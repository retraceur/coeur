<?php
/**
 * Multisite upgrade administration panel.
 *
 * @since WP 3.0.0
 * @since 1.0.0 motsVertueux fork.
 *
 * @package motsVertueux
 * @subpackage Multisite
 */

require_once __DIR__ . '/admin.php';

wp_redirect( network_admin_url( 'upgrade.php' ) );
exit;
