<?php
/**
 * Action handler for Multisite administration panels.
 *
 * @since WP 3.0.0
 * @since 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Multisite
 */

/** Load WordPress Administration Bootstrap */
require_once __DIR__ . '/admin.php';

if ( ! has_filter( 'retraceur_network_admin_edit', 'retraceur_reseau_network_admin_edit' ) ) {
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
if ( apply_filters( 'retraceur_network_admin_edit', false ) ) {
	$action = ( isset( $_GET['action'] ) ) ? $_GET['action'] : '';

	if ( empty( $action ) ) {
		wp_redirect( network_admin_url() );
		exit;
	}

	/**
	 * Fires just before the action handler in several Network Admin screens.
	 *
	 * This hook fires on multiple screens in the Multisite Network Admin,
	 * including Users, Network Settings, and Site Settings.
	 *
	 * @since WP 3.0.0
	 */
	do_action( 'wpmuadminedit' );

	/**
	 * Fires the requested handler action.
	 *
	 * The dynamic portion of the hook name, `$action`, refers to the name
	 * of the requested action derived from the `GET` request.
	 *
	 * @since WP 3.1.0
	 */
	do_action( "network_admin_edit_{$action}" );

	wp_redirect( network_admin_url() );
	exit;
}
