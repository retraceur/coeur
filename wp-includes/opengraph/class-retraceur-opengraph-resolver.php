<?php
/**
 * Opengraph: Retraceur_Opengraph_Resolver class.
 *
 * @since 3.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Opengraph
 */

/**
 * Class Retraceur_Opengraph_Resolver.
 *
 * @since 3.0.0 Retraceur fork.
 */
class Retraceur_Opengraph_Resolver {

	/**
	 * Checks whether resolving the Opengraph context for the current loaded page should be skipped.
	 *
	 * @since 3.0.0 Retraceur fork.
	 *
	 * @return boolean True to skip resolving the Opengraph context. False otherwise.
	 */
	private function should_skip() {
		$skip = false;

		if ( is_admin() || is_feed() || is_404() ) {
			$skip = true;
		}

		return $skip;
	}

	/**
	 * Checks whether an Opengraph context is valid.
	 *
	 * @since 3.0.0 Retraceur fork.
	 *
	 * @param Retraceur_Opengraph_Context $context The Opengraph context object.
	 * @return boolean True when the Opengraph context is valid. False otherwise.
	 */
	private function is_valid( Retraceur_Opengraph_Context $context ) {
		return ! empty( $context->title )
			&& ! empty( $context->description )
			&& ! empty( $context->type )
			&& ! empty( $context->url );
	}

	/**
	 * Resolves the `type` property of the Retraceur Opengraph context.
	 *
	 * @since 3.0.0 Retraceur fork.
	 *
	 * @return string The `type` property of the Retraceur Opengraph context.
	 */
	public function resolve_type() {
		$type = 'website';

		if ( is_author() ) {
			$type = 'profile';
		} elseif ( ! is_front_page() && ! is_home() && is_singular() ) {
			$type = 'article';
		}

		/**
		 * Filter here to edit the `type` property of the Retraceur Opengraph context.
		 *
		 * @since 3.0.0 Retraceur fork.
		 *
		 * @param string $type The `type` property of the Retraceur Opengraph context.
		 */
		return apply_filters( 'retraceur_opengraph_type', $type );
	}

	/**
	 * Resolves the `url` property of the Retraceur Opengraph context.
	 *
	 * @since 3.0.0 Retraceur fork.
	 *
	 * @return string The `url` property of the Retraceur Opengraph context.
	 */
	private function resolve_url() {
		if ( is_singular() ) {
			return get_permalink();
		}

		if ( is_front_page() ) {
			return home_url( '/' );
		}

		return home_url( add_query_arg( null, null ) );
	}

	/**
	 * Resolves the `title` property of the Retraceur Opengraph context.
	 *
	 * @since 3.0.0 Retraceur fork.
	 *
	 * @param string $title Optional. The document title if available.
	 * @return string The `title` property of the Retraceur Opengraph context.
	 */
	public function resolve_title( $title = '' ) {

		// Only resolve the title if it wasn't resolved by `wp_get_document_title()`.
		if ( empty( $title ) ) {
			if ( is_singular() ) {
				$title = get_the_title();
			} else {
				$title = get_bloginfo( 'name', 'display' );
			}
		}

		/**
		 * Filter here to edit the `title` property of the Retraceur Opengraph context.
		 *
		 * @since 3.0.0 Retraceur fork.
		 *
		 * @param string $title The `title` property of the Retraceur Opengraph context.
		 */
		$title = apply_filters( 'retraceur_opengraph_title', $title );

		return wp_strip_all_tags( $title );
	}

	/**
	 * Resolves the `description` property of the Retraceur Opengraph context.
	 *
	 * @since 3.0.0 Retraceur fork.
	 *
	 * @return string The `description` property of the Retraceur Opengraph context.
	 */
	public function resolve_description() {
		$description = '';

		if ( is_singular() ) {
			$post = get_post();

			if ( ! empty( $post->post_excerpt ) ) {
				$description = $post->post_excerpt;
			} else {
				/** This filter is documented in wp-includes/post-template.php */
				$description = apply_filters( 'the_content', $post->post_content );
			}
		} else {
			// Defaults to site's tagline.
			$description    = get_bloginfo( 'description', 'display' );
			$queried_object = get_queried_object();

			if ( $queried_object instanceof WP_User ) {
				$description = get_the_author_meta( 'description' );

				if ( empty( $description ) ) {
					$description = sprintf(
						/* Translators: %1$s is the Author name. %2$s is the Site name. */
						_x( '%1$s’s profile page on the %2$s website.', 'Default Opengraph profile description' ),
						$queried_object->display_name,
						get_bloginfo( 'name', 'display' )
					);
				}

			} elseif ( $queried_object instanceof WP_Term ) {
				$description = term_description();
			}
		}

		if ( empty( $description) ) {
			$description = sprintf(
				/* Translators: %s is the Website name. */
				_x( 'A %s website’s page.', 'Default Opengraph description' ),
				get_bloginfo( 'name', 'display' )
			);
		}

		/**
		 * Filter here to edit the `description` property of the Retraceur Opengraph context.
		 *
		 * @since 3.0.0 Retraceur fork.
		 *
		 * @param string $description The `description` property of the Retraceur Opengraph context.
		 */
		$description = apply_filters( 'retraceur_opengraph_description', $description );

		return wp_trim_words(
			wp_strip_all_tags( $description ),
			30
		);
	}

