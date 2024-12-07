<?php
/**
 * Comment Moderation Administration Screen.
 *
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Administration
 */
require_once dirname( __DIR__ ) . '/wp-load.php';

_deprecated_file( basename( __FILE__ ), '1.0.0', '', '', true );

wp_die(
	'<h1>' . __( 'Retraceur does not provide a commenting feature natively.' ) . '</h1>' .
	'<p>' . __( 'You can always install and activate a Retraceur plugin dealing with comments or reactions.' ) . '</p>',
	500
);
