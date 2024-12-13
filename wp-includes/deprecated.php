<?php
/**
 * Deprecated functions from past WordPress versions. You shouldn't use these
 * functions and look for the alternatives instead. The functions will be
 * removed in a later version.
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
 * Retrieves all post data for a given post.
 *
 * @since WP 0.71
 * @deprecated WP 1.5.1 Use get_post()
 * @see get_post()
 *
 * @param int $postid Post ID.
 * @return array Post data.
 */
function get_postdata($postid) {
	_deprecated_function( __FUNCTION__, '1.5.1', 'get_post()' );

	$post = get_post($postid);

	$postdata = array (
		'ID' => $post->ID,
		'Author_ID' => $post->post_author,
		'Date' => $post->post_date,
		'Content' => $post->post_content,
		'Excerpt' => $post->post_excerpt,
		'Title' => $post->post_title,
		'Category' => $post->post_category,
		'post_status' => $post->post_status,
		'comment_status' => $post->comment_status,
		'ping_status' => $post->ping_status,
		'post_password' => $post->post_password,
		'to_ping' => $post->to_ping,
		'pinged' => $post->pinged,
		'post_type' => $post->post_type,
		'post_name' => $post->post_name
	);

	return $postdata;
}

/**
 * Sets up the WordPress Loop.
 *
 * Use The Loop instead.
 *
 * @since WP 1.0.1
 * @deprecated WP 1.5.0
 *
 * @global WP_Query $wp_query WordPress Query object.
 */
function start_wp() {
	global $wp_query;

	_deprecated_function( __FUNCTION__, '1.5.0', __('new WordPress Loop') );

	// Since the old style loop is being used, advance the query iterator here.
	$wp_query->next_post();

	setup_postdata( get_post() );
}

/**
 * Returns or prints a category ID.
 *
 * @since WP 0.71
 * @deprecated WP 0.71 Use get_the_category()
 * @see get_the_category()
 *
 * @param bool $display Optional. Whether to display the output. Default true.
 * @return int Category ID.
 */
function the_category_ID($display = true) {
	_deprecated_function( __FUNCTION__, '0.71', 'get_the_category()' );

	// Grab the first cat in the list.
	$categories = get_the_category();
	$cat = $categories[0]->term_id;

	if ( $display )
		echo $cat;

	return $cat;
}

/**
 * Prints a category with optional text before and after.
 *
 * @since WP 0.71
 * @deprecated WP 0.71 Use get_the_category_by_ID()
 * @see get_the_category_by_ID()
 *
 * @param string $before Optional. Text to display before the category. Default empty.
 * @param string $after  Optional. Text to display after the category. Default empty.
 */
function the_category_head( $before = '', $after = '' ) {
	global $currentcat, $previouscat;

	_deprecated_function( __FUNCTION__, '0.71', 'get_the_category_by_ID()' );

	// Grab the first cat in the list.
	$categories = get_the_category();
	$currentcat = $categories[0]->category_id;
	if ( $currentcat != $previouscat ) {
		echo $before;
		echo get_the_category_by_ID($currentcat);
		echo $after;
		$previouscat = $currentcat;
	}
}

/**
 * Prints a link to the previous post.
 *
 * @since WP 1.5.0
 * @deprecated WP 2.0.0 Use previous_post_link()
 * @see previous_post_link()
 *
 * @param string $format
 * @param string $previous
 * @param string $title
 * @param string $in_same_cat
 * @param int    $limitprev
 * @param string $excluded_categories
 */
function previous_post($format='%', $previous='previous post: ', $title='yes', $in_same_cat='no', $limitprev=1, $excluded_categories='') {

	_deprecated_function( __FUNCTION__, '2.0.0', 'previous_post_link()' );

	if ( empty($in_same_cat) || 'no' == $in_same_cat )
		$in_same_cat = false;
	else
		$in_same_cat = true;

	$post = get_previous_post($in_same_cat, $excluded_categories);

	if ( !$post )
		return;

	$string = '<a href="'.get_permalink($post->ID).'">'.$previous;
	if ( 'yes' == $title )
		$string .= apply_filters('the_title', $post->post_title, $post->ID);
	$string .= '</a>';
	$format = str_replace('%', $string, $format);
	echo $format;
}

/**
 * Prints link to the next post.
 *
 * @since WP 0.71
 * @deprecated WP 2.0.0 Use next_post_link()
 * @see next_post_link()
 *
 * @param string $format
 * @param string $next
 * @param string $title
 * @param string $in_same_cat
 * @param int $limitnext
 * @param string $excluded_categories
 */
function next_post($format='%', $next='next post: ', $title='yes', $in_same_cat='no', $limitnext=1, $excluded_categories='') {
	_deprecated_function( __FUNCTION__, '2.0.0', 'next_post_link()' );

	if ( empty($in_same_cat) || 'no' == $in_same_cat )
		$in_same_cat = false;
	else
		$in_same_cat = true;

	$post = get_next_post($in_same_cat, $excluded_categories);

	if ( !$post	)
		return;

	$string = '<a href="'.get_permalink($post->ID).'">'.$next;
	if ( 'yes' == $title )
		$string .= apply_filters('the_title', $post->post_title, $post->ID);
	$string .= '</a>';
	$format = str_replace('%', $string, $format);
	echo $format;
}

/**
 * Whether user can create a post.
 *
 * @since WP 1.5.0
 * @deprecated WP 2.0.0 Use current_user_can()
 * @see current_user_can()
 *
 * @param int $user_id
 * @param int $blog_id Not Used
 * @param int $category_id Not Used
 * @return bool
 */
function user_can_create_post($user_id, $blog_id = 1, $category_id = 'None') {
	_deprecated_function( __FUNCTION__, '2.0.0', 'current_user_can()' );

	$author_data = get_userdata($user_id);
	return ($author_data->user_level > 1);
}

/**
 * Whether user can create a post.
 *
 * @since WP 1.5.0
 * @deprecated WP 2.0.0 Use current_user_can()
 * @see current_user_can()
 *
 * @param int $user_id
 * @param int $blog_id Not Used
 * @param int $category_id Not Used
 * @return bool
 */
function user_can_create_draft($user_id, $blog_id = 1, $category_id = 'None') {
	_deprecated_function( __FUNCTION__, '2.0.0', 'current_user_can()' );

	$author_data = get_userdata($user_id);
	return ($author_data->user_level >= 1);
}

/**
 * Whether user can edit a post.
 *
 * @since WP 1.5.0
 * @deprecated WP 2.0.0 Use current_user_can()
 * @see current_user_can()
 *
 * @param int $user_id
 * @param int $post_id
 * @param int $blog_id Not Used
 * @return bool
 */
