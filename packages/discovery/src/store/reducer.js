/**
 * Reducer returning an array of repositories.
 *
 * @param {Object} state  Current state.
 * @param {Object} action Dispatched action.
 *
 * @return {Object} Updated state.
 */
const reducer = ( state = {}, action ) => {
	switch ( action.type ) {
		case 'SET_DISCOVERY_SETTINGS':
			return {
				...state,
				settings: action.settings,
			};

		case 'FETCH_REPOS':
			return {
				...state,
				isRequestingRepositories: true,
			};
		case 'RECEIVE_REPOS':
			return {
				...state,
				resultsByPage: {
					...state.resultsByPage,
					[ action.page ]: action.repositories,
				},
				repositoriesByFullName: {
					...state.repositoriesByFullName,
					...Object.fromEntries(
						action.repositories.map( ( r ) => [ r.full_name, r ] )
					),
				},
				totalItems: action.totalItems,
				totalPages: action.totalPages,
				isRequestingRepositories: false,
			};
		case 'FETCH_RELEASES':
			return {
				...state,
				loadingReleases: {
					...state.loadingReleases,
					[ action.repository ]: true,
				},
			};
		case 'RECEIVE_RELEASES':
			return {
				...state,
				loadingReleases: {
					...state.loadingReleases,
					[ action.repository ]: false,
				},
				releases: {
					...state.releases,
					[ action.repository ]: action.releases,
				},
			};
		case 'FETCH_REPOSITORY':
			return {
				...state,
				loadingDetails: {
					...state.loadingDetails,
					[ action.repository ]: true,
				},
			};

		case 'RECEIVE_REPOSITORY':
			return {
				...state,
				loadingDetails: {
					...state.loadingDetails,
					[ action.repository ]: false,
				},
				details: {
					...state.details,
					[ action.repository ]: action.repositoryDetails,
				},
			};

		case 'FETCH_CHANGELOG':
			return {
				...state,
				loadingChangelogs: {
					...state.loadingChangelogs,
					[ action.repository ]: true,
				},
			};

		case 'RECEIVE_CHANGELOG':
			return {
				...state,
				loadingChangelogs: {
					...state.loadingChangelogs,
					[ action.repository ]: false,
				},
				changelogs: {
					...state.changelogs,
					[ action.repository ]: action.changelog,
				},
			};

		case 'REQUEST_INSTALLATION':
			return {
				...state,
				installationRequest: action.repository,
			};

		case 'MARK_AS_INSTALLED':
			return {
				...state,
				details: {
					...state.details,
					[ action.repository ]: {
						...state.details[ action.repository ],
						is_installed: true,
					},
				},
				repositoriesByFullName: {
					...state.repositoriesByFullName,
					[ action.repository ]: {
						...state.repositoriesByFullName[ action.repository ],
						is_installed: true,
					},
				},
				resultsByPage: Object.fromEntries(
					Object.entries( state.resultsByPage ?? {} ).map( ( [ page, repos ] ) => [
						page,
						repos.map( ( r ) =>
							r.full_name === action.repository
								? { ...r, is_installed: true }
								: r
						),
					] )
				),
			};
	}
	return state;
};

export default reducer;
