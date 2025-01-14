<?php
/**
 * RetraceurUpgrade API.
 *
 * Most of the functions are pluggable and can be overwritten.
 *
 * @since 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Administration
 */

/** Include user installation customization script. */
if ( file_exists( WP_CONTENT_DIR . '/install.php' ) ) {
	require WP_CONTENT_DIR . '/install.php';
}

/** Retraceur Administration API */
require_once ABSPATH . 'wp-admin/includes/admin.php';

/** Retraceur Schema API */
require_once ABSPATH . 'wp-admin/includes/schema.php';

if ( ! function_exists( 'wp_install' ) ) :
	/**
	 * Installs the site.
	 *
	 * Runs the required functions to set up and populate the database,
	 * including primary admin user and initial options.
	 *
	 * @since WP 2.1.0
	 *
	 * @param string $blog_title    Site title.
	 * @param string $user_name     User's username.
	 * @param string $user_email    User's email.
	 * @param bool   $is_public     Whether the site is public.
	 * @param string $deprecated    Optional. Not used.
	 * @param string $user_password Optional. User's chosen password. Default empty (random password).
	 * @param string $language      Optional. Language chosen. Default empty.
	 * @return array {
	 *     Data for the newly installed site.
	 *
	 *     @type string $url              The URL of the site.
	 *     @type int    $user_id          The ID of the site owner.
	 *     @type string $password         The password of the site owner, if their user account didn't already exist.
	 *     @type string $password_message The explanatory message regarding the password.
	 * }
	 */
	function wp_install( $blog_title, $user_name, $user_email, $is_public, $deprecated = '', $user_password = '', $language = '' ) {
		if ( ! empty( $deprecated ) ) {
			_deprecated_argument( __FUNCTION__, '2.6.0' );
		}

		wp_check_mysql_version();
		wp_cache_flush();
		make_db_current_silent();

		/*
		 * Ensure update checks are delayed after installation.
		 *
		 * This prevents users being presented with a maintenance mode screen
		 * immediately after installation.
		 */
		wp_unschedule_hook( 'wp_version_check' );
		wp_unschedule_hook( 'wp_update_plugins' );
		wp_unschedule_hook( 'wp_update_themes' );

		wp_schedule_event( time() + HOUR_IN_SECONDS, 'twicedaily', 'wp_version_check' );
		wp_schedule_event( time() + ( 1.5 * HOUR_IN_SECONDS ), 'twicedaily', 'wp_update_plugins' );
		wp_schedule_event( time() + ( 2 * HOUR_IN_SECONDS ), 'twicedaily', 'wp_update_themes' );

		populate_options();
		populate_roles();

		update_option( 'blogname', $blog_title );
		update_option( 'admin_email', $user_email );
		update_option( 'blog_public', $is_public );

		// Freshness of site - in the future, this could get more specific about actions taken, perhaps.
		update_option( 'fresh_site', 1, false );

		if ( $language ) {
			update_option( 'WPLANG', $language );
		}

		$guessurl = wp_guess_url();

		update_option( 'siteurl', $guessurl );

		// If not a public site, don't ping.
		if ( ! $is_public ) {
			update_option( 'default_pingback_flag', 0 );
		}

		/*
		 * Create default user. If the user already exists, the user tables are
		 * being shared among sites. Just set the role in that case.
		 */
		$user_id        = username_exists( $user_name );
		$user_password  = trim( $user_password );
		$email_password = false;
		$user_created   = false;

		if ( ! $user_id && empty( $user_password ) ) {
			$user_password = wp_generate_password( 12, false );
			$message       = __( '<strong><em>Note that password</em></strong> carefully! It is a <em>random</em> password that was generated just for you.' );
			$user_id       = wp_create_user( $user_name, $user_password, $user_email );
			update_user_meta( $user_id, 'default_password_nag', true );
			$email_password = true;
			$user_created   = true;
		} elseif ( ! $user_id ) {
			// Password has been provided.
			$message      = '<em>' . __( 'Your chosen password.' ) . '</em>';
			$user_id      = wp_create_user( $user_name, $user_password, $user_email );
			$user_created = true;
		} else {
			$message = __( 'User already exists. Password inherited.' );
		}

		$user = new WP_User( $user_id );
		$user->set_role( 'administrator' );

		if ( $user_created ) {
			$user->user_url = $guessurl;
			wp_update_user( $user );
		}

		wp_install_defaults( $user_id );

		wp_install_maybe_enable_pretty_permalinks();

		flush_rewrite_rules();

		wp_new_blog_notification( $blog_title, $guessurl, $user_id, ( $email_password ? $user_password : __( 'The password you chose during installation.' ) ) );

		wp_cache_flush();

		/**
		 * Fires after a site is fully installed.
		 *
		 * @since WP 3.9.0
		 *
		 * @param WP_User $user The site owner.
		 */
		do_action( 'wp_install', $user );

		return array(
			'url'              => $guessurl,
			'user_id'          => $user_id,
			'password'         => $user_password,
			'password_message' => $message,
		);
	}
endif;

