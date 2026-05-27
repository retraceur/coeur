/**
 * WP dependencies
 */
import { useSelect } from '@wordpress/data';
import { __, sprintf } from '@wordpress/i18n';
import { ExternalLink } from '@wordpress/components';
import { Button } from '@wordpress/components';

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
