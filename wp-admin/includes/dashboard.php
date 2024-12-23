<?php
/**
 * Dashboard Widget Administration Screen API.
 *
 * @since 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Administration
 */

/**
 * Registers dashboard widgets.
 *
 * Handles POST data, sets up filters.
 *
 * @since WP 2.5.0
 * @since 1.0.0 Retraceur fork is removing WP Widget API globals.
 *
 * @global callable[] $wp_dashboard_control_callbacks
 */
function wp_dashboard_setup() {
	global $wp_dashboard_control_callbacks;

	$screen = get_current_screen();

	/* Register Widgets and Controls */
	$wp_dashboard_control_callbacks = array();

	// PHP Version.
	$check_php = wp_check_php_version();

	if ( $check_php && current_user_can( 'update_php' ) ) {
		// If "not acceptable" the widget will be shown.
		if ( isset( $check_php['is_acceptable'] ) && ! $check_php['is_acceptable'] ) {
			add_filter( 'postbox_classes_dashboard_dashboard_php_nag', 'dashboard_php_nag_class' );

			if ( $check_php['is_lower_than_future_minimum'] ) {
				wp_add_dashboard_widget( 'dashboard_php_nag', __( 'PHP Update Required' ), 'wp_dashboard_php_nag' );
			} else {
				wp_add_dashboard_widget( 'dashboard_php_nag', __( 'PHP Update Recommended' ), 'wp_dashboard_php_nag' );
			}
		}
	}

	// Site Health.
	if ( current_user_can( 'view_site_health_checks' ) && ! is_network_admin() ) {
		if ( ! class_exists( 'WP_Site_Health' ) ) {
			require_once ABSPATH . 'wp-admin/includes/class-wp-site-health.php';
		}

		WP_Site_Health::get_instance();

		wp_enqueue_style( 'site-health' );
		wp_enqueue_script( 'site-health' );

		wp_add_dashboard_widget( 'dashboard_site_health', __( 'Site Health Status' ), 'wp_dashboard_site_health' );
	}

	// Right Now.
	if ( is_blog_admin() && current_user_can( 'edit_posts' ) ) {
		wp_add_dashboard_widget( 'dashboard_right_now', __( 'At a Glance' ), 'wp_dashboard_right_now' );
	}

	if ( is_network_admin() ) {
		wp_add_dashboard_widget( 'network_dashboard_right_now', __( 'Right Now' ), 'wp_network_dashboard_right_now' );
	}

	// Activity Widget.
	if ( is_blog_admin() ) {
		wp_add_dashboard_widget( 'dashboard_activity', __( 'Activity' ), 'wp_dashboard_site_activity' );
	}

	if ( is_network_admin() ) {

		/**
		 * Fires after core widgets for the Network Admin dashboard have been registered.
		 *
		 * @since WP 3.1.0
		 */
		do_action( 'wp_network_dashboard_setup' );

		/**
		 * Filters the list of widgets to load for the Network Admin dashboard.
		 *
		 * @since WP 3.1.0
		 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
		 *
		 * @param string[] $dashboard_widgets An array of dashboard widget IDs.
		 */
		apply_filters_deprecated(
			'wp_network_dashboard_widgets',
			array( array() ),
			'1.0.0',
			'',
			__( 'Widgets are not supported in Retraceur, use the `wp_network_dashboard_setup` action instead.' )
		);
	} elseif ( is_user_admin() ) {

		/**
		 * Fires after core widgets for the User Admin dashboard have been registered.
		 *
		 * @since WP 3.1.0
		 */
		do_action( 'wp_user_dashboard_setup' );

		/**
		 * Filters the list of widgets to load for the User Admin dashboard.
		 *
		 * @since WP 3.1.0
		 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
		 *
		 * @param string[] $dashboard_widgets An array of dashboard widget IDs.
		 */
		apply_filters_deprecated(
			'wp_user_dashboard_widgets',
			array( array() ),
			'1.0.0',
			'',
			__( 'Widgets are not supported in Retraceur, use the `wp_user_dashboard_setup` action instead.' )
		);
	} else {

		/**
		 * Fires after core widgets for the admin dashboard have been registered.
		 *
		 * @since WP 2.5.0
		 */
		do_action( 'wp_dashboard_setup' );

		/**
		 * Filters the list of widgets to load for the admin dashboard.
		 *
		 * @since WP 2.5.0
		 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
		 *
		 * @param string[] $dashboard_widgets An array of dashboard widget IDs.
		 */
		apply_filters_deprecated(
			'wp_dashboard_widgets',
			array( array() ),
			'1.0.0',
			'',
			__( 'Widgets are not supported in Retraceur, use the `wp_dashboard_setup` action instead.' )
		);
	}

	if ( 'POST' === $_SERVER['REQUEST_METHOD'] && isset( $_POST['widget_id'] ) ) {
		check_admin_referer( 'edit-dashboard-widget_' . $_POST['widget_id'], 'dashboard-widget-nonce' );
		ob_start(); // Hack - but the same hack wp-admin/widgets.php uses.
		wp_dashboard_trigger_widget_control( $_POST['widget_id'] );
		ob_end_clean();
		wp_redirect( remove_query_arg( 'edit' ) );
		exit;
	}

	/** This action is documented in wp-admin/includes/meta-boxes.php */
	do_action( 'do_meta_boxes', $screen->id, 'normal', '' );

	/** This action is documented in wp-admin/includes/meta-boxes.php */
	do_action( 'do_meta_boxes', $screen->id, 'side', '' );
}

