<?php
/**
 * Deprecated. Use rss.php instead.
 *
 * @package Retraceur
 * @deprecated WP 2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

_deprecated_file( basename( __FILE__ ), '2.1.0', WPINC . '/rss.php' );
require_once ABSPATH . WPINC . '/rss.php';
