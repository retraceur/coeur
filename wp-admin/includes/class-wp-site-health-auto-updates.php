<?php
/**
 * Class for testing automatic updates in the Retraceur code.
 *
 * @since WP 5.2.0
 * @since 1.0.0 Retraceur fork.
 * @deprecated 4.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Site_Health
 */

_deprecated_file( basename( __FILE__ ), '4.0.0', '', '', true );

#[AllowDynamicProperties]
class WP_Site_Health_Auto_Updates {
	/**
	 * WP_Site_Health_Auto_Updates constructor.
	 *
	 * @since WP 5.2.0
	 * @deprecated 4.0.0 Retraceur fork.
	 */
	public function __construct() {
		_deprecated_class( 'WP_Site_Health_Auto_Updates', '4.0.0', '', true );
	}


	/**
	 * Runs tests to determine if auto-updates can run.
	 *
	 * @since WP 5.2.0
	 * @deprecated 4.0.0 Retraceur fork.
	 *
	 * @return array The test results.
	 */
	public function run_tests() {
		_deprecated_function( __METHOD__, '4.0.0', '', true );

		return array();
	}

	/**
	 * Tests if auto-updates related constants are set correctly.
	 *
	 * @since WP 5.2.0
	 * @since WP 5.5.1 The `$value` parameter can accept an array.
	 * @deprecated 2.0.0 Retraceur fork.
	 *
	 * @param string $constant         The name of the constant to check.
	 * @param bool|string|array $value The value that the constant should be, if set,
	 *                                 or an array of acceptable values.
	 * @return array|null The test results if there are any constants set incorrectly,
	 *                    or null if the test passed.
	 */
	public function test_constants( $constant, $value ) {
		_deprecated_function( __METHOD__, '2.0.0', '', true );
		return null;
	}

	/**
	 * Checks if updates are intercepted by a filter.
	 *
	 * @since WP 5.2.0
	 * @deprecated 4.0.0 Retraceur fork.
	 *
	 * @return array|null The test results if `retraceur_version_check()` is disabled,
	 *                    or null if the test passed.
	 */
	public function test_wp_version_check_attached() {
		_deprecated_function( __METHOD__, '4.0.0', '', true );

		return null;
	}

	/**
	 * Checks if automatic updates are disabled by a filter.
	 *
	 * @since WP 5.2.0
	 * @deprecated 4.0.0 Retraceur fork.
	 *
	 * @return array|null The test results if the {@see 'retraceur_is_updater_enabled'} filter is set,
	 *                    or null if the test passed.
	 */
	public function test_filters_automatic_updater_disabled() {
		_deprecated_function( __METHOD__, '4.0.0', '', true );

		return null;
	}

	/**
	 * Checks if automatic updates are disabled.
	 *
	 * @since WP 5.3.0
	 * @deprecated 2.0.0 Retraceur fork.
	 *
	 * @return array|false The test results if auto-updates are disabled, false otherwise.
	 */
	public function test_wp_automatic_updates_disabled() {
		_deprecated_function( __METHOD__, '2.0.0', '', true );

		return false;
	}

	/**
	 * Checks if automatic updates have tried to run, but failed, previously.
	 *
	 * @since WP 5.2.0
	 * @deprecated 2.0.0 Retraceur fork.
	 *
	 * @return array|false The test results if auto-updates previously failed, false otherwise.
	 */
	public function test_if_failed_update() {
		_deprecated_function( __METHOD__, '2.0.0', '', true );

		return false;
	}

	/**
	 * Checks if Retraceur is controlled by a VCS (Git, Subversion etc).
	 *
	 * @since WP 5.2.0
	 * @deprecated 4.0.0 Retraceur fork.
	 *
	 * @return array The test results.
	 */
	public function test_vcs_abspath() {
		_deprecated_function( __METHOD__, '4.0.0', '', true );

		return array();
	}

	/**
	 * Checks if we can access files without providing credentials.
	 *
	 * @since WP 5.2.0
	 * @deprecated 4.0.0 Retraceur fork.
	 *
	 * @return array The test results.
	 */
	public function test_check_wp_filesystem_method() {
		_deprecated_function( __METHOD__, '4.0.0', '', true );

		return array();
	}

	/**
	 * Checks if core files are writable by the web user/group.
	 *
	 * @since WP 5.2.0
	 * @deprecated 4.0.0 Retraceur fork.
	 *
	 * @global WP_Filesystem_Base $wp_filesystem Retraceur filesystem subclass.
	 *
	 * @return array|false The test results if at least some of WP core files are writeable,
	 *                     or if a list of the checksums could not be retrieved.
	 *                     False if the core files are not writeable.
	 */
	public function test_all_files_writable() {
		_deprecated_function( __METHOD__, '4.0.0', '', true );

		return false;
	}

	/**
	 * Checks if the install is using a development branch and can use nightly packages.
	 *
	 * @since WP 5.2.0
	 * @deprecated 2.0.0 Retraceur fork.
	 *
	 * @return array|false|null The test results if development updates are blocked.
	 *                          False if it isn't a development version. Null if the test passed.
	 */
	public function test_accepts_dev_updates() {
		_deprecated_function( __METHOD__, '2.0.0', '', true );

		return false;
	}

	/**
	 * Checks if the site supports automatic minor updates.
	 *
	 * @since WP 5.2.0
	 * @deprecated 2.0.0 Retraceur fork.
	 *
	 * @return array|null The test results if minor updates are blocked,
	 *                    or null if the test passed.
	 */
	public function test_accepts_minor_updates() {
		_deprecated_function( __METHOD__, '2.0.0', '', true );

		return null;
	}
}
