<?php
/**
 * List Table API: WP_Plugin_Install_List_Table class.
 *
 * @since WP 3.1.0
 * @since 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Administration
 */

/**
 * Core class used to implement displaying plugins to install in a list table.
 *
 * @since WP 3.1.0
 *
 * @see WP_List_Table
 */
class WP_Plugin_Install_List_Table extends WP_List_Table {

	public $order   = 'ASC';
	public $orderby = null;
	public $groups  = array();

	private $error;

	/**
	 * @return bool
	 */
	public function ajax_user_can() {
		return current_user_can( 'install_plugins' );
	}

	/**
	 * Returns the list of known plugins.
	 *
	 * Uses the transient data from the updates API to determine the known
	 * installed plugins.
	 *
	 * @since WP 4.9.0
	 *
	 * @return array
	 */
	protected function get_installed_plugins() {
		$plugins = array();

		$plugin_info = get_site_transient( 'update_plugins' );
		if ( isset( $plugin_info->no_update ) ) {
			foreach ( $plugin_info->no_update as $plugin ) {
				if ( isset( $plugin->slug ) ) {
					$plugin->upgrade          = false;
					$plugins[ $plugin->slug ] = $plugin;
				}
			}
		}

		if ( isset( $plugin_info->response ) ) {
			foreach ( $plugin_info->response as $plugin ) {
				if ( isset( $plugin->slug ) ) {
					$plugin->upgrade          = true;
					$plugins[ $plugin->slug ] = $plugin;
				}
			}
		}

		return $plugins;
	}

	/**
	 * Returns a list of slugs of installed plugins, if known.
	 *
	 * Uses the transient data from the updates API to determine the slugs of
	 * known installed plugins. This might be better elsewhere, perhaps even
	 * within get_plugins().
	 *
	 * @since WP 4.0.0
	 *
	 * @return array
	 */
	protected function get_installed_plugin_slugs() {
		return array_keys( $this->get_installed_plugins() );
	}

