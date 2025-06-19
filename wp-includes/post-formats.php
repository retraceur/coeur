<?php
/**
 * Post format functions.
 *
 * @since 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Post
 */

/**
 * Builds a Term Query slug's argument to get all supported Post Format terms.
 *
 * @since 2.0.0 Retraceur fork.
 *
 * @return array The list of supported post format slugs.
 */
function get_supported_post_format_slugs() {
	$supported_formats = get_theme_support( 'post-formats' );
	$args              = array( 'post-format-standard' );

	if ( is_array( $supported_formats ) && count( $supported_formats ) > 0 ) {
		$includes = reset( $supported_formats );

		foreach ( $includes as $include ) {
			$args[] = 'post-format-'. $include;
		}
	} else {
		return array();
	}

	return $args;
}

/**
 * Get Post Format terms.
 *
 * @since 2.0.0 Retraceur fork.
 *
 * @return WP_Term[]|array The list of Post Format terms. An empty array if none were found.
 */
function get_post_formats() {
	$slugs        = get_supported_post_format_slugs();
	$post_formats = array();

	if ( ! $slugs ) {
		return $post_formats;
	}

	$cache_key = 'post_formats:' . wp_get_theme()->stylesheet;
	$cache     = wp_cache_get( $cache_key, 'post-formats' );

	if ( false === $cache ) {
		$post_formats = get_terms(
			array(
				'taxonomy'   => 'post_format',
				'hide_empty' => 0,
				'slugs'      => $slugs,
			)
		);

		if ( ! $post_formats || count( $post_formats ) !== count( $slugs ) ) {
			return $post_formats;
		}

		wp_cache_set( $cache_key, $post_formats, 'post-formats' );
	} else {
		$post_formats = $cache;
	}

	return $post_formats;
}

/**
 * Retrieve the format slug for a post
 *
 * @since WP 3.1.0
 *
 * @param int|WP_Post|null $post Optional. Post ID or post object. Defaults to the current post in the loop.
 * @return string|false The format if successful. False otherwise.
 */
function get_post_format( $post = null ) {
	$post = get_post( $post );

	if ( ! $post ) {
		return false;
	}

	if ( ! post_type_supports( $post->post_type, 'post-formats' ) ) {
		return false;
	}

	$_format = get_the_terms( $post->ID, 'post_format' );

	if ( empty( $_format ) ) {
		return false;
	}

	$format = reset( $_format );

	return str_replace( 'post-format-', '', $format->slug );
}

/**
 * Check if a post has any of the given formats, or any format.
 *
 * @since WP 3.1.0
 *
 * @param string|string[]  $format Optional. The format or formats to check. Default empty array.
 * @param WP_Post|int|null $post   Optional. The post to check. Defaults to the current post in the loop.
 * @return bool True if the post has any of the given formats (or any format, if no format specified),
 *              false otherwise.
 */
function has_post_format( $format = array(), $post = null ) {
	$prefixed = array();

	if ( $format ) {
		foreach ( (array) $format as $single ) {
			$prefixed[] = 'post-format-' . sanitize_key( $single );
		}
	}

	return has_term( $prefixed, 'post_format', $post );
}

/**
 * Assign a format to a post
 *
 * @since WP 3.1.0
 *
 * @param int|WP_Post $post   The post for which to assign a format.
 * @param string      $format A format to assign. Use an empty string or array to remove all formats from the post.
 * @return array|WP_Error|false Array of affected term IDs on success. WP_Error on error.
 */
function set_post_format( $post, $format ) {
	$post = get_post( $post );

	if ( ! $post ) {
		return new WP_Error( 'invalid_post', __( 'Invalid post.' ) );
	}

	if ( ! empty( $format ) ) {
		$format = sanitize_key( $format );
		if ( 'standard' === $format || ! in_array( $format, get_post_format_slugs(), true ) ) {
			$format = '';
		} else {
			$format = 'post-format-' . $format;
		}
	}

	return wp_set_post_terms( $post->ID, $format, 'post_format' );
}

