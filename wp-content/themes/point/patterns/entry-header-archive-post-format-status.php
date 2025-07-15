<?php
/**
 * Title: Point’s Status Post Format archive entry header
 * Slug: point/entry-header-archive-post-format-status
 * Inserter: no
 *
 * @package Retraceur
 * @subpackage Content/Themes/Point
 *
 * @since 2.0.0
 */
?>
<!-- wp:post-format-name {"isLink":false,"level":2,"className":"screen-reader-text"} /-->
<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20","margin":{"bottom":"var:preset|spacing|50"}},"typography":{"fontSize":"16px"}},"layout":{"type":"flex"}} -->
<div class="wp-block-group" style="margin-bottom:var(--wp--preset--spacing--50);font-size:16px">
	<!-- wp:post-author {"showAvatar":true, "avatarSize":32, "className":"inline-post-format"} /-->
	<!-- wp:paragraph -->
	<p><?php echo esc_html_x( 'on', 'Status post format "Published on" date separator' ); ?></p>
	<!-- /wp:paragraph -->
	<!-- wp:post-date {"isLink":true} /-->
</div>
<!-- /wp:group -->