if ( ! function_exists( 'wp_install_defaults' ) ) :
	/**
	 * Creates the initial content for a newly-installed site.
	 *
	 * Adds the default "Uncategorized" category, the first post,
	 * first page for default theme for the current version.
	 *
	 * @since WP 2.1.0
	 *
	 * @global wpdb       $wpdb         Retraceur database abstraction object.
	 * @global string     $table_prefix The database table prefix.
	 *
	 * @param int $user_id User ID.
	 */
	function wp_install_defaults( $user_id ) {
		global $wpdb, $table_prefix;

		// Default category.
		$cat_name = __( 'Uncategorized' );
		/* translators: Default category slug. */
		$cat_slug = sanitize_title( _x( 'Uncategorized', 'Default category slug' ) );

		$cat_id = 1;

		$wpdb->insert(
			$wpdb->terms,
			array(
				'term_id'    => $cat_id,
				'name'       => $cat_name,
				'slug'       => $cat_slug,
				'term_group' => 0,
			)
		);
		$wpdb->insert(
			$wpdb->term_taxonomy,
			array(
				'term_id'     => $cat_id,
				'taxonomy'    => 'category',
				'description' => '',
				'parent'      => 0,
				'count'       => 1,
			)
		);
		$cat_tt_id = $wpdb->insert_id;

		// First post.
		$now             = current_time( 'mysql' );
		$now_gmt         = current_time( 'mysql', 1 );
		$first_post_guid = get_option( 'home' ) . '/?p=1';
		$first_post      = "<!-- wp:paragraph -->\n<p>" .
			/* translators: First post content. */
			__( 'This a post. Posts appear chronologically in your news feed and are a great way to retrace stories about you, your interests or what you accomplished.' ) .
			"</p>\n<!-- /wp:paragraph -->";

		if ( is_multisite() ) {
			/**
			 * Filter here to edit the first network site post.
			 *
			 * @since 1.0.0
			 *
			 * @param string $first_post The content of the first default post.
			 */
			$first_post = apply_filters( 'retraceur_ms_default_post', $first_post );
		}

		$wpdb->insert(
			$wpdb->posts,
			array(
				'post_author'           => $user_id,
				'post_date'             => $now,
				'post_date_gmt'         => $now_gmt,
				'post_content'          => $first_post,
				'post_excerpt'          => '',
				'post_title'            => __( 'Thanks for making Retraceur your very own Personal Online Publication Hub ♡' ),
				/* translators: Default post slug. */
				'post_name'             => sanitize_title( _x( 'thank-you', 'Default post slug' ) ),
				'post_modified'         => $now,
				'post_modified_gmt'     => $now_gmt,
				'guid'                  => $first_post_guid,
				'post_content_filtered' => '',
			)
		);

		if ( is_multisite() ) {
			update_posts_count();
		}

		$wpdb->insert(
			$wpdb->term_relationships,
			array(
				'term_taxonomy_id' => $cat_tt_id,
				'object_id'        => 1,
			)
		);

		$first_page = "<!-- wp:paragraph -->\n<p>";
		/* translators: First page content. */
		$first_page .= __( "This is a page, unlike posts, which appear chronologically in your news feed, pages are hierarchical content that can be used to introduce yourself or share lasting information about you. As most people start with an About page, here is an example of what you might say to your visitors:" );
		$first_page .= "</p>\n<!-- /wp:paragraph -->\n\n";

		$first_page .= "<!-- wp:quote -->\n<blockquote class=\"wp-block-quote\"><p>";
		/* translators: First page content. */
		$first_page .= __( "Hi there! This is my personal website. I use it to retrace great stories and share my thoughts." );
		$first_page .= "</p></blockquote>\n<!-- /wp:quote -->\n\n";

		$first_page .= "<!-- wp:paragraph -->\n<p>";
		$first_page .= sprintf(
			/* translators: First page content. %s: Site admin URL. */
			__( 'As a new Retraceur writer, you should go to <a href="%s">your dashboard</a> to edit or delete this page and create new pages for your content. Be inspired!' ),
			admin_url()
		);
		$first_page .= "</p>\n<!-- /wp:paragraph -->";

		if ( is_multisite() ) {
			/**
			 * Filter here to edit the first network site page.
			 *
			 * @since 1.0.0
			 *
			 * @param string $first_page The content of the first default page.
			 */
			$first_page = apply_filters( 'retraceur_ms_default_page', $first_page );
		}

		$first_post_guid = get_option( 'home' ) . '/?page_id=2';
		$wpdb->insert(
			$wpdb->posts,
			array(
				'post_author'           => $user_id,
				'post_date'             => $now,
				'post_date_gmt'         => $now_gmt,
				'post_content'          => $first_page,
				'post_excerpt'          => '',
				'post_title'            => __( 'About' ),
				/* translators: Default page slug. */
				'post_name'             => sanitize_title( _x( 'about', 'Default post slug' ) ),
				'post_modified'         => $now,
				'post_modified_gmt'     => $now_gmt,
				'guid'                  => $first_post_guid,
				'post_type'             => 'page',
				'post_content_filtered' => '',
			)
		);
		$wpdb->insert(
			$wpdb->postmeta,
			array(
				'post_id'    => 2,
				'meta_key'   => '_wp_page_template',
				'meta_value' => 'default',
			)
		);

		// Privacy Policy page.
		if ( is_multisite() ) {
			// Disable by default unless the suggested content is provided.
			$privacy_policy_content = get_site_option( 'default_privacy_policy_content' );
		} else {
			if ( ! class_exists( 'WP_Privacy_Policy_Content' ) ) {
				require_once ABSPATH . 'wp-admin/includes/class-wp-privacy-policy-content.php';
			}

			$privacy_policy_content = WP_Privacy_Policy_Content::get_default_content();
		}

		if ( ! empty( $privacy_policy_content ) ) {
			$privacy_policy_guid = get_option( 'home' ) . '/?page_id=3';

			$wpdb->insert(
				$wpdb->posts,
				array(
					'post_author'           => $user_id,
					'post_date'             => $now,
					'post_date_gmt'         => $now_gmt,
					'post_content'          => $privacy_policy_content,
					'post_excerpt'          => '',
					'post_title'            => __( 'Privacy Policy' ),
					/* translators: Privacy Policy page slug. */
					'post_name'             => __( 'privacy-policy' ),
					'post_modified'         => $now,
					'post_modified_gmt'     => $now_gmt,
					'guid'                  => $privacy_policy_guid,
					'post_type'             => 'page',
					'post_status'           => 'draft',
					'post_content_filtered' => '',
				)
			);
			$wpdb->insert(
				$wpdb->postmeta,
				array(
					'post_id'    => 3,
					'meta_key'   => '_wp_page_template',
					'meta_value' => 'default',
				)
			);
			update_option( 'wp_page_for_privacy_policy', 3 );
		}

		if ( ! is_multisite() ) {
			update_user_meta( $user_id, 'show_welcome_panel', 1 );
		} elseif ( ! is_super_admin( $user_id ) && ! metadata_exists( 'user', $user_id, 'show_welcome_panel' ) ) {
			update_user_meta( $user_id, 'show_welcome_panel', 2 );
		}

		/**
		 * Fire once default content has been created.
		 *
		 * @since 1.0.0 Retraceur fork.
		 *
		 * @param integer $user_id The user ID.
		 */
		do_action( 'retraceur_installed_defaults', $user_id );
	}
