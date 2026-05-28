/**
 * Returns whether the repositories are being requested.
 *
 * @param {Object} state Global application state.
 *
 * @return {boolean} Whether the repositories are being requested.
 */
export function isRequestingRepositories( state ) {
	return state?.isRequestingRepositories ?? false;
}

/**
 * Returns the repositories.
 *
 * @param {Object} state Global application state.
 *
 * @return {Array} Repositories.
 */
export function getRepositories( state ) {
	return state?.results ?? [];
}

/**
 * Returns whether the releases for a given repository are being requested.
 *
 * @param {Object} state      Global application state.
 * @param {string} repository The repository full name.
 *
 * @return {boolean} Whether the releases are being requested.
 */
export function isRequestingReleases( state, repository ) {
	return state?.loadingReleases?.[ repository ] ?? false;
}

/**
 * Returns a repository releases.
 *
 * @param {Object} state      Global application state.
 * @param {string} repository The repository full name.
 *
 * @return {Array} Releases.
 */
export function getReleases( state, repository ) {
	const currentRepository = state?.results.find(
		( result ) => result.full_name === repository
	);
	return currentRepository?.releases ?? [];
}
