<?php
/**
 * REST API: Retraceur_REST_Discovery_Controller class
 *
 * @since 4.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage REST_API
 */

/**
 * Controller which provides REST endpoint to discover blocks & plugins.
 *
 * @since 4.0.0 Retraceur fork.
 *
 * @see WP_REST_Controller
 */
class Retraceur_REST_Discovery_Controller extends WP_REST_Controller {

	/**
	 * Constructs the controller.
	 *
	 * @since 4.0.0 Retraceur fork.
	 */
	public function __construct() {
		$this->namespace = 'wp/v2';
		$this->rest_base = 'discover';
	}

	/**
	 * Registers the necessary REST API routes.
	 *
	 * @since 4.0.0 Retraceur fork.
	 */
	public function register_routes() {
		register_rest_route(
			$this->namespace,
			'/' . $this->rest_base . '/repositories',
			array(
				array(
					'methods'             => WP_REST_Server::READABLE,
					'callback'            => array( $this, 'get_repositories' ),
					'permission_callback' => array( $this, 'get_items_permissions_check' ),
					'args'                => $this->get_collection_params(),
				),
				'schema' => array( $this, 'get_public_item_schema' ),
			)
		);

		register_rest_route(
			$this->namespace,
			'/' . $this->rest_base . '/repository',
			array(
				array(
					'methods'             => WP_REST_Server::READABLE,
					'callback'            => array( $this, 'get_repository' ),
					'permission_callback' => array( $this, 'get_items_permissions_check' ),
					'args'                => array(
						'context'    => array(
							'description' => __( 'Scope under which the request is made.' ),
							'type'        => 'string',
							'default'     => 'view',
						),
						'name'       => array(
							'description' => __( 'The repository full name (owner/repo).' ),
							'type'        => 'string',
							'required'    => true,
							'minLength'   => 1,
							'pattern'     => '^[a-zA-Z0-9_.-]+/[a-zA-Z0-9_.-]+$',
						),
					),
				),
				'schema' => array( $this, 'get_single_repository_schema' ),
			)
		);

		register_rest_route(
			$this->namespace,
			'/' . $this->rest_base . '/releases',
			array(
				array(
					'methods'             => WP_REST_Server::READABLE,
					'callback'            => array( $this, 'get_releases' ),
					'permission_callback' => array( $this, 'get_items_permissions_check' ),
					'args'                => array(
						'context'    => array(
							'description'       => __( 'Scope under which the request is made; determines fields present in response.' ),
							'type'              => 'string',
							'sanitize_callback' => 'sanitize_key',
							'validate_callback' => 'rest_validate_request_arg',
							'default'           => 'view',
						),
						'repository' => array(
							'description' => __( 'The repository full name.' ),
							'type'        => 'string',
							'required'    => true,
							'minLength'   => 1,
							'pattern'     => '^[a-zA-Z0-9_.-]+/[a-zA-Z0-9_.-]+$',
						),
					),
				),
				'schema' => array( $this, 'get_release_schema' ),
			)
		);

		register_rest_route(
			$this->namespace,
			'/' . $this->rest_base . '/changelog',
			array(
				array(
					'methods'             => WP_REST_Server::READABLE,
					'callback'            => array( $this, 'get_changelog' ),
					'permission_callback' => array( $this, 'get_items_permissions_check' ),
					'args'                => array(
						'context'    => array(
							'description' => __( 'Scope under which the request is made.' ),
							'type'        => 'string',
							'default'     => 'view',
						),
						'repository' => array(
							'description' => __( 'The repository full name (owner/repo).' ),
							'type'        => 'string',
							'required'    => true,
							'pattern'     => '^[a-zA-Z0-9_.-]+/[a-zA-Z0-9_.-]+$',
						),
					),
				),
				'schema' => array( $this, 'get_changelog_schema' ),
			)
		);

		register_rest_route(
			$this->namespace,
			'/' . $this->rest_base . '/install',
			array(
				array(
					'methods'             => WP_REST_Server::CREATABLE,
					'callback'            => array( $this, 'install_repository' ),
					'permission_callback' => array( $this, 'get_items_permissions_check' ),
					'args'                => array(
						'full_name'    => array(
							'description' => __( 'The repository full name (owner/repo).' ),
							'type'        => 'string',
							'required'    => true,
							'pattern'     => '^[a-zA-Z0-9_.-]+/[a-zA-Z0-9_.-]+$',
						),
						'version'      => array(
							'description' => __( 'The version tag to install.' ),
							'type'        => 'string',
							'required'    => true,
						),
						'download_url' => array(
							'description' => __( 'The asset download URL.' ),
							'type'        => 'string',
							'format'      => 'uri',
							'required'    => true,
						),
						'digest'       => array(
							'description' => __( 'The SHA256 digest of the asset (sha256:abc123...).' ),
							'type'        => 'string',
						),
					),
				),
				'schema' => array( $this, 'get_install_repository_schema' ),
			)
		);
	}

