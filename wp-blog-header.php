<?php
/**
 * Loads the motsVertueux environment and template.
 *
 * @package motsVertueux
 */

if ( ! isset( $wp_did_header ) ) {

	$wp_did_header = true;

	// Load the motsVertueux library.
	require_once __DIR__ . '/wp-load.php';

	// Set up the motsVertueux query.
	wp();

	// Load the theme template.
	require_once ABSPATH . WPINC . '/template-loader.php';

}
