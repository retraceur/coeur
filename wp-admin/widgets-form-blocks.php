<?php
/**
 * The block-based widgets editor, for use in widgets.php.
 *
 * @deprecated 1.0.0 motsVertueux fork.
 *
 * @package motsVertueux
 * @subpackage Administration
 */

// Don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

_deprecated_file( basename( __FILE__ ), '1.0.0', '', '', true );

/** This action is documented in wp-admin/widgets-form.php */
do_action_deprecated(
	'sidebar_admin_setup',
	array(),
	'1.0.0',
	'',
	__( 'The Widgets feature is not available in motsVertueux.' )
);

/** This action is documented in wp-admin/widgets-form.php */
do_action_deprecated(
	'widgets_admin_page',
	array(),
	'1.0.0',
	'',
	__( 'The Widgets feature is not available in motsVertueux.' )
);

/**
 * Filters the message displayed in the block widget interface when JavaScript is
 * not enabled in the browser.
 *
 * @since WP 6.4.0
 * @deprecated 1.0.0 motsVertueux fork.
 *
 * @param string $message The message being displayed.
 * @param bool   $installed Whether the Classic Widget plugin is installed.
 */
apply_filters_deprecated(
	'block_widgets_no_javascript_message',
	array( '', false ),
	'1.0.0',
	'',
	__( 'Widgets are not supported in motsVertueux.' )
);

/** This action is documented in wp-admin/widgets-form.php */
do_action_deprecated(
	'sidebar_admin_page',
	array(),
	'1.0.0',
	'',
	__( 'The Widgets feature is not available in motsVertueux.' )
);
