<?php
/**
 * Post advanced form for inclusion in the administration panels.
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
 * Filters whether to enable the 'expand' functionality in the post editor.
 *
 * @since WP 4.0.0
 * @since WP 4.1.0 Added the `$post_type` parameter.
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param bool   $expand    Whether to enable the 'expand' functionality. Default true.
 * @param string $post_type Post type.
 */
apply_filters_deprecated(
	'wp_editor_expand',
	array( false, '' ),
	'1.0.0',
	'',
	__( 'WP Classic Editor feature is not supported in Retraceur.' )
);

/**
 * Filters the post updated messages.
 *
 * @since WP 3.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param array[] $messages Post updated messages. For defaults see `$messages` declarations above.
 */
apply_filters_deprecated(
	'post_updated_messages',
	array( array() ),
	'1.0.0',
	'',
	__( 'WP Classic Editor feature is not supported in Retraceur.' )
);

/**
 * Fires inside the post editor form tag.
 *
 * @since WP 3.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param WP_Post $post Post object.
 */
do_action_deprecated(
	'post_edit_form_tag',
	array( null ),
	'1.0.0',
	'',
	__( 'WP Classic Editor feature is not supported in Retraceur.' )
);

/**
 * Fires at the beginning of the edit form.
 *
 * At this point, the required hidden fields and nonces have already been output.
 *
 * @since WP 3.7.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param WP_Post $post Post object.
 */
do_action_deprecated(
	'edit_form_top',
	array( null ),
	'1.0.0',
	'',
	__( 'WP Classic Editor feature is not supported in Retraceur.' )
);

/**
 * Filters the title field placeholder text.
 *
 * @since WP 3.1.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string  $text Placeholder text. Default 'Add title'.
 * @param WP_Post $post Post object.
 */
apply_filters_deprecated(
	'enter_title_here',
	array( null ),
	'1.0.0',
	'',
	__( 'WP Classic Editor feature is not supported in Retraceur.' )
);

/**
 * Fires before the permalink field in the edit form.
 *
 * @since WP 4.1.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param WP_Post $post Post object.
 */
do_action_deprecated(
	'edit_form_before_permalink',
	array( null ),
	'1.0.0',
	'',
	__( 'WP Classic Editor feature is not supported in Retraceur.' )
);

/**
 * Fires after the title field.
 *
 * @since WP 3.5.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param WP_Post $post Post object.
 */
do_action_deprecated(
	'edit_form_after_title',
	array( null ),
	'1.0.0',
	'',
	__( 'WP Classic Editor feature is not supported in Retraceur.' )
);

/**
 * Fires after the content editor.
 *
 * @since WP 3.5.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param WP_Post $post Post object.
 */
do_action_deprecated(
	'edit_form_after_editor',
	array( null ),
	'1.0.0',
	'',
	__( 'WP Classic Editor feature is not supported in Retraceur.' )
);

/**
 * Fires before meta boxes with 'side' context are output for the 'page' post type.
 *
 * The submitpage box is a meta box with 'side' context, so this hook fires just before it is output.
 *
 * @since WP 2.5.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param WP_Post $post Post object.
 */
do_action_deprecated(
	'submitpage_box',
	array( null ),
	'1.0.0',
	'',
	__( 'WP Classic Editor feature is not supported in Retraceur.' )
);

/**
 * Fires before meta boxes with 'side' context are output for all post types other than 'page'.
 *
 * The submitpost box is a meta box with 'side' context, so this hook fires just before it is output.
 *
 * @since WP 2.5.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param WP_Post $post Post object.
 */
do_action_deprecated(
	'submitpost_box',
	array( null ),
	'1.0.0',
	'',
	__( 'WP Classic Editor feature is not supported in Retraceur.' )
);

/**
 * Fires after 'normal' context meta boxes have been output for the 'page' post type.
 *
 * @since WP 1.5.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param WP_Post $post Post object.
 */
do_action_deprecated(
	'edit_page_form',
	array( null ),
	'1.0.0',
	'',
	__( 'WP Classic Editor feature is not supported in Retraceur.' )
);

/**
 * Fires after 'normal' context meta boxes have been output for all post types other than 'page'.
 *
 * @since WP 1.5.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param WP_Post $post Post object.
 */
do_action_deprecated(
	'edit_form_advanced',
	array( null ),
	'1.0.0',
	'',
	__( 'WP Classic Editor feature is not supported in Retraceur.' )
);

/**
 * Fires after all meta box sections have been output, before the closing #post-body div.
 *
 * @since WP 2.1.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param WP_Post $post Post object.
 */
do_action_deprecated(
	'dbx_post_sidebar',
	array( null ),
	'1.0.0',
	'',
	__( 'WP Classic Editor feature is not supported in Retraceur.' )
);
