<?php
/**
 * REST API: Retraceur_REST_Discovery_Controller class
 *
 * @since 3.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage REST_API
 */

/**
 * Controller which provides REST endpoint to discover blocks, plugins & themes.
 *
 * @since 3.0.0 Retraceur fork.
 *
 * @see WP_REST_Controller
 */
class Retraceur_REST_Discovery_Controller extends WP_REST_Controller {

	/**
	 * Constructs the controller.
	 *
	 * @since 3.0.0 Retraceur fork.
	 */
	public function __construct() {
		$this->namespace = 'wp/v2';
		$this->rest_base = 'discover';
	}

	/**
	 * Registers the necessary REST API routes.
	 *
	 * @since 3.0.0 Retraceur fork.
	 */
	public function register_routes() {
		register_rest_route(
			$this->namespace,
			'/' . $this->rest_base . '/blocks',
			array(
				array(
					'methods'             => WP_REST_Server::READABLE,
					'callback'            => array( $this, 'get_blocks' ),
					'permission_callback' => array( $this, 'get_blocks_permissions_check' ),
					'args'                => $this->get_collection_params(),
				),
				'schema' => array( $this, 'get_public_item_schema' ),
			)
		);
	}

	/**
	 * Checks whether a given request has permission to install and activate plugins.
	 *
	 * @since 3.0.0 Retraceur fork.
	 *
	 * @param WP_REST_Request $request Full details about the request.
	 * @return true|WP_Error True if the request has permission, WP_Error object otherwise.
	 */
	public function get_blocks_permissions_check( $request ) {
		return true;
		if ( ! current_user_can( 'install_plugins' ) || ! current_user_can( 'activate_plugins' ) ) {
			return new WP_Error(
				'rest_block_directory_cannot_view',
				__( 'Sorry, you are not allowed to discover external blocks.' ),
				array( 'status' => rest_authorization_required_code() )
			);
		}

		return true;
	}

	/**
	 * Search and retrieve blocks metadata
	 *
	 * @since 3.0.0 Retraceur fork.
	 *
	 * @param WP_REST_Request $request Full details about the request.
	 * @return WP_REST_Response|WP_Error Response object on success, or WP_Error object on failure.
	 */
	public function get_blocks( $request ) {
		require_once ABSPATH . 'wp-admin/includes/plugin-install.php';
		require_once ABSPATH . 'wp-admin/includes/plugin.php';

		$response = retraceur_discovery_api(
			'retraceur-block',
			array(
				'search'   => $request['search'],
				'sort'     => $request['sort'],
				'order'    => $request['order'],
				'per_page' => $request['per_page'],
				'page'     => $request['page'],
			)
		);

		if ( is_wp_error( $response ) ) {
			$response->add_data( array( 'status' => 500 ) );

			return $response;
		}

		$result = array();

		foreach ( $response['items'] as $repository ) {
			$data     = $this->prepare_item_for_response( $repository, $request );
			$result[] = $this->prepare_response_for_collection( $data );
		}

		return rest_ensure_response( $result );
	}

	/**
	 * Parse repository data and prepare it for an API response.
	 *
	 * @since 3.0.0 Retraceur fork.
	 *
	 * @param array           $item    The repository data.
	 * @param WP_REST_Request $request Request object.
	 * @return WP_REST_Response|WP_Error Response object on success, or WP_Error object on failure.
	 */
	public function prepare_item_for_response( $item, $request ) {
		$fields = $this->get_fields_for_response( $request );

		// A data array containing the properties we'll return.
		$repository = array(
			'id'                  => (int) $item['id'],
			'name'                => wp_strip_all_tags( $item['name'] ),
			'full_name'           => wp_strip_all_tags( $item['full_name'] ),
			'description'         => wp_strip_all_tags( $item['description'] ),
			'author'              => ! empty( $item['owner']['login'] ) ? wp_strip_all_tags( $item['owner']['login'] ) : __( 'Unknown author.' ),
			'last_updated'        => gmdate( 'Y-m-d\TH:i:s', strtotime( $item['updated_at'] ) ),
			'stargazers_count'    => (int) $item['stargazers_count'],
			'open_issues_count'   => (int) $item['open_issues_count'],
		);

		$this->add_additional_fields_to_object( $repository, $request );

		$response = new WP_REST_Response( $repository );

		return $response;
	}

	/**
	 * Retrieves the repository's schema, conforming to JSON Schema.
	 *
	 * @since 3.0.0 Retraceur fork.
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
			),
		);

		return $this->add_additional_fields_schema( $this->schema );
	}

	/**
	 * Retrieves repository collection parameters.
	 *
	 * @since 3.0.0 Retraceur fork.
	 *
	 * @return array Collection parameters.
	 */
	public function get_collection_params() {
		$query_params = parent::get_collection_params();

		$query_params['context']['default'] = 'view';

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
		 * Filters REST API collection parameters for the block directory controller.
		 *
		 * @since 3.0.0 Retraceur fork.
		 *
		 * @param array $query_params JSON Schema-formatted collection parameters.
		 */
		return apply_filters( 'rest_retraceur_discovery_collection_params', $query_params );
	}
}
