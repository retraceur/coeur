/**
 * WP dependencies
 */
import apiFetch from '@wordpress/api-fetch';
import {
	Button,
	ExternalLink,
	Notice,
	Spinner,
	privateApis as componentsPrivateApis,
} from '@wordpress/components';
import { useSelect, useDispatch } from '@wordpress/data';
import { dateI18n } from '@wordpress/date';
import {
	useState,
	useCallback,
	RawHTML,
} from '@wordpress/element';
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
		isEligible: ( item ) => ! item.is_installed,
		RenderModal: ( { items, closeModal } ) => {
			const [ item ]                      = items;
			const { repository, isRequesting, compatibility } = useSelect( ( select ) => {
				return {
					repository: select( discoveryStore ).getRepository( item.full_name ),
					isRequesting: select( discoveryStore ).isRequestingRepository( item.full_name ),
					compatibility: select( discoveryStore ).getRepositoryCompatibility( item.full_name ),
				};
			}, [] );
			const [ isInstalling, setInstalling ] = useState( false );
			const [ success, setSuccess ] = useState( null );
			const [ error, setError ] = useState( null );
			const { markAsInstalled } = useDispatch( discoveryStore );

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

					// Update installation status.
					markAsInstalled( item.full_name );
				} catch ( e ) {
					setError( e?.message ?? __( 'Unknown error.' ) );
				} finally {
					setInstalling( false );
				}
			}, [ repository ] );

			if ( isInstalling || isRequesting ) {
				return (
					<div className="retraceur-repository-modal__spinner">
						<Spinner />
					</div>
				);
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

			if ( ! compatibility.compatible ) {
				return (
					<>
						<Notice status="warning" isDismissible={ false }>
							<p>{ __( 'This repository is not compatible with your installation:' ) }</p>
							<ul>
								{ compatibility.reasons.map( ( reason, i ) => (
									<li key={ i }>{ reason }</li>
								) ) }
							</ul>
						</Notice>
						<Button variant="tertiary" onClick={ closeModal }>
							{ __( 'Cancel' ) }
						</Button>
					</>
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
			const discoverySettings = useSelect( ( select ) => {
				return select( discoveryStore ).getSettings();
			}, [] );
			const [ item ] = items;
			const { repository, isRequesting, compatibility } = useSelect( ( select ) => {
				return {
					repository: select( discoveryStore ).getRepository( item.full_name ),
					isRequesting: select( discoveryStore ).isRequestingRepository( item.full_name ),
					compatibility: select( discoveryStore ).getRepositoryCompatibility( item.full_name ),
				};
			}, [] );

			// Releases are only fetched if the corresponding tab is active.
			const { releases, isRequestingReleases } = useSelect( ( select ) => {
				if ( activeTab !== 'releases' ) {
					return { releases: [], isRequestingReleases: false };
				}
				return {
					releases: select( discoveryStore ).getReleases( item.full_name ),
					isRequestingReleases: select( discoveryStore ).isRequestingReleases( item.full_name ),
				};
			}, [ activeTab ] );

			// Changelog is only fetched if the corresponding tab is active.
			const { changelog, isRequestingChangelog } = useSelect( ( select ) => {
				if ( activeTab !== 'changelog' ) {
					return { changelog: null, isRequestingChangelog: false };
				}
				return {
					changelog: select( discoveryStore ).getChangelog( item.full_name ),
					isRequestingChangelog: select( discoveryStore ).isRequestingChangelog( item.full_name ),
				};
			}, [ activeTab ] );

			if ( isRequesting ) {
				return (
					<div className="retraceur-repository-modal__spinner">
						<Spinner />
					</div>
				);
			}

			const hasRelease  = !! repository.version;
			const hasAsset    = !! repository.download_url;
			const isInstalled = !! repository.is_installed;

			return (
				<div className="retraceur-repository-modal">
					<div className="retraceur-repository-modal__header">
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
						<div className="retraceur-repository-modal__header-meta">
							<h2 className="retraceur-repository-modal__title">
								{ repository.name }
							</h2>
							<div className="retraceur-repository-modal__actions">
								{ isInstalled && (
									<span className="retraceur-repository-modal__installed-badge">
										{ __( 'Installed' ) }
									</span>
								) }
								{ ! isInstalled && hasAsset && compatibility.compatible && (
									<>
										<Button
											variant="primary"
											onClick={ () => onInstall( repository ) }
										>
											{ sprintf(
												/* Translators: %s is the version number. */
												__( 'Install %s' ),
												repository.version
											) }
										</Button>
										<Button
											href={ repository.download_url }
											variant="secondary"
										>
											{ sprintf(
												/* Translators: %s is the version number. */
												__( 'Download %s' ),
												repository.version
											) }
										</Button>
									</>
								) }
							</div>
						</div>
					</div>

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
							<Tabs.Tab tabId="changelog">
								{ __( 'Changelog' ) }
							</Tabs.Tab>
						</Tabs.TabList>

						<Tabs.TabPanel tabId="details">
							{ ! compatibility.compatible && (
								<Notice
									status="warning"
									isDismissible={ false }
								>
									<p>{ __( 'This repository may not be compatible with your installation:' ) }</p>
									<ul>
										{ compatibility.reasons.map( ( reason, i ) => (
											<li key={ i }>{ reason }</li>
										) ) }
									</ul>
								</Notice>
							) }
							{ ! hasRelease && (
								<Notice
									status="warning"
									isDismissible={ false }
								>
									<p>{ __( 'No release available yet.' ) }</p>
								</Notice>
							) }
							{ hasRelease && ! hasAsset && (
								<Notice
									status="warning"
									isDismissible={ false }
								>
									<p>{ __( 'No installable asset found for this release.' ) }</p>
								</Notice>
							) }
							<div className="retraceur-repository-modal__details">
								<p className="retraceur-repository-modal__description">
									<span>{ repository.description }</span>
									<span>
										<ExternalLink href={ repository.html_url }>
											{ __( 'Discover more' ) }
										</ExternalLink>
									</span>
								</p>
								<dl className="retraceur-repository-modal__details-meta">
									{ repository.requires_retraceur && (
										<>
											<dt>{ __( 'Requires Retraceur' ) }</dt>
											<dd>{ repository.requires_retraceur }</dd>
										</>
									) }
									{ repository.requires_php && (
										<>
											<dt>{ __( 'Requires PHP' ) }</dt>
											<dd>{ repository.requires_php }</dd>
										</>
									) }
									{ repository.last_updated && (
										<>
											<dt>{ __( 'Last updated' ) }</dt>
											<dd>{ dateI18n( discoverySettings.dateFormat, repository.last_updated ) }</dd>
										</>
									) }
									<dt>{ __( 'Stars' ) }</dt>
									<dd>{ repository.stargazers_count }</dd>
									<dt>{ __( 'Open issues' ) }</dt>
									<dd>{ repository.open_issues_count }</dd>
								</dl>
							</div>
						</Tabs.TabPanel>
						<Tabs.TabPanel tabId="releases">
							{ isRequestingReleases && (
								<div className="retraceur-repository-modal__spinner">
									<Spinner />
								</div>
							) }
							{ ! isRequestingReleases && ! releases.length && (
								<Notice
									status="warning"
									isDismissible={ false }
								>
									<p>{ sprintf( __( 'No releases found for %s.' ), repository.name ) }</p>
								</Notice>
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
						<Tabs.TabPanel tabId="changelog">
							{ isRequestingChangelog && (
								<div className="retraceur-repository-modal__spinner">
									<Spinner />
								</div>
							) }
							{ ! isRequestingChangelog && ! changelog && (
								<Notice
									status="warning"
									isDismissible={ false }
								>
									<p>{ __( 'No changelog available.' ) }</p>
								</Notice>
							) }
							{ ! isRequestingChangelog && !! changelog && (
								<RawHTML className="retraceur-repository-modal__changelog">
									{ changelog }
								</RawHTML>
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
