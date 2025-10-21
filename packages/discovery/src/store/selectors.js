/**
 * Returns the repositories.
 *
 * @param {Object} state Global application state.
 *
 * @return {Array} Repositories.
 */
export function getRepositories( state ) {
	return state.results || [];
}
