const path = require( 'path' );

/**
 * WP Dependencies
 */
const defaultConfig = require( '@wordpress/scripts/config/webpack.config.js' );

module.exports = {
    ...defaultConfig,
    ...{
        entry: {
			'login.min': './wp-admin/css/login.js',
			'login-rtl.min': './wp-admin/css/login-rtl.js',
			'install.min': './wp-admin/css/install.js',
			'install-rtl.min': './wp-admin/css/install-rtl.js',
        },
		output: {
			filename: '[name].js',
			path: path.resolve( __dirname, '..', '..', 'built' ),
		}
    }
}
