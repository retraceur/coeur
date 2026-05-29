/**
 * WP dependencies
 */
import { useSelect } from '@wordpress/data';
import { __, sprintf } from '@wordpress/i18n';
import {
	Button,
	ExternalLink,
	Spinner,
} from '@wordpress/components';

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
			const { releases, isRequesting } = useSelect( ( select ) => {
				return {
					releases:     select( discoveryStore ).getReleases( repository.full_name ),
					isRequesting: select( discoveryStore ).isRequestingReleases( repository.full_name ),
				};
			}, [] );

			if ( isRequesting ) {
				return <Spinner />;
			}

			if ( ! releases.length ) {
				return (
					<p>
						{ sprintf(
							/* Translators: %s is the repository name. */
							__( 'No releases found for %s.' ),
							repository.name
						) }
					</p>
				);
			}

			const releasesList = releases.map( ( release, id ) => {
				return (
					<li key={ release.version }>
						<div>
							<strong>{ release.title }</strong>
							<span>
								&nbsp;(
								<ExternalLink href={ release.release_url }>
									{ __( 'Release note' ) }
								</ExternalLink>
								)&nbsp;
								<Button
									href={ release.download_url }
									variant="primary"
								>
									{ __( 'Download' ) }
								</Button>
							</span>
						</div>
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