	/**
	 * @global array  $tabs
	 * @global string $tab
	 * @global int    $paged
	 * @global string $type
	 * @global string $term
	 */
	public function prepare_items() {
		require_once ABSPATH . 'wp-admin/includes/plugin-install.php';

		global $tabs, $tab, $paged, $type, $term;

		$tab = ! empty( $_REQUEST['tab'] ) ? sanitize_text_field( $_REQUEST['tab'] ) : '';

		$paged = $this->get_pagenum();

		$per_page = 36;

		// These are the tabs which are shown on the page.
		$tabs = array(
			'all' => _x( 'All', 'Plugin Installer' ),
		);

		if ( 'search' === $tab ) {
			$tabs['search'] = __( 'Search Results' );
		}

		if ( current_user_can( 'upload_plugins' ) ) {
			/*
			 * No longer a real tab. Here for filter compatibility.
			 * Gets skipped in get_views().
			 */
			$tabs['upload'] = __( 'Upload Plugin' );
		}

		$nonmenu_tabs = array( 'plugin-information' ); // Valid actions to perform which do not have a Menu item.

		/**
		 * Filters the tabs shown on the Add Plugins screen.
		 *
		 * @since WP 2.7.0
		 *
		 * @param string[] $tabs The tabs shown on the Add Plugins screen. Defaults include
		 *                       'all', 'featured' and 'upload'.
		 */
		$tabs = apply_filters( 'install_plugins_tabs', $tabs );

		/**
		 * Filters tabs not associated with a menu item on the Add Plugins screen.
		 *
		 * @since WP 2.7.0
		 *
		 * @param string[] $nonmenu_tabs The tabs that don't have a menu item on the Add Plugins screen.
		 */
		$nonmenu_tabs = apply_filters( 'install_plugins_nonmenu_tabs', $nonmenu_tabs );

		// If a non-valid menu tab has been selected, And it's not a non-menu action.
		if ( empty( $tab ) || ( ! isset( $tabs[ $tab ] ) && ! in_array( $tab, (array) $nonmenu_tabs, true ) ) ) {
			$tab = key( $tabs );
		}

		$installed_plugins = $this->get_installed_plugins();

		$args = array(
			'page'     => $paged,
			'per_page' => $per_page,
		);

		switch ( $tab ) {
			case 'search':
				$type = isset( $_REQUEST['type'] ) ? wp_unslash( $_REQUEST['type'] ) : 'term';
				$term = isset( $_REQUEST['s'] ) ? wp_unslash( $_REQUEST['s'] ) : '';

				switch ( $type ) {
					case 'tag':
						$args['tag'] = sanitize_title_with_dashes( $term );
						break;
					case 'term':
						$args['search'] = $term;
						break;
					case 'author':
						$args['author'] = $term;
						break;
				}

				break;

			case 'all':
				$args['browse'] = $tab;
				break;

			default:
				$args = false;
				break;
		}

		/**
		 * Filters API request arguments for each Add Plugins screen tab.
		 *
		 * The dynamic portion of the hook name, `$tab`, refers to the plugin install tabs.
		 *
		 * Possible hook names include:
		 *
		 *  - `install_plugins_table_api_args_all`
		 *  - `install_plugins_table_api_args_upload`
		 *  - `install_plugins_table_api_args_search`
		 *
		 * @since WP 3.7.0
		 *
		 * @param array|false $args Plugin install API arguments.
		 */
		$args = apply_filters( "install_plugins_table_api_args_{$tab}", $args );

		if ( ! $args ) {
			return;
		}

		$api = retraceur_discovery_api( 'retraceur-' . $this->_args['singular'], $args );

		if ( is_wp_error( $api ) ) {
			$this->error = $api;
			return;
		}

		$this->items = $api['items'];

		if ( $this->orderby ) {
			uasort( $api['items'], array( $this, 'order_callback' ) );
		}

		$this->set_pagination_args(
			array(
				'total_items' => $api['total_count'],
				'per_page'    => $args['per_page'],
			)
		);

		if ( $installed_plugins ) {
			$js_plugins = array_fill_keys(
				array( 'all', 'search', 'active', 'inactive', 'recently_activated', 'mustuse', 'dropins' ),
				array()
			);

			$js_plugins['all'] = array_values( wp_list_pluck( $installed_plugins, 'plugin' ) );
			$upgrade_plugins   = wp_filter_object_list( $installed_plugins, array( 'upgrade' => true ), 'and', 'plugin' );

			if ( $upgrade_plugins ) {
				$js_plugins['upgrade'] = array_values( $upgrade_plugins );
			}

			wp_localize_script(
				'updates',
				'_wpUpdatesItemCounts',
				array(
					'plugins' => $js_plugins,
					'totals'  => wp_get_update_data(),
				)
			);
		}
	}

	/**
	 */
	public function no_items() {
		if ( isset( $this->error ) ) {
			$error_message  = '<p>' . $this->error->get_error_message() . '</p>';
			wp_admin_notice(
				$error_message,
				array(
					'additional_classes' => array( 'inline', 'error' ),
					'paragraph_wrap'     => false,
				)
			);
			?>
		<?php } else { ?>
			<div class="no-plugin-results">
				<?php
				if ( 'block' === $this->_args['singular'] ) {
					esc_html_e( 'No blocks found. Try a different search.' );
				} else {
					esc_html_e( 'No plugins found. Try a different search.' );
				}
				?>
			</div>
			<?php
		}
	}

	/**
	 * @global array $tabs
	 * @global string $tab
	 *
	 * @return array
	 */
	protected function get_views() {
		global $tabs, $tab;

		$display_tabs = array();
		foreach ( (array) $tabs as $action => $text ) {
			$display_tabs[ 'plugin-install-' . $action ] = array(
				'url'     => self_admin_url( $this->_args['singular'] . '-install.php?tab=' . $action ),
				'label'   => $text,
				'current' => $action === $tab,
			);
		}
		// No longer a real tab.
		unset( $display_tabs['plugin-install-upload'] );

		return $this->get_views_links( $display_tabs );
	}