/**
 * Returns an array of post format slugs to their translated and pretty display versions
 *
 * @since WP 3.1.0
 *
 * @return string[] Array of post format labels keyed by format slug.
 */
function get_post_format_strings() {
	$strings = array(
		'standard' => _x( 'Standard', 'Post format' ), // Special case. Any value that evals to false will be considered standard.
		'aside'    => _x( 'Aside', 'Post format' ),
		'chat'     => _x( 'Chat', 'Post format' ),
		'gallery'  => _x( 'Gallery', 'Post format' ),
		'link'     => _x( 'Link', 'Post format' ),
		'image'    => _x( 'Image', 'Post format' ),
		'quote'    => _x( 'Quote', 'Post format' ),
		'status'   => _x( 'Status', 'Post format' ),
		'video'    => _x( 'Video', 'Post format' ),
		'audio'    => _x( 'Audio', 'Post format' ),
	);
	return $strings;
}

/**
 * Retrieves the array of post format slugs.
 *
 * @since WP 3.1.0
 *
 * @return string[] The array of post format slugs as both keys and values.
 */
function get_post_format_slugs() {
	$slugs = array_keys( get_post_format_strings() );
	return array_combine( $slugs, $slugs );
}

/**
 * Retrieves the array of post format custom slugs.
 *
 * @since 2.0.0 Retraceur fork.
 *
 * @return string[] The array of real post format slugs keyed by custom ones.
 */
function get_post_format_custom_slugs() {
	$post_formats = get_post_formats();
	$slugs        = array();

	foreach ( $post_formats as $post_format ) {
		$slug           = get_post_format_slug( $post_format, $post_format->slug );
		$slugs[ $slug ] = str_replace( 'post_format_', '', $post_format->slug );
	}

	return $slugs;
}

/**
 * Returns a pretty, translated version of a post format slug
 *
 * @since WP 3.1.0
 *
 * @param string $slug A post format slug.
 * @return string The translated post format name.
 */
function get_post_format_string( $slug ) {
	$strings = get_post_format_strings();
	if ( ! $slug ) {
		return $strings['standard'];
	} else {
		return ( isset( $strings[ $slug ] ) ) ? $strings[ $slug ] : '';
	}
}

/**
 * Returns a link to a post format index.
 *
 * @since WP 3.1.0
 *
 * @param string $format The post format slug.
 * @return string|WP_Error|false The post format term link.
 */
function get_post_format_link( $format ) {
	$term = get_term_by( 'slug', 'post-format-' . $format, 'post_format' );
	if ( ! $term || is_wp_error( $term ) ) {
		return false;
	}
	return get_term_link( $term );
}

/**
 * Filters the request to allow for the format prefix.
 *
 * @access private
 * @since WP 3.1.0
 *
 * @param array $qvs
 * @return array
 */
function _post_format_request( $qvs ) {
	if ( ! isset( $qvs['post_format'] ) ) {
		return $qvs;
	}
	$slugs = get_post_format_custom_slugs();
	if ( isset( $slugs[ $qvs['post_format'] ] ) ) {
		$qvs['post_format'] = $slugs[ $qvs['post_format'] ];
	}
	$tax = get_taxonomy( 'post_format' );
	if ( ! is_admin() ) {
		$qvs['post_type'] = $tax->object_type;
	}
	return $qvs;
}

/**
 * Filters the post format term link to remove the format prefix.
 *
 * @access private
 * @since WP 3.1.0
 *
 * @global WP_Rewrite $wp_rewrite WP rewrite component.
 *
 * @param string  $link
 * @param WP_Term $term
 * @param string  $taxonomy
 * @return string
 */
function _post_format_link( $link, $term, $taxonomy ) {
	global $wp_rewrite;
	if ( 'post_format' !== $taxonomy ) {
		return $link;
	}
	if ( $wp_rewrite->get_extra_permastruct( $taxonomy ) ) {
		return str_replace( "/{$term->slug}", '/' . get_post_format_slug( $term, $term->slug ), $link );
	} else {
		$link = remove_query_arg( 'post_format', $link );
		return add_query_arg( 'post_format', get_post_format_slug( $term, $term->slug ), $link );
	}
}

