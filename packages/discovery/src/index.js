/**
 * WP dependencies
 */
import { Modal, ExternalLink } from '@wordpress/components';
import { useSelect, useDispatch } from '@wordpress/data';
import { DataViews } from '@wordpress/dataviews';
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
import RetraceurIcon from './assets/icon';

/**
 * Style dependency
 */
import './discovery.scss';

const Discovery = ( { settings } ) => {
	const { pluginType } = settings;
	const { setSettings } = useDispatch( discoveryStore );
	const discoverySettings = useSelect( ( select ) => {
		return select( discoveryStore ).getSettings();
	}, [] );

	// Set discovery settings.
	if ( ! discoverySettings.pluginType ) {
		setSettings( settings );
	}
	const [ view, setView ] = useState( {
		type: 'grid',
		page: 1,
		perPage: 10,
		layout: defaultLayouts.grid.layout,
		titleField: 'name',
		descriptionField: 'description',
		mediaField: 'image',
		fields: ['author'],
	} );
	const { repositories, paginationInfo } = useSelect( ( select ) => {
		return {
			repositories:   select( discoveryStore ).getRepositories( pluginType, view.page, view.perPage ),
			paginationInfo: select( discoveryStore ).getRepositoriesPaginationInfo(),
		};
	}, [ view.page, view.perPage ] );

	// Used to manage the modal to display.
	const [ openRepository, SetOpenRepository ] = useState( null );

	// Fires the `view-repository` action.
	const onClickItem = useCallback( ( repository ) => {
		SetOpenRepository( repository );
	}, [] );

	// All items can be clicked.
	const isItemClickable = useCallback( () => true, [] );

	// Find the action to reuse its RenderModal.
	const viewRepositoryAction = actions.find( ( a ) => a.id === 'view-repository' );
	const installRepositoryAction = actions.find( ( a ) => a.id === 'install-repository' );
	const RenderModal = viewRepositoryAction?.RenderModal;
	const InstallRepositoryModal = installRepositoryAction?.RenderModal;

	const installationRequest = useSelect( ( select ) => {
		return select( discoveryStore ).getInstallationRequest();
	}, [] );

	const { requestInstallation } = useDispatch( discoveryStore );
	const customEmptyResults = (
		<div className="retraceur-discovery-empty">
			<RetraceurIcon />
			<h2 className="retraceur-discovery-empty__heading">
				{ 'block' === pluginType
					? __( 'No available Blocks yet' )
					: __( 'No available Plugins yet' )
				}
			</h2>
			<p className="retraceur-discovery-empty__description">
				{ 'block' === pluginType
					? __( 'Get started by building & publishing a Block.' )
					: __( 'Get started by building & publishing a Plugin.' )
				}
			</p>
			<ExternalLink
				className="button button-primary"
				href={
					/* translators: use the documentation URL of your language. */
					__( 'https://retraceur.github.io/plugins/publish/' )
				}
			>
				{ __( 'Read more about it' ) }
			</ExternalLink>
		</div>
	);

	return (
		<>
			 <DataViews
				data={ repositories }
				fields={ fields }
				view={ view }
				onChangeView={ setView }
				defaultLayouts={ defaultLayouts }
				actions={ actions }
				paginationInfo={ paginationInfo }
				onClickItem={ onClickItem }
				isItemClickable={ isItemClickable }
				search={ false }
				empty={ customEmptyResults }
			/>
			{ openRepository && RenderModal && (
				<Modal
					title={ viewRepositoryAction.modalHeader }
					size='medium'
					onRequestClose={ () => SetOpenRepository( null ) }
					className='dataviews-action-modal dataviews-action-modal__view-repository'
				>
					<RenderModal
						items={ [ openRepository ] }
						closeModal={ () => SetOpenRepository( null ) }
					/>
				</Modal>
			) }
			{ installationRequest && InstallRepositoryModal && (
				<Modal
					title={ installRepositoryAction.modalHeader }
					size="medium"
					onRequestClose={ () => requestInstallation( null ) }
					className="dataviews-action-modal dataviews-action-modal__install-repository"
				>
					<InstallRepositoryModal
						items={ [ installationRequest ] }
						closeModal={ () => requestInstallation( null ) }
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
