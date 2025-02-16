<?php
/**
 * Post API: WP_Post class.
 *
 * @since WP 4.4.0
 * @since 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Post
 */

/**
 * Core class used to implement the WP_Post object.
 *
 * @since WP 3.5.0
 *
 * @property string $page_template
 *
 * @property-read int[]    $ancestors
 * @property-read int[]    $post_category
 * @property-read string[] $tags_input
 */
#[AllowDynamicProperties]
final class WP_Post {

	/**
	 * Post ID.
	 *
	 * @since WP 3.5.0
	 * @var int
	 */
	public $ID;

	/**
	 * ID of post author.
	 *
	 * A numeric string, for compatibility reasons.
	 *
	 * @since WP 3.5.0
	 * @var string
	 */
	public $post_author = 0;

	/**
	 * The post's local publication time.
	 *
	 * @since WP 3.5.0
	 * @var string
	 */
	public $post_date = '0000-00-00 00:00:00';

	/**
	 * The post's GMT publication time.
	 *
	 * @since WP 3.5.0
	 * @var string
	 */
	public $post_date_gmt = '0000-00-00 00:00:00';

	/**
	 * The post's content.
	 *
	 * @since WP 3.5.0
	 * @var string
	 */
	public $post_content = '';

	/**
	 * The post's title.
	 *
	 * @since WP 3.5.0
	 * @var string
	 */
	public $post_title = '';

	/**
	 * The post's excerpt.
	 *
	 * @since WP 3.5.0
	 * @var string
	 */
	public $post_excerpt = '';

	/**
	 * The post's status.
	 *
	 * @since WP 3.5.0
	 * @var string
	 */
	public $post_status = 'publish';

	/**
	 * The post's password in plain text.
	 *
	 * @since WP 3.5.0
	 * @var string
	 */
	public $post_password = '';

	/**
	 * The post's slug.
	 *
	 * @since WP 3.5.0
	 * @var string
	 */
	public $post_name = '';

	/**
	 * The post's local modified time.
	 *
	 * @since WP 3.5.0
	 * @var string
	 */
	public $post_modified = '0000-00-00 00:00:00';

	/**
	 * The post's GMT modified time.
	 *
	 * @since WP 3.5.0
	 * @var string
	 */
	public $post_modified_gmt = '0000-00-00 00:00:00';

	/**
	 * A utility DB field for post content.
	 *
	 * @since WP 3.5.0
	 * @var string
	 */
	public $post_content_filtered = '';

	/**
	 * ID of a post's parent post.
	 *
	 * @since WP 3.5.0
	 * @var int
	 */
	public $post_parent = 0;

	/**
	 * The unique identifier for a post, not necessarily a URL, used as the feed GUID.
	 *
	 * @since WP 3.5.0
	 * @var string
	 */
	public $guid = '';

	/**
	 * A field used for ordering posts.
	 *
	 * @since WP 3.5.0
	 * @var int
	 */
	public $menu_order = 0;

	/**
	 * The post's type, like post or page.
	 *
	 * @since WP 3.5.0
	 * @var string
	 */
	public $post_type = 'post';

	/**
	 * An attachment's mime type.
	 *
	 * @since WP 3.5.0
	 * @var string
	 */
	public $post_mime_type = '';

	/**
	 * Stores the post object's sanitization level.
	 *
	 * Does not correspond to a DB field.
	 *
	 * @since WP 3.5.0
	 * @var string
	 */
	public $filter;

	/**
	 * Deprecated properties.
	 *
	 * @since 1.0.0 Retraceur fork does not provide support for WP Comments.
	 * @var string[]
	 */
	private static $deprecated_properties = array(
		'comment_status',
		'ping_status',
		'to_ping',
		'pinged',
		'comment_count',
		'post_pingback',
	);

	/**
	 * Retrieve WP_Post instance.
	 *
	 * @since WP 3.5.0
	 *
	 * @global wpdb $wpdb Retraceur database abstraction object.
	 *
	 * @param int $post_id Post ID.
	 * @return WP_Post|false Post object, false otherwise.
	 */
	public static function get_instance( $post_id ) {
		global $wpdb;

		$post_id = (int) $post_id;
		if ( ! $post_id ) {
			return false;
		}

		$_post = wp_cache_get( $post_id, 'posts' );

		if ( ! $_post ) {
			$_post = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $wpdb->posts WHERE ID = %d LIMIT 1", $post_id ) );

			if ( ! $_post ) {
				return false;
			}

			foreach ( get_object_vars( $_post ) as $_post_key => $_post_value ) {
				if ( ! in_array( $_post_key, self::$deprecated_properties, true ) ) {
					continue;
				}

				unset( $_post->{ $_post_key } );
			}

			$_post = sanitize_post( $_post, 'raw' );
			wp_cache_add( $_post->ID, $_post, 'posts' );
		} elseif ( empty( $_post->filter ) || 'raw' !== $_post->filter ) {
			$_post = sanitize_post( $_post, 'raw' );
		}

		return new WP_Post( $_post );
	}

