<?php
/**
 * Themes administration panel.
 *
 * @since 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Administration
 */

/** Retraceur Administration Bootstrap */
require_once __DIR__ . '/admin.php';

if ( ! current_user_can( 'switch_themes' ) && ! current_user_can( 'edit_theme_options' ) ) {
	wp_die(
		'<h1>' . __( 'You need a higher level of permission.' ) . '</h1>' .
		'<p>' . __( 'Sorry, you are not allowed to edit theme options on this site.' ) . '</p>',
		403
	);
}

if ( current_user_can( 'switch_themes' ) && isset( $_GET['action'] ) ) {
	if ( 'activate' === $_GET['action'] ) {
		check_admin_referer( 'switch-theme_' . $_GET['stylesheet'] );
		$theme = wp_get_theme( $_GET['stylesheet'] );

		if ( ! $theme->exists() || ! $theme->is_allowed() ) {
			wp_die(
				'<h1>' . __( 'Something went wrong.' ) . '</h1>' .
				'<p>' . __( 'The requested theme does not exist.' ) . '</p>',
				403
			);
		}

		switch_theme( $theme->get_stylesheet() );
		wp_redirect( admin_url( 'themes.php?activated=true' ) );
		exit;
	} elseif ( 'resume' === $_GET['action'] ) {
		check_admin_referer( 'resume-theme_' . $_GET['stylesheet'] );
		$theme = wp_get_theme( $_GET['stylesheet'] );

		if ( ! current_user_can( 'resume_theme', $_GET['stylesheet'] ) ) {
			wp_die(
				'<h1>' . __( 'You need a higher level of permission.' ) . '</h1>' .
				'<p>' . __( 'Sorry, you are not allowed to resume this theme.' ) . '</p>',
				403
			);
		}

		$result = resume_theme( $theme->get_stylesheet(), self_admin_url( 'themes.php?error=resuming' ) );

		if ( is_wp_error( $result ) ) {
			wp_die( $result );
		}

		wp_redirect( admin_url( 'themes.php?resumed=true' ) );
		exit;
	} elseif ( 'delete' === $_GET['action'] ) {
		check_admin_referer( 'delete-theme_' . $_GET['stylesheet'] );
		$theme = wp_get_theme( $_GET['stylesheet'] );

		if ( ! current_user_can( 'delete_themes' ) ) {
			wp_die(
				'<h1>' . __( 'You need a higher level of permission.' ) . '</h1>' .
				'<p>' . __( 'Sorry, you are not allowed to delete this item.' ) . '</p>',
				403
			);
		}

		if ( ! $theme->exists() ) {
			wp_die(
				'<h1>' . __( 'Something went wrong.' ) . '</h1>' .
				'<p>' . __( 'The requested theme does not exist.' ) . '</p>',
				403
			);
		}

		$active = wp_get_theme();
		if ( $active->get( 'Template' ) === $_GET['stylesheet'] ) {
			wp_redirect( admin_url( 'themes.php?delete-active-child=true' ) );
		} else {
			delete_theme( $_GET['stylesheet'] );
			wp_redirect( admin_url( 'themes.php?deleted=true' ) );
		}
		exit;
	} elseif ( 'enable-auto-update' === $_GET['action'] ) {
		if ( ! ( current_user_can( 'update_themes' ) && wp_is_auto_update_enabled_for_type( 'theme' ) ) ) {
			wp_die( __( 'Sorry, you are not allowed to enable themes automatic updates.' ) );
		}

		check_admin_referer( 'updates' );

		$all_items    = wp_get_themes();
		$auto_updates = (array) get_site_option( 'auto_update_themes', array() );

		$auto_updates[] = $_GET['stylesheet'];
		$auto_updates   = array_unique( $auto_updates );
		// Remove themes that have been deleted since the site option was last updated.
		$auto_updates = array_intersect( $auto_updates, array_keys( $all_items ) );

		update_site_option( 'auto_update_themes', $auto_updates );

		wp_redirect( admin_url( 'themes.php?enabled-auto-update=true' ) );

		exit;
	} elseif ( 'disable-auto-update' === $_GET['action'] ) {
		if ( ! ( current_user_can( 'update_themes' ) && wp_is_auto_update_enabled_for_type( 'theme' ) ) ) {
			wp_die( __( 'Sorry, you are not allowed to disable themes automatic updates.' ) );
		}

		check_admin_referer( 'updates' );

		$all_items    = wp_get_themes();
		$auto_updates = (array) get_site_option( 'auto_update_themes', array() );

		$auto_updates = array_diff( $auto_updates, array( $_GET['stylesheet'] ) );
		// Remove themes that have been deleted since the site option was last updated.
		$auto_updates = array_intersect( $auto_updates, array_keys( $all_items ) );

		update_site_option( 'auto_update_themes', $auto_updates );

		wp_redirect( admin_url( 'themes.php?disabled-auto-update=true' ) );

		exit;
	}
}

// Used in the HTML title tag.
$title       = __( 'Themes' );
$parent_file = 'themes.php';

