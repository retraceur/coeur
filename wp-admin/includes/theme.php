<?php
/**
 * Retraceur Theme Administration API.
 *
 * @since 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Administration
 */

/**
 * Removes a theme.
 *
 * @since WP 2.8.0
 *
 * @global WP_Filesystem_Base $wp_filesystem WP filesystem subclass.
 *
 * @param string $stylesheet Stylesheet of the theme to delete.
 * @param string $redirect   Redirect to page when complete.
 * @return bool|null|WP_Error True on success, false if `$stylesheet` is empty, WP_Error on failure.
 *                            Null if filesystem credentials are required to proceed.
 */
function delete_theme( $stylesheet, $redirect = '' ) {
	global $wp_filesystem;

	if ( empty( $stylesheet ) ) {
		return false;
	}

	if ( empty( $redirect ) ) {
		$redirect = wp_nonce_url( 'themes.php?action=delete&stylesheet=' . urlencode( $stylesheet ), 'delete-theme_' . $stylesheet );
	}

	ob_start();
	$credentials = request_filesystem_credentials( $redirect );
	$data        = ob_get_clean();

	if ( false === $credentials ) {
		if ( ! empty( $data ) ) {
			require_once ABSPATH . 'wp-admin/admin-header.php';
			echo $data;
			require_once ABSPATH . 'wp-admin/admin-footer.php';
			exit;
		}
		return;
	}

	if ( ! WP_Filesystem( $credentials ) ) {
		ob_start();
		// Failed to connect. Error and request again.
		request_filesystem_credentials( $redirect, '', true );
		$data = ob_get_clean();

		if ( ! empty( $data ) ) {
			require_once ABSPATH . 'wp-admin/admin-header.php';
			echo $data;
			require_once ABSPATH . 'wp-admin/admin-footer.php';
			exit;
		}
		return;
	}

	if ( ! is_object( $wp_filesystem ) ) {
		return new WP_Error( 'fs_unavailable', __( 'Could not access filesystem.' ) );
	}

	if ( is_wp_error( $wp_filesystem->errors ) && $wp_filesystem->errors->has_errors() ) {
		return new WP_Error( 'fs_error', __( 'Filesystem error.' ), $wp_filesystem->errors );
	}

	// Get the base theme folder.
	$themes_dir = $wp_filesystem->wp_themes_dir();
	if ( empty( $themes_dir ) ) {
		return new WP_Error( 'fs_no_themes_dir', __( 'Unable to locate Retraceur theme directory.' ) );
	}

	/**
	 * Fires immediately before a theme deletion attempt.
	 *
	 * @since WP 5.8.0
	 *
	 * @param string $stylesheet Stylesheet of the theme to delete.
	 */
	do_action( 'delete_theme', $stylesheet );

	$theme = wp_get_theme( $stylesheet );

	$themes_dir = trailingslashit( $themes_dir );
	$theme_dir  = trailingslashit( $themes_dir . $stylesheet );
	$deleted    = $wp_filesystem->delete( $theme_dir, true );

	/**
	 * Fires immediately after a theme deletion attempt.
	 *
	 * @since WP 5.8.0
	 *
	 * @param string $stylesheet Stylesheet of the theme to delete.
	 * @param bool   $deleted    Whether the theme deletion was successful.
	 */
	do_action( 'deleted_theme', $stylesheet, $deleted );

	if ( ! $deleted ) {
		return new WP_Error(
			'could_not_remove_theme',
			/* translators: %s: Theme name. */
			sprintf( __( 'Could not fully remove the theme %s.' ), $stylesheet )
		);
	}

	$theme_translations = wp_get_installed_translations( 'themes' );

	// Remove language files, silently.
	if ( ! empty( $theme_translations[ $stylesheet ] ) ) {
		$translations = $theme_translations[ $stylesheet ];

		foreach ( $translations as $translation => $data ) {
			$wp_filesystem->delete( WP_LANG_DIR . '/themes/' . $stylesheet . '-' . $translation . '.po' );
			$wp_filesystem->delete( WP_LANG_DIR . '/themes/' . $stylesheet . '-' . $translation . '.mo' );
			$wp_filesystem->delete( WP_LANG_DIR . '/themes/' . $stylesheet . '-' . $translation . '.l10n.php' );

			$json_translation_files = glob( WP_LANG_DIR . '/themes/' . $stylesheet . '-' . $translation . '-*.json' );
			if ( $json_translation_files ) {
				array_map( array( $wp_filesystem, 'delete' ), $json_translation_files );
			}
		}
	}

	// Remove the theme from allowed themes on the network.
	if ( is_multisite() ) {
		WP_Theme::network_disable_theme( $stylesheet );
	}

	// Clear theme caches.
	$theme->cache_delete();

	// Force refresh of theme update information.
	delete_site_transient( 'update_themes' );

	return true;
}

/**
 * Gets the page templates available in this theme.
 *
 * @since WP 1.5.0
 * @since WP 4.7.0 Added the `$post_type` parameter.
 *
 * @param WP_Post|null $post      Optional. The post being edited, provided for context.
 * @param string       $post_type Optional. Post type to get the templates for. Default 'page'.
 * @return string[] Array of template file names keyed by the template header name.
 */
function get_page_templates( $post = null, $post_type = 'page' ) {
	return array_flip( wp_get_theme()->get_page_templates( $post, $post_type ) );
}

/**
 * Tidies a filename for url display by the theme file editor.
 *
 * @since WP 2.9.0
 * @access private
 *
 * @param string $fullpath Full path to the theme file
 * @param string $containingfolder Path of the theme parent folder
 * @return string
 */
function _get_template_edit_filename( $fullpath, $containingfolder ) {
	return str_replace( dirname( $containingfolder, 2 ), '', $fullpath );
}

