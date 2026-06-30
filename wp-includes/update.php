<?php
/**
 * A simple set of functions to check the Version Update service.
 *
 * @since WP 2.3.0
 * @since 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 */

// Don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Fetches a repository's releases from its GitHub Atom feed.
 *
 * Reads the `releases.atom` feed of a GitHub repository and returns its entries.
 * Two strategies are available:
 *
 * - When `$use_core_feed_cache` is true, the feed is parsed with a dedicated
 *   SimplePie setup relying on the `WP_Feed_Cache_Version_Check` cache handler
 *   and the KSES sanitizer. This is used to check for Retraceur core updates.
 * - Otherwise the feed is retrieved with {@see fetch_feed()}, benefiting from the
 *   standard feed caching used for plugins, blocks and themes.
 *
 * @since 4.0.0 Retraceur fork.
 *
 * @param string $url                 URL of the repository `releases.atom` feed.
 * @param bool   $use_core_feed_cache Optional. Whether to use the dedicated core update
 *                                    feed cache instead of the standard `fetch_feed()`
 *                                    cache. Default false.
 * @return SimplePie\Item[]|WP_Error List of release items on success, WP_Error on failure.
 */
function retraceur_fetch_repository_releases( $url, $use_core_feed_cache = false ) {
	if ( $use_core_feed_cache ) {
		if ( ! class_exists( 'SimplePie\SimplePie', false ) ) {
			require_once ABSPATH . WPINC . '/class-simplepie.php';
		}

		require_once ABSPATH . WPINC . '/class-wp-simplepie-file.php';
		require_once ABSPATH . WPINC . '/class-wp-feed-cache-version-check.php';
		require_once ABSPATH . WPINC . '/class-wp-simplepie-sanitize-kses.php';

		$feed = new SimplePie\SimplePie();

		$feed->get_registry()->register( SimplePie\Sanitize::class, 'WP_SimplePie_Sanitize_KSES', true );
		/*
		 * We must manually overwrite $feed->sanitize because SimplePie's constructor
		 * sets it before we have a chance to set the sanitization class.
		 */
		$feed->sanitize = new WP_SimplePie_Sanitize_KSES();

		// Register the cache handler using the recommended method for SimplePie 1.3 or later.
		if ( method_exists( 'SimplePie_Cache', 'register' ) ) {
			SimplePie_Cache::register( 'retraceur_coeur_update', 'WP_Feed_Cache_Version_Check' );
			$feed->set_cache_location( 'retraceur_coeur_update' );
		}

		$feed->get_registry()->register( SimplePie\File::class, 'WP_SimplePie_File', true );

		$feed->set_feed_url( $url );
		$feed->init();
		$feed->set_output_encoding( get_bloginfo( 'charset' ) );

		if ( $feed->error() ) {
			return new WP_Error( 'simplepie-error', $feed->error() );
		}

		// Plugins, blocks or themes use regular SimplePie implementation to enjoy feed caching.
	} else {
		$feed = fetch_feed( $url );

		if ( is_wp_error( $feed ) ) {
			return $feed;
		}
	}

	return $feed->get_items();
}

/**
 * Look for Retraceur requirements parsing its release note content.
 *
 * @since 2.0.0 Retraceur fork.
 *
 * @param string $html HTML content of the release note.
 * @param string $type 'PHP' or 'MySQL'.
 * @return string The required version number.
 */
function retraceur_get_requirement( $html, $type = 'PHP' ) {
	$tags    = new WP_HTML_Tag_Processor( $html );
	$tag     = 'MySQL' === $type ? 'td' : 'th';
	$skip    = $type . ' >=';
	$version = '';
	$i       = 2;

	while ( $i > 0 && $tags->next_tag( $tag ) ) {
		$tags->next_token();

		$version = $tags->get_modifiable_text();
		if ( $skip === $version ) {
			$version = '';
		}

		$i--;
	}

	return $version;
}

/**
 * Checks if a Retraceur update is available.
 *
 * @since 2.0.0 Retraceur fork.
 *
 * @param bool $force_check Whether to bypass the transient cache and force a fresh update check.
 *                          Defaults to false.
 * @return object The available updates.
 */
