<?php
/**
 * Edit comment form for inclusion in another file.
 *
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Administration
 */

// Don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

_deprecated_file( basename( __FILE__ ), '1.0.0', '', '', true );

/**
 * Filters miscellaneous actions for the edit comment form sidebar.
 *
 * @since WP 4.3.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string     $html    Output HTML to display miscellaneous action.
 * @param WP_Comment $comment Current comment object.
 */
apply_filters_deprecated(
	'edit_comment_misc_actions',
	array( '', null ),
	'1.0.0',
	'',
	__( 'WP Comments feature is not supported in Retraceur.' )
);

/**
 * Fires when comment-specific meta boxes are added.
 *
 * @since WP 3.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param WP_Comment $comment Comment object.
 */
do_action_deprecated(
	'add_meta_boxes_comment',
	array( null ),
	'1.0.0',
	'',
	__( 'WP Comments feature is not supported in Retraceur.' )
);
