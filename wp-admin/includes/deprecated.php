<?php
/**
 * Deprecated admin functions from past WP & Retraceur versions. You shouldn't use these
 * functions and look for the alternatives instead. The functions will be removed
 * in a later version.
 *
 * @since 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Deprecated
 */

/*
 * Deprecated functions come here to die.
 */

/**
 * @since WP 2.1.0
 * @deprecated WP 2.1.0 Use wp_editor()
 * @see wp_editor()
 */
function tinymce_include() {
	_deprecated_function( __FUNCTION__, '2.1.0', 'wp_editor()' );

	wp_tiny_mce();
}

/**
 * Unused Admin function.
 *
 * @since WP 2.0.0
 * @deprecated WP 2.5.0
 *
 */
function documentation_link() {
	_deprecated_function( __FUNCTION__, '2.5.0' );
}

/**
 * Calculates the new dimensions for a downsampled image.
 *
 * @since WP 2.0.0
 * @deprecated WP 3.0.0 Use wp_constrain_dimensions()
 * @see wp_constrain_dimensions()
 *
 * @param int $width Current width of the image
 * @param int $height Current height of the image
 * @param int $wmax Maximum wanted width
 * @param int $hmax Maximum wanted height
 * @return array Shrunk dimensions (width, height).
 */
function wp_shrink_dimensions( $width, $height, $wmax = 128, $hmax = 96 ) {
	_deprecated_function( __FUNCTION__, '3.0.0', 'wp_constrain_dimensions()' );
	return wp_constrain_dimensions( $width, $height, $wmax, $hmax );
}

/**
 * Calculated the new dimensions for a downsampled image.
 *
 * @since WP 2.0.0
 * @deprecated WP 3.5.0 Use wp_constrain_dimensions()
 * @see wp_constrain_dimensions()
 *
 * @param int $width Current width of the image
 * @param int $height Current height of the image
 * @return array Shrunk dimensions (width, height).
 */
function get_udims( $width, $height ) {
	_deprecated_function( __FUNCTION__, '3.5.0', 'wp_constrain_dimensions()' );
	return wp_constrain_dimensions( $width, $height, 128, 96 );
}

/**
 * Legacy function used to generate the categories checklist control.
 *
 * @since WP 0.71
 * @deprecated WP 2.6.0 Use wp_category_checklist()
 * @see wp_category_checklist()
 *
 * @global int $post_ID
 *
 * @param int   $default_category Unused.
 * @param int   $category_parent  Unused.
 * @param array $popular_ids      Unused.
 */
function dropdown_categories( $default_category = 0, $category_parent = 0, $popular_ids = array() ) {
	_deprecated_function( __FUNCTION__, '2.6.0', 'wp_category_checklist()' );
	global $post_ID;
	wp_category_checklist( $post_ID );
}

/**
 * Legacy function used to generate a link categories checklist control.
 *
 * @since WP 2.1.0
 * @deprecated WP 2.6.0 Use wp_link_category_checklist()
 * @see wp_link_category_checklist()
 *
 * @global int $link_id
 *
 * @param int $default_link_category Unused.
 */
function dropdown_link_categories( $default_link_category = 0 ) {
	_deprecated_function( __FUNCTION__, '2.6.0', 'wp_link_category_checklist()' );
	global $link_id;
	wp_link_category_checklist( $link_id );
}

/**
 * Get the real filesystem path to a file to edit within the admin.
 *
 * @since WP 1.5.0
 * @deprecated WP 2.9.0
 * @uses WP_CONTENT_DIR Full filesystem path to the wp-content directory.
 *
 * @param string $file Filesystem path relative to the wp-content directory.
 * @return string Full filesystem path to edit.
 */
function get_real_file_to_edit( $file ) {
	_deprecated_function( __FUNCTION__, '2.9.0' );

	return WP_CONTENT_DIR . $file;
}

/**
 * Legacy function used for generating a categories drop-down control.
 *
 * @since WP 1.2.0
 * @deprecated WP 3.0.0 Use wp_dropdown_categories()
 * @see wp_dropdown_categories()
 *
 * @param int $current_cat     Optional. ID of the current category. Default 0.
 * @param int $current_parent  Optional. Current parent category ID. Default 0.
 * @param int $category_parent Optional. Parent ID to retrieve categories for. Default 0.
 * @param int $level           Optional. Number of levels deep to display. Default 0.
 * @param array $categories    Optional. Categories to include in the control. Default 0.
 * @return void|false Void on success, false if no categories were found.
 */
function wp_dropdown_cats( $current_cat = 0, $current_parent = 0, $category_parent = 0, $level = 0, $categories = 0 ) {
	_deprecated_function( __FUNCTION__, '3.0.0', 'wp_dropdown_categories()' );
	if (!$categories )
		$categories = get_categories( array('hide_empty' => 0) );

	if ( $categories ) {
		foreach ( $categories as $category ) {
			if ( $current_cat != $category->term_id && $category_parent == $category->parent) {
				$pad = str_repeat( '&#8211; ', $level );
				$category->name = esc_html( $category->name );
				echo "\n\t<option value='$category->term_id'";
				if ( $current_parent == $category->term_id )
					echo " selected='selected'";
				echo ">$pad$category->name</option>";
				wp_dropdown_cats( $current_cat, $current_parent, $category->term_id, $level +1, $categories );
			}
		}
	} else {
		return false;
	}
}

/**
 * Register a setting and its sanitization callback
 *
 * @since WP 2.7.0
 * @deprecated WP 3.0.0 Use register_setting()
 * @see register_setting()
 *
 * @param string   $option_group      A settings group name. Should correspond to an allowed option key name.
 *                                    Default allowed option key names include 'general', 'discussion', 'media',
 *                                    'reading', 'writing', and 'options'.
 * @param string   $option_name       The name of an option to sanitize and save.
 * @param callable $sanitize_callback Optional. A callback function that sanitizes the option's value.
 */
function add_option_update_handler( $option_group, $option_name, $sanitize_callback = '' ) {
	_deprecated_function( __FUNCTION__, '3.0.0', 'register_setting()' );
	register_setting( $option_group, $option_name, $sanitize_callback );
}

/**
 * Unregister a setting
 *
 * @since WP 2.7.0
 * @deprecated WP 3.0.0 Use unregister_setting()
 * @see unregister_setting()
 *
 * @param string   $option_group      The settings group name used during registration.
 * @param string   $option_name       The name of the option to unregister.
 * @param callable $sanitize_callback Optional. Deprecated.
 */
function remove_option_update_handler( $option_group, $option_name, $sanitize_callback = '' ) {
	_deprecated_function( __FUNCTION__, '3.0.0', 'unregister_setting()' );
	unregister_setting( $option_group, $option_name, $sanitize_callback );
}

/**
 * Determines the language to use for CodePress syntax highlighting.
 *
 * @since WP 2.8.0
 * @deprecated WP 3.0.0
 *
 * @param string $filename
 */
function codepress_get_lang( $filename ) {
	_deprecated_function( __FUNCTION__, '3.0.0' );
}

/**
 * Adds JavaScript required to make CodePress work on the theme/plugin file editors.
 *
 * @since WP 2.8.0
 * @deprecated WP 3.0.0
 */
function codepress_footer_js() {
	_deprecated_function( __FUNCTION__, '3.0.0' );
}

/**
 * Determine whether to use CodePress.
 *
 * @since WP 2.8.0
 * @deprecated WP 3.0.0
 */
function use_codepress() {
	_deprecated_function( __FUNCTION__, '3.0.0' );
}

/**
 * Get all user IDs.
 *
 * @deprecated WP 3.1.0 Use get_users()
 *
 * @global wpdb $wpdb Retraceur database abstraction object.
 *
 * @return array List of user IDs.
 */
function get_author_user_ids() {
	_deprecated_function( __FUNCTION__, '3.1.0', 'get_users()' );

	global $wpdb;
	if ( !is_multisite() )
		$level_key = $wpdb->get_blog_prefix() . 'user_level';
	else
		$level_key = $wpdb->get_blog_prefix() . 'capabilities'; // WPMU site admins don't have user_levels.

	return $wpdb->get_col( $wpdb->prepare("SELECT user_id FROM $wpdb->usermeta WHERE meta_key = %s AND meta_value != '0'", $level_key) );
}

/**
 * Gets author users who can edit posts.
 *
 * @deprecated WP 3.1.0 Use get_users()
 *
 * @global wpdb $wpdb Retraceur database abstraction object.
 *
 * @param int $user_id User ID.
 * @return array|false List of editable authors. False if no editable users.
 */
function get_editable_authors( $user_id ) {
	_deprecated_function( __FUNCTION__, '3.1.0', 'get_users()' );

	global $wpdb;

	$editable = get_editable_user_ids( $user_id );

	if ( !$editable ) {
		return false;
	} else {
		$editable = join(',', $editable);
		$authors = $wpdb->get_results( "SELECT * FROM $wpdb->users WHERE ID IN ($editable) ORDER BY display_name" );
	}

	return apply_filters('get_editable_authors', $authors);
}

/**
 * Gets the IDs of any users who can edit posts.
 *
 * @deprecated WP 3.1.0 Use get_users()
 *
 * @global wpdb $wpdb Retraceur database abstraction object.
 *
 * @param int  $user_id       User ID.
 * @param bool $exclude_zeros Optional. Whether to exclude zeroes. Default true.
 * @return array Array of editable user IDs, empty array otherwise.
 */
function get_editable_user_ids( $user_id, $exclude_zeros = true, $post_type = 'post' ) {
	_deprecated_function( __FUNCTION__, '3.1.0', 'get_users()' );

	global $wpdb;

	if ( ! $user = get_userdata( $user_id ) )
		return array();
	$post_type_obj = get_post_type_object($post_type);

	if ( ! $user->has_cap($post_type_obj->cap->edit_others_posts) ) {
		if ( $user->has_cap($post_type_obj->cap->edit_posts) || ! $exclude_zeros )
			return array($user->ID);
		else
			return array();
	}

	if ( !is_multisite() )
		$level_key = $wpdb->get_blog_prefix() . 'user_level';
	else
		$level_key = $wpdb->get_blog_prefix() . 'capabilities'; // WPMU site admins don't have user_levels.

	$query = $wpdb->prepare("SELECT user_id FROM $wpdb->usermeta WHERE meta_key = %s", $level_key);
	if ( $exclude_zeros )
		$query .= " AND meta_value != '0'";

	return $wpdb->get_col( $query );
}