/**
 * Check if there is an update for a theme available.
 *
 * Will display link, if there is an update available.
 *
 * @since WP 2.7.0
 *
 * @see get_theme_update_available()
 *
 * @param WP_Theme $theme Theme data object.
 */
function theme_update_available( $theme ) {
	echo get_theme_update_available( $theme );
}

/**
 * Retrieves the update link if there is a theme update available.
 *
 * Will return a link if there is an update available.
 *
 * @since WP 3.8.0
 *
 * @param WP_Theme $theme WP_Theme object.
 * @return string|false HTML for the update link, or false if invalid info was passed.
 */
function get_theme_update_available( $theme ) {
	static $themes_update = null;

	if ( ! current_user_can( 'update_themes' ) ) {
		return false;
	}

	if ( ! isset( $themes_update ) ) {
		$themes_update = get_site_transient( 'update_themes' );
	}

	if ( ! ( $theme instanceof WP_Theme ) ) {
		return false;
	}

	$stylesheet = $theme->get_stylesheet();

	$html = '';

	if ( isset( $themes_update->response[ $stylesheet ] ) ) {
		$update      = $themes_update->response[ $stylesheet ];
		$theme_name  = $theme->display( 'Name' );
		$details_url = add_query_arg(
			array(
				'TB_iframe' => 'true',
				'width'     => 1024,
				'height'    => 800,
			),
			$update['url']
		); // Theme browser inside WP? Replace this. Also, theme preview JS will override this on the available list.
		$update_url  = wp_nonce_url( admin_url( 'update.php?action=upgrade-theme&amp;theme=' . urlencode( $stylesheet ) ), 'upgrade-theme_' . $stylesheet );

		if ( ! is_multisite() ) {
			if ( ! current_user_can( 'update_themes' ) ) {
				$html = sprintf(
					/* translators: 1: Theme name, 2: Theme details URL, 3: Additional link attributes, 4: Version number. */
					'<p><strong>' . _x( 'There is a new version of %1$s available. <a href="%2$s" %3$s>View version %4$s details</a>.', 'theme' ) . '</strong></p>',
					$theme_name,
					esc_url( $details_url ),
					sprintf(
						'class="thickbox open-plugin-details-modal" aria-label="%s"',
						/* translators: 1: Theme name, 2: Version number. */
						esc_attr( sprintf( _x( 'View %1$s version %2$s details', 'theme' ), $theme_name, $update['new_version'] ) )
					),
					$update['new_version']
				);
			} elseif ( empty( $update['package'] ) ) {
				$html = sprintf(
					/* translators: 1: Theme name, 2: Theme details URL, 3: Additional link attributes, 4: Version number. */
					'<p><strong>' . _x( 'There is a new version of %1$s available. <a href="%2$s" %3$s>View version %4$s details</a>. <em>Automatic update is unavailable for this theme.</em>', 'theme' ) . '</strong></p>',
					$theme_name,
					esc_url( $details_url ),
					sprintf(
						'class="thickbox open-plugin-details-modal" aria-label="%s"',
						/* translators: 1: Theme name, 2: Version number. */
						esc_attr( sprintf( _x( 'View %1$s version %2$s details', 'theme' ), $theme_name, $update['new_version'] ) )
					),
					$update['new_version']
				);
			} else {
				$html = sprintf(
					/* translators: 1: Theme name, 2: Theme details URL, 3: Additional link attributes, 4: Version number, 5: Update URL, 6: Additional link attributes. */
					'<p><strong>' . _x( 'There is a new version of %1$s available. <a href="%2$s" %3$s>View version %4$s details</a> or <a href="%5$s" %6$s>update now</a>.', 'theme' ) . '</strong></p>',
					$theme_name,
					esc_url( $details_url ),
					sprintf(
						'class="thickbox open-plugin-details-modal" aria-label="%s"',
						/* translators: 1: Theme name, 2: Version number. */
						esc_attr( sprintf( _x( 'View %1$s version %2$s details', 'theme' ), $theme_name, $update['new_version'] ) )
					),
					$update['new_version'],
					$update_url,
					sprintf(
						'aria-label="%s" id="update-theme" data-slug="%s"',
						/* translators: %s: Theme name. */
						esc_attr( sprintf( _x( 'Update %s now', 'theme' ), $theme_name ) ),
						$stylesheet
					)
				);
			}
		}
	}

	return $html;
}

/**
 * Retrieves list of Retraceur theme features (aka theme tags).
 *
 * @since WP 3.1.0
 * @since WP 3.2.0 Added 'Gray' color and 'Featured Image Header', 'Featured Images',
 *              'Full Width Template', and 'Post Formats' features.
 * @since WP 3.5.0 Added 'Flexible Header' feature.
 * @since WP 3.8.0 Renamed 'Width' filter to 'Layout'.
 * @since WP 3.8.0 Renamed 'Fixed Width' and 'Flexible Width' options
 *              to 'Fixed Layout' and 'Fluid Layout'.
 * @since WP 3.8.0 Added 'Accessibility Ready' feature and 'Responsive Layout' option.
 * @since WP 3.9.0 Combined 'Layout' and 'Columns' filters.
 * @since WP 4.6.0 Removed 'Colors' filter.
 * @since WP 4.6.0 Added 'Grid Layout' option.
 *              Removed 'Fixed Layout', 'Fluid Layout', and 'Responsive Layout' options.
 * @since WP 4.6.0 Added 'Custom Logo' and 'Footer Widgets' features.
 *              Removed 'Blavatar' feature.
 * @since WP 4.6.0 Added 'Blog', 'E-Commerce', 'Education', 'Entertainment', 'Food & Drink',
 *              'Holiday', 'News', 'Photography', and 'Portfolio' subjects.
 *              Removed 'Photoblogging' and 'Seasonal' subjects.
 * @since WP 4.9.0 Reordered the filters from 'Layout', 'Features', 'Subject'
 *              to 'Subject', 'Features', 'Layout'.
 * @since WP 4.9.0 Removed 'BuddyPress', 'Custom Menu', 'Flexible Header',
 *              'Front Page Posting', 'Microformats', 'RTL Language Support',
 *              'Threaded Comments', and 'Translation Ready' features.
 * @since WP 5.5.0 Added 'Block Editor Patterns', 'Block Editor Styles',
 *              and 'Full Site Editing' features.
 * @since WP 5.5.0 Added 'Wide Blocks' layout option.
 * @since WP 5.8.1 Added 'Template Editing' feature.
 * @since WP 6.1.1 Replaced 'Full Site Editing' feature name with 'Site Editor'.
 * @since WP 6.2.0 Added 'Style Variations' feature.
 * @since 1.0.0    Retraceur: remove the WP API requesting part.
 *
 * @return array Array of features keyed by category with translations keyed by slug.
 */
