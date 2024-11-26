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
				<?php _e( 'Contributors' ); ?>
			</h1>
		</div>

		<div class="about__header-text">
			<?php _e( 'Created by a worldwide team of passionate individuals' ); ?>
		</div>
	</div>

	<nav class="about__header-navigation nav-tab-wrapper wp-clearfix" aria-label="<?php esc_attr_e( 'Secondary menu' ); ?>">
		<a href="about.php" class="nav-tab"><?php _e( 'What&#8217;s New' ); ?></a>
		<a href="credits.php" class="nav-tab nav-tab-active" aria-current="page"><?php _e( 'Credits' ); ?></a>
		<a href="freedoms.php" class="nav-tab"><?php _e( 'Freedoms' ); ?></a>
		<a href="privacy.php" class="nav-tab"><?php _e( 'Privacy' ); ?></a>
		<a href="contribute.php" class="nav-tab"><?php _e( 'Get Involved' ); ?></a>
	</nav>

	<div class="about__section has-1-column has-gutters">
		<div class="column aligncenter">
			<p>
				<?php
				printf(
					/* translators: 1: GH URL listing contributors */
					__( 'WordPress est maintenu par une <a href="%1$s">équipe de passionnés du monde entier</a>.' ),
					__( 'https://github.com/WordPress/wordpress-develop/graphs/contributors' )
				);
				?>
				<br />
				<a href="<?php echo esc_url( __( 'https://github.com/WordPress/wordpress-develop/blob/trunk/CONTRIBUTING.md' ) ); ?>"><?php _e( 'Get involved in WordPress.' ); ?></a>
			</p>
		</div>
	</div>
</div>

<?php
require_once ABSPATH . 'wp-admin/admin-footer.php';
return;

// These are strings returned by the API that we want to be translatable.
__( 'Project Leaders' );
/* translators: %s: The current WordPress version number. */
__( 'Core Contributors to WordPress %s' );
__( 'Noteworthy Contributors' );
__( 'Cofounder, Project Lead' );
__( 'Lead Developer' );
__( 'Release Lead' );
__( 'Release Design Lead' );
__( 'Release Deputy' );
__( 'Core Developer' );
__( 'External Libraries' );
