<?php
/**
 * View Transitions API.
 *
 * @since WP 7.0.0
 * @since 4.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage View Transitions
 */

/**
 * Enqueues View Transitions CSS for the admin.
 *
 * @since WP 7.0.0
 */
function wp_enqueue_view_transitions_admin_css(): void {
	wp_enqueue_style( 'wp-view-transitions-admin' );
}

/**
 * Gets the CSS for View Transitions in the admin.
 *
 * @since WP 7.0.0
 *
 * @return string The CSS.
 */
function wp_get_view_transitions_admin_css(): string {
	$affix = SCRIPT_DEBUG ? '' : '.min';
	$path  = ABSPATH . "wp-admin/css/view-transitions{$affix}.css";
	return file_get_contents( $path );
}
