# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).


## [Unreleased]


## [4.0.0-beta2] - 2026-07-28

### Added

- Site Admin menu of the Admin bar: include a link to reach Block administration. See [#227](https://github.com/retraceur/coeur/pull/227).

### Changed

- Avoid warnings about `/* translators: */` comments. See [#228](https://github.com/retraceur/coeur/pull/228).
- Use more consistent text about some translatable strings. See [#229](https://github.com/retraceur/coeur/pull/229)
- Make sure the `$_bundled_files_to_refresh` global is rightly referenced within the `update_core()` function. See [#230](https://github.com/retraceur/coeur/pull/230).
- REST API: `WP_REST_URL_Details_Controller::get_description()` is now searching for `og:description` inside the `prorperty` meta attribute, instead of the `name` one.
- Discovery/Update APIs: Delete Discovery & Releases caches once a plugin/block is deleted. See [#237](https://github.com/retraceur/coeur/pull/237)


## [4.0.0-beta1] - 2026-07-21

### Added

- Introduce the Discovery API: a minimalist, GitHub.com-based replacement for the WP.org Plugin Install API, see [#186](https://github.com/retraceur/coeur/pull/186) and [#30](https://github.com/retraceur/coeur/issues/30).
  - Consume the GitHub REST API to list Retraceur blocks and plugins, with transient caching of the responses.
  - Add the `retraceur_discovery_api()` and `retraceur_discovery_request()` helper functions.
  - Add the `/discover` and `/discover/repository` REST routes, the latter returning a single repository's details and its releases.
  - Make sure Discovery API transients/caches are cleaned when needed, see [#196](https://github.com/retraceur/coeur/issues/196).
- Introduce the Discovery UI: a new React application, built on top of the DataViews package, to browse and install blocks & plugins hosted on GitHub.com.
  - Add the repository installation feature, see [#187](https://github.com/retraceur/coeur/pull/187).
  - Redesign the repository detail modal and move the releases list into the `view-repository` action.
  - Add a Changelog tab to the repository detail modal, see [#189](https://github.com/retraceur/coeur/issues/189) and [#190](https://github.com/retraceur/coeur/pull/190).
  - Check Retraceur and PHP version requirements before installing a repository and disable the ones needing a higher version, see [#188](https://github.com/retraceur/coeur/issues/188) and [#191](https://github.com/retraceur/coeur/pull/191).
  - Hide the install action and highlight already installed repositories across the UI, see [#192](https://github.com/retraceur/coeur/issues/192).
  - Build the pagination out of the GitHub REST API results and store releases/repositories independently, see [#193](https://github.com/retraceur/coeur/issues/193), [#194](https://github.com/retraceur/coeur/pull/194) and [#195](https://github.com/retraceur/coeur/pull/195).
  - Reflect the installation state immediately after installing from the UI, see [#197](https://github.com/retraceur/coeur/pull/197).
  - Add activation and list links to the install confirmation modal, see [#211](https://github.com/retraceur/coeur/pull/211).
- Build the first iteration of the Retraceur Plugin/Block update API, based on GitHub releases instead of the WP.org update API, see [#201](https://github.com/retraceur/coeur/issues/201) and [#202](https://github.com/retraceur/coeur/pull/202).
  - Custom updaters are checked first, Retraceur's one is only used as a fallback.
  - Required Retraceur & PHP versions are included in `retraceur_get_plugin_update()`.
- Verify GitHub release asset checksums (SHA-256 digests) during `WP_Upgrader::download_package()` before the package reaches the installer, see [#206](https://github.com/retraceur/coeur/pull/206).
- Add an Icons API so that the `wp` icon can be replaced by the Retraceur one, see [#180](https://github.com/retraceur/coeur/pull/180).
- Add the `GitHub Plugin URI` plugin main file header tag.
- Include the `core/table-of-contents` block.
- Cherry pick 374 commits from the WP 7.0-branch, see [#171](https://github.com/retraceur/coeur/issues/171).
- Make sure Retraceur code is synchronized with WP 7.0.3-alpha-62793, including the WP 7.0.2 security & maintenance fixes.

### Changed

- Set the `WP_DEFAULT_THEME` constant to `point`, which has been Retraceur's default and only theme since 1.0.0, see [#220](https://github.com/retraceur/coeur/issues/220) and [#222](https://github.com/retraceur/coeur/pull/222).
- Refresh the bundled files that ship with cœur and have no external update source, making sure the Point theme is updated during each Retraceur upgrade, see [#221](https://github.com/retraceur/coeur/issues/221) and [#224](https://github.com/retraceur/coeur/pull/224).
- Update the `@wordpress` JavaScript packages according to the Gutenberg `wp/7.0` branch and apply the Retraceur customizations, see [#216](https://github.com/retraceur/coeur/pull/216).
  - Remove the `registerLegacyWidgetBlock` & `registerWidgetGroupBlock` calls from `@wordpress/edit-post` and `@wordpress/edit-site` so that these scripts no longer depend on `widgets`.
  - Add `@retraceur/discovery` to the `@wordpress/private-apis` consumers.
  - Fix the `@wordpress/interactivity` loading issue and the Icon library file paths.
- Update `@wordpress/scripts` dependency to v32.0.
- Update the Twemoji library to version `17.0.3`.
- Rename the "Add Plugins/Blocks" screens in favor of "Discover Plugins/Blocks".
- Move the plugin/block manual upload inside the installed Plugins/Blocks Admin screens, see [#204](https://github.com/retraceur/coeur/issues/204) and [#208](https://github.com/retraceur/coeur/pull/208).
- Simplify the `plugin-install` JavaScript, removing the jQuery and Thickbox dependencies, and stop loading it when it is not needed.
- Display active and inactive blocks separately from plugins in the Site Health information screen, see [#199](https://github.com/retraceur/coeur/issues/199) and [#207](https://github.com/retraceur/coeur/pull/207).
- Improve the Plugin/Block updates section of the `wp-admin/update-core.php` screen, see [#212](https://github.com/retraceur/coeur/pull/212).
- Restrict plugin/block updates to the Admin Update screen and remove the Plugins Admin menu updates bubble.
- Update the Retraceur Admin color scheme, see [#177](https://github.com/retraceur/coeur/pull/177).
- Improve the upload UI style inside the `media-new` Admin screen, see [#184](https://github.com/retraceur/coeur/issues/184) and [#185](https://github.com/retraceur/coeur/pull/185).
- Minify more `admin/css` & `includes/css` styles using the Webpack builder and refresh all minified assets for 4.0.0, see [#223](https://github.com/retraceur/coeur/pull/223).
- Fix a fatal error in the PclZip extraction fallback of the upgrader.
- Fix wrong right borders in the list table styles.
- Use the right Admin screen once an upgrade succeeded.
- Temporarily disable the Plugin Dependencies feature, which relied on the WP.org Plugin Install API. The dependency checks are turned off (a plugin declaring a `Requires Plugins` header can be activated) until the distant dependency is replaced by a GitHub.com-based mechanism. See [#205](https://github.com/retraceur/coeur/issues/205) and [#213](https://github.com/retraceur/coeur/pull/213).

### Deprecated

- The WP.org Plugin Install API, see [#198](https://github.com/retraceur/coeur/issues/198), [#200](https://github.com/retraceur/coeur/pull/200) and [#214](https://github.com/retraceur/coeur/pull/214):
  - `plugins_api()`.
  - `install_dashboard()`.
  - `install_popular_tags()`.
  - `install_search_form()`.
  - `install_plugin_information()`.
  - `install_plugin_install_status()`.
  - `display_plugins_table()`.
  - `wp_get_plugin_action_button()`.
  - `wp_ajax_install_plugin()`.
  - `wp_ajax_search_install_plugins()`.
  - `WP_Plugin_Install_List_Table`.
- The background/automatic updates feature, see [#203](https://github.com/retraceur/coeur/issues/203) and [#210](https://github.com/retraceur/coeur/pull/210):
  - `WP_Automatic_Updater`.
  - `Automatic_Upgrader_Skin`.
  - `WP_Site_Health_Auto_Updates`.
  - `wp_is_auto_update_enabled_for_type()`.
  - `wp_is_auto_update_forced_for_item()`.
  - `wp_get_auto_update_message()`.
  - `wp_theme_auto_update_setting_template()`.
  - `wp_ajax_toggle_auto_updates()`.
  - `wp_plugin_update_rows()`.
  - `wp_plugin_update_row()`.
- The WP.org-backed core checksum verification, see [#215](https://github.com/retraceur/coeur/pull/215):
  - `get_core_checksums()`.
  - `Core_Upgrader::check_files()`, as well as the `pre_check_md5` upgrade argument it relied on.
- The IXR API, only used by the XML-RPC API deprecated in Retraceur 1.0.0, see [#181](https://github.com/retraceur/coeur/pull/181):
  - `class-IXR.php` and all the `IXR_*` classes.
  - `WP_HTTP_IXR_Client`, which has been moved into the Reactions plugin, see [#182](https://github.com/retraceur/coeur/issues/182) and [#183](https://github.com/retraceur/coeur/pull/183).
- The WP Code Editor functions, see [#175](https://github.com/retraceur/coeur/issues/175):
  - `wp_enqueue_code_editor()`.
  - `wp_get_code_editor_settings()`.
  - `wp_custom_css_cb()`.
- The `widgets` dist JS & dist CSS assets.

### Removed

- Fully remove the WP Code Editor (CodeMirror), which was only used by the Customizer, the Widgets screens and the Plugin/Theme file editors — all removed in previous Retraceur versions. The `codemirror` directory is deleted during the 4.0.0 upgrade, see [#175](https://github.com/retraceur/coeur/issues/175) and [#176](https://github.com/retraceur/coeur/pull/176).
- Remove the `editor-buttons` styles, only used by the Classic Editor which is no more supported since Retraceur 1.0.0, see [#178](https://github.com/retraceur/coeur/issues/178) and [#179](https://github.com/retraceur/coeur/pull/179).
- Remove the Thickbox usage from the Plugins/Blocks list tables.
- Remove the plugin auto updates UI.


## [3.2.0] - 2026-07-18

### Changed

- Backports WP 6.9.5 Security fixes about:
  - a facilitated SQL injection vulnerability;
  - a REST API batch-route confusion and SQL injection issue leading to Remote Code Execution.


## [3.1.0] - 2026-03-14

### Changed

- Don't show the "Must-Use" and "Drop-ins" views when on the blocks list table, see [#166](https://github.com/retraceur/coeur/issues/166).
- Use Retraceur logo as post preview loader, see [#168](https://github.com/retraceur/coeur/issues/168).
- Disable Retraceur releases checksum site health checks, see [#169](https://github.com/retraceur/coeur/issues/169).
- Improve the Open Graph Image setting, making it more consistent compared to the Site Icon one. See [#172](https://github.com/retraceur/coeur/issues/172).
- Cherry pick 9 interesting WP 6.9 commits.


## [3.0.0] - 2026-03-01

### Added

- Cherry pick 548 commits from the WP 6.9-branch, see [#121](https://github.com/retraceur/coeur/issues/121).
- Introduce a Core Open Graph API for Retraceur, see [#144](https://github.com/retraceur/coeur/issues/144).
- Define a “Global Media Assets” section in Media settings, see [#149](https://github.com/retraceur/coeur/issues/149).

### Changed

- Make sure `undo-manager` package is not deleted during upgrade process, see [#160](https://github.com/retraceur/coeur/issues/160).
- Improve the "1 click update" logic, see [#161](https://github.com/retraceur/coeur/issues/161).
- Open Graph API: improve `og:description` prop when a single post/page is displayed, see [#164](https://github.com/retraceur/coeur/issues/164).
- Make sure latest posts widget only lists standard post formats, see [#133](https://github.com/retraceur/coeur/issues/133).
- Make sure `per_page` user setting is saved in Blocks Admin page, see [#127](https://github.com/retraceur/coeur/issues/127).
- Make sure the Edit posts Screen's post format dropdown uses the right slug, see [#123](https://github.com/retraceur/coeur/issues/123).

## [3.0.0-RC1] - 2026-02-28


## [3.0.0-beta1] - 2026-02-24


## [2.0.1] - 2025-10-01

### Changed

- Increase the specificity of capability checks for collections when the edit context is in use.


## [2.0.0] - 2025-09-21

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
- Make sure the "core/more" block is honored by the Site Editor, see [#103](https://github.com/retraceur/coeur/issues/103)
- Improve the `WP_Screen->set_help_sidebar()` method to better control its output, see [#107](https://github.com/retraceur/coeur/issues/107)
- Improve Blocks Admin screen help tabs content, see [#108](https://github.com/retraceur/coeur/issues/108)
- Improve the "Add Block" Admin screen help tab, see [#111](https://github.com/retraceur/coeur/issues/111)
- Add a link to docs for the "Add block" Admin screen, see [#113](https://github.com/retraceur/coeur/issues/113)
- Avoid using placeholders in Block/Plugin screen help tabs l10n, see [#118](https://github.com/retraceur/coeur/issues/118)
- Do not include the "cb" column in the Post Formats list table, see [#122](https://github.com/retraceur/coeur/issues/122)

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
- Disable experimental Blocks, see [#105](https://github.com/retraceur/coeur/issues/105)
- Remove the 1 click upgrade opt-in filter, see [#117](https://github.com/retraceur/coeur/issues/117)


## [2.0.0-RC1] - 2025-09-14


## [2.0.0-beta2] - 2025-09-06


## [2.0.0-beta1] - 2025-08-14


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
