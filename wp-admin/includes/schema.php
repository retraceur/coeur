<?php
/**
 * Retraceur Administration Scheme API.
 *
 * Here we keep the DB structure and option values.
 *
 * @since 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Administration
 */

/**
 * Declare these as global in case schema.php is included from a function.
 *
 * @global wpdb   $wpdb            Retraceur database abstraction object.
 * @global array  $wp_queries
 * @global string $charset_collate
 */
global $wpdb, $wp_queries, $charset_collate;

/**
 * The database character collate.
 */
$charset_collate = $wpdb->get_charset_collate();

/**
 * Retrieve the SQL for creating database tables.
 *
 * @since WP 3.3.0
 *
 * @global wpdb $wpdb Retraceur database abstraction object.
 *
 * @param string $scope   Optional. The tables for which to retrieve SQL. Can be all, global, ms_global, or blog tables. Defaults to all.
 * @param int    $blog_id Optional. The site ID for which to retrieve SQL. Default is the current site ID.
 * @return string The SQL needed to create the requested tables.
 */
function wp_get_db_schema( $scope = 'all', $blog_id = null ) {
	global $wpdb;

	// Use an array to ease db table manipulation.
	$tables = array();

	$charset_collate = $wpdb->get_charset_collate();

	if ( $blog_id && (int) $blog_id !== $wpdb->blogid ) {
		$old_blog_id = $wpdb->set_blog_id( $blog_id );
	}

	/*
	 * Indexes have a maximum size of 767 bytes. Historically, we haven't need to be concerned about that.
	 * As of 4.2, however, we moved to utf8mb4, which uses 4 bytes per character. This means that an index which
	 * used to have room for floor(767/3) = 255 characters, now only has room for floor(767/4) = 191 characters.
	 */
	$max_index_length = 191;

	// Blog-specific tables.
	$tables['blog'] = "CREATE TABLE $wpdb->termmeta (
	meta_id bigint(20) unsigned NOT NULL auto_increment,
	term_id bigint(20) unsigned NOT NULL default '0',
	meta_key varchar(255) default NULL,
	meta_value longtext,
	PRIMARY KEY  (meta_id),
	KEY term_id (term_id),
	KEY meta_key (meta_key($max_index_length))
) $charset_collate;
CREATE TABLE $wpdb->terms (
 term_id bigint(20) unsigned NOT NULL auto_increment,
 name varchar(200) NOT NULL default '',
 slug varchar(200) NOT NULL default '',
 term_group bigint(10) NOT NULL default 0,
 PRIMARY KEY  (term_id),
 KEY slug (slug($max_index_length)),
 KEY name (name($max_index_length))
) $charset_collate;
CREATE TABLE $wpdb->term_taxonomy (
 term_taxonomy_id bigint(20) unsigned NOT NULL auto_increment,
 term_id bigint(20) unsigned NOT NULL default 0,
 taxonomy varchar(32) NOT NULL default '',
 description longtext NOT NULL,
 parent bigint(20) unsigned NOT NULL default 0,
 count bigint(20) NOT NULL default 0,
 PRIMARY KEY  (term_taxonomy_id),
 UNIQUE KEY term_id_taxonomy (term_id,taxonomy),
 KEY taxonomy (taxonomy)
) $charset_collate;
CREATE TABLE $wpdb->term_relationships (
 object_id bigint(20) unsigned NOT NULL default 0,
 term_taxonomy_id bigint(20) unsigned NOT NULL default 0,
 term_order int(11) NOT NULL default 0,
 PRIMARY KEY  (object_id,term_taxonomy_id),
 KEY term_taxonomy_id (term_taxonomy_id)
) $charset_collate;
CREATE TABLE $wpdb->commentmeta (
	meta_id bigint(20) unsigned NOT NULL auto_increment,
	comment_id bigint(20) unsigned NOT NULL default '0',
	meta_key varchar(255) default NULL,
	meta_value longtext,
	PRIMARY KEY  (meta_id),
	KEY comment_id (comment_id),
	KEY meta_key (meta_key($max_index_length))
) $charset_collate;
CREATE TABLE $wpdb->comments (
	comment_ID bigint(20) unsigned NOT NULL auto_increment,
	comment_post_ID bigint(20) unsigned NOT NULL default '0',
	comment_author tinytext NOT NULL,
	comment_author_email varchar(100) NOT NULL default '',
	comment_author_url varchar(200) NOT NULL default '',
	comment_author_IP varchar(100) NOT NULL default '',
	comment_date datetime NOT NULL default '0000-00-00 00:00:00',
	comment_date_gmt datetime NOT NULL default '0000-00-00 00:00:00',
	comment_content text NOT NULL,
	comment_karma int(11) NOT NULL default '0',
	comment_approved varchar(20) NOT NULL default '1',
	comment_agent varchar(255) NOT NULL default '',
	comment_type varchar(20) NOT NULL default 'comment',
	comment_parent bigint(20) unsigned NOT NULL default '0',
	user_id bigint(20) unsigned NOT NULL default '0',
	PRIMARY KEY  (comment_ID),
	KEY comment_post_ID (comment_post_ID),
	KEY comment_approved_date_gmt (comment_approved,comment_date_gmt),
	KEY comment_date_gmt (comment_date_gmt),
	KEY comment_parent (comment_parent),
	KEY comment_author_email (comment_author_email(10))
) $charset_collate;
CREATE TABLE $wpdb->options (
	option_id bigint(20) unsigned NOT NULL auto_increment,
	option_name varchar(191) NOT NULL default '',
	option_value longtext NOT NULL,
	autoload varchar(20) NOT NULL default 'yes',
	PRIMARY KEY  (option_id),
	UNIQUE KEY option_name (option_name),
	KEY autoload (autoload)
) $charset_collate;
CREATE TABLE $wpdb->postmeta (
	meta_id bigint(20) unsigned NOT NULL auto_increment,
	post_id bigint(20) unsigned NOT NULL default '0',
	meta_key varchar(255) default NULL,
	meta_value longtext,
	PRIMARY KEY  (meta_id),
	KEY post_id (post_id),
	KEY meta_key (meta_key($max_index_length))
) $charset_collate;
CREATE TABLE $wpdb->posts (
	ID bigint(20) unsigned NOT NULL auto_increment,
	post_author bigint(20) unsigned NOT NULL default '0',
	post_date datetime NOT NULL default '0000-00-00 00:00:00',
	post_date_gmt datetime NOT NULL default '0000-00-00 00:00:00',
	post_content longtext NOT NULL,
	post_title text NOT NULL,
	post_excerpt text NOT NULL,
	post_status varchar(20) NOT NULL default 'publish',
	comment_status varchar(20) NOT NULL default 'open',
	ping_status varchar(20) NOT NULL default 'open',
	post_password varchar(255) NOT NULL default '',
	post_name varchar(200) NOT NULL default '',
	to_ping text NOT NULL,
	pinged text NOT NULL,
	post_modified datetime NOT NULL default '0000-00-00 00:00:00',
	post_modified_gmt datetime NOT NULL default '0000-00-00 00:00:00',
	post_content_filtered longtext NOT NULL,
	post_parent bigint(20) unsigned NOT NULL default '0',
	guid varchar(255) NOT NULL default '',
	menu_order int(11) NOT NULL default '0',
	post_type varchar(20) NOT NULL default 'post',
	post_mime_type varchar(100) NOT NULL default '',
	comment_count bigint(20) NOT NULL default '0',
	PRIMARY KEY  (ID),
	KEY post_name (post_name($max_index_length)),
	KEY type_status_date (post_type,post_status,post_date,ID),
	KEY post_parent (post_parent),
	KEY post_author (post_author)
) $charset_collate;\n";

	// Single site users table. The multisite flavor of the users table is handled below.
	$tables['users_table'] = "CREATE TABLE $wpdb->users (
	ID bigint(20) unsigned NOT NULL auto_increment,
	user_login varchar(60) NOT NULL default '',
	user_pass varchar(255) NOT NULL default '',
	user_nicename varchar(50) NOT NULL default '',
	user_email varchar(100) NOT NULL default '',
	user_url varchar(100) NOT NULL default '',
	user_registered datetime NOT NULL default '0000-00-00 00:00:00',
	user_activation_key varchar(255) NOT NULL default '',
	user_status int(11) NOT NULL default '0',
	display_name varchar(250) NOT NULL default '',
	PRIMARY KEY  (ID),
	KEY user_login_key (user_login),
	KEY user_nicename (user_nicename),
	KEY user_email (user_email)
) $charset_collate;\n";

	// Usermeta.
	$tables['usermeta_table'] = "CREATE TABLE $wpdb->usermeta (
	umeta_id bigint(20) unsigned NOT NULL auto_increment,
	user_id bigint(20) unsigned NOT NULL default '0',
	meta_key varchar(255) default NULL,
	meta_value longtext,
	PRIMARY KEY  (umeta_id),
	KEY user_id (user_id),
	KEY meta_key (meta_key($max_index_length))
) $charset_collate;
CREATE TABLE $wpdb->signups (
	signup_id bigint(20) NOT NULL auto_increment,
	domain varchar(200) NOT NULL default '',
	path varchar(100) NOT NULL default '',
	title longtext NOT NULL,
	user_login varchar(60) NOT NULL default '',
	user_email varchar(100) NOT NULL default '',
	registered datetime NOT NULL default '0000-00-00 00:00:00',
	activated datetime NOT NULL default '0000-00-00 00:00:00',
	active tinyint(1) NOT NULL default '0',
	activation_key varchar(50) NOT NULL default '',
	meta longtext,
	PRIMARY KEY  (signup_id),
	KEY activation_key (activation_key),
	KEY user_email (user_email),
	KEY user_login_email (user_login,user_email),
	KEY domain_path (domain(140),path(51))
) $charset_collate;\n";

	/**
	 * Filter here to edit global tables.
	 *
	 * @since 1.0.0 Retraceur fork.
	 *
	 * @param array  $tables          The queries to run to create the db tables.
	 * @param string $charset_collate The database character collate.
	 */
	$tables = apply_filters( 'retraceur_db_schema', $tables, $charset_collate );

	// Global tables.
	$global_tables = $tables['users_table'] . $tables['usermeta_table'];

	switch ( $scope ) {
		case 'blog':
			$queries = $tables['blog'];
			break;
		case 'global':
			$queries = $global_tables;
			if ( isset( $tables['ms_global'] ) ) {
				$queries .= $tables['ms_global'];
			}
			break;
		case 'ms_global' && isset( $tables['ms_global'] ):
			$queries = $tables['ms_global'];
			break;
		case 'all':
		default:
			$queries = $global_tables . $tables['blog'];
			if ( isset( $tables['ms_global'] ) ) {
				$queries .= $tables['ms_global'];
			}
			break;
	}

	if ( isset( $old_blog_id ) ) {
		$wpdb->set_blog_id( $old_blog_id );
	}

	return $queries;
}

