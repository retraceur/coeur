<?php
/**
 * Navigation Menu API: Walker_Nav_Menu_Edit class.
 *
 * @since WP 4.4.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Administration
 */

_deprecated_file( basename( __FILE__ ), '1.0.0', '', '', true );

/**
 * Create HTML list of nav menu input items.
 *
 * @since WP 3.0.0
 *
 * @see Walker_Nav_Menu
 */
class Walker_Nav_Menu_Edit extends Walker_Nav_Menu {

	/**
	 * Constructor.
	 *
	 * @since WP 3.0.0
	 * @deprecated 1.0.0 Retraceur removed the WP Nav Menus feature.
	 */
	public function __construct() {
		_deprecated_class( 'Walker_Nav_Menu_Edit', '1.0.0', '', true );
	}
}
