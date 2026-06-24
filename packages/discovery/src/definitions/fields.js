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
			<div className="retraceur-repository-thumbnail">
				<img
					alt={
						/* Translators: %s is the repository name */
						sprintf( __( 'Preview image of the %s repository'), item.name )
					}
					src={ item.image }
					onError={ ( e ) => {
						e.target.onerror = null;
						e.target.src = `https://opengraph.github.com/repo/${ item.full_name }`;
					} }
				/>
				{ item.is_installed && (
					<span className="retraceur-repository-thumbnail__badge">
						{ __( 'Installed' ) }
					</span>
				) }
			</div>
		),
		enableSorting: false,
		enableGlobalSearch: false,
	},
	{
		id: 'full_name',
		label: __( 'Full name' ),
		getValue: ( { item } ) =>
			`${ item.full_name }`,
		enableSorting: false,
		enableGlobalSearch: false,
	},
	{
		id: 'name',
		label: __( 'Name' ),
		getValue: ( { item } ) =>
			`${ item.name }`,
		render: ( { item } ) => (
			<strong
				className={
					item.is_installed
						? 'retraceur-repository-name retraceur-repository-name--installed'
						: 'retraceur-repository-name'
				}
			>
				{ item.name }
			</strong>
		),
		enableSorting: false,
		enableGlobalSearch: false,
	},
	{
		id: 'description',
		label: __( 'Description' ),
		getValue: ( { item } ) =>
			`${ item.description }`,
		enableSorting: false,
		enableGlobalSearch: false,
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
		enableSorting: false,
		enableGlobalSearch: false,
	},
];

export default fields;
