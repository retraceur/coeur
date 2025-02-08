# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).


## [1.0.0-RC1] - 2025-02-08

### Added

- Add a security policy.
- Create a distinct Administration area to manage blocks and avoid mixing these with Plugins.
- Make sure Retraceur code is synchronized with WP 6.7.2-RC2-59782.

### Changed

- Improve point's theme header and footer display on small screens.
- Update credits to thank me & Retraceur best friends.
- Replace explanations about contributing to WP with the Retraceur ones.
- Replace WP release note with Retraceur one.
- Disable the `wp-admin/update-core.php` screen as well as all Automatic updates.

### Deprecated

- `wp-admin/plugin-editor.php`.
- `wp-admin/theme-editor.php`.

### Removed

- Remove the features to edit Plugin and Theme files.
- Remove no more used images.


## [1.0.0-beta1] - 2025-01-14

### Added

- Add a new Administration file to perform Media edits.
- Add build workflow to internationalize the software.
- Add Uglify workflow to minify JavaScript files.
- Add Minify workflow to minify CSS files.
- Add a specific WP Admin color scheme for Retraceur and make it the default one.
- Add a new default Block Theme: « Point. ».
- Introduce a new registration workflow based on the `$wpdb-signups` DB table use.
- Add a way for Subscribers to freely delete their account.
- Add security policy, a privacy policy as well as contributing guidelines.

### Changed

- Add information about Retraceur in the software license.
- All WP Graphics (logo, images, animations,...) were replaced by Retraceur ones.
- Replace Gravatar by Libravatar.
- Replace WP Emojis by OpenMujis.
- Improve the WP Admin Tools main screen to summarize the available tools. 

### Deprecated

- `xmlrpc.php`.
- `wp-trackback.php`.
- `wp-signup.php`.
- `wp-mail.php`.
- `wp-links-opml.php`.
- `wp-comments-post.php`.
- `wp-activate.php`.
- `wp-admin/widgets.php`.
- `wp-admin/widgets-form.php`.
- `wp-admin/widgets-form-blocks.php`.
- `wp-admin/options-discussion.php`.
- `wp-admin/network.php` as well as ``wp-admin/network/*.php`.
- `wp-admin/nav-menus.php`.
- `wp-admin/ms-users.php`.
- `wp-admin/ms-upgrade-network.php`.
- `wp-admin/ms-themes.php`.
- `wp-admin/ms-sites.php`.
- `wp-admin/ms-options.php`.
- `wp-admin/ms-edit.php`.
- `wp-admin/ms-delete-site.php`.
- `wp-admin/ms-admin.php`.
- `wp-admin/moderation.php`.
- `wp-admin/moderation.php`.
- `wp-admin/link.php`.
- `wp-admin/link-parse-opml.php`.
- `wp-admin/link-manager.php`.
- `wp-admin/link-add.php`.
- `wp-admin/import.php`.
- `wp-admin/edit-form-comment.php`.
- `wp-admin/edit-comments.php`.
- `wp-admin/customize.php`.
- `wp-admin/comment.php`.

### Removed

- WP Trademark references were all removed or replaced by `WP` or `Retraceur`.
- All Links having the following domains `wp.org`, `w.org` & `wordpress.org` were removed.
- Requests to WP Block, WP Pattern, WP Plugin, WP Theme directories as well as to the WP "Openverse" were neutralized.
- Remove The WP Customizer feature.
- Remove WP Legacy Widgets feature.
- Remove WP Post by email feature.
- Remove WP Link manager feature.
- Remove XML-RPC API.
- Remove Multisite feature.
- Remove WP Legacy Navigation Menus feature.
- Remove the WP-dot-org Plugin/Theme "favorites" integration.
- Remove the WP Comments / Trackbacks feature.
- Remove the WP legacy Classic Editor code.
- Remove all WP Twenty* default themes.
- Remove the embed & social link blocks related to WP.
