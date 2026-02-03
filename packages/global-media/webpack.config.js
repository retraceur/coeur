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
			'global-media': './src/index.js',
        },
		output: {
			filename: '[name].js',
			path: path.resolve( __dirname, '..', '..', 'built' ),
		}
    },
}
