<?php
/**
 * Nav Menu API: Walker_Nav_Menu class.
 *
 * @since WP 4.6.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Nav_Menus
 */

_deprecated_file( basename( __FILE__ ), '1.0.0', '', '', true );

/**
 * Core class used to implement an HTML list of nav menu items.
 *
 * @since WP 3.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @see Walker
 */
class Walker_Nav_Menu extends Walker {

	/**
	 * Constructor.
	 *
	 * @since WP 5.8.0
	 * @deprecated 1.0.0 Retraceur removed the WP Nav Menus feature.
	 */
	public function __construct() {
		_deprecated_class( 'Walker_Nav_Menu', '1.0.0', '', true );
	}
}
