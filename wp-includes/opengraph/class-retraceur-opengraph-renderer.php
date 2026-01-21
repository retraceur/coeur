<?php
/**
 * Opengraph: Retraceur_Opengraph_Renderer class.
 *
 * @since 3.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Opengraph
 */

/**
 * Class Retraceur_Opengraph_Renderer.
 *
 * @since 3.0.0 Retraceur fork.
 */
class Retraceur_Opengraph_Renderer {

	/**
	 * Builds the Retraceur Opengraph meta tag.
	 *
	 * @since
	 *
	 * @param string $property Required. The name of the Opengraph property.
	 * @param string $content  Optional. The Opengraph content value.
	 * @return string The Opengraph HTML output.
	 */
	private function meta( $property, $content = '' ) {

		if ( '' === $content ) {
			return '';
		}

		if ( 'og:url' === $property || 'article:author' === $property ) {
			return sprintf(
				'<meta property="%s" content="%s" />',
				esc_attr( $property ),
				esc_url( $content )
			);
		}

		return sprintf(
			'<meta property="%s" content="%s" />',
			esc_attr( $property ),
			esc_attr( $content )
		);
	}

	/**
	 * Renders the site properties of the Retraceur Opengraph context.
	 *
	 * @since 3.0.0 Retraceur fork.
	 *
	 * @param Retraceur_Opengraph_Context $context The Opengraph context object.
	 * @return string The Site's Retraceur Opengraph meta tags.
	 */
	private function render_site_properties( Retraceur_Opengraph_Context $context ) {
		$html = array();

		$html[] = $this->meta( 'og:title', $context->title );
		$html[] = $this->meta( 'og:description', $context->description );
		$html[] = $this->meta( 'og:type', $context->type );
		$html[] = $this->meta( 'og:url', $context->url );
		$html[] = $this->meta( 'og:site_name', $context->site_name );

		if ( ! empty( $context->image ) ) {
			$html[] = $this->meta( 'og:image', $context->image );

			if ( $context->image_width ) {
				$html[] = $this->meta( 'og:image:width', (string) $context->image_width );
			}

			if ( $context->image_height ) {
				$html[] = $this->meta( 'og:image:height', (string) $context->image_height );
			}
		}

		if ( ! empty( $context->locale ) ) {
			$html[] = $this->meta( 'og:locale', $context->locale );
		}

		foreach ( $context->alternate_locales as $locale ) {
			$html[] = $this->meta( 'og:locale:alternate', $locale );
		}

		return implode( "\n", array_filter( $html ) );
	}

	/**
	 * Renders the article properties of the Retraceur Opengraph context.
	 *
	 * @since 3.0.0 Retraceur fork.
	 *
	 * @param Retraceur_Opengraph_Context $context The Opengraph context object.
	 * @return string The article's Retraceur Opengraph meta tags.
	 */
	private function render_article_properties( Retraceur_Opengraph_Context $context ) {
		return '';
	}

	/**
	 * Renders all Retraceur Opengraph meta tags.
	 *
	 * @since 3.0.0 Retraceur fork.
	 *
	 * @param Retraceur_Opengraph_Context $context The Opengraph context object.
	 */
	public function render( Retraceur_Opengraph_Context $context ) {
		echo "\n" . $this->render_site_properties( $context );
		echo $this->render_article_properties( $context );
		echo "\n";
	}
}