	/**
	 * Constructor.
	 *
	 * @since WP 3.5.0
	 *
	 * @param WP_Post|object $post Post object.
	 */
	public function __construct( $post ) {
		foreach ( get_object_vars( $post ) as $key => $value ) {
			$this->$key = $value;
		}
	}

	/**
	 * Isset-er.
	 *
	 * @since WP 3.5.0
	 *
	 * @param string $key Property to check if set.
	 * @return bool
	 */
	public function __isset( $key ) {
		if ( in_array( $key, self::$deprecated_properties, true ) ) {
			_deprecated_argument( __METHOD__, '1.0.0', '', true );
			return false;
		}

		if ( 'ancestors' === $key ) {
			return true;
		}

		if ( 'page_template' === $key ) {
			return true;
		}

		if ( 'post_category' === $key ) {
			return true;
		}

		if ( 'tags_input' === $key ) {
			return true;
		}

		return metadata_exists( 'post', $this->ID, $key );
	}

	/**
	 * Getter.
	 *
	 * @since WP 3.5.0
	 *
	 * @param string $key Key to get.
	 * @return mixed
	 */
	public function __get( $key ) {
		if ( in_array( $key, self::$deprecated_properties, true ) ) {
			_deprecated_argument( __METHOD__, '1.0.0', '', true );
			return null;
		}

		if ( 'page_template' === $key && $this->__isset( $key ) ) {
			return get_post_meta( $this->ID, '_wp_page_template', true );
		}

		if ( 'post_category' === $key ) {
			if ( is_object_in_taxonomy( $this->post_type, 'category' ) ) {
				$terms = get_the_terms( $this, 'category' );
			}

			if ( empty( $terms ) ) {
				return array();
			}

			return wp_list_pluck( $terms, 'term_id' );
		}

		if ( 'tags_input' === $key ) {
			if ( is_object_in_taxonomy( $this->post_type, 'post_tag' ) ) {
				$terms = get_the_terms( $this, 'post_tag' );
			}

			if ( empty( $terms ) ) {
				return array();
			}

			return wp_list_pluck( $terms, 'name' );
		}

		// Rest of the values need filtering.
		if ( 'ancestors' === $key ) {
			$value = get_post_ancestors( $this );
		} else {
			$value = get_post_meta( $this->ID, $key, true );
		}

		if ( $this->filter ) {
			$value = sanitize_post_field( $key, $value, $this->ID, $this->filter );
		}

		return $value;
	}

	/**
	 * {@Missing Summary}
	 *
	 * @since WP 3.5.0
	 *
	 * @param string $filter Filter.
	 * @return WP_Post
	 */
	public function filter( $filter ) {
		if ( $this->filter === $filter ) {
			return $this;
		}

		if ( 'raw' === $filter ) {
			return self::get_instance( $this->ID );
		}

		return sanitize_post( $this, $filter );
	}

	/**
	 * Convert object to array.
	 *
	 * @since WP 3.5.0
	 *
	 * @return array Object as array.
	 */
	public function to_array() {
		$post = get_object_vars( $this );

		foreach ( array( 'ancestors', 'page_template', 'post_category', 'tags_input' ) as $key ) {
			if ( $this->__isset( $key ) ) {
				$post[ $key ] = $this->__get( $key );
			}
		}

		return $post;
	}

	/**
	 * Proxies setting values for deprecated properties.
	 *
	 * @since 1.0.0 Retraceur fork does not provide support for WP Comments.
	 *
	 * @param string $key  Property name.
	 * @param mixed  $value Property value.
	 */
	public function __set( $key, $value ) {
		if ( in_array( $key, self::$deprecated_properties, true ) ) {
			_deprecated_argument( __METHOD__, '1.0.0', wp_debug_backtrace_summary(), true );
			$this->{$key} = null;
		} else {
			$this->{$key} = $value;
		}
	}

	public static function get_deprecated_properties() {
		return self::$deprecated_properties;
	}
}