/**
 * Gets all users who are not authors.
 *
 * @deprecated WP 3.1.0 Use get_users()
 *
 * @global wpdb $wpdb Retraceur database abstraction object.
 */
function get_nonauthor_user_ids() {
	_deprecated_function( __FUNCTION__, '3.1.0', 'get_users()' );

	global $wpdb;

	if ( !is_multisite() )
		$level_key = $wpdb->get_blog_prefix() . 'user_level';
	else
		$level_key = $wpdb->get_blog_prefix() . 'capabilities'; // WPMU site admins don't have user_levels.

	return $wpdb->get_col( $wpdb->prepare("SELECT user_id FROM $wpdb->usermeta WHERE meta_key = %s AND meta_value = '0'", $level_key) );
}

if ( ! class_exists( 'WP_User_Search', false ) ) :
/**
 * Retraceur User Search class.
 *
 * @since WP 2.1.0
 * @deprecated WP 3.1.0 Use WP_User_Query
 */
class WP_User_Search {

	/**
	 * {@internal Missing Description}}
	 *
	 * @since WP 2.1.0
	 * @access private
	 * @var mixed
	 */
	var $results;

	/**
	 * {@internal Missing Description}}
	 *
	 * @since WP 2.1.0
	 * @access private
	 * @var string
	 */
	var $search_term;

	/**
	 * Page number.
	 *
	 * @since WP 2.1.0
	 * @access private
	 * @var int
	 */
	var $page;

	/**
	 * Role name that users have.
	 *
	 * @since WP 2.5.0
	 * @access private
	 * @var string
	 */
	var $role;

	/**
	 * Raw page number.
	 *
	 * @since WP 2.1.0
	 * @access private
	 * @var int|bool
	 */
	var $raw_page;

	/**
	 * Amount of users to display per page.
	 *
	 * @since WP 2.1.0
	 * @access public
	 * @var int
	 */
	var $users_per_page = 50;

	/**
	 * {@internal Missing Description}}
	 *
	 * @since WP 2.1.0
	 * @access private
	 * @var int
	 */
	var $first_user;

	/**
	 * {@internal Missing Description}}
	 *
	 * @since WP 2.1.0
	 * @access private
	 * @var int
	 */
	var $last_user;

	/**
	 * {@internal Missing Description}}
	 *
	 * @since WP 2.1.0
	 * @access private
	 * @var string
	 */
	var $query_limit;

	/**
	 * {@internal Missing Description}}
	 *
	 * @since WP 3.0.0
	 * @access private
	 * @var string
	 */
	var $query_orderby;

	/**
	 * {@internal Missing Description}}
	 *
	 * @since WP 3.0.0
	 * @access private
	 * @var string
	 */
	var $query_from;

	/**
	 * {@internal Missing Description}}
	 *
	 * @since WP 3.0.0
	 * @access private
	 * @var string
	 */
	var $query_where;

	/**
	 * {@internal Missing Description}}
	 *
	 * @since WP 2.1.0
	 * @access private
	 * @var int
	 */
	var $total_users_for_query = 0;

	/**
	 * {@internal Missing Description}}
	 *
	 * @since WP 2.1.0
	 * @access private
	 * @var bool
	 */
	var $too_many_total_users = false;

	/**
	 * {@internal Missing Description}}
	 *
	 * @since WP 2.1.0
	 * @access private
	 * @var WP_Error
	 */
	var $search_errors;

	/**
	 * {@internal Missing Description}}
	 *
	 * @since WP 2.7.0
	 * @access private
	 * @var string
	 */
	var $paging_text;

	/**
	 * PHP5 Constructor - Sets up the object properties.
	 *
	 * @since WP 2.1.0
	 *
	 * @param string $search_term Search terms string.
	 * @param int $page Optional. Page ID.
	 * @param string $role Role name.
	 * @return WP_User_Search
	 */
	function __construct( $search_term = '', $page = '', $role = '' ) {
		_deprecated_class( 'WP_User_Search', '3.1.0', 'WP_User_Query' );

		$this->search_term = wp_unslash( $search_term );
		$this->raw_page = ( '' == $page ) ? false : (int) $page;
		$this->page = ( '' == $page ) ? 1 : (int) $page;
		$this->role = $role;

		$this->prepare_query();
		$this->query();
		$this->do_paging();
	}

	/**
	 * PHP4 Constructor - Sets up the object properties.
	 *
	 * @since WP 2.1.0
	 *
	 * @param string $search_term Search terms string.
	 * @param int $page Optional. Page ID.
	 * @param string $role Role name.
	 * @return WP_User_Search
	 */
	public function WP_User_Search( $search_term = '', $page = '', $role = '' ) {
		_deprecated_constructor( 'WP_User_Search', '3.1.0', get_class( $this ) );
		self::__construct( $search_term, $page, $role );
	}

	/**
	 * Prepares the user search query (legacy).
	 *
	 * @since WP 2.1.0
	 * @access public
	 *
	 * @global wpdb $wpdb Retraceur database abstraction object.
	 */
	public function prepare_query() {
		global $wpdb;
		$this->first_user = ($this->page - 1) * $this->users_per_page;

		$this->query_limit = $wpdb->prepare(" LIMIT %d, %d", $this->first_user, $this->users_per_page);
		$this->query_orderby = ' ORDER BY user_login';

		$search_sql = '';
		if ( $this->search_term ) {
			$searches = array();
			$search_sql = 'AND (';
			foreach ( array('user_login', 'user_nicename', 'user_email', 'user_url', 'display_name') as $col )
				$searches[] = $wpdb->prepare( $col . ' LIKE %s', '%' . like_escape($this->search_term) . '%' );
			$search_sql .= implode(' OR ', $searches);
			$search_sql .= ')';
		}

		$this->query_from = " FROM $wpdb->users";
		$this->query_where = " WHERE 1=1 $search_sql";

		if ( $this->role ) {
			$this->query_from .= " INNER JOIN $wpdb->usermeta ON $wpdb->users.ID = $wpdb->usermeta.user_id";
			$this->query_where .= $wpdb->prepare(" AND $wpdb->usermeta.meta_key = '{$wpdb->prefix}capabilities' AND $wpdb->usermeta.meta_value LIKE %s", '%' . $this->role . '%');
		} elseif ( is_multisite() ) {
			$level_key = $wpdb->prefix . 'capabilities'; // WPMU site admins don't have user_levels.
			$this->query_from .= ", $wpdb->usermeta";
			$this->query_where .= " AND $wpdb->users.ID = $wpdb->usermeta.user_id AND meta_key = '{$level_key}'";
		}

		do_action_ref_array( 'pre_user_search', array( &$this ) );
	}

	/**
	 * Executes the user search query.
	 *
	 * @since WP 2.1.0
	 * @access public
	 *
	 * @global wpdb $wpdb Retraceur database abstraction object.
	 */
	public function query() {
		global $wpdb;

		$this->results = $wpdb->get_col("SELECT DISTINCT($wpdb->users.ID)" . $this->query_from . $this->query_where . $this->query_orderby . $this->query_limit);

		if ( $this->results )
			$this->total_users_for_query = $wpdb->get_var("SELECT COUNT(DISTINCT($wpdb->users.ID))" . $this->query_from . $this->query_where); // No limit.
		else
			$this->search_errors = new WP_Error('no_matching_users_found', __('No users found.'));
	}

	/**
	 * Prepares variables for use in templates.
	 *
	 * @since WP 2.1.0
	 * @access public
	 */
	function prepare_vars_for_template_usage() {}

	/**
	 * Handles paging for the user search query.
	 *
	 * @since WP 2.1.0
	 * @access public
	 */
	public function do_paging() {
		if ( $this->total_users_for_query > $this->users_per_page ) { // Have to page the results.
			$args = array();
			if ( ! empty($this->search_term) )
				$args['usersearch'] = urlencode($this->search_term);
			if ( ! empty($this->role) )
				$args['role'] = urlencode($this->role);

			$this->paging_text = paginate_links( array(
				'total' => ceil($this->total_users_for_query / $this->users_per_page),
				'current' => $this->page,
				'base' => 'users.php?%_%',
				'format' => 'userspage=%#%',
				'add_args' => $args
			) );
			if ( $this->paging_text ) {
				$this->paging_text = sprintf(
					/* translators: 1: Starting number of users on the current page, 2: Ending number of users, 3: Total number of users. */
					'<span class="displaying-num">' . __( 'Displaying %1$s&#8211;%2$s of %3$s' ) . '</span>%s',
					number_format_i18n( ( $this->page - 1 ) * $this->users_per_page + 1 ),
					number_format_i18n( min( $this->page * $this->users_per_page, $this->total_users_for_query ) ),
					number_format_i18n( $this->total_users_for_query ),
					$this->paging_text
				);
			}
		}
	}

	/**
	 * Retrieves the user search query results.
	 *
	 * @since WP 2.1.0
	 * @access public
	 *
	 * @return array
	 */
	public function get_results() {
		return (array) $this->results;
	}

	/**
	 * Displaying paging text.
	 *
	 * @see do_paging() Builds paging text.
	 *
	 * @since WP 2.1.0
	 * @access public
	 */
	function page_links() {
		echo $this->paging_text;
	}

	/**
	 * Whether paging is enabled.
	 *
	 * @see do_paging() Builds paging text.
	 *
	 * @since WP 2.1.0
	 * @access public
	 *
	 * @return bool
	 */
	function results_are_paged() {
		if ( $this->paging_text )
			return true;
		return false;
	}

	/**
	 * Whether there are search terms.
	 *
	 * @since WP 2.1.0
	 * @access public
	 *
	 * @return bool
	 */
	function is_search() {
		if ( $this->search_term )
			return true;
		return false;
	}
}
endif;

/**
 * Retrieves editable posts from other users.
 *
 * @since WP 2.3.0
 * @deprecated WP 3.1.0 Use get_posts()
 * @see get_posts()
 *
 * @global wpdb $wpdb Retraceur database abstraction object.
 *
 * @param int    $user_id User ID to not retrieve posts from.
 * @param string $type    Optional. Post type to retrieve. Accepts 'draft', 'pending' or 'any' (all).
 *                        Default 'any'.
 * @return array List of posts from others.
 */
