<?php
/**
 * Upgrader API: Plugin_Installer_Skin class.
 *
 * @since WP 4.6.0
 * @since 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Upgrader
 */

/**
 * Plugin Installer Skin for Retraceur Plugin Installer.
 *
 * @since WP 2.8.0
 * @since WP 4.6.0 Moved to its own file from wp-admin/includes/class-wp-upgrader-skins.php.
 *
 * @see WP_Upgrader_Skin
 */
class Plugin_Installer_Skin extends WP_Upgrader_Skin {
	public $api;
	public $type;
	public $url;
	public $overwrite;

	private $is_downgrading = false;

	/**
	 * Constructor.
	 *
	 * Sets up the plugin installer skin.
	 *
	 * @since WP 2.8.0
	 *
	 * @param array $args
	 */
	public function __construct( $args = array() ) {
		$defaults = array(
			'type'      => 'web',
			'url'       => '',
			'plugin'    => '',
			'nonce'     => '',
			'title'     => '',
			'overwrite' => '',
		);
		$args     = wp_parse_args( $args, $defaults );

		$this->type      = $args['type'];
		$this->url       = $args['url'];
		$this->api       = isset( $args['api'] ) ? $args['api'] : array();
		$this->overwrite = $args['overwrite'];

		parent::__construct( $args );
	}

	/**
	 * Performs an action before installing a plugin.
	 *
	 * @since WP 2.8.0
	 */
	public function before() {
		if ( ! empty( $this->api ) ) {
			$this->upgrader->strings['process_success'] = sprintf(
				$this->upgrader->strings['process_success_specific'],
				$this->api->name,
				$this->api->version
			);
		}
	}

	/**
	 * Hides the `process_failed` error when updating a plugin by uploading a zip file.
	 *
	 * @since WP 5.5.0
	 *
	 * @param WP_Error $wp_error WP_Error object.
	 * @return bool True if the error should be hidden, false otherwise.
	 */
	public function hide_process_failed( $wp_error ) {
		if (
			'upload' === $this->type &&
			'' === $this->overwrite &&
			$wp_error->get_error_code() === 'folder_exists'
		) {
			return true;
		}

		return false;
	}

	/**
	 * Performs an action following a plugin install.
	 *
	 * @since WP 2.8.0
	 */
	public function after() {
		// Check if the plugin can be overwritten and output the HTML.
		if ( $this->do_overwrite() ) {
			return;
		}

		$plugin_file = $this->upgrader->plugin_info();
		$plugin_data = get_plugin_data( WP_PLUGIN_DIR . '/' . $plugin_file );
		$plugin_type = 'regular';
		if ( isset( $plugin_data['Type'] ) && 'block' === strtolower( $plugin_data['Type'] ) ) {
			$plugin_type = 'block';
		}

		$install_actions = array();

		$from = isset( $_GET['from'] ) ? wp_unslash( $_GET['from'] ) : 'plugins';

		if ( 'import' === $from ) {
			$install_actions['activate_plugin'] = sprintf(
				'<a class="button button-primary" href="%s" target="_parent">%s</a>',
				wp_nonce_url( 'plugins.php?action=activate&amp;from=import&amp;plugin=' . urlencode( $plugin_file ), 'activate-plugin_' . $plugin_file ),
				__( 'Activate Plugin &amp; Run Importer' )
			);
		} elseif ( 'press-this' === $from ) {
			$install_actions['activate_plugin'] = sprintf(
				'<a class="button button-primary" href="%s" target="_parent">%s</a>',
				wp_nonce_url( 'plugins.php?action=activate&amp;from=press-this&amp;plugin=' . urlencode( $plugin_file ), 'activate-plugin_' . $plugin_file ),
				__( 'Activate Plugin &amp; Go to Press This' )
			);
		} elseif ( 'block' === $plugin_type ) {
			$install_actions['activate_plugin'] = sprintf(
				'<a class="button button-primary" href="%s" target="_parent">%s</a>',
				wp_nonce_url( 'blocks.php?action=activate&amp;plugin=' . urlencode( $plugin_file ), 'activate-plugin_' . $plugin_file ),
				__( 'Activate Block' )
			);
		} else {
			$install_actions['activate_plugin'] = sprintf(
				'<a class="button button-primary" href="%s" target="_parent">%s</a>',
				wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . urlencode( $plugin_file ), 'activate-plugin_' . $plugin_file ),
				__( 'Activate Plugin' )
			);
		}