/**
 * Adds a new dashboard widget.
 *
 * @since WP 2.7.0
 * @since WP 5.6.0 The `$context` and `$priority` parameters were added.
 *
 * @global callable[] $wp_dashboard_control_callbacks
 *
 * @param string   $widget_id        Widget ID  (used in the 'id' attribute for the widget).
 * @param string   $widget_name      Title of the widget.
 * @param callable $callback         Function that fills the widget with the desired content.
 *                                   The function should echo its output.
 * @param callable $control_callback Optional. Function that outputs controls for the widget. Default null.
 * @param array    $callback_args    Optional. Data that should be set as the $args property of the widget array
 *                                   (which is the second parameter passed to your callback). Default null.
 * @param string   $context          Optional. The context within the screen where the box should display.
 *                                   Accepts 'normal', 'side', 'column3', or 'column4'. Default 'normal'.
 * @param string   $priority         Optional. The priority within the context where the box should show.
 *                                   Accepts 'high', 'core', 'default', or 'low'. Default 'core'.
 */
function wp_add_dashboard_widget( $widget_id, $widget_name, $callback, $control_callback = null, $callback_args = null, $context = 'normal', $priority = 'core' ) {
	global $wp_dashboard_control_callbacks;

	$screen = get_current_screen();

	$private_callback_args = array( '__widget_basename' => $widget_name );

	if ( is_null( $callback_args ) ) {
		$callback_args = $private_callback_args;
	} elseif ( is_array( $callback_args ) ) {
		$callback_args = array_merge( $callback_args, $private_callback_args );
	}

	if ( $control_callback && is_callable( $control_callback ) && current_user_can( 'edit_dashboard' ) ) {
		$wp_dashboard_control_callbacks[ $widget_id ] = $control_callback;

		if ( isset( $_GET['edit'] ) && $widget_id === $_GET['edit'] ) {
			list($url)    = explode( '#', add_query_arg( 'edit', false ), 2 );
			$widget_name .= ' <span class="postbox-title-action"><a href="' . esc_url( $url ) . '">' . __( 'Cancel' ) . '</a></span>';
			$callback     = '_wp_dashboard_control_callback';
		} else {
			list($url)    = explode( '#', add_query_arg( 'edit', $widget_id ), 2 );
			$widget_name .= ' <span class="postbox-title-action"><a href="' . esc_url( "$url#$widget_id" ) . '" class="edit-box open-box">' . __( 'Configure' ) . '</a></span>';
		}
	}

	$side_widgets = array( 'dashboard_activity', 'dashboard_primary' );

	if ( in_array( $widget_id, $side_widgets, true ) ) {
		$context = 'side';
	}

	$high_priority_widgets = array( 'dashboard_browser_nag', 'dashboard_php_nag' );

	if ( in_array( $widget_id, $high_priority_widgets, true ) ) {
		$priority = 'high';
	}

	if ( empty( $context ) ) {
		$context = 'normal';
	}

	if ( empty( $priority ) ) {
		$priority = 'core';
	}

	add_meta_box( $widget_id, $widget_name, $callback, $screen, $context, $priority, $callback_args );
}

/**
 * Outputs controls for the current dashboard widget.
 *
 * @access private
 * @since WP 2.7.0
 *
 * @param mixed $dashboard
 * @param array $meta_box
 */
function _wp_dashboard_control_callback( $dashboard, $meta_box ) {
	echo '<form method="post" class="dashboard-widget-control-form wp-clearfix">';
	wp_dashboard_trigger_widget_control( $meta_box['id'] );
	wp_nonce_field( 'edit-dashboard-widget_' . $meta_box['id'], 'dashboard-widget-nonce' );
	echo '<input type="hidden" name="widget_id" value="' . esc_attr( $meta_box['id'] ) . '" />';
	submit_button( __( 'Save Changes' ) );
	echo '</form>';
}

/**
 * Displays the dashboard.
 *
 * @since WP 2.5.0
 */
function wp_dashboard() {
	$screen      = get_current_screen();
	$columns     = absint( $screen->get_columns() );
	$columns_css = '';

	if ( $columns ) {
		$columns_css = " columns-$columns";
	}
	?>
<div id="dashboard-widgets" class="metabox-holder<?php echo $columns_css; ?>">
	<div id="postbox-container-1" class="postbox-container">
	<?php do_meta_boxes( $screen->id, 'normal', '' ); ?>
	</div>
	<div id="postbox-container-2" class="postbox-container">
	<?php do_meta_boxes( $screen->id, 'side', '' ); ?>
	</div>
	<div id="postbox-container-3" class="postbox-container">
	<?php do_meta_boxes( $screen->id, 'column3', '' ); ?>
	</div>
	<div id="postbox-container-4" class="postbox-container">
	<?php do_meta_boxes( $screen->id, 'column4', '' ); ?>
	</div>
</div>

	<?php
	wp_nonce_field( 'closedpostboxes', 'closedpostboxesnonce', false );
	wp_nonce_field( 'meta-box-order', 'meta-box-order-nonce', false );
}

