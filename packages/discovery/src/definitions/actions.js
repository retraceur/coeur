/**
 * WP dependencies
 */
import { __, sprintf } from '@wordpress/i18n';

const actions = [
	{
		id: 'view-releases',
		label: __( 'View releases' ),
		RenderModal: ( { items } ) => {
			const [repository] = items;

			return (
				<p>
					{
						/* Translators: %s is the repository name. */
						sprintf( __( '%s’s releases' ), repository.name )
					}
				</p>
			);
		},
		modalHeader: __( 'Available releases' )
	},
]

export default actions;