endif;

/**
 * Maybe enable pretty permalinks on installation.
 *
 * If after enabling pretty permalinks don't work, fallback to query-string permalinks.
 *
 * @since WP 4.2.0
 *
 * @global WP_Rewrite $wp_rewrite Retraceur rewrite component.
 *
 * @return bool Whether pretty permalinks are enabled. False otherwise.
 */
function wp_install_maybe_enable_pretty_permalinks() {
	global $wp_rewrite;

	// Bail if a permalink structure is already enabled.
	if ( get_option( 'permalink_structure' ) ) {
		return true;
	}

	/*
	 * The Permalink structures to attempt.
	 *
	 * The first is designed for mod_rewrite or nginx rewriting.
	 *
	 * The second is PATHINFO-based permalinks for web server configurations
	 * without a true rewrite module enabled.
	 */
	$permalink_structures = array(
		'/%year%/%monthnum%/%day%/%postname%/',
		'/index.php/%year%/%monthnum%/%day%/%postname%/',
	);

	foreach ( (array) $permalink_structures as $permalink_structure ) {
		$wp_rewrite->set_permalink_structure( $permalink_structure );

		/*
		 * Flush rules with the hard option to force refresh of the web-server's
		 * rewrite config file (e.g. .htaccess or web.config).
		 */
		$wp_rewrite->flush_rules( true );

		$test_url = '';

		// Test against a real Retraceur post.
		$first_post = get_page_by_path( sanitize_title( _x( 'thank-you', 'Default post slug' ) ), OBJECT, 'post' );
		if ( $first_post ) {
			$test_url = get_permalink( $first_post->ID );
		}

		/*
		 * Send a request to the site, and check whether
		 * the 'X-Pingback' header is returned as expected.
		 *
		 * Uses wp_remote_get() instead of wp_remote_head() because web servers
		 * can block head requests.
		 */
		$response          = wp_remote_get( $test_url, array( 'timeout' => 5 ) );
		$x_pingback_header = wp_remote_retrieve_header( $response, 'X-Pingback' );
		$pretty_permalinks = $x_pingback_header && get_bloginfo( 'pingback_url' ) === $x_pingback_header;

		if ( $pretty_permalinks ) {
			return true;
		}
	}

	/*
	 * If it makes it this far, pretty permalinks failed.
	 * Fallback to query-string permalinks.
	 */
	$wp_rewrite->set_permalink_structure( '' );
	$wp_rewrite->flush_rules( true );

	return false;
}

if ( ! function_exists( 'wp_new_blog_notification' ) ) :
	/**
	 * Notifies the site admin that the installation of Retraceur is complete.
	 *
	 * Sends an email to the new administrator that the installation is complete
	 * and provides them with a record of their login credentials.
	 *
	 * @since WP 2.1.0
	 *
	 * @param string $blog_title Site title.
	 * @param string $blog_url   Site URL.
	 * @param int    $user_id    Administrator's user ID.
	 * @param string $password   Administrator's password. Note that a placeholder message is
	 *                           usually passed instead of the actual password.
	 */
	function wp_new_blog_notification( $blog_title, $blog_url, $user_id, $password ) {
		$user      = new WP_User( $user_id );
		$email     = $user->user_email;
		$name      = $user->user_login;
		$login_url = wp_login_url();

		$message = sprintf(
			/* translators: New site notification email. 1: New site URL, 2: User login, 3: User password or password reset link, 4: Login URL. */
			__(
				'Your new Retraceur site has been successfully set up at:

%1$s

You can log in to the administrator account with the following information:

Username: %2$s
Password: %3$s
Log in here: %4$s

We hope you enjoy your new site. Thanks!
'
			),
			$blog_url,
			$name,
			$password,
			$login_url
		);

		$installed_email = array(
			'to'      => $email,
			'subject' => __( 'New Retraceur Site' ),
			'message' => $message,
			'headers' => '',
		);

		/**
		 * Filters the contents of the email sent to the site administrator when Retraceur is installed.
		 *
		 * @since WP 5.6.0
		 *
		 * @param array $installed_email {
		 *     Used to build wp_mail().
		 *
		 *     @type string $to      The email address of the recipient.
		 *     @type string $subject The subject of the email.
		 *     @type string $message The content of the email.
		 *     @type string $headers Headers.
		 * }
		 * @param WP_User $user          The site administrator user object.
		 * @param string  $blog_title    The site title.
		 * @param string  $blog_url      The site URL.
		 * @param string  $password      The site administrator's password. Note that a placeholder message
		 *                               is usually passed instead of the user's actual password.
		 */
		$installed_email = apply_filters( 'wp_installed_email', $installed_email, $user, $blog_title, $blog_url, $password );

		wp_mail(
			$installed_email['to'],
			$installed_email['subject'],
			$installed_email['message'],
			$installed_email['headers']
		);
	}
endif;

