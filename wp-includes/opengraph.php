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
 * Retrieves the current Sitemaps server instance.
 *
 * @since 3.0.0 Retraceur fork.
 */
function retraceur_init_opengraph() {
	/**
	 * Filter here to completely disable the Retraceur Opengraph API.
	 *
	 * @since 3.0.0 Retraceur fork.
	 *
	 * @param boolean $value False to disable. True otherwise.
	 */
	if ( ! apply_filters( 'retraceur_opengraph_enabled', true ) ) {
		return;
	}

	// Load required classes.
	require ABSPATH . WPINC . '/opengraph/class-retraceur-opengraph-context.php';
	require ABSPATH . WPINC . '/opengraph/class-retraceur-opengraph-resolver.php';
	require ABSPATH . WPINC . '/opengraph/class-retraceur-opengraph-renderer.php';
	require ABSPATH . WPINC . '/opengraph/class-retraceur-opengraph-manager.php';

	$resolver = new Retraceur_Opengraph_Resolver();
	$renderer = new Retraceur_Opengraph_Renderer();
	$manager  = new Retraceur_Opengraph_Manager( $resolver, $renderer );

	$manager->register();
}