		if ( is_multisite() && current_user_can( 'manage_network_plugins' ) ) {
			$install_actions['network_activate'] = sprintf(
				'<a class="button button-primary" href="%s" target="_parent">%s</a>',
				wp_nonce_url( 'plugins.php?action=activate&amp;networkwide=1&amp;plugin=' . urlencode( $plugin_file ), 'activate-plugin_' . $plugin_file ),
				_x( 'Network Activate', 'plugin' )
			);
			unset( $install_actions['activate_plugin'] );
		}

		if ( 'web' === $this->type ) {
			$install_actions['plugins_page'] = sprintf(
				'<a href="%s" target="_parent">%s</a>',
				self_admin_url( 'plugin-install.php' ),
				__( 'Go to Plugin Installer' )
			);
		} elseif ( 'upload' === $this->type && 'plugins' === $from ) {
			if ( 'block' === $plugin_type ) {
				$install_actions['plugins_page'] = sprintf(
					'<a href="%s">%s</a>',
					self_admin_url( 'block-install.php' ),
					__( 'Go to Block Installer' )
				);
			} else {
				$install_actions['plugins_page'] = sprintf(
					'<a href="%s">%s</a>',
					self_admin_url( 'plugin-install.php' ),
					__( 'Go to Plugin Installer' )
				);
			}
		} else {
			$install_actions['plugins_page'] = sprintf(
				'<a href="%s" target="_parent">%s</a>',
				self_admin_url( 'plugins.php' ),
				__( 'Go to Plugins page' )
			);
		}

		if ( ! $this->result || is_wp_error( $this->result ) ) {
			unset( $install_actions['activate_plugin'], $install_actions['network_activate'] );
		} elseif ( ! current_user_can( 'activate_plugin', $plugin_file ) || is_plugin_active( $plugin_file ) ) {
			unset( $install_actions['activate_plugin'] );
		}

		/**
		 * Filters the list of action links available following a single plugin installation.
		 *
		 * @since WP 2.7.0
		 *
		 * @param string[] $install_actions Array of plugin action links.
		 * @param object   $api             Object containing plugin data. Empty
		 *                                  for non-API installs, such as when a plugin is installed
		 *                                  via upload.
		 * @param string   $plugin_file     Path to the plugin file relative to the plugins directory.
		 */
		$install_actions = apply_filters( 'install_plugin_complete_actions', $install_actions, $this->api, $plugin_file );