// Help tab: Overview.
if ( current_user_can( 'switch_themes' ) ) {
	$help_overview = '<p>' . __( 'This screen is used for managing your installed themes. Aside from the default theme(s) included with your Retraceur installation, themes are designed and developed by third parties.' ) . '</p>' .
		'<p>' . __( 'From this screen you can:' ) . '</p>' .
		'<ul><li>' . __( 'Hover or tap to see the Activate and Customize buttons' ) . '</li>' .
		'<li>' . __( 'Click on the theme to see the theme name, version, author, description, tags, and the Delete link' ) . '</li>' .
		'</ul>' .
		'<p>' . __( 'The active theme is displayed highlighted as the first theme.' ) . '</p>' .
		'<p>' . __( 'The search for installed themes will search for terms in their name, description, author, or tag.' ) . ' <span id="live-search-desc">' . __( 'The search results will be updated as you type.' ) . '</span></p>';

	get_current_screen()->add_help_tab(
		array(
			'id'      => 'overview',
			'title'   => __( 'Overview' ),
			'content' => $help_overview,
		)
	);
} // End if 'switch_themes'.

if ( current_user_can( 'switch_themes' ) ) {
	$themes = wp_prepare_themes_for_js();
} else {
	$themes = wp_prepare_themes_for_js( array( wp_get_theme() ) );
}

$theme  = ! empty( $_REQUEST['theme'] ) ? sanitize_text_field( $_REQUEST['theme'] ) : '';
$search = ! empty( $_REQUEST['search'] ) ? sanitize_text_field( $_REQUEST['search'] ) : '';

wp_localize_script(
	'theme',
	'_wpThemeSettings',
	array(
		'themes'   => $themes,
		'settings' => array(
			'canInstall'    => ( ! is_multisite() && current_user_can( 'install_themes' ) ),
			'installURI'    => ( ! is_multisite() && current_user_can( 'install_themes' ) ) ? admin_url( 'theme-install.php' ) : null,
			'confirmDelete' => __( "Are you sure you want to delete this theme?\n\nClick 'Cancel' to go back, 'OK' to confirm the delete." ),
			'adminUrl'      => parse_url( admin_url(), PHP_URL_PATH ),
		),
		'l10n'     => array(
			'addNew'        => __( 'Add New Theme' ),
			'search'        => __( 'Search installed themes' ),
			/* translators: %d: Number of themes. */
			'themesFound'   => __( 'Number of Themes found: %d' ),
			'noThemesFound' => __( 'No themes found. Try a different search.' ),
		),
	)
);

add_thickbox();
wp_enqueue_script( 'theme' );
wp_enqueue_script( 'updates' );

require_once ABSPATH . 'wp-admin/admin-header.php';
?>

<div class="wrap">
	<h1 class="wp-heading-inline"><?php esc_html_e( 'Themes' ); ?>
		<span class="title-count theme-count"><?php echo ! empty( $_GET['search'] ) ? __( '&hellip;' ) : count( $themes ); ?></span>
	</h1>
	<?php if ( ! is_multisite() && current_user_can( 'install_themes' ) ) : ?>
		<a href="<?php echo esc_url( admin_url( 'theme-install.php' ) ); ?>" class="hide-if-no-js page-title-action"><?php echo esc_html__( 'Add New Theme' ); ?></a>
	<?php endif; ?>
	<hr class="wp-header-end">
	<form class="search-form search-themes"><p class="search-box"></p></form>

<?php
if ( ! validate_current_theme() || isset( $_GET['broken'] ) ) {
	wp_admin_notice(
		__( 'The active theme is broken. Reverting to the default theme.' ),
		array(
			'id'                 => 'message1',
			'additional_classes' => array( 'updated' ),
			'dismissible'        => true,
		)
	);
} elseif ( isset( $_GET['activated'] ) ) {
	if ( isset( $_GET['previewed'] ) ) {
		wp_admin_notice(
			__( 'Settings saved and theme activated.' ) . ' <a href="' . esc_url( home_url( '/' ) ) . '">' . __( 'Visit site' ) . '</a>',
			array(
				'id'                 => 'message2',
				'additional_classes' => array( 'updated' ),
				'dismissible'        => true,
			)
		);
	} else {
		wp_admin_notice(
			__( 'New theme activated.' ) . ' <a href="' . esc_url( home_url( '/' ) ) . '">' . __( 'Visit site' ) . '</a>',
			array(
				'id'                 => 'message2',
				'additional_classes' => array( 'updated' ),
				'dismissible'        => true,
			)
		);
	}
} elseif ( isset( $_GET['deleted'] ) ) {
	wp_admin_notice(
		__( 'Theme deleted.' ),
		array(
			'id'                 => 'message3',
			'additional_classes' => array( 'updated' ),
			'dismissible'        => true,
		)
	);
} elseif ( isset( $_GET['delete-active-child'] ) ) {
	wp_admin_notice(
		__( 'You cannot delete a theme while it has an active child theme.' ),
		array(
			'id'                 => 'message4',
			'additional_classes' => array( 'error' ),
		)
	);
} elseif ( isset( $_GET['resumed'] ) ) {
	wp_admin_notice(
		__( 'Theme resumed.' ),
		array(
			'id'                 => 'message5',
			'additional_classes' => array( 'updated' ),
			'dismissible'        => true,
		)
	);
} elseif ( isset( $_GET['error'] ) && 'resuming' === $_GET['error'] ) {
	wp_admin_notice(
		__( 'Theme could not be resumed because it triggered a <strong>fatal error</strong>.' ),
		array(
			'id'                 => 'message6',
			'additional_classes' => array( 'error' ),
		)
	);
} elseif ( isset( $_GET['enabled-auto-update'] ) ) {
	wp_admin_notice(
		__( 'Theme will be auto-updated.' ),
		array(
			'id'                 => 'message7',
			'additional_classes' => array( 'updated' ),
			'dismissible'        => true,
		)
	);
} elseif ( isset( $_GET['disabled-auto-update'] ) ) {
	wp_admin_notice(
		__( 'Theme will no longer be auto-updated.' ),
		array(
			'id'                 => 'message8',
			'additional_classes' => array( 'updated' ),
			'dismissible'        => true,
		)
	);
}

