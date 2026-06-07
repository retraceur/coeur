/**
 * WP dependencies
 */
import apiFetch from '@wordpress/api-fetch';
import {
	Button,
	ExternalLink,
	Spinner,
} from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import { useState, useCallback } from '@wordpress/element';
import { __, sprintf } from '@wordpress/i18n';

/**
 * Internal dependencies
 */
import discoveryStore from './../store';

const actions = [
	{
		id: 'install-repository',
		label: __( 'Install latest' ),
		RenderModal: ( { items, closeModal } ) => {
			const [ item ]                      = items;
			const { repository, isRequesting } = useSelect( ( select ) => {
				return {
					repository:   select( discoveryStore ).getRepository( item.full_name ),
					isRequesting: select( discoveryStore ).isRequestingRepository( item.full_name ),
				};
			}, [] );
			const [ isInstalling, setInstalling ] = useState( false );
			const [ success, setSuccess ]         = useState( null );
			const [ error, setError ]             = useState( null );

			const onInstall = useCallback( async () => {
				setInstalling( true );
				setError( null );

				try {
					await apiFetch( {
						path:   '/wp/v2/discover/install',
						method: 'POST',
						data:   {
							full_name:    repository.full_name,
							version:      repository.version,
							download_url: repository.download_url,
							digest:       repository.digest ?? '',
						},
					} );
					setSuccess( true );
				} catch ( e ) {
					setError( e?.message ?? __( 'Unknown error.' ) );
				} finally {
					setInstalling( false );
				}
			}, [ repository ] );

			if ( isInstalling || isRequesting ) {
				return <Spinner />;
			}

			if ( ! repository.version ) {
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

			if ( success ) {
				return (
					<>
						<p>
							{ sprintf(
								/* Translators: %s is the repository name. */
								__( '%s was successfully installed.' ),
								item.name
							) }
						</p>
						<Button variant="primary" onClick={ closeModal }>
							{ __( 'Close' ) }
						</Button>
					</>
				);
			}

			return (
				<>
					<p>
						{ sprintf(
							/* Translators: %s is the repository name. */
							__( 'Are you sure you want to install %1$s %2$s?' ),
							item.name,
							repository.version
						) }
					</p>
					{ error && (
						<p className="retraceur-install-error">
							{ error }
						</p>
					) }
					<Button
						variant="primary"
						onClick={ onInstall }
					>
						{ __( 'Install' ) }
					</Button>
					<Button variant="tertiary" onClick={ closeModal }>
						{ __( 'Cancel' ) }
					</Button>
				</>
			);
		},
		modalHeader: __( 'Install repository’s latest release' ),
	},
	{
		id: 'view-repository',
		label: __( 'View details' ),
		RenderModal: ( { items, closeModal, onInstall } ) => {
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
								variant="primary"
								onClick={ () => onInstall( repository ) }
							>
								{ __( 'Install' ) }
							</Button>
							&nbsp;
							<Button
								href={ repository.download_url }
								variant="secondary"
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
			const [ repository ] = items;
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
