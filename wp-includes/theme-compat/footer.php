<?php
/**
 * @package Retraceur
 * @subpackage Theme_Compat
 * @deprecated WP 3.0.0
 *
 * This file is here for backward compatibility with old themes and will be removed in a future version
 */
_deprecated_file(
	/* translators: %s: Template name. */
	sprintf( __( 'Theme without %s' ), basename( __FILE__ ) ),
	'3.0.0',
	null,
	/* translators: %s: Template name. */
	sprintf( __( 'Please include a %s template in your theme.' ), basename( __FILE__ ) )
);
?>

<hr />
<div id="footer" role="contentinfo">
	<p>
		<?php
		printf(
			/* Translators: %s: Retraceur link. */
			__( '♡ %s' ),
			'<a href="' . esc_url( __( 'https://retraceur.github.io/' ) ) . '" rel="nofollow">Retraceur</a>'
		);
		?>
	</p>
</div>
</div>

<!-- Gorgeous design by Michael Heilemann - http://binarybonsai.com/ -->
<?php /* "Just what do you think you're doing Dave?" */ ?>

		<?php wp_footer(); ?>
</body>
</html>
