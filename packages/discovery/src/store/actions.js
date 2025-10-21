/**
 * Returns an action object used in signalling that the repositories
 * have been requested and are loading.
 *
 * @return {Object} Action object.
 */
export function fetchRepositories() {
	return { type: 'FETCH_REPOS' };
}

/**
 * Returns an action object used in signalling that the repositories
 * have been fetched.
 *
 * @param {Array} repositories Repositories.
 *
 * @return {Object} Action object.
 */
export function receiveRepositories( repositories ) {
	return {
		type: 'RECEIVE_REPOS',
		repositories,
	};
}
