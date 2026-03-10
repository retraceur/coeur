<?php
/**
 * Class for testing automatic updates in the Retraceur code.
 *
 * @since WP 5.2.0
 * @since 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Site_Health
 */

#[AllowDynamicProperties]
class WP_Site_Health_Auto_Updates {
	/**
	 * WP_Site_Health_Auto_Updates constructor.
	 *
	 * @since WP 5.2.0
	 */
	public function __construct() {
		require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
	}


	/**
	 * Runs tests to determine if auto-updates can run.
	 *
	 * @since WP 5.2.0
	 *
	 * @return array The test results.
	 */
	public function run_tests() {
		$tests = array(
			$this->test_wp_version_check_attached(),
			$this->test_filters_automatic_updater_disabled(),
			$this->test_vcs_abspath(),
			$this->test_check_wp_filesystem_method(),
			$this->test_all_files_writable(),
		);

		$tests = array_filter( $tests );
		$tests = array_map(
			static function ( $test ) {
				$test = (object) $test;

				if ( empty( $test->severity ) ) {
					$test->severity = 'warning';
				}

				return $test;
			},
			$tests
		);

		return $tests;
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
	 *
	 * @return array|null The test results if `retraceur_version_check()` is disabled,
	 *                    or null if the test passed.
	 */
	public function test_wp_version_check_attached() {
		if ( ( ! is_multisite() || is_main_site() && is_network_admin() )
			&& ! has_filter( 'retraceur_version_check', 'retraceur_version_check' )
		) {
			return array(
				'description' => sprintf(
					/* translators: %s: Name of the filter used. */
					__( 'A plugin has prevented updates by disabling %s.' ),
					'<code>retraceur_version_check()</code>'
				),
				'severity'    => 'fail',
			);
		}

		return null;
	}

	/**
	 * Checks if automatic updates are disabled by a filter.
	 *
	 * @since WP 5.2.0
	 *
	 * @return array|null The test results if the {@see 'retraceur_is_updater_enabled'} filter is set,
	 *                    or null if the test passed.
	 */
	public function test_filters_automatic_updater_disabled() {
		/** This filter is documented in wp-admin/includes/class-wp-automatic-updater.php */
		if ( ! apply_filters( 'retraceur_is_updater_enabled', true ) ) {
			return array(
				'description' => sprintf(
					/* translators: %s: Name of the filter used. */
					__( 'The %s filter is disabled.' ),
					'<code>retraceur_is_updater_enabled</code>'
				),
				'severity'    => 'fail',
			);
		}

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
	 *
	 * @return array The test results.
	 */
	public function test_vcs_abspath() {
		$context_dirs = array( ABSPATH );
		$vcs_dirs     = array( '.svn', '.git', '.hg', '.bzr' );
		$check_dirs   = array();

		foreach ( $context_dirs as $context_dir ) {
			// Walk up from $context_dir to the root.
			do {
				$check_dirs[] = $context_dir;

				// Once we've hit '/' or 'C:\', we need to stop. dirname will keep returning the input here.
				if ( dirname( $context_dir ) === $context_dir ) {
					break;
				}

				// Continue one level at a time.
			} while ( $context_dir = dirname( $context_dir ) );
		}

		$check_dirs = array_unique( $check_dirs );
		$updater    = new WP_Automatic_Updater();
		$checkout   = false;

		// Search all directories we've found for evidence of version control.
		foreach ( $vcs_dirs as $vcs_dir ) {
			foreach ( $check_dirs as $check_dir ) {
				if ( ! $updater->is_allowed_dir( $check_dir ) ) {
					continue;
				}

				$checkout = is_dir( rtrim( $check_dir, '\\/' ) . "/$vcs_dir" );
				if ( $checkout ) {
					break 2;
				}
			}
		}

		/** This filter is documented in wp-admin/includes/class-wp-automatic-updater.php */
		if ( $checkout && ! apply_filters( 'automatic_updates_is_vcs_checkout', true, ABSPATH ) ) {
			return array(
				'description' => sprintf(
					/* translators: 1: Folder name. 2: Version control directory. 3: Filter name. */
					__( 'The folder %1$s was detected as being under version control (%2$s), but the %3$s filter is allowing updates.' ),
					'<code>' . $check_dir . '</code>',
					"<code>$vcs_dir</code>",
					'<code>automatic_updates_is_vcs_checkout</code>'
				),
				'severity'    => 'info',
			);
		}

		if ( $checkout ) {
			return array(
				'description' => sprintf(
					/* translators: 1: Folder name. 2: Version control directory. */
					__( 'The folder %1$s was detected as being under version control (%2$s).' ),
					'<code>' . $check_dir . '</code>',
					"<code>$vcs_dir</code>"
				),
				'severity'    => 'warning',
			);
		}

		return array(
			'description' => __( 'No version control systems were detected.' ),
			'severity'    => 'pass',
		);
	}

	/**
	 * Checks if we can access files without providing credentials.
	 *
	 * @since WP 5.2.0
	 *
	 * @return array The test results.
	 */
	public function test_check_wp_filesystem_method() {
		// Make sure the `request_filesystem_credentials()` function is available during our REST API call.
		if ( ! function_exists( 'request_filesystem_credentials' ) ) {
			require_once ABSPATH . 'wp-admin/includes/file.php';
		}

		$skin    = new Automatic_Upgrader_Skin();
		$success = $skin->request_filesystem_credentials( false, ABSPATH );

		if ( ! $success ) {
			$description  = __( 'Your installation of Retraceur prompts for FTP credentials to perform updates.' );
			$description .= ' ' . __( '(Your site is performing updates over FTP due to file ownership. Talk to your hosting company.)' );

			return array(
				'description' => $description,
				'severity'    => 'fail',
			);
		}

		return array(
			'description' => __( 'Your installation of Retraceur does not require FTP credentials to perform updates.' ),
			'severity'    => 'pass',
		);
	}

	/**
	 * Checks if core files are writable by the web user/group.
	 *
	 * @since WP 5.2.0
	 *
	 * @global WP_Filesystem_Base $wp_filesystem Retraceur filesystem subclass.
	 *
	 * @return array|false The test results if at least some of WP core files are writeable,
	 *                     or if a list of the checksums could not be retrieved.
	 *                     False if the core files are not writeable.
	 */
	public function test_all_files_writable() {
		global $wp_filesystem;

		require ABSPATH . WPINC . '/version.php'; // $retraceur_version; // x.y.z

		$skin    = new Automatic_Upgrader_Skin();
		$success = $skin->request_filesystem_credentials( false, ABSPATH );

		if ( ! $success ) {
			return false;
		}

		WP_Filesystem();

		if ( 'direct' !== $wp_filesystem->method ) {
			return false;
		}

		/*
		 * @todo Use GitHub assets generated checksums.
		 *
		 * Make sure the `get_core_checksums()` function is available during our REST API call.
		if ( ! function_exists( 'get_core_checksums' ) ) {
			require_once ABSPATH . 'wp-admin/includes/update.php';
		}

		$checksums = get_core_checksums( $retraceur_version, 'en_US' );
		$dev       = ( str_contains( $retraceur_version, '-' ) );
		// Get the last stable version's files and test against that.
		if ( ! $checksums && $dev ) {
			$checksums = get_core_checksums( (float) $retraceur_version - 0.1, 'en_US' );
		}

		// There aren't always checksums for development releases, so just skip the test if we still can't find any.
		if ( ! $checksums && $dev ) {
			return false;
		}

		if ( ! $checksums ) {
			$description = sprintf(
				// translators: %s: Retraceur version.
				__( "Couldn't retrieve a list of the checksums for Retraceur %s." ),
				$retraceur_version
			);
			return array(
				'description' => $description,
				'severity'    => 'warning',
			);
		}*/

		$unwritable_files = array();
		/*
		 * @todo Use GitHub assets generated checksums.
		 *
		 * foreach ( array_keys( $checksums ) as $file ) {
			if ( str_starts_with( $file, 'wp-content' ) ) {
				continue;
			}
			if ( ! file_exists( ABSPATH . $file ) ) {
				continue;
			}
			if ( ! is_writable( ABSPATH . $file ) ) {
				$unwritable_files[] = $file;
			}
		}*/

		if ( $unwritable_files ) {
			if ( count( $unwritable_files ) > 20 ) {
				$unwritable_files   = array_slice( $unwritable_files, 0, 20 );
				$unwritable_files[] = '...';
			}
			return array(
				'description' => __( 'Some files are not writable by Retraceur:' ) . ' <ul><li>' . implode( '</li><li>', $unwritable_files ) . '</li></ul>',
				'severity'    => 'fail',
			);
		} else {
			return array(
				'description' => __( 'All of your Retraceur files are writable.' ),
				'severity'    => 'pass',
			);
		}
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
