<?php
/**
 * Install plugin administration panel.
 *
 * @since 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Administration
 */

$plugin_type = 'plugin';

if ( defined( 'IS_BLOCKS_ADMIN' ) && IS_BLOCKS_ADMIN ) {
	$plugin_type  = 'block';
}

/**
 * Retraceur Administration Bootstrap.
 */
require_once __DIR__ . '/admin.php';

// Init discovery settings.
$discovery_settings = array(
	'pluginType' => $plugin_type,
	'versions'   => array(
		'retraceur' => retraceur_get_version(),
		'php'       => PHP_VERSION,
	),
	'dateFormat' => get_option( 'date_format' ),
);

if ( ! current_user_can( 'install_plugins' ) ) {
	if ( 'block' === $plugin_type ) {
		wp_die( esc_html__( 'Sorry, you are not allowed to install blocks for this site.' ) );
	} else {
		wp_die( esc_html__( 'Sorry, you are not allowed to install plugins for this site.' ) );
	}
}

if ( is_multisite() && ! is_network_admin() ) {
	wp_redirect( network_admin_url( 'plugin-install.php' ) );
	exit;
}

// Used in the HTML title tag.
$title       = __( 'Discover Plugins' );
$parent_file = 'plugins.php';

if ( 'block' === $plugin_type ) {
	$title       = _x( 'Discover Blocks', 'block install page title' );
	$parent_file = 'blocks.php';
}

wp_enqueue_script( 'retraceur-discovery' );
wp_add_inline_script(
	'retraceur-discovery',
	sprintf(
		'retraceurDiscoverySettings = %s;',
		wp_json_encode( $discovery_settings, JSON_HEX_TAG | JSON_UNESCAPED_SLASHES )
	)
);

wp_enqueue_style( 'retraceur-discovery' );

/**
 * Fires before the Install Plugins screen is loaded.
 *
 * @since WP 2.7.0
 */
do_action( 'install_plugins_pre_all' );
foreach ( array( 'beta', 'favorites', 'featured', 'plugin-information', 'popular', 'recommended', 'search' ) as $tab ) {
	/**
	 * Fires before each tab on the Install Plugins screen is loaded.
	 *
	 * The dynamic portion of the hook name, `$tab`, allows for targeting
	 * individual tabs.
	 *
	 * Possible hook names include:
	 *
	 *  - `install_plugins_pre_beta`
	 *  - `install_plugins_pre_favorites`
	 *  - `install_plugins_pre_featured`
	 *  - `install_plugins_pre_plugin-information`
	 *  - `install_plugins_pre_popular`
	 *  - `install_plugins_pre_recommended`
	 *  - `install_plugins_pre_search`
	 *
	 * @since 2.7.0
	 * @deprecated 4.0.0 Retraceur fork.
	 */
	do_action_deprecated(
		"install_plugins_pre_{$tab}",
		array(),
		'4.0.0',
		'',
		sprintf(
			/* translators: %s is the dynamic portion of the hook. */
			__( 'Retraceur Discover API is not firing the `install_plugins_pre_%s` hook.' ),
			$tab
		)
	);
}

if ( 'block' === $plugin_type ) {
	$help  = '<p>' . esc_html__( 'Blocks are pieces of content of a post, page or template of your site. Blocks are developed independently from the Retraceur software by thousands of developers all over the world.' ) . '</p>';
	$help .= '<p>' . esc_html__( 'You can find new blocks to install by searching or browsing the directory right here in your own blocks section.' );
} else {
	$help  = '<p>' . esc_html__( 'Plugins hook into Retraceur to extend its functionality with custom features. Plugins are developed independently from the Retraceur software by thousands of developers all over the world.' ) . '</p>';
	$help .= '<p>' . esc_html__( 'You can find new plugins to install by searching or browsing the directory right here in your own plugins section.' );
}

$help .= ' <span id="live-search-desc" class="hide-if-no-js">' . __( 'The search results will be updated as you type.' ) . '</span></p>';

get_current_screen()->add_help_tab(
	array(
		'id'      => 'overview',
		'title'   => __( 'Overview' ),
		'content' => $help,
	)
);

unset( $help );

if ( 'block' === $plugin_type ) {
	$help_sidebar = array(
		_x( 'https://retraceur.github.io/administration/manage-blocks/', 'Block installation docs link' ) => __( 'Documentation on installing/updating a block' ),
	);

	get_current_screen()->set_help_sidebar( $help_sidebar );
	unset( $help_sidebar );
}

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
<div class="wrap plugin-install-tab-all">
<h1 class="wp-heading-inline">
<?php
echo esc_html( $title );
?>
</h1>

<hr class="wp-header-end">

<?php
$context_settings = array( 'name' => 'retraceur/discovery' );

if ( 'block' === $plugin_type ) {
	$context_settings['repositoryType'] = 'block';

} else {
	$context_settings['repositoryType'] = 'plugin';
}

$discovery_context = new WP_Block_Editor_Context( $context_settings );
$preload_paths     = array(
	'/wp/v2/discover/repositories?type=' . $plugin_type . '&page=1&per_page=10',
);

block_editor_rest_api_preload( $preload_paths, $discovery_context );
?>
	<div id="retraceur-discovery"></div>
	<span class="spinner"></span>
</div>

<?php
if ( 'block' !== $plugin_type ) {
	/**
	 * Fires after the plugins list table of the Install Plugins screen.
	 *
	 * @since WP 2.7.0
	 *
	 * @param int $paged The current page number of the plugins list table.
	 */
	do_action( 'install_plugins_all', 1 );

	foreach ( array( 'beta', 'favorites', 'featured', 'plugin-information', 'popular', 'recommended', 'search' ) as $tab ) {
		/**
		 * Fires after the plugins list table in each tab of the Install Plugins screen.
		 *
		 * The dynamic portion of the hook name, `$tab`, allows for targeting
		 * individual tabs.
		 *
		 * Possible hook names include:
		 *
		 *  - `install_plugins_beta`
		 *  - `install_plugins_favorites`
		 *  - `install_plugins_featured`
		 *  - `install_plugins_plugin-information`
		 *  - `install_plugins_popular`
		 *  - `install_plugins_recommended`
		 *  - `install_plugins_search`
		 *  - `install_plugins_upload`
		 *
		 * @since 2.7.0
		 * @deprecated 4.0.0 Retraceur fork.
		 */
		do_action_deprecated(
			"install_plugins_{$tab}",
			array( 1 ),
			'4.0.0',
			'',
			sprintf(
				/* translators: %s is the dynamic portion of the hook. */
				__( 'Retraceur Discover API is not firing the `install_plugins_%s` hook.' ),
				$tab
			)
		);
	}
}

wp_print_request_filesystem_credentials_modal();
wp_print_admin_notice_templates();

/**
 * Retraceur Administration Template Footer.
 */
require_once ABSPATH . 'wp-admin/admin-footer.php';