function user_can_edit_post($user_id, $post_id, $blog_id = 1) {
	_deprecated_function( __FUNCTION__, '2.0.0', 'current_user_can()' );

	$author_data = get_userdata($user_id);
	$post = get_post($post_id);
	$post_author_data = get_userdata($post->post_author);

	if ( (($user_id == $post_author_data->ID) && !($post->post_status == 'publish' && $author_data->user_level < 2))
			|| ($author_data->user_level > $post_author_data->user_level)
			|| ($author_data->user_level >= 10) ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Whether user can delete a post.
 *
 * @since WP 1.5.0
 * @deprecated WP 2.0.0 Use current_user_can()
 * @see current_user_can()
 *
 * @param int $user_id
 * @param int $post_id
 * @param int $blog_id Not Used
 * @return bool
 */
function user_can_delete_post($user_id, $post_id, $blog_id = 1) {
	_deprecated_function( __FUNCTION__, '2.0.0', 'current_user_can()' );

	// Right now if one can edit, one can delete.
	return user_can_edit_post($user_id, $post_id, $blog_id);
}

/**
 * Whether user can set new posts' dates.
 *
 * @since WP 1.5.0
 * @deprecated WP 2.0.0 Use current_user_can()
 * @see current_user_can()
 *
 * @param int $user_id
 * @param int $blog_id Not Used
 * @param int $category_id Not Used
 * @return bool
 */
function user_can_set_post_date($user_id, $blog_id = 1, $category_id = 'None') {
	_deprecated_function( __FUNCTION__, '2.0.0', 'current_user_can()' );

	$author_data = get_userdata($user_id);
	return (($author_data->user_level > 4) && user_can_create_post($user_id, $blog_id, $category_id));
}

/**
 * Whether user can delete a post.
 *
 * @since WP 1.5.0
 * @deprecated WP 2.0.0 Use current_user_can()
 * @see current_user_can()
 *
 * @param int $user_id
 * @param int $post_id
 * @param int $blog_id Not Used
 * @return bool returns true if $user_id can edit $post_id's date
 */
function user_can_edit_post_date($user_id, $post_id, $blog_id = 1) {
	_deprecated_function( __FUNCTION__, '2.0.0', 'current_user_can()' );

	$author_data = get_userdata($user_id);
	return (($author_data->user_level > 4) && user_can_edit_post($user_id, $post_id, $blog_id));
}

/**
 * Whether user can delete a post.
 *
 * @since WP 1.5.0
 * @deprecated WP 2.0.0 Use current_user_can()
 * @see current_user_can()
 *
 * @param int $user_id
 * @param int $post_id
 * @param int $blog_id Not Used
 * @return bool returns true if $user_id can edit $post_id's comments
 */
function user_can_edit_post_comments($user_id, $post_id, $blog_id = 1) {
	_deprecated_function( __FUNCTION__, '2.0.0', 'current_user_can()' );

	// Right now if one can edit a post, one can edit comments made on it.
	return user_can_edit_post($user_id, $post_id, $blog_id);
}

/**
 * Whether user can delete a post.
 *
 * @since WP 1.5.0
 * @deprecated WP 2.0.0 Use current_user_can()
 * @see current_user_can()
 *
 * @param int $user_id
 * @param int $post_id
 * @param int $blog_id Not Used
 * @return bool returns true if $user_id can delete $post_id's comments
 */
function user_can_delete_post_comments($user_id, $post_id, $blog_id = 1) {
	_deprecated_function( __FUNCTION__, '2.0.0', 'current_user_can()' );

	// Right now if one can edit comments, one can delete comments.
	return user_can_edit_post_comments($user_id, $post_id, $blog_id);
}

/**
 * Can user can edit other user.
 *
 * @since WP 1.5.0
 * @deprecated WP 2.0.0 Use current_user_can()
 * @see current_user_can()
 *
 * @param int $user_id
 * @param int $other_user
 * @return bool
 */
function user_can_edit_user($user_id, $other_user) {
	_deprecated_function( __FUNCTION__, '2.0.0', 'current_user_can()' );

	$user  = get_userdata($user_id);
	$other = get_userdata($other_user);
	if ( $user->user_level > $other->user_level || $user->user_level > 8 || $user->ID == $other->ID )
		return true;
	else
		return false;
}

/**
 * Gets the links associated with category $cat_name.
 *
 * @since WP 0.71
 * @deprecated WP 2.1.0 Use get_bookmarks()
 * @see get_bookmarks()
 *
 * @param string $cat_name         Optional. The category name to use. If no match is found, uses all.
 *                                 Default 'noname'.
 * @param string $before           Optional. The HTML to output before the link. Default empty.
 * @param string $after            Optional. The HTML to output after the link. Default '<br />'.
 * @param string $between          Optional. The HTML to output between the link/image and its description.
 *                                 Not used if no image or $show_images is true. Default ' '.
 * @param bool   $show_images      Optional. Whether to show images (if defined). Default true.
 * @param string $orderby          Optional. The order to output the links. E.g. 'id', 'name', 'url',
 *                                 'description', 'rating', or 'owner'. Default 'id'.
 *                                 If you start the name with an underscore, the order will be reversed.
 *                                 Specifying 'rand' as the order will return links in a random order.
 * @param bool   $show_description Optional. Whether to show the description if show_images=false/not defined.
 *                                 Default true.
 * @param bool   $show_rating      Optional. Show rating stars/chars. Default false.
 * @param int    $limit            Optional. Limit to X entries. If not specified, all entries are shown.
 *                                 Default -1.
 * @param int    $show_updated     Optional. Whether to show last updated timestamp. Default 0.
 */
function get_linksbyname($cat_name = "noname", $before = '', $after = '<br />', $between = " ", $show_images = true, $orderby = 'id',
						$show_description = true, $show_rating = false,
						$limit = -1, $show_updated = 0) {
	_deprecated_function( __FUNCTION__, '2.1.0', 'get_bookmarks()' );

	$cat_id = -1;
	$cat = get_term_by('name', $cat_name, 'link_category');
	if ( $cat )
		$cat_id = $cat->term_id;

	get_links($cat_id, $before, $after, $between, $show_images, $orderby, $show_description, $show_rating, $limit, $show_updated);
}

/**
 * Gets the links associated with the named category.
 *
 * @since WP 1.0.1
 * @deprecated WP 2.1.0 Use wp_list_bookmarks()
 * @see wp_list_bookmarks()
 *
 * @param string $category The category to use.
 * @param string $args
 * @return string|null
 */
function wp_get_linksbyname($category, $args = '') {
	_deprecated_function(__FUNCTION__, '2.1.0', 'wp_list_bookmarks()');

	$defaults = array(
		'after' => '<br />',
		'before' => '',
		'categorize' => 0,
		'category_after' => '',
		'category_before' => '',
		'category_name' => $category,
		'show_description' => 1,
		'title_li' => '',
	);

	$parsed_args = wp_parse_args( $args, $defaults );

	return wp_list_bookmarks($parsed_args);
}

/**
 * Gets an array of link objects associated with category $cat_name.
 *
 *     $links = get_linkobjectsbyname( 'fred' );
 *     foreach ( $links as $link ) {
 *      	echo '<li>' . $link->link_name . '</li>';
 *     }
 *
 * @since WP 1.0.1
 * @deprecated WP 2.1.0 Use get_bookmarks()
 * @see get_bookmarks()
 *
 * @param string $cat_name Optional. The category name to use. If no match is found, uses all.
 *                         Default 'noname'.
 * @param string $orderby  Optional. The order to output the links. E.g. 'id', 'name', 'url',
 *                         'description', 'rating', or 'owner'. Default 'name'.
 *                         If you start the name with an underscore, the order will be reversed.
 *                         Specifying 'rand' as the order will return links in a random order.
 * @param int    $limit    Optional. Limit to X entries. If not specified, all entries are shown.
 *                         Default -1.
 * @return array
 */
function get_linkobjectsbyname($cat_name = "noname" , $orderby = 'name', $limit = -1) {
	_deprecated_function( __FUNCTION__, '2.1.0', 'get_bookmarks()' );

	$cat_id = -1;
	$cat = get_term_by('name', $cat_name, 'link_category');
	if ( $cat )
		$cat_id = $cat->term_id;

	return get_linkobjects($cat_id, $orderby, $limit);
}

/**
 * Gets an array of link objects associated with category n.
 *
 * Usage:
 *
 *     $links = get_linkobjects(1);
 *     if ($links) {
 *     	foreach ($links as $link) {
 *     		echo '<li>'.$link->link_name.'<br />'.$link->link_description.'</li>';
 *     	}
 *     }
 *
 * Fields are:
 *
 * - link_id
 * - link_url
 * - link_name
 * - link_image
 * - link_target
 * - link_category
 * - link_description
 * - link_visible
 * - link_owner
 * - link_rating
 * - link_updated
 * - link_rel
 * - link_notes
 *
 * @since WP 1.0.1
 * @deprecated WP 2.1.0 Use get_bookmarks()
 * @see get_bookmarks()
 *
 * @param int    $category Optional. The category to use. If no category supplied, uses all.
 *                         Default 0.
 * @param string $orderby  Optional. The order to output the links. E.g. 'id', 'name', 'url',
 *                         'description', 'rating', or 'owner'. Default 'name'.
 *                         If you start the name with an underscore, the order will be reversed.
 *                         Specifying 'rand' as the order will return links in a random order.
 * @param int    $limit    Optional. Limit to X entries. If not specified, all entries are shown.
 *                         Default 0.
 * @return array
 */
function get_linkobjects($category = 0, $orderby = 'name', $limit = 0) {
	_deprecated_function( __FUNCTION__, '2.1.0', 'get_bookmarks()' );

	$links = get_bookmarks( array( 'category' => $category, 'orderby' => $orderby, 'limit' => $limit ) ) ;

	$links_array = array();
	foreach ($links as $link)
		$links_array[] = $link;

	return $links_array;
}

/**
 * Gets the links associated with category 'cat_name' and display rating stars/chars.
 *
 * @since WP 0.71
 * @deprecated WP 2.1.0 Use get_bookmarks()
 * @see get_bookmarks()
 *
 * @param string $cat_name         Optional. The category name to use. If no match is found, uses all.
 *                                 Default 'noname'.
 * @param string $before           Optional. The HTML to output before the link. Default empty.
 * @param string $after            Optional. The HTML to output after the link. Default '<br />'.
 * @param string $between          Optional. The HTML to output between the link/image and its description.
 *                                 Not used if no image or $show_images is true. Default ' '.
 * @param bool   $show_images      Optional. Whether to show images (if defined). Default true.
 * @param string $orderby          Optional. The order to output the links. E.g. 'id', 'name', 'url',
 *                                 'description', 'rating', or 'owner'. Default 'id'.
 *                                 If you start the name with an underscore, the order will be reversed.
 *                                 Specifying 'rand' as the order will return links in a random order.
 * @param bool   $show_description Optional. Whether to show the description if show_images=false/not defined.
 *                                 Default true.
 * @param int    $limit		       Optional. Limit to X entries. If not specified, all entries are shown.
 *                                 Default -1.
 * @param int    $show_updated     Optional. Whether to show last updated timestamp. Default 0.
 */
function get_linksbyname_withrating($cat_name = "noname", $before = '', $after = '<br />', $between = " ",
									$show_images = true, $orderby = 'id', $show_description = true, $limit = -1, $show_updated = 0) {
	_deprecated_function( __FUNCTION__, '2.1.0', 'get_bookmarks()' );

	get_linksbyname($cat_name, $before, $after, $between, $show_images, $orderby, $show_description, true, $limit, $show_updated);
}

/**
 * Gets the links associated with category n and display rating stars/chars.
 *
 * @since WP 0.71
 * @deprecated WP 2.1.0 Use get_bookmarks()
 * @see get_bookmarks()
 *
 * @param int    $category         Optional. The category to use. If no category supplied, uses all.
 *                                 Default 0.
 * @param string $before           Optional. The HTML to output before the link. Default empty.
 * @param string $after            Optional. The HTML to output after the link. Default '<br />'.
 * @param string $between          Optional. The HTML to output between the link/image and its description.
 *                                 Not used if no image or $show_images is true. Default ' '.
 * @param bool   $show_images      Optional. Whether to show images (if defined). Default true.
 * @param string $orderby          Optional. The order to output the links. E.g. 'id', 'name', 'url',
 *                                 'description', 'rating', or 'owner'. Default 'id'.
 *                                 If you start the name with an underscore, the order will be reversed.
 *                                 Specifying 'rand' as the order will return links in a random order.
 * @param bool   $show_description Optional. Whether to show the description if show_images=false/not defined.
 *                                 Default true.
 * @param int    $limit		       Optional. Limit to X entries. If not specified, all entries are shown.
 *                                 Default -1.
 * @param int    $show_updated     Optional. Whether to show last updated timestamp. Default 0.
 */
function get_links_withrating($category = -1, $before = '', $after = '<br />', $between = " ", $show_images = true,
							$orderby = 'id', $show_description = true, $limit = -1, $show_updated = 0) {
	_deprecated_function( __FUNCTION__, '2.1.0', 'get_bookmarks()' );

	get_links($category, $before, $after, $between, $show_images, $orderby, $show_description, true, $limit, $show_updated);
}

/**
 * Gets the auto_toggle setting.
 *
 * @since WP 0.71
 * @deprecated WP 2.1.0
 *
 * @param int $id The category to get. If no category supplied uses 0
 * @return int Only returns 0.
 */
function get_autotoggle($id = 0) {
	_deprecated_function( __FUNCTION__, '2.1.0' );
	return 0;
}

/**
 * Lists categories.
 *
 * @since WP 0.71
 * @deprecated WP 2.1.0 Use wp_list_categories()
 * @see wp_list_categories()
 *
 * @param int $optionall
 * @param string $all
 * @param string $sort_column
 * @param string $sort_order
 * @param string $file
 * @param bool $list
 * @param int $optiondates
 * @param int $optioncount
 * @param int $hide_empty
 * @param int $use_desc_for_title
 * @param bool $children
 * @param int $child_of
 * @param int $categories
 * @param int $recurse
 * @param string $feed
 * @param string $feed_image
 * @param string $exclude
 * @param bool $hierarchical
 * @return null|false
 */
function list_cats($optionall = 1, $all = 'All', $sort_column = 'ID', $sort_order = 'asc', $file = '', $list = true, $optiondates = 0,
				$optioncount = 0, $hide_empty = 1, $use_desc_for_title = 1, $children=false, $child_of=0, $categories=0,
				$recurse=0, $feed = '', $feed_image = '', $exclude = '', $hierarchical=false) {
	_deprecated_function( __FUNCTION__, '2.1.0', 'wp_list_categories()' );

	$query = compact('optionall', 'all', 'sort_column', 'sort_order', 'file', 'list', 'optiondates', 'optioncount', 'hide_empty', 'use_desc_for_title', 'children',
		'child_of', 'categories', 'recurse', 'feed', 'feed_image', 'exclude', 'hierarchical');
	return wp_list_cats($query);
}

/**
 * Lists categories.
 *
 * @since WP 1.2.0
 * @deprecated WP 2.1.0 Use wp_list_categories()
 * @see wp_list_categories()
 *
 * @param string|array $args
 * @return null|string|false
 */
function wp_list_cats($args = '') {
	_deprecated_function( __FUNCTION__, '2.1.0', 'wp_list_categories()' );

	$parsed_args = wp_parse_args( $args );

	// Map to new names.
	if ( isset($parsed_args['optionall']) && isset($parsed_args['all']))
		$parsed_args['show_option_all'] = $parsed_args['all'];
	if ( isset($parsed_args['sort_column']) )
		$parsed_args['orderby'] = $parsed_args['sort_column'];
	if ( isset($parsed_args['sort_order']) )
		$parsed_args['order'] = $parsed_args['sort_order'];
	if ( isset($parsed_args['optiondates']) )
		$parsed_args['show_last_update'] = $parsed_args['optiondates'];
	if ( isset($parsed_args['optioncount']) )
		$parsed_args['show_count'] = $parsed_args['optioncount'];
	if ( isset($parsed_args['list']) )
		$parsed_args['style'] = $parsed_args['list'] ? 'list' : 'break';
	$parsed_args['title_li'] = '';

	return wp_list_categories($parsed_args);
}

/**
 * Deprecated method for generating a drop-down of categories.
 *
 * @since WP 0.71
 * @deprecated WP 2.1.0 Use wp_dropdown_categories()
 * @see wp_dropdown_categories()
 *
 * @param int $optionall
 * @param string $all
 * @param string $orderby
 * @param string $order
 * @param int $show_last_update
 * @param int $show_count
 * @param int $hide_empty
 * @param bool $optionnone
 * @param int $selected
 * @param int $exclude
 * @return string
 */
function dropdown_cats($optionall = 1, $all = 'All', $orderby = 'ID', $order = 'asc',
		$show_last_update = 0, $show_count = 0, $hide_empty = 1, $optionnone = false,
		$selected = 0, $exclude = 0) {
	_deprecated_function( __FUNCTION__, '2.1.0', 'wp_dropdown_categories()' );

	$show_option_all = '';
	if ( $optionall )
		$show_option_all = $all;

	$show_option_none = '';
	if ( $optionnone )
		$show_option_none = _x( 'None', 'Categories dropdown (show_option_none parameter)' );

	$vars = compact('show_option_all', 'show_option_none', 'orderby', 'order',
					'show_last_update', 'show_count', 'hide_empty', 'selected', 'exclude');
	$query = add_query_arg($vars, '');
	return wp_dropdown_categories($query);
}

/**
 * Lists authors.
 *
 * @since WP 1.2.0
 * @deprecated WP 2.1.0 Use wp_list_authors()
 * @see wp_list_authors()
 *
 * @param bool $optioncount
 * @param bool $exclude_admin
 * @param bool $show_fullname
 * @param bool $hide_empty
 * @param string $feed
 * @param string $feed_image
 * @return null|string
 */
function list_authors($optioncount = false, $exclude_admin = true, $show_fullname = false, $hide_empty = true, $feed = '', $feed_image = '') {
	_deprecated_function( __FUNCTION__, '2.1.0', 'wp_list_authors()' );

	$args = compact('optioncount', 'exclude_admin', 'show_fullname', 'hide_empty', 'feed', 'feed_image');
	return wp_list_authors($args);
}

/**
 * Retrieves a list of post categories.
 *
 * @since WP 1.0.1
 * @deprecated WP 2.1.0 Use wp_get_post_categories()
 * @see wp_get_post_categories()
 *
 * @param int $blogid Not Used
 * @param int $post_id
 * @return array
 */
function wp_get_post_cats($blogid = '1', $post_id = 0) {
	_deprecated_function( __FUNCTION__, '2.1.0', 'wp_get_post_categories()' );
	return wp_get_post_categories($post_id);
}

/**
 * Sets the categories that the post ID belongs to.
 *
 * @since WP 1.0.1
 * @deprecated WP 2.1.0
 * @deprecated WP Use wp_set_post_categories()
 * @see wp_set_post_categories()
 *
 * @param int $blogid Not used
 * @param int $post_id
 * @param array $post_categories
 * @return bool|mixed
 */
function wp_set_post_cats($blogid = '1', $post_id = 0, $post_categories = array()) {
	_deprecated_function( __FUNCTION__, '2.1.0', 'wp_set_post_categories()' );
	return wp_set_post_categories($post_id, $post_categories);
}

/**
 * Retrieves a list of archives.
 *
 * @since WP 0.71
 * @deprecated WP 2.1.0 Use wp_get_archives()
 * @see wp_get_archives()
 *
 * @param string $type
 * @param string $limit
 * @param string $format
 * @param string $before
 * @param string $after
 * @param bool $show_post_count
 * @return string|null
 */
function get_archives($type='', $limit='', $format='html', $before = '', $after = '', $show_post_count = false) {
	_deprecated_function( __FUNCTION__, '2.1.0', 'wp_get_archives()' );
	$args = compact('type', 'limit', 'format', 'before', 'after', 'show_post_count');
	return wp_get_archives($args);
}

/**
 * Returns or Prints link to the author's posts.
 *
 * @since WP 1.2.0
 * @deprecated WP 2.1.0 Use get_author_posts_url()
 * @see get_author_posts_url()
 *
 * @param bool $display
 * @param int $author_id
 * @param string $author_nicename Optional.
 * @return string|null
 */
function get_author_link($display, $author_id, $author_nicename = '') {
	_deprecated_function( __FUNCTION__, '2.1.0', 'get_author_posts_url()' );

	$link = get_author_posts_url($author_id, $author_nicename);

	if ( $display )
		echo $link;
	return $link;
}

/**
 * Print list of pages based on arguments.
 *
 * @since WP 0.71
 * @deprecated WP 2.1.0 Use wp_link_pages()
 * @see wp_link_pages()
 *
 * @param string $before
 * @param string $after
 * @param string $next_or_number
 * @param string $nextpagelink
 * @param string $previouspagelink
 * @param string $pagelink
 * @param string $more_file
 * @return string
 */
function link_pages($before='<br />', $after='<br />', $next_or_number='number', $nextpagelink='next page', $previouspagelink='previous page',
					$pagelink='%', $more_file='') {
	_deprecated_function( __FUNCTION__, '2.1.0', 'wp_link_pages()' );

	$args = compact('before', 'after', 'next_or_number', 'nextpagelink', 'previouspagelink', 'pagelink', 'more_file');
	return wp_link_pages($args);
}

/**
 * Get value based on option.
 *
 * @since WP 0.71
 * @deprecated WP 2.1.0 Use get_option()
 * @see get_option()
 *
 * @param string $option
 * @return string
 */
function get_settings($option) {
	_deprecated_function( __FUNCTION__, '2.1.0', 'get_option()' );

	return get_option($option);
}

/**
 * Print the permalink of the current post in the loop.
 *
 * @since WP 0.71
 * @deprecated WP 1.2.0 Use the_permalink()
 * @see the_permalink()
 */
function permalink_link() {
	_deprecated_function( __FUNCTION__, '1.2.0', 'the_permalink()' );
	the_permalink();
}

/**
 * Print the permalink to the RSS feed.
 *
 * @since WP 0.71
 * @deprecated WP 2.3.0 Use the_permalink_rss()
 * @see the_permalink_rss()
 *
 * @param string $deprecated
 */
function permalink_single_rss($deprecated = '') {
	_deprecated_function( __FUNCTION__, '2.3.0', 'the_permalink_rss()' );
	the_permalink_rss();
}

/**
 * Gets the links associated with category.
 *
 * @since WP 1.0.1
 * @deprecated WP 2.1.0 Use wp_list_bookmarks()
 * @see wp_list_bookmarks()
 *
 * @param string $args a query string
 * @return null|string
 */
function wp_get_links($args = '') {
	_deprecated_function( __FUNCTION__, '2.1.0', 'wp_list_bookmarks()' );

	if ( ! str_contains( $args, '=' ) ) {
		$cat_id = $args;
		$args = add_query_arg( 'category', $cat_id, $args );
	}

	$defaults = array(
		'after' => '<br />',
		'before' => '',
		'between' => ' ',
		'categorize' => 0,
		'category' => '',
		'echo' => true,
		'limit' => -1,
		'orderby' => 'name',
		'show_description' => true,
		'show_images' => true,
		'show_rating' => false,
		'show_updated' => true,
		'title_li' => '',
	);

	$parsed_args = wp_parse_args( $args, $defaults );

	return wp_list_bookmarks($parsed_args);
}

/**
 * Gets the links associated with category by ID.
 *
 * @since WP 0.71
 * @deprecated WP 2.1.0 Use get_bookmarks()
 * @see get_bookmarks()
 *
 * @param int    $category         Optional. The category to use. If no category supplied uses all.
 *                                 Default 0.
 * @param string $before           Optional. The HTML to output before the link. Default empty.
 * @param string $after            Optional. The HTML to output after the link. Default '<br />'.
 * @param string $between          Optional. The HTML to output between the link/image and its description.
 *                                 Not used if no image or $show_images is true. Default ' '.
 * @param bool   $show_images      Optional. Whether to show images (if defined). Default true.
 * @param string $orderby          Optional. The order to output the links. E.g. 'id', 'name', 'url',
 *                                 'description', 'rating', or 'owner'. Default 'name'.
 *                                 If you start the name with an underscore, the order will be reversed.
 *                                 Specifying 'rand' as the order will return links in a random order.
 * @param bool   $show_description Optional. Whether to show the description if show_images=false/not defined.
 *                                 Default true.
 * @param bool   $show_rating      Optional. Show rating stars/chars. Default false.
 * @param int    $limit            Optional. Limit to X entries. If not specified, all entries are shown.
 *                                 Default -1.
 * @param int    $show_updated     Optional. Whether to show last updated timestamp. Default 1.
 * @param bool   $display          Whether to display the results, or return them instead.
 * @return null|string
 */
function get_links($category = -1, $before = '', $after = '<br />', $between = ' ', $show_images = true, $orderby = 'name',
			$show_description = true, $show_rating = false, $limit = -1, $show_updated = 1, $display = true) {
	_deprecated_function( __FUNCTION__, '2.1.0', 'get_bookmarks()' );

	$order = 'ASC';
	if ( str_starts_with($orderby, '_') ) {
		$order = 'DESC';
		$orderby = substr($orderby, 1);
	}

	if ( $category == -1 ) // get_bookmarks() uses '' to signify all categories.
		$category = '';

	$results = get_bookmarks(array('category' => $category, 'orderby' => $orderby, 'order' => $order, 'show_updated' => $show_updated, 'limit' => $limit));

	if ( !$results )
		return;

	$output = '';

	foreach ( (array) $results as $row ) {
		if ( !isset($row->recently_updated) )
			$row->recently_updated = false;
		$output .= $before;
		if ( $show_updated && $row->recently_updated )
			$output .= get_option('links_recently_updated_prepend');
		$the_link = '#';
		if ( !empty($row->link_url) )
			$the_link = esc_url($row->link_url);
		$rel = $row->link_rel;
		if ( '' != $rel )
			$rel = ' rel="' . $rel . '"';

		$desc = esc_attr(sanitize_bookmark_field('link_description', $row->link_description, $row->link_id, 'display'));
		$name = esc_attr(sanitize_bookmark_field('link_name', $row->link_name, $row->link_id, 'display'));
		$title = $desc;

		if ( $show_updated )
			if ( !str_starts_with($row->link_updated_f, '00') )
				$title .= ' ('.__('Last updated') . ' ' . gmdate(get_option('links_updated_date_format'), $row->link_updated_f + (get_option('gmt_offset') * HOUR_IN_SECONDS)) . ')';

		if ( '' != $title )
			$title = ' title="' . $title . '"';

		$alt = ' alt="' . $name . '"';

		$target = $row->link_target;
		if ( '' != $target )
			$target = ' target="' . $target . '"';

		$output .= '<a href="' . $the_link . '"' . $rel . $title . $target. '>';

		if ( '' != $row->link_image && $show_images ) {
			if ( str_contains( $row->link_image, 'http' ) )
				$output .= '<img src="' . $row->link_image . '"' . $alt . $title . ' />';
			else // If it's a relative path.
				$output .= '<img src="' . get_option('siteurl') . $row->link_image . '"' . $alt . $title . ' />';
		} else {
			$output .= $name;
		}

		$output .= '</a>';

		if ( $show_updated && $row->recently_updated )
			$output .= get_option('links_recently_updated_append');

		if ( $show_description && '' != $desc )
			$output .= $between . $desc;

		if ($show_rating) {
			$output .= $between . get_linkrating($row);
		}

		$output .= "$after\n";
	} // End while.

	if ( !$display )
		return $output;
	echo $output;
}

/**
 * Output entire list of links by category.
 *
 * Output a list of all links, listed by category, using the settings in
 * $wpdb->linkcategories and output it as a nested HTML unordered list.
 *
 * @since WP 1.0.1
 * @deprecated WP 2.1.0 Use wp_list_bookmarks()
 * @see wp_list_bookmarks()
 *
 * @param string $order Sort link categories by 'name' or 'id'
 */
function get_links_list($order = 'name') {
	_deprecated_function( __FUNCTION__, '2.1.0', 'wp_list_bookmarks()' );

	$order = strtolower($order);

	// Handle link category sorting.
	$direction = 'ASC';
	if ( str_starts_with( $order, '_' ) ) {
		$direction = 'DESC';
		$order = substr($order,1);
	}

	if ( !isset($direction) )
		$direction = '';

	$cats = get_categories(array('type' => 'link', 'orderby' => $order, 'order' => $direction, 'hierarchical' => 0));

	// Display each category.
	if ( $cats ) {
		foreach ( (array) $cats as $cat ) {
			// Handle each category.

			// Display the category name.
			echo '  <li id="linkcat-' . $cat->term_id . '" class="linkcat"><h2>' . apply_filters('link_category', $cat->name ) . "</h2>\n\t<ul>\n";
			// Call get_links() with all the appropriate params.
			get_links($cat->term_id, '<li>', "</li>", "\n", true, 'name', false);

			// Close the last category.
			echo "\n\t</ul>\n</li>\n";
		}
	}
}

/**
 * Show the link to the links popup and the number of links.
 *
 * @since WP 0.71
 * @deprecated WP 2.1.0
 *
 * @param string $text the text of the link
 * @param int $width the width of the popup window
 * @param int $height the height of the popup window
 * @param string $file the page to open in the popup window
 * @param bool $count the number of links in the db
 */
function links_popup_script($text = 'Links', $width=400, $height=400, $file='links.all.php', $count = true) {
	_deprecated_function( __FUNCTION__, '2.1.0' );
}

/**
 * Legacy function that retrieved the value of a link's link_rating field.
 *
 * @since WP 1.0.1
 * @deprecated WP 2.1.0 Use sanitize_bookmark_field()
 * @see sanitize_bookmark_field()
 *
 * @param object $link Link object.
 * @return mixed Value of the 'link_rating' field, false otherwise.
 */
function get_linkrating( $link ) {
	_deprecated_function( __FUNCTION__, '2.1.0', 'sanitize_bookmark_field()' );
	return sanitize_bookmark_field('link_rating', $link->link_rating, $link->link_id, 'display');
}

/**
 * Gets the name of category by ID.
 *
 * @since WP 0.71
 * @deprecated WP 2.1.0 Use get_category()
 * @see get_category()
 *
 * @param int $id The category to get. If no category supplied uses 0
 * @return string
 */
function get_linkcatname($id = 0) {
	_deprecated_function( __FUNCTION__, '2.1.0', 'get_category()' );

	$id = (int) $id;

	if ( empty($id) )
		return '';

	$cats = wp_get_link_cats($id);

	if ( empty($cats) || ! is_array($cats) )
		return '';

	$cat_id = (int) $cats[0]; // Take the first cat.

	$cat = get_category($cat_id);
	return $cat->name;
}

/**
 * Print RSS comment feed link.
 *
 * @since WP 1.0.1
 * @deprecated WP 2.5.0 Use post_comments_feed_link()
 * @see post_comments_feed_link()
 *
 * @param string $link_text
 */
function comments_rss_link($link_text = 'Comments RSS') {
	_deprecated_function( __FUNCTION__, '2.5.0', 'post_comments_feed_link()' );
	post_comments_feed_link($link_text);
}

/**
 * Print/Return link to category RSS2 feed.
 *
 * @since WP 1.2.0
 * @deprecated WP 2.5.0 Use get_category_feed_link()
 * @see get_category_feed_link()
 *
 * @param bool $display
 * @param int $cat_id
 * @return string
 */
function get_category_rss_link($display = false, $cat_id = 1) {
	_deprecated_function( __FUNCTION__, '2.5.0', 'get_category_feed_link()' );

	$link = get_category_feed_link($cat_id, 'rss2');

	if ( $display )
		echo $link;
	return $link;
}

/**
 * Print/Return link to author RSS feed.
 *
 * @since WP 1.2.0
 * @deprecated WP 2.5.0 Use get_author_feed_link()
 * @see get_author_feed_link()
 *
 * @param bool $display
 * @param int $author_id
 * @return string
 */
function get_author_rss_link($display = false, $author_id = 1) {
	_deprecated_function( __FUNCTION__, '2.5.0', 'get_author_feed_link()' );

	$link = get_author_feed_link($author_id);
	if ( $display )
		echo $link;
	return $link;
}

/**
 * Return link to the post RSS feed.
 *
 * @since WP 1.5.0
 * @deprecated WP 2.2.0 Use get_post_comments_feed_link()
 * @see get_post_comments_feed_link()
 *
 * @return string
 */
function comments_rss() {
	_deprecated_function( __FUNCTION__, '2.2.0', 'get_post_comments_feed_link()' );
	return esc_url( get_post_comments_feed_link() );
}

/**
 * An alias of wp_create_user().
 *
 * @since WP 2.0.0
 * @deprecated WP 2.0.0 Use wp_create_user()
 * @see wp_create_user()
 *
 * @param string $username The user's username.
 * @param string $password The user's password.
 * @param string $email    The user's email.
 * @return int The new user's ID.
 */
function create_user($username, $password, $email) {
	_deprecated_function( __FUNCTION__, '2.0.0', 'wp_create_user()' );
	return wp_create_user($username, $password, $email);
}

/**
 * Unused function.
 *
 * @deprecated WP 2.5.0
 */
function gzip_compression() {
	_deprecated_function( __FUNCTION__, '2.5.0' );
	return false;
}

/**
 * Retrieve an array of comment data about comment $comment_id.
 *
 * @since WP 0.71
 * @deprecated WP 2.7.0 Use get_comment()
 * @see get_comment()
 *
 * @param int $comment_id The ID of the comment
 * @param int $no_cache Whether to use the cache (cast to bool)
 * @param bool $include_unapproved Whether to include unapproved comments
 * @return array The comment data
 */
function get_commentdata( $comment_id, $no_cache = 0, $include_unapproved = false ) {
	_deprecated_function( __FUNCTION__, '2.7.0', 'get_comment()' );
	return get_comment($comment_id, ARRAY_A);
}

/**
 * Retrieve the category name by the category ID.
 *
 * @since WP 0.71
 * @deprecated WP 2.8.0 Use get_cat_name()
 * @see get_cat_name()
 *
 * @param int $cat_id Category ID
 * @return string category name
 */
function get_catname( $cat_id ) {
	_deprecated_function( __FUNCTION__, '2.8.0', 'get_cat_name()' );
	return get_cat_name( $cat_id );
}

/**
 * Retrieve category children list separated before and after the term IDs.
 *
 * @since WP 1.2.0
 * @deprecated WP 2.8.0 Use get_term_children()
 * @see get_term_children()
 *
 * @param int    $id      Category ID to retrieve children.
 * @param string $before  Optional. Prepend before category term ID. Default '/'.
 * @param string $after   Optional. Append after category term ID. Default empty string.
 * @param array  $visited Optional. Category Term IDs that have already been added.
 *                        Default empty array.
 * @return string
 */
function get_category_children( $id, $before = '/', $after = '', $visited = array() ) {
	_deprecated_function( __FUNCTION__, '2.8.0', 'get_term_children()' );
	if ( 0 == $id )
		return '';

	$chain = '';
	/** TODO: Consult hierarchy */
	$cat_ids = get_all_category_ids();
	foreach ( (array) $cat_ids as $cat_id ) {
		if ( $cat_id == $id )
			continue;

		$category = get_category( $cat_id );
		if ( is_wp_error( $category ) )
			return $category;
		if ( $category->parent == $id && !in_array( $category->term_id, $visited ) ) {
			$visited[] = $category->term_id;
			$chain .= $before.$category->term_id.$after;
			$chain .= get_category_children( $category->term_id, $before, $after );
		}
	}
	return $chain;
}

/**
 * Retrieves all category IDs.
 *
 * @since WP 2.0.0
 * @deprecated WP 4.0.0 Use get_terms()
 * @see get_terms()
 *
 * @return int[] List of all of the category IDs.
 */
function get_all_category_ids() {
	_deprecated_function( __FUNCTION__, '4.0.0', 'get_terms()' );

	$cat_ids = get_terms(
		array(
			'taxonomy' => 'category',
			'fields'   => 'ids',
			'get'      => 'all',
		)
	);

	return $cat_ids;
}

/**
 * Retrieve the description of the author of the current post.
 *
 * @since WP 1.5.0
 * @deprecated WP 2.8.0 Use get_the_author_meta()
 * @see get_the_author_meta()
 *
 * @return string The author's description.
 */
function get_the_author_description() {
	_deprecated_function( __FUNCTION__, '2.8.0', 'get_the_author_meta(\'description\')' );
	return get_the_author_meta('description');
}

/**
 * Display the description of the author of the current post.
 *
 * @since WP 1.0.0
 * @deprecated WP 2.8.0 Use the_author_meta()
 * @see the_author_meta()
 */
function the_author_description() {
	_deprecated_function( __FUNCTION__, '2.8.0', 'the_author_meta(\'description\')' );
	the_author_meta('description');
}

/**
 * Retrieve the login name of the author of the current post.
 *
 * @since WP 1.5.0
 * @deprecated WP 2.8.0 Use get_the_author_meta()
 * @see get_the_author_meta()
 *
 * @return string The author's login name (username).
 */
function get_the_author_login() {
	_deprecated_function( __FUNCTION__, '2.8.0', 'get_the_author_meta(\'login\')' );
	return get_the_author_meta('login');
}

/**
 * Display the login name of the author of the current post.
 *
 * @since WP 0.71
 * @deprecated WP 2.8.0 Use the_author_meta()
 * @see the_author_meta()
 */
function the_author_login() {
	_deprecated_function( __FUNCTION__, '2.8.0', 'the_author_meta(\'login\')' );
	the_author_meta('login');
}

/**
 * Retrieve the first name of the author of the current post.
 *
 * @since WP 1.5.0
 * @deprecated WP 2.8.0 Use get_the_author_meta()
 * @see get_the_author_meta()
 *
 * @return string The author's first name.
 */
function get_the_author_firstname() {
	_deprecated_function( __FUNCTION__, '2.8.0', 'get_the_author_meta(\'first_name\')' );
	return get_the_author_meta('first_name');
}

/**
 * Display the first name of the author of the current post.
 *
 * @since WP 0.71
 * @deprecated WP 2.8.0 Use the_author_meta()
 * @see the_author_meta()
 */
function the_author_firstname() {
	_deprecated_function( __FUNCTION__, '2.8.0', 'the_author_meta(\'first_name\')' );
	the_author_meta('first_name');
}

/**
 * Retrieve the last name of the author of the current post.
 *
 * @since WP 1.5.0
 * @deprecated WP 2.8.0 Use get_the_author_meta()
 * @see get_the_author_meta()
 *
 * @return string The author's last name.
 */
function get_the_author_lastname() {
	_deprecated_function( __FUNCTION__, '2.8.0', 'get_the_author_meta(\'last_name\')' );
	return get_the_author_meta('last_name');
}

/**
 * Display the last name of the author of the current post.
 *
 * @since WP 0.71
 * @deprecated WP 2.8.0 Use the_author_meta()
 * @see the_author_meta()
 */
function the_author_lastname() {
	_deprecated_function( __FUNCTION__, '2.8.0', 'the_author_meta(\'last_name\')' );
	the_author_meta('last_name');
}

/**
 * Retrieve the nickname of the author of the current post.
 *
 * @since WP 1.5.0
 * @deprecated WP 2.8.0 Use get_the_author_meta()
 * @see get_the_author_meta()
 *
 * @return string The author's nickname.
 */
function get_the_author_nickname() {
	_deprecated_function( __FUNCTION__, '2.8.0', 'get_the_author_meta(\'nickname\')' );
	return get_the_author_meta('nickname');
}

/**
 * Display the nickname of the author of the current post.
 *
 * @since WP 0.71
 * @deprecated WP 2.8.0 Use the_author_meta()
 * @see the_author_meta()
 */
function the_author_nickname() {
	_deprecated_function( __FUNCTION__, '2.8.0', 'the_author_meta(\'nickname\')' );
	the_author_meta('nickname');
}

/**
 * Retrieve the email of the author of the current post.
 *
 * @since WP 1.5.0
 * @deprecated WP 2.8.0 Use get_the_author_meta()
 * @see get_the_author_meta()
 *
 * @return string The author's username.
 */
function get_the_author_email() {
	_deprecated_function( __FUNCTION__, '2.8.0', 'get_the_author_meta(\'email\')' );
	return get_the_author_meta('email');
}

/**
 * Display the email of the author of the current post.
 *
 * @since WP 0.71
 * @deprecated WP 2.8.0 Use the_author_meta()
 * @see the_author_meta()
 */
function the_author_email() {
	_deprecated_function( __FUNCTION__, '2.8.0', 'the_author_meta(\'email\')' );
	the_author_meta('email');
}

/**
 * Retrieve the ICQ number of the author of the current post.
 *
 * @since WP 1.5.0
 * @deprecated WP 2.8.0 Use get_the_author_meta()
 * @see get_the_author_meta()
 *
 * @return string The author's ICQ number.
 */
function get_the_author_icq() {
	_deprecated_function( __FUNCTION__, '2.8.0', 'get_the_author_meta(\'icq\')' );
	return get_the_author_meta('icq');
}

/**
 * Display the ICQ number of the author of the current post.
 *
 * @since WP 0.71
 * @deprecated WP 2.8.0 Use the_author_meta()
 * @see the_author_meta()
 */
function the_author_icq() {
	_deprecated_function( __FUNCTION__, '2.8.0', 'the_author_meta(\'icq\')' );
	the_author_meta('icq');
}

/**
 * Retrieve the Yahoo! IM name of the author of the current post.
 *
 * @since WP 1.5.0
 * @deprecated WP 2.8.0 Use get_the_author_meta()
 * @see get_the_author_meta()
 *
 * @return string The author's Yahoo! IM name.
 */
function get_the_author_yim() {
	_deprecated_function( __FUNCTION__, '2.8.0', 'get_the_author_meta(\'yim\')' );
	return get_the_author_meta('yim');
}

/**
 * Display the Yahoo! IM name of the author of the current post.
 *
 * @since WP 0.71
 * @deprecated WP 2.8.0 Use the_author_meta()
 * @see the_author_meta()
 */
function the_author_yim() {
	_deprecated_function( __FUNCTION__, '2.8.0', 'the_author_meta(\'yim\')' );
	the_author_meta('yim');
}

/**
 * Retrieve the MSN address of the author of the current post.
 *
 * @since WP 1.5.0
 * @deprecated WP 2.8.0 Use get_the_author_meta()
 * @see get_the_author_meta()
 *
 * @return string The author's MSN address.
 */
function get_the_author_msn() {
	_deprecated_function( __FUNCTION__, '2.8.0', 'get_the_author_meta(\'msn\')' );
	return get_the_author_meta('msn');
}

/**
 * Display the MSN address of the author of the current post.
 *
 * @since WP 0.71
 * @deprecated WP 2.8.0 Use the_author_meta()
 * @see the_author_meta()
 */
function the_author_msn() {
	_deprecated_function( __FUNCTION__, '2.8.0', 'the_author_meta(\'msn\')' );
	the_author_meta('msn');
}

/**
 * Retrieve the AIM address of the author of the current post.
 *
 * @since WP 1.5.0
 * @deprecated WP 2.8.0 Use get_the_author_meta()
 * @see get_the_author_meta()
 *
 * @return string The author's AIM address.
 */
function get_the_author_aim() {
	_deprecated_function( __FUNCTION__, '2.8.0', 'get_the_author_meta(\'aim\')' );
	return get_the_author_meta('aim');
}

/**
 * Display the AIM address of the author of the current post.
 *
 * @since WP 0.71
 * @deprecated WP 2.8.0 Use the_author_meta('aim')
 * @see the_author_meta()
 */
function the_author_aim() {
	_deprecated_function( __FUNCTION__, '2.8.0', 'the_author_meta(\'aim\')' );
	the_author_meta('aim');
}

/**
 * Retrieve the specified author's preferred display name.
 *
 * @since WP 1.0.0
 * @deprecated WP 2.8.0 Use get_the_author_meta()
 * @see get_the_author_meta()
 *
 * @param int $auth_id The ID of the author.
 * @return string The author's display name.
 */
function get_author_name( $auth_id = false ) {
	_deprecated_function( __FUNCTION__, '2.8.0', 'get_the_author_meta(\'display_name\')' );
	return get_the_author_meta('display_name', $auth_id);
}

/**
 * Retrieve the URL to the home page of the author of the current post.
 *
 * @since WP 1.5.0
 * @deprecated WP 2.8.0 Use get_the_author_meta()
 * @see get_the_author_meta()
 *
 * @return string The URL to the author's page.
 */
function get_the_author_url() {
	_deprecated_function( __FUNCTION__, '2.8.0', 'get_the_author_meta(\'url\')' );
	return get_the_author_meta('url');
}

/**
 * Display the URL to the home page of the author of the current post.
 *
 * @since WP 0.71
 * @deprecated WP 2.8.0 Use the_author_meta()
 * @see the_author_meta()
 */
function the_author_url() {
	_deprecated_function( __FUNCTION__, '2.8.0', 'the_author_meta(\'url\')' );
	the_author_meta('url');
}

/**
 * Retrieve the ID of the author of the current post.
 *
 * @since WP 1.5.0
 * @deprecated WP 2.8.0 Use get_the_author_meta()
 * @see get_the_author_meta()
 *
 * @return string|int The author's ID.
 */
function get_the_author_ID() {
	_deprecated_function( __FUNCTION__, '2.8.0', 'get_the_author_meta(\'ID\')' );
	return get_the_author_meta('ID');
}

/**
 * Display the ID of the author of the current post.
 *
 * @since WP 0.71
 * @deprecated WP 2.8.0 Use the_author_meta()
 * @see the_author_meta()
 */
function the_author_ID() {
	_deprecated_function( __FUNCTION__, '2.8.0', 'the_author_meta(\'ID\')' );
	the_author_meta('ID');
}

/**
 * Display the post content for the feed.
 *
 * For encoding the HTML or the $encode_html parameter, there are three possible values:
 * - '0' will make urls footnotes and use make_url_footnote().
 * - '1' will encode special characters and automatically display all of the content.
 * - '2' will strip all HTML tags from the content.
 *
 * Also note that you cannot set the amount of words and not set the HTML encoding.
 * If that is the case, then the HTML encoding will default to 2, which will strip
 * all HTML tags.
 *
 * To restrict the amount of words of the content, you can use the cut parameter.
 * If the content is less than the amount, then there won't be any dots added to the end.
 * If there is content left over, then dots will be added and the rest of the content
 * will be removed.
 *
 * @since WP 0.71
 *
 * @deprecated WP 2.9.0 Use the_content_feed()
 * @see the_content_feed()
 *
 * @param string $more_link_text Optional. Text to display when more content is available
 *                               but not displayed. Default '(more...)'.
 * @param int    $stripteaser    Optional. Default 0.
 * @param string $more_file      Optional.
 * @param int    $cut            Optional. Amount of words to keep for the content.
 * @param int    $encode_html    Optional. How to encode the content.
 */
function the_content_rss($more_link_text='(more...)', $stripteaser=0, $more_file='', $cut = 0, $encode_html = 0) {
	_deprecated_function( __FUNCTION__, '2.9.0', 'the_content_feed()' );
	$content = get_the_content($more_link_text, $stripteaser);

	/**
	 * Filters the post content in the context of an RSS feed.
	 *
	 * @since WP 0.71
	 *
	 * @param string $content Content of the current post.
	 */
	$content = apply_filters('the_content_rss', $content);
	if ( $cut && !$encode_html )
		$encode_html = 2;
	if ( 1== $encode_html ) {
		$content = esc_html($content);
		$cut = 0;
	} elseif ( 0 == $encode_html ) {
		$content = make_url_footnote($content);
	} elseif ( 2 == $encode_html ) {
		$content = strip_tags($content);
	}
	if ( $cut ) {
		$blah = explode(' ', $content);
		if ( count($blah) > $cut ) {
			$k = $cut;
			$use_dotdotdot = 1;
		} else {
			$k = count($blah);
			$use_dotdotdot = 0;
		}

		/** @todo Check performance, might be faster to use array slice instead. */
		for ( $i=0; $i<$k; $i++ )
			$excerpt .= $blah[$i].' ';
		$excerpt .= ($use_dotdotdot) ? '...' : '';
		$content = $excerpt;
	}
	$content = str_replace(']]>', ']]&gt;', $content);
	echo $content;
}

/**
 * Strip HTML and put links at the bottom of stripped content.
 *
 * Searches for all of the links, strips them out of the content, and places
 * them at the bottom of the content with numbers.
 *
 * @since WP 0.71
 * @deprecated WP 2.9.0
 *
 * @param string $content Content to get links.
 * @return string HTML stripped out of content with links at the bottom.
 */
function make_url_footnote( $content ) {
	_deprecated_function( __FUNCTION__, '2.9.0', '' );
	preg_match_all( '/<a(.+?)href=\"(.+?)\"(.*?)>(.+?)<\/a>/', $content, $matches );
	$links_summary = "\n";
	for ( $i = 0, $c = count( $matches[0] ); $i < $c; $i++ ) {
		$link_match = $matches[0][$i];
		$link_number = '['.($i+1).']';
		$link_url = $matches[2][$i];
		$link_text = $matches[4][$i];
		$content = str_replace( $link_match, $link_text . ' ' . $link_number, $content );
		$link_url = ( ( strtolower( substr( $link_url, 0, 7 ) ) !== 'http://' ) && ( strtolower( substr( $link_url, 0, 8 ) ) !== 'https://' ) ) ? get_option( 'home' ) . $link_url : $link_url;
		$links_summary .= "\n" . $link_number . ' ' . $link_url;
	}
	$content  = strip_tags( $content );
	$content .= $links_summary;
	return $content;
}

/**
 * Retrieve translated string with vertical bar context
 *
 * Quite a few times, there will be collisions with similar translatable text
 * found in more than two places but with different translated context.
 *
 * In order to use the separate contexts, the _c() function is used and the
 * translatable string uses a pipe ('|') which has the context the string is in.
 *
 * When the translated string is returned, it is everything before the pipe, not
 * including the pipe character. If there is no pipe in the translated text then
 * everything is returned.
 *
 * @since WP 2.2.0
 * @deprecated WP 2.9.0 Use _x()
 * @see _x()
 *
 * @param string $text Text to translate.
 * @param string $domain Optional. Domain to retrieve the translated text.
 * @return string Translated context string without pipe.
 */
function _c( $text, $domain = 'default' ) {
	_deprecated_function( __FUNCTION__, '2.9.0', '_x()' );
	return before_last_bar( translate( $text, $domain ) );
}

/**
 * Translates $text like translate(), but assumes that the text
 * contains a context after its last vertical bar.
 *
 * @since WP 2.5.0
 * @deprecated WP 3.0.0 Use _x()
 * @see _x()
 *
 * @param string $text Text to translate.
 * @param string $domain Domain to retrieve the translated text.
 * @return string Translated text.
 */
function translate_with_context( $text, $domain = 'default' ) {
	_deprecated_function( __FUNCTION__, '2.9.0', '_x()' );
	return before_last_bar( translate( $text, $domain ) );
}

/**
 * Legacy version of _n(), which supports contexts.
 *
 * Strips everything from the translation after the last bar.
 *
 * @since WP 2.7.0
 * @deprecated WP 3.0.0 Use _nx()
 * @see _nx()
 *
 * @param string $single The text to be used if the number is singular.
 * @param string $plural The text to be used if the number is plural.
 * @param int    $number The number to compare against to use either the singular or plural form.
 * @param string $domain Optional. Text domain. Unique identifier for retrieving translated strings.
 *                       Default 'default'.
 * @return string The translated singular or plural form.
 */
function _nc( $single, $plural, $number, $domain = 'default' ) {
	_deprecated_function( __FUNCTION__, '2.9.0', '_nx()' );
	return before_last_bar( _n( $single, $plural, $number, $domain ) );
}

/**
 * Retrieve the plural or single form based on the amount.
 *
 * @since WP 1.2.0
 * @deprecated WP 2.8.0 Use _n()
 * @see _n()
 */
function __ngettext( ...$args ) { // phpcs:ignore PHPCompatibility.FunctionNameRestrictions.ReservedFunctionNames.FunctionDoubleUnderscore
	_deprecated_function( __FUNCTION__, '2.8.0', '_n()' );
	return _n( ...$args );
}

/**
 * Register plural strings in POT file, but don't translate them.
 *
 * @since WP 2.5.0
 * @deprecated WP 2.8.0 Use _n_noop()
 * @see _n_noop()
 */
function __ngettext_noop( ...$args ) { // phpcs:ignore PHPCompatibility.FunctionNameRestrictions.ReservedFunctionNames.FunctionDoubleUnderscore
	_deprecated_function( __FUNCTION__, '2.8.0', '_n_noop()' );
	return _n_noop( ...$args );

}

/**
 * Retrieve all autoload options, or all options if no autoloaded ones exist.
 *
 * @since WP 1.0.0
 * @deprecated WP 3.0.0 Use wp_load_alloptions())
 * @see wp_load_alloptions()
 *
 * @return array List of all options.
 */
function get_alloptions() {
	_deprecated_function( __FUNCTION__, '3.0.0', 'wp_load_alloptions()' );
	return wp_load_alloptions();
}

/**
 * Retrieve HTML content of attachment image with link.
 *
 * @since WP 2.0.0
 * @deprecated WP 2.5.0 Use wp_get_attachment_link()
 * @see wp_get_attachment_link()
 *
 * @param int   $id       Optional. Post ID.
 * @param bool  $fullsize Optional. Whether to use full size image. Default false.
 * @param array $max_dims Optional. Max image dimensions.
 * @param bool $permalink Optional. Whether to include permalink to image. Default false.
 * @return string
 */
function get_the_attachment_link($id = 0, $fullsize = false, $max_dims = false, $permalink = false) {
	_deprecated_function( __FUNCTION__, '2.5.0', 'wp_get_attachment_link()' );
	$id = (int) $id;
	$_post = get_post($id);

	if ( ('attachment' != $_post->post_type) || !$url = wp_get_attachment_url($_post->ID) )
		return __('Missing Attachment');

	if ( $permalink )
		$url = get_attachment_link($_post->ID);

	$post_title = esc_attr($_post->post_title);

	$innerHTML = get_attachment_innerHTML($_post->ID, $fullsize, $max_dims);
	return "<a href='$url' title='$post_title'>$innerHTML</a>";
}

/**
 * Retrieve icon URL and Path.
 *
 * @since WP 2.1.0
 * @deprecated WP 2.5.0 Use wp_get_attachment_image_src()
 * @see wp_get_attachment_image_src()
 *
 * @param int  $id       Optional. Post ID.
 * @param bool $fullsize Optional. Whether to have full image. Default false.
 * @return array Icon URL and full path to file, respectively.
 */
function get_attachment_icon_src( $id = 0, $fullsize = false ) {
	_deprecated_function( __FUNCTION__, '2.5.0', 'wp_get_attachment_image_src()' );
	$id = (int) $id;
	if ( !$post = get_post($id) )
		return false;

	$file = get_attached_file( $post->ID );

	if ( !$fullsize && $src = wp_get_attachment_thumb_url( $post->ID ) ) {
		// We have a thumbnail desired, specified and existing.

		$src_file = wp_basename($src);
	} elseif ( wp_attachment_is_image( $post->ID ) ) {
		// We have an image without a thumbnail.

		$src = wp_get_attachment_url( $post->ID );
		$src_file = & $file;
	} elseif ( $src = wp_mime_type_icon( $post->ID, '.svg' ) ) {
		// No thumb, no image. We'll look for a mime-related icon instead.

		/** This filter is documented in wp-includes/post.php */
		$icon_dir = apply_filters( 'icon_dir', get_template_directory() . '/images' );
		$src_file = $icon_dir . '/' . wp_basename($src);
	}

	if ( !isset($src) || !$src )
		return false;

	return array($src, $src_file);
}

/**
 * Retrieve HTML content of icon attachment image element.
 *
 * @since WP 2.0.0
 * @deprecated WP 2.5.0 Use wp_get_attachment_image()
 * @see wp_get_attachment_image()
 *
 * @param int   $id       Optional. Post ID.
 * @param bool  $fullsize Optional. Whether to have full size image. Default false.
 * @param array $max_dims Optional. Dimensions of image.
 * @return string|false HTML content.
 */
function get_attachment_icon( $id = 0, $fullsize = false, $max_dims = false ) {
	_deprecated_function( __FUNCTION__, '2.5.0', 'wp_get_attachment_image()' );
	$id = (int) $id;
	if ( !$post = get_post($id) )
		return false;

	if ( !$src = get_attachment_icon_src( $post->ID, $fullsize ) )
		return false;

	list($src, $src_file) = $src;

	// Do we need to constrain the image?
	if ( ($max_dims = apply_filters('attachment_max_dims', $max_dims)) && file_exists($src_file) ) {

		$imagesize = wp_getimagesize($src_file);

		if (($imagesize[0] > $max_dims[0]) || $imagesize[1] > $max_dims[1] ) {
			$actual_aspect = $imagesize[0] / $imagesize[1];
			$desired_aspect = $max_dims[0] / $max_dims[1];

			if ( $actual_aspect >= $desired_aspect ) {
				$height = $actual_aspect * $max_dims[0];
				$constraint = "width='{$max_dims[0]}' ";
				$post->iconsize = array($max_dims[0], $height);
			} else {
				$width = $max_dims[1] / $actual_aspect;
				$constraint = "height='{$max_dims[1]}' ";
				$post->iconsize = array($width, $max_dims[1]);
			}
		} else {
			$post->iconsize = array($imagesize[0], $imagesize[1]);
			$constraint = '';
		}
	} else {
		$constraint = '';
	}

	$post_title = esc_attr($post->post_title);

	$icon = "<img src='$src' title='$post_title' alt='$post_title' $constraint/>";

	return apply_filters( 'attachment_icon', $icon, $post->ID );
}

/**
 * Retrieve HTML content of image element.
 *
 * @since WP 2.0.0
 * @deprecated WP 2.5.0 Use wp_get_attachment_image()
 * @see wp_get_attachment_image()
 *
 * @param int   $id       Optional. Post ID.
 * @param bool  $fullsize Optional. Whether to have full size image. Default false.
 * @param array $max_dims Optional. Dimensions of image.
 * @return string|false
 */
function get_attachment_innerHTML($id = 0, $fullsize = false, $max_dims = false) {
	_deprecated_function( __FUNCTION__, '2.5.0', 'wp_get_attachment_image()' );
	$id = (int) $id;
	if ( !$post = get_post($id) )
		return false;

	if ( $innerHTML = get_attachment_icon($post->ID, $fullsize, $max_dims))
		return $innerHTML;

	$innerHTML = esc_attr($post->post_title);

	return apply_filters('attachment_innerHTML', $innerHTML, $post->ID);
}

/**
 * Retrieves bookmark data based on ID.
 *
 * @since WP 2.0.0
 * @deprecated WP 2.1.0 Use get_bookmark()
 * @see get_bookmark()
 *
 * @param int    $bookmark_id ID of link
 * @param string $output      Optional. Type of output. Accepts OBJECT, ARRAY_N, or ARRAY_A.
 *                            Default OBJECT.
 * @param string $filter      Optional. How to filter the link for output. Accepts 'raw', 'edit',
 *                            'attribute', 'js', 'db', or 'display'. Default 'raw'.
 * @return object|array Bookmark object or array, depending on the type specified by `$output`.
 */
function get_link( $bookmark_id, $output = OBJECT, $filter = 'raw' ) {
	_deprecated_function( __FUNCTION__, '2.1.0', 'get_bookmark()' );
	return get_bookmark($bookmark_id, $output, $filter);
}

/**
 * Checks and cleans a URL.
 *
 * A number of characters are removed from the URL. If the URL is for displaying
 * (the default behavior) ampersands are also replaced. The 'clean_url' filter
 * is applied to the returned cleaned URL.
 *
 * @since WP 1.2.0
 * @deprecated WP 3.0.0 Use esc_url()
 * @see esc_url()
 *
 * @param string $url The URL to be cleaned.
 * @param array $protocols Optional. An array of acceptable protocols.
 * @param string $context Optional. How the URL will be used. Default is 'display'.
 * @return string The cleaned $url after the {@see 'clean_url'} filter is applied.
 */
function clean_url( $url, $protocols = null, $context = 'display' ) {
	if ( $context == 'db' )
		_deprecated_function( 'clean_url( $context = \'db\' )', '3.0.0', 'sanitize_url()' );
	else
		_deprecated_function( __FUNCTION__, '3.0.0', 'esc_url()' );
	return esc_url( $url, $protocols, $context );
}

/**
 * Escape single quotes, specialchar double quotes, and fix line endings.
 *
 * The filter {@see 'js_escape'} is also applied by esc_js().
 *
 * @since WP 2.0.4
 * @deprecated WP 2.8.0 Use esc_js()
 * @see esc_js()
 *
 * @param string $text The text to be escaped.
 * @return string Escaped text.
 */
function js_escape( $text ) {
	_deprecated_function( __FUNCTION__, '2.8.0', 'esc_js()' );
	return esc_js( $text );
}

/**
 * Legacy escaping for HTML blocks.
 *
 * @deprecated WP 2.8.0 Use esc_html()
 * @see esc_html()
 *
 * @param string       $text          Text to escape.
 * @param string       $quote_style   Unused.
 * @param false|string $charset       Unused.
 * @param false        $double_encode Whether to double encode. Unused.
 * @return string Escaped `$text`.
 */
function wp_specialchars( $text, $quote_style = ENT_NOQUOTES, $charset = false, $double_encode = false ) {
	_deprecated_function( __FUNCTION__, '2.8.0', 'esc_html()' );
	if ( func_num_args() > 1 ) { // Maintain back-compat for people passing additional arguments.
		return _wp_specialchars( $text, $quote_style, $charset, $double_encode );
	} else {
		return esc_html( $text );
	}
}

/**
 * Escaping for HTML attributes.
 *
 * @since WP 2.0.6
 * @deprecated WP 2.8.0 Use esc_attr()
 * @see esc_attr()
 *
 * @param string $text
 * @return string
 */
function attribute_escape( $text ) {
	_deprecated_function( __FUNCTION__, '2.8.0', 'esc_attr()' );
	return esc_attr( $text );
}

/**
 * Register widget for sidebar with backward compatibility.
 *
 * Allows $name to be an array that accepts either three elements to grab the
 * first element and the third for the name or just uses the first element of
 * the array for the name.
 *
 * Passes to wp_register_sidebar_widget() after argument list and backward
 * compatibility is complete.
 *
 * @since WP 2.2.0
 * @deprecated WP 2.8.0 Use wp_register_sidebar_widget()
 * @see wp_register_sidebar_widget()
 *
 * @param string|int $name            Widget ID.
 * @param callable   $output_callback Run when widget is called.
 * @param string     $classname       Optional. Classname widget option. Default empty.
 * @param mixed      ...$params       Widget parameters.
 */
function register_sidebar_widget($name, $output_callback, $classname = '', ...$params) {
	_deprecated_function( __FUNCTION__, '2.8.0', 'wp_register_sidebar_widget()' );
	// Compat.
	if ( is_array( $name ) ) {
		if ( count( $name ) === 3 ) {
			$name = sprintf( $name[0], $name[2] );
		} else {
			$name = $name[0];
		}
	}

	$id      = sanitize_title( $name );
	$options = array();
	if ( ! empty( $classname ) && is_string( $classname ) ) {
		$options['classname'] = $classname;
	}

	wp_register_sidebar_widget( $id, $name, $output_callback, $options, ...$params );
}

/**
 * Serves as an alias of wp_unregister_sidebar_widget().
 *
 * @since WP 2.2.0
 * @deprecated WP 2.8.0 Use wp_unregister_sidebar_widget()
 * @see wp_unregister_sidebar_widget()
 *
 * @param int|string $id Widget ID.
 */
function unregister_sidebar_widget($id) {
	_deprecated_function( __FUNCTION__, '2.8.0', 'wp_unregister_sidebar_widget()' );
	return wp_unregister_sidebar_widget($id);
}

/**
 * Registers widget control callback for customizing options.
 *
 * Allows $name to be an array that accepts either three elements to grab the
 * first element and the third for the name or just uses the first element of
 * the array for the name.
 *
 * Passes to wp_register_widget_control() after the argument list has
 * been compiled.
 *
 * @since WP 2.2.0
 * @deprecated WP 2.8.0 Use wp_register_widget_control()
 * @see wp_register_widget_control()
 *
 * @param int|string $name             Sidebar ID.
 * @param callable   $control_callback Widget control callback to display and process form.
 * @param int        $width            Widget width.
 * @param int        $height           Widget height.
 * @param mixed      ...$params        Widget parameters.
 */
function register_widget_control($name, $control_callback, $width = '', $height = '', ...$params) {
	_deprecated_function( __FUNCTION__, '2.8.0', 'wp_register_widget_control()' );
	// Compat.
	if ( is_array( $name ) ) {
		if ( count( $name ) === 3 ) {
			$name = sprintf( $name[0], $name[2] );
		} else {
			$name = $name[0];
		}
	}

	$id      = sanitize_title( $name );
	$options = array();
	if ( ! empty( $width ) ) {
		$options['width'] = $width;
	}
	if ( ! empty( $height ) ) {
		$options['height'] = $height;
	}

	wp_register_widget_control( $id, $name, $control_callback, $options, ...$params );
}

/**
 * Alias of wp_unregister_widget_control().
 *
 * @since WP 2.2.0
 * @deprecated WP 2.8.0 Use wp_unregister_widget_control()
 * @see wp_unregister_widget_control()
 *
 * @param int|string $id Widget ID.
 */
function unregister_widget_control($id) {
	_deprecated_function( __FUNCTION__, '2.8.0', 'wp_unregister_widget_control()' );
	return wp_unregister_widget_control($id);
}

/**
 * Remove user meta data.
 *
 * @since WP 2.0.0
 * @deprecated WP 3.0.0 Use delete_user_meta()
 * @see delete_user_meta()
 *
 * @global wpdb $wpdb WordPress database abstraction object.
 *
 * @param int $user_id User ID.
 * @param string $meta_key Metadata key.
 * @param mixed $meta_value Optional. Metadata value. Default empty.
 * @return bool True deletion completed and false if user_id is not a number.
 */
function delete_usermeta( $user_id, $meta_key, $meta_value = '' ) {
	_deprecated_function( __FUNCTION__, '3.0.0', 'delete_user_meta()' );
	global $wpdb;
	if ( !is_numeric( $user_id ) )
		return false;
	$meta_key = preg_replace('|[^a-z0-9_]|i', '', $meta_key);

	if ( is_array($meta_value) || is_object($meta_value) )
		$meta_value = serialize($meta_value);
	$meta_value = trim( $meta_value );

	$cur = $wpdb->get_row( $wpdb->prepare("SELECT * FROM $wpdb->usermeta WHERE user_id = %d AND meta_key = %s", $user_id, $meta_key) );

	if ( $cur && $cur->umeta_id )
		do_action( 'delete_usermeta', $cur->umeta_id, $user_id, $meta_key, $meta_value );

	if ( ! empty($meta_value) )
		$wpdb->query( $wpdb->prepare("DELETE FROM $wpdb->usermeta WHERE user_id = %d AND meta_key = %s AND meta_value = %s", $user_id, $meta_key, $meta_value) );
	else
		$wpdb->query( $wpdb->prepare("DELETE FROM $wpdb->usermeta WHERE user_id = %d AND meta_key = %s", $user_id, $meta_key) );

	clean_user_cache( $user_id );
	wp_cache_delete( $user_id, 'user_meta' );

	if ( $cur && $cur->umeta_id )
		do_action( 'deleted_usermeta', $cur->umeta_id, $user_id, $meta_key, $meta_value );

	return true;
}

/**
 * Retrieve user metadata.
 *
 * If $user_id is not a number, then the function will fail over with a 'false'
 * boolean return value. Other returned values depend on whether there is only
 * one item to be returned, which be that single item type. If there is more
 * than one metadata value, then it will be list of metadata values.
 *
 * @since WP 2.0.0
 * @deprecated WP 3.0.0 Use get_user_meta()
 * @see get_user_meta()
 *
 * @global wpdb $wpdb WordPress database abstraction object.
 *
 * @param int $user_id User ID
 * @param string $meta_key Optional. Metadata key. Default empty.
 * @return mixed
 */
function get_usermeta( $user_id, $meta_key = '' ) {
	_deprecated_function( __FUNCTION__, '3.0.0', 'get_user_meta()' );
	global $wpdb;
	$user_id = (int) $user_id;

	if ( !$user_id )
		return false;

	if ( !empty($meta_key) ) {
		$meta_key = preg_replace('|[^a-z0-9_]|i', '', $meta_key);
		$user = wp_cache_get($user_id, 'users');
		// Check the cached user object.
		if ( false !== $user && isset($user->$meta_key) )
			$metas = array($user->$meta_key);
		else
			$metas = $wpdb->get_col( $wpdb->prepare("SELECT meta_value FROM $wpdb->usermeta WHERE user_id = %d AND meta_key = %s", $user_id, $meta_key) );
	} else {
		$metas = $wpdb->get_col( $wpdb->prepare("SELECT meta_value FROM $wpdb->usermeta WHERE user_id = %d", $user_id) );
	}

	if ( empty($metas) ) {
		if ( empty($meta_key) )
			return array();
		else
			return '';
	}

	$metas = array_map('maybe_unserialize', $metas);

	if ( count($metas) === 1 )
		return $metas[0];
	else
		return $metas;
}

/**
 * Update metadata of user.
 *
 * There is no need to serialize values, they will be serialized if it is
 * needed. The metadata key can only be a string with underscores. All else will
 * be removed.
 *
 * Will remove the metadata, if the meta value is empty.
 *
 * @since WP 2.0.0
 * @deprecated WP 3.0.0 Use update_user_meta()
 * @see update_user_meta()
 *
 * @global wpdb $wpdb WordPress database abstraction object.
 *
 * @param int $user_id User ID
 * @param string $meta_key Metadata key.
 * @param mixed $meta_value Metadata value.
 * @return bool True on successful update, false on failure.
 */
function update_usermeta( $user_id, $meta_key, $meta_value ) {
	_deprecated_function( __FUNCTION__, '3.0.0', 'update_user_meta()' );
	global $wpdb;
	if ( !is_numeric( $user_id ) )
		return false;
	$meta_key = preg_replace('|[^a-z0-9_]|i', '', $meta_key);

	/** @todo Might need fix because usermeta data is assumed to be already escaped */
	if ( is_string($meta_value) )
		$meta_value = stripslashes($meta_value);
	$meta_value = maybe_serialize($meta_value);

	if (empty($meta_value)) {
		return delete_usermeta($user_id, $meta_key);
	}

	$cur = $wpdb->get_row( $wpdb->prepare("SELECT * FROM $wpdb->usermeta WHERE user_id = %d AND meta_key = %s", $user_id, $meta_key) );

	if ( $cur )
		do_action( 'update_usermeta', $cur->umeta_id, $user_id, $meta_key, $meta_value );

	if ( !$cur )
		$wpdb->insert($wpdb->usermeta, compact('user_id', 'meta_key', 'meta_value') );
	elseif ( $cur->meta_value != $meta_value )
		$wpdb->update($wpdb->usermeta, compact('meta_value'), compact('user_id', 'meta_key') );
	else
		return false;

	clean_user_cache( $user_id );
	wp_cache_delete( $user_id, 'user_meta' );

	if ( !$cur )
		do_action( 'added_usermeta', $wpdb->insert_id, $user_id, $meta_key, $meta_value );
	else
		do_action( 'updated_usermeta', $cur->umeta_id, $user_id, $meta_key, $meta_value );

	return true;
}

/**
 * Get users for the site.
 *
 * For setups that use the multisite feature. Can be used outside of the
 * multisite feature.
 *
 * @since WP 2.2.0
 * @deprecated WP 3.1.0 Use get_users()
 * @see get_users()
 *
 * @global wpdb $wpdb WordPress database abstraction object.
 *
 * @param int $id Site ID.
 * @return array List of users that are part of that site ID
 */
function get_users_of_blog( $id = '' ) {
	_deprecated_function( __FUNCTION__, '3.1.0', 'get_users()' );

	global $wpdb;
	if ( empty( $id ) ) {
		$id = get_current_blog_id();
	}
	$blog_prefix = $wpdb->get_blog_prefix($id);
	$users = $wpdb->get_results( "SELECT user_id, user_id AS ID, user_login, display_name, user_email, meta_value FROM $wpdb->users, $wpdb->usermeta WHERE {$wpdb->users}.ID = {$wpdb->usermeta}.user_id AND meta_key = '{$blog_prefix}capabilities' ORDER BY {$wpdb->usermeta}.user_id" );
	return $users;
}

/**
 * Enable/disable automatic general feed link outputting.
 *
 * @since WP 2.8.0
 * @deprecated WP 3.0.0 Use add_theme_support()
 * @see add_theme_support()
 *
 * @param bool $add Optional. Add or remove links. Default true.
 */
function automatic_feed_links( $add = true ) {
	_deprecated_function( __FUNCTION__, '3.0.0', "add_theme_support( 'automatic-feed-links' )" );

	if ( $add )
		add_theme_support( 'automatic-feed-links' );
	else
		remove_action( 'wp_head', 'feed_links_extra', 3 ); // Just do this yourself in 3.0+.
}

/**
 * Retrieve user data based on field.
 *
 * @since WP 1.5.0
 * @deprecated WP 3.0.0 Use get_the_author_meta()
 * @see get_the_author_meta()
 *
 * @param string    $field User meta field.
 * @param false|int $user  Optional. User ID to retrieve the field for. Default false (current user).
 * @return string The author's field from the current author's DB object.
 */
function get_profile( $field, $user = false ) {
	_deprecated_function( __FUNCTION__, '3.0.0', 'get_the_author_meta()' );
	if ( $user ) {
		$user = get_user_by( 'login', $user );
		$user = $user->ID;
	}
	return get_the_author_meta( $field, $user );
}

/**
 * Retrieves the number of posts a user has written.
 *
 * @since WP 0.71
 * @deprecated WP 3.0.0 Use count_user_posts()
 * @see count_user_posts()
 *
 * @param int $userid User to count posts for.
 * @return int Number of posts the given user has written.
 */
function get_usernumposts( $userid ) {
	_deprecated_function( __FUNCTION__, '3.0.0', 'count_user_posts()' );
	return count_user_posts( $userid );
}

/**
 * Callback used to change %uXXXX to &#YYY; syntax
 *
 * @since WP 2.8.0
 * @access private
 * @deprecated WP 3.0.0
 *
 * @param array $matches Single Match
 * @return string An HTML entity
 */
function funky_javascript_callback($matches) {
	return "&#".base_convert($matches[1],16,10).";";
}

/**
 * Fixes JavaScript bugs in browsers.
 *
 * Converts unicode characters to HTML numbered entities.
 *
 * @since WP 1.5.0
 * @deprecated WP 3.0.0
 *
 * @global $is_macIE
 * @global $is_winIE
 *
 * @param string $text Text to be made safe.
 * @return string Fixed text.
 */
function funky_javascript_fix($text) {
	_deprecated_function( __FUNCTION__, '3.0.0' );
	// Fixes for browsers' JavaScript bugs.
	global $is_macIE, $is_winIE;

	if ( $is_winIE || $is_macIE )
		$text =  preg_replace_callback("/\%u([0-9A-F]{4,4})/",
					"funky_javascript_callback",
					$text);

	return $text;
}

/**
 * Checks that the taxonomy name exists.
 *
 * @since WP 2.3.0
 * @deprecated WP 3.0.0 Use taxonomy_exists()
 * @see taxonomy_exists()
 *
 * @param string $taxonomy Name of taxonomy object
 * @return bool Whether the taxonomy exists.
 */
function is_taxonomy( $taxonomy ) {
	_deprecated_function( __FUNCTION__, '3.0.0', 'taxonomy_exists()' );
	return taxonomy_exists( $taxonomy );
}

/**
 * Check if Term exists.
 *
 * @since WP 2.3.0
 * @deprecated WP 3.0.0 Use term_exists()
 * @see term_exists()
 *
 * @param int|string $term The term to check
 * @param string $taxonomy The taxonomy name to use
 * @param int $parent ID of parent term under which to confine the exists search.
 * @return mixed Get the term ID or term object, if exists.
 */
function is_term( $term, $taxonomy = '', $parent = 0 ) {
	_deprecated_function( __FUNCTION__, '3.0.0', 'term_exists()' );
	return term_exists( $term, $taxonomy, $parent );
}

/**
 * Determines whether the current admin page is generated by a plugin.
 *
 * Use global $plugin_page and/or get_plugin_page_hookname() hooks.
 *
 * @since WP 1.5.0
 * @deprecated WP 3.1.0
 *
 * @global $plugin_page
 *
 * @return bool
 */
function is_plugin_page() {
	_deprecated_function( __FUNCTION__, '3.1.0' );

	global $plugin_page;

	if ( isset($plugin_page) )
		return true;

	return false;
}

/**
 * Update the categories cache.
 *
 * This function does not appear to be used anymore or does not appear to be
 * needed. It might be a legacy function left over from when there was a need
 * for updating the category cache.
 *
 * @since WP 1.5.0
 * @deprecated WP 3.1.0
 *
 * @return bool Always return True
 */
function update_category_cache() {
	_deprecated_function( __FUNCTION__, '3.1.0' );

	return true;
}

/**
 * Check for PHP timezone support
 *
 * @since WP 2.9.0
 * @deprecated WP 3.2.0
 *
 * @return bool
 */
function wp_timezone_supported() {
	_deprecated_function( __FUNCTION__, '3.2.0' );

	return true;
}

/**
 * Displays an editor: TinyMCE, HTML, or both.
 *
 * @since WP 2.1.0
 * @deprecated WP 3.3.0 Use wp_editor()
 * @see wp_editor()
 *
 * @param string $content       Textarea content.
 * @param string $id            Optional. HTML ID attribute value. Default 'content'.
 * @param string $prev_id       Optional. Unused.
 * @param bool   $media_buttons Optional. Whether to display media buttons. Default true.
 * @param int    $tab_index     Optional. Unused.
 * @param bool   $extended      Optional. Unused.
 */
function the_editor($content, $id = 'content', $prev_id = 'title', $media_buttons = true, $tab_index = 2, $extended = true) {
	_deprecated_function( __FUNCTION__, '3.3.0', 'wp_editor()' );

	wp_editor( $content, $id, array( 'media_buttons' => $media_buttons ) );
}

/**
 * Perform the query to get the $metavalues array(s) needed by _fill_user and _fill_many_users
 *
 * @since WP 3.0.0
 * @deprecated WP 3.3.0
 *
 * @param array $ids User ID numbers list.
 * @return array of arrays. The array is indexed by user_id, containing $metavalues object arrays.
 */
function get_user_metavalues($ids) {
	_deprecated_function( __FUNCTION__, '3.3.0' );

	$objects = array();

	$ids = array_map('intval', $ids);
	foreach ( $ids as $id )
		$objects[$id] = array();

	$metas = update_meta_cache('user', $ids);

	foreach ( $metas as $id => $meta ) {
		foreach ( $meta as $key => $metavalues ) {
			foreach ( $metavalues as $value ) {
				$objects[$id][] = (object)array( 'user_id' => $id, 'meta_key' => $key, 'meta_value' => $value);
			}
		}
	}

	return $objects;
}

/**
 * Sanitize every user field.
 *
 * If the context is 'raw', then the user object or array will get minimal sanitization of the int fields.
 *
 * @since WP 2.3.0
 * @deprecated WP 3.3.0
 *
 * @param object|array $user    The user object or array.
 * @param string       $context Optional. How to sanitize user fields. Default 'display'.
 * @return object|array The now sanitized user object or array (will be the same type as $user).
 */
function sanitize_user_object($user, $context = 'display') {
	_deprecated_function( __FUNCTION__, '3.3.0' );

	if ( is_object($user) ) {
		if ( !isset($user->ID) )
			$user->ID = 0;
		if ( ! ( $user instanceof WP_User ) ) {
			$vars = get_object_vars($user);
			foreach ( array_keys($vars) as $field ) {
				if ( is_string($user->$field) || is_numeric($user->$field) )
					$user->$field = sanitize_user_field($field, $user->$field, $user->ID, $context);
			}
		}
		$user->filter = $context;
	} else {
		if ( !isset($user['ID']) )
			$user['ID'] = 0;
		foreach ( array_keys($user) as $field )
			$user[$field] = sanitize_user_field($field, $user[$field], $user['ID'], $context);
		$user['filter'] = $context;
	}

	return $user;
}

/**
 * Get boundary post relational link.
 *
 * Can either be start or end post relational link.
 *
 * @since WP 2.8.0
 * @deprecated WP 3.3.0
 *
 * @param string $title               Optional. Link title format. Default '%title'.
 * @param bool   $in_same_cat         Optional. Whether link should be in a same category.
 *                                    Default false.
 * @param string $excluded_categories Optional. Excluded categories IDs. Default empty.
 * @param bool   $start               Optional. Whether to display link to first or last post.
 *                                    Default true.
 * @return string
 */
function get_boundary_post_rel_link($title = '%title', $in_same_cat = false, $excluded_categories = '', $start = true) {
	_deprecated_function( __FUNCTION__, '3.3.0' );

	$posts = get_boundary_post($in_same_cat, $excluded_categories, $start);
	// If there is no post, stop.
	if ( empty($posts) )
		return;

	// Even though we limited get_posts() to return only 1 item it still returns an array of objects.
	$post = $posts[0];

	if ( empty($post->post_title) )
		$post->post_title = $start ? __('First Post') : __('Last Post');

	$date = mysql2date(get_option('date_format'), $post->post_date);

	$title = str_replace('%title', $post->post_title, $title);
	$title = str_replace('%date', $date, $title);
	$title = apply_filters('the_title', $title, $post->ID);

	$link = $start ? "<link rel='start' title='" : "<link rel='end' title='";
	$link .= esc_attr($title);
	$link .= "' href='" . get_permalink($post) . "' />\n";

	$boundary = $start ? 'start' : 'end';
	return apply_filters( "{$boundary}_post_rel_link", $link );
}

/**
 * Display relational link for the first post.
 *
 * @since WP 2.8.0
 * @deprecated WP 3.3.0
 *
 * @param string $title Optional. Link title format.
 * @param bool $in_same_cat Optional. Whether link should be in a same category.
 * @param string $excluded_categories Optional. Excluded categories IDs.
 */
function start_post_rel_link($title = '%title', $in_same_cat = false, $excluded_categories = '') {
	_deprecated_function( __FUNCTION__, '3.3.0' );

	echo get_boundary_post_rel_link($title, $in_same_cat, $excluded_categories, true);
}

/**
 * Get site index relational link.
 *
 * @since WP 2.8.0
 * @deprecated WP 3.3.0
 *
 * @return string
 */
function get_index_rel_link() {
	_deprecated_function( __FUNCTION__, '3.3.0' );

	$link = "<link rel='index' title='" . esc_attr( get_bloginfo( 'name', 'display' ) ) . "' href='" . esc_url( user_trailingslashit( get_bloginfo( 'url', 'display' ) ) ) . "' />\n";
	return apply_filters( "index_rel_link", $link );
}

/**
 * Display relational link for the site index.
 *
 * @since WP 2.8.0
 * @deprecated WP 3.3.0
 */
function index_rel_link() {
	_deprecated_function( __FUNCTION__, '3.3.0' );

	echo get_index_rel_link();
}

/**
 * Get parent post relational link.
 *
 * @since WP 2.8.0
 * @deprecated WP 3.3.0
 *
 * @global WP_Post $post Global post object.
 *
 * @param string $title Optional. Link title format. Default '%title'.
 * @return string
 */
function get_parent_post_rel_link( $title = '%title' ) {
	_deprecated_function( __FUNCTION__, '3.3.0' );

	if ( ! empty( $GLOBALS['post'] ) && ! empty( $GLOBALS['post']->post_parent ) )
		$post = get_post($GLOBALS['post']->post_parent);

	if ( empty($post) )
		return;

	$date = mysql2date(get_option('date_format'), $post->post_date);

	$title = str_replace('%title', $post->post_title, $title);
	$title = str_replace('%date', $date, $title);
	$title = apply_filters('the_title', $title, $post->ID);

	$link = "<link rel='up' title='";
	$link .= esc_attr( $title );
	$link .= "' href='" . get_permalink($post) . "' />\n";

	return apply_filters( "parent_post_rel_link", $link );
}

/**
 * Display relational link for parent item
 *
 * @since WP 2.8.0
 * @deprecated WP 3.3.0
 *
 * @param string $title Optional. Link title format. Default '%title'.
 */
function parent_post_rel_link( $title = '%title' ) {
	_deprecated_function( __FUNCTION__, '3.3.0' );

	echo get_parent_post_rel_link($title);
}

/**
 * Add the "Dashboard"/"Visit Site" menu.
 *
 * @since WP 3.2.0
 * @deprecated WP 3.3.0
 *
 * @param WP_Admin_Bar $wp_admin_bar WP_Admin_Bar instance.
 */
function wp_admin_bar_dashboard_view_site_menu( $wp_admin_bar ) {
	_deprecated_function( __FUNCTION__, '3.3.0' );

	$user_id = get_current_user_id();

	if ( 0 != $user_id ) {
		if ( is_admin() )
			$wp_admin_bar->add_menu( array( 'id' => 'view-site', 'title' => __( 'Visit Site' ), 'href' => home_url() ) );
		elseif ( is_multisite() )
			$wp_admin_bar->add_menu( array( 'id' => 'dashboard', 'title' => __( 'Dashboard' ), 'href' => get_dashboard_url( $user_id ) ) );
		else
			$wp_admin_bar->add_menu( array( 'id' => 'dashboard', 'title' => __( 'Dashboard' ), 'href' => admin_url() ) );
	}
}

/**
 * Checks if the current user belong to a given site.
 *
 * @since WP MU (3.0.0)
 * @deprecated WP 3.3.0 Use is_user_member_of_blog()
 * @see is_user_member_of_blog()
 *
 * @param int $blog_id Site ID
 * @return bool True if the current users belong to $blog_id, false if not.
 */
function is_blog_user( $blog_id = 0 ) {
	_deprecated_function( __FUNCTION__, '3.3.0', 'is_user_member_of_blog()' );

	return is_user_member_of_blog( get_current_user_id(), $blog_id );
}

/**
 * Open the file handle for debugging.
 *
 * @since WP 0.71
 * @deprecated WP 3.4.0 Use error_log()
 * @see error_log()
 *
 * @link https://www.php.net/manual/en/function.error-log.php
 *
 * @param string $filename File name.
 * @param string $mode     Type of access you required to the stream.
 * @return false Always false.
 */
function debug_fopen( $filename, $mode ) {
	_deprecated_function( __FUNCTION__, '3.4.0', 'error_log()' );
	return false;
}

/**
 * Write contents to the file used for debugging.
 *
 * @since WP 0.71
 * @deprecated WP 3.4.0 Use error_log()
 * @see error_log()
 *
 * @link https://www.php.net/manual/en/function.error-log.php
 *
 * @param mixed  $fp      Unused.
 * @param string $message Message to log.
 */
function debug_fwrite( $fp, $message ) {
	_deprecated_function( __FUNCTION__, '3.4.0', 'error_log()' );
	if ( ! empty( $GLOBALS['debug'] ) )
		error_log( $message );
}

/**
 * Close the debugging file handle.
 *
 * @since WP 0.71
 * @deprecated WP 3.4.0 Use error_log()
 * @see error_log()
 *
 * @link https://www.php.net/manual/en/function.error-log.php
 *
 * @param mixed $fp Unused.
 */
function debug_fclose( $fp ) {
	_deprecated_function( __FUNCTION__, '3.4.0', 'error_log()' );
}

/**
 * Retrieve list of themes with theme data in theme directory.
 *
 * The theme is broken, if it doesn't have a parent theme and is missing either
 * style.css and, or index.php. If the theme has a parent theme then it is
 * broken, if it is missing style.css; index.php is optional.
 *
 * @since WP 1.5.0
 * @deprecated WP 3.4.0 Use wp_get_themes()
 * @see wp_get_themes()
 *
 * @return array Theme list with theme data.
 */
function get_themes() {
	_deprecated_function( __FUNCTION__, '3.4.0', 'wp_get_themes()' );

	global $wp_themes;
	if ( isset( $wp_themes ) )
		return $wp_themes;

	$themes = wp_get_themes();
	$wp_themes = array();

	foreach ( $themes as $theme ) {
		$name = $theme->get('Name');
		if ( isset( $wp_themes[ $name ] ) )
			$wp_themes[ $name . '/' . $theme->get_stylesheet() ] = $theme;
		else
			$wp_themes[ $name ] = $theme;
	}

	return $wp_themes;
}

/**
 * Retrieve theme data.
 *
 * @since WP 1.5.0
 * @deprecated WP 3.4.0 Use wp_get_theme()
 * @see wp_get_theme()
 *
 * @param string $theme Theme name.
 * @return array|null Null, if theme name does not exist. Theme data, if exists.
 */
function get_theme( $theme ) {
	_deprecated_function( __FUNCTION__, '3.4.0', 'wp_get_theme( $stylesheet )' );

	$themes = get_themes();
	if ( is_array( $themes ) && array_key_exists( $theme, $themes ) )
		return $themes[ $theme ];
	return null;
}

/**
 * Retrieve current theme name.
 *
 * @since WP 1.5.0
 * @deprecated WP 3.4.0 Use wp_get_theme()
 * @see wp_get_theme()
 *
 * @return string
 */
function get_current_theme() {
	_deprecated_function( __FUNCTION__, '3.4.0', 'wp_get_theme()' );

	if ( $theme = get_option( 'current_theme' ) )
		return $theme;

	return wp_get_theme()->get('Name');
}

/**
 * Accepts matches array from preg_replace_callback in wpautop() or a string.
 *
 * Ensures that the contents of a `<pre>...</pre>` HTML block are not
 * converted into paragraphs or line breaks.
 *
 * @since WP 1.2.0
 * @deprecated WP 3.4.0
 *
 * @param array|string $matches The array or string
 * @return string The pre block without paragraph/line break conversion.
 */
function clean_pre($matches) {
	_deprecated_function( __FUNCTION__, '3.4.0' );

	if ( is_array($matches) )
		$text = $matches[1] . $matches[2] . "</pre>";
	else
		$text = $matches;

	$text = str_replace(array('<br />', '<br/>', '<br>'), array('', '', ''), $text);
	$text = str_replace('<p>', "\n", $text);
	$text = str_replace('</p>', '', $text);

	return $text;
}


/**
 * Add callbacks for image header display.
 *
 * @since WP 2.1.0
 * @deprecated WP 3.4.0 Use add_theme_support()
 * @see add_theme_support()
 *
 * @param callable $wp_head_callback Call on the {@see 'wp_head'} action.
 * @param callable $admin_head_callback Call on custom header administration screen.
 * @param callable $admin_preview_callback Output a custom header image div on the custom header administration screen. Optional.
 */
function add_custom_image_header( $wp_head_callback, $admin_head_callback, $admin_preview_callback = '' ) {
	_deprecated_function( __FUNCTION__, '3.4.0', 'add_theme_support( \'custom-header\', $args )' );
	$args = array(
		'wp-head-callback'    => $wp_head_callback,
		'admin-head-callback' => $admin_head_callback,
	);
	if ( $admin_preview_callback )
		$args['admin-preview-callback'] = $admin_preview_callback;
	return add_theme_support( 'custom-header', $args );
}

/**
 * Remove image header support.
 *
 * @since WP 3.1.0
 * @deprecated WP 3.4.0 Use remove_theme_support()
 * @see remove_theme_support()
 *
 * @return null|bool Whether support was removed.
 */
function remove_custom_image_header() {
	_deprecated_function( __FUNCTION__, '3.4.0', 'remove_theme_support( \'custom-header\' )' );
	return remove_theme_support( 'custom-header' );
}

/**
 * Add callbacks for background image display.
 *
 * @since WP 3.0.0
 * @deprecated WP 3.4.0 Use add_theme_support()
 * @see add_theme_support()
 *
 * @param callable $wp_head_callback Call on the {@see 'wp_head'} action.
 * @param callable $admin_head_callback Call on custom background administration screen.
 * @param callable $admin_preview_callback Output a custom background image div on the custom background administration screen. Optional.
 */
function add_custom_background( $wp_head_callback = '', $admin_head_callback = '', $admin_preview_callback = '' ) {
	_deprecated_function( __FUNCTION__, '3.4.0', 'add_theme_support( \'custom-background\', $args )' );
	$args = array();
	if ( $wp_head_callback )
		$args['wp-head-callback'] = $wp_head_callback;
	if ( $admin_head_callback )
		$args['admin-head-callback'] = $admin_head_callback;
	if ( $admin_preview_callback )
		$args['admin-preview-callback'] = $admin_preview_callback;
	return add_theme_support( 'custom-background', $args );
}

/**
 * Remove custom background support.
 *
 * @since WP 3.1.0
 * @deprecated WP 3.4.0 Use add_custom_background()
 * @see add_custom_background()
 *
 * @return null|bool Whether support was removed.
 */
function remove_custom_background() {
	_deprecated_function( __FUNCTION__, '3.4.0', 'remove_theme_support( \'custom-background\' )' );
	return remove_theme_support( 'custom-background' );
}

/**
 * Retrieve theme data from parsed theme file.
 *
 * @since WP 1.5.0
 * @deprecated WP 3.4.0 Use wp_get_theme()
 * @see wp_get_theme()
 *
 * @param string $theme_file Theme file path.
 * @return array Theme data.
 */
function get_theme_data( $theme_file ) {
	_deprecated_function( __FUNCTION__, '3.4.0', 'wp_get_theme()' );
	$theme = new WP_Theme( wp_basename( dirname( $theme_file ) ), dirname( dirname( $theme_file ) ) );

	$theme_data = array(
		'Name' => $theme->get('Name'),
		'URI' => $theme->display('ThemeURI', true, false),
		'Description' => $theme->display('Description', true, false),
		'Author' => $theme->display('Author', true, false),
		'AuthorURI' => $theme->display('AuthorURI', true, false),
		'Version' => $theme->get('Version'),
		'Template' => $theme->get('Template'),
		'Status' => $theme->get('Status'),
		'Tags' => $theme->get('Tags'),
		'Title' => $theme->get('Name'),
		'AuthorName' => $theme->get('Author'),
	);

	foreach ( apply_filters( 'extra_theme_headers', array() ) as $extra_header ) {
		if ( ! isset( $theme_data[ $extra_header ] ) )
			$theme_data[ $extra_header ] = $theme->get( $extra_header );
	}

	return $theme_data;
}

/**
 * Alias of update_post_cache().
 *
 * @see update_post_cache() Posts and pages are the same, alias is intentional
 *
 * @since WP 1.5.1
 * @deprecated WP 3.4.0 Use update_post_cache()
 * @see update_post_cache()
 *
 * @param array $pages list of page objects
 */
function update_page_cache( &$pages ) {
	_deprecated_function( __FUNCTION__, '3.4.0', 'update_post_cache()' );

	update_post_cache( $pages );
}

/**
 * Will clean the page in the cache.
 *
 * Clean (read: delete) page from cache that matches $id. Will also clean cache
 * associated with 'all_page_ids' and 'get_pages'.
 *
 * @since WP 2.0.0
 * @deprecated WP 3.4.0 Use clean_post_cache
 * @see clean_post_cache()
 *
 * @param int $id Page ID to clean
 */
function clean_page_cache( $id ) {
	_deprecated_function( __FUNCTION__, '3.4.0', 'clean_post_cache()' );

	clean_post_cache( $id );
}

/**
 * Retrieve nonce action "Are you sure" message.
 *
 * Deprecated in 3.4.1 and 3.5.0. Backported to 3.3.3.
 *
 * @since WP 2.0.4
 * @deprecated WP 3.4.1 Use wp_nonce_ays()
 * @see wp_nonce_ays()
 *
 * @param string $action Nonce action.
 * @return string Are you sure message.
 */
function wp_explain_nonce( $action ) {
	_deprecated_function( __FUNCTION__, '3.4.1', 'wp_nonce_ays()' );
	return __( 'Are you sure you want to do this?' );
}

/**
 * Display "sticky" CSS class, if a post is sticky.
 *
 * @since WP 2.7.0
 * @deprecated WP 3.5.0 Use post_class()
 * @see post_class()
 *
 * @param int $post_id An optional post ID.
 */
function sticky_class( $post_id = null ) {
	_deprecated_function( __FUNCTION__, '3.5.0', 'post_class()' );
	if ( is_sticky( $post_id ) )
		echo ' sticky';
}

/**
 * Retrieve post ancestors.
 *
 * This is no longer needed as WP_Post lazy-loads the ancestors
 * property with get_post_ancestors().
 *
 * @since WP 2.3.4
 * @deprecated WP 3.5.0 Use get_post_ancestors()
 * @see get_post_ancestors()
 *
 * @param WP_Post $post Post object, passed by reference (unused).
 */
function _get_post_ancestors( &$post ) {
	_deprecated_function( __FUNCTION__, '3.5.0' );
}

/**
 * Load an image from a string, if PHP supports it.
 *
 * @since WP 2.1.0
 * @deprecated WP 3.5.0 Use wp_get_image_editor()
 * @see wp_get_image_editor()
 *
 * @param string $file Filename of the image to load.
 * @return resource|GdImage|string The resulting image resource or GdImage instance on success,
 *                                 error string on failure.
 */
function wp_load_image( $file ) {
	_deprecated_function( __FUNCTION__, '3.5.0', 'wp_get_image_editor()' );

	if ( is_numeric( $file ) )
		$file = get_attached_file( $file );

	if ( ! is_file( $file ) ) {
		/* translators: %s: File name. */
		return sprintf( __( 'File &#8220;%s&#8221; does not exist?' ), $file );
	}

	if ( ! function_exists('imagecreatefromstring') )
		return __('The GD image library is not installed.');

	// Set artificially high because GD uses uncompressed images in memory.
	wp_raise_memory_limit( 'image' );

	$image = imagecreatefromstring( file_get_contents( $file ) );

	if ( ! is_gd_image( $image ) ) {
		/* translators: %s: File name. */
		return sprintf( __( 'File &#8220;%s&#8221; is not an image.' ), $file );
	}

	return $image;
}

/**
 * Scale down an image to fit a particular size and save a new copy of the image.
 *
 * The PNG transparency will be preserved using the function, as well as the
 * image type. If the file going in is PNG, then the resized image is going to
 * be PNG. The only supported image types are PNG, GIF, and JPEG.
 *
 * Some functionality requires API to exist, so some PHP version may lose out
 * support. This is not the fault of WordPress (where functionality is
 * downgraded, not actual defects), but of your PHP version.
 *
 * @since WP 2.5.0
 * @deprecated WP 3.5.0 Use wp_get_image_editor()
 * @see wp_get_image_editor()
 *
 * @param string $file         Image file path.
 * @param int    $max_w        Maximum width to resize to.
 * @param int    $max_h        Maximum height to resize to.
 * @param bool   $crop         Optional. Whether to crop image or resize. Default false.
 * @param string $suffix       Optional. File suffix. Default null.
 * @param string $dest_path    Optional. New image file path. Default null.
 * @param int    $jpeg_quality Optional. Image quality percentage. Default 90.
 * @return mixed WP_Error on failure. String with new destination path.
 */
function image_resize( $file, $max_w, $max_h, $crop = false, $suffix = null, $dest_path = null, $jpeg_quality = 90 ) {
	_deprecated_function( __FUNCTION__, '3.5.0', 'wp_get_image_editor()' );

	$editor = wp_get_image_editor( $file );
	if ( is_wp_error( $editor ) )
		return $editor;
	$editor->set_quality( $jpeg_quality );

	$resized = $editor->resize( $max_w, $max_h, $crop );
	if ( is_wp_error( $resized ) )
		return $resized;

	$dest_file = $editor->generate_filename( $suffix, $dest_path );
	$saved = $editor->save( $dest_file );

	if ( is_wp_error( $saved ) )
		return $saved;

	return $dest_file;
}

/**
 * Retrieve a single post, based on post ID.
 *
 * Has categories in 'post_category' property or key. Has tags in 'tags_input'
 * property or key.
 *
 * @since WP 1.0.0
 * @deprecated WP 3.5.0 Use get_post()
 * @see get_post()
 *
 * @param int $postid Post ID.
 * @param string $mode How to return result, either OBJECT, ARRAY_N, or ARRAY_A.
 * @return WP_Post|null Post object or array holding post contents and information
 */
function wp_get_single_post( $postid = 0, $mode = OBJECT ) {
	_deprecated_function( __FUNCTION__, '3.5.0', 'get_post()' );
	return get_post( $postid, $mode );
}

/**
 * Check that the user login name and password is correct.
 *
 * @since WP 0.71
 * @deprecated WP 3.5.0 Use wp_authenticate()
 * @see wp_authenticate()
 *
 * @param string $user_login User name.
 * @param string $user_pass User password.
 * @return bool False if does not authenticate, true if username and password authenticates.
 */
function user_pass_ok($user_login, $user_pass) {
	_deprecated_function( __FUNCTION__, '3.5.0', 'wp_authenticate()' );
	$user = wp_authenticate( $user_login, $user_pass );
	if ( is_wp_error( $user ) )
		return false;

	return true;
}

/**
 * Callback formerly fired on the save_post hook. No longer needed.
 *
 * @since WP 2.3.0
 * @deprecated WP 3.5.0
 */
function _save_post_hook() {}

/**
 * Check if the installed version of GD supports particular image type
 *
 * @since WP 2.9.0
 * @deprecated WP 3.5.0 Use wp_image_editor_supports()
 * @see wp_image_editor_supports()
 *
 * @param string $mime_type
 * @return bool
 */
function gd_edit_image_support($mime_type) {
	_deprecated_function( __FUNCTION__, '3.5.0', 'wp_image_editor_supports()' );

	if ( function_exists('imagetypes') ) {
		switch( $mime_type ) {
			case 'image/jpeg':
				return (imagetypes() & IMG_JPG) != 0;
			case 'image/png':
				return (imagetypes() & IMG_PNG) != 0;
			case 'image/gif':
				return (imagetypes() & IMG_GIF) != 0;
			case 'image/webp':
				return (imagetypes() & IMG_WEBP) != 0;
			case 'image/avif':
				return (imagetypes() & IMG_AVIF) != 0;
			}
	} else {
		switch( $mime_type ) {
			case 'image/jpeg':
				return function_exists('imagecreatefromjpeg');
			case 'image/png':
				return function_exists('imagecreatefrompng');
			case 'image/gif':
				return function_exists('imagecreatefromgif');
			case 'image/webp':
				return function_exists('imagecreatefromwebp');
			case 'image/avif':
				return function_exists('imagecreatefromavif');
		}
	}
	return false;
}

/**
 * Converts an integer byte value to a shorthand byte value.
 *
 * @since WP 2.3.0
 * @deprecated WP 3.6.0 Use size_format()
 * @see size_format()
 *
 * @param int $bytes An integer byte value.
 * @return string A shorthand byte value.
 */
function wp_convert_bytes_to_hr( $bytes ) {
	_deprecated_function( __FUNCTION__, '3.6.0', 'size_format()' );

	$units = array( 0 => 'B', 1 => 'KB', 2 => 'MB', 3 => 'GB', 4 => 'TB' );
	$log   = log( $bytes, KB_IN_BYTES );
	$power = (int) $log;
	$size  = KB_IN_BYTES ** ( $log - $power );

	if ( ! is_nan( $size ) && array_key_exists( $power, $units ) ) {
		$unit = $units[ $power ];
	} else {
		$size = $bytes;
		$unit = $units[0];
	}

	return $size . $unit;
}

/**
 * Formerly used internally to tidy up the search terms.
 *
 * @since WP 2.9.0
 * @access private
 * @deprecated WP 3.7.0
 *
 * @param string $t Search terms to "tidy", e.g. trim.
 * @return string Trimmed search terms.
 */
function _search_terms_tidy( $t ) {
	_deprecated_function( __FUNCTION__, '3.7.0' );
	return trim( $t, "\"'\n\r " );
}

/**
 * Determine if TinyMCE is available.
 *
 * Checks to see if the user has deleted the tinymce files to slim down
 * their WordPress installation.
 *
 * @since WP 2.1.0
 * @deprecated WP 3.9.0
 *
 * @return bool Whether TinyMCE exists.
 */
function rich_edit_exists() {
	global $wp_rich_edit_exists;
	_deprecated_function( __FUNCTION__, '3.9.0' );

	if ( ! isset( $wp_rich_edit_exists ) )
		$wp_rich_edit_exists = file_exists( ABSPATH . WPINC . '/js/tinymce/tinymce.js' );

	return $wp_rich_edit_exists;
}

/**
 * Old callback for tag link tooltips.
 *
 * @since WP 2.7.0
 * @access private
 * @deprecated WP 3.9.0
 *
 * @param int $count Number of topics.
 * @return int Number of topics.
 */
function default_topic_count_text( $count ) {
	return $count;
}

/**
 * Formerly used to escape strings before inserting into the DB.
 *
 * Has not performed this function for many, many years. Use wpdb::prepare() instead.
 *
 * @since WP 0.71
 * @deprecated WP 3.9.0
 *
 * @param string $content The text to format.
 * @return string The very same text.
 */
function format_to_post( $content ) {
	_deprecated_function( __FUNCTION__, '3.9.0' );
	return $content;
}

/**
 * Formerly used to escape strings before searching the DB. It was poorly documented and never worked as described.
 *
 * @since WP 2.5.0
 * @deprecated WP 4.0.0 Use wpdb::esc_like()
 * @see wpdb::esc_like()
 *
 * @param string $text The text to be escaped.
 * @return string text, safe for inclusion in LIKE query.
 */
function like_escape($text) {
	_deprecated_function( __FUNCTION__, '4.0.0', 'wpdb::esc_like()' );
	return str_replace( array( "%", "_" ), array( "\\%", "\\_" ), $text );
}

/**
 * Determines if the URL can be accessed over SSL.
 *
 * Determines if the URL can be accessed over SSL by using the WordPress HTTP API to access
 * the URL using https as the scheme.
 *
 * @since WP 2.5.0
 * @deprecated WP 4.0.0
 *
 * @param string $url The URL to test.
 * @return bool Whether SSL access is available.
 */
function url_is_accessable_via_ssl( $url ) {
	_deprecated_function( __FUNCTION__, '4.0.0' );

	$response = wp_remote_get( set_url_scheme( $url, 'https' ) );

	if ( !is_wp_error( $response ) ) {
		$status = wp_remote_retrieve_response_code( $response );
		if ( 200 == $status || 401 == $status ) {
			return true;
		}
	}

	return false;
}

/**
 * Start preview theme output buffer.
 *
 * Will only perform task if the user has permissions and template and preview
 * query variables exist.
 *
 * @since WP 2.6.0
 * @deprecated WP 4.3.0
 */
function preview_theme() {
	_deprecated_function( __FUNCTION__, '4.3.0' );
}

/**
 * Private function to modify the current template when previewing a theme
 *
 * @since WP 2.9.0
 * @deprecated WP 4.3.0
 * @access private
 *
 * @return string
 */
function _preview_theme_template_filter() {
	_deprecated_function( __FUNCTION__, '4.3.0' );
	return '';
}

/**
 * Private function to modify the current stylesheet when previewing a theme
 *
 * @since WP 2.9.0
 * @deprecated WP 4.3.0
 * @access private
 *
 * @return string
 */
function _preview_theme_stylesheet_filter() {
	_deprecated_function( __FUNCTION__, '4.3.0' );
	return '';
}

/**
 * Callback function for ob_start() to capture all links in the theme.
 *
 * @since WP 2.6.0
 * @deprecated WP 4.3.0
 * @access private
 *
 * @param string $content
 * @return string
 */
function preview_theme_ob_filter( $content ) {
	_deprecated_function( __FUNCTION__, '4.3.0' );
	return $content;
}

/**
 * Manipulates preview theme links in order to control and maintain location.
 *
 * Callback function for preg_replace_callback() to accept and filter matches.
 *
 * @since WP 2.6.0
 * @deprecated WP 4.3.0
 * @access private
 *
 * @param array $matches
 * @return string
 */
function preview_theme_ob_filter_callback( $matches ) {
	_deprecated_function( __FUNCTION__, '4.3.0' );
	return '';
}

/**
 * Formats text for the rich text editor.
 *
 * The {@see 'richedit_pre'} filter is applied here. If `$text` is empty the filter will
 * be applied to an empty string.
 *
 * @since WP 2.0.0
 * @deprecated WP 4.3.0 Use format_for_editor()
 * @see format_for_editor()
 *
 * @param string $text The text to be formatted.
 * @return string The formatted text after filter is applied.
 */
function wp_richedit_pre($text) {
	_deprecated_function( __FUNCTION__, '4.3.0', 'format_for_editor()' );

	if ( empty( $text ) ) {
		/**
		 * Filters text returned for the rich text editor.
		 *
		 * This filter is first evaluated, and the value returned, if an empty string
		 * is passed to wp_richedit_pre(). If an empty string is passed, it results
		 * in a break tag and line feed.
		 *
		 * If a non-empty string is passed, the filter is evaluated on the wp_richedit_pre()
		 * return after being formatted.
		 *
		 * @since WP 2.0.0
		 * @deprecated WP 4.3.0
		 *
		 * @param string $output Text for the rich text editor.
		 */
		return apply_filters( 'richedit_pre', '' );
	}

	$output = convert_chars($text);
	$output = wpautop($output);
	$output = htmlspecialchars($output, ENT_NOQUOTES, get_option( 'blog_charset' ) );

	/** This filter is documented in wp-includes/deprecated.php */
	return apply_filters( 'richedit_pre', $output );
}

/**
 * Formats text for the HTML editor.
 *
 * Unless $output is empty it will pass through htmlspecialchars before the
 * {@see 'htmledit_pre'} filter is applied.
 *
 * @since WP 2.5.0
 * @deprecated WP 4.3.0 Use format_for_editor()
 * @see format_for_editor()
 *
 * @param string $output The text to be formatted.
 * @return string Formatted text after filter applied.
 */
function wp_htmledit_pre($output) {
	_deprecated_function( __FUNCTION__, '4.3.0', 'format_for_editor()' );

	if ( !empty($output) )
		$output = htmlspecialchars($output, ENT_NOQUOTES, get_option( 'blog_charset' ) ); // Convert only '< > &'.

	/**
	 * Filters the text before it is formatted for the HTML editor.
	 *
	 * @since WP 2.5.0
	 * @deprecated WP 4.3.0
	 *
	 * @param string $output The HTML-formatted text.
	 */
	return apply_filters( 'htmledit_pre', $output );
}

/**
 * Retrieve permalink from post ID.
 *
 * @since WP 1.0.0
 * @deprecated WP 4.4.0 Use get_permalink()
 * @see get_permalink()
 *
 * @param int|WP_Post $post Optional. Post ID or WP_Post object. Default is global $post.
 * @return string|false
 */
function post_permalink( $post = 0 ) {
	_deprecated_function( __FUNCTION__, '4.4.0', 'get_permalink()' );

	return get_permalink( $post );
}

/**
 * Perform a HTTP HEAD or GET request.
 *
 * If $file_path is a writable filename, this will do a GET request and write
 * the file to that path.
 *
 * @since WP 2.5.0
 * @deprecated WP 4.4.0 Use WP_Http
 * @see WP_Http
 *
 * @param string      $url       URL to fetch.
 * @param string|bool $file_path Optional. File path to write request to. Default false.
 * @param int         $red       Optional. The number of Redirects followed, Upon 5 being hit,
 *                               returns false. Default 1.
 * @return \WpOrg\Requests\Utility\CaseInsensitiveDictionary|false Headers on success, false on failure.
 */
function wp_get_http( $url, $file_path = false, $red = 1 ) {
	_deprecated_function( __FUNCTION__, '4.4.0', 'WP_Http' );

	// Add 60 seconds to the script timeout to ensure the remote request has enough time.
	if ( function_exists( 'set_time_limit' ) ) {
		@set_time_limit( 60 );
	}

	if ( $red > 5 )
		return false;

	$options = array();
	$options['redirection'] = 5;

	if ( false == $file_path )
		$options['method'] = 'HEAD';
	else
		$options['method'] = 'GET';

	$response = wp_safe_remote_request( $url, $options );

	if ( is_wp_error( $response ) )
		return false;

	$headers = wp_remote_retrieve_headers( $response );
	$headers['response'] = wp_remote_retrieve_response_code( $response );

	// WP_HTTP no longer follows redirects for HEAD requests.
	if ( 'HEAD' == $options['method'] && in_array($headers['response'], array(301, 302)) && isset( $headers['location'] ) ) {
		return wp_get_http( $headers['location'], $file_path, ++$red );
	}

	if ( false == $file_path )
		return $headers;

	// GET request - write it to the supplied filename.
	$out_fp = fopen($file_path, 'w');
	if ( !$out_fp )
		return $headers;

	fwrite( $out_fp,  wp_remote_retrieve_body( $response ) );
	fclose($out_fp);
	clearstatcache();

	return $headers;
}

/**
 * Whether SSL login should be forced.
 *
 * @since WP 2.6.0
 * @deprecated WP 4.4.0 Use force_ssl_admin()
 * @see force_ssl_admin()
 *
 * @param string|bool $force Optional Whether to force SSL login. Default null.
 * @return bool True if forced, false if not forced.
 */
function force_ssl_login( $force = null ) {
	_deprecated_function( __FUNCTION__, '4.4.0', 'force_ssl_admin()' );
	return force_ssl_admin( $force );
}

/**
 * Retrieve path of comment popup template in current or parent template.
 *
 * @since WP 1.5.0
 * @deprecated WP 4.5.0
 *
 * @return string Full path to comments popup template file.
 */
function get_comments_popup_template() {
	_deprecated_function( __FUNCTION__, '4.5.0' );

	return '';
}

/**
 * Determines whether the current URL is within the comments popup window.
 *
 * @since WP 1.5.0
 * @deprecated WP 4.5.0
 *
 * @return false Always returns false.
 */
function is_comments_popup() {
	_deprecated_function( __FUNCTION__, '4.5.0' );

	return false;
}

/**
 * Display the JS popup script to show a comment.
 *
 * @since WP 0.71
 * @deprecated WP 4.5.0
 */
function comments_popup_script() {
	_deprecated_function( __FUNCTION__, '4.5.0' );
}

/**
 * Adds element attributes to open links in new tabs.
 *
 * @since WP 0.71
 * @deprecated WP 4.5.0
 *
 * @param string $text Content to replace links to open in a new tab.
 * @return string Content that has filtered links.
 */
function popuplinks( $text ) {
	_deprecated_function( __FUNCTION__, '4.5.0' );
	$text = preg_replace('/<a (.+?)>/i', "<a $1 target='_blank' rel='external'>", $text);
	return $text;
}

/**
 * The Google Video embed handler callback.
 *
 * Deprecated function that previously assisted in turning Google Video URLs
 * into embeds but that service has since been shut down.
 *
 * @since WP 2.9.0
 * @deprecated WP 4.6.0
 *
 * @return string An empty string.
 */
function wp_embed_handler_googlevideo( $matches, $attr, $url, $rawattr ) {
	_deprecated_function( __FUNCTION__, '4.6.0' );

	return '';
}

/**
 * Retrieve path of paged template in current or parent template.
 *
 * @since WP 1.5.0
 * @deprecated WP 4.7.0 The paged.php template is no longer part of the theme template hierarchy.
 *
 * @return string Full path to paged template file.
 */
function get_paged_template() {
	_deprecated_function( __FUNCTION__, '4.7.0' );

	return get_query_template( 'paged' );
}

/**
 * Removes the HTML JavaScript entities found in early versions of Netscape 4.
 *
 * Previously, this function was pulled in from the original
 * import of kses and removed a specific vulnerability only
 * existent in early version of Netscape 4. However, this
 * vulnerability never affected any other browsers and can
 * be considered safe for the modern web.
 *
 * The regular expression which sanitized this vulnerability
 * has been removed in consideration of the performance and
 * energy demands it placed, now merely passing through its
 * input to the return.
 *
 * @since WP 1.0.0
 * @deprecated WP 4.7.0 Officially dropped security support for Netscape 4.
 *
 * @param string $content
 * @return string
 */
function wp_kses_js_entities( $content ) {
	_deprecated_function( __FUNCTION__, '4.7.0' );

	return preg_replace( '%&\s*\{[^}]*(\}\s*;?|$)%', '', $content );
}

/**
 * Sort categories by ID.
 *
 * Used by usort() as a callback, should not be used directly. Can actually be
 * used to sort any term object.
 *
 * @since WP 2.3.0
 * @deprecated WP 4.7.0 Use wp_list_sort()
 * @access private
 *
 * @param object $a
 * @param object $b
 * @return int
 */
function _usort_terms_by_ID( $a, $b ) {
	_deprecated_function( __FUNCTION__, '4.7.0', 'wp_list_sort()' );

	if ( $a->term_id > $b->term_id )
		return 1;
	elseif ( $a->term_id < $b->term_id )
		return -1;
	else
		return 0;
}

/**
 * Sort categories by name.
 *
 * Used by usort() as a callback, should not be used directly. Can actually be
 * used to sort any term object.
 *
 * @since WP 2.3.0
 * @deprecated WP 4.7.0 Use wp_list_sort()
 * @access private
 *
 * @param object $a
 * @param object $b
 * @return int
 */
function _usort_terms_by_name( $a, $b ) {
	_deprecated_function( __FUNCTION__, '4.7.0', 'wp_list_sort()' );

	return strcmp( $a->name, $b->name );
}

/**
 * Sort menu items by the desired key.
 *
 * @since WP 3.0.0
 * @deprecated WP 4.7.0 Use wp_list_sort()
 * @access private
 *
 * @global string $_menu_item_sort_prop
 *
 * @param object $a The first object to compare
 * @param object $b The second object to compare
 * @return int -1, 0, or 1 if $a is considered to be respectively less than, equal to, or greater than $b.
 */
function _sort_nav_menu_items( $a, $b ) {
	global $_menu_item_sort_prop;

	_deprecated_function( __FUNCTION__, '4.7.0', 'wp_list_sort()' );

	if ( empty( $_menu_item_sort_prop ) )
		return 0;

	if ( ! isset( $a->$_menu_item_sort_prop ) || ! isset( $b->$_menu_item_sort_prop ) )
		return 0;

	$_a = (int) $a->$_menu_item_sort_prop;
	$_b = (int) $b->$_menu_item_sort_prop;

	if ( $a->$_menu_item_sort_prop == $b->$_menu_item_sort_prop )
		return 0;
	elseif ( $_a == $a->$_menu_item_sort_prop && $_b == $b->$_menu_item_sort_prop )
		return $_a < $_b ? -1 : 1;
	else
		return strcmp( $a->$_menu_item_sort_prop, $b->$_menu_item_sort_prop );
}

/**
 * Retrieves the Press This bookmarklet link.
 *
 * @since WP 2.6.0
 * @deprecated WP 4.9.0
 * @return string
 */
function get_shortcut_link() {
	_deprecated_function( __FUNCTION__, '4.9.0' );

	$link = '';

	/**
	 * Filters the Press This bookmarklet link.
	 *
	 * @since WP 2.6.0
	 * @deprecated WP 4.9.0
	 *
	 * @param string $link The Press This bookmarklet link.
	 */
	return apply_filters( 'shortcut_link', $link );
}

/**
 * Ajax handler for saving a post from Press This.
 *
 * @since WP 4.2.0
 * @deprecated WP 4.9.0
 */
function wp_ajax_press_this_save_post() {
	_deprecated_function( __FUNCTION__, '4.9.0' );
	if ( is_plugin_active( 'press-this/press-this-plugin.php' ) ) {
		include WP_PLUGIN_DIR . '/press-this/class-wp-press-this-plugin.php';
		$wp_press_this = new WP_Press_This_Plugin();
		$wp_press_this->save_post();
	} else {
		wp_send_json_error( array( 'errorMessage' => __( 'The Press This plugin is required.' ) ) );
	}
}

/**
 * Ajax handler for creating new category from Press This.
 *
 * @since WP 4.2.0
 * @deprecated WP 4.9.0
 */
function wp_ajax_press_this_add_category() {
	_deprecated_function( __FUNCTION__, '4.9.0' );
	if ( is_plugin_active( 'press-this/press-this-plugin.php' ) ) {
		include WP_PLUGIN_DIR . '/press-this/class-wp-press-this-plugin.php';
		$wp_press_this = new WP_Press_This_Plugin();
		$wp_press_this->add_category();
	} else {
		wp_send_json_error( array( 'errorMessage' => __( 'The Press This plugin is required.' ) ) );
	}
}

/**
 * Return the user request object for the specified request ID.
 *
 * @since WP 4.9.6
 * @deprecated WP 5.4.0 Use wp_get_user_request()
 * @see wp_get_user_request()
 *
 * @param int $request_id The ID of the user request.
 * @return WP_User_Request|false
 */
function wp_get_user_request_data( $request_id ) {
	_deprecated_function( __FUNCTION__, '5.4.0', 'wp_get_user_request()' );
	return wp_get_user_request( $request_id );
}

/**
 * Filters 'img' elements in post content to add 'srcset' and 'sizes' attributes.
 *
 * @since WP 4.4.0
 * @deprecated WP 5.5.0
 *
 * @see wp_image_add_srcset_and_sizes()
 *
 * @param string $content The raw post content to be filtered.
 * @return string Converted content with 'srcset' and 'sizes' attributes added to images.
 */
function wp_make_content_images_responsive( $content ) {
	_deprecated_function( __FUNCTION__, '5.5.0', 'wp_filter_content_tags()' );

	// This will also add the `loading` attribute to `img` tags, if enabled.
	return wp_filter_content_tags( $content );
}

/**
 * Turn register globals off.
 *
 * @since WP 2.1.0
 * @access private
 * @deprecated WP 5.5.0
 */
function wp_unregister_GLOBALS() {
	// register_globals was deprecated in PHP 5.3 and removed entirely in PHP 5.4.
	_deprecated_function( __FUNCTION__, '5.5.0' );
}

/**
 * Does comment contain disallowed characters or words.
 *
 * @since WP 1.5.0
 * @deprecated WP 5.5.0 Use wp_check_comment_disallowed_list() instead.
 *                   Please consider writing more inclusive code.
 *
 * @param string $author The author of the comment
 * @param string $email The email of the comment
 * @param string $url The url used in the comment
 * @param string $comment The comment content
 * @param string $user_ip The comment author's IP address
 * @param string $user_agent The author's browser user agent
 * @return bool True if comment contains disallowed content, false if comment does not
 */
function wp_blacklist_check( $author, $email, $url, $comment, $user_ip, $user_agent ) {
	_deprecated_function( __FUNCTION__, '5.5.0', 'wp_check_comment_disallowed_list()' );

	return wp_check_comment_disallowed_list( $author, $email, $url, $comment, $user_ip, $user_agent );
}

/**
 * Filters out `register_meta()` args based on an allowed list.
 *
 * `register_meta()` args may change over time, so requiring the allowed list
 * to be explicitly turned off is a warranty seal of sorts.
 *
 * @access private
 * @since WP 4.6.0
 * @deprecated WP 5.5.0 Use _wp_register_meta_args_allowed_list() instead.
 *                   Please consider writing more inclusive code.
 *
 * @param array $args         Arguments from `register_meta()`.
 * @param array $default_args Default arguments for `register_meta()`.
 * @return array Filtered arguments.
 */
function _wp_register_meta_args_whitelist( $args, $default_args ) {
	_deprecated_function( __FUNCTION__, '5.5.0', '_wp_register_meta_args_allowed_list()' );

	return _wp_register_meta_args_allowed_list( $args, $default_args );
}

/**
 * Adds an array of options to the list of allowed options.
 *
 * @since WP 2.7.0
 * @deprecated WP 5.5.0 Use add_allowed_options() instead.
 *                   Please consider writing more inclusive code.
 *
 * @param array        $new_options
 * @param string|array $options
 * @return array
 */
function add_option_whitelist( $new_options, $options = '' ) {
	_deprecated_function( __FUNCTION__, '5.5.0', 'add_allowed_options()' );

	return add_allowed_options( $new_options, $options );
}

/**
 * Removes a list of options from the allowed options list.
 *
 * @since WP 2.7.0
 * @deprecated WP 5.5.0 Use remove_allowed_options() instead.
 *                   Please consider writing more inclusive code.
 *
 * @param array        $del_options
 * @param string|array $options
 * @return array
 */
function remove_option_whitelist( $del_options, $options = '' ) {
	_deprecated_function( __FUNCTION__, '5.5.0', 'remove_allowed_options()' );

	return remove_allowed_options( $del_options, $options );
}

/**
 * Adds slashes to only string values in an array of values.
 *
 * This should be used when preparing data for core APIs that expect slashed data.
 * This should not be used to escape data going directly into an SQL query.
 *
 * @since WP 5.3.0
 * @deprecated WP 5.6.0 Use wp_slash()
 *
 * @see wp_slash()
 *
 * @param mixed $value Scalar or array of scalars.
 * @return mixed Slashes $value
 */
function wp_slash_strings_only( $value ) {
	return map_deep( $value, 'addslashes_strings_only' );
}

/**
 * Adds slashes only if the provided value is a string.
 *
 * @since WP 5.3.0
 * @deprecated WP 5.6.0
 *
 * @see wp_slash()
 *
 * @param mixed $value
 * @return mixed
 */
function addslashes_strings_only( $value ) {
	return is_string( $value ) ? addslashes( $value ) : $value;
}

/**
 * Displays a `noindex` meta tag if required by the blog configuration.
 *
 * If a blog is marked as not being public then the `noindex` meta tag will be
 * output to tell web robots not to index the page content.
 *
 * Typical usage is as a {@see 'wp_head'} callback:
 *
 *     add_action( 'wp_head', 'noindex' );
 *
 * @see wp_no_robots()
 *
 * @since WP 2.1.0
 * @deprecated WP 5.7.0 Use wp_robots_noindex() instead on 'wp_robots' filter.
 */
function noindex() {
	_deprecated_function( __FUNCTION__, '5.7.0', 'wp_robots_noindex()' );

	// If the blog is not public, tell robots to go away.
	if ( '0' == get_option( 'blog_public' ) ) {
		wp_no_robots();
	}
}

/**
 * Display a `noindex` meta tag.
 *
 * Outputs a `noindex` meta tag that tells web robots not to index the page content.
 *
 * Typical usage is as a {@see 'wp_head'} callback:
 *
 *     add_action( 'wp_head', 'wp_no_robots' );
 *
 * @since WP 3.3.0
 * @since WP 5.3.0 Echo `noindex,nofollow` if search engine visibility is discouraged.
 * @deprecated WP 5.7.0 Use wp_robots_no_robots() instead on 'wp_robots' filter.
 */
function wp_no_robots() {
	_deprecated_function( __FUNCTION__, '5.7.0', 'wp_robots_no_robots()' );

	if ( get_option( 'blog_public' ) ) {
		echo "<meta name='robots' content='noindex,follow' />\n";
		return;
	}

	echo "<meta name='robots' content='noindex,nofollow' />\n";
}

/**
 * Display a `noindex,noarchive` meta tag and referrer `strict-origin-when-cross-origin` meta tag.
 *
 * Outputs a `noindex,noarchive` meta tag that tells web robots not to index or cache the page content.
 * Outputs a referrer `strict-origin-when-cross-origin` meta tag that tells the browser not to send
 * the full URL as a referrer to other sites when cross-origin assets are loaded.
 *
 * Typical usage is as a {@see 'wp_head'} callback:
 *
 *     add_action( 'wp_head', 'wp_sensitive_page_meta' );
 *
 * @since WP 5.0.1
 * @deprecated WP 5.7.0 Use wp_robots_sensitive_page() instead on 'wp_robots' filter
 *                   and wp_strict_cross_origin_referrer() on 'wp_head' action.
 *
 * @see wp_robots_sensitive_page()
 */
function wp_sensitive_page_meta() {
	_deprecated_function( __FUNCTION__, '5.7.0', 'wp_robots_sensitive_page()' );

	?>
	<meta name='robots' content='noindex,noarchive' />
	<?php
	wp_strict_cross_origin_referrer();
}

/**
 * Render inner blocks from the `core/columns` block for generating an excerpt.
 *
 * @since WP 5.2.0
 * @access private
 * @deprecated WP 5.8.0 Use _excerpt_render_inner_blocks() introduced in 5.8.0.
 *
 * @see _excerpt_render_inner_blocks()
 *
 * @param array $columns        The parsed columns block.
 * @param array $allowed_blocks The list of allowed inner blocks.
 * @return string The rendered inner blocks.
 */
function _excerpt_render_inner_columns_blocks( $columns, $allowed_blocks ) {
	_deprecated_function( __FUNCTION__, '5.8.0', '_excerpt_render_inner_blocks()' );

	return _excerpt_render_inner_blocks( $columns, $allowed_blocks );
}

/**
 * Renders the duotone filter SVG and returns the CSS filter property to
 * reference the rendered SVG.
 *
 * @since WP 5.9.0
 * @deprecated WP 5.9.1 Use wp_get_duotone_filter_property() introduced in 5.9.1.
 *
 * @see wp_get_duotone_filter_property()
 *
 * @param array $preset Duotone preset value as seen in theme.json.
 * @return string Duotone CSS filter property.
 */
function wp_render_duotone_filter_preset( $preset ) {
	_deprecated_function( __FUNCTION__, '5.9.1', 'wp_get_duotone_filter_property()' );

	return wp_get_duotone_filter_property( $preset );
}

/**
 * Checks whether serialization of the current block's border properties should occur.
 *
 * @since WP 5.8.0
 * @access private
 * @deprecated WP 6.0.0 Use wp_should_skip_block_supports_serialization() introduced in 6.0.0.
 *
 * @see wp_should_skip_block_supports_serialization()
 *
 * @param WP_Block_Type $block_type Block type.
 * @return bool Whether serialization of the current block's border properties
 *              should occur.
 */
function wp_skip_border_serialization( $block_type ) {
	_deprecated_function( __FUNCTION__, '6.0.0', 'wp_should_skip_block_supports_serialization()' );

	$border_support = isset( $block_type->supports['__experimentalBorder'] )
		? $block_type->supports['__experimentalBorder']
		: false;

	return is_array( $border_support ) &&
		array_key_exists( '__experimentalSkipSerialization', $border_support ) &&
		$border_support['__experimentalSkipSerialization'];
}

/**
 * Checks whether serialization of the current block's dimensions properties should occur.
 *
 * @since WP 5.9.0
 * @access private
 * @deprecated WP 6.0.0 Use wp_should_skip_block_supports_serialization() introduced in 6.0.0.
 *
 * @see wp_should_skip_block_supports_serialization()
 *
 * @param WP_Block_type $block_type Block type.
 * @return bool Whether to serialize spacing support styles & classes.
 */
function wp_skip_dimensions_serialization( $block_type ) {
	_deprecated_function( __FUNCTION__, '6.0.0', 'wp_should_skip_block_supports_serialization()' );

	$dimensions_support = isset( $block_type->supports['__experimentalDimensions'] )
		? $block_type->supports['__experimentalDimensions']
		: false;

	return is_array( $dimensions_support ) &&
		array_key_exists( '__experimentalSkipSerialization', $dimensions_support ) &&
		$dimensions_support['__experimentalSkipSerialization'];
}

/**
 * Checks whether serialization of the current block's spacing properties should occur.
 *
 * @since WP 5.9.0
 * @access private
 * @deprecated WP 6.0.0 Use wp_should_skip_block_supports_serialization() introduced in 6.0.0.
 *
 * @see wp_should_skip_block_supports_serialization()
 *
 * @param WP_Block_Type $block_type Block type.
 * @return bool Whether to serialize spacing support styles & classes.
 */
function wp_skip_spacing_serialization( $block_type ) {
	_deprecated_function( __FUNCTION__, '6.0.0', 'wp_should_skip_block_supports_serialization()' );

	$spacing_support = isset( $block_type->supports['spacing'] )
		? $block_type->supports['spacing']
		: false;

	return is_array( $spacing_support ) &&
		array_key_exists( '__experimentalSkipSerialization', $spacing_support ) &&
		$spacing_support['__experimentalSkipSerialization'];
}

/**
 * Inject the block editor assets that need to be loaded into the editor's iframe as an inline script.
 *
 * @since WP 5.8.0
 * @deprecated WP 6.0.0
 */
function wp_add_iframed_editor_assets_html() {
	_deprecated_function( __FUNCTION__, '6.0.0' );
}

/**
 * Retrieves thumbnail for an attachment.
 * Note that this works only for the (very) old image metadata style where 'thumb' was set,
 * and the 'sizes' array did not exist. This function returns false for the newer image metadata style
 * despite that 'thumbnail' is present in the 'sizes' array.
 *
 * @since WP 2.1.0
 * @deprecated WP 6.1.0
 *
 * @param int $post_id Optional. Attachment ID. Default is the ID of the global `$post`.
 * @return string|false Thumbnail file path on success, false on failure.
 */
function wp_get_attachment_thumb_file( $post_id = 0 ) {
	_deprecated_function( __FUNCTION__, '6.1.0' );

	$post_id = (int) $post_id;
	$post    = get_post( $post_id );

	if ( ! $post ) {
		return false;
	}

	// Use $post->ID rather than $post_id as get_post() may have used the global $post object.
	$imagedata = wp_get_attachment_metadata( $post->ID );

	if ( ! is_array( $imagedata ) ) {
		return false;
	}

	$file = get_attached_file( $post->ID );

	if ( ! empty( $imagedata['thumb'] ) ) {
		$thumbfile = str_replace( wp_basename( $file ), $imagedata['thumb'], $file );
		if ( file_exists( $thumbfile ) ) {
			/**
			 * Filters the attachment thumbnail file path.
			 *
			 * @since WP 2.1.0
			 *
			 * @param string $thumbfile File path to the attachment thumbnail.
			 * @param int    $post_id   Attachment ID.
			 */
			return apply_filters( 'wp_get_attachment_thumb_file', $thumbfile, $post->ID );
		}
	}

	return false;
}

/**
 * Gets the path to a translation file for loading a textdomain just in time.
 *
 * Caches the retrieved results internally.
 *
 * @since WP 4.7.0
 * @deprecated WP 6.1.0
 * @access private
 *
 * @see _load_textdomain_just_in_time()
 *
 * @param string $domain Text domain. Unique identifier for retrieving translated strings.
 * @param bool   $reset  Whether to reset the internal cache. Used by the switch to locale functionality.
 * @return string|false The path to the translation file or false if no translation file was found.
 */
function _get_path_to_translation( $domain, $reset = false ) {
	_deprecated_function( __FUNCTION__, '6.1.0', 'WP_Textdomain_Registry' );

	static $available_translations = array();

	if ( true === $reset ) {
		$available_translations = array();
	}

	if ( ! isset( $available_translations[ $domain ] ) ) {
		$available_translations[ $domain ] = _get_path_to_translation_from_lang_dir( $domain );
	}

	return $available_translations[ $domain ];
}

/**
 * Gets the path to a translation file in the languages directory for the current locale.
 *
 * Holds a cached list of available .mo files to improve performance.
 *
 * @since WP 4.7.0
 * @deprecated WP 6.1.0
 * @access private
 *
 * @see _get_path_to_translation()
 *
 * @param string $domain Text domain. Unique identifier for retrieving translated strings.
 * @return string|false The path to the translation file or false if no translation file was found.
 */
function _get_path_to_translation_from_lang_dir( $domain ) {
	_deprecated_function( __FUNCTION__, '6.1.0', 'WP_Textdomain_Registry' );

	static $cached_mofiles = null;

	if ( null === $cached_mofiles ) {
		$cached_mofiles = array();

		$locations = array(
			WP_LANG_DIR . '/plugins',
			WP_LANG_DIR . '/themes',
		);

		foreach ( $locations as $location ) {
			$mofiles = glob( $location . '/*.mo' );
			if ( $mofiles ) {
				$cached_mofiles = array_merge( $cached_mofiles, $mofiles );
			}
		}
	}

	$locale = determine_locale();
	$mofile = "{$domain}-{$locale}.mo";

	$path = WP_LANG_DIR . '/plugins/' . $mofile;
	if ( in_array( $path, $cached_mofiles, true ) ) {
		return $path;
	}

	$path = WP_LANG_DIR . '/themes/' . $mofile;
	if ( in_array( $path, $cached_mofiles, true ) ) {
		return $path;
	}

	return false;
}

/**
 * Allows multiple block styles.
 *
 * @since WP 5.9.0
 * @deprecated WP 6.1.0
 *
 * @param array $metadata Metadata for registering a block type.
 * @return array Metadata for registering a block type.
 */
function _wp_multiple_block_styles( $metadata ) {
	_deprecated_function( __FUNCTION__, '6.1.0' );
	return $metadata;
}

/**
 * Generates an inline style for a typography feature e.g. text decoration,
 * text transform, and font style.
 *
 * @since WP 5.8.0
 * @access private
 * @deprecated WP 6.1.0 Use wp_style_engine_get_styles() introduced in 6.1.0.
 *
 * @see wp_style_engine_get_styles()
 *
 * @param array  $attributes   Block's attributes.
 * @param string $feature      Key for the feature within the typography styles.
 * @param string $css_property Slug for the CSS property the inline style sets.
 * @return string CSS inline style.
 */
function wp_typography_get_css_variable_inline_style( $attributes, $feature, $css_property ) {
	_deprecated_function( __FUNCTION__, '6.1.0', 'wp_style_engine_get_styles()' );

	// Retrieve current attribute value or skip if not found.
	$style_value = _wp_array_get( $attributes, array( 'style', 'typography', $feature ), false );
	if ( ! $style_value ) {
		return;
	}

	// If we don't have a preset CSS variable, we'll assume it's a regular CSS value.
	if ( ! str_contains( $style_value, "var:preset|{$css_property}|" ) ) {
		return sprintf( '%s:%s;', $css_property, $style_value );
	}

	/*
	 * We have a preset CSS variable as the style.
	 * Get the style value from the string and return CSS style.
	 */
	$index_to_splice = strrpos( $style_value, '|' ) + 1;
	$slug            = substr( $style_value, $index_to_splice );

	// Return the actual CSS inline style e.g. `text-decoration:var(--wp--preset--text-decoration--underline);`.
	return sprintf( '%s:var(--wp--preset--%s--%s);', $css_property, $css_property, $slug );
}

/**
 * Determines whether global terms are enabled.
 *
 * @since WP 3.0.0
 * @since WP 6.1.0 This function now always returns false.
 * @deprecated WP 6.1.0
 *
 * @return bool Always returns false.
 */
function global_terms_enabled() {
	_deprecated_function( __FUNCTION__, '6.1.0' );

	return false;
}

/**
 * Filter the SQL clauses of an attachment query to include filenames.
 *
 * @since WP 4.7.0
 * @deprecated WP 6.0.3
 * @access private
 *
 * @param array $clauses An array including WHERE, GROUP BY, JOIN, ORDER BY,
 *                       DISTINCT, fields (SELECT), and LIMITS clauses.
 * @return array The unmodified clauses.
 */
function _filter_query_attachment_filenames( $clauses ) {
	_deprecated_function( __FUNCTION__, '6.0.3', 'add_filter( "wp_allow_query_attachment_by_filename", "__return_true" )' );
	remove_filter( 'posts_clauses', __FUNCTION__ );
	return $clauses;
}

/**
 * Retrieves a page given its title.
 *
 * If more than one post uses the same title, the post with the smallest ID will be returned.
 * Be careful: in case of more than one post having the same title, it will check the oldest
 * publication date, not the smallest ID.
 *
 * Because this function uses the MySQL '=' comparison, $page_title will usually be matched
 * as case-insensitive with default collation.
 *
 * @since WP 2.1.0
 * @since WP 3.0.0 The `$post_type` parameter was added.
 * @deprecated WP 6.2.0 Use WP_Query.
 *
 * @global wpdb $wpdb WordPress database abstraction object.
 *
 * @param string       $page_title Page title.
 * @param string       $output     Optional. The required return type. One of OBJECT, ARRAY_A, or ARRAY_N, which
 *                                 correspond to a WP_Post object, an associative array, or a numeric array,
 *                                 respectively. Default OBJECT.
 * @param string|array $post_type  Optional. Post type or array of post types. Default 'page'.
 * @return WP_Post|array|null WP_Post (or array) on success, or null on failure.
 */
function get_page_by_title( $page_title, $output = OBJECT, $post_type = 'page' ) {
	_deprecated_function( __FUNCTION__, '6.2.0', 'WP_Query' );
	global $wpdb;

	if ( is_array( $post_type ) ) {
		$post_type           = esc_sql( $post_type );
		$post_type_in_string = "'" . implode( "','", $post_type ) . "'";
		$sql                 = $wpdb->prepare(
			"SELECT ID
			FROM $wpdb->posts
			WHERE post_title = %s
			AND post_type IN ($post_type_in_string)",
			$page_title
		);
	} else {
		$sql = $wpdb->prepare(
			"SELECT ID
			FROM $wpdb->posts
			WHERE post_title = %s
			AND post_type = %s",
			$page_title,
			$post_type
		);
	}

	$page = $wpdb->get_var( $sql );

	if ( $page ) {
		return get_post( $page, $output );
	}

	return null;
}

/**
 * Returns the correct template for the site's home page.
 *
 * @access private
 * @since WP 6.0.0
 * @deprecated WP 6.2.0 Site Editor's server-side redirect for missing postType and postId
 *                   query args is removed. Thus, this function is no longer used.
 *
 * @return array|null A template object, or null if none could be found.
 */
function _resolve_home_block_template() {
	_deprecated_function( __FUNCTION__, '6.2.0' );

	$show_on_front = get_option( 'show_on_front' );
	$front_page_id = get_option( 'page_on_front' );

	if ( 'page' === $show_on_front && $front_page_id ) {
		return array(
				'postType' => 'page',
				'postId'   => $front_page_id,
		);
	}

	$hierarchy = array( 'front-page', 'home', 'index' );
	$template  = resolve_block_template( 'home', $hierarchy, '' );

	if ( ! $template ) {
		return null;
	}

	return array(
			'postType' => 'wp_template',
			'postId'   => $template->id,
	);
}

/**
 * Displays the link to the Windows Live Writer manifest file.
 *
 * @link https://msdn.microsoft.com/en-us/library/bb463265.aspx
 * @since WP 2.3.1
 * @deprecated WP 6.3.0 WLW manifest is no longer in use and no longer included in core,
 *                   so the output from this function is removed.
 */
function wlwmanifest_link() {
	_deprecated_function( __FUNCTION__, '6.3.0' );
}

/**
 * Queues comments for metadata lazy-loading.
 *
 * @since WP 4.5.0
 * @deprecated WP 6.3.0 Use wp_lazyload_comment_meta() instead.
 *
 * @param WP_Comment[] $comments Array of comment objects.
 */
function wp_queue_comments_for_comment_meta_lazyload( $comments ) {
	_deprecated_function( __FUNCTION__, '6.3.0', 'wp_lazyload_comment_meta()' );
	// Don't use `wp_list_pluck()` to avoid by-reference manipulation.
	$comment_ids = array();
	if ( is_array( $comments ) ) {
		foreach ( $comments as $comment ) {
			if ( $comment instanceof WP_Comment ) {
				$comment_ids[] = $comment->comment_ID;
			}
		}
	}

	wp_lazyload_comment_meta( $comment_ids );
}

/**
 * Gets the default value to use for a `loading` attribute on an element.
 *
 * This function should only be called for a tag and context if lazy-loading is generally enabled.
 *
 * The function usually returns 'lazy', but uses certain heuristics to guess whether the current element is likely to
 * appear above the fold, in which case it returns a boolean `false`, which will lead to the `loading` attribute being
 * omitted on the element. The purpose of this refinement is to avoid lazy-loading elements that are within the initial
 * viewport, which can have a negative performance impact.
 *
 * Under the hood, the function uses {@see wp_increase_content_media_count()} every time it is called for an element
 * within the main content. If the element is the very first content element, the `loading` attribute will be omitted.
 * This default threshold of 3 content elements to omit the `loading` attribute for can be customized using the
 * {@see 'wp_omit_loading_attr_threshold'} filter.
 *
 * @since WP 5.9.0
 * @deprecated WP 6.3.0 Use wp_get_loading_optimization_attributes() instead.
 * @see wp_get_loading_optimization_attributes()
 *
 * @global WP_Query $wp_query WordPress Query object.
 *
 * @param string $context Context for the element for which the `loading` attribute value is requested.
 * @return string|bool The default `loading` attribute value. Either 'lazy', 'eager', or a boolean `false`, to indicate
 *                     that the `loading` attribute should be skipped.
 */
function wp_get_loading_attr_default( $context ) {
	_deprecated_function( __FUNCTION__, '6.3.0', 'wp_get_loading_optimization_attributes()' );
	global $wp_query;

	// Skip lazy-loading for the overall block template, as it is handled more granularly.
	if ( 'template' === $context ) {
		return false;
	}

	/*
	 * Do not lazy-load images in the header block template part, as they are likely above the fold.
	 * For classic themes, this is handled in the condition below using the 'get_header' action.
	 */
	$header_area = WP_TEMPLATE_PART_AREA_HEADER;
	if ( "template_part_{$header_area}" === $context ) {
		return false;
	}

	// Special handling for programmatically created image tags.
	if ( 'the_post_thumbnail' === $context || 'wp_get_attachment_image' === $context ) {
		/*
		 * Skip programmatically created images within post content as they need to be handled together with the other
		 * images within the post content.
		 * Without this clause, they would already be counted below which skews the number and can result in the first
		 * post content image being lazy-loaded only because there are images elsewhere in the post content.
		 */
		if ( doing_filter( 'the_content' ) ) {
			return false;
		}

		// Conditionally skip lazy-loading on images before the loop.
		if (
			// Only apply for main query but before the loop.
			$wp_query->before_loop && $wp_query->is_main_query()
			/*
			 * Any image before the loop, but after the header has started should not be lazy-loaded,
			 * except when the footer has already started which can happen when the current template
			 * does not include any loop.
			 */
			&& did_action( 'get_header' ) && ! did_action( 'get_footer' )
		) {
			return false;
		}
	}

	/*
	 * The first elements in 'the_content' or 'the_post_thumbnail' should not be lazy-loaded,
	 * as they are likely above the fold.
	 */
	if ( 'the_content' === $context || 'the_post_thumbnail' === $context ) {
		// Only elements within the main query loop have special handling.
		if ( is_admin() || ! in_the_loop() || ! is_main_query() ) {
			return 'lazy';
		}

		// Increase the counter since this is a main query content element.
		$content_media_count = wp_increase_content_media_count();

		// If the count so far is below the threshold, return `false` so that the `loading` attribute is omitted.
		if ( $content_media_count <= wp_omit_loading_attr_threshold() ) {
			return false;
		}

		// For elements after the threshold, lazy-load them as usual.
		return 'lazy';
	}

	// Lazy-load by default for any unknown context.
	return 'lazy';
}

/**
 * Adds `loading` attribute to an `img` HTML tag.
 *
 * @since WP 5.5.0
 * @deprecated WP 6.3.0 Use wp_img_tag_add_loading_optimization_attrs() instead.
 * @see wp_img_tag_add_loading_optimization_attrs()
 *
 * @param string $image   The HTML `img` tag where the attribute should be added.
 * @param string $context Additional context to pass to the filters.
 * @return string Converted `img` tag with `loading` attribute added.
 */
function wp_img_tag_add_loading_attr( $image, $context ) {
	_deprecated_function( __FUNCTION__, '6.3.0', 'wp_img_tag_add_loading_optimization_attrs()' );
	/*
	 * Get loading attribute value to use. This must occur before the conditional check below so that even images that
	 * are ineligible for being lazy-loaded are considered.
	 */
	$value = wp_get_loading_attr_default( $context );

	// Images should have source and dimension attributes for the `loading` attribute to be added.
	if ( ! str_contains( $image, ' src="' ) || ! str_contains( $image, ' width="' ) || ! str_contains( $image, ' height="' ) ) {
		return $image;
	}

	/** This filter is documented in wp-admin/includes/media.php */
	$value = apply_filters( 'wp_img_tag_add_loading_attr', $value, $image, $context );

	if ( $value ) {
		if ( ! in_array( $value, array( 'lazy', 'eager' ), true ) ) {
			$value = 'lazy';
		}

		return str_replace( '<img', '<img loading="' . esc_attr( $value ) . '"', $image );
	}

	return $image;
}

/**
 * Takes input from [0, n] and returns it as [0, 1].
 *
 * Direct port of TinyColor's function, lightly simplified to maintain
 * consistency with TinyColor.
 *
 * @link https://github.com/bgrins/TinyColor
 *
 * @since WP 5.8.0
 * @deprecated WP 6.3.0
 *
 * @access private
 *
 * @param mixed $n   Number of unknown type.
 * @param int   $max Upper value of the range to bound to.
 * @return float Value in the range [0, 1].
 */
function wp_tinycolor_bound01( $n, $max ) {
	_deprecated_function( __FUNCTION__, '6.3.0' );
	if ( 'string' === gettype( $n ) && str_contains( $n, '.' ) && 1 === (float) $n ) {
		$n = '100%';
	}

	$n = min( $max, max( 0, (float) $n ) );

	// Automatically convert percentage into number.
	if ( 'string' === gettype( $n ) && str_contains( $n, '%' ) ) {
		$n = (int) ( $n * $max ) / 100;
	}

	// Handle floating point rounding errors.
	if ( ( abs( $n - $max ) < 0.000001 ) ) {
		return 1.0;
	}

	// Convert into [0, 1] range if it isn't already.
	return ( $n % $max ) / (float) $max;
}

/**
 * Direct port of tinycolor's boundAlpha function to maintain consistency with
 * how tinycolor works.
 *
 * @link https://github.com/bgrins/TinyColor
 *
 * @since WP 5.9.0
 * @deprecated WP 6.3.0
 *
 * @access private
 *
 * @param mixed $n Number of unknown type.
 * @return float Value in the range [0,1].
 */
function _wp_tinycolor_bound_alpha( $n ) {
	_deprecated_function( __FUNCTION__, '6.3.0' );

	if ( is_numeric( $n ) ) {
		$n = (float) $n;
		if ( $n >= 0 && $n <= 1 ) {
			return $n;
		}
	}
	return 1;
}

/**
 * Rounds and converts values of an RGB object.
 *
 * Direct port of TinyColor's function, lightly simplified to maintain
 * consistency with TinyColor.
 *
 * @link https://github.com/bgrins/TinyColor
 *
 * @since WP 5.8.0
 * @deprecated WP 6.3.0
 *
 * @access private
 *
 * @param array $rgb_color RGB object.
 * @return array Rounded and converted RGB object.
 */
function wp_tinycolor_rgb_to_rgb( $rgb_color ) {
	_deprecated_function( __FUNCTION__, '6.3.0' );

	return array(
		'r' => wp_tinycolor_bound01( $rgb_color['r'], 255 ) * 255,
		'g' => wp_tinycolor_bound01( $rgb_color['g'], 255 ) * 255,
		'b' => wp_tinycolor_bound01( $rgb_color['b'], 255 ) * 255,
	);
}

/**
 * Helper function for hsl to rgb conversion.
 *
 * Direct port of TinyColor's function, lightly simplified to maintain
 * consistency with TinyColor.
 *
 * @link https://github.com/bgrins/TinyColor
 *
 * @since WP 5.8.0
 * @deprecated WP 6.3.0
 *
 * @access private
 *
 * @param float $p first component.
 * @param float $q second component.
 * @param float $t third component.
 * @return float R, G, or B component.
 */
function wp_tinycolor_hue_to_rgb( $p, $q, $t ) {
	_deprecated_function( __FUNCTION__, '6.3.0' );

	if ( $t < 0 ) {
		++$t;
	}
	if ( $t > 1 ) {
		--$t;
	}
	if ( $t < 1 / 6 ) {
		return $p + ( $q - $p ) * 6 * $t;
	}
	if ( $t < 1 / 2 ) {
		return $q;
	}
	if ( $t < 2 / 3 ) {
		return $p + ( $q - $p ) * ( 2 / 3 - $t ) * 6;
	}
	return $p;
}

/**
 * Converts an HSL object to an RGB object with converted and rounded values.
 *
 * Direct port of TinyColor's function, lightly simplified to maintain
 * consistency with TinyColor.
 *
 * @link https://github.com/bgrins/TinyColor
 *
 * @since WP 5.8.0
 * @deprecated WP 6.3.0
 *
 * @access private
 *
 * @param array $hsl_color HSL object.
 * @return array Rounded and converted RGB object.
 */
function wp_tinycolor_hsl_to_rgb( $hsl_color ) {
	_deprecated_function( __FUNCTION__, '6.3.0' );

	$h = wp_tinycolor_bound01( $hsl_color['h'], 360 );
	$s = wp_tinycolor_bound01( $hsl_color['s'], 100 );
	$l = wp_tinycolor_bound01( $hsl_color['l'], 100 );

	if ( 0 === $s ) {
		// Achromatic.
		$r = $l;
		$g = $l;
		$b = $l;
	} else {
		$q = $l < 0.5 ? $l * ( 1 + $s ) : $l + $s - $l * $s;
		$p = 2 * $l - $q;
		$r = wp_tinycolor_hue_to_rgb( $p, $q, $h + 1 / 3 );
		$g = wp_tinycolor_hue_to_rgb( $p, $q, $h );
		$b = wp_tinycolor_hue_to_rgb( $p, $q, $h - 1 / 3 );
	}

	return array(
		'r' => $r * 255,
		'g' => $g * 255,
		'b' => $b * 255,
	);
}

/**
 * Parses hex, hsl, and rgb CSS strings using the same regex as TinyColor v1.4.2
 * used in the JavaScript. Only colors output from react-color are implemented.
 *
 * Direct port of TinyColor's function, lightly simplified to maintain
 * consistency with TinyColor.
 *
 * @link https://github.com/bgrins/TinyColor
 * @link https://github.com/casesandberg/react-color/
 *
 * @since WP 5.8.0
 * @since WP 5.9.0 Added alpha processing.
 * @deprecated WP 6.3.0
 *
 * @access private
 *
 * @param string $color_str CSS color string.
 * @return array RGB object.
 */
function wp_tinycolor_string_to_rgb( $color_str ) {
	_deprecated_function( __FUNCTION__, '6.3.0' );

	$color_str = strtolower( trim( $color_str ) );

	$css_integer = '[-\\+]?\\d+%?';
	$css_number  = '[-\\+]?\\d*\\.\\d+%?';

	$css_unit = '(?:' . $css_number . ')|(?:' . $css_integer . ')';

	$permissive_match3 = '[\\s|\\(]+(' . $css_unit . ')[,|\\s]+(' . $css_unit . ')[,|\\s]+(' . $css_unit . ')\\s*\\)?';
	$permissive_match4 = '[\\s|\\(]+(' . $css_unit . ')[,|\\s]+(' . $css_unit . ')[,|\\s]+(' . $css_unit . ')[,|\\s]+(' . $css_unit . ')\\s*\\)?';

	$rgb_regexp = '/^rgb' . $permissive_match3 . '$/';
	if ( preg_match( $rgb_regexp, $color_str, $match ) ) {
		$rgb = wp_tinycolor_rgb_to_rgb(
			array(
				'r' => $match[1],
				'g' => $match[2],
				'b' => $match[3],
			)
		);

		$rgb['a'] = 1;

		return $rgb;
	}

	$rgba_regexp = '/^rgba' . $permissive_match4 . '$/';
	if ( preg_match( $rgba_regexp, $color_str, $match ) ) {
		$rgb = wp_tinycolor_rgb_to_rgb(
			array(
				'r' => $match[1],
				'g' => $match[2],
				'b' => $match[3],
			)
		);

		$rgb['a'] = _wp_tinycolor_bound_alpha( $match[4] );

		return $rgb;
	}

	$hsl_regexp = '/^hsl' . $permissive_match3 . '$/';
	if ( preg_match( $hsl_regexp, $color_str, $match ) ) {
		$rgb = wp_tinycolor_hsl_to_rgb(
			array(
				'h' => $match[1],
				's' => $match[2],
				'l' => $match[3],
			)
		);

		$rgb['a'] = 1;

		return $rgb;
	}

	$hsla_regexp = '/^hsla' . $permissive_match4 . '$/';
	if ( preg_match( $hsla_regexp, $color_str, $match ) ) {
		$rgb = wp_tinycolor_hsl_to_rgb(
			array(
				'h' => $match[1],
				's' => $match[2],
				'l' => $match[3],
			)
		);

		$rgb['a'] = _wp_tinycolor_bound_alpha( $match[4] );

		return $rgb;
	}

	$hex8_regexp = '/^#?([0-9a-fA-F]{2})([0-9a-fA-F]{2})([0-9a-fA-F]{2})([0-9a-fA-F]{2})$/';
	if ( preg_match( $hex8_regexp, $color_str, $match ) ) {
		$rgb = wp_tinycolor_rgb_to_rgb(
			array(
				'r' => base_convert( $match[1], 16, 10 ),
				'g' => base_convert( $match[2], 16, 10 ),
				'b' => base_convert( $match[3], 16, 10 ),
			)
		);

		$rgb['a'] = _wp_tinycolor_bound_alpha(
			base_convert( $match[4], 16, 10 ) / 255
		);

		return $rgb;
	}

	$hex6_regexp = '/^#?([0-9a-fA-F]{2})([0-9a-fA-F]{2})([0-9a-fA-F]{2})$/';
	if ( preg_match( $hex6_regexp, $color_str, $match ) ) {
		$rgb = wp_tinycolor_rgb_to_rgb(
			array(
				'r' => base_convert( $match[1], 16, 10 ),
				'g' => base_convert( $match[2], 16, 10 ),
				'b' => base_convert( $match[3], 16, 10 ),
			)
		);

		$rgb['a'] = 1;

		return $rgb;
	}

	$hex4_regexp = '/^#?([0-9a-fA-F]{1})([0-9a-fA-F]{1})([0-9a-fA-F]{1})([0-9a-fA-F]{1})$/';
	if ( preg_match( $hex4_regexp, $color_str, $match ) ) {
		$rgb = wp_tinycolor_rgb_to_rgb(
			array(
				'r' => base_convert( $match[1] . $match[1], 16, 10 ),
				'g' => base_convert( $match[2] . $match[2], 16, 10 ),
				'b' => base_convert( $match[3] . $match[3], 16, 10 ),
			)
		);

		$rgb['a'] = _wp_tinycolor_bound_alpha(
			base_convert( $match[4] . $match[4], 16, 10 ) / 255
		);

		return $rgb;
	}

	$hex3_regexp = '/^#?([0-9a-fA-F]{1})([0-9a-fA-F]{1})([0-9a-fA-F]{1})$/';
	if ( preg_match( $hex3_regexp, $color_str, $match ) ) {
		$rgb = wp_tinycolor_rgb_to_rgb(
			array(
				'r' => base_convert( $match[1] . $match[1], 16, 10 ),
				'g' => base_convert( $match[2] . $match[2], 16, 10 ),
				'b' => base_convert( $match[3] . $match[3], 16, 10 ),
			)
		);

		$rgb['a'] = 1;

		return $rgb;
	}

	/*
	 * The JS color picker considers the string "transparent" to be a hex value,
	 * so we need to handle it here as a special case.
	 */
	if ( 'transparent' === $color_str ) {
		return array(
			'r' => 0,
			'g' => 0,
			'b' => 0,
			'a' => 0,
		);
	}
}

/**
 * Returns the prefixed id for the duotone filter for use as a CSS id.
 *
 * @since WP 5.9.1
 * @deprecated WP 6.3.0
 *
 * @access private
 *
 * @param array $preset Duotone preset value as seen in theme.json.
 * @return string Duotone filter CSS id.
 */
function wp_get_duotone_filter_id( $preset ) {
	_deprecated_function( __FUNCTION__, '6.3.0' );
	return WP_Duotone::get_filter_id_from_preset( $preset );
}

/**
 * Returns the CSS filter property url to reference the rendered SVG.
 *
 * @since WP 5.9.0
 * @since WP 6.1.0 Allow unset for preset colors.
 * @deprecated WP 6.3.0
 *
 * @access private
 *
 * @param array $preset Duotone preset value as seen in theme.json.
 * @return string Duotone CSS filter property url value.
 */
function wp_get_duotone_filter_property( $preset ) {
	_deprecated_function( __FUNCTION__, '6.3.0' );
	return WP_Duotone::get_filter_css_property_value_from_preset( $preset );
}

/**
 * Returns the duotone filter SVG string for the preset.
 *
 * @since WP 5.9.1
 * @deprecated WP 6.3.0
 *
 * @access private
 *
 * @param array $preset Duotone preset value as seen in theme.json.
 * @return string Duotone SVG filter.
 */
function wp_get_duotone_filter_svg( $preset ) {
	_deprecated_function( __FUNCTION__, '6.3.0' );
	return WP_Duotone::get_filter_svg_from_preset( $preset );
}

/**
 * Registers the style and colors block attributes for block types that support it.
 *
 * @since WP 5.8.0
 * @deprecated WP 6.3.0 Use WP_Duotone::register_duotone_support() instead.
 *
 * @access private
 *
 * @param WP_Block_Type $block_type Block Type.
 */
function wp_register_duotone_support( $block_type ) {
	_deprecated_function( __FUNCTION__, '6.3.0', 'WP_Duotone::register_duotone_support()' );
	return WP_Duotone::register_duotone_support( $block_type );
}

/**
 * Renders out the duotone stylesheet and SVG.
 *
 * @since WP 5.8.0
 * @since WP 6.1.0 Allow unset for preset colors.
 * @deprecated WP 6.3.0 Use WP_Duotone::render_duotone_support() instead.
 *
 * @access private
 *
 * @param string $block_content Rendered block content.
 * @param array  $block         Block object.
 * @return string Filtered block content.
 */
function wp_render_duotone_support( $block_content, $block ) {
	_deprecated_function( __FUNCTION__, '6.3.0', 'WP_Duotone::render_duotone_support()' );
	$wp_block = new WP_Block( $block );
	return WP_Duotone::render_duotone_support( $block_content, $block, $wp_block );
}

/**
 * Returns a string containing the SVGs to be referenced as filters (duotone).
 *
 * @since WP 5.9.1
 * @deprecated WP 6.3.0 SVG generation is handled on a per-block basis in block supports.
 *
 * @return string
 */
function wp_get_global_styles_svg_filters() {
	_deprecated_function( __FUNCTION__, '6.3.0' );

	/*
	 * Ignore cache when the development mode is set to 'theme', so it doesn't interfere with the theme
	 * developer's workflow.
	 */
	$can_use_cached = ! wp_is_development_mode( 'theme' );
	$cache_group    = 'theme_json';
	$cache_key      = 'wp_get_global_styles_svg_filters';
	if ( $can_use_cached ) {
		$cached = wp_cache_get( $cache_key, $cache_group );
		if ( $cached ) {
			return $cached;
		}
	}

	$supports_theme_json = wp_theme_has_theme_json();

	$origins = array( 'default', 'theme', 'custom' );
	if ( ! $supports_theme_json ) {
		$origins = array( 'default' );
	}

	$tree = WP_Theme_JSON_Resolver::get_merged_data();
	$svgs = $tree->get_svg_filters( $origins );

	if ( $can_use_cached ) {
		wp_cache_set( $cache_key, $svgs, $cache_group );
	}

	return $svgs;
}

/**
 * Renders the SVG filters supplied by theme.json.
 *
 * Note that this doesn't render the per-block user-defined
 * filters which are handled by wp_render_duotone_support,
 * but it should be rendered before the filtered content
 * in the body to satisfy Safari's rendering quirks.
 *
 * @since WP 5.9.1
 * @deprecated WP 6.3.0 SVG generation is handled on a per-block basis in block supports.
 */
function wp_global_styles_render_svg_filters() {
	_deprecated_function( __FUNCTION__, '6.3.0' );

	/*
	 * When calling via the in_admin_header action, we only want to render the
	 * SVGs on block editor pages.
	 */
	if (
		is_admin() &&
		! get_current_screen()->is_block_editor()
	) {
		return;
	}

	$filters = wp_get_global_styles_svg_filters();
	if ( ! empty( $filters ) ) {
		echo $filters;
	}
}

/**
 * Build an array with CSS classes and inline styles defining the colors
 * which will be applied to the navigation markup in the front-end.
 *
 * @since WP 5.9.0
 * @deprecated WP 6.3.0 This was removed from the Navigation Submenu block in favour of `wp_apply_colors_support()`.
 *                   `wp_apply_colors_support()` returns an array with similar class and style values,
 *                   but with different keys: `class` and `style`.
 *
 * @param  array $context     Navigation block context.
 * @param  array $attributes  Block attributes.
 * @param  bool  $is_sub_menu Whether the block is a sub-menu.
 * @return array Colors CSS classes and inline styles.
 */
function block_core_navigation_submenu_build_css_colors( $context, $attributes, $is_sub_menu = false ) {
	_deprecated_function( __FUNCTION__, '6.3.0' );
	$colors = array(
		'css_classes'   => array(),
		'inline_styles' => '',
	);

	// Text color.
	$named_text_color  = null;
	$custom_text_color = null;

	if ( $is_sub_menu && array_key_exists( 'customOverlayTextColor', $context ) ) {
		$custom_text_color = $context['customOverlayTextColor'];
	} elseif ( $is_sub_menu && array_key_exists( 'overlayTextColor', $context ) ) {
		$named_text_color = $context['overlayTextColor'];
	} elseif ( array_key_exists( 'customTextColor', $context ) ) {
		$custom_text_color = $context['customTextColor'];
	} elseif ( array_key_exists( 'textColor', $context ) ) {
		$named_text_color = $context['textColor'];
	} elseif ( isset( $context['style']['color']['text'] ) ) {
		$custom_text_color = $context['style']['color']['text'];
	}

	// If has text color.
	if ( ! is_null( $named_text_color ) ) {
		// Add the color class.
		array_push( $colors['css_classes'], 'has-text-color', sprintf( 'has-%s-color', $named_text_color ) );
	} elseif ( ! is_null( $custom_text_color ) ) {
		// Add the custom color inline style.
		$colors['css_classes'][]  = 'has-text-color';
		$colors['inline_styles'] .= sprintf( 'color: %s;', $custom_text_color );
	}

	// Background color.
	$named_background_color  = null;
	$custom_background_color = null;

	if ( $is_sub_menu && array_key_exists( 'customOverlayBackgroundColor', $context ) ) {
		$custom_background_color = $context['customOverlayBackgroundColor'];
	} elseif ( $is_sub_menu && array_key_exists( 'overlayBackgroundColor', $context ) ) {
		$named_background_color = $context['overlayBackgroundColor'];
	} elseif ( array_key_exists( 'customBackgroundColor', $context ) ) {
		$custom_background_color = $context['customBackgroundColor'];
	} elseif ( array_key_exists( 'backgroundColor', $context ) ) {
		$named_background_color = $context['backgroundColor'];
	} elseif ( isset( $context['style']['color']['background'] ) ) {
		$custom_background_color = $context['style']['color']['background'];
	}

	// If has background color.
	if ( ! is_null( $named_background_color ) ) {
		// Add the background-color class.
		array_push( $colors['css_classes'], 'has-background', sprintf( 'has-%s-background-color', $named_background_color ) );
	} elseif ( ! is_null( $custom_background_color ) ) {
		// Add the custom background-color inline style.
		$colors['css_classes'][]  = 'has-background';
		$colors['inline_styles'] .= sprintf( 'background-color: %s;', $custom_background_color );
	}

	return $colors;
}

/**
 * Runs the theme.json webfonts handler.
 *
 * Using `WP_Theme_JSON_Resolver`, it gets the fonts defined
 * in the `theme.json` for the current selection and style
 * variations, validates the font-face properties, generates
 * the '@font-face' style declarations, and then enqueues the
 * styles for both the editor and front-end.
 *
 * Design Notes:
 * This is not a public API, but rather an internal handler.
 * A future public Webfonts API will replace this stopgap code.
 *
 * This code design is intentional.
 *    a. It hides the inner-workings.
 *    b. It does not expose API ins or outs for consumption.
 *    c. It only works with a theme's `theme.json`.
 *
 * Why?
 *    a. To avoid backwards-compatibility issues when
 *       the Webfonts API is introduced in Core.
 *    b. To make `fontFace` declarations in `theme.json` work.
 *
 * @link  https://github.com/WordPress/gutenberg/issues/40472
 *
 * @since WP 6.0.0
 * @deprecated WP 6.4.0 Use wp_print_font_faces() instead.
 * @access private
 */
function _wp_theme_json_webfonts_handler() {
	_deprecated_function( __FUNCTION__, '6.4.0', 'wp_print_font_faces' );

	// Block themes are unavailable during installation.
	if ( wp_installing() ) {
		return;
	}

	if ( ! wp_theme_has_theme_json() ) {
		return;
	}

	// Webfonts to be processed.
	$registered_webfonts = array();

	/**
	 * Gets the webfonts from theme.json.
	 *
	 * @since WP 6.0.0
	 *
	 * @return array Array of defined webfonts.
	 */
	$fn_get_webfonts_from_theme_json = static function() {
		// Get settings from theme.json.
		$settings = WP_Theme_JSON_Resolver::get_merged_data()->get_settings();

		// If in the editor, add webfonts defined in variations.
		if ( is_admin() || wp_is_rest_endpoint() ) {
			$variations = WP_Theme_JSON_Resolver::get_style_variations();
			foreach ( $variations as $variation ) {
				// Skip if fontFamilies are not defined in the variation.
				if ( empty( $variation['settings']['typography']['fontFamilies'] ) ) {
					continue;
				}

				// Initialize the array structure.
				if ( empty( $settings['typography'] ) ) {
					$settings['typography'] = array();
				}
				if ( empty( $settings['typography']['fontFamilies'] ) ) {
					$settings['typography']['fontFamilies'] = array();
				}
				if ( empty( $settings['typography']['fontFamilies']['theme'] ) ) {
					$settings['typography']['fontFamilies']['theme'] = array();
				}

				// Combine variations with settings. Remove duplicates.
				$settings['typography']['fontFamilies']['theme'] = array_merge( $settings['typography']['fontFamilies']['theme'], $variation['settings']['typography']['fontFamilies']['theme'] );
				$settings['typography']['fontFamilies']          = array_unique( $settings['typography']['fontFamilies'] );
			}
		}

		// Bail out early if there are no settings for webfonts.
		if ( empty( $settings['typography']['fontFamilies'] ) ) {
			return array();
		}

		$webfonts = array();

		// Look for fontFamilies.
		foreach ( $settings['typography']['fontFamilies'] as $font_families ) {
			foreach ( $font_families as $font_family ) {

				// Skip if fontFace is not defined.
				if ( empty( $font_family['fontFace'] ) ) {
					continue;
				}

				// Skip if fontFace is not an array of webfonts.
				if ( ! is_array( $font_family['fontFace'] ) ) {
					continue;
				}

				$webfonts = array_merge( $webfonts, $font_family['fontFace'] );
			}
		}

		return $webfonts;
	};

	/**
	 * Transforms each 'src' into an URI by replacing 'file:./'
	 * placeholder from theme.json.
	 *
	 * The absolute path to the webfont file(s) cannot be defined in
	 * theme.json. `file:./` is the placeholder which is replaced by
	 * the theme's URL path to the theme's root.
	 *
	 * @since WP 6.0.0
	 *
	 * @param array $src Webfont file(s) `src`.
	 * @return array Webfont's `src` in URI.
	 */
	$fn_transform_src_into_uri = static function( array $src ) {
		foreach ( $src as $key => $url ) {
			// Tweak the URL to be relative to the theme root.
			if ( ! str_starts_with( $url, 'file:./' ) ) {
				continue;
			}

			$src[ $key ] = get_theme_file_uri( str_replace( 'file:./', '', $url ) );
		}

		return $src;
	};

	/**
	 * Converts the font-face properties (i.e. keys) into kebab-case.
	 *
	 * @since WP 6.0.0
	 *
	 * @param array $font_face Font face to convert.
	 * @return array Font faces with each property in kebab-case format.
	 */
	$fn_convert_keys_to_kebab_case = static function( array $font_face ) {
		foreach ( $font_face as $property => $value ) {
			$kebab_case               = _wp_to_kebab_case( $property );
			$font_face[ $kebab_case ] = $value;
			if ( $kebab_case !== $property ) {
				unset( $font_face[ $property ] );
			}
		}

		return $font_face;
	};

	/**
	 * Validates a webfont.
	 *
	 * @since WP 6.0.0
	 *
	 * @param array $webfont The webfont arguments.
	 * @return array|false The validated webfont arguments, or false if the webfont is invalid.
	 */
	$fn_validate_webfont = static function( $webfont ) {
		$webfont = wp_parse_args(
				$webfont,
				array(
						'font-family'  => '',
						'font-style'   => 'normal',
						'font-weight'  => '400',
						'font-display' => 'fallback',
						'src'          => array(),
				)
		);

		// Check the font-family.
		if ( empty( $webfont['font-family'] ) || ! is_string( $webfont['font-family'] ) ) {
			trigger_error( __( 'Webfont font family must be a non-empty string.' ) );

			return false;
		}

		// Check that the `src` property is defined and a valid type.
		if ( empty( $webfont['src'] ) || ( ! is_string( $webfont['src'] ) && ! is_array( $webfont['src'] ) ) ) {
			trigger_error( __( 'Webfont src must be a non-empty string or an array of strings.' ) );

			return false;
		}

		// Validate the `src` property.
		foreach ( (array) $webfont['src'] as $src ) {
			if ( ! is_string( $src ) || '' === trim( $src ) ) {
				trigger_error( __( 'Each webfont src must be a non-empty string.' ) );

				return false;
			}
		}

		// Check the font-weight.
		if ( ! is_string( $webfont['font-weight'] ) && ! is_int( $webfont['font-weight'] ) ) {
			trigger_error( __( 'Webfont font weight must be a properly formatted string or integer.' ) );

			return false;
		}

		// Check the font-display.
		if ( ! in_array( $webfont['font-display'], array( 'auto', 'block', 'fallback', 'optional', 'swap' ), true ) ) {
			$webfont['font-display'] = 'fallback';
		}

		$valid_props = array(
				'ascend-override',
				'descend-override',
				'font-display',
				'font-family',
				'font-stretch',
				'font-style',
				'font-weight',
				'font-variant',
				'font-feature-settings',
				'font-variation-settings',
				'line-gap-override',
				'size-adjust',
				'src',
				'unicode-range',
		);

		foreach ( $webfont as $prop => $value ) {
			if ( ! in_array( $prop, $valid_props, true ) ) {
				unset( $webfont[ $prop ] );
			}
		}

		return $webfont;
	};

	/**
	 * Registers webfonts declared in theme.json.
	 *
	 * @since WP 6.0.0
	 *
	 * @uses $registered_webfonts To access and update the registered webfonts registry (passed by reference).
	 * @uses $fn_get_webfonts_from_theme_json To run the function that gets the webfonts from theme.json.
	 * @uses $fn_convert_keys_to_kebab_case To run the function that converts keys into kebab-case.
	 * @uses $fn_validate_webfont To run the function that validates each font-face (webfont) from theme.json.
	 */
	$fn_register_webfonts = static function() use ( &$registered_webfonts, $fn_get_webfonts_from_theme_json, $fn_convert_keys_to_kebab_case, $fn_validate_webfont, $fn_transform_src_into_uri ) {
		$registered_webfonts = array();

		foreach ( $fn_get_webfonts_from_theme_json() as $webfont ) {
			if ( ! is_array( $webfont ) ) {
				continue;
			}

			$webfont = $fn_convert_keys_to_kebab_case( $webfont );

			$webfont = $fn_validate_webfont( $webfont );

			$webfont['src'] = $fn_transform_src_into_uri( (array) $webfont['src'] );

			// Skip if not valid.
			if ( empty( $webfont ) ) {
				continue;
			}

			$registered_webfonts[] = $webfont;
		}
	};

	/**
	 * Orders 'src' items to optimize for browser support.
	 *
	 * @since WP 6.0.0
	 *
	 * @param array $webfont Webfont to process.
	 * @return array Ordered `src` items.
	 */
	$fn_order_src = static function( array $webfont ) {
		$src         = array();
		$src_ordered = array();

		foreach ( $webfont['src'] as $url ) {
			// Add data URIs first.
			if ( str_starts_with( trim( $url ), 'data:' ) ) {
				$src_ordered[] = array(
						'url'    => $url,
						'format' => 'data',
				);
				continue;
			}
			$format         = pathinfo( $url, PATHINFO_EXTENSION );
			$src[ $format ] = $url;
		}

		// Add woff2.
		if ( ! empty( $src['woff2'] ) ) {
			$src_ordered[] = array(
					'url'    => sanitize_url( $src['woff2'] ),
					'format' => 'woff2',
			);
		}

		// Add woff.
		if ( ! empty( $src['woff'] ) ) {
			$src_ordered[] = array(
					'url'    => sanitize_url( $src['woff'] ),
					'format' => 'woff',
			);
		}

		// Add ttf.
		if ( ! empty( $src['ttf'] ) ) {
			$src_ordered[] = array(
					'url'    => sanitize_url( $src['ttf'] ),
					'format' => 'truetype',
			);
		}

		// Add eot.
		if ( ! empty( $src['eot'] ) ) {
			$src_ordered[] = array(
					'url'    => sanitize_url( $src['eot'] ),
					'format' => 'embedded-opentype',
			);
		}

		// Add otf.
		if ( ! empty( $src['otf'] ) ) {
			$src_ordered[] = array(
					'url'    => sanitize_url( $src['otf'] ),
					'format' => 'opentype',
			);
		}
		$webfont['src'] = $src_ordered;

		return $webfont;
	};

	/**
	 * Compiles the 'src' into valid CSS.
	 *
	 * @since WP 6.0.0
	 * @since WP 6.2.0 Removed local() CSS.
	 *
	 * @param string $font_family Font family.
	 * @param array  $value       Value to process.
	 * @return string The CSS.
	 */
	$fn_compile_src = static function( $font_family, array $value ) {
		$src = '';

		foreach ( $value as $item ) {
			$src .= ( 'data' === $item['format'] )
					? ", url({$item['url']})"
					: ", url('{$item['url']}') format('{$item['format']}')";
		}

		$src = ltrim( $src, ', ' );

		return $src;
	};

	/**
	 * Compiles the font variation settings.
	 *
	 * @since WP 6.0.0
	 *
	 * @param array $font_variation_settings Array of font variation settings.
	 * @return string The CSS.
	 */
	$fn_compile_variations = static function( array $font_variation_settings ) {
		$variations = '';

		foreach ( $font_variation_settings as $key => $value ) {
			$variations .= "$key $value";
		}

		return $variations;
	};

	/**
	 * Builds the font-family's CSS.
	 *
	 * @since WP 6.0.0
	 *
	 * @uses $fn_compile_src To run the function that compiles the src.
	 * @uses $fn_compile_variations To run the function that compiles the variations.
	 *
	 * @param array $webfont Webfont to process.
	 * @return string This font-family's CSS.
	 */
	$fn_build_font_face_css = static function( array $webfont ) use ( $fn_compile_src, $fn_compile_variations ) {
		$css = '';

		// Wrap font-family in quotes if it contains spaces.
		if (
				str_contains( $webfont['font-family'], ' ' ) &&
				! str_contains( $webfont['font-family'], '"' ) &&
				! str_contains( $webfont['font-family'], "'" )
		) {
			$webfont['font-family'] = '"' . $webfont['font-family'] . '"';
		}

		foreach ( $webfont as $key => $value ) {
			/*
			 * Skip "provider", since it's for internal API use,
			 * and not a valid CSS property.
			 */
			if ( 'provider' === $key ) {
				continue;
			}

			// Compile the "src" parameter.
			if ( 'src' === $key ) {
				$value = $fn_compile_src( $webfont['font-family'], $value );
			}

			// If font-variation-settings is an array, convert it to a string.
			if ( 'font-variation-settings' === $key && is_array( $value ) ) {
				$value = $fn_compile_variations( $value );
			}

			if ( ! empty( $value ) ) {
				$css .= "$key:$value;";
			}
		}

		return $css;
	};

	/**
	 * Gets the '@font-face' CSS styles for locally-hosted font files.
	 *
	 * @since WP 6.0.0
	 *
	 * @uses $registered_webfonts To access and update the registered webfonts registry (passed by reference).
	 * @uses $fn_order_src To run the function that orders the src.
	 * @uses $fn_build_font_face_css To run the function that builds the font-face CSS.
	 *
	 * @return string The `@font-face` CSS.
	 */
	$fn_get_css = static function() use ( &$registered_webfonts, $fn_order_src, $fn_build_font_face_css ) {
		$css = '';

		foreach ( $registered_webfonts as $webfont ) {
			// Order the webfont's `src` items to optimize for browser support.
			$webfont = $fn_order_src( $webfont );

			// Build the @font-face CSS for this webfont.
			$css .= '@font-face{' . $fn_build_font_face_css( $webfont ) . '}';
		}

		return $css;
	};

	/**
	 * Generates and enqueues webfonts styles.
	 *
	 * @since WP 6.0.0
	 *
	 * @uses $fn_get_css To run the function that gets the CSS.
	 */
	$fn_generate_and_enqueue_styles = static function() use ( $fn_get_css ) {
		// Generate the styles.
		$styles = $fn_get_css();

		// Bail out if there are no styles to enqueue.
		if ( '' === $styles ) {
			return;
		}

		// Enqueue the stylesheet.
		wp_register_style( 'wp-webfonts', '' );
		wp_enqueue_style( 'wp-webfonts' );

		// Add the styles to the stylesheet.
		wp_add_inline_style( 'wp-webfonts', $styles );
	};

	/**
	 * Generates and enqueues editor styles.
	 *
	 * @since WP 6.0.0
	 *
	 * @uses $fn_get_css To run the function that gets the CSS.
	 */
	$fn_generate_and_enqueue_editor_styles = static function() use ( $fn_get_css ) {
		// Generate the styles.
		$styles = $fn_get_css();

		// Bail out if there are no styles to enqueue.
		if ( '' === $styles ) {
			return;
		}

		wp_add_inline_style( 'wp-block-library', $styles );
	};

	add_action( 'wp_loaded', $fn_register_webfonts );
	add_action( 'wp_enqueue_scripts', $fn_generate_and_enqueue_styles );
	add_action( 'admin_init', $fn_generate_and_enqueue_editor_styles );
}

/**
 * Prints the CSS in the embed iframe header.
 *
 * @since WP 4.4.0
 * @deprecated WP 6.4.0 Use wp_enqueue_embed_styles() instead.
 */
function print_embed_styles() {
	_deprecated_function( __FUNCTION__, '6.4.0', 'wp_enqueue_embed_styles' );

	$type_attr = current_theme_supports( 'html5', 'style' ) ? '' : ' type="text/css"';
	$suffix    = SCRIPT_DEBUG ? '' : '.min';
	?>
	<style<?php echo $type_attr; ?>>
		<?php echo file_get_contents( ABSPATH . WPINC . "/css/wp-embed-template$suffix.css" ); ?>
	</style>
	<?php
}

/**
 * Prints the important emoji-related styles.
 *
 * @since WP 4.2.0
 * @deprecated WP 6.4.0 Use wp_enqueue_emoji_styles() instead.
 */
function print_emoji_styles() {
	_deprecated_function( __FUNCTION__, '6.4.0', 'wp_enqueue_emoji_styles' );
	static $printed = false;

	if ( $printed ) {
		return;
	}

	$printed = true;

	$type_attr = current_theme_supports( 'html5', 'style' ) ? '' : ' type="text/css"';
	?>
	<style<?php echo $type_attr; ?>>
	img.wp-smiley,
	img.emoji {
		display: inline !important;
		border: none !important;
		box-shadow: none !important;
		height: 1em !important;
		width: 1em !important;
		margin: 0 0.07em !important;
		vertical-align: -0.1em !important;
		background: none !important;
		padding: 0 !important;
	}
	</style>
	<?php
}

/**
 * Prints style and scripts for the admin bar.
 *
 * @since WP 3.1.0
 * @deprecated WP 6.4.0 Use wp_enqueue_admin_bar_header_styles() instead.
 */
function wp_admin_bar_header() {
	_deprecated_function( __FUNCTION__, '6.4.0', 'wp_enqueue_admin_bar_header_styles' );
	$type_attr = current_theme_supports( 'html5', 'style' ) ? '' : ' type="text/css"';
	?>
	<style<?php echo $type_attr; ?> media="print">#wpadminbar { display:none; }</style>
	<?php
}

/**
 * Prints default admin bar callback.
 *
 * @since WP 3.1.0
 * @deprecated WP 6.4.0 Use wp_enqueue_admin_bar_bump_styles() instead.
 */
function _admin_bar_bump_cb() {
	_deprecated_function( __FUNCTION__, '6.4.0', 'wp_enqueue_admin_bar_bump_styles' );
	$type_attr = current_theme_supports( 'html5', 'style' ) ? '' : ' type="text/css"';
	?>
	<style<?php echo $type_attr; ?> media="screen">
	html { margin-top: 32px !important; }
	@media screen and ( max-width: 782px ) {
	  html { margin-top: 46px !important; }
	}
	</style>
	<?php
}

/**
 * Runs a remote HTTPS request to detect whether HTTPS supported, and stores potential errors.
 *
 * This internal function is called by a regular Cron hook to ensure HTTPS support is detected and maintained.
 *
 * @since WP 5.7.0
 * @deprecated WP 6.4.0 The `wp_update_https_detection_errors()` function is no longer used and has been replaced by
 *                   `wp_get_https_detection_errors()`. Previously the function was called by a regular Cron hook to
 *                    update the `https_detection_errors` option, but this is no longer necessary as the errors are
 *                    retrieved directly in Site Health and no longer used outside of Site Health.
 * @access private
 */
function wp_update_https_detection_errors() {
	_deprecated_function( __FUNCTION__, '6.4.0' );

	/**
	 * Short-circuits the process of detecting errors related to HTTPS support.
	 *
	 * Returning a `WP_Error` from the filter will effectively short-circuit the default logic of trying a remote
	 * request to the site over HTTPS, storing the errors array from the returned `WP_Error` instead.
	 *
	 * @since WP 5.7.0
	 * @deprecated WP 6.4.0 The `wp_update_https_detection_errors` filter is no longer used and has been replaced by `pre_wp_get_https_detection_errors`.
	 *
	 * @param null|WP_Error $pre Error object to short-circuit detection,
	 *                           or null to continue with the default behavior.
	 */
	$support_errors = apply_filters( 'pre_wp_update_https_detection_errors', null );
	if ( is_wp_error( $support_errors ) ) {
		update_option( 'https_detection_errors', $support_errors->errors, false );
		return;
	}

	$support_errors = wp_get_https_detection_errors();

	update_option( 'https_detection_errors', $support_errors );
}

/**
 * Adds `decoding` attribute to an `img` HTML tag.
 *
 * The `decoding` attribute allows developers to indicate whether the
 * browser can decode the image off the main thread (`async`), on the
 * main thread (`sync`) or as determined by the browser (`auto`).
 *
 * By default WordPress adds `decoding="async"` to images but developers
 * can use the {@see 'wp_img_tag_add_decoding_attr'} filter to modify this
 * to remove the attribute or set it to another accepted value.
 *
 * @since WP 6.1.0
 * @deprecated WP 6.4.0 Use wp_img_tag_add_loading_optimization_attrs() instead.
 * @see wp_img_tag_add_loading_optimization_attrs()
 *
 * @param string $image   The HTML `img` tag where the attribute should be added.
 * @param string $context Additional context to pass to the filters.
 * @return string Converted `img` tag with `decoding` attribute added.
 */
function wp_img_tag_add_decoding_attr( $image, $context ) {
	_deprecated_function( __FUNCTION__, '6.4.0', 'wp_img_tag_add_loading_optimization_attrs()' );

	/*
	 * Only apply the decoding attribute to images that have a src attribute that
	 * starts with a double quote, ensuring escaped JSON is also excluded.
	 */
	if ( ! str_contains( $image, ' src="' ) ) {
		return $image;
	}

	/** This action is documented in wp-includes/media.php */
	$value = apply_filters( 'wp_img_tag_add_decoding_attr', 'async', $image, $context );

	if ( in_array( $value, array( 'async', 'sync', 'auto' ), true ) ) {
		$image = str_replace( '<img ', '<img decoding="' . esc_attr( $value ) . '" ', $image );
	}

	return $image;
}

/**
 * Parses wp_template content and injects the active theme's
 * stylesheet as a theme attribute into each wp_template_part
 *
 * @since WP 5.9.0
 * @deprecated WP 6.4.0 Use traverse_and_serialize_blocks( parse_blocks( $template_content ), '_inject_theme_attribute_in_template_part_block' ) instead.
 * @access private
 *
 * @param string $template_content serialized wp_template content.
 * @return string Updated 'wp_template' content.
 */
function _inject_theme_attribute_in_block_template_content( $template_content ) {
	_deprecated_function(
		__FUNCTION__,
		'6.4.0',
		'traverse_and_serialize_blocks( parse_blocks( $template_content ), "_inject_theme_attribute_in_template_part_block" )'
	);

	$has_updated_content = false;
	$new_content         = '';
	$template_blocks     = parse_blocks( $template_content );

	$blocks = _flatten_blocks( $template_blocks );
	foreach ( $blocks as &$block ) {
		if (
			'core/template-part' === $block['blockName'] &&
			! isset( $block['attrs']['theme'] )
		) {
			$block['attrs']['theme'] = get_stylesheet();
			$has_updated_content     = true;
		}
	}

	if ( $has_updated_content ) {
		foreach ( $template_blocks as &$block ) {
			$new_content .= serialize_block( $block );
		}

		return $new_content;
	}

	return $template_content;
}

/**
 * Parses a block template and removes the theme attribute from each template part.
 *
 * @since WP 5.9.0
 * @deprecated WP 6.4.0 Use traverse_and_serialize_blocks( parse_blocks( $template_content ), '_remove_theme_attribute_from_template_part_block' ) instead.
 * @access private
 *
 * @param string $template_content Serialized block template content.
 * @return string Updated block template content.
 */
function _remove_theme_attribute_in_block_template_content( $template_content ) {
	_deprecated_function(
		__FUNCTION__,
		'6.4.0',
		'traverse_and_serialize_blocks( parse_blocks( $template_content ), "_remove_theme_attribute_from_template_part_block" )'
	);

	$has_updated_content = false;
	$new_content         = '';
	$template_blocks     = parse_blocks( $template_content );

	$blocks = _flatten_blocks( $template_blocks );
	foreach ( $blocks as $key => $block ) {
		if ( 'core/template-part' === $block['blockName'] && isset( $block['attrs']['theme'] ) ) {
			unset( $blocks[ $key ]['attrs']['theme'] );
			$has_updated_content = true;
		}
	}

	if ( ! $has_updated_content ) {
		return $template_content;
	}

	foreach ( $template_blocks as $block ) {
		$new_content .= serialize_block( $block );
	}

	return $new_content;
}

/**
 * Prints the skip-link script & styles.
 *
 * @since WP 5.8.0
 * @access private
 * @deprecated WP 6.4.0 Use wp_enqueue_block_template_skip_link() instead.
 *
 * @global string $_wp_current_template_content
 */
function the_block_template_skip_link() {
	_deprecated_function( __FUNCTION__, '6.4.0', 'wp_enqueue_block_template_skip_link()' );

	global $_wp_current_template_content;

	// Early exit if not a block theme.
	if ( ! current_theme_supports( 'block-templates' ) ) {
		return;
	}

	// Early exit if not a block template.
	if ( ! $_wp_current_template_content ) {
		return;
	}
	?>

	<?php
	/**
	 * Print the skip-link styles.
	 */
	?>
	<style id="skip-link-styles">
		.skip-link.screen-reader-text {
			border: 0;
			clip: rect(1px,1px,1px,1px);
			clip-path: inset(50%);
			height: 1px;
			margin: -1px;
			overflow: hidden;
			padding: 0;
			position: absolute !important;
			width: 1px;
			word-wrap: normal !important;
		}

		.skip-link.screen-reader-text:focus {
			background-color: #eee;
			clip: auto !important;
			clip-path: none;
			color: #444;
			display: block;
			font-size: 1em;
			height: auto;
			left: 5px;
			line-height: normal;
			padding: 15px 23px 14px;
			text-decoration: none;
			top: 5px;
			width: auto;
			z-index: 100000;
		}
	</style>
	<?php
	/**
	 * Print the skip-link script.
	 */
	?>
	<script>
	( function() {
		var skipLinkTarget = document.querySelector( 'main' ),
			sibling,
			skipLinkTargetID,
			skipLink;

		// Early exit if a skip-link target can't be located.
		if ( ! skipLinkTarget ) {
			return;
		}

		/*
		 * Get the site wrapper.
		 * The skip-link will be injected in the beginning of it.
		 */
		sibling = document.querySelector( '.wp-site-blocks' );

		// Early exit if the root element was not found.
		if ( ! sibling ) {
			return;
		}

		// Get the skip-link target's ID, and generate one if it doesn't exist.
		skipLinkTargetID = skipLinkTarget.id;
		if ( ! skipLinkTargetID ) {
			skipLinkTargetID = 'wp--skip-link--target';
			skipLinkTarget.id = skipLinkTargetID;
		}

		// Create the skip link.
		skipLink = document.createElement( 'a' );
		skipLink.classList.add( 'skip-link', 'screen-reader-text' );
		skipLink.href = '#' + skipLinkTargetID;
		skipLink.innerHTML = '<?php /* translators: Hidden accessibility text. */ esc_html_e( 'Skip to content' ); ?>';

		// Inject the skip link.
		sibling.parentElement.insertBefore( skipLink, sibling );
	}() );
	</script>
	<?php
}

/**
 * Ensure that the view script has the `wp-interactivity` dependency.
 *
 * @since WP 6.4.0
 * @deprecated WP 6.5.0
 */
function block_core_query_ensure_interactivity_dependency() {
	_deprecated_function( __FUNCTION__, '6.5.0', 'wp_register_script_module' );
}

/**
 * Ensure that the view script has the `wp-interactivity` dependency.
 *
 * @since WP 6.4.0
 * @deprecated WP 6.5.0
 */
function block_core_file_ensure_interactivity_dependency() {
	_deprecated_function( __FUNCTION__, '6.5.0', 'wp_register_script_module' );
}

/**
 * Ensures that the view script has the `wp-interactivity` dependency.
 *
 * @since WP 6.4.0
 * @deprecated WP 6.5.0
 */
function block_core_image_ensure_interactivity_dependency() {
	_deprecated_function( __FUNCTION__, '6.5.0', 'wp_register_script_module' );
}

/**
 * Updates the block content with elements class names.
 *
 * @deprecated WP 6.6.0 Generation of element class name is handled via `render_block_data` filter.
 *
 * @since WP 5.8.0
 * @since WP 6.4.0 Added support for button and heading element styling.
 * @access private
 *
 * @param string $block_content Rendered block content.
 * @param array  $block         Block object.
 * @return string Filtered block content.
 */
function wp_render_elements_support( $block_content, $block ) {
	_deprecated_function( __FUNCTION__, '6.6.0', 'wp_render_elements_class_name' );
	return $block_content;
}

/**
 * Processes the directives on the rendered HTML of the interactive blocks.
 *
 * This processes only one root interactive block at a time because the
 * rendered HTML of that block contains the rendered HTML of all its inner
 * blocks, including any interactive block. It does so by ignoring all the
 * interactive inner blocks until the root interactive block is processed.
 *
 * @since WP 6.5.0
 * @deprecated WP 6.6.0
 *
 * @param array $parsed_block The parsed block.
 * @return array The same parsed block.
 */
function wp_interactivity_process_directives_of_interactive_blocks( array $parsed_block ): array {
	_deprecated_function( __FUNCTION__, '6.6.0' );
	return $parsed_block;
}

/**
 * Gets the global styles custom CSS from theme.json.
 *
 * @since WP 6.2.0
 * @deprecated WP 6.7.0 Use {@see 'wp_get_global_stylesheet'} instead.
 *
 * @return string The global styles custom CSS.
 */
function wp_get_global_styles_custom_css() {
	_deprecated_function( __FUNCTION__, '6.7.0', 'wp_get_global_stylesheet' );
	if ( ! wp_theme_has_theme_json() ) {
		return '';
	}
	/*
	 * Ignore cache when the development mode is set to 'theme', so it doesn't interfere with the theme
	 * developer's workflow.
	 */
	$can_use_cached = ! wp_is_development_mode( 'theme' );

	/*
	 * By using the 'theme_json' group, this data is marked to be non-persistent across requests.
	 * @see `wp_cache_add_non_persistent_groups()`.
	 *
	 * The rationale for this is to make sure derived data from theme.json
	 * is always fresh from the potential modifications done via hooks
	 * that can use dynamic data (modify the stylesheet depending on some option,
	 * settings depending on user permissions, etc.).
	 *
	 * A different alternative considered was to invalidate the cache upon certain
	 * events such as options add/update/delete, user meta, etc.
	 * It was judged not enough, hence this approach.
	 * @see https://github.com/WordPress/gutenberg/pull/45372
	 */
	$cache_key   = 'wp_get_global_styles_custom_css';
	$cache_group = 'theme_json';
	if ( $can_use_cached ) {
		$cached = wp_cache_get( $cache_key, $cache_group );
		if ( $cached ) {
			return $cached;
		}
	}

	$tree       = WP_Theme_JSON_Resolver::get_merged_data();
	$stylesheet = $tree->get_custom_css();

	if ( $can_use_cached ) {
		wp_cache_set( $cache_key, $stylesheet, $cache_group );
	}

	return $stylesheet;
}

/**
 * Enqueues the global styles custom css defined via theme.json.
 *
 * @since WP 6.2.0
 * @deprecated WP 6.7.0 Use {@see 'wp_enqueue_global_styles'} instead.
 */
function wp_enqueue_global_styles_custom_css() {
	_deprecated_function( __FUNCTION__, '6.7.0', 'wp_enqueue_global_styles' );
	if ( ! wp_is_block_theme() ) {
		return;
	}

	// Don't enqueue Customizer's custom CSS separately.
	remove_action( 'wp_head', 'wp_custom_css_cb', 101 );

	$custom_css  = wp_get_custom_css();
	$custom_css .= wp_get_global_styles_custom_css();

	if ( ! empty( $custom_css ) ) {
		wp_add_inline_style( 'global-styles', $custom_css );
	}
}

/**
 * Generate block style variation instance name.
 *
 * @since WP 6.6.0
 * @deprecated WP 6.7.0 Use `wp_unique_id( $variation . '--' )` instead.
 *
 * @access private
 *
 * @param array  $block     Block object.
 * @param string $variation Slug for the block style variation.
 *
 * @return string The unique variation name.
 */
function wp_create_block_style_variation_instance_name( $block, $variation ) {
	_deprecated_function( __FUNCTION__, '6.7.0', 'wp_unique_id' );
	return $variation . '--' . md5( serialize( $block ) );
}

/**
 * Returns whether the current user has the specified capability for a given site.
 *
 * @since WP 3.0.0
 * @since WP 5.3.0 Formalized the existing and already documented `...$args` parameter
 *              by adding it to the function signature.
 * @since WP 5.8.0 Wraps current_user_can() after switching to blog.
 * @deprecated WP 6.7.0 Use current_user_can_for_site() instead.
 *
 * @param int    $blog_id    Site ID.
 * @param string $capability Capability name.
 * @param mixed  ...$args    Optional further parameters, typically starting with an object ID.
 * @return bool Whether the user has the given capability.
 */
function current_user_can_for_blog( $blog_id, $capability, ...$args ) {
	return current_user_can_for_site( $blog_id, $capability, ...$args );
}

/**
 * Gets the default URL to learn more about updating the PHP version the site is running on.
 *
 * Do not use this function to retrieve this URL. Instead, use {@see wp_get_update_php_url()} when relying on the URL.
 * This function does not allow modifying the returned URL, and is only used to compare the actually used URL with the
 * default one.
 *
 * @since WP 5.1.0
 * @deprecated 1.0.0
 * @access private
 *
 * @return string Default URL to learn more about updating PHP.
 */
function wp_get_default_update_php_url() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return '';
}

/**
 * Gets the URL to learn more about updating the PHP version the site is running on.
 *
 * This URL can be overridden by specifying an environment variable `WP_UPDATE_PHP_URL` or by using the
 * {@see 'wp_update_php_url'} filter. Providing an empty string is not allowed and will result in the
 * default URL being used. Furthermore the page the URL links to should preferably be localized in the
 * site language.
 *
 * @since WP 5.1.0
 * @deprecated 1.0.0
 *
 * @return string URL to learn more about updating PHP.
 */
function wp_get_update_php_url() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return '';
}

