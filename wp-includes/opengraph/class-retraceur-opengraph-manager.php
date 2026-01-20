<?php
/**
 * Opengraph: Retraceur_Opengraph_Manager class.
 *
 * @since 3.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Opengraph
 */

/**
 * Class Retraceur_Opengraph_Manager.
 *
 * @since 3.0.0 Retraceur fork.
 */
class Retraceur_Opengraph_Manager {

	/**
	 * Retraceur Opengraph context resolver object.
	 *
	 * @since 3.0.0 Retraceur fork.
	 *
	 * @var Retraceur_Opengraph_Resolver
	 */
	private Retraceur_Opengraph_Resolver $resolver;

	/**
	 * Retraceur Opengraph meta tags renderer object.
	 *
	 * @since 3.0.0 Retraceur fork.
	 *
	 * @var Retraceur_Opengraph_Renderer
	 */
	private Retraceur_Opengraph_Renderer $renderer;

	/**
	 * The document title parts.
	 *
	 * @since 3.0.0 Retraceur fork.
	 *
	 * @var array
	 */
	public array $title_parts = array();

	/**
	 * Retraceur Opengraph manager constructor.
	 *
	 * @since 3.0.0 Retraceur fork.
	 */
	public function __construct( Retraceur_Opengraph_Resolver $resolver, Retraceur_Opengraph_Renderer $renderer ) {
		$this->resolver = $resolver;
		$this->renderer = $renderer;
	}

	/**
	 * Sets the title parts property.
	 *
	 * The title is first set by `wp_get_document_title()` inside its title parts array,
	 * using this value makes sure the `og:title` property will be consistent with the
	 * `<title>` tag.
	 *
	 * @since 3.0.0 Retraceur fork.
	 *
	 * @param array $title_parts {
	 *     The document title parts.
	 *
	 *     @type string $title   Title of the viewed page.
	 *     @type string $page    Optional. Page number if paginated.
	 *     @type string $tagline Optional. Site description when on home page.
	 *     @type string $site    Optional. Site title when not on home page.
	 * }
	 */
	public function set_title_parts( $title_parts = array() ) {
		$this->title_parts = $title_parts;
	}

	/**
	 * Renders the Opengraph meta tags.
	 *
	 * @since 3.0.0 Retraceur fork.
	 *
	 * @return void
	 */
	public function render() {
		$opengraph = $this->resolver->resolve( $this->title_parts );
		return;
	}

	/**
	 * Registers needed Hooks to render the Opengraph meta tags.
	 *
	 * @since 3.0.0 Retraceur fork.
	 */
	public function register() {
		add_action( 'defined_title_parts', array( $this, 'set_title_parts' ), 10, 1 );
		add_action( 'wp_head', array( $this, 'render' ), 10 );
	}
}
