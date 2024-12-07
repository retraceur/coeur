<?php
/**
 * Comment Management Screen.
 *
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Administration
 */

/** Load Retraceur Bootstrap */
require_once __DIR__ . '/admin.php';

_deprecated_file( basename( __FILE__ ), '1.0.0', '', '', true );

/**
 * Filters the URI the user is redirected to after editing a comment in the admin.
 *
 * @since WP 2.1.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param string $location The URI the user will be redirected to.
 * @param int $comment_id The ID of the comment being edited.
 */
apply_filters_deprecated(
	'comment_edit_redirect',
	array( '', 0 ),
	'1.0.0',
	'',
	__( 'WP Comments feature is not supported in Retraceur.' )
);

wp_die(
	'<h1>' . __( 'Retraceur does not provide a commenting feature natively.' ) . '</h1>' .
	'<p>' . __( 'You can always install and activate a Retraceur plugin dealing with comments or reactions.' ) . '</p>',
	500
);
