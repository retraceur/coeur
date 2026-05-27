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
						),
					),
				),
				'schema' => array( $this, 'get_release_schema' ),
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
	 * Search and retrieve Repositories metadata
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
		$releases      = $releases_feed->get_items();
		$response      = array();

		foreach ( $releases as $release ) {
			$data       = $this->prepare_release_for_response( $release, $request );
			$response[] = $this->prepare_response_for_collection( $data );
		}

		return rest_ensure_response( $response );
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

		$response = new WP_REST_Response( $repository );

		return $response;
	}

	/**
	 * Parse release data and prepare it for an API response.
	 *
	 * @since 4.0.0 Retraceur fork.
	 *
	 * @param SimplePie\SimplePie $release The release data.
	 * @param WP_REST_Request     $request Request object.
	 * @return WP_REST_Response|WP_Error Response object on success, or WP_Error object on failure.
	 */
	public function prepare_release_for_response( $release, $request ) {
		$version    = '';
		$release_id = explode( '/', rtrim( $release->get_id(), '/' ) );
		$version    = end( $release_id );
		$repo_parts = explode( '/', $request['repository'] );
		$repo_slug  = end( $repo_parts );
		$url        = $release->get_link();

		if ( ! $version ) {
			$url_data = explode( '/', rtrim( wp_parse_url( $url, PHP_URL_PATH ) ) );
			$version  = end( $url_data );
		}

		// A data array containing the properties we'll return.
		$data = array(
			'title'        => wp_strip_all_tags( $release->get_title() ),
			'version'      => wp_strip_all_tags( $version ),
			'note'         => wp_strip_all_tags( $release->get_description() ),
			'release_url'  => esc_url_raw( $url ),
			'download_url' => esc_url_raw(
				"https://github.com/{$request['repository']}/releases/download/{$version}/{$repo_slug}.zip"
			),
		);

		$response = new WP_REST_Response( $data );

		return $response;
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
				'title'   => array(
					'description' => __( 'The release title.' ),
					'type'        => 'string',
					'context'     => array( 'view' ),
				),
				'version' => array(
					'description' => __( 'The repository release version number.' ),
					'type'        => 'string',
					'context'     => array( 'view' ),
				),
				'note'    => array(
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
			),
		);
	}
}
