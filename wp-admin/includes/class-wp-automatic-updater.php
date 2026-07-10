<?php
/**
 * Upgrade API: WP_Automatic_Updater class.
 *
 * @since WP 4.6.0
 * @since 1.0.0 Retraceur fork.
 * @deprecated 4.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Upgrader
 */

_deprecated_file( basename( __FILE__ ), '4.0.0', '', '', true );

/**
 * Core class used for handling automatic background updates.
 *
 * @since WP 3.7.0
 * @since WP 4.6.0 Moved to its own file from wp-admin/includes/class-wp-upgrader.php.
 * @deprecated 4.0.0 Retraceur fork.
 */
#[AllowDynamicProperties]
class WP_Automatic_Updater {

	/**
	 * Tracks update results during processing.
	 *
	 * @var array
	 */
	protected $update_results = array();

	/**
	 * Constructor.
	 *
	 * @since 4.0.0 Retraceur fork.
	 */
	public function __construct() {
		_deprecated_class( 'WP_Automatic_Updater', '4.0.0', '', true );
	}

	/**
	 * Determines whether the entire automatic updater is disabled.
	 *
	 * @since WP 3.7.0
	 * @deprecated 2.0.0 Retraceur fork.
	 *
	 * @return bool True if the automatic updater is disabled, false otherwise.
	 */
	public function is_disabled() {
		_deprecated_function( __METHOD__, '2.0.0', '', true );

		/**
		 * Filters whether to entirely disable background updates.
		 *
		 * There are more fine-grained filters and controls for selective disabling.
		 * This filter parallels the AUTOMATIC_UPDATER_DISABLED constant in name.
		 *
		 * This also disables update notification emails. That may change in the future.
		 *
		 * @since WP 3.7.0
		 * @since 1.0.0 Retraceur fork disabled auto-updates. It will be back soon.
		 * @deprecated 2.0.0 Retraceur fork.
		 *
		 * @param bool $disabled Whether the updater should be disabled.
		 */
		apply_filters_deprecated(
			'automatic_updater_disabled',
			array( false ),
			'2.0.0',
			'',
			__( 'The WP Background Updates feature is not used by Retraceur fork.' )
		);

		return false;
	}

	/**
	 * Checks whether access to a given directory is allowed.
	 *
	 * This is used when detecting version control checkouts. Takes into account
	 * the PHP `open_basedir` restrictions, so that Retraceur does not try to access
	 * directories it is not allowed to.
	 *
	 * @since WP 6.2.0
	 * @deprecated 4.0.0 Retraceur fork.
	 *
	 * @param string $dir The directory to check.
	 * @return bool True if access to the directory is allowed, false otherwise.
	 */
	public function is_allowed_dir( $dir ) {
		_deprecated_function( __METHOD__, '4.0.0', '', true );

		return false;
	}

	/**
	 * Checks for version control checkouts.
	 *
	 * Checks for Subversion, Git, Mercurial, and Bazaar. It recursively looks up the
	 * filesystem to the top of the drive, erring on the side of detecting a VCS
	 * checkout somewhere.
	 *
	 * ABSPATH is always checked in addition to whatever `$context` is (which may be the
	 * wp-content directory, for example). The underlying assumption is that if you are
	 * using version control *anywhere*, then you should be making decisions for
	 * how things get updated.
	 *
	 * @since WP 3.7.0
	 * @deprecated 4.0.0 Retraceur fork.
	 *
	 * @param string $context The filesystem path to check, in addition to ABSPATH.
	 * @return bool True if a VCS checkout was discovered at `$context` or ABSPATH,
	 *              or anywhere higher. False otherwise.
	 */
	public function is_vcs_checkout( $context ) {
		_deprecated_function( __METHOD__, '4.0.0', '', true );

		/**
		 * Filters whether the automatic updater should consider a filesystem
		 * location to be potentially managed by a version control system.
		 *
		 * @since WP 3.7.0
		 * @deprecated 4.0.0 Retraceur fork.
		 *
		 * @param bool $checkout  Whether a VCS checkout was discovered at `$context`
		 *                        or ABSPATH, or anywhere higher.
		 * @param string $context The filesystem context (a path) against which
		 *                        filesystem status should be checked.
		 */
		apply_filters_deprecated(
			'automatic_updates_is_vcs_checkout',
			array( false, $context ),
			'4.0.0',
			'',
			__( 'The WP Automatic Updates feature is not supported by the Retraceur fork.' )
		);

		return false;
	}

