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
			'about.min': './wp-admin/css/about.js',
			'about-rtl.min': './wp-admin/css/about-rtl.js',
			'admin-menu.min': './wp-admin/css/admin-menu.js',
			'admin-menu-rtl.min': './wp-admin/css/admin-menu-rtl.js',
			'common.min': './wp-admin/css/common.js',
			'common-rtl.min': './wp-admin/css/common-rtl.js',
			'dashboard.min': './wp-admin/css/dashboard.js',
			'dashboard-rtl.min': './wp-admin/css/dashboard-rtl.js',
			'edit.min': './wp-admin/css/edit.js',
			'edit-rtl.min': './wp-admin/css/edit-rtl.js',
			'forms.min': './wp-admin/css/forms.js',
			'forms-rtl.min': './wp-admin/css/forms-rtl.js',
			'install.min': './wp-admin/css/install.js',
			'install-rtl.min': './wp-admin/css/install-rtl.js',
			'list-tables.min': './wp-admin/css/list-tables.js',
			'list-tables-rtl.min': './wp-admin/css/list-tables-rtl.js',
			'login.min': './wp-admin/css/login.js',
			'login-rtl.min': './wp-admin/css/login-rtl.js',
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
