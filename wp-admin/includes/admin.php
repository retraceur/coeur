<?php
/**
 * Core Administration API.
 *
 * @since WP 2.3.0
 * @since 1.0.0 motsVertueux fork.
 *
 * @package motsVertueux
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

/** motsVertueux Administration Hooks */
require_once ABSPATH . 'wp-admin/includes/admin-filters.php';

/** motsVertueux Bookmark Administration API */
require_once ABSPATH . 'wp-admin/includes/bookmark.php';

/** motsVertueux Comment Administration API */
require_once ABSPATH . 'wp-admin/includes/comment.php';

/** motsVertueux Administration File API */
require_once ABSPATH . 'wp-admin/includes/file.php';

/** motsVertueux Image Administration API */
require_once ABSPATH . 'wp-admin/includes/image.php';

/** motsVertueux Media Administration API */
require_once ABSPATH . 'wp-admin/includes/media.php';

/** motsVertueux Import Administration API */
require_once ABSPATH . 'wp-admin/includes/import.php';

/** motsVertueux Misc Administration API */
require_once ABSPATH . 'wp-admin/includes/misc.php';

/** motsVertueux Misc Administration API */
require_once ABSPATH . 'wp-admin/includes/class-wp-privacy-policy-content.php';

/** motsVertueux Options Administration API */
require_once ABSPATH . 'wp-admin/includes/options.php';

/** motsVertueux Plugin Administration API */
require_once ABSPATH . 'wp-admin/includes/plugin.php';

/** motsVertueux Post Administration API */
require_once ABSPATH . 'wp-admin/includes/post.php';

/** motsVertueux Administration Screen API */
require_once ABSPATH . 'wp-admin/includes/class-wp-screen.php';
require_once ABSPATH . 'wp-admin/includes/screen.php';

/** motsVertueux Taxonomy Administration API */
require_once ABSPATH . 'wp-admin/includes/taxonomy.php';

/** motsVertueux Template Administration API */
require_once ABSPATH . 'wp-admin/includes/template.php';

/** motsVertueux List Table Administration API and base class */
require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
require_once ABSPATH . 'wp-admin/includes/class-wp-list-table-compat.php';
require_once ABSPATH . 'wp-admin/includes/list-table.php';

/** motsVertueux Theme Administration API */
require_once ABSPATH . 'wp-admin/includes/theme.php';

/** motsVertueux Privacy Functions */
require_once ABSPATH . 'wp-admin/includes/privacy-tools.php';

/** motsVertueux Privacy List Table classes. */
// Previously in wp-admin/includes/user.php. Need to be loaded for backward compatibility.
require_once ABSPATH . 'wp-admin/includes/class-wp-privacy-requests-table.php';
require_once ABSPATH . 'wp-admin/includes/class-wp-privacy-data-export-requests-list-table.php';
require_once ABSPATH . 'wp-admin/includes/class-wp-privacy-data-removal-requests-list-table.php';

/** motsVertueux User Administration API */
require_once ABSPATH . 'wp-admin/includes/user.php';

/** motsVertueux Site Icon API */
require_once ABSPATH . 'wp-admin/includes/class-wp-site-icon.php';

/** motsVertueux Update Administration API */
require_once ABSPATH . 'wp-admin/includes/update.php';

/** motsVertueux Deprecated Administration API */
require_once ABSPATH . 'wp-admin/includes/deprecated.php';

/** motsVertueux Multisite support API */
if ( is_multisite() ) {
	require_once ABSPATH . 'wp-admin/includes/ms-admin-filters.php';
	require_once ABSPATH . 'wp-admin/includes/ms.php';
	require_once ABSPATH . 'wp-admin/includes/ms-deprecated.php';
}
