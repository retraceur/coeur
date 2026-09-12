<?php
/**
 * Custom header image script.
 *
 * This file is deprecated, use 'wp-admin/includes/class-custom-image-header.php' instead.
 *
 * @deprecated WP 5.3.0
 * @package Retraceur
 * @subpackage Administration
 */

// Don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

_deprecated_file( basename( __FILE__ ), '5.3.0', 'wp-admin/includes/class-custom-image-header.php' );

/** Custom_Image_Header class */
require_once ABSPATH . 'wp-admin/includes/class-custom-image-header.php';
