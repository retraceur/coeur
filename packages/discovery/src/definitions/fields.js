/**
 * WP dependencies
 */
import { __, sprintf } from '@wordpress/i18n';
import { ExternalLink } from '@wordpress/components';

const fields = [
	{
		id: 'image',
		label: __( 'Preview image' ),
		render: ( { item } ) => (
			/* Translators: %s is the repository name */
			<img alt={ sprintf( __( 'Preview image of the %s repository'), item.name ) } src={ item.image } />
		),
		enableSorting: false,
	},
	{
		id: 'full_name',
		label: __( 'Full name' ),
		getValue: ( { item } ) =>
			`${ item.full_name }`,
		enableGlobalSearch: false,
	},
	{
		id: 'name',
		label: __( 'Name' ),
		getValue: ( { item } ) =>
			`${ item.name }`,
		enableGlobalSearch: true,
	},
	{
		id: 'description',
		label: __( 'Description' ),
		getValue: ( { item } ) =>
			`${ item.description }`,
		enableGlobalSearch: true,
	},
	{
		id: 'author',
		label: __( 'Author' ),
		getValue: ( { item } ) =>
			`${ item.author }`,
		render: ( { item } ) => (
			<ExternalLink
				href={ item.author_url }
				className="repo-author-link"
			>
				<img
					alt={
						/* Translators: %s is the author name */
						sprintf( __( 'Profile image of %s'), item.author )
					}
					src={ item.author_avatar }
				/>
				{ item.author }
			</ExternalLink>
		),
		enableGlobalSearch: false,
	},
];

export default fields;