	/**
	 * Checks whether a given request has permission to list items.
	 *
	 * @since 4.0.0 Retraceur fork.
	 *
	 * @param WP_REST_Request $request Full details about the request.
	 * @return true|WP_Error True if the request has permission, WP_Error object otherwise.
	 */
	public function get_items_permissions_check( $request ) {
		if ( ! current_user_can( 'install_plugins' ) || ! current_user_can( 'activate_plugins' ) ) {
			return new WP_Error(
				'rest_retraceur_discovery_cannot_view',
				__( 'Sorry, you are not allowed to discover external items.' ),
				array( 'status' => rest_authorization_required_code() )
			);
		}

		return true;
	}

	/**
	 * Search and retrieve Repositories metadata.
	 *
	 * @since 4.0.0 Retraceur fork.
	 *
	 * @param WP_REST_Request $request Full details about the request.
	 * @return WP_REST_Response|WP_Error Response object on success, or WP_Error object on failure.
	 */
	public function get_repositories( $request ) {
		require_once ABSPATH . 'wp-admin/includes/plugin-install.php';
		require_once ABSPATH . 'wp-admin/includes/plugin.php';

		$repositories_tag = sprintf( 'retraceur-%s', $request['type'] );

		$result = retraceur_discovery_api(
			$repositories_tag,
			array(
				'search'   => $request['search'],
				'sort'     => $request['sort'],
				'order'    => $request['order'],
				'per_page' => $request['per_page'],
				'page'     => $request['page'],
			)
		);

		if ( is_wp_error( $result ) ) {
			$result->add_data( array( 'status' => 500 ) );

			return $result;
		}

		$response = array();
		foreach ( $result['items'] as $repository ) {
			$data       = $this->prepare_item_for_response( $repository, $request );
			$response[] = $this->prepare_response_for_collection( $data );
		}

		return rest_ensure_response( $response );
	}

	/**
	 * Gets all needed information about a specific repository.
	 *
	 * @since 4.0.0 Retraceur fork.
	 *
	 * @param WP_REST_Request $request Full details about the request.
	 * @return WP_REST_Response|WP_Error Response object on success, or WP_Error object on failure.
	 */
	public function get_repository( $request ) {
		require_once ABSPATH . 'wp-admin/includes/plugin-install.php';
		require_once ABSPATH . 'wp-admin/includes/plugin.php';

		$full_name = sanitize_text_field( $request['name'] );
		$parts     = explode( '/', $full_name );

		if ( count( $parts ) !== 2 ) {
			return new WP_Error(
				'rest_retraceur_discovery_invalid_repository',
				__( 'Invalid repository name. Expected format: owner/repo.' ),
				array( 'status' => 400 )
			);
		}

		$result = retraceur_discovery_api(
			'retraceur-repository',
			array(
				'repository' => $full_name,
			)
		);

		if ( is_wp_error( $result ) ) {
			$result->add_data( array( 'status' => 500 ) );
			return $result;
		}

		return rest_ensure_response(
			$this->prepare_single_repository_for_response( $result, $request )
		);
	}