	/**
	 * Tests to see if we can and should update a specific item.
	 *
	 * @since WP 3.7.0
	 * @deprecated 2.0.0 Retraceur fork.
	 *
	 * @param string $type    The type of update being checked: 'core', 'theme',
	 *                        'plugin', 'translation'.
	 * @param object $item    The update offer.
	 * @param string $context The filesystem context (a path) against which filesystem
	 *                        access and status should be checked.
	 * @return bool True if the item should be updated, false otherwise.
	 */
	public function should_update( $type, $item, $context ) {
		_deprecated_function( __METHOD__, '2.0.0', '', true );
		$update = false;
		$item   =  new stdClass();

		/**
		 * Filters whether to automatically update core, a plugin, a theme, or a language.
		 *
		 * The dynamic portion of the hook name, `$type`, refers to the type of update
		 * being checked.
		 *
		 * Possible hook names include:
		 *
		 *  - `auto_update_core`
		 *  - `auto_update_plugin`
		 *  - `auto_update_theme`
		 *  - `auto_update_translation`
		 *
		 * Since WP 3.7, minor and development versions of core, and translations have
		 * been auto-updated by default. New installs on WP 5.6 or higher will also
		 * auto-update major versions by default. Starting in 5.6, older sites can opt-in to
		 * major version auto-updates, and auto-updates for plugins and themes.
		 *
		 * See the {@see 'allow_dev_auto_core_updates'}, {@see 'allow_minor_auto_core_updates'},
		 * and {@see 'allow_major_auto_core_updates'} filters for a more straightforward way to
		 * adjust core updates.
		 *
		 * @since WP 3.7.0
		 * @since WP 5.5.0 The `$update` parameter accepts the value of null.
		 * @deprecated 2.0.0 Retraceur fork.
		 *
		 * @param bool|null $update Whether to update. The value of null is internally used
		 *                          to detect whether nothing has hooked into this filter.
		 * @param object    $item   The update offer.
		 */
		apply_filters_deprecated(
			"auto_update_{$type}",
			array( $update, $item ),
			'2.0.0',
			'',
			__( 'The WP Background Updates feature is not used by Retraceur fork.' )
		);

		return false;
	}

	/**
	 * Notifies an administrator of a core update.
	 *
	 * @since WP 3.7.0
	 * @deprecated 2.0.0 Retraceur fork.
	 *
	 * @param object $item The update offer.
	 * @return bool True if the site administrator is notified of a core update,
	 *              false otherwise.
	 */
	protected function send_core_update_notification_email( $item ) {
		_deprecated_function( __METHOD__, '2.0.0', '', true );


		// Don't notify if we've already notified the same email address of the same version.
		if ( $notified
			&& get_site_option( 'admin_email' ) === $notified['email']
			&& $notified['version'] === $item->current
		) {
			return false;
		}

		// See if we need to notify users of a core update.
		$notify = ! empty( $item->notify_email );

		/**
		 * Filters whether to notify the site administrator of a new core update.
		 *
		 * By default, administrators are notified when the update offer received
		 * sets a particular flag. This allows some discretion in if and when to notify.
		 *
		 * This filter is only evaluated once per release. If the same email address
		 * was already notified of the same new version, Retraceur won't repeatedly
		 * email the administrator.
		 *
		 * This filter is also used on about.php to check if a plugin has disabled
		 * these notifications.
		 *
		 * @since WP 3.7.0
		 * @deprecated 2.0.0 Retraceur fork.
		 *
		 * @param bool   $notify Whether the site administrator is notified.
		 * @param object $item   The update offer.
		 */
		apply_filters_deprecated(
			'send_core_update_notification_email',
			array( $notify, $item ),
			'2.0.0',
			'',
			__( 'The WP Background Updates feature is not used by Retraceur fork.' )
		);

		return false;
	}

	/**
	 * Updates an item, if appropriate.
	 *
	 * @since WP 3.7.0
	 * @deprecated 2.0.0 Retraceur fork.
	 *
	 * @param string $type The type of update being checked: 'core', 'theme', 'plugin', 'translation'.
	 * @param object $item The update offer.
	 * @return null|WP_Error
	 */
	public function update( $type, $item ) {
		_deprecated_function( __METHOD__, '2.0.0', '', true );
		$item =  new stdClass();

		/**
		 * Fires immediately prior to an auto-update.
		 *
		 * @since WP 4.4.0
		 * @deprecated 2.0.0 Retraceur fork.
		 *
		 * @param string $type    The type of update being checked: 'core', 'theme', 'plugin', or 'translation'.
		 * @param object $item    The update offer.
		 * @param string $context The filesystem context (a path) against which filesystem access and status
		 *                        should be checked.
		 */
		do_action_deprecated(
			'pre_auto_update',
			array( '', $item, '' ),
			'2.0.0',
			'',
			__( 'The WP Background Updates feature is not used by Retraceur fork.' )
		);

		return null;
	}

