<?php
/**
 * Install plugin administration panel.
 *
 * @since 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Administration
 */
// TODO: Route this page via a specific iframe handler instead of the do_action below.
if ( ! defined( 'IFRAME_REQUEST' ) && isset( $_GET['tab'] ) && ( 'plugin-information' === $_GET['tab'] ) ) {
	define( 'IFRAME_REQUEST', true );
}

$plugin_type  = 'regular';
$plugins_args = array(
	'singular' => 'plugin',
	'plural'   => 'plugins',
);

if ( defined( 'IS_BLOCKS_ADMIN' ) && IS_BLOCKS_ADMIN ) {
	$plugin_type  = 'block';
	$plugins_args = array(
		'singular' => 'block',
		'plural'   => 'blocks',
	);
}

/**
 * Retraceur Administration Bootstrap.
 */
require_once __DIR__ . '/admin.php';

if ( ! current_user_can( 'install_plugins' ) ) {
	if ( 'block' === $plugins_type ) {
		wp_die( esc_html__( 'Sorry, you are not allowed to install blocks for this site.' ) );
	} else {
		wp_die( esc_html__( 'Sorry, you are not allowed to install plugins for this site.' ) );
	}
}

if ( is_multisite() && ! is_network_admin() ) {
	wp_redirect( network_admin_url( 'plugin-install.php' ) );
	exit;
}

$wp_list_table = _get_list_table( 'WP_Plugin_Install_List_Table', $plugins_args );
$pagenum       = $wp_list_table->get_pagenum();

if ( ! empty( $_REQUEST['_wp_http_referer'] ) ) {
	$location = remove_query_arg( '_wp_http_referer', wp_unslash( $_SERVER['REQUEST_URI'] ) );

	if ( ! empty( $_REQUEST['paged'] ) ) {
		$location = add_query_arg( 'paged', (int) $_REQUEST['paged'], $location );
	}

	wp_redirect( $location );
	exit;
}

$wp_list_table->prepare_items();

$total_pages = $wp_list_table->get_pagination_arg( 'total_pages' );

if ( $pagenum > $total_pages && $total_pages > 0 ) {
	wp_redirect( add_query_arg( 'paged', $total_pages ) );
	exit;
}

// Used in the HTML title tag.
$title       = __( 'Add Plugins' );
$parent_file = 'plugins.php';

if ( 'block' === $plugin_type ) {
	$title       = _x( 'Add Blocks', 'block install page title' );
	$parent_file = 'blocks.php';
}

wp_enqueue_script( 'plugin-install' );
if ( 'plugin-information' !== $tab ) {
	add_thickbox();
}

$body_id = $tab;

wp_enqueue_script( 'updates' );

/**
 * Fires before each tab on the Install Plugins screen is loaded.
 *
 * The dynamic portion of the hook name, `$tab`, allows for targeting
 * individual tabs.
 *
 * Possible hook names include:
 *
 *  - `install_plugins_pre_beta`
 *  - `install_plugins_pre_featured`
 *  - `install_plugins_pre_plugin-information`
 *  - `install_plugins_pre_all`
 *  - `install_plugins_pre_search`
 *  - `install_plugins_pre_upload`
 *
 * @since WP 2.7.0
 */
do_action( "install_plugins_pre_{$tab}" );

/*
 * Call the pre upload action on every non-upload plugin installation screen
 * because the form is always displayed on these screens.
 */
if ( 'upload' !== $tab ) {
	/** This action is documented in wp-admin/plugin-install.php */
	do_action( 'install_plugins_pre_upload' );
}

