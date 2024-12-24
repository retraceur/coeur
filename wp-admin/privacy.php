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
				<?php esc_html_e( 'About' ); ?>
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

</div>
<?php require_once ABSPATH . 'wp-admin/admin-footer.php'; ?>