	/**
	 * Installs the requested repository.
	 *
	 * @since 4.0.0 Retraceur fork.
	 *
	 * @param WP_REST_Request $request Full details about the request.
	 * @return WP_REST_Response|WP_Error Response object on success, or WP_Error object on failure.
	 */
	public function install_repository( $request ) {
		require_once ABSPATH . 'wp-admin/includes/file.php';
		require_once ABSPATH . 'wp-admin/includes/plugin-install.php';
		require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
		require_once ABSPATH . 'wp-admin/includes/plugin.php';

		$full_name    = sanitize_text_field( $request['full_name'] );
		$version      = sanitize_text_field( $request['version'] );
		$download_url = esc_url_raw( $request['download_url'] );
		$digest       = sanitize_text_field( $request['digest'] ?? '' );

		if ( ! $digest ) {
			return new WP_Error(
				'rest_retraceur_discovery_required_param',
				__( 'Please provide the repository’s asset digest.' ),
				array( 'status' => 400 )
			);
		}

		// Validate the GitHub hash format "sha256:abc123..."
		if ( ! str_starts_with( $digest, 'sha256:' ) ) {
			return new WP_Error(
				'retraceur_install_invalid_digest',
				__( 'Invalid digest format. Expected sha256:...' ),
				array( 'status' => 422 )
			);
		}

		// Set the hash to check against.
		$expected_hash = substr( $digest, strlen( 'sha256:' ) );

		// Download the repository asset.
		$temp_file = download_url( $download_url );

		if ( is_wp_error( $temp_file ) ) {
			$temp_file->add_data( array( 'status' => 500 ) );
			return $temp_file;
		}

		// Checks package's integrity.
		$actual_hash = hash_file( 'sha256', $temp_file );

		if ( ! hash_equals( $expected_hash, $actual_hash ) ) {
			@unlink( $temp_file );
			return new WP_Error(
				'retraceur_install_digest_mismatch',
				__( 'The downloaded file digest does not match. Installation aborted.' ),
				array( 'status' => 422 )
			);
		}

		// Use WP_Upgrader to install the repository.
		WP_Filesystem( array(), '', true );
		$upgrader = new Plugin_Upgrader( new WP_Ajax_Upgrader_Skin() );
		$result   = $upgrader->install( $temp_file );

		@unlink( $temp_file );

		if ( is_wp_error( $result ) ) {
			$result->add_data( array( 'status' => 500 ) );
			return $result;
		}

		if ( ! $result ) {
			return new WP_Error(
				'retraceur_install_failed',
				__( 'Installation failed.' ),
				array( 'status' => 500 )
			);
		}

		return rest_ensure_response( array(
			'success' => true,
			'message' => __( 'Installation successful.' ),
		) );
	}

	/**
	 * Retrieve a given repository releases.
	 *
	 * @since 4.0.0 Retraceur fork.
	 *
	 * @param WP_REST_Request $request Full details about the request.
	 * @return WP_REST_Response|WP_Error Response object on success, or WP_Error object on failure.
	 */
	public function get_releases( $request ) {
		if ( ! $request['repository'] ) {
			return new WP_Error(
				'rest_retraceur_discovery_required_param',
				__( 'Please provide the repository fullname.' ),
				array( 'status' => 400 )
			);
		}

		// Needs sanitization.
		$releases_url  = 'https://github.com/' . wp_unslash( $request['repository'] ) . '/releases.atom';
		$releases_feed = fetch_feed( $releases_url );

		if ( is_wp_error( $releases_feed ) ) {
			$releases_feed->add_data( array( 'status' => 500 ) );

			return $releases_feed;
		}

		$releases = $releases_feed->get_items();
		$response = array();

		foreach ( $releases as $release ) {
			$release_id = explode( '/', rtrim( $release->get_id(), '/' ) );
			$version    = end( $release_id );
			$url        = $release->get_link();

			if ( ! $version ) {
				$url_data = explode( '/', rtrim( wp_parse_url( $url, PHP_URL_PATH ) ) );
				$version  = end( $url_data );
			}

			$data       = $this->prepare_release_for_response(
				array(
					'title'       => $release->get_title(),
					'version'     => $version,
					'note'        => $release->get_description(),
					'release_url' => $url,
				),
				$request
			);
			$response[] = $this->prepare_response_for_collection( $data );
		}

		return rest_ensure_response( $response );
	}

	/**
	 * Retrieves the changelog of a given repository.
	 *
	 * @since 4.0.0 Retraceur fork.
	 *
	 * @param WP_REST_Request $request Full details about the request.
	 * @return WP_REST_Response|WP_Error Response object on success, or WP_Error object on failure.
	 */
	public function get_changelog( $request ) {
		require_once ABSPATH . 'wp-admin/includes/plugin-install.php';
		require_once ABSPATH . 'wp-admin/includes/plugin.php';

		$repository = sanitize_text_field( $request['repository'] );

		$result = retraceur_discovery_api(
			'retraceur-changelog',
			array( 'repository' => $repository )
		);

		if ( is_wp_error( $result ) ) {
			$result = '';
		}

		return rest_ensure_response(
			array( 'content' => $result )
		);
	}

