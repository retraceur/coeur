/**
 * @file Functionality for the plugis screen.
 *
 * @output wp-admin/js/plugin-install.js
 */

/**
 * WP dependencies
 */
const { domReady } = wp;

domReady( () => {
	const pluginsScreen = document.body;
	const uploadViewToggler = document.querySelector( '.upload-view-toggle' );

	if ( uploadViewToggler ) {
		uploadViewToggler.addEventListener( 'click', ( e ) => {
			e.preventDefault();

			if ( pluginsScreen.classList.contains( 'show-upload-view' ) ) {
				pluginsScreen.classList.remove( 'show-upload-view' );
			} else {
				pluginsScreen.classList.add( 'show-upload-view' );
			}

			e.currentTarget.setAttribute( 'aria-expanded', pluginsScreen.classList.contains( 'show-upload-view' ) );
		} );
	}
} );