	/**
	 * Kicks off the background update process, looping through all pending updates.
	 *
	 * @since WP 3.7.0
	 * @deprecated 2.0.0 Retraceur fork.
	 */
	public function run() {
		_deprecated_function( __METHOD__, '2.0.0', '', true );
		$not_supported = __( 'The WP Background Updates feature is not used by Retraceur fork.' );

		/**
		 * Filters whether to send a debugging email for each automatic background update.
		 *
		 * @since WP 3.7.0
		 * @deprecated 2.0.0 Retraceur fork.
		 *
		 * @param bool $development_version By default, emails are sent if the
		 *                                  install is a development version.
		 *                                  Return false to avoid the email.
		 */
		apply_filters_deprecated(
			'automatic_updates_send_debug_email',
			array( false ),
			'2.0.0',
			'',
			$not_supported
		);

		/**
		 * Fires after all automatic updates have run.
		 *
		 * @since WP 3.8.0
		 * @deprecated 2.0.0 Retraceur fork.
		 *
		 * @param array $update_results The results of all attempted updates.
		 */
		do_action_deprecated(
			'automatic_updates_complete',
			array( array() ),
			'2.0.0',
			'',
			$not_supported
		);

		return;
	}

	/**
	 * Checks whether to send an email and avoid processing future updates after
	 * attempting a core update.
	 *
	 * @since WP 3.7.0
	 * @deprecated 2.0.0 Retraceur fork.
	 *
	 * @param object $update_result The result of the core update. Includes the update offer and result.
	 */
	protected function after_core_update( $update_result ) {
		_deprecated_function( __METHOD__, '2.0.0', '', true );
		return;
	}

	/**
	 * Sends an email upon the completion or failure of a background core update.
	 *
	 * @since WP 3.7.0
	 * @deprecated 2.0.0 Retraceur fork.
	 *
	 * @param string $type        The type of email to send. Can be one of 'success', 'fail', 'manual', 'critical'.
	 * @param object $core_update The update offer that was attempted.
	 * @param mixed  $result      Optional. The result for the core update. Can be WP_Error.
	 */
	protected function send_email( $type, $core_update, $result = null ) {
		_deprecated_function( __METHOD__, '2.0.0', '', true );
		$core_update   = new stdClass();
		$not_supported = __( 'The WP Background Updates feature is not used by Retraceur fork.' );

		/**
		 * Filters whether to send an email following an automatic background core update.
		 *
		 * @since WP 3.7.0
		 * @deprecated 2.0.0 Retraceur fork.
		 *
		 * @param bool   $send        Whether to send the email. Default true.
		 * @param string $type        The type of email to send. Can be one of
		 *                            'success', 'fail', 'critical'.
		 * @param object $core_update The update offer that was attempted.
		 * @param mixed  $result      The result for the core update. Can be WP_Error.
		 */
		apply_filters_deprecated(
			'auto_core_update_send_email',
			array( false, '', $core_update, null ),
			'2.0.0',
			'',
			$not_supported
		);

		/**
		 * Filters the email sent following an automatic background core update.
		 *
		 * @since WP 3.7.0
		 * @deprecated 2.0.0 Retraceur fork.
		 *
		 * @param array $email {
		 *     Array of email arguments that will be passed to wp_mail().
		 *
		 *     @type string $to      The email recipient. An array of emails
		 *                            can be returned, as handled by wp_mail().
		 *     @type string $subject The email's subject.
		 *     @type string $body    The email message body.
		 *     @type string $headers Any email headers, defaults to no headers.
		 * }
		 * @param string $type        The type of email being sent. Can be one of
		 *                            'success', 'fail', 'manual', 'critical'.
		 * @param object $core_update The update offer that was attempted.
		 * @param mixed  $result      The result for the core update. Can be WP_Error.
		 */
		apply_filters_deprecated(
			'auto_core_update_email',
			array( array(), '', $core_update, null ),
			'2.0.0',
			'',
			$not_supported
		);

		return;
	}


