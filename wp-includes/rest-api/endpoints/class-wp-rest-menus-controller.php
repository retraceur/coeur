<?php
/**
 * REST API: WP_REST_Menus_Controller class.
 *
 * @since WP 5.9.0
 * @deprecated 1.0.0 Retraceur removed the WP Nav Menu feature.
 *
 * @package Retraceur
 * @subpackage REST_API
 */

_deprecated_file( basename( __FILE__ ), '1.0.0', '', '', true );

/**
 * Core class used to managed menu terms associated via the REST API.
 *
 * @since WP 5.9.0
 * @deprecated 1.0.0 Retraceur removed the WP Nav Menu feature.
 *
 * @see WP_REST_Controller
 */
class WP_REST_Menus_Controller extends WP_REST_Terms_Controller {

	/**
	 * Constructor.
	 *
	 * @since WP 5.9.0
	 * @deprecated 1.0.0 Retraceur removed the WP Nav Menu feature.
	 *
	 * @param string $taxonomy Taxonomy key.
	 */
	public function __construct( $taxonomy ) {
		_deprecated_class( 'WP_REST_Menus_Controller', '1.0.0', '', true );
	}
}
