<?php
/**
 * The User Interface "Skins" for the Retraceur File Upgrader.
 *
 * @since WP 2.8.0
 * @deprecated WP 4.7.0
 *
 * @package Retraceur
 * @subpackage Upgrader
 */

_deprecated_file( basename( __FILE__ ), '4.7.0', 'class-wp-upgrader.php' );

/** WP_Upgrader_Skin class */
require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader-skin.php';

/** Plugin_Upgrader_Skin class */
require_once ABSPATH . 'wp-admin/includes/class-plugin-upgrader-skin.php';

/** Theme_Upgrader_Skin class */
require_once ABSPATH . 'wp-admin/includes/class-theme-upgrader-skin.php';

/** Bulk_Upgrader_Skin class */
require_once ABSPATH . 'wp-admin/includes/class-bulk-upgrader-skin.php';

/** Bulk_Plugin_Upgrader_Skin class */
require_once ABSPATH . 'wp-admin/includes/class-bulk-plugin-upgrader-skin.php';

/** Bulk_Theme_Upgrader_Skin class */
require_once ABSPATH . 'wp-admin/includes/class-bulk-theme-upgrader-skin.php';

/** Plugin_Installer_Skin class */
require_once ABSPATH . 'wp-admin/includes/class-plugin-installer-skin.php';

/** Theme_Installer_Skin class */
require_once ABSPATH . 'wp-admin/includes/class-theme-installer-skin.php';

/** Language_Pack_Upgrader_Skin class */
require_once ABSPATH . 'wp-admin/includes/class-language-pack-upgrader-skin.php';

/** Automatic_Upgrader_Skin class */
require_once ABSPATH . 'wp-admin/includes/class-automatic-upgrader-skin.php';

/** WP_Ajax_Upgrader_Skin class */
require_once ABSPATH . 'wp-admin/includes/class-wp-ajax-upgrader-skin.php';
