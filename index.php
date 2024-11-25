<?php
/**
 * Front to the Retraceur application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells Retraceur to load the theme.
 *
 * @since 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 */

/**
 * Tells Retraceur to load the Retraceur theme and output it.
 *
 * @var bool
 */
define( 'WP_USE_THEMES', true );

/** Loads the Retraceur Environment and Template */
require __DIR__ . '/wp-blog-header.php';
