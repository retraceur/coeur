<?php
/**
 * Update Core administration panel.
 *
 * @since 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Administration
 */

/** Retraceur Administration Bootstrap */
require_once __DIR__ . '/admin.php';

wp_enqueue_style( 'plugin-install' );
wp_enqueue_script( 'plugin-install' );
wp_enqueue_script( 'updates' );
add_thickbox();

if ( is_multisite() && ! is_network_admin() ) {
	wp_redirect( network_admin_url( 'update-core.php' ) );
	exit;
}

if ( ! current_user_can( 'update_core' ) && ! current_user_can( 'update_themes' ) && ! current_user_can( 'update_plugins' ) && ! current_user_can( 'update_languages' ) ) {
	wp_die( __( 'Sorry, you are not allowed to update this site.' ) );
}

/**
 * Lists available coeur updates.
 *
 * @since 2.0.0 Retraceur fork.
 *
 * @global wpdb $wpdb Retraceur database abstraction object.
 *
 * @param array $update The retraceur update informations.
 */
function retraceur_list_update( $update ) {
	global $wpdb;
	static $first_pass = true;

	$retraceur_version  = retraceur_get_version();
	$version_string     = $update['version'];
	$current            = $retraceur_version === $update['version'];

	$message       = '';
	$form_action   = 'update-core.php?action=do-core-upgrade';
	$php_version   = PHP_VERSION;
	$mysql_version = $wpdb->db_version();

	/**
	 * Filter to opt-in for Coeur "direct" updates (still in beta).
	 *
	 * @since 2.0.0 Retraceur fork.
	 *
	 * @param boolean $test True to test "direct" updates. False otherwise.
	 */
	$show_buttons = apply_filters( 'retraceur_betatest_direct_updates', false );
	$submit       = sprintf(
		/* translators: %s: Version number. */
		__( 'Update to version %s' ),
		$version_string
	);
	$link_text    = sprintf(
		/* translators: %s: Version number. */
		__( 'Download & upgrade to version %s' ),
		$version_string
	);

	if ( $current ) {
		/* translators: %s: Version number. */
		$submit      = sprintf( __( 'Re-install version %s' ), $version_string );
		$form_action = 'update-core.php?action=do-core-reinstall';
	} else {
		$needs_php  = ! empty( $update['requirements']['php'] ) ? $update['requirements']['php'] : '';
		$php_compat = true;

		if ( $needs_php ) {
			$php_compat = version_compare( $php_version, $needs_php, '>=' );
		}

		$needs_mysql  = ! empty( $update['requirements']['mysql'] ) ? $update['requirements']['mysql'] : '';
		$mysql_compat = true;
		if ( ! file_exists( WP_CONTENT_DIR . '/db.php' ) || empty( $wpdb->is_mysql ) && $needs_mysql ) {
			$mysql_compat = version_compare( $mysql_version, $needs_mysql, '>=' );
		}

		if ( ! $mysql_compat && ! $php_compat ) {
			$message = sprintf(
				/* translators: 1: Retraceur version number, 2: Minimum required PHP version number, 3: Minimum required MySQL version number, 4: Current PHP version number, 5: Current MySQL version number. */
				__( 'You cannot update because Retraceur %1$s requires PHP version %2$s or higher and MySQL version %3$s or higher. You are running PHP version %4$s and MySQL version %5$s.' ),
				$update['version'],
				$needs_php,
				$needs_mysql,
				$php_version,
				$mysql_version
			);
		} elseif ( ! $php_compat ) {
			$message = sprintf(
				/* translators: 1: Retraceur version number, 2: Minimum required PHP version number, 3: Current PHP version number. */
				__( 'You cannot update because Retraceur %1$s requires PHP version %2$s or higher. You are running version %3$s.' ),
				$update['version'],
				$needs_php,
				$php_version
			);
		} elseif ( ! $mysql_compat ) {
			$message = sprintf(
				/* translators: 1: Retraceur version number, 2: Minimum required MySQL version number, 3: Current MySQL version number. */
				__( 'You cannot update because Retraceur %1$s requires MySQL version %2$s or higher. You are running version %3$s.' ),
				$update['version'],
				$needs_mysql,
				$mysql_version
			);
		} else {
			$message = sprintf(
				/* translators: 1: Installed Retraceur version number, 2: New Retraceur version number, including locale if necessary. */
				__( 'You can update from Retraceur %1$s to Retraceur %2$s manually:' ),
				$retraceur_version,
				$version_string
			);
		}

		if ( ! $mysql_compat || ! $php_compat ) {
			$show_buttons = false;
		}
	}

	echo '<p>';
	echo $message;
	echo '</p>';

	echo '<form method="post" action="' . esc_url( $form_action ) . '" name="upgrade" class="upgrade">';
	wp_nonce_field( 'upgrade-core' );

	echo '<p>';
	echo '<input name="version" value="' . esc_attr( $update['version'] ) . '" type="hidden" />';
	echo '<input name="locale" value="' . esc_attr( $update['locale'] ) . '" type="hidden" />';
	if ( $show_buttons ) {
		if ( $first_pass ) {
			submit_button( $submit, $current ? '' : 'primary regular', 'upgrade', false );
			$first_pass = false;
		} else {
			submit_button( $submit, '', 'upgrade', false );
		}
	}

	// Provide a simple download link to people wishing to manually update.
	if ( isset( $update['download'] ) ) {
		$link_class = ! $show_buttons && $first_pass ? 'button-primary' : 'button-secondary';
		$first_pass = false;
		$package    = $update['download'];

		if ( 'fr_FR' === $update['locale'] ) {
			$package = str_replace( 'retraceur.zip', 'retraceur-fr_FR.zip', $package );
		}
		?>
		<a class="button<?php echo ' ' . $link_class; ?> download-package" href="<?php echo esc_url( $package ); ?>" aria-label="<?php echo esc_attr( $link_text ); ?>"><?php echo esc_html( $link_text ); ?></a>
		<?php
	}

	if ( ! isset( $update['dismissed'] ) || ! $update['dismissed'] ) {
		submit_button( __( 'Hide this update' ), '', 'dismiss', false );
	} else {
		submit_button( __( 'Bring back this update' ), '', 'undismiss', false );
	}

	echo '</p>';
	echo '</form>';
}