	/**
	 * Overrides parent views so we can use the filter bar display.
	 */
	public function views() {
		$views = $this->get_views();

		/** This filter is documented in wp-admin/includes/class-wp-list-table.php */
		$views = apply_filters( "views_{$this->screen->id}", $views );

		$this->screen->render_screen_reader_content( 'heading_views' );

		if ( 'block-install' === $this->screen->id ) {
			echo '<p>' . esc_html__( 'Blocks are pieces of content of a post, page or template of your site. You may upload a block in .zip format by clicking the button at the top of this page.' ) . '</p>';
		} else {
			echo '<p>' . esc_html__( 'Plugins extend and expand the functionality of Retraceur. You may upload a plugin in .zip format by clicking the button at the top of this page.' ) . '</p>';
		}
		?>
<div class="wp-filter">
	<ul class="filter-links">
		<?php
		if ( ! empty( $views ) ) {
			foreach ( $views as $class => $view ) {
				$views[ $class ] = "\t<li class='$class'>$view";
			}
			echo implode( " </li>\n", $views ) . "</li>\n";
		}
		?>
	</ul>

		<?php
		$search_args = array(
			'plural'   => $this->_args['plural'],
			'singular' => $this->_args['singular'],
		);

		install_search_form( true, $search_args );
		?>
</div>
		<?php
	}

	/**
	 * Displays the plugin install table.
	 *
	 * Overrides the parent display() method to provide a different container.
	 *
	 * @since WP 4.0.0
	 */
	public function display() {
		$singular = $this->_args['singular'];

		$data_attr = '';

		if ( $singular ) {
			$data_attr = " data-wp-lists='list:$singular'";
		}

		$this->display_tablenav( 'top' );

		?>
<div class="wp-list-table <?php echo implode( ' ', $this->get_table_classes() ); ?>">
		<?php
		$this->screen->render_screen_reader_content( 'heading_list' );
		?>
	<div id="the-list"<?php echo $data_attr; ?>>
		<?php $this->display_rows_or_placeholder(); ?>
	</div>
</div>
		<?php
		$this->display_tablenav( 'bottom' );
	}

	/**
	 * @global string $tab
	 *
	 * @param string $which
	 */
	protected function display_tablenav( $which ) {
		if ( 'top' === $which ) {
			wp_referer_field();
			?>
			<div class="tablenav top">
				<div class="alignleft actions">
					<?php
					/**
					 * Fires before the Plugin Install table header pagination is displayed.
					 *
					 * @since WP 2.7.0
					 */
					do_action( 'install_plugins_table_header' );
					?>
				</div>
				<?php $this->pagination( $which ); ?>
				<br class="clear" />
			</div>
		<?php } else { ?>
			<div class="tablenav bottom">
				<?php $this->pagination( $which ); ?>
				<br class="clear" />
			</div>
			<?php
		}
	}

	/**
	 * @return array
	 */
	protected function get_table_classes() {
		return array( 'widefat', 'plugins' );
	}

	/**
	 * @return string[] Array of column titles keyed by their column name.
	 */
	public function get_columns() {
		return array();
	}

	/**
	 * @param object $plugin_a
	 * @param object $plugin_b
	 * @return int
	 */
	private function order_callback( $plugin_a, $plugin_b ) {
		$orderby = $this->orderby;
		if ( ! isset( $plugin_a->$orderby, $plugin_b->$orderby ) ) {
			return 0;
		}

		$a = $plugin_a->$orderby;
		$b = $plugin_b->$orderby;

		return 'DESC' === $this->order ?
			$b <=> $a :
			$a <=> $b;
	}

