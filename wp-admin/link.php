<?php
/**
 * Manage link administration actions.
 *
 * This page is accessed by the link management pages and handles the forms and
 * Ajax processes for link actions.
 *
 * @deprecated 1.0.0 motsVertueux removed the Link/Bookmark API.
 *
 * @package motsVertueux
 * @subpackage Administration
 */

/** Load motsVertueux Administration Bootstrap */
require_once __DIR__ . '/admin.php';

_deprecated_file( basename( __FILE__ ), '1.0.0', '', '', true );

wp_die(
	'<h1>' . __( 'motsVertueux does not provide a Link/Bookmark manager.' ) . '</h1>' .
	'<p>' . __( 'Please use a plugin instead.' ) . '</p>',
	500
);
