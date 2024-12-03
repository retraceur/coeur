<?php
/**
 * Retraceur Administration for Navigation Menus
 * Interface functions.
 *
 * @version WP 2.0.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Administration
 */

/** Load Retraceur Administration Bootstrap */
require_once __DIR__ . '/admin.php';

_deprecated_file( basename( __FILE__ ), '1.0.0', '', '', true );

/**
 * Fires after the menu locations table is displayed.
 *
 * @since WP 3.6.0
 * @deprecated 1.0.0 Retraceur fork.
 */
do_action_deprecated(
	'after_menu_locations_table',
	array( 0, 0, array() ),
	'1.0.0',
	'',
	__( 'WP Nav Menus feature is not supported in Retraceur.' )
);

/**
 * Filters the number of locations listed per menu in the drop-down select.
 *
 * @since WP 3.6.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int $locations Number of menu locations to list. Default 3.
 */
apply_filters_deprecated(
	'wp_nav_locations_listed_per_menu',
	array( 3 ),
	'1.0.0',
	'',
	__( 'WP Nav Menus feature is not supported in Retraceur.' )
);

wp_die(
	'<h1>' . __( 'Retraceur does not support WP Nav Menus.' ) . '</h1>' .
	'<p>' . __( 'Using Block Themes is strongly encouraged.' ) . '</p>',
	500
);