//
// Dashboard Widgets.
//

/**
 * Dashboard widget that displays some basic stats about the site.
 *
 * Formerly 'Right Now'. A streamlined 'At a Glance' as of 3.8.
 *
 * @since WP 2.7.0
 */
function wp_dashboard_right_now() {
	?>
	<div class="main">
	<ul>
	<?php
	// Posts and Pages.
	foreach ( array( 'post', 'page' ) as $post_type ) {
		$num_posts = wp_count_posts( $post_type );

		if ( $num_posts && $num_posts->publish ) {
			if ( 'post' === $post_type ) {
				/* translators: %s: Number of posts. */
				$text = _n( '%s Post', '%s Posts', $num_posts->publish );
			} else {
				/* translators: %s: Number of pages. */
				$text = _n( '%s Page', '%s Pages', $num_posts->publish );
			}

			$text             = sprintf( $text, number_format_i18n( $num_posts->publish ) );
			$post_type_object = get_post_type_object( $post_type );

			if ( $post_type_object && current_user_can( $post_type_object->cap->edit_posts ) ) {
				printf( '<li class="%1$s-count"><a href="edit.php?post_type=%1$s">%2$s</a></li>', $post_type, $text );
			} else {
				printf( '<li class="%1$s-count"><span>%2$s</span></li>', $post_type, $text );
			}
		}
	}

	/**
	 * Filters the array of extra elements to list in the 'At a Glance'
	 * dashboard widget.
	 *
	 * Prior to 3.8.0, the widget was named 'Right Now'. Each element
	 * is wrapped in list-item tags on output.
	 *
	 * @since WP 3.8.0
	 *
	 * @param string[] $items Array of extra 'At a Glance' widget items.
	 */
	$elements = apply_filters( 'dashboard_glance_items', array() );

	if ( $elements ) {
		echo '<li>' . implode( "</li>\n<li>", $elements ) . "</li>\n";
	}

	?>
	</ul>
	<?php
	update_right_now_message();

	// Check if search engines are asked not to index this site.
	if ( ! is_network_admin() && ! is_user_admin()
		&& current_user_can( 'manage_options' ) && ! get_option( 'blog_public' )
	) {

		/**
		 * Filters the link title attribute for the 'Search engines discouraged'
		 * message displayed in the 'At a Glance' dashboard widget.
		 *
		 * Prior to 3.8.0, the widget was named 'Right Now'.
		 *
		 * @since WP 3.0.0
		 * @since WP 4.5.0 The default for `$title` was updated to an empty string.
		 *
		 * @param string $title Default attribute text.
		 */
		$title = apply_filters( 'privacy_on_link_title', '' );

		/**
		 * Filters the link label for the 'Search engines discouraged' message
		 * displayed in the 'At a Glance' dashboard widget.
		 *
		 * Prior to 3.8.0, the widget was named 'Right Now'.
		 *
		 * @since WP 3.0.0
		 *
		 * @param string $content Default text.
		 */
		$content = apply_filters( 'privacy_on_link_text', __( 'Search engines discouraged' ) );

		$title_attr = '' === $title ? '' : " title='$title'";

		echo "<p class='search-engines-info'><a href='options-reading.php'$title_attr>$content</a></p>";
	}
	?>
	</div>
	<?php
	/*
	 * activity_box_end has a core action, but only prints content when multisite.
	 * Using an output buffer is the only way to really check if anything's displayed here.
	 */
	ob_start();

	/**
	 * Fires at the end of the 'At a Glance' dashboard widget.
	 *
	 * Prior to 3.8.0, the widget was named 'Right Now'.
	 *
	 * @since WP 2.5.0
	 */
	do_action( 'rightnow_end' );

	/**
	 * Fires at the end of the 'At a Glance' dashboard widget.
	 *
	 * Prior to 3.8.0, the widget was named 'Right Now'.
	 *
	 * @since WP 2.0.0
	 */
	do_action( 'activity_box_end' );

	$actions = ob_get_clean();

	if ( ! empty( $actions ) ) :
		?>
	<div class="sub">
		<?php echo $actions; ?>
	</div>
		<?php
	endif;
}

/**
 * @since WP 3.1.0
 */
