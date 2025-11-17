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
		case 'FETCH_REPOS':
			return {
				...state,
				isRequesting: true,
			};
		case 'RECEIVE_REPOS':
			return {
				...state,
				results: action.repositories,
				isRequesting: false,
			};
		case 'FETCH_RELEASES':
			return {
				...state,
				isRequesting: true,
			};
		case 'RECEIVE_RELEASES':
			const repository = state.results.find( ( repository ) => repository.full_name === action.repository );
			repository.releases = action.releases;

			return {
				...state,
				results: [
					...state.results,
					repository,
				],
				isRequesting: false,
			};
	}
	return state;
};

export default reducer;
