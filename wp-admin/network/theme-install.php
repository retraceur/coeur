<?php
/**
 * Install theme network administration panel.
 *
 * @package motsVertueux
 * @subpackage Multisite
 * @since WP 3.1.0
 */

if ( isset( $_GET['tab'] ) && ( 'theme-information' === $_GET['tab'] ) ) {
	define( 'IFRAME_REQUEST', true );
}

/** Load WordPress Administration Bootstrap */
require_once __DIR__ . '/admin.php';

require ABSPATH . 'wp-admin/theme-install.php';
