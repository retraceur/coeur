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
			'<div class="is-retraceur-size wp-block-site-logo">
				<a href="%1$s" class="custom-logo-link" rel="home" aria-current="page">
					<img width="60" height="60" src="%2$s" class="custom-logo" alt="%3$s" decoding="async" fetchpriority="high">
				</a>
			</div>',
			esc_url( home_url() ),
			esc_url( includes_url( 'images/retraceur-white-64x64.svg' ) ),
			esc_attr( get_bloginfo( 'name', 'display' ) )
		);
	}

	return $block;
}
add_filter( 'render_block_core/site-logo', 'retraceur_render_default_logo' );