$current_theme = wp_get_theme();

if ( $current_theme->errors() && ( ! is_multisite() || current_user_can( 'manage_network_themes' ) ) ) {
	wp_admin_notice(
		__( 'Error:' ) . ' ' . $current_theme->errors()->get_error_message(),
		array(
			'additional_classes' => array( 'error' ),
		)
	);
}

$current_theme_actions = array();

if ( is_array( $submenu ) && isset( $submenu['themes.php'] ) ) {
	$forbidden_paths = array(
		'themes.php',
		'theme-editor.php',
		'site-editor.php',
		'edit.php?post_type=wp_navigation',
	);

	foreach ( (array) $submenu['themes.php'] as $item ) {
		$class = '';

		// 0 = name, 1 = capability, 2 = file.
		if ( 0 === strcmp( $self, $item[2] ) && empty( $parent_file )
			|| $parent_file && $item[2] === $parent_file
		) {
			$class = ' current';
		}

		if ( ! empty( $submenu[ $item[2] ] ) ) {
			$submenu[ $item[2] ] = array_values( $submenu[ $item[2] ] ); // Re-index.
			$menu_hook           = get_plugin_page_hook( $submenu[ $item[2] ][0][2], $item[2] );

			if ( file_exists( WP_PLUGIN_DIR . "/{$submenu[$item[2]][0][2]}" ) || ! empty( $menu_hook ) ) {
				$current_theme_actions[] = "<a class='button$class' href='admin.php?page={$submenu[$item[2]][0][2]}'>{$item[0]}</a>";
			} else {
				$current_theme_actions[] = "<a class='button$class' href='{$submenu[$item[2]][0][2]}'>{$item[0]}</a>";
			}
		} elseif ( ! empty( $item[2] ) && current_user_can( $item[1] ) ) {
			$menu_file = $item[2];

			$pos = strpos( $menu_file, '?' );
			if ( false !== $pos ) {
				$menu_file = substr( $menu_file, 0, $pos );
			}

			if ( file_exists( ABSPATH . "wp-admin/$menu_file" ) ) {
				$current_theme_actions[] = "<a class='button$class' href='{$item[2]}'>{$item[0]}</a>";
			} else {
				$current_theme_actions[] = "<a class='button$class' href='themes.php?page={$item[2]}'>{$item[0]}</a>";
			}
		}
	}
}

$class_name = 'theme-browser';
if ( ! empty( $_GET['search'] ) ) {
	$class_name .= ' search-loading';
}
?>
<div class="<?php echo esc_attr( $class_name ); ?>">
	<div class="themes wp-clearfix">

<?php
/*
 * This PHP is synchronized with the tmpl-theme template below!
 */

foreach ( $themes as $theme ) :
	$aria_action = $theme['id'] . '-action';
	$aria_name   = $theme['id'] . '-name';

	$active_class = '';
	if ( $theme['active'] ) {
		$active_class = ' active';
	}
	?>
