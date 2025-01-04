<?php
/**
 * Title: Point’s entry footer
 * Slug: point/entry-footer
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
	<?php
	printf( '<!-- wp:post-terms {"term":"category","prefix":"%s ","suffix":"."} /-->', esc_html_x( 'Categorized in', '"Published in" category separator' ) );
	printf( '<!-- wp:post-terms {"term":"post_tag","prefix":"%s ","suffix":"."} /-->', esc_html_x( 'Tagged', '"Tagged" tag separator' ) );
	?>
</div>
<!-- /wp:group -->
