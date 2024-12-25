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
			'colors.min': './wp-admin/css/colors/retraceur/colors.js',
			'colors-rtl.min': './wp-admin/css/colors/retraceur/colors-rtl.js',
        },
		output: {
			filename: '[name].js',
			path: path.resolve( __dirname, '..', '..', '..', '..', 'built' ),
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
