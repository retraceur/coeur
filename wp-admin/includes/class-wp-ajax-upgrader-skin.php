<?php
/**
 * Upgrader API: WP_Ajax_Upgrader_Skin class.
 *
 * @since WP 4.6.0
 * @since 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Upgrader
 */

/**
 * Upgrader Skin for Ajax Retraceur upgrades.
 *
 * This skin is designed to be used for Ajax updates.
 *
 * @since WP 4.6.0
 *
 * @see WP_Upgrader_Skin
 */
class WP_Ajax_Upgrader_Skin extends WP_Upgrader_Skin {
	protected $messages = array();

	/**
	 * Plugin info.
	 *
	 * The Plugin_Upgrader::bulk_upgrade() method will fill this in
	 * with info retrieved from the get_plugin_data() function.
	 *
	 * @var array Plugin data. Values will be empty if not supplied by the plugin.
	 */
	public $plugin_info = array();

	/**
	 * Theme info.
	 *
	 * The Theme_Upgrader::bulk_upgrade() method will fill this in
	 * with info retrieved from the Theme_Upgrader::theme_info() method,
	 * which in turn calls the wp_get_theme() function.
	 *
	 * @var WP_Theme|false The theme's info object, or false.
	 */
	public $theme_info = false;

	/**
	 * Holds the WP_Error object.
	 *
	 * @since WP 4.6.0
	 *
	 * @var null|WP_Error
	 */
	protected $errors = null;

	/**
	 * Constructor.
	 *
	 * Sets up the Retraceur Ajax upgrader skin.
	 *
	 * @since WP 4.6.0
	 *
	 * @see WP_Upgrader_Skin::__construct()
	 *
	 * @param array $args Optional. The Retraceur Ajax upgrader skin arguments to
	 *                    override default options. See WP_Upgrader_Skin::__construct().
	 *                    Default empty array.
	 */
	public function __construct( $args = array() ) {
		parent::__construct( $args );

		$this->errors = new WP_Error();
	}

	/**
	 * Retrieves the list of errors.
	 *
	 * @since WP 4.6.0
	 *
	 * @return WP_Error Errors during an upgrade.
	 */
	public function get_errors() {
		return $this->errors;
	}

	/**
	 * Retrieves a string for error messages.
	 *
	 * @since WP 4.6.0
	 *
	 * @return string Error messages during an upgrade.
	 */
	public function get_error_messages() {
		$messages = array();

		foreach ( $this->errors->get_error_codes() as $error_code ) {
			$error_data = $this->errors->get_error_data( $error_code );

			if ( $error_data && is_string( $error_data ) ) {
				$messages[] = $this->errors->get_error_message( $error_code ) . ' ' . esc_html( strip_tags( $error_data ) );
			} else {
				$messages[] = $this->errors->get_error_message( $error_code );
			}
		}

		return implode( ', ', $messages );
	}

	/**
	 * Stores an error message about the upgrade.
	 *
	 * @since WP 4.6.0
	 * @since WP 5.3.0 Formalized the existing `...$args` parameter by adding it
	 *              to the function signature.
	 *
	 * @param string|WP_Error $errors  Errors.
	 * @param mixed           ...$args Optional text replacements.
	 */
	public function error( $errors, ...$args ) {
		if ( is_string( $errors ) ) {
			$string = $errors;
			if ( ! empty( $this->upgrader->strings[ $string ] ) ) {
				$string = $this->upgrader->strings[ $string ];
			}

			if ( str_contains( $string, '%' ) ) {
				if ( ! empty( $args ) ) {
					$string = vsprintf( $string, $args );
				}
			}

			// Count existing errors to generate a unique error code.
			$errors_count = count( $this->errors->get_error_codes() );
			$this->errors->add( 'unknown_upgrade_error_' . ( $errors_count + 1 ), $string );
		} elseif ( is_wp_error( $errors ) ) {
			foreach ( $errors->get_error_codes() as $error_code ) {
				$this->errors->add( $error_code, $errors->get_error_message( $error_code ), $errors->get_error_data( $error_code ) );
			}
		}

		parent::error( $errors, ...$args );
	}

