<?php
/**
 * Customize API: WP_Customize_Image_Control class.
 *
 * @since WP 4.4.0
 * @since 1.0.0 motsVertueux fork.
 *
 * @package motsVertueux
 * @subpackage Customize
 */

/**
 * Customize Image Control class.
 *
 * @since WP 3.4.0
 *
 * @see WP_Customize_Upload_Control
 */
class WP_Customize_Image_Control extends WP_Customize_Upload_Control {
	/**
	 * Control type.
	 *
	 * @since WP 3.4.0
	 * @var string
	 */
	public $type = 'image';

	/**
	 * Media control mime type.
	 *
	 * @since WP 4.1.0
	 * @var string
	 */
	public $mime_type = 'image';

	/**
	 * @since WP 3.4.2
	 * @deprecated WP 4.1.0
	 */
	public function prepare_control() {}

	/**
	 * @since WP 3.4.0
	 * @deprecated WP 4.1.0
	 *
	 * @param string $id
	 * @param string $label
	 * @param mixed  $callback
	 */
	public function add_tab( $id, $label, $callback ) {
		_deprecated_function( __METHOD__, '4.1.0' );
	}

	/**
	 * @since WP 3.4.0
	 * @deprecated WP 4.1.0
	 *
	 * @param string $id
	 */
	public function remove_tab( $id ) {
		_deprecated_function( __METHOD__, '4.1.0' );
	}

	/**
	 * @since WP 3.4.0
	 * @deprecated WP 4.1.0
	 *
	 * @param string $url
	 * @param string $thumbnail_url
	 */
	public function print_tab_image( $url, $thumbnail_url = null ) {
		_deprecated_function( __METHOD__, '4.1.0' );
	}
}