function get_theme_feature_list() {
	// Hard-coded list.
	$features = array(

		__( 'Subject' )  => array(
			'blog'           => __( 'Blog' ),
			'e-commerce'     => __( 'E-Commerce' ),
			'education'      => __( 'Education' ),
			'entertainment'  => __( 'Entertainment' ),
			'food-and-drink' => __( 'Food & Drink' ),
			'holiday'        => __( 'Holiday' ),
			'news'           => __( 'News' ),
			'photography'    => __( 'Photography' ),
			'portfolio'      => __( 'Portfolio' ),
		),

		__( 'Features' ) => array(
			'accessibility-ready'   => __( 'Accessibility Ready' ),
			'block-patterns'        => __( 'Block Editor Patterns' ),
			'block-styles'          => __( 'Block Editor Styles' ),
			'custom-background'     => __( 'Custom Background' ),
			'custom-colors'         => __( 'Custom Colors' ),
			'custom-header'         => __( 'Custom Header' ),
			'custom-logo'           => __( 'Custom Logo' ),
			'editor-style'          => __( 'Editor Style' ),
			'featured-image-header' => __( 'Featured Image Header' ),
			'featured-images'       => __( 'Featured Images' ),
			'full-site-editing'     => __( 'Site Editor' ),
			'full-width-template'   => __( 'Full Width Template' ),
			'post-formats'          => __( 'Post Formats' ),
			'sticky-post'           => __( 'Sticky Post' ),
			'style-variations'      => __( 'Style Variations' ),
			'template-editing'      => __( 'Template Editing' ),
			'theme-options'         => __( 'Theme Options' ),
		),

		__( 'Layout' )   => array(
			'grid-layout'   => __( 'Grid Layout' ),
			'one-column'    => __( 'One Column' ),
			'two-columns'   => __( 'Two Columns' ),
			'three-columns' => __( 'Three Columns' ),
			'four-columns'  => __( 'Four Columns' ),
			'left-sidebar'  => __( 'Left Sidebar' ),
			'right-sidebar' => __( 'Right Sidebar' ),
			'wide-blocks'   => __( 'Wide Blocks' ),
		),

	);

	return $features;
}

/**
 * Retrieves theme installer pages.
 *
 * It is possible for a theme to override the Themes API result with three
 * filters. Assume this is for themes, which can extend on the Theme Info to
 * offer more choices. This is very powerful and must be used with care, when
 * overriding the filters.
 *
 * The first filter, {@see 'themes_api_args'}, is for the args and gives the action
 * as the second parameter. The hook for {@see 'themes_api_args'} must ensure that
 * an object is returned.
 *
 * The second filter, {@see 'themes_api'}, allows a plugin to override the Theme API entirely
 * If `$action` is 'query_themes', 'theme_information', or 'feature_list', an object MUST be
 * passed. If `$action` is 'hot_tags', an array should be passed.
 *
 * Finally, the third filter, {@see 'themes_api_result'}, makes it possible to filter the
 * response object or array, depending on the `$action` type.
 *
 * Supported arguments per action:
 *
 * | Argument Name      | 'query_themes' | 'theme_information' | 'hot_tags' | 'feature_list'   |
 * | -------------------| :------------: | :-----------------: | :--------: | :--------------: |
 * | `$slug`            | No             |  Yes                | No         | No               |
 * | `$per_page`        | Yes            |  No                 | No         | No               |
 * | `$page`            | Yes            |  No                 | No         | No               |
 * | `$number`          | No             |  No                 | Yes        | No               |
 * | `$search`          | Yes            |  No                 | No         | No               |
 * | `$tag`             | Yes            |  No                 | No         | No               |
 * | `$author`          | Yes            |  No                 | No         | No               |
 * | `$user`            | Yes            |  No                 | No         | No               |
 * | `$browse`          | Yes            |  No                 | No         | No               |
 * | `$locale`          | Yes            |  Yes                | No         | No               |
 * | `$fields`          | Yes            |  Yes                | No         | No               |
 *
 * @since WP 2.8.0
 *
 * @param string       $action API action to perform: Accepts 'query_themes', 'theme_information',
 *                             'hot_tags' or 'feature_list'.
 * @param array|object $args   {
 *     Optional. Array or object of arguments to serialize for the Themes API. Default empty array.
 *
 *     @type string  $slug     The theme slug. Default empty.
 *     @type int     $per_page Number of themes per page. Default 24.
 *     @type int     $page     Number of current page. Default 1.
 *     @type int     $number   Number of tags to be queried.
 *     @type string  $search   A search term. Default empty.
 *     @type string  $tag      Tag to filter themes. Default empty.
 *     @type string  $author   Username of an author to filter themes. Default empty.
 *     @type string  $user     Username to query for their favorites. Default empty.
 *     @type string  $browse   Browse view: 'featured', 'popular', 'updated', 'favorites'.
 *     @type string  $locale   Locale to provide context-sensitive results. Default is the value of get_locale().
 *     @type array   $fields   {
 *         Array of fields which should or should not be returned.
 *
 *         @type bool $description        Whether to return the theme full description. Default false.
 *         @type bool $sections           Whether to return the theme readme sections: description, installation,
 *                                        FAQ, screenshots, other notes, and changelog. Default false.
 *         @type bool $rating             Whether to return the rating in percent and total number of ratings.
 *                                        Default false.
 *         @type bool $ratings            Whether to return the number of rating for each star (1-5). Default false.
 *         @type bool $downloaded         Whether to return the download count. Default false.
 *         @type bool $downloadlink       Whether to return the download link for the package. Default false.
 *         @type bool $last_updated       Whether to return the date of the last update. Default false.
 *         @type bool $tags               Whether to return the assigned tags. Default false.
 *         @type bool $homepage           Whether to return the theme homepage link. Default false.
 *         @type bool $screenshots        Whether to return the screenshots. Default false.
 *         @type int  $screenshot_count   Number of screenshots to return. Default 1.
 *         @type bool $screenshot_url     Whether to return the URL of the first screenshot. Default false.
 *         @type bool $photon_screenshots Whether to return the screenshots via Photon. Default false.
 *         @type bool $template           Whether to return the slug of the parent theme. Default false.
 *         @type bool $parent             Whether to return the slug, name and homepage of the parent theme. Default false.
 *         @type bool $versions           Whether to return the list of all available versions. Default false.
 *         @type bool $theme_url          Whether to return theme's URL. Default false.
 *         @type bool $extended_author    Whether to return nicename or nicename and display name. Default false.
 *     }
 * }
 * @return object|array|WP_Error Response object or array on success, WP_Error on failure.
 */
