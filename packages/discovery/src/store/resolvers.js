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
} from './actions';

export const getRepositories = ( pluginType ) => async ( { dispatch } ) => {
	try {
		dispatch( fetchRepositories() );
		const repositories = await apiFetch( {
			path: '/wp/v2/discover/repositories?type=' + pluginType,
		} );

		dispatch( receiveRepositories( repositories ) );
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