/**
 * Remove the post format prefix from the name property of the term object created by get_term().
 *
 * @access private
 * @since WP 3.1.0
 *
 * @param object $term
 * @return object
 */
function _post_format_get_term( $term ) {
	if ( isset( $term->slug, $term->name ) && $term->name === $term->slug ) {
		$term->name = get_post_format_string( str_replace( 'post-format-', '', $term->slug ) );
	}
	return $term;
}

/**
 * Remove the post format prefix from the name property of the term objects created by get_terms().
 *
 * @access private
 * @since WP 3.1.0
 *
 * @param array        $terms
 * @param string|array $taxonomies
 * @param array        $args
 * @return array
 */
function _post_format_get_terms( $terms, $taxonomies, $args ) {
	if ( in_array( 'post_format', (array) $taxonomies, true ) ) {
		if ( isset( $args['fields'] ) && 'names' === $args['fields'] ) {
			foreach ( $terms as $order => $name ) {
				$terms[ $order ] = get_post_format_string( str_replace( 'post-format-', '', $name ) );
			}
		} else {
			foreach ( (array) $terms as $order => $term ) {
				if ( isset( $term->taxonomy ) && 'post_format' === $term->taxonomy && $terms[ $order ]->name === $terms[ $order ]->slug ) {
					$terms[ $order ]->name = get_post_format_string( str_replace( 'post-format-', '', $term->slug ) );
				}
			}
		}
	}
	return $terms;
}

/**
 * Remove the post format prefix from the name property of the term objects created by wp_get_object_terms().
 *
 * @access private
 * @since WP 3.1.0
 *
 * @param array $terms
 * @return array
 */
function _post_format_wp_get_object_terms( $terms ) {
	foreach ( (array) $terms as $order => $term ) {
		if ( isset( $term->taxonomy ) && 'post_format' === $term->taxonomy ) {
			$terms[ $order ]->name = get_post_format_string( str_replace( 'post-format-', '', $term->slug ) );
		}
	}
	return $terms;
}

/**
 * Populate the DB with supported Post Formats.
 *
 * This allowes Admins to use the Term API to customize slugs, names and descriptions.
 *
 * @since 2.0.0 Retraceur fork.
 */
function _post_format_populate_terms() {
	$current_screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;
	$taxonomy       = 'post_format';

	if ( ! isset( $current_screen->taxonomy ) || $taxonomy !== $current_screen->taxonomy || ! current_theme_supports( 'post-formats' ) || count( $_REQUEST ) !== 1 ) {
		return;
	}

	// @todo use cache to avoid querying multiple times.
	$post_formats = get_supported_post_format_slugs();
	$terms        = get_post_formats();

	if ( ! $terms || count( $terms ) !== count( $post_formats ) ) {
		$existing_terms = wp_list_pluck( $terms, 'slug' );

		foreach ( $post_formats as $post_format ) {
			if ( in_array( $post_format, $existing_terms, true ) ) {
				continue;
			}

			wp_insert_term( $post_format, $taxonomy );
		}
	}
}

/**
 * Gets a Post Format's term object.
 *
 * @since 2.0.0 Retraceur fork.
 *
 * @param string $format The Post format slug.
 * @return false|WP_Term False if no terms match required format. The corresponding term object otherwise.
 */
function get_post_format_object( $format ) {
	$term = get_term_by( 'slug', 'post-format-' . $format, 'post_format' );

	if ( ! $term || is_wp_error( $term ) ) {
		return false;
	}

	return $term;
}

/**
 * Gets a Post Format's term ID.
 *
 * @since 2.0.0 Retraceur fork.
 *
 * @param string $format The Post format slug.
 * @return integer The Post Format term ID.
 */
function get_post_format_id( $format ) {
	$term      = get_post_format_object( $format );
	$format_id = 0;

	if ( isset( $term->term_id ) ) {
		$format_id = (int) $term->term_id;
	}

	return $format_id;
}

