/**
 * WP dependencies.
 */
import { createReduxStore, register } from '@wordpress/data';

/**
 * Internal dependencies.
 */
import reducer from './reducer';
import * as actions from './actions';
import * as selectors from './selectors';
import * as resolvers from './resolvers';

const discoveryStore = 'retraceur/discovery';

const store = createReduxStore( discoveryStore, {
	reducer,
	actions,
	selectors,
	resolvers,
} );

register( store );

export default discoveryStore;