		if ( ! empty( $install_actions ) ) {
			$this->feedback( implode( ' ', (array) $install_actions ) );
		}
	}

	/**
	 * Checks if the plugin can be overwritten and outputs the HTML for overwriting a plugin on upload.
	 *
	 * @since WP 5.5.0
	 *
	 * @return bool Whether the plugin can be overwritten and HTML was outputted.
	 */
	private function do_overwrite() {
		if ( 'upload' !== $this->type || ! is_wp_error( $this->result ) || 'folder_exists' !== $this->result->get_error_code() ) {
			return false;
		}

		$folder = $this->result->get_error_data( 'folder_exists' );
		$folder = ltrim( substr( $folder, strlen( WP_PLUGIN_DIR ) ), '/' );

		$current_plugin_data = false;
		$all_plugins         = get_plugins();

		foreach ( $all_plugins as $plugin => $plugin_data ) {
			if ( strrpos( $plugin, $folder ) !== 0 ) {
				continue;
			}

			$current_plugin_data = $plugin_data;
		}

		$new_plugin_data = $this->upgrader->new_plugin_data;

		if ( ! $current_plugin_data || ! $new_plugin_data ) {
			return false;
		}

		$plugin_type    = 'regular';
		$upload_heading = __( 'This plugin is already installed.' );

		if ( isset( $new_plugin_data['Type'] ) && 'block' === strtolower( $new_plugin_data['Type'] ) ) {
			$plugin_type    = 'block';
			$upload_heading = __( 'This block is already installed.' );
		}

		echo '<h2 class="update-from-upload-heading">' . esc_html( $upload_heading ) . '</h2>';

		$this->is_downgrading = version_compare( $current_plugin_data['Version'], $new_plugin_data['Version'], '>' );

		$rows = array(
			'Name'        => __( 'Plugin name' ),
			'Version'     => __( 'Version' ),
			'Author'      => __( 'Author' ),
			'RequiresR'   => __( 'Required Retraceur version' ),
			'RequiresPHP' => __( 'Required PHP version' ),
		);

		$table  = '<table class="update-from-upload-comparison"><tbody>';

		if ( 'block' === $plugin_type ) {
			$rows['Name'] = __( 'Block name' );
			$table .= '<tr><th></th><th>' . esc_html_x( 'Current', 'block' ) . '</th>';
			$table .= '<th>' . esc_html_x( 'Uploaded', 'block' ) . '</th></tr>';
		} else {
			$table .= '<tr><th></th><th>' . esc_html_x( 'Current', 'plugin' ) . '</th>';
			$table .= '<th>' . esc_html_x( 'Uploaded', 'plugin' ) . '</th></tr>';
		}

		$is_same_plugin = true; // Let's consider only these rows.

		foreach ( $rows as $field => $label ) {
			$old_value = ! empty( $current_plugin_data[ $field ] ) ? (string) $current_plugin_data[ $field ] : '-';
			$new_value = ! empty( $new_plugin_data[ $field ] ) ? (string) $new_plugin_data[ $field ] : '-';

			$is_same_plugin = $is_same_plugin && ( $old_value === $new_value );

			$diff_field   = ( 'Version' !== $field && $new_value !== $old_value );
			$diff_version = ( 'Version' === $field && $this->is_downgrading );

			$table .= '<tr><td class="name-label">' . $label . '</td><td>' . wp_strip_all_tags( $old_value ) . '</td>';
			$table .= ( $diff_field || $diff_version ) ? '<td class="warning">' : '<td>';
			$table .= wp_strip_all_tags( $new_value ) . '</td></tr>';
		}

		$table .= '</tbody></table>';

		/**
		 * Filters the compare table output for overwriting a plugin package on upload.
		 *
		 * @since WP 5.5.0
		 *
		 * @param string $table               The output table with Name, Version, Author, RequiresR, and RequiresPHP info.
		 * @param array  $current_plugin_data Array with current plugin data.
		 * @param array  $new_plugin_data     Array with uploaded plugin data.
		 */
		echo apply_filters( 'install_plugin_overwrite_comparison', $table, $current_plugin_data, $new_plugin_data );

		$install_actions = array();
		$can_update      = true;

		$blocked_message  = '<p>' . esc_html__( 'The plugin cannot be updated due to the following:' ) . '</p>';

		if ( 'block' === $plugin_type ) {
			$blocked_message  = '<p>' . esc_html__( 'The block cannot be updated due to the following:' ) . '</p>';
		}

		$blocked_message .= '<ul class="ul-disc">';

		$requires_php = isset( $new_plugin_data['RequiresPHP'] ) ? $new_plugin_data['RequiresPHP'] : null;
		$requires_wp  = isset( $new_plugin_data['RequiresR'] ) ? $new_plugin_data['RequiresR'] : null;

		if ( ! is_php_version_compatible( $requires_php ) ) {
			if ( 'block' === $plugin_type ) {
				$error = sprintf(
					/* translators: 1: Current PHP version, 2: Version required by the uploaded block */
					__( 'The PHP version on your server is %1$s, however the uploaded block requires %2$s.' ),
					PHP_VERSION,
					$requires_php
				);
			} else {
				$error = sprintf(
					/* translators: 1: Current PHP version, 2: Version required by the uploaded plugin. */
					__( 'The PHP version on your server is %1$s, however the uploaded plugin requires %2$s.' ),
					PHP_VERSION,
					$requires_php
				);
			}

			$blocked_message .= '<li>' . esc_html( $error ) . '</li>';
			$can_update       = false;
		}

		if ( ! is_wp_version_compatible( $requires_wp ) ) {
			if ( 'block' === $plugin_type ) {
				$error = sprintf(
					/* translators: 1: Current Retraceur version, 2: Version required by the uploaded block. */
					__( 'Your Retraceur version is %1$s, however the uploaded block requires %2$s.' ),
					esc_html( retraceur_get_version() ),
					$requires_wp
				);
			} else {
				$error = sprintf(
					/* translators: 1: Current Retraceur version, 2: Version required by the uploaded plugin. */
					__( 'Your Retraceur version is %1$s, however the uploaded plugin requires %2$s.' ),
					esc_html( retraceur_get_version() ),
					$requires_wp
				);
			}

			$blocked_message .= '<li>' . esc_html( $error ) . '</li>';
			$can_update       = false;
		}

		$blocked_message .= '</ul>';

		if ( $can_update ) {
			if ( $this->is_downgrading ) {
				if ( 'block' === $plugin_type ) {
					$warning = __( 'You are uploading an older version of a current block. You can continue to install the older version, but be sure to back up your database and files first.' );
				} else {
					$warning = __( 'You are uploading an older version of a current plugin. You can continue to install the older version, but be sure to back up your database and files first.' );
				}
			} else {
				if ( 'block' === $plugin_type ) {
					$warning = __( 'You are updating a block. Be sure to back up your database and files first.' );
				} else {
					$warning = __( 'You are updating a plugin. Be sure to back up your database and files first.' );
				}
			}

			echo '<p class="update-from-upload-notice">' . $warning . '</p>';

			$overwrite   = $this->is_downgrading ? 'downgrade-plugin' : 'update-plugin';
			$action_text = _x( 'Replace current with uploaded', 'plugin' );

			if ( 'block' === $plugin_type ) {
				$action_text = _x( 'Replace current with uploaded', 'block' );
			}

			$install_actions['overwrite_plugin'] = sprintf(
				'<a class="button button-primary update-from-upload-overwrite" href="%s" target="_parent">%s</a>',
				wp_nonce_url( add_query_arg( 'overwrite', $overwrite, $this->url ), 'plugin-upload' ),
				$action_text
			);
		} else {
			echo $blocked_message;
		}

		if ( 'block' === $plugin_type ) {
			$cancel_url = add_query_arg( 'action', 'upload-block-cancel-overwrite', $this->url );
		} else {
			$cancel_url = add_query_arg( 'action', 'upload-plugin-cancel-overwrite', $this->url );
		}

		$install_actions['plugins_page'] = sprintf(
			'<a class="button" href="%s">%s</a>',
			wp_nonce_url( $cancel_url, 'package-upload-cancel-overwrite' ),
			__( 'Cancel and go back' )
		);

		/**
		 * Filters the list of action links available following a single plugin installation failure
		 * when overwriting is allowed.
		 *
		 * @since WP 5.5.0
		 *
		 * @param string[] $install_actions Array of plugin action links.
		 * @param object   $api             Object containing plugin data.
		 * @param array    $new_plugin_data Array with uploaded plugin data.
		 */
		$install_actions = apply_filters( 'install_plugin_overwrite_actions', $install_actions, $this->api, $new_plugin_data );

		if ( ! empty( $install_actions ) ) {
			printf(
				'<p class="update-from-upload-expired hidden">%s</p>',
				__( 'The uploaded file has expired. Please go back and upload it again.' )
			);
			echo '<p class="update-from-upload-actions">' . implode( ' ', (array) $install_actions ) . '</p>';
		}

		return true;
	}
}
