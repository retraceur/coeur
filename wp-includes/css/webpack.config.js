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
        },
		output: {
			filename: '[name].js',
			path: path.resolve( __dirname, '..', '..', 'built' ),
		}
    }
}
