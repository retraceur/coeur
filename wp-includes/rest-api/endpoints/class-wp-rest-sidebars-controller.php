<?php
/**
 * REST API: WP_REST_Sidebars_Controller class.
 *
 * Original code from {@link https://github.com/martin-pettersson/wp-rest-api-sidebars Martin Pettersson (martin_pettersson@outlook.com)}.
 *
 * @since WP 5.8.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage REST_API
 */

_deprecated_file( basename( __FILE__ ), '1.0.0', '', '', true );

/**
 * Core class used to manage a site's sidebars.
 *
 * @since WP 5.8.0
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 *
 * @see WP_REST_Controller
 */
class WP_REST_Sidebars_Controller extends WP_REST_Controller {

	/**
	 * Tracks whether {@see retrieve_widgets()} has been called in the current request.
	 *
	 * @since WP 5.9.0
	 * @var bool
	 */
	protected $widgets_retrieved = false;

	/**
	 * Sidebars controller constructor.
	 *
	 * @since WP 5.8.0
	 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
	 */
	public function __construct() {
		_deprecated_class( 'WP_REST_Sidebars_Controller', '1.0.0', '', true );
	}
}
