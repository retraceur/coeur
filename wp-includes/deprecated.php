<?php
/**
 * Deprecated functions from past WP/Retraceur versions. You shouldn't use these
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
 * Sets up the WP Loop.
 *
 * Use The Loop instead.
 *
 * @since WP 1.0.1
 * @deprecated WP 1.5.0
 *
 * @global WP_Query $wp_query WP Query object.
 */
function start_wp() {
	global $wp_query;

	_deprecated_function( __FUNCTION__, '1.5.0', __('new WP Loop') );

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
 * @global wpdb $wpdb WP database abstraction object.
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
 * @global wpdb $wpdb WP database abstraction object.
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
 * @global wpdb $wpdb WP database abstraction object.
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
 * @global wpdb $wpdb WP database abstraction object.
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
 * support. This is not the fault of WP (where functionality is downgraded,
 * not actual defects), but of your PHP version.
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
 * their WP installation.
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
 * Determines if the URL can be accessed over SSL by using the WP HTTP API to access
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
 * @global wpdb $wpdb WP database abstraction object.
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
 * @global WP_Query $wp_query WP Query object.
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
 * By default WP adds `decoding="async"` to images but developers can
 * use the {@see 'wp_img_tag_add_decoding_attr'} filter to modify this
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
 * WP is loading, especially in the Customizer preview or when making Customizer Ajax
 * requests for widgets or menus.
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
 * of default arguments for the new sidebar. WP will automatically generate
 * a sidebar ID and name based on the current number of registered sidebars
 * if those arguments are not included.
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
 * Registers all of the default WP widgets on startup.
 *
 * Calls {@see 'widgets_init'} action after all of the WP widgets have been registered.
 *
 * @since WP 2.2.0
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 */
function wp_widgets_init() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Fires after all default WP widgets have been registered.
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
 * Make a note of the sidebar being rendered before WP starts rendering
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
 * Kills WP execution and displays XML response with an error message.
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
 * WP 3.0.0 so this needs to allow for cases in which the filter is
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
	return '';
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
 * Renders the `core/comment-author-name` block on the server.
 *
 * @since WP 6.0.0
 *
 * @param array    $attributes Block attributes.
 * @param string   $content    Block default content.
 * @param WP_Block $block      Block instance.
 * @return string Return the post comment's author.
 */
function render_block_core_comment_author_name( $attributes, $content, $block ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return '';
}

/**
 * Registers the `core/comment-author-name` block on the server.
 *
 * @since WP 6.0.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function register_block_core_comment_author_name() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Renders the `core/comment-content` block on the server.
 *
 * @since WP 6.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param array    $attributes Block attributes.
 * @param string   $content    Block default content.
 * @param WP_Block $block      Block instance.
 * @return string Return the post comment's content.
 */
function render_block_core_comment_content( $attributes, $content, $block ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return '';
}

/**
 * Registers the `core/comment-content` block on the server.
 *
 * @since WP 6.0.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function register_block_core_comment_content() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Renders the `core/comment-reply-link` block on the server.
 *
 * @since WP 6.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param array    $attributes Block attributes.
 * @param string   $content    Block default content.
 * @param WP_Block $block      Block instance.
 * @return string Return the post comment's reply link.
 */
function render_block_core_comment_reply_link( $attributes, $content, $block ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return '';
}

/**
 * Registers the `core/comment-reply-link` block on the server.
 *
 * @since WP 6.0.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function register_block_core_comment_reply_link() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Function that recursively renders a list of nested comments.
 *
 * @since WP 6.3.0 Changed render_block_context priority to `1`.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @global int $comment_depth
 *
 * @param WP_Comment[] $comments        The array of comments.
 * @param WP_Block     $block           Block instance.
 * @return string
 */
function block_core_comment_template_render_comments( $comments, $block ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return '';
}

/**
 * Renders the `core/comment-template` block on the server.
 *
 * @since WP 6.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param array    $attributes Block attributes.
 * @param string   $content    Block default content.
 * @param WP_Block $block      Block instance.
 *
 * @return string Returns the HTML representing the comments using the layout
 * defined by the block's inner blocks.
 */
function render_block_core_comment_template( $attributes, $content, $block ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return '';
}

/**
 * Registers the `core/comment-template` block on the server.
 *
 * @since WP 6.0.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function register_block_core_comment_template() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Helper function that returns the proper pagination arrow HTML for
 * `CommentsPaginationNext` and `CommentsPaginationPrevious` blocks based on the
 * provided `paginationArrow` from `CommentsPagination` context.
 *
 * It's used in CommentsPaginationNext and CommentsPaginationPrevious blocks.
 *
 * @since WP 6.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param WP_Block $block           Block instance.
 * @param string   $pagination_type Optional. Type of the arrow we will be rendering.
 *                                  Accepts 'next' or 'previous'. Default 'next'.
 * @return string|null The pagination arrow HTML or null if there is none.
 */
function get_comments_pagination_arrow( $block, $pagination_type = 'next' ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return null;
}

/**
 * Renders the `core/comments-pagination-previous` block on the server.
 *
 * @since WP 6.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param array    $attributes Block attributes.
 * @param string   $content    Block default content.
 * @param WP_Block $block      Block instance.
 *
 * @return string Returns the previous posts link for the comments pagination.
 */
function render_block_core_comments_pagination_previous( $attributes, $content, $block ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return '';
}

/**
 * Registers the `core/comments-pagination-previous` block on the server.
 *
 * @since WP 6.0.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function register_block_core_comments_pagination_previous() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Renders the `core/comments-pagination-next` block on the server.
 *
 * @since WP 6.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param array    $attributes Block attributes.
 * @param string   $content    Block default content.
 * @param WP_Block $block      Block instance.
 *
 * @return string Returns the next comments link for the query pagination.
 */
function render_block_core_comments_pagination_next( $attributes, $content, $block ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return '';
}

/**
 * Registers the `core/comments-pagination-next` block on the server.
 *
 * @since WP 6.0.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function register_block_core_comments_pagination_next() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Renders the `core/comments-pagination-numbers` block on the server.
 *
 * @since WP 6.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param array    $attributes Block attributes.
 * @param string   $content    Block default content.
 * @param WP_Block $block      Block instance.
 *
 * @return string Returns the pagination numbers for the comments.
 */
function render_block_core_comments_pagination_numbers( $attributes, $content, $block ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return '';
}

/**
 * Registers the `core/comments-pagination-numbers` block on the server.
 *
 * @since WP 6.0.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function register_block_core_comments_pagination_numbers() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Renders the `core/comments-pagination` block on the server.
 *
 * @since WP 6.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param array  $attributes Block attributes.
 * @param string $content    Block default content.
 *
 * @return string Returns the wrapper for the Comments pagination.
 */
function render_block_core_comments_pagination( $attributes, $content ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return '';
}

/**
 * Registers the `core/comments-pagination` block on the server.
 *
 * @since WP 6.0.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function register_block_core_comments_pagination() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Renders the `core/comments-title` block on the server.
 *
 * @since WP 6.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param array $attributes Block attributes.
 *
 * @return string Return the post comments title.
 */
function render_block_core_comments_title( $attributes ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return '';
}

/**
 * Registers the `core/comments-title` block on the server.
 *
 * @since WP 6.0.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function register_block_core_comments_title() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Renders the `core/post-comments-form` block on the server.
 *
 * @since WP 6.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param array    $attributes Block attributes.
 * @param string   $content    Block default content.
 * @param WP_Block $block      Block instance.
 * @return string Returns the filtered post comments form for the current post.
 */
function render_block_core_post_comments_form( $attributes, $content, $block ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return '';
}

/**
 * Registers the `core/post-comments-form` block on the server.
 *
 * @since WP 6.0.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function register_block_core_post_comments_form() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Use the button block classes for the form-submit button.
 *
 * @since WP 6.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param array $fields The default comment form arguments.
 *
 * @return array Returns the modified fields.
 */
function post_comments_form_block_form_defaults( $fields ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return $fields;
}

/**
 * Renders the `core/comments` block on the server.
 *
 * This render callback is mainly for rendering a dynamic, legacy version of
 * this block (the old `core/post-comments`). It uses the `comments_template()`
 * function to generate the output, in the same way as classic PHP themes.
 *
 * As this callback will always run during SSR, first we need to check whether
 * the block is in legacy mode. If not, the HTML generated in the editor is
 * returned instead.
 *
 * @since WP 6.1.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @global WP_Post $post Global post object.
 *
 * @param array    $attributes Block attributes.
 * @param string   $content    Block default content.
 * @param WP_Block $block      Block instance.
 * @return string Returns the filtered post comments for the current post wrapped inside "p" tags.
 */
function render_block_core_comments( $attributes, $content, $block ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return '';
}

/**
 * Registers the `core/comments` block on the server.
 *
 * @since WP 6.1.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function register_block_core_comments() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Use the button block classes for the form-submit button.
 *
 * @since WP 6.1.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param array $fields The default comment form arguments.
 *
 * @return array Returns the modified fields.
 */
function comments_block_form_defaults( $fields ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return $fields;
}

/**
 * Enqueues styles from the legacy `core/post-comments` block. These styles are
 * required only by the block's fallback.
 *
 * @since WP 6.1.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string $block_name Name of the new block type.
 */
function enqueue_legacy_post_comments_block_styles( $block_name ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Ensures backwards compatibility for any users running the Gutenberg plugin
 * who have used Post Comments before it was merged into Comments Query Loop.
 *
 * The same approach was followed when core/query-loop was renamed to
 * core/post-template.
 *
 * @since WP 6.1.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @see https://github.com/WordPress/gutenberg/pull/41807
 * @see https://github.com/WordPress/gutenberg/pull/32514
 */
function register_legacy_post_comments_block() {
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

/**
 * Moves comments for a post to the Trash.
 *
 * @since WP 2.9.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int|WP_Post|null $post Optional. Post ID or post object. Defaults to global $post.
 * @return mixed|void False on failure.
 */
function wp_trash_post_comments( $post = null ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Fires before comments are sent to the Trash.
	 *
	 * @since WP 2.9.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param int $post_id Post ID.
	 */
	do_action_deprecated(
		'trash_post_comments',
		array( 0 ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	/**
	 * Fires after comments are sent to the Trash.
	 *
	 * @since WP 2.9.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param int   $post_id  Post ID.
	 * @param array $statuses Array of comment statuses.
	 */
	do_action_deprecated(
		'trashed_post_comments',
		array( 0, array() ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return false;
}

/**
 * Restores comments for a post from the Trash.
 *
 * @since WP 2.9.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int|WP_Post|null $post Optional. Post ID or post object. Defaults to global $post.
 * @return true|void
 */
function wp_untrash_post_comments( $post = null ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Fires before comments are restored for a post from the Trash.
	 *
	 * @since WP 2.9.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param int $post_id Post ID.
	 */
	do_action_deprecated(
		'untrash_post_comments',
		array( 0 ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	/**
	 * Fires after comments are restored for a post from the Trash.
	 *
	 * @since WP 2.9.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param int $post_id Post ID.
	 */
	do_action_deprecated(
		'untrashed_post_comments',
		array( 0 ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return;
}

/**
 * Displays a list of comments.
 *
 * Used in the comments.php template to list comments for a particular post.
 *
 * @since WP 2.7.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @see WP_Query::$comments
 *
 * @param string|array $args {
 *     Optional. Formatting options.
 *
 *     @type object   $walker            Instance of a Walker class to list comments. Default null.
 *     @type int      $max_depth         The maximum comments depth. Default empty.
 *     @type string   $style             The style of list ordering. Accepts 'ul', 'ol', or 'div'.
 *                                       'div' will result in no additional list markup. Default 'ul'.
 *     @type callable $callback          Callback function to use. Default null.
 *     @type callable $end-callback      Callback function to use at the end. Default null.
 *     @type string   $type              Type of comments to list. Accepts 'all', 'comment',
 *                                       'pingback', 'trackback', 'pings'. Default 'all'.
 *     @type int      $page              Page ID to list comments for. Default empty.
 *     @type int      $per_page          Number of comments to list per page. Default empty.
 *     @type int      $avatar_size       Height and width dimensions of the avatar size. Default 32.
 *     @type bool     $reverse_top_level Ordering of the listed comments. If true, will display
 *                                       newest comments first. Default null.
 *     @type bool     $reverse_children  Whether to reverse child comments in the list. Default null.
 *     @type string   $format            How to format the comments list. Accepts 'html5', 'xhtml'.
 *                                       Default 'html5' if the theme supports it.
 *     @type bool     $short_ping        Whether to output short pings. Default false.
 *     @type bool     $echo              Whether to echo the output or return it. Default true.
 * }
 * @param WP_Comment[] $comments Optional. Array of WP_Comment objects. Default null.
 * @return void|string Void if 'echo' argument is true, or no comments to list.
 *                     Otherwise, HTML list of comments.
 */
function wp_list_comments( $args = array(), $comments = null ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the arguments used in retrieving the comment list.
	 *
	 * @since WP 4.0.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param array $parsed_args An array of arguments for displaying comments.
	 */
	apply_filters_deprecated(
		'wp_list_comments_args',
		array( array() ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return;
}

/**
 * Calculates the total number of comment pages.
 *
 * @since WP 2.7.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param WP_Comment[] $comments Optional. Array of WP_Comment objects. Defaults to `$wp_query->comments`.
 * @param int          $per_page Optional. Comments per page. Defaults to the value of `comments_per_page`
 *                               query var, option of the same name, or 1 (in that order).
 * @param bool         $threaded Optional. Control over flat or threaded comments. Defaults to the value
 *                               of `thread_comments` option.
 * @return int Number of comment pages.
 */
function get_comment_pages_count( $comments = null, $per_page = null, $threaded = null ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return 0;
}

/**
 * Retrieves comment data given a comment ID or comment object.
 *
 * If an object is passed then the comment data will be cached and then returned
 * after being passed through a filter. If the comment is empty, then the global
 * comment variable will be used, if it is set.
 *
 * @since WP 2.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param WP_Comment|string|int $comment Comment to retrieve.
 * @param string                $output  Optional. The required return type. One of OBJECT, ARRAY_A, or ARRAY_N, which
 *                                       correspond to a WP_Comment object, an associative array, or a numeric array,
 *                                       respectively. Default OBJECT.
 * @return WP_Comment|array|null Depends on $output value.
 */
function get_comment( $comment = null, $output = OBJECT ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Fires after a comment is retrieved.
	 *
	 * @since WP 2.3.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param WP_Comment $_comment Comment data.
	 */
	apply_filters_deprecated(
		'get_comment',
		array( null ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return null;
}

/**
 * Retrieves the approved comments for a post.
 *
 * @since WP 2.0.0
 * @since WP 4.1.0 Refactored to leverage WP_Comment_Query over a direct query.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int   $post_id The ID of the post.
 * @param array $args    {
 *     Optional. See WP_Comment_Query::__construct() for information on accepted arguments.
 *
 *     @type int    $status  Comment status to limit results by. Defaults to approved comments.
 *     @type int    $post_id Limit results to those affiliated with a given post ID.
 *     @type string $order   How to order retrieved comments. Default 'ASC'.
 * }
 * @return WP_Comment[]|int[]|int The approved comments, or number of comments if `$count`
 *                                argument is true.
 */
function get_approved_comments( $post_id, $args = array() ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	if ( isset( $args['count'] ) && $args['count'] ) {
		return 0;
	}

	return array();
}

/**
 * Retrieves a list of comments.
 *
 * The comment list can be for the blog as a whole or for an individual post.
 *
 * @since WP 2.7.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string|array $args Optional. Array or string of arguments. See WP_Comment_Query::__construct()
 *                           for information on accepted arguments. Default empty string.
 * @return WP_Comment[]|int[]|int List of comments or number of found comments if `$count` argument is true.
 */
function get_comments( $args = '' ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return array();
}

/**
 * Calculates what page number a comment will appear on for comment paging.
 *
 * @since WP 2.7.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int   $comment_id Comment ID.
 * @param array $args {
 *     Array of optional arguments.
 *
 *     @type string     $type      Limit paginated comments to those matching a given type.
 *                                 Accepts 'comment', 'trackback', 'pingback', 'pings'
 *                                 (trackbacks and pingbacks), or 'all'. Default 'all'.
 *     @type int        $per_page  Per-page count to use when calculating pagination.
 *                                 Defaults to the value of the 'comments_per_page' option.
 *     @type int|string $max_depth If greater than 1, comment page will be determined
 *                                 for the top-level parent `$comment_id`.
 *                                 Defaults to the value of the 'thread_comments_depth' option.
 * }
 * @return int|null Comment page number or null on error.
 */
function get_page_of_comment( $comment_id, $args = array() ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the arguments used to query comments in get_page_of_comment().
	 *
	 * @since WP 5.5.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @see WP_Comment_Query::__construct()
	 *
	 * @param array $comment_args {
	 *     Array of WP_Comment_Query arguments.
	 *
	 *     @type string $type               Limit paginated comments to those matching a given type.
	 *                                      Accepts 'comment', 'trackback', 'pingback', 'pings'
	 *                                      (trackbacks and pingbacks), or 'all'. Default 'all'.
	 *     @type int    $post_id            ID of the post.
	 *     @type string $fields             Comment fields to return.
	 *     @type bool   $count              Whether to return a comment count (true) or array
	 *                                      of comment objects (false).
	 *     @type string $status             Comment status.
	 *     @type int    $parent             Parent ID of comment to retrieve children of.
	 *     @type array  $date_query         Date query clauses to limit comments by. See WP_Date_Query.
	 *     @type array  $include_unapproved Array of IDs or email addresses whose unapproved comments
	 *                                      will be included in paginated comments.
	 * }
	 */
	apply_filters_deprecated(
		'get_page_of_comment_query_args',
		array( array() ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	/**
	 * Filters the calculated page on which a comment appears.
	 *
	 * @since WP 4.4.0
	 * @since WP 4.7.0 Introduced the `$comment_id` parameter.
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param int   $page          Comment page.
	 * @param array $args {
	 *     Arguments used to calculate pagination. These include arguments auto-detected by the function,
	 *     based on query vars, system settings, etc. For pristine arguments passed to the function,
	 *     see `$original_args`.
	 *
	 *     @type string $type      Type of comments to count.
	 *     @type int    $page      Calculated current page.
	 *     @type int    $per_page  Calculated number of comments per page.
	 *     @type int    $max_depth Maximum comment threading depth allowed.
	 * }
	 * @param array $original_args {
	 *     Array of arguments passed to the function. Some or all of these may not be set.
	 *
	 *     @type string $type      Type of comments to count.
	 *     @type int    $page      Current comment page.
	 *     @type int    $per_page  Number of comments per page.
	 *     @type int    $max_depth Maximum comment threading depth allowed.
	 * }
	 * @param int $comment_id ID of the comment.
	 */
	apply_filters_deprecated(
		'get_page_of_comment',
		array( 0, array(), array(), 0 ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return null;
}

/**
 * Loads the comment template specified in $file.
 *
 * Will not display the comments template if not on single post or page, or if
 * the post does not have comments.
 *
 * Uses the Retraceur database object to query for the comments. The comments
 * are passed through the {@see 'comments_array'} filter hook with the list of comments
 * and the post ID respectively.
 *
 * The `$file` path is passed through a filter hook called {@see 'comments_template'},
 * which includes the template directory and $file combined. Tries the $filtered path
 * first and if it fails it will require the default comment template from the
 * default theme. If either does not exist, then the Retraceur process will be
 * halted. It is advised for that reason, that the default theme is not deleted.
 *
 * Will not try to get the comments if the post has none.
 *
 * @since WP 1.5.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string $file              Optional. The file to load. Default '/comments.php'.
 * @param bool   $separate_comments Optional. Whether to separate the comments by comment type.
 *                                  Default false.
 */
function comments_template( $file = '/comments.php', $separate_comments = false ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the arguments used in the top level comments query.
	 *
	 * @since WP 5.6.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @see WP_Comment_Query::__construct()
	 *
	 * @param array $top_level_args {
	 *     The top level query arguments for the comments template.
	 *
	 *     @type bool         $count   Whether to return a comment count.
	 *     @type string|array $orderby The field(s) to order by.
	 *     @type int          $post_id The post ID.
	 *     @type string|array $status  The comment status to limit results by.
	 * }
	 */
	apply_filters_deprecated(
		'comments_template_top_level_query_args',
		array( array() ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	/**
	 * Filters the arguments used to query comments in comments_template().
	 *
	 * @since WP 4.5.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @see WP_Comment_Query::__construct()
	 *
	 * @param array $comment_args {
	 *     Array of WP_Comment_Query arguments.
	 *
	 *     @type string|array $orderby                   Field(s) to order by.
	 *     @type string       $order                     Order of results. Accepts 'ASC' or 'DESC'.
	 *     @type string       $status                    Comment status.
	 *     @type array        $include_unapproved        Array of IDs or email addresses whose unapproved comments
	 *                                                   will be included in results.
	 *     @type int          $post_id                   ID of the post.
	 *     @type bool         $no_found_rows             Whether to refrain from querying for found rows.
	 *     @type bool         $update_comment_meta_cache Whether to prime cache for comment meta.
	 *     @type bool|string  $hierarchical              Whether to query for comments hierarchically.
	 *     @type int          $offset                    Comment offset.
	 *     @type int          $number                    Number of comments to fetch.
	 * }
	 */
	apply_filters_deprecated(
		'comments_template_query_args',
		array( array() ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	/**
	 * Filters the comments array.
	 *
	 * @since WP 2.1.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param array $comments Array of comments supplied to the comments template.
	 * @param int   $post_id  Post ID.
	 */
	apply_filters_deprecated(
		'comments_array',
		array( array(), 0 ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	/**
	 * Filters the path to the theme template file used for the comments template.
	 *
	 * @since WP 1.5.1
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string $theme_template The path to the theme template file.
	 */
	apply_filters_deprecated(
		'comments_template',
		array( '' ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);
}

/**
 * Helper function that constructs a comment query vars array from the passed
 * block properties.
 *
 * It's used with the Comment Query Loop inner blocks.
 *
 * @since WP 6.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param WP_Block $block Block instance.
 * @return array Returns the comment query parameters to use with the
 *               WP_Comment_Query constructor.
 */
function build_comment_query_vars_from_block( $block ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return array();
}

/**
 * Outputs the link to the comments for the current post in an XML safe way.
 *
 * @since WP 3.0.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function comments_link_feed() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the comments permalink for the current post.
	 *
	 * @since WP 3.6.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string $comment_permalink The current comment permalink with
	 *                                  '#comments' appended.
	 */
	apply_filters_deprecated(
		'comments_link_feed',
		array( '' ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);
}

/**
 * Displays the feed GUID for the current comment.
 *
 * @since WP 2.5.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int|WP_Comment $comment_id Optional comment object or ID. Defaults to global comment object.
 */
function comment_guid( $comment_id = null ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Retrieves the feed GUID for the current comment.
 *
 * @since WP 2.5.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int|WP_Comment $comment_id Optional comment object or ID. Defaults to global comment object.
 * @return string|false GUID for comment on success, false on failure.
 */
function get_comment_guid( $comment_id = null ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return false;
}

/**
 * Displays the link to the comments.
 *
 * @since WP 1.5.0
 * @since WP 4.4.0 Introduced the `$comment` argument.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int|WP_Comment $comment Optional. Comment object or ID. Defaults to global comment object.
 */
function comment_link( $comment = null ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the current comment's permalink.
	 *
	 * @since WP 3.6.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @see get_comment_link()
	 *
	 * @param string $comment_permalink The current comment permalink.
	 */
	apply_filters_deprecated(
		'comment_link',
		array( '' ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);
}

/**
 * Retrieves the current comment author for use in the feeds.
 *
 * @since WP 2.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @return string Comment Author.
 */
function get_comment_author_rss() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the current comment author for use in a feed.
	 *
	 * @since WP 1.5.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @see get_comment_author()
	 *
	 * @param string $comment_author The current comment author.
	 */
	apply_filters_deprecated(
		'comment_author_rss',
		array( '' ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);
}

/**
 * Displays the current comment author in the feed.
 *
 * @since WP 1.0.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function comment_author_rss() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Displays the current comment content for use in the feeds.
 *
 * @since WP 1.0.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function comment_text_rss() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the current comment content for use in a feed.
	 *
	 * @since WP 1.5.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string $comment_text The content of the current comment.
	 */
	apply_filters_deprecated(
		'comment_text_rss',
		array( '' ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);
}

/**
 * Retrieves the permalink for the post comments feed.
 *
 * @since WP 2.2.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int    $post_id Optional. Post ID. Default is the ID of the global `$post`.
 * @param string $feed    Optional. Feed type. Possible values include 'rss2', 'atom'.
 *                        Default is the value of get_default_feed().
 * @return string The permalink for the comments feed for the given post on success, empty string on failure.
 */
function get_post_comments_feed_link( $post_id = 0, $feed = '' ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the post comments feed permalink.
	 *
	 * @since WP 1.5.1
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string $url Post comments feed permalink.
	 */
	apply_filters_deprecated(
		'post_comments_feed_link',
		array( '' ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return '';
}

/**
 * Displays the comment feed link for a post.
 *
 * Prints out the comment feed link for a post. Link text is placed in the
 * anchor. If no link text is specified, default text is used. If no post ID is
 * specified, the current post is used.
 *
 * @since WP 2.5.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string $link_text Optional. Descriptive link text. Default 'Comments Feed'.
 * @param int    $post_id   Optional. Post ID. Default is the ID of the global `$post`.
 * @param string $feed      Optional. Feed type. Possible values include 'rss2', 'atom'.
 *                          Default is the value of get_default_feed().
 */
function post_comments_feed_link( $link_text = '', $post_id = '', $feed = '' ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the post comment feed link anchor tag.
	 *
	 * @since WP 2.8.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string $link    The complete anchor tag for the comment feed link.
	 * @param int    $post_id Post ID.
	 * @param string $feed    The feed type. Possible values include 'rss2', 'atom',
	 *                        or an empty string for the default feed type.
	 */
	apply_filters_deprecated(
		'post_comments_feed_link_html',
		array( '', 0, '' ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);
}

/**
 * Retrieves the permalink for the search results comments feed.
 *
 * @since WP 2.5.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string $search_query Optional. Search query. Default empty.
 * @param string $feed         Optional. Feed type. Possible values include 'rss2', 'atom'.
 *                             Default is the value of get_default_feed().
 * @return string The comments feed search results permalink.
 */
function get_search_comments_feed_link( $search_query = '', $feed = '' ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/** This filter is documented in wp-includes/link-template.php */
	apply_filters_deprecated(
		'search_feed_link',
		array( '', '', '' ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return '';
}

/**
 * Retrieves the comments page number link.
 *
 * @since WP 2.7.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int $pagenum  Optional. Page number. Default 1.
 * @param int $max_page Optional. The maximum number of comment pages. Default 0.
 * @return string The comments page number link URL.
 */
function get_comments_pagenum_link( $pagenum = 1, $max_page = 0 ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the comments page number link for the current request.
	 *
	 * @since WP 2.7.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string $result The comments page number link.
	 */
	apply_filters_deprecated(
		'get_comments_pagenum_link',
		array( '' ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return '';
}

/**
 * Retrieves the link to the next comments page.
 *
 * @since WP 2.7.1
 * @since WP 6.7.0 Added the `page` parameter.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string   $label    Optional. Label for link text. Default empty.
 * @param int      $max_page Optional. Max page. Default 0.
 * @param int|null $page     Optional. Page number. Default null.
 * @return string|void HTML-formatted link for the next page of comments.
 */
function get_next_comments_link( $label = '', $max_page = 0, $page = null ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the anchor tag attributes for the next comments page link.
	 *
	 * @since WP 2.7.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string $attributes Attributes for the anchor tag.
	 */
	apply_filters_deprecated(
		'next_comments_link_attributes',
		array( '' ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return '';
}

/**
 * Displays the link to the next comments page.
 *
 * @since WP 2.7.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string $label    Optional. Label for link text. Default empty.
 * @param int    $max_page Optional. Max page. Default 0.
 */
function next_comments_link( $label = '', $max_page = 0 ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Retrieves the link to the previous comments page.
 *
 * @since WP 2.7.1
 * @since WP 6.7.0 Added the `page` parameter.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string   $label Optional. Label for comments link text. Default empty.
 * @param int|null $page  Optional. Page number. Default null.
 * @return string|void HTML-formatted link for the previous page of comments.
 */
function get_previous_comments_link( $label = '', $page = null ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the anchor tag attributes for the previous comments page link.
	 *
	 * @since WP 2.7.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string $attributes Attributes for the anchor tag.
	 */
	apply_filters_deprecated(
		'previous_comments_link_attributes',
		array( '' ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return '';
}

/**
 * Displays the link to the previous comments page.
 *
 * @since WP 2.7.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string $label Optional. Label for comments link text. Default empty.
 */
function previous_comments_link( $label = '' ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Displays or retrieves pagination links for the comments on the current post.
 *
 * @see paginate_links()
 * @since WP 2.7.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string|array $args Optional args. See paginate_links(). Default empty array.
 * @return void|string|array Void if 'echo' argument is true and 'type' is not an array,
 *                           or if the query is not for an existing single post of any post type.
 *                           Otherwise, markup for comment page links or array of comment page links,
 *                           depending on 'type' argument.
 */
function paginate_comments_links( $args = array() ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Retrieves navigation to next/previous set of comments, when applicable.
 *
 * @since WP 4.4.0
 * @since WP 5.3.0 Added the `aria_label` parameter.
 * @since WP 5.5.0 Added the `class` parameter.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param array $args {
 *     Optional. Default comments navigation arguments.
 *
 *     @type string $prev_text          Anchor text to display in the previous comments link.
 *                                      Default 'Older comments'.
 *     @type string $next_text          Anchor text to display in the next comments link.
 *                                      Default 'Newer comments'.
 *     @type string $screen_reader_text Screen reader text for the nav element. Default 'Comments navigation'.
 *     @type string $aria_label         ARIA label text for the nav element. Default 'Comments'.
 *     @type string $class              Custom class for the nav element. Default 'comment-navigation'.
 * }
 * @return string Markup for comments links.
 */
function get_the_comments_navigation( $args = array() ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return '';
}

/**
 * Displays navigation to next/previous set of comments, when applicable.
 *
 * @since WP 4.4.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param array $args See get_the_comments_navigation() for available arguments. Default empty array.
 */
function the_comments_navigation( $args = array() ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Retrieves a paginated navigation to next/previous set of comments, when applicable.
 *
 * @since WP 4.4.0
 * @since WP 5.3.0 Added the `aria_label` parameter.
 * @since WP 5.5.0 Added the `class` parameter.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @see paginate_comments_links()
 *
 * @param array $args {
 *     Optional. Default pagination arguments.
 *
 *     @type string $screen_reader_text Screen reader text for the nav element. Default 'Comments pagination'.
 *     @type string $aria_label         ARIA label text for the nav element. Default 'Comments pagination'.
 *     @type string $class              Custom class for the nav element. Default 'comments-pagination'.
 * }
 * @return string Markup for pagination links.
 */
function get_the_comments_pagination( $args = array() ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return '';
}

/**
 * Displays a paginated navigation to next/previous set of comments, when applicable.
 *
 * @since WP 4.4.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param array $args See get_the_comments_pagination() for available arguments. Default empty array.
 */
function the_comments_pagination( $args = array() ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Check if this comment type allows avatars to be retrieved.
 *
 * @since WP 5.1.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string $comment_type Comment type to check.
 * @return bool Whether the comment type is allowed for retrieving avatars.
 */
function is_avatar_comment_type( $comment_type ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the list of allowed comment types for retrieving avatars.
	 *
	 * @since WP 3.0.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param array $types An array of content types. Default only contains 'comment'.
	 */
	apply_filters_deprecated(
		'get_avatar_comment_types',
		array( array() ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return false;
}

/**
 * Adds a URL to those already pinged.
 *
 * @since WP 1.5.0
 * @since WP 4.7.0 `$post` can be a WP_Post object.
 * @since WP 4.7.0 `$uri` can be an array of URIs.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int|WP_Post  $post Post ID or post object.
 * @param string|array $uri  Ping URI or array of URIs.
 * @return int|false How many rows were updated.
 */
function add_ping( $post, $uri ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the new ping URL to add for the given post.
	 *
	 * @since WP 2.0.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string $new New ping URL to add.
	 */
	apply_filters_deprecated(
		'add_ping',
		array( '' ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return false;
}

/**
 * Retrieves URLs already pinged for a post.
 *
 * @since WP 1.5.0
 * @since WP 4.7.0 `$post` can be a WP_Post object.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int|WP_Post $post Post ID or object.
 * @return string[]|false Array of URLs already pinged for the given post, false if the post is not found.
 */
function get_pung( $post ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the list of already-pinged URLs for the given post.
	 *
	 * @since WP 2.0.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string[] $pung Array of URLs already pinged for the given post.
	 */
	apply_filters_deprecated(
		'get_pung',
		array( array() ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return false;
}

/**
 * Hook to schedule pings and enclosures when a post is published.
 *
 * Uses WP_IMPORTING constants.
 *
 * @since WP 2.3.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @access private
 *
 * @param int $post_id The ID of the post being published.
 */
function _publish_post_hook( $post_id ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Checks whether a comment passes internal checks to be allowed to add.
 *
 * If manual comment moderation is set in the administration, then all checks,
 * regardless of their type and substance, will fail and the function will
 * return false.
 *
 * If the number of links exceeds the amount in the administration, then the
 * check fails. If any of the parameter contents contain any disallowed words,
 * then the check fails.
 *
 * If the comment author was approved before, then the comment is automatically
 * approved.
 *
 * If all checks pass, the function will return true.
 *
 * @since WP 1.2.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string $author       Comment author name.
 * @param string $email        Comment author email.
 * @param string $url          Comment author URL.
 * @param string $comment      Content of the comment.
 * @param string $user_ip      Comment author IP address.
 * @param string $user_agent   Comment author User-Agent.
 * @param string $comment_type Comment type, either user-submitted comment,
 *                             trackback, or pingback.
 * @return bool If all checks pass, true, otherwise false.
 */
function check_comment( $author, $email, $url, $comment, $user_ip, $user_agent, $comment_type ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/** This filter is documented in wp-includes/comment-template.php */
	apply_filters_deprecated(
		'comment_text',
		array( null, null, array() ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	/**
	 * Filters the number of links found in a comment.
	 *
	 * @since WP 3.0.0
	 * @since WP 4.7.0 Added the `$comment` parameter.
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param int    $num_links The number of links found.
	 * @param string $url       Comment author's URL. Included in allowed links total.
	 * @param string $comment   Content of the comment.
	 */
	apply_filters_deprecated(
		'comment_max_links_url',
		array( 0, '', '' ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return false;
}

/**
 * Retrieves all of the WP supported comment statuses.
 *
 * Comments have a limited set of valid status values, this provides the comment
 * status values and descriptions.
 *
 * @since WP 2.7.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @return string[] List of comment status labels keyed by status.
 */
function get_comment_statuses() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return array();
}

/**
 * Gets the default comment status for a post type.
 *
 * @since WP 4.3.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string $post_type    Optional. Post type. Default 'post'.
 * @param string $comment_type Optional. Comment type. Default 'comment'.
 * @return string Either 'open' or 'closed'.
 */
function get_default_comment_status( $post_type = 'post', $comment_type = 'comment' ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the default comment status for the given post type.
	 *
	 * @since WP 4.3.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string $status       Default status for the given post type,
	 *                             either 'open' or 'closed'.
	 * @param string $post_type    Post type. Default is `post`.
	 * @param string $comment_type Type of comment. Default is `comment`.
	 */
	apply_filters_deprecated(
		'get_default_comment_status',
		array( '', '', '' ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return 'closed';
}

/**
 * Retrieves the date the last comment was modified.
 *
 * @since WP 1.5.0
 * @since WP 4.7.0 Replaced caching the modified date in a local static variable
 *              with the Object Cache API.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string $timezone Which timezone to use in reference to 'gmt', 'blog', or 'server' locations.
 * @return string|false Last comment modified date on success, false on failure.
 */
function get_lastcommentmodified( $timezone = 'server' ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return false;
}

/**
 * Retrieves the total comment counts for the whole site or a single post.
 *
 * @since WP 2.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int $post_id Optional. Restrict the comment counts to the given post. Default 0, which indicates that
 *                     comment counts for the whole site will be retrieved.
 * @return int[] {
 *     The number of comments keyed by their status.
 *
 *     @type int $approved            The number of approved comments.
 *     @type int $awaiting_moderation The number of comments awaiting moderation (a.k.a. pending).
 *     @type int $spam                The number of spam comments.
 *     @type int $trash               The number of trashed comments.
 *     @type int $post-trashed        The number of comments for posts that are in the trash.
 *     @type int $total_comments      The total number of non-trashed comments, including spam.
 *     @type int $all                 The total number of pending or approved comments.
 * }
 */
function get_comment_count( $post_id = 0 ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return array();
}

/**
 * Adds meta data field to a comment.
 *
 * @since WP 2.9.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int    $comment_id Comment ID.
 * @param string $meta_key   Metadata name.
 * @param mixed  $meta_value Metadata value. Must be serializable if non-scalar.
 * @param bool   $unique     Optional. Whether the same key should not be added.
 *                           Default false.
 * @return int|false Meta ID on success, false on failure.
 */
function add_comment_meta( $comment_id, $meta_key, $meta_value, $unique = false ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return false;
}

/**
 * Removes metadata matching criteria from a comment.
 *
 * You can match based on the key, or key and value. Removing based on key and
 * value, will keep from removing duplicate metadata with the same key. It also
 * allows removing all metadata matching key, if needed.
 *
 * @since WP 2.9.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int    $comment_id Comment ID.
 * @param string $meta_key   Metadata name.
 * @param mixed  $meta_value Optional. Metadata value. If provided,
 *                           rows will only be removed that match the value.
 *                           Must be serializable if non-scalar. Default empty string.
 * @return bool True on success, false on failure.
 */
function delete_comment_meta( $comment_id, $meta_key, $meta_value = '' ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return false;
}

/**
 * Retrieves comment meta field for a comment.
 *
 * @since WP 2.9.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int    $comment_id Comment ID.
 * @param string $key        Optional. The meta key to retrieve. By default,
 *                           returns data for all keys. Default empty string.
 * @param bool   $single     Optional. Whether to return a single value.
 *                           This parameter has no effect if `$key` is not specified.
 *                           Default false.
 * @return mixed An array of values if `$single` is false.
 *               The value of meta data field if `$single` is true.
 *               False for an invalid `$comment_id` (non-numeric, zero, or negative value).
 *               An empty array if a valid but non-existing comment ID is passed and `$single` is false.
 *               An empty string if a valid but non-existing comment ID is passed and `$single` is true.
 */
function get_comment_meta( $comment_id, $key = '', $single = false ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return false;
}

/**
 * Queue comment meta for lazy-loading.
 *
 * @since WP 6.3.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param array $comment_ids List of comment IDs.
 */
function wp_lazyload_comment_meta( array $comment_ids ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Updates comment meta field based on comment ID.
 *
 * Use the $prev_value parameter to differentiate between meta fields with the
 * same key and comment ID.
 *
 * If the meta field for the comment does not exist, it will be added.
 *
 * @since WP 2.9.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int    $comment_id Comment ID.
 * @param string $meta_key   Metadata key.
 * @param mixed  $meta_value Metadata value. Must be serializable if non-scalar.
 * @param mixed  $prev_value Optional. Previous value to check before updating.
 *                           If specified, only update existing metadata entries with
 *                           this value. Otherwise, update all entries. Default empty string.
 * @return int|bool Meta ID if the key didn't exist, true on successful update,
 *                  false on failure or if the value passed to the function
 *                  is the same as the one that is already in the database.
 */
function update_comment_meta( $comment_id, $meta_key, $meta_value, $prev_value = '' ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return false;
}

/**
 * Validates whether this comment is allowed to be made.
 *
 * @since WP 2.0.0
 * @since WP 4.7.0 The `$avoid_die` parameter was added, allowing the function
 *              to return a WP_Error object instead of dying.
 * @since WP 5.5.0 The `$avoid_die` parameter was renamed to `$wp_error`.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param array $commentdata Contains information on the comment.
 * @param bool  $wp_error    When true, a disallowed comment will result in the function
 *                           returning a WP_Error object, rather than executing wp_die().
 *                           Default false.
 * @return int|string|WP_Error Allowed comments return the approval status (0|1|'spam'|'trash').
 *                             If `$wp_error` is true, disallowed comments return a WP_Error.
 */
function wp_allow_comment( $commentdata, $wp_error = false ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the ID, if any, of the duplicate comment found when creating a new comment.
	 *
	 * Return an empty value from this filter to allow what WP considers a duplicate comment.
	 *
	 * @since WP 4.4.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param int   $dupe_id     ID of the comment identified as a duplicate.
	 * @param array $commentdata Data for the comment being created.
	 */
	apply_filters_deprecated(
		'duplicate_comment_id',
		array( 0, array() ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	/**
	 * Fires immediately after a duplicate comment is detected.
	 *
	 * @since WP 3.0.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param array $commentdata Comment data.
	 */
	do_action_deprecated(
		'comment_duplicate_trigger',
		array( array() ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	/**
	 * Filters duplicate comment error message.
	 *
	 * @since WP 5.2.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string $comment_duplicate_message Duplicate comment error message.
	 */
	apply_filters_deprecated(
		'comment_duplicate_message',
		array( '' ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	/**
	 * Fires immediately before a comment is marked approved.
	 *
	 * Allows checking for comment flooding.
	 *
	 * @since WP 2.3.0
	 * @since WP 4.7.0 The `$avoid_die` parameter was added.
	 * @since WP 5.5.0 The `$avoid_die` parameter was renamed to `$wp_error`.
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string $comment_author_ip    Comment author's IP address.
	 * @param string $comment_author_email Comment author's email.
	 * @param string $comment_date_gmt     GMT date the comment was posted.
	 * @param bool   $wp_error             Whether to return a WP_Error object instead of executing
	 *                                     wp_die() or die() if a comment flood is occurring.
	 */
	do_action_deprecated(
		'check_comment_flood',
		array( '', '', '', false ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	/**
	 * Filters whether a comment is part of a comment flood.
	 *
	 * The default check is wp_check_comment_flood(). See check_comment_flood_db().
	 *
	 * @since WP 4.7.0
	 * @since WP 5.5.0 The `$avoid_die` parameter was renamed to `$wp_error`.
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param bool   $is_flood             Is a comment flooding occurring? Default false.
	 * @param string $comment_author_ip    Comment author's IP address.
	 * @param string $comment_author_email Comment author's email.
	 * @param string $comment_date_gmt     GMT date the comment was posted.
	 * @param bool   $wp_error             Whether to return a WP_Error object instead of executing
	 *                                     wp_die() or die() if a comment flood is occurring.
	 */
	apply_filters_deprecated(
		'wp_is_comment_flood',
		array( false,'' , '', '', false ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return 0;
}

/**
 * Hooks WP's native database-based comment-flood check.
 *
 * This wrapper maintains backward compatibility with plugins that expect to
 * be able to unhook the legacy check_comment_flood_db() function from
 * 'check_comment_flood' using remove_action().
 *
 * @since WP 2.3.0
 * @since WP 4.7.0 Converted to be an add_filter() wrapper.
 * @deprecated 1.0.0 Retraceur fork.
 */
function check_comment_flood_db() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Checks whether comment flooding is occurring.
 *
 * Won't run, if current user can manage options, so to not block
 * administrators.
 *
 * @since WP 4.7.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param bool   $is_flood  Is a comment flooding occurring?
 * @param string $ip        Comment author's IP address.
 * @param string $email     Comment author's email address.
 * @param string $date      MySQL time string.
 * @param bool   $avoid_die When true, a disallowed comment will result in the function
 *                          returning without executing wp_die() or die(). Default false.
 * @return bool Whether comment flooding is occurring.
 */
function wp_check_comment_flood( $is_flood, $ip, $email, $date, $avoid_die = false ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the comment flood status.
	 *
	 * @since WP 2.1.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param bool $bool             Whether a comment flood is occurring. Default false.
	 * @param int  $time_lastcomment Timestamp of when the last comment was posted.
	 * @param int  $time_newcomment  Timestamp of when the new comment was posted.
	 */
	apply_filters_deprecated(
		'comment_flood_filter',
		array( false, 0, 0 ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	/**
	 * Fires before the comment flood message is triggered.
	 *
	 * @since WP 1.5.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param int $time_lastcomment Timestamp of when the last comment was posted.
	 * @param int $time_newcomment  Timestamp of when the new comment was posted.
	 */
	do_action_deprecated(
		'comment_flood_trigger',
		array( 0, 0 ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	/**
	 * Filters the comment flood error message.
	 *
	 * @since WP 5.2.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string $comment_flood_message Comment flood error message.
	 */
	apply_filters_deprecated(
		'comment_flood_message',
		array( '' ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return false;
}

/**
 * Separates an array of comments into an array keyed by comment_type.
 *
 * @since WP 2.7.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param WP_Comment[] $comments Array of comments
 * @return WP_Comment[] Array of comments keyed by comment_type.
 */
function separate_comments( &$comments ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return array();
}

/**
 * Retrieves the maximum character lengths for the comment form fields.
 *
 * @since WP 4.5.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @return int[] Array of maximum lengths keyed by field name.
 */
function wp_get_comment_fields_max_lengths() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the lengths for the comment form fields.
	 *
	 * @since WP 4.5.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param int[] $lengths Array of maximum lengths keyed by field name.
	 */
	apply_filters_deprecated(
		'wp_get_comment_fields_max_lengths',
		array( array() ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return array();
}

/**
 * Compares the lengths of comment data against the maximum character limits.
 *
 * @since WP 4.7.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param array $comment_data Array of arguments for inserting a comment.
 * @return WP_Error|true WP_Error when a comment field exceeds the limit,
 *                       otherwise true.
 */
function wp_check_comment_data_max_lengths( $comment_data ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return true;
}

/**
 * Checks whether comment data passes internal checks or has disallowed content.
 *
 * @since WP 6.7.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param array $comment_data Array of arguments for inserting a comment.
 * @return int|string|WP_Error The approval status on success (0|1|'spam'|'trash'),
  *                            WP_Error otherwise.
 */
function wp_check_comment_data( $comment_data ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters a comment's approval status before it is set.
	 *
	 * @since WP 2.1.0
	 * @since WP 4.9.0 Returning a WP_Error value from the filter will short-circuit comment insertion
	 *              and allow skipping further processing.
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param int|string|WP_Error $approved    The approval status. Accepts 1, 0, 'spam', 'trash',
	 *                                         or WP_Error.
	 * @param array               $commentdata Comment data.
	 */
	apply_filters_deprecated(
		'pre_comment_approved',
		array( 0, array() ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return 0;
}

/**
 * Checks if a comment contains disallowed characters or words.
 *
 * @since WP 5.5.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string $author The author of the comment
 * @param string $email The email of the comment
 * @param string $url The url used in the comment
 * @param string $comment The comment content
 * @param string $user_ip The comment author's IP address
 * @param string $user_agent The author's browser user agent
 * @return bool True if comment contains disallowed content, false if comment does not
 */
function wp_check_comment_disallowed_list( $author, $email, $url, $comment, $user_ip, $user_agent ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Fires before the comment is tested for disallowed characters or words.
	 *
	 * @since WP 1.5.0
	 * @deprecated WP 5.5.0 Use {@see 'wp_check_comment_disallowed_list'} instead.
	 *
	 * @param string $author     Comment author.
	 * @param string $email      Comment author's email.
	 * @param string $url        Comment author's URL.
	 * @param string $comment    Comment content.
	 * @param string $user_ip    Comment author's IP address.
	 * @param string $user_agent Comment author's browser user agent.
	 */
	do_action_deprecated(
		'wp_blacklist_check',
		array( $author, $email, $url, $comment, $user_ip, $user_agent ),
		'5.5.0',
		'wp_check_comment_disallowed_list',
		__( 'Please consider writing more inclusive code.' )
	);

	/**
	 * Fires before the comment is tested for disallowed characters or words.
	 *
	 * @since WP 5.5.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string $author     Comment author.
	 * @param string $email      Comment author's email.
	 * @param string $url        Comment author's URL.
	 * @param string $comment    Comment content.
	 * @param string $user_ip    Comment author's IP address.
	 * @param string $user_agent Comment author's browser user agent.
	 */
	do_action_deprecated(
		'wp_check_comment_disallowed_list',
		array( '', '', '', '', '', '' ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return false;
}

/**
 * Retrieves the total comment counts for the whole site or a single post.
 *
 * The comment stats are cached and then retrieved, if they already exist in the
 * cache.
 *
 * @see get_comment_count() Which handles fetching the live comment counts.
 *
 * @since WP 2.5.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int $post_id Optional. Restrict the comment counts to the given post. Default 0, which indicates that
 *                     comment counts for the whole site will be retrieved.
 * @return stdClass {
 *     The number of comments keyed by their status.
 *
 *     @type int $approved       The number of approved comments.
 *     @type int $moderated      The number of comments awaiting moderation (a.k.a. pending).
 *     @type int $spam           The number of spam comments.
 *     @type int $trash          The number of trashed comments.
 *     @type int $post-trashed   The number of comments for posts that are in the trash.
 *     @type int $total_comments The total number of non-trashed comments, including spam.
 *     @type int $all            The total number of pending or approved comments.
 * }
 */
function wp_count_comments( $post_id = 0 ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the comments count for a given post or the whole site.
	 *
	 * @since WP 2.7.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param array|stdClass $count   An empty array or an object containing comment counts.
	 * @param int            $post_id The post ID. Can be 0 to represent the whole site.
	 */
	apply_filters_deprecated(
		'wp_count_comments',
		array( array(), 0 ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return null;
}

/**
 * Trashes or deletes a comment.
 *
 * The comment is moved to Trash instead of permanently deleted unless Trash is
 * disabled, item is already in the Trash, or $force_delete is true.
 *
 * The post comment count will be updated if the comment was approved and has a
 * post ID available.
 *
 * @since WP 2.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int|WP_Comment $comment_id   Comment ID or WP_Comment object.
 * @param bool           $force_delete Whether to bypass Trash and force deletion. Default false.
 * @return bool True on success, false on failure.
 */
function wp_delete_comment( $comment_id, $force_delete = false ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Fires immediately before a comment is deleted from the database.
	 *
	 * @since WP 1.2.0
	 * @since WP 4.9.0 Added the `$comment` parameter.
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string     $comment_id The comment ID as a numeric string.
	 * @param WP_Comment $comment    The comment to be deleted.
	 */
	do_action_deprecated(
		'delete_comment',
		array( '', null ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	/**
	 * Fires immediately after a comment is deleted from the database.
	 *
	 * @since WP 2.9.0
	 * @since WP 4.9.0 Added the `$comment` parameter.
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string     $comment_id The comment ID as a numeric string.
	 * @param WP_Comment $comment    The deleted comment.
	 */
	do_action_deprecated(
		'deleted_comment',
		array( '', null ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return false;
}

/**
 * Moves a comment to the Trash
 *
 * If Trash is disabled, comment is permanently deleted.
 *
 * @since WP 2.9.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int|WP_Comment $comment_id Comment ID or WP_Comment object.
 * @return bool True on success, false on failure.
 */
function wp_trash_comment( $comment_id ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Fires immediately before a comment is sent to the Trash.
	 *
	 * @since WP 2.9.0
	 * @since WP 4.9.0 Added the `$comment` parameter.
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string     $comment_id The comment ID as a numeric string.
	 * @param WP_Comment $comment    The comment to be trashed.
	 */
	do_action_deprecated(
		'trash_comment',
		array( '', null ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	/**
	 * Fires immediately after a comment is sent to Trash.
	 *
	 * @since WP 2.9.0
	 * @since WP 4.9.0 Added the `$comment` parameter.
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string     $comment_id The comment ID as a numeric string.
	 * @param WP_Comment $comment    The trashed comment.
	 */
	do_action_deprecated(
		'trashed_comment',
		array( '', null ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return false;
}

/**
 * Removes a comment from the Trash
 *
 * @since WP 2.9.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int|WP_Comment $comment_id Comment ID or WP_Comment object.
 * @return bool True on success, false on failure.
 */
function wp_untrash_comment( $comment_id ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Fires immediately before a comment is restored from the Trash.
	 *
	 * @since WP 2.9.0
	 * @since WP 4.9.0 Added the `$comment` parameter.
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string     $comment_id The comment ID as a numeric string.
	 * @param WP_Comment $comment    The comment to be untrashed.
	 */
	do_action_deprecated(
		'untrash_comment',
		array( '', null ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	/**
	 * Fires immediately after a comment is restored from the Trash.
	 *
	 * @since WP 2.9.0
	 * @since WP 4.9.0 Added the `$comment` parameter.
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string     $comment_id The comment ID as a numeric string.
	 * @param WP_Comment $comment    The untrashed comment.
	 */
	do_action_deprecated(
		'untrashed_comment',
		array( '', null ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return false;
}

/**
 * Marks a comment as Spam.
 *
 * @since WP 2.9.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int|WP_Comment $comment_id Comment ID or WP_Comment object.
 * @return bool True on success, false on failure.
 */
function wp_spam_comment( $comment_id ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Fires immediately before a comment is marked as Spam.
	 *
	 * @since WP 2.9.0
	 * @since WP 4.9.0 Added the `$comment` parameter.
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param int        $comment_id The comment ID.
	 * @param WP_Comment $comment    The comment to be marked as spam.
	 */
	do_action_deprecated(
		'spam_comment',
		array( 0, null ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	/**
	 * Fires immediately after a comment is marked as Spam.
	 *
	 * @since WP 2.9.0
	 * @since WP 4.9.0 Added the `$comment` parameter.
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param int        $comment_id The comment ID.
	 * @param WP_Comment $comment    The comment marked as spam.
	 */
	do_action_deprecated(
		'spammed_comment',
		array( 0, null ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return false;
}

/**
 * Removes a comment from the Spam.
 *
 * @since WP 2.9.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int|WP_Comment $comment_id Comment ID or WP_Comment object.
 * @return bool True on success, false on failure.
 */
function wp_unspam_comment( $comment_id ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Fires immediately before a comment is unmarked as Spam.
	 *
	 * @since WP 2.9.0
	 * @since WP 4.9.0 Added the `$comment` parameter.
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string     $comment_id The comment ID as a numeric string.
	 * @param WP_Comment $comment    The comment to be unmarked as spam.
	 */
	do_action_deprecated(
		'unspam_comment',
		array( '', null ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	/**
	 * Fires immediately after a comment is unmarked as Spam.
	 *
	 * @since WP 2.9.0
	 * @since WP 4.9.0 Added the `$comment` parameter.
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string     $comment_id The comment ID as a numeric string.
	 * @param WP_Comment $comment    The comment unmarked as spam.
	 */
	do_action_deprecated(
		'unspammed_comment',
		array( '', null ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return false;
}

/**
 * Retrieves the status of a comment by comment ID.
 *
 * @since WP 1.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int|WP_Comment $comment_id Comment ID or WP_Comment object
 * @return string|false Status might be 'trash', 'approved', 'unapproved', 'spam'. False on failure.
 */
function wp_get_comment_status( $comment_id ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return false;
}

/**
 * Calls hooks for when a comment status transition occurs.
 *
 * Calls hooks for comment status transitions. If the new comment status is not the same
 * as the previous comment status, then two hooks will be ran, the first is
 * {@see 'transition_comment_status'} with new status, old status, and comment data.
 * The next action called is {@see 'comment_$old_status_to_$new_status'}. It has
 * the comment data.
 *
 * The final action will run whether or not the comment statuses are the same.
 * The action is named {@see 'comment_$new_status_$comment->comment_type'}.
 *
 * @since WP 2.7.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string     $new_status New comment status.
 * @param string     $old_status Previous comment status.
 * @param WP_Comment $comment    Comment object.
 */
function wp_transition_comment_status( $new_status, $old_status, $comment ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Fires when the comment status is in transition.
	 *
	 * @since WP 2.7.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param int|string $new_status The new comment status.
	 * @param int|string $old_status The old comment status.
	 * @param WP_Comment $comment    Comment object.
	 */
	do_action_deprecated(
		'transition_comment_status',
		array( 0, 0, null ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	/**
	 * Fires when the comment status is in transition from one specific status to another.
	 *
	 * The dynamic portions of the hook name, `$old_status`, and `$new_status`,
	 * refer to the old and new comment statuses, respectively.
	 *
	 * Possible hook names include:
	 *
	 *  - `comment_unapproved_to_approved`
	 *  - `comment_spam_to_approved`
	 *  - `comment_approved_to_unapproved`
	 *  - `comment_spam_to_unapproved`
	 *  - `comment_unapproved_to_spam`
	 *  - `comment_approved_to_spam`
	 *
	 * @since WP 2.7.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param WP_Comment $comment Comment object.
	 */
	do_action_deprecated(
		"comment_{$old_status}_to_{$new_status}",
		array( null ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);
}

/**
 * Clears the lastcommentmodified cached value when a comment status is changed.
 *
 * Deletes the lastcommentmodified cache key when a comment enters or leaves
 * 'approved' status.
 *
 * @since WP 4.7.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @access private
 *
 * @param string $new_status The new comment status.
 * @param string $old_status The old comment status.
 */
function _clear_modified_cache_on_transition_comment_status( $new_status, $old_status ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Gets current commenter's name, email, and URL.
 *
 * Expects cookies content to already be sanitized. User of this function might
 * wish to recheck the returned array for validity.
 *
 * @see sanitize_comment_cookies() Use to sanitize cookies
 *
 * @since WP 2.0.4
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @return array {
 *     An array of current commenter variables.
 *
 *     @type string $comment_author       The name of the current commenter, or an empty string.
 *     @type string $comment_author_email The email address of the current commenter, or an empty string.
 *     @type string $comment_author_url   The URL address of the current commenter, or an empty string.
 * }
 */
function wp_get_current_commenter() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the current commenter's name, email, and URL.
	 *
	 * @since WP 3.1.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param array $comment_author_data {
	 *     An array of current commenter variables.
	 *
	 *     @type string $comment_author       The name of the current commenter, or an empty string.
	 *     @type string $comment_author_email The email address of the current commenter, or an empty string.
	 *     @type string $comment_author_url   The URL address of the current commenter, or an empty string.
	 * }
	 */
	apply_filters_deprecated(
		'wp_get_current_commenter',
		array( array() ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return array();
}

/**
 * Gets unapproved comment author's email.
 *
 * Used to allow the commenter to see their pending comment.
 *
 * @since WP 5.1.0
 * @since WP 5.7.0 The window within which the author email for an unapproved comment
 *              can be retrieved was extended to 10 minutes.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @return string The unapproved comment author's email (when supplied).
 */
function wp_get_unapproved_comment_author_email() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return '';
}

/**
 * Inserts a comment into the database.
 *
 * @since WP 2.0.0
 * @since WP 4.4.0 Introduced the `$comment_meta` argument.
 * @since WP 5.5.0 Default value for `$comment_type` argument changed to `comment`.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param array $commentdata {
 *     Array of arguments for inserting a new comment.
 *
 *     @type string     $comment_agent        The HTTP user agent of the `$comment_author` when
 *                                            the comment was submitted. Default empty.
 *     @type int|string $comment_approved     Whether the comment has been approved. Default 1.
 *     @type string     $comment_author       The name of the author of the comment. Default empty.
 *     @type string     $comment_author_email The email address of the `$comment_author`. Default empty.
 *     @type string     $comment_author_IP    The IP address of the `$comment_author`. Default empty.
 *     @type string     $comment_author_url   The URL address of the `$comment_author`. Default empty.
 *     @type string     $comment_content      The content of the comment. Default empty.
 *     @type string     $comment_date         The date the comment was submitted. To set the date
 *                                            manually, `$comment_date_gmt` must also be specified.
 *                                            Default is the current time.
 *     @type string     $comment_date_gmt     The date the comment was submitted in the GMT timezone.
 *                                            Default is `$comment_date` in the site's GMT timezone.
 *     @type int        $comment_karma        The karma of the comment. Default 0.
 *     @type int        $comment_parent       ID of this comment's parent, if any. Default 0.
 *     @type int        $comment_post_ID      ID of the post that relates to the comment, if any.
 *                                            Default 0.
 *     @type string     $comment_type         Comment type. Default 'comment'.
 *     @type array      $comment_meta         Optional. Array of key/value pairs to be stored in commentmeta for the
 *                                            new comment.
 *     @type int        $user_id              ID of the user who submitted the comment. Default 0.
 * }
 * @return int|false The new comment's ID on success, false on failure.
 */
function wp_insert_comment( $commentdata ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Fires immediately after a comment is inserted into the database.
	 *
	 * @since WP 2.8.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param int        $id      The comment ID.
	 * @param WP_Comment $comment Comment object.
	 */
	do_action_deprecated(
		'wp_insert_comment',
		array( 0, null ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return false;
}

/**
 * Filters and sanitizes comment data.
 *
 * Sets the comment data 'filtered' field to true when finished. This can be
 * checked as to whether the comment should be filtered and to keep from
 * filtering the same comment more than once.
 *
 * @since WP 2.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param array $commentdata Contains information on the comment.
 * @return array Parsed comment information.
 */
function wp_filter_comment( $commentdata ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the comment author's user ID before it is set.
	 *
	 * The first time this filter is evaluated, `user_ID` is checked
	 * (for back-compat), followed by the standard `user_id` value.
	 *
	 * @since WP 1.5.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param int $user_id The comment author's user ID.
	 */
	apply_filters_deprecated(
		'pre_user_id',
		array( 0 ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	/**
	 * Filters the comment author's browser user agent before it is set.
	 *
	 * @since WP 1.5.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string $comment_agent The comment author's browser user agent.
	 */
	apply_filters_deprecated(
		'pre_comment_user_agent',
		array( '' ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	/** This filter is documented in wp-includes/comment.php */
	apply_filters_deprecated(
		'pre_comment_author_name',
		array( '' ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	/**
	 * Filters the comment content before it is set.
	 *
	 * @since WP 1.5.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string $comment_content The comment content.
	 */
	apply_filters_deprecated(
		'pre_comment_content',
		array( '' ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	/**
	 * Filters the comment author's IP address before it is set.
	 *
	 * @since WP 1.5.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string $comment_author_ip The comment author's IP address.
	 */
	apply_filters_deprecated(
		'pre_comment_user_ip',
		array( '' ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	/** This filter is documented in wp-includes/comment.php */
	apply_filters_deprecated(
		'pre_comment_author_url',
		array( '' ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	/** This filter is documented in wp-includes/comment.php */
	apply_filters_deprecated(
		'pre_comment_author_email',
		array( '' ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return array();
}

/**
 * Determines whether a comment should be blocked because of comment flood.
 *
 * @since WP 2.1.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param bool $block            Whether plugin has already blocked comment.
 * @param int  $time_lastcomment Timestamp for last comment.
 * @param int  $time_newcomment  Timestamp for new comment.
 * @return bool Whether comment should be blocked.
 */
function wp_throttle_comment_flood( $block, $time_lastcomment, $time_newcomment ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return false;
}

/**
 * Adds a new comment to the database.
 *
 * Filters new comment to ensure that the fields are sanitized and valid before
 * inserting comment into database. Calls {@see 'comment_post'} action with comment ID
 * and whether comment is approved by WordPress. Also has {@see 'preprocess_comment'}
 * filter for processing the comment data before the function handles it.
 *
 * We use `REMOTE_ADDR` here directly. If you are behind a proxy, you should ensure
 * that it is properly set, such as in wp-config.php, for your environment.
 *
 * @since WP 1.5.0
 * @since WP 4.3.0 Introduced the `comment_agent` and `comment_author_IP` arguments.
 * @since WP 4.7.0 The `$avoid_die` parameter was added, allowing the function
 *              to return a WP_Error object instead of dying.
 * @since WP 5.5.0 The `$avoid_die` parameter was renamed to `$wp_error`.
 * @since WP 5.5.0 Introduced the `comment_type` argument.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @see wp_insert_comment()
 *
 * @param array $commentdata {
 *     Comment data.
 *
 *     @type string $comment_author       The name of the comment author.
 *     @type string $comment_author_email The comment author email address.
 *     @type string $comment_author_url   The comment author URL.
 *     @type string $comment_content      The content of the comment.
 *     @type string $comment_date         The date the comment was submitted. Default is the current time.
 *     @type string $comment_date_gmt     The date the comment was submitted in the GMT timezone.
 *                                        Default is `$comment_date` in the GMT timezone.
 *     @type string $comment_type         Comment type. Default 'comment'.
 *     @type int    $comment_parent       The ID of this comment's parent, if any. Default 0.
 *     @type int    $comment_post_ID      The ID of the post that relates to the comment.
 *     @type int    $user_id              The ID of the user who submitted the comment. Default 0.
 *     @type int    $user_ID              Kept for backward-compatibility. Use `$user_id` instead.
 *     @type string $comment_agent        Comment author user agent. Default is the value of 'HTTP_USER_AGENT'
 *                                        in the `$_SERVER` superglobal sent in the original request.
 *     @type string $comment_author_IP    Comment author IP address in IPv4 format. Default is the value of
 *                                        'REMOTE_ADDR' in the `$_SERVER` superglobal sent in the original request.
 * }
 * @param bool  $wp_error Should errors be returned as WP_Error objects instead of
 *                        executing wp_die()? Default false.
 * @return int|false|WP_Error The ID of the comment on success, false or WP_Error on failure.
 */
function wp_new_comment( $commentdata, $wp_error = false ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters a comment's data before it is sanitized and inserted into the database.
	 *
	 * @since WP 1.5.0
	 * @since WP 5.6.0 Comment data includes the `comment_agent` and `comment_author_IP` values.
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param array $commentdata Comment data.
	 */
	apply_filters_deprecated(
		'preprocess_comment',
		array( array() ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	/**
	 * Fires immediately after a comment is inserted into the database.
	 *
	 * @since WP 1.2.0
	 * @since WP 4.5.0 The `$commentdata` parameter was added.
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param int        $comment_id       The comment ID.
	 * @param int|string $comment_approved 1 if the comment is approved, 0 if not, 'spam' if spam.
	 * @param array      $commentdata      Comment data.
	 */
	do_action_deprecated(
		'comment_post',
		array( 0, 0, array() ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return false;
}

/**
 * Sends a comment moderation notification to the comment moderator.
 *
 * @since WP 4.4.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int $comment_id ID of the comment.
 * @return bool True on success, false on failure.
 */
function wp_new_comment_notify_moderator( $comment_id ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return false;
}

/**
 * Sends a notification of a new comment to the post author.
 *
 * @since WP 4.4.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * Uses the {@see 'notify_post_author'} filter to determine whether the post author
 * should be notified when a new comment is added, overriding site setting.
 *
 * @param int $comment_id Comment ID.
 * @return bool True on success, false on failure.
 */
function wp_new_comment_notify_postauthor( $comment_id ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters whether to send the post author new comment notification emails,
	 * overriding the site setting.
	 *
	 * @since WP 4.4.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param bool $maybe_notify Whether to notify the post author about the new comment.
	 * @param int  $comment_id   The ID of the comment for the notification.
	 */
	apply_filters_deprecated(
		'notify_post_author',
		array( false, 1 ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return false;
}

/**
 * Sets the status of a comment.
 *
 * The {@see 'wp_set_comment_status'} action is called after the comment is handled.
 * If the comment status is not in the list, then false is returned.
 *
 * @since WP 1.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int|WP_Comment $comment_id     Comment ID or WP_Comment object.
 * @param string         $comment_status New comment status, either 'hold', 'approve', 'spam', or 'trash'.
 * @param bool           $wp_error       Whether to return a WP_Error object if there is a failure. Default false.
 * @return bool|WP_Error True on success, false or WP_Error on failure.
 */
function wp_set_comment_status( $comment_id, $comment_status, $wp_error = false ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Fires immediately after transitioning a comment's status from one to another in the database
	 * and removing the comment from the object cache, but prior to all status transition hooks.
	 *
	 * @since WP 1.5.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string $comment_id     Comment ID as a numeric string.
	 * @param string $comment_status Current comment status. Possible values include
	 *                               'hold', '0', 'approve', '1', 'spam', and 'trash'.
	 */
	do_action_deprecated(
		'wp_set_comment_status',
		array( 0, '' ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return false;
}

/**
 * Updates an existing comment in the database.
 *
 * Filters the comment and makes sure certain fields are valid before updating.
 *
 * @since WP 2.0.0
 * @since WP 4.9.0 Add updating comment meta during comment update.
 * @since WP 5.5.0 The `$wp_error` parameter was added.
 * @since WP 5.5.0 The return values for an invalid comment or post ID
 *              were changed to false instead of 0.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param array $commentarr Contains information on the comment.
 * @param bool  $wp_error   Optional. Whether to return a WP_Error on failure. Default false.
 * @return int|false|WP_Error The value 1 if the comment was updated, 0 if not updated.
 *                            False or a WP_Error object on failure.
 */
function wp_update_comment( $commentarr, $wp_error = false ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the comment content before it is updated in the database.
	 *
	 * @since WP 1.5.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string $comment_content The comment data.
	 */
	apply_filters_deprecated(
		'comment_save_pre',
		array( '' ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	/**
	 * Filters the comment data immediately before it is updated in the database.
	 *
	 * Note: data being passed to the filter is already unslashed.
	 *
	 * @since WP 4.7.0
	 * @since WP 5.5.0 Returning a WP_Error value from the filter will short-circuit comment update
	 *              and allow skipping further processing.
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param array|WP_Error $data       The new, processed comment data, or WP_Error.
	 * @param array          $comment    The old, unslashed comment data.
	 * @param array          $commentarr The new, raw comment data.
	 */
	apply_filters_deprecated(
		'wp_update_comment_data',
		array( array(), array(), array() ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	/**
	 * Fires immediately after a comment is updated in the database.
	 *
	 * The hook also fires immediately before comment status transition hooks are fired.
	 *
	 * @since WP 1.2.0
	 * @since WP 4.6.0 Added the `$data` parameter.
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param int   $comment_id The comment ID.
	 * @param array $data       Comment data.
	 */
	do_action_deprecated(
		'edit_comment',
		array( 0, array() ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return false;
}

/**
 * Determines whether to defer comment counting.
 *
 * When setting $defer to true, all post comment counts will not be updated
 * until $defer is set to false. When $defer is set to false, then all
 * previously deferred updated post comment counts will then be automatically
 * updated without having to call wp_update_comment_count() after.
 *
 * @since WP 2.5.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param bool $defer
 * @return bool
 */
function wp_defer_comment_counting( $defer = null ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return false;
}

/**
 * Updates the comment count for post(s).
 *
 * When $do_deferred is false (is by default) and the comments have been set to
 * be deferred, the post_id will be added to a queue, which will be updated at a
 * later date and only updated once per post ID.
 *
 * If the comments have not be set up to be deferred, then the post will be
 * updated. When $do_deferred is set to true, then all previous deferred post
 * IDs will be updated along with the current $post_id.
 *
 * @since WP 2.1.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @see wp_update_comment_count_now() For what could cause a false return value
 *
 * @param int|null $post_id     Post ID.
 * @param bool     $do_deferred Optional. Whether to process previously deferred
 *                              post comment counts. Default false.
 * @return bool|void True on success, false on failure or if post with ID does
 *                   not exist.
 */
function wp_update_comment_count( $post_id, $do_deferred = false ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return false;
}

/**
 * Updates the comment count for the post.
 *
 * @since WP 2.5.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int $post_id Post ID
 * @return bool True on success, false if the post does not exist.
 */
function wp_update_comment_count_now( $post_id ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters a post's comment count before it is updated in the database.
	 *
	 * @since WP 4.5.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param int|null $new     The new comment count. Default null.
	 * @param int      $old     The old comment count.
	 * @param int      $post_id Post ID.
	 */
	apply_filters_deprecated(
		'pre_wp_update_comment_count_now',
		array( 0, 0, 0 ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	/**
	 * Fires immediately after a post's comment count is updated in the database.
	 *
	 * @since WP 2.3.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param int $post_id Post ID.
	 * @param int $new     The new comment count.
	 * @param int $old     The old comment count.
	 */
	do_action_deprecated(
		'wp_update_comment_count',
		array( 0, 0, 0 ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	/** This action is documented in wp-includes/post.php */
	do_action_deprecated(
		'edit_post',
		array( 0, null ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return false;
}

/**
 * Finds a pingback server URI based on the given URL.
 *
 * Checks the HTML for the rel="pingback" link and X-Pingback headers. It does
 * a check for the X-Pingback headers first and returns that, if available.
 * The check for the rel="pingback" has more overhead than just the header.
 *
 * @since WP 1.5.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string $url        URL to ping.
 * @param string $deprecated Not Used.
 * @return string|false String containing URI on success, false on failure.
 */
function discover_pingback_server_uri( $url, $deprecated = '' ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return false;
}

/**
 * Performs all pingbacks, enclosures, trackbacks, and sends to pingback services.
 *
 * @since WP 2.1.0
 * @since WP 5.6.0 Introduced `do_all_pings` action hook for individual services.
 * @deprecated 1.0.0 Retraceur fork.
 */
function do_all_pings() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Fires immediately after the `do_pings` event to hook services individually.
	 *
	 * @since WP 5.6.0
	 * @deprecated 1.0.0 Retraceur fork.
	 */
	do_action_deprecated(
		'do_all_pings',
		array(),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);
}

/**
 * Performs all pingbacks.
 *
 * @since WP 5.6.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function do_all_pingbacks() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Performs all enclosures.
 *
 * @since WP 5.6.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function do_all_enclosures() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Performs all trackbacks.
 *
 * @since WP 5.6.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function do_all_trackbacks() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Performs trackbacks.
 *
 * @since WP 1.5.0
 * @since WP 4.7.0 `$post` can be a WP_Post object.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @global wpdb $wpdb WP database abstraction object.
 *
 * @param int|WP_Post $post Post ID or object to do trackbacks on.
 * @return void|false Returns false on failure.
 */
function do_trackbacks( $post ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Sends pings to all of the ping site services.
 *
 * @since WP 1.2.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int $post_id Post ID.
 * @return int Same post ID as provided.
 */
function generic_ping( $post_id = 0 ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return $post_id;
}

/**
 * Pings back the links found in a post.
 *
 * @since WP 0.71
 * @since WP 4.7.0 `$post` can be a WP_Post object.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string      $content Post content to check for links. If empty will retrieve from post.
 * @param int|WP_Post $post    Post ID or object.
 */
function pingback( $content, $post ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Fires just before pinging back links found in a post.
	 *
	 * @since WP 2.0.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string[] $post_links Array of link URLs to be checked (passed by reference).
	 * @param string[] $pung       Array of link URLs already pinged (passed by reference).
	 * @param int      $post_id    The post ID.
	 */
	do_action_deprecated(
		'pre_ping',
		array( array(), array(), 0 ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	/**
	 * Filters the user agent sent when pinging-back a URL.
	 *
	 * @since WP 2.9.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string $concat_useragent    The user agent concatenated with ' -- WP/'
	 *                                    and the WP version.
	 * @param string $useragent           The useragent.
	 * @param string $pingback_server_url The server URL being linked to.
	 * @param string $pagelinkedto        URL of page linked to.
	 * @param string $pagelinkedfrom      URL of page linked from.
	 */
	apply_filters_deprecated(
		'pingback_useragent',
		array( '', '', '', '', '' ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);
}

/**
 * Checks whether blog is public before returning sites.
 *
 * @since WP 2.1.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param mixed $sites Will return if blog is public, will not return if not public.
 * @return mixed Empty string if blog is not public, returns $sites, if site is public.
 */
function privacy_ping_filter( $sites ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return '';
}

/**
 * Sends a Trackback.
 *
 * Updates database when sending trackback to prevent duplicates.
 *
 * @since WP 0.71
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string $trackback_url URL to send trackbacks.
 * @param string $title         Title of post.
 * @param string $excerpt       Excerpt of post.
 * @param int    $post_id       Post ID.
 * @return int|false|void Database query from update.
 */
function trackback( $trackback_url, $title, $excerpt, $post_id ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Sends a pingback.
 *
 * @since WP 1.2.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string $server Host of blog to connect to.
 * @param string $path Path to send the ping.
 */
function weblog_ping( $server = '', $path = '' ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Default filter attached to pingback_ping_source_uri to validate the pingback's Source URI.
 *
 * @since WP 3.5.1
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @see wp_http_validate_url()
 *
 * @param string $source_uri
 * @return string
 */
function pingback_ping_source_uri( $source_uri ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Default filter attached to xmlrpc_pingback_error.
 *
 * Returns a generic pingback error code unless the error code is 48,
 * which reports that the pingback is already registered.
 *
 * @since WP 3.5.1
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @link https://www.hixie.ch/specs/pingback/pingback#TOC3
 *
 * @param IXR_Error $ixr_error
 * @return IXR_Error
 */
function xmlrpc_pingback_error( $ixr_error ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Removes a comment from the object cache.
 *
 * @since WP 2.3.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int|array $ids Comment ID or an array of comment IDs to remove from cache.
 */
function clean_comment_cache( $ids ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Fires immediately after a comment has been removed from the object cache.
	 *
	 * @since WP 4.5.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param int $id Comment ID.
	 */
	do_action_deprecated(
		'clean_comment_cache',
		array( 0 ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);
}

/**
 * Updates the comment cache of given comments.
 *
 * Will add the comments in $comments to the cache. If comment ID already exists
 * in the comment cache then it will not be updated. The comment is added to the
 * cache using the comment group with the key using the ID of the comments.
 *
 * @since WP 2.3.0
 * @since WP 4.4.0 Introduced the `$update_meta_cache` parameter.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param WP_Comment[] $comments          Array of comment objects
 * @param bool         $update_meta_cache Whether to update commentmeta cache. Default true.
 */
function update_comment_cache( $comments, $update_meta_cache = true ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Adds any comments from the given IDs to the cache that do not already exist in cache.
 *
 * @since WP 4.4.0
 * @since WP 6.1.0 This function is no longer marked as "private".
 * @since WP 6.3.0 Use wp_lazyload_comment_meta() for lazy-loading of comment meta.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @see update_comment_cache()
 *
 * @param int[] $comment_ids       Array of comment IDs.
 * @param bool  $update_meta_cache Optional. Whether to update the meta cache. Default true.
 */
function _prime_comment_caches( $comment_ids, $update_meta_cache = true ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Closes comments on old posts on the fly, without any extra DB queries. Hooked to the_posts.
 *
 * @since WP 2.7.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @access private
 *
 * @param WP_Post  $posts Post data object.
 * @param WP_Query $query Query object.
 * @return array
 */
function _close_comments_for_old_posts( $posts, $query ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the list of post types to automatically close comments for.
	 *
	 * @since WP 3.2.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string[] $post_types An array of post type names.
	 */
	apply_filters_deprecated(
		'close_comments_for_post_types',
		array( array( 'post' ) ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return array();
}

/**
 * Closes comments on an old post. Hooked to comments_open and pings_open.
 *
 * @since WP 2.7.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @access private
 *
 * @param bool $open    Comments open or closed.
 * @param int  $post_id Post ID.
 * @return bool $open
 */
function _close_comments_for_old_post( $open, $post_id ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return false;
}

/**
 * Handles the submission of a comment, usually posted to wp-comments-post.php via a comment form.
 *
 * This function expects unslashed data, as opposed to functions such as `wp_new_comment()` which
 * expect slashed data.
 *
 * @since WP 4.4.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param array $comment_data {
 *     Comment data.
 *
 *     @type string|int $comment_post_ID             The ID of the post that relates to the comment.
 *     @type string     $author                      The name of the comment author.
 *     @type string     $email                       The comment author email address.
 *     @type string     $url                         The comment author URL.
 *     @type string     $comment                     The content of the comment.
 *     @type string|int $comment_parent              The ID of this comment's parent, if any. Default 0.
 *     @type string     $_wp_unfiltered_html_comment The nonce value for allowing unfiltered HTML.
 * }
 * @return WP_Comment|WP_Error A WP_Comment object on success, a WP_Error object on failure.
 */
function wp_handle_comment_submission( $comment_data ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Fires when a comment reply is attempted to an unapproved comment.
	 *
	 * @since WP 6.2.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param int $comment_post_id Post ID.
	 * @param int $comment_parent  Parent comment ID.
	 */
	do_action_deprecated(
		'comment_reply_to_unapproved_comment',
		array( 0, 0 ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	/**
	 * Fires when a comment is attempted on a post that does not exist.
	 *
	 * @since WP 1.5.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param int $comment_post_id Post ID.
	 */
	do_action_deprecated(
		'comment_id_not_found',
		array( 0 ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	/**
	 * Fires when a comment is attempted on a post that has comments closed.
	 *
	 * @since WP 1.5.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param int $comment_post_id Post ID.
	 */
	do_action_deprecated(
		'comment_closed',
		array( 0 ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	/**
	 * Fires when a comment is attempted on a trashed post.
	 *
	 * @since WP 2.9.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param int $comment_post_id Post ID.
	 */
	do_action_deprecated(
		'comment_on_trash',
		array( 0 ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	/**
	 * Fires when a comment is attempted on a post in draft mode.
	 *
	 * @since WP 1.5.1
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param int $comment_post_id Post ID.
	 */
	do_action_deprecated(
		'comment_on_draft',
		array( 0 ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	/**
	 * Fires when a comment is attempted on a password-protected post.
	 *
	 * @since WP 2.9.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param int $comment_post_id Post ID.
	 */
	do_action_deprecated(
		'comment_on_password_protected',
		array( 0 ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	/**
	 * Fires before a comment is posted.
	 *
	 * @since WP 2.8.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param int $comment_post_id Post ID.
	 */
	do_action_deprecated(
		'pre_comment_on_post',
		array( 0 ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	/**
	 * Filters whether an empty comment should be allowed.
	 *
	 * @since WP 5.1.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param bool  $allow_empty_comment Whether to allow empty comments. Default false.
	 * @param array $commentdata         Array of comment data to be sent to wp_insert_comment().
	 */
	apply_filters_deprecated(
		'allow_empty_comment',
		array( false, array() ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return null;
}

/**
 * Finds and exports personal data associated with an email address from the comments table.
 *
 * @since WP 4.9.6
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string $email_address The comment author email address.
 * @param int    $page          Comment page number.
 * @return array {
 *     An array of personal data.
 *
 *     @type array[] $data An array of personal data arrays.
 *     @type bool    $done Whether the exporter is finished.
 * }
 */
function wp_comments_personal_data_exporter( $email_address, $page = 1 ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return array();
}

/**
 * Erases personal data associated with an email address from the comments table.
 *
 * @since WP 4.9.6
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string $email_address The comment author email address.
 * @param int    $page          Comment page number.
 * @return array {
 *     Data removal results.
 *
 *     @type bool     $items_removed  Whether items were actually removed.
 *     @type bool     $items_retained Whether items were retained.
 *     @type string[] $messages       An array of messages to add to the personal data export file.
 *     @type bool     $done           Whether the eraser is finished.
 * }
 */
function wp_comments_personal_data_eraser( $email_address, $page = 1 ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters whether to anonymize the comment.
	 *
	 * @since WP 4.9.6
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param bool|string $anon_message       Whether to apply the comment anonymization (bool) or a custom
	 *                                        message (string). Default true.
	 * @param WP_Comment  $comment            WP_Comment object.
	 * @param array       $anonymized_comment Anonymized comment data.
	 */
	apply_filters_deprecated(
		'wp_anonymize_comment',
		array( false, null, array() ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return array();
}

/**
 * Retrieves the author of the current comment.
 *
 * If the comment has an empty comment_author field, then 'Anonymous' person is
 * assumed.
 *
 * @since WP 1.5.0
 * @since WP 4.4.0 Added the ability for `$comment_id` to also accept a WP_Comment object.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int|WP_Comment $comment_id Optional. WP_Comment or the ID of the comment for which to retrieve the author.
 *                                   Default current comment.
 * @return string The comment author
 */
function get_comment_author( $comment_id = 0 ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the returned comment author name.
	 *
	 * @since WP 1.5.0
	 * @since WP 4.1.0 The `$comment_id` and `$comment` parameters were added.
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string     $comment_author The comment author's username.
	 * @param string     $comment_id     The comment ID as a numeric string.
	 * @param WP_Comment $comment        The comment object.
	 */
	apply_filters_deprecated(
		'get_comment_author',
		array( '', '', null ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return '';
}

/**
 * Displays the author of the current comment.
 *
 * @since WP 0.71
 * @since WP 4.4.0 Added the ability for `$comment_id` to also accept a WP_Comment object.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int|WP_Comment $comment_id Optional. WP_Comment or the ID of the comment for which to print the author.
 *                                   Default current comment.
 */
function comment_author( $comment_id = 0 ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the comment author's name for display.
	 *
	 * @since WP 1.2.0
	 * @since WP 4.1.0 The `$comment_id` parameter was added.
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string $comment_author The comment author's username.
	 * @param string $comment_id     The comment ID as a numeric string.
	 */
	apply_filters_deprecated(
		'comment_author',
		array( '', '' ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);
}

/**
 * Retrieves the email of the author of the current comment.
 *
 * @since WP 1.5.0
 * @since WP 4.4.0 Added the ability for `$comment_id` to also accept a WP_Comment object.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int|WP_Comment $comment_id Optional. WP_Comment or the ID of the comment for which to get the author's email.
 *                                   Default current comment.
 * @return string The current comment author's email
 */
function get_comment_author_email( $comment_id = 0 ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the comment author's returned email address.
	 *
	 * @since WP 1.5.0
	 * @since WP 4.1.0 The `$comment_id` and `$comment` parameters were added.
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string     $comment_author_email The comment author's email address.
	 * @param string     $comment_id           The comment ID as a numeric string.
	 * @param WP_Comment $comment              The comment object.
	 */
	apply_filters_deprecated(
		'get_comment_author_email',
		array( '', '', null ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return '';
}

/**
 * Displays the email of the author of the current global $comment.
 *
 * Care should be taken to protect the email address and assure that email
 * harvesters do not capture your commenter's email address. Most assume that
 * their email address will not appear in raw form on the site. Doing so will
 * enable anyone, including those that people don't want to get the email
 * address and use it for their own means good and bad.
 *
 * @since WP 0.71
 * @since WP 4.4.0 Added the ability for `$comment_id` to also accept a WP_Comment object.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int|WP_Comment $comment_id Optional. WP_Comment or the ID of the comment for which to print the author's email.
 *                                   Default current comment.
 */
function comment_author_email( $comment_id = 0 ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the comment author's email for display.
	 *
	 * @since WP 1.2.0
	 * @since WP 4.1.0 The `$comment_id` parameter was added.
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string $comment_author_email The comment author's email address.
	 * @param string $comment_id           The comment ID as a numeric string.
	 */
	apply_filters_deprecated(
		'author_email',
		array( '', '' ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);
}

/**
 * Displays the HTML email link to the author of the current comment.
 *
 * Care should be taken to protect the email address and assure that email
 * harvesters do not capture your commenter's email address. Most assume that
 * their email address will not appear in raw form on the site. Doing so will
 * enable anyone, including those that people don't want to get the email
 * address and use it for their own means good and bad.
 *
 * @since WP 0.71
 * @since WP 4.6.0 Added the `$comment` parameter.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string         $link_text Optional. Text to display instead of the comment author's email address.
 *                                  Default empty.
 * @param string         $before    Optional. Text or HTML to display before the email link. Default empty.
 * @param string         $after     Optional. Text or HTML to display after the email link. Default empty.
 * @param int|WP_Comment $comment   Optional. Comment ID or WP_Comment object. Default is the current comment.
 */
function comment_author_email_link( $link_text = '', $before = '', $after = '', $comment = null ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Returns the HTML email link to the author of the current comment.
 *
 * Care should be taken to protect the email address and assure that email
 * harvesters do not capture your commenter's email address. Most assume that
 * their email address will not appear in raw form on the site. Doing so will
 * enable anyone, including those that people don't want to get the email
 * address and use it for their own means good and bad.
 *
 * @since WP 2.7.0
 * @since WP 4.6.0 Added the `$comment` parameter.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string         $link_text Optional. Text to display instead of the comment author's email address.
 *                                  Default empty.
 * @param string         $before    Optional. Text or HTML to display before the email link. Default empty.
 * @param string         $after     Optional. Text or HTML to display after the email link. Default empty.
 * @param int|WP_Comment $comment   Optional. Comment ID or WP_Comment object. Default is the current comment.
 * @return string HTML markup for the comment author email link. By default, the email address is obfuscated
 *                via the {@see 'comment_email'} filter with antispambot().
 */
function get_comment_author_email_link( $link_text = '', $before = '', $after = '', $comment = null ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the comment author's email for display.
	 *
	 * Care should be taken to protect the email address and assure that email
	 * harvesters do not capture your commenter's email address.
	 *
	 * @since WP 1.2.0
	 * @since WP 4.1.0 The `$comment` parameter was added.
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string     $comment_author_email The comment author's email address.
	 * @param WP_Comment $comment              The comment object.
	 */
	apply_filters_deprecated(
		'comment_email',
		array( '', null ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return '';
}

/**
 * Retrieves the HTML link to the URL of the author of the current comment.
 *
 * Both get_comment_author_url() and get_comment_author() rely on get_comment(),
 * which falls back to the global comment variable if the $comment_id argument is empty.
 *
 * @since WP 1.5.0
 * @since WP 4.4.0 Added the ability for `$comment_id` to also accept a WP_Comment object.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int|WP_Comment $comment_id Optional. WP_Comment or the ID of the comment for which to get the author's link.
 *                                   Default current comment.
 * @return string The comment author name or HTML link for author's URL.
 */
function get_comment_author_link( $comment_id = 0 ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the rel attributes of the comment author's link.
	 *
	 * @since WP 6.2.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string[]   $rel_parts An array of strings representing the rel tags
	 *                              which will be joined into the anchor's rel attribute.
	 * @param WP_Comment $comment   The comment object.
	 */
	apply_filters_deprecated(
		'comment_author_link_rel',
		array( array(), null ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	/**
	 * Filters the comment author's link for display.
	 *
	 * @since WP 1.5.0
	 * @since WP 4.1.0 The `$comment_author` and `$comment_id` parameters were added.
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string $comment_author_link The HTML-formatted comment author link.
	 *                                    Empty for an invalid URL.
	 * @param string $comment_author      The comment author's username.
	 * @param string $comment_id          The comment ID as a numeric string.
	 */
	apply_filters_deprecated(
		'get_comment_author_link',
		array( '', '', '' ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return '';
}

/**
 * Displays the HTML link to the URL of the author of the current comment.
 *
 * @since WP 0.71
 * @since WP 4.4.0 Added the ability for `$comment_id` to also accept a WP_Comment object.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int|WP_Comment $comment_id Optional. WP_Comment or the ID of the comment for which to print the author's link.
 *                                   Default current comment.
 */
function comment_author_link( $comment_id = 0 ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Retrieves the IP address of the author of the current comment.
 *
 * @since WP 1.5.0
 * @since WP 4.4.0 Added the ability for `$comment_id` to also accept a WP_Comment object.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int|WP_Comment $comment_id Optional. WP_Comment or the ID of the comment for which to get the author's IP address.
 *                                   Default current comment.
 * @return string Comment author's IP address, or an empty string if it's not available.
 */
function get_comment_author_IP( $comment_id = 0 ) { // phpcs:ignore WordPress.NamingConventions.ValidFunctionName.FunctionNameInvalid
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the comment author's returned IP address.
	 *
	 * @since WP 1.5.0
	 * @since WP 4.1.0 The `$comment_id` and `$comment` parameters were added.
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string     $comment_author_ip The comment author's IP address, or an empty string if it's not available.
	 * @param string     $comment_id        The comment ID as a numeric string.
	 * @param WP_Comment $comment           The comment object.
	 */
	apply_filters_deprecated(
		'get_comment_author_IP', // phpcs:ignore WordPress.NamingConventions.ValidHookName.NotLowercase
		array( '', '', null ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);
}

/**
 * Displays the IP address of the author of the current comment.
 *
 * @since WP 0.71
 * @since WP 4.4.0 Added the ability for `$comment_id` to also accept a WP_Comment object.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int|WP_Comment $comment_id Optional. WP_Comment or the ID of the comment for which to print the author's IP address.
 *                                   Default current comment.
 */
function comment_author_IP( $comment_id = 0 ) { // phpcs:ignore WordPress.NamingConventions.ValidFunctionName.FunctionNameInvalid
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Retrieves the URL of the author of the current comment, not linked.
 *
 * @since WP 1.5.0
 * @since WP 4.4.0 Added the ability for `$comment_id` to also accept a WP_Comment object.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int|WP_Comment $comment_id Optional. WP_Comment or the ID of the comment for which to get the author's URL.
 *                                   Default current comment.
 * @return string Comment author URL, if provided, an empty string otherwise.
 */
function get_comment_author_url( $comment_id = 0 ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the comment author's URL.
	 *
	 * @since WP 1.5.0
	 * @since WP 4.1.0 The `$comment_id` and `$comment` parameters were added.
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string          $comment_author_url The comment author's URL, or an empty string.
	 * @param string|int      $comment_id         The comment ID as a numeric string, or 0 if not found.
	 * @param WP_Comment|null $comment            The comment object, or null if not found.
	 */
	apply_filters_deprecated(
		'get_comment_author_url',
		array( '', '', null ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return '';
}

/**
 * Displays the URL of the author of the current comment, not linked.
 *
 * @since WP 0.71
 * @since WP 4.4.0 Added the ability for `$comment_id` to also accept a WP_Comment object.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int|WP_Comment $comment_id Optional. WP_Comment or the ID of the comment for which to print the author's URL.
 *                                   Default current comment.
 */
function comment_author_url( $comment_id = 0 ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the comment author's URL for display.
	 *
	 * @since WP 1.2.0
	 * @since WP 4.1.0 The `$comment_id` parameter was added.
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string $comment_author_url The comment author's URL.
	 * @param string $comment_id         The comment ID as a numeric string.
	 */
	apply_filters_deprecated(
		'comment_url',
		array( '', '' ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);
}

/**
 * Retrieves the HTML link of the URL of the author of the current comment.
 *
 * $link_text parameter is only used if the URL does not exist for the comment
 * author. If the URL does exist then the URL will be used and the $link_text
 * will be ignored.
 *
 * Encapsulate the HTML link between the $before and $after. So it will appear
 * in the order of $before, link, and finally $after.
 *
 * @since WP 1.5.0
 * @since WP 4.6.0 Added the `$comment` parameter.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string         $link_text Optional. The text to display instead of the comment
 *                                  author's email address. Default empty.
 * @param string         $before    Optional. The text or HTML to display before the email link.
 *                                  Default empty.
 * @param string         $after     Optional. The text or HTML to display after the email link.
 *                                  Default empty.
 * @param int|WP_Comment $comment   Optional. Comment ID or WP_Comment object.
 *                                  Default is the current comment.
 * @return string The HTML link between the $before and $after parameters.
 */
function get_comment_author_url_link( $link_text = '', $before = '', $after = '', $comment = 0 ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the comment author's returned URL link.
	 *
	 * @since WP 1.5.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string $comment_author_url_link The HTML-formatted comment author URL link.
	 */
	apply_filters_deprecated(
		'get_comment_author_url_link',
		array( '' ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return '';
}

/**
 * Displays the HTML link of the URL of the author of the current comment.
 *
 * @since WP 0.71
 * @since WP 4.6.0 Added the `$comment` parameter.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string         $link_text Optional. Text to display instead of the comment author's
 *                                  email address. Default empty.
 * @param string         $before    Optional. Text or HTML to display before the email link.
 *                                  Default empty.
 * @param string         $after     Optional. Text or HTML to display after the email link.
 *                                  Default empty.
 * @param int|WP_Comment $comment   Optional. Comment ID or WP_Comment object.
 *                                  Default is the current comment.
 */
function comment_author_url_link( $link_text = '', $before = '', $after = '', $comment = 0 ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Generates semantic classes for each comment element.
 *
 * @since WP 2.7.0
 * @since WP 4.4.0 Added the ability for `$comment` to also accept a WP_Comment object.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string|string[] $css_class Optional. One or more classes to add to the class list.
 *                                   Default empty.
 * @param int|WP_Comment  $comment   Optional. Comment ID or WP_Comment object. Default current comment.
 * @param int|WP_Post     $post      Optional. Post ID or WP_Post object. Default current post.
 * @param bool            $display   Optional. Whether to print or return the output.
 *                                   Default true.
 * @return void|string Void if `$display` argument is true, comment classes if `$display` is false.
 */
function comment_class( $css_class = '', $comment = null, $post = null, $display = true ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Returns the classes for the comment div as an array.
 *
 * @since WP 2.7.0
 * @since WP 4.4.0 Added the ability for `$comment_id` to also accept a WP_Comment object.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @global int $comment_alt
 * @global int $comment_depth
 * @global int $comment_thread_alt
 *
 * @param string|string[] $css_class  Optional. One or more classes to add to the class list.
 *                                    Default empty.
 * @param int|WP_Comment  $comment_id Optional. Comment ID or WP_Comment object. Default current comment.
 * @param int|WP_Post     $post       Optional. Post ID or WP_Post object. Default current post.
 * @return string[] An array of classes.
 */
function get_comment_class( $css_class = '', $comment_id = null, $post = null ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the returned CSS classes for the current comment.
	 *
	 * @since WP 2.7.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string[]    $classes    An array of comment classes.
	 * @param string[]    $css_class  An array of additional classes added to the list.
	 * @param string      $comment_id The comment ID as a numeric string.
	 * @param WP_Comment  $comment    The comment object.
	 * @param int|WP_Post $post       The post ID or WP_Post object.
	 */
	apply_filters_deprecated(
		'comment_class',
		array( array(), array(), '', null, 0 ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return array();
}

/**
 * Retrieves the comment date of the current comment.
 *
 * @since WP 1.5.0
 * @since WP 4.4.0 Added the ability for `$comment_id` to also accept a WP_Comment object.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string         $format     Optional. PHP date format. Defaults to the 'date_format' option.
 * @param int|WP_Comment $comment_id Optional. WP_Comment or ID of the comment for which to get the date.
 *                                   Default current comment.
 * @return string The comment's date.
 */
function get_comment_date( $format = '', $comment_id = 0 ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the returned comment date.
	 *
	 * @since WP 1.5.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string|int $comment_date Formatted date string or Unix timestamp.
	 * @param string     $format       PHP date format.
	 * @param WP_Comment $comment      The comment object.
	 */
	apply_filters_deprecated(
		'get_comment_date',
		array( '', '', null ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return '';
}

/**
 * Displays the comment date of the current comment.
 *
 * @since WP 0.71
 * @since WP 4.4.0 Added the ability for `$comment_id` to also accept a WP_Comment object.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string         $format     Optional. PHP date format. Defaults to the 'date_format' option.
 * @param int|WP_Comment $comment_id WP_Comment or ID of the comment for which to print the date.
 *                                   Default current comment.
 */
function comment_date( $format = '', $comment_id = 0 ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Retrieves the excerpt of the given comment.
 *
 * Returns a maximum of 20 words with an ellipsis appended if necessary.
 *
 * @since WP 1.5.0
 * @since WP 4.4.0 Added the ability for `$comment_id` to also accept a WP_Comment object.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int|WP_Comment $comment_id Optional. WP_Comment or ID of the comment for which to get the excerpt.
 *                                   Default current comment.
 * @return string The possibly truncated comment excerpt.
 */
function get_comment_excerpt( $comment_id = 0 ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the maximum number of words used in the comment excerpt.
	 *
	 * @since WP 4.4.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param int $comment_excerpt_length The amount of words you want to display in the comment excerpt.
	 */
	apply_filters_deprecated(
		'comment_excerpt_length',
		array( 0 ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	/**
	 * Filters the retrieved comment excerpt.
	 *
	 * @since WP 1.5.0
	 * @since WP 4.1.0 The `$comment_id` and `$comment` parameters were added.
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string     $comment_excerpt The comment excerpt text.
	 * @param string     $comment_id      The comment ID as a numeric string.
	 * @param WP_Comment $comment         The comment object.
	 */
	apply_filters_deprecated(
		'get_comment_excerpt',
		array( '', '', null ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return '';
}

/**
 * Displays the excerpt of the current comment.
 *
 * @since WP 1.2.0
 * @since WP 4.4.0 Added the ability for `$comment_id` to also accept a WP_Comment object.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int|WP_Comment $comment_id Optional. WP_Comment or ID of the comment for which to print the excerpt.
 *                                   Default current comment.
 */
function comment_excerpt( $comment_id = 0 ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the comment excerpt for display.
	 *
	 * @since WP 1.2.0
	 * @since WP 4.1.0 The `$comment_id` parameter was added.
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string $comment_excerpt The comment excerpt text.
	 * @param string $comment_id      The comment ID as a numeric string.
	 */
	apply_filters_deprecated(
		'comment_excerpt',
		array( '', '' ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);
}

/**
 * Retrieves the comment ID of the current comment.
 *
 * @since WP 1.5.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @return string The comment ID as a numeric string.
 */
function get_comment_ID() { // phpcs:ignore WordPress.NamingConventions.ValidFunctionName.FunctionNameInvalid
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the returned comment ID.
	 *
	 * @since WP 1.5.0
	 * @since WP 4.1.0 The `$comment` parameter was added.
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string     $comment_id The current comment ID as a numeric string.
	 * @param WP_Comment $comment    The comment object.
	 */
	apply_filters_deprecated(
		'get_comment_ID', // phpcs:ignore WordPress.NamingConventions.ValidHookName.NotLowercase
		array( '', null ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return '';
}

/**
 * Displays the comment ID of the current comment.
 *
 * @since WP 0.71
 * @deprecated 1.0.0 Retraceur fork.
 */
function comment_ID() { // phpcs:ignore WordPress.NamingConventions.ValidFunctionName.FunctionNameInvalid
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Retrieves the link to a given comment.
 *
 * @since WP 1.5.0
 * @since WP 4.4.0 Added the ability for `$comment` to also accept a WP_Comment object. Added `$cpage` argument.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @see get_page_of_comment()
 *
 * @global WP_Rewrite $wp_rewrite      Retraceur rewrite component.
 * @global bool       $in_comment_loop
 *
 * @param WP_Comment|int|null $comment Optional. Comment to retrieve. Default current comment.
 * @param array               $args {
 *     An array of optional arguments to override the defaults.
 *
 *     @type string     $type      Passed to get_page_of_comment().
 *     @type int        $page      Current page of comments, for calculating comment pagination.
 *     @type int        $per_page  Per-page value for comment pagination.
 *     @type int        $max_depth Passed to get_page_of_comment().
 *     @type int|string $cpage     Value to use for the comment's "comment-page" or "cpage" value.
 *                                 If provided, this value overrides any value calculated from `$page`
 *                                 and `$per_page`.
 * }
 * @return string The permalink to the given comment.
 */
function get_comment_link( $comment = null, $args = array() ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the returned single comment permalink.
	 *
	 * @since WP 2.8.0
	 * @since WP 4.4.0 Added the `$cpage` parameter.
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @see get_page_of_comment()
	 *
	 * @param string     $comment_link The comment permalink with '#comment-$id' appended.
	 * @param WP_Comment $comment      The current comment object.
	 * @param array      $args         An array of arguments to override the defaults.
	 * @param int        $cpage        The calculated 'cpage' value.
	 */
	apply_filters_deprecated(
		'get_comment_link',
		array( '', null, array(), 0 ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return '';
}

/**
 * Retrieves the link to the current post comments.
 *
 * @since WP 1.5.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int|WP_Post $post Optional. Post ID or WP_Post object. Default is global $post.
 * @return string The link to the comments.
 */
function get_comments_link( $post = 0 ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the returned post comments permalink.
	 *
	 * @since WP 3.6.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string      $comments_link Post comments permalink with '#comments' appended.
	 * @param int|WP_Post $post          Post ID or WP_Post object.
	 */
	apply_filters_deprecated(
		'get_comments_link',
		array( '', null ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return '';
}

/**
 * Displays the link to the current post comments.
 *
 * @since WP 0.71
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string $deprecated   Not Used.
 * @param string $deprecated_2 Not Used.
 */
function comments_link( $deprecated = '', $deprecated_2 = '' ) {
	if ( ! empty( $deprecated ) ) {
		_deprecated_argument( __FUNCTION__, '0.72' );
	}
	if ( ! empty( $deprecated_2 ) ) {
		_deprecated_argument( __FUNCTION__, '1.3.0' );
	}

	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Retrieves the amount of comments a post has.
 *
 * @since WP 1.5.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int|WP_Post $post Optional. Post ID or WP_Post object. Default is the global `$post`.
 * @return string|int If the post exists, a numeric string representing the number of comments
 *                    the post has, otherwise 0.
 */
function get_comments_number( $post = 0 ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the returned comment count for a post.
	 *
	 * @since WP 1.5.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string|int $comments_number A string representing the number of comments a post has, otherwise 0.
	 * @param int        $post_id Post ID.
	 */
	apply_filters_deprecated(
		'get_comments_number',
		array( '', 0 ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return '';
}

/**
 * Displays the language string for the number of comments the current post has.
 *
 * @since WP 0.71
 * @since WP 5.4.0 The `$deprecated` parameter was changed to `$post`.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string|false $zero Optional. Text for no comments. Default false.
 * @param string|false $one  Optional. Text for one comment. Default false.
 * @param string|false $more Optional. Text for more than one comment. Default false.
 * @param int|WP_Post  $post Optional. Post ID or WP_Post object. Default is the global `$post`.
 */
function comments_number( $zero = false, $one = false, $more = false, $post = 0 ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Displays the language string for the number of comments the current post has.
 *
 * @since WP 4.0.0
 * @since WP 5.4.0 Added the `$post` parameter to allow using the function outside of the loop.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string      $zero Optional. Text for no comments. Default false.
 * @param string      $one  Optional. Text for one comment. Default false.
 * @param string      $more Optional. Text for more than one comment. Default false.
 * @param int|WP_Post $post Optional. Post ID or WP_Post object. Default is the global `$post`.
 * @return string Language string for the number of comments a post has.
 */
function get_comments_number_text( $zero = false, $one = false, $more = false, $post = 0 ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the comments count for display.
	 *
	 * @since WP 1.5.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @see _n()
	 *
	 * @param string $comments_number_text A translatable string formatted based on whether the count
	 *                                     is equal to 0, 1, or 1+.
	 * @param int    $comments_number      The number of post comments.
	 */
	apply_filters_deprecated(
		'comments_number',
		array( '', 0 ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return '';
}

/**
 * Retrieves the text of the current comment.
 *
 * @since WP 1.5.0
 * @since WP 4.4.0 Added the ability for `$comment_id` to also accept a WP_Comment object.
 * @since WP 5.4.0 Added 'In reply to %s.' prefix to child comments in comments feed.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int|WP_Comment $comment_id Optional. WP_Comment or ID of the comment for which to get the text.
 *                                   Default current comment.
 * @param array          $args       Optional. An array of arguments. Default empty array.
 * @return string The comment content.
 */
function get_comment_text( $comment_id = 0, $args = array() ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the text of a comment.
	 *
	 * @since WP 1.5.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string     $comment_text Text of the comment.
	 * @param WP_Comment $comment      The comment object.
	 * @param array      $args         An array of arguments.
	 */
	apply_filters_deprecated(
		'get_comment_text',
		array( '', null, array() ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return '';
}

/**
 * Displays the text of the current comment.
 *
 * @since WP 0.71
 * @since WP 4.4.0 Added the ability for `$comment_id` to also accept a WP_Comment object.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int|WP_Comment $comment_id Optional. WP_Comment or ID of the comment for which to print the text.
 *                                   Default current comment.
 * @param array          $args       Optional. An array of arguments. Default empty array.
 */
function comment_text( $comment_id = 0, $args = array() ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the text of a comment to be displayed.
	 *
	 * @since WP 1.2.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string          $comment_text Text of the comment.
	 * @param WP_Comment|null $comment      The comment object. Null if not found.
	 * @param array           $args         An array of arguments.
	 */
	apply_filters_deprecated(
		'comment_text',
		array( '', null, array() ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);
}

/**
 * Retrieves the comment time of the current comment.
 *
 * @since WP 1.5.0
 * @since WP 6.2.0 Added the `$comment_id` parameter.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string         $format     Optional. PHP date format. Defaults to the 'time_format' option.
 * @param bool           $gmt        Optional. Whether to use the GMT date. Default false.
 * @param bool           $translate  Optional. Whether to translate the time (for use in feeds).
 *                                   Default true.
 * @param int|WP_Comment $comment_id Optional. WP_Comment or ID of the comment for which to get the time.
 *                                   Default current comment.
 * @return string The formatted time.
 */
function get_comment_time( $format = '', $gmt = false, $translate = true, $comment_id = 0 ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the returned comment time.
	 *
	 * @since WP 1.5.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string|int $comment_time The comment time, formatted as a date string or Unix timestamp.
	 * @param string     $format       PHP date format.
	 * @param bool       $gmt          Whether the GMT date is in use.
	 * @param bool       $translate    Whether the time is translated.
	 * @param WP_Comment $comment      The comment object.
	 */
	apply_filters_deprecated(
		'get_comment_time',
		array( '', '', false, false, null ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return '';
}

/**
 * Displays the comment time of the current comment.
 *
 * @since WP 0.71
 * @since WP 6.2.0 Added the `$comment_id` parameter.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string         $format     Optional. PHP time format. Defaults to the 'time_format' option.
 * @param int|WP_Comment $comment_id Optional. WP_Comment or ID of the comment for which to print the time.
 *                                   Default current comment.
 */
function comment_time( $format = '', $comment_id = 0 ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Retrieves the comment type of the current comment.
 *
 * @since WP 1.5.0
 * @since WP 4.4.0 Added the ability for `$comment_id` to also accept a WP_Comment object.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int|WP_Comment $comment_id Optional. WP_Comment or ID of the comment for which to get the type.
 *                                   Default current comment.
 * @return string The comment type.
 */
function get_comment_type( $comment_id = 0 ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the returned comment type.
	 *
	 * @since WP 1.5.0
	 * @since WP 4.1.0 The `$comment_id` and `$comment` parameters were added.
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string     $comment_type The type of comment, such as 'comment', 'pingback', or 'trackback'.
	 * @param string     $comment_id   The comment ID as a numeric string.
	 * @param WP_Comment $comment      The comment object.
	 */
	apply_filters_deprecated(
		'get_comment_type',
		array( '', '', null ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return '';
}

/**
 * Displays the comment type of the current comment.
 *
 * @since WP 0.71
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string|false $commenttxt   Optional. String to display for comment type. Default false.
 * @param string|false $trackbacktxt Optional. String to display for trackback type. Default false.
 * @param string|false $pingbacktxt  Optional. String to display for pingback type. Default false.
 */
function comment_type( $commenttxt = false, $trackbacktxt = false, $pingbacktxt = false ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Retrieves the current post's trackback URL.
 *
 * There is a check to see if permalink's have been enabled and if so, will
 * retrieve the pretty path. If permalinks weren't enabled, the ID of the
 * current post is used and appended to the correct page to go to.
 *
 * @since WP 1.5.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @return string The trackback URL after being filtered.
 */
function get_trackback_url() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the returned trackback URL.
	 *
	 * @since WP 2.2.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string $trackback_url The trackback URL.
	 */
	apply_filters_deprecated(
		'trackback_url',
		array( '' ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return '';
}

/**
 * Displays the current post's trackback URL.
 *
 * @since WP 0.71
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param bool $deprecated_echo Not used.
 * @return void|string Should only be used to echo the trackback URL, use get_trackback_url()
 *                     for the result instead.
 */
function trackback_url( $deprecated_echo = true ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Generates and displays the RDF for the trackback information of current post.
 *
 * Deprecated in 3.0.0, and restored in 3.0.1.
 *
 * @since WP 0.71
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int|string $deprecated Not used (Was $timezone = 0).
 */
function trackback_rdf( $deprecated = '' ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Determines whether the current post is open for comments.
 *
 * @since WP 1.5.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int|WP_Post $post Optional. Post ID or WP_Post object. Default current post.
 * @return bool True if the comments are open.
 */
function comments_open( $post = null ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters whether the current post is open for comments.
	 *
	 * @since WP 2.5.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param bool $comments_open Whether the current post is open for comments.
	 * @param int  $post_id       The post ID.
	 */
	apply_filters_deprecated(
		'comments_open',
		array( false, 0 ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return false;
}

/**
 * Determines whether the current post is open for pings.
 *
 * @since WP 1.5.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int|WP_Post $post Optional. Post ID or WP_Post object. Default current post.
 * @return bool True if pings are accepted
 */
function pings_open( $post = null ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters whether the current post is open for pings.
	 *
	 * @since WP 2.5.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param bool $pings_open Whether the current post is open for pings.
	 * @param int  $post_id    The post ID.
	 */
	apply_filters_deprecated(
		'pings_open',
		array( false, 0 ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return false;
}

/**
 * Displays form token for unfiltered comments.
 *
 * Will only display nonce token if the current user has permissions for
 * unfiltered html. Won't display the token for other users.
 *
 * The function was backported to 2.0.10 and was added to versions 2.1.3 and
 * above. Does not exist in versions prior to 2.0.10 in the 2.0 branch and in
 * the 2.1 branch, prior to 2.1.3. Technically added in 2.2.0.
 *
 * Backported to 2.0.10.
 *
 * @since WP 2.1.3
 * @deprecated 1.0.0 Retraceur fork.
 */
function wp_comment_form_unfiltered_html_nonce() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Displays the link to the comments for the current post ID.
 *
 * @since WP 0.71
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param false|string $zero      Optional. String to display when no comments. Default false.
 * @param false|string $one       Optional. String to display when only one comment is available. Default false.
 * @param false|string $more      Optional. String to display when there are more than one comment. Default false.
 * @param string       $css_class Optional. CSS class to use for comments. Default empty.
 * @param false|string $none      Optional. String to display when comments have been turned off. Default false.
 */
function comments_popup_link( $zero = false, $one = false, $more = false, $css_class = '', $none = false ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the respond link when a post has no comments.
	 *
	 * @since WP 4.4.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string $respond_link The default response link.
	 * @param int    $post_id      The post ID.
	 */
	apply_filters_deprecated(
		'respond_link',
		array( '', 0 ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	/**
	 * Filters the comments link attributes for display.
	 *
	 * @since WP 2.5.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string $link_attributes The comments link attributes. Default empty.
	 */
	apply_filters_deprecated(
		'comments_popup_link_attributes',
		array( '' ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);
}

/**
 * Retrieves HTML content for reply to comment link.
 *
 * @since WP 2.7.0
 * @since WP 4.4.0 Added the ability for `$comment` to also accept a WP_Comment object.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param array          $args {
 *     Optional. Override default arguments.
 *
 *     @type string $add_below          The first part of the selector used to identify the comment to respond below.
 *                                      The resulting value is passed as the first parameter to addComment.moveForm(),
 *                                      concatenated as $add_below-$comment->comment_ID. Default 'comment'.
 *     @type string $respond_id         The selector identifying the responding comment. Passed as the third parameter
 *                                      to addComment.moveForm(), and appended to the link URL as a hash value.
 *                                      Default 'respond'.
 *     @type string $reply_text         The visible text of the Reply link. Default 'Reply'.
 *     @type string $reply_to_text      The accessible name of the Reply link, using `%s` as a placeholder
 *                                      for the comment author's name. Default 'Reply to %s'.
 *                                      Should start with the visible `reply_text` value.
 *     @type bool   $show_reply_to_text Whether to use `reply_to_text` as visible link text. Default false.
 *     @type string $login_text         The text of the link to reply if logged out. Default 'Log in to Reply'.
 *     @type int    $max_depth          The max depth of the comment tree. Default 0.
 *     @type int    $depth              The depth of the new comment. Must be greater than 0 and less than the value
 *                                      of the 'thread_comments_depth' option set in Settings > Discussion. Default 0.
 *     @type string $before             The text or HTML to add before the reply link. Default empty.
 *     @type string $after              The text or HTML to add after the reply link. Default empty.
 * }
 * @param int|WP_Comment $comment Optional. Comment being replied to. Default current comment.
 * @param int|WP_Post    $post    Optional. Post ID or WP_Post object the comment is going to be displayed on.
 *                                Default current post.
 * @return string|false|null Link to show comment form, if successful. False, if comments are closed.
 */
function get_comment_reply_link( $args = array(), $comment = null, $post = null ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the comment reply link arguments.
	 *
	 * @since WP 4.1.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param array      $args    Comment reply link arguments. See get_comment_reply_link()
	 *                            for more information on accepted arguments.
	 * @param WP_Comment $comment The object of the comment being replied to.
	 * @param WP_Post    $post    The WP_Post object.
	 */
	apply_filters_deprecated(
		'comment_reply_link_args',
		array( array(), null, null ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	/**
	 * Filters the comment reply link.
	 *
	 * @since WP 2.7.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string     $comment_reply_link The HTML markup for the comment reply link.
	 * @param array      $args               An array of arguments overriding the defaults.
	 * @param WP_Comment $comment            The object of the comment being replied.
	 * @param WP_Post    $post               The WP_Post object.
	 */
	apply_filters_deprecated(
		'comment_reply_link',
		array( '', array(), null, null ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return '';
}

/**
 * Displays the HTML content for reply to comment link.
 *
 * @since WP 2.7.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @see get_comment_reply_link()
 *
 * @param array          $args    Optional. Override default options. Default empty array.
 * @param int|WP_Comment $comment Optional. Comment being replied to. Default current comment.
 * @param int|WP_Post    $post    Optional. Post ID or WP_Post object the comment is going to be displayed on.
 *                                Default current post.
 */
function comment_reply_link( $args = array(), $comment = null, $post = null ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Retrieves HTML content for reply to post link.
 *
 * @since WP 2.7.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param array       $args {
 *     Optional. Override default arguments.
 *
 *     @type string $add_below  The first part of the selector used to identify the comment to respond below.
 *                              The resulting value is passed as the first parameter to addComment.moveForm(),
 *                              concatenated as $add_below-$comment->comment_ID. Default is 'post'.
 *     @type string $respond_id The selector identifying the responding comment. Passed as the third parameter
 *                              to addComment.moveForm(), and appended to the link URL as a hash value.
 *                              Default 'respond'.
 *     @type string $reply_text Text of the Reply link. Default is 'Leave a Comment'.
 *     @type string $login_text Text of the link to reply if logged out. Default is 'Log in to leave a Comment'.
 *     @type string $before     Text or HTML to add before the reply link. Default empty.
 *     @type string $after      Text or HTML to add after the reply link. Default empty.
 * }
 * @param int|WP_Post $post    Optional. Post ID or WP_Post object the comment is going to be displayed on.
 *                             Default current post.
 * @return string|false|null Link to show comment form, if successful. False, if comments are closed.
 */
function get_post_reply_link( $args = array(), $post = null ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the formatted post comments link HTML.
	 *
	 * @since WP 2.7.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string      $post_reply_link The HTML-formatted post comments link.
	 * @param int|WP_Post $post            The post ID or WP_Post object.
	 */
	apply_filters_deprecated(
		'post_comments_link',
		array( '', 0 ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return '';
}

/**
 * Displays the HTML content for reply to post link.
 *
 * @since WP 2.7.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @see get_post_reply_link()
 *
 * @param array       $args Optional. Override default options. Default empty array.
 * @param int|WP_Post $post Optional. Post ID or WP_Post object the comment is going to be displayed on.
 *                          Default current post.
 */
function post_reply_link( $args = array(), $post = null ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Retrieves HTML content for cancel comment reply link.
 *
 * @since WP 2.7.0
 * @since WP 6.2.0 Added the `$post` parameter.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string           $link_text Optional. Text to display for cancel reply link. If empty,
 *                                    defaults to 'Click here to cancel reply'. Default empty.
 * @param int|WP_Post|null $post      Optional. The post the comment thread is being
 *                                    displayed for. Defaults to the current global post.
 * @return string
 */
function get_cancel_comment_reply_link( $link_text = '', $post = null ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the cancel comment reply link HTML.
	 *
	 * @since WP 2.7.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string $cancel_comment_reply_link The HTML-formatted cancel comment reply link.
	 * @param string $link_url                  Cancel comment reply link URL.
	 * @param string $link_text                 Cancel comment reply link text.
	 */
	apply_filters_deprecated(
		'cancel_comment_reply_link',
		array( '', '', '' ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return '';
}

/**
 * Displays HTML content for cancel comment reply link.
 *
 * @since WP 2.7.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string $link_text Optional. Text to display for cancel reply link. If empty,
 *                     defaults to 'Click here to cancel reply'. Default empty.
 */
function cancel_comment_reply_link( $link_text = '' ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Retrieves hidden input HTML for replying to comments.
 *
 * @since WP 3.0.0
 * @since WP 6.2.0 Renamed `$post_id` to `$post` and added WP_Post support.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int|WP_Post|null $post Optional. The post the comment is being displayed for.
 *                               Defaults to the current global post.
 * @return string Hidden input HTML for replying to comments.
 */
function get_comment_id_fields( $post = null ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the returned comment ID fields.
	 *
	 * @since WP 3.0.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string $comment_id_fields The HTML-formatted hidden ID field comment elements.
	 * @param int    $post_id           The post ID.
	 * @param int    $reply_to_id       The ID of the comment being replied to.
	 */
	apply_filters_deprecated(
		'comment_id_fields',
		array( '', 0, 0 ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return '';
}

/**
 * Outputs hidden input HTML for replying to comments.
 *
 * Adds two hidden inputs to the comment form to identify the `comment_post_ID`
 * and `comment_parent` values for threaded comments.
 *
 * This tag must be within the `<form>` section of the `comments.php` template.
 *
 * @since WP 2.7.0
 * @since WP 6.2.0 Renamed `$post_id` to `$post` and added WP_Post support.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @see get_comment_id_fields()
 *
 * @param int|WP_Post|null $post Optional. The post the comment is being displayed for.
 *                               Defaults to the current global post.
 */
function comment_id_fields( $post = null ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Displays text based on comment reply status.
 *
 * Only affects users with JavaScript disabled.
 *
 * @internal The $comment global must be present to allow template tags access to the current
 *           comment.
 *
 * @since WP 2.7.0
 * @since WP 6.2.0 Added the `$post` parameter.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @global WP_Comment $comment Global comment object.
 *
 * @param string|false     $no_reply_text  Optional. Text to display when not replying to a comment.
 *                                         Default false.
 * @param string|false     $reply_text     Optional. Text to display when replying to a comment.
 *                                         Default false. Accepts "%s" for the author of the comment
 *                                         being replied to.
 * @param bool             $link_to_parent Optional. Boolean to control making the author's name a link
 *                                         to their comment. Default true.
 * @param int|WP_Post|null $post           Optional. The post that the comment form is being displayed for.
 *                                         Defaults to the current global post.
 */
function comment_form_title( $no_reply_text = false, $reply_text = false, $link_to_parent = true, $post = null ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Gets the comment's reply to ID from the $_GET['replytocom'].
 *
 * @since WP 6.2.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @access private
 *
 * @param int|WP_Post $post The post the comment is being displayed for.
 *                          Defaults to the current global post.
 * @return int Comment's reply to ID.
 */
function _get_comment_reply_id( $post = null ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return 0;
}

/**
 * Outputs a complete commenting form for use within a template.
 *
 * Most strings and form fields may be controlled through the `$args` array passed
 * into the function, while you may also choose to use the {@see 'comment_form_default_fields'}
 * filter to modify the array of default fields if you'd just like to add a new
 * one or remove a single field. All fields are also individually passed through
 * a filter of the {@see 'comment_form_field_$name'} where `$name` is the key used
 * in the array of fields.
 *
 * @since WP 3.0.0
 * @since WP 4.1.0 Introduced the 'class_submit' argument.
 * @since WP 4.2.0 Introduced the 'submit_button' and 'submit_fields' arguments.
 * @since WP 4.4.0 Introduced the 'class_form', 'title_reply_before', 'title_reply_after',
 *              'cancel_reply_before', and 'cancel_reply_after' arguments.
 * @since WP 4.5.0 The 'author', 'email', and 'url' form fields are limited to 245, 100,
 *              and 200 characters, respectively.
 * @since WP 4.6.0 Introduced the 'action' argument.
 * @since WP 4.9.6 Introduced the 'cookies' default comment field.
 * @since WP 5.5.0 Introduced the 'class_container' argument.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param array       $args {
 *     Optional. Default arguments and form fields to override.
 *
 *     @type array $fields {
 *         Default comment fields, filterable by default via the {@see 'comment_form_default_fields'} hook.
 *
 *         @type string $author  Comment author field HTML.
 *         @type string $email   Comment author email field HTML.
 *         @type string $url     Comment author URL field HTML.
 *         @type string $cookies Comment cookie opt-in field HTML.
 *     }
 *     @type string $comment_field        The comment textarea field HTML.
 *     @type string $must_log_in          HTML element for a 'must be logged in to comment' message.
 *     @type string $logged_in_as         The HTML for the 'logged in as [user]' message, the Edit profile link,
 *                                        and the Log out link.
 *     @type string $comment_notes_before HTML element for a message displayed before the comment fields
 *                                        if the user is not logged in.
 *                                        Default 'Your email address will not be published.'.
 *     @type string $comment_notes_after  HTML element for a message displayed after the textarea field.
 *     @type string $action               The comment form element action attribute. Default '/wp-comments-post.php'.
 *     @type string $id_form              The comment form element id attribute. Default 'commentform'.
 *     @type string $id_submit            The comment submit element id attribute. Default 'submit'.
 *     @type string $class_container      The comment form container class attribute. Default 'comment-respond'.
 *     @type string $class_form           The comment form element class attribute. Default 'comment-form'.
 *     @type string $class_submit         The comment submit element class attribute. Default 'submit'.
 *     @type string $name_submit          The comment submit element name attribute. Default 'submit'.
 *     @type string $title_reply          The translatable 'reply' button label. Default 'Leave a Reply'.
 *     @type string $title_reply_to       The translatable 'reply-to' button label. Default 'Leave a Reply to %s',
 *                                        where %s is the author of the comment being replied to.
 *     @type string $title_reply_before   HTML displayed before the comment form title.
 *                                        Default: '<h3 id="reply-title" class="comment-reply-title">'.
 *     @type string $title_reply_after    HTML displayed after the comment form title.
 *                                        Default: '</h3>'.
 *     @type string $cancel_reply_before  HTML displayed before the cancel reply link.
 *     @type string $cancel_reply_after   HTML displayed after the cancel reply link.
 *     @type string $cancel_reply_link    The translatable 'cancel reply' button label. Default 'Cancel reply'.
 *     @type string $label_submit         The translatable 'submit' button label. Default 'Post a comment'.
 *     @type string $submit_button        HTML format for the Submit button.
 *                                        Default: '<input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />'.
 *     @type string $submit_field         HTML format for the markup surrounding the Submit button and comment hidden
 *                                        fields. Default: '<p class="form-submit">%1$s %2$s</p>', where %1$s is the
 *                                        submit button markup and %2$s is the comment hidden fields.
 *     @type string $format               The comment form format. Default 'xhtml'. Accepts 'xhtml', 'html5'.
 * }
 * @param int|WP_Post $post Optional. Post ID or WP_Post object to generate the form for. Default current post.
 */
function comment_form( $args = array(), $post = null ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Fires after the comment form if comments are closed.
	 *
	 * For backward compatibility, this action also fires if comment_form()
	 * is called with an invalid post object or ID.
	 *
	 * @since WP 3.0.0
	 * @deprecated 1.0.0 Retraceur fork.
	 */
	do_action_deprecated(
		'comment_form_comments_closed',
		array(),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	/**
	 * Filters the default comment form fields.
	 *
	 * @since WP 3.0.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string[] $fields Array of the default comment fields.
	 */
	apply_filters_deprecated(
		'comment_form_default_fields',
		array( array() ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	/**
	 * Filters the comment form default arguments.
	 *
	 * Use {@see 'comment_form_default_fields'} to filter the comment fields.
	 *
	 * @since WP 3.0.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param array $defaults The default comment form arguments.
	 */
	apply_filters_deprecated(
		'comment_form_defaults',
		array( array() ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	/**
	 * Fires before the comment form.
	 *
	 * @since WP 3.0.0
	 * @deprecated 1.0.0 Retraceur fork.
	 */
	do_action_deprecated(
		'comment_form_before',
		array(),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	/**
	 * Fires after the HTML-formatted 'must log in after' message in the comment form.
	 *
	 * @since WP 3.0.0
	 */
	do_action_deprecated(
		'comment_form_must_log_in_after',
		array(),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	/**
	 * Fires at the top of the comment form, inside the form tag.
	 *
	 * @since WP 3.0.0
	 * @deprecated 1.0.0 Retraceur fork.
	 */
	do_action_deprecated(
		'comment_form_top',
		array(),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	/**
	 * Filters the 'logged in' message for the comment form for display.
	 *
	 * @since WP 3.0.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string $args_logged_in The HTML for the 'logged in as [user]' message,
	 *                               the Edit profile link, and the Log out link.
	 * @param array  $commenter      An array containing the comment author's
	 *                               username, email, and URL.
	 * @param string $user_identity  If the commenter is a registered user,
	 *                               the display name, blank otherwise.
	 */
	apply_filters_deprecated(
		'comment_form_logged_in',
		array( '', array(), '' ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	/**
	 * Fires after the is_user_logged_in() check in the comment form.
	 *
	 * @since WP 3.0.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param array  $commenter     An array containing the comment author's
	 *                              username, email, and URL.
	 * @param string $user_identity If the commenter is a registered user,
	 *                              the display name, blank otherwise.
	 */
	do_action_deprecated(
		'comment_form_logged_in_after',
		array( array(), '' ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	/**
	 * Filters the comment form fields, including the textarea.
	 *
	 * @since WP 4.4.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param array $comment_fields The comment fields.
	 */
	apply_filters_deprecated(
		'comment_form_fields',
		array( array() ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	/**
	 * Filters the content of the comment textarea field for display.
	 *
	 * @since WP 3.0.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string $args_comment_field The content of the comment textarea field.
	 */
	apply_filters_deprecated(
		'comment_form_field_comment',
		array( '' ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	/**
	 * Fires before the comment fields in the comment form, excluding the textarea.
	 *
	 * @since WP 3.0.0
	 * @deprecated 1.0.0 Retraceur fork.
	 */
	do_action_deprecated(
		'comment_form_before_fields',
		array(),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	/**
	 * Fires after the comment fields in the comment form, excluding the textarea.
	 *
	 * @since WP 3.0.0
	 */
	do_action_deprecated(
		'comment_form_after_fields',
		array(),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	/**
	 * Filters the submit button for the comment form to display.
	 *
	 * @since WP 4.2.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string $submit_button HTML markup for the submit button.
	 * @param array  $args          Arguments passed to comment_form().
	 */
	apply_filters_deprecated(
		'comment_form_submit_button',
		array( '', array() ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	/**
	 * Filters the submit field for the comment form to display.
	 *
	 * The submit field includes the submit button, hidden fields for the
	 * comment form, and any wrapper markup.
	 *
	 * @since WP 4.2.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string $submit_field HTML markup for the submit field.
	 * @param array  $args         Arguments passed to comment_form().
	 */
	apply_filters_deprecated(
		'comment_form_submit_field',
		array( '', array() ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	/**
	 * Fires at the bottom of the comment form, inside the closing form tag.
	 *
	 * @since WP 1.5.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param int $post_id The post ID.
	 */
	do_action_deprecated(
		'comment_form',
		array( 0 ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	/**
	 * Fires after the comment form.
	 *
	 * @since WP 3.0.0
	 * @deprecated 1.0.0 Retraceur fork.
	 */
	do_action_deprecated(
		'comment_form_after',
		array(),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);
}

/**
 * Is the query for a comments feed?
 *
 * @since WP 3.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @return bool Whether the query is for a comments feed.
 */
function is_comment_feed() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return false;
}

/**
 * Determines whether current WP query has comments to loop over.
 *
 * @since WP 2.2.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @return bool True if comments are available, false if no more comments.
 */
function have_comments() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return false;
}

/**
 * Iterate comment index in the comment loop.
 *
 * @since WP 2.2.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function the_comment() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Sanitizes space or carriage return separated URLs that are used to send trackbacks.
 *
 * @since WP 3.4.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string $to_ping Space or carriage return separated URLs
 * @return string URLs starting with the http or https protocol, separated by a carriage return.
 */
function sanitize_trackback_urls( $to_ping ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters a list of trackback URLs following sanitization.
	 *
	 * The string returned here consists of a space or carriage return-delimited list
	 * of trackback URLs.
	 *
	 * @since WP 3.4.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string $urls_to_ping Sanitized space or carriage return separated URLs.
	 * @param string $to_ping      Space or carriage return separated URLs before sanitization.
	 */
	apply_filters_deprecated(
		'sanitize_trackback_urls',
		array( '', '' ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return '';
}

/**
 * Retrieves enclosures already enclosed for a post.
 *
 * @since WP 1.5.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int $post_id Post ID.
 * @return string[] Array of enclosures for the given post.
 */
function get_enclosed( $post_id ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the list of enclosures already enclosed for the given post.
	 *
	 * @since WP 2.0.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string[] $pung    Array of enclosures for the given post.
	 * @param int      $post_id Post ID.
	 */
	apply_filters_deprecated(
		'get_enclosed',
		array( '', 0 ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);
}

/**
 * Retrieves URLs that need to be pinged.
 *
 * @since WP 1.5.0
 * @since WP 4.7.0 `$post` can be a WP_Post object.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int|WP_Post $post Post ID or post object.
 * @return string[]|false List of URLs yet to ping.
 */
function get_to_ping( $post ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the list of URLs yet to ping for the given post.
	 *
	 * @since WP 2.0.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string[] $to_ping List of URLs yet to ping.
	 */
	apply_filters_deprecated(
		'get_to_ping',
		array( array() ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return false;
}

/**
 * Does trackbacks for a list of URLs.
 *
 * @since WP 1.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string $tb_list Comma separated list of URLs.
 * @param int    $post_id Post ID.
 */
function trackback_url_list( $tb_list, $post_id ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Checks content for video and audio links to add as enclosures.
 *
 * Will not add enclosures that have already been added and will
 * remove enclosures that are no longer in the post. This is called as
 * pingbacks and trackbacks.
 *
 * @since WP 1.5.0
 * @since WP 5.3.0 The `$content` parameter was made optional, and the `$post` parameter was
 *              updated to accept a post ID or a WP_Post object.
 * @since WP 5.6.0 The `$content` parameter is no longer optional, but passing `null` to skip it
 *              is still supported.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string|null $content Post content. If `null`, the `post_content` field from `$post` is used.
 * @param int|WP_Post $post    Post ID or post object.
 * @return void|false Void on success, false if the post is not found.
 */
function do_enclose( $content, $post ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the list of enclosure links before querying the database.
	 *
	 * Allows for the addition and/or removal of potential enclosures to save
	 * to postmeta before checking the database for existing enclosures.
	 *
	 * @since WP 4.4.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string[] $post_links An array of enclosure links.
	 * @param int      $post_id    Post ID.
	 */
	apply_filters_deprecated(
		'enclosure_links',
		array( array(), 0 ),
		'1.0.0',
		'',
		__( 'WP Comments feature is not supported in Retraceur.' )
	);

	return false;
}

/**
 * Determines whether the query is for a trackback endpoint call.
 *
 * @since WP 1.5.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @return bool Whether the query is for a trackback endpoint call.
 */
function is_trackback() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return false;
}

/**
 * Adds inline scripts required for the TinyMCE in the block editor.
 *
 * These TinyMCE init settings are used to extend and override the default settings
 * from `_WP_Editors::default_settings()` for the Classic block.
 *
 * @since WP 5.0.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function wp_tinymce_inline_scripts() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Renders an editor.
 *
 * Using this function is the proper way to output all needed components for both TinyMCE and Quicktags.
 * _WP_Editors should not be used directly.
 *
 * NOTE: Once initialized the TinyMCE editor cannot be safely moved in the DOM. For that reason
 * running wp_editor() inside of a meta box is not a good idea unless only Quicktags is used.
 * On the post edit screen several actions can be used to include additional editors
 * containing TinyMCE: 'edit_page_form', 'edit_form_advanced' and 'dbx_post_sidebar'.
 *
 * @see _WP_Editors::editor()
 * @see _WP_Editors::parse_settings()
 * @since WP 3.3.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string $content   Initial content for the editor.
 * @param string $editor_id HTML ID attribute value for the textarea and TinyMCE.
 *                          Should not contain square brackets.
 * @param array  $settings  See _WP_Editors::parse_settings() for description.
 */
function wp_editor( $content, $editor_id, $settings = array() ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Outputs the editor scripts, stylesheets, and default settings.
 *
 * The editor can be initialized when needed after page load.
 * See wp.editor.initialize() in wp-admin/js/editor.js for initialization options.
 *
 * @uses _WP_Editors
 * @since WP 4.8.0
 * @deprecated 1.0.0 Retraceur fork.
 */
function wp_enqueue_editor() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Adds an action hook specific to this page.
 *
 * Fires on {@see 'wp_head'}.
 *
 * @since WP MU (3.0.0)
 * @deprecated 1.0.0 Retraceur fork.
 */
function do_activate_header() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Fires within the `<head>` section of the Site Activation page.
	 *
	 * Fires on the {@see 'wp_head'} action.
	 *
	 * @since WP 3.0.0
	 */
	do_action_deprecated(
		'activate_wp_head',
		array(),
		'1.0.0',
		'',
		__( 'WP Multisite feature is not supported in Retraceur.' )
	);
}

/**
 * Loads styles specific to this page.
 *
 * @since WP MU (3.0.0)
 * @deprecated 1.0.0 Retraceur fork.
 */
function wpmu_activate_stylesheet() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Prints signup_header via wp_head.
 *
 * @since WP MU (3.0.0)
 * @deprecated 1.0.0 Retraceur fork.
 */
function do_signup_header() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Fires within the head section of the site sign-up screen.
	 *
	 * @since WP 3.0.0
	 * @deprecated 1.0.0 Retraceur fork.
	 */
	do_action_deprecated(
		'signup_header',
		array(),
		'1.0.0',
		'',
		__( 'WP Multisite feature is not supported in Retraceur.' )
	);
}

/**
 * Prints styles for front-end Multisite Sign-up pages.
 *
 * @since WP MU (3.0.0)
 * @deprecated 1.0.0 Retraceur fork.
 */
function wpmu_signup_stylesheet() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Generates and displays the Sign-up and Create Site forms.
 *
 * @since WP MU (3.0.0)
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string          $blogname   The new site name.
 * @param string          $blog_title The new site title.
 * @param WP_Error|string $errors     A WP_Error object containing existing errors. Defaults to empty string.
 */
function show_blog_form( $blogname = '', $blog_title = '', $errors = '' ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Fires after the site sign-up form.
	 *
	 * @since WP 3.0.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param WP_Error $errors A WP_Error object possibly containing 'blogname' or 'blog_title' errors.
	 */
	do_action_deprecated(
		'signup_blogform',
		array( null ),
		'1.0.0',
		'',
		__( 'WP Multisite feature is not supported in Retraceur.' )
	);
}


/**
 * Validates the new site sign-up.
 *
 * @since WP MU (3.0.0)
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @return array Contains the new site data and error messages.
 *               See wpmu_validate_blog_signup() for details.
 */
function validate_blog_form() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return array();
}

/**
 * Displays the fields for the new user account registration form.
 *
 * @since WP MU (3.0.0)
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string          $user_name  The entered username.
 * @param string          $user_email The entered email address.
 * @param WP_Error|string $errors     A WP_Error object containing existing errors. Defaults to empty string.
 */
function show_user_form( $user_name = '', $user_email = '', $errors = '' ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Fires at the end of the new user account registration form.
	 *
	 * @since WP 3.0.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param WP_Error $errors A WP_Error object containing 'user_name' or 'user_email' errors.
	 */
	do_action_deprecated(
		'signup_extra_fields',
		array( null ),
		'1.0.0',
		'',
		__( 'WP Multisite feature is not supported in Retraceur.' )
	);
}


/**
 * Validates user sign-up name and email.
 *
 * @since WP MU (3.0.0)
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @return array Contains username, email, and error messages.
 *               See wpmu_validate_user_signup() for details.
 */
function validate_user_form() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return array();
}

/**
 * Shows a form for returning users to sign up for another site.
 *
 * @since WP MU (3.0.0)
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string          $blogname   The new site name
 * @param string          $blog_title The new site title.
 * @param WP_Error|string $errors     A WP_Error object containing existing errors. Defaults to empty string.
 */
function signup_another_blog( $blogname = '', $blog_title = '', $errors = '' ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the default site sign-up variables.
	 *
	 * @since WP 3.0.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param array $signup_defaults {
	 *     An array of default site sign-up variables.
	 *
	 *     @type string   $blogname   The site blogname.
	 *     @type string   $blog_title The site title.
	 *     @type WP_Error $errors     A WP_Error object possibly containing 'blogname' or 'blog_title' errors.
	 * }
	 */
	apply_filters_deprecated(
		'signup_another_blog_init',
		array( array() ),
		'1.0.0',
		'',
		__( 'WP Multisite feature is not supported in Retraceur.' )
	);

	/**
	 * Fires when hidden sign-up form fields output when creating another site or user.
	 *
	 * @since WP MU (3.0.0)
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string $context A string describing the steps of the sign-up process. The value can be
	 *                        'create-another-site', 'validate-user', or 'validate-site'.
	 */
	do_action_deprecated(
		'signup_hidden_fields',
		array( 'create-another-site' ),
		'1.0.0',
		'',
		__( 'WP Multisite feature is not supported in Retraceur.' )
	);
}

/**
 * Validates a new site sign-up for an existing user.
 *
 * @since WP MU (3.0.0)
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @global string   $blogname   The new site's subdomain or directory name.
 * @global string   $blog_title The new site's title.
 * @global WP_Error $errors     Existing errors in the global scope.
 * @global string   $domain     The new site's domain.
 * @global string   $path       The new site's path.
 *
 * @return null|bool True if site signup was validated, false on error.
 *                   The function halts all execution if the user is not logged in.
 */
function validate_another_blog_signup() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the new site meta variables.
	 *
	 * Use the {@see 'add_signup_meta'} filter instead.
	 *
	 * @since WP MU (3.0.0)
	 * @deprecated WP 3.0.0 Use the {@see 'add_signup_meta'} filter instead.
	 *
	 * @param array $blog_meta_defaults An array of default blog meta variables.
	 */
	$meta_defaults = apply_filters_deprecated( 'signup_create_blog_meta', array( $blog_meta_defaults ), '3.0.0', 'add_signup_meta' );

	/**
	 * Filters the new default site meta variables.
	 *
	 * @since WP 3.0.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param array $meta {
	 *     An array of default site meta variables.
	 *
	 *     @type int $lang_id     The language ID.
	 *     @type int $blog_public Whether search engines should be discouraged from indexing the site. 1 for true, 0 for false.
	 * }
	 */
	apply_filters_deprecated(
		'add_signup_meta',
		array( $meta_defaults ),
		'1.0.0',
		'',
		__( 'WP Multisite feature is not supported in Retraceur.' )
	);

	return false;
}

/**
 * Shows a message confirming that the new site has been created.
 *
 * @since WP MU (3.0.0)
 * @since WP 4.4.0 Added the `$blog_id` parameter.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string $domain     The domain URL.
 * @param string $path       The site root path.
 * @param string $blog_title The site title.
 * @param string $user_name  The username.
 * @param string $user_email The user's email address.
 * @param array  $meta       Any additional meta from the {@see 'add_signup_meta'} filter in validate_blog_signup().
 * @param int    $blog_id    The site ID.
 */
function confirm_another_blog_signup( $domain, $path, $blog_title, $user_name, $user_email = '', $meta = array(), $blog_id = 0 ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Fires when the site or user sign-up process is complete.
	 *
	 * @since WP 3.0.0
	 * @deprecated 1.0.0 Retraceur fork.
	 */
	do_action_deprecated(
		'signup_finished',
		array(),
		'1.0.0',
		'',
		__( 'WP Multisite feature is not supported in Retraceur.' )
	);
}

/**
 * Shows a form for a visitor to sign up for a new user account.
 *
 * @since WP MU (3.0.0)
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @global string $active_signup String that returns registration type. The value can be
 *                               'all', 'none', 'blog', or 'user'.
 *
 * @param string          $user_name  The username.
 * @param string          $user_email The user's email.
 * @param WP_Error|string $errors     A WP_Error object containing existing errors. Defaults to empty string.
 */
function signup_user( $user_name = '', $user_email = '', $errors = '' ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the default user variables used on the user sign-up form.
	 *
	 * @since WP 3.0.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param array $signup_user_defaults {
	 *     An array of default user variables.
	 *
	 *     @type string   $user_name  The user username.
	 *     @type string   $user_email The user email address.
	 *     @type WP_Error $errors     A WP_Error object with possible errors relevant to the sign-up user.
	 * }
	 */
	apply_filters_deprecated(
		'signup_user_init',
		array( array() ),
		'1.0.0',
		'',
		__( 'WP Multisite feature is not supported in Retraceur.' )
	);
}

/**
 * Validates the new user sign-up.
 *
 * @since WP MU (3.0.0)
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @return bool True if new user sign-up was validated, false on error.
 */
function validate_user_signup() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return false;
}

/**
 * Shows a message confirming that the new user has been registered and is awaiting activation.
 *
 * @since WP MU (3.0.0)
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string $user_name  The username.
 * @param string $user_email The user's email address.
 */
function confirm_user_signup( $user_name, $user_email ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Shows a form for a user or visitor to sign up for a new site.
 *
 * @since WP MU (3.0.0)
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string          $user_name  The username.
 * @param string          $user_email The user's email address.
 * @param string          $blogname   The site name.
 * @param string          $blog_title The site title.
 * @param WP_Error|string $errors     A WP_Error object containing existing errors. Defaults to empty string.
 */
function signup_blog( $user_name = '', $user_email = '', $blogname = '', $blog_title = '', $errors = '' ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the default site creation variables for the site sign-up form.
	 *
	 * @since WP 3.0.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param array $signup_blog_defaults {
	 *     An array of default site creation variables.
	 *
	 *     @type string   $user_name  The user username.
	 *     @type string   $user_email The user email address.
	 *     @type string   $blogname   The blogname.
	 *     @type string   $blog_title The title of the site.
	 *     @type WP_Error $errors     A WP_Error object with possible errors relevant to new site creation variables.
	 * }
	 */
	apply_filters_deprecated(
		'signup_blog_init',
		array( array() ),
		'1.0.0',
		'',
		__( 'WP Multisite feature is not supported in Retraceur.' )
	);
}

/**
 * Validates new site signup.
 *
 * @since WP MU (3.0.0)
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @return bool True if the site sign-up was validated, false on error.
 */
function validate_blog_signup() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
	return false;
}

/**
 * Shows a message confirming that the new site has been registered and is awaiting activation.
 *
 * @since WP MU (3.0.0)
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string $domain     The domain or subdomain of the site.
 * @param string $path       The path of the site.
 * @param string $blog_title The title of the new site.
 * @param string $user_name  The user's username.
 * @param string $user_email The user's email address.
 * @param array  $meta       Any additional meta from the {@see 'add_signup_meta'} filter in validate_blog_signup().
 */
function confirm_blog_signup( $domain, $path, $blog_title, $user_name = '', $user_email = '', $meta = array() ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Retrieves languages available during the site/user sign-up process.
 *
 * @since WP 4.4.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @see get_available_languages()
 *
 * @return string[] Array of available language codes. Language codes are formed by
 *                  stripping the .mo extension from the language file names.
 */
function signup_get_available_languages() {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );

	/**
	 * Filters the list of available languages for front-end site sign-ups.
	 *
	 * Passing an empty array to this hook will disable output of the setting on the
	 * sign-up form, and the default language will be used when creating the site.
	 *
	 * Languages not already installed will be stripped.
	 *
	 * @since WP 4.4.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string[] $languages Array of available language codes. Language codes are formed by
	 *                            stripping the .mo extension from the language file names.
	 */
	apply_filters_deprecated(
		'signup_get_available_languages',
		array( array() ),
		'1.0.0',
		'',
		__( 'WP Multisite feature is not supported in Retraceur.' )
	);
}