function get_others_unpublished_posts( $user_id, $type = 'any' ) {
	_deprecated_function( __FUNCTION__, '3.1.0' );

	global $wpdb;

	$editable = get_editable_user_ids( $user_id );

	if ( in_array($type, array('draft', 'pending')) )
		$type_sql = " post_status = '$type' ";
	else
		$type_sql = " ( post_status = 'draft' OR post_status = 'pending' ) ";

	$dir = ( 'pending' == $type ) ? 'ASC' : 'DESC';

	if ( !$editable ) {
		$other_unpubs = '';
	} else {
		$editable = join(',', $editable);
		$other_unpubs = $wpdb->get_results( $wpdb->prepare("SELECT ID, post_title, post_author FROM $wpdb->posts WHERE post_type = 'post' AND $type_sql AND post_author IN ($editable) AND post_author != %d ORDER BY post_modified $dir", $user_id) );
	}

	return apply_filters('get_others_drafts', $other_unpubs);
}

/**
 * Retrieve drafts from other users.
 *
 * @deprecated WP 3.1.0 Use get_posts()
 * @see get_posts()
 *
 * @param int $user_id User ID.
 * @return array List of drafts from other users.
 */
function get_others_drafts($user_id) {
	_deprecated_function( __FUNCTION__, '3.1.0' );

	return get_others_unpublished_posts($user_id, 'draft');
}

/**
 * Retrieve pending review posts from other users.
 *
 * @deprecated WP 3.1.0 Use get_posts()
 * @see get_posts()
 *
 * @param int $user_id User ID.
 * @return array List of posts with pending review post type from other users.
 */
function get_others_pending($user_id) {
	_deprecated_function( __FUNCTION__, '3.1.0' );

	return get_others_unpublished_posts($user_id, 'pending');
}

/**
 * Output the QuickPress dashboard widget.
 *
 * @since WP 3.0.0
 * @deprecated WP 3.2.0 Use wp_dashboard_quick_press()
 * @see wp_dashboard_quick_press()
 */
function wp_dashboard_quick_press_output() {
	_deprecated_function( __FUNCTION__, '3.2.0', 'wp_dashboard_quick_press()' );
	wp_dashboard_quick_press();
}

/**
 * Outputs the TinyMCE editor.
 *
 * @since WP 2.7.0
 * @deprecated WP 3.3.0 Use wp_editor()
 * @see wp_editor()
 */
function wp_tiny_mce( $teeny = false, $settings = false ) {
	_deprecated_function( __FUNCTION__, '3.3.0', 'wp_editor()' );

	static $num = 1;

	if ( ! class_exists( '_WP_Editors', false ) )
		require_once ABSPATH . WPINC . '/class-wp-editor.php';

	$editor_id = 'content' . $num++;

	$set = array(
		'teeny' => $teeny,
		'tinymce' => $settings ? $settings : true,
		'quicktags' => false
	);

	$set = _WP_Editors::parse_settings($editor_id, $set);
	_WP_Editors::editor_settings($editor_id, $set);
}

/**
 * Preloads TinyMCE dialogs.
 *
 * @deprecated WP 3.3.0 Use wp_editor()
 * @see wp_editor()
 */
function wp_preload_dialogs() {
	_deprecated_function( __FUNCTION__, '3.3.0', 'wp_editor()' );
}

/**
 * Prints TinyMCE editor JS.
 *
 * @deprecated WP 3.3.0 Use wp_editor()
 * @see wp_editor()
 */
function wp_print_editor_js() {
	_deprecated_function( __FUNCTION__, '3.3.0', 'wp_editor()' );
}

/**
 * Handles quicktags.
 *
 * @deprecated WP 3.3.0 Use wp_editor()
 * @see wp_editor()
 */
function wp_quicktags() {
	_deprecated_function( __FUNCTION__, '3.3.0', 'wp_editor()' );
}

/**
 * Returns the screen layout options.
 *
 * @since WP 2.8.0
 * @deprecated WP 3.3.0 WP_Screen::render_screen_layout()
 * @see WP_Screen::render_screen_layout()
 */
function screen_layout( $screen ) {
	_deprecated_function( __FUNCTION__, '3.3.0', '$current_screen->render_screen_layout()' );

	$current_screen = get_current_screen();

	if ( ! $current_screen )
		return '';

	ob_start();
	$current_screen->render_screen_layout();
	return ob_get_clean();
}

/**
 * Returns the screen's per-page options.
 *
 * @since WP 2.8.0
 * @deprecated WP 3.3.0 Use WP_Screen::render_per_page_options()
 * @see WP_Screen::render_per_page_options()
 */
function screen_options( $screen ) {
	_deprecated_function( __FUNCTION__, '3.3.0', '$current_screen->render_per_page_options()' );

	$current_screen = get_current_screen();

	if ( ! $current_screen )
		return '';

	ob_start();
	$current_screen->render_per_page_options();
	return ob_get_clean();
}

/**
 * Renders the screen's help.
 *
 * @since WP 2.7.0
 * @deprecated WP 3.3.0 Use WP_Screen::render_screen_meta()
 * @see WP_Screen::render_screen_meta()
 */
function screen_meta( $screen ) {
	$current_screen = get_current_screen();
	$current_screen->render_screen_meta();
}

/**
 * Favorite actions were deprecated in version 3.2. Use the admin bar instead.
 *
 * @since WP 2.7.0
 * @deprecated WP 3.2.0 Use WP_Admin_Bar
 * @see WP_Admin_Bar
 */
function favorite_actions() {
	_deprecated_function( __FUNCTION__, '3.2.0', 'WP_Admin_Bar' );
}

/**
 * Handles uploading an image.
 *
 * @deprecated WP 3.3.0 Use wp_media_upload_handler()
 * @see wp_media_upload_handler()
 *
 * @return null|string
 */
function media_upload_image() {
	_deprecated_function( __FUNCTION__, '3.3.0', 'wp_media_upload_handler()' );
	return wp_media_upload_handler();
}

/**
 * Handles uploading an audio file.
 *
 * @deprecated WP 3.3.0 Use wp_media_upload_handler()
 * @see wp_media_upload_handler()
 *
 * @return null|string
 */
function media_upload_audio() {
	_deprecated_function( __FUNCTION__, '3.3.0', 'wp_media_upload_handler()' );
	return wp_media_upload_handler();
}

/**
 * Handles uploading a video file.
 *
 * @deprecated WP 3.3.0 Use wp_media_upload_handler()
 * @see wp_media_upload_handler()
 *
 * @return null|string
 */
function media_upload_video() {
	_deprecated_function( __FUNCTION__, '3.3.0', 'wp_media_upload_handler()' );
	return wp_media_upload_handler();
}

/**
 * Handles uploading a generic file.
 *
 * @deprecated WP 3.3.0 Use wp_media_upload_handler()
 * @see wp_media_upload_handler()
 *
 * @return null|string
 */
function media_upload_file() {
	_deprecated_function( __FUNCTION__, '3.3.0', 'wp_media_upload_handler()' );
	return wp_media_upload_handler();
}

/**
 * Handles retrieving the insert-from-URL form for an image.
 *
 * @deprecated WP 3.3.0 Use wp_media_insert_url_form()
 * @see wp_media_insert_url_form()
 *
 * @return string
 */
function type_url_form_image() {
	_deprecated_function( __FUNCTION__, '3.3.0', "wp_media_insert_url_form('image')" );
	return wp_media_insert_url_form( 'image' );
}

/**
 * Handles retrieving the insert-from-URL form for an audio file.
 *
 * @deprecated WP 3.3.0 Use wp_media_insert_url_form()
 * @see wp_media_insert_url_form()
 *
 * @return string
 */
function type_url_form_audio() {
	_deprecated_function( __FUNCTION__, '3.3.0', "wp_media_insert_url_form('audio')" );
	return wp_media_insert_url_form( 'audio' );
}

/**
 * Handles retrieving the insert-from-URL form for a video file.
 *
 * @deprecated WP 3.3.0 Use wp_media_insert_url_form()
 * @see wp_media_insert_url_form()
 *
 * @return string
 */
function type_url_form_video() {
	_deprecated_function( __FUNCTION__, '3.3.0', "wp_media_insert_url_form('video')" );
	return wp_media_insert_url_form( 'video' );
}

/**
 * Handles retrieving the insert-from-URL form for a generic file.
 *
 * @deprecated WP 3.3.0 Use wp_media_insert_url_form()
 * @see wp_media_insert_url_form()
 *
 * @return string
 */
function type_url_form_file() {
	_deprecated_function( __FUNCTION__, '3.3.0', "wp_media_insert_url_form('file')" );
	return wp_media_insert_url_form( 'file' );
}

/**
 * Add contextual help text for a page.
 *
 * Creates an 'Overview' help tab.
 *
 * @since WP 2.7.0
 * @deprecated WP 3.3.0 Use WP_Screen::add_help_tab()
 * @see WP_Screen::add_help_tab()
 *
 * @param string    $screen The handle for the screen to add help to. This is usually
 *                          the hook name returned by the `add_*_page()` functions.
 * @param string    $help   The content of an 'Overview' help tab.
 */
function add_contextual_help( $screen, $help ) {
	_deprecated_function( __FUNCTION__, '3.3.0', 'get_current_screen()->add_help_tab()' );

	if ( is_string( $screen ) )
		$screen = convert_to_screen( $screen );

	WP_Screen::add_old_compat_help( $screen, $help );
}

/**
 * Get the allowed themes for the current site.
 *
 * @since WP 3.0.0
 * @deprecated WP 3.4.0 Use wp_get_themes()
 * @see wp_get_themes()
 *
 * @return WP_Theme[] Array of WP_Theme objects keyed by their name.
 */
function get_allowed_themes() {
	_deprecated_function( __FUNCTION__, '3.4.0', "wp_get_themes( array( 'allowed' => true ) )" );

	$themes = wp_get_themes( array( 'allowed' => true ) );

	$wp_themes = array();
	foreach ( $themes as $theme ) {
		$wp_themes[ $theme->get('Name') ] = $theme;
	}

	return $wp_themes;
}

/**
 * Retrieves a list of broken themes.
 *
 * @since WP 1.5.0
 * @deprecated WP 3.4.0 Use wp_get_themes()
 * @see wp_get_themes()
 *
 * @return array
 */
