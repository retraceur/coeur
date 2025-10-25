/**
 * WP dependencies
 */
import { __, sprintf } from '@wordpress/i18n';

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
		enableGlobalSearch: false,
	},
];

export default fields;
