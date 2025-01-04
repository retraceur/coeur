<?php
/**
 * Title: Point’s footer
 * Slug: point/footer
 * Inserter: no
 *
 * @package Retraceur
 * @subpackage Content/Themes/Point
 *
 * @since 1.0.0
 */
?>
<!-- wp:group {"layout":{"inherit":true}} -->
<div class="wp-block-group">
	<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|40"}}},"layout":{"type":"flex","justifyContent":"space-between"}} -->
	<div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--40)">
		<!-- wp:social-links -->
		<ul class="wp-block-social-links">
		<?php
		printf(
			'<!-- wp:social-link {"url":"%s","service":"feed"} /-->',
			esc_url( get_bloginfo( 'rss2_url' ) )
		);
		?>
		<!-- wp:social-link {"url":"https://bsky.app/profile/retraceur.bsky.social","service":"bluesky"} /-->
		<!-- wp:social-link {"url":"https://github.com/retraceur/","service":"github"} /-->
		</ul>
		<!-- /wp:social-links -->
		<!-- wp:paragraph {"align":"right"} -->
		<p class="has-text-align-right">
		<?php
		printf(
			/* Translators: %s: Retraceur link. */
			esc_html__( '♡ %s' ),
			'<a href="' . esc_url( __( 'https://retraceur.github.io/' ) ) . '" rel="nofollow">Retraceur</a>'
		);

		if ( function_exists( 'the_privacy_policy_link' ) ) {
			the_privacy_policy_link( '<span class="sep"> | </span>', '' );
		}
		?>
		</p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
