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
 * Returns the list of a Post Format additional props (stored in term metas).
 *
 * @since 2.0.0 Retraceur fork.
 *
 * @param integer $term_id The Post Format term ID.
 * @return array The list of a Post Format additional props.
 */
function get_post_format_additional_props( $term_id = 0 ) {
	$props = array();
	$metas = get_term_meta( $term_id );

	foreach ( $metas as $meta_key => $meta_value ) {
		if ( ! registered_meta_key_exists( 'term', $meta_key, 'post_format' ) ) {
			continue;
		}

		$metakey           = str_replace( 'post_format_', '', $meta_key );
		$props[ $metakey ] = is_array( $meta_value ) ? reset( $meta_value ) : $meta_value;
	}

	return $props;
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

		if ( ! $post_formats ) {
			return array();
		}

		// Fetch all registered metadata at once for each Post Format.
		foreach ( $post_formats as $term_index => $term ) {
			$props = get_post_format_additional_props( $term->term_id );

			foreach ( $props as $meta_key => $meta_value ) {
				$post_formats[ $term_index ]->{$meta_key} = $meta_value;
			}
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
 * Gets a Post Format's object.
 *
 * @since 2.0.0 Retraceur fork.
 *
 * @param integer|WP_Term|string $format The Post Format ID, Object or slug.
 * @return false|WP_Term False if no terms match required format. The corresponding term object otherwise.
 */
function get_post_format_object( $format ) {
	$args = array();

	if ( is_numeric( $format ) || $format instanceof WP_Term ) {
		$args['term'] = $format;
	} else {
		$args['slug'] = 'post-format-' . str_replace( 'post-format-', '', $format );
	}

	if ( isset( $args['slug'] ) && $args['slug'] ) {
		$post_format = wp_filter_object_list( get_post_formats(), $args );
		$post_format = reset( $post_format );
	} else {
		$post_format = get_term( $args['term'] );

		if ( ! empty( $post_format->term_id ) ) {
			$props = get_post_format_additional_props( $post_format->term_id );

			foreach ( $props as $meta_key => $meta_value ) {
				$post_format->{$meta_key} = $meta_value;
			}
		}
	}

	if ( ! $post_format ) {
		return null;
	}

	return $post_format;
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
			$prefixed[] = 'post-format-' . str_replace( 'post-format-', '', sanitize_key( $single ) );
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
 * Returns all Post Format labels (keyed by slugs).
 *
 * @since 2.0.0 Retraceur fork.
 *
 * @return array The list of Post Format labels.
 */
function get_post_format_default_labels() {
	return array(
		'post-format-standard' => array(
			'name'          => 'standard',
			'label'         => _x( 'Standard', 'Post format label' ),
			'singular_name' => _x( 'Post', 'Post format singular name' ),
			'plural_name'   => _x( 'Posts', 'Post format plural name' ),
		),
		'post-format-aside'    => array(
			'name'          => 'aside',
			'label'         => _x( 'Aside', 'Post format label' ),
			'singular_name' => _x( 'Aside', 'Post format singular name' ),
			'plural_name'   => _x( 'Asides', 'Post format plural name' ),
		),
		'post-format-chat'     => array(
			'name'          => 'chat',
			'label'         => _x( 'Chat', 'Post format label' ),
			'singular_name' => _x( 'Chat', 'Post format singular name' ),
			'plural_name'   => _x( 'Chats', 'Post format plural name' ),
		),
		'post-format-code'     => array(
			'name'          => 'code',
			'label'         => _x( 'Code', 'Post format label' ),
			'singular_name' => _x( 'Code', 'Post format singular name' ),
			'plural_name'   => _x( 'Codes', 'Post format plural name' ),
		),
		'post-format-gallery'  => array(
			'name'          => 'gallery',
			'label'         => _x( 'Gallery', 'Post format label' ),
			'singular_name' => _x( 'Gallery', 'Post format singular name' ),
			'plural_name'   => _x( 'Galleries', 'Post format plural name' ),
		),
		'post-format-link'     => array(
			'name'          => 'link',
			'label'         => _x( 'Link', 'Post format label' ),
			'singular_name' => _x( 'Link', 'Post format singular name' ),
			'plural_name'   => _x( 'Links', 'Post format plural name' ),
		),
		'post-format-image'    => array(
			'name'          => 'image',
			'label'         => _x( 'Image', 'Post format label' ),
			'singular_name' => _x( 'Image', 'Post format singular name' ),
			'plural_name'   => _x( 'Images', 'Post format plural name' ),
		),
		'post-format-quote'    => array(
			'name'          => 'quote',
			'label'         => _x( 'Quote', 'Post format label' ),
			'singular_name' => _x( 'Quote', 'Post format singular name' ),
			'plural_name'   => _x( 'Quotes', 'Post format plural name' ),
		),
		'post-format-status'   => array(
			'name'          => 'status',
			'label'         => _x( 'Status', 'Post format label' ),
			'singular_name' => _x( 'Status', 'Post format singular name' ),
			'plural_name'   => _x( 'Statuses', 'Post format plural name' ),
		),
		'post-format-video'    => array(
			'name'          => 'video',
			'label'         => _x( 'Video', 'Post format label' ),
			'singular_name' => _x( 'Video', 'Post format singular name' ),
			'plural_name'   => _x( 'Videos', 'Post format plural name' ),
		),
		'post-format-audio'    => array(
			'name'          => 'audio',
			'label'         => _x( 'Audio', 'Post format label' ),
			'singular_name' => _x( 'Audio', 'Post format singular name' ),
			'plural_name'   => _x( 'Audios', 'Post format plural name' ),
		),
	);
}

/**
 * Returns a Post Format default label for the requested real slug.
 *
 * @since 2.0.0
 *
 * @param string $slug The Post Format real slug (eg: `post-format-standard`).
 * @param string $prop The property name of the needed default label.
 * @return string The default label value.
 */
function get_post_format_default_label( $slug, $prop ) {
	$default_singular_names = get_post_format_default_labels();
	$retval                 = '';

	if ( isset( $default_singular_names[ $slug ][ $prop ] ) ) {
		$retval = $default_singular_names[ $slug ][ $prop ];
	}

	return $retval;
}

/**
 * Returns an array of post format slugs to their translated and pretty display versions
 *
 * @since WP 3.1.0
 *
 * @return string[] Array of post format labels keyed by format slug.
 */
function get_post_format_strings() {
	$strings = wp_list_pluck( get_post_format_default_labels(), 'label', 'name' );
	return $strings;
}

function get_post_format_default_slugs() {
	return array_keys( get_post_format_default_labels() );
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
		if ( isset( $post_format->custom_slug ) ) {
			$slug = $post_format->custom_slug;
		} else {
			$slug = $post_format->name;
		}

		$slugs[ $slug ] = $post_format->slug;
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
		return str_replace( "/{$term->slug}", '/' . get_post_format_slug( $term ), $link );
	} else {
		$link = remove_query_arg( 'post_format', $link );
		return add_query_arg( 'post_format', get_post_format_slug( $term ), $link );
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
 * Gets a Post Format's term ID.
 *
 * @since 2.0.0 Retraceur fork.
 *
 * @param string $format The Post format slug.
 * @return integer The Post Format term ID.
 */
function get_post_format_id( $format ) {
	$post_format = get_post_format_object( $format );
	$format_id   = 0;

	if ( isset( $post_format->term_id ) ) {
		$format_id = (int) $post_format->term_id;
	}

	return $format_id;
}

/**
 * Gets the Post Format's singular name (possibly customized).
 *
 * @since 2.0.0 Retraceur fork.
 *
 * @param integer|WP_Term|string $format The Post Format ID, Object or slug.
 * @return string An empty string if no terms match required Format. The Post Format plural name otherwise.
 */
function get_post_format_singular_name( $format ) {
	$post_format   = get_post_format_object( $format );
	$singular_name = '';

	if ( isset( $post_format->singular_name ) ) {
		$singular_name = $post_format->singular_name;
	} else {
		$singular_name = get_post_format_default_label( $post_format->slug, 'singular_name' );
	}

	return $singular_name;
}

/**
 * Gets the Post Format's plural name (possibly customized).
 *
 * @since 2.0.0 Retraceur fork.
 *
 * @param integer|WP_Term|string $format The Post Format ID, Object or slug.
 * @return string An empty string if no terms match required Format. The Post Format plural name otherwise.
 */
function get_post_format_plural_name( $format ) {
	$post_format   = get_post_format_object( $format );
	$plural_name   = '';

	if ( isset( $post_format->plural_name ) ) {
		$plural_name = $post_format->plural_name;
	} else {
		$plural_name = get_post_format_default_label( $post_format->slug, 'plural_name' );
	}

	return $plural_name;
}

/**
 * Gets the Post Format's slug (possibly customized).
 *
 * @since 2.0.0 Retraceur fork.
 *
 * @param integer|WP_Term|string $format  The Post Format ID, Object or slug.
 * @return string An empty string if no terms match required format. The Post format slug otherwise.
 */
function get_post_format_slug( $format ) {
	$post_format = get_post_format_object( $format );

	if ( ! isset( $post_format->slug ) ) {
		return '';
	}

	$slug = str_replace( 'post-format-', '', $post_format->slug );

	if ( isset( $post_format->custom_slug ) ) {
		$slug = $post_format->custom_slug;
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

/**
 * Cleans the Post Formats cache on term update.
 *
 * @since 2.0.0 Retraceur fork.
 *
 * @param array  $ids      An array of term IDs.
 * @param string $taxonomy Taxonomy slug.
 */
function clean_post_formats_cache( $ids = array(), $taxonomy ='' ) {
	if ( 'post_format' === $taxonomy ) {
		$cache_key = 'post_formats:' . wp_get_theme()->stylesheet;

		wp_cache_delete( $cache_key, 'post-formats' );
	}
}
