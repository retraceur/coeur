const path = require( 'path' );

/**
 * WP Dependencies
 */
const defaultConfig = require( '@wordpress/scripts/config/webpack.config.js' );

module.exports = {
    ...defaultConfig,
    ...{
        entry: {
			'accordion.min': './wp-admin/js/accordion.js',
			'application-passwords.min': './wp-admin/js/application-passwords.js',
			'auth-app.min': './wp-admin/js/auth-app.js',
			'code-editor.min': './wp-admin/js/code-editor.js',
			'color-picker.min': './wp-admin/js/color-picker.js',
			'common.min': './wp-admin/js/common.js',
			'custom-background.min': './wp-admin/js/custom-background.js',
			'dashboard.min': './wp-admin/js/dashboard.js',
			'image-edit.min': './wp-admin/js/image-edit.js',
			'inline-edit-post.min': './wp-admin/js/inline-edit-post.js',
			'inline-edit-tax.min': './wp-admin/js/inline-edit-tax.js',
			'media-upload.min': './wp-admin/js/media-upload.js',
			'media.min': './wp-admin/js/media.js',
			'password-strength-meter.min': './wp-admin/js/password-strength-meter.js',
			'password-toggle.min': './wp-admin/js/password-toggle.js',
			'plugin-install.min': './wp-admin/js/plugin-install.js',
			'post.min': './wp-admin/js/post.js',
			'postbox.min': './wp-admin/js/postbox.js',
			'privacy-tools.min': './wp-admin/js/privacy-tools.js',
			'site-health.min': './wp-admin/js/site-health.js',
			'site-icon.min': './wp-admin/js/site-icon.js',
			'tags-box.min': './wp-admin/js/tags-box.js',
			'tags-suggest.min': './wp-admin/js/tags-suggest.js',
			'tags.min': './wp-admin/js/tags.js',
			'theme-plugin-editor.min': './wp-admin/js/theme-plugin-editor.js',
			'theme.min': './wp-admin/js/theme.js',
			'updates.min': './wp-admin/js/updates.js',
			'user-profile.min': './wp-admin/js/user-profile.js',
			'user-suggest.min': './wp-admin/js/user-suggest.js',
			'word-count.min': './wp-admin/js/word-count.js',
			'xfn.min': './wp-admin/js/xfn.js',
        },
		output: {
			filename: '[name].js',
			path: path.resolve( __dirname, '..', '..', 'built' ),
		}
    }
}