function retraceur_version_check( $force_check = false ) {
	if ( wp_installing() ) {
		return;
	}

	$current         = get_site_transient( 'update_coeur' );
	$version_checked = retraceur_get_version();

	// Invalidate the transient when $retraceur_version changes.
	if ( is_object( $current ) && $version_checked !== $current->version_checked ) {
		$current = false;
	}

	if ( ! is_object( $current ) ) {
		$current                  = new stdClass();
		$current->updates         = array();
		$current->version_checked = $version_checked;
	}

	// Wait 1 day between multiple version check requests.
	$timeout          = DAY_IN_SECONDS;
	$time_not_changed = isset( $current->last_checked ) && $timeout > ( time() - $current->last_checked );

	if ( ! $force_check && $time_not_changed ) {
		return;
	}

	$current->last_checked = time();
	set_site_transient( 'update_coeur', $current );

	$releases = retraceur_fetch_repository_releases( 'https://github.com/retraceur/coeur/releases.atom', true );
	if ( is_wp_error( $releases ) ) {
		return $releases;
	}

	$offers   = array();
	$locale   = get_option( 'WPLANG' );
	$package  = 'retraceur.zip';

	if ( ! $locale ) {
		$locale = 'en_US';
	}

	/**
	 * When building the `retraceur-fr_FR.zip` package, it's required that a "retraceur" named folder
	 * is first compressed to `retraceur.zip` and then renamed as `retraceur-fr_FR.zip`.
	 */
	if ( 'fr_FR' === $locale ) {
		$package = 'retraceur-fr_FR.zip';
	}

	foreach ( $releases as $release ) {
		$version    = '';
		$release_id = explode( '/', rtrim( $release->get_id(), '/' ) );
		$version    = end( $release_id );
		$url        = $release->get_link();

		if ( ! $version ) {
			$url_data = explode( '/', rtrim( wp_parse_url( $url, PHP_URL_PATH ) ) );
			$version  = end( $url_data );
		}

		if ( ! $version || version_compare( $version, $version_checked, '<=' ) ) {
			continue;
		}

		$is_stable   = is_numeric( str_replace( '.', '', $version ) );
		$needs_php   = retraceur_get_requirement( $release->get_description() );
		$needs_mysql = retraceur_get_requirement( $release->get_description(), 'MySQL' );

		$offers[] = array(
			'version'      => $version,
			'url'          => $url,
			'download'     => trailingslashit( str_replace( 'tag', 'download', $url ) ) . $package,
			'requirements' => array(
				'php'   => strip_tags( $needs_php ),
				'mysql' => strip_tags( $needs_mysql ),
			),
			'date'         => $release->get_date( 'U' ),
			'stable'       => $is_stable,
			'locale'       => $locale,
		);
	}

	$updates                  = new stdClass();
	$updates->updates         = $offers;
	$updates->last_checked    = time();
	$updates->version_checked = $version_checked;

	set_site_transient( 'update_coeur', $updates );

	return $updates;
}

/**
 * Builds the update offer for a GitHub-hosted plugin or block.
 *
 * Reads the repository's `releases.atom` feed, selects the latest stable release
 * (pre-releases such as `v1.2.0-beta1` are skipped), and assembles the data
 * expected in the `update_plugins` site transient. The download package is derived
 * by convention from the release tag and the plugin slug:
 * `https://github.com/{owner}/{repo}/releases/download/{tag}/{slug}.zip`.
 *
 * The result is intentionally returned as an array: {@see wp_update_plugins()} casts
 * it to an object, compares its version and sorts it into the transient's `response`
 * or `no_update` list.
 *
 * @since 4.0.0 Retraceur fork.
 *
 * @param string   $owner_repo  GitHub full name of the repository, as `owner/repo`.
 * @param array    $plugin_data Plugin headers, as returned by {@see get_plugin_data()}.
 * @param string   $plugin_file Path to the plugin file, relative to the plugins directory.
 * @param string[] $locales     Installed locales to look up translations for.
 * @return array|false {
 *     Update data for the plugin, or false when no stable release was found or the feed
 *     could not be read.
 *
 *     @type string $id           GitHub full name of the repository (`owner/repo`).
 *     @type string $slug         Plugin slug (the plugin directory name).
 *     @type string $plugin       Path to the plugin file, relative to the plugins directory.
 *     @type string $version      Latest stable version available (tag without a leading `v`).
 *     @type string $package      URL of the release ZIP asset to install.
 *     @type string $url          URL of the release details on GitHub.
 *     @type string $requires_php Minimum PHP version required, from the `Requires PHP` header.
 *     @type string $requires_r   Minimum Retraceur version required, from the `Requires Retraceur` header.
 *     @type string $requires     Minimum WordPress version required, from the `Requires at least` header.
 * }
 */
function retraceur_get_plugin_update( $owner_repo, $plugin_data, $plugin_file, $locales ) {
	$items = retraceur_fetch_repository_releases( "https://github.com/{$owner_repo}/releases.atom" );

	if ( ! is_wp_error( $items ) && $items ) {
		foreach ( $items as $release ) {
			$id           = explode( '/', rtrim( $release->get_id(), '/' ) );
			$version      = end( $id );
			$stable_probe = ltrim( $version, 'vV' );

			if ( ! $version || ! is_numeric( str_replace( '.', '', $stable_probe ) ) ) {
				continue;
			}

			$slug = dirname( $plugin_file );

			return array(
				'id'           => $owner_repo,
				'slug'         => $slug,
				'plugin'       => $plugin_file,
				'version'      => $stable_probe,
				'package'      => "https://github.com/{$owner_repo}/releases/download/{$version}/{$slug}.zip",
				'url'          => $release->get_link(),
				'requires_php' => $plugin_data['RequiresPHP'],
				'requires_r'   => $plugin_data['RequiresR'],
				'requires'     => $plugin_data['RequiresWP'],
			);
		}
	}

	return false;
}

