const path = require( 'path' );

/**
 * WP Dependencies
 */
const defaultConfig = require( '@wordpress/scripts/config/webpack.config.js' );
const RtlCssPlugin  = require( 'rtlcss-webpack-plugin' );

module.exports = {
    ...defaultConfig,
    ...{
        entry: {
			'block-editor/content-ltr.min': './wp-includes/css/dist/block-editor-content.js',
			'block-editor/content-rtl.min': './wp-includes/css/dist/block-editor-content-rtl.js',
			'block-editor/ltr.min': './wp-includes/css/dist/block-editor-style.js',
			'block-editor/style-rtl.min': './wp-includes/css/dist/block-editor-style-rtl.js',
			'edit-post/ltr.min': './wp-includes/css/dist/edit-post-style.js',
			'edit-post/style-rtl.min': './wp-includes/css/dist/edit-post-style-rtl.js',
			'edit-site/ltr.min': './wp-includes/css/dist/edit-site-style.js',
			'edit-site/style-rtl.min': './wp-includes/css/dist/edit-site-style-rtl.js',
			'edit-site/posts.min': './wp-includes/css/dist/edit-site-posts.js',
			'edit-site/posts-rtl.min': './wp-includes/css/dist/edit-site-posts-rtl.js',
			'edit-widgets/ltr.min': './wp-includes/css/dist/edit-widgets-style.js',
			'edit-widgets/style-rtl.min': './wp-includes/css/dist/edit-widgets-style-rtl.js',
			'list-reusable-blocks/ltr.min': './wp-includes/css/dist/list-reusable-blocks-style.js',
			'list-reusable-blocks/style-rtl.min': './wp-includes/css/dist/list-reusable-blocks-style-rtl.js',
        },
		output: {
			filename: '[name].js',
			path: path.resolve( __dirname, '..', '..', '..', 'built' ),
		}
    },
	...{
		plugins: [
			...defaultConfig.plugins.filter(
				(filter) => ! (filter instanceof RtlCssPlugin)
			),
		]
	}
}
