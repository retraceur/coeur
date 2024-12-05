#!/bin/bash

# Exit if any command fails
set -e

# Enable nicer messaging for build status
YELLOW_BOLD='\033[1;33m';
COLOR_RESET='\033[0m';
status () {
	echo -e "\n${YELLOW_BOLD}$1${COLOR_RESET}\n"
}

wp i18n make-pot . wp-content/languages/js/admin-media.pot --include="wp-admin/js/media.js" --ignore-domain
wp i18n make-pot . wp-content/languages/js/admin-site-health.pot --include="wp-admin/js/site-health.js" --ignore-domain
wp i18n make-pot . wp-content/languages/js/admin-set-post-thumbnail.pot --include="wp-admin/js/set-post-thumbnail.js" --ignore-domain
wp i18n make-pot . wp-content/languages/js/admin-auth-app.pot --include="wp-admin/js/auth-app.js" --ignore-domain
wp i18n make-pot . wp-content/languages/js/admin-site-icon.pot --include="wp-admin/js/site-icon.js" --ignore-domain
wp i18n make-pot . wp-content/languages/js/admin-comment.pot --include="wp-admin/js/comment.js" --ignore-domain
wp i18n make-pot . wp-content/languages/js/admin-password-strength-meter.pot --include="wp-admin/js/password-strength-meter.js" --ignore-domain
wp i18n make-pot . wp-content/languages/js/admin-user-profile.pot --include="wp-admin/js/user-profile.js" --ignore-domain
wp i18n make-pot . wp-content/languages/js/admin-postbox.pot --include="wp-admin/js/postbox.js" --ignore-domain
wp i18n make-pot . wp-content/languages/js/admin-image-edit.pot --include="wp-admin/js/image-edit.js" --ignore-domain
wp i18n make-pot . wp-content/languages/js/admin-updates.pot --include="wp-admin/js/updates.js" --ignore-domain
wp i18n make-pot . wp-content/languages/js/admin-inline-edit-post.pot --include="wp-admin/js/inline-edit-post.js" --ignore-domain
wp i18n make-pot . wp-content/languages/js/admin-tags-box.pot --include="wp-admin/js/tags-box.js" --ignore-domain
wp i18n make-pot . wp-content/languages/js/admin-plugin-install.pot --include="wp-admin/js/plugin-install.js" --ignore-domain
wp i18n make-pot . wp-content/languages/js/admin-application-passwords.pot --include="wp-admin/js/application-passwords.js" --ignore-domain
wp i18n make-pot . wp-content/languages/js/admin-tags-suggest.pot --include="wp-admin/js/tags-suggest.js" --ignore-domain
wp i18n make-pot . wp-content/languages/js/admin-post.pot --include="wp-admin/js/post.js" --ignore-domain
wp i18n make-pot . wp-content/languages/js/admin-theme-plugin-editor.pot --include="wp-admin/js/theme-plugin-editor.js" --ignore-domain
wp i18n make-pot . wp-content/languages/js/admin-password-toggle.pot --include="wp-admin/js/password-toggle.js" --ignore-domain
wp i18n make-pot . wp-content/languages/js/admin-color-picker.pot --include="wp-admin/js/color-picker.js" --ignore-domain
wp i18n make-pot . wp-content/languages/js/admin-privacy-tools.pot --include="wp-admin/js/privacy-tools.js" --ignore-domain
wp i18n make-pot . wp-content/languages/js/admin-edit-comments.pot --include="wp-admin/js/edit-comments.js" --ignore-domain
wp i18n make-pot . wp-content/languages/js/admin-common.pot --include="wp-admin/js/common.js" --ignore-domain
wp i18n make-pot . wp-content/languages/js/admin-inline-edit-tax.pot --include="wp-admin/js/inline-edit-tax.js" --ignore-domain
wp i18n make-pot . wp-content/languages/js/admin-tags.pot --include="wp-admin/js/tags.js" --ignore-domain
wp i18n make-pot . wp-content/languages/js/includes-media-views.pot --include="wp-includes/js/media-views.js" --ignore-domain
wp i18n make-pot . wp-content/languages/js/includes-media-editor.pot --include="wp-includes/js/media-editor.js" --ignore-domain
wp i18n make-pot . wp-content/languages/js/includes-auth-check.pot --include="wp-includes/js/wp-auth-check.js" --ignore-domain
wp i18n make-pot . wp-content/languages/js/includes-wp-pointer.pot --include="wp-includes/js/wp-pointer.js" --ignore-domain
wp i18n make-pot . wp-content/languages/js/dist-fields.pot --include="wp-includes/js/dist/fields.js" --ignore-domain
wp i18n make-pot . wp-content/languages/js/dist-block-library.pot --include="wp-includes/js/dist/block-library.js" --ignore-domain
wp i18n make-pot . wp-content/languages/js/dist-reusable-blocks.pot --include="wp-includes/js/dist/reusable-blocks.js" --ignore-domain
wp i18n make-pot . wp-content/languages/js/dist-core-commands.pot --include="wp-includes/js/dist/core-commands.js" --ignore-domain
wp i18n make-pot . wp-content/languages/js/dist-format-library.pot --include="wp-includes/js/dist/format-library.js" --ignore-domain
wp i18n make-pot . wp-content/languages/js/dist-keycodes.pot --include="wp-includes/js/dist/keycodes.js" --ignore-domain
wp i18n make-pot . wp-content/languages/js/dist-block-directory.pot --include="wp-includes/js/dist/block-directory.js" --ignore-domain
wp i18n make-pot . wp-content/languages/js/dist-edit-post.pot --include="wp-includes/js/dist/edit-post.js" --ignore-domain
wp i18n make-pot . wp-content/languages/js/dist-list-reusable-blocks.pot --include="wp-includes/js/dist/list-reusable-blocks.js" --ignore-domain
wp i18n make-pot . wp-content/languages/js/dist-rich-text.pot --include="wp-includes/js/dist/rich-text.js" --ignore-domain
wp i18n make-pot . wp-content/languages/js/dist-editor.pot --include="wp-includes/js/dist/editor.js" --ignore-domain
wp i18n make-pot . wp-content/languages/js/dist-media-utils.pot --include="wp-includes/js/dist/media-utils.js" --ignore-domain
wp i18n make-pot . wp-content/languages/js/dist-components.pot --include="wp-includes/js/dist/components.js" --ignore-domain
wp i18n make-pot . wp-content/languages/js/dist-patterns.pot --include="wp-includes/js/dist/patterns.js" --ignore-domain
wp i18n make-pot . wp-content/languages/js/dist-annotations.pot --include="wp-includes/js/dist/annotations.js" --ignore-domain
wp i18n make-pot . wp-content/languages/js/dist-blocks.pot --include="wp-includes/js/dist/blocks.js" --ignore-domain
wp i18n make-pot . wp-content/languages/js/dist-core-data.pot --include="wp-includes/js/dist/core-data.js" --ignore-domain
wp i18n make-pot . wp-content/languages/js/dist-a11y.pot --include="wp-includes/js/dist/a11y.js" --ignore-domain
wp i18n make-pot . wp-content/languages/js/dist-i18n.pot --include="wp-includes/js/dist/i18n.js" --ignore-domain
wp i18n make-pot . wp-content/languages/js/dist-server-side-render.pot --include="wp-includes/js/dist/server-side-render.js" --ignore-domain
wp i18n make-pot . wp-content/languages/js/dist-edit-site.pot --include="wp-includes/js/dist/edit-site.js" --ignore-domain
wp i18n make-pot . wp-content/languages/js/dist-api-fetch.pot --include="wp-includes/js/dist/api-fetch.js" --ignore-domain
wp i18n make-pot . wp-content/languages/js/dist-nux.pot --include="wp-includes/js/dist/nux.js" --ignore-domain
wp i18n make-pot . wp-content/languages/js/dist-block-editor.pot --include="wp-includes/js/dist/block-editor.js" --ignore-domain
wp i18n make-pot . wp-content/languages/js/dist-commands.pot --include="wp-includes/js/dist/commands.js" --ignore-domain
wp i18n make-pot . wp-content/languages/js/dist-preferences.pot --include="wp-includes/js/dist/preferences.js" --ignore-domain

status "Done."