/**
 * Checks for available updates to plugins.
 *
 * Despite its name this function does not actually perform any updates, it only checks for available updates.
 *
 * @since WP 2.3.0
 * @since 1.0.0 Retraceur fork.
 * @since 4.0.0 Retraceur fork: use the Retraceur Update API (plugins need to be hosted on GitHub).
 *
 * @global string $retraceur_version The Retraceur version string.
 */
function wp_update_plugins() {
	if ( wp_installing() ) {
		return;
	}

	// If running blog-side, bail unless we've not checked in the last 12 hours.
	if ( ! function_exists( 'get_plugins' ) ) {
		require_once ABSPATH . 'wp-admin/includes/plugin.php';
	}

	$plugins      = get_plugins();
	$translations = wp_get_installed_translations( 'plugins' );

	$active  = get_option( 'active_plugins', array() );
	$current = get_site_transient( 'update_plugins' );

	if ( ! is_object( $current ) ) {
		$current = new stdClass();
	}

	$doing_cron = wp_doing_cron();

	// Check for update on a different schedule, depending on the page.
	switch ( current_filter() ) {
		case 'upgrader_process_complete':
			$timeout = 0;
			break;
		case 'load-update-core.php':
			$timeout = MINUTE_IN_SECONDS;
			break;
		case 'load-plugins.php':
		case 'load-update.php':
			$timeout = HOUR_IN_SECONDS;
			break;
		default:
			if ( $doing_cron ) {
				$timeout = 2 * HOUR_IN_SECONDS;
			} else {
				$timeout = 12 * HOUR_IN_SECONDS;
			}
	}

	$time_not_changed = isset( $current->last_checked ) && $timeout > ( time() - $current->last_checked );

	if ( $time_not_changed ) {
		$plugin_changed = false;

		foreach ( $plugins as $file => $p ) {
			if ( ! isset( $current->checked[ $file ] ) || (string) $current->checked[ $file ] !== (string) $p['Version'] ) {
				$plugin_changed = true;
			}
		}

		if ( isset( $current->response ) && is_array( $current->response ) ) {
			foreach ( $current->response as $plugin_file => $update_details ) {
				if ( ! isset( $plugins[ $plugin_file ] ) ) {
					$plugin_changed = true;
					break;
				}
			}
		}

		// Bail if we've checked recently and if nothing has changed.
		if ( ! $plugin_changed ) {
			return;
		}
	}

	// Update last_checked for current to prevent multiple blocking requests if request hangs.
	$current->last_checked = time();
	set_site_transient( 'update_plugins', $current );

	$locales = array_values( get_available_languages() );

	/**
	 * Filters the locales requested for plugin translations.
	 *
	 * @since WP 3.7.0
	 * @since WP 4.5.0 The default value of the `$locales` parameter changed to include all locales.
	 *
	 * @param string[] $locales Plugin locales. Default is all available locales of the site.
	 */
	$locales = apply_filters( 'plugins_update_check_locales', $locales );
	$locales = array_unique( $locales );

	if ( $doing_cron ) {
		$timeout = 30; // 30 seconds.
	} else {
		// Three seconds, plus one extra second for every 10 plugins.
		$timeout = 3 + (int) ( count( $plugins ) / 10 );
	}

	$updates               = new stdClass();
	$updates->last_checked = time();
	$updates->response     = array();
	$updates->translations = array();
	$updates->no_update    = array();
	foreach ( $plugins as $file => $p ) {
		$updates->checked[ $file ] = $p['Version'];
	}

	$installed_map = array_flip( retraceur_discovery_get_installed_map() );

	// Support updates for any plugins using the `Update URI` header field.
	foreach ( $plugins as $plugin_file => $plugin_data ) {
		$update = array();

		// Let plugins use their own updater first.
		if ( $plugin_data['UpdateURI'] ) {
			// Tiers qui n'utilise pas l'API de Retraceur
			$hostname = wp_parse_url( sanitize_url( $plugin_data['UpdateURI'] ), PHP_URL_HOST );

			/**
			 * Filters the update response for a given plugin hostname.
			 *
			 * The dynamic portion of the hook name, `$hostname`, refers to the hostname
			 * of the URI specified in the `Update URI` header field.
			 *
			 * @since WP 5.8.0
			 *
			 * @param array|false $update {
			 *     The plugin update data with the latest details. Default false.
			 *
			 *     @type string    $id           Optional. ID of the plugin for update purposes, should be a URI
			 *                                   specified in the `Update URI` header field.
			 *     @type string    $slug         Slug of the plugin.
			 *     @type string    $version      The version of the plugin.
			 *     @type string    $url          The URL for details of the plugin.
			 *     @type string    $package      Optional. The update ZIP for the plugin.
			 *     @type string    $tested       Optional. The version of WP the plugin is tested against.
			 *     @type string    $requires_php Optional. The version of PHP which the plugin requires.
			 *     @type bool      $autoupdate   Optional. Whether the plugin should automatically update.
			 *     @type string[]  $icons        Optional. Array of plugin icons.
			 *     @type string[]  $banners      Optional. Array of plugin banners.
			 *     @type string[]  $banners_rtl  Optional. Array of plugin RTL banners.
			 *     @type array     $translations {
			 *         Optional. List of translation updates for the plugin.
			 *
			 *         @type string $language   The language the translation update is for.
			 *         @type string $version    The version of the plugin this translation is for.
			 *                                  This is not the version of the language file.
			 *         @type string $updated    The update timestamp of the translation file.
			 *                                  Should be a date in the `YYYY-MM-DD HH:MM:SS` format.
			 *         @type string $package    The ZIP location containing the translation update.
			 *         @type string $autoupdate Whether the translation should be automatically installed.
			 *     }
			 * }
			 * @param array       $plugin_data      Plugin headers.
			 * @param string      $plugin_file      Plugin filename.
			 * @param string[]    $locales          Installed locales to look up translations for.
			 */
			$update = apply_filters( "update_plugins_{$hostname}", false, $plugin_data, $plugin_file, $locales );

			if ( ! $update ) {
				if ( 'github.com' === $hostname && ! isset( $installed_map[ $plugin_file ] ) ) {
					_doing_it_wrong(
						__FUNCTION__,
						sprintf(
							/* translators: 1: Plugin file. 2: The update_plugins_{hostname} filter name. */
							esc_html__( '%1$s defines the `Update URI` plugin header but does not filter `%2$s`. To use the Retraceur built-in updater, please use the `GitHub Plugin URI` header tag instead.' ),
							$plugin_file,
							"update_plugins_{$hostname}"
						),
						'4.0.0',
						true
					);

					continue;
				}
			}
		}

		// Default to the Retraceur updater if none was given.
		if ( ! $update && isset( $installed_map[ $plugin_file ] ) ) {
			$update = retraceur_get_plugin_update( $installed_map[ $plugin_file ], $plugin_data, $plugin_file, $locales );
		}

		if ( ! $update ) {
			continue;
		}

		$update = (object) $update;

		// Is it valid? We require at least a version.
		if ( ! isset( $update->version ) ) {
			continue;
		}

		// These should remain constant.
		if ( ! isset( $update->id )  ) {
			$update->id = $plugin_data['UpdateURI'];
		}

		if ( ! isset( $update->plugin )  ) {
			$update->plugin = $plugin_file;
		}

		// WP needs the version field specified as 'new_version'.
		if ( ! isset( $update->new_version ) ) {
			$update->new_version = $update->version;
		}

		// Handle any translation updates.
		if ( ! empty( $update->translations ) ) {
			foreach ( $update->translations as $translation ) {
				if ( isset( $translation['language'], $translation['package'] ) ) {
					$translation['type'] = 'plugin';
					$translation['slug'] = isset( $update->slug ) ? $update->slug : $update->id;

					$updates->translations[] = $translation;
				}
			}
		}

		unset( $updates->no_update[ $plugin_file ], $updates->response[ $plugin_file ] );

		if ( version_compare( $update->new_version, $plugin_data['Version'], '>' ) ) {
			$updates->response[ $plugin_file ] = $update;
		} else {
			$updates->no_update[ $plugin_file ] = $update;
		}
	}

	$sanitize_plugin_update_payload = static function ( &$item ) {
		$item = (object) $item;

		unset( $item->translations, $item->compatibility );

		return $item;
	};

	array_walk( $updates->response, $sanitize_plugin_update_payload );
	array_walk( $updates->no_update, $sanitize_plugin_update_payload );

	set_site_transient( 'update_plugins', $updates );
}

