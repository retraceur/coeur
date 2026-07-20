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
			'about.min': './wp-admin/css/about.js',
			'about-rtl.min': './wp-admin/css/about-rtl.js',
			'admin-menu.min': './wp-admin/css/admin-menu.js',
			'admin-menu-rtl.min': './wp-admin/css/admin-menu-rtl.js',
			'color-picker.min': './wp-admin/css/color-picker.js',
			'color-picker-rtl.min': './wp-admin/css/color-picker-rtl.js',
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
			'l10n.min': './wp-admin/css/l10n.js',
			'l10n-rtl.min': './wp-admin/css/l10n-rtl.js',
			'list-tables.min': './wp-admin/css/list-tables.js',
			'list-tables-rtl.min': './wp-admin/css/list-tables-rtl.js',
			'login.min': './wp-admin/css/login.js',
			'login-rtl.min': './wp-admin/css/login-rtl.js',
			'media.min': './wp-admin/css/media.js',
			'media-rtl.min': './wp-admin/css/media-rtl.js',
			'revisions.min': './wp-admin/css/revisions.js',
			'revisions-rtl.min': './wp-admin/css/revisions-rtl.js',
			'site-health.min': './wp-admin/css/site-health.js',
			'site-health-rtl.min': './wp-admin/css/site-health-rtl.js',
			'site-icon.min': './wp-admin/css/site-icon.js',
			'site-icon-rtl.min': './wp-admin/css/site-icon-rtl.js',
			'themes.min': './wp-admin/css/themes.js',
			'themes-rtl.min': './wp-admin/css/themes-rtl.js',
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
