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
				results: action.repositories.items,
				totalItems: action.repositories.total_items,
				totalPages: action.repositories.total_pages,
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
				results: state.results.map( ( repository ) => {
					if ( repository.full_name !== action.repository ) {
						return repository;
					}
					return {
						...repository,
						releases: action.releases,
					};
				} ),
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
	}
	return state;
};

export default reducer;