<div class="theme<?php echo $active_class; ?>">
	<?php if ( ! empty( $theme['screenshot'][0] ) ) { ?>
		<div class="theme-screenshot">
			<img src="<?php echo esc_url( $theme['screenshot'][0] . '?ver=' . $theme['version'] ); ?>" alt="" />
		</div>
	<?php } else { ?>
		<div class="theme-screenshot blank"></div>
	<?php } ?>

	<?php if ( $theme['hasUpdate'] ) : ?>
		<?php
		if ( $theme['updateResponse']['compatibleWP'] && $theme['updateResponse']['compatiblePHP'] ) :
			if ( $theme['hasPackage'] ) {
				$new_version_available = __( 'New version available. <button class="button-link" type="button">Update now</button>' );
			} else {
				$new_version_available = __( 'New version available.' );
			}
			wp_admin_notice(
				$new_version_available,
				array(
					'type'               => 'warning',
					'additional_classes' => array( 'notice-alt', 'inline', 'update-message' ),
				)
			);
		else :
			$theme_update_error = '';
			if ( ! $theme['updateResponse']['compatibleWP'] && ! $theme['updateResponse']['compatiblePHP'] ) {
				$theme_update_error .= sprintf(
					/* translators: %s: Theme name. */
					__( 'There is a new version of %s available, but it does not work with your versions of Retraceur and PHP.' ),
					$theme['name']
				);
				if ( current_user_can( 'update_core' ) && current_user_can( 'update_php' ) ) {
					$theme_update_error .= sprintf(
						/* translators: %s: URL to Retraceur Updates screen. */
						' ' . __( '<a href="%s">Please update Retraceur</a>.' ),
						self_admin_url( 'update-core.php' )
					);
				} elseif ( current_user_can( 'update_core' ) ) {
					$theme_update_error .= sprintf(
						/* translators: %s: URL to Retraceur Updates screen. */
						' ' . __( '<a href="%s">Please update Retraceur</a>.' ),
						self_admin_url( 'update-core.php' )
					);
				}
			} elseif ( ! $theme['updateResponse']['compatibleWP'] ) {
				$theme_update_error .= sprintf(
					/* translators: %s: Theme name. */
					__( 'There is a new version of %s available, but it does not work with your version of Retraceur.' ),
					$theme['name']
				);
				if ( current_user_can( 'update_core' ) ) {
					$theme_update_error .= sprintf(
						/* translators: %s: URL to Retraceur Updates screen. */
						' ' . __( '<a href="%s">Please update Retraceur</a>.' ),
						self_admin_url( 'update-core.php' )
					);
				}
			} elseif ( ! $theme['updateResponse']['compatiblePHP'] ) {
				$theme_update_error .= sprintf(
					/* translators: %s: Theme name. */
					__( 'There is a new version of %s available, but it does not work with your version of PHP.' ),
					$theme['name']
				);
			}
			wp_admin_notice(
				$theme_update_error,
				array(
					'type'               => 'error',
					'additional_classes' => array( 'notice-alt', 'inline', 'update-message' ),
				)
			);
		endif;
	endif;

	if ( ! $theme['compatibleWP'] || ! $theme['compatiblePHP'] ) {
		$message = '';
		if ( ! $theme['compatibleWP'] && ! $theme['compatiblePHP'] ) {
			$message = __( 'This theme does not work with your versions of Retraceur and PHP.' );
			if ( current_user_can( 'update_core' ) && current_user_can( 'update_php' ) ) {
				$message .= sprintf(
					/* translators: %s: URL to Retraceur Updates screen. */
					' ' . __( '<a href="%1$s">Please update Retraceur</a>.' ),
					self_admin_url( 'update-core.php' )
				);
			} elseif ( current_user_can( 'update_core' ) ) {
				$message .= sprintf(
					/* translators: %s: URL to Retraceur Updates screen. */
					' ' . __( '<a href="%s">Please update Retraceur</a>.' ),
					self_admin_url( 'update-core.php' )
				);
			}
		} elseif ( ! $theme['compatibleWP'] ) {
			$message .= __( 'This theme does not work with your version of Retraceur.' );
			if ( current_user_can( 'update_core' ) ) {
				$message .= sprintf(
					/* translators: %s: URL to Retraceur Updates screen. */
					' ' . __( '<a href="%s">Please update Retraceur</a>.' ),
					self_admin_url( 'update-core.php' )
				);
			}
		} elseif ( ! $theme['compatiblePHP'] ) {
			$message .= __( 'This theme does not work with your version of PHP.' );
		}

		wp_admin_notice(
			$message,
			array(
				'type'               => 'error',
				'additional_classes' => array( 'inline', 'notice-alt' ),
			)
		);
	}

	/* translators: %s: Theme name. */
	$details_aria_label = sprintf( _x( 'View Theme Details for %s', 'theme' ), $theme['name'] );
	?>
	<button type="button" aria-label="<?php echo esc_attr( $details_aria_label ); ?>" class="more-details" id="<?php echo esc_attr( $aria_action ); ?>"><?php _e( 'Theme Details' ); ?></button>
	<div class="theme-author">
		<?php
		/* translators: %s: Theme author name. */
		printf( _x( 'By %s', 'theme' ), $theme['author'] );
		?>
	</div>

	<div class="theme-id-container">
		<?php if ( $theme['active'] ) { ?>
			<h2 class="theme-name" id="<?php echo esc_attr( $aria_name ); ?>">
				<span><?php _ex( 'Active:', 'theme' ); ?></span> <?php echo $theme['name']; ?>
			</h2>
		<?php } else { ?>
			<h2 class="theme-name" id="<?php echo esc_attr( $aria_name ); ?>"><?php echo $theme['name']; ?></h2>
		<?php } ?>

		<div class="theme-actions">
		<?php if ( $theme['active'] ) { ?>
			<?php
			if ( $theme['actions']['customize'] && current_user_can( 'edit_theme_options' ) ) {
				/* translators: %s: Theme name. */
				$customize_aria_label = sprintf( _x( 'Customize %s', 'theme' ), $theme['name'] );
				?>
				<a aria-label="<?php echo esc_attr( $customize_aria_label ); ?>" class="button button-primary customize load-customize hide-if-no-customize" href="<?php echo $theme['actions']['customize']; ?>"><?php _e( 'Customize' ); ?></a>
			<?php } ?>
		<?php } elseif ( $theme['compatibleWP'] && $theme['compatiblePHP'] ) { ?>
			<?php
			/* translators: %s: Theme name. */
			$aria_label = sprintf( _x( 'Activate %s', 'theme' ), '{{ data.name }}' );
			?>
			<a class="button activate" href="<?php echo $theme['actions']['activate']; ?>" aria-label="<?php echo esc_attr( $aria_label ); ?>"><?php _e( 'Activate' ); ?></a>
		<?php } else { ?>
			<?php
			/* translators: %s: Theme name. */
			$aria_label = sprintf( _x( 'Cannot Activate %s', 'theme' ), '{{ data.name }}' );
			?>
			<a class="button disabled" aria-label="<?php echo esc_attr( $aria_label ); ?>"><?php _ex( 'Cannot Activate', 'theme' ); ?></a>
		<?php } ?>

		</div>
	</div>