	/**
	 * Parse repository data and prepare it for an API response.
	 *
	 * @since 4.0.0 Retraceur fork.
	 *
	 * @param array           $item    The repository data.
	 * @param WP_REST_Request $request Request object.
	 * @return WP_REST_Response|WP_Error Response object on success, or WP_Error object on failure.
	 */
	public function prepare_item_for_response( $item, $request ) {
		$full_name      = wp_strip_all_tags( $item['full_name'] );
		$default_branch = wp_strip_all_tags( $item['default_branch'] );

		// A data array containing the properties we'll return.
		$repository = array(
			'id'                  => (int) $item['id'],
			'name'                => wp_strip_all_tags( $item['name'] ),
			'full_name'           => $full_name,
			'html_url'            => esc_url_raw( $item['html_url'] ),
			'description'         => wp_strip_all_tags( $item['description'] ),
			'author'              => ! empty( $item['owner']['login'] ) ? wp_strip_all_tags( $item['owner']['login'] ) : __( 'Unknown author.' ),
			'author_avatar'       => ! empty( $item['owner']['avatar_url'] ) ? esc_url_raw( $item['owner']['avatar_url'] ) : '',
			'author_url'          => ! empty( $item['owner']['html_url'] ) ? esc_url_raw( $item['owner']['html_url'] ) : '',
			'image'               => 'https://raw.githubusercontent.com/' . $full_name . '/refs/heads/' . $default_branch . '/retraceur/og-image.png',
			'last_updated'        => gmdate( 'Y-m-d\TH:i:s', strtotime( $item['updated_at'] ) ),
			'stargazers_count'    => (int) $item['stargazers_count'],
			'open_issues_count'   => (int) $item['open_issues_count'],
			'default_branch'      => $default_branch,
		);

		// Check already installed repositories.
		$installed_map              = retraceur_discovery_get_installed_map();
		$repository['is_installed'] = isset( $installed_map[ strtolower( $full_name ) ] );

		$response = new WP_REST_Response( $repository );

		return $response;
	}

	/**
	 * Parse release data and prepare it for an API response.
	 *
	 * @since 4.0.0 Retraceur fork.
	 *
	 * @param array           $release The release data.
	 * @param WP_REST_Request $request Request object.
	 * @return WP_REST_Response|WP_Error Response object on success, or WP_Error object on failure.
	 */
	public function prepare_release_for_response( $release, $request ) {
		$full_name = ! empty( $request['name'] ) ? $request['name'] : $request['repository'];
		$version   = $release['version'];
		$repo_name = explode( '/', $full_name )[1];

		$data = array(
			'title'        => wp_strip_all_tags( $release['title'] ),
			'version'      => wp_strip_all_tags( $version ),
			'note'         => wp_strip_all_tags( $release['note'] ),
			'release_url'  => esc_url_raw( $release['release_url'] ),
			'download_url' => empty( $release['download_url'] ) ? esc_url_raw( "https://github.com/{$full_name}/releases/download/{$version}/{$repo_name}.zip" ) : $release['download_url'],
		);

		if ( ! empty( $release['digest'] ) ) {
			$data['digest'] = sanitize_text_field( $release['digest'] );
		}

		return rest_ensure_response( $data );
	}

	/**
	 * Parse single repository data and prepare it for an API response.
	 *
	 * @since 4.0.0 Retraceur fork.
	 *
	 * @param array           $item    The repository data.
	 * @param WP_REST_Request $request Request object.
	 * @return WP_REST_Response|WP_Error Response object on success, or WP_Error object on failure.
	 */
	public function prepare_single_repository_for_response( $item, $request ) {
		// Uses existing repository item method to build the first part of the response.
		$repository = $this->prepare_item_for_response( $item['repository'], $request );
		$data       = $repository->get_data();

		// Set up Retraceur meta data.
		$manifest     = $item['manifest'] ?? array();
		$data['type'] = '';
		if ( isset( $manifest['type'] ) && in_array( $manifest['type'], array( 'plugin', 'block' ), true ) ) {
			$data['type'] = $manifest['type'];
		}

		$data['requires_retraceur'] = '';
		if ( isset( $manifest['requires']['retraceur'] ) ) {
			$data['requires_retraceur'] = sanitize_text_field( $manifest['requires']['retraceur'] );
		}

		$data['requires_php'] = '';
		if ( isset( $manifest['requires']['php'] ) ) {
			$data['requires_php'] = sanitize_text_field( $manifest['requires']['php'] );
		}

		$data['dependencies'] = array();
		if ( isset( $manifest['requires']['dependencies'] ) && is_array( $manifest['requires']['dependencies'] ) && $manifest['requires']['dependencies'] ) {
			$data['dependencies'] = array_map( 'sanitize_text_field',  $manifest['requires']['dependencies'] );
		}

		// Enrich the response with latest release data.
		$release      = $item['release'] ?? array();
		$release_data = array();
		if ( $release ) {
			$slug  = explode( '/', $data['full_name'] )[1];
			$asset = array_values( array_filter(
				$release['assets'] ?? array(),
				fn( $a ) => $a['name'] === $slug . '.zip'
			) )[0] ?? null;

			$release_data = $this->prepare_release_for_response(
				array(
					'title'        => $release['name']     ?? '',
					'version'      => $release['tag_name'] ?? '',
					'note'         => $release['body']     ?? '',
					'release_url'  => $release['html_url'] ?? '',
					'download_url' => isset( $asset['browser_download_url'] ) ? esc_url_raw( $asset['browser_download_url'] ) : '',
					'digest'       => isset( $asset['digest'] ) ? sanitize_text_field( $asset['digest'] ) : '',
				),
				$request
			)->get_data();
		}

		return rest_ensure_response( array_merge( $data, $release_data ) );
	}