/**
 * Display dismissed updates.
 *
 * @since WP 2.7.0
 * @since 2.0.0 Retraceur fork. Now uses `retraceur_get_updates()`.
 */
function dismissed_updates() {
	$dismissed = retraceur_get_updates(
		array(
			'dismissed' => true,
			'available' => false,
		)
	);

	if ( $dismissed ) {
		$show_text = esc_js( __( 'Show hidden updates' ) );
		$hide_text = esc_js( __( 'Hide hidden updates' ) );
		?>
		<script type="text/javascript">
			jQuery( function( $ ) {
				$( '#show-dismissed' ).on( 'click', function() {
					var isExpanded = ( 'true' === $( this ).attr( 'aria-expanded' ) );

					if ( isExpanded ) {
						$( this ).text( '<?php echo $show_text; ?>' ).attr( 'aria-expanded', 'false' );
					} else {
						$( this ).text( '<?php echo $hide_text; ?>' ).attr( 'aria-expanded', 'true' );
					}

					$( '#dismissed-updates' ).toggle( 'fast' );
				});
			});
		</script>
		<?php
		echo '<p class="hide-if-no-js"><button type="button" class="button" id="show-dismissed" aria-expanded="false">' . __( 'Show hidden updates' ) . '</button></p>';
		echo '<ul id="dismissed-updates" class="core-updates dismissed">';
		foreach ( (array) $dismissed as $update ) {
			echo '<li>';
			retraceur_list_update( $update );
			echo '</li>';
		}
		echo '</ul>';
	}
}

/**
 * Display upgrade Retraceur for downloading latest or upgrading automatically form.
 *
 * @since WP 2.7.0
 */
function core_upgrade_preamble() {
	$updates = retraceur_get_updates();

	if ( ! $updates ) {
		wp_admin_notice(
			__( 'No Retraceur Coeur updates were found for now.' ),
			array(
				'type'               => 'info',
				'additional_classes' => array( 'inline' ),
			)
		);
		return;
	}

	// Include an unmodified $retraceur_version.
	require ABSPATH . WPINC . '/version.php';

	$is_development_version = preg_match( '/alpha|beta|RC/', $retraceur_version );

	if ( isset( $updates[0]['version'] ) && version_compare( $updates[0]['version'], $retraceur_version, '>' ) ) {
		echo '<h2 class="response">';
		esc_html_e( 'An updated version of Retraceur is available.' );
		echo '</h2>';

		wp_admin_notice(
			__( '<strong>Important:</strong> Before updating, please back up your database and files.' ),
			array(
				'type'               => 'warning',
				'additional_classes' => array( 'inline' ),
			)
		);
	} elseif ( $is_development_version ) {
		echo '<h2 class="response">' . __( 'You are using a development version of Retraceur.' ) . '</h2>';
	} else {
		echo '<h2 class="response">' . __( 'You have the latest version of Retraceur.' ) . '</h2>';
	}

	echo '<ul class="core-updates">';

	foreach ( (array) $updates as $update ) {
		if ( true !== $update['stable'] && ! $is_development_version ) {
			continue;
		}

		// Disable older version than current.
		if ( version_compare( $update['version'], $retraceur_version, '<=' ) ) {
			continue;
		}

		echo '<li>';
		retraceur_list_update( $update );
		echo '</li>';
	}
	echo '</ul>';

	// Don't show the maintenance mode notice when we are only showing a single re-install option.
	if ( $updates && count( $updates ) > 1 ) {
		echo '<p>' . __( 'While your site is being updated, it will be in maintenance mode. As soon as your updates are complete, this mode will be deactivated.' ) . '</p>';
	} elseif ( ! $updates ) {
		list( $normalized_version ) = explode( '-', $retraceur_version );
		echo '<p>' . sprintf(
			/* translators: 1: URL to About screen, 2: Retraceur version. */
			__( '<a href="%1$s">Learn more about Retraceur %2$s</a>.' ),
			esc_url( self_admin_url( 'about.php' ) ),
			$normalized_version
		) . '</p>';
	}

	dismissed_updates();
}

/**
 * Display the upgrade plugins form.
 *
 * @since WP 2.9.0
 * @since 2.0.0 Retraceur fork disabled the Plugin updates.
 */