if ( ! function_exists( 'wp_upgrade' ) ) :
	/**
	 * Runs Retraceur Upgrade functions.
	 *
	 * Upgrades the database if needed during a site update.
	 *
	 * @since WP 2.1.0
	 *
	 * @global int $wp_current_db_version The old (current) database version.
	 * @global int $wp_db_version         The new database version.
	 */
	function wp_upgrade() {
		global $wp_current_db_version, $wp_db_version;

		$wp_current_db_version = (int) __get_option( 'db_version' );

		// We are up to date. Nothing to do.
		if ( $wp_db_version === $wp_current_db_version ) {
			return;
		}

		if ( ! is_blog_installed() ) {
			return;
		}

		wp_check_mysql_version();
		wp_cache_flush();
		make_db_current_silent();
		upgrade_all();
		if ( is_multisite() && is_main_site() ) {
			upgrade_network();
		}
		wp_cache_flush();

		if ( is_multisite() ) {
			update_site_meta( get_current_blog_id(), 'db_version', $wp_db_version );
			update_site_meta( get_current_blog_id(), 'db_last_updated', microtime() );
		}

		delete_transient( 'wp_core_block_css_files' );

		/**
		 * Fires after a site is fully upgraded.
		 *
		 * @since WP 3.9.0
		 *
		 * @param int $wp_db_version         The new $wp_db_version.
		 * @param int $wp_current_db_version The old (current) $wp_db_version.
		 */
		do_action( 'wp_upgrade', $wp_db_version, $wp_current_db_version );
	}
endif;

/**
 * Functions to be called in installation and upgrade scripts.
 *
 * Contains conditional checks to determine which upgrade scripts to run,
 * based on database version and WP version being updated-to.
 *
 * @ignore
 * @since WP 1.0.1
 *
 * @global int $wp_current_db_version The old (current) database version.
 * @global int $wp_db_version         The new database version.
 */
function upgrade_all() {
	global $wp_current_db_version, $wp_db_version;

	$wp_current_db_version = (int) __get_option( 'db_version' );

	// We are up to date. Nothing to do.
	if ( $wp_db_version === $wp_current_db_version ) {
		return;
	}

	// If the version is not set in the DB, use 0.
	if ( empty( $wp_current_db_version ) ) {
		$wp_current_db_version = 0;
	}

	populate_options();

	update_option( 'db_version', $wp_db_version );
	update_option( 'db_upgraded', true );
}

/**
 * Executes network-level upgrade routines.
 *
 * @since WP 3.0.0
 *
 * @global int  $wp_current_db_version The old (current) database version.
 * @global wpdb $wpdb                  Retraceur database abstraction object.
 */
function upgrade_network() {
	global $wp_current_db_version, $wpdb;

	// Always clear expired transients.
	delete_expired_transients( true );
}

//
// General functions we use to actually do stuff.
//

/**
 * Creates a table in the database, if it doesn't already exist.
 *
 * This method checks for an existing database table and creates a new one if it's not
 * already present. It doesn't rely on MySQL's "IF NOT EXISTS" statement, but chooses
 * to query all tables first and then run the SQL statement creating the table.
 *
 * @since WP 1.0.0
 *
 * @global wpdb $wpdb Retraceur database abstraction object.
 *
 * @param string $table_name Database table name.
 * @param string $create_ddl SQL statement to create table.
 * @return bool True on success or if the table already exists. False on failure.
 */
function maybe_create_table( $table_name, $create_ddl ) {
	global $wpdb;

	$query = $wpdb->prepare( 'SHOW TABLES LIKE %s', $wpdb->esc_like( $table_name ) );

	if ( $wpdb->get_var( $query ) === $table_name ) {
		return true;
	}

	// Didn't find it, so try to create it.
	$wpdb->query( $create_ddl );

	// We cannot directly tell that whether this succeeded!
	if ( $wpdb->get_var( $query ) === $table_name ) {
		return true;
	}

	return false;
}

/**
 * Drops a specified index from a table.
 *
 * @since WP 1.0.1
 *
 * @global wpdb $wpdb Retraceur database abstraction object.
 *
 * @param string $table Database table name.
 * @param string $index Index name to drop.
 * @return true True, when finished.
 */
function drop_index( $table, $index ) {
	global $wpdb;

	$wpdb->hide_errors();

	$wpdb->query( "ALTER TABLE `$table` DROP INDEX `$index`" );

	// Now we need to take out all the extra ones we may have created.
	for ( $i = 0; $i < 25; $i++ ) {
		$wpdb->query( "ALTER TABLE `$table` DROP INDEX `{$index}_$i`" );
	}

	$wpdb->show_errors();

	return true;
}

/**
 * Adds an index to a specified table.
 *
 * @since WP 1.0.1
 *
 * @global wpdb $wpdb Retraceur database abstraction object.
 *
 * @param string $table Database table name.
 * @param string $index Database table index column.
 * @return true True, when done with execution.
 */
function add_clean_index( $table, $index ) {
	global $wpdb;

	drop_index( $table, $index );
	$wpdb->query( "ALTER TABLE `$table` ADD INDEX ( `$index` )" );

	return true;
}

/**
 * Adds column to a database table, if it doesn't already exist.
 *
 * @since WP 1.3.0
 *
 * @global wpdb $wpdb Retraceur database abstraction object.
 *
 * @param string $table_name  Database table name.
 * @param string $column_name Table column name.
 * @param string $create_ddl  SQL statement to add column.
 * @return bool True on success or if the column already exists. False on failure.
 */
function maybe_add_column( $table_name, $column_name, $create_ddl ) {
	global $wpdb;

	foreach ( $wpdb->get_col( "DESC $table_name", 0 ) as $column ) {
		if ( $column === $column_name ) {
			return true;
		}
	}

	// Didn't find it, so try to create it.
	$wpdb->query( $create_ddl );

	// We cannot directly tell that whether this succeeded!
	foreach ( $wpdb->get_col( "DESC $table_name", 0 ) as $column ) {
		if ( $column === $column_name ) {
			return true;
		}
	}

	return false;
}

/**
 * If a table only contains utf8 or utf8mb4 columns, convert it to utf8mb4.
 *
 * @since WP 4.2.0
 *
 * @global wpdb $wpdb Retraceur database abstraction object.
 *
 * @param string $table The table to convert.
 * @return bool True if the table was converted, false if it wasn't.
 */
