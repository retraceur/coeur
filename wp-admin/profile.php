<?php
/**
 * User Profile Administration Screen.
 *
 * @since 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Administration
 */

/**
 * This is a profile page.
 *
 * @since WP 2.5.0
 * @var bool
 */
define( 'IS_PROFILE_PAGE', true );

/** Load User Editing Page */
require_once __DIR__ . '/user-edit.php';