function list_plugin_updates() {
	// Disable Plugin updates for now.
	return '';

	$retraceur_version = retraceur_get_version();
	$cur_r_version     = preg_replace( '/-.*$/', '', $retraceur_version );

	require_once ABSPATH . 'wp-admin/includes/plugin-install.php';
	$plugins = get_plugin_updates();
	if ( empty( $plugins ) ) {
		echo '<h2>' . __( 'Plugins' ) . '</h2>';
		echo '<p>' . __( 'Your plugins are all up to date.' ) . '</p>';
		return;
	}
	$form_action = 'update-core.php?action=do-plugin-upgrade';

	$core_updates = retraceur_get_updates();
	if ( ! isset( $core_updates[0]['stable'] ) || false === $core_updates[0]['stable'] || version_compare( $core_updates[0]['version'], $cur_r_version, '=' ) ) {
		$core_update_version = false;
	} else {
		$core_update_version = $core_updates[0]['version'];
	}

	$plugins_count = count( $plugins );
	?>
<h2>
	<?php
	printf(
		'%s <span class="count">(%d)</span>',
		__( 'Plugins' ),
		number_format_i18n( $plugins_count )
	);
	?>
</h2>
<p><?php _e( 'The following plugins have new versions available. Check the ones you want to update and then click &#8220;Update Plugins&#8221;.' ); ?></p>
<form method="post" action="<?php echo esc_url( $form_action ); ?>" name="upgrade-plugins" class="upgrade">
	<?php wp_nonce_field( 'upgrade-core' ); ?>
<p><input id="upgrade-plugins" class="button" type="submit" value="<?php esc_attr_e( 'Update Plugins' ); ?>" name="upgrade" /></p>
<table class="widefat updates-table" id="update-plugins-table">
	<thead>
	<tr>
		<td class="manage-column check-column"><input type="checkbox" id="plugins-select-all" /></td>
		<td class="manage-column"><label for="plugins-select-all"><?php _e( 'Select All' ); ?></label></td>
	</tr>
	</thead>

	<tbody class="plugins">
	<?php

	$auto_updates = array();
	if ( wp_is_auto_update_enabled_for_type( 'plugin' ) ) {
		$auto_updates       = (array) get_site_option( 'auto_update_plugins', array() );
		$auto_update_notice = ' | ' . wp_get_auto_update_message();
	}

	foreach ( (array) $plugins as $plugin_file => $plugin_data ) {
		$plugin_data = (object) _get_plugin_data_markup_translate( $plugin_file, (array) $plugin_data, false, true );

		$icon            = '<span class="dashicons dashicons-admin-plugins"></span>';
		$preferred_icons = array( 'svg', '2x', '1x', 'default' );
		foreach ( $preferred_icons as $preferred_icon ) {
			if ( ! empty( $plugin_data->update->icons[ $preferred_icon ] ) ) {
				$icon = '<img src="' . esc_url( $plugin_data->update->icons[ $preferred_icon ] ) . '" alt="" />';
				break;
			}
		}

		// Get plugin compat for running version of Retraceur.
		if ( isset( $plugin_data->update->tested ) && version_compare( $plugin_data->update->tested, $cur_r_version, '>=' ) ) {
			/* translators: %s: Retraceur version. */
			$compat = '<br />' . sprintf( __( 'Compatibility with Retraceur %s: 100%% (according to its author)' ), $cur_r_version );
		} else {
			/* translators: %s: Retraceur version. */
			$compat = '<br />' . sprintf( __( 'Compatibility with Retraceur %s: Unknown' ), $cur_r_version );
		}
		// Get plugin compat for updated version of Retraceur.
		if ( $core_update_version ) {
			if ( isset( $plugin_data->update->tested ) && version_compare( $plugin_data->update->tested, $core_update_version, '>=' ) ) {
				/* translators: %s: Retraceur version. */
				$compat .= '<br />' . sprintf( __( 'Compatibility with Retraceur %s: 100%% (according to its author)' ), $core_update_version );
			} else {
				/* translators: %s: Retraceur version. */
				$compat .= '<br />' . sprintf( __( 'Compatibility with Retraceur %s: Unknown' ), $core_update_version );
			}
		}

		$requires_php   = isset( $plugin_data->update->requires_php ) ? $plugin_data->update->requires_php : null;
		$compatible_php = is_php_version_compatible( $requires_php );

		if ( ! $compatible_php && current_user_can( 'update_php' ) ) {
			$compat .= '<br />' . __( 'This update does not work with your version of PHP.' );
		}

		// Get the upgrade notice for the new plugin version.
		if ( isset( $plugin_data->update->upgrade_notice ) ) {
			$upgrade_notice = '<br />' . strip_tags( $plugin_data->update->upgrade_notice );
		} else {
			$upgrade_notice = '';
		}

		$details_url = self_admin_url( 'plugin-install.php?tab=plugin-information&plugin=' . $plugin_data->update->slug . '&section=changelog&TB_iframe=true&width=640&height=662' );
		$details     = sprintf(
			'<a href="%1$s" class="thickbox open-plugin-details-modal" aria-label="%2$s">%3$s</a>',
			esc_url( $details_url ),
			/* translators: 1: Plugin name, 2: Version number. */
			esc_attr( sprintf( _x( 'View %1$s version %2$s details', 'plugin' ), $plugin_data->Name, $plugin_data->update->new_version ) ),
			/* translators: %s: Plugin version. */
			sprintf( __( 'View version %s details.' ), $plugin_data->update->new_version )
		);

		$checkbox_id = 'checkbox_' . md5( $plugin_file );
		?>
	<tr>
		<td class="check-column">
			<?php if ( $compatible_php ) : ?>
				<input type="checkbox" name="checked[]" id="<?php echo $checkbox_id; ?>" value="<?php echo esc_attr( $plugin_file ); ?>" />
				<label for="<?php echo $checkbox_id; ?>">
					<span class="screen-reader-text">
					<?php
					/* translators: %s: Plugin name. */
					printf( _x( 'Select %s', 'plugin' ), $plugin_data->Name );
					?>
					</span>
				</label>
			<?php endif; ?>
		</td>
		<td class="plugin-title"><p>
			<?php echo $icon; ?>
			<strong><?php echo $plugin_data->Name; ?></strong>
			<?php
			printf(
				/* translators: 1: Plugin version, 2: New version. */
				_x( 'You have version %1$s installed. Update to %2$s.', 'plugin' ),
				$plugin_data->Version,
				$plugin_data->update->new_version
			);

			echo ' ' . $details . $compat;

			if ( in_array( $plugin_file, $auto_updates, true ) ) {
				echo $auto_update_notice;
			}

			echo $upgrade_notice;
			?>
		</p></td>
	</tr>
			<?php
	}
	?>
	</tbody>

	<tfoot>
	<tr>
		<td class="manage-column check-column"><input type="checkbox" id="plugins-select-all-2" /></td>
		<td class="manage-column"><label for="plugins-select-all-2"><?php _e( 'Select All' ); ?></label></td>
	</tr>
	</tfoot>
</table>
<p><input id="upgrade-plugins-2" class="button" type="submit" value="<?php esc_attr_e( 'Update Plugins' ); ?>" name="upgrade" /></p>
</form>
	<?php
}