	/**
	 * Stores a message about the upgrade.
	 *
	 * @since WP 4.6.0
	 * @since WP 5.3.0 Formalized the existing `...$args` parameter by adding it
	 *              to the function signature.
	 * @since WP 5.9.0 Renamed `$data` to `$feedback` for PHP 8 named parameter support.
	 * @since 4.0.0 Retraceur fork copied the code from `Automatic_Upgrader_Skin::feedback()`.
	 *
	 * @param string|array|WP_Error $feedback Message data.
	 * @param mixed                 ...$args  Optional text replacements.
	 */
	public function feedback( $feedback, ...$args ) {
		if ( is_wp_error( $feedback ) ) {
			foreach ( $feedback->get_error_codes() as $error_code ) {
				$this->errors->add( $error_code, $feedback->get_error_message( $error_code ), $feedback->get_error_data( $error_code ) );
			}
		} elseif ( is_array( $feedback ) ) {
			return;
		} else {
			$string = $feedback;
		}

		if ( ! empty( $this->upgrader->strings[ $string ] ) ) {
			$string = $this->upgrader->strings[ $string ];
		}

		if ( str_contains( $string, '%' ) ) {
			if ( ! empty( $args ) ) {
				$string = vsprintf( $string, $args );
			}
		}

		$string = trim( $string );

		// Only allow basic HTML in the messages, as it'll be used in emails/logs rather than direct browser output.
		$string = wp_kses(
			$string,
			array(
				'a'      => array(
					'href' => true,
				),
				'br'     => true,
				'em'     => true,
				'strong' => true,
			)
		);

		if ( empty( $string ) ) {
			return;
		}

		$this->messages[] = $string;
	}

	/**
	 * Determines whether the upgrader needs FTP/SSH details in order to connect
	 * to the filesystem.
	 *
	 * @since 4.0.0 Retraceur fork copied the code from `Automatic_Upgrader_Skin::request_filesystem_credentials()`.
	 *
	 * @see request_filesystem_credentials()
	 *
	 * @param bool|WP_Error $error                        Optional. Whether the current request has failed to connect,
	 *                                                    or an error object. Default false.
	 * @param string        $context                      Optional. Full path to the directory that is tested
	 *                                                    for being writable. Default empty.
	 * @param bool          $allow_relaxed_file_ownership Optional. Whether to allow Group/World writable. Default false.
	 * @return bool True on success, false on failure.
	 */
	public function request_filesystem_credentials( $error = false, $context = '', $allow_relaxed_file_ownership = false ) {
		if ( $context ) {
			$this->options['context'] = $context;
		}
		/*
		 * TODO: Fix up request_filesystem_credentials(), or split it, to allow us to request a no-output version.
		 * This will output a credentials form in event of failure. We don't want that, so just hide with a buffer.
		 */
		ob_start();
		$result = parent::request_filesystem_credentials( $error, $context, $allow_relaxed_file_ownership );
		ob_end_clean();
		return $result;
	}

	/**
	 * Retrieves the upgrade messages.
	 *
	 * @since 4.0.0 Retraceur fork copied the code from `Automatic_Upgrader_Skin::get_upgrade_messages()`.
	 *
	 * @return string[] Messages during an upgrade.
	 */
	public function get_upgrade_messages() {
		return $this->messages;
	}

	/**
	 * Creates a new output buffer.
	 *
	 * @since 4.0.0 Retraceur fork copied the code from `Automatic_Upgrader_Skin::header()`.
	 */
	public function header() {
		ob_start();
	}

	/**
	 * Retrieves the buffered content, deletes the buffer, and processes the output.
	 *
	 * @since 4.0.0 Retraceur fork copied the code from `Automatic_Upgrader_Skin::footer()`.
	 */
	public function footer() {
		$output = ob_get_clean();
		if ( ! empty( $output ) ) {
			$this->feedback( $output );
		}
	}
}