</div>
<?php endforeach; ?>
	</div>
</div>
<div class="theme-overlay" tabindex="0" role="dialog" aria-label="<?php esc_attr_e( 'Theme Details' ); ?>"></div>

<p class="no-themes"><?php _e( 'No themes found. Try a different search.' ); ?></p>

<?php
// List broken themes, if any.
$broken_themes = wp_get_themes( array( 'errors' => true ) );
if ( ! is_multisite() && $broken_themes ) {
	?>

<div class="broken-themes">
<h3><?php _e( 'Broken Themes' ); ?></h3>
<p><?php _e( 'The following themes are installed but incomplete.' ); ?></p>

	<?php
	$can_resume  = current_user_can( 'resume_themes' );
	$can_delete  = current_user_can( 'delete_themes' );
	$can_install = current_user_can( 'install_themes' );
	?>
<table>
	<tr>
		<th><?php _ex( 'Name', 'theme name' ); ?></th>
		<th><?php _e( 'Description' ); ?></th>
		<?php if ( $can_resume ) { ?>
			<td></td>
		<?php } ?>
		<?php if ( $can_delete ) { ?>
			<td></td>
		<?php } ?>
		<?php if ( $can_install ) { ?>
			<td></td>
		<?php } ?>
	</tr>
	<?php
	foreach ( $broken_themes as $broken_theme ) :
		?>
		<tr>
			<td><?php echo $broken_theme->get( 'Name' ) ? $broken_theme->display( 'Name' ) : esc_html( $broken_theme->get_stylesheet() ); ?></td>
			<td><?php echo $broken_theme->errors()->get_error_message(); ?></td>
			<?php
			if ( $can_resume ) {
				if ( 'theme_paused' === $broken_theme->errors()->get_error_code() ) {
					$stylesheet = $broken_theme->get_stylesheet();
					$resume_url = add_query_arg(
						array(
							'action'     => 'resume',
							'stylesheet' => urlencode( $stylesheet ),
						),
						admin_url( 'themes.php' )
					);
					$resume_url = wp_nonce_url( $resume_url, 'resume-theme_' . $stylesheet );
					?>
					<td><a href="<?php echo esc_url( $resume_url ); ?>" class="button resume-theme"><?php _e( 'Resume' ); ?></a></td>
					<?php
				} else {
					?>
					<td></td>
					<?php
				}
			}

			if ( $can_delete ) {
				$stylesheet = $broken_theme->get_stylesheet();
				$delete_url = add_query_arg(
					array(
						'action'     => 'delete',
						'stylesheet' => urlencode( $stylesheet ),
					),
					admin_url( 'themes.php' )
				);
				$delete_url = wp_nonce_url( $delete_url, 'delete-theme_' . $stylesheet );
				?>
				<td><a href="<?php echo esc_url( $delete_url ); ?>" class="button delete-theme"><?php _e( 'Delete' ); ?></a></td>
				<?php
			}

			if ( $can_install && 'theme_no_parent' === $broken_theme->errors()->get_error_code() ) {
				$parent_theme_name = $broken_theme->get( 'Template' );
				$parent_theme      = themes_api( 'theme_information', array( 'slug' => urlencode( $parent_theme_name ) ) );

				if ( ! is_wp_error( $parent_theme ) ) {
					$install_url = add_query_arg(
						array(
							'action' => 'install-theme',
							'theme'  => urlencode( $parent_theme_name ),
						),
						admin_url( 'update.php' )
					);
					$install_url = wp_nonce_url( $install_url, 'install-theme_' . $parent_theme_name );
					?>
					<td><a href="<?php echo esc_url( $install_url ); ?>" class="button install-theme"><?php _e( 'Install Parent Theme' ); ?></a></td>
					<?php
				}
			}
			?>
		</tr>
		<?php
	endforeach;
	?>
</table>
</div>

	<?php
}
?>
</div><!-- .wrap -->

<?php

/**
 * Returns the JavaScript template used to display the auto-update setting for a theme.
 *
 * @since WP 5.5.0
 *
 * @return string The template for displaying the auto-update setting link.
 */
function wp_theme_auto_update_setting_template() {
	$notice   = wp_get_admin_notice(
		'',
		array(
			'type'               => 'error',
			'additional_classes' => array( 'notice-alt', 'inline', 'hidden' ),
		)
	);
	$template = '
		<div class="theme-autoupdate">
			<# if ( data.autoupdate.supported ) { #>
				<# if ( data.autoupdate.forced === false ) { #>
					' . __( 'Auto-updates disabled' ) . '
				<# } else if ( data.autoupdate.forced ) { #>
					' . __( 'Auto-updates enabled' ) . '
				<# } else if ( data.autoupdate.enabled ) { #>
					<button type="button" class="toggle-auto-update button-link" data-slug="{{ data.id }}" data-wp-action="disable">
						<span class="dashicons dashicons-update spin hidden" aria-hidden="true"></span><span class="label">' . __( 'Disable auto-updates' ) . '</span>
					</button>
				<# } else { #>
					<button type="button" class="toggle-auto-update button-link" data-slug="{{ data.id }}" data-wp-action="enable">
						<span class="dashicons dashicons-update spin hidden" aria-hidden="true"></span><span class="label">' . __( 'Enable auto-updates' ) . '</span>
					</button>
				<# } #>
			<# } #>
			<# if ( data.hasUpdate ) { #>
				<# if ( data.autoupdate.supported && data.autoupdate.enabled ) { #>
					<span class="auto-update-time">
				<# } else { #>
					<span class="auto-update-time hidden">
				<# } #>
				<br />' . wp_get_auto_update_message() . '</span>
			<# } #>
			' . $notice . '
		</div>
	';

	/**
	 * Filters the JavaScript template used to display the auto-update setting for a theme (in the overlay).
	 *
	 * See {@see wp_prepare_themes_for_js()} for the properties of the `data` object.
	 *
	 * @since WP 5.5.0
	 *
	 * @param string $template The template for displaying the auto-update setting link.
	 */
	return apply_filters( 'theme_auto_update_setting_template', $template );
}

