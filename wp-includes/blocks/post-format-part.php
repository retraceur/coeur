<?php
/**
 * Server-side rendering of the `core/post-format-part` block.
 *
 * @since 2.0.0 Retraceur fork.
 *
 * @package Retraceur
 */

/**
 * Renders the `core/post-format` block on the server.
 *
 * @since 2.0.0 Retraceur fork.
 *
 * @param array    $attributes Block attributes.
 * @param string   $content    Block default content.
 * @param WP_Block $block      Block instance.
 *
 * @return string Returns the output of the post, structured using the layout defined by the block's inner blocks
 *                and according the specified include/exclude attributes.
 */
function render_block_core_post_format_part( $attributes, $content, $block ) {
	$current_post_format = isset( $block->context['postFormat'] ) ? $block->context['postFormat'] : 'standard';
	$include_post_format = isset( $attributes['include'] ) ? $attributes['include'] : '';
	$exclude_post_format = isset( $attributes['exclude'] ) ? $attributes['exclude'] : '';

	if ( $exclude_post_format && ! $include_post_format ) {
		$supported_theme_formats = get_theme_support( 'post-formats' );
		$include_post_format     = is_array( $supported_theme_formats ) ? reset( $supported_theme_formats ) : array();
	}

	$include_post_format = wp_parse_slug_list( $include_post_format );
	$exclude_post_format = wp_parse_slug_list( $exclude_post_format );

	$show_post_format = array_diff( $include_post_format, $exclude_post_format );

	if ( ! in_array( $current_post_format, $show_post_format, true ) ) {
		return null;
	}

	return $content;
}

/**
 * Registers the `core/post-format-part` block on the server.
 *
 * @since 2.0.0 Retraceur fork.
 */
function register_block_core_post_format_part() {
	register_block_type_from_metadata(
		__DIR__ . '/post-format-part',
		array(
			'render_callback' => 'render_block_core_post_format_part',
		)
	);
}
add_action( 'init', 'register_block_core_post_format_part' );
