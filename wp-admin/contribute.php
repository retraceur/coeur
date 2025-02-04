<?php
/**
 * Contribute administration panel.
 *
 * @since 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Administration
 */

/** Retraceur Administration Bootstrap */
require_once __DIR__ . '/admin.php';

// Used in the HTML title tag.
$title = __( 'Get Involved' );

list( $display_version ) = explode( '-', get_bloginfo( 'version' ) );

require_once ABSPATH . 'wp-admin/admin-header.php';
?>
<div class="wrap about__container">

	<div class="about__header">
		<div class="about__header-title">
			<h1>
				<?php echo esc_html_x( 'About', 'About admin page before software logo' ); ?>
				<div class="retraceur-badge"></div>
			</h1>
		</div>
	</div>

	<nav class="about__header-navigation nav-tab-wrapper wp-clearfix" aria-label="<?php esc_attr_e( 'Secondary menu' ); ?>">
		<a href="about.php" class="nav-tab"><?php esc_html_e( 'What’s New' ); ?></a>
		<a href="credits.php" class="nav-tab"><?php esc_html_e( 'Credits' ); ?></a>
		<a href="freedoms.php" class="nav-tab"><?php esc_html_e( 'Freedoms' ); ?></a>
		<a href="privacy.php" class="nav-tab"><?php esc_html_e( 'Privacy' ); ?></a>
		<a href="contribute.php" class="nav-tab nav-tab-active" aria-current="page"><?php esc_html_e( 'Contributing' ); ?></a>
	</nav>

	<div class="about__section is-feature">
		<div class="column aligncenter">
			<p class="is-subheading">
				<?php
				printf(
					/* Translators: %s: Heart emoji. */
					esc_html__( 'First off, thanks for taking the time to contribute %s!' ),
					wp_staticize_emoji( '♥️' )
				);
				?>
			</p>
		</div>
	</div>

	<div class="about__section">
		<div class="column">
			<p>
				<?php printf(
					/* Translators: 1: Retraceur Cœeur GitHub repository URL. 2: Retraceur documentation GitHub repository URL. 3: Retraceur Cœeur GitHub issues URL. 4: Retraceur Cœeur GitHub PR URL. */
					esc_html__( 'All types of contributions are encouraged and valued: you can contribute with %1$s, %2$s, translations, testing pre-releases, %3$s and %4$s.' ),
					'<a href="https://github.com/retraceur/coeur">' . __( 'code' ) . '</a>',
					'<a href="https://github.com/retraceur/retraceur.github.io">' . __( 'documentation' ) . '</a>',
					'<a href="https://github.com/retraceur/coeur/issues">' . __( 'reporting issues' ) . '</a>',
					'<a href="https://github.com/retraceur/coeur/pulls">' . __( 'suggesting pull requests' ) . '</a>'
				);
				?>
			</p>
			<p><?php esc_html_e( 'And if you like the project, but just don’t have time to contribute, that’s fine. There are other easy ways to support the project and show your appreciation, which we would also be very happy about:' ); ?></p>
			<ul>
				<li>
					<?php
					printf(
						/* Translators: 1: Star emoji. 2: Retraceur Cœeur GitHub repository URL. */
						esc_html__( 'Star %1$s the project on %2$s.' ),
						wp_staticize_emoji( '⭐️' ),
						'<a href="https://github.com/retraceur/coeur">GitHub</a>'
					);
					?>
				</li>
				<li>
					<?php
					printf(
						/* Translators: %s: Retraceur Bluesky profile URL. */
						esc_html__( 'Follow %s on Bluesky and/or share posts about it.' ),
						'<a href="https://bsky.app/profile/retraceur.bsky.social">Retraceur</a>'
					);
					?>
				</li>
				<li><?php esc_html_e( 'Mention the project at local meetups and tell your friends/colleagues' ); ?></li>
			</ul>
		</div>
	</div>

	<div class="about__section">
		<div class="column">
			<h2><?php esc_html_e( 'Code of conduct' ) ;?></h2>
			<p>
				<?php
				printf(
					/* Translators: %s: Retraceur Code of conduct link. */
					esc_html__( 'This project and everyone participating in it is governed by the %s. By participating, you are expected to uphold this code.' ),
					'<a href="' . esc_url( __( 'https://retraceur.github.io/rules/code-of-conduct/' ) ) . '">' . esc_html__( 'Retraceur Code of Conduct' ) . '</a>'
				);
				?>
			</p>
		</div>
	</div>

	<div class="about__section">
		<div class="column">
			<h2><?php esc_html_e( 'Legal Notice' ) ;?></h2>
			<p><?php esc_html_e( 'When contributing to this project, you must agree that you have authored 100% of the content, that you have the necessary rights to the content and that the content you contribute may be provided under the GPL.' ); ?></p>
		</div>
	</div>

	<div class="about__section">
		<div class="column">
			<h2><?php esc_html_e( 'Reporting security issues' ) ;?></h2>
			<p>
				<?php
				printf(
					/* Translators: %s: Email address to report security issues. */
					esc_html__( 'You must never report security related issues, vulnerabilities or bugs including sensitive information to the issue tracker, or elsewhere in public. Instead sensitive bugs must be sent by email to <%s>.' ),
					'<a href="mailto:retraceur+security@proton.me">retraceur+security@proton.me</a>'
				);
				?>
			</p>
		</div>
	</div>

</div>
<?php
require_once ABSPATH . 'wp-admin/admin-footer.php';
