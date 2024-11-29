<?php
/**
 * Core Administration API.
 *
 * @since WP 2.3.0
 * @since 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Administration
 */

if ( ! defined( 'WP_ADMIN' ) ) {
	/*
	 * This file is being included from a file other than wp-admin/admin.php, so
	 * some setup was skipped. Make sure the admin message catalog is loaded since
	 * load_default_textdomain() will not have done so in this context.
	 */
	$admin_locale = get_locale();
	load_textdomain( 'default', WP_LANG_DIR . '/admin-' . $admin_locale . '.mo', $admin_locale );
	unset( $admin_locale );
}

/** Retraceur Administration Hooks */
require_once ABSPATH . 'wp-admin/includes/admin-filters.php';

/** Retraceur Comment Administration API */
require_once ABSPATH . 'wp-admin/includes/comment.php';

/** Retraceur Administration File API */
require_once ABSPATH . 'wp-admin/includes/file.php';

/** Retraceur Image Administration API */
require_once ABSPATH . 'wp-admin/includes/image.php';

/** Retraceur Media Administration API */
require_once ABSPATH . 'wp-admin/includes/media.php';

/** Retraceur Import Administration API */
require_once ABSPATH . 'wp-admin/includes/import.php';

/** Retraceur Misc Administration API */
require_once ABSPATH . 'wp-admin/includes/misc.php';

/** Retraceur Misc Administration API */
require_once ABSPATH . 'wp-admin/includes/class-wp-privacy-policy-content.php';

/** Retraceur Options Administration API */
require_once ABSPATH . 'wp-admin/includes/options.php';

/** Retraceur Plugin Administration API */
require_once ABSPATH . 'wp-admin/includes/plugin.php';

/** Retraceur Post Administration API */
require_once ABSPATH . 'wp-admin/includes/post.php';

/** Retraceur Administration Screen API */
require_once ABSPATH . 'wp-admin/includes/class-wp-screen.php';
require_once ABSPATH . 'wp-admin/includes/screen.php';

/** Retraceur Taxonomy Administration API */
require_once ABSPATH . 'wp-admin/includes/taxonomy.php';

/** Retraceur Template Administration API */
require_once ABSPATH . 'wp-admin/includes/template.php';

/** Retraceur List Table Administration API and base class */
require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
require_once ABSPATH . 'wp-admin/includes/class-wp-list-table-compat.php';
require_once ABSPATH . 'wp-admin/includes/list-table.php';

/** Retraceur Theme Administration API */
require_once ABSPATH . 'wp-admin/includes/theme.php';

/** Retraceur Privacy Functions */
require_once ABSPATH . 'wp-admin/includes/privacy-tools.php';

/** Retraceur Privacy List Table classes. */
// Previously in wp-admin/includes/user.php. Need to be loaded for backward compatibility.
require_once ABSPATH . 'wp-admin/includes/class-wp-privacy-requests-table.php';
require_once ABSPATH . 'wp-admin/includes/class-wp-privacy-data-export-requests-list-table.php';
require_once ABSPATH . 'wp-admin/includes/class-wp-privacy-data-removal-requests-list-table.php';

/** Retraceur User Administration API */
require_once ABSPATH . 'wp-admin/includes/user.php';

/** Retraceur Site Icon API */
require_once ABSPATH . 'wp-admin/includes/class-wp-site-icon.php';

/** Retraceur Update Administration API */
require_once ABSPATH . 'wp-admin/includes/update.php';

/** Retraceur Deprecated Administration API */
require_once ABSPATH . 'wp-admin/includes/deprecated.php';

/** Retraceur Multisite support API */
if ( is_multisite() ) {
	/**
	 * Sets up Multisite administration.
	 *
	 * @since 1.0.0 Retraceur fork.
	 */
	do_action( 'retraceur_admin_setup_multisite' );
}
