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
					<img src="https://wsrv.nl/?url=https://raw.githubusercontent.com/retraceur/ressources/refs/heads/main/images/discovery-ui.svg" alt="" />
				</div>
			</div>
			<div class="column is-vertically-aligned-center">
				<h3><?php esc_html_e( 'An open crossroads for evolving your site' ); ?></h3>
				<p>
					<strong>
						<?php esc_html_e( 'Retraceur was born from a simple goal: taking back control of our personal presence on the Web.' );
						?>
					</strong>
					<br /><?php esc_html_e( 'This new version takes an important step in that direction.' ); ?>
					<br /><?php esc_html_e( 'Retraceur can now discover and update the Plugins and Blocks that enrich our sites, without creating a new dependency on a centralized platform.' ); ?>
				</p>
				<h4><?php esc_html_e( 'Discover, choose, contribute' ); ?></h4>
				<p>
					<?php
					printf(
						/* Translators: %s: The discovery API name in bold format. */
						esc_html__( 'Retraceur now provides %s that allows Plugins and Blocks to make themselves available to sites that want to use them.' ),
						'<strong>' . esc_html_x( 'a discovery API', 'about 4.0 page' ) . '</strong>'
					);
					?>
					<br /><?php esc_html_e( 'The goal is more ambitious than rebuilding another centralized directory: freeing developers to publish, and users to discover Plugins and Blocks.' ); ?>
					<br /><?php
					printf(
						/* Translators: %s: The discovery API goal in blod format. */
						esc_html__( 'The direction is clear: progressively build a “%s” mechanism that will ultimately depend on no particular infrastructure.' ),
						'<strong>' . esc_html_x( 'forge-agnostic', 'about 4.0 page' ) . '</strong>'
					);
					?>
					<br /><?php esc_html_e( 'For this first version, Retraceur relies on GitHub, a forge widely used by open-source projects and a natural starting point for Retraceur resources.' ); ?>
				</p>
			</div>
		</div>

		<div class="about__section has-1-column">
			<div class="column">
				<p class="is-subheading italic">
					<?php esc_html_e( 'A crossroads rather than a destination.' ); ?><br />
					<?php esc_html_e( 'Resources rather than a curated catalog.' ); ?><br />
					<?php esc_html_e( 'A first forge, but not a forge imposed forever.' ); ?>
				</p>
			</div>
		</div>

		<div class="about__section has-2-columns">
			<div class="column is-vertically-aligned-center">
				<h4><?php esc_html_e( 'Update without giving up independence' ); ?></h4>
				<p>
					<?php
					printf(
						/* Translators: %s: The update API name in bold format. */
						esc_html__( 'This same approach guided the design of %s.' ),
						'<strong>' . esc_html_x( 'the update API', 'about 4.0 page' ) . '</strong>'
					);
					?>
					<br /><?php esc_html_e( 'Retraceur can now check whether new versions of installed Plugins and Blocks are available, and offer to update them directly from the site administration, currently relying on GitHub.' ); ?>
					<br /><?php
					printf(
						/* Translators: %s: The update API goal in blod format. */
						esc_html__( 'Here too, the direction is the same: enable infrastructure %s so that no single one becomes essential to Retraceur\'s operation.' ),
						'<strong>' . esc_html_x( 'to diversify', 'about 4.0 page' ) . '</strong>'
					);
					?>
					<br /><?php esc_html_e( 'Version 4.0.0 lays the first foundations for a distributed system where responsibility for publishing, distributing, and updating resources progressively belongs to the people who create and use them.' ); ?>
				</p>
			</div>
			<div class="column is-vertically-aligned-center">
				<div class="about__image svg">
					<img src="https://wsrv.nl/?url=https://raw.githubusercontent.com/retraceur/ressources/refs/heads/main/images/unified-update-management.svg" alt="" />
				</div>
			</div>
		</div>

		<hr class="is-invisible is-large" />

		<div class="about__section has-2-columns">
			<div class="column">
				<h3><?php esc_html_e( 'A few extra treats!' ); ?></h3>
				<p>
					<strong><?php esc_html_e( 'Three new blocks' ); ?></strong><br />
					<?php
					printf(
						/* Translators: 1: first block name. 2: second block name. 3: Third block name. */
						esc_html__( 'Designing your website and writing your content in Retraceur gets three new native blocks: %1$s, %2$s and %3$s.' ),
						'<strong>' . esc_html_x( 'Breadcrumbs', 'about 4.0 page' ) . '</strong>',
						'<strong>' . esc_html_x( 'Table of Contents', 'about 4.0 page' ) . '</strong>',
						'<strong>' . esc_html_x( 'Icons', 'about 4.0 page' ) . '</strong>'
					);
					?>
				</p>
			</div>
			<div class="column is-vertically-aligned-bottom">
				<p>
					<strong><?php esc_html_e( 'Unified update management' ); ?></strong><br />
					<?php esc_html_e( 'Extension and block updates are now managed from the same administration screen already used for Retraceur core updates.' ); ?>
				</p>
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
