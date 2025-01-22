<?php
/**
 * Credits administration panel.
 *
 * @since 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Administration
 */

/** Retraceur Administration Bootstrap */
require_once __DIR__ . '/admin.php';

// Used in the HTML title tag.
$title = __( 'Credits' );

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
		<a href="credits.php" class="nav-tab nav-tab-active" aria-current="page"><?php esc_html_e( 'Credits' ); ?></a>
		<a href="freedoms.php" class="nav-tab"><?php esc_html_e( 'Freedoms' ); ?></a>
		<a href="privacy.php" class="nav-tab"><?php esc_html_e( 'Privacy' ); ?></a>
		<a href="contribute.php" class="nav-tab"><?php esc_html_e( 'Contributing' ); ?></a>
	</nav>

	<div class="about__section is-feature">
		<div class="column aligncenter">
			<p class="is-subheading">
				<?php
				esc_html_e( 'Retraceur is currently maintained by a unique contributor!' );
				echo '<br/>';
				printf(
					/* Translators: %s: GH link to learn how to get involved. */
					esc_html__( 'You’re welcome to join the party and %s.' ),
					'<a href="https://github.com/retraceur/coeur/blob/trunk/CONTRIBUTING.md">' . esc_html__( 'contribute' ) . '</a>'
				);
				?>
			</p>
		</div>
	</div>

	<div class="about__section">
		<div class="column">
			<h3><?php esc_html_e( 'Contributor' ) ;?></h3>
			<p><a href="https://github.com/imath">imath</a></p>
		</div>
	</div>

	<div class="about__section">
		<div class="column">
			<h3><?php esc_html_e( 'Eternal thanks' ) ;?></h3>
			<p>
				<?php
				printf(
					/* translators: %s: GH link listing contributors */
					__( 'As a fork of WP, Retraceur doesn’t forget where it comes from: the passion of the %s.' ),
					'<a href="https://github.com/WordPress/wordpress-develop/graphs/contributors">' . esc_html__( 'WP Core Contributors' ) . '</a>'
				);
				?>
			</p>
		</div>
	</div>

	<div class="about__section">
		<div class="column">
			<h3>
				<?php
				/* Translators: %s is the Heart emoji. */
				printf( esc_html__( '%s GitHub' ), wp_staticize_emoji( '❤️' ) );
				?>
			</h3>
			<p>
				<?php
				printf(
					/* Translators: %s: GitHub’ about URL. */
					__( 'Building free and Open Source software requires time, energy and great tools such as the ones provided freely by %s.' ),
					'<a href="https://github.com/about">GitHub</a>'
				);
				?>
			</p>
		</div>
	</div>

	<div class="about__section">
		<div class="column">
			<h3>
				<?php
				/* Translators: %s is the Handshake emoji. */
				printf( esc_html__( 'The other Retraceur best Open Source friends %s' ), wp_staticize_emoji( '🤝' ) );
				?>
			</h3>
			<ul>
				<li><a href="https://www.libravatar.org/">Libravatar</a></li>
				<li><a href="https://openmoji.org/">OpenMoji</a> <?php echo wp_staticize_emoji( '🚀' ) ;?></li>
				<li><a href="https://wsrv.nl/">wsrv.nl</a></li>
			</ul>
		</div>
	</div>

</div>

<?php
require_once ABSPATH . 'wp-admin/admin-footer.php';
return;

// These are strings returned by the API that we want to be translatable.
__( 'Project Leaders' );
/* translators: %s: The current Retraceur version number. */
__( 'Core Contributors to Retraceur %s' );
__( 'Noteworthy Contributors' );
__( 'Cofounder, Project Lead' );
__( 'Lead Developer' );
__( 'Release Lead' );
__( 'Release Design Lead' );
__( 'Release Deputy' );
__( 'Core Developer' );
__( 'External Libraries' );
