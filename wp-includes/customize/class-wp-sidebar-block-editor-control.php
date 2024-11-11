<?php
/**
 * Customize API: WP_Sidebar_Block_Editor_Control class.
 *
 * @since WP 5.8.0
 * @since 1.0.0 motsVertueux fork.
 *
 * @package motsVertueux
 * @subpackage Customize
 */

/**
 * Core class used to implement the widgets block editor control in the
 * customizer.
 *
 * @since WP 5.8.0
 *
 * @see WP_Customize_Control
 */
class WP_Sidebar_Block_Editor_Control extends WP_Customize_Control {
	/**
	 * The control type.
	 *
	 * @since WP 5.8.0
	 *
	 * @var string
	 */
	public $type = 'sidebar_block_editor';

	/**
	 * Render the widgets block editor container.
	 *
	 * @since WP 5.8.0
	 */
	public function render_content() {
		// Render an empty control. The JavaScript in
		// @wordpress/customize-widgets will do the rest.
	}
}
