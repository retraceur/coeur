/**
 * WP dependencies
 */
import { Modal } from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import { DataViews, filterSortAndPaginate } from '@wordpress/dataviews';
import domReady from '@wordpress/dom-ready';
import {
	createRoot,
	useMemo,
	useState,
	useCallback,
} from '@wordpress/element';
import { __ } from '@wordpress/i18n';

/**
 * Internal dependencies
 */
import discoveryStore from './store';
import fields from './definitions/fields';
import defaultLayouts from './definitions/layouts';
import actions from './definitions/actions';

/**
 * Style dependency
 */
import './discovery.scss';

const Discovery = ( { settings } ) => {
	const { pluginType } = settings;
	const repositories = useSelect( ( select ) => {
		return select( discoveryStore ).getRepositories( pluginType );
	}, [] );
	const [ view, setView ] = useState( {
		type: 'grid',
		perPage: 10,
		layout: defaultLayouts.grid.layout,
		titleField: 'name',
		descriptionField: 'description',
		mediaField: 'image',
		fields: ['author'],
	} );
	// Used to set the active repository.
    const [ activeRepository, setActiveRepository ] = useState( null );
	const { data: processedData, paginationInfo } = useMemo( () => {
		return filterSortAndPaginate( repositories, view, fields );
	}, [ view ] );

	// Fires the `view-repository` action.
    const onClickItem = useCallback( ( repository ) => {
        setActiveRepository( repository );
    }, [] );

    // All items can be clicked.
    const isItemClickable = useCallback( () => true, [] );

    // Find the `view-repository` action to reuse its RenderModal.
    const viewRepositoryAction = actions.find( ( a ) => a.id === 'view-repository' );
    const RenderModal = viewRepositoryAction?.RenderModal;

	return (
		<>
			 <DataViews
				data={ processedData }
				fields={ fields }
				view={ view }
				onChangeView={ setView }
				defaultLayouts={ defaultLayouts }
				actions={ actions }
				paginationInfo={ paginationInfo }
				onClickItem={ onClickItem }
				isItemClickable={ isItemClickable }
			/>
			{ activeRepository && RenderModal && (
				<Modal
					title={ viewRepositoryAction.modalHeader }
					size='medium'
					onRequestClose={ () => setActiveRepository( null ) }
					className='dataviews-action-modal dataviews-action-modal__view-repository'
				>
					<RenderModal
						items={ [ activeRepository ] }
						closeModal={ () => setActiveRepository( null ) }
					/>
				</Modal>
			) }
		</>
    );
}

domReady( function() {
	const target = document.querySelector( '#retraceur-discovery' );
	const root = createRoot( target );
	const settings = window.retraceurDiscoverySettings || {};

	root.render( <Discovery settings={ settings } /> );
} );