/**
 * Display the upgrade themes form.
 *
 * @since WP 2.9.0
 * @since 2.0.0 Retraceur fork disabled the Theme updates.
 */
function list_theme_updates() {
	// Disable Theme updates for now.
	return '';

	$themes = get_theme_updates();
	if ( empty( $themes ) ) {
		echo '<h2>' . __( 'Themes' ) . '</h2>';
		echo '<p>' . __( 'Your themes are all up to date.' ) . '</p>';
		return;
	}

	$form_action = 'update-core.php?action=do-theme-upgrade';

	$themes_count = count( $themes );
	?>
<h2>
	<?php
	printf(
		'%s <span class="count">(%d)</span>',
		__( 'Themes' ),
		number_format_i18n( $themes_count )
	);
	?>
</h2>
<p><?php _e( 'The following themes have new versions available. Check the ones you want to update and then click &#8220;Update Themes&#8221;.' ); ?></p>
<p><?php esc_html_e( 'Please Note: Any customizations you have made to theme files will be lost. Please consider using child themes for modifications.' ) ;?></p>
<form method="post" action="<?php echo esc_url( $form_action ); ?>" name="upgrade-themes" class="upgrade">
	<?php wp_nonce_field( 'upgrade-core' ); ?>
<p><input id="upgrade-themes" class="button" type="submit" value="<?php esc_attr_e( 'Update Themes' ); ?>" name="upgrade" /></p>
<table class="widefat updates-table" id="update-themes-table">
	<thead>
	<tr>
		<td class="manage-column check-column"><input type="checkbox" id="themes-select-all" /></td>
		<td class="manage-column"><label for="themes-select-all"><?php _e( 'Select All' ); ?></label></td>
	</tr>
	</thead>

	<tbody class="plugins">
	<?php
	$auto_updates = array();
	if ( wp_is_auto_update_enabled_for_type( 'theme' ) ) {
		$auto_updates       = (array) get_site_option( 'auto_update_themes', array() );
		$auto_update_notice = ' | ' . wp_get_auto_update_message();
	}

	foreach ( $themes as $stylesheet => $theme ) {
		$requires_wp  = isset( $theme->update['requires'] ) ? $theme->update['requires'] : null;
		$requires_r   = isset( $theme->update['requires_r'] ) ? $theme->update['requires_r'] : null;
		$requires_php = isset( $theme->update['requires_php'] ) ? $theme->update['requires_php'] : null;

		$is_compatible  = is_wp_version_compatible( $requires_wp ) && is_retraceur_version_compatible( $requires_r );
		$compatible_php = is_php_version_compatible( $requires_php );

		$compat = '';

		if ( ! $is_compatible && ! $compatible_php ) {
			$compat .= '<br />' . __( 'This update does not work with your versions of Retraceur and PHP.' ) . '&nbsp;';
			if ( current_user_can( 'update_core' ) && current_user_can( 'update_php' ) ) {
				$compat .= sprintf(
					/* translators: %s: URL to Retraceur Updates screen. */
					__( '<a href="%s">Please update Retraceur</a>.' ),
					esc_url( self_admin_url( 'update-core.php' ) )
				);
			} elseif ( current_user_can( 'update_core' ) ) {
				$compat .= sprintf(
					/* translators: %s: URL to Retraceur Updates screen. */
					__( '<a href="%s">Please update Retraceur</a>.' ),
					esc_url( self_admin_url( 'update-core.php' ) )
				);
			}
		} elseif ( ! $is_compatible ) {
			$compat .= '<br />' . __( 'This update does not work with your version of Retraceur.' ) . '&nbsp;';
			if ( current_user_can( 'update_core' ) ) {
				$compat .= sprintf(
					/* translators: %s: URL to Retraceur Updates screen. */
					__( '<a href="%s">Please update Retraceur</a>.' ),
					esc_url( self_admin_url( 'update-core.php' ) )
				);
			}
		} elseif ( ! $compatible_php ) {
			$compat .= '<br />' . __( 'This update does not work with your version of PHP.' );
		}

		$checkbox_id = 'checkbox_' . md5( $theme->get( 'Name' ) );
		?>
	<tr>
		<td class="check-column">
			<?php if ( $compatible_wp && $compatible_php ) : ?>
				<input type="checkbox" name="checked[]" id="<?php echo $checkbox_id; ?>" value="<?php echo esc_attr( $stylesheet ); ?>" />
				<label for="<?php echo $checkbox_id; ?>">
					<span class="screen-reader-text">
					<?php
					/* translators: %s: Theme name. */
					printf( _x( 'Select %s', 'theme' ), $theme->display( 'Name' ) );
					?>
					</span>
				</label>
			<?php endif; ?>
		</td>
		<td class="plugin-title"><p>
			<img src="<?php echo esc_url( $theme->get_screenshot() . '?ver=' . $theme->version ); ?>" width="85" height="64" class="updates-table-screenshot" alt="" />
			<strong><?php echo $theme->display( 'Name' ); ?></strong>
			<?php
			printf(
				/* translators: 1: Theme version, 2: New version. */
				_x( 'You have version %1$s installed. Update to %2$s.', 'theme' ),
				$theme->display( 'Version' ),
				$theme->update['new_version']
			);

			echo ' ' . $compat;

			if ( in_array( $stylesheet, $auto_updates, true ) ) {
				echo $auto_update_notice;
			}
			?>
		</p></td>
	</tr>
			<?php
	}
	?>
	</tbody>

	<tfoot>
	<tr>
		<td class="manage-column check-column"><input type="checkbox" id="themes-select-all-2" /></td>
		<td class="manage-column"><label for="themes-select-all-2"><?php _e( 'Select All' ); ?></label></td>
	</tr>
	</tfoot>
</table>
<p><input id="upgrade-themes-2" class="button" type="submit" value="<?php esc_attr_e( 'Update Themes' ); ?>" name="upgrade" /></p>
</form>
	<?php
}

