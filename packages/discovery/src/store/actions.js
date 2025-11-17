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

/**
 * Returns an action object used in signalling that releases
 * for a repository have been requested and are loading.
 *
 * @param {String} repository The repository full name.
 *
 * @return {Object} Action object.
 */
export function fetchReleases( repository ) {
	return {
		type: 'FETCH_RELEASES',
		repository
	};
}

/**
 * Returns an action object used in signalling that releases
 * for a repository have been fetched.
 *
 * @param {Array} releases Releases.
 * @param {String} repository The repository full name.
 *
 * @return {Object} Action object.
 */
export function receiveReleases( releases, repository ) {
	return {
		type: 'RECEIVE_RELEASES',
		releases,
		repository,
	};
}
