<?php
/**
 * List Table API: WP_Comments_List_Table class.
 *
 * @since WP 3.1.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Administration
 */

_deprecated_file( basename( __FILE__ ), '1.0.0', '', '', true );

/**
 * Core class used to implement displaying comments in a list table.
 *
 * @since WP 3.1.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @see WP_List_Table
 */
class WP_Comments_List_Table extends WP_List_Table {

	/**
	 * Constructor.
	 *
	 * @since WP 3.1.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @see WP_List_Table::__construct() for more information on default arguments.
	 *
	 * @global int $post_id
	 *
	 * @param array $args An associative array of arguments.
	 */
	public function __construct( $args = array() ) {
		_deprecated_class( 'WP_Comments_List_Table', '1.0.0', '', true );
	}
}