function get_broken_themes() {
	_deprecated_function( __FUNCTION__, '3.4.0', "wp_get_themes( array( 'errors' => true )" );

	$themes = wp_get_themes( array( 'errors' => true ) );
	$broken = array();
	foreach ( $themes as $theme ) {
		$name = $theme->get('Name');
		$broken[ $name ] = array(
			'Name' => $name,
			'Title' => $name,
			'Description' => $theme->errors()->get_error_message(),
		);
	}
	return $broken;
}

/**
 * Retrieves information on the current active theme.
 *
 * @since WP 2.0.0
 * @deprecated WP 3.4.0 Use wp_get_theme()
 * @see wp_get_theme()
 *
 * @return WP_Theme
 */
function current_theme_info() {
	_deprecated_function( __FUNCTION__, '3.4.0', 'wp_get_theme()' );

	return wp_get_theme();
}

/**
 * This was once used to display an 'Insert into Post' button.
 *
 * Now it is deprecated and stubbed.
 *
 * @deprecated WP 3.5.0
 */
function _insert_into_post_button( $type ) {
	_deprecated_function( __FUNCTION__, '3.5.0' );
}

/**
 * This was once used to display a media button.
 *
 * Now it is deprecated and stubbed.
 *
 * @deprecated WP 3.5.0
 */
function _media_button($title, $icon, $type, $id) {
	_deprecated_function( __FUNCTION__, '3.5.0' );
}

/**
 * Gets an existing post and format it for editing.
 *
 * @since WP 2.0.0
 * @deprecated WP 3.5.0 Use get_post()
 * @see get_post()
 *
 * @param int $id
 * @return WP_Post
 */
function get_post_to_edit( $id ) {
	_deprecated_function( __FUNCTION__, '3.5.0', 'get_post()' );

	return get_post( $id, OBJECT, 'edit' );
}

/**
 * Gets the default page information to use.
 *
 * @since WP 2.5.0
 * @deprecated WP 3.5.0 Use get_default_post_to_edit()
 * @see get_default_post_to_edit()
 *
 * @return WP_Post Post object containing all the default post data as attributes
 */
function get_default_page_to_edit() {
	_deprecated_function( __FUNCTION__, '3.5.0', "get_default_post_to_edit( 'page' )" );

	$page = get_default_post_to_edit();
	$page->post_type = 'page';
	return $page;
}

/**
 * This was once used to create a thumbnail from an Image given a maximum side size.
 *
 * @since WP 1.2.0
 * @deprecated WP 3.5.0 Use image_resize()
 * @see image_resize()
 *
 * @param mixed $file Filename of the original image, Or attachment ID.
 * @param int $max_side Maximum length of a single side for the thumbnail.
 * @param mixed $deprecated Never used.
 * @return string Thumbnail path on success, Error string on failure.
 */
function wp_create_thumbnail( $file, $max_side, $deprecated = '' ) {
	_deprecated_function( __FUNCTION__, '3.5.0', 'image_resize()' );
	return apply_filters( 'wp_create_thumbnail', image_resize( $file, $max_side, $max_side ) );
}

/**
 * This was once used to display a meta box for the nav menu theme locations.
 *
 * Deprecated in favor of a 'Manage Locations' tab added to nav menus management screen.
 *
 * @since WP 3.0.0
 * @deprecated WP 3.6.0
 */
function wp_nav_menu_locations_meta_box() {
	_deprecated_function( __FUNCTION__, '3.6.0' );
}

/**
 * This was once used to kick-off the Core Updater.
 *
 * Deprecated in favor of instantiating a Core_Upgrader instance directly,
 * and calling the 'upgrade' method.
 *
 * @since WP 2.7.0
 * @deprecated WP 3.7.0 Use Core_Upgrader
 * @see Core_Upgrader
 */
function wp_update_core($current, $feedback = '') {
	_deprecated_function( __FUNCTION__, '3.7.0', 'new Core_Upgrader();' );

	if ( !empty($feedback) )
		add_filter('update_feedback', $feedback);

	require ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
	$upgrader = new Core_Upgrader();
	return $upgrader->upgrade($current);

}

/**
 * This was once used to kick-off the Plugin Updater.
 *
 * Deprecated in favor of instantiating a Plugin_Upgrader instance directly,
 * and calling the 'upgrade' method.
 * Unused since 2.8.0.
 *
 * @since WP 2.5.0
 * @deprecated WP 3.7.0 Use Plugin_Upgrader
 * @see Plugin_Upgrader
 */
function wp_update_plugin($plugin, $feedback = '') {
	_deprecated_function( __FUNCTION__, '3.7.0', 'new Plugin_Upgrader();' );

	if ( !empty($feedback) )
		add_filter('update_feedback', $feedback);

	require ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
	$upgrader = new Plugin_Upgrader();
	return $upgrader->upgrade($plugin);
}

/**
 * This was once used to kick-off the Theme Updater.
 *
 * Deprecated in favor of instantiating a Theme_Upgrader instance directly,
 * and calling the 'upgrade' method.
 * Unused since 2.8.0.
 *
 * @since WP 2.7.0
 * @deprecated WP 3.7.0 Use Theme_Upgrader
 * @see Theme_Upgrader
 */
function wp_update_theme($theme, $feedback = '') {
	_deprecated_function( __FUNCTION__, '3.7.0', 'new Theme_Upgrader();' );

	if ( !empty($feedback) )
		add_filter('update_feedback', $feedback);

	require ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
	$upgrader = new Theme_Upgrader();
	return $upgrader->upgrade($theme);
}

/**
 * This was once used to display attachment links. Now it is deprecated and stubbed.
 *
 * @since WP 2.0.0
 * @deprecated WP 3.7.0
 *
 * @param int|bool $id
 */
function the_attachment_links( $id = false ) {
	_deprecated_function( __FUNCTION__, '3.7.0' );
}

/**
 * Displays a screen icon.
 *
 * @since WP 2.7.0
 * @deprecated WP 3.8.0
 */
function screen_icon() {
	_deprecated_function( __FUNCTION__, '3.8.0' );
	echo get_screen_icon();
}

/**
 * Retrieves the screen icon (no longer used in 3.8+).
 *
 * @since WP 3.2.0
 * @deprecated WP 3.8.0
 *
 * @return string An HTML comment explaining that icons are no longer used.
 */
function get_screen_icon() {
	_deprecated_function( __FUNCTION__, '3.8.0' );
	return '<!-- Screen icons are no longer used as of Retraceur 3.8. -->';
}

/**
 * Deprecated dashboard widget controls.
 *
 * @since WP 2.5.0
 * @deprecated WP 3.8.0
 */
function wp_dashboard_incoming_links_output() {}

/**
 * Deprecated dashboard secondary output.
 *
 * @deprecated WP 3.8.0
 */
function wp_dashboard_secondary_output() {}

/**
 * Deprecated dashboard widget controls.
 *
 * @since WP 2.7.0
 * @deprecated WP 3.8.0
 */
function wp_dashboard_incoming_links() {}

/**
 * Deprecated dashboard incoming links control.
 *
 * @deprecated WP 3.8.0
 */
function wp_dashboard_incoming_links_control() {}

/**
 * Deprecated dashboard plugins control.
 *
 * @deprecated WP 3.8.0
 */
function wp_dashboard_plugins() {}

/**
 * Deprecated dashboard primary control.
 *
 * @deprecated WP 3.8.0
 */
function wp_dashboard_primary_control() {}

/**
 * Deprecated dashboard recent comments control.
 *
 * @deprecated WP 3.8.0
 */
function wp_dashboard_recent_comments_control() {}

/**
 * Deprecated dashboard secondary section.
 *
 * @deprecated WP 3.8.0
 */
function wp_dashboard_secondary() {}

/**
 * Deprecated dashboard secondary control.
 *
 * @deprecated WP 3.8.0
 */
function wp_dashboard_secondary_control() {}

/**
 * Display plugins text for the Retraceur news widget.
 *
 * @since WP 2.5.0
 * @deprecated WP 4.8.0
 *
 * @param string $rss  The RSS feed URL.
 * @param array  $args Array of arguments for this RSS feed.
 */
function wp_dashboard_plugins_output( $rss, $args = array() ) {
	_deprecated_function( __FUNCTION__, '4.8.0' );

	// Plugin feeds plus link to install them.
	$popular = fetch_feed( $args['url']['popular'] );

	if ( false === $plugin_slugs = get_transient( 'plugin_slugs' ) ) {
		$plugin_slugs = array_keys( get_plugins() );
		set_transient( 'plugin_slugs', $plugin_slugs, DAY_IN_SECONDS );
	}

	echo '<ul>';

	foreach ( array( $popular ) as $feed ) {
		if ( is_wp_error( $feed ) || ! $feed->get_item_quantity() )
			continue;

		$items = $feed->get_items(0, 5);

		// Pick a random, non-installed plugin.
		while ( true ) {
			// Abort this foreach loop iteration if there's no plugins left of this type.
			if ( 0 === count($items) )
				continue 2;

			$item_key = array_rand($items);
			$item = $items[$item_key];

			list($link, $frag) = explode( '#', $item->get_link() );

			$link = esc_url($link);
			if ( preg_match( '|/([^/]+?)/?$|', $link, $matches ) )
				$slug = $matches[1];
			else {
				unset( $items[$item_key] );
				continue;
			}

			// Is this random plugin's slug already installed? If so, try again.
			reset( $plugin_slugs );
			foreach ( $plugin_slugs as $plugin_slug ) {
				if ( str_starts_with( $plugin_slug, $slug ) ) {
					unset( $items[$item_key] );
					continue 2;
				}
			}

			// If we get to this point, then the random plugin isn't installed and we can stop the while().
			break;
		}

		// Eliminate some common badly formed plugin descriptions.
		while ( ( null !== $item_key = array_rand($items) ) && str_contains( $items[$item_key]->get_description(), 'Plugin Name:' ) )
			unset($items[$item_key]);

		if ( !isset($items[$item_key]) )
			continue;

		$raw_title = $item->get_title();

		$ilink = wp_nonce_url('plugin-install.php?tab=plugin-information&plugin=' . $slug, 'install-plugin_' . $slug) . '&amp;TB_iframe=true&amp;width=600&amp;height=800';
		echo '<li class="dashboard-news-plugin"><span>' . __( 'Popular Plugin' ) . ':</span> ' . esc_html( $raw_title ) .
			'&nbsp;<a href="' . $ilink . '" class="thickbox open-plugin-details-modal" aria-label="' .
			/* translators: %s: Plugin name. */
			esc_attr( sprintf( _x( 'Install %s', 'plugin' ), $raw_title ) ) . '">(' . __( 'Install' ) . ')</a></li>';

		$feed->__destruct();
		unset( $feed );
	}

	echo '</ul>';
}

