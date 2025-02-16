<?php

if ( class_exists( 'SimplePie', false ) ) {
	return;
}

// Load and register the SimplePie native autoloaders.
require ABSPATH . WPINC . '/SimplePie/autoloader.php';

/**
 * Retraceur autoloader for SimplePie.
 *
 * @since WP 3.5.0
 * @deprecated WP 6.7.0 Use `SimplePie_Autoloader` instead.
 *
 * @param string $class Class name.
 */
function wp_simplepie_autoload( $class ) {
	_deprecated_function( __FUNCTION__, '6.7.0', 'SimplePie_Autoloader' );
}
