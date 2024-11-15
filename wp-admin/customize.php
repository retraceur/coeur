<?php
/**
 * Theme Customize Screen.
 *
 * @since WP 3.4.0
 * @deprecated 1.0.0 motsVertueux removed the customizer feature.
 *
 * @package motsVertueux
 * @subpackage Customize
 */

define( 'IFRAME_REQUEST', true );

/** Load motsVertueux Administration Bootstrap */
require_once __DIR__ . '/admin.php';

_deprecated_file( basename( __FILE__ ), '1.0.0', '', '', true );

wp_die(
	'<h1>' . __( 'motsVertueux does not provide a Customizer.' ) . '</h1>' .
	'<p>' . __( 'Using Block Themes is strongly encouraged.' ) . '</p>',
	500
);
