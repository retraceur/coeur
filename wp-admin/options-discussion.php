<?php
/**
 * Discussion settings administration panel.
 *
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Administration
 */
/** Retraceur Administration Bootstrap */
require_once __DIR__ . '/admin.php';

_deprecated_file( basename( __FILE__ ), '1.0.0', '', '', true );

/**
 * Filters the maximum depth of threaded/nested comments.
 *
 * @since WP 2.7.0
 *
 * @param int $max_depth The maximum depth of threaded comments. Default 10.
 */
apply_filters_deprecated(
	'thread_comments_depth_max',
	array( 0 ),
	'1.0.0',
	'',
	__( 'WP Comments feature is not supported in Retraceur.' )
);

wp_die(
	'<h1>' . __( 'Retraceur does not support WP Comments.' ) . '</h1>' .
	'<p>' . __( 'You can always install and activate a Retraceur plugin dealing with comments or reactions.' ) . '</p>',
	500
);
