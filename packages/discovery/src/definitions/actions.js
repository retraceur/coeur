/**
 * WP dependencies
 */
import { useSelect } from '@wordpress/data';
import { __, sprintf } from '@wordpress/i18n';

/**
 * Internal dependencies
 */
import discoveryStore from './../store';

const actions = [
	{
		id: 'view-releases',
		label: __( 'View releases' ),
		RenderModal: ( { items } ) => {
			const [repository] = items;
			const releases = useSelect( ( select ) => {
				return select( discoveryStore ).getReleases( repository.full_name );
			}, [] );
			const releasesList = releases.map( ( release, id ) => {
				return (
					<li key={ id }>
						<span>{ release.title } : </span>
						<strong>{ release.version }</strong>
					</li>
				);
			} );

			return (
				<div>
					<h2>
						{
							/* Translators: %s is the repository name. */
							sprintf( __( '%s’s releases' ), repository.name )
						}
					</h2>
					<ul>
						{ releasesList }
					</ul>
				</div>
			);
		},
		modalHeader: __( 'Available releases' )
	},
]

export default actions;
