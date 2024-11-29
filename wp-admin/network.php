<?php
/**
 * Network installation administration panel.
 *
 * A multi-step process allowing the user to enable a network of Retraceur sites.
 *
 * @since WP 3.0.0
 * @since 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Administration
 */

define( 'WP_INSTALLING_NETWORK', true );

/** Retraceur Administration Bootstrap */
require_once __DIR__ . '/admin.php';

if ( ! has_action( 'retraceur_install_network', 'retraceur_reseau_install_network' ) ) {
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
do_action( 'retraceur_install_network' );
