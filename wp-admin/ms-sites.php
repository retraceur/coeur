<?php
/**
 * Multisite sites administration panel.
 *
 * @since WP 3.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Multisite
 */

require_once __DIR__ . '/admin.php';

_deprecated_file( basename( __FILE__ ), '1.0.0', '', '', true );

wp_die(
	'<h1>' . __( 'Are you lost?' ) . '</h1>' .
	'<p>' . __( 'This administration page does not exist.' ) . '</p>',
	404
);
