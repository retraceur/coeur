<?php
/**
 * Contains the post embed footer template.
 *
 * When a post is embedded in an iframe, this file is used to create the footer output
 * if the active theme does not include a footer-embed.php template.
 *
 * @since WP 4.5.0
 * @since 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Theme_Compat
 */

/**
 * Prints scripts or data before the closing body tag in the embed template.
 *
 * @since WP 4.4.0
 */
do_action( 'embed_footer' );
?>
</body>
</html>