function themes_api( $action, $args = array() ) {
	if ( is_array( $args ) ) {
		$args = (object) $args;
	}

	if ( 'query_themes' === $action ) {
		if ( ! isset( $args->per_page ) ) {
			$args->per_page = 24;
		}
	}

	if ( ! isset( $args->locale ) ) {
		$args->locale = get_user_locale();
	}

	if ( ! isset( $args->wp_version ) ) {
		$args->wp_version = substr( wp_get_wp_version(), 0, 3 ); // x.y
	}

	if ( ! isset( $args->retraceur_version ) ) {
		$args->retraceur_version = substr( retraceur_get_version(), 0, 5 ); // x.y
	}

	/**
	 * Filters arguments used to query for installer pages from the Themes API.
	 *
	 * Important: An object MUST be returned to this filter.
	 *
	 * @since WP 2.8.0
	 *
	 * @param object $args   Arguments used to query for installer pages from the Themes API.
	 * @param string $action Requested action. Likely values are 'theme_information',
	 *                       'feature_list', or 'query_themes'.
	 */
	$args = apply_filters( 'themes_api_args', $args, $action );

	/**
	 * Filters whether to override the Themes API.
	 *
	 * Returning a non-false value will effectively short-circuit the API request.
	 *
	 * If `$action` is 'query_themes', 'theme_information', or 'feature_list', an object MUST
	 * be passed. If `$action` is 'hot_tags', an array should be passed.
	 *
	 * @since WP 2.8.0
	 *
	 * @param false|object|array $override Whether to override the Themes API. Default false.
	 * @param string             $action   Requested action. Likely values are 'theme_information',
	 *                                    'feature_list', or 'query_themes'.
	 * @param object             $args     Arguments used to query for installer pages from the Themes API.
	 */
	$res = apply_filters( 'themes_api', false, $action, $args );

	if ( ! $res ) {
		return new WP_Error( 'themes_api_disabled', __( 'Retraceur does not provide a Theme Installation API.' ) );

		// @todo use GitHub instead
		$url = '';
		$url = add_query_arg(
			array(
				'action'  => $action,
				'request' => $args,
			),
			$url
		);

		$http_url = $url;
		$ssl      = wp_http_supports( array( 'ssl' ) );
		if ( $ssl ) {
			$url = set_url_scheme( $url, 'https' );
		}

		$http_args = array(
			'timeout'    => 15,
			'user-agent' => 'Retraceur/' . retraceur_get_version() . '; ' . home_url( '/' ),
		);
		$request   = wp_remote_get( $url, $http_args );

		if ( $ssl && is_wp_error( $request ) ) {
			if ( ! wp_doing_ajax() ) {
				wp_trigger_error(
					__FUNCTION__,
					__( 'An unexpected error occurred. Something may be wrong with this server&#8217;s configuration.' ) . ' ' . __( '(Retraceur could not establish a secure connection to Theme Installation API. Please contact your server administrator.)' ),
					headers_sent() || WP_DEBUG ? E_USER_WARNING : E_USER_NOTICE
				);
			}
			$request = wp_remote_get( $http_url, $http_args );
		}

		if ( is_wp_error( $request ) ) {
			$res = new WP_Error(
				'themes_api_failed',
				__( 'An unexpected error occurred. Something may be wrong with this server&#8217;s configuration.' ),
				$request->get_error_message()
			);
		} else {
			$res = json_decode( wp_remote_retrieve_body( $request ), true );
			if ( is_array( $res ) ) {
				// Object casting is required in order to match the info/1.0 format.
				$res = (object) $res;
			} elseif ( null === $res ) {
				$res = new WP_Error(
					'themes_api_failed',
					__( 'An unexpected error occurred. Something may be wrong with this server&#8217;s configuration.' ),
					wp_remote_retrieve_body( $request )
				);
			}

			if ( isset( $res->error ) ) {
				$res = new WP_Error( 'themes_api_failed', $res->error );
			}
		}

		if ( ! is_wp_error( $res ) ) {
			// Back-compat for info/1.2 API, upgrade the theme objects in query_themes to objects.
			if ( 'query_themes' === $action ) {
				foreach ( $res->themes as $i => $theme ) {
					$res->themes[ $i ] = (object) $theme;
				}
			}

			// Back-compat for info/1.2 API, downgrade the feature_list result back to an array.
			if ( 'feature_list' === $action ) {
				$res = (array) $res;
			}
		}
	}

	/**
	 * Filters the returned Themes API response.
	 *
	 * @since WP 2.8.0
	 *
	 * @param array|stdClass|WP_Error $res    Themes API response.
	 * @param string                  $action Requested action. Likely values are 'theme_information',
	 *                                        'feature_list', or 'query_themes'.
	 * @param stdClass                $args   Arguments used to query for installer pages from the Themes API.
	 */
	return apply_filters( 'themes_api_result', $res, $action, $args );
}

