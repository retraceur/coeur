<?php
/**
 * About This Version administration panel.
 *
 * @since 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Administration
 */

/** Retraceur Administration Bootstrap */
require_once __DIR__ . '/admin.php';

// Used in the HTML title tag.
/* translators: Page title of the About Retraceur page in the admin. */
$title = _x( 'About', 'page title' );

list( $display_version ) = explode( '-', retraceur_get_version() );

require_once ABSPATH . 'wp-admin/admin-header.php';
?>
	<div class="wrap about__container svg">

		<div class="about__header">
			<div class="about__header-title">
				<h1>
					<?php echo esc_html_x( 'About', 'About admin page before software logo' ); ?>
					<div class="retraceur-badge"></div>
				</h1>
			</div>
		</div>

		<nav class="about__header-navigation nav-tab-wrapper wp-clearfix" aria-label="<?php esc_attr_e( 'Secondary menu' ); ?>">
			<a href="about.php" class="nav-tab nav-tab-active" aria-current="page"><?php esc_html_e( 'What’s New' ); ?></a>
			<a href="credits.php" class="nav-tab"><?php esc_html_e( 'Credits' ); ?></a>
			<a href="freedoms.php" class="nav-tab"><?php esc_html_e( 'Freedoms' ); ?></a>
			<a href="privacy.php" class="nav-tab"><?php esc_html_e( 'Privacy' ); ?></a>
			<a href="contribute.php" class="nav-tab"><?php esc_html_e( 'Contributing' ); ?></a>
		</nav>

		<div class="about__section">
			<div class="column">
				<h2>
					<?php
					printf(
						/* translators: %s: Retraceur version. */
						__( 'Retraceur %s' ),
						$display_version
					);
					?>
				</h2>
				<p class="is-subheading">
					<?php esc_html_e( 'Thanks for making Retraceur your very own Personal Online Publication Hub.' ); ?>
				</p>
			</div>
		</div>

		<div class="about__section has-2-columns">
			<div class="column is-vertically-aligned-center">
				<h3><?php esc_html_e( 'The Post Formats theme feature has been completely revamped' ); ?></h3>
				<p>
					<strong>
						<?php printf(
							/* Translators: %s: Retraceur’s name & version number. */
							esc_html__( 'While Mr. Mullenweg’s WP has neglected this theme feature since its introduction in 2011, %s brings it back to the forefront by completely rewriting it.' ),
							'Retraceur&nbsp;2.0.0'
						);
						?>
					</strong><br />
					<?php esc_html_e( 'It’s obvious: your very own online publication hub needs a fancy way — in line with your active theme capabilities — to let you potentially share code, status updates, photos, asides, links, chat transcripts, image galleries, quotes, movies, sounds and regular posts into your publication stream using a dedicated output for each format.' ); ?><br />
					<?php esc_html_e( 'If, like "Point" — the bundled default Retraceur theme — your active theme is supporting one or more Post Formats, you’ll be able to select the best format to structure your content front-end layout within the Post Editor as well as to customize Post Format templates from the Site Editor.' ); ?><br />
				</p>
			</div>
			<div class="column is-vertically-aligned-center">
				<div class="about__image svg">
					<img src="https://wsrv.nl/?url=https://raw.githubusercontent.com/retraceur/ressources/refs/heads/main/images/revamped-post-format.svg" alt="" />
				</div>
			</div>
		</div>

		<hr class="is-invisible is-large" />

		<div class="about__section has-2-columns">
			<div class="column is-vertically-aligned-center">
				<div class="about__image svg">
					<img src="https://wsrv.nl/?url=https://raw.githubusercontent.com/retraceur/ressources/refs/heads/main/images/1-click-upgrade.svg" alt="" />
				</div>
			</div>
			<div class="column is-vertically-aligned-center">
				<h3><?php esc_html_e( '1 click Retraceur Coeur Upgrade' ); ?></h3>
				<p>
					<strong><?php esc_html_e( 'Updating a software is too sensitive to let it run in the background.' ); ?></strong><br />
					<?php esc_html_e( 'Here comes the first iteration of the Retraceur Updates API, it’s primarily focusing on the core software.' ); ?><br />
					<?php esc_html_e( 'As soon as a new Retraceur release is available, the next time you’ll visit your dashboard, an update notification inside your main menu will inform you about it.' ); ?>
					<?php esc_html_e( 'Head over to your Retraceur Updates administration screen & choose whether to directly launch the 1 click process or download the release package to perform a manual upgrade.' ); ?><br />
				</p>
				<p><strong><?php esc_html_e( 'Retraceur Coeur updates stay under your control.' ); ?></strong><br /></p>
			</div>
		</div>

		<hr class="is-invisible is-large" />

		<div class="about__section">
			<div class="column">
				<p class="is-subheading">
					<?php esc_html_e( 'Retraceur chooses to move forward and promote the Site Editor and using Block Themes.' ); ?>
				</p>
			</div>
			<div class="column is-vertically-aligned-center">
				<div class="about__image svg">
					<?php printf( '<img src="https://wsrv.nl/?url=%s" alt="" />', esc_url( __( 'https://raw.githubusercontent.com/retraceur/ressources/refs/heads/main/images/point-en-2-0.webp' ) ) ); ?>
				</div>
			</div>
		</div>

		<hr class="is-invisible is-large" />

		<div class="about__section has-3-columns">
			<div class="column">
				<h3><?php esc_html_e( 'Three more things!' ); ?></h3>
				<p>
					<?php
					printf(
						/* Translators: %s: The link to the Blocks Administration. */
						esc_html__( 'You can now customize Post Format names, descriptions & URLs from a %s.' ),
						'<a href="edit-tags.php?taxonomy=post_format">' . __( 'dedicated Administration screen' ) . '</a>'
					);
					?>
				</p>
			</div>
			<div class="column is-vertically-aligned-bottom">
				<p><?php esc_html_e( 'Share your Paypal profile thanks to the new Paypal item added to the social links block.' ); ?></p>
			</div>
			<div class="column is-vertically-aligned-bottom">
				<p><?php esc_html_e( 'Password security has been strengthened thanks to bcrypt encryption.' ); ?></p>
			</div>
		</div>

		<hr class="is-large" />

		<div class="return-to-dashboard">
			<?php
			if ( isset( $_GET['updated'] ) && current_user_can( 'update_core' ) ) {
				printf(
					'<a href="%1$s">%2$s</a> | ',
					esc_url( self_admin_url( 'update-core.php' ) ),
					is_multisite() ? __( 'Go to Updates' ) : __( 'Go to Dashboard &rarr; Updates' )
				);
			}

			printf(
				'<a href="%1$s">%2$s</a>',
				esc_url( self_admin_url() ),
				is_blog_admin() ? __( 'Go to Dashboard &rarr; Home' ) : __( 'Go to Dashboard' )
			);
			?>
			<a href="https://bsky.app/profile/retraceur.bsky.social" target="_blank">Bluesky</a>
			<a href="https://github.com/retraceur/coeur" target="_blank">GitHub</a>
			<?php
			printf(
				'<a href="%1$s" target="_blank">%2$s</a>',
				esc_url( _x( 'https://retraceur.github.io/', 'Retraceur Documentation site' ) ),
				esc_html__( 'Documentation', 'Retraceur About page' )
			);
			?>
	</div>