/**
 * Returns the default annotation for the web hosting altering the "Update PHP" page URL.
 *
 * This function is to be used after {@see wp_get_update_php_url()} to return a consistent
 * annotation if the web host has altered the default "Update PHP" page URL.
 *
 * @since WP 5.2.0
 * @deprecated 1.0.0
 *
 * @return string Update PHP page annotation. An empty string if no custom URLs are provided.
 */
function wp_get_update_php_annotation() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return '';
}

/**
 * Prints the default annotation for the web host altering the "Update PHP" page URL.
 *
 * This function is to be used after {@see wp_get_update_php_url()} to display a consistent
 * annotation if the web host has altered the default "Update PHP" page URL.
 *
 * @since WP 5.1.0
 * @since WP 5.2.0 Added the `$before` and `$after` parameters.
 * @since WP 6.4.0 Added the `$display` parameter.
 * @deprecated 1.0.0
 *
 * @param string $before  Markup to output before the annotation. Default `<p class="description">`.
 * @param string $after   Markup to output after the annotation. Default `</p>`.
 * @param bool   $display Whether to echo or return the markup. Default `true` for echo.
 *
 * @return string|void
 */
function wp_update_php_annotation( $before = '<p class="description">', $after = '</p>', $display = true ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return '';
}

/**
 * Gets the URL for directly updating the PHP version the site is running on.
 *
 * A URL will only be returned if the `WP_DIRECT_UPDATE_PHP_URL` environment variable is specified or
 * by using the {@see 'wp_direct_php_update_url'} filter. This allows hosts to send users directly to
 * the page where they can update PHP to a newer version.
 *
 * @since WP 5.1.1
 * @deprecated 1.0.0
 *
 * @return string URL for directly updating PHP or empty string.
 */
