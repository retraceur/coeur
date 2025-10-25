/**
 * WP dependencies
 */
import { __ } from '@wordpress/i18n';

const actions = [
	{
		id: 'log-item',
		label: __( 'Log data' ),
		callback: ( [ item ] ) => {
			console.log( item );
		},
	},
]

export default actions;
