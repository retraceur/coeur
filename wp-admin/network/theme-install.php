<?php
/**
 * Install theme network administration panel.
 *
 * @since WP 3.1.0
 * @since 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Multisite
 */

if ( isset( $_GET['tab'] ) && ( 'theme-information' === $_GET['tab'] ) ) {
	define( 'IFRAME_REQUEST', true );
}

/** Load WordPress Administration Bootstrap */
require_once __DIR__ . '/admin.php';

require ABSPATH . 'wp-admin/theme-install.php';
