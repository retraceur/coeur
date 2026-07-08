<?php
/**
 * Upgrader API: Automatic_Upgrader_Skin class.
 *
 * @since WP 4.6.0
 * @since 1.0.0 Retraceur fork.
 * @deprecated 4.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Upgrader
 */

_deprecated_file( basename( __FILE__ ), '4.0.0', '', '', true );

/**
 * Upgrader Skin for Automatic Retraceur Upgrades.
 *
 * This skin is designed to be used when no output is intended, all output
 * is captured and stored for the caller to process and log/email/discard.
 *
 * @since WP 3.7.0
 * @since WP 4.6.0 Moved to its own file from wp-admin/includes/class-wp-upgrader-skins.php.
 * @deprecated 4.0.0 Retraceur fork.
 *
 * @see Bulk_Upgrader_Skin
 */
class Automatic_Upgrader_Skin extends WP_Upgrader_Skin {
	protected $messages = array();

	/**
	 * Constructor.
	 *
	 * @since 4.0.0 Retraceur fork.
	 */
	public function __construct() {
		_deprecated_class( 'Automatic_Upgrader_Skin', '4.0.0', '', true );
	}

	/**
	 * Determines whether the upgrader needs FTP/SSH details in order to connect
	 * to the filesystem.
	 *
	 * @since WP 3.7.0
	 * @since WP 4.6.0 The `$context` parameter default changed from `false` to an empty string.
	 * @deprecated 4.0.0 Retraceur fork.
	 *
	 * @see request_filesystem_credentials()
	 *
	 * @param bool|WP_Error $error                        Optional. Whether the current request has failed to connect,
	 *                                                    or an error object. Default false.
	 * @param string        $context                      Optional. Full path to the directory that is tested
	 *                                                    for being writable. Default empty.
	 * @param bool          $allow_relaxed_file_ownership Optional. Whether to allow Group/World writable. Default false.
	 * @return bool True on success, false on failure.
	 */
	public function request_filesystem_credentials( $error = false, $context = '', $allow_relaxed_file_ownership = false ) {
		_deprecated_function( __FUNCTION__, '4.0.0', '', true );
		return false;
	}

	/**
	 * Retrieves the upgrade messages.
	 *
	 * @since WP 3.7.0
	 * @deprecated 4.0.0 Retraceur fork.
	 *
	 * @return string[] Messages during an upgrade.
	 */
	public function get_upgrade_messages() {
		_deprecated_function( __FUNCTION__, '4.0.0', '', true );
		return $this->messages;
	}

	/**
	 * Stores a message about the upgrade.
	 *
	 * @since WP 3.7.0
	 * @since WP 5.9.0 Renamed `$data` to `$feedback` for PHP 8 named parameter support.
	 * @deprecated 4.0.0 Retraceur fork.
	 *
	 * @param string|array|WP_Error $feedback Message data.
	 * @param mixed                 ...$args  Optional text replacements.
	 */
	public function feedback( $feedback, ...$args ) {
		_deprecated_function( __FUNCTION__, '4.0.0', '', true );
	}

	/**
	 * Creates a new output buffer.
	 *
	 * @since WP 3.7.0
	 * @deprecated 4.0.0 Retraceur fork.
	 */
	public function header() {
		_deprecated_function( __FUNCTION__, '4.0.0', '', true );
	}

	/**
	 * Retrieves the buffered content, deletes the buffer, and processes the output.
	 *
	 * @since WP 3.7.0
	 * @deprecated 4.0.0 Retraceur fork.
	 */
	public function footer() {
		_deprecated_function( __FUNCTION__, '4.0.0', '', true );
	}
}