/*
 * The tmpl-theme template is synchronized with PHP above!
 */
?>
<script id="tmpl-theme" type="text/template">
	<# if ( data.screenshot[0] ) { #>
		<div class="theme-screenshot">
			<img src="{{ data.screenshot[0] }}?ver={{ data.version }}" alt="" />
		</div>
	<# } else { #>
		<div class="theme-screenshot blank"></div>
	<# } #>

	<# if ( data.hasUpdate ) { #>
		<# if ( data.updateResponse.compatibleWP && data.updateResponse.compatiblePHP ) { #>
			<div class="update-message notice inline notice-warning notice-alt"><p>
				<# if ( data.hasPackage ) { #>
					<?php _e( 'New version available. <button class="button-link" type="button">Update now</button>' ); ?>
				<# } else { #>
					<?php _e( 'New version available.' ); ?>
				<# } #>
			</p></div>
		<# } else { #>
			<div class="update-message notice inline notice-error notice-alt"><p>
				<# if ( ! data.updateResponse.compatibleWP && ! data.updateResponse.compatiblePHP ) { #>
					<?php
					printf(
						/* translators: %s: Theme name. */
						__( 'There is a new version of %s available, but it does not work with your versions of Retraceur and PHP.' ),
						'{{{ data.name }}}'
					);
					if ( current_user_can( 'update_core' ) && current_user_can( 'update_php' ) ) {
						printf(
							/* translators: %s: URL to Retraceur Updates screen. */
							' ' . __( '<a href="%s">Please update Retraceur</a>.' ),
							self_admin_url( 'update-core.php' )
						);
					} elseif ( current_user_can( 'update_core' ) ) {
						printf(
							/* translators: %s: URL to Retraceur Updates screen. */
							' ' . __( '<a href="%s">Please update Retraceur</a>.' ),
							self_admin_url( 'update-core.php' )
						);
					}
					?>
				<# } else if ( ! data.updateResponse.compatibleWP ) { #>
					<?php
					printf(
						/* translators: %s: Theme name. */
						__( 'There is a new version of %s available, but it does not work with your version of Retraceur.' ),
						'{{{ data.name }}}'
					);
					if ( current_user_can( 'update_core' ) ) {
						printf(
							/* translators: %s: URL to Retraceur Updates screen. */
							' ' . __( '<a href="%s">Please update Retraceur</a>.' ),
							self_admin_url( 'update-core.php' )
						);
					}
					?>
				<# } else if ( ! data.updateResponse.compatiblePHP ) { #>
					<?php
					printf(
						/* translators: %s: Theme name. */
						__( 'There is a new version of %s available, but it does not work with your version of PHP.' ),
						'{{{ data.name }}}'
					);
					?>
				<# } #>
			</p></div>
		<# } #>
	<# } #>

	<# if ( ! data.compatibleWP || ! data.compatiblePHP ) { #>
		<div class="notice notice-error notice-alt"><p>
			<# if ( ! data.compatibleWP && ! data.compatiblePHP ) { #>
				<?php
				_e( 'This theme does not work with your versions of Retraceur and PHP.' );
				if ( current_user_can( 'update_core' ) && current_user_can( 'update_php' ) ) {
					printf(
						/* translators: %s: URL to Retraceur Updates screen. */
						' ' . __( '<a href="%s">Please update Retraceur</a>.' ),
						self_admin_url( 'update-core.php' )
					);
				} elseif ( current_user_can( 'update_core' ) ) {
					printf(
						/* translators: %s: URL to Retraceur Updates screen. */
						' ' . __( '<a href="%s">Please update Retraceur</a>.' ),
						self_admin_url( 'update-core.php' )
					);
				}
				?>
			<# } else if ( ! data.compatibleWP ) { #>
				<?php
				_e( 'This theme does not work with your version of Retraceur.' );
				if ( current_user_can( 'update_core' ) ) {
					printf(
						/* translators: %s: URL to Retraceur Updates screen. */
						' ' . __( '<a href="%s">Please update Retraceur</a>.' ),
						self_admin_url( 'update-core.php' )
					);
				}
				?>
			<# } else if ( ! data.compatiblePHP ) { #>
				<?php
				_e( 'This theme does not work with your version of PHP.' );
				?>
			<# } #>
		</p></div>
	<# } #>

	<?php
	/* translators: %s: Theme name. */
	$details_aria_label = sprintf( _x( 'View Theme Details for %s', 'theme' ), '{{ data.name }}' );
	?>
	<button type="button" aria-label="<?php echo esc_attr( $details_aria_label ); ?>" class="more-details" id="{{ data.id }}-action"><?php _e( 'Theme Details' ); ?></button>
	<div class="theme-author">
		<?php
		/* translators: %s: Theme author name. */
		printf( _x( 'By %s', 'theme' ), '{{{ data.author }}}' );
		?>
	</div>

	<div class="theme-id-container">
		<# if ( data.active ) { #>
			<h2 class="theme-name" id="{{ data.id }}-name">
				<span><?php _ex( 'Active:', 'theme' ); ?></span> {{{ data.name }}}
			</h2>
		<# } else { #>
			<h2 class="theme-name" id="{{ data.id }}-name">{{{ data.name }}}</h2>
		<# } #>

		<div class="theme-actions">
			<# if ( data.active ) { #>
				<# if ( data.actions.customize ) { #>
					<?php
					/* translators: %s: Theme name. */
					$customize_aria_label = sprintf( _x( 'Customize %s', 'theme' ), '{{ data.name }}' );
					?>
					<a aria-label="<?php echo esc_attr( $customize_aria_label ); ?>" class="button button-primary customize load-customize hide-if-no-customize" href="{{{ data.actions.customize }}}"><?php _e( 'Customize' ); ?></a>
				<# } #>
			<# } else { #>
				<# if ( data.compatibleWP && data.compatiblePHP ) { #>
					<?php
					/* translators: %s: Theme name. */
					$aria_label = sprintf( _x( 'Activate %s', 'theme' ), '{{ data.name }}' );
					?>
					<a class="button activate" href="{{{ data.actions.activate }}}" aria-label="<?php echo esc_attr( $aria_label ); ?>"><?php _e( 'Activate' ); ?></a>
				<# } else { #>
					<?php
					/* translators: %s: Theme name. */
					$aria_label = sprintf( _x( 'Cannot Activate %s', 'theme' ), '{{ data.name }}' );
					?>
					<a class="button disabled" aria-label="<?php echo esc_attr( $aria_label ); ?>"><?php _ex( 'Cannot Activate', 'theme' ); ?></a>
				<# } #>
			<# } #>
		</div>
	</div>