/**
 * Prepares themes for JavaScript.
 *
 * @since WP 3.8.0
 *
 * @param WP_Theme[] $themes Optional. Array of theme objects to prepare.
 *                           Defaults to all allowed themes.
 *
 * @return array An associative array of theme data, sorted by name.
 */
function wp_prepare_themes_for_js( $themes = null ) {
	$current_theme = get_stylesheet();

	/**
	 * Filters theme data before it is prepared for JavaScript.
	 *
	 * Passing a non-empty array will result in wp_prepare_themes_for_js() returning
	 * early with that value instead.
	 *
	 * @since WP 4.2.0
	 *
	 * @param array           $prepared_themes An associative array of theme data. Default empty array.
	 * @param WP_Theme[]|null $themes          An array of theme objects to prepare, if any.
	 * @param string          $current_theme   The active theme slug.
	 */
	$prepared_themes = (array) apply_filters( 'pre_prepare_themes_for_js', array(), $themes, $current_theme );

	if ( ! empty( $prepared_themes ) ) {
		return $prepared_themes;
	}

	// Make sure the active theme is listed first.
	$prepared_themes[ $current_theme ] = array();

	if ( null === $themes ) {
		$themes = wp_get_themes( array( 'allowed' => true ) );
		if ( ! isset( $themes[ $current_theme ] ) ) {
			$themes[ $current_theme ] = wp_get_theme();
		}
	}

	$updates    = array();
	$no_updates = array();
	if ( ! is_multisite() && current_user_can( 'update_themes' ) ) {
		$updates_transient = get_site_transient( 'update_themes' );
		if ( isset( $updates_transient->response ) ) {
			$updates = $updates_transient->response;
		}
		if ( isset( $updates_transient->no_update ) ) {
			$no_updates = $updates_transient->no_update;
		}
	}

	WP_Theme::sort_by_name( $themes );

	$parents = array();

	$auto_updates = (array) get_site_option( 'auto_update_themes', array() );

	foreach ( $themes as $theme ) {
		$slug         = $theme->get_stylesheet();
		$encoded_slug = urlencode( $slug );

		$parent = false;
		if ( $theme->parent() ) {
			$parent           = $theme->parent();
			$parents[ $slug ] = $parent->get_stylesheet();
			$parent           = $parent->display( 'Name' );
		}

		$customize_action = null;

		$can_edit_theme_options = current_user_can( 'edit_theme_options' );
		$is_block_theme         = $theme->is_block_theme();

		if ( $is_block_theme && $can_edit_theme_options ) {
			$customize_action = admin_url( 'site-editor.php' );
			if ( $current_theme !== $slug ) {
				$customize_action = add_query_arg( 'wp_theme_preview', $slug, $customize_action );
			}

			$customize_action = add_query_arg(
				array(
					'return' => urlencode( sanitize_url( remove_query_arg( wp_removable_query_args(), wp_unslash( $_SERVER['REQUEST_URI'] ) ) ) ),
				),
				$customize_action
			);
			$customize_action = esc_url( $customize_action );
		}

		$update_requires_wp  = isset( $updates[ $slug ]['requires'] ) ? $updates[ $slug ]['requires'] : null;
		$update_requires_php = isset( $updates[ $slug ]['requires_php'] ) ? $updates[ $slug ]['requires_php'] : null;

		$auto_update        = in_array( $slug, $auto_updates, true );
		$auto_update_action = $auto_update ? 'disable-auto-update' : 'enable-auto-update';

		if ( isset( $updates[ $slug ] ) ) {
			$auto_update_supported      = true;
			$auto_update_filter_payload = (object) $updates[ $slug ];
		} elseif ( isset( $no_updates[ $slug ] ) ) {
			$auto_update_supported      = true;
			$auto_update_filter_payload = (object) $no_updates[ $slug ];
		} else {
			$auto_update_supported = false;
			/*
			 * Create the expected payload for the auto_update_theme filter, this is the same data
			 * as contained within $updates or $no_updates but used when the Theme is not known.
			 */
			$auto_update_filter_payload = (object) array(
				'theme'        => $slug,
				'new_version'  => $theme->get( 'Version' ),
				'url'          => '',
				'package'      => '',
				'requires'     => $theme->get( 'RequiresR' ),
				'requires_php' => $theme->get( 'RequiresPHP' ),
			);
		}

		$auto_update_forced = wp_is_auto_update_forced_for_item( 'theme', null, $auto_update_filter_payload );

		$prepared_themes[ $slug ] = array(
			'id'             => $slug,
			'name'           => $theme->display( 'Name' ),
			'screenshot'     => array( $theme->get_screenshot() ), // @todo Multiple screenshots.
			'description'    => $theme->display( 'Description' ),
			'author'         => $theme->display( 'Author', false, true ),
			'authorAndUri'   => $theme->display( 'Author' ),
			'tags'           => $theme->display( 'Tags' ),
			'version'        => $theme->get( 'Version' ),
			'compatibleWP'   => is_wp_version_compatible( $theme->get( 'RequiresR' ) ),
			'compatiblePHP'  => is_php_version_compatible( $theme->get( 'RequiresPHP' ) ),
			'updateResponse' => array(
				'compatibleWP'  => is_wp_version_compatible( $update_requires_wp ),
				'compatiblePHP' => is_php_version_compatible( $update_requires_php ),
			),
			'parent'         => $parent,
			'active'         => $slug === $current_theme,
			'hasUpdate'      => isset( $updates[ $slug ] ),
			'hasPackage'     => isset( $updates[ $slug ] ) && ! empty( $updates[ $slug ]['package'] ),
			'update'         => get_theme_update_available( $theme ),
			'autoupdate'     => array(
				'enabled'   => $auto_update || $auto_update_forced,
				'supported' => $auto_update_supported,
				'forced'    => $auto_update_forced,
			),
			'actions'        => array(
				'activate'   => current_user_can( 'switch_themes' ) ? wp_nonce_url( admin_url( 'themes.php?action=activate&amp;stylesheet=' . $encoded_slug ), 'switch-theme_' . $slug ) : null,
				'customize'  => $customize_action,
				'delete'     => ( ! is_multisite() && current_user_can( 'delete_themes' ) ) ? wp_nonce_url( admin_url( 'themes.php?action=delete&amp;stylesheet=' . $encoded_slug ), 'delete-theme_' . $slug ) : null,
				'autoupdate' => wp_is_auto_update_enabled_for_type( 'theme' ) && ! is_multisite() && current_user_can( 'update_themes' )
					? wp_nonce_url( admin_url( 'themes.php?action=' . $auto_update_action . '&amp;stylesheet=' . $encoded_slug ), 'updates' )
					: null,
			),
			'blockTheme'     => $theme->is_block_theme(),
		);
	}

	// Remove 'delete' action if theme has an active child.
	if ( ! empty( $parents ) && array_key_exists( $current_theme, $parents ) ) {
		unset( $prepared_themes[ $parents[ $current_theme ] ]['actions']['delete'] );
	}

	/**
	 * Filters the themes prepared for JavaScript, for themes.php.
	 *
	 * Could be useful for changing the order, which is by name by default.
	 *
	 * @since WP 3.8.0
	 *
	 * @param array $prepared_themes Array of theme data.
	 */
	$prepared_themes = apply_filters( 'wp_prepare_themes_for_js', $prepared_themes );
	$prepared_themes = array_values( $prepared_themes );
	return array_filter( $prepared_themes );
}