/**
 * Checks for available updates to themes.
 *
 * Despite its name this function does not actually perform any updates, it only checks for available updates.
 *
 * A list of all themes installed is sent to remote directory provider, along with the site locale.
 *
 * @since WP 2.7.0
 * @since 1.0.0 Retraceur fork.
 *
 * @global string $retraceur_version The Retraceur version string.
 *
 * @param array $extra_stats Extra statistics.
 */
function wp_update_themes( $extra_stats = array() ) {
	// Disable theme updates for now.
	return;

	if ( wp_installing() ) {
		return;
	}

	$installed_themes = wp_get_themes();
	$translations     = wp_get_installed_translations( 'themes' );

	$last_update = get_site_transient( 'update_themes' );

	if ( ! is_object( $last_update ) ) {
		$last_update = new stdClass();
	}

	$themes  = array();
	$checked = array();
	$request = array();

	// Put slug of active theme into request.
	$request['active'] = get_option( 'stylesheet' );

	foreach ( $installed_themes as $theme ) {
		$checked[ $theme->get_stylesheet() ] = $theme->get( 'Version' );

		$themes[ $theme->get_stylesheet() ] = array(
			'Name'       => $theme->get( 'Name' ),
			'Title'      => $theme->get( 'Name' ),
			'Version'    => $theme->get( 'Version' ),
			'Author'     => $theme->get( 'Author' ),
			'Author URI' => $theme->get( 'AuthorURI' ),
			'UpdateURI'  => $theme->get( 'UpdateURI' ),
			'Template'   => $theme->get_template(),
			'Stylesheet' => $theme->get_stylesheet(),
		);
	}

	$doing_cron = wp_doing_cron();

	// Check for update on a different schedule, depending on the page.
	switch ( current_filter() ) {
		case 'upgrader_process_complete':
			$timeout = 0;
			break;
		case 'load-update-core.php':
			$timeout = MINUTE_IN_SECONDS;
			break;
		case 'load-themes.php':
		case 'load-update.php':
			$timeout = HOUR_IN_SECONDS;
			break;
		default:
			if ( $doing_cron ) {
				$timeout = 2 * HOUR_IN_SECONDS;
			} else {
				$timeout = 12 * HOUR_IN_SECONDS;
			}
	}

	$time_not_changed = isset( $last_update->last_checked ) && $timeout > ( time() - $last_update->last_checked );

	if ( $time_not_changed && ! $extra_stats ) {
		$theme_changed = false;

		foreach ( $checked as $slug => $v ) {
			if ( ! isset( $last_update->checked[ $slug ] ) || (string) $last_update->checked[ $slug ] !== (string) $v ) {
				$theme_changed = true;
			}
		}

		if ( isset( $last_update->response ) && is_array( $last_update->response ) ) {
			foreach ( $last_update->response as $slug => $update_details ) {
				if ( ! isset( $checked[ $slug ] ) ) {
					$theme_changed = true;
					break;
				}
			}
		}

		// Bail if we've checked recently and if nothing has changed.
		if ( ! $theme_changed ) {
			return;
		}
	}

	// Update last_checked for current to prevent multiple blocking requests if request hangs.
	$last_update->last_checked = time();
	set_site_transient( 'update_themes', $last_update );

	$request['themes'] = $themes;

	$locales = array_values( get_available_languages() );

	/**
	 * Filters the locales requested for theme translations.
	 *
	 * @since WP 3.7.0
	 * @since WP 4.5.0 The default value of the `$locales` parameter changed to include all locales.
	 *
	 * @param string[] $locales Theme locales. Default is all available locales of the site.
	 */
	$locales = apply_filters( 'themes_update_check_locales', $locales );
	$locales = array_unique( $locales );

	if ( $doing_cron ) {
		$timeout = 30; // 30 seconds.
	} else {
		// Three seconds, plus one extra second for every 10 themes.
		$timeout = 3 + (int) ( count( $themes ) / 10 );
	}

	$options = array(
		'timeout'    => $timeout,
		'body'       => array(
			'themes'       => wp_json_encode( $request ),
			'translations' => wp_json_encode( $translations ),
			'locale'       => wp_json_encode( $locales ),
		),
		'user-agent' => 'Retraceur/' . retraceur_get_version() . '; ' . home_url( '/' ),
	);

	// @todo See what's doable using GitHub.
	$url      = '';
	$http_url = $url;
	$ssl      = wp_http_supports( array( 'ssl' ) );

	if ( $ssl ) {
		$url = set_url_scheme( $url, 'https' );
	}

	$raw_response = wp_remote_post( $url, $options );

	if ( $ssl && is_wp_error( $raw_response ) ) {
		wp_trigger_error(
			__FUNCTION__,
			__( 'An unexpected error occurred. Something may be wrong with this server&#8217;s configuration.' ) . ' ' . __( '(Retraceur could not establish a secure connection to Theme updater. Please contact your server administrator.)' ),
			headers_sent() || WP_DEBUG ? E_USER_WARNING : E_USER_NOTICE
		);
		$raw_response = wp_remote_post( $http_url, $options );
	}

	if ( is_wp_error( $raw_response ) || 200 !== wp_remote_retrieve_response_code( $raw_response ) ) {
		return;
	}

	$new_update               = new stdClass();
	$new_update->last_checked = time();
	$new_update->checked      = $checked;

	$response = json_decode( wp_remote_retrieve_body( $raw_response ), true );

	if ( is_array( $response ) ) {
		$new_update->response     = $response['themes'];
		$new_update->no_update    = $response['no_update'];
		$new_update->translations = $response['translations'];
	}

	// Support updates for any themes using the `Update URI` header field.
	foreach ( $themes as $theme_stylesheet => $theme_data ) {
		if ( ! $theme_data['UpdateURI'] || isset( $new_update->response[ $theme_stylesheet ] ) ) {
			continue;
		}

		$hostname = wp_parse_url( sanitize_url( $theme_data['UpdateURI'] ), PHP_URL_HOST );

		/**
		 * Filters the update response for a given theme hostname.
		 *
		 * The dynamic portion of the hook name, `$hostname`, refers to the hostname
		 * of the URI specified in the `Update URI` header field.
		 *
		 * @since WP 6.1.0
		 *
		 * @param array|false $update {
		 *     The theme update data with the latest details. Default false.
		 *
		 *     @type string $id           Optional. ID of the theme for update purposes, should be a URI
		 *                                specified in the `Update URI` header field.
		 *     @type string $theme        Directory name of the theme.
		 *     @type string $version      The version of the theme.
		 *     @type string $url          The URL for details of the theme.
		 *     @type string $package      Optional. The update ZIP for the theme.
		 *     @type string $tested       Optional. The version of WP the theme is tested against.
		 *     @type string $requires_php Optional. The version of PHP which the theme requires.
		 *     @type bool   $autoupdate   Optional. Whether the theme should automatically update.
		 *     @type array  $translations {
		 *         Optional. List of translation updates for the theme.
		 *
		 *         @type string $language   The language the translation update is for.
		 *         @type string $version    The version of the theme this translation is for.
		 *                                  This is not the version of the language file.
		 *         @type string $updated    The update timestamp of the translation file.
		 *                                  Should be a date in the `YYYY-MM-DD HH:MM:SS` format.
		 *         @type string $package    The ZIP location containing the translation update.
		 *         @type string $autoupdate Whether the translation should be automatically installed.
		 *     }
		 * }
		 * @param array       $theme_data       Theme headers.
		 * @param string      $theme_stylesheet Theme stylesheet.
		 * @param string[]    $locales          Installed locales to look up translations for.
		 */
		$update = apply_filters( "update_themes_{$hostname}", false, $theme_data, $theme_stylesheet, $locales );

		if ( ! $update ) {
			continue;
		}

		$update = (object) $update;

		// Is it valid? We require at least a version.
		if ( ! isset( $update->version ) ) {
			continue;
		}

		// This should remain constant.
		$update->id = $theme_data['UpdateURI'];

		// WP needs the version field specified as 'new_version'.
		if ( ! isset( $update->new_version ) ) {
			$update->new_version = $update->version;
		}

		// Handle any translation updates.
		if ( ! empty( $update->translations ) ) {
			foreach ( $update->translations as $translation ) {
				if ( isset( $translation['language'], $translation['package'] ) ) {
					$translation['type'] = 'theme';
					$translation['slug'] = isset( $update->theme ) ? $update->theme : $update->id;

					$new_update->translations[] = $translation;
				}
			}
		}

		unset( $new_update->no_update[ $theme_stylesheet ], $new_update->response[ $theme_stylesheet ] );

		if ( version_compare( $update->new_version, $theme_data['Version'], '>' ) ) {
			$new_update->response[ $theme_stylesheet ] = (array) $update;
		} else {
			$new_update->no_update[ $theme_stylesheet ] = (array) $update;
		}
	}

	set_site_transient( 'update_themes', $new_update );
}

