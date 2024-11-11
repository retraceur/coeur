<?php
/**
 * Customize API: WP_Customize_New_Menu_Control class.
 *
 * @since WP 4.4.0
 * @deprecated WP 4.9.0 This file is no longer used as of the menu creation UX introduced in #40104.
 *
 * @package motsVertueux
 * @subpackage Customize
 */

_deprecated_file( basename( __FILE__ ), '4.9.0' );

/**
 * Customize control class for new menus.
 *
 * @since WP 4.3.0
 * @deprecated WP 4.9.0 This class is no longer used as of the menu creation UX introduced in #40104.
 *
 * @see WP_Customize_Control
 */
class WP_Customize_New_Menu_Control extends WP_Customize_Control {

	/**
	 * Control type.
	 *
	 * @since WP 4.3.0
	 * @var string
	 */
	public $type = 'new_menu';

	/**
	 * Constructor.
	 *
	 * @since WP 4.9.0
	 * @deprecated WP 4.9.0
	 *
	 * @see WP_Customize_Control::__construct()
	 *
	 * @param WP_Customize_Manager $manager Customizer bootstrap instance.
	 * @param string               $id      The control ID.
	 * @param array                $args    Optional. Arguments to override class property defaults.
	 *                                      See WP_Customize_Control::__construct() for information
	 *                                      on accepted arguments. Default empty array.
	 */
	public function __construct( WP_Customize_Manager $manager, $id, array $args = array() ) {
		_deprecated_function( __METHOD__, '4.9.0' );
		parent::__construct( $manager, $id, $args );
	}

	/**
	 * Render the control's content.
	 *
	 * @since WP 4.3.0
	 * @deprecated WP 4.9.0
	 */
	public function render_content() {
		_deprecated_function( __METHOD__, '4.9.0' );
		?>
		<button type="button" class="button button-primary" id="create-new-menu-submit"><?php _e( 'Create Menu' ); ?></button>
		<span class="spinner"></span>
		<?php
	}
}
