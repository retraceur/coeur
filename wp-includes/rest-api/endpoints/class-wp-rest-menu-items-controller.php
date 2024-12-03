<?php
/**
 * REST API: WP_REST_Menu_Items_Controller class
 *
 * @since WP 5.9.0
 * @deprecated 1.0.0 Retraceur removed the WP Nav Menu feature.
 *
 * @package Retraceur
 * @subpackage REST_API
 */

_deprecated_file( basename( __FILE__ ), '1.0.0', '', '', true );

/**
 * Core class to access nav items via the REST API.
 *
 * @since WP 5.9.0
 * @deprecated 1.0.0 Retraceur removed the WP Nav Menu feature.
 *
 * @see WP_REST_Posts_Controller
 */
class WP_REST_Menu_Items_Controller extends WP_REST_Posts_Controller {

	/**
	 * Constructor.
	 *
	 * @since WP 5.9.0
	 * @deprecated 1.0.0 Retraceur removed the WP Nav Menu feature.
	 *
	 * @param string $post_type Post type.
	 */
	public function __construct( $post_type ) {
		_deprecated_class( 'WP_REST_Menu_Items_Controller', '1.0.0', '', true );
	}
}