/**
 * Retrieves a list of all language updates available.
 *
 * @since WP 3.7.0
 * @since 1.0.0 Retraceur fork.
 *
 * @return object[] Array of translation objects that have available updates.
 */
function wp_get_translation_updates() {
	// Disable translation updates for now.
	return array();

	$updates    = array();
	$transients = array(
		'update_coeur'   => 'core',
		'update_plugins' => 'plugin',
		'update_themes'  => 'theme',
	);

	foreach ( $transients as $transient => $type ) {
		$transient = get_site_transient( $transient );

		if ( empty( $transient->translations ) ) {
			continue;
		}

		foreach ( $transient->translations as $translation ) {
			$updates[] = (object) $translation;
		}
	}

	return $updates;
}

/**
 * Checks whether the Automatic Updater is enabled or not.
 *
 * @since 1.0.0 Retraceur fork.
 *
 * @return boolean True if the Automatic Updater is enabled. False otherwise.
 */
function retraceur_is_updater_enabled() {
	$enabled = true;

	if ( ! wp_is_file_mod_allowed( 'retraceur_updater' ) || wp_installing() ) {
		$enabled = false;
	}

	/**
	 * Filters whether to entirely disable the Retraceur updater.
	 *
	 * @since 2.0.0 Retraceur fork.
	 *
	 * @param boolean $enabled True if enabled. False otherwise.
	 */
	return apply_filters( 'retraceur_is_updater_enabled', $enabled );
}

