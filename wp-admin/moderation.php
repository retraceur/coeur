<?php
/**
 * Comment Moderation Administration Screen.
 *
 * Redirects to edit-comments.php?comment_status=moderated.
 *
 * @since 1.0.0 motsVertueux fork.
 *
 * @package motsVertueux
 * @subpackage Administration
 */
require_once dirname( __DIR__ ) . '/wp-load.php';
wp_redirect( admin_url( 'edit-comments.php?comment_status=moderated' ) );
exit;