// Populate for back compat.
$wp_queries = wp_get_db_schema( 'all' );

/**
 * Create Retraceur options and set the default values.
 *
 * @since WP 1.5.0
 * @since WP 5.1.0 The $options parameter has been added.
 *
 * @global wpdb $wpdb                  Retraceur database abstraction object.
 * @global int  $wp_db_version         Retraceur database version.
 * @global int  $wp_current_db_version The old (current) database version.
 *
 * @param array $options Optional. Custom option $key => $value pairs to use. Default empty array.
 */
function populate_options( array $options = array() ) {
	global $wpdb, $wp_db_version, $wp_current_db_version;

	$guessurl = wp_guess_url();
	/**
	 * Fires before creating Retraceur options and populating their default values.
	 *
	 * @since WP 2.6.0
	 */
	do_action( 'populate_options' );

	// If WP_DEFAULT_THEME doesn't exist, fall back to the latest core default theme.
	$stylesheet = WP_DEFAULT_THEME;
	$template   = WP_DEFAULT_THEME;
	$theme      = wp_get_theme( WP_DEFAULT_THEME );
	if ( ! $theme->exists() ) {
		$theme = WP_Theme::get_core_default_theme();
	}

	// If we can't find a core default theme, WP_DEFAULT_THEME is the best we can do.
	if ( $theme ) {
		$stylesheet = $theme->get_stylesheet();
		$template   = $theme->get_template();
	}

	$timezone_string = '';
	$gmt_offset      = 0;
	/*
	 * translators: default GMT offset or timezone string. Must be either a valid offset (-12 to 14)
	 * or a valid timezone string (America/New_York). See https://www.php.net/manual/en/timezones.php
	 * for all timezone strings currently supported by PHP.
	 *
	 * Important: When a previous timezone string, like `Europe/Kiev`, has been superseded by an
	 * updated one, like `Europe/Kyiv`, as a rule of thumb, the **old** timezone name should be used
	 * in the "translation" to allow for the default timezone setting to be PHP cross-version compatible,
	 * as old timezone names will be recognized in new PHP versions, while new timezone names cannot
	 * be recognized in old PHP versions.
	 *
	 * To verify which timezone strings are available in the _oldest_ PHP version supported, you can
	 * use https://3v4l.org/6YQAt#v5.6.20 and replace the "BR" (Brazil) in the code line with the
	 * country code for which you want to look up the supported timezone names.
	 */
	$offset_or_tz = _x( '0', 'default GMT offset or timezone string' );
	if ( is_numeric( $offset_or_tz ) ) {
		$gmt_offset = $offset_or_tz;
	} elseif ( $offset_or_tz && in_array( $offset_or_tz, timezone_identifiers_list( DateTimeZone::ALL_WITH_BC ), true ) ) {
		$timezone_string = $offset_or_tz;
	}

	$defaults = array(
		'siteurl'                         => $guessurl,
		'home'                            => $guessurl,
		'blogname'                        => __( 'My Site' ),
		'blogdescription'                 => '',
		'users_can_register'              => 0,
		'admin_email'                     => 'you@example.com',
		/* translators: Default start of the week. 0 = Sunday, 1 = Monday. */
		'start_of_week'                   => _x( '1', 'start of week' ),
		'use_balanceTags'                 => 0,
		'use_smilies'                     => 1,
		'require_name_email'              => 1,
		'comments_notify'                 => 1,
		'posts_per_rss'                   => 10,
		'rss_use_excerpt'                 => 0,
		'default_category'                => 1,
		'default_comment_status'          => 'open',
		'default_ping_status'             => 'open',
		'default_pingback_flag'           => 1,
		'posts_per_page'                  => 10,
		/* translators: Default date format, see https://www.php.net/manual/datetime.format.php */
		'date_format'                     => __( 'F j, Y' ),
		/* translators: Default time format, see https://www.php.net/manual/datetime.format.php */
		'time_format'                     => __( 'g:i a' ),
		/* translators: Links last updated date format, see https://www.php.net/manual/datetime.format.php */
		'links_updated_date_format'       => __( 'F j, Y g:i a' ),
		'comment_moderation'              => 0,
		'moderation_notify'               => 1,
		'permalink_structure'             => '',
		'rewrite_rules'                   => '',
		'hack_file'                       => 0,
		'blog_charset'                    => 'UTF-8',
		'moderation_keys'                 => '',
		'active_plugins'                  => array(),
		'category_base'                   => '',
		'ping_sites'                      => '',
		'comment_max_links'               => 2,
		'gmt_offset'                      => $gmt_offset,

		// 1.5.0
		'recently_edited'                 => '',
		'template'                        => $template,
		'stylesheet'                      => $stylesheet,
		'comment_registration'            => 0,
		'html_type'                       => 'text/html',

		// 1.5.1
		'use_trackback'                   => 0,

		// 2.0.0
		'default_role'                    => 'subscriber',
		'db_version'                      => $wp_db_version,

		// 2.0.1
		'uploads_use_yearmonth_folders'   => 1,
		'upload_path'                     => '',

		// 2.1.0
		'blog_public'                     => '1',
		'default_link_category'           => 2,
		'show_on_front'                   => 'posts',

		// 2.2.0
		'tag_base'                        => '',

		// 2.5.0
		'show_avatars'                    => '1',
		'avatar_rating'                   => 'G',
		'upload_url_path'                 => '',
		'thumbnail_size_w'                => 150,
		'thumbnail_size_h'                => 150,
		'thumbnail_crop'                  => 1,
		'medium_size_w'                   => 300,
		'medium_size_h'                   => 300,

		// 2.6.0
		'avatar_default'                  => 'mystery',

		// 2.7.0
		'large_size_w'                    => 1024,
		'large_size_h'                    => 1024,
		'image_default_link_type'         => 'none',
		'image_default_size'              => '',
		'image_default_align'             => '',
		'close_comments_for_old_posts'    => 0,
		'close_comments_days_old'         => 14,
		'thread_comments'                 => 1,
		'thread_comments_depth'           => 5,
		'page_comments'                   => 0,
		'comments_per_page'               => 50,
		'default_comments_page'           => 'newest',
		'comment_order'                   => 'asc',
		'sticky_posts'                    => array(),
		'uninstall_plugins'               => array(),

		// 2.8.0
		'timezone_string'                 => $timezone_string,

		// 3.0.0
		'page_for_posts'                  => 0,
		'page_on_front'                   => 0,

		// 3.1.0
		'default_post_format'             => 0,

		// 4.3.0
		'finished_splitting_shared_terms' => 1,
		'site_icon'                       => 0,

		// 4.4.0
		'medium_large_size_w'             => 768,
		'medium_large_size_h'             => 0,

		// 4.9.6
		'wp_page_for_privacy_policy'      => 0,

		// 4.9.8
		'show_comments_cookies_opt_in'    => 1,

		// 5.3.0
		'admin_email_lifespan'            => ( time() + 6 * MONTH_IN_SECONDS ),

		// 5.5.0
		'disallowed_keys'                 => '',
		'comment_previously_approved'     => 1,
		'auto_plugin_theme_update_emails' => array(),

		// 5.6.0
		'auto_update_core_dev'            => 'enabled',
		'auto_update_core_minor'          => 'enabled',
		'auto_update_core_major'          => 'enabled',

		// 5.8.0
		'wp_force_deactivated_plugins'    => array(),

		// 6.4.0
		'wp_attachment_pages_enabled'     => 0,
	);

	// 3.3.0
	if ( ! is_multisite() ) {
		$defaults['initial_db_version'] = ! empty( $wp_current_db_version ) && $wp_current_db_version < $wp_db_version
			? $wp_current_db_version : $wp_db_version;
	}

	// 3.0.0 multisite.
	if ( is_multisite() ) {
		$defaults['permalink_structure'] = '/%year%/%monthnum%/%day%/%postname%/';
	}

	$options = wp_parse_args( $options, $defaults );

	// Set autoload to no for these options.
	$fat_options = array(
		'moderation_keys',
		'recently_edited',
		'disallowed_keys',
		'uninstall_plugins',
		'auto_plugin_theme_update_emails',
	);

	$keys             = "'" . implode( "', '", array_keys( $options ) ) . "'";
	$existing_options = $wpdb->get_col( "SELECT option_name FROM $wpdb->options WHERE option_name in ( $keys )" ); // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared

	$insert = '';

	foreach ( $options as $option => $value ) {
		if ( in_array( $option, $existing_options, true ) ) {
			continue;
		}

		if ( in_array( $option, $fat_options, true ) ) {
			$autoload = 'off';
		} else {
			$autoload = 'on';
		}

		if ( ! empty( $insert ) ) {
			$insert .= ', ';
		}

		$value = maybe_serialize( sanitize_option( $option, $value ) );

		$insert .= $wpdb->prepare( '(%s, %s, %s)', $option, $value, $autoload );
	}

	if ( ! empty( $insert ) ) {
		$wpdb->query( "INSERT INTO $wpdb->options (option_name, option_value, autoload) VALUES " . $insert ); // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
	}

	// In case it is set, but blank, update "home".
	if ( ! __get_option( 'home' ) ) {
		update_option( 'home', $guessurl );
	}

	// Delete obsolete magpie stuff.
	$wpdb->query( "DELETE FROM $wpdb->options WHERE option_name REGEXP '^rss_[0-9a-f]{32}(_ts)?$'" );

	// Clear expired transients.
	delete_expired_transients( true );
}

