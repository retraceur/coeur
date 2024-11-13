<?php
/**
 * Front to the motsVertueux application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells motsVertueux to load the theme.
 *
 * @since 1.0.0 motsVertueux fork.
 *
 * @package motsVertueux
 */

/**
 * Tells motsVertueux to load the motsVertueux theme and output it.
 *
 * @var bool
 */
define( 'WP_USE_THEMES', true );

/** Loads the motsVertueux Environment and Template */
require __DIR__ . '/wp-blog-header.php';