	/**
	 * Retrieves the repository's schema, conforming to JSON Schema.
	 *
	 * @since 4.0.0 Retraceur fork.
	 *
	 * @return array Repository schema data.
	 */
	public function get_item_schema() {
		if ( $this->schema ) {
			return $this->add_additional_fields_schema( $this->schema );
		}

		$this->schema = array(
			'$schema'    => 'http://json-schema.org/draft-04/schema#',
			'title'      => 'retraceur-repository',
			'type'       => 'object',
			'properties' => array(
				'id'                => array(
					'description' => __( 'The repository GitHub ID.' ),
					'type'        => 'string',
					'context'     => array( 'view' ),
				),
				'name'              => array(
					'description' => __( 'The repository short name.' ),
					'type'        => 'string',
					'context'     => array( 'view' ),
				),
				'full_name'         => array(
					'description' => __( 'The repository full name.' ),
					'type'        => 'string',
					'context'     => array( 'view' ),
				),
				'html_url'         => array(
					'description' => __( 'The repository GitHub URL.' ),
					'type'        => 'string',
					'format'      => 'uri',
					'context'     => array( 'view' ),
					'readonly'    => true,
				),
				'description'       => array(
					'description' => __( 'The repository description.' ),
					'type'        => 'string',
					'context'     => array( 'view' ),
				),
				'author'            => array(
					'description' => __( 'The repository owner.' ),
					'type'        => 'string',
					'context'     => array( 'view' ),
				),
				'author_avatar'     => array(
					'description' => __( 'The repository owner’s avatar.' ),
					'type'        => 'string',
					'format'      => 'uri',
					'context'     => array( 'view' ),
					'readonly'    => true,
				),
				'author_url'     => array(
					'description' => __( 'The repository owner’s GitHub URL.' ),
					'type'        => 'string',
					'format'      => 'uri',
					'context'     => array( 'view' ),
					'readonly'    => true,
				),
				'image'             => array(
					'description' => __( 'URL to the open graph image representing the repository.' ),
					'type'        => 'string',
					'format'      => 'uri',
					'context'     => array( 'view' ),
					'readonly'    => true,
				),
				'last_updated'      => array(
					'description' => __( 'The date when the repository was last updated.' ),
					'type'        => 'string',
					'format'      => 'date-time',
					'context'     => array( 'view' ),
				),
				'stargazers_count'  => array(
					'description' => __( 'The star rating of the repository.' ),
					'type'        => 'integer',
					'context'     => array( 'view' ),
				),
				'open_issues_count' => array(
					'description' => __( 'The number of opened issues for the repository.' ),
					'type'        => 'integer',
					'context'     => array( 'view' ),
				),
				'default_branch' => array(
					'description' => __( 'The default branch name.' ),
					'type'        => 'string',
					'context'     => array( 'view' ),
				),
				'is_installed' => array(
					'description' => __( 'Whether the repository is already installed.' ),
					'type'        => 'boolean',
					'context'     => array( 'view' ),
					'readonly'    => true,
				),
			),
		);

		return $this->add_additional_fields_schema( $this->schema );
	}