/**
 * Display the update translations form.
 *
 * @since WP 3.7.0
 * @since 2.0.0 Retraceur fork disabled the Translation updates.
 */
function list_translation_updates() {
	// Disable Translation updates for now.
	return '';

	$updates = wp_get_translation_updates();
	if ( ! $updates ) {
		if ( 'en_US' !== get_locale() ) {
			echo '<h2>' . __( 'Translations' ) . '</h2>';
			echo '<p>' . __( 'Your translations are all up to date.' ) . '</p>';
		}
		return;
	}

	$form_action = 'update-core.php?action=do-translation-upgrade';
	?>
	<h2><?php _e( 'Translations' ); ?></h2>
	<form method="post" action="<?php echo esc_url( $form_action ); ?>" name="upgrade-translations" class="upgrade">
		<p><?php _e( 'New translations are available.' ); ?></p>
		<?php wp_nonce_field( 'upgrade-translations' ); ?>
		<p><input class="button" type="submit" value="<?php esc_attr_e( 'Update Translations' ); ?>" name="upgrade" /></p>
	</form>
	<?php
}

/**
 * Upgrades Retraceur core display.
 *
 * @since WP 2.7.0
 *
 * @global WP_Filesystem_Base $wp_filesystem Retraceur filesystem subclass.
 *
 * @param bool $reinstall
 */
