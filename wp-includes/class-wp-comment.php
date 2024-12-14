<?php
/**
 * Comment API: WP_Comment class.
 *
 * @since WP 4.4.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Comments
 */

_deprecated_file( basename( __FILE__ ), '1.0.0', '', '', true );

/**
 * Core class used to organize comments as instantiated objects with defined members.
 *
 * @since WP 4.4.0
 * @deprecated 1.0.0 Retraceur removed the WP Comments feature.
 */
#[AllowDynamicProperties]
final class WP_Comment {

	/**
	 * Constructor.
	 *
	 * Populates properties with object vars.
	 *
	 * @since WP 4.4.0
	 * @deprecated 1.0.0 Retraceur removed the WP Comments feature.
	 *
	 * @param WP_Comment $comment Comment object.
	 */
	public function __construct( $comment ) {
		_deprecated_class( 'WP_Comment', '1.0.0', '', true );
	}
}