/**
 * Collects counts and UI strings for available updates.
 *
 * @since WP 3.3.0
 *
 * @return array {
 *     Fetched update data.
 *
 *     @type int[]   $counts       An array of counts for available plugin, theme, and WP updates.
 *     @type string  $update_title Titles of available updates.
 * }
 */
function wp_get_update_data() {
	$counts = array(
		'plugins'      => 0,
		'themes'       => 0,
		'retraceur'    => 0,
		'translations' => 0,
	);

	$plugins = current_user_can( 'update_plugins' );

	if ( $plugins ) {
		$update_plugins = get_site_transient( 'update_plugins' );

		if ( ! empty( $update_plugins->response ) ) {
			$counts['plugins'] = count( $update_plugins->response );
		}
	}

	$themes = current_user_can( 'update_themes' );

	if ( $themes ) {
		$update_themes = get_site_transient( 'update_themes' );

		if ( ! empty( $update_themes->response ) ) {
			$counts['themes'] = count( $update_themes->response );
		}
	}

	$core = current_user_can( 'update_core' );

	if ( $core && function_exists( 'retraceur_get_updates' ) ) {
		$update_retraceur = retraceur_get_updates( array( 'dismissed' => false ) );

		if ( ! empty( $update_retraceur )
			&& true === $update_retraceur[0]['stable']
			&& current_user_can( 'update_core' )
		) {
			$counts['retraceur'] = 1;
		}
	}

	if ( ( $core || $plugins || $themes ) && wp_get_translation_updates() ) {
		$counts['translations'] = 1;
	}

	$counts['total'] = $counts['plugins'] + $counts['themes'] + $counts['retraceur'] + $counts['translations'];
	$titles          = array();

	if ( $counts['retraceur'] ) {
		/* translators: %d: Number of available Retraceur updates. */
		$titles['retraceur'] = sprintf( __( '%d Retraceur Update' ), $counts['retraceur'] );
	}

	if ( $counts['plugins'] ) {
		/* translators: %d: Number of available plugin updates. */
		$titles['plugins'] = sprintf( _n( '%d Plugin Update', '%d Plugin Updates', $counts['plugins'] ), $counts['plugins'] );
	}

	if ( $counts['themes'] ) {
		/* translators: %d: Number of available theme updates. */
		$titles['themes'] = sprintf( _n( '%d Theme Update', '%d Theme Updates', $counts['themes'] ), $counts['themes'] );
	}

	if ( $counts['translations'] ) {
		$titles['translations'] = __( 'Translation Updates' );
	}

	$update_title = $titles ? esc_attr( implode( ', ', $titles ) ) : '';

	$update_data = array(
		'counts' => $counts,
		'title'  => $update_title,
	);
	/**
	 * Filters the returned array of update data for plugins, themes, and WP core.
	 *
	 * @since WP 3.5.0
	 *
	 * @param array $update_data {
	 *     Fetched update data.
	 *
	 *     @type int[]   $counts       An array of counts for available plugin, theme, and WP updates.
	 *     @type string  $update_title Titles of available updates.
	 * }
	 * @param array $titles An array of update counts and UI strings for available updates.
	 */
	return apply_filters( 'wp_get_update_data', $update_data, $titles );
}

