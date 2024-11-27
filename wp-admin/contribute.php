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
				<?php _e( 'Get Involved' ); ?>
			</h1>
		</div>

		<div class="about__header-text">
			<?php _e( 'Be the future of Retraceur' ); ?>
		</div>
	</div>

	<nav class="about__header-navigation nav-tab-wrapper wp-clearfix" aria-label="<?php esc_attr_e( 'Secondary menu' ); ?>">
		<a href="about.php" class="nav-tab"><?php _e( 'What&#8217;s New' ); ?></a>
		<a href="credits.php" class="nav-tab"><?php _e( 'Credits' ); ?></a>
		<a href="freedoms.php" class="nav-tab"><?php _e( 'Freedoms' ); ?></a>
		<a href="privacy.php" class="nav-tab"><?php _e( 'Privacy' ); ?></a>
		<a href="contribute.php" class="nav-tab nav-tab-active" aria-current="page"><?php _e( 'Get Involved' ); ?></a>
	</nav>

	<div class="about__section has-2-columns is-wider-right">
		<div class="column">
			<img src="<?php echo esc_url( admin_url( 'images/contribute-main.svg?ver=6.5' ) ); ?>" alt="" width="290" height="290" />
		</div>
	</div>

	<div class="about__section has-2-columns is-wider-left">
		<div class="column is-vertically-aligned-center">
			<h2 class="is-smaller-heading"><?php _e( 'No-code contribution' ); ?></h2>
			<p><?php _e( 'Retraceur may thrive on technical contributions, but you don&#8217;t have to code to contribute. Here are some of the ways you can make an impact without writing a single line of code:' ); ?></p>
			<ul>
				<li><?php _e( '<strong>Write</strong> or improve documentation for Retraceur.' ); ?></li>
				<li><?php _e( '<strong>Translate</strong> Retraceur into your local language.' ); ?></li>
				<li><?php _e( '<strong>Explore</strong> ways to reduce the environmental impact of websites.' ); ?></li>
			</ul>
		</div>
		<div class="column">
			<img src="<?php echo esc_url( admin_url( 'images/contribute-no-code.svg?ver=6.5' ) ); ?>" alt="" width="290" height="290" />
		</div>
	</div>
	<div class="about__section has-2-columns is-wider-right">
		<div class="column">
			<img src="<?php echo esc_url( admin_url( 'images/contribute-code.svg?ver=6.5' ) ); ?>" alt="" width="290" height="290" />
		</div>
		<div class="column is-vertically-aligned-center">
			<h2 class="is-smaller-heading"><?php _e( 'Code-based contribution' ); ?></h2>
			<p><?php _e( 'If you do code, or want to learn how, you can contribute technically in numerous ways:' ); ?></p>
			<ul>
				<li><?php _e( '<strong>Find</strong> and report bugs in the Retraceur core software.' ); ?></li>
				<li><?php _e( '<strong>Test</strong> new releases and proposed features for the Block Editor.' ); ?></li>
				<li><?php _e( '<strong>Write</strong> and submit patches to fix bugs or help build new features.' ); ?></li>
			</ul>
			<p><?php _e( 'Retraceur embraces new technologies, while being committed to backward compatibility. The Retraceur project uses the following languages and libraries:' ); ?></p>
			<ul>
				<li><?php _e( 'Retraceur Core and Block Editor: HTML, CSS, PHP, SQL, JavaScript, and React.' ); ?></li>
			</ul>
		</div>
	</div>

</div>
<?php
require_once ABSPATH . 'wp-admin/admin-footer.php';