function do_core_upgrade( $reinstall = false ) {
	global $wp_filesystem;

	require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';

	if ( $reinstall ) {
		$url = 'update-core.php?action=do-core-reinstall';
	} else {
		$url = 'update-core.php?action=do-core-upgrade';
	}
	$url = wp_nonce_url( $url, 'upgrade-core' );

	$version = isset( $_POST['version'] ) ? $_POST['version'] : false;
	$locale  = isset( $_POST['locale'] ) ? $_POST['locale'] : 'en_US';
	$update  = retraceur_find_coeur_update( $version, $locale );
	if ( ! $update ) {
		return;
	} else {
		$update           = (object) $update;
		$update->response = 'upgrade';

		// For now consider each update contains new files.
		$update->new_files = true;
	}

	/*
	 * Allow relaxed file ownership writes for User-initiated upgrades when the API specifies
	 * that it's safe to do so. This only happens when there are no new files to create.
	 */
	$allow_relaxed_file_ownership = ! $reinstall && isset( $update->new_files ) && ! $update->new_files;

	?>
	<div class="wrap">
	<h1><?php esc_html_e( 'Update Retraceur' ); ?></h1>
	<?php

	$credentials = request_filesystem_credentials( $url, '', false, ABSPATH, array( 'version', 'locale' ), $allow_relaxed_file_ownership );
	if ( false === $credentials ) {
		echo '</div>';
		return;
	}

	if ( ! WP_Filesystem( $credentials, ABSPATH, $allow_relaxed_file_ownership ) ) {
		// Failed to connect. Error and request again.
		request_filesystem_credentials( $url, '', true, ABSPATH, array( 'version', 'locale' ), $allow_relaxed_file_ownership );
		echo '</div>';
		return;
	}

	if ( $wp_filesystem->errors->has_errors() ) {
		foreach ( $wp_filesystem->errors->get_error_messages() as $message ) {
			show_message( $message );
		}
		echo '</div>';
		return;
	}

	if ( $reinstall ) {
		$update->response = 'reinstall';
	}

	add_filter( 'update_feedback', 'show_message' );

	$upgrader = new Core_Upgrader();
	$result   = $upgrader->upgrade(
		$update,
		array(
			'allow_relaxed_file_ownership' => $allow_relaxed_file_ownership,
		)
	);

	if ( is_wp_error( $result ) ) {
		show_message( $result );
		if ( 'up_to_date' !== $result->get_error_code() && 'locked' !== $result->get_error_code() ) {
			show_message( __( 'Installation failed.' ) );
		}
		echo '</div>';
		return;
	}

	show_message( __( 'Retraceur updated successfully.' ) );
	show_message(
		'<span class="hide-if-no-js">' . sprintf(
			/* translators: 1: Retraceur version, 2: URL to About screen. */
			__( 'Welcome to Retraceur %1$s. You will be redirected to the About Retraceur screen. If not, click <a href="%2$s">here</a>.' ),
			$result,
			esc_url( self_admin_url( 'about.php?updated' ) )
		) . '</span>'
	);
	show_message(
		'<span class="hide-if-js">' . sprintf(
			/* translators: 1: Retraceur version, 2: URL to About screen. */
			__( 'Welcome to Retraceur %1$s. <a href="%2$s">Learn more</a>.' ),
			$result,
			esc_url( self_admin_url( 'about.php?updated' ) )
		) . '</span>'
	);
	?>
	</div>
	<script type="text/javascript">
	window.location = '<?php echo esc_url( self_admin_url( 'about.php?updated' ) ); ?>';
	</script>
	<?php
}

/**
 * Dismiss a core update.
 *
 * @since 2.0.0 Retraceur fork.
 */
function do_dismiss_coeur_update() {
	$version = isset( $_POST['version'] ) ? $_POST['version'] : false;
	$locale  = isset( $_POST['locale'] ) ? $_POST['locale'] : 'en_US';
	$update  = retraceur_find_coeur_update(
		$version,
		$locale,
		array(
			'available' => true,
			'dismissed' => false,
		),
	);

	if ( ! $update ) {
		return;
	}

	dismiss_coeur_update( $update );

	wp_safe_redirect( wp_nonce_url( 'update-core.php?action=upgrade-core', 'upgrade-core' ) );
	exit;
}

/**
 * Undismiss a coeur update.
 *
 * @since 2.0.0 Retraceur fork.
 */
function do_undismiss_coeur_update() {
	$version = isset( $_POST['version'] ) ? $_POST['version'] : false;
	$locale  = isset( $_POST['locale'] ) ? $_POST['locale'] : 'en_US';
	$update  = retraceur_find_coeur_update(
		$version,
		$locale,
		array(
			'available' => false,
			'dismissed' => true,
		),
	);

	if ( ! $update ) {
		return;
	}

	undismiss_coeur_update( $version );

	wp_safe_redirect( wp_nonce_url( 'update-core.php?action=upgrade-core', 'upgrade-core' ) );
	exit;
}

$action = isset( $_GET['action'] ) ? $_GET['action'] : 'upgrade-core';

$upgrade_error = false;
if ( ( 'do-theme-upgrade' === $action || ( 'do-plugin-upgrade' === $action && ! isset( $_GET['plugins'] ) ) )
	&& ! isset( $_POST['checked'] ) ) {
	$upgrade_error = ( 'do-theme-upgrade' === $action ) ? 'themes' : 'plugins';
	$action        = 'upgrade-core';
}

$title       = __( 'Retraceur Updates' );
$parent_file = 'index.php';

// @todo Restore when the Retraceur Update API will be ready.
$updates_overview  = ''; // '<p>' . __( 'On this screen, you can update to the latest version of Retraceur, as well as update your themes, plugins, and translations.' ) . '</p>';
$updates_overview .= '<p>' . __( 'If an update is available, you&#8127;ll see a notification appear in the Toolbar and navigation menu.' ) . ' ' . __( 'Keeping your site updated is important for security. It also makes the internet a safer place for you and your readers.' ) . '</p>';

get_current_screen()->add_help_tab(
	array(
		'id'      => 'overview',
		'title'   => __( 'Overview' ),
		'content' => $updates_overview,
	)
);

