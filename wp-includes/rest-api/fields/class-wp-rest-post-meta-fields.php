<?php
/**
 * REST API: WP_REST_Post_Meta_Fields class.
 *
 * @since WP 4.7.0
 * @since 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage REST_API
 */

/**
 * Core class used to manage meta values for posts via the REST API.
 *
 * @since WP 4.7.0
 *
 * @see WP_REST_Meta_Fields
 */
class WP_REST_Post_Meta_Fields extends WP_REST_Meta_Fields {

	/**
	 * Post type to register fields for.
	 *
	 * @since WP 4.7.0
	 * @var string
	 */
	protected $post_type;

	/**
	 * Constructor.
	 *
	 * @since WP 4.7.0
	 *
	 * @param string $post_type Post type to register fields for.
	 */
	public function __construct( $post_type ) {
		$this->post_type = $post_type;
	}

	/**
	 * Retrieves the post meta type.
	 *
	 * @since WP 4.7.0
	 *
	 * @return string The meta type.
	 */
	protected function get_meta_type() {
		return 'post';
	}

	/**
	 * Retrieves the post meta subtype.
	 *
	 * @since WP 4.9.8
	 *
	 * @return string Subtype for the meta type, or empty string if no specific subtype.
	 */
	protected function get_meta_subtype() {
		return $this->post_type;
	}

	/**
	 * Retrieves the type for register_rest_field().
	 *
	 * @since WP 4.7.0
	 *
	 * @see register_rest_field()
	 *
	 * @return string The REST field type.
	 */
	public function get_rest_field_type() {
		return $this->post_type;
	}
}
