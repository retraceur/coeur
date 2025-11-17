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
 * Returns a repository releases.
 *
 * @param {Object} state Global application state.
 *
 * @return {Array} Releases.
 */
export function getReleases( state, repository ) {
	const currentRepository = state?.results.find( ( result ) => result.full_name === repository ) ?? [];
	return currentRepository?.releases ?? [];
}
