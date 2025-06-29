<?php
/**
 * Server-side rendering of the `core/post-format-name` block.
 *
 * @since 2.0.0 Retraceur fork.
 *
 * @package Retraceur
 */

/**
 * Renders the `core/post-format-name` block on the server.
 *
 * @since 2.0.0 Retraceur fork.
 *
 * @param array    $attributes Block attributes.
 * @param string   $content    Block default content.
 * @param WP_Block $block      Block instance.
 *
 * @return string Returns the output of the post format title.
 */
function render_block_core_post_format_name( $attributes, $content, $block ) {
	if ( ! isset( $block->context['postId'] ) ) {
		return '';
	}

	$supported_theme_formats = get_theme_support( 'post-formats' );
	$formats                 = is_array( $supported_theme_formats ) ? reset( $supported_theme_formats ) : array();

	if ( ! $formats ) {
		return '';
	}

	$post_id     =  (int) $block->context['postId'];
	$post_format = get_post_format( $post_id );

	if ( ! $post_format ) {
		$post_format = 'standard';
	}

	if ( ! in_array( $post_format, $formats, true ) ) {
		// Translators: %s: Post Format name.
		return sprintf( __( 'The %s post format is not supported by this Theme.' ), esc_html( $post_format ) );
	}

	$post_format_title = sprintf(
		// Translators: 1: Post Format title. 2: Post ID.
		__( '%1$s #%2$d' ),
		esc_html( get_post_format_singular_name( $post_format ) ),
		intval( $post_id )
	);

	$tag_name = 'h2';
	if ( isset( $attributes['level'] ) ) {
		$tag_name = 0 === $attributes['level'] ? 'p' : 'h' . (int) $attributes['level'];
	}

	if ( isset( $attributes['isLink'] ) && $attributes['isLink'] ) {
		$rel               = ! empty( $attributes['rel'] ) ? 'rel="' . esc_attr( $attributes['rel'] ) . '"' : '';
		$post_format_title = sprintf( '<a href="%1$s" target="%2$s" %3$s>%4$s</a>', esc_url( get_the_permalink( $block->context['postId'] ) ), esc_attr( $attributes['linkTarget'] ), $rel, $post_format_title );
	}

	$classes = array();
	if ( isset( $attributes['textAlign'] ) ) {
		$classes[] = 'has-text-align-' . $attributes['textAlign'];
	}
	if ( isset( $attributes['style']['elements']['link']['color']['text'] ) ) {
		$classes[] = 'has-link-color';
	}
	$wrapper_attributes = get_block_wrapper_attributes( array( 'class' => implode( ' ', $classes ) ) );

	return sprintf(
		'<%1$s %2$s>%3$s</%1$s>',
		$tag_name,
		$wrapper_attributes,
		$post_format_title
	);
}

/**
 * Registers the `core/post-format-name` block on the server.
 *
 * @since 2.0.0 Retraceur fork.
 */
function register_block_core_post_format_name() {
	register_block_type_from_metadata(
		__DIR__ . '/post-format-name',
		array(
			'render_callback' => 'render_block_core_post_format_name',
		)
	);
}
add_action( 'init', 'register_block_core_post_format_name' );