function wp_network_dashboard_right_now() {
	$actions = array();

	if ( current_user_can( 'create_sites' ) ) {
		$actions['create-site'] = '<a href="' . network_admin_url( 'site-new.php' ) . '">' . __( 'Create a New Site' ) . '</a>';
	}
	if ( current_user_can( 'create_users' ) ) {
		$actions['create-user'] = '<a href="' . network_admin_url( 'user-new.php' ) . '">' . __( 'Create a New User' ) . '</a>';
	}

	$c_users = get_user_count();
	$c_blogs = get_blog_count();

	/* translators: %s: Number of users on the network. */
	$user_text = sprintf( _n( '%s user', '%s users', $c_users ), number_format_i18n( $c_users ) );
	/* translators: %s: Number of sites on the network. */
	$blog_text = sprintf( _n( '%s site', '%s sites', $c_blogs ), number_format_i18n( $c_blogs ) );

	/* translators: 1: Text indicating the number of sites on the network, 2: Text indicating the number of users on the network. */
	$sentence = sprintf( __( 'You have %1$s and %2$s.' ), $blog_text, $user_text );

	if ( $actions ) {
		echo '<ul class="subsubsub">';
		foreach ( $actions as $class => $action ) {
			$actions[ $class ] = "\t<li class='$class'>$action";
		}
		echo implode( " |</li>\n", $actions ) . "</li>\n";
		echo '</ul>';
	}
	?>
	<br class="clear" />

	<p class="youhave"><?php echo $sentence; ?></p>


	<?php
		/**
		 * Fires in the Network Admin 'Right Now' dashboard widget
		 * just before the user and site search form fields.
		 *
		 * @since WP MU (3.0.0)
		 */
		do_action( 'wpmuadminresult' );
	?>

	<form action="<?php echo esc_url( network_admin_url( 'users.php' ) ); ?>" method="get">
		<p>
			<label class="screen-reader-text" for="search-users">
				<?php
				/* translators: Hidden accessibility text. */
				_e( 'Search Users' );
				?>
			</label>
			<input type="search" name="s" value="" size="30" autocomplete="off" id="search-users" />
			<?php submit_button( __( 'Search Users' ), '', false, false, array( 'id' => 'submit_users' ) ); ?>
		</p>
	</form>

	<form action="<?php echo esc_url( network_admin_url( 'sites.php' ) ); ?>" method="get">
		<p>
			<label class="screen-reader-text" for="search-sites">
				<?php
				/* translators: Hidden accessibility text. */
				_e( 'Search Sites' );
				?>
			</label>
			<input type="search" name="s" value="" size="30" autocomplete="off" id="search-sites" />
			<?php submit_button( __( 'Search Sites' ), '', false, false, array( 'id' => 'submit_sites' ) ); ?>
		</p>
	</form>
	<?php
	/**
	 * Fires at the end of the 'Right Now' widget in the Network Admin dashboard.
	 *
	 * @since WP MU (3.0.0)
	 */
	do_action( 'mu_rightnow_end' );

	/**
	 * Fires at the end of the 'Right Now' widget in the Network Admin dashboard.
	 *
	 * @since WP MU (3.0.0)
	 */
	do_action( 'mu_activity_box_end' );
}

/**
 * Outputs the Activity widget.
 *
 * Callback function for {@see 'dashboard_activity'}.
 *
 * @since WP 3.8.0
 */
function wp_dashboard_site_activity() {

	echo '<div id="activity-widget">';

	$future_posts = wp_dashboard_recent_posts(
		array(
			'max'    => 5,
			'status' => 'future',
			'order'  => 'ASC',
			'title'  => __( 'Publishing Soon' ),
			'id'     => 'future-posts',
		)
	);
	$recent_posts = wp_dashboard_recent_posts(
		array(
			'max'    => 5,
			'status' => 'publish',
			'order'  => 'DESC',
			'title'  => __( 'Recently Published' ),
			'id'     => 'published-posts',
		)
	);

	if ( ! $future_posts && ! $recent_posts ) {
		echo '<div class="no-activity">';
		echo '<p>' . __( 'No activity yet!' ) . '</p>';
		echo '</div>';
	}

	echo '</div>';
}

/**
 * Generates Publishing Soon and Recently Published sections.
 *
 * @since WP 3.8.0
 *
 * @param array $args {
 *     An array of query and display arguments.
 *
 *     @type int    $max     Number of posts to display.
 *     @type string $status  Post status.
 *     @type string $order   Designates ascending ('ASC') or descending ('DESC') order.
 *     @type string $title   Section title.
 *     @type string $id      The container id.
 * }
 * @return bool False if no posts were found. True otherwise.
 */
