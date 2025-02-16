<?php
/**
 * Contains the post embed base template;
 *
 * When a post is embedded in an iframe, this file is used to create the output
 * if the active theme does not include an embed.php template.
 *
 * @since WP 4.4.0
 * @since 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage oEmbed
 */

get_header( 'embed' );

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		get_template_part( 'embed', 'content' );
	endwhile;
else :
	get_template_part( 'embed', '404' );
endif;

get_footer( 'embed' );
