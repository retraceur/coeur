<?php
/**
 * Network Contribute administration panel.
 *
 * @since WP 6.3.0
 * @since 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Multisite
 */

/** Load WordPress Administration Bootstrap */
require_once __DIR__ . '/admin.php';

if ( ! has_filter( 'retraceur_network_admin_contribute', 'retraceur_reseau_network_admin_contribute' ) ) {
	wp_die(
		'<h1>' . __( 'Retraceur does not provide the Multisite feature by default.' ) . '</h1>' .
		'<p>' . __( 'Please download and install the « Retraceur Réseau » add-on.' ) . '</p>',
		500
	);
}

/**
 * Filter Retraceur Réseau is using to dislay the Network Admin page.
 *
 * @since 1.0.0 Retraceur fork.
 *
 * @param boolean $value True to run the Network admin code, false otherwise.
 */
if ( apply_filters( 'retraceur_network_admin_contribute', false ) ) {
	require ABSPATH . 'wp-admin/contribute.php';
}
