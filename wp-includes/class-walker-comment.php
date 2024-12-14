<?php
/**
 * Comment API: Walker_Comment class.
 *
 * @since WP 4.4.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Comments
 */

_deprecated_file( basename( __FILE__ ), '1.0.0', '', '', true );

/**
 * Core walker class used to create an HTML list of comments.
 *
 * @since WP 2.7.0
 * @deprecated 1.0.0 Retraceur removed the WP Comments feature.
 *
 * @see Walker
 */
class Walker_Comment extends Walker {

	/**
	 * Constructor.
	 *
	 * @since WP 2.7.0
	 * @deprecated 1.0.0 Retraceur removed the WP Comments feature.
	 */
	public function __construct() {
		_deprecated_class( 'Walker_Comment', '1.0.0', '', true );
	}
}
