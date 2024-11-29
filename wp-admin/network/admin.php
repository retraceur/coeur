<?php
/**
 * WordPress Network Administration Bootstrap.
 *
 * @since WP 3.1.0
 * @since 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Multisite
 */

define( 'WP_NETWORK_ADMIN', true );

/** Load WordPress Administration Bootstrap */
require_once dirname( __DIR__ ) . '/admin.php';

if ( ! has_filter( 'retraceur_network_admin', 'retraceur_reseau_network_admin' ) ) {
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
if ( apply_filters( 'retraceur_network_admin', false ) ) {
	// Do not remove this check. It is required by individual network admin pages.
	if ( ! is_multisite() ) {
		wp_die( __( 'Multisite support is not enabled.' ) );
	}

	$redirect_network_admin_request = ( 0 !== strcasecmp( $current_blog->domain, $current_site->domain ) || 0 !== strcasecmp( $current_blog->path, $current_site->path ) );

	/**
	 * Filters whether to redirect the request to the Network Admin.
	 *
	 * @since WP 3.2.0
	 *
	 * @param bool $redirect_network_admin_request Whether the request should be redirected.
	 */
	$redirect_network_admin_request = apply_filters( 'redirect_network_admin_request', $redirect_network_admin_request );

	if ( $redirect_network_admin_request ) {
		wp_redirect( network_admin_url() );
		exit;
	}

	unset( $redirect_network_admin_request );
}
