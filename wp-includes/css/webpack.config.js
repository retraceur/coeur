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
			'media-views.min': './wp-includes/css/media-views.js',
			'wp-auth-check-rtl.min': './wp-includes/css/wp-auth-check-rtl.js',
			'wp-auth-check.min': './wp-includes/css/wp-auth-check.js',
			'wp-pointer-rtl.min': './wp-includes/css/wp-pointer-rtl.js',
			'wp-pointer.min': './wp-includes/css/wp-pointer.js'
        },
		output: {
			filename: '[name].js',
			path: path.resolve( __dirname, '..', '..', 'built' ),
		}
    }
}
