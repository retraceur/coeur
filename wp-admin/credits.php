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
				<?php esc_html_e( 'About' ); ?>
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

	<div class="about__section has-1-column has-gutters">
		<div class="column aligncenter">
			<p>
				<?php
				printf(
					/* translators: 1: GH URL listing contributors */
					__( 'Retraceur is a fork of WP. Many thanks to the <a href="%1$s">WP Core Contributors</a>.' ),
					esc_url( 'https://github.com/WordPress/wordpress-develop/graphs/contributors' )
				);
				?>
				<br />
				<a href="<?php echo esc_url( __( 'https://github.com/WordPress/wordpress-develop/blob/trunk/CONTRIBUTING.md' ) ); ?>"><?php _e( 'Get involved in WP.' ); ?></a>
			</p>
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
