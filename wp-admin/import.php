<?php
/**
 * Import Retraceur Administration Screen.
 *
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Administration
 */

define( 'WP_LOAD_IMPORTERS', true );

/** Load Retraceur Bootstrap */
require_once __DIR__ . '/admin.php';

_deprecated_file( basename( __FILE__ ), '1.0.0', '', '', true );

wp_die(
	'<h1>' . __( 'Retraceur does not provide Importers.' ) . '</h1>' .
	'<p>' . __( 'Try to find Retraceur plugins instead.' ) . '</p>',
	500
);
