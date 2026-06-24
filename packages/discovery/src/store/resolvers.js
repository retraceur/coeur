/**
 * WP dependencies.
 */
import apiFetch from '@wordpress/api-fetch';

/**
 * Internal dependencies.
 */
import {
	fetchRepositories,
	receiveRepositories,
	fetchReleases,
	receiveReleases,
	fetchRepository,
    receiveRepository,
	fetchChangelog,
	receiveChangelog,
} from './actions';

export const getRepositories = ( pluginType, page = 1, perPage = 10 ) => async ( { dispatch } ) => {
	try {
		dispatch( fetchRepositories() );
		const items = await apiFetch( {
			path: `/wp/v2/discover/repositories?type=${ pluginType }&page=${ page }&per_page=${ perPage }`,
		} );

		const { repositories, total_items, total_pages } = items;

		const totalItems = parseInt( total_items, 10 ) || 0;
		const totalPages = parseInt( total_pages, 10 ) || 0;

		dispatch( receiveRepositories( repositories, totalItems, totalPages, page ) );
	} catch {}
};

export const getReleases = ( repository ) => async ( { dispatch } ) => {
	if ( ! repository ) {
		return;
	}

	try {
		dispatch( fetchReleases( repository ) );
		const releases = await apiFetch( {
			path: `/wp/v2/discover/releases?repository=${ repository }`,
		} );

		dispatch( receiveReleases( releases, repository ) );
	} catch {}
};

export const getRepository = ( repository ) => async ( { dispatch } ) => {
	if ( ! repository ) {
		return;
	}

	try {
		dispatch( fetchRepository( repository ) );
		const repositoryDetails = await apiFetch( {
			path: `/wp/v2/discover/repository?name=${ repository }`,
		} );

		dispatch( receiveRepository( repositoryDetails, repository ) );
	} catch {}
};

/**
 * Fetches the changelog for a given repository from the discovery API.
 * Only triggered when getChangelog() is called from a component —
 * i.e. when the Changelog tab is active.
 *
 * @param {string} repository The repository full name.
 */
export const getChangelog = ( repository ) => async ( { dispatch } ) => {
	if ( ! repository ) {
		return;
	}

	try {
		dispatch( fetchChangelog( repository ) );
		const result = await apiFetch( {
			path: `/wp/v2/discover/changelog?repository=${ repository }`,
		} );

		dispatch( receiveChangelog( result.content, repository ) );
	} catch {}
};
