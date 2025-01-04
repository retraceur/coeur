<?php
/**
 * Title: Point’s 404 page
 * Slug: point/404
 * Inserter: no
 *
 * @package Retraceur
 * @subpackage Content/Themes/Point
 *
 * @since 1.0.0
 */
?>
<!-- wp:image {"align":"center","sizeSlug":"large"} -->
<figure class="wp-block-image aligncenter size-large">
	<img src="<?php echo esc_url( get_template_directory_uri() );?>/assets/images/404.svg" alt=""/>
</figure>
<!-- /wp:image -->

<!-- wp:heading {"textAlign":"center","level":1} -->
<h1 class="wp-block-heading has-text-align-center" id="page-not-found"><?php echo esc_html_x( 'Page Not Found', 'Heading for a webpage that is not found' ); ?></h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center"><?php echo esc_html_x( 'The page you are looking for does not exist, or it has been moved.', 'Message to convey that a webpage could not be found' ); ?></p>
<!-- /wp:paragraph -->
