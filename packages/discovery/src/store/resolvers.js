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
} from './actions';

export const getRepositories = () => async ( { dispatch } ) => {
	try {
		dispatch( fetchRepositories() );
		const repositories = await apiFetch( {
			path: '/wp/v2/discover/blocks',
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
