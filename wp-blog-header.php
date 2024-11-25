<?php
/**
 * Loads the Retraceur environment and template.
 *
 * @package Retraceur
 */

if ( ! isset( $wp_did_header ) ) {

	$wp_did_header = true;

	// Load the Retraceur library.
	require_once __DIR__ . '/wp-load.php';

	// Set up the Retraceur query.
	wp();

	// Load the theme template.
	require_once ABSPATH . WPINC . '/template-loader.php';

}