/**
 * Determines whether core should be updated.
 *
 * @since WP 2.8.0
 */
function _maybe_update_core() {
	$current = get_site_transient( 'update_coeur' );

	if ( isset( $current->last_checked, $current->version_checked )
		&& 12 * HOUR_IN_SECONDS > ( time() - $current->last_checked )
		&& retraceur_get_version() === $current->version_checked
	) {
		return;
	}

	retraceur_version_check();
}
/**
 * Checks the last time plugins were run before checking plugin versions.
 *
 * This might have been backported to WP 2.6.1 for performance reasons.
 * This is used for the wp-admin to check only so often instead of every page
 * load.
 *
 * @since WP 2.7.0
 * @access private
 */
function _maybe_update_plugins() {
	$current = get_site_transient( 'update_plugins' );

	if ( isset( $current->last_checked )
		&& 12 * HOUR_IN_SECONDS > ( time() - $current->last_checked )
	) {
		return;
	}

	wp_update_plugins();
}

/**
 * Checks themes versions only after a duration of time.
 *
 * This is for performance reasons to make sure that on the theme version
 * checker is not run on every page load.
 *
 * @since WP 2.7.0
 * @access private
 */
function _maybe_update_themes() {
	$current = get_site_transient( 'update_themes' );

	if ( isset( $current->last_checked )
		&& 12 * HOUR_IN_SECONDS > ( time() - $current->last_checked )
	) {
		return;
	}

	wp_update_themes();
}

