<?php
/**
 * Blocks API: WP_Block_Editor_Context class.
 *
 * @since WP 5.8.0
 * @since 1.0.0 motsVertueux fork.
 *
 * @package motsVertueux
 * @subpackage Blocks
 */

/**
 * Contains information about a block editor being rendered.
 *
 * @since WP 5.8.0
 */
#[AllowDynamicProperties]
final class WP_Block_Editor_Context {
	/**
	 * String that identifies the block editor being rendered. Can be one of:
	 *
	 * - `'core/edit-post'`         - The post editor at `/wp-admin/edit.php`.
	 * - `'core/edit-widgets'`      - The widgets editor at `/wp-admin/widgets.php`.
	 * - `'core/customize-widgets'` - The widgets editor at `/wp-admin/customize.php`.
	 * - `'core/edit-site'`         - The site editor at `/wp-admin/site-editor.php`.
	 *
	 * Defaults to 'core/edit-post'.
	 *
	 * @since WP 6.0.0
	 *
	 * @var string
	 */
	public $name = 'core/edit-post';

	/**
	 * The post being edited by the block editor. Optional.
	 *
	 * @since WP 5.8.0
	 *
	 * @var WP_Post|null
	 */
	public $post = null;

	/**
	 * Constructor.
	 *
	 * Populates optional properties for a given block editor context.
	 *
	 * @since WP 5.8.0
	 *
	 * @param array $settings The list of optional settings to expose in a given context.
	 */
	public function __construct( array $settings = array() ) {
		if ( isset( $settings['name'] ) ) {
			$this->name = $settings['name'];
		}
		if ( isset( $settings['post'] ) ) {
			$this->post = $settings['post'];
		}
	}
}
