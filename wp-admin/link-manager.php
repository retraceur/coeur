<?php
/**
 * Link Management Administration Screen.
 *
 * @deprecated 1.0.0 Retraceur removed the Link/Bookmark API.
 *
 * @package Retraceur
 * @subpackage Administration
 */

/** Load Retraceur Administration Bootstrap */
require_once __DIR__ . '/admin.php';

_deprecated_file( basename( __FILE__ ), '1.0.0', '', '', true );

wp_die(
	'<h1>' . __( 'Retraceur does not provide a Link/Bookmark manager.' ) . '</h1>' .
	'<p>' . __( 'Please use a plugin instead.' ) . '</p>',
	500
);
