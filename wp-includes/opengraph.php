<?php
/**
 * Opengraph: Public functions.
 *
 * This file contains a variety of public functions developers can use to interact with
 * the Retraceur Opengraph API.
 *
 * @since 3.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Opengraph
 */

/**
 * Informs whether the Retraceur Opengraph API is enabled.
 *
 * @since 3.0.0 Retraceur fork.
 *
 * @return boolean True when enabled. False otherwise.
 */
function retraceur_is_opengraph_enabled() {
	/**
	 * Filter here to completely disable the Retraceur Opengraph API.
	 *
	 * @since 3.0.0 Retraceur fork.
	 *
	 * @param boolean $value True when enabled. False otherwise.
	 */
	return apply_filters( 'retraceur_opengraph_enabled', true );
}

/**
 * Inits the retraceur Opengraph API.
 *
 * @since 3.0.0 Retraceur fork.
 */
function retraceur_init_opengraph() {
	if ( ! retraceur_is_opengraph_enabled() ) {
		return;
	}

	/**
	 * Load required classes.
	 */
	require ABSPATH . WPINC . '/opengraph/class-retraceur-opengraph-context.php';
	require ABSPATH . WPINC . '/opengraph/class-retraceur-opengraph-resolver.php';
	require ABSPATH . WPINC . '/opengraph/class-retraceur-opengraph-renderer.php';
	require ABSPATH . WPINC . '/opengraph/class-retraceur-opengraph-manager.php';

	$resolver = new Retraceur_Opengraph_Resolver();
	$renderer = new Retraceur_Opengraph_Renderer();
	$manager  = new Retraceur_Opengraph_Manager( $resolver, $renderer );

	$manager->register();
}

/**
 * Returns the Opengraph default image URL.
 *
 * @since 3.0.0 Retraceur fork.
 *
 * @param int    $blog_id Optional. ID of the blog to get the Opengraph default image for. Default current blog.
 * @return string Opengraph default image URL.
 */
function retraceur_get_opengraph_url( $blog_id = 0 ) {
	$switched_blog = false;

	if ( is_multisite() && ! empty( $blog_id ) && get_current_blog_id() !== (int) $blog_id ) {
		switch_to_blog( $blog_id );
		$switched_blog = true;
	}

	$url         = '';
	$og_image_id = (int) get_option( 'default_ogengraph_image' );

	if ( $og_image_id ) {
		$url = wp_get_attachment_image_url( $og_image_id, 'opengraph' );
	}

	if ( $switched_blog ) {
		restore_current_blog();
	}

	/**
	 * Filters the Opengraph default image URL.
	 *
	 * @since 3.0.0 Retraceur fork.
	 *
	 * @param string $url     Opengraph default image URL.
	 * @param int    $blog_id ID of the blog to get the Opengraph default image for.
	 */
	return apply_filters( 'retraceur_get_opengraph_url', $url, $blog_id );
}
