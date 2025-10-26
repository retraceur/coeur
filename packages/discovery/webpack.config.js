const path = require( 'path' );

/**
 * WP Dependencies
 */
const defaultConfig = require( '@wordpress/scripts/config/webpack.config.js' );
const DependencyExtractionWebpackPlugin = require( '@wordpress/dependency-extraction-webpack-plugin' );

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
	plugins: [
		...defaultConfig.plugins.filter(
			( plugin ) =>
				plugin.constructor.name !== 'DependencyExtractionWebpackPlugin'
		),
		new DependencyExtractionWebpackPlugin( {
			requestToExternal( request ) {
				if ( request === '@wordpress/dataviews' ) {
					return [ 'wp', 'dataviews' ];
				}
			},
			requestToHandle( request ) {
				if ( request === '@wordpress/dataviews' ) {
					return 'wp-dataviews';
				}
			}
		} )
	],
}