/**
 * Schedules core, theme, and plugin update checks.
 *
 * @since WP 3.1.0
 */
function wp_schedule_update_checks() {
	if ( ! wp_next_scheduled( 'retraceur_version_check' ) && ! wp_installing() ) {
		wp_schedule_event( time(), 'twicedaily', 'retraceur_version_check' );
	}

	if ( ! wp_next_scheduled( 'wp_update_plugins' ) && ! wp_installing() ) {
		wp_schedule_event( time(), 'twicedaily', 'wp_update_plugins' );
	}

	/**
	 * Disable Theme new update checks for now.
	 *
	 * @todo Restore it once adaptations to Retraceur fork are put in place.
	 */
	/*if ( ! wp_next_scheduled( 'wp_update_themes' ) && ! wp_installing() ) {
		wp_schedule_event( time(), 'twicedaily', 'wp_update_themes' );
	}*/
}

/**
 * Clears existing update caches for plugins, themes, and core.
 *
 * @since WP 4.1.0
 */
function wp_clean_update_cache() {
	if ( function_exists( 'wp_clean_plugins_cache' ) ) {
		wp_clean_plugins_cache();
	} else {
		delete_site_transient( 'update_plugins' );
	}

	wp_clean_themes_cache();

	delete_site_transient( 'update_coeur' );
}

/**
 * Schedules the removal of all contents in the temporary backup directory.
 *
 * @since WP 6.3.0
 */
function wp_delete_all_temp_backups() {
	/*
	 * Check if there is a lock, or if currently performing an Ajax request,
	 * in which case there is a chance an update is running.
	 * Reschedule for an hour from now and exit early.
	 */
	if ( get_option( 'core_updater.lock' ) || get_option( 'auto_updater.lock' ) || wp_doing_ajax() ) {
		wp_schedule_single_event( time() + HOUR_IN_SECONDS, 'wp_delete_temp_updater_backups' );
		return;
	}

	// This action runs on shutdown to make sure there are no plugin updates currently running.
	add_action( 'shutdown', '_wp_delete_all_temp_backups' );
}

/**
 * Deletes all contents in the temporary backup directory.
 *
 * @since WP 6.3.0
 *
 * @access private
 *
 * @global WP_Filesystem_Base $wp_filesystem WP filesystem subclass.
 */
function _wp_delete_all_temp_backups() {
	global $wp_filesystem;

	if ( ! function_exists( 'WP_Filesystem' ) ) {
		require_once ABSPATH . 'wp-admin/includes/file.php';
	}

	ob_start();
	$credentials = request_filesystem_credentials( '' );
	ob_end_clean();

	if ( false === $credentials || ! WP_Filesystem( $credentials ) ) {
		wp_trigger_error( __FUNCTION__, __( 'Could not access filesystem.' ) );
		return;
	}

	if ( ! $wp_filesystem->wp_content_dir() ) {
		wp_trigger_error(
			__FUNCTION__,
			/* translators: %s: Directory name. */
			sprintf( __( 'Unable to locate Retraceur content directory (%s).' ), 'wp-content' )
		);
		return;
	}

	$temp_backup_dir = $wp_filesystem->wp_content_dir() . 'upgrade-temp-backup/';
	$dirlist         = $wp_filesystem->dirlist( $temp_backup_dir );
	$dirlist         = $dirlist ? $dirlist : array();

	foreach ( array_keys( $dirlist ) as $dir ) {
		if ( '.' === $dir || '..' === $dir ) {
			continue;
		}

		$wp_filesystem->delete( $temp_backup_dir . $dir, true );
	}
}

if ( ( ! is_main_site() && ! is_network_admin() ) || wp_doing_ajax() ) {
	return;
}

/**
 * Disable updates for now.
 *
 * @since 1.0.0 Retraceur fork.
 */
add_action( 'admin_init', '_maybe_update_core' );
add_action( 'retraceur_version_check', 'retraceur_version_check' );
add_action( 'init', 'wp_schedule_update_checks' );

add_action( 'load-plugins.php', 'wp_update_plugins' );
add_action( 'load-update.php', 'wp_update_plugins' );
add_action( 'load-update-core.php', 'wp_update_plugins' );
add_action( 'admin_init', '_maybe_update_plugins' );
add_action( 'wp_update_plugins', 'wp_update_plugins' );

/*
add_action( 'load-themes.php', 'wp_update_themes' );
add_action( 'load-update.php', 'wp_update_themes' );
add_action( 'load-update-core.php', 'wp_update_themes' );
add_action( 'admin_init', '_maybe_update_themes' );
add_action( 'wp_update_themes', 'wp_update_themes' );

add_action( 'update_option_WPLANG', 'wp_clean_update_cache', 10, 0 );
*/

add_action( 'wp_delete_temp_updater_backups', 'wp_delete_all_temp_backups' );