	/**
	 * Generates the list table rows.
	 *
	 * @since WP 3.1.0
	 */
	public function display_rows() {
		$plugins_allowedtags = array(
			'a'       => array(
				'href'   => array(),
				'title'  => array(),
				'target' => array(),
			),
			'abbr'    => array( 'title' => array() ),
			'acronym' => array( 'title' => array() ),
			'code'    => array(),
			'pre'     => array(),
			'em'      => array(),
			'strong'  => array(),
			'ul'      => array(),
			'ol'      => array(),
			'li'      => array(),
			'p'       => array(),
			'br'      => array(),
		);

		foreach ( (array) $this->items as $plugin ) {
			$title = wp_kses( $plugin['name'], $plugins_allowedtags );

			// Remove any HTML from the description.
			$description = strip_tags( $plugin['description'] );

			/**
			 * Filters the plugin card description on the Add Plugins screen.
			 *
			 * @since WP 6.0.0
			 *
			 * @param string $description Plugin card description.
			 * @param array  $plugin      An array of plugin data. See {@see plugins_api()}
			 *                            for the list of possible values.
			 */
			$description = apply_filters( 'plugin_install_description', $description, $plugin );
			$name        = strip_tags( $title );
			$author      = wp_kses( $plugin['owner']['login'], $plugins_allowedtags );

			if ( ! empty( $author ) ) {
				/* translators: %s: Plugin author name. */
				$author = ' <cite>' . sprintf( _x( 'By %s', 'plugin' ), $author ) . '</cite>';
			}

			$requires_php = $plugin['requires_php'] ?? null;
			$requires_wp  = $plugin['requires'] ?? null;
			$requires_r   = $plugin['requires_r'] ?? null;

			$compatible_php = is_php_version_compatible( $requires_php );
			$is_compatible  = is_wp_version_compatible( $requires_wp ) && is_retraceur_version_compatible( $requires_r );
			$tested_wp      = ( empty( $plugin['tested'] ) || version_compare( get_bloginfo( 'version' ), $plugin['tested'], '<=' ) );
			$tested_r       = ( empty( $plugin['tested_r'] ) || version_compare( get_bloginfo( 'version' ), $plugin['tested_r'], '<=' ) );

			$action_links = array();

			/*
			 @todo
			$action_links[] = wp_get_plugin_action_button( $name, $plugin );
			 */

			$details_link = self_admin_url(
				'plugin-install.php?tab=plugin-information&amp;plugin=' . $plugin['full_name'] .
				'&amp;TB_iframe=true&amp;width=600&amp;height=550'
			);

			$action_links[] = sprintf(
				'<a href="%s" class="thickbox open-plugin-details-modal" aria-label="%s" data-title="%s">%s</a>',
				esc_url( $details_link ),
				/* translators: %s: Plugin name. */
				esc_attr( sprintf( __( 'More information about %s' ), $name ) ),
				esc_attr( $name ),
				__( 'More Details' )
			);

			/**
			 * Filters the install action links for a plugin.
			 *
			 * @since WP 2.7.0
			 *
			 * @param string[] $action_links An array of plugin action links.
			 *                               Defaults are links to Details and Install Now.
			 * @param array    $plugin       An array of plugin data. See {@see plugins_api()}
			 *                               for the list of possible values.
			 */
			$action_links = apply_filters( 'plugin_install_action_links', $action_links, $plugin );

			$last_updated_timestamp = strtotime( $plugin['updated_at'] );
			?>
		<div class="plugin-card plugin-card-<?php echo sanitize_html_class( $plugin['full_name'] ); ?>">
			<div class="plugin-card-top">
				<div class="column-name">
					<h3>
						<a href="<?php echo esc_url( $details_link ); ?>" class="thickbox open-plugin-details-modal">
						<?php echo $title; ?>
						</a>
					</h3>
				</div>
				<div class="action-links">
					<?php
					if ( $action_links ) {
						echo '<ul class="plugin-action-buttons"><li>' . implode( '</li><li>', $action_links ) . '</li></ul>';
					}
					?>
				</div>
				<div class="column-description">
					<p><?php echo $description; ?></p>
					<p class="authors"><?php echo $author; ?></p>
				</div>
			</div>
			<div class="plugin-card-bottom">
				<div class="vers column-rating">
					<span class="num-ratings" aria-hidden="true">
						<?php
						echo esc_html(
							sprintf(
								/* translators: %s: Number of stargazers. */
								_n( '%s star', '%s stars', (int) $plugin['stargazers_count'] ),
								number_format_i18n( $plugin['stargazers_count'] )
							)
						);
						?>
					</span>
					&mdash;
					<span class="num-issues" aria-hidden="true">
						<?php
						echo esc_html(
							sprintf(
								/* translators: %s: Number of stargazers. */
								_n( '%s issue', '%s issues', (int) $plugin['open_issues_count'] ),
								number_format_i18n( $plugin['open_issues_count'] )
							)
						);
						?>
					</span>
				</div>
				<div class="column-updated">
					<strong><?php esc_html_e( 'Last Updated:' ); ?></strong>
					<?php
						/* translators: %s: Human-readable time difference. */
						printf( __( '%s ago' ), human_time_diff( $last_updated_timestamp ) );
					?>
				</div>
			</div>
		</div>
			<?php
		}

		// Close off the group divs of the last one.
		if ( ! empty( $group ) ) {
			echo '</div></div>';
		}
	}

