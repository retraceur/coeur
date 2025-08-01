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
<!-- wp:group {"tagName":"section","className":"entry-header","style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"inherit":true,"type":"constrained"}} -->
<section class="wp-block-group entry-header">
	<!-- wp:post-format-part {"include":"standard"} -->
		<!-- wp:post-title {"isLink":true,"level":2} /-->
		<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20","margin":{"bottom":"var:preset|spacing|50"}},"typography":{"fontSize":"16px"}},"layout":{"type":"flex"}} -->
		<div class="wp-block-group" style="margin-bottom:var(--wp--preset--spacing--50);font-size:16px">
			<!-- wp:paragraph -->
			<p><?php echo esc_html_x( 'Published on', '"Published on" date separator' ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:post-date /-->
			<?php if ( ! is_author() ) : ?>
				<!-- wp:paragraph -->
				<p><?php echo esc_html_x( 'by', '"by" Author separator' ); ?></p>
				<!-- /wp:paragraph -->
				<!-- wp:post-author {"showAvatar":false} /-->
			<?php endif ; ?>
		</div>
		<!-- /wp:group -->
		<!-- wp:post-featured-image {"isLink":true} /-->
	<!-- /wp:post-format-part -->
	<!-- wp:post-format-part {"exclude":"standard"} -->
		<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20","margin":{"bottom":"var:preset|spacing|50"}},"typography":{"fontSize":"16px"}},"layout":{"type":"flex"}} -->
		<div class="wp-block-group" style="margin-bottom:var(--wp--preset--spacing--50);font-size:16px">
			<!-- wp:post-format-part {"exclude":"status"} -->
				<!-- wp:post-format-name {"isLink":true,"level":2,"className":"screen-reader-text"} /-->
			<!-- /wp:post-format-part -->
			<!-- wp:post-author {"showAvatar":true, "avatarSize":48, "className":"post-format-status"} /-->
			<!-- wp:post-format-part {"include":"link"} -->
				<!-- wp:paragraph -->
				<p><?php echo esc_html_x( 'shared this link on', 'Link post format "Published on" date separator' ); ?></p>
				<!-- /wp:paragraph -->
			<!-- /wp:post-format-part -->
			<!-- wp:post-format-part {"include":"status"} -->
				<!-- wp:paragraph -->
				<p><?php echo esc_html_x( 'published this status update on', 'Status post format "Published on" date separator' ); ?></p>
				<!-- /wp:paragraph -->
			<!-- /wp:post-format-part -->
			<!-- wp:post-format-part {"include":"image"} -->
				<!-- wp:paragraph -->
				<p><?php echo esc_html_x( 'shared this photo on', 'Image post format "Published on" date separator' ); ?></p>
				<!-- /wp:paragraph -->
			<!-- /wp:post-format-part -->
			<!-- wp:post-format-part {"include":"quote"} -->
				<!-- wp:paragraph -->
				<p><?php echo esc_html_x( 'referred to this quote on', 'Quote post format "Published on" date separator' ); ?></p>
				<!-- /wp:paragraph -->
			<!-- /wp:post-format-part -->
			<!-- wp:post-date {"isLink":true} /-->
		</div>
		<!-- /wp:group -->
	<!-- /wp:post-format-part -->
</section>
<!-- /wp:group -->
