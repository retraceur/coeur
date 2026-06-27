<?php
/**
 * Retraceur Plugin Install Administration API.
 *
 * @since 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Administration
 */

/**
 * Performs a GET request to a discovery provider API.
 *
 * @since 4.0.0 Retraceur fork.
 *
 * @param string $endpoint The API endpoint path (e.g. '/repos/owner/repo').
 * @param array  $args     Optional. Additional arguments to merge into the request args.
 * @return array|WP_Error Decoded JSON response or WP_Error on failure.
 */
function retraceur_discovery_request( $endpoint, $args = array() ) {
	/**
	 * Filters the discovery provider base URL.
	 *
	 * Can be used to replace GitHub with an alternative provider
	 * such as Forgejo or Gitea.
	 *
	 * @since 4.0.0 Retraceur fork.
	 *
	 * @param string $base_url The base URL of the discovery provider API.
	 */
	$base_url = apply_filters( 'retraceur_discovery_provider_url', 'https://api.github.com' );

	$default_headers = array(
		'X-GitHub-Api-Version' => '2026-03-10',
		'Accept'               => 'application/vnd.github+json',
		'User-Agent'           => 'Retraceur/' . retraceur_get_version() . '; ' . home_url( '/' ),
	);

	$token = defined( 'RETRACEUR_GHT' ) && RETRACEUR_GHT ? RETRACEUR_GHT : get_option( 'retraceur_github_token', '' );
	if ( $token ) {
		$default_headers['Authorization'] = 'Bearer ' . $token;
	}

	// Should the response be returned as raw?
	$get_raw = isset( $args['raw'] ) && true === $args['raw'];
	unset( $args['raw'] );

	// Deeply merge headers.
	$merged_headers = array_merge( $default_headers, $args['headers'] ?? array() );

	$http_args = array(
		'timeout' => 15,
		'headers' => $merged_headers,
	);

	// Remove passed headers before parsing args.
	unset( $args['headers'] );
	$http_args = wp_parse_args( $args, $http_args );

	// Set URL to request.
	$url      = $base_url . $endpoint;
	$ssl      = wp_http_supports( array( 'ssl' ) );
	$http_url = $url;

	if ( $ssl ) {
		$url = set_url_scheme( $url, 'https' );
	}

	$request = wp_remote_get( $url, $http_args );

	if ( $ssl && is_wp_error( $request ) ) {
		if ( ! wp_is_json_request() ) {
			wp_trigger_error(
				__FUNCTION__,
				__( 'An unexpected error occurred. Something may be wrong with this server&#8217;s configuration.' ) . ' ' . __( '(Retraceur could not establish a secure connection to the GitHub API. Please contact your server administrator.)' ),
				headers_sent() || WP_DEBUG ? E_USER_WARNING : E_USER_NOTICE
			);
		}

		$request = wp_remote_get( $http_url, $http_args );
	}

	if ( is_wp_error( $request ) ) {
		return new WP_Error(
			'retraceur_discovery_request_failed',
			__( 'An unexpected error occurred. Something may be wrong with this server&#8217;s configuration.' ),
			$request->get_error_message()
		);
	}

	$code = (int) wp_remote_retrieve_response_code( $request );
	if ( $code !== 200 ) {
		return new WP_Error(
			'retraceur_discovery_api_error',
			$body['message'] ?? __( 'An error occurred. Please try again later.' ),
			array( 'status' => $code )
		);
	}

	$body = wp_remote_retrieve_body( $request );
	if ( ! $get_raw ) {
		$body = json_decode( wp_remote_retrieve_body( $request ), true );
	}

	return $body;
}

/**
 * Retrieves repository information from the discovery provider.
 *
 * It is possible for a plugin to override the Discovery API result with three
 * filters. Assume this is for plugins, which can extend on the Discovery Info
 * to offer more choices. This is very powerful and must be used with care when
 * overriding the filters.
 *
 * The first filter, {@see 'retraceur_discovery_api_args'}, is for the args and
 * gives the action as the second parameter. The hook for
 * {@see 'retraceur_discovery_api_args'} must ensure that an array is returned.
 *
 * The second filter, {@see 'retraceur_discovery_api'}, allows a plugin to
 * override the built-in Discovery API entirely. If `$action` is
 * 'retraceur-plugin', 'retraceur-block' or 'retraceur-theme', an array MUST
 * be passed.
 *
 * Finally, the third filter, {@see 'retraceur_discovery_api_result'}, makes it
 * possible to filter the response array, depending on the `$action` type.
 *
 * Supported arguments per action:
 *
 * | Argument Name | retraceur-plugin | retraceur-block | retraceur-theme |
 * | ------------- | :--------------: | :-------------: | :-------------: |
 * | `$search`     | Yes              | Yes             | Yes             |
 * | `$sort`       | Yes              | Yes             | Yes             |
 * | `$order`      | Yes              | Yes             | Yes             |
 * | `$per_page`   | Yes              | Yes             | Yes             |
 * | `$page`       | Yes              | Yes             | Yes             |
 *
 * @since 4.0.0 Retraceur fork.
 *
 * @param string $action The type of information being requested from the
 *                       Discovery API. Accepts 'retraceur-plugin',
 *                       'retraceur-block' or 'retraceur-theme'.
 * @param array  $args {
 *     Optional. Array of arguments to pass to the Discovery API.
 *
 *     @type string $search   A search term. Default empty.
 *     @type string $sort     Sort results by. Accepts 'updated', 'stars'.
 *                            Default 'updated'.
 *     @type string $order    Order of results. Accepts 'asc', 'desc'.
 *                            Default 'desc'.
 *     @type int    $per_page Number of repositories per page. Default 10.
 *     @type int    $page     Current page number. Default 1.
 * }
 * @return array|WP_Error Response array on success, WP_Error on failure.
 */
