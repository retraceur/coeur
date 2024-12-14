<?php
/**
 * Comment API: WP_Comment_Query class.
 *
 * @since WP 4.4.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Comments
 */

_deprecated_file( basename( __FILE__ ), '1.0.0', '', '', true );

/**
 * Core class used for querying comments.
 *
 * @since WP 3.1.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @see WP_Comment_Query::__construct() for accepted arguments.
 */
#[AllowDynamicProperties]
class WP_Comment_Query {

	/**
	 * Constructor.
	 *
	 * Sets up the comment query, based on the query vars passed.
	 *
	 * @since WP 4.2.0
	 * @since WP 4.4.0 `$parent__in` and `$parent__not_in` were added.
	 * @since WP 4.4.0 Order by `comment__in` was added. `$update_comment_meta_cache`, `$no_found_rows`,
	 *              `$hierarchical`, and `$update_comment_post_cache` were added.
	 * @since WP 4.5.0 Introduced the `$author_url` argument.
	 * @since WP 4.6.0 Introduced the `$cache_domain` argument.
	 * @since WP 4.9.0 Introduced the `$paged` argument.
	 * @since WP 5.1.0 Introduced the `$meta_compare_key` argument.
	 * @since WP 5.3.0 Introduced the `$meta_type_key` argument.
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string|array $query {
	 *     Optional. Array or query string of comment query parameters. Default empty.
	 *
	 *     @type string          $author_email              Comment author email address. Default empty.
	 *     @type string          $author_url                Comment author URL. Default empty.
	 *     @type int[]           $author__in                Array of author IDs to include comments for. Default empty.
	 *     @type int[]           $author__not_in            Array of author IDs to exclude comments for. Default empty.
	 *     @type int[]           $comment__in               Array of comment IDs to include. Default empty.
	 *     @type int[]           $comment__not_in           Array of comment IDs to exclude. Default empty.
	 *     @type bool            $count                     Whether to return a comment count (true) or array of
	 *                                                      comment objects (false). Default false.
	 *     @type array           $date_query                Date query clauses to limit comments by. See WP_Date_Query.
	 *                                                      Default null.
	 *     @type string          $fields                    Comment fields to return. Accepts 'ids' for comment IDs
	 *                                                      only or empty for all fields. Default empty.
	 *     @type array           $include_unapproved        Array of IDs or email addresses of users whose unapproved
	 *                                                      comments will be returned by the query regardless of
	 *                                                      `$status`. Default empty.
	 *     @type int             $karma                     Karma score to retrieve matching comments for.
	 *                                                      Default empty.
	 *     @type string|string[] $meta_key                  Meta key or keys to filter by.
	 *     @type string|string[] $meta_value                Meta value or values to filter by.
	 *     @type string          $meta_compare              MySQL operator used for comparing the meta value.
	 *                                                      See WP_Meta_Query::__construct() for accepted values and default value.
	 *     @type string          $meta_compare_key          MySQL operator used for comparing the meta key.
	 *                                                      See WP_Meta_Query::__construct() for accepted values and default value.
	 *     @type string          $meta_type                 MySQL data type that the meta_value column will be CAST to for comparisons.
	 *                                                      See WP_Meta_Query::__construct() for accepted values and default value.
	 *     @type string          $meta_type_key             MySQL data type that the meta_key column will be CAST to for comparisons.
	 *                                                      See WP_Meta_Query::__construct() for accepted values and default value.
	 *     @type array           $meta_query                An associative array of WP_Meta_Query arguments.
	 *                                                      See WP_Meta_Query::__construct() for accepted values.
	 *     @type int             $number                    Maximum number of comments to retrieve.
	 *                                                      Default empty (no limit).
	 *     @type int             $paged                     When used with `$number`, defines the page of results to return.
	 *                                                      When used with `$offset`, `$offset` takes precedence. Default 1.
	 *     @type int             $offset                    Number of comments to offset the query. Used to build
	 *                                                      LIMIT clause. Default 0.
	 *     @type bool            $no_found_rows             Whether to disable the `SQL_CALC_FOUND_ROWS` query.
	 *                                                      Default: true.
	 *     @type string|array    $orderby                   Comment status or array of statuses. To use 'meta_value'
	 *                                                      or 'meta_value_num', `$meta_key` must also be defined.
	 *                                                      To sort by a specific `$meta_query` clause, use that
	 *                                                      clause's array key. Accepts:
	 *                                                      - 'comment_agent'
	 *                                                      - 'comment_approved'
	 *                                                      - 'comment_author'
	 *                                                      - 'comment_author_email'
	 *                                                      - 'comment_author_IP'
	 *                                                      - 'comment_author_url'
	 *                                                      - 'comment_content'
	 *                                                      - 'comment_date'
	 *                                                      - 'comment_date_gmt'
	 *                                                      - 'comment_ID'
	 *                                                      - 'comment_karma'
	 *                                                      - 'comment_parent'
	 *                                                      - 'comment_post_ID'
	 *                                                      - 'comment_type'
	 *                                                      - 'user_id'
	 *                                                      - 'comment__in'
	 *                                                      - 'meta_value'
	 *                                                      - 'meta_value_num'
	 *                                                      - The value of `$meta_key`
	 *                                                      - The array keys of `$meta_query`
	 *                                                      - false, an empty array, or 'none' to disable `ORDER BY` clause.
	 *                                                      Default: 'comment_date_gmt'.
	 *     @type string          $order                     How to order retrieved comments. Accepts 'ASC', 'DESC'.
	 *                                                      Default: 'DESC'.
	 *     @type int             $parent                    Parent ID of comment to retrieve children of.
	 *                                                      Default empty.
	 *     @type int[]           $parent__in                Array of parent IDs of comments to retrieve children for.
	 *                                                      Default empty.
	 *     @type int[]           $parent__not_in            Array of parent IDs of comments *not* to retrieve
	 *                                                      children for. Default empty.
	 *     @type int[]           $post_author__in           Array of author IDs to retrieve comments for.
	 *                                                      Default empty.
	 *     @type int[]           $post_author__not_in       Array of author IDs *not* to retrieve comments for.
	 *                                                      Default empty.
	 *     @type int             $post_id                   Limit results to those affiliated with a given post ID.
	 *                                                      Default 0.
	 *     @type int[]           $post__in                  Array of post IDs to include affiliated comments for.
	 *                                                      Default empty.
	 *     @type int[]           $post__not_in              Array of post IDs to exclude affiliated comments for.
	 *                                                      Default empty.
	 *     @type int             $post_author               Post author ID to limit results by. Default empty.
	 *     @type string|string[] $post_status               Post status or array of post statuses to retrieve
	 *                                                      affiliated comments for. Pass 'any' to match any value.
	 *                                                      Default empty.
	 *     @type string|string[] $post_type                 Post type or array of post types to retrieve affiliated
	 *                                                      comments for. Pass 'any' to match any value. Default empty.
	 *     @type string          $post_name                 Post name to retrieve affiliated comments for.
	 *                                                      Default empty.
	 *     @type int             $post_parent               Post parent ID to retrieve affiliated comments for.
	 *                                                      Default empty.
	 *     @type string          $search                    Search term(s) to retrieve matching comments for.
	 *                                                      Default empty.
	 *     @type string|array    $status                    Comment statuses to limit results by. Accepts an array
	 *                                                      or space/comma-separated list of 'hold' (`comment_status=0`),
	 *                                                      'approve' (`comment_status=1`), 'all', or a custom
	 *                                                      comment status. Default 'all'.
	 *     @type string|string[] $type                      Include comments of a given type, or array of types.
	 *                                                      Accepts 'comment', 'pings' (includes 'pingback' and
	 *                                                      'trackback'), or any custom type string. Default empty.
	 *     @type string[]        $type__in                  Include comments from a given array of comment types.
	 *                                                      Default empty.
	 *     @type string[]        $type__not_in              Exclude comments from a given array of comment types.
	 *                                                      Default empty.
	 *     @type int             $user_id                   Include comments for a specific user ID. Default empty.
	 *     @type bool|string     $hierarchical              Whether to include comment descendants in the results.
	 *                                                      - 'threaded' returns a tree, with each comment's children
	 *                                                        stored in a `children` property on the `WP_Comment` object.
	 *                                                      - 'flat' returns a flat array of found comments plus
	 *                                                        their children.
	 *                                                      - Boolean `false` leaves out descendants.
	 *                                                      The parameter is ignored (forced to `false`) when
	 *                                                      `$fields` is 'ids' or 'counts'. Accepts 'threaded',
	 *                                                      'flat', or false. Default: false.
	 *     @type string          $cache_domain              Unique cache key to be produced when this query is stored in
	 *                                                      an object cache. Default is 'core'.
	 *     @type bool            $update_comment_meta_cache Whether to prime the metadata cache for found comments.
	 *                                                      Default true.
	 *     @type bool            $update_comment_post_cache Whether to prime the cache for comment posts.
	 *                                                      Default false.
	 * }
	 */
	public function __construct( $query = '' ) {
		_deprecated_class( 'WP_Comment', '1.0.0', '', true );
	}
}