	/**
	 * Returns a notice containing a list of dependencies required by the plugin.
	 *
	 * @since WP 6.5.0
	 *
	 * @param array  $plugin_data An array of plugin data. See {@see plugins_api()}
	 *                            for the list of possible values.
	 * @return string A notice containing a list of dependencies required by the plugin,
	 *                or an empty string if none is required.
	 */
	protected function get_dependencies_notice( $plugin_data ) {
		if ( empty( $plugin_data['requires_plugins'] ) ) {
			return '';
		}

		$no_name_markup  = '<div class="plugin-dependency"><span class="plugin-dependency-name">%s</span></div>';
		$has_name_markup = '<div class="plugin-dependency"><span class="plugin-dependency-name">%s</span> %s</div>';

		$dependencies_list = '';
		foreach ( $plugin_data['requires_plugins'] as $dependency ) {
			$dependency_data = WP_Plugin_Dependencies::get_dependency_data( $dependency );

			if (
				false !== $dependency_data &&
				! empty( $dependency_data['name'] ) &&
				! empty( $dependency_data['slug'] ) &&
				! empty( $dependency_data['version'] )
			) {
				$more_details_link  = $this->get_more_details_link( $dependency_data['name'], $dependency_data['slug'] );
				$dependencies_list .= sprintf( $has_name_markup, esc_html( $dependency_data['name'] ), $more_details_link );
				continue;
			}

			$result = plugins_api( 'plugin_information', array( 'slug' => $dependency ) );

			if ( ! empty( $result->name ) ) {
				$more_details_link  = $this->get_more_details_link( $result->name, $result->slug );
				$dependencies_list .= sprintf( $has_name_markup, esc_html( $result->name ), $more_details_link );
				continue;
			}

			$dependencies_list .= sprintf( $no_name_markup, esc_html( $dependency ) );
		}

		$dependencies_notice = sprintf(
			'<div class="plugin-dependencies notice notice-alt notice-info inline"><p class="plugin-dependencies-explainer-text">%s</p> %s</div>',
			'<strong>' . __( 'Additional plugins are required' ) . '</strong>',
			$dependencies_list
		);

		return $dependencies_notice;
	}

	/**
	 * Creates a 'More details' link for the plugin.
	 *
	 * @since WP 6.5.0
	 *
	 * @param string $name The plugin's name.
	 * @param string $slug The plugin's slug.
	 * @return string The 'More details' link for the plugin.
	 */
	protected function get_more_details_link( $name, $slug ) {
		$url = add_query_arg(
			array(
				'tab'       => 'plugin-information',
				'plugin'    => $slug,
				'TB_iframe' => 'true',
				'width'     => '600',
				'height'    => '550',
			),
			network_admin_url( 'plugin-install.php' )
		);

		$more_details_link = sprintf(
			'<a href="%1$s" class="more-details-link thickbox open-plugin-details-modal" aria-label="%2$s" data-title="%3$s">%4$s</a>',
			esc_url( $url ),
			/* translators: %s: Plugin name. */
			sprintf( __( 'More information about %s' ), esc_html( $name ) ),
			esc_attr( $name ),
			__( 'More Details' )
		);

		return $more_details_link;
	}
}