function wp_get_direct_php_update_url() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return '';
}

/**
 * Displays a button directly linking to a PHP update process.
 *
 * This provides hosts with a way for users to be sent directly to their PHP update process.
 *
 * The button is only displayed if a URL is returned by `wp_get_direct_php_update_url()`.
 *
 * @since WP 5.1.1
 * @deprecated 1.0.0
 */
function wp_direct_php_update_button() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Gets the URL to learn more about updating the site to use HTTPS.
 *
 * This URL can be overridden by specifying an environment variable `WP_UPDATE_HTTPS_URL` or by using the
 * {@see 'wp_update_https_url'} filter. Providing an empty string is not allowed and will result in the
 * default URL being used. Furthermore the page the URL links to should preferably be localized in the
 * site language.
 *
 * @since WP 5.7.0
 * @deprecated 1.0.0
 *
 * @return string URL to learn more about updating to HTTPS.
 */
function wp_get_update_https_url() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return '';
}

/**
 * Gets the default URL to learn more about updating the site to use HTTPS.
 *
 * Do not use this function to retrieve this URL. Instead, use {@see wp_get_update_https_url()} when relying on the URL.
 * This function does not allow modifying the returned URL, and is only used to compare the actually used URL with the
 * default one.
 *
 * @since WP 5.7.0
 * @deprecated 1.0.0
 * @access private
 *
 * @return string Default URL to learn more about updating to HTTPS.
 */