function wp_dashboard_recent_posts( $args ) {
	$query_args = array(
		'post_type'      => 'post',
		'post_status'    => $args['status'],
		'orderby'        => 'date',
		'order'          => $args['order'],
		'posts_per_page' => (int) $args['max'],
		'no_found_rows'  => true,
		'cache_results'  => true,
		'perm'           => ( 'future' === $args['status'] ) ? 'editable' : 'readable',
	);

	/**
	 * Filters the query arguments used for the Recent Posts widget.
	 *
	 * @since WP 4.2.0
	 *
	 * @param array $query_args The arguments passed to WP_Query to produce the list of posts.
	 */
	$query_args = apply_filters( 'dashboard_recent_posts_query_args', $query_args );

	$posts = new WP_Query( $query_args );

	if ( $posts->have_posts() ) {

		echo '<div id="' . $args['id'] . '" class="activity-block">';

		echo '<h3>' . $args['title'] . '</h3>';

		echo '<ul>';

		$today    = current_time( 'Y-m-d' );
		$tomorrow = current_datetime()->modify( '+1 day' )->format( 'Y-m-d' );
		$year     = current_time( 'Y' );

		while ( $posts->have_posts() ) {
			$posts->the_post();

			$time = get_the_time( 'U' );

			if ( gmdate( 'Y-m-d', $time ) === $today ) {
				$relative = __( 'Today' );
			} elseif ( gmdate( 'Y-m-d', $time ) === $tomorrow ) {
				$relative = __( 'Tomorrow' );
			} elseif ( gmdate( 'Y', $time ) !== $year ) {
				/* translators: Date and time format for recent posts on the dashboard, from a different calendar year, see https://www.php.net/manual/datetime.format.php */
				$relative = date_i18n( __( 'M jS Y' ), $time );
			} else {
				/* translators: Date and time format for recent posts on the dashboard, see https://www.php.net/manual/datetime.format.php */
				$relative = date_i18n( __( 'M jS' ), $time );
			}

			// Use the post edit link for those who can edit, the permalink otherwise.
			$recent_post_link = current_user_can( 'edit_post', get_the_ID() ) ? get_edit_post_link() : get_permalink();

			$draft_or_post_title = _draft_or_post_title();
			printf(
				'<li><span>%1$s</span> <a href="%2$s" aria-label="%3$s">%4$s</a></li>',
				/* translators: 1: Relative date, 2: Time. */
				sprintf( _x( '%1$s, %2$s', 'dashboard' ), $relative, get_the_time() ),
				$recent_post_link,
				/* translators: %s: Post title. */
				esc_attr( sprintf( __( 'Edit &#8220;%s&#8221;' ), $draft_or_post_title ) ),
				$draft_or_post_title
			);
		}

		echo '</ul>';
		echo '</div>';

	} else {
		return false;
	}

	wp_reset_postdata();

	return true;
}

/**
 * Display generic dashboard RSS widget feed.
 *
 * @since WP 2.5.0
 *
 * @param string $widget_id
 */
function wp_dashboard_rss_output( $widget_id ) {
	$widgets = get_option( 'dashboard_widget_options' );
	echo '<div class="rss-widget">';
	wp_widget_rss_output( $widgets[ $widget_id ] );
	echo '</div>';
}

/**
 * Checks to see if all of the feed url in $check_urls are cached.
 *
 * If $check_urls is empty, look for the rss feed url found in the dashboard
 * widget options of $widget_id. If cached, call $callback, a function that
 * echoes out output for this widget. If not cache, echo a "Loading..." stub
 * which is later replaced by Ajax call (see top of /wp-admin/index.php)
 *
 * @since WP 2.5.0
 * @since WP 5.3.0 Formalized the existing and already documented `...$args` parameter
 *              by adding it to the function signature.
 *
 * @param string   $widget_id  The widget ID.
 * @param callable $callback   The callback function used to display each feed.
 * @param array    $check_urls RSS feeds.
 * @param mixed    ...$args    Optional additional parameters to pass to the callback function.
 * @return bool True on success, false on failure.
 */
function wp_dashboard_cached_rss_widget( $widget_id, $callback, $check_urls = array(), ...$args ) {
	$doing_ajax = wp_doing_ajax();
	$loading    = '<p class="widget-loading hide-if-no-js">' . __( 'Loading&hellip;' ) . '</p>';
	$loading   .= wp_get_admin_notice(
		__( 'This widget requires JavaScript.' ),
		array(
			'type'               => 'error',
			'additional_classes' => array( 'inline', 'hide-if-js' ),
		)
	);

	if ( empty( $check_urls ) ) {
		$widgets = get_option( 'dashboard_widget_options' );

		if ( empty( $widgets[ $widget_id ]['url'] ) && ! $doing_ajax ) {
			echo $loading;
			return false;
		}

		$check_urls = array( $widgets[ $widget_id ]['url'] );
	}

	$locale    = get_user_locale();
	$cache_key = 'dash_v2_' . md5( $widget_id . '_' . $locale );
	$output    = get_transient( $cache_key );

	if ( false !== $output ) {
		echo $output;
		return true;
	}

	if ( ! $doing_ajax ) {
		echo $loading;
		return false;
	}

	if ( $callback && is_callable( $callback ) ) {
		array_unshift( $args, $widget_id, $check_urls );
		ob_start();
		call_user_func_array( $callback, $args );
		// Default lifetime in cache of 12 hours (same as the feeds).
		set_transient( $cache_key, ob_get_flush(), 12 * HOUR_IN_SECONDS );
	}

	return true;
}

//
// Dashboard Widgets Controls.
//

/**
 * Calls widget control callback.
 *
 * @since WP 2.5.0
 *
 * @global callable[] $wp_dashboard_control_callbacks
 *
 * @param int|false $widget_control_id Optional. Registered widget ID. Default false.
 */
function wp_dashboard_trigger_widget_control( $widget_control_id = false ) {
	global $wp_dashboard_control_callbacks;

	if ( is_scalar( $widget_control_id ) && $widget_control_id
		&& isset( $wp_dashboard_control_callbacks[ $widget_control_id ] )
		&& is_callable( $wp_dashboard_control_callbacks[ $widget_control_id ] )
	) {
		call_user_func(
			$wp_dashboard_control_callbacks[ $widget_control_id ],
			'',
			array(
				'id'       => $widget_control_id,
				'callback' => $wp_dashboard_control_callbacks[ $widget_control_id ],
			)
		);
	}
}

