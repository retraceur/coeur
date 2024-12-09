<?php
/**
 * Handle Trackbacks and Pingbacks Sent to Retraceur.
 *
 * @since WP 0.71
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Trackbacks
 */

require_once __DIR__ . '/wp-load.php';

_deprecated_file( basename( __FILE__ ), '1.0.0', '', '', true );

/**
 * Response to a trackback.
 *
 * Responds with an error or success XML message.
 *
 * @since WP 0.71
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int|bool $error         Whether there was an error.
 *                                Default '0'. Accepts '0' or '1', true or false.
 * @param string   $error_message Error message if an error occurred. Default empty string.
 */
function trackback_response( $error = 0, $error_message = '' ) {
	_deprecated_function( __FUNCTION__, '1.0.0', '', true );
}

/**
 * Fires before the trackback is added to a post.
 *
 * @since WP 4.7.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int    $post_id       Post ID related to the trackback.
 * @param string $trackback_url Trackback URL.
 * @param string $charset       Character set.
 * @param string $title         Trackback title.
 * @param string $excerpt       Trackback excerpt.
 * @param string $blog_name     Site name.
 */
do_action_deprecated(
	'trackback_post',
	array( 0, '', '', '', '', '' ),
	'1.0.0',
	'',
	__( 'WP Trackbacks/Comments feature is not supported in Retraceur.' )
);

/**
 * Fires after a trackback is added to a post.
 *
 * @since WP 1.2.0
 * @deprecated 1.0.0 Retraceur fork.
 *
 * @param int $trackback_id Trackback ID.
 */
do_action_deprecated(
	'trackback_post',
	array( 0 ),
	'1.0.0',
	'',
	__( 'WP Trackbacks/Comments feature is not supported in Retraceur.' )
);

wp_die(
	'<h1>' . __( 'Retraceur does not provide a commenting feature natively.' ) . '</h1>' .
	'<p>' . __( 'You can always install and activate a Retraceur plugin dealing with comments/trackbacks or reactions.' ) . '</p>',
	500
);