/**
 * Prints JS templates for the theme-browsing UI in the Customizer.
 *
 * @since WP 4.2.0
 */
function customize_themes_print_templates() {
	?>
	<script type="text/html" id="tmpl-customize-themes-details-view">
		<div class="theme-backdrop"></div>
		<div class="theme-wrap wp-clearfix" role="document">
			<div class="theme-header">
				<button type="button" class="left dashicons dashicons-no"><span class="screen-reader-text">
					<?php
					/* translators: Hidden accessibility text. */
					_e( 'Show previous theme' );
					?>
				</span></button>
				<button type="button" class="right dashicons dashicons-no"><span class="screen-reader-text">
					<?php
					/* translators: Hidden accessibility text. */
					_e( 'Show next theme' );
					?>
				</span></button>
				<button type="button" class="close dashicons dashicons-no"><span class="screen-reader-text">
					<?php
					/* translators: Hidden accessibility text. */
					_e( 'Close details dialog' );
					?>
				</span></button>
			</div>
			<div class="theme-about wp-clearfix">
				<div class="theme-screenshots">
				<# if ( data.screenshot && data.screenshot[0] ) { #>
					<div class="screenshot"><img src="{{ data.screenshot[0] }}?ver={{ data.version }}" alt="" /></div>
				<# } else { #>
					<div class="screenshot blank"></div>
				<# } #>
				</div>

				<div class="theme-info">
					<# if ( data.active ) { #>
						<span class="current-label"><?php _e( 'Active Theme' ); ?></span>
					<# } #>
					<h2 class="theme-name">{{{ data.name }}}<span class="theme-version">
						<?php
						/* translators: %s: Theme version. */
						printf( __( 'Version: %s' ), '{{ data.version }}' );
						?>
					</span></h2>
					<h3 class="theme-author">
						<?php
						/* translators: %s: Theme author name. */
						printf( _x( 'By %s', 'theme' ), '{{{ data.authorAndUri }}}' );
						?>
					</h3>

					<# if ( data.stars && 0 != data.num_ratings ) { #>
						<div class="theme-rating">
							{{{ data.stars }}}
							<a class="num-ratings" target="_blank" href="{{ data.reviews_url }}">
								<?php
								printf(
									'%1$s <span class="screen-reader-text">%2$s</span>',
									/* translators: %s: Number of ratings. */
									sprintf( __( '(%s ratings)' ), '{{ data.num_ratings }}' ),
									/* translators: Hidden accessibility text. */
									__( '(opens in a new tab)' )
								);
								?>
							</a>
						</div>
					<# } #>

					<# if ( data.hasUpdate ) { #>
						<# if ( data.updateResponse.compatibleWP && data.updateResponse.compatiblePHP ) { #>
							<div class="notice notice-warning notice-alt notice-large" data-slug="{{ data.id }}">
								<h3 class="notice-title"><?php _e( 'Update Available' ); ?></h3>
								{{{ data.update }}}
							</div>
						<# } else { #>
							<div class="notice notice-error notice-alt notice-large" data-slug="{{ data.id }}">
								<h3 class="notice-title"><?php _e( 'Update Incompatible' ); ?></h3>
								<p>
									<# if ( ! data.updateResponse.compatibleWP && ! data.updateResponse.compatiblePHP ) { #>
										<?php
										printf(
											/* translators: %s: Theme name. */
											__( 'There is a new version of %s available, but it does not work with your versions of Retraceur and PHP.' ),
											'{{{ data.name }}}'
										);
										if ( current_user_can( 'update_core' ) && current_user_can( 'update_php' ) ) {
											printf(
												/* translators: %s: URL to Retraceur Updates screen. */
												' ' . __( '<a href="%1$s">Please update Retraceur</a>.' ),
												self_admin_url( 'update-core.php' )
											);
										} elseif ( current_user_can( 'update_core' ) ) {
											printf(
												/* translators: %s: URL to Retraceur Updates screen. */
												' ' . __( '<a href="%s">Please update Retraceur</a>.' ),
												self_admin_url( 'update-core.php' )
											);
										}
										?>
									<# } else if ( ! data.updateResponse.compatibleWP ) { #>
										<?php
										printf(
											/* translators: %s: Theme name. */
											__( 'There is a new version of %s available, but it does not work with your version of Retraceur.' ),
											'{{{ data.name }}}'
										);
										if ( current_user_can( 'update_core' ) ) {
											printf(
												/* translators: %s: URL to Retraceur Updates screen. */
												' ' . __( '<a href="%s">Please update Retraceur</a>.' ),
												self_admin_url( 'update-core.php' )
											);
										}
										?>
									<# } else if ( ! data.updateResponse.compatiblePHP ) { #>
										<?php
										printf(
											/* translators: %s: Theme name. */
											__( 'There is a new version of %s available, but it does not work with your version of PHP.' ),
											'{{{ data.name }}}'
										);
										?>
									<# } #>
								</p>
							</div>
						<# } #>
					<# } #>

					<# if ( data.parent ) { #>
						<p class="parent-theme">
							<?php
							printf(
								/* translators: %s: Theme name. */
								__( 'This is a child theme of %s.' ),
								'<strong>{{{ data.parent }}}</strong>'
							);
							?>
						</p>
					<# } #>

					<# if ( ! data.compatibleWP || ! data.compatiblePHP ) { #>
						<div class="notice notice-error notice-alt notice-large"><p>
							<# if ( ! data.compatibleWP && ! data.compatiblePHP ) { #>
								<?php
								_e( 'This theme does not work with your versions of Retraceur and PHP.' );
								if ( current_user_can( 'update_core' ) && current_user_can( 'update_php' ) ) {
									printf(
										/* translators: %s: URL to Retraceur Updates screen. */
										' ' . __( '<a href="%s">Please update Retraceur</a>.' ),
										self_admin_url( 'update-core.php' )
									);
								} elseif ( current_user_can( 'update_core' ) ) {
									printf(
										/* translators: %s: URL to Retraceur Updates screen. */
										' ' . __( '<a href="%s">Please update Retraceur</a>.' ),
										self_admin_url( 'update-core.php' )
									);
								}
								?>
							<# } else if ( ! data.compatibleWP ) { #>
								<?php
								_e( 'This theme does not work with your version of Retraceur.' );
								if ( current_user_can( 'update_core' ) ) {
									printf(
										/* translators: %s: URL to Retraceur Updates screen. */
										' ' . __( '<a href="%s">Please update Retraceur</a>.' ),
										self_admin_url( 'update-core.php' )
									);
								}
								?>
							<# } else if ( ! data.compatiblePHP ) { #>
								<?php
								_e( 'This theme does not work with your version of PHP.' );
								?>
							<# } #>
						</p></div>
					<# } else if ( ! data.active && data.blockTheme && data.actions.activate ) { #>
						<div class="notice notice-warning notice-alt notice-large"><p>
							<?php
							printf(
								/* translators: %s: URL to the themes page (also it activates the theme). */
								' ' . __( '<a href="%s">Activate this theme</a>, and use the Site Editor to customize it.' ),
								'{{{ data.actions.activate }}}'
							);
							?>
						</p></div>
					<# } #>

					<p class="theme-description">{{{ data.description }}}</p>

					<# if ( data.tags ) { #>
						<p class="theme-tags"><span><?php _e( 'Tags:' ); ?></span> {{{ data.tags }}}</p>
					<# } #>
				</div>
			</div>

			<div class="theme-actions">
				<# if ( data.active ) { #>
					<button type="button" class="button button-primary customize-theme"><?php _e( 'Customize' ); ?></button>
				<# } else if ( 'installed' === data.type ) { #>
					<div class="theme-inactive-actions">
					<# if ( data.blockTheme ) { #>
						<?php
							/* translators: %s: Theme name. */
							$aria_label = sprintf( _x( 'Activate %s', 'theme' ), '{{ data.name }}' );
						?>
						<# if ( data.compatibleWP && data.compatiblePHP && data.actions.activate ) { #>
							<a href="{{{ data.actions.activate }}}" class="button button-primary activate" aria-label="<?php echo esc_attr( $aria_label ); ?>"><?php _e( 'Activate' ); ?></a>
						<# } #>
					<# } else { #>
						<# if ( data.compatibleWP && data.compatiblePHP ) { #>
							<button type="button" class="button button-primary preview-theme" data-slug="{{ data.id }}"><?php _e( 'Customize' ); ?></button>
						<# } else { #>
							<button class="button button-primary disabled"><?php _e( 'Customize' ); ?></button>
						<# } #>
					<# } #>
					</div>
					<?php if ( current_user_can( 'delete_themes' ) ) { ?>
						<# if ( data.actions && data.actions['delete'] ) { #>
							<a href="{{{ data.actions['delete'] }}}" data-slug="{{ data.id }}" class="button button-secondary delete-theme"><?php _e( 'Delete' ); ?></a>
						<# } #>
					<?php } ?>
				<# } else { #>
					<# if ( data.compatibleWP && data.compatiblePHP ) { #>
						<button type="button" class="button theme-install" data-slug="{{ data.id }}"><?php _e( 'Install' ); ?></button>
						<button type="button" class="button button-primary theme-install preview" data-slug="{{ data.id }}"><?php _e( 'Install &amp; Activate' ); ?></button>
					<# } else { #>
						<button type="button" class="button disabled"><?php _ex( 'Cannot Install', 'theme' ); ?></button>
						<button type="button" class="button button-primary disabled"><?php _e( 'Install &amp; Activate' ); ?></button>
					<# } #>
				<# } #>
			</div>
		</div>
	</script>
	<?php
}