function maybe_convert_table_to_utf8mb4( $table ) {
	global $wpdb;

	$results = $wpdb->get_results( "SHOW FULL COLUMNS FROM `$table`" );
	if ( ! $results ) {
		return false;
	}

	foreach ( $results as $column ) {
		if ( $column->Collation ) {
			list( $charset ) = explode( '_', $column->Collation );
			$charset         = strtolower( $charset );
			if ( 'utf8' !== $charset && 'utf8mb4' !== $charset ) {
				// Don't upgrade tables that have non-utf8 columns.
				return false;
			}
		}
	}

	$table_details = $wpdb->get_row( "SHOW TABLE STATUS LIKE '$table'" );
	if ( ! $table_details ) {
		return false;
	}

	list( $table_charset ) = explode( '_', $table_details->Collation );
	$table_charset         = strtolower( $table_charset );
	if ( 'utf8mb4' === $table_charset ) {
		return true;
	}

	return $wpdb->query( "ALTER TABLE $table CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci" );
}

/**
 * Utility version of get_option that is private to installation/upgrade.
 *
 * @ignore
 * @since WP 1.5.1
 * @access private
 *
 * @global wpdb $wpdb Retraceur database abstraction object.
 *
 * @param string $setting Option name.
 * @return mixed
 */
function __get_option( $setting ) { // phpcs:ignore WordPress.NamingConventions.ValidFunctionName.FunctionDoubleUnderscore,PHPCompatibility.FunctionNameRestrictions.ReservedFunctionNames.FunctionDoubleUnderscore
	global $wpdb;

	if ( 'home' === $setting && defined( 'WP_HOME' ) ) {
		return untrailingslashit( WP_HOME );
	}

	if ( 'siteurl' === $setting && defined( 'WP_SITEURL' ) ) {
		return untrailingslashit( WP_SITEURL );
	}

	$option = $wpdb->get_var( $wpdb->prepare( "SELECT option_value FROM $wpdb->options WHERE option_name = %s", $setting ) );

	if ( 'home' === $setting && ! $option ) {
		return __get_option( 'siteurl' );
	}

	if ( in_array( $setting, array( 'siteurl', 'home', 'category_base', 'tag_base' ), true ) ) {
		$option = untrailingslashit( $option );
	}

	return maybe_unserialize( $option );
}

/**
 * Filters for content to remove unnecessary slashes.
 *
 * @since WP 1.5.0
 *
 * @param string $content The content to modify.
 * @return string The de-slashed content.
 */
function deslash( $content ) {
	// Note: \\\ inside a regex denotes a single backslash.

	/*
	 * Replace one or more backslashes followed by a single quote with
	 * a single quote.
	 */
	$content = preg_replace( "/\\\+'/", "'", $content );

	/*
	 * Replace one or more backslashes followed by a double quote with
	 * a double quote.
	 */
	$content = preg_replace( '/\\\+"/', '"', $content );

	// Replace one or more backslashes with one backslash.
	$content = preg_replace( '/\\\+/', '\\', $content );

	return $content;
}

/**
 * Modifies the database based on specified SQL statements.
 *
 * Useful for creating new tables and updating existing tables to a new structure.
 *
 * @since WP 1.5.0
 * @since WP 6.1.0 Ignores display width for integer data types on MySQL 8.0.17 or later,
 *              to match MySQL behavior. Note: This does not affect MariaDB.
 *
 * @global wpdb $wpdb Retraceur database abstraction object.
 *
 * @param string[]|string $queries Optional. The query to run. Can be multiple queries
 *                                 in an array, or a string of queries separated by
 *                                 semicolons. Default empty string.
 * @param bool            $execute Optional. Whether or not to execute the query right away.
 *                                 Default true.
 * @return array Strings containing the results of the various update queries.
 */