/**
 * This was once used to move child posts to a new parent.
 *
 * @since WP 2.3.0
 * @deprecated WP 3.9.0
 * @access private
 *
 * @param int $old_ID
 * @param int $new_ID
 */
function _relocate_children( $old_ID, $new_ID ) {
	_deprecated_function( __FUNCTION__, '3.9.0' );
}

/**
 * Add a top-level menu page in the 'objects' section.
 *
 * This function takes a capability which will be used to determine whether
 * or not a page is included in the menu.
 *
 * The function which is hooked in to handle the output of the page must check
 * that the user has the required capability as well.
 *
 * @since WP 2.7.0
 *
 * @deprecated WP 4.5.0 Use add_menu_page()
 * @see add_menu_page()
 * @global int $_wp_last_object_menu
 *
 * @param string   $page_title The text to be displayed in the title tags of the page when the menu is selected.
 * @param string   $menu_title The text to be used for the menu.
 * @param string   $capability The capability required for this menu to be displayed to the user.
 * @param string   $menu_slug  The slug name to refer to this menu by (should be unique for this menu).
 * @param callable $callback   Optional. The function to be called to output the content for this page.
 * @param string   $icon_url   Optional. The URL to the icon to be used for this menu.
 * @return string The resulting page's hook_suffix.
 */
function add_object_page( $page_title, $menu_title, $capability, $menu_slug, $callback = '', $icon_url = '') {
	_deprecated_function( __FUNCTION__, '4.5.0', 'add_menu_page()' );

	global $_wp_last_object_menu;

	$_wp_last_object_menu++;

	return add_menu_page($page_title, $menu_title, $capability, $menu_slug, $callback, $icon_url, $_wp_last_object_menu);
}

/**
 * Add a top-level menu page in the 'utility' section.
 *
 * This function takes a capability which will be used to determine whether
 * or not a page is included in the menu.
 *
 * The function which is hooked in to handle the output of the page must check
 * that the user has the required capability as well.
 *
 * @since WP 2.7.0
 *
 * @deprecated WP 4.5.0 Use add_menu_page()
 * @see add_menu_page()
 * @global int $_wp_last_utility_menu
 *
 * @param string   $page_title The text to be displayed in the title tags of the page when the menu is selected.
 * @param string   $menu_title The text to be used for the menu.
 * @param string   $capability The capability required for this menu to be displayed to the user.
 * @param string   $menu_slug  The slug name to refer to this menu by (should be unique for this menu).
 * @param callable $callback   Optional. The function to be called to output the content for this page.
 * @param string   $icon_url   Optional. The URL to the icon to be used for this menu.
 * @return string The resulting page's hook_suffix.
 */
function add_utility_page( $page_title, $menu_title, $capability, $menu_slug, $callback = '', $icon_url = '') {
	_deprecated_function( __FUNCTION__, '4.5.0', 'add_menu_page()' );

	global $_wp_last_utility_menu;

	$_wp_last_utility_menu++;

	return add_menu_page($page_title, $menu_title, $capability, $menu_slug, $callback, $icon_url, $_wp_last_utility_menu);
}

/**
 * Disables autocomplete on the 'post' form (Add/Edit Post screens) for WebKit browsers,
 * as they disregard the autocomplete setting on the editor textarea. That can break the editor
 * when the user navigates to it with the browser's Back button. See #28037
 *
 * Replaced with wp_page_reload_on_back_button_js() that also fixes this problem.
 *
 * @since WP 4.0.0
 * @deprecated WP 4.6.0
 *
 * @global bool $is_safari
 * @global bool $is_chrome
 */
function post_form_autocomplete_off() {
	global $is_safari, $is_chrome;

	_deprecated_function( __FUNCTION__, '4.6.0' );

	if ( $is_safari || $is_chrome ) {
		echo ' autocomplete="off"';
	}
}

/**
 * Display JavaScript on the page.
 *
 * @since WP 3.5.0
 * @deprecated WP 4.9.0
 */
function options_permalink_add_js() {
	?>
	<script type="text/javascript">
		jQuery( function() {
			jQuery('.permalink-structure input:radio').change(function() {
				if ( 'custom' == this.value )
					return;
				jQuery('#permalink_structure').val( this.value );
			});
			jQuery( '#permalink_structure' ).on( 'click input', function() {
				jQuery( '#custom_selection' ).prop( 'checked', true );
			});
		} );
	</script>
	<?php
}

/**
 * Previous class for list table for privacy data export requests.
 *
 * @since WP 4.9.6
 * @deprecated WP 5.3.0
 */
class WP_Privacy_Data_Export_Requests_Table extends WP_Privacy_Data_Export_Requests_List_Table {
	function __construct( $args ) {
		_deprecated_function( __CLASS__, '5.3.0', 'WP_Privacy_Data_Export_Requests_List_Table' );

		if ( ! isset( $args['screen'] ) || $args['screen'] === 'export_personal_data' ) {
			$args['screen'] = 'export-personal-data';
		}

		parent::__construct( $args );
	}
}

/**
 * Previous class for list table for privacy data erasure requests.
 *
 * @since WP 4.9.6
 * @deprecated WP 5.3.0
 */
class WP_Privacy_Data_Removal_Requests_Table extends WP_Privacy_Data_Removal_Requests_List_Table {
	function __construct( $args ) {
		_deprecated_function( __CLASS__, '5.3.0', 'WP_Privacy_Data_Removal_Requests_List_Table' );

		if ( ! isset( $args['screen'] ) || $args['screen'] === 'remove_personal_data' ) {
			$args['screen'] = 'erase-personal-data';
		}

		parent::__construct( $args );
	}
}

/**
 * Was used to add options for the privacy requests screens before they were separate files.
 *
 * @since WP 4.9.8
 * @access private
 * @deprecated WP 5.3.0
 */
function _wp_privacy_requests_screen_options() {
	_deprecated_function( __FUNCTION__, '5.3.0' );
}

/**
 * Was used to filter input from media_upload_form_handler() and to assign a default
 * post_title from the file name if none supplied.
 *
 * @since WP 2.5.0
 * @deprecated WP 6.0.0
 *
 * @param array $post       The WP_Post attachment object converted to an array.
 * @param array $attachment An array of attachment metadata.
 * @return array Attachment post object converted to an array.
 */
function image_attachment_fields_to_save( $post, $attachment ) {
	_deprecated_function( __FUNCTION__, '6.0.0' );

	return $post;
}

/**
 * 'Retraceur Events and News' dashboard widget.
 *
 * @since 2.7.0
 * @since 4.8.0 Removed popular plugins feed.
 * @deprecated 1.0.0 Retraceur fork.
 */
function wp_dashboard_primary() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Displays the Retraceur events and news feeds.
 *
 * @since 3.8.0
 * @since 4.8.0 Removed popular plugins feed.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string $widget_id Widget ID.
 * @param array  $feeds     Array of RSS feeds.
 */
