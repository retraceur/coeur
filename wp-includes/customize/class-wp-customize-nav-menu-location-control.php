<?php
/**
 * Customize API: WP_Customize_Nav_Menu_Location_Control class.
 *
 * @since WP 4.4.0
 * @since 1.0.0 motsVertueux fork.
 *
 * @package motsVertueux
 * @subpackage Customize
 */

/**
 * Customize Menu Location Control Class.
 *
 * This custom control is only needed for JS.
 *
 * @since WP 4.3.0
 *
 * @see WP_Customize_Control
 */
class WP_Customize_Nav_Menu_Location_Control extends WP_Customize_Control {

	/**
	 * Control type.
	 *
	 * @since WP 4.3.0
	 * @var string
	 */
	public $type = 'nav_menu_location';

	/**
	 * Location ID.
	 *
	 * @since WP 4.3.0
	 * @var string
	 */
	public $location_id = '';

	/**
	 * Refresh the parameters passed to JavaScript via JSON.
	 *
	 * @since WP 4.3.0
	 *
	 * @see WP_Customize_Control::to_json()
	 */
	public function to_json() {
		parent::to_json();
		$this->json['locationId'] = $this->location_id;
	}

	/**
	 * Render content just like a normal select control.
	 *
	 * @since WP 4.3.0
	 * @since WP 4.9.0 Added a button to create menus.
	 */
	public function render_content() {
		if ( empty( $this->choices ) ) {
			return;
		}

		$value_hidden_class    = '';
		$no_value_hidden_class = '';
		if ( $this->value() ) {
			$value_hidden_class = ' hidden';
		} else {
			$no_value_hidden_class = ' hidden';
		}
		?>
		<label>
			<?php if ( ! empty( $this->label ) ) : ?>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php endif; ?>

			<?php if ( ! empty( $this->description ) ) : ?>
			<span class="description customize-control-description"><?php echo $this->description; ?></span>
			<?php endif; ?>

			<select <?php $this->link(); ?>>
				<?php
				foreach ( $this->choices as $value => $label ) :
					echo '<option value="' . esc_attr( $value ) . '"' . selected( $this->value(), $value, false ) . '>' . esc_html( $label ) . '</option>';
				endforeach;
				?>
			</select>
		</label>
		<button type="button" class="button-link create-menu<?php echo $value_hidden_class; ?>" data-location-id="<?php echo esc_attr( $this->location_id ); ?>" aria-label="<?php esc_attr_e( 'Create a menu for this location' ); ?>"><?php _e( '+ Create New Menu' ); ?></button>
		<button type="button" class="button-link edit-menu<?php echo $no_value_hidden_class; ?>" aria-label="<?php esc_attr_e( 'Edit selected menu' ); ?>"><?php _e( 'Edit Menu' ); ?></button>
		<?php
	}
}
