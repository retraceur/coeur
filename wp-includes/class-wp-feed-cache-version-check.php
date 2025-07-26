<?php
/**
 * Feed API: class to avoid a SimplePie warning about the cache location.
 *
 * @since 2.0.0 Retraceur fork.
 *
 * @package Retraceur
 */

/**
 * Core class to avoid a SimplePie warning about the cache location.
 *
 * @since 2.0.0 Retraceur fork.
 */
#[AllowDynamicProperties]
class WP_Feed_Cache_Version_Check implements SimplePie\Cache\Base {

	/**
	 * Creates a new cache object.
	 *
	 * @since 2.0.0 Retraceur fork.
	 *
	 * @param string                           $location URL location (scheme is used to determine handler).
	 * @param string                           $name     Unique identifier for cache object.
	 * @param Base::TYPE_FEED|Base::TYPE_IMAGE $type     Either `TYPE_FEED` ('spc') for SimplePie data,
	 *                                                   or `TYPE_IMAGE` ('spi') for image data.
	 */
	public function __construct( $location, $name, $type ) { /* Do nothing. */ }

	/**
	 * Saves data to the transient.
	 *
	 * @since 2.0.0 Retraceur fork.
	 *
	 * @param array|SimplePie\SimplePie $data Data to save. If passed a SimplePie object,
	 *                                        only cache the `$data` property.
	 * @return true Always true.
	 */
	public function save( $data ) {
		return true;
	}

	/**
	 * Retrieves the data saved in the transient.
	 *
	 * @since 2.0.0 Retraceur fork.
	 *
	 * @return array Data for `SimplePie::$data`.
	 */
	public function load() {
		return array();
	}

	/**
	 * Gets mod transient.
	 *
	 * @since 2.0.0 Retraceur fork.
	 *
	 * @return int Timestamp.
	 */
	public function mtime() {
		return time();
	}

	/**
	 * Sets mod cache.
	 *
	 * @since 2.0.0 Retraceur fork.
	 *
	 * @return true Always true.
	 */
	public function touch() {
		return true;
	}

	/**
	 * Deletes cache.
	 *
	 * @since 2.0.0 Retraceur fork.
	 *
	 * @return true Always true.
	 */
	public function unlink() {
		return true;
	}
}