	/**
	 * Retrieves repository collection parameters.
	 *
	 * @since 4.0.0 Retraceur fork.
	 *
	 * @return array Collection parameters.
	 */
	public function get_collection_params() {
		$query_params = parent::get_collection_params();

		$query_params['context']['default'] = 'view';

		$query_params['type'] = array(
			'default'     => 'plugin',
			'description' => __( 'The type of Retraceur repositories to fetch.' ),
			'type'        => 'string',
			'enum'        => array( 'plugin', 'block' ),
		);

		$query_params['sort'] = array(
			'default'     => 'updated',
			'description' => __( 'Sorts the results of your query by how recently the items were updated or number of stars.' ),
			'type'        => 'string',
			'enum'        => array( 'updated', 'stars' ),
		);

		$query_params['order'] = array(
			'default'     => 'desc',
			'description' => __( 'Determines whether the first search result returned is the highest number of matches (desc) or lowest number of matches (asc). This parameter is ignored unless you provide sort.' ),
			'type'        => 'string',
			'enum'        => array( 'asc', 'desc' ),
		);

		/**
		 * Filters REST API collection parameters for the repositories discovery controller.
		 *
		 * @since 4.0.0 Retraceur fork.
		 *
		 * @param array $query_params JSON Schema-formatted collection parameters.
		 */
		return apply_filters( 'rest_retraceur_discovery_collection_params', $query_params );
	}

	/**
	 * Retrieves the release's schema, conforming to JSON Schema.
	 *
	 * @since 4.0.0 Retraceur fork.
	 *
	 * @return array Release schema data.
	 */
	public function get_release_schema() {
		return array(
			'$schema'    => 'http://json-schema.org/draft-04/schema#',
			'title'      => 'retraceur-repository-release',
			'type'       => 'object',
			'properties' => array(
				'title'        => array(
					'description' => __( 'The release title.' ),
					'type'        => 'string',
					'context'     => array( 'view' ),
				),
				'version'     => array(
					'description' => __( 'The repository release version number.' ),
					'type'        => 'string',
					'context'     => array( 'view' ),
				),
				'note'        => array(
					'description' => __( 'The repository release note.' ),
					'type'        => 'string',
					'context'     => array( 'view' ),
				),
				'release_url' => array(
					'description' => __( 'The URL to the release page.' ),
					'type'        => 'string',
					'format'      => 'uri',
					'context'     => array( 'view' ),
				),
				'download_url' => array(
					'description' => __( 'The URL to download the release zip asset.' ),
					'type'        => 'string',
					'format'      => 'uri',
					'context'     => array( 'view' ),
				),
				'digest'       => array(
					'description' => __( 'The SHA256 digest of the asset (sha256:abc123...).' ),
					'type'        => 'string',
					'context'     => array( 'view' ),
					'readonly'    => true,
				),
			),
		);
	}

	/**
	 * Retrieves the repository's schema, conforming to JSON Schema.
	 *
	 * @since 4.0.0 Retraceur fork.
	 *
	 * @return array Repository schema data.
	 */
	public function get_single_repository_schema() {
		$base_schema    = $this->get_item_schema();
		$release_schema = $this->get_release_schema();

		// Build from `retraceur/manifest.json`.
		$extra_properties = array(
			'type'               => array(
				'description' => __( 'The type of Retraceur repository.' ),
				'type'        => 'string',
				'enum'        => array( 'plugin', 'block' ),
				'context'     => array( 'view' ),
			),
			'requires_retraceur' => array(
				'description' => __( 'The minimum required version of Retraceur.' ),
				'type'        => 'string',
				'context'     => array( 'view' ),
			),
			'requires_php'       => array(
				'description' => __( 'The minimum required version of PHP.' ),
				'type'        => 'string',
				'context'     => array( 'view' ),
			),
			'dependencies'        => array(
				'description' => __( 'The list of repository dependencies.' ),
				'type'        => 'array',
				'items'       => array(
					'type' => 'string',
				),
				'context'     => array( 'view' ),
			),
		);

		return array_merge(
			$base_schema,
			array(
				'title'      => 'retraceur-single-repository',
				'properties' => array_merge( $base_schema['properties'], $extra_properties, $release_schema['properties'] ),
			)
		);
	}

	/**
	 * Retrieves the changelog schema, conforming to JSON Schema.
	 *
	 * @since 4.0.0 Retraceur fork.
	 *
	 * @return array Changelog schema data.
	 */
	public function get_changelog_schema() {
		return array(
			'$schema'    => 'http://json-schema.org/draft-04/schema#',
			'title'      => 'retraceur-repository-changelog',
			'type'       => 'object',
			'properties' => array(
				'content' => array(
					'description' => __( 'The repository changelog rendered as HTML.' ),
					'type'        => 'string',
					'context'     => array( 'view' ),
					'readonly'    => true,
				),
			),
		);
	}
}
