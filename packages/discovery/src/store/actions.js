/**
 * Returns an action object used to set discovery settings.
 *
 * @param {array} settings The discovery settings.
 * @return {Object} Object for action.
 */
export function setSettings( settings ) {
	return {
		type: 'SET_DISCOVERY_SETTINGS',
		settings,
	};
}

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

/**
 * Returns an action object used in signalling that details
 * for a repository are being requested.
 *
 * @param {string} repository The repository full name.
 *
 * @return {Object} Action object.
 */
export function fetchRepository( repository ) {
	return {
		type: 'FETCH_REPOSITORY',
		repository,
	};
}

/**
 * Returns an action object used in signalling that details
 * for a repository have been fetched.
 *
 * @param {Object} repositoryDetails The repository details.
 * @param {string} repository        The repository full name.
 *
 * @return {Object} Action object.
 */
export function receiveRepository( repositoryDetails, repository ) {
	return {
		type: 'RECEIVE_REPOSITORY',
		repositoryDetails,
		repository,
	};
}

/**
 * Returns an action object used in signalling that the changelog
 * for a repository is being requested.
 *
 * @param {string} repository The repository full name.
 *
 * @return {Object} Action object.
 */
export function fetchChangelog( repository ) {
	return {
		type: 'FETCH_CHANGELOG',
		repository,
	};
}

/**
 * Returns an action object used in signalling that the changelog
 * for a repository has been fetched.
 *
 * @param {string} changelog  The repository changelog HTML content.
 * @param {string} repository The repository full name.
 *
 * @return {Object} Action object.
 */
export function receiveChangelog( changelog, repository ) {
	return {
		type: 'RECEIVE_CHANGELOG',
		changelog,
		repository,
	};
}
