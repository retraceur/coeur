<?php
/**
 * WP_Navigation_Fallback class.
 *
 * Manages fallback behavior for Navigation menus.
 *
 * @since WP 6.3.0
 * @since 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Navigation
 */

/**
 * Manages fallback behavior for Navigation menus.
 *
 * @access public
 * @since WP 6.3.0
 */
class WP_Navigation_Fallback {

	/**
	 * Updates the wp_navigation custom post type schema, in order to expose
	 * additional fields in the embeddable links of WP_REST_Navigation_Fallback_Controller.
	 *
	 * The Navigation Fallback endpoint may embed the full Navigation Menu object
	 * into the response as the `self` link. By default, the Posts Controller
	 * will only expose a limited subset of fields but the editor requires
	 * additional fields to be available in order to utilize the menu.
	 *
	 * Used with the `rest_wp_navigation_item_schema` hook.
	 *
	 * @since WP 6.4.0
	 *
	 * @param array $schema The schema for the `wp_navigation` post.
	 * @return array The modified schema.
	 */
	public static function update_wp_navigation_post_schema( $schema ) {
		// Expose top level fields.
		$schema['properties']['status']['context']  = array_merge( $schema['properties']['status']['context'], array( 'embed' ) );
		$schema['properties']['content']['context'] = array_merge( $schema['properties']['content']['context'], array( 'embed' ) );

		/*
		 * Exposes sub properties of content field.
		 * These sub properties aren't exposed by the posts controller by default,
		 * for requests where context is `embed`.
		 *
		 * @see WP_REST_Posts_Controller::get_item_schema()
		 */
		$schema['properties']['content']['properties']['raw']['context']           = array_merge( $schema['properties']['content']['properties']['raw']['context'], array( 'embed' ) );
		$schema['properties']['content']['properties']['rendered']['context']      = array_merge( $schema['properties']['content']['properties']['rendered']['context'], array( 'embed' ) );
		$schema['properties']['content']['properties']['block_version']['context'] = array_merge( $schema['properties']['content']['properties']['block_version']['context'], array( 'embed' ) );

		/*
		 * Exposes sub properties of title field.
		 * These sub properties aren't exposed by the posts controller by default,
		 * for requests where context is `embed`.
		 *
		 * @see WP_REST_Posts_Controller::get_item_schema()
		 */
		$schema['properties']['title']['properties']['raw']['context'] = array_merge( $schema['properties']['title']['properties']['raw']['context'], array( 'embed' ) );

		return $schema;
	}

	/**
	 * Gets (and/or creates) an appropriate fallback Navigation Menu.
	 *
	 * @since WP 6.3.0
	 *
	 * @return WP_Post|null the fallback Navigation Post or null.
	 */
	public static function get_fallback() {
		/**
		 * Filters whether or not a fallback should be created.
		 *
		 * @since WP 6.3.0
		 *
		 * @param bool $create Whether to create a fallback navigation menu. Default true.
		 */
		$should_create_fallback = apply_filters( 'wp_navigation_should_create_fallback', true );

		$fallback = static::get_most_recently_published_navigation();

		if ( $fallback || ! $should_create_fallback ) {
			return $fallback;
		}

		$fallback = static::create_default_fallback();

		if ( $fallback && ! is_wp_error( $fallback ) ) {
			// Return the newly created fallback post object which will now be the most recently created navigation menu.
			return $fallback instanceof WP_Post ? $fallback : static::get_most_recently_published_navigation();
		}

		return null;
	}

	/**
	 * Finds the most recently published `wp_navigation` post type.
	 *
	 * @since WP 6.3.0
	 *
	 * @return WP_Post|null the first non-empty Navigation or null.
	 */
	private static function get_most_recently_published_navigation() {

		$parsed_args = array(
			'post_type'              => 'wp_navigation',
			'no_found_rows'          => true,
			'update_post_meta_cache' => false,
			'update_post_term_cache' => false,
			'order'                  => 'DESC',
			'orderby'                => 'date',
			'post_status'            => 'publish',
			'posts_per_page'         => 1,
		);

		$navigation_post = new WP_Query( $parsed_args );

		if ( count( $navigation_post->posts ) > 0 ) {
			return $navigation_post->posts[0];
		}

		return null;
	}