/**
 * Sets up the RSS dashboard widget control and $args to be used as input to wp_widget_rss_form().
 *
 * Handles POST data from RSS-type widgets.
 *
 * @since WP 2.5.0
 *
 * @param string $widget_id
 * @param array  $form_inputs
 */
function wp_dashboard_rss_control( $widget_id, $form_inputs = array() ) {
	$widget_options = get_option( 'dashboard_widget_options' );

	if ( ! $widget_options ) {
		$widget_options = array();
	}

	if ( ! isset( $widget_options[ $widget_id ] ) ) {
		$widget_options[ $widget_id ] = array();
	}

	$number = 1; // Hack to use wp_widget_rss_form().

	$widget_options[ $widget_id ]['number'] = $number;

	if ( 'POST' === $_SERVER['REQUEST_METHOD'] && isset( $_POST['widget-rss'][ $number ] ) ) {
		$_POST['widget-rss'][ $number ]         = wp_unslash( $_POST['widget-rss'][ $number ] );
		$widget_options[ $widget_id ]           = wp_widget_rss_process( $_POST['widget-rss'][ $number ] );
		$widget_options[ $widget_id ]['number'] = $number;

		// Title is optional. If black, fill it if possible.
		if ( ! $widget_options[ $widget_id ]['title'] && isset( $_POST['widget-rss'][ $number ]['title'] ) ) {
			$rss = fetch_feed( $widget_options[ $widget_id ]['url'] );
			if ( is_wp_error( $rss ) ) {
				$widget_options[ $widget_id ]['title'] = htmlentities( __( 'Unknown Feed' ) );
			} else {
				$widget_options[ $widget_id ]['title'] = htmlentities( strip_tags( $rss->get_title() ) );
				$rss->__destruct();
				unset( $rss );
			}
		}

		update_option( 'dashboard_widget_options', $widget_options, false );

		$locale    = get_user_locale();
		$cache_key = 'dash_v2_' . md5( $widget_id . '_' . $locale );
		delete_transient( $cache_key );
	}

	wp_widget_rss_form( $widget_options[ $widget_id ], $form_inputs );
}

/**
 * Displays file upload quota on dashboard.
 *
 * Runs on the {@see 'activity_box_end'} hook in wp_dashboard_right_now().
 *
 * @since WP 3.0.0
 *
 * @return true|void True if not multisite, user can't upload files, or the space check option is disabled.
 */
function wp_dashboard_quota() {
	if ( ! is_multisite() || ! current_user_can( 'upload_files' )
		|| get_site_option( 'upload_space_check_disabled' )
	) {
		return true;
	}

	$quota = get_space_allowed();
	$used  = get_space_used();

	if ( $used > $quota ) {
		$percentused = '100';
	} else {
		$percentused = ( $used / $quota ) * 100;
	}

	$used_class  = ( $percentused >= 70 ) ? ' warning' : '';
	$used        = round( $used, 2 );
	$percentused = number_format( $percentused );

	?>
	<h3 class="mu-storage"><?php _e( 'Storage Space' ); ?></h3>
	<div class="mu-storage">
	<ul>
		<li class="storage-count">
			<?php
			$text = sprintf(
				/* translators: %s: Number of megabytes. */
				__( '%s MB Space Allowed' ),
				number_format_i18n( $quota )
			);
			printf(
				'<a href="%1$s">%2$s<span class="screen-reader-text"> (%3$s)</span></a>',
				esc_url( admin_url( 'upload.php' ) ),
				$text,
				/* translators: Hidden accessibility text. */
				__( 'Manage Uploads' )
			);
			?>
		</li><li class="storage-count <?php echo $used_class; ?>">
			<?php
			$text = sprintf(
				/* translators: 1: Number of megabytes, 2: Percentage. */
				__( '%1$s MB (%2$s%%) Space Used' ),
				number_format_i18n( $used, 2 ),
				$percentused
			);
			printf(
				'<a href="%1$s" class="musublink">%2$s<span class="screen-reader-text"> (%3$s)</span></a>',
				esc_url( admin_url( 'upload.php' ) ),
				$text,
				/* translators: Hidden accessibility text. */
				__( 'Manage Uploads' )
			);
			?>
		</li>
	</ul>
	</div>
	<?php
}

/**
 * Displays the PHP update nag.
 *
 * @since WP 5.1.0
 */
