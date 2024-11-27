<?php
/**
 * XML-RPC protocol support for WordPress.
 *
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 */

/** Include the bootstrap for setting up WordPress environment */
require_once __DIR__ . '/wp-load.php';

_deprecated_file( basename( __FILE__ ), '1.0.0', '', '', true );

wp_die(
	'<h1>' . __( 'Retraceur does not provide a XML-RPC API.' ) . '</h1>' .
	'<p>' . __( 'Use the REST API instead.' ) . '</p>',
	500
);
