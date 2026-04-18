const path = require( 'path' );

/**
 * WP Dependencies
 */
const defaultConfig = require( '@wordpress/scripts/config/webpack.config.js' );

module.exports = {
    ...defaultConfig,
    ...{
        entry: {
			'admin-bar.min': './wp-includes/css/admin-bar.js',
			'admin-bar-rtl.min': './wp-includes/css/admin-bar-rtl.js',
			'buttons.min': './wp-includes/css/buttons.js',
			'buttons-rtl.min': './wp-includes/css/buttons-rtl.js',
			'media-views-rtl.min': './wp-includes/css/media-views-rtl.js',
			'media-views.min': './wp-includes/css/media-views.js'
        },
		output: {
			filename: '[name].js',
			path: path.resolve( __dirname, '..', '..', 'built' ),
		}
    }
}
