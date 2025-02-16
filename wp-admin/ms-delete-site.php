<?php
/**
 * Multisite delete site panel.
 *
 * @since WP 3.0.0
 * @since 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Multisite
 */

require_once __DIR__ . '/admin.php';

if ( ! has_action( 'retraceur_delete_site', 'retraceur_reseau_delete_site' ) ) {
	wp_die(
		'<h1>' . __( 'Retraceur does not provide the Multisite feature by default.' ) . '</h1>' .
		'<p>' . __( 'Please download and install the « Retraceur Réseau » add-on.' ) . '</p>',
		500
	);
}

/**
 * Fires to inform Retraceur Réseau can deal with Network install.
 *
 * @since 1.0.0 Retraceur fork.
 */
do_action( 'retraceur_delete_site' );