/**
 * Determines whether a theme is technically active but was paused while
 * loading.
 *
 * @since WP 5.2.0
 *
 * @global WP_Paused_Extensions_Storage $_paused_themes
 *
 * @param string $theme Path to the theme directory relative to the themes directory.
 * @return bool True, if in the list of paused themes. False, not in the list.
 */
function is_theme_paused( $theme ) {
	if ( ! isset( $GLOBALS['_paused_themes'] ) ) {
		return false;
	}

	if ( get_stylesheet() !== $theme && get_template() !== $theme ) {
		return false;
	}

	return array_key_exists( $theme, $GLOBALS['_paused_themes'] );
}

/**
 * Gets the error that was recorded for a paused theme.
 *
 * @since WP 5.2.0
 *
 * @global WP_Paused_Extensions_Storage $_paused_themes
 *
 * @param string $theme Path to the theme directory relative to the themes
 *                      directory.
 * @return array|false Array of error information as it was returned by
 *                     `error_get_last()`, or false if none was recorded.
 */
function wp_get_theme_error( $theme ) {
	if ( ! isset( $GLOBALS['_paused_themes'] ) ) {
		return false;
	}

	if ( ! array_key_exists( $theme, $GLOBALS['_paused_themes'] ) ) {
		return false;
	}

	return $GLOBALS['_paused_themes'][ $theme ];
}