function wp_get_default_update_https_url() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return '';
}

/**
 * Gets the URL for directly updating the site to use HTTPS.
 *
 * A URL will only be returned if the `WP_DIRECT_UPDATE_HTTPS_URL` environment variable is specified or
 * by using the {@see 'wp_direct_update_https_url'} filter. This allows hosts to send users directly to
 * the page where they can update their site to use HTTPS.
 *
 * @since WP 5.7.0
 * @deprecated 1.0.0
 *
 * @return string URL for directly updating to HTTPS or empty string.
 */
function wp_get_direct_update_https_url() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return '';
}

/**
 * Localizes community events data that needs to be passed to dashboard.js.
 *
 * @since WP 4.8.0
 * @deprecated 1.0.0
 */
function wp_localize_community_events() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Handles Ajax requests for community events
 *
 * @since WP 4.8.0
 * @deprecated 1.0.0
 */
function wp_ajax_get_community_events() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Handles dashboard widgets via AJAX.
 *
 * @since 3.4.0
 * @deprecated 1.0.0
 */
function wp_ajax_dashboard_widgets() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Renders the Events and News dashboard widget.
 *
 * @since 4.8.0
 * @deprecated 1.0.0
 */
function wp_dashboard_events_news() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Prints the markup for the Community Events section of the Events and News Dashboard widget.
 *
 * @since WP 4.8.0
 * @deprecated 1.0.0
 */