$updates_howto  = '<p>' . __( '<strong>Retraceur</strong> &mdash; Updating your Retraceur installation is a simple one-click procedure: just <strong>click on the &#8220;Update to version X.Y.Z&#8221; button</strong> when you are notified that a new version is available.' ) . ' ' . __( 'Alternatively, you can perform a manual upgrade using the &#8220;Download & upgrade to version X.Y.Z&#8221; button.' ) . '</p>';
/*$updates_howto .= '<p>' . __( '<strong>Themes and Plugins</strong> &mdash; To update individual themes or plugins from this screen, use the checkboxes to make your selection, then <strong>click on the appropriate &#8220;Update&#8221; button</strong>. To update all of your themes or plugins at once, you can check the box at the top of the section to select all before clicking the update button.' ) . '</p>';

if ( 'en_US' !== get_locale() ) {
	$updates_howto .= '<p>' . __( '<strong>Translations</strong> &mdash; The files translating Retraceur into your language are updated for you whenever any other updates occur. But if these files are out of date, you can <strong>click the &#8220;Update Translations&#8221;</strong> button.' ) . '</p>';
}*/

get_current_screen()->add_help_tab(
	array(
		'id'      => 'how-to-update',
		'title'   => __( 'How to Update' ),
		'content' => $updates_howto,
	)
);

$help_sidebar = array(
	_x( 'https://retraceur.github.io/administration/manage-updates/', 'Documentation site URL' ) => __( 'Documentation on managing updates' ),
);

get_current_screen()->set_help_sidebar( $help_sidebar );