</script>

<script id="tmpl-theme-single" type="text/template">
	<div class="theme-backdrop"></div>
	<div class="theme-wrap wp-clearfix" role="document">
		<div class="theme-header">
			<button class="left dashicons dashicons-no"><span class="screen-reader-text">
				<?php
				/* translators: Hidden accessibility text. */
				_e( 'Show previous theme' );
				?>
			</span></button>
			<button class="right dashicons dashicons-no"><span class="screen-reader-text">
				<?php
				/* translators: Hidden accessibility text. */
				_e( 'Show next theme' );
				?>
			</span></button>
			<button class="close dashicons dashicons-no"><span class="screen-reader-text">
				<?php
				/* translators: Hidden accessibility text. */
				_e( 'Close details dialog' );
				?>
			</span></button>
		</div>
		<div class="theme-about wp-clearfix">
			<div class="theme-screenshots">
			<# if ( data.screenshot[0] ) { #>
				<div class="screenshot"><img src="{{ data.screenshot[0] }}?ver={{ data.version }}" alt="" /></div>
			<# } else { #>
				<div class="screenshot blank"></div>
			<# } #>
			</div>

			<div class="theme-info">
				<# if ( data.active ) { #>
					<span class="current-label"><?php _e( 'Active Theme' ); ?></span>
				<# } #>
				<h2 class="theme-name">{{{ data.name }}}<span class="theme-version">
					<?php
					/* translators: %s: Theme version. */
					printf( __( 'Version: %s' ), '{{ data.version }}' );
					?>
				</span></h2>
				<p class="theme-author">
					<?php
					/* translators: %s: Theme author name. */
					printf( _x( 'By %s', 'theme' ), '{{{ data.authorAndUri }}}' );
					?>
				</p>

				<# if ( ! data.compatibleWP || ! data.compatiblePHP ) { #>
					<div class="notice notice-error notice-alt notice-large"><p>
						<# if ( ! data.compatibleWP && ! data.compatiblePHP ) { #>
							<?php
							_e( 'This theme does not work with your versions of Retraceur and PHP.' );
							if ( current_user_can( 'update_core' ) && current_user_can( 'update_php' ) ) {
								printf(
									/* translators: %s: URL to Retraceur Updates screen. */
									' ' . __( '<a href="%s">Please update Retraceur</a>.' ),
									self_admin_url( 'update-core.php' )
								);
							} elseif ( current_user_can( 'update_core' ) ) {
								printf(
									/* translators: %s: URL to Retraceur Updates screen. */
									' ' . __( '<a href="%s">Please update Retraceur</a>.' ),
									self_admin_url( 'update-core.php' )
								);
							}
							?>
						<# } else if ( ! data.compatibleWP ) { #>
							<?php
							_e( 'This theme does not work with your version of Retraceur.' );
							if ( current_user_can( 'update_core' ) ) {
								printf(
									/* translators: %s: URL to Retraceur Updates screen. */
									' ' . __( '<a href="%s">Please update Retraceur</a>.' ),
									self_admin_url( 'update-core.php' )
								);
							}
							?>
						<# } else if ( ! data.compatiblePHP ) { #>
							<?php
							_e( 'This theme does not work with your version of PHP.' );
							?>
						<# } #>
					</p></div>
				<# } #>

				<# if ( data.hasUpdate ) { #>
					<# if ( data.updateResponse.compatibleWP && data.updateResponse.compatiblePHP ) { #>
						<div class="notice notice-warning notice-alt notice-large">
							<h3 class="notice-title"><?php _e( 'Update Available' ); ?></h3>
							{{{ data.update }}}
						</div>
					<# } else { #>
						<div class="notice notice-error notice-alt notice-large">
							<h3 class="notice-title"><?php _e( 'Update Incompatible' ); ?></h3>
							<p>
								<# if ( ! data.updateResponse.compatibleWP && ! data.updateResponse.compatiblePHP ) { #>
									<?php
									printf(
										/* translators: %s: Theme name. */
										__( 'There is a new version of %s available, but it does not work with your versions of Retraceur and PHP.' ),
										'{{{ data.name }}}'
									);
									if ( current_user_can( 'update_core' ) && current_user_can( 'update_php' ) ) {
										printf(
											/* translators: %s: URL to Retraceur Updates screen. */
											' ' . __( '<a href="%s">Please update Retraceur</a>.' ),
											self_admin_url( 'update-core.php' )
										);
									} elseif ( current_user_can( 'update_core' ) ) {
										printf(
											/* translators: %s: URL to Retraceur Updates screen. */
											' ' . __( '<a href="%s">Please update Retraceur</a>.' ),
											self_admin_url( 'update-core.php' )
										);
									}
									?>
								<# } else if ( ! data.updateResponse.compatibleWP ) { #>
									<?php
									printf(
										/* translators: %s: Theme name. */
										__( 'There is a new version of %s available, but it does not work with your version of Retraceur.' ),
										'{{{ data.name }}}'
									);
									if ( current_user_can( 'update_core' ) ) {
										printf(
											/* translators: %s: URL to Retraceur Updates screen. */
											' ' . __( '<a href="%s">Please update Retraceur</a>.' ),
											self_admin_url( 'update-core.php' )
										);
									}
									?>
								<# } else if ( ! data.updateResponse.compatiblePHP ) { #>
									<?php
									printf(
										/* translators: %s: Theme name. */
										__( 'There is a new version of %s available, but it does not work with your version of PHP.' ),
										'{{{ data.name }}}'
									);
									?>
								<# } #>
							</p>
						</div>
					<# } #>
				<# } #>

				<# if ( data.actions.autoupdate ) { #>
					<?php echo wp_theme_auto_update_setting_template(); ?>
				<# } #>

				<# if ( 'Point' === data.name ) { #>
					<p class="theme-description"><?php esc_html_e( 'Built-in default Retraceur Theme. There’s always a point to start retracing.' ); ?></p>
				<# } else { #>
					<p class="theme-description">{{{ data.description }}}</p>
				<# } #>

				<# if ( data.parent ) { #>
					<p class="parent-theme">
						<?php
						/* translators: %s: Theme name. */
						printf( __( 'This is a child theme of %s.' ), '<strong>{{{ data.parent }}}</strong>' );
						?>
					</p>
				<# } #>

				<# if ( data.tags ) { #>
					<p class="theme-tags"><span><?php _e( 'Tags:' ); ?></span> {{{ data.tags }}}</p>
				<# } #>
			</div>
		</div>

		<div class="theme-actions">
			<div class="active-theme">
				<# if ( data.actions && data.actions.customize ) { #>
					<a href="{{{ data.actions.customize }}}" class="button button-primary customize load-customize hide-if-no-customize"><?php _e( 'Customize' ); ?></a>
				<# } #>
			</div>
			<div class="inactive-theme">
				<# if ( data.compatibleWP && data.compatiblePHP ) { #>
					<?php
					/* translators: %s: Theme name. */
					$aria_label = sprintf( _x( 'Activate %s', 'theme' ), '{{ data.name }}' );
					?>
					<# if ( data.actions.activate ) { #>
						<a href="{{{ data.actions.activate }}}" class="button activate" aria-label="<?php echo esc_attr( $aria_label ); ?>"><?php _e( 'Activate' ); ?></a>
					<# } #>
				<# } else { #>
					<?php
					/* translators: %s: Theme name. */
					$aria_label = sprintf( _x( 'Cannot Activate %s', 'theme' ), '{{ data.name }}' );
					?>
					<# if ( data.actions.activate ) { #>
						<a class="button disabled" aria-label="<?php echo esc_attr( $aria_label ); ?>"><?php _ex( 'Cannot Activate', 'theme' ); ?></a>
					<# } #>
				<# } #>
			</div>

			<# if ( ! data.active && data.actions['delete'] ) { #>
				<?php
				/* translators: %s: Theme name. */
				$aria_label = sprintf( _x( 'Delete %s', 'theme' ), '{{ data.name }}' );
				?>
				<a href="{{{ data.actions['delete'] }}}" class="button delete-theme" aria-label="<?php echo esc_attr( $aria_label ); ?>"><?php _e( 'Delete' ); ?></a>
			<# } #>
		</div>
	</div>
</script>

<?php
wp_print_request_filesystem_credentials_modal();
wp_print_admin_notice_templates();
wp_print_update_row_templates();

wp_localize_script(
	'updates',
	'_wpUpdatesItemCounts',
	array(
		'totals' => wp_get_update_data(),
	)
);

require_once ABSPATH . 'wp-admin/admin-footer.php';
