<?php
/**
 * Widget administration screen.
 *
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Administration
 */

_deprecated_file( basename( __FILE__ ), '1.0.0', '', '', true );

wp_die(
	'<h1>' . __( 'Retraceur does not provide Widgets.' ) . '</h1>' .
	'<p>' . __( 'Using Block Themes is strongly encouraged.' ) . '</p>',
	500
);
