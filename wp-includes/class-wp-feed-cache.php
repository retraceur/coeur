<?php
/**
 * Feed API: WP_Feed_Cache class.
 *
 * @since WP 4.7.0
 * @deprecated WP 5.6.0
 *
 * @package Retraceur
 * @subpackage Feed
 */

_deprecated_file(
	basename( __FILE__ ),
	'5.6.0',
	'',
	__( 'This file is only loaded for backward compatibility with SimplePie 1.2.x. Please consider switching to a recent SimplePie version.' )
);

/**
 * Core class used to implement a feed cache.
 *
 * @since WP 2.8.0
 */
#[AllowDynamicProperties]
class WP_Feed_Cache extends SimplePie\Cache {

	/**
	 * Creates a new SimplePie\Cache object.
	 *
	 * @since WP 2.8.0
	 *
	 * @param string $location  URL location (scheme is used to determine handler).
	 * @param string $filename  Unique identifier for cache object.
	 * @param string $extension 'spi' or 'spc'.
	 * @return WP_Feed_Cache_Transient Feed cache handler object that uses transients.
	 */
	public function create( $location, $filename, $extension ) {
		return new WP_Feed_Cache_Transient( $location, $filename, $extension );
	}
}
