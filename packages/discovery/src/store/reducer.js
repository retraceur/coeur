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
	}
	return state;
};

export default reducer;