	/**
	 * Resolves the `image` property of the Retraceur Opengraph context.
	 *
	 * @since 3.0.0 Retraceur fork.
	 *
	 * @return string The `image` property of the Retraceur Opengraph context.
	 */
	public function resolve_image() {
		$image = '';

		if ( is_singular() && has_post_thumbnail() ) {
			$image = get_the_post_thumbnail_url( null, 'opengraph' );
		}

		if ( empty( $image ) ) {
			$image = retraceur_get_opengraph_url();
		}

		/**
		 * Filter here to edit the `image` property of the Retraceur Opengraph context.
		 *
		 * @since 3.0.0 Retraceur fork.
		 *
		 * @param string $image The `image` property of the Retraceur Opengraph context.
		 */
		return apply_filters( 'retraceur_opengraph_image', $image );
	}

	/**
	 * Resolves the site properties of the Retraceur Opengraph context.
	 *
	 * @since 3.0.0 Retraceur fork.
	 *
	 * @param Retraceur_Opengraph_Context $context     The Opengraph context object.
	 * @param array                       $title_parts Optional. The document title parts.
	 */
	private function resolve_site_properties( Retraceur_Opengraph_Context $context, $title_parts = array() ) {
		$title = '';

		// Use the title's document title part if available.
		if ( ! empty( $title_parts['title'] ) ) {
			$title = $title_parts['title'];
		}

		$context->type        = $this->resolve_type();
		$context->url         = $this->resolve_url();
		$context->site_name   = ! empty( $title_parts['site'] ) ? $title_parts['site'] : get_bloginfo( 'name', 'display' );
		$context->title       = $this->resolve_title( $title );
		$context->description = $this->resolve_description();
		$context->image       = $this->resolve_image();
		$context->locale      = get_locale();
	}

	/**
	 * Resolves the article properties of the Retraceur Opengraph context.
	 *
	 * @since 3.0.0 Retraceur fork.
	 *
	 * @param Retraceur_Opengraph_Context $context The Opengraph context object.
	 */
	private function resolve_article_properties( Retraceur_Opengraph_Context $context ) {

		if ( ! is_singular() ) {
			return;
		}

		$post                    = get_post();
		$context->published_time = wp_date( DATE_W3C, strtotime( $post->post_date_gmt ) );
		$context->modified_time  = wp_date( DATE_W3C, strtotime( $post->post_modified_gmt ) );
		$context->author_url     = get_author_posts_url( $post->post_author );

		$categories = get_the_category();
		if ( ! empty( $categories ) ) {
			$category         = reset( $categories );
			$context->section = $category->name;
		}

		$tags = get_the_tags();
		if ( $tags ) {
			$context->tags = wp_list_pluck( $tags, 'name' );
		}
	}

	/**
	 * Resolves the Opengraph context according to the current page being loaded.
	 *
	 * @since 3.0.0 Retraceur fork.
	 *
	 * @param array $title_parts Optional. The document title parts.
	 * @return Retraceur_Opengraph_Context|null The valid Opengraph context object. `null` when it is invalid.
	 */
	public function resolve( $title_parts = array() ) {
		$skip = $this->should_skip();

		/**
		 * Filter here to skip resolving Opengraph context for additional cases.
		 *
		 * @since 3.0.0 Retraceur fork.
		 *
		 * @param boolean $skip True to skip resolving the Opengraph context. False otherwise.
		 */
		if ( $skip || ( ! $skip && true === apply_filters( 'retraceur_opengraph_skip_resolving', $skip ) ) ) {
			return null;
		}

		$context = new Retraceur_Opengraph_Context();

		$this->resolve_site_properties( $context, $title_parts );

		if ( 'article' === $context->type ) {
			$this->resolve_article_properties( $context );
		}

		/**
		 * Filter to edit the full Retraceur Opengraph context.
		 *
		 * @since 3.0.0 Retraceur fork.
		 *
		 * @param Retraceur_Opengraph_Context|null The valid Opengraph context object. `null` when it is invalid.
		 */
		$context = apply_filters( 'retraceur_opengraph_context', $context );

		return $this->is_valid( $context ) ? $context : null;
	}
}