<?php require_once ABSPATH . 'wp-admin/admin-footer.php'; ?>

<?php

// These are strings we may use to describe maintenance/security releases, where we aim for no new strings.
return;

__( 'Maintenance Release' );
__( 'Maintenance Releases' );

__( 'Security Release' );
__( 'Security Releases' );

__( 'Maintenance and Security Release' );
__( 'Maintenance and Security Releases' );

/* translators: %s: Retraceur version number. */
__( '<strong>Version %s</strong> addressed one security issue.' );
/* translators: %s: Retraceur version number. */
__( '<strong>Version %s</strong> addressed some security issues.' );

/* translators: 1: Retraceur version number, 2: Plural number of bugs. */
_n_noop(
	'<strong>Version %1$s</strong> addressed %2$s bug.',
	'<strong>Version %1$s</strong> addressed %2$s bugs.'
);

/* translators: 1: Retraceur version number, 2: Plural number of bugs. Singular security issue. */
_n_noop(
	'<strong>Version %1$s</strong> addressed a security issue and fixed %2$s bug.',
	'<strong>Version %1$s</strong> addressed a security issue and fixed %2$s bugs.'
);

/* translators: 1: Retraceur version number, 2: Plural number of bugs. More than one security issue. */
_n_noop(
	'<strong>Version %1$s</strong> addressed some security issues and fixed %2$s bug.',
	'<strong>Version %1$s</strong> addressed some security issues and fixed %2$s bugs.'
);

/* translators: %s: Documentation URL. */
__( 'For more information, see <a href="%s">the release notes</a>.' );

/* translators: 1: Retraceur version number, 2: Link to update Retraceur */
__( 'Important! Your version of Retraceur (%1$s) is no longer supported, you will not receive any security updates for your website. To keep your site secure, please <a href="%2$s">update to the latest version of Retraceur</a>.' );

/* translators: 1: Retraceur version number, 2: Link to update Retraceur */
__( 'Important! Your version of Retraceur (%1$s) will stop receiving security updates in the near future. To keep your site secure, please <a href="%2$s">update to the latest version of Retraceur</a>.' );

/* translators: %s: The major version of Retraceur for this branch. */
__( 'This is the final release of Retraceur %s' );
