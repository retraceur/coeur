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