function retraceur_discovery_api( $action, $args = array() ) {
	if ( 'retraceur-plugin' === $action || 'retraceur-block' === $action ) {
		if ( ! isset( $args['per_page'] ) ) {
			$args['per_page'] = 10;
		}
	}

	/**
	 * Filters the Discovery API arguments.
	 *
	 * Important: An object MUST be returned to this filter.
	 *
	 * @since 4.0.0 Retraceur fork.
	 *
	 * @param array  $args   Discovery API arguments.
	 * @param string $action The type of information being requested from the Discovery API.
	 */
	$args = apply_filters( 'retraceur_discovery_api_args', $args, $action );

	/**
	 * Filters the response for the current Discovery API request.
	 *
	 * Returning a non-false value will effectively short-circuit the API request.
	 *
	 * @since 4.0.0 Retraceur fork.
	 *
	 * @param false|array $result The result object or array. Default false.
	 * @param string      $action The type of information being requested from the Discovery API.
	 * @param array       $args   Discovery API arguments.
	 */
	$res = apply_filters( 'retraceur_discovery_api', false, $action, $args );

	if ( false === $res ) {
		if ( 'retraceur-repository' === $action ) {
			if ( empty( $args['repository'] ) ) {
				return new WP_Error(
					'retraceur_discovery_missing_repository',
					__( 'Please provide the repository full name.' )
				);
			}

			$repository = sanitize_text_field( $args['repository'] );
			$cache_key  = 'retraceur_discovery_repo_' . md5( $repository );
			$cached     = get_transient( $cache_key );

			if ( false === $cached ) {
				// 1. Repository metadata.
				$repo_data = retraceur_discovery_request( '/repos/' . $repository );
				if ( is_wp_error( $repo_data ) ) {
					return $repo_data;
				}

				// 2. Manifest (retraceur/manifest.json).
				$manifest      = array();
				$manifest_data = retraceur_discovery_request( '/repos/' . $repository . '/contents/retraceur/manifest.json' );
				if ( ! is_wp_error( $manifest_data ) && isset( $manifest_data['content'] ) ) {
					$decoded  = base64_decode( str_replace( "\n", '', $manifest_data['content'] ) );
					$manifest = json_decode( $decoded, true ) ?? array();
				}

				// 3. Latest release.
				$release      = array();
				$release_data = retraceur_discovery_request( '/repos/' . $repository . '/releases/latest' );
				if ( ! is_wp_error( $release_data ) ) {
					$release = $release_data;
				}

				$res = array(
					'repository' => $repo_data,
					'manifest'   => $manifest,
					'release'    => $release,
				);

				set_transient( $cache_key, $res, DAY_IN_SECONDS );
			} else {
				$res = $cached;
			}
		} elseif ( 'retraceur-changelog' === $action ) {
			if ( empty( $args['repository'] ) ) {
				return new WP_Error(
					'retraceur_discovery_missing_repository',
					__( 'Please provide the repository full name.' ),
					array( 'status' => 400 )
				);
			}

			$repository = sanitize_text_field( $args['repository'] );
			$cache_key  = 'retraceur_discovery_changelog_' . md5( $repository );
			$cached     = get_transient( $cache_key );

			if ( false !== $cached ) {
				return $cached;
			}

			$changelog = retraceur_discovery_request(
				'/repos/' . $repository . '/contents/CHANGELOG.md',
				array(
					'raw'     => true,
					'headers' => array(
						'Accept' => 'application/vnd.github.html+json',
					),
				)
			);

			$empty_changelog = new WP_Error(
				'retraceur_discovery_empty_changelog',
				__( 'The repository changelog is not available or empty.' ),
				array( 'status' => 404 )
			);

			if ( is_wp_error( $changelog ) ) {
				// 404 = pas de CHANGELOG.md, ce n'est pas une erreur fatale.
				if ( 404 === ( $changelog->get_error_data()['status'] ?? 0 ) ) {
					return $empty_changelog;
				}

				return $changelog;
			}

			if ( empty( $changelog ) ) {
				return $empty_changelog;
			}

			// No need to parse block attributes.
			remove_filter( 'pre_kses', 'wp_pre_kses_block_attributes', 10 );

			$allowed_tags = wp_kses_allowed_html( 'post' );
			unset( $allowed_tags['a'] );
			$changelog = wp_kses( $changelog, $allowed_tags );

			// Remove potential changelog title.
			$changelog = preg_replace( '/<h1[^>]*>.*?<\/h1>/is', '', $changelog, 1 );

			// Resume the block attributes filter.
			add_filter( 'pre_kses', 'wp_pre_kses_block_attributes', 10, 3 );

			set_transient( $cache_key, $changelog, DAY_IN_SECONDS );

			return $changelog;
		} else {
			$api_args      = $args;
			$api_args['q'] = 'topic:' . $action;

			// Remove unused argument.
			unset( $api_args['browse'], $api_args['context'] );

			// Sanitize search inputs.
			if ( isset( $api_args['search'] ) && $api_args['search'] ) {
				$api_args['q'] .= ' ' . sanitize_text_field( $api_args['search'] ) . ' in:name,description';
			} else {
				unset( $api_args['search'] );
			}

			// Sanitize sort & order.
			if ( isset( $api_args['sort'] ) && isset( $api_args['order'] ) ) {
				if ( ! in_array( $api_args['sort'], array( 'updated', 'stars' ), true ) || ! in_array( $api_args['order'], array( 'desc', 'asc' ), true ) ) {
					unset( $api_args['sort'], $api_args['order'] );
				}
			}

			$cache_key       = 'retraceur_discovery_api_' . md5( serialize( $api_args ) );
			$cached_response = get_transient( $cache_key );

			if ( false === $cached_response ) {
				$res = retraceur_discovery_request( '/search/repositories?' . http_build_query( $api_args ) );

				if ( ! is_wp_error( $res ) ) {
					set_transient( $cache_key, $res, DAY_IN_SECONDS );
				}
			} else {
				$res = $cached_response;
			}
		}
	} elseif ( ! is_wp_error( $res ) ) {
		$res['external'] = true;
	}

	/**
	 * Filters the Plugin Installation API response results.
	 *
	 * @since 3.0.0 Retraceur fork.
	 *
	 * @param array|WP_Error $res    Response object or WP_Error.
	 * @param string         $action The type of information being requested from the Plugin Installation API.
	 * @param array          $args   Plugin API arguments.
	 */
	return apply_filters( 'retraceur_discovery_api_result', $res, $action, $args );
}

