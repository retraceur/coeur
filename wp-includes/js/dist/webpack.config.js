const path = require( 'path' );

/**
 * WP Dependencies
 */
const defaultConfig = require( '@wordpress/scripts/config/webpack.config.js' );

module.exports = {
    ...defaultConfig,
    ...{
        entry: {
			'block-directory.min': './wp-includes/js/dist/block-directory.js',
			'block-editor.min': './wp-includes/js/dist/block-editor.js',
			'block-library.min': './wp-includes/js/dist/block-library.js',
			'blocks.min': './wp-includes/js/dist/blocks.js',
			'components.min': './wp-includes/js/dist/components.js',
			'core-data.min': './wp-includes/js/dist/core-data.js',
			'edit-post.min': './wp-includes/js/dist/edit-post.js',
			'edit-site.min': './wp-includes/js/dist/edit-site.js',
			'editor.min': './wp-includes/js/dist/editor.js',
			'widgets.min': './wp-includes/js/dist/widgets.js',
        },
		output: {
			filename: '[name].js',
			path: path.resolve( __dirname, '..', '..', '..', 'built' ),
		}
    }
}
