<?php
/**
 * Tools Administration Screen.
 *
 * @since 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Administration
 */

if ( isset( $_GET['page'] ) && ! empty( $_POST ) ) {
	// Ensure POST-ing to `tools.php?page=export_personal_data` and `tools.php?page=remove_personal_data`
	// continues to work after creating the new files for exporting and erasing of personal data.
	if ( 'export_personal_data' === $_GET['page'] ) {
		require_once ABSPATH . 'wp-admin/export-personal-data.php';
		return;
	} elseif ( 'remove_personal_data' === $_GET['page'] ) {
		require_once ABSPATH . 'wp-admin/erase-personal-data.php';
		return;
	}
}

// The privacy policy guide used to be outputted from here. Since WP 5.3 it is in wp-admin/privacy-policy-guide.php.
if ( isset( $_GET['wp-privacy-policy-guide'] ) ) {
	require_once dirname( __DIR__ ) . '/wp-load.php';
	wp_redirect( admin_url( 'options-privacy.php?tab=policyguide' ), 301 );
	exit;
} elseif ( isset( $_GET['page'] ) ) {
	// These were also moved to files in WP 5.3.
	if ( 'export_personal_data' === $_GET['page'] ) {
		require_once dirname( __DIR__ ) . '/wp-load.php';
		wp_redirect( admin_url( 'export-personal-data.php' ), 301 );
		exit;
	} elseif ( 'remove_personal_data' === $_GET['page'] ) {
		require_once dirname( __DIR__ ) . '/wp-load.php';
		wp_redirect( admin_url( 'erase-personal-data.php' ), 301 );
		exit;
	}
}

/** Retraceur Administration Bootstrap */
require_once __DIR__ . '/admin.php';

// Used in the HTML title tag.
$title = __( 'Tools' );

require_once ABSPATH . 'wp-admin/admin-header.php';

?>
<div class="wrap">
<h1><?php echo esc_html( $title ); ?></h1>

<?php
$tool_infos = array(
	'site-health.php'          => array(
		'title' => __( 'Site Health' ),
		'desc'  => array(
			__( 'Retraceur offers a diagnosis of your site’s health. There are two tabs on the site health screen:' ),
			__( 'The first one allows you to see critical information about your configuration while the second one gives you a granular view of the most technical aspects of your website' ),
		),
	),
	'export.php'               => array(
		'title' => __( 'Export' ),
		'desc'  => array(
			__( 'Exporting your site’s data (posts, pages, custom post types, comments, custom fields, categories, tags, custom taxonomies, and users) is sometimes necessary and useful.' ),
			__( 'If you are moving to a new host or just want a backup of your site data, then Exporting your site is the answer.' ),
		),
	),
	'export-personal-data.php' => array(
		'title' => __( 'Export Personal Data' ),
		'desc'  => array(
			__( 'One of your member asked about getting the personnal data they left on your site?' ),
			__( 'The Export Personal Data tool can generate a (.zip format) file containing the personal data which exists about a user within your site.' ),
		),
	),
	'erase-personal-data.php'  => array(
		'title' => __( 'Erase Personal Data' ),
		'desc'  => array(
			__( 'One of your member asked about erasing the personnal data they left on your site?' ),
			__( 'Use the Erase Personal Data tool to delete a member’s personal data upon verified request.' ),
		),
	),
);
?>

<div class="flex-row">
	<?php foreach ( $tool_infos as $page => $tool ) {
		printf(
			'<div class="card">
				<h2 class="title">%1$s</h2>
				<p>%2$s</p>
				<p><a href="%3$s" class="button button-secondary alignright">&rarr; %1$s</a></p>
			</div>',
			esc_html( $tool['title'] ),
			esc_html( implode( ' ', $tool['desc'] ) ),
			esc_url( admin_url( $page ) )
		);
	}
	unset( $page, $tool );
	?>
</div>

<?php
/**
 * Fires at the end of the Tools Administration screen.
 *
 * @since WP 2.8.0
 */
do_action( 'tool_box' );

?>
</div>
<?php

require_once ABSPATH . 'wp-admin/admin-footer.php';
