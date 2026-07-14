<?php
/**
 * Retraceur core upgrade functionality.
 *
 * Note: Newly introduced functions and methods cannot be used here.
 * All functions must be present in the previous version being upgraded from
 * as this file is used there too.
 *
 * @since WP 2.7.0
 * @since 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Administration
 */

/**
 * Stores files to be deleted.
 *
 * Bundled theme files should not be included in this list.
 *
 * @since WP 2.7.0
 *
 * @global string[] $_old_files
 * @var string[]
 * @name $_old_files
 */
global $_old_files;

$_old_files = array(
	// 6.6
	'wp-includes/blocks/block/editor.css',
	'wp-includes/blocks/block/editor.min.css',
	'wp-includes/blocks/block/editor-rtl.css',
	'wp-includes/blocks/block/editor-rtl.min.css',
	/*
	 * 6.7
	 *
	 * WP 6.7 included a SimplePie upgrade that included a major
	 * refactoring of the file structure and library. The old files are
	 * split in to two sections to account for this: files and directories.
	 */
	// 6.7 - files
	'wp-includes/js/dist/interactivity-router.asset.php',
	'wp-includes/js/dist/interactivity-router.js',
	'wp-includes/js/dist/interactivity-router.min.js',
	'wp-includes/js/dist/interactivity-router.min.asset.php',
	'wp-includes/js/dist/interactivity.js',
	'wp-includes/js/dist/interactivity.min.js',
	'wp-includes/js/dist/vendor/react-dom.min.js.LICENSE.txt',
	'wp-includes/js/dist/vendor/react.min.js.LICENSE.txt',
	'wp-includes/js/dist/vendor/wp-polyfill-importmap.js',
	'wp-includes/js/dist/vendor/wp-polyfill-importmap.min.js',
	'wp-includes/sodium_compat/src/Core/Base64/Common.php',
	'wp-includes/SimplePie/Author.php',
	'wp-includes/SimplePie/Cache.php',
	'wp-includes/SimplePie/Caption.php',
	'wp-includes/SimplePie/Category.php',
	'wp-includes/SimplePie/Copyright.php',
	'wp-includes/SimplePie/Core.php',
	'wp-includes/SimplePie/Credit.php',
	'wp-includes/SimplePie/Enclosure.php',
	'wp-includes/SimplePie/Exception.php',
	'wp-includes/SimplePie/File.php',
	'wp-includes/SimplePie/gzdecode.php',
	'wp-includes/SimplePie/IRI.php',
	'wp-includes/SimplePie/Item.php',
	'wp-includes/SimplePie/Locator.php',
	'wp-includes/SimplePie/Misc.php',
	'wp-includes/SimplePie/Parser.php',
	'wp-includes/SimplePie/Rating.php',
	'wp-includes/SimplePie/Registry.php',
	'wp-includes/SimplePie/Restriction.php',
	'wp-includes/SimplePie/Sanitize.php',
	'wp-includes/SimplePie/Source.php',
	// 6.7 - directories
	'wp-includes/SimplePie/Cache/',
	'wp-includes/SimplePie/Content/',
	'wp-includes/SimplePie/Decode/',
	'wp-includes/SimplePie/HTTP/',
	'wp-includes/SimplePie/Net/',
	'wp-includes/SimplePie/Parse/',
	'wp-includes/SimplePie/XML/',
	// 6.8
	'wp-includes/blocks/post-content/editor.css',
	'wp-includes/blocks/post-content/editor.min.css',
	'wp-includes/blocks/post-content/editor-rtl.css',
	'wp-includes/blocks/post-content/editor-rtl.min.css',
	'wp-includes/blocks/post-template/editor.css',
	'wp-includes/blocks/post-template/editor.min.css',
	'wp-includes/blocks/post-template/editor-rtl.css',
	'wp-includes/blocks/post-template/editor-rtl.min.css',
	'wp-includes/js/dist/fields.min.js',
	'wp-includes/js/dist/fields.js',
	// 6.9
	'wp-includes/blocks/post-author/editor.css',
	'wp-includes/blocks/post-author/editor.min.css',
	'wp-includes/blocks/post-author/editor-rtl.css',
	'wp-includes/blocks/post-author/editor-rtl.min.css',
	'wp-includes/SimplePie/src/Decode',
	'wp-includes/SimplePie/src/Core.php',
	// Retraceur 4.0 - directories (7.0)
	'wp-includes/js/codemirror',
	'wp-includes/IXR',
);