function dbDelta( $queries = '', $execute = true ) { // phpcs:ignore WordPress.NamingConventions.ValidFunctionName.FunctionNameInvalid
	global $wpdb;

	if ( in_array( $queries, array( '', 'all', 'blog', 'global', 'ms_global' ), true ) ) {
		$queries = wp_get_db_schema( $queries );
	}

	// Separate individual queries into an array.
	if ( ! is_array( $queries ) ) {
		$queries = explode( ';', $queries );
		$queries = array_filter( $queries );
	}

	/**
	 * Filters the dbDelta SQL queries.
	 *
	 * @since WP 3.3.0
	 *
	 * @param string[] $queries An array of dbDelta SQL queries.
	 */
	$queries = apply_filters( 'dbdelta_queries', $queries );

	$cqueries   = array(); // Creation queries.
	$iqueries   = array(); // Insertion queries.
	$for_update = array();

	// Create a tablename index for an array ($cqueries) of recognized query types.
	foreach ( $queries as $qry ) {
		if ( preg_match( '|CREATE TABLE ([^ ]*)|', $qry, $matches ) ) {
			$cqueries[ trim( $matches[1], '`' ) ] = $qry;
			$for_update[ $matches[1] ]            = 'Created table ' . $matches[1];
			continue;
		}

		if ( preg_match( '|CREATE DATABASE ([^ ]*)|', $qry, $matches ) ) {
			array_unshift( $cqueries, $qry );
			continue;
		}

		if ( preg_match( '|INSERT INTO ([^ ]*)|', $qry, $matches ) ) {
			$iqueries[] = $qry;
			continue;
		}

		if ( preg_match( '|UPDATE ([^ ]*)|', $qry, $matches ) ) {
			$iqueries[] = $qry;
			continue;
		}
	}

	/**
	 * Filters the dbDelta SQL queries for creating tables and/or databases.
	 *
	 * Queries filterable via this hook contain "CREATE TABLE" or "CREATE DATABASE".
	 *
	 * @since WP 3.3.0
	 *
	 * @param string[] $cqueries An array of dbDelta create SQL queries.
	 */
	$cqueries = apply_filters( 'dbdelta_create_queries', $cqueries );

	/**
	 * Filters the dbDelta SQL queries for inserting or updating.
	 *
	 * Queries filterable via this hook contain "INSERT INTO" or "UPDATE".
	 *
	 * @since WP 3.3.0
	 *
	 * @param string[] $iqueries An array of dbDelta insert or update SQL queries.
	 */
	$iqueries = apply_filters( 'dbdelta_insert_queries', $iqueries );

	$text_fields = array( 'tinytext', 'text', 'mediumtext', 'longtext' );
	$blob_fields = array( 'tinyblob', 'blob', 'mediumblob', 'longblob' );
	$int_fields  = array( 'tinyint', 'smallint', 'mediumint', 'int', 'integer', 'bigint' );

	$global_tables  = $wpdb->tables( 'global' );
	$db_version     = $wpdb->db_version();
	$db_server_info = $wpdb->db_server_info();

	foreach ( $cqueries as $table => $qry ) {
		// Upgrade global tables only for the main site. Don't upgrade at all if conditions are not optimal.
		if ( in_array( $table, $global_tables, true ) && ! wp_should_upgrade_global_tables() ) {
			unset( $cqueries[ $table ], $for_update[ $table ] );
			continue;
		}

		// Fetch the table column structure from the database.
		$suppress    = $wpdb->suppress_errors();
		$tablefields = $wpdb->get_results( "DESCRIBE {$table};" );
		$wpdb->suppress_errors( $suppress );

		if ( ! $tablefields ) {
			continue;
		}

		// Clear the field and index arrays.
		$cfields                  = array();
		$indices                  = array();
		$indices_without_subparts = array();

		// Get all of the field names in the query from between the parentheses.
		preg_match( '|\((.*)\)|ms', $qry, $match2 );
		$qryline = trim( $match2[1] );

		// Separate field lines into an array.
		$flds = explode( "\n", $qryline );

		// For every field line specified in the query.
		foreach ( $flds as $fld ) {
			$fld = trim( $fld, " \t\n\r\0\x0B," ); // Default trim characters, plus ','.

			// Extract the field name.
			preg_match( '|^([^ ]*)|', $fld, $fvals );
			$fieldname            = trim( $fvals[1], '`' );
			$fieldname_lowercased = strtolower( $fieldname );

			// Verify the found field name.
			$validfield = true;
			switch ( $fieldname_lowercased ) {
				case '':
				case 'primary':
				case 'index':
				case 'fulltext':
				case 'unique':
				case 'key':
				case 'spatial':
					$validfield = false;

					/*
					 * Normalize the index definition.
					 *
					 * This is done so the definition can be compared against the result of a
					 * `SHOW INDEX FROM $table_name` query which returns the current table
					 * index information.
					 */

					// Extract type, name and columns from the definition.
					preg_match(
						'/^
							(?P<index_type>             # 1) Type of the index.
								PRIMARY\s+KEY|(?:UNIQUE|FULLTEXT|SPATIAL)\s+(?:KEY|INDEX)|KEY|INDEX
							)
							\s+                         # Followed by at least one white space character.
							(?:                         # Name of the index. Optional if type is PRIMARY KEY.
								`?                      # Name can be escaped with a backtick.
									(?P<index_name>     # 2) Name of the index.
										(?:[0-9a-zA-Z$_-]|[\xC2-\xDF][\x80-\xBF])+
									)
								`?                      # Name can be escaped with a backtick.
								\s+                     # Followed by at least one white space character.
							)*
							\(                          # Opening bracket for the columns.
								(?P<index_columns>
									.+?                 # 3) Column names, index prefixes, and orders.
								)
							\)                          # Closing bracket for the columns.
						$/imx',
						$fld,
						$index_matches
					);

					// Uppercase the index type and normalize space characters.
					$index_type = strtoupper( preg_replace( '/\s+/', ' ', trim( $index_matches['index_type'] ) ) );

					// 'INDEX' is a synonym for 'KEY', standardize on 'KEY'.
					$index_type = str_replace( 'INDEX', 'KEY', $index_type );

					// Escape the index name with backticks. An index for a primary key has no name.
					$index_name = ( 'PRIMARY KEY' === $index_type ) ? '' : '`' . strtolower( $index_matches['index_name'] ) . '`';

					// Parse the columns. Multiple columns are separated by a comma.
					$index_columns                  = array_map( 'trim', explode( ',', $index_matches['index_columns'] ) );
					$index_columns_without_subparts = $index_columns;

					// Normalize columns.
					foreach ( $index_columns as $id => &$index_column ) {
						// Extract column name and number of indexed characters (sub_part).
						preg_match(
							'/
								`?                      # Name can be escaped with a backtick.
									(?P<column_name>    # 1) Name of the column.
										(?:[0-9a-zA-Z$_-]|[\xC2-\xDF][\x80-\xBF])+
									)
								`?                      # Name can be escaped with a backtick.
								(?:                     # Optional sub part.
									\s*                 # Optional white space character between name and opening bracket.
									\(                  # Opening bracket for the sub part.
										\s*             # Optional white space character after opening bracket.
										(?P<sub_part>
											\d+         # 2) Number of indexed characters.
										)
										\s*             # Optional white space character before closing bracket.
									\)                  # Closing bracket for the sub part.
								)?
							/x',
							$index_column,
							$index_column_matches
						);

						// Escape the column name with backticks.
						$index_column = '`' . $index_column_matches['column_name'] . '`';

						// We don't need to add the subpart to $index_columns_without_subparts
						$index_columns_without_subparts[ $id ] = $index_column;

						// Append the optional sup part with the number of indexed characters.
						if ( isset( $index_column_matches['sub_part'] ) ) {
							$index_column .= '(' . $index_column_matches['sub_part'] . ')';
						}
					}

					// Build the normalized index definition and add it to the list of indices.
					$indices[]                  = "{$index_type} {$index_name} (" . implode( ',', $index_columns ) . ')';
					$indices_without_subparts[] = "{$index_type} {$index_name} (" . implode( ',', $index_columns_without_subparts ) . ')';

					// Destroy no longer needed variables.
					unset( $index_column, $index_column_matches, $index_matches, $index_type, $index_name, $index_columns, $index_columns_without_subparts );

					break;
			}

			// If it's a valid field, add it to the field array.
			if ( $validfield ) {
				$cfields[ $fieldname_lowercased ] = $fld;
			}
		}

		// For every field in the table.
		foreach ( $tablefields as $tablefield ) {
			$tablefield_field_lowercased = strtolower( $tablefield->Field );
			$tablefield_type_lowercased  = strtolower( $tablefield->Type );

			$tablefield_type_without_parentheses = preg_replace(
				'/'
				. '(.+)'       // Field type, e.g. `int`.
				. '\(\d*\)'    // Display width.
				. '(.*)'       // Optional attributes, e.g. `unsigned`.
				. '/',
				'$1$2',
				$tablefield_type_lowercased
			);

			// Get the type without attributes, e.g. `int`.
			$tablefield_type_base = strtok( $tablefield_type_without_parentheses, ' ' );

			// If the table field exists in the field array...
			if ( array_key_exists( $tablefield_field_lowercased, $cfields ) ) {

				// Get the field type from the query.
				preg_match( '|`?' . $tablefield->Field . '`? ([^ ]*( unsigned)?)|i', $cfields[ $tablefield_field_lowercased ], $matches );
				$fieldtype            = $matches[1];
				$fieldtype_lowercased = strtolower( $fieldtype );

				$fieldtype_without_parentheses = preg_replace(
					'/'
					. '(.+)'       // Field type, e.g. `int`.
					. '\(\d*\)'    // Display width.
					. '(.*)'       // Optional attributes, e.g. `unsigned`.
					. '/',
					'$1$2',
					$fieldtype_lowercased
				);

				// Get the type without attributes, e.g. `int`.
				$fieldtype_base = strtok( $fieldtype_without_parentheses, ' ' );

				// Is actual field type different from the field type in query?
				if ( $tablefield->Type !== $fieldtype ) {
					$do_change = true;
					if ( in_array( $fieldtype_lowercased, $text_fields, true ) && in_array( $tablefield_type_lowercased, $text_fields, true ) ) {
						if ( array_search( $fieldtype_lowercased, $text_fields, true ) < array_search( $tablefield_type_lowercased, $text_fields, true ) ) {
							$do_change = false;
						}
					}

					if ( in_array( $fieldtype_lowercased, $blob_fields, true ) && in_array( $tablefield_type_lowercased, $blob_fields, true ) ) {
						if ( array_search( $fieldtype_lowercased, $blob_fields, true ) < array_search( $tablefield_type_lowercased, $blob_fields, true ) ) {
							$do_change = false;
						}
					}

					if ( in_array( $fieldtype_base, $int_fields, true ) && in_array( $tablefield_type_base, $int_fields, true )
						&& $fieldtype_without_parentheses === $tablefield_type_without_parentheses
					) {
						/*
						 * MySQL 8.0.17 or later does not support display width for integer data types,
						 * so if display width is the only difference, it can be safely ignored.
						 * Note: This is specific to MySQL and does not affect MariaDB.
						 */
						if ( version_compare( $db_version, '8.0.17', '>=' )
							&& ! str_contains( $db_server_info, 'MariaDB' )
						) {
							$do_change = false;
						}
					}

					if ( $do_change ) {
						// Add a query to change the column type.
						$cqueries[] = "ALTER TABLE {$table} CHANGE COLUMN `{$tablefield->Field}` " . $cfields[ $tablefield_field_lowercased ];

						$for_update[ $table . '.' . $tablefield->Field ] = "Changed type of {$table}.{$tablefield->Field} from {$tablefield->Type} to {$fieldtype}";
					}
				}

				// Get the default value from the array.
				if ( preg_match( "| DEFAULT '(.*?)'|i", $cfields[ $tablefield_field_lowercased ], $matches ) ) {
					$default_value = $matches[1];
					if ( $tablefield->Default !== $default_value ) {
						// Add a query to change the column's default value
						$cqueries[] = "ALTER TABLE {$table} ALTER COLUMN `{$tablefield->Field}` SET DEFAULT '{$default_value}'";

						$for_update[ $table . '.' . $tablefield->Field ] = "Changed default value of {$table}.{$tablefield->Field} from {$tablefield->Default} to {$default_value}";
					}
				}

				// Remove the field from the array (so it's not added).
				unset( $cfields[ $tablefield_field_lowercased ] );
			} else {
				// This field exists in the table, but not in the creation queries?
			}
		}

		// For every remaining field specified for the table.
		foreach ( $cfields as $fieldname => $fielddef ) {
			// Push a query line into $cqueries that adds the field to that table.
			$cqueries[] = "ALTER TABLE {$table} ADD COLUMN $fielddef";

			$for_update[ $table . '.' . $fieldname ] = 'Added column ' . $table . '.' . $fieldname;
		}

		// Index stuff goes here. Fetch the table index structure from the database.
		$tableindices = $wpdb->get_results( "SHOW INDEX FROM {$table};" );

		if ( $tableindices ) {
			// Clear the index array.
			$index_ary = array();

			// For every index in the table.
			foreach ( $tableindices as $tableindex ) {
				$keyname = strtolower( $tableindex->Key_name );

				// Add the index to the index data array.
				$index_ary[ $keyname ]['columns'][]  = array(
					'fieldname' => $tableindex->Column_name,
					'subpart'   => $tableindex->Sub_part,
				);
				$index_ary[ $keyname ]['unique']     = ( '0' === $tableindex->Non_unique ) ? true : false;
				$index_ary[ $keyname ]['index_type'] = $tableindex->Index_type;
			}

			// For each actual index in the index array.
			foreach ( $index_ary as $index_name => $index_data ) {

				// Build a create string to compare to the query.
				$index_string = '';
				if ( 'primary' === $index_name ) {
					$index_string .= 'PRIMARY ';
				} elseif ( $index_data['unique'] ) {
					$index_string .= 'UNIQUE ';
				}

				if ( 'FULLTEXT' === strtoupper( $index_data['index_type'] ) ) {
					$index_string .= 'FULLTEXT ';
				}

				if ( 'SPATIAL' === strtoupper( $index_data['index_type'] ) ) {
					$index_string .= 'SPATIAL ';
				}

				$index_string .= 'KEY ';
				if ( 'primary' !== $index_name ) {
					$index_string .= '`' . $index_name . '`';
				}

				$index_columns = '';

				// For each column in the index.
				foreach ( $index_data['columns'] as $column_data ) {
					if ( '' !== $index_columns ) {
						$index_columns .= ',';
					}

					// Add the field to the column list string.
					$index_columns .= '`' . $column_data['fieldname'] . '`';
				}

				// Add the column list to the index create string.
				$index_string .= " ($index_columns)";

				// Check if the index definition exists, ignoring subparts.
				$aindex = array_search( $index_string, $indices_without_subparts, true );
				if ( false !== $aindex ) {
					// If the index already exists (even with different subparts), we don't need to create it.
					unset( $indices_without_subparts[ $aindex ] );
					unset( $indices[ $aindex ] );
				}
			}
		}

		// For every remaining index specified for the table.
		foreach ( (array) $indices as $index ) {
			// Push a query line into $cqueries that adds the index to that table.
			$cqueries[] = "ALTER TABLE {$table} ADD $index";

			$for_update[] = 'Added index ' . $table . ' ' . $index;
		}

		// Remove the original table creation query from processing.
		unset( $cqueries[ $table ], $for_update[ $table ] );
	}

	$allqueries = array_merge( $cqueries, $iqueries );
	if ( $execute ) {
		foreach ( $allqueries as $query ) {
			$wpdb->query( $query );
		}
	}

	return $for_update;
}