function wp_dashboard_primary_output( $widget_id, $feeds ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Displays the browser update nag.
 *
 * @since 3.2.0
 * @since 5.8.0 Added a special message for Internet Explorer users.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @global bool $is_IE
 */
function wp_dashboard_browser_nag() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Adds an additional class to the browser nag if the current version is insecure.
 *
 * @since 3.2.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string[] $classes Array of meta box classes.
 * @return string[] Modified array of meta box classes.
 */
function dashboard_browser_nag_class( $classes ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Checks if the user needs a browser update.
 *
 * @since 3.2.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @return array|false Array of browser data on success, false on failure.
 */
function wp_check_browser_version() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Verifies the contents of a file against its ED25519 signature.
 *
 * @since 5.2.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string       $filename            The file to validate.
 * @param string|array $signatures          A Signature provided for the file.
 * @param string|false $filename_for_errors Optional. A friendly filename for errors.
 * @return bool|WP_Error True on success, false if verification not attempted,
 *                       or WP_Error describing an error condition.
 */
function verify_file_signature( $filename, $signatures, $filename_for_errors = false ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Retrieves the list of signing keys trusted by WP.
 *
 * @since 5.2.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @return string[] Array of base64-encoded signing keys.
 */
function wp_trusted_keys() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Returns the content for the help sidebar on the Edit Site screens.
 *
 * @since WP 4.9.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @return string Help sidebar content.
 */
function get_site_screen_help_sidebar_content() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return '';
}

/**
 * Shows a username form for the favorites page.
 *
 * @since WP 3.5.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function install_plugins_favorites_form() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Display list of the available widgets.
 *
 * @since WP 2.5.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function wp_list_widgets() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Callback to sort array by a 'name' key.
 *
 * @since WP 3.1.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @access private
 *
 * @param array $a First array.
 * @param array $b Second array.
 */
function _sort_name_callback( $a, $b ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Show the widgets and their settings for a sidebar.
 * Used in the admin widget config screen.
 *
 * @since WP 2.5.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string $sidebar      Sidebar ID.
 * @param string $sidebar_name Optional. Sidebar name. Default empty.
 */
function wp_list_widget_controls( $sidebar, $sidebar_name = '' ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Retrieves the widget control arguments.
 *
 * @since WP 2.5.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param array $params
 */
function wp_list_widget_controls_dynamic_sidebar( $params ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string $id_base
 */
function next_widget_id_number( $id_base ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Meta widget used to display the control form for a widget.
 *
 * Called from dynamic_sidebar().
 *
 * @since WP 2.5.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param array $sidebar_args
 * @return array
 */
function wp_widget_control( $sidebar_args ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * @deprecated 1.0.0 Retraceur fork.
 * @param string $classes
 */
function wp_widgets_access_body_class( $classes ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Disables the Automattic widgets plugin, which was merged into core.
 *
 * @since WP 2.2.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function maybe_disable_automattic_widgets() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Outputs a link category checklist element.
 *
 * @since WP 2.5.1
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int $link_id Optional. The link ID. Default 0.
 */
function wp_link_category_checklist( $link_id = 0 ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Displays link create form fields.
 *
 * @since WP 2.7.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param object $link Current link object.
 */
function link_submit_meta_box( $link ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}



/**
 * Displays advanced link options form fields.
 *
 * @since WP 2.6.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param object $link Current link object.
 */
function link_advanced_meta_box( $link ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Displays link categories form fields.
 *
 * @since WP 2.6.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param object $link Current link object.
 */
function link_categories_meta_box( $link ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Displays form fields for changing link target.
 *
 * @since WP 2.6.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param object $link Current link object.
 */
function link_target_meta_box( $link ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Displays 'checked' checkboxes attribute for XFN microformat options.
 *
 * @since WP 1.0.1
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string $xfn_relationship XFN relationship category. Possible values are:
 *                                 'friendship', 'physical', 'professional',
 *                                 'geographical', 'family', 'romantic', 'identity'.
 * @param string $xfn_value        Optional. The XFN value to mark as checked
 *                                 if it matches the current link's relationship.
 *                                 Default empty string.
 * @param mixed  $deprecated       Deprecated. Not used.
 */
function xfn_check( $xfn_relationship, $xfn_value = '', $deprecated = '' ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Displays XFN form fields.
 *
 * @since WP 2.6.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param object $link Current link object.
 */
function link_xfn_meta_box( $link ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Adds a link using values provided in $_POST.
 *
 * @since WP 2.0.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function add_link() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Updates or inserts a link using values provided in $_POST.
 *
 * @since WP 2.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int $link_id Optional. ID of the link to edit. Default 0.
 * @return int|WP_Error Value 0 or WP_Error on failure. The link ID on success.
 */
function edit_link( $link_id = 0 ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Retrieves the default link for editing.
 *
 * @since WP 2.0.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function get_default_link_to_edit() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Deletes a specified link from the database.
 *
 * @since WP 2.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int $link_id ID of the link to delete.
 */
function wp_delete_link( $link_id ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Fires before a link is deleted.
	 *
	 * @since WP 2.0.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param int $link_id ID of the link to delete.
	 */
	do_action_deprecated(
		'delete_link',
		array( 0 ),
		'1.0.0',
		'',
		__( 'The Link/bookmark manager feature is not available in Retraceur.' )
	);

	/**
	 * Fires after a link has been deleted.
	 *
	 * @since WP 2.2.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param int $link_id ID of the deleted link.
	 */
	do_action_deprecated(
		'deleted_link',
		array( 0 ),
		'1.0.0',
		'',
		__( 'The Link/bookmark manager feature is not available in Retraceur.' )
	);
}

/**
 * Retrieves the link category IDs associated with the link specified.
 *
 * @since WP 2.1.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int $link_id Link ID to look up.
 */
function wp_get_link_cats( $link_id = 0 ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Retrieves link data based on its ID.
 *
 * @since WP 2.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int|stdClass $link Link ID or object to retrieve.
 */
function get_link_to_edit( $link ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Inserts a link into the database, or updates an existing link.
 *
 * Runs all the necessary sanitizing, provides default values if arguments are missing,
 * and finally saves the link.
 *
 * @since WP 2.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param array $linkdata {
 *     Elements that make up the link to insert.
 *
 *     @type int    $link_id          Optional. The ID of the existing link if updating.
 *     @type string $link_url         The URL the link points to.
 *     @type string $link_name        The title of the link.
 *     @type string $link_image       Optional. A URL of an image.
 *     @type string $link_target      Optional. The target element for the anchor tag.
 *     @type string $link_description Optional. A short description of the link.
 *     @type string $link_visible     Optional. 'Y' means visible, anything else means not.
 *     @type int    $link_owner       Optional. A user ID.
 *     @type int    $link_rating      Optional. A rating for the link.
 *     @type string $link_rel         Optional. A relationship of the link to you.
 *     @type string $link_notes       Optional. An extended description of or notes on the link.
 *     @type string $link_rss         Optional. A URL of an associated RSS feed.
 *     @type int    $link_category    Optional. The term ID of the link category.
 *                                    If empty, uses default link category.
 * }
 * @param bool  $wp_error Optional. Whether to return a WP_Error object on failure. Default false.
 */
function wp_insert_link( $linkdata, $wp_error = false ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Fires after a link was updated in the database.
	 *
	 * @since WP 2.0.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param int $link_id ID of the link that was updated.
	 */
	do_action_deprecated(
		'edit_link',
		array( 0 ),
		'1.0.0',
		'',
		__( 'The Link/bookmark manager feature is not available in Retraceur.' )
	);

	/**
	 * Fires after a link was added to the database.
	 *
	 * @since WP 2.0.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param int $link_id ID of the link that was added.
	 */
	do_action_deprecated(
		'add_link',
		array( 0 ),
		'1.0.0',
		'',
		__( 'The Link/bookmark manager feature is not available in Retraceur.' )
	);
}

/**
 * Updates link with the specified link categories.
 *
 * @since WP 2.1.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int   $link_id         ID of the link to update.
 * @param int[] $link_categories Array of link category IDs to add the link to.
 */
function wp_set_link_cats( $link_id = 0, $link_categories = array() ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Updates a link in the database.
 *
 * @since WP 2.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param array $linkdata Link data to update. See wp_insert_link() for accepted arguments.
 * @return int|WP_Error Value 0 or WP_Error on failure. The updated link ID on success.
 */
function wp_update_link( $linkdata ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Outputs the 'disabled' message for the Retraceur Link Manager.
 *
 * @since WP 3.5.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @access private
 *
 * @global string $pagenow The filename of the current screen.
 */
function wp_link_manager_disabled_message() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Retrieves the contributor credits.
 *
 * @since WP 3.2.0
 * @since WP 5.6.0 Added the `$version` and `$locale` parameters.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string $version WP version. Defaults to the current version.
 * @param string $locale  WP locale. Defaults to the current user's locale.
 * @return array|false A list of all of the contributors, or false on error.
 */
function wp_credits( $version = '', $locale = '' ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return false;
}

/**
 * Displays a list of contributors for a given group.
 *
 * @since WP 5.3.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param array  $credits The credits groups returned from the API.
 * @param string $slug    The current group to display.
 */
function wp_credits_section_list( $credits = array(), $slug = '' ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Displays the title for a given group of contributors.
 *
 * @since WP 5.3.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param array $group_data The current contributor group.
 */
function wp_credits_section_title( $group_data = array() ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Retrieves the link to a contributor's profile page.
 *
 * @access private
 * @since WP 3.2.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string $display_name  The contributor's display name (passed by reference).
 * @param string $username      The contributor's username.
 * @param string $profiles      URL to the contributor's profile page.
 */
function _wp_credits_add_profile_link( &$display_name, $username, $profiles ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Retrieves the link to an external library used in WP.
 *
 * @access private
 * @since WP 3.2.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string $data External library data (passed by reference).
 */
function _wp_credits_build_object_link( &$data ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Create the roles for WP 2.0
 *
 * @since WP 2.0.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function populate_roles_160() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Create and modify WP roles for WP 2.1.
 *
 * @since WP 2.1.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function populate_roles_210() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Create and modify WP roles for WP 2.3.
 *
 * @since WP 2.3.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function populate_roles_230() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Create and modify WP roles for WP 2.5.
 *
 * @since WP 2.5.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function populate_roles_250() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Create and modify WP roles for WP 2.6.
 *
 * @since WP 2.6.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function populate_roles_260() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Create and modify WP roles for WP 2.7.
 *
 * @since WP 2.7.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function populate_roles_270() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Create and modify WP roles for WP 2.8.
 *
 * @since WP 2.8.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function populate_roles_280() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Create and modify WP roles for WP 3.0.
 *
 * @since WP 3.0.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function populate_roles_300() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Execute changes made in WP 1.0.
 *
 * @ignore
 * @since WP 1.0.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function upgrade_100() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Execute changes made in WP 1.0.1.
 *
 * @ignore
 * @since WP 1.0.1
 * @deprecated 1.0.0 Retraceur fork.
 */
function upgrade_101() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}


/**
 * Execute changes made in WP 1.2.
 *
 * @ignore
 * @since WP 1.2.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function upgrade_110() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Execute changes made in WP 1.5.
 *
 * @ignore
 * @since WP 1.5.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function upgrade_130() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Execute changes made in WP 2.0.
 *
 * @ignore
 * @since WP 2.0.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function upgrade_160() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Execute changes made in WP 2.1.
 *
 * @ignore
 * @since WP 2.1.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function upgrade_210() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Execute changes made in WP 2.3.
 *
 * @ignore
 * @since WP 2.3.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function upgrade_230() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Remove old options from the database.
 *
 * @ignore
 * @since WP 2.3.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function upgrade_230_options_table() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Remove old categories, link2cat, and post2cat database tables.
 *
 * @ignore
 * @since WP 2.3.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function upgrade_230_old_tables() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Upgrade old slugs made in version 2.2.
 *
 * @ignore
 * @since WP 2.2.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function upgrade_old_slugs() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Execute changes made in WP 2.5.0.
 *
 * @ignore
 * @since WP 2.5.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function upgrade_250() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Execute changes made in WP 2.5.2.
 *
 * @ignore
 * @since WP 2.5.2
 * @deprecated 1.0.0 Retraceur fork.
 */
function upgrade_252() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Execute changes made in WP 2.6.
 *
 * @ignore
 * @since WP 2.6.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function upgrade_260() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Execute changes made in WP 2.7.
 *
 * @ignore
 * @since WP 2.7.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function upgrade_270() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Execute changes made in WP 2.8.
 *
 * @ignore
 * @since WP 2.8.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function upgrade_280() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Execute changes made in WP 2.9.
 *
 * @ignore
 * @since WP 2.9.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function upgrade_290() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Execute changes made in WP 3.0.
 *
 * @ignore
 * @since WP 3.0.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function upgrade_300() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Execute changes made in WP 3.3.
 *
 * @ignore
 * @since WP 3.3.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function upgrade_330() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Execute changes made in WP 3.4.
 *
 * @ignore
 * @since WP 3.4.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function upgrade_340() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Execute changes made in WP 3.5.
 *
 * @ignore
 * @since WP 3.5.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function upgrade_350() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Execute changes made in WP 3.7.
 *
 * @ignore
 * @since WP 3.7.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function upgrade_370() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Execute changes made in WP 3.7.2.
 *
 * @ignore
 * @since WP 3.7.2
 * @deprecated 1.0.0 Retraceur fork.
 */
function upgrade_372() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Execute changes made in WP 3.8.0.
 *
 * @ignore
 * @since WP 3.8.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function upgrade_380() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Execute changes made in WP 4.0.0.
 *
 * @ignore
 * @since WP 4.0.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function upgrade_400() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Execute changes made in WP 4.2.0.
 *
 * @ignore
 * @since WP 4.2.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function upgrade_420() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Executes changes made in WP 4.3.0.
 *
 * @ignore
 * @since WP 4.3.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function upgrade_430() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Executes comments changes made in WP 4.3.0.
 *
 * @ignore
 * @since WP 4.3.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function upgrade_430_fix_comments() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Executes changes made in WP 4.3.1.
 *
 * @ignore
 * @since WP 4.3.1
 * @deprecated 1.0.0 Retraceur fork.
 */
function upgrade_431() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Executes changes made in WP 4.4.0.
 *
 * @ignore
 * @since WP 4.4.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function upgrade_440() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Executes changes made in WP 4.5.0.
 *
 * @ignore
 * @since WP 4.5.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function upgrade_450() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Executes changes made in WP 4.6.0.
 *
 * @ignore
 * @since WP 4.6.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function upgrade_460() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Executes changes made in WP 5.0.0.
 *
 * @ignore
 * @since WP 5.0.0
 * @deprecated WP 5.1.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function upgrade_500() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Executes changes made in WP 5.1.0.
 *
 * @ignore
 * @since WP 5.1.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function upgrade_510() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Executes changes made in WP 5.3.0.
 *
 * @ignore
 * @since WP 5.3.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function upgrade_530() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Executes changes made in WP 5.5.0.
 *
 * @ignore
 * @since WP 5.5.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function upgrade_550() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Executes changes made in WP 5.6.0.
 *
 * @ignore
 * @since WP 5.6.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function upgrade_560() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Executes changes made in WP 5.9.0.
 *
 * @ignore
 * @since WP 5.9.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function upgrade_590() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Executes changes made in WP 6.0.0.
 *
 * @ignore
 * @since WP 6.0.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function upgrade_600() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Executes changes made in WP 6.3.0.
 *
 * @ignore
 * @since WP 6.3.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function upgrade_630() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Executes changes made in WP 6.4.0.
 *
 * @ignore
 * @since WP 6.4.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function upgrade_640() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Executes changes made in WP 6.5.0.
 *
 * @ignore
 * @since WP 6.5.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function upgrade_650() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}



/**
 * Executes changes made in WP 6.7.0.
 *
 * @ignore
 * @since WP 6.7.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @global int  $wp_current_db_version The old (current) database version.
 */
function upgrade_670() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Retrieve all options as it was for 1.2.
 *
 * @since WP 1.2.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function get_alloptions_110() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Adds custom arguments to some of the meta box object types.
 *
 * @since WP 3.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @access private
 *
 * @param object $data_object The post type or taxonomy meta-object.
 */
function _wp_nav_menu_meta_box_object( $data_object = null ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Handles adding a menu item via AJAX.
 *
 * @since WP 3.1.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function wp_ajax_add_menu_item() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Handles for retrieving menu meta boxes via AJAX.
 *
 * @since WP 3.1.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function wp_ajax_menu_get_metabox() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Handles saving menu locations via AJAX.
 *
 * @since WP 3.1.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function wp_ajax_menu_locations_save() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Handles menu quick searching via AJAX.
 *
 * @since WP 3.1.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function wp_ajax_menu_quick_search() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Prints the appropriate response to a menu quick search.
 *
 * @since WP 3.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param array $request The unsanitized request values.
 */
function _wp_ajax_menu_quick_search( $request = array() ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string $classes
 */
function wp_nav_menu_max_depth( $classes ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Register nav menu meta boxes and advanced menu items.
 *
 * @since WP 3.0.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function wp_nav_menu_setup() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Creates meta boxes for any post type menu item..
 *
 * @since WP 3.0.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function wp_nav_menu_post_type_meta_boxes() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters whether a menu items meta box will be added for the current
	 * object type.
	 *
	 * If a falsey value is returned instead of an object, the menu items
	 * meta box for the current meta box object will not be added.
	 *
	 * @since WP 3.0.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param WP_Post_Type|false $post_type The current object to add a menu items
	 *                                      meta box for.
	 */
	apply_filters_deprecated(
		'nav_menu_meta_box_object',
		array( false ),
		'1.0.0',
		'',
		__( 'WP Nav Menus feature is not supported in Retraceur.' )
	);
}

/**
 * Displays a meta box for the custom links menu item.
 *
 * @since WP 3.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @global int        $_nav_menu_placeholder
 * @global int|string $nav_menu_selected_id
 */
function wp_nav_menu_item_link_meta_box() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Displays a meta box for a post type menu item.
 *
 * @since WP 3.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string $data_object Not used.
 * @param array  $box {
 *     Post type menu item meta box arguments.
 *
 *     @type string       $id       Meta box 'id' attribute.
 *     @type string       $title    Meta box title.
 *     @type callable     $callback Meta box display callback.
 *     @type WP_Post_Type $args     Extra meta box arguments (the post type object for this meta box).
 * }
 */
function wp_nav_menu_item_post_type_meta_box( $data_object, $box ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Check whether to disable the Menu Locations meta box submit button and inputs.
 *
 * @since WP 3.6.0
 * @since WP 5.3.1 The `$display` parameter was added.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @global bool $one_theme_location_no_menus to determine if no menus exist
 *
 * @param int|string $nav_menu_selected_id ID, name, or slug of the currently selected menu.
 * @param bool       $display              Whether to display or just return the string.
 * @return string|false Disabled attribute if at least one menu exists, false if not.
 */
function wp_nav_menu_disabled_check( $nav_menu_selected_id, $display = true ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return false;
}

/**
 * Limit the amount of meta boxes to pages, posts, links, and categories for first time users.
 *
 * @since WP 3.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @global array $wp_meta_boxes Global meta box state.
 */
function wp_initial_nav_menu_meta_boxes() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Creates meta boxes for any taxonomy menu item.
 *
 * @since WP 3.0.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function wp_nav_menu_taxonomy_meta_boxes() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Displays a meta box for a taxonomy menu item.
 *
 * @since WP 3.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string $data_object Not used.
 * @param array  $box {
 *     Taxonomy menu item meta box arguments.
 *
 *     @type string   $id       Meta box 'id' attribute.
 *     @type string   $title    Meta box title.
 *     @type callable $callback Meta box display callback.
 *     @type object   $args     Extra meta box arguments (the taxonomy object for this meta box).
 * }
 */
function wp_nav_menu_item_taxonomy_meta_box( $data_object, $box ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Save posted nav menu item data.
 *
 * @since WP 3.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int     $menu_id   The menu ID for which to save this item. Value of 0 makes a draft, orphaned menu item. Default 0.
 * @param array[] $menu_data The unsanitized POSTed menu item data.
 * @return int[] The database IDs of the items saved
 */
function wp_save_nav_menu_items( $menu_id = 0, $menu_data = array() ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return array();
}

/**
 * Returns the menu formatted to edit.
 *
 * @since WP 3.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int $menu_id Optional. The ID of the menu to format. Default 0.
 * @return string|WP_Error The menu formatted to edit or error object on failure.
 */
function wp_get_nav_menu_to_edit( $menu_id = 0 ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the Walker class used when adding nav menu items.
	 *
	 * @since WP 3.0.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string $class   The walker class to use. Default 'Walker_Nav_Menu_Edit'.
	 * @param int    $menu_id ID of the menu being rendered.
	 */
	apply_filters_deprecated(
		'wp_edit_nav_menu_walker',
		array( 'Walker_Nav_Menu_Edit', 0 ),
		'1.0.0',
		'',
		__( 'WP Nav Menus feature is not supported in Retraceur.' )
	);
}

/**
 * Returns the columns for the nav menus page.
 *
 * @since WP 3.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @return string[] Array of column titles keyed by their column name.
 */
function wp_nav_menu_manage_columns() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return array();
}

/**
 * Deletes orphaned draft menu items
 *
 * @since WP 3.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @access private
 */
function _wp_delete_orphaned_draft_menu_items() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Saves nav menu items.
 *
 * @since WP 3.6.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int|string $nav_menu_selected_id    ID, slug, or name of the currently-selected menu.
 * @param string     $nav_menu_selected_title Title of the currently-selected menu.
 * @return string[] The menu updated messages.
 */
function wp_nav_menu_update_menu_items( $nav_menu_selected_id, $nav_menu_selected_title ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return array();
}

/**
 * If a JSON blob of navigation menu data is in POST data, expand it and inject
 * it into `$_POST` to avoid PHP `max_input_vars` limitations. See #14134.
 *
 * @ignore
 * @since WP 4.5.3
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @access private
 */
function _wp_expand_nav_menu_post_data() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Handles saving the user's username via AJAX.
 *
 * @since WP 4.4.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function wp_ajax_save_wporg_username() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Show Comments section.
 *
 * @since WP 3.8.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int $total_items Optional. Number of comments to query. Default 5.
 * @return bool False if no comments were found. True otherwise.
 */
function wp_dashboard_recent_comments( $total_items = 5 ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return false;
}

/**
 * Outputs a row for the Recent Comments widget.
 *
 * @access private
 * @since WP 2.7.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param WP_Comment $comment   The current comment.
 * @param bool       $show_date Optional. Whether to display the date.
 */
function _wp_dashboard_recent_comments_row( &$comment, $show_date = true ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Handles replying to a comment via AJAX.
 *
 * @since WP 3.1.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string $action Action to perform.
 */
function wp_ajax_replyto_comment( $action ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	wp_die( __( 'Retraceur does not support WP Comments.' ) );
}

/**
 * Handles editing a comment via AJAX.
 *
 * @since WP 3.1.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function wp_ajax_edit_comment() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	wp_die( __( 'Retraceur does not support WP Comments.' ) );
}

/**
 * Handles getting comments via AJAX.
 *
 * @since WP 3.1.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string $action Action to perform.
 */
function wp_ajax_get_comments( $action ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	wp_die( __( 'Retraceur does not support WP Comments.' ) );
}

/**
 * Sends back current comment total and new page links if they need to be updated.
 *
 * Contrary to normal success Ajax response ("1"), die with time() on success.
 *
 * @since WP 2.7.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @access private
 *
 * @param int $comment_id
 * @param int $delta
 */
function _wp_ajax_delete_comment_response( $comment_id, $delta = -1 ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	wp_die( __( 'Retraceur does not support WP Comments.' ) );
}

/**
 * Handles deleting a comment via AJAX.
 *
 * @since WP 3.1.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function wp_ajax_delete_comment() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	wp_die( __( 'Retraceur does not support WP Comments.' ) );
}

/**
 * Handles dimming a comment via AJAX.
 *
 * @since WP 3.1.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function wp_ajax_dim_comment() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	wp_die( __( 'Retraceur does not support WP Comments.' ) );
}

/**
 * Enqueues comment shortcuts jQuery script.
 *
 * @since WP 2.7.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function enqueue_comment_hotkeys_js() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Displays error message at bottom of comments.
 *
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string $msg Error Message. Assumed to contain HTML and be sanitized.
 */
function comment_footer_die( $msg ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	die;
}

/**
 * Displays comments for post table header
 *
 * @since WP 3.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param array $result Table header rows.
 * @return array
 */
function post_comment_meta_box_thead( $result ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return array();
}

/**
 * Displays trackback links form fields.
 *
 * @since WP 2.6.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param WP_Post $post Current post object.
 */
function post_trackback_meta_box( $post ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Displays the Quick Draft widget.
 *
 * @since WP 3.8.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @global int $post_ID
 *
 * @param string|false $error_msg Optional. Error message. Default false.
 */
function wp_dashboard_quick_press( $error_msg = false ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Show recent drafts of the user on the dashboard.
 *
 * @since WP 2.7.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param WP_Post[]|false $drafts Optional. Array of posts to display. Default false.
 */
function wp_dashboard_recent_drafts( $drafts = false ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Displays comments for post.
 *
 * @since WP 2.8.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param WP_Post $post Current post object.
 */
function post_comment_meta_box( $post ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Displays comments status form fields.
 *
 * @since WP 2.6.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param WP_Post $post Current post object.
 */
function post_comment_status_meta_box( $post ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Fires at the end of the Discussion meta box on the post editing screen.
	 *
	 * @since WP 3.1.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param WP_Post $post WP_Post object for the current post.
	 */
	do_action_deprecated(
		'post_comment_status_meta_box-options', // phpcs:ignore WordPress.NamingConventions.ValidHookName.UseUnderscores
		array( null ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);
}

/**
 * Outputs the in-line comment reply-to form in the Comments list table.
 *
 * @since WP 2.7.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int    $position  Optional. The value of the 'position' input field. Default 1.
 * @param bool   $checkbox  Optional. The value of the 'checkbox' input field. Default false.
 * @param string $mode      Optional. If set to 'single', will use WP_Post_Comments_List_Table,
 *                          otherwise WP_Comments_List_Table. Default 'single'.
 * @param bool   $table_row Optional. Whether to use a table instead of a div element. Default true.
 */
function wp_comment_reply( $position = 1, $checkbox = false, $mode = 'single', $table_row = true ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the in-line comment reply-to form output in the Comments
	 * list table.
	 *
	 * Returning a non-empty value here will short-circuit display
	 * of the in-line comment-reply form in the Comments list table,
	 * echoing the returned value instead.
	 *
	 * @since WP 2.7.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string $content The reply-to form content.
	 * @param array  $args    An array of default args.
	 */
	apply_filters_deprecated(
		'wp_comment_reply',
		array( '', array() ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);
}

/**
 * Adds a submenu page to the Comments main menu.
 *
 * This function takes a capability which will be used to determine whether
 * or not a page is included in the menu.
 *
 * The function which is hooked in to handle the output of the page must check
 * that the user has the required capability as well.
 *
 * @since WP 2.7.0
 * @since WP 5.3.0 Added the `$position` parameter.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string   $page_title The text to be displayed in the title tags of the page when the menu is selected.
 * @param string   $menu_title The text to be used for the menu.
 * @param string   $capability The capability required for this menu to be displayed to the user.
 * @param string   $menu_slug  The slug name to refer to this menu by (should be unique for this menu).
 * @param callable $callback   Optional. The function to be called to output the content for this page.
 * @param int      $position   Optional. The position in the menu order this item should appear.
 * @return string|false The resulting page's hook_suffix, or false if the user does not have the capability required.
 */
function add_comments_page( $page_title, $menu_title, $capability, $menu_slug, $callback = '', $position = null ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Determines if a comment exists based on author and date.
 *
 * For best performance, use `$timezone = 'gmt'`, which queries a field that is properly indexed. The default value
 * for `$timezone` is 'blog' for legacy reasons.
 *
 * @since WP 2.0.0
 * @since WP 4.4.0 Added the `$timezone` parameter.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string $comment_author Author of the comment.
 * @param string $comment_date   Date of the comment.
 * @param string $timezone       Timezone. Accepts 'blog' or 'gmt'. Default 'blog'.
 * @return string|null Comment post ID on success.
 */
function comment_exists( $comment_author, $comment_date, $timezone = 'blog' ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return '';
}

/**
 * Updates a comment with values provided in $_POST.
 *
 * @since WP 2.0.0
 * @since WP 5.5.0 A return value was added.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @return int|WP_Error The value 1 if the comment was updated, 0 if not updated.
 *                      A WP_Error object on failure.
 */
function edit_comment() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return 0;
}

/**
 * Returns a WP_Comment object based on comment ID.
 *
 * @since WP 2.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int $id ID of comment to retrieve.
 * @return WP_Comment|false Comment if found. False on failure.
 */
function get_comment_to_edit( $id ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the comment content before editing.
	 *
	 * @since WP 2.0.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string $comment_content Comment content.
	 */
	apply_filters_deprecated(
		'comment_edit_pre',
		array( '' ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return false;
}

/**
 * Gets the number of pending comments on a post or posts.
 *
 * @since WP 2.3.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int|int[] $post_id Either a single Post ID or an array of Post IDs
 * @return int|int[] Either a single Posts pending comments as an int or an array of ints keyed on the Post IDs
 */
function get_pending_comments_num( $post_id ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return 0;
}

/**
 * Adds avatars to relevant places in admin.
 *
 * @since WP 2.5.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string $name User name.
 * @return string Avatar with the user name.
 */
function floated_admin_avatar( $name ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return '';
}

/**
 * Outputs 'undo move to Trash' text for comments.
 *
 * @since WP 2.9.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function wp_comment_trashnotice() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Creates a site theme from an existing theme.
 *
 * {@internal Missing Long Description}}
 *
 * @since WP 1.5.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string $theme_name The name of the theme.
 * @param string $template   The directory name of the theme.
 * @return bool
 */
function make_site_theme_from_oldschool( $theme_name, $template ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return false;
}

/**
 * Creates a site theme from the default theme.
 *
 * {@internal Missing Long Description}}
 *
 * @since WP 1.5.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string $theme_name The name of the theme.
 * @param string $template   The directory name of the theme.
 */
function make_site_theme_from_default( $theme_name, $template ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Creates a site theme.
 *
 * {@internal Missing Long Description}}
 *
 * @since WP 1.5.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @return string|false
 */
function make_site_theme() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return false;
}

/**
 * Runs before the schema is upgraded.
 *
 * @since WP 2.9.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function pre_schema_upgrade() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Retrieves the list of importers.
 *
 * @since WP 2.0.0
 * @deprecated 1.0.0 Retraceur fork.
 * @return array
 */
function get_importers() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return array();
}

/**
 * Returns a list of popular importer plugins.
 *
 * @since WP 3.5.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @return array Importers with metadata for each.
 */
function wp_get_popular_importers() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return array();
}

/**
 * Adds the 'Theme File Editor' menu item to the bottom of the Appearance (non-block themes)
 * or Tools (block themes) menu.
 *
 * @access private
 * @since WP 3.0.0
 * @since WP 5.9.0 Renamed 'Theme Editor' to 'Theme File Editor'.
 *              Relocates to Tools for block themes.
 * @deprecated 1.0.0 Retraceur fork.
 */
function _add_themes_utility_last() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Adds the 'Plugin File Editor' menu item after the 'Themes File Editor' in Tools
 * for block themes.
 *
 * @access private
 * @since WP 5.9.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function _add_plugin_file_editor_to_tools() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Makes a tree structure for the theme file editor's file list.
 *
 * @since WP 4.9.0
 * @deprecated 1.0.0 Retraceur fork.
 * @access private
 *
 * @param array $allowed_files List of theme file paths.
 * @return array Tree structure for listing theme files.
 */
function wp_make_theme_file_tree( $allowed_files ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return array();
}

/**
 * Outputs the formatted file list for the theme file editor.
 *
 * @since WP 4.9.0
 * @deprecated 1.0.0 Retraceur fork.
 * @access private
 *
 * @param array|string $tree  List of file/folder paths, or filename.
 * @param int          $level The aria-level for the current iteration.
 * @param int          $size  The aria-setsize for the current iteration.
 * @param int          $index The aria-posinset for the current iteration.
 */
function wp_print_theme_file_tree( $tree, $level = 2, $size = 1, $index = 1 ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Makes a tree structure for the plugin file editor's file list.
 *
 * @since WP 4.9.0
 * @deprecated 1.0.0 Retraceur fork.
 * @access private
 *
 * @param array $plugin_editable_files List of plugin file paths.
 * @return array Tree structure for listing plugin files.
 */
function wp_make_plugin_file_tree( $plugin_editable_files ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return array();
}

/**
 * Outputs the formatted file list for the plugin file editor.
 *
 * @since WP 4.9.0
 * @deprecated 1.0.0 Retraceur fork.
 * @access private
 *
 * @param array|string $tree  List of file/folder paths, or filename.
 * @param string       $label Name of file or folder to print.
 * @param int          $level The aria-level for the current iteration.
 * @param int          $size  The aria-setsize for the current iteration.
 * @param int          $index The aria-posinset for the current iteration.
 */
function wp_print_plugin_file_tree( $tree, $label = '', $level = 2, $size = 1, $index = 1 ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}