/**
 * Stores Requests files to be preloaded and deleted.
 *
 * For classes/interfaces, use the class/interface name
 * as the array key.
 *
 * All other files/directories should not have a key.
 *
 * @since WP 6.2.0
 * @deprecated 2.0.0 Retraceur fork was introduced during 6.7 development cycle.
 *
 * @global string[] $_old_requests_files
 * @var string[]
 * @name $_old_requests_files
 */
global $_old_requests_files;

/**
 * Stores new files in wp-content to copy
 *
 * The contents of this array indicate any new bundled plugins/themes which
 * should be installed with the Retraceur Upgrade. These items will not be
 * re-installed in future upgrades, this behavior is controlled by the
 * introduced version present here being older than the current installed version.
 *
 * The content of this array should follow the following format:
 * Filename (relative to wp-content) => Introduced version
 * Directories should be noted by suffixing it with a trailing slash (/)
 *
 * @since WP 3.2.0
 * @since WP 4.7.0 New themes were not automatically installed for 4.4-4.6 on
 *              upgrade. New themes are now installed again. To disable new
 *              themes from being installed on upgrade, explicitly define
 *              CORE_UPGRADE_SKIP_NEW_BUNDLED as true.
 * @global string[] $_new_bundled_files
 * @var string[]
 * @name $_new_bundled_files
 */
global $_new_bundled_files;

$_new_bundled_files = array(
	'themes/point/' => '1.0.0',
);

/**
 * Upgrades the core of Retraceur.
 *
 * This will create a .maintenance file at the base of the Retraceur directory
 * to ensure that people can not access the website, when the files are being
 * copied to their locations.
 *
 * The files in the `$_old_files` list will be removed and the new files
 * copied from the zip file after the database is upgraded.
 *
 * The files in the `$_new_bundled_files` list will be added to the installation
 * if the version is greater than or equal to the old version being upgraded.
 *
 * The steps for the upgrader for after the new release is downloaded and
 * unzipped is:
 *
 *   1. Test unzipped location for select files to ensure that unzipped worked.
 *   2. Create the .maintenance file in current Retraceur base.
 *   3. Copy new Retraceur directory over old Retraceur files.
 *   4. Upgrade Retraceur to new version.
 *     1. Copy all files/folders other than wp-content
 *     2. Copy any language files to `WP_LANG_DIR` (which may differ from `WP_CONTENT_DIR`
 *     3. Copy any new bundled themes/plugins to their respective locations
 *   5. Delete new Retraceur directory path.
 *   6. Delete .maintenance file.
 *   7. Remove old files.
 *   8. Delete 'update_coeur' option.
 *
 * There are several areas of failure. For instance if PHP times out before step
 * 6, then you will not be able to access any portion of your site. Also, since
 * the upgrade will not continue where it left off, you will not be able to
 * automatically remove old files and remove the 'update_coeur' option. This
 * isn't that bad.
 *
 * If the copy of the new Retraceur over the old fails, then the worse is that
 * the new Retraceur directory will remain.
 *
 * If it is assumed that every file will be copied over, including plugins and
 * themes, then if you edit the default theme, you should rename it, so that
 * your changes remain.
 *
 * @since WP 2.7.0
 *
 * @global WP_Filesystem_Base $wp_filesystem          WP filesystem subclass.
 * @global string[]           $_old_files
 * @global string[]           $_new_bundled_files
 * @global wpdb               $wpdb                   WP database abstraction object.
 * @global string             $retraceur_version      The Retraceur version string.
 *
 * @param string $from New release unzipped path.
 * @param string $to   Path to old Retraceur installation.
 * @return string|WP_Error New Retraceur version on success, WP_Error on failure.
 */
