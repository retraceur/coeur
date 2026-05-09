<?php
/**
 * WP_HTTP_IXR_Client class.
 *
 * @since WP 3.1.0
 * @since 1.0.0 Retraceur fork.
 * @deprecated 4.0.0 Retraceur fork.
 *
 * @package Retraceur
 */

/** Include the bootstrap for setting up Retraceur environment */
require_once '../wp-load.php';

_deprecated_file( basename( __FILE__ ), '4.0.0', '', '', true );

wp_die(
	'<h1>' . __( 'Retraceur does not provide a XML-RPC API.' ) . '</h1>' .
	'<p>' . __( 'Use the REST API instead.' ) . '</p>',
	500
);
