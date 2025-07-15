<?php
/**
 * Title: Point’s image format entry footer (single)
 * Slug: point/entry-footer-single-post-format-image
 * Inserter: no
 *
 * @package Retraceur
 * @subpackage Content/Themes/Point
 *
 * @since 1.0.0
 */
?>
<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20","margin":{"top":"var:preset|spacing|40"}},"typography":{"fontSize":"16px"}},"layout":{"type":"flex"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--40);font-size:16px">
	<!-- wp:post-format-name {"isLink":false,"level":1,"className":"post-format-image"} /-->
	<!-- wp:paragraph -->
	<p><?php echo esc_html_x( ': published on', 'Image post format "Published on" date separator' ); ?></p>
	<!-- /wp:paragraph -->
	<!-- wp:post-date /-->
	<!-- wp:paragraph -->
	<p><?php echo esc_html_x( 'by', '"by" Author separator' ); ?></p>
	<!-- /wp:paragraph -->
	<!-- wp:post-author {"showAvatar":false} /-->
</div>
<!-- /wp:group -->
