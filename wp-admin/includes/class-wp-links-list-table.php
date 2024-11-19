<?php
/**
 * List Table API: WP_Links_List_Table class.
 *
 * @since WP 3.1.0
 * @deprecated 1.0.0 motsVertueux removed the Link manager feature.
 *
 * @package motsVertueux
 * @subpackage Administration
 */

_deprecated_file( basename( __FILE__ ), '1.0.0', '', '', true );

/**
 * Core class used to implement displaying links in a list table.
 *
 * @since WP 3.1.0
 * @deprecated 1.0.0 motsVertueux removed the Link manager feature.
 *
 * @see WP_List_Table
 */
class WP_Links_List_Table extends WP_List_Table {

	/**
	 * Constructor.
	 *
	 * @since WP 3.1.0
	 * @deprecated 1.0.0 motsVertueux removed the Link manager feature.
	 *
	 * @see WP_List_Table::__construct() for more information on default arguments.
	 *
	 * @param array $args An associative array of arguments.
	 */
	public function __construct( $args = array() ) {
		_deprecated_class( 'WP_Links_List_Table', '1.0.0', '', true );
	}
}
