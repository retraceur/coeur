# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).


## [2.0.0-beta1] - 2025-08-14

### Added

- Cherry pick 346 commits from the WP 6.8-branch.
- Introduce a new Post Format Part block to manage contained blocks rendering, see [#1](https://github.com/retraceur/coeur/issues/1).
- Introduce a new Post Format Name block to replace post titles and inform about the post format, see [#1](https://github.com/retraceur/coeur/issues/1).
- Introduce a new Admin screen to let Administrators easily customize Post Format names, description and slugs, see [#1](https://github.com/retraceur/coeur/issues/1).
- Add PayPal to the social links block, see [#87](https://github.com/retraceur/coeur/issues/87).
- Build the Retraceur Coeur update API, see [9201dc8](https://github.com/retraceur/coeur/commit/9201dc8543f431177dc12be286752911ef2e3c96)

### Changed

- Improve the `_doing_it_wrong()` function making sure the custom message if specified is actually used, see [#62](https://github.com/retraceur/coeur/issues/62).
- Use a WP Gutenberg fork to build modern editors, see [#61](https://github.com/retraceur/coeur/issues/61).
- Completely revamp the Post Format feature, see [#1](https://github.com/retraceur/coeur/issues/1).
- Improve the way the Theme detail overlay is appearing, see [#65](https://github.com/retraceur/coeur/issues/65).
- Exclude the Post Format taxonomy from the `WP_REST_Term_Search_Handler` controller, see [#1](https://github.com/retraceur/coeur/issues/1).
- Disable the Editor's Post Title when creating/editing a Post Format, see [#1](https://github.com/retraceur/coeur/issues/1).
- Update `@wordpress/scripts` dependency to v30.20.0.

### Deprecated

- `wp_add_editor_classic_theme_styles()`.
- `_post_format_request()`.
- `wp_version_check()`.
- `wp_maybe_auto_update()`.
- `list_core_update()`.
- `core_auto_updates_settings()`.
- `do_dismiss_core_update()`.
- `do_undismiss_core_update()`.
- `_preload_old_requests_classes_and_interfaces()`.
- `get_core_updates()`.
- `find_core_auto_update()`.
- `dismiss_core_update()`.
- `undismiss_core_update()`.
- `find_core_update()`.
- `maintenance_nag()`.

### Removed

- Remove the SiteDiscussion panel from the Site Editor, see [#64](https://github.com/retraceur/coeur/issues/64).
- Take care of missed WP Trademark occurrences included in localized strings.
- Take care of missed WP Trademark occurrences included in inline comments, see [#72](https://github.com/retraceur/coeur/issues/72).
- Take care of missed WP Trademark (including Openverse) occurrences in Editor code, see [#69](https://github.com/retraceur/coeur/issues/69).
- Remove missed WP site's URL occurrences, see [#68](https://github.com/retraceur/coeur/issues/68).


## [1.0.0] - 2025-04-21

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
- Create a distinct Administration area to manage blocks and avoid mixing these with Plugins.
- Make sure Retraceur code is synchronized with WP 6.7.2-RC2-59782.
- Make sure Retraceur code is synchronized with WP 6.7.3-alpha-59977.
- Point theme: add an `author.html` and a `category.html` template.

### Changed

- Add information about Retraceur in the software license.
- All WP Graphics (logo, images, animations,...) were replaced by Retraceur ones.
- Replace Gravatar by Libravatar.
- Replace WP Emojis by OpenMujis.
- Improve the WP Admin Tools main screen to summarize the available tools.
- Improve point's theme header and footer display on small screens.
- Update credits to thank me & Retraceur best friends.
- Replace explanations about contributing to WP with the Retraceur ones.
- Replace WP release note with Retraceur one.
- Disable the `wp-admin/update-core.php` screen as well as all Automatic updates.
- Make admin messages consistent when upgrading/downgrading a block.
- Update @wordpress/scripts to version 30.12.0.
- Improve how plugin/theme version checks are performed.
- Use WP fork of rtlcss-webpack-plugin.
- Improve the way main Tools Admin menu/page are loaded.
- Allow contributor to delete their account.
- Set the contributor role as the Retraceur default role.
- Replace all "user" occurrences in translatable string by "contributor".
- Update @wordpress/scripts to version 30.15.0.
- Point theme: make sure to comply with Headings hierarchy.
- Point theme: improve font size typography.

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
- `wp-admin/plugin-editor.php`.
- `wp-admin/theme-editor.php`.

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
- Remove the features to edit Plugin and Theme files.
- Remove no more used images.
- Remove missed customizer code.


## [1.0.0-RC3] - 2025-04-15


## [1.0.0-RC2] - 2025-03-16


## [1.0.0-RC1] - 2025-02-08


## [1.0.0-beta1] - 2025-01-14
