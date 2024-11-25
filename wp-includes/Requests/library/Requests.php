<?php
/**
 * Loads the old Requests class file when the autoloader
 * references the original PSR-0 Requests class.
 *
 * @deprecated WP 6.2.0
 * @package Retraceur
 * @subpackage Requests
 * @since WP 6.2.0
 */

include_once ABSPATH . WPINC . '/class-requests.php';
