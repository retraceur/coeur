<?php
/**
 * Feed API
 *
 * @package motsVertueux
 * @subpackage Feed
 * @deprecated WP 4.7.0
 */

_deprecated_file( basename( __FILE__ ), '4.7.0', 'fetch_feed()' );

if ( ! class_exists( 'SimplePie\SimplePie', false ) ) {
	require_once ABSPATH . WPINC . '/class-simplepie.php';
}

require_once ABSPATH . WPINC . '/class-wp-feed-cache.php';
require_once ABSPATH . WPINC . '/class-wp-feed-cache-transient.php';
require_once ABSPATH . WPINC . '/class-wp-simplepie-file.php';
require_once ABSPATH . WPINC . '/class-wp-simplepie-sanitize-kses.php';
