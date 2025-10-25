/**
 * WP dependencies
 */
import { useSelect } from '@wordpress/data';
import { DataViews, filterSortAndPaginate } from '@wordpress/dataviews';
import domReady from '@wordpress/dom-ready';
import { createRoot, useMemo, useState } from '@wordpress/element';
import { __ } from '@wordpress/i18n';

/**
 * Internal dependencies
 */
import discoveryStore from './store';
import fields from './definitions/fields';
import defaultLayouts from './definitions/layouts';
import actions from './definitions/actions';
import './style.scss';

const Discovery = ( { settings } ) => {
	const repositories = useSelect( ( select ) => {
		return select( discoveryStore ).getRepositories();
	}, [] );
	const [ view, setView ] = useState( {
		type: 'table',
		perPage: 10,
		layout: defaultLayouts.grid.layout,
		fields: [
			'image',
			'full_name',
			'name',
			'description',
			'author',
		],
	} );
	const { data: processedData, paginationInfo } = useMemo( () => {
		return filterSortAndPaginate( repositories, view, fields );
	}, [ view ] );

	return (
        <DataViews
            data={ processedData }
            fields={ fields }
            view={ view }
            onChangeView={ setView }
            defaultLayouts={ defaultLayouts }
			actions={ actions }
			paginationInfo={ paginationInfo }
        />
    );
}

domReady( function() {
	const target = document.querySelector( '#retraceur-discovery' );
	const root = createRoot( target );
	const settings = window.retraceurDiscoverySettings || {};

	root.render( <Discovery settings={ settings } /> );
} );