/**
 * Displays a form to upload plugins from zip files.
 *
 * @since WP 2.8.0
 */
function install_plugins_upload() {
	?>
<div class="upload-plugin">
	<p class="install-help"><?php _e( 'If you have a plugin in a .zip format, you may install or update it by uploading it here.' ); ?></p>
	<form method="post" enctype="multipart/form-data" class="wp-upload-form" action="<?php echo esc_url( self_admin_url( 'update.php?action=upload-plugin' ) ); ?>">
		<?php wp_nonce_field( 'plugin-upload' ); ?>
		<label class="screen-reader-text" for="pluginzip">
			<?php
			/* translators: Hidden accessibility text. */
			_e( 'Plugin zip file' );
			?>
		</label>
		<input type="file" id="pluginzip" name="pluginzip" accept=".zip" />
		<?php submit_button( _x( 'Install Now', 'plugin' ), '', 'install-plugin-submit', false ); ?>
	</form>
</div>
	<?php
}

/**
 * Displays a form to upload blocks from zip files.
 *
 * @since 1.0.0 Retraceur fork.
 */
function retraceur_block_upload() {
	?>
<div class="upload-plugin">
	<p class="install-help"><?php esc_html_e( 'If you have a block in a .zip format, you may install or update it by uploading it here.' ); ?></p>
	<form method="post" enctype="multipart/form-data" class="wp-upload-form" action="<?php echo esc_url( self_admin_url( 'update.php?action=upload-block' ) ); ?>">
		<?php wp_nonce_field( 'plugin-upload' ); ?>
		<label class="screen-reader-text" for="pluginzip">
			<?php
			/* translators: Hidden accessibility text. */
			esc_html_e( 'Block zip file' );
			?>
		</label>
		<input type="file" id="pluginzip" name="pluginzip" accept=".zip" />
		<?php submit_button( _x( 'Install Now', 'plugin' ), '', 'install-plugin-submit', false ); ?>
	</form>
</div>
	<?php
}