/**
 * Updates the database tables to a new schema.
 *
 * By default, updates all the tables to use the latest defined schema, but can also
 * be used to update a specific set of tables in wp_get_db_schema().
 *
 * @since WP 1.5.0
 *
 * @uses dbDelta
 *
 * @param string $tables Optional. Which set of tables to update. Default is 'all'.
 */
function make_db_current( $tables = 'all' ) {
	$alterations = dbDelta( $tables );
	echo "<ol>\n";
	foreach ( $alterations as $alteration ) {
		echo "<li>$alteration</li>\n";
	}
	echo "</ol>\n";
}

/**
 * Updates the database tables to a new schema, but without displaying results.
 *
 * By default, updates all the tables to use the latest defined schema, but can
 * also be used to update a specific set of tables in wp_get_db_schema().
 *
 * @since WP 1.5.0
 *
 * @see make_db_current()
 *
 * @param string $tables Optional. Which set of tables to update. Default is 'all'.
 */
function make_db_current_silent( $tables = 'all' ) {
	dbDelta( $tables );
}

/**
 * Translate user level to user role name.
 *
 * @since WP 2.0.0
 *
 * @param int $level User level.
 * @return string User role name.
 */
function translate_level_to_role( $level ) {
	switch ( $level ) {
		case 10:
		case 9:
		case 8:
			return 'administrator';
		case 7:
		case 6:
		case 5:
			return 'editor';
		case 4:
		case 3:
		case 2:
			return 'author';
		case 1:
			return 'contributor';
		case 0:
		default:
			return 'subscriber';
	}
}

