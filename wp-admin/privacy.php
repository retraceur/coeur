<?php
/**
 * Privacy administration panel.
 *
 * @since 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Administration
 */

/** Retraceur Administration Bootstrap */
require_once __DIR__ . '/admin.php';

// Used in the HTML title tag.
$title = __( 'Privacy' );

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
		<a href="privacy.php" class="nav-tab nav-tab-active" aria-current="page"><?php esc_html_e( 'Privacy' ); ?></a>
		<a href="contribute.php" class="nav-tab"><?php esc_html_e( 'Contributing' ); ?></a>
	</nav>

	<div class="about__section">
		<div class="column">
			<h2><?php esc_html_e( 'Privacy policy' ) ;?></h2>
			<p class="is-subheading">
				<?php esc_html_e( 'In short: Retraceur does not collect any of your personal data, the GitHub services are & third party plugins or themes might!' ); ?>
			</p>
		</div>
	</div>

	<div class="about__section">
		<div class="column">
			<p>
				<?php
				printf(
					/* Translators: %s: Link to the email address to use to ask questions about privacy. */
					esc_html__( 'If you require any more information or have any questions about Retraceur privacy policy, please feel free to contact us by email at %s.' ),
					'<a href="mailto:retraceur+privacy@proton.me">retraceur+privacy@proton.me</a>'
				);
				?>
			</p>
			<p><?php esc_html_e( 'Retraceur considers users privacy to be extremely important, so important it does not collect any personal information. This privacy policy document describes how to be informed about the personal data collected and recorded by the GitHub services Retraceur uses, as well as warns you about the fact third party Retraceur plugins or themes might collect your personal data.' ) ; ?></p>
		</div>
	</div>

	<div class="about__section">
		<div class="column">
			<h3><?php esc_html_e( 'Scope' ) ;?></h3>
			<p>
				<?php
				printf(
					/* translators: 1: Retraceur’s repositories link. 2: Retraceur’s documentation site link. */
					esc_html__( 'This privacy policy applies only to the %1$s, as well as %2$s.' ),
					sprintf(
						'<a href="%1$s">%2$s</a>',
						esc_url( 'https://github.com/orgs/retraceur/repositories' ),
						esc_html__( 'Retraceur’s repositories' )
					),
					sprintf(
						'<a href="%1$s">%2$s</a>',
						esc_url( __( 'https://retraceur.github.io/' ) ),
						esc_html__( 'its documentation websiste' )
					)
				);
				?>
			</p>
		</div>
	</div>

	<div class="about__section">
		<div class="column">
			<h3><?php esc_html_e( 'Retraceur documentation site’s Cookies' ) ;?></h3>
			<p>
				<?php
				printf(
					/* translators: %s: Retraceur’s documentation site link. */
					esc_html__( 'If you visit the %s, be aware it uses cookies to store information about visitors’ preferences, to personalize or customize its web page content based upon visitors’ browser type or other information that the visitor sends via their browser.' ),
					sprintf(
						'<a href="%1$s">%2$s</a>',
						esc_url( __( 'https://retraceur.github.io/' ) ),
						esc_html__( 'Retraceur documentation site' )
					)
				);
				?>
			</p>
		</div>
	</div>
	<div class="about__section">
		<div class="column">
			<h3><?php esc_html_e( 'GitHub services privacy policy' ) ;?></h3>
			<p>
				<?php
				printf(
					/* translators: %s: Retraceur’s GitHub organization link. */
					esc_html__( 'Retraceur’s source code and tools to manage translations, issues, documentation and contributions are hosted on %s.' ),
					'<a href="' . esc_url( 'https://github.com/retraceur' ) . '">GitHub.com</a>'
				);
				?>
			</p>
			<p>
				<?php
				printf(
					/* translators: %s: GitHub privacy policy link. */
					esc_html__( 'You should consult the %s for more detailed information on their practices as well as for instructions about how to opt-out of certain practices.' ),
					sprintf(
						'<a href="%1$s">%2$s</a>',
						esc_url( 'https://docs.github.com/en/site-policy/privacy-policies/github-general-privacy-statement' ),
						esc_html__( 'GitHub privacy policy' )
					)
				);
				?>
			</p>
		</div>
	</div>
	<div class="about__section">
		<div class="column">
			<h3><?php esc_html_e( 'Third party Plugins or Themes' ) ;?></h3>
			<p><?php esc_html_e( 'Retraceur cannot monitor third party Plugins or Themes practices regarding your personal information. As a result it takes no responsibility nor provide any warranty about how these third parties are using your data.' ) ;?></p>
			<p>
				<?php
				printf(
					/* translators: %s: Retraceur’s repositories link. */
					esc_html__( 'Before installing a plugin or theme that is not listed into the %s, please make sure to check its privacy policy matches your expectations regarding how your personal information is managed.' ),
					sprintf(
						'<a href="%1$s">%2$s</a>',
						esc_url( 'https://github.com/orgs/retraceur/repositories' ),
						esc_html__( 'Retraceur’s repositories' )
					)
				);
				?>
			</p>
		</div>
	</div>
	<div class="about__section">
		<div class="column">
			<h3><?php esc_html_e( 'Consent' ) ;?></h3>
			<p><?php esc_html_e( 'By using Retraceur, you hereby consent to this privacy policy and agree to its terms.' ) ;?></p>

			<hr style="border: none" />

			<h3><?php echo esc_html_x( 'Update', 'Retraceur privacy policy' ) ;?></h3>
			<p>
				<?php
				printf(
					/* translators: %s: Privacy policy last updated date. */
					esc_html__( 'This Privacy Policy was last updated on: %s. Should we update, amend or make any changes to our privacy policy, those changes will be posted here.' ),
					esc_html( date_i18n( get_option( 'date_format' ), 1737200765 ) )
				);
				?>
			</p>
		</div>
	</div>
</div>
<?php require_once ABSPATH . 'wp-admin/admin-footer.php'; ?>