function wp_print_community_events_markup() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Renders the events templates for the Event and News widget.
 *
 * @since WP 4.8.0
 * @deprecated 1.0.0
 */
function wp_print_community_events_templates() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Enqueues the assets required for the block directory within the block editor.
 *
 * @since WP 5.5.0
 * @deprecated 1.0.0 Retraceur does not allow remote access to WP Block directory.
 */
function wp_enqueue_editor_block_directory_assets() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Normalize the pattern properties to camelCase.
 *
 * The API's format is snake_case, `register_block_pattern()` expects camelCase.
 *
 * @since WP 6.2.0
 *
 * @deprecated 1.0.0 Retraceur does not allow remote access to WP Pattern directory.
 *
 * @access private
 *
 * @param array $pattern Pattern as returned from the Pattern Directory API.
 * @return array Normalized pattern.
 */
function wp_normalize_remote_block_pattern( $pattern ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Register Core's official patterns.
 *
 * @since WP 5.8.0
 * @since WP 5.9.0 The $current_screen argument was removed.
 * @since WP 6.2.0 Normalize the pattern from the API (snake_case) to the
 *              format expected by `register_block_pattern` (camelCase).
 * @since WP 6.3.0 Add 'pattern-directory/core' to the pattern's 'source'.
 *
 * @deprecated 1.0.0 Retraceur does not allow remote access to WP Pattern directory.
 *
 * @param WP_Screen $deprecated Unused. Formerly the screen that the current request was triggered from.
 */
function _load_remote_block_patterns( $deprecated = null ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Register `Featured` (category) patterns.
 *
 * @since WP 5.9.0
 * @since WP 6.2.0 Normalized the pattern from the API (snake_case) to the
 *              format expected by `register_block_pattern()` (camelCase).
 * @since WP 6.3.0 Add 'pattern-directory/featured' to the pattern's 'source'.
 *
 * @deprecated 1.0.0 Retraceur does not allow remote access to WP Pattern directory.
 */
function _load_remote_featured_patterns() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Registers patterns from Pattern Directory provided by a theme's
 * `theme.json` file.
 *
 * @since WP 6.0.0
 * @since WP 6.2.0 Normalized the pattern from the API (snake_case) to the
 *              format expected by `register_block_pattern()` (camelCase).
 * @since WP 6.3.0 Add 'pattern-directory/theme' to the pattern's 'source'.
 *
 * @deprecated 1.0.0 Retraceur does not allow remote access to WP Pattern directory.
 *
 * @access private
 */
function _register_remote_theme_patterns() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Includes and instantiates the WP_Customize_Manager class.
 *
 * Loads the Customizer at plugins_loaded when accessing the customize.php admin
 * page or when any request includes a wp_customize=on param or a customize_changeset
 * param (a UUID). This param is a signal for whether to bootstrap the Customizer when
 * WordPress is loading, especially in the Customizer preview
 * or when making Customizer Ajax requests for widgets or menus.
 *
 * @since WP 3.4.0
 * @deprecated 1.0.0 Retraceur removed the customizer feature.
 */
function _wp_customize_include() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Publishes a snapshot's changes.
 *
 * @since WP 4.7.0
 * @deprecated 1.0.0 Retraceur removed the customizer feature.
 * @access private
 *
 * @param string  $new_status     New post status.
 * @param string  $old_status     Old post status.
 * @param WP_Post $changeset_post Changeset post object.
 */
function _wp_customize_publish_changeset( $new_status, $old_status, $changeset_post ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Filters changeset post data upon insert to ensure post_name is intact.
 *
 * This is needed to prevent the post_name from being dropped when the post is
 * transitioned into pending status by a contributor.
 *
 * @since WP 4.7.0
 * @deprecated 1.0.0 Retraceur removed the customizer feature.
 *
 * @see wp_insert_post()
 *
 * @param array $post_data          An array of slashed post data.
 * @param array $supplied_post_data An array of sanitized, but otherwise unmodified post data.
 * @return array Filtered data.
 */
function _wp_customize_changeset_filter_insert_post_data( $post_data, $supplied_post_data ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Adds settings for the customize-loader script.
 *
 * @since WP 3.4.0
 * @deprecated 1.0.0 Retraceur removed the customizer feature.
 */
function _wp_customize_loader_settings() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Returns a URL to load the Customizer.
 *
 * @since WP 3.4.0
 * @deprecated 1.0.0 Retraceur removed the customizer feature.
 *
 * @param string $stylesheet Optional. Theme to customize. Defaults to active theme.
 *                           The theme's stylesheet will be urlencoded if necessary.
 * @return string
 */
function wp_customize_url( $stylesheet = '' ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return esc_url( admin_url( 'customize.php' ) );
}

/**
 * Prints a script to check whether or not the Customizer is supported,
 * and apply either the no-customize-support or customize-support class
 * to the body.
 *
 * This function MUST be called inside the body tag.
 *
 * Ideally, call this function immediately after the body tag is opened.
 * This prevents a flash of unstyled content.
 *
 * It is also recommended that you add the "no-customize-support" class
 * to the body tag by default.
 *
 * @since WP 3.4.0
 * @since WP 4.7.0 Support for IE8 and below is explicitly removed via conditional comments.
 * @since WP 5.5.0 IE8 and older are no longer supported.
 * @deprecated 1.0.0 Retraceur removed the customizer feature.
 */
function wp_customize_support_script() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Whether the site is being previewed in the Customizer.
 *
 * @since WP 4.0.0
 * @deprecated 1.0.0 Retraceur removed the customizer feature.
 *
 * @return bool True if the site is being previewed in the Customizer, false otherwise.
 */
function is_customize_preview() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return false;
}

/**
 * Makes sure that auto-draft posts get their post_date bumped or status changed
 * to draft to prevent premature garbage-collection.
 *
 * When a changeset is updated but remains an auto-draft, ensure the post_date
 * for the auto-draft posts remains the same so that it will be
 * garbage-collected at the same time by `wp_delete_auto_drafts()`. Otherwise,
 * if the changeset is updated to be a draft then update the posts
 * to have a far-future post_date so that they will never be garbage collected
 * unless the changeset post itself is deleted.
 *
 * When a changeset is updated to be a persistent draft or to be scheduled for
 * publishing, then transition any dependent auto-drafts to a draft status so
 * that they likewise will not be garbage-collected but also so that they can
 * be edited in the admin before publishing since there is not yet a post/page
 * editing flow in the Customizer.
 *
 * @since WP 4.8.0
 * @deprecated 1.0.0 Retraceur removed the customizer feature.
 * @access private
 * @see wp_delete_auto_drafts()
 *
 * @param string   $new_status Transition to this post status.
 * @param string   $old_status Previous post status.
 * @param \WP_Post $post       Post data.
 */
function _wp_keep_alive_customize_changeset_dependent_auto_drafts( $new_status, $old_status, $post ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Adds the "Customize" link to the Toolbar.
 *
 * @since WP 4.3.0
 * @deprecated 1.0.0 Retraceur removed the customizer feature.
 *
 * @param WP_Admin_Bar $wp_admin_bar The WP_Admin_Bar instance.
 */
function wp_admin_bar_customize_menu( $wp_admin_bar ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Deletes auto-draft posts associated with the supplied changeset.
 *
 * @since WP 4.8.0
 * @deprecated 1.0.0 Retraceur removed the customizer feature.
 * @access private
 *
 * @param int $post_id Post ID for the customize_changeset.
 */
function _wp_delete_customize_changeset_dependent_auto_drafts( $post_id ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Determines if Widgets library should be loaded.
 *
 * Checks to make sure that the widgets library hasn't already been loaded.
 * If it hasn't, then it will load the widgets library and run an action hook.
 *
 * @since WP 2.2.0
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 */
function wp_maybe_load_widgets() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Appends the Widgets menu to the themes main menu.
 *
 * @since WP 2.2.0
 * @since WP 5.9.3 Don't specify menu order when the active theme is a block theme.
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 */
function wp_widgets_add_menu() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Enables the widgets block editor. This is hooked into 'after_setup_theme' so
 * that the block editor is enabled by default but can be disabled by themes.
 *
 * @since WP 5.8.0
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 *
 * @access private
 */
function wp_setup_widgets_block_editor() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Displays a _doing_it_wrong() message for conflicting widget editor scripts.
 *
 * The 'wp-editor' script module is exposed as window.wp.editor. This overrides
 * the legacy TinyMCE editor module which is required by the widgets editor.
 * Because of that conflict, these two shouldn't be enqueued together.
 *
 * There is also another conflict related to styles where the block widgets
 * editor is hidden if a block enqueues 'wp-edit-post' stylesheet.
 *
 * @since WP 5.8.0
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 *
 * @access private
 */
function wp_check_widget_editor_deps() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Validates and remaps any "orphaned" widgets to wp_inactive_widgets sidebar,
 * and saves the widget settings. This has to run at least on each theme change.
 *
 * For example, let's say theme A has a "footer" sidebar, and theme B doesn't have one.
 * After switching from theme A to theme B, all the widgets previously assigned
 * to the footer would be inaccessible. This function detects this scenario, and
 * moves all the widgets previously assigned to the footer under wp_inactive_widgets.
 *
 * Despite the word "retrieve" in the name, this function actually updates the database
 * and the global `$sidebars_widgets`. For that reason it should not be run on front end,
 * unless the `$theme_changed` value is 'customize' (to bypass the database write).
 *
 * @since WP 2.8.0
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 *
 * @param string|bool $theme_changed Whether the theme was changed as a boolean. A value
 *                                   of 'customize' defers updates for the Customizer.
 */
function retrieve_widgets( $theme_changed = false ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Handle sidebars config after theme change
 *
 * @since WP 3.3.0
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 *
 * @access private
 */
function _wp_sidebars_changed() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Register a widget
 *
 * Registers a WP_Widget widget
 *
 * @since      WP 2.8.0
 * @since      WP 4.6.0 Updated the `$widget` parameter to also accept a WP_Widget instance object
 *                      instead of simply a `WP_Widget` subclass name.
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 *
 * @see WP_Widget
 *
 * @param string|WP_Widget $widget Either the name of a `WP_Widget` subclass or an instance of a `WP_Widget` subclass.
 */
function register_widget( $widget ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Unregisters a widget.
 *
 * Unregisters a WP_Widget widget. Useful for un-registering default widgets.
 * Run within a function hooked to the {@see 'widgets_init'} action.
 *
 * @since      WP 2.8.0
 * @since      WP 4.6.0 Updated the `$widget` parameter to also accept a WP_Widget instance object
 *                      instead of simply a `WP_Widget` subclass name.
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 *
 * @see WP_Widget
 *
 * @param string|WP_Widget $widget Either the name of a `WP_Widget` subclass or an instance of a `WP_Widget` subclass.
 */
function unregister_widget( $widget ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Creates multiple sidebars.
 *
 * If you wanted to quickly create multiple sidebars for a theme or internally.
 * This function will allow you to do so. If you don't pass the 'name' and/or
 * 'id' in `$args`, then they will be built for you.
 *
 * @since      WP 2.2.0
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 *
 * @see register_sidebar() The second parameter is documented by register_sidebar() and is the same here.
 *
 * @param int          $number Optional. Number of sidebars to create. Default 1.
 * @param array|string $args {
 *     Optional. Array or string of arguments for building a sidebar.
 *
 *     @type string $id   The base string of the unique identifier for each sidebar. If provided, and multiple
 *                        sidebars are being defined, the ID will have "-2" appended, and so on.
 *                        Default 'sidebar-' followed by the number the sidebar creation is currently at.
 *     @type string $name The name or title for the sidebars displayed in the admin dashboard. If registering
 *                        more than one sidebar, include '%d' in the string as a placeholder for the uniquely
 *                        assigned number for each sidebar.
 *                        Default 'Sidebar' for the first sidebar, otherwise 'Sidebar %d'.
 * }
 */
function register_sidebars( $number = 1, $args = array() ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Builds the definition for a single sidebar and returns the ID.
 *
 * Accepts either a string or an array and then parses that against a set
 * of default arguments for the new sidebar. WordPress will automatically
 * generate a sidebar ID and name based on the current number of registered
 * sidebars if those arguments are not included.
 *
 * When allowing for automatic generation of the name and ID parameters, keep
 * in mind that the incrementor for your sidebar can change over time depending
 * on what other plugins and themes are installed.
 *
 * If theme support for 'widgets' has not yet been added when this function is
 * called, it will be automatically enabled through the use of add_theme_support()
 *
 * @since      WP 2.2.0
 * @since      WP 5.6.0 Added the `before_sidebar` and `after_sidebar` arguments.
 * @since      WP 5.9.0 Added the `show_in_rest` argument.
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 *
 * @param array|string $args {
 *     Optional. Array or string of arguments for the sidebar being registered.
 *
 *     @type string $name           The name or title of the sidebar displayed in the Widgets
 *                                  interface. Default 'Sidebar $instance'.
 *     @type string $id             The unique identifier by which the sidebar will be called.
 *                                  Default 'sidebar-$instance'.
 *     @type string $description    Description of the sidebar, displayed in the Widgets interface.
 *                                  Default empty string.
 *     @type string $class          Extra CSS class to assign to the sidebar in the Widgets interface.
 *                                  Default empty.
 *     @type string $before_widget  HTML content to prepend to each widget's HTML output when assigned
 *                                  to this sidebar. Receives the widget's ID attribute as `%1$s`
 *                                  and class name as `%2$s`. Default is an opening list item element.
 *     @type string $after_widget   HTML content to append to each widget's HTML output when assigned
 *                                  to this sidebar. Default is a closing list item element.
 *     @type string $before_title   HTML content to prepend to the sidebar title when displayed.
 *                                  Default is an opening h2 element.
 *     @type string $after_title    HTML content to append to the sidebar title when displayed.
 *                                  Default is a closing h2 element.
 *     @type string $before_sidebar HTML content to prepend to the sidebar when displayed.
 *                                  Receives the `$id` argument as `%1$s` and `$class` as `%2$s`.
 *                                  Outputs after the {@see 'dynamic_sidebar_before'} action.
 *                                  Default empty string.
 *     @type string $after_sidebar  HTML content to append to the sidebar when displayed.
 *                                  Outputs before the {@see 'dynamic_sidebar_after'} action.
 *                                  Default empty string.
 *     @type bool $show_in_rest     Whether to show this sidebar publicly in the REST API.
 *                                  Defaults to only showing the sidebar to administrator users.
 * }
 */
function register_sidebar( $args = array() ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Removes a sidebar from the list.
 *
 * @since WP 2.2.0
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 *
 * @param string|int $sidebar_id The ID of the sidebar when it was registered.
 */
function unregister_sidebar( $sidebar_id ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Checks if a sidebar is registered.
 *
 * @since      WP 4.4.0
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 *
 * @param string|int $sidebar_id The ID of the sidebar when it was registered.
 * @return bool True if the sidebar is registered, false otherwise.
 */
function is_registered_sidebar( $sidebar_id ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return false;
}

/**
 * Register an instance of a widget.
 *
 * The default widget option is 'classname' that can be overridden.
 *
 * The function can also be used to un-register widgets when `$output_callback`
 * parameter is an empty string.
 *
 * @since      WP 2.2.0
 * @since      WP 5.3.0 Formalized the existing and already documented `...$params` parameter
 *                      by adding it to the function signature.
 * @since      WP 5.8.0 Added show_instance_in_rest option.
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 *
 * @param int|string $id              Widget ID.
 * @param string     $name            Widget display title.
 * @param callable   $output_callback Run when widget is called.
 * @param array      $options {
 *     Optional. An array of supplementary widget options for the instance.
 *
 *     @type string $classname             Class name for the widget's HTML container. Default is a shortened
 *                                         version of the output callback name.
 *     @type string $description           Widget description for display in the widget administration
 *                                         panel and/or theme.
 *     @type bool   $show_instance_in_rest Whether to show the widget's instance settings in the REST API.
 *                                         Only available for WP_Widget based widgets.
 * }
 * @param mixed      ...$params       Optional additional parameters to pass to the callback function when it's called.
 */
function wp_register_sidebar_widget( $id, $name, $output_callback, $options = array(), ...$params ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Retrieve description for widget.
 *
 * When registering widgets, the options can also include 'description' that
 * describes the widget for display on the widget administration panel or
 * in the theme.
 *
 * @since      WP 2.5.0
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 *
 * @param int|string $id Widget ID.
 */
function wp_widget_description( $id ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Retrieve description for a sidebar.
 *
 * When registering sidebars a 'description' parameter can be included that
 * describes the sidebar for display on the widget administration panel.
 *
 * @since WP 2.9.0
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 *
 * @param string $id sidebar ID.
 */
function wp_sidebar_description( $id ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Remove widget from sidebar.
 *
 * @since WP 2.2.0
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 *
 * @param int|string $id Widget ID.
 */
function wp_unregister_sidebar_widget( $id ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Fires just before a widget is removed from a sidebar.
	 *
	 * @since WP 3.0.0
	 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
	 *
	 * @param int|string $id The widget ID.
	 */
	do_action_deprecated(
		'wp_unregister_sidebar_widget',
		array( $id ),
		'1.0.0',
		'',
		__( 'The Widgets feature is not available in Retraceur.' )
	);
}

/**
 * Registers widget control callback for customizing options.
 *
 * @since WP 2.2.0
 * @since WP 5.3.0 Formalized the existing and already documented `...$params` parameter
 *              by adding it to the function signature.
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 *
 * @param int|string $id               Sidebar ID.
 * @param string     $name             Sidebar display name.
 * @param callable   $control_callback Run when sidebar is displayed.
 * @param array      $options {
 *     Optional. Array or string of control options. Default empty array.
 *
 *     @type int        $height  Never used. Default 200.
 *     @type int        $width   Width of the fully expanded control form (but try hard to use the default width).
 *                               Default 250.
 *     @type int|string $id_base Required for multi-widgets, i.e widgets that allow multiple instances such as the
 *                               text widget. The widget ID will end up looking like `{$id_base}-{$unique_number}`.
 * }
 * @param mixed      ...$params        Optional additional parameters to pass to the callback function when it's called.
 */
function wp_register_widget_control( $id, $name, $control_callback, $options = array(), ...$params ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Registers the update callback for a widget.
 *
 * @since WP 2.8.0
 * @since WP 5.3.0 Formalized the existing and already documented `...$params` parameter
 *              by adding it to the function signature.
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 *
 * @param string   $id_base         The base ID of a widget created by extending WP_Widget.
 * @param callable $update_callback Update callback method for the widget.
 * @param array    $options         Optional. Widget control options. See wp_register_widget_control().
 *                                  Default empty array.
 * @param mixed    ...$params       Optional additional parameters to pass to the callback function when it's called.
 */
function _register_widget_update_callback( $id_base, $update_callback, $options = array(), ...$params ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Registers the form callback for a widget.
 *
 * @since WP 2.8.0
 * @since WP 5.3.0 Formalized the existing and already documented `...$params` parameter
 *              by adding it to the function signature.
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 *
 * @param int|string $id            Widget ID.
 * @param string     $name          Name attribute for the widget.
 * @param callable   $form_callback Form callback.
 * @param array      $options       Optional. Widget control options. See wp_register_widget_control().
 *                                  Default empty array.
 * @param mixed      ...$params     Optional additional parameters to pass to the callback function when it's called.
 */

function _register_widget_form_callback( $id, $name, $form_callback, $options = array(), ...$params ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Remove control callback for widget.
 *
 * @since WP 2.2.0
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 *
 * @param int|string $id Widget ID.
 */
function wp_unregister_widget_control( $id ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Display dynamic sidebar.
 *
 * By default this displays the default sidebar or 'sidebar-1'. If your theme specifies the 'id' or
 * 'name' parameter for its registered sidebars you can pass an ID or name as the $index parameter.
 * Otherwise, you can pass in a numerical index to display the sidebar at that index.
 *
 * @since WP 2.2.0
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 *
 * @param int|string $index Optional. Index, name or ID of dynamic sidebar. Default 1.
 */
function dynamic_sidebar( $index = 1 ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Fires before widgets are rendered in a dynamic sidebar.
	 *
	 * Note: The action also fires for empty sidebars, and on both the front end
	 * and back end, including the Inactive Widgets sidebar on the Widgets screen.
	 *
	 * @since WP 3.9.0
	 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
	 *
	 * @param int|string $index       Index, name, or ID of the dynamic sidebar.
	 * @param bool       $has_widgets Whether the sidebar is populated with widgets.
	 *                                Default true.
	 */
	do_action_deprecated(
		'dynamic_sidebar_before',
		array( $index, true ),
		'1.0.0',
		'',
		__( 'The Widgets feature is not available in Retraceur.' )
	);

	/**
	 * Filters the parameters passed to a widget's display callback.
	 *
	 * Note: The filter is evaluated on both the front end and back end,
	 * including for the Inactive Widgets sidebar on the Widgets screen.
	 *
	 * @since WP 2.5.0
	 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
	 *
	 * @see register_sidebar()
	 *
	 * @param array $params {
	 *     @type array $args  {
	 *         An array of widget display arguments.
	 *
	 *         @type string $name          Name of the sidebar the widget is assigned to.
	 *         @type string $id            ID of the sidebar the widget is assigned to.
	 *         @type string $description   The sidebar description.
	 *         @type string $class         CSS class applied to the sidebar container.
	 *         @type string $before_widget HTML markup to prepend to each widget in the sidebar.
	 *         @type string $after_widget  HTML markup to append to each widget in the sidebar.
	 *         @type string $before_title  HTML markup to prepend to the widget title when displayed.
	 *         @type string $after_title   HTML markup to append to the widget title when displayed.
	 *         @type string $widget_id     ID of the widget.
	 *         @type string $widget_name   Name of the widget.
	 *     }
	 *     @type array $widget_args {
	 *         An array of multi-widget arguments.
	 *
	 *         @type int $number Number increment used for multiples of the same widget.
	 *     }
	 * }
	 */
	apply_filters_deprecated(
		'dynamic_sidebar_params',
		array( array() ),
		'1.0.0',
		'',
		__( 'Widgets are not supported in Retraceur.' )
	);

	/**
	 * Fires before a widget's display callback is called.
	 *
	 * Note: The action fires on both the front end and back end, including
	 * for widgets in the Inactive Widgets sidebar on the Widgets screen.
	 *
	 * The action is not fired for empty sidebars.
	 *
	 * @since WP 3.0.0
	 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
	 *
	 * @param array $widget {
	 *     An associative array of widget arguments.
	 *
	 *     @type string   $name        Name of the widget.
	 *     @type string   $id          Widget ID.
	 *     @type callable $callback    When the hook is fired on the front end, `$callback` is an array
	 *                                 containing the widget object. Fired on the back end, `$callback`
	 *                                 is 'wp_widget_control', see `$_callback`.
	 *     @type array    $params      An associative array of multi-widget arguments.
	 *     @type string   $classname   CSS class applied to the widget container.
	 *     @type string   $description The widget description.
	 *     @type array    $_callback   When the hook is fired on the back end, `$_callback` is populated
	 *                                 with an array containing the widget object, see `$callback`.
	 * }
	 */
	do_action_deprecated(
		'dynamic_sidebar',
		array( array() ),
		'1.0.0',
		'',
		__( 'The Widgets feature is not available in Retraceur.' )
	);

	/**
	 * Fires after widgets are rendered in a dynamic sidebar.
	 *
	 * Note: The action also fires for empty sidebars, and on both the front end
	 * and back end, including the Inactive Widgets sidebar on the Widgets screen.
	 *
	 * @since WP 3.9.0
	 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
	 *
	 * @param int|string $index       Index, name, or ID of the dynamic sidebar.
	 * @param bool       $has_widgets Whether the sidebar is populated with widgets.
	 *                                Default true.
	 */
	do_action_deprecated(
		'dynamic_sidebar_after',
		array( $index, false ),
		'1.0.0',
		'',
		__( 'The Widgets feature is not available in Retraceur.' )
	);

	/**
	 * Filters whether a sidebar has widgets.
	 *
	 * Note: The filter is also evaluated for empty sidebars, and on both the front end
	 * and back end, including the Inactive Widgets sidebar on the Widgets screen.
	 *
	 * @since WP 3.9.0
	 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
	 *
	 * @param bool       $did_one Whether at least one widget was rendered in the sidebar.
	 *                            Default false.
	 * @param int|string $index   Index, name, or ID of the dynamic sidebar.
	 */
	apply_filters_deprecated(
		'dynamic_sidebar_has_widgets',
		array( $did_one, $index ),
		'1.0.0',
		'',
		__( 'Widgets are not supported in Retraceur.' )
	);
}

/**
 * Determines whether a given widget is displayed on the front end.
 *
 * Either $callback or $id_base can be used
 * $id_base is the first argument when extending WP_Widget class
 * Without the optional $widget_id parameter, returns the ID of the first sidebar
 * in which the first instance of the widget with the given callback or $id_base is found.
 * With the $widget_id parameter, returns the ID of the sidebar where
 * the widget with that callback/$id_base AND that ID is found.
 *
 * NOTE: $widget_id and $id_base are the same for single widgets. To be effective
 * this function has to run after widgets have initialized, at action {@see 'init'} or later.
 *
 * @since WP 2.2.0
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 *
 * @param callable|false $callback      Optional. Widget callback to check. Default false.
 * @param string|false   $widget_id     Optional. Widget ID. Optional, but needed for checking.
 *                                      Default false.
 * @param string|false   $id_base       Optional. The base ID of a widget created by extending WP_Widget.
 *                                      Default false.
 * @param bool           $skip_inactive Optional. Whether to check in 'wp_inactive_widgets'.
 *                                      Default true.
 * @return string|false ID of the sidebar in which the widget is active,
 *                      false if the widget is not active.
 */
function is_active_widget( $callback = false, $widget_id = false, $id_base = false, $skip_inactive = true ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Determines whether the dynamic sidebar is enabled and used by the theme.
 *
 * @since WP 2.2.0
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 *
 * @return bool True if using widgets, false otherwise.
 */
function is_dynamic_sidebar() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Determines whether a sidebar contains widgets.
 *
 * @since WP 2.8.0
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 *
 * @param string|int $index Sidebar name, id or number to check.
 * @return bool True if the sidebar has widgets, false otherwise.
 */
function is_active_sidebar( $index ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters whether a dynamic sidebar is considered "active".
	 *
	 * @since WP 3.9.0
	 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
	 *
	 * @param bool       $is_active_sidebar Whether or not the sidebar should be considered "active".
	 *                                      In other words, whether the sidebar contains any widgets.
	 * @param int|string $index             Index, name, or ID of the dynamic sidebar.
	 */
	apply_filters_deprecated(
		'is_active_sidebar',
		array( $is_active_sidebar, $index ),
		'1.0.0',
		'',
		__( 'Widgets are not supported in Retraceur.' )
	);
}

/**
 * Retrieve full list of sidebars and their widget instance IDs.
 *
 * Will upgrade sidebar widget list, if needed. Will also save updated list, if
 * needed.
 *
 * @since WP 2.2.0
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 * @access private
 *
 * @param bool $deprecated Not used (argument deprecated).
 */
function wp_get_sidebars_widgets( $deprecated = true ) {
	if ( true !== $deprecated ) {
		_deprecated_argument( __FUNCTION__, '2.8.1' );
	}

	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the list of sidebars and their widgets.
	 *
	 * @since WP 2.7.0
	 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
	 *
	 * @param array $sidebars_widgets An associative array of sidebars and their widgets.
	 */
	apply_filters_deprecated(
		'sidebars_widgets',
		array( $sidebars_widgets ),
		'1.0.0',
		'',
		__( 'Widgets are not supported in Retraceur.' )
	);
}

/**
 * Retrieves the registered sidebar with the given ID.
 *
 * @since WP 5.9.0
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 *
 * @param string $id The sidebar ID.
 */
function wp_get_sidebar( $id ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Set the sidebar widget option to update sidebars.
 *
 * @since WP 2.2.0
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 * @access private
 *
 * @global array $_wp_sidebars_widgets
 * @param array $sidebars_widgets Sidebar widgets and their settings.
 */
function wp_set_sidebars_widgets( $sidebars_widgets ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Retrieve default registered sidebars list.
 *
 * @since WP 2.2.0
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 * @access private
 *
 * @return array
 */
function wp_get_widget_defaults() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Converts the widget settings from single to multi-widget format.
 *
 * @since WP 2.8.0
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 *
 * @global array $_wp_sidebars_widgets
 *
 * @param string $base_name   Root ID for all widgets of this type.
 * @param string $option_name Option name for this widget type.
 * @param array  $settings    The array of widget instance settings.
 * @return array The array of widget settings converted to multi-widget format.
 */
function wp_convert_widget_settings( $base_name, $option_name, $settings ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Output an arbitrary widget as a template tag.
 *
 * @since WP 2.8.0
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 *
 * @param string $widget   The widget's PHP class name (see class-wp-widget.php).
 * @param array  $instance Optional. The widget's instance settings. Default empty array.
 * @param array  $args {
 *     Optional. Array of arguments to configure the display of the widget.
 *
 *     @type string $before_widget HTML content that will be prepended to the widget's HTML output.
 *                                 Default `<div class="widget %s">`, where `%s` is the widget's class name.
 *     @type string $after_widget  HTML content that will be appended to the widget's HTML output.
 *                                 Default `</div>`.
 *     @type string $before_title  HTML content that will be prepended to the widget's title when displayed.
 *                                 Default `<h2 class="widgettitle">`.
 *     @type string $after_title   HTML content that will be appended to the widget's title when displayed.
 *                                 Default `</h2>`.
 * }
 */
function the_widget( $widget, $instance = array(), $args = array() ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Fires before rendering the requested widget.
	 *
	 * @since WP 3.0.0
	 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
	 *
	 * @param string $widget   The widget's class name.
	 * @param array  $instance The current widget instance's settings.
	 * @param array  $args     An array of the widget's sidebar arguments.
	 */
	do_action_deprecated(
		'the_widget',
		array( $widget, $instance, $args ),
		'1.0.0',
		'',
		__( 'The Widgets feature is not available in Retraceur.' )
	);
}

/**
 * Retrieves the widget ID base value.
 *
 * @since WP 2.8.0
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 *
 * @param string $id Widget ID.
 */
function _get_widget_id_base( $id ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Compares a list of sidebars with their widgets against an allowed list.
 *
 * @since WP 4.9.0
 * @since WP 4.9.2 Always tries to restore widget assignments from previous data, not just if sidebars needed mapping.
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 *
 * @param array $existing_sidebars_widgets List of sidebars and their widget instance IDs.
 * @return array Mapped sidebars widgets.
 */
function wp_map_sidebars_widgets( $existing_sidebars_widgets ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Compares a list of sidebars with their widgets against an allowed list.
 *
 * @since WP 4.9.0
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 *
 * @param array $sidebars_widgets   List of sidebars and their widget instance IDs.
 * @param array $allowed_widget_ids Optional. List of widget IDs to compare against. Default: Registered widgets.
 */
function _wp_remove_unregistered_widgets( $sidebars_widgets, $allowed_widget_ids = array() ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Display the RSS entries in a list.
 *
 * @since WP 2.5.0
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 *
 * @param string|array|object $rss  RSS url.
 * @param array               $args Widget arguments.
 */
function wp_widget_rss_output( $rss, $args = array() ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Display RSS widget options form.
 *
 * The options for what fields are displayed for the RSS form are all booleans
 * and are as follows: 'url', 'title', 'items', 'show_summary', 'show_author',
 * 'show_date'.
 *
 * @since WP 2.5.0
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 *
 * @param array|string $args   Values for input fields.
 * @param array        $inputs Override default display options.
 */
function wp_widget_rss_form( $args, $inputs = null ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Process RSS feed widget data and optionally retrieve feed items.
 *
 * The feed widget can not have more than 20 items or it will reset back to the
 * default, which is 10.
 *
 * The resulting array has the feed title, feed url, feed link (from channel),
 * feed items, error (if any), and whether to show summary, author, and date.
 * All respectively in the order of the array elements.
 *
 * @since WP 2.5.0
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 *
 * @param array $widget_rss RSS widget feed data. Expects unescaped data.
 * @param bool  $check_feed Optional. Whether to check feed for errors. Default true.
 * @return array
 */
function wp_widget_rss_process( $widget_rss, $check_feed = true ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Registers all of the default WordPress widgets on startup.
 *
 * Calls {@see 'widgets_init'} action after all of the WordPress widgets have been registered.
 *
 * @since WP 2.2.0
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 */
function wp_widgets_init() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Fires after all default WordPress widgets have been registered.
	 *
	 * @since WP 2.2.0
	 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
	 */
	do_action_deprecated(
		'widgets_init',
		array(),
		'1.0.0',
		'',
		__( 'The Widgets feature is not available in Retraceur.' )
	);
}

/**
 * Whether or not to use the block editor to manage widgets. Defaults to true
 * unless a theme has removed support for widgets-block-editor or a plugin has
 * filtered the return value of this function.
 *
 * @since WP 5.8.0
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 *
 * @return bool Whether to use the block editor to manage widgets.
 */
function wp_use_widgets_block_editor() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters whether to use the block editor to manage widgets.
	 *
	 * @since WP 5.8.0
	 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
	 *
	 * @param bool $use_widgets_block_editor Whether to use the block editor to manage widgets.
	 */
	apply_filters_deprecated(
		'use_widgets_block_editor',
		array( get_theme_support( 'widgets-block-editor' ) ),
		'1.0.0',
		'',
		__( 'Widgets are not supported in Retraceur.' )
	);
}

/**
 * Converts a widget ID into its id_base and number components.
 *
 * @since WP 5.8.0
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 *
 * @param string $id Widget ID.
 */
function wp_parse_widget_id( $id ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Finds the sidebar that a given widget belongs to.
 *
 * @since WP 5.8.0
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 *
 * @param string $widget_id The widget ID to look for.
 */
function wp_find_widgets_sidebar( $widget_id ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Assigns a widget to the given sidebar.
 *
 * @since WP 5.8.0
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 *
 * @param string $widget_id  The widget ID to assign.
 * @param string $sidebar_id The sidebar ID to assign to. If empty, the widget won't be added to any sidebar.
 */
function wp_assign_widget_to_sidebar( $widget_id, $sidebar_id ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Calls the render callback of a widget and returns the output.
 *
 * @since WP 5.8.0
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 *
 * @param string $widget_id Widget ID.
 * @param string $sidebar_id Sidebar ID.
 * @return string
 */
function wp_render_widget( $widget_id, $sidebar_id ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Calls the control callback of a widget and returns the output.
 *
 * @since WP 5.8.0
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 *
 * @param string $id Widget ID.
 * @return string|null
 */
function wp_render_widget_control( $id ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Registers the previous theme's sidebars for the block themes.
 *
 * @since WP 6.2.0
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 * @access private
 */
function _wp_block_theme_register_classic_sidebars() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Returns the block editor settings needed to use the Legacy Widget block which
 * is not registered by default.
 *
 * @since WP 5.8.0
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 *
 * @return array Settings to be used with get_block_editor_settings().
 */
function get_legacy_widget_block_editor_settings() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the list of widget-type IDs that should **not** be offered by the
	 * Legacy Widget block.
	 *
	 * Returning an empty array will make all widgets available.
	 *
	 * @since WP 5.8.0
	 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
	 *
	 * @param string[] $widgets An array of excluded widget-type IDs.
	 */
	apply_filters_deprecated(
		'widget_types_to_hide_from_legacy_widget_block',
		array(),
		'1.0.0',
		'',
		__( 'Widgets are not supported in Retraceur.' )
	);

	return array();
}

/**
 * Handles saving the widgets order via AJAX.
 *
 * @since WP 3.1.0
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 */
function wp_ajax_widgets_order() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Handles saving a widget via AJAX.
 *
 * @since WP 3.1.0
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 */
function wp_ajax_save_widget() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Handles updating a widget via AJAX.
 *
 * @since WP 3.9.0
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 */
function wp_ajax_update_widget() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Handles removing inactive widgets via AJAX.
 *
 * @since WP 4.4.0
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 */
function wp_ajax_delete_inactive_widgets() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Renders the 'core/legacy-widget' block.
 *
 * @since WP 5.8.0
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 *
 * @param array $attributes The block attributes.
 */
function render_block_core_legacy_widget( $attributes ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Registers the 'core/legacy-widget' block.
 *
 * @since WP 5.8.0
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 */
function register_block_core_legacy_widget() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Intercepts any request with legacy-widget-preview in the query param and, if
 * set, renders a page containing a preview of the requested Legacy Widget
 * block.
 *
 * @since WP 5.8.0
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 */
function handle_legacy_widget_preview_iframe() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}


/**
 * Renders the 'core/widget-group' block.
 *
 * @since WP 5.9.0
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 *
 * @param array    $attributes The block attributes.
 * @param string   $content The block content.
 * @param WP_Block $block The block.
 */
function render_block_core_widget_group( $attributes, $content, $block ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Registers the 'core/widget-group' block.
 *
 * @since WP 5.9.0
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 */
function register_block_core_widget_group() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Make a note of the sidebar being rendered before WordPress starts rendering
 * it. This lets us get to the current sidebar in
 * render_block_core_widget_group().
 *
 * @since WP 5.9.0
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 *
 * @param int|string $index Index, name, or ID of the dynamic sidebar.
 */
function note_sidebar_being_rendered( $index ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Clear whatever we set in note_sidebar_being_rendered() after WordPress
 * finishes rendering a sidebar.
 *
 * @since WP 5.9.0
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 */
function discard_sidebar_being_rendered() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Handles adding a link category via AJAX.
 *
 * @since WP 3.1.0
 * @deprecated 1.0.0 Retraceur removed the Link manager feature.
 *
 * @param string $action Action to perform.
 */
function wp_ajax_add_link_category( $action ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Handles deleting a link via AJAX.
 *
 * @since WP 3.1.0
 * @deprecated 1.0.0 Retraceur removed the Link manager feature.
 */
function wp_ajax_delete_link() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Retrieves bookmark data.
 *
 * @since WP 2.1.0
 * @deprecated 1.0.0 Retraceur removed the Link manager feature.
 *
 * @param int|stdClass $bookmark
 * @param string       $output   Optional. The required return type. One of OBJECT, ARRAY_A, or ARRAY_N, which
 *                               correspond to an stdClass object, an associative array, or a numeric array,
 *                               respectively. Default OBJECT.
 * @param string       $filter   Optional. How to sanitize bookmark fields. Default 'raw'.
 */
function get_bookmark( $bookmark, $output = OBJECT, $filter = 'raw' ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Retrieves single bookmark data item or field.
 *
 * @since WP 2.3.0
 * @deprecated 1.0.0 Retraceur removed the Link manager feature.
 *
 * @param string $field    The name of the data field to return.
 * @param int    $bookmark The bookmark ID to get field.
 * @param string $context  Optional. The context of how the field will be used. Default 'display'.
 */
function get_bookmark_field( $field, $bookmark, $context = 'display' ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Retrieves the list of bookmarks.
 *
 * Attempts to retrieve from the cache first based on MD5 hash of arguments. If
 * that fails, then the query will be built from the arguments and executed. The
 * results will be stored to the cache.
 *
 * @since WP 2.1.0
 * @deprecated 1.0.0 Retraceur removed the Link manager feature.
 *
 * @param string|array $args {
 *     Optional. String or array of arguments to retrieve bookmarks.
 *
 *     @type string   $orderby        How to order the links by. Accepts 'id', 'link_id', 'name', 'link_name',
 *                                    'url', 'link_url', 'visible', 'link_visible', 'rating', 'link_rating',
 *                                    'owner', 'link_owner', 'updated', 'link_updated', 'notes', 'link_notes',
 *                                    'description', 'link_description', 'length' and 'rand'.
 *                                    When `$orderby` is 'length', orders by the character length of
 *                                    'link_name'. Default 'name'.
 *     @type string   $order          Whether to order bookmarks in ascending or descending order.
 *                                    Accepts 'ASC' (ascending) or 'DESC' (descending). Default 'ASC'.
 *     @type int      $limit          Amount of bookmarks to display. Accepts any positive number or
 *                                    -1 for all.  Default -1.
 *     @type string   $category       Comma-separated list of category IDs to include links from.
 *                                    Default empty.
 *     @type string   $category_name  Category to retrieve links for by name. Default empty.
 *     @type int|bool $hide_invisible Whether to show or hide links marked as 'invisible'. Accepts
 *                                    1|true or 0|false. Default 1|true.
 *     @type int|bool $show_updated   Whether to display the time the bookmark was last updated.
 *                                    Accepts 1|true or 0|false. Default 0|false.
 *     @type string   $include        Comma-separated list of bookmark IDs to include. Default empty.
 *     @type string   $exclude        Comma-separated list of bookmark IDs to exclude. Default empty.
 *     @type string   $search         Search terms. Will be SQL-formatted with wildcards before and after
 *                                    and searched in 'link_url', 'link_name' and 'link_description'.
 *                                    Default empty.
 * }
 */
function get_bookmarks( $args = '' ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the returned list of bookmarks.
	 *
	 * The first time the hook is evaluated in this file, it returns the cached
	 * bookmarks list. The second evaluation returns a cached bookmarks list if the
	 * link category is passed but does not exist. The third evaluation returns
	 * the full cached results.
	 *
	 * @since WP 2.1.0
	 * @deprecated 1.0.0 Retraceur removed the Link manager feature.
	 *
	 * @see get_bookmarks()
	 *
	 * @param array $bookmarks   List of the cached bookmarks.
	 * @param array $parsed_args An array of bookmark query arguments.
	 */
	apply_filters_deprecated(
		'get_bookmarks',
		array( array(), array() ),
		'1.0.0',
		'',
		__( 'Link/bookmark manager is not supported in Retraceur.' )
	);
}

/**
 * Sanitizes all bookmark fields.
 *
 * @since WP 2.3.0
 * @deprecated 1.0.0 Retraceur removed the Link manager feature.
 *
 * @param stdClass|array $bookmark Bookmark row.
 * @param string         $context  Optional. How to filter the fields. Default 'display'.
 */
function sanitize_bookmark( $bookmark, $context = 'display' ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Sanitizes a bookmark field.
 *
 * Sanitizes the bookmark fields based on what the field name is. If the field
 * has a strict value set, then it will be tested for that, else a more generic
 * filtering is applied. After the more strict filter is applied, if the `$context`
 * is 'raw' then the value is immediately return.
 *
 * Hooks exist for the more generic cases. With the 'edit' context, the {@see 'edit_$field'}
 * filter will be called and passed the `$value` and `$bookmark_id` respectively.
 *
 * With the 'db' context, the {@see 'pre_$field'} filter is called and passed the value.
 * The 'display' context is the final context and has the `$field` has the filter name
 * and is passed the `$value`, `$bookmark_id`, and `$context`, respectively.
 *
 * @since WP 2.3.0
 * @deprecated 1.0.0 Retraceur removed the Link manager feature.
 *
 * @param string $field       The bookmark field.
 * @param mixed  $value       The bookmark field value.
 * @param int    $bookmark_id Bookmark ID.
 * @param string $context     How to filter the field value. Accepts 'raw', 'edit', 'db',
 *                            'display', 'attribute', or 'js'. Default 'display'.
 */
function sanitize_bookmark_field( $field, $value, $bookmark_id, $context ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Deletes the bookmark cache.
 *
 * @since WP 2.7.0
 * @deprecated 1.0.0 Retraceur removed the Link manager feature.
 *
 * @param int $bookmark_id Bookmark ID.
 */
function clean_bookmark_cache( $bookmark_id ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * The formatted output of a list of bookmarks.
 *
 * The $bookmarks array must contain bookmark objects and will be iterated over
 * to retrieve the bookmark to be used in the output.
 *
 * The output is formatted as HTML with no way to change that format. However,
 * what is between, before, and after can be changed. The link itself will be
 * HTML.
 *
 * This function is used internally by wp_list_bookmarks() and should not be
 * used by themes.
 *
 * @since WP 2.1.0
 * @deprecated 1.0.0 Retraceur removed the Link manager feature.
 *
 * @access private
 *
 * @param array        $bookmarks List of bookmarks to traverse.
 * @param string|array $args {
 *     Optional. Bookmarks arguments.
 *
 *     @type int|bool $show_updated     Whether to show the time the bookmark was last updated.
 *                                      Accepts 1|true or 0|false. Default 0|false.
 *     @type int|bool $show_description Whether to show the bookmark description. Accepts 1|true,
 *                                      Accepts 1|true or 0|false. Default 0|false.
 *     @type int|bool $show_images      Whether to show the link image if available. Accepts 1|true
 *                                      or 0|false. Default 1|true.
 *     @type int|bool $show_name        Whether to show link name if available. Accepts 1|true or
 *                                      0|false. Default 0|false.
 *     @type string   $before           The HTML or text to prepend to each bookmark. Default `<li>`.
 *     @type string   $after            The HTML or text to append to each bookmark. Default `</li>`.
 *     @type string   $link_before      The HTML or text to prepend to each bookmark inside the anchor
 *                                      tags. Default empty.
 *     @type string   $link_after       The HTML or text to append to each bookmark inside the anchor
 *                                      tags. Default empty.
 *     @type string   $between          The string for use in between the link, description, and image.
 *                                      Default "\n".
 *     @type int|bool $show_rating      Whether to show the link rating. Accepts 1|true or 0|false.
 *                                      Default 0|false.
 *
 * }
 */
function _walk_bookmarks( $bookmarks, $args = '' ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Retrieves or echoes all of the bookmarks.
 *
 * List of default arguments are as follows:
 *
 * These options define how the Category name will appear before the category
 * links are displayed, if 'categorize' is 1. If 'categorize' is 0, then it will
 * display for only the 'title_li' string and only if 'title_li' is not empty.
 *
 * @since WP 2.1.0
 * @deprecated 1.0.0 Retraceur removed the Link manager feature.
 *
 * @see _walk_bookmarks()
 *
 * @param string|array $args {
 *     Optional. String or array of arguments to list bookmarks.
 *
 *     @type string       $orderby          How to order the links by. Accepts post fields. Default 'name'.
 *     @type string       $order            Whether to order bookmarks in ascending or descending order.
 *                                          Accepts 'ASC' (ascending) or 'DESC' (descending). Default 'ASC'.
 *     @type int          $limit            Amount of bookmarks to display. Accepts 1+ or -1 for all.
 *                                          Default -1.
 *     @type string       $category         Comma-separated list of category IDs to include links from.
 *                                          Default empty.
 *     @type string       $category_name    Category to retrieve links for by name. Default empty.
 *     @type int|bool     $hide_invisible   Whether to show or hide links marked as 'invisible'. Accepts
 *                                          1|true or 0|false. Default 1|true.
 *     @type int|bool     $show_updated     Whether to display the time the bookmark was last updated.
 *                                          Accepts 1|true or 0|false. Default 0|false.
 *     @type int|bool     $echo             Whether to echo or return the formatted bookmarks. Accepts
 *                                          1|true (echo) or 0|false (return). Default 1|true.
 *     @type int|bool     $categorize       Whether to show links listed by category or in a single column.
 *                                          Accepts 1|true (by category) or 0|false (one column). Default 1|true.
 *     @type int|bool     $show_description Whether to show the bookmark descriptions. Accepts 1|true or 0|false.
 *                                          Default 0|false.
 *     @type string       $title_li         What to show before the links appear. Default 'Bookmarks'.
 *     @type string       $title_before     The HTML or text to prepend to the $title_li string. Default '<h2>'.
 *     @type string       $title_after      The HTML or text to append to the $title_li string. Default '</h2>'.
 *     @type string|array $class            The CSS class or an array of classes to use for the $title_li.
 *                                          Default 'linkcat'.
 *     @type string       $category_before  The HTML or text to prepend to $title_before if $categorize is true.
 *                                          String must contain '%id' and '%class' to inherit the category ID and
 *                                          the $class argument used for formatting in themes.
 *                                          Default '<li id="%id" class="%class">'.
 *     @type string       $category_after   The HTML or text to append to $title_after if $categorize is true.
 *                                          Default '</li>'.
 *     @type string       $category_orderby How to order the bookmark category based on term scheme if $categorize
 *                                          is true. Default 'name'.
 *     @type string       $category_order   Whether to order categories in ascending or descending order if
 *                                          $categorize is true. Accepts 'ASC' (ascending) or 'DESC' (descending).
 *                                          Default 'ASC'.
 * }
 * @return void|string Void if 'echo' argument is true, HTML list of bookmarks if 'echo' is false.
 */
function wp_list_bookmarks( $args = '' ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the bookmarks list before it is echoed or returned.
	 *
	 * @since WP 2.5.0
	 * @deprecated 1.0.0 Retraceur removed the Link manager feature.
	 *
	 * @param string $html The HTML list of bookmarks.
	 */
	apply_filters_deprecated(
		'wp_list_bookmarks',
		array( '' ),
		'1.0.0',
		'',
		__( 'Link/bookmark manager is not supported in Retraceur.' )
	);
}

/**
 * Displays the edit bookmark link.
 *
 * @since WP 2.7.0
 * @deprecated 1.0.0 Retraceur removed the Link manager feature.
 *
 * @param int|stdClass $link Optional. Bookmark ID. Default is the ID of the current bookmark.
 */
function get_edit_bookmark_link( $link = 0 ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the bookmark edit link.
	 *
	 * @since WP 2.7.0
	 * @deprecated 1.0.0 Retraceur removed the Link manager feature.
	 *
	 * @param string $location The edit link.
	 * @param int    $link_id  Bookmark ID.
	 */
	apply_filters_deprecated(
		'get_edit_bookmark_link',
		array( '', 0 ),
		'1.0.0',
		'',
		__( 'Link/bookmark manager is not supported in Retraceur.' )
	);
}

/**
 * Displays the edit bookmark link anchor content.
 *
 * @since WP 2.7.0
 * @deprecated 1.0.0 Retraceur removed the Link manager feature.
 *
 * @param string $link     Optional. Anchor text. If empty, default is 'Edit This'. Default empty.
 * @param string $before   Optional. Display before edit link. Default empty.
 * @param string $after    Optional. Display after edit link. Default empty.
 * @param int    $bookmark Optional. Bookmark ID. Default is the current bookmark.
 */
function edit_bookmark_link( $link = '', $before = '', $after = '', $bookmark = null ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the bookmark edit link anchor tag.
	 *
	 * @since WP 2.7.0
	 * @deprecated 1.0.0 Retraceur removed the Link manager feature.
	 *
	 * @param string $link    Anchor tag for the edit link.
	 * @param int    $link_id Bookmark ID.
	 */
	apply_filters_deprecated(
		'edit_bookmark_link',
		array( '', 0 ),
		'1.0.0',
		'',
		__( 'Link/bookmark manager is not supported in Retraceur.' )
	);
}

/**
 * Register the default font collections.
 *
 * @access private
 * @since WP 6.5.0
 * @deprecated 1.0.0 Retraceur removed the default font collection.
 */
function _wp_register_default_font_collections() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Kills WordPress execution and displays XML response with an error message.
 *
 * This is the handler for wp_die() when processing XMLRPC requests.
 *
 * @since WP 3.2.0
 * @deprecated 1.0.0 Retraceur removed the XML-RPC API.
 *
 * @access private
 *
 * @param string       $message Error message.
 * @param string       $title   Optional. Error title. Default empty string.
 * @param string|array $args    Optional. Arguments to control behavior. Default empty array.
 */
function _xmlrpc_wp_die_handler( $message, $title = '', $args = array() ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Retrieves post title from XMLRPC XML.
 *
 * If the title element is not part of the XML, then the default post title from
 * the $post_default_title will be used instead.
 *
 * @since WP 0.71
 * @deprecated 1.0.0 Retraceur removed the XML-RPC API.
 *
 * @global string $post_default_title Default XML-RPC post title.
 *
 * @param string $content XMLRPC XML Request content
 * @return string Post title
 */
function xmlrpc_getposttitle( $content ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Retrieves the post category or categories from XMLRPC XML.
 *
 * If the category element is not found, then the default post category will be
 * used. The return type then would be what $post_default_category. If the
 * category is found, then it will always be an array.
 *
 * @since WP 0.71
 * @deprecated 1.0.0 Retraceur removed the XML-RPC API.
 *
 * @global string $post_default_category Default XML-RPC post category.
 *
 * @param string $content XMLRPC XML Request content
 * @return string|array List of categories or category name.
 */
function xmlrpc_getpostcategory( $content ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * XMLRPC XML content without title and category elements.
 *
 * @since WP 0.71
 * @deprecated 1.0.0 Retraceur removed the XML-RPC API.
 *
 * @param string $content XML-RPC XML Request content.
 * @return string XMLRPC XML Request content without title and category elements.
 */
function xmlrpc_removepostdata( $content ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Displays the link to the Really Simple Discovery service endpoint.
 *
 * @link http://archipelago.phrasewise.com/rsd
 * @since WP 2.0.0
 * @deprecated 1.0.0 Retraceur removed the XML-RPC API.
 */
function rsd_link() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Updates the comment type for a batch of comments.
 *
 * @since WP 5.5.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function _wp_batch_update_comment_type() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * In order to avoid the _wp_batch_update_comment_type() job being accidentally removed,
 * check that it's still scheduled while we haven't finished updating comment types.
 *
 * @ignore
 * @since WP 5.5.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function _wp_check_for_scheduled_update_comment_type() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * If the term being split is a nav_menu, changes associations.
 *
 * @ignore
 * @since WP 4.3.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int    $term_id          ID of the formerly shared term.
 * @param int    $new_term_id      ID of the new term created for the $term_taxonomy_id.
 * @param int    $term_taxonomy_id ID for the term_taxonomy row affected by the split.
 * @param string $taxonomy         Taxonomy for the split term.
 */
function _wp_check_split_nav_menu_terms( $term_id, $new_term_id, $term_taxonomy_id, $taxonomy ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Prevents a menu item ID from being used more than once.
 *
 * @since WP 3.0.1
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @access private
 *
 * @param string $id
 * @param object $item
 */
function _nav_menu_item_id_use_once( $id, $item ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Remove the `menu-item-has-children` class from bottom level menu items.
 *
 * This runs on the {@see 'nav_menu_css_class'} filter. The $args and $depth
 * parameters were added after the filter was originally introduced in
 * WordPress 3.0.0 so this needs to allow for cases in which the filter is
 * called without them.
 *
 * @since WP 6.2.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string[]       $classes   Array of the CSS classes that are applied to the menu item's `<li>` element.
 * @param WP_Post        $menu_item The current menu item object.
 * @param stdClass|false $args      An object of wp_nav_menu() arguments. Default false ($args unspecified when filter is called).
 * @param int|false      $depth     Depth of menu item. Default false ($depth unspecified when filter is called).
 */
function wp_nav_menu_remove_menu_item_has_children_class( $classes, $menu_item, $args = false, $depth = false ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Displays a navigation menu.
 *
 * @since WP 3.0.0
 * @since WP 4.7.0 Added the `item_spacing` argument.
 * @since WP 5.5.0 Added the `container_aria_label` argument.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param array $args {
 *     Optional. Array of nav menu arguments.
 *
 *     @type int|string|WP_Term $menu                 Desired menu. Accepts a menu ID, slug, name, or object.
 *                                                    Default empty.
 *     @type string             $menu_class           CSS class to use for the ul element which forms the menu.
 *                                                    Default 'menu'.
 *     @type string             $menu_id              The ID that is applied to the ul element which forms the menu.
 *                                                    Default is the menu slug, incremented.
 *     @type string             $container            Whether to wrap the ul, and what to wrap it with.
 *                                                    Default 'div'.
 *     @type string             $container_class      Class that is applied to the container.
 *                                                    Default 'menu-{menu slug}-container'.
 *     @type string             $container_id         The ID that is applied to the container. Default empty.
 *     @type string             $container_aria_label The aria-label attribute that is applied to the container
 *                                                    when it's a nav element. Default empty.
 *     @type callable|false     $fallback_cb          If the menu doesn't exist, a callback function will fire.
 *                                                    Default is 'wp_page_menu'. Set to false for no fallback.
 *     @type string             $before               Text before the link markup. Default empty.
 *     @type string             $after                Text after the link markup. Default empty.
 *     @type string             $link_before          Text before the link text. Default empty.
 *     @type string             $link_after           Text after the link text. Default empty.
 *     @type bool               $echo                 Whether to echo the menu or return it. Default true.
 *     @type int                $depth                How many levels of the hierarchy are to be included.
 *                                                    0 means all. Default 0.
 *                                                    Default 0.
 *     @type object             $walker               Instance of a custom walker class. Default empty.
 *     @type string             $theme_location       Theme location to be used. Must be registered with
 *                                                    register_nav_menu() in order to be selectable by the user.
 *     @type string             $items_wrap           How the list items should be wrapped. Uses printf() format with
 *                                                    numbered placeholders. Default is a ul with an id and class.
 *     @type string             $item_spacing         Whether to preserve whitespace within the menu's HTML.
 *                                                    Accepts 'preserve' or 'discard'. Default 'preserve'.
 * }
 */
function wp_nav_menu( $args = array() ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the arguments used to display a navigation menu.
	 *
	 * @since WP 3.0.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @see wp_nav_menu()
	 *
	 * @param array $args Array of wp_nav_menu() arguments.
	 */
	apply_filters_deprecated(
		'wp_nav_menu_args',
		array( array() ),
		'1.0.0',
		'',
		__( 'WP Nav Menus feature is not supported in Retraceur.' )
	);

	/**
	 * Filters whether to short-circuit the wp_nav_menu() output.
	 *
	 * Returning a non-null value from the filter will short-circuit wp_nav_menu(),
	 * echoing that value if $args->echo is true, returning that value otherwise.
	 *
	 * @since WP 3.9.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @see wp_nav_menu()
	 *
	 * @param string|null $output Nav menu output to short-circuit with. Default null.
	 * @param stdClass    $args   An object containing wp_nav_menu() arguments.
	 */
	apply_filters_deprecated(
		'pre_wp_nav_menu',
		array( null, null ),
		'1.0.0',
		'',
		__( 'WP Nav Menus feature is not supported in Retraceur.' )
	);

	/**
	 * Filters the list of HTML tags that are valid for use as menu containers.
	 *
	 * @since WP 3.0.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string[] $tags The acceptable HTML tags for use as menu containers.
	 *                       Default is array containing 'div' and 'nav'.
	 */
	apply_filters_deprecated(
		'wp_nav_menu_container_allowedtags',
		array( array( 'div', 'nav' ) ),
		'1.0.0',
		'',
		__( 'WP Nav Menus feature is not supported in Retraceur.' )
	);

	/**
	 * Filters the sorted list of menu item objects before generating the menu's HTML.
	 *
	 * @since WP 3.1.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param array    $sorted_menu_items The menu items, sorted by each menu item's menu order.
	 * @param stdClass $args              An object containing wp_nav_menu() arguments.
	 */
	apply_filters_deprecated(
		'wp_nav_menu_objects',
		array( array(), null ),
		'1.0.0',
		'',
		__( 'WP Nav Menus feature is not supported in Retraceur.' )
	);

	/**
	 * Filters the HTML list content for navigation menus.
	 *
	 * @since WP 3.0.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @see wp_nav_menu()
	 *
	 * @param string   $items The HTML list content for the menu items.
	 * @param stdClass $args  An object containing wp_nav_menu() arguments.
	 */
	apply_filters_deprecated(
		'wp_nav_menu_items',
		array( array(), null ),
		'1.0.0',
		'',
		__( 'WP Nav Menus feature is not supported in Retraceur.' )
	);

	/**
	 * Filters the HTML content for navigation menus.
	 *
	 * @since WP 3.0.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @see wp_nav_menu()
	 *
	 * @param string   $nav_menu The HTML content for the navigation menu.
	 * @param stdClass $args     An object containing wp_nav_menu() arguments.
	 */
	apply_filters_deprecated(
		'wp_nav_menu',
		array( '', null ),
		'1.0.0',
		'',
		__( 'WP Nav Menus feature is not supported in Retraceur.' )
	);
}

/**
 * Converts a classic navigation to blocks.
 *
 * @since WP 6.2.0
 * @deprecated WP 6.3.0 Use WP_Navigation_Fallback::get_classic_menu_fallback_blocks() instead.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param  object $classic_nav_menu WP_Term The classic navigation object to convert.
 * @return array the normalized parsed blocks.
 */
function block_core_navigation_get_classic_menu_fallback_blocks( $classic_nav_menu ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return array();
}

/**
 * Turns menu item data into a nested array of parsed blocks
 *
 * @since WP 5.9.0
 * @deprecated WP 6.3.0 Use WP_Navigation_Fallback::parse_blocks_from_menu_items() instead.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param array $menu_items               An array of menu items that represent
 *                                        an individual level of a menu.
 * @param array $menu_items_by_parent_id  An array keyed by the id of the
 *                                        parent menu where each element is an
 *                                        array of menu items that belong to
 *                                        that parent.
 * @return array An array of parsed block data.
 */
function block_core_navigation_parse_blocks_from_menu_items( $menu_items, $menu_items_by_parent_id ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return array();
}

/**
 * Get the classic navigation menu to use as a fallback.
 *
 * @since WP 6.2.0
 * @deprecated WP 6.3.0 Use WP_Navigation_Fallback::get_classic_menu_fallback() instead.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @return object WP_Term The classic navigation.
 */
function block_core_navigation_get_classic_menu_fallback() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return null;
}

/**
 * If there's a classic menu then use it as a fallback.
 *
 * @since WP 6.2.0
 * @deprecated WP 6.3.0 Use WP_Navigation_Fallback::create_classic_menu_fallback() instead.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @return array the normalized parsed blocks.
 */
function block_core_navigation_maybe_use_classic_menu_fallback() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return array();
}

/**
 * Finds the most recently published `wp_navigation` Post.
 *
 * @since WP 6.1.0
 * @deprecated WP 6.3.0 Use WP_Navigation_Fallback::get_most_recently_published_navigation() instead.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @return WP_Post|null the first non-empty Navigation or null.
 */
function block_core_navigation_get_most_recently_published_navigation() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return null;
}

/**
 * Adds the class property classes for the current context, if applicable.
 *
 * @access private
 * @since WP 3.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param array $menu_items The current menu item objects to which to add the class property information.
 */
function _wp_menu_item_classes_by_context( $menu_items ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Retrieves the HTML list content for nav menu items.
 *
 * @uses Walker_Nav_Menu to create HTML list content.
 * @since WP 3.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param array    $items The menu items, sorted by each menu item's menu order.
 * @param int      $depth Depth of the item in reference to parents.
 * @param stdClass $args  An object containing wp_nav_menu() arguments.
 * @return string The HTML list content for the menu items.
 */
function walk_nav_menu_tree( $items, $depth, $args ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return '';
}

/**
 * Returns a navigation menu object.
 *
 * @since WP 3.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int|string|WP_Term $menu Menu ID, slug, name, or object.
 * @return WP_Term|false Menu object on success, false if $menu param isn't supplied or term does not exist.
 */
function wp_get_nav_menu_object( $menu ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the nav_menu term retrieved for wp_get_nav_menu_object().
	 *
	 * @since WP 4.3.0
	 *
	 * @param WP_Term|false      $menu_obj Term from nav_menu taxonomy, or false if nothing had been found.
	 * @param int|string|WP_Term $menu     The menu ID, slug, name, or object passed to wp_get_nav_menu_object().
	 */
	apply_filters_deprecated(
		'wp_get_nav_menu_object',
		array( false, 0 ),
		'1.0.0',
		'',
		__( 'WP Nav Menus feature is not supported in Retraceur.' )
	);

	return false;
}

/**
 * Determines whether the given ID is a navigation menu.
 *
 * Returns true if it is; false otherwise.
 *
 * @since WP 3.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int|string|WP_Term $menu Menu ID, slug, name, or object of menu to check.
 * @return bool Whether the menu exists.
 */
function is_nav_menu( $menu ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return false;
}

/**
 * Registers navigation menu locations for a theme.
 *
 * @since WP 3.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string[] $locations Associative array of menu location identifiers (like a slug) and descriptive text.
 */
function register_nav_menus( $locations = array() ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Unregisters a navigation menu location for a theme.
 *
 * @since WP 3.1.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string $location The menu location identifier.
 * @return bool True on success, false on failure.
 */
function unregister_nav_menu( $location ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return false;
}

/**
 * Registers a navigation menu location for a theme.
 *
 * @since WP 3.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string $location    Menu location identifier, like a slug.
 * @param string $description Menu location descriptive text.
 */
function register_nav_menu( $location, $description ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}
/**
 * Retrieves all registered navigation menu locations in a theme.
 *
 * @since WP 3.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @return string[] Associative array of registered navigation menu descriptions keyed
 *                  by their location. If none are registered, an empty array.
 */
function get_registered_nav_menus() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return array();
}

/**
 * Retrieves all registered navigation menu locations and the menus assigned to them.
 *
 * @since WP 3.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @return int[] Associative array of registered navigation menu IDs keyed by their
 *               location name. If none are registered, an empty array.
 */
function get_nav_menu_locations() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return array();
}

/**
 * Determines whether a registered nav menu location has a menu assigned to it.
 *
 * @since WP 3.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string $location Menu location identifier.
 * @return bool Whether location has a menu.
 */
function has_nav_menu( $location ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters whether a nav menu is assigned to the specified location.
	 *
	 * @since WP 4.3.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param bool   $has_nav_menu Whether there is a menu assigned to a location.
	 * @param string $location     Menu location.
	 */
	apply_filters_deprecated(
		'has_nav_menu',
		array( false, '' ),
		'1.0.0',
		'',
		__( 'WP Nav Menus feature is not supported in Retraceur.' )
	);

	return false;
}

/**
 * Returns the name of a navigation menu.
 *
 * @since WP 4.9.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string $location Menu location identifier.
 * @return string Menu name.
 */
function wp_get_nav_menu_name( $location ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the navigation menu name being returned.
	 *
	 * @since WP 4.9.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string $menu_name Menu name.
	 * @param string $location  Menu location identifier.
	 */
	apply_filters_deprecated(
		'wp_get_nav_menu_name',
		array( '', '' ),
		'1.0.0',
		'',
		__( 'WP Nav Menus feature is not supported in Retraceur.' )
	);

	return '';
}

/**
 * Determines whether the given ID is a nav menu item.
 *
 * @since WP 3.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int $menu_item_id The ID of the potential nav menu item.
 * @return bool Whether the given ID is that of a nav menu item.
 */
function is_nav_menu_item( $menu_item_id = 0 ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return false;
}

/**
 * Creates a navigation menu.
 *
 * Note that `$menu_name` is expected to be pre-slashed.
 *
 * @since WP 3.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string $menu_name Menu name.
 * @return int|WP_Error Menu ID on success, WP_Error object on failure.
 */
function wp_create_nav_menu( $menu_name ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return 0;
}

/**
 * Deletes a navigation menu.
 *
 * @since WP 3.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int|string|WP_Term $menu Menu ID, slug, name, or object.
 * @return bool|WP_Error True on success, false or WP_Error object on failure.
 */
function wp_delete_nav_menu( $menu ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Fires after a navigation menu has been successfully deleted.
	 *
	 * @since WP 3.0.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param int $term_id ID of the deleted menu.
	 */
	do_action_deprecated(
		'wp_delete_nav_menu',
		array( 0 ),
		'1.0.0',
		'',
		__( 'WP Nav Menus feature is not supported in Retraceur.' )
	);

	return false;
}

/**
 * Saves the properties of a menu or create a new menu with those properties.
 *
 * Note that `$menu_data` is expected to be pre-slashed.
 *
 * @since WP 3.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int   $menu_id   The ID of the menu or "0" to create a new menu.
 * @param array $menu_data The array of menu data.
 * @return int|WP_Error Menu ID on success, WP_Error object on failure.
 */
function wp_update_nav_menu_object( $menu_id = 0, $menu_data = array() ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Fires after a navigation menu is successfully created.
	 *
	 * @since WP 3.0.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param int   $term_id   ID of the new menu.
	 * @param array $menu_data An array of menu data.
	 */
	do_action_deprecated(
		'wp_create_nav_menu',
		array( 0, array() ),
		'1.0.0',
		'',
		__( 'WP Nav Menus feature is not supported in Retraceur.' )
	);

	/**
	 * Fires after a navigation menu has been successfully updated.
	 *
	 * @since WP 3.0.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param int   $menu_id   ID of the updated menu.
	 * @param array $menu_data An array of menu data.
	 */
	do_action_deprecated(
		'wp_update_nav_menu',
		array( 0, array() ),
		'1.0.0',
		'',
		__( 'WP Nav Menus feature is not supported in Retraceur.' )
	);

	return 0;
}

/**
 * Saves the properties of a menu item or create a new one.
 *
 * The menu-item-title, menu-item-description and menu-item-attr-title are expected
 * to be pre-slashed since they are passed directly to APIs that expect slashed data.
 *
 * @since WP 3.0.0
 * @since WP 5.9.0 Added the `$fire_after_hooks` parameter.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int   $menu_id          The ID of the menu. If 0, makes the menu item a draft orphan.
 * @param int   $menu_item_db_id  The ID of the menu item. If 0, creates a new menu item.
 * @param array $menu_item_data   The menu item's data.
 * @param bool  $fire_after_hooks Whether to fire the after insert hooks. Default true.
 * @return int|WP_Error The menu item's database ID or WP_Error object on failure.
 */
function wp_update_nav_menu_item( $menu_id = 0, $menu_item_db_id = 0, $menu_item_data = array(), $fire_after_hooks = true ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Fires immediately after a new navigation menu item has been added.
	 *
	 * @since WP 4.4.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @see wp_update_nav_menu_item()
	 *
	 * @param int   $menu_id         ID of the updated menu.
	 * @param int   $menu_item_db_id ID of the new menu item.
	 * @param array $args            An array of arguments used to update/add the menu item.
	 */
	do_action_deprecated(
		'wp_add_nav_menu_item',
		array( 0, 0, array() ),
		'1.0.0',
		'',
		__( 'WP Nav Menus feature is not supported in Retraceur.' )
	);

	/**
	 * Fires after a navigation menu item has been updated.
	 *
	 * @since WP 3.0.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @see wp_update_nav_menu_item()
	 *
	 * @param int   $menu_id         ID of the updated menu.
	 * @param int   $menu_item_db_id ID of the updated menu item.
	 * @param array $args            An array of arguments used to update a menu item.
	 */
	do_action_deprecated(
		'wp_update_nav_menu_item',
		array( 0, 0, array() ),
		'1.0.0',
		'',
		__( 'WP Nav Menus feature is not supported in Retraceur.' )
	);

	return 0;
}

/**
 * Returns all navigation menu objects.
 *
 * @since WP 3.0.0
 * @since WP 4.1.0 Default value of the 'orderby' argument was changed from 'none'
 *              to 'name'.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param array $args Optional. Array of arguments passed on to get_terms().
 *                    Default empty array.
 * @return WP_Term[] An array of menu objects.
 */
function wp_get_nav_menus( $args = array() ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the navigation menu objects being returned.
	 *
	 * @since WP 3.0.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @see get_terms()
	 *
	 * @param WP_Term[] $menus An array of menu objects.
	 * @param array     $args  An array of arguments used to retrieve menu objects.
	 */
	apply_filters_deprecated(
		'wp_get_nav_menus',
		array( null, array() ),
		'1.0.0',
		'',
		__( 'WP Nav Menus feature is not supported in Retraceur.' )
	);
}

/**
 * Determines whether a menu item is valid.
 *
 * @since WP 3.2.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @access private
 *
 * @param object $item The menu item to check.
 * @return bool False if invalid, otherwise true.
 */
function _is_valid_nav_menu_item( $item ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return false;
}

/**
 * Retrieves all menu items of a navigation menu.
 *
 * Note: Most arguments passed to the `$args` parameter – save for 'output_key' – are
 * specifically for retrieving nav_menu_item posts from get_posts() and may only
 * indirectly affect the ultimate ordering and content of the resulting nav menu
 * items that get returned from this function.
 *
 * @since WP 3.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int|string|WP_Term $menu Menu ID, slug, name, or object.
 * @param array              $args {
 *     Optional. Arguments to pass to get_posts().
 *
 *     @type string $order                  How to order nav menu items as queried with get_posts().
 *                                          Will be ignored if 'output' is ARRAY_A. Default 'ASC'.
 *     @type string $orderby                Field to order menu items by as retrieved from get_posts().
 *                                          Supply an orderby field via 'output_key' to affect the
 *                                          output order of nav menu items. Default 'menu_order'.
 *     @type string $post_type              Menu items post type. Default 'nav_menu_item'.
 *     @type string $post_status            Menu items post status. Default 'publish'.
 *     @type string $output                 How to order outputted menu items. Default ARRAY_A.
 *     @type string $output_key             Key to use for ordering the actual menu items that get
 *                                          returned. Note that that is not a get_posts() argument
 *                                          and will only affect output of menu items processed in
 *                                          this function. Default 'menu_order'.
 *     @type bool   $nopaging               Whether to retrieve all menu items (true) or paginate
 *                                          (false). Default true.
 *     @type bool   $update_menu_item_cache Whether to update the menu item cache. Default true.
 * }
 * @return array|false Array of menu items, otherwise false.
 */
function wp_get_nav_menu_items( $menu, $args = array() ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the navigation menu items being returned.
	 *
	 * @since WP 3.0.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param array  $items An array of menu item post objects.
	 * @param object $menu  The menu object.
	 * @param array  $args  An array of arguments used to retrieve menu item objects.
	 */
	apply_filters_deprecated(
		'wp_get_nav_menu_items',
		array( array(), null, array() ),
		'1.0.0',
		'',
		__( 'WP Nav Menus feature is not supported in Retraceur.' )
	);

	return false;
}

/**
 * Updates post and term caches for all linked objects for a list of menu items.
 *
 * @since WP 6.1.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param WP_Post[] $menu_items Array of menu item post objects.
 */
function update_menu_item_cache( $menu_items ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Decorates a menu item object with the shared navigation menu item properties.
 *
 * Properties:
 * - ID:               The term_id if the menu item represents a taxonomy term.
 * - attr_title:       The title attribute of the link element for this menu item.
 * - classes:          The array of class attribute values for the link element of this menu item.
 * - db_id:            The DB ID of this item as a nav_menu_item object, if it exists (0 if it doesn't exist).
 * - description:      The description of this menu item.
 * - menu_item_parent: The DB ID of the nav_menu_item that is this item's menu parent, if any. 0 otherwise.
 * - object:           The type of object originally represented, such as 'category', 'post', or 'attachment'.
 * - object_id:        The DB ID of the original object this menu item represents, e.g. ID for posts and term_id for categories.
 * - post_parent:      The DB ID of the original object's parent object, if any (0 otherwise).
 * - post_title:       A "no title" label if menu item represents a post that lacks a title.
 * - target:           The target attribute of the link element for this menu item.
 * - title:            The title of this menu item.
 * - type:             The family of objects originally represented, such as 'post_type' or 'taxonomy'.
 * - type_label:       The singular label used to describe this type of menu item.
 * - url:              The URL to which this menu item points.
 * - xfn:              The XFN relationship expressed in the link of this menu item.
 * - _invalid:         Whether the menu item represents an object that no longer exists.
 *
 * @since WP 3.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param object $menu_item The menu item to modify.
 * @return object The menu item with standard menu item properties.
 */
function wp_setup_nav_menu_item( $menu_item ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters whether to short-circuit the wp_setup_nav_menu_item() output.
	 *
	 * Returning a non-null value from the filter will short-circuit wp_setup_nav_menu_item(),
	 * returning that value instead.
	 *
	 * @since WP 6.3.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param object|null $modified_menu_item Modified menu item. Default null.
	 * @param object      $menu_item          The menu item to modify.
	 */
	apply_filters_deprecated(
		'pre_wp_setup_nav_menu_item',
		array( null, $menu_item ),
		'1.0.0',
		'',
		__( 'WP Nav Menus feature is not supported in Retraceur.' )
	);

	/**
	 * Filters a navigation menu item's title attribute.
	 *
	 * @since WP 3.0.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string $item_title The menu item title attribute.
	 */
	apply_filters_deprecated(
		'nav_menu_attr_title',
		array( '' ),
		'1.0.0',
		'',
		__( 'WP Nav Menus feature is not supported in Retraceur.' )
	);

	/**
	 * Filters a navigation menu item's description.
	 *
	 * @since WP 3.0.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string $description The menu item description.
	 */
	apply_filters_deprecated(
		'nav_menu_description',
		array( '' ),
		'1.0.0',
		'',
		__( 'WP Nav Menus feature is not supported in Retraceur.' )
	);

	/**
	 * Filters a navigation menu item object.
	 *
	 * @since WP 3.0.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param object $menu_item The menu item object.
	 */
	apply_filters_deprecated(
		'wp_setup_nav_menu_item',
		array( $menu_item ),
		'1.0.0',
		'',
		__( 'WP Nav Menus feature is not supported in Retraceur.' )
	);

	return null;
}

/**
 * Returns the menu items associated with a particular object.
 *
 * @since WP 3.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int    $object_id   Optional. The ID of the original object. Default 0.
 * @param string $object_type Optional. The type of object, such as 'post_type' or 'taxonomy'.
 *                            Default 'post_type'.
 * @param string $taxonomy    Optional. If $object_type is 'taxonomy', $taxonomy is the name
 *                            of the tax that $object_id belongs to. Default empty.
 * @return int[] The array of menu item IDs; empty array if none.
 */
function wp_get_associated_nav_menu_items( $object_id = 0, $object_type = 'post_type', $taxonomy = '' ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return array();
}

/**
 * Callback for handling a menu item when its original object is deleted.
 *
 * @since WP 3.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @access private
 *
 * @param int $object_id The ID of the original object being trashed.
 */
function _wp_delete_post_menu_item( $object_id ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Serves as a callback for handling a menu item when its original object is deleted.
 *
 * @since WP 3.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @access private
 *
 * @param int    $object_id The ID of the original object being trashed.
 * @param int    $tt_id     Term taxonomy ID. Unused.
 * @param string $taxonomy  Taxonomy slug.
 */
function _wp_delete_tax_menu_item( $object_id, $tt_id, $taxonomy ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Automatically add newly published page objects to menus with that as an option.
 *
 * @since WP 3.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @access private
 *
 * @param string  $new_status The new status of the post object.
 * @param string  $old_status The old status of the post object.
 * @param WP_Post $post       The post object being transitioned from one status to another.
 */
function _wp_auto_add_pages_to_menu( $new_status, $old_status, $post ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Handles menu config after theme change.
 *
 * @since WP 4.9.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @access private
 */
function _wp_menus_changed() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Maps nav menu locations according to assignments in previously active theme.
 *
 * @since WP 4.9.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param array $new_nav_menu_locations New nav menu locations assignments.
 * @param array $old_nav_menu_locations Old nav menu locations assignments.
 * @return array Nav menus mapped to new nav menu locations.
 */
function wp_map_nav_menu_locations( $new_nav_menu_locations, $old_nav_menu_locations ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return array();
}

/**
 * Prevents menu items from being their own parent.
 *
 * Resets menu_item_parent to 0 when the parent is set to the item itself.
 * For use before saving `_menu_item_menu_item_parent` in nav-menus.php.
 *
 * @since WP 6.2.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @access private
 *
 * @param array $menu_item_data The menu item data array.
 * @return array The menu item data with reset menu_item_parent.
 */
function _wp_reset_invalid_menu_item_parent( $menu_item_data ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return array();
}

/**
 * Get the post title.
 *
 * The post title is fetched and if it is blank then a default string is
 * returned.
 *
 * Copied from `wp-admin/includes/template.php`, but we can't include that
 * file because:
 *
 * 1. It causes bugs with test fixture generation and strange Docker 255 error
 *    codes.
 * 2. It's in the admin; ideally we *shouldn't* be including files from the
 *    admin for a block's output. It's a very small/simple function as well,
 *    so duplicating it isn't too terrible.
 *
 * @since WP 3.3.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int|WP_Post $post Optional. Post ID or WP_Post object. Default is global $post.
 * @return string The post title if set; "(no title)" if no title is set.
 */
function wp_latest_comments_draft_or_post_title( $post = 0 ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return '';
}

/**
 * Renders the `core/latest-comments` block on server.
 *
 * @since WP 5.1.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param array $attributes The block attributes.
 *
 * @return string Returns the post content with latest comments added.
 */
function render_block_core_latest_comments( $attributes = array() ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return '';
}

/**
 * Registers the `core/latest-comments` block.
 *
 * @since WP 5.3.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function register_block_core_latest_comments() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Renders the `core/comment-edit-link` block on the server.
 *
 * @since WP 6.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param array    $attributes Block attributes.
 * @param string   $content    Block default content.
 * @param WP_Block $block      Block instance.
 *
 * @return string Return the post comment's date.
 */
function render_block_core_comment_edit_link( $attributes, $content, $block ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Registers the `core/comment-edit-link` block on the server.
 *
 * @since WP 6.0.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function register_block_core_comment_edit_link() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Renders the `core/comment-date` block on the server.
 *
 * @since WP 6.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param array    $attributes Block attributes.
 * @param string   $content    Block default content.
 * @param WP_Block $block      Block instance.
 * @return string Return the post comment's date.
 */
function render_block_core_comment_date( $attributes, $content, $block ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return '';
}

/**
 * Registers the `core/comment-date` block on the server.
 *
 * @since WP 6.0.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function register_block_core_comment_date() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Adds edit comments link with awaiting moderation count bubble.
 *
 * @since WP 3.1.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param WP_Admin_Bar $wp_admin_bar The WP_Admin_Bar instance.
 */
function wp_admin_bar_comments_menu( $wp_admin_bar ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

if ( ! function_exists( 'wp_notify_postauthor' ) ) :
	/**
	 * Notifies an author (and/or others) of a comment/trackback/pingback on a post.
	 *
	 * @since WP 1.0.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param int|WP_Comment $comment_id Comment ID or WP_Comment object.
	 * @param string         $deprecated Not used.
	 * @return bool True on completion. False if no email addresses were specified.
	 */
	function wp_notify_postauthor( $comment_id, $deprecated = null ) {
		_deprecated_function( __FUNCTION__, '1.0.0', '', true );

		/**
		 * Filters the list of email addresses to receive a comment notification.
		 *
		 * By default, only post authors are notified of comments. This filter allows
		 * others to be added.
		 *
		 * @since WP 3.7.0
		 * @deprecated 1.0.0 Retraceur fork.
		 *
		 * @param string[] $emails     An array of email addresses to receive a comment notification.
		 * @param string   $comment_id The comment ID as a numeric string.
		 */
		apply_filters_deprecated(
			'comment_notification_recipients',
			array( array(), 0 ),
			'1.0.0',
			'',
			__( 'WP Comments feature is not supported in Retraceur.' )
		);

		/**
		 * Filters whether to notify comment authors of their comments on their own posts.
		 *
		 * By default, comment authors aren't notified of their comments on their own
		 * posts. This filter allows you to override that.
		 *
		 * @since WP 3.8.0
		 * @deprecated 1.0.0 Retraceur fork.
		 *
		 * @param bool   $notify     Whether to notify the post author of their own comment.
		 *                           Default false.
		 * @param string $comment_id The comment ID as a numeric string.
		 */
		apply_filters_deprecated(
			'comment_notification_notify_author',
			array( false, 0 ),
			'1.0.0',
			'',
			__( 'WP Comments feature is not supported in Retraceur.' )
		);

		/**
		 * Filters the comment notification email headers.
		 *
		 * @since WP 1.5.2
		 * @deprecated 1.0.0 Retraceur fork.
		 *
		 * @param string $message_headers Headers for the comment notification email.
		 * @param string $comment_id      Comment ID as a numeric string.
		 */
		apply_filters_deprecated(
			'comment_notification_headers',
			array( '', 0 ),
			'1.0.0',
			'',
			__( 'WP Comments feature is not supported in Retraceur.' )
		);

		/**
		 * Filters the comment notification email text.
		 *
		 * @since WP 1.5.2
		 * @deprecated 1.0.0 Retraceur fork.
		 *
		 * @param string $notify_message The comment notification email text.
		 * @param string $comment_id     Comment ID as a numeric string.
		 */
		apply_filters_deprecated(
			'comment_notification_text',
			array( '', 0 ),
			'1.0.0',
			'',
			__( 'WP Comments feature is not supported in Retraceur.' )
		);

		/**
		 * Filters the comment notification email subject.
		 *
		 * @since WP 1.5.2
		 * @deprecated 1.0.0 Retraceur fork.
		 *
		 * @param string $subject    The comment notification email subject.
		 * @param string $comment_id Comment ID as a numeric string.
		 */
		apply_filters_deprecated(
			'comment_notification_subject',
			array( '', 0 ),
			'1.0.0',
			'',
			__( 'WP Comments feature is not supported in Retraceur.' )
		);

		return false;
	}
endif;

if ( ! function_exists( 'wp_notify_moderator' ) ) :
	/**
	 * Notifies the moderator of the site about a new comment that is awaiting approval.
	 *
	 * @since WP 1.0.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * Uses the {@see 'notify_moderator'} filter to determine whether the site moderator
	 * should be notified, overriding the site setting.
	 *
	 * @param int $comment_id Comment ID.
	 * @return true Always returns true.
	 */
	function wp_notify_moderator( $comment_id ) {
		_deprecated_function( __FUNCTION__, '1.0.0', '', true );

		/**
		 * Filters whether to send the site moderator email notifications, overriding the site setting.
		 *
		 * @since WP 4.4.0
		 * @deprecated 1.0.0 Retraceur fork.
		 *
		 * @param bool $maybe_notify Whether to notify blog moderator.
		 * @param int  $comment_id   The ID of the comment for the notification.
		 */
		apply_filters_deprecated(
			'notify_moderator',
			array( false, 0 ),
			'1.0.0',
			'',
			__( 'WP Comments feature is not supported in Retraceur.' )
		);

		/**
		 * Filters the list of recipients for comment moderation emails.
		 *
		 * @since WP 3.7.0
		 * @deprecated 1.0.0 Retraceur fork.
		 *
		 * @param string[] $emails     List of email addresses to notify for comment moderation.
		 * @param int      $comment_id Comment ID.
		 */
		apply_filters_deprecated(
			'comment_moderation_recipients',
			array( array(), 0 ),
			'1.0.0',
			'',
			__( 'WP Comments feature is not supported in Retraceur.' )
		);

		/**
		 * Filters the comment moderation email headers.
		 *
		 * @since WP 2.8.0
		 * @deprecated 1.0.0 Retraceur fork.
		 *
		 * @param string $message_headers Headers for the comment moderation email.
		 * @param int    $comment_id      Comment ID.
		 */
		apply_filters_deprecated(
			'comment_moderation_headers',
			array( '', 0 ),
			'1.0.0',
			'',
			__( 'WP Comments feature is not supported in Retraceur.' )
		);

		/**
		 * Filters the comment moderation email text.
		 *
		 * @since WP 1.5.2
		 * @deprecated 1.0.0 Retraceur fork.
		 *
		 * @param string $notify_message Text of the comment moderation email.
		 * @param int    $comment_id     Comment ID.
		 */
		apply_filters_deprecated(
			'comment_moderation_text',
			array( '', 0 ),
			'1.0.0',
			'',
			__( 'WP Comments feature is not supported in Retraceur.' )
		);

		/**
		 * Filters the comment moderation email subject.
		 *
		 * @since WP 1.5.2
		 * @deprecated 1.0.0 Retraceur fork.
		 *
		 * @param string $subject    Subject of the comment moderation email.
		 * @param int    $comment_id Comment ID.
		 */
		apply_filters_deprecated(
			'comment_moderation_subject',
			array( '', 0 ),
			'1.0.0',
			'',
			__( 'WP Comments feature is not supported in Retraceur.' )
		);

		return true;
	}
endif;

/**
 * Retrieves the edit comment link.
 *
 * @since WP 2.3.0
 * @since WP 6.7.0 The $context parameter was added.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int|WP_Comment $comment_id Optional. Comment ID or WP_Comment object.
 * @param string         $context    Optional. Context in which the URL should be used. Either 'display',
 *                                   to include HTML entities, or 'url'. Default 'display'.
 * @return string|void The edit comment link URL for the given comment, or void if the comment id does not exist or
 *                     the current user is not allowed to edit it.
 */
function get_edit_comment_link( $comment_id = 0, $context = 'display' ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the comment edit link.
	 *
	 * @since WP 2.3.0
	 * @since WP 6.7.0 The $comment_id and $context parameters are now being passed to the filter.
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string $location   The edit link.
	 * @param int    $comment_id Unique ID of the comment to generate an edit link.
	 * @param string $context    Context to include HTML entities in link. Default 'display'.
	 */
	apply_filters_deprecated(
		'get_edit_comment_link',
		array( '', 0, '' ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return '';
}

/**
 * Displays the edit comment link with formatting.
 *
 * @since WP 1.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string $text   Optional. Anchor text. If null, default is 'Edit This'. Default null.
 * @param string $before Optional. Display before edit link. Default empty.
 * @param string $after  Optional. Display after edit link. Default empty.
 */
function edit_comment_link( $text = null, $before = '', $after = '' ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the comment edit link anchor tag.
	 *
	 * @since WP 2.3.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string $link       Anchor tag for the edit link.
	 * @param string $comment_id Comment ID as a numeric string.
	 * @param string $text       Anchor text.
	 */
	apply_filters_deprecated(
		'edit_comment_link',
		array( '', 0, '' ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);
}

/**
 * Sets the cookies used to store an unauthenticated commentator's identity. Typically used
 * to recall previous comments by this commentator that are still held in moderation.
 *
 * @since WP 3.4.0
 * @since WP 4.9.6 The `$cookies_consent` parameter was added.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param WP_Comment $comment         Comment object.
 * @param WP_User    $user            Comment author's user object. The user may not exist.
 * @param bool       $cookies_consent Optional. Comment author's consent to store cookies. Default true.
 */
function wp_set_comment_cookies( $comment, $user, $cookies_consent = true ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the lifetime of the comment cookie in seconds.
	 *
	 * @since WP 2.8.0
	 * @since WP 6.6.0 The default $seconds value changed from 30000000 to YEAR_IN_SECONDS.
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param int $seconds Comment cookie lifetime. Default YEAR_IN_SECONDS.
	 */
	apply_filters_deprecated(
		'comment_cookie_lifetime',
		array( 0 ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);
}

/**
 * Sanitizes the cookies sent to the user already.
 *
 * Will only do anything if the cookies have already been created for the user.
 * Mostly used after cookies had been sent to use elsewhere.
 *
 * @since WP 2.0.4
 * @deprecated 1.0.0 Retraceur fork.
 */
function sanitize_comment_cookies() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Prints the necessary markup for the embed comments button.
 *
 * @since WP 4.4.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function print_embed_comments_button() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return;
}

/**
 * Sets the last changed time for the 'comment' cache group.
 *
 * @since WP 5.0.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function wp_cache_set_comments_last_changed() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Registers the personal data exporter for comments.
 *
 * @since WP 4.9.6
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param array[] $exporters An array of personal data exporters.
 * @return array[] An array of personal data exporters.
 */
function wp_register_comment_personal_data_exporter( $exporters ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return $exporters;
}

/**
 * Registers the personal data eraser for comments.
 *
 * @since WP 4.9.6
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param array $erasers An array of personal data erasers.
 * @return array An array of personal data erasers.
 */
function wp_register_comment_personal_data_eraser( $erasers ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return $erasers;
}
