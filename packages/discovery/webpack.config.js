const path = require( 'path' );

/**
 * WP Dependencies
 */
const defaultConfig = require( '@wordpress/scripts/config/webpack.config.js' );
const RtlCssPlugin  = require( '@wordpress/scripts/plugins/rtlcss-webpack-plugin' );

module.exports = {
    ...defaultConfig,
    ...{
        entry: {
			'discovery': './src/index.js',
        },
		output: {
			filename: '[name].js',
			path: path.resolve( __dirname, '..', '..', 'built' ),
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
