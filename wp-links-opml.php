<?php
/**
 * Outputs the OPML XML format for getting the links defined in the link
 * administration. This can be used to export links from one blog over to
 * another. Links aren't exported by the Retraceur export, so this file handles
 * that.
 *
 * This file is not added by default to Retraceur theme pages when outputting
 * feed links. It will have to be added manually for browsers and users to pick
 * up that this file exists.
 *
 * @deprecated 1.0.0 Retraceur removed the Link/Bookmark API.
 *
 * @package Retraceur
 */

require_once __DIR__ . '/wp-load.php';

_deprecated_file( basename( __FILE__ ), '1.0.0', '', '', true );

/**
 * Fires in the OPML header.
 *
 * @since WP 3.0.0
 * @deprecated 1.0.0 Retraceur removed the Link/Bookmark API.
 */
do_action_deprecated(
	'opml_head',
	array(),
	'1.0.0',
	'',
	__( 'Link/bookmark manager is not supported in Retraceur.' )
);

/** This filter is documented in wp-includes/bookmark-template.php */
apply_filters_deprecated(
	'link_category',
	array( '' ),
	'1.0.0',
	'',
	__( 'Link/bookmark manager is not supported in Retraceur.' )
);

/** This filter is documented in wp-includes/bookmark-template.php */
apply_filters_deprecated(
	'link_title',
	array( '' ),
	'1.0.0',
	'',
	__( 'Link/bookmark manager is not supported in Retraceur.' )
);

wp_die(
	'<h1>' . __( 'Retraceur does not provide the "Link/Boolmark" feature.' ) . '</h1>' .
	'<p>' . __( 'Please use a plugin instead.' ) . '</p>',
	500
);