if ( 'upgrade-core' === $action ) {
	// Force an update check when requested.
	$force_check = ! empty( $_GET['force-check'] );
	retraceur_version_check( $force_check );

	require_once ABSPATH . 'wp-admin/admin-header.php';
	?>
	<div class="wrap">
	<h1><?php esc_html_e( 'Retraceur Updates' ); ?></h1>
	<?php
	/*
	 * Disable this for now.
	 * @todo Restore when the Retraceur Update API will be ready.
	 *
	<p><?php _e( 'Updates may take several minutes to complete. If there is no feedback after 5 minutes, or if there are errors please refer to the Help section above.' ); ?></p>

	<?php
	if ( $upgrade_error ) {
		if ( 'themes' === $upgrade_error ) {
			$theme_updates = get_theme_updates();
			if ( ! empty( $theme_updates ) ) {
				wp_admin_notice(
					__( 'Please select one or more themes to update.' ),
					array(
						'additional_classes' => array( 'error' ),
					)
				);
			}
		} else {
			$plugin_updates = get_plugin_updates();
			if ( ! empty( $plugin_updates ) ) {
				wp_admin_notice(
					__( 'Please select one or more plugins to update.' ),
					array(
						'additional_classes' => array( 'error' ),
					)
				);
			}
		}
	}
	*/

	$last_update_check = false;
	$current           = get_site_transient( 'update_coeur' );

	if ( $current && isset( $current->last_checked ) ) {
		$last_update_check = $current->last_checked + (int) ( (float) get_option( 'gmt_offset' ) * HOUR_IN_SECONDS );
	}

	echo '<h2 class="wp-current-version">';
	/* translators: Current version of Retraceur. */
	printf( __( 'Current version: %s' ), esc_html( retraceur_get_version() ) );
	echo '</h2>';

	echo '<p class="update-last-checked">';

	printf(
		// translators: 1: Date, 2: Time.
		__( 'Last checked on %1$s at %2$s.' ),
		// translators: Default date format, see https://www.php.net/manual/datetime.format.php
		date_i18n( __( 'F j, Y' ), $last_update_check ),
		// translators: Last update time format, see https://www.php.net/manual/datetime.format.php
		date_i18n( __( 'g:i a T' ), $last_update_check )
	);
	echo ' <a href="' . esc_url( self_admin_url( 'update-core.php?force-check=1' ) ) . '">' . __( 'Check again.' ) . '</a>';
	echo '</p>';

	if ( current_user_can( 'update_core' ) ) {
		core_upgrade_preamble();
	}

	/*
	 * Disable this for now.
	 * @todo Restore when the Retraceur Update API will be ready.
	 *
	if ( current_user_can( 'update_plugins' ) ) {
		list_plugin_updates();
	}
	if ( current_user_can( 'update_themes' ) ) {
		list_theme_updates();
	}
	if ( current_user_can( 'update_languages' ) ) {
		list_translation_updates();
	}
	*/

	/**
	 * Fires after the core, plugin, and theme update tables.
	 *
	 * @since WP 2.9.0
	 */
	do_action( 'core_upgrade_preamble' );
	echo '</div>';

	wp_localize_script(
		'updates',
		'_wpUpdatesItemCounts',
		array(
			'totals' => wp_get_update_data(),
		)
	);

	require_once ABSPATH . 'wp-admin/admin-footer.php';

} elseif ( 'do-core-upgrade' === $action || 'do-core-reinstall' === $action ) {

	if ( ! current_user_can( 'update_core' ) ) {
		wp_die( __( 'Sorry, you are not allowed to update this site.' ) );
	}

	check_admin_referer( 'upgrade-core' );

	// Do the (un)dismiss actions before headers, so that they can redirect.
	if ( isset( $_POST['dismiss'] ) ) {
		do_dismiss_coeur_update();
	} elseif ( isset( $_POST['undismiss'] ) ) {
		do_undismiss_coeur_update();
	}

	require_once ABSPATH . 'wp-admin/admin-header.php';
	if ( 'do-core-reinstall' === $action ) {
		$reinstall = true;
	} else {
		$reinstall = false;
	}

	if ( isset( $_POST['upgrade'] ) ) {
		do_core_upgrade( $reinstall );
	}

	wp_localize_script(
		'updates',
		'_wpUpdatesItemCounts',
		array(
			'totals' => wp_get_update_data(),
		)
	);

	require_once ABSPATH . 'wp-admin/admin-footer.php';

} elseif ( 'do-plugin-upgrade' === $action ) {
	wp_die(
		'<h1>' . __( 'Retraceur does not provide an API to update plugins yet.' ) . '</h1>' .
		'<p>' . __( 'You can always go to the Plugin’s "Add new" screen to upload and replace outdated packages.' ) . '</p>',
		500
	);

	if ( ! current_user_can( 'update_plugins' ) ) {
		wp_die( __( 'Sorry, you are not allowed to update this site.' ) );
	}

	check_admin_referer( 'upgrade-core' );

	if ( isset( $_GET['plugins'] ) ) {
		$plugins = explode( ',', $_GET['plugins'] );
	} elseif ( isset( $_POST['checked'] ) ) {
		$plugins = (array) $_POST['checked'];
	} else {
		wp_redirect( admin_url( 'update-core.php' ) );
		exit;
	}

	$url = 'update.php?action=update-selected&plugins=' . urlencode( implode( ',', $plugins ) );
	$url = wp_nonce_url( $url, 'bulk-update-plugins' );

	// Used in the HTML title tag.
	$title = __( 'Update Plugins' );

	require_once ABSPATH . 'wp-admin/admin-header.php';
	?>
	<div class="wrap">
		<h1><?php _e( 'Update Plugins' ); ?></h1>
		<iframe src="<?php echo $url; ?>" style="width: 100%; height: 100%; min-height: 750px;" frameborder="0" title="<?php esc_attr_e( 'Update progress' ); ?>"></iframe>
	</div>
	<?php

	wp_localize_script(
		'updates',
		'_wpUpdatesItemCounts',
		array(
			'totals' => wp_get_update_data(),
		)
	);

	require_once ABSPATH . 'wp-admin/admin-footer.php';

} elseif ( 'do-theme-upgrade' === $action ) {
	wp_die(
		'<h1>' . __( 'Retraceur does not provide an API to update themes yet.' ) . '</h1>' .
		'<p>' . __( 'You can always go to the Theme’s "Add new" screen to upload and replace outdated packages.' ) . '</p>',
		500
	);

	if ( ! current_user_can( 'update_themes' ) ) {
		wp_die( __( 'Sorry, you are not allowed to update this site.' ) );
	}

	check_admin_referer( 'upgrade-core' );

	if ( isset( $_GET['themes'] ) ) {
		$themes = explode( ',', $_GET['themes'] );
	} elseif ( isset( $_POST['checked'] ) ) {
		$themes = (array) $_POST['checked'];
	} else {
		wp_redirect( admin_url( 'update-core.php' ) );
		exit;
	}

	$url = 'update.php?action=update-selected-themes&themes=' . urlencode( implode( ',', $themes ) );
	$url = wp_nonce_url( $url, 'bulk-update-themes' );

	// Used in the HTML title tag.
	$title = __( 'Update Themes' );

	require_once ABSPATH . 'wp-admin/admin-header.php';
	?>
	<div class="wrap">
		<h1><?php _e( 'Update Themes' ); ?></h1>
		<iframe src="<?php echo $url; ?>" style="width: 100%; height: 100%; min-height: 750px;" frameborder="0" title="<?php esc_attr_e( 'Update progress' ); ?>"></iframe>
	</div>
	<?php

	wp_localize_script(
		'updates',
		'_wpUpdatesItemCounts',
		array(
			'totals' => wp_get_update_data(),
		)
	);

	require_once ABSPATH . 'wp-admin/admin-footer.php';

} elseif ( 'do-translation-upgrade' === $action ) {
	wp_die( __( 'Retraceur does not provide an API to update languages yet.' ), 500 );

	if ( ! current_user_can( 'update_languages' ) ) {
		wp_die( __( 'Sorry, you are not allowed to update this site.' ) );
	}

	check_admin_referer( 'upgrade-translations' );

	require_once ABSPATH . 'wp-admin/admin-header.php';
	require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';

	$url     = 'update-core.php?action=do-translation-upgrade';
	$nonce   = 'upgrade-translations';
	$title   = __( 'Update Translations' );
	$context = WP_LANG_DIR;

	$upgrader = new Language_Pack_Upgrader( new Language_Pack_Upgrader_Skin( compact( 'url', 'nonce', 'title', 'context' ) ) );
	$result   = $upgrader->bulk_upgrade();

	wp_localize_script(
		'updates',
		'_wpUpdatesItemCounts',
		array(
			'totals' => wp_get_update_data(),
		)
	);

	require_once ABSPATH . 'wp-admin/admin-footer.php';

} else {
	/**
	 * Fires for each custom update action on the Retraceur Updates screen.
	 *
	 * The dynamic portion of the hook name, `$action`, refers to the
	 * passed update action. The hook fires in lieu of all available
	 * default update actions.
	 *
	 * @since WP 3.2.0
	 */
	do_action( "update-core-custom_{$action}" );  // phpcs:ignore WordPress.NamingConventions.ValidHookName.UseUnderscores
}
