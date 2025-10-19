/**
 * WP dependencies
 */
import domReady from '@wordpress/dom-ready';
import { createRoot } from '@wordpress/element';
import { __ } from '@wordpress/i18n';

const Discovery = ( { settings } ) => {
	return (
		<div>
			<p>{ __( 'The Discovery Admin UI is available.' ) }</p>
		</div>
	)
}

domReady( function() {
	const target = document.querySelector( '#retraceur-discovery' );
	const root = createRoot( target );
	const settings = window.retraceurDiscoverySettings || {};

	root.render( <Discovery settings={ settings } /> );
} );
