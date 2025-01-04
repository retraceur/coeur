<?php
/**
 * Title: Point’s entry header
 * Slug: point/entry-header
 * Inserter: no
 *
 * @package Retraceur
 * @subpackage Content/Themes/Point
 *
 * @since 1.0.0
 */
?>
<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20","margin":{"bottom":"var:preset|spacing|50"}},"typography":{"fontSize":"16px"}},"layout":{"type":"flex"}} -->
<div class="wp-block-group" style="margin-bottom:var(--wp--preset--spacing--50);font-size:16px">
	<!-- wp:paragraph -->
	<p><?php echo esc_html_x( 'Published on', '"Published on" date separator' ); ?></p>
	<!-- /wp:paragraph -->
	<!-- wp:post-date /-->
	<!-- wp:paragraph -->
	<p><?php echo esc_html_x( 'by', '"by" Author separator' ); ?></p>
	<!-- /wp:paragraph -->
	<!-- wp:post-author {"showAvatar":false} /-->
</div>
<!-- /wp:group -->
