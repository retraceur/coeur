<?php
/**
 * Dependencies API: _WP_Dependency class.
 *
 * @since WP 4.7.0
 * @since 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Dependencies
 */

/**
 * Class _WP_Dependency
 *
 * Helper class to register a handle and associated data.
 *
 * @access private
 * @since WP 2.6.0
 */
#[AllowDynamicProperties]
class _WP_Dependency {
	/**
	 * The handle name.
	 *
	 * @since WP 2.6.0
	 * @var string
	 */
	public $handle;

	/**
	 * The handle source.
	 *
	 * If source is set to false, the item is an alias of other items it depends on.
	 *
	 * @since WP 2.6.0
	 * @var string|false
	 */
	public $src;

	/**
	 * An array of handle dependencies.
	 *
	 * @since WP 2.6.0
	 * @var string[]
	 */
	public $deps = array();

	/**
	 * The handle version.
	 *
	 * Used for cache-busting.
	 *
	 * @since WP 2.6.0
	 * @var bool|string
	 */
	public $ver = false;

	/**
	 * Additional arguments for the handle.
	 *
	 * @since WP 2.6.0
	 * @var array
	 */
	public $args = null;  // Custom property, such as $in_footer or $media.

	/**
	 * Extra data to supply to the handle.
	 *
	 * @since WP 2.6.0
	 * @var array
	 */
	public $extra = array();

	/**
	 * Translation textdomain set for this dependency.
	 *
	 * @since WP 5.0.0
	 * @var string
	 */
	public $textdomain;

	/**
	 * Translation path set for this dependency.
	 *
	 * @since WP 5.0.0
	 * @var string
	 */
	public $translations_path;

	/**
	 * Setup dependencies.
	 *
	 * @since WP 2.6.0
	 * @since WP 5.3.0 Formalized the existing `...$args` parameter by adding it
	 *              to the function signature.
	 *
	 * @param mixed ...$args Dependency information.
	 */
	public function __construct( ...$args ) {
		list( $this->handle, $this->src, $this->deps, $this->ver, $this->args ) = $args;
		if ( ! is_array( $this->deps ) ) {
			$this->deps = array();
		}
	}

	/**
	 * Add handle data.
	 *
	 * @since WP 2.6.0
	 *
	 * @param string $name The data key to add.
	 * @param mixed  $data The data value to add.
	 * @return bool False if not scalar, true otherwise.
	 */
	public function add_data( $name, $data ) {
		if ( ! is_scalar( $name ) ) {
			return false;
		}
		$this->extra[ $name ] = $data;
		return true;
	}

	/**
	 * Sets the translation domain for this dependency.
	 *
	 * @since WP 5.0.0
	 *
	 * @param string $domain The translation textdomain.
	 * @param string $path   Optional. The full file path to the directory containing translation files.
	 * @return bool False if $domain is not a string, true otherwise.
	 */
	public function set_translations( $domain, $path = '' ) {
		if ( ! is_string( $domain ) ) {
			return false;
		}
		$this->textdomain        = $domain;
		$this->translations_path = $path;
		return true;
	}
}
