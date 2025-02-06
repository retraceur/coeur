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
				<h3><?php esc_html_e( 'Unchained from «&nbsp;MullenWeb&nbsp;»' ); ?></h3>
				<p>
					<strong><?php esc_html_e( 'Retraceur is a WP fork completely disconnected from any personal or professional Websites owned by Mr. Mullenweg.' ); ?></strong><br />
					<?php esc_html_e( 'Freeing yourself from such a powerful grip requires sacrifices and responsibility. By choosing Retraceur, you gave up all the services freely provided by the WP-dot-org remote APIs.' ); ?><br />
					<?php esc_html_e( 'As a result, you temporarly need to care about keeping up to date this software & all the third party resources you might install to customize or extend it.' ); ?><br />
					<?php
					printf(
						/* Translators: 1: Retraceur’s Bluesky feed link. 2: Retraceur’s GitHub feed link. */
						esc_html__( 'Untill Retraceur provides its own Automatic Update API, you can be notified of new versions subscribing to Retraceur’s %1$s or %2$s feeds.' ),
						'<a href="https://bsky.app/profile/retraceur.bsky.social" target="_blank">Bluesky</a>',
						'<a href="https://github.com/retraceur/coeur/releases.atom" target="_blank">GitHub</a>'
					);
					?><br />
				</p>
			</div>
			<div class="column is-vertically-aligned-center">
				<div class="about__image svg">
					<img src="https://wsrv.nl/?url=https://raw.githubusercontent.com/retraceur/ressources/refs/heads/main/images/unlock.svg" alt="" />
				</div>
			</div>
		</div>

		<hr class="is-invisible is-large" />

		<div class="about__section has-2-columns">
			<div class="column is-vertically-aligned-center">
				<div class="about__image svg">
					<img src="https://wsrv.nl/?url=https://raw.githubusercontent.com/retraceur/ressources/refs/heads/main/images/clean-up.svg" alt="" />
				</div>
			</div>
			<div class="column is-vertically-aligned-center">
				<h3><?php esc_html_e( 'A streamlined core, free of outdated features' ); ?></h3>
				<p>
					<strong><?php esc_html_e( 'Retraceur’s goal is to help individuals build personal Websites up, first and foremost.' ); ?></strong><br />
					<?php esc_html_e( 'That’s why its core has been considerably lightened, keeping only what’s crucial to achieving this goal.' ); ?><br />
					<?php esc_html_e( 'While features like Comments or Multisite were removed to be soon available as plugins, others like the Legacy Navigation Menus, the Legacy Widgets, the Legacy Classic Editor code, the Customizer, the Link Manager, the XML-RPC API and Posting by email completely vanished.' ); ?><br />
				</p>
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
					<?php printf( '<img src="https://wsrv.nl/?url=%s" alt="" />', esc_url( __( 'https://raw.githubusercontent.com/retraceur/ressources/refs/heads/main/images/point-en.png' ) ) ); ?>
				</div>
			</div>
		</div>

		<hr class="is-invisible is-large" />

		<div class="about__section has-3-columns">
			<div class="column">
				<h3><?php esc_html_e( 'The new features!' ); ?></h3>
				<p>
					<?php
					printf(
						/* Translators: %s: The link to the Blocks Administration. */
						esc_html__( 'You can now install & manage your blocks from a %s.' ),
						'<a href="blocks.php">' . __( 'dedicated Administration screen' ) . '</a>'
					);
					?>
				</p>
			</div>
			<div class="column is-vertically-aligned-bottom">
				<p><?php esc_html_e( 'Registration workflow now only creates users once they activated their account.' ); ?></p>
			</div>
			<div class="column is-vertically-aligned-bottom">
				<p><?php esc_html_e( 'Your subscribers are free to delete their account from their Profile Administration page.' ); ?></p>
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
		</div>
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
