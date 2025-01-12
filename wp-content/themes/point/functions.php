<?php
/**
 * Point functions and definitions
 *
 * @package Retraceur
 * @subpackage Content/Themes/Point
 *
 * @since 1.0.0
 */

if ( ! function_exists( 'retraceur_point_setup' ) ) {
	/**
	 * Defines Theme features.
	 *
	 * @since 1.0.0
	 */
	function retraceur_point_setup() {
		add_theme_support( 'wp-block-styles' );

		// Use specific thumbnail size.
		set_post_thumbnail_size( 800, 400, true );
	}
	add_action( 'after_setup_theme', 'retraceur_point_setup' );
}

/**
 * Adds a Site logo fallback.
 *
 * @since 1.0.0
 *
 * @param string $block The block content.
 * @return string The block content.
 */
function retraceur_render_default_logo( $block = '' ) {
	if ( ! $block ) {
		$block = sprintf(
			'<div class="is-style-rounded is-style-rounded--1 wp-block-site-logo" style="padding-right:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30);padding-top:0;padding-bottom:0;">
				<a href="%1$s" class="custom-logo-link" rel="home" aria-current="page">
					<img width="64" height="64" src="%2$s" class="custom-logo" alt="%3$s" decoding="async" fetchpriority="high">
				</a>
			</div>',
			esc_url( home_url() ),
			esc_url( get_template_directory_uri() . '/assets/images/logo.svg' ),
			esc_attr( get_bloginfo( 'name', 'display' ) )
		);
	}

	return $block;
}
add_filter( 'render_block_core/site-logo', 'retraceur_render_default_logo' );

/**
 * Customize the post content's more link.
 *
 * @since 1.0.0
 *
 * @return string The customized post content's more link.
 */
function retraceur_point_more_link() {
	return sprintf(
		'<p class="ensemble-more-link">
			<a href="%1$s" class="more-link">%2$s &rarr;</a>
		</p>',
		esc_url( get_the_permalink() ),
		sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Read more<span class="screen-reader-text"> about "%s"</span>' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			esc_html( get_the_title() )
		)
	);
}
add_filter( 'the_content_more_link', 'retraceur_point_more_link', 10, 0 );
