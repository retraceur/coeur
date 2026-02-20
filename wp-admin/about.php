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
				<div class="about__image svg">
					<img src="https://wsrv.nl/?url=https://raw.githubusercontent.com/retraceur/ressources/refs/heads/main/images/opengraph.webp" alt="" />
				</div>
			</div>
			<div class="column is-vertically-aligned-center">
				<h3><?php esc_html_e( 'Open Graph is part of your identity' ); ?></h3>
				<p>
					<strong>
						<?php esc_html__( 'A website is no longer just a destination. It is a personal crossroads — a place where your ideas, your work, and your identity converge and radiate outward.' );
						?>
					</strong><br />
					<?php esc_html_e( 'Every time a link to your site is shared, it becomes a representation of you. With built-in Open Graph support, Retraceur ensures that representation is intentional.' ); ?><br />
					<br /><?php esc_html_e( 'Your pages and posts automatically expose structured metadata designed for modern sharing. Titles, descriptions, publication data, and images are generated natively by the core — consistently, predictably, without plugins or fragile theme logic.' ); ?><br />
					<br /><?php esc_html_e( 'Because how your content appears outside your site matters as much as how it appears within it.' ); ?><br />
					<?php
					printf(
						/* Translators: 1: The settings Admin menu name. 2: The Media Admin sub menu name. */
						esc_html__( 'You can also define a global fallback image in %1$s → %2$s, guaranteeing a coherent visual presence whenever your content travels beyond your domain.' ),
						'<strong>' . esc_html_x( 'Settings', 'about 3.0 page' ),
						esc_html_x( 'Media', 'about 3.0 page' ) . '</strong>'
					);
					?>
					<br/>
					<br /><?php esc_html_e( 'Retraceur treats social metadata not as decoration, but as part of your site’s identity. Open Graph is not an add-on. It is infrastructure.' ); ?>
				</p>
			</div>
		</div>

		<hr class="is-invisible is-large" />

		<div class="about__section has-2-columns">
			<div class="column">
				<h3><?php esc_html_e( 'Two other sweets!' ); ?></h3>
				<p>
					<?php
					printf(
						/* Translators: %s: keyboard combination keys to launch the palette. */
						esc_html__( 'Hit the %s keys to launch the command palette from any part of your site’s Administration.' ),
						str_contains( $_SERVER['HTTP_USER_AGENT'], 'Mac' ) ? '<code>Cmd + k</code>' : '<code>Ctrl + k</code>'
					);
					?>
				</p>
			</div>
			<div class="column is-vertically-aligned-bottom">
				<p><?php esc_html_e( 'Use the new Accordion block for your FAQs, menus, or long content you want to keep easy to explore.' ); ?></p>
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
