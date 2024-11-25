<?php
/**
 * The classic widget administration screen, for use in widgets.php.
 *
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Administration
 */

// Don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

_deprecated_file( basename( __FILE__ ), '1.0.0', '', '', true );

/**
 * Fires early before the Widgets administration screen loads,
 * after scripts are enqueued.
 *
 * @since WP 2.2.0
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 */
do_action_deprecated(
	'sidebar_admin_setup',
	array(),
	'1.0.0',
	'',
	__( 'The Widgets feature is not available in Retraceur.' )
);

/**
 * Fires immediately after a widget has been marked for deletion.
 *
 * @since WP 4.4.0
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 *
 * @param string $widget_id  ID of the widget marked for deletion.
 * @param string $sidebar_id ID of the sidebar the widget was deleted from.
 * @param string $id_base    ID base for the widget.
 */
do_action_deprecated(
	'delete_widget',
	array( '', '', '' ),
	'1.0.0',
	'',
	__( 'The Widgets feature is not available in Retraceur.' )
);

/**
 * Fires before the Widgets administration page content loads.
 *
 * @since WP 3.0.0
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 */
do_action_deprecated(
	'widgets_admin_page',
	array(),
	'1.0.0',
	'',
	__( 'The Widgets feature is not available in Retraceur.' )
);

/**
 * Fires after the available widgets and sidebars have loaded, before the admin footer.
 *
 * @since WP 2.2.0
 * @deprecated 1.0.0 Retraceur removed the Widgets feature.
 */
do_action_deprecated(
	'sidebar_admin_page',
	array(),
	'1.0.0',
	'',
	__( 'The Widgets feature is not available in Retraceur.' )
);