/**
 * Tries to resume a single theme.
 *
 * If a redirect was provided and a functions.php file was found, we first ensure that
 * functions.php file does not throw fatal errors anymore.
 *
 * The way it works is by setting the redirection to the error before trying to
 * include the file. If the theme fails, then the redirection will not be overwritten
 * with the success message and the theme will not be resumed.
 *
 * @since WP 5.2.0
 *
 * @global string $wp_stylesheet_path Path to current theme's stylesheet directory.
 * @global string $wp_template_path   Path to current theme's template directory.
 *
 * @param string $theme    Single theme to resume.
 * @param string $redirect Optional. URL to redirect to. Default empty string.
 * @return bool|WP_Error True on success, false if `$theme` was not paused,
 *                       `WP_Error` on failure.
 */
function resume_theme( $theme, $redirect = '' ) {
	global $wp_stylesheet_path, $wp_template_path;

	list( $extension ) = explode( '/', $theme );

	/*
	 * We'll override this later if the theme could be resumed without
	 * creating a fatal error.
	 */
	if ( ! empty( $redirect ) ) {
		$functions_path = '';
		if ( str_contains( $wp_stylesheet_path, $extension ) ) {
			$functions_path = $wp_stylesheet_path . '/functions.php';
		} elseif ( str_contains( $wp_template_path, $extension ) ) {
			$functions_path = $wp_template_path . '/functions.php';
		}

		if ( ! empty( $functions_path ) ) {
			wp_redirect(
				add_query_arg(
					'_error_nonce',
					wp_create_nonce( 'theme-resume-error_' . $theme ),
					$redirect
				)
			);

			// Load the theme's functions.php to test whether it throws a fatal error.
			ob_start();
			if ( ! defined( 'WP_SANDBOX_SCRAPING' ) ) {
				define( 'WP_SANDBOX_SCRAPING', true );
			}
			include $functions_path;
			ob_clean();
		}
	}

	$result = wp_paused_themes()->delete( $extension );

	if ( ! $result ) {
		return new WP_Error(
			'could_not_resume_theme',
			__( 'Could not resume the theme.' )
		);
	}

	return true;
}

/**
 * Renders an admin notice in case some themes have been paused due to errors.
 *
 * @since WP 5.2.0
 *
 * @global string                       $pagenow        The filename of the current screen.
 * @global WP_Paused_Extensions_Storage $_paused_themes
 */
function paused_themes_notice() {
	if ( 'themes.php' === $GLOBALS['pagenow'] ) {
		return;
	}

	if ( ! current_user_can( 'resume_themes' ) ) {
		return;
	}

	if ( ! isset( $GLOBALS['_paused_themes'] ) || empty( $GLOBALS['_paused_themes'] ) ) {
		return;
	}

	$message = sprintf(
		'<p><strong>%s</strong><br>%s</p><p><a href="%s">%s</a></p>',
		__( 'One or more themes failed to load properly.' ),
		__( 'You can find more details and make changes on the Themes screen.' ),
		esc_url( admin_url( 'themes.php' ) ),
		__( 'Go to the Themes screen' )
	);
	wp_admin_notice(
		$message,
		array(
			'type'           => 'error',
			'paragraph_wrap' => false,
		)
	);
}
