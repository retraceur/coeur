<?php
/**
 * REST API: WP_REST_Widgets_Controller class
 *
 * @since WP 5.8.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage REST_API
 */

_deprecated_file( basename( __FILE__ ), '1.0.0', '', '', true );

/**
 * Core class to access widgets via the REST API.
 *
 * @since WP 5.8.0
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 *
 * @see WP_REST_Controller
 */
class WP_REST_Widgets_Controller extends WP_REST_Controller {

	/**
	 * Widgets controller constructor.
	 *
	 * @since WP 5.8.0
	 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
	 */
	public function __construct() {
		_deprecated_class( 'WP_REST_Widgets_Controller', '1.0.0', '', true );
	}
}
