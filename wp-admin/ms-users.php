<?php
/**
 * Multisite users administration panel.
 *
 * @since WP 3.0.0
 * @since 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Multisite
 */

require_once __DIR__ . '/admin.php';

wp_redirect( network_admin_url( 'users.php' ) );
exit;
