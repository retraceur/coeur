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

		if ( ! is_front_page() && ! is_home() && is_singular() ) {
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
	 * @return string The `title` property of the Retraceur Opengraph context.
	 */
	public function resolve_title() {
		$title = '';

		if ( is_singular() ) {
			$title = get_the_title();
		}

		if ( empty( $title ) ) {
			$title = get_bloginfo( 'name' );
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
				$description = $post->post_content;
			}
		} else {
			$description = get_bloginfo( 'description' );
		}

		if ( empty( $description) ) {
			$description = sprintf(
				/* Translators: %s is the Website name. */
				_x( 'A %s website’s page.', 'Default Opengraph description' ),
				get_bloginfo( 'name' )
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
			$image = get_the_post_thumbnail_url( null, 'full' );
		}

		if ( empty( $image ) ) {
			$image = get_option( 'retraceur_default_ogengraph_image', '' );
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
	 * Resolves the basic part of the Retraceur Opengraph context.
	 *
	 * @since 3.0.0 Retraceur fork.
	 *
	 * @param Retraceur_Opengraph_Context $context The Opengraph context object.
	 */
	private function resolve_basic_properties( Retraceur_Opengraph_Context $context ) {
		$context->type        = $this->resolve_type();
		$context->url         = $this->resolve_url();
		$context->site_name   = get_bloginfo( 'name' );
		$context->title       = $this->resolve_title();
		$context->description = $this->resolve_description();
		$context->image       = $this->resolve_image();
		$context->locale      = get_locale();
	}

	/**
	 * Resolves the detailed part of the Retraceur Opengraph context.
	 *
	 * @since 3.0.0 Retraceur fork.
	 *
	 * @param Retraceur_Opengraph_Context $context The Opengraph context object.
	 */
	private function resolve_article_properties( Retraceur_Opengraph_Context $context ) {
		return;
	}

	/**
	 * Resolves the Opengraph context according to the current page being loaded.
	 *
	 * @since 3.0.0 Retraceur fork.
	 *
	 * @return Retraceur_Opengraph_Context|null The valid Opengraph context object. `null` when it is invalid.
	 */
	public function resolve() {
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

		$this->resolve_basic_properties( $context );

		if ( $context->type === 'article' ) {
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