	/**
	 * Creates a Navigation Menu post from a Classic Menu.
	 *
	 * @since WP 6.3.0
	 * @deprecated 1.0.0 Retraceur fork removed the WP Nav Menu feature.
	 *
	 * @return int|WP_Error The post ID of the default fallback menu or a WP_Error object.
	 */
	private static function create_classic_menu_fallback() {
		_deprecated_function( __METHOD__, '1.0.0', '', true );
		return new WP_Error( 'classic_menus_no_support', __( 'Classic Menus are not supported by Retraceur.' ) );
	}

	/**
	 * Determines the most appropriate classic navigation menu to use as a fallback.
	 *
	 * @since WP 6.3.0
	 * @deprecated 1.0.0 Retraceur fork removed the WP Nav Menu feature.
	 *
	 * @return WP_Term|null The most appropriate classic navigation menu to use as a fallback.
	 */
	private static function get_fallback_classic_menu() {
		_deprecated_function( __METHOD__, '1.0.0', '', true );
		return null;
	}


	/**
	 * Sorts the classic menus and returns the most recently created one.
	 *
	 * @since WP 6.3.0
	 *
	 * @param WP_Term[] $classic_nav_menus Array of classic nav menu term objects.
	 * @return WP_Term The most recently created classic nav menu.
	 */
	private static function get_most_recently_created_nav_menu( $classic_nav_menus ) {
		usort(
			$classic_nav_menus,
			static function ( $a, $b ) {
				return $b->term_id - $a->term_id;
			}
		);

		return $classic_nav_menus[0];
	}

	/**
	 * Returns the classic menu with the slug `primary` if it exists.
	 *
	 * @since WP 6.3.0
	 * @deprecated 1.0.0 Retraceur fork removed the WP Nav Menu feature.
	 *
	 * @param WP_Term[] $classic_nav_menus Array of classic nav menu term objects.
	 * @return WP_Term|null The classic nav menu with the slug `primary` or null.
	 */
	private static function get_nav_menu_with_primary_slug( $classic_nav_menus ) {
		_deprecated_function( __METHOD__, '1.0.0', '', true );
		return null;
	}


	/**
	 * Gets the classic menu assigned to the `primary` navigation menu location
	 * if it exists.
	 *
	 * @since WP 6.3.0
	 * @deprecated 1.0.0 Retraceur fork removed the WP Nav Menu feature.
	 *
	 * @return WP_Term|null The classic nav menu assigned to the `primary` location or null.
	 */
	private static function get_nav_menu_at_primary_location() {
		_deprecated_function( __METHOD__, '1.0.0', '', true );
		return null;
	}

	/**
	 * Creates a default Navigation Block Menu fallback.
	 *
	 * @since WP 6.3.0
	 *
	 * @return int|WP_Error The post ID of the default fallback menu or a WP_Error object.
	 */
	private static function create_default_fallback() {

		$default_blocks = static::get_default_fallback_blocks();

		// Create a new navigation menu from the fallback blocks.
		$default_fallback = wp_insert_post(
			array(
				'post_content' => $default_blocks,
				'post_title'   => _x( 'Navigation', 'Title of a Navigation menu' ),
				'post_name'    => 'navigation',
				'post_status'  => 'publish',
				'post_type'    => 'wp_navigation',
			),
			true // So that we can check whether the result is an error.
		);

		return $default_fallback;
	}

	/**
	 * Gets the rendered markup for the default fallback blocks.
	 *
	 * @since WP 6.3.0
	 *
	 * @return string default blocks markup to use a the fallback.
	 */
	private static function get_default_fallback_blocks() {
		$registry = WP_Block_Type_Registry::get_instance();

		// If `core/page-list` is not registered then use empty blocks.
		return $registry->is_registered( 'core/page-list' ) ? '<!-- wp:page-list /-->' : '';
	}
}