function wp_dashboard_php_nag() {
	$response = wp_check_php_version();

	if ( ! $response ) {
		return;
	}

	if ( isset( $response['is_secure'] ) && ! $response['is_secure'] ) {
		// The `is_secure` array key name doesn't actually imply this is a secure version of PHP. It only means it receives security updates.

		if ( $response['is_lower_than_future_minimum'] ) {
			$message = sprintf(
				/* translators: %s: The server PHP version. */
				__( 'Your site is running on an outdated version of PHP (%s), which does not receive security updates and soon will not be supported by Retraceur. Ensure that PHP is updated on your server as soon as possible. Otherwise you will not be able to upgrade Retraceur.' ),
				PHP_VERSION
			);
		} else {
			$message = sprintf(
				/* translators: %s: The server PHP version. */
				__( 'Your site is running on an outdated version of PHP (%s), which does not receive security updates. It should be updated.' ),
				PHP_VERSION
			);
		}
	} elseif ( $response['is_lower_than_future_minimum'] ) {
		$message = sprintf(
			/* translators: %s: The server PHP version. */
			__( 'Your site is running on an outdated version of PHP (%s), which soon will not be supported by Retraceur. Ensure that PHP is updated on your server as soon as possible. Otherwise you will not be able to upgrade Retraceur.' ),
			PHP_VERSION
		);
	} else {
		$message = sprintf(
			/* translators: %s: The server PHP version. */
			__( 'Your site is running on an outdated version of PHP (%s), which should be updated.' ),
			PHP_VERSION
		);
	}
	?>
	<p class="bigger-bolder-text"><?php echo $message; ?></p>

	<p><?php _e( 'What is PHP and how does it affect my site?' ); ?></p>
	<p>
		<?php _e( 'PHP is one of the programming languages used to build Retraceur. Newer versions of PHP receive regular security updates and may increase your site&#8217;s performance.' ); ?>
		<?php
		if ( ! empty( $response['recommended_version'] ) ) {
			printf(
				/* translators: %s: The minimum recommended PHP version. */
				__( 'The minimum recommended version of PHP is %s.' ),
				$response['recommended_version']
			);
		}
		?>
	</p>
	<?php
}

/**
 * Adds an additional class to the PHP nag if the current version is insecure.
 *
 * @since WP 5.1.0
 *
 * @param string[] $classes Array of meta box classes.
 * @return string[] Modified array of meta box classes.
 */
function dashboard_php_nag_class( $classes ) {
	$response = wp_check_php_version();

	if ( ! $response ) {
		return $classes;
	}

	if ( isset( $response['is_secure'] ) && ! $response['is_secure'] ) {
		$classes[] = 'php-no-security-updates';
	} elseif ( $response['is_lower_than_future_minimum'] ) {
		$classes[] = 'php-version-lower-than-future-minimum';
	}

	return $classes;
}

/**
 * Displays the Site Health Status widget.
 *
 * @since WP 5.4.0
 */
function wp_dashboard_site_health() {
	$get_issues = get_transient( 'health-check-site-status-result' );

	$issue_counts = array();

	if ( false !== $get_issues ) {
		$issue_counts = json_decode( $get_issues, true );
	}

	if ( ! is_array( $issue_counts ) || ! $issue_counts ) {
		$issue_counts = array(
			'good'        => 0,
			'recommended' => 0,
			'critical'    => 0,
		);
	}

	$issues_total = $issue_counts['recommended'] + $issue_counts['critical'];
	?>
	<div class="health-check-widget">
		<div class="health-check-widget-title-section site-health-progress-wrapper loading hide-if-no-js">
			<div class="site-health-progress">
				<svg aria-hidden="true" focusable="false" width="100%" height="100%" viewBox="0 0 200 200" version="1.1" xmlns="http://www.w3.org/2000/svg">
					<circle r="90" cx="100" cy="100" fill="transparent" stroke-dasharray="565.48" stroke-dashoffset="0"></circle>
					<circle id="bar" r="90" cx="100" cy="100" fill="transparent" stroke-dasharray="565.48" stroke-dashoffset="0"></circle>
				</svg>
			</div>
			<div class="site-health-progress-label">
				<?php if ( false === $get_issues ) : ?>
					<?php _e( 'No information yet&hellip;' ); ?>
				<?php else : ?>
					<?php _e( 'Results are still loading&hellip;' ); ?>
				<?php endif; ?>
			</div>
		</div>

		<div class="site-health-details">
			<?php if ( false === $get_issues ) : ?>
				<p>
					<?php
					printf(
						/* translators: %s: URL to Site Health screen. */
						__( 'Site health checks will automatically run periodically to gather information about your site. You can also <a href="%s">visit the Site Health screen</a> to gather information about your site now.' ),
						esc_url( admin_url( 'site-health.php' ) )
					);
					?>
				</p>
			<?php else : ?>
				<p>
					<?php if ( $issues_total <= 0 ) : ?>
						<?php _e( 'Great job! Your site currently passes all site health checks.' ); ?>
					<?php elseif ( 1 === (int) $issue_counts['critical'] ) : ?>
						<?php _e( 'Your site has a critical issue that should be addressed as soon as possible to improve its performance and security.' ); ?>
					<?php elseif ( $issue_counts['critical'] > 1 ) : ?>
						<?php _e( 'Your site has critical issues that should be addressed as soon as possible to improve its performance and security.' ); ?>
					<?php elseif ( 1 === (int) $issue_counts['recommended'] ) : ?>
						<?php _e( 'Your site&#8217;s health is looking good, but there is still one thing you can do to improve its performance and security.' ); ?>
					<?php else : ?>
						<?php _e( 'Your site&#8217;s health is looking good, but there are still some things you can do to improve its performance and security.' ); ?>
					<?php endif; ?>
				</p>
			<?php endif; ?>

			<?php if ( $issues_total > 0 && false !== $get_issues ) : ?>
				<p>
					<?php
					printf(
						/* translators: 1: Number of issues. 2: URL to Site Health screen. */
						_n(
							'Take a look at the <strong>%1$d item</strong> on the <a href="%2$s">Site Health screen</a>.',
							'Take a look at the <strong>%1$d items</strong> on the <a href="%2$s">Site Health screen</a>.',
							$issues_total
						),
						$issues_total,
						esc_url( admin_url( 'site-health.php' ) )
					);
					?>
				</p>
			<?php endif; ?>
		</div>
	</div>

	<?php
}

