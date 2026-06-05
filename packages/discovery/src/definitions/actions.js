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
		id: 'view-repository',
		label: __( 'View details' ),
		RenderModal: ( { items } ) => {
			const [ item ] = items;
			const { repository, isRequesting } = useSelect( ( select ) => {
				return {
					repository:   select( discoveryStore ).getRepository( item.full_name ),
					isRequesting: select( discoveryStore ).isRequestingRepository( item.full_name ),
				};
			}, [] );

			if ( isRequesting ) {
				return <Spinner />;
			}

			return (
				<div>
					<img
						alt={ sprintf(
							/* Translators: %s is the repository name. */
							__( 'Preview image of %s' ),
							repository.name
						) }
						src={ repository.image }
						onError={ ( e ) => {
							e.target.onerror = null;
							e.target.src = `https://opengraph.github.com/repo/${ repository.full_name }`;
						} }
					/>
					<p>{ repository.description }</p>
					{ repository.requires_retraceur && (
						<p>
							{ sprintf(
								/* Translators: %s is the version number. */
								__( 'Requires Retraceur %s or higher.' ),
								repository.requires_retraceur
							) }
						</p>
					) }
					{ repository.requires_php && (
						<p>
							{ sprintf(
								/* Translators: %s is the version number. */
								__( 'Requires PHP %s or higher.' ),
								repository.requires_php
							) }
						</p>
					) }
					{ repository.version && (
						<p>
							{ sprintf(
								/* Translators: %s is the version number. */
								__( 'Latest version: %s' ),
								repository.version
							) }
							&nbsp;
							<Button
								href={ repository.download_url }
								variant="primary"
							>
								{ __( 'Download' ) }
							</Button>
						</p>
					) }
					{ repository.homepage && (
						<ExternalLink href={ repository.homepage }>
							{ __( 'Visit homepage' ) }
						</ExternalLink>
					) }
				</div>
			);
		},
		modalHeader: __( 'Repository details' ),
	},
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
