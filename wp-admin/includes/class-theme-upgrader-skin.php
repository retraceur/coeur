<?php
/**
 * Upgrader API: Theme_Upgrader_Skin class.
 *
 * @since WP 4.6.0
 * @since 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Upgrader
 */

/**
 * Theme Upgrader Skin for Retraceur Theme Upgrades.
 *
 * @since WP 2.8.0
 * @since WP 4.6.0 Moved to its own file from wp-admin/includes/class-wp-upgrader-skins.php.
 *
 * @see WP_Upgrader_Skin
 */
class Theme_Upgrader_Skin extends WP_Upgrader_Skin {

	/**
	 * Holds the theme slug in the Theme Directory.
	 *
	 * @since WP 2.8.0
	 *
	 * @var string
	 */
	public $theme = '';

	/**
	 * Constructor.
	 *
	 * Sets up the theme upgrader skin.
	 *
	 * @since WP 2.8.0
	 *
	 * @param array $args Optional. The theme upgrader skin arguments to
	 *                    override default options. Default empty array.
	 */
	public function __construct( $args = array() ) {
		$defaults = array(
			'url'   => '',
			'theme' => '',
			'nonce' => '',
			'title' => __( 'Update Theme' ),
		);
		$args     = wp_parse_args( $args, $defaults );

		$this->theme = $args['theme'];

		parent::__construct( $args );
	}

	/**
	 * Performs an action following a single theme update.
	 *
	 * @since WP 2.8.0
	 */
	public function after() {
		$this->decrement_update_count( 'theme' );

		$update_actions = array();
		$theme_info     = $this->upgrader->theme_info();
		if ( $theme_info ) {
			$name       = $theme_info->display( 'Name' );
			$stylesheet = $this->upgrader->result['destination_name'];
			$template   = $theme_info->get_template();

			$activate_link = add_query_arg(
				array(
					'action'     => 'activate',
					'template'   => urlencode( $template ),
					'stylesheet' => urlencode( $stylesheet ),
				),
				admin_url( 'themes.php' )
			);
			$activate_link = wp_nonce_url( $activate_link, 'switch-theme_' . $stylesheet );

			$customize_url = add_query_arg(
				array(
					'theme'  => urlencode( $stylesheet ),
					'return' => urlencode( admin_url( 'themes.php' ) ),
				),
				admin_url( 'customize.php' )
			);

			if ( current_user_can( 'switch_themes' ) ) {
				$update_actions['activate'] = sprintf(
					'<a href="%s" class="activatelink">' .
					'<span aria-hidden="true">%s</span><span class="screen-reader-text">%s</span></a>',
					esc_url( $activate_link ),
					_x( 'Activate', 'theme' ),
					/* translators: %s: Theme name. */
					sprintf( _x( 'Activate &#8220;%s&#8221;', 'theme' ), $name )
				);
			}

			if ( ! $this->result || is_wp_error( $this->result ) || is_network_admin() ) {
				unset( $update_actions['preview'], $update_actions['activate'] );
			}
		}

		$update_actions['themes_page'] = sprintf(
			'<a href="%s" target="_parent">%s</a>',
			self_admin_url( 'themes.php' ),
			__( 'Go to Themes page' )
		);

		/**
		 * Filters the list of action links available following a single theme update.
		 *
		 * @since WP 2.8.0
		 *
		 * @param string[] $update_actions Array of theme action links.
		 * @param string   $theme          Theme directory name.
		 */
		$update_actions = apply_filters( 'update_theme_complete_actions', $update_actions, $this->theme );

		if ( ! empty( $update_actions ) ) {
			$this->feedback( implode( ' | ', (array) $update_actions ) );
		}
	}
}