/**
 * Execute Retraceur role creation for the various Retraceur versions.
 *
 * @since WP 2.0.0
 * @since 1.0.0 Retraceur fork grouped all populate functions into one.
 */
function populate_roles() {
	// Retraceur capabilities.
	$caps  = array(
		'administrator' => array(
			'update_core',
			'export',
			'edit_dashboard',
			'install_themes',
			'switch_themes',
			'edit_themes',
			'edit_theme_options',
			'delete_themes',
			'update_themes',
			'install_plugins',
			'activate_plugins',
			'edit_plugins',
			'update_plugins',
			'delete_plugins',
			'edit_users',
			'delete_users',
			'create_users',
			'list_users',
			'remove_users',
			'promote_users',
			'edit_files',
			'manage_options',
			'moderate_comments',
			'manage_categories',
			'upload_files',
			'unfiltered_upload',
			'import',
			'unfiltered_html',
			'edit_posts',
			'edit_others_posts',
			'edit_published_posts',
			'publish_posts',
			'edit_pages',
			'edit_others_pages',
			'edit_published_pages',
			'publish_pages',
			'delete_pages',
			'delete_others_pages',
			'delete_published_pages',
			'delete_posts',
			'delete_others_posts',
			'delete_published_posts',
			'delete_private_posts',
			'edit_private_posts',
			'read_private_posts',
			'delete_private_pages',
			'edit_private_pages',
			'read_private_pages',
			'read',
			'level_10',
			'level_9',
			'level_8',
			'level_7',
			'level_6',
			'level_5',
			'level_4',
			'level_3',
			'level_2',
			'level_1',
			'level_0',
		),
		'subscriber'    => array(
			'read',
			'level_0',
		),
	);

	// Retraceur roles.
	$roles = array(
		'administrator' => 'Administrator',
		'subscriber'    => 'Subscriber',
	);

	// Default WP Roles.
	if ( defined( 'USE_DEFAULT_WP_ROLES' ) && USE_DEFAULT_WP_ROLES ) {
		// Other WP capabilities.
		$caps  = array(
			'editor'      => array(
				'moderate_comments',
				'manage_categories',
				'upload_files',
				'unfiltered_html',
				'edit_posts',
				'edit_others_posts',
				'edit_published_posts',
				'publish_posts',
				'edit_pages',
				'edit_others_pages',
				'edit_published_pages',
				'publish_pages',
				'delete_pages',
				'delete_others_pages',
				'delete_published_pages',
				'delete_posts',
				'delete_others_posts',
				'delete_published_posts',
				'delete_private_posts',
				'edit_private_posts',
				'read_private_posts',
				'delete_private_pages',
				'edit_private_pages',
				'read_private_pages',
				'read',
				'level_7',
				'level_6',
				'level_5',
				'level_4',
				'level_3',
				'level_2',
				'level_1',
				'level_0',
			),
			'author'      => array(
				'upload_files',
				'edit_posts',
				'edit_published_posts',
				'publish_posts',
				'delete_posts',
				'delete_published_posts',
				'read',
				'level_2',
				'level_1',
				'level_0',
			),
			'contributor' => array(
				'edit_posts',
				'delete_posts',
				'read',
				'level_1',
				'level_0',
			),
		);

		$roles = array(
			'administrator' => 'Administrator',
			'editor'        => 'Editor',
			'author'        => 'Author',
			'contributor'   => 'Contributor',
			'subscriber'    => 'Subscriber',
		);
	}

	foreach ( $roles as $role_id => $role_name ) {
		// Add roles.
		add_role( $role_id, $role_name );

		// Add caps for role.
		$role = get_role( $role_id );

		foreach ( $caps[ $role_id ] as $cap ) {
			$role->add_cap( $cap );
		}
	}
}
