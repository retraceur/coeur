<?php
/**
 * Confirms that the activation key that is sent in an email after a user signs
 * up for a new site matches the key for that user and then displays confirmation.
 *
 * @package Retraceur
 */

define( 'WP_INSTALLING', true );

/** Sets up the Retraceur Environment. */
require __DIR__ . '/wp-load.php';

if ( ! has_action( 'retraceur_network_activate_template', 'retraceur_reseau_activate_template' ) ) {
	/**
	 * Fires before the Site Activation page is loaded.
	 *
	 * @since WP 3.0.0
	 * @deprecated 1.0.0 Retraceur fork.
	 */
	do_action_deprecated(
		'activate_header',
		array(),
		'1.0.0',
		'',
		__( 'WP Multisite feature is not supported in Retraceur.' )
	);

	wp_die(
		'<h1>' . __( 'Retraceur does not provide the Multisite feature by default.' ) . '</h1>' .
		'<p>' . __( 'Please download and install the « Retraceur Réseau » add-on.' ) . '</p>',
		500
	);
}

/**
 * Hook used by Retraceur Réseau to inject Activation code.
 *
 * @since 1.0.0 Retraceur fork.
 */
do_action( 'retraceur_network_activate_template' );
