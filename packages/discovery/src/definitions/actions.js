/**
 * WP dependencies
 */
import apiFetch from '@wordpress/api-fetch';
import {
	Button,
	ExternalLink,
	Spinner,
	privateApis as componentsPrivateApis,
} from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import { useState, useCallback } from '@wordpress/element';
import { __, sprintf } from '@wordpress/i18n';

/**
 * Internal dependencies
 */
import discoveryStore from './../store';
import { unlock } from '../lock-unlock';

const { Tabs } = unlock( componentsPrivateApis );

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
			const [ activeTab, setActiveTab ] = useState( 'details' );
			const [ item ] = items;
			const { repository, isRequesting } = useSelect( ( select ) => {
				return {
					repository:   select( discoveryStore ).getRepository( item.full_name ),
					isRequesting: select( discoveryStore ).isRequestingRepository( item.full_name ),
				};
			}, [] );

			// Releases are only fetched if the corresponding tab is active.
			const { releases, isRequestingReleases } = useSelect( ( select ) => {
				if ( activeTab !== 'releases' ) {
					return { releases: [], isRequestingReleases: false };
				}
				return {
					releases:             select( discoveryStore ).getReleases( item.full_name ),
					isRequestingReleases: select( discoveryStore ).isRequestingReleases( item.full_name ),
				};
			}, [ activeTab ] );

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
					<Tabs
						defaultTabId="details"
						onSelect={ ( tabId ) => setActiveTab( tabId ) }
					>
						<Tabs.TabList>
							<Tabs.Tab tabId="details">
								{ __( 'Details' ) }
							</Tabs.Tab>
							<Tabs.Tab tabId="releases">
								{ __( 'Releases' ) }
							</Tabs.Tab>
						</Tabs.TabList>

						<Tabs.TabPanel tabId="details">
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
						</Tabs.TabPanel>
						<Tabs.TabPanel tabId="releases">
							{ isRequestingReleases && <Spinner /> }
							{ ! isRequestingReleases && ! releases.length && (
								<p>{ sprintf( __( 'No releases found for %s.' ), repository.name ) }</p>
							) }
							{ ! isRequestingReleases && !! releases.length && (
								<ul className="retraceur-repository-modal__releases">
									{ releases.map( ( release ) => (
										<li key={ release.version }>
											<strong>{ release.title }</strong>
											<span>
												<ExternalLink href={ release.release_url }>
													{ __( 'Release note' ) }
												</ExternalLink>
												<Button
													href={ release.download_url }
													variant="secondary"
												>
													{ __( 'Download' ) }
												</Button>
											</span>
										</li>
									) ) }
								</ul>
							) }
						</Tabs.TabPanel>
					</Tabs>
				</div>
			);
		},
		modalHeader: __( 'Repository details' ),
	},
]

export default actions;