/**
 * Gets the Post Format's plural name (possibly customized).
 *
 * @since 2.0.0 Retraceur fork.
 *
 * @param integer|WP_Term|string $format The Post Format ID, Object or slug.
 * @return false|string False if no terms match required Format. The Post Format plural name otherwise.
 */
function get_post_format_plural_name( $format ) {
	if ( is_numeric( $format ) ) {
		$format_id = $format;
	} elseif ( $format instanceof WP_Term ) {
		$format_id = $format->term_id;
	} else {
		$format    = str_replace( 'post-format-', '', $format );
		$format_id = get_post_format_id( $format );
	}

	if ( ! $format_id ) {
		return false;
	}

	$default_plural_names = array(
		'standard' => _x( 'Posts', 'post format archive title' ),
		'aside'    => _x( 'Asides', 'post format archive title' ),
		'chat'     => _x( 'Chats', 'post format archive title' ),
		'gallery'  => _x( 'Galleries', 'post format archive title' ),
		'link'     => _x( 'Links', 'post format archive title' ),
		'image'    => _x( 'Images', 'post format archive title' ),
		'quote'    => _x( 'Quotes', 'post format archive title' ),
		'status'   => _x( 'Statuses', 'post format archive title' ),
		'video'    => _x( 'Videos', 'post format archive title' ),
		'audio'    => _x( 'Audio', 'post format archive title' ),
	);

	$plural_name = get_term_meta( $format_id, 'post_format_plural_name', true );
	if ( ! $plural_name && isset( $default_plural_names[ $format ] ) ) {
		$plural_name = $default_plural_names[ $format ];
	}

	return $plural_name;
}

/**
 * Gets the Post Format's slug (possibly customized).
 *
 * @since 2.0.0 Retraceur fork.
 *
 * @param integer|WP_Term|string $format  The Post Format ID, Object or slug.
 * @param string                 $default The default slug to fallback on.
 * @return false|string False if no terms match required format. The Post format slug otherwise.
 */
function get_post_format_slug( $format, $default = '' ) {
	if ( is_numeric( $format ) ) {
		$format_id = $format;
	} elseif ( $format instanceof WP_Term ) {
		$format_id = $format->term_id;
	} else {
		$format_id = get_post_format_id( $format );
	}

	if ( ! $format_id ) {
		return false;
	}

	$slug = get_term_meta( $format_id, 'post_format_slug', true );

	if ( ! $slug ) {
		$slug = str_replace( 'post-format-', '', $default );
	}

	return $slug;
}

/**
 * Gets the Post Format's slug (possibly customized).
 *
 * @since 2.0.0 Retraceur fork.
 *
 * @param string|integer $format The Post format slug or ID.
 * @param string         $key    The Post format meta key suffix.
 * @param string         $value  The customized value to use for the given key.
 * @return int|bool|WP_Error Meta ID if the key didn't exist. true on successful update,
 *                           false on failure or if the value passed to the function
 *                           is the same as the one that is already in the database.
 *                           WP_Error when term_id is ambiguous between taxonomies.
 */
function set_post_format_meta( $format, $key, $value ) {
	if ( is_numeric( $format ) ) {
		$format_id = $format;
	} else {
		$format_id = get_post_format_id( $format );
	}

	$meta_key = 'post_format_' . $key;

	if ( ! $format_id || ! registered_meta_key_exists( 'term', $meta_key, 'post_format' ) ) {
		return false;
	}

	return update_term_meta( $format_id, $meta_key, $value );
}

/**
 * Removes the Post Format meta.
 *
 * @since 2.0.0 Retraceur fork.
 *
 * @param string|integer $format The Post format slug or ID.
 * @param string         $key    The Post format meta key suffix.
 * @return bool True on success, false on failure.
 */
function reset_post_format_meta( $format, $key ) {
	if ( is_numeric( $format ) ) {
		$format_id = $format;
	} else {
		$format_id = get_post_format_id( $format );
	}

	$meta_key = 'post_format_' . $key;

	if ( ! $format_id || ! registered_meta_key_exists( 'term', $meta_key, 'post_format' ) ) {
		return false;
	}

	return delete_term_meta( $format_id, $meta_key );
}