function update_core( $from, $to ) {
	global $wp_filesystem, $_old_files, $_new_bundled_files, $wpdb;

	/*
 	 * Give core update script an additional 300 seconds (5 minutes)
 	 * to finish updating large files when running on slower servers.
 	 */
	if ( function_exists( 'set_time_limit' ) ) {
		set_time_limit( 300 );
	}

	/**
	 * Filters feedback messages displayed during the core update process.
	 *
	 * The filter is first evaluated after the zip file for the latest version
	 * has been downloaded and unzipped. It is evaluated five more times during
	 * the process:
	 *
	 * 1. Before Retraceur begins the core upgrade process.
	 * 2. Before Maintenance Mode is enabled.
	 * 3. Before Retraceur begins copying over the necessary files.
	 * 4. Before Maintenance Mode is disabled.
	 * 5. Before the database is upgraded.
	 *
	 * @since WP 2.5.0
	 *
	 * @param string $feedback The core update feedback messages.
	 */
	apply_filters( 'update_feedback', __( 'Verifying the unpacked files&#8230;' ) );

	// Confidence check the unzipped distribution.
	$distro = '';
	$root   = '/retraceur/';

	if ( $wp_filesystem->exists( $from . $root . 'README.md' ) && $wp_filesystem->exists( $from . $root . 'wp-includes/version.php' ) ) {
		$distro = $root;
	}

	if ( ! $distro ) {
		$wp_filesystem->delete( $from, true );

		return new WP_Error( 'insane_distro', __( 'The update could not be unpacked' ) );
	}

	/*
	 * Import $wp_version, $retraceur_version, $required_php_version, $required_php_extensions, and $required_mysql_version from the new version.
	 * DO NOT globalize any variables imported from `version-current.php` in this function.
	 *
	 * BC Note: $wp_filesystem->wp_content_dir() returned unslashed pre-2.8.
	 */
	$versions_file = trailingslashit( $wp_filesystem->wp_content_dir() ) . 'upgrade/version-current.php';

	if ( ! $wp_filesystem->copy( $from . $distro . 'wp-includes/version.php', $versions_file ) ) {
		$wp_filesystem->delete( $from, true );

		return new WP_Error(
			'copy_failed_for_version_file',
			__( 'The update cannot be installed because some files could not be copied. This is usually due to inconsistent file permissions.' ),
			'wp-includes/version.php'
		);
	}

	$wp_filesystem->chmod( $versions_file, FS_CHMOD_FILE );

	/*
	 * `wp_opcache_invalidate()` only exists in Retraceur 5.5 or later,
	 * so don't run it when upgrading from older versions.
	 */
	if ( function_exists( 'wp_opcache_invalidate' ) ) {
		wp_opcache_invalidate( $versions_file );
	}

	require WP_CONTENT_DIR . '/upgrade/version-current.php';
	$wp_filesystem->delete( $versions_file );

	$php_version    = PHP_VERSION;
	$mysql_version  = $wpdb->db_version();
	$old_wp_version = $GLOBALS['retraceur_version']; // The version of Retraceur we're updating from.
	/*
	 * Note: str_contains() is not used here, as this file is included
	 * when updating from older Retraceur versions, in which case
	 * the polyfills from wp-includes/compat.php may not be available.
	 */
	$development_build = ( false !== strpos( $old_wp_version . $retraceur_version, '-' ) ); // A dash in the version indicates a development release.
	$php_compat        = version_compare( $php_version, $required_php_version, '>=' );

	if ( file_exists( WP_CONTENT_DIR . '/db.php' ) && empty( $wpdb->is_mysql ) ) {
		$mysql_compat = true;
	} else {
		$mysql_compat = version_compare( $mysql_version, $required_mysql_version, '>=' );
	}

	if ( ! $mysql_compat || ! $php_compat ) {
		$wp_filesystem->delete( $from, true );
	}

	if ( ! $mysql_compat && ! $php_compat ) {
		return new WP_Error(
			'php_mysql_not_compatible',
			sprintf(
				/* translators: 1: Retraceur version number, 2: Minimum required PHP version number, 3: Minimum required MySQL version number, 4: Current PHP version number, 5: Current MySQL version number. */
				__( 'The update cannot be installed because Retraceur %1$s requires PHP version %2$s or higher and MySQL version %3$s or higher. You are running PHP version %4$s and MySQL version %5$s.' ),
				$retraceur_version,
				$required_php_version,
				$required_mysql_version,
				$php_version,
				$mysql_version
			)
		);
	} elseif ( ! $php_compat ) {
		return new WP_Error(
			'php_not_compatible',
			sprintf(
				/* translators: 1: Retraceur version number, 2: Minimum required PHP version number, 3: Current PHP version number. */
				__( 'The update cannot be installed because Retraceur %1$s requires PHP version %2$s or higher. You are running version %3$s.' ),
				$retraceur_version,
				$required_php_version,
				$php_version
			)
		);
	} elseif ( ! $mysql_compat ) {
		return new WP_Error(
			'mysql_not_compatible',
			sprintf(
				/* translators: 1: Retraceur version number, 2: Minimum required MySQL version number, 3: Current MySQL version number. */
				__( 'The update cannot be installed because Retraceur %1$s requires MySQL version %2$s or higher. You are running version %3$s.' ),
				$retraceur_version,
				$required_mysql_version,
				$mysql_version
			)
		);
	}

	if ( isset( $required_php_extensions ) && is_array( $required_php_extensions ) ) {
		$missing_extensions = new WP_Error();

		foreach ( $required_php_extensions as $extension ) {
			if ( extension_loaded( $extension ) ) {
				continue;
			}

			$missing_extensions->add(
				"php_not_compatible_{$extension}",
				sprintf(
					/* translators: 1: Retraceur version number, 2: The PHP extension name needed. */
					__( 'The update cannot be installed because Retraceur %1$s requires the %2$s PHP extension.' ),
					$retraceur_version,
					$extension
				)
			);
		}

		// Add a warning when required PHP extensions are missing.
		if ( ! empty( $missing_extensions->errors ) ) {
			return $missing_extensions;
		}
	}

	/** This filter is documented in wp-admin/includes/update-core.php */
	apply_filters( 'update_feedback', __( 'Preparing to install the latest version&#8230;' ) );

	/*
	 * Don't copy wp-content, we'll deal with that below.
	 * We also copy version.php last so failed updates report their old version.
	 */
	$skip              = array( 'wp-content', 'wp-includes/version.php' );
	$check_is_writable = array();

	// If we're using the direct method, we can predict write failures that are due to permissions.
	if ( $check_is_writable && 'direct' === $wp_filesystem->method ) {
		$files_writable = array_filter( $check_is_writable, array( $wp_filesystem, 'is_writable' ) );

		if ( $files_writable !== $check_is_writable ) {
			$files_not_writable = array_diff_key( $check_is_writable, $files_writable );

			foreach ( $files_not_writable as $relative_file_not_writable => $file_not_writable ) {
				// If the writable check failed, chmod file to 0644 and try again, same as copy_dir().
				$wp_filesystem->chmod( $file_not_writable, FS_CHMOD_FILE );

				if ( $wp_filesystem->is_writable( $file_not_writable ) ) {
					unset( $files_not_writable[ $relative_file_not_writable ] );
				}
			}

			// Store package-relative paths (the key) of non-writable files in the WP_Error object.
			$error_data = version_compare( $old_wp_version, '3.7-beta2', '>' ) ? array_keys( $files_not_writable ) : '';

			if ( $files_not_writable ) {
				return new WP_Error(
					'files_not_writable',
					__( 'The update cannot be installed because your site is unable to copy some files. This is usually due to inconsistent file permissions.' ),
					implode( ', ', $error_data )
				);
			}
		}
	}

	/** This filter is documented in wp-admin/includes/update-core.php */
	apply_filters( 'update_feedback', __( 'Enabling Maintenance mode&#8230;' ) );

	// Create maintenance file to signal that we are upgrading.
	$maintenance_string = '<?php $upgrading = ' . time() . '; ?>';
	$maintenance_file   = $to . '.maintenance';
	$wp_filesystem->delete( $maintenance_file );
	$wp_filesystem->put_contents( $maintenance_file, $maintenance_string, FS_CHMOD_FILE );

	/** This filter is documented in wp-admin/includes/update-core.php */
	apply_filters( 'update_feedback', __( 'Copying the required files&#8230;' ) );

	// Copy new versions of WP files into place.
	$result = copy_dir( $from . $distro, $to, $skip );

	if ( is_wp_error( $result ) ) {
		$result = new WP_Error(
			$result->get_error_code(),
			$result->get_error_message(),
			substr( $result->get_error_data(), strlen( $to ) )
		);
	}

	// Since we know the core files have copied over, we can now copy the version file.
	if ( ! is_wp_error( $result ) ) {
		if ( ! $wp_filesystem->copy( $from . $distro . 'wp-includes/version.php', $to . 'wp-includes/version.php', true /* overwrite */ ) ) {
			$wp_filesystem->delete( $from, true );
			$result = new WP_Error(
				'copy_failed_for_version_file',
				__( 'The update cannot be installed because your site is unable to copy some files. This is usually due to inconsistent file permissions.' ),
				'wp-includes/version.php'
			);
		}

		$wp_filesystem->chmod( $to . 'wp-includes/version.php', FS_CHMOD_FILE );

		/*
		 * `wp_opcache_invalidate()` only exists in Retraceur 5.5 or later,
		 * so don't run it when upgrading from older versions.
		 */
		if ( function_exists( 'wp_opcache_invalidate' ) ) {
			wp_opcache_invalidate( $to . 'wp-includes/version.php' );
		}
	}

	// Check to make sure everything copied correctly, ignoring the contents of wp-content.
	$skip   = array( 'wp-content' );
	$failed = array();

	// Some files didn't copy properly.
	if ( ! empty( $failed ) ) {
		$total_size = 0;

		foreach ( $failed as $file ) {
			if ( file_exists( $working_dir_local . $file ) ) {
				$total_size += filesize( $working_dir_local . $file );
			}
		}

		/*
		 * If we don't have enough free space, it isn't worth trying again.
		 * Unlikely to be hit due to the check in unzip_file().
		 */
		$available_space = function_exists( 'disk_free_space' ) ? @disk_free_space( ABSPATH ) : false;

		if ( $available_space && $total_size >= $available_space ) {
			$result = new WP_Error( 'disk_full', __( 'There is not enough free disk space to complete the update.' ) );
		} else {
			$result = copy_dir( $from . $distro, $to, $skip );

			if ( is_wp_error( $result ) ) {
				$result = new WP_Error(
					$result->get_error_code() . '_retry',
					$result->get_error_message(),
					substr( $result->get_error_data(), strlen( $to ) )
				);
			}
		}
	}

	/*
	 * Custom content directory needs updating now.
	 * Copy languages.
	 */
	if ( ! is_wp_error( $result ) && $wp_filesystem->is_dir( $from . $distro . 'wp-content/languages' ) ) {
		if ( WP_LANG_DIR !== ABSPATH . WPINC . '/languages' || @is_dir( WP_LANG_DIR ) ) {
			$lang_dir = WP_LANG_DIR;
		} else {
			$lang_dir = WP_CONTENT_DIR . '/languages';
		}
		/*
		 * Note: str_starts_with() is not used here, as this file is included
		 * when updating from older Retraceur versions, in which case
		 * the polyfills from wp-includes/compat.php may not be available.
		 */
		// Check if the language directory exists first.
		if ( ! @is_dir( $lang_dir ) && 0 === strpos( $lang_dir, ABSPATH ) ) {
			// If it's within the ABSPATH we can handle it here, otherwise they're out of luck.
			$wp_filesystem->mkdir( $to . str_replace( ABSPATH, '', $lang_dir ), FS_CHMOD_DIR );
			clearstatcache(); // For FTP, need to clear the stat cache.
		}

		if ( @is_dir( $lang_dir ) ) {
			$wp_lang_dir = $wp_filesystem->find_folder( $lang_dir );

			if ( $wp_lang_dir ) {
				$result = copy_dir( $from . $distro . 'wp-content/languages/', $wp_lang_dir );

				if ( is_wp_error( $result ) ) {
					$result = new WP_Error(
						$result->get_error_code() . '_languages',
						$result->get_error_message(),
						substr( $result->get_error_data(), strlen( $wp_lang_dir ) )
					);
				}
			}
		}
	}

	/** This filter is documented in wp-admin/includes/update-core.php */
	apply_filters( 'update_feedback', __( 'Disabling Maintenance mode&#8230;' ) );

	// Remove maintenance file, we're done with potential site-breaking changes.
	$wp_filesystem->delete( $maintenance_file );

	/*
	 * Copy new bundled plugins & themes.
	 * This gives us the ability to install new plugins & themes bundled with
	 * future versions of Retraceur whilst avoiding the re-install upon upgrade issue.
	 * $development_build controls us overwriting bundled themes and plugins when a non-stable release is being updated.
	 */
	if ( ! is_wp_error( $result )
		&& ( ! defined( 'CORE_UPGRADE_SKIP_NEW_BUNDLED' ) || ! CORE_UPGRADE_SKIP_NEW_BUNDLED )
	) {
		foreach ( (array) $_new_bundled_files as $file => $introduced_version ) {
			// If a $development_build or if $introduced version is greater than what the site was previously running.
			if ( $development_build || version_compare( $introduced_version, $old_wp_version, '>' ) ) {
				$directory = ( '/' === $file[ strlen( $file ) - 1 ] );

				list( $type, $filename ) = explode( '/', $file, 2 );

				// Check to see if the bundled items exist before attempting to copy them.
				if ( ! $wp_filesystem->exists( $from . $distro . 'wp-content/' . $file ) ) {
					continue;
				}

				if ( 'plugins' === $type ) {
					$dest = $wp_filesystem->wp_plugins_dir();
				} elseif ( 'themes' === $type ) {
					// Back-compat, ::wp_themes_dir() did not return trailingslash'd pre-3.2.
					$dest = trailingslashit( $wp_filesystem->wp_themes_dir() );
				} else {
					continue;
				}

				if ( ! $directory ) {
					if ( ! $development_build && $wp_filesystem->exists( $dest . $filename ) ) {
						continue;
					}

					if ( ! $wp_filesystem->copy( $from . $distro . 'wp-content/' . $file, $dest . $filename, FS_CHMOD_FILE ) ) {
						$result = new WP_Error( "copy_failed_for_new_bundled_$type", __( 'Could not copy file.' ), $dest . $filename );
					}
				} else {
					if ( ! $development_build && $wp_filesystem->is_dir( $dest . $filename ) ) {
						continue;
					}

					$wp_filesystem->mkdir( $dest . $filename, FS_CHMOD_DIR );
					$_result = copy_dir( $from . $distro . 'wp-content/' . $file, $dest . $filename );

					/*
					 * If an error occurs partway through this final step,
					 * keep the error flowing through, but keep the process going.
					 */
					if ( is_wp_error( $_result ) ) {
						if ( ! is_wp_error( $result ) ) {
							$result = new WP_Error();
						}

						$result->add(
							$_result->get_error_code() . "_$type",
							$_result->get_error_message(),
							substr( $_result->get_error_data(), strlen( $dest ) )
						);
					}
				}
			}
		} // End foreach.
	}

	// Handle $result error from the above blocks.
	if ( is_wp_error( $result ) ) {
		$wp_filesystem->delete( $from, true );

		return $result;
	}

	// Remove old files.
	foreach ( $_old_files as $old_file ) {
		$old_file = $to . $old_file;

		if ( ! $wp_filesystem->exists( $old_file ) ) {
			continue;
		}

		// If the file isn't deleted, try writing an empty string to the file instead.
		if ( ! $wp_filesystem->delete( $old_file, true ) && $wp_filesystem->is_file( $old_file ) ) {
			$wp_filesystem->put_contents( $old_file, '' );
		}
	}

	// Upgrade DB with separate request.
	/** This filter is documented in wp-admin/includes/update-core.php */
	apply_filters( 'update_feedback', __( 'Upgrading database&#8230;' ) );

	$db_upgrade_url = admin_url( 'upgrade.php?step=upgrade_db' );
	wp_remote_post( $db_upgrade_url, array( 'timeout' => 60 ) );

	// Clear the cache to prevent an update_option() from saving a stale db_version to the cache.
	wp_cache_flush();
	// Not all cache back ends listen to 'flush'.
	wp_cache_delete( 'alloptions', 'options' );

	// Remove working directory.
	$wp_filesystem->delete( $from, true );

	// Force refresh of update information.
	if ( function_exists( 'delete_site_transient' ) ) {
		delete_site_transient( 'update_coeur' );
	} else {
		delete_option( 'update_coeur' );
	}

	/**
	 * Fires after Retraceur core has been successfully updated.
	 *
	 * @since WP 3.3.0
	 *
	 * @param string $wp_version        The current WP version.
	 * @param string $retraceur_version The current Retraceur version.
	 */
	do_action( '_core_updated_successfully', $wp_version, $retraceur_version );

	return $retraceur_version;
}