/**
 * Checks the version of the installed MySQL binary.
 *
 * @since WP 2.1.0
 *
 * @global wpdb $wpdb Retraceur database abstraction object.
 */
function wp_check_mysql_version() {
	global $wpdb;
	$result = $wpdb->check_database_version();
	if ( is_wp_error( $result ) ) {
		wp_die( $result );
	}
}

/**
 * Disables the Link Manager on upgrade if, at the time of upgrade, no links exist in the DB.
 *
 * @since WP 3.5.0
 * @deprecated 1.0.0 Retraceur removed the Link manager feature.
 *
 * @global int  $wp_current_db_version The old (current) database version.
 * @global wpdb $wpdb                  Retraceur database abstraction object.
 */
function maybe_disable_link_manager() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Determine if global tables should be upgraded.
 *
 * This function performs a series of checks to ensure the environment allows
 * for the safe upgrading of global Retraceur database tables. It is necessary
 * because global tables will commonly grow to millions of rows on large
 * installations, and the ability to control their upgrade routines can be
 * critical to the operation of large networks.
 *
 * In a future iteration, this function may use `wp_is_large_network()` to more-
 * intelligently prevent global table upgrades. Until then, we make sure
 * Retraceur is on the main site of the main network, to avoid running queries
 * more than once in multi-site or multi-network environments.
 *
 * @since WP 4.3.0
 *
 * @return bool Whether to run the upgrade routines on global tables.
 */
function wp_should_upgrade_global_tables() {

	// Return false early if explicitly not upgrading.
	if ( defined( 'DO_NOT_UPGRADE_GLOBAL_TABLES' ) ) {
		return false;
	}

	// Assume global tables should be upgraded.
	$should_upgrade = true;

	// Set to false if not on main network (does not matter if not multi-network).
	if ( ! is_main_network() ) {
		$should_upgrade = false;
	}

	// Set to false if not on main site of current network (does not matter if not multi-site).
	if ( ! is_main_site() ) {
		$should_upgrade = false;
	}

	/**
	 * Filters if upgrade routines should be run on global tables.
	 *
	 * @since WP 4.3.0
	 *
	 * @param bool $should_upgrade Whether to run the upgrade routines on global tables.
	 */
	return apply_filters( 'wp_should_upgrade_global_tables', $should_upgrade );
}
