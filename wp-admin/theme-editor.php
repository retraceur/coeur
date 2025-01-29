<?php
/**
 * Theme file editor administration panel.
 *
 * @deprecated 1.0.0 Retraceur removed the faculty to edit theme files.
 *
 * @package Retraceur
 * @subpackage Administration
 */

/** Retraceur Administration Bootstrap */
require_once __DIR__ . '/admin.php';

_deprecated_file( basename( __FILE__ ), '1.0.0', '', '', true );

wp_die(
	'<h1>' . __( 'Retraceur does not support this.' ) . '</h1>' .
	'<p>' . __( 'Editing theme files is not supported by Retraceur.' ) . '</p>',
	500
);
