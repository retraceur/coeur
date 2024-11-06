<?php
/**
 * Multisite users administration panel.
 *
 * @package motsVertueux
 * @subpackage Multisite
 * @since WP 3.0.0
 */

require_once __DIR__ . '/admin.php';

wp_redirect( network_admin_url( 'users.php' ) );
exit;