/**
 * Outputs empty dashboard widget to be populated by JS later.
 *
 * Usable by plugins.
 *
 * @since WP 2.5.0
 */
function wp_dashboard_empty() {}

/**
 * Displays a welcome panel to introduce users to Retraceur.
 *
 * @since WP 3.3.0
 * @since WP 5.9.0 Send users to the Site Editor if the active theme is block-based.
 */
function wp_welcome_panel() {
	list( $display_version ) = explode( '-', retraceur_get_version() );
	$is_block_theme          = wp_is_block_theme();
	?>
	<div class="welcome-panel-content">
	<div class="welcome-panel-header">
		<div class="welcome-panel-header-image">
			<?php echo file_get_contents( dirname( __DIR__ ) . '/images/dashboard-background.svg' ); ?>
		</div>
		<h2><?php _e( 'Welcome to Retraceur!' ); ?></h2>
		<p>
			<a href="<?php echo esc_url( admin_url( 'about.php' ) ); ?>">
			<?php
				/* translators: %s: Current Retraceur version. */
				printf( __( 'Learn more about the %s version.' ), esc_html( $display_version ) );
			?>
			</a>
		</p>
	</div>
	<div class="welcome-panel-column-container">
		<div class="welcome-panel-column">
			<svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
				<rect width="48" height="48" rx="4" fill="#273c86"/>
				<path fill-rule="evenodd" clip-rule="evenodd" d="M32.0668 17.0854L28.8221 13.9454L18.2008 24.671L16.8983 29.0827L21.4257 27.8309L32.0668 17.0854ZM16 32.75H24V31.25H16V32.75Z" fill="white"/>
			</svg>
			<div class="welcome-panel-column-content">
				<h3><?php _e( 'Author rich content with blocks and patterns' ); ?></h3>
				<p><?php _e( 'Block patterns are pre-configured block layouts. Use them to get inspired or create new pages in a flash.' ); ?></p>
				<a href="<?php echo esc_url( admin_url( 'post-new.php?post_type=page' ) ); ?>"><?php _e( 'Add a new page' ); ?></a>
			</div>
		</div>
		<div class="welcome-panel-column">
			<svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
				<rect width="48" height="48" rx="4" fill="#273c86"/>
				<path fill-rule="evenodd" clip-rule="evenodd" d="M18 16h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H18a2 2 0 0 1-2-2V18a2 2 0 0 1 2-2zm12 1.5H18a.5.5 0 0 0-.5.5v3h13v-3a.5.5 0 0 0-.5-.5zm.5 5H22v8h8a.5.5 0 0 0 .5-.5v-7.5zm-10 0h-3V30a.5.5 0 0 0 .5.5h2.5v-8z" fill="#fff"/>
			</svg>
			<div class="welcome-panel-column-content">
			<?php if ( $is_block_theme ) : ?>
				<h3><?php _e( 'Customize your entire site with block themes' ); ?></h3>
				<p><?php _e( 'Design everything on your site &#8212; from the header down to the footer, all using blocks and patterns.' ); ?></p>
				<a href="<?php echo esc_url( admin_url( 'site-editor.php' ) ); ?>"><?php _e( 'Open site editor' ); ?></a>
			<?php endif; ?>
			</div>
		</div>
		<div class="welcome-panel-column">
			<svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
				<rect width="48" height="48" rx="4" fill="#273c86"/>
				<path fill-rule="evenodd" clip-rule="evenodd" d="M31 24a7 7 0 0 1-7 7V17a7 7 0 0 1 7 7zm-7-8a8 8 0 1 1 0 16 8 8 0 0 1 0-16z" fill="#fff"/>
			</svg>
			<div class="welcome-panel-column-content">
			<?php if ( $is_block_theme ) : ?>
				<h3><?php _e( 'Switch up your site&#8217;s look & feel with Styles' ); ?></h3>
				<p><?php _e( 'Tweak your site, or give it a whole new look! Get creative &#8212; how about a new color palette or font?' ); ?></p>
				<a href="<?php echo esc_url( admin_url( '/site-editor.php?path=%2Fwp_global_styles' ) ); ?>"><?php _e( 'Edit styles' ); ?></a>
			<?php else : ?>
				<h3><?php _e( 'Discover a new way to build your site.' ); ?></h3>
				<p><?php _e( 'There is a new kind of theme, called a block theme, that lets you build the site you&#8217;ve always wanted &#8212; with blocks and styles.' ); ?></p>
			<?php endif; ?>
			</div>
		</div>
	</div>
	</div>
	<?php
}