get_current_screen()->add_help_tab(
	array(
		'id'      => 'overview',
		'title'   => __( 'Overview' ),
		'content' =>
				'<p>' . __( 'Plugins hook into Retraceur to extend its functionality with custom features. Plugins are developed independently from the core Retraceur application by thousands of developers all over the world.' ) . '</p>' .
				'<p>' . __( 'You can find new plugins to install by searching or browsing the directory right here in your own Plugins section.' ) . ' <span id="live-search-desc" class="hide-if-no-js">' . __( 'The search results will be updated as you type.' ) . '</span></p>',

	)
);
get_current_screen()->add_help_tab(
	array(
		'id'      => 'adding-plugins',
		'title'   => __( 'Adding Plugins' ),
		'content' =>
				'<p>' . __( 'If you want to install a plugin that you&#8217;ve downloaded elsewhere, click the Upload Plugin button above the plugins list. You will be prompted to upload the .zip package, and once uploaded, you can activate the new plugin.' ) . '</p>',
	)
);

get_current_screen()->set_screen_reader_content(
	array(
		'heading_views'      => __( 'Filter plugins list' ),
		'heading_pagination' => __( 'Plugins list navigation' ),
		'heading_list'       => __( 'Plugins list' ),
	)
);

/**
 * Retraceur Administration Template Header.
 */
require_once ABSPATH . 'wp-admin/admin-header.php';

WP_Plugin_Dependencies::initialize();
WP_Plugin_Dependencies::display_admin_notice_for_unmet_dependencies();
WP_Plugin_Dependencies::display_admin_notice_for_circular_dependencies();
?>
<div class="wrap <?php echo esc_attr( "plugin-install-tab-$tab" ); ?>">
<h1 class="wp-heading-inline">
<?php
echo esc_html( $title );
?>
</h1>

<?php
if ( ! empty( $tabs['upload'] ) && current_user_can( 'upload_plugins' ) ) {
	printf(
		' <a href="%s" class="upload-view-toggle page-title-action"><span class="upload">%s</span><span class="browse">%s</span></a>',
		( 'upload' === $tab ) ? self_admin_url( 'plugin-install.php' ) : self_admin_url( 'plugin-install.php?tab=upload' ),
		'block' === $plugin_type ? __( 'Upload Block' ) : __( 'Upload Plugin' ),
		'block' === $plugin_type ? __( 'Browse Blocks' ) : __( 'Browse Plugins' )
	);
}
?>

<hr class="wp-header-end">

<?php
/*
 * Output the upload plugin form on every non-upload plugin installation screen, so it can be
 * displayed via JavaScript rather then opening up the devoted upload plugin page.
 */
if ( 'upload' !== $tab ) {
	?>
	<div class="upload-plugin-wrap">
		<?php
		if ( 'block' === $plugin_type ) {
			/**
			 * Fire the hook to display the Block upload form.
			 *
			 * @since 1.0.0 Retraceur fork.
			 */
			do_action( 'install_blocks_upload' );
		} else {
			/** This action is documented in wp-admin/plugin-install.php */
			do_action( 'install_plugins_upload' );
		}
		?>
	</div>
	<?php
	$wp_list_table->views();
}

if ( 'block' === $plugin_type ) {
	/**
	 * Fires after the blocks list table in each tab of the Install Blocks screen.
	 *
	 * The dynamic portion of the hook name, `$tab`, allows for targeting
	 * individual tabs.
	 *
	 * @since 1.0.0 Retraceur fork.
	 */
	do_action( "install_blocks_{$tab}", $paged );
} else {
	/**
	 * Fires after the plugins list table in each tab of the Install Plugins screen.
	 *
	 * The dynamic portion of the hook name, `$tab`, allows for targeting
	 * individual tabs.
	 *
	 * Possible hook names include:
	 *
	 *  - `install_plugins_beta`
	 *  - `install_plugins_featured`
	 *  - `install_plugins_plugin-information`
	 *  - `install_plugins_popular`
	 *  - `install_plugins_recommended`
	 *  - `install_plugins_search`
	 *  - `install_plugins_upload`
	 *
	 * @since WP 2.7.0
	 *
	 * @param int $paged The current page number of the plugins list table.
	 */
	do_action( "install_plugins_{$tab}", $paged );
}
?>

	<span class="spinner"></span>
</div>

<?php
wp_print_request_filesystem_credentials_modal();
wp_print_admin_notice_templates();

/**
 * Retraceur Administration Template Footer.
 */
require_once ABSPATH . 'wp-admin/admin-footer.php';