	/**
	 * Checks whether an email should be sent after attempting plugin or theme updates.
	 *
	 * @since WP 5.5.0
	 * @deprecated 2.0.0 Retraceur fork.
	 *
	 * @param array $update_results The results of update tasks.
	 */
	protected function after_plugin_theme_update( $update_results ) {
		_deprecated_function( __METHOD__, '2.0.0', '', true );
		$not_supported = __( 'The WP Background Updates feature is not used by Retraceur fork.' );

		/**
		 * Filters whether to send an email following an automatic background plugin update.
		 *
		 * @since WP 5.5.0
		 * @since WP 5.5.1 Added the `$update_results` parameter.
		 * @deprecated 2.0.0 Retraceur fork.
		 *
		 * @param bool  $enabled        True if plugin update notifications are enabled, false otherwise.
		 * @param array $update_results The results of plugins update tasks.
		 */
		apply_filters_deprecated(
			'auto_plugin_update_send_email',
			array( false, array() ),
			'2.0.0',
			'',
			$not_supported
		);

		/**
		 * Filters whether to send an email following an automatic background theme update.
		 *
		 * @since WP 5.5.0
		 * @since WP 5.5.1 Added the `$update_results` parameter.
		 * @deprecated 2.0.0 Retraceur fork.
		 *
		 * @param bool  $enabled        True if theme update notifications are enabled, false otherwise.
		 * @param array $update_results The results of theme update tasks.
		 */
		apply_filters_deprecated(
			'auto_theme_update_send_email',
			array( false, array() ),
			'2.0.0',
			'',
			$not_supported
		);
	}

	/**
	 * Sends an email upon the completion or failure of a plugin or theme background update.
	 *
	 * @since WP 5.5.0
	 * @deprecated 2.0.0 Retraceur fork.
	 *
	 * @param string $type               The type of email to send. Can be one of 'success', 'fail', 'mixed'.
	 * @param array  $successful_updates A list of updates that succeeded.
	 * @param array  $failed_updates     A list of updates that failed.
	 */
	protected function send_plugin_theme_email( $type, $successful_updates, $failed_updates ) {
		_deprecated_function( __METHOD__, '2.0.0', '', true );

		/**
		 * Filters the email sent following an automatic background update for plugins and themes.
		 *
		 * @since WP 5.5.0
		 * @deprecated 2.0.0 Retraceur fork.
		 *
		 * @param array  $email {
		 *     Array of email arguments that will be passed to wp_mail().
		 *
		 *     @type string $to      The email recipient. An array of emails
		 *                           can be returned, as handled by wp_mail().
		 *     @type string $subject The email's subject.
		 *     @type string $body    The email message body.
		 *     @type string $headers Any email headers, defaults to no headers.
		 * }
		 * @param string $type               The type of email being sent. Can be one of 'success', 'fail', 'mixed'.
		 * @param array  $successful_updates A list of updates that succeeded.
		 * @param array  $failed_updates     A list of updates that failed.
		 */
		apply_filters_deprecated(
			'auto_plugin_theme_update_email',
			array( array(), '', array(), array() ),
			'2.0.0',
			'',
			__( 'The WP Background Updates feature is not used by Retraceur fork.' )
		);
	}

	/**
	 * Prepares and sends an email of a full log of background update results, useful for debugging and geekery.
	 *
	 * @since WP 3.7.0
	 * @deprecated 2.0.0 Retraceur fork.
	 */
	protected function send_debug_email() {
		_deprecated_function( __METHOD__, '2.0.0', '', true );

		/**
		 * Filters the debug email that can be sent following an automatic
		 * background core update.
		 *
		 * @since WP 3.8.0
		 * @deprecated 2.0.0 Retraceur fork.
		 *
		 * @param array $email {
		 *     Array of email arguments that will be passed to wp_mail().
		 *
		 *     @type string $to      The email recipient. An array of emails
		 *                           can be returned, as handled by wp_mail().
		 *     @type string $subject Email subject.
		 *     @type string $body    Email message body.
		 *     @type string $headers Any email headers. Default empty.
		 * }
		 * @param int   $failures The number of failures encountered while upgrading.
		 * @param mixed $results  The results of all attempted updates.
		 */
		apply_filters_deprecated(
			'automatic_updates_debug_email',
			array( array(), 0, null ),
			'2.0.0',
			'',
			__( 'The WP Background Updates feature is not used by Retraceur fork.' )
		);
	}

	/**
	 * Performs a loopback request to check for potential fatal errors.
	 *
	 * Fatal errors cannot be detected unless maintenance mode is enabled.
	 *
	 * @since WP 6.6.0
	 * @deprecated 2.0.0 Retraceur fork.
	 *
	 * @global int $upgrading The Unix timestamp marking when upgrading Retraceur began.
	 *
	 * @return bool Whether a fatal error was detected.
	 */
	protected function has_fatal_error() {
		_deprecated_function( __METHOD__, '2.0.0', '', true );
		return false;
	}
}
