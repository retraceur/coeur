/**
 * WP dependencies
 */
import { useSelect } from '@wordpress/data';
import domReady from '@wordpress/dom-ready';
import { createRoot } from '@wordpress/element';
import { __ } from '@wordpress/i18n';

/**
 * Internal dependencies
 */
import discoveryStore from './store';

const Discovery = ( { settings } ) => {
	const repositories = useSelect( ( select ) => {
		return select( discoveryStore ).getRepositories();
	}, [] );

	return (
		<div>
			<p>{ __( 'The Discovery Admin UI is available.' ) }</p>
			<ul>
				{ repositories.map( ( repository ) => {
					return (
						<li key={ repository.id }>
							{ repository.name }
						</li>
					);
				} ) }
			</ul>
		</div>
	)
}

domReady( function() {
	const target = document.querySelector( '#retraceur-discovery' );
	const root = createRoot( target );
	const settings = window.retraceurDiscoverySettings || {};

	root.render( <Discovery settings={ settings } /> );
} );
