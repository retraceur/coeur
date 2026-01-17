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
	 * Hooks to `wp_head` to render the Opengraph meta tags.
	 *
	 * @since 3.0.0 Retraceur fork.
	 */
	public function register() {
		add_action( 'wp_head', array( $this, 'render' ), 10 );
	}

	/**
	 * Renders the Opengraph meta tags.
	 *
	 * @since 3.0.0 Retraceur fork.
	 *
	 * @return void
	 */
	public function render() {
		return;
	}
}
