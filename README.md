# Retraceur

[![Contributor Covenant](https://img.shields.io/badge/Contributor%20Covenant-2.1-4baaaa.svg)](CODE_OF_CONDUCT.md)

This **Personal Online Publication Hub** is a WordPress®[^1] **fork** I decided to build & maintain for [my use](https://imathi.eu) in reaction to the "Web" that Mr. Mullenweg has woven for 20 years and which has lately become untrustworthy.

My belief is open source project should be led **virtuously** which excludes the current WP centralization of powers and the fact it currenlty lacks a watchdogs system making sure every community members and **firslty leaders** comply to highest standards of probity, integrity, fairness, impartiality, transparency & trustworthy (eg: basic requirements as a conflict of interest policy or a code of ethics are not currently met by the WordPress®[^1] project).

More or less of 40% of the Web cannot have a strong dependency to a site owned by Mr. Mullenweg without any watchdogs. [wp-dot-org](https://w.org), a property of M. Mullenweg, is centralizing: code source management, documentation, translations, end users automatic updates; plugin, theme, block or pattern directory integrations; emojis; browser compatibility checks; default font collections, etc.

Retraceur is setting me (and possibly "us"?) free from the WordPress®[^1] trademark and the wp-dot-org chains Mr. Mullenweg is using to preserve his personal interests:

- All links to the [wp-dot-org](https://w.org) network or distant API were removed from the source code.
- All references to the WordPress®[^1] trademark were replaced by the "WP" or "Retraceur" terms or removed.
- WordPress®[^1] logos were replaced by Retraceur ones.
- Gravatar was replaced by [Libravatar](https://www.libravatar.org/).
- WP Emojis were replaced by [OpenMojis](https://openmoji.org/).
- The default font collection was removed as it's hosted on `s.w.org`.

Retraceur Core ("**coeur**" in french, if you're wondering about the meaning of this repository name) only keeps what a **Personal Online Publication Hub** needs:

- The Link/Bookmark manager was removed.
- The Multisite feature was removed.
- The WP Comments & Trackbacks feature were removed.
- The legacy WP Editor code (_the one used by the Classic editor_) was removed.
- Using the **Block Editor** & a **Block Theme** is required:
  - The WP Customizer was removed.
  - WP Widgets were removed.
  - WP Nav Menus were removed.

Everyone is free to make Retraceur their very own **Personal Online Publication Hub** & contributions are welcome!

"Retraceur" is not a trademark, it's just a [GitHub organization name](https://github.com/retraceur)! You can use this name or the software logos (CC0 licensed) for any purpose. The users of the software wishing to make sure to get Retraceur safely can do so from this URL: [https://github.com/retraceur/coeur](https://github.com/retraceur/coeur) or from the [Retraceur’s documentation site](https://retraceur.github.io/).

Retraceur is cherry picking attractive WP Core commits to benefit from potential security fixes and interesting improvements brought by the great WP Core contributors team.

Next Retraceur steps are:
- [ ] Improve the post format API (see [#1](https://github.com/retraceur/coeur/issues/1)).
- [ ] Build an automatic & distributed update system based on GitHub services replacing the WP distant plugin, block, theme and translation APIs (see [#30](https://github.com/retraceur/coeur/issues/30)).
- [ ] Include a Post Status API to allow custom Post Status (see [#44](https://github.com/retraceur/coeur/issues/44))

**This software comes without any warranty.**

[^1]: The WordPress® trademark is the intellectual property of the [WordPress Foundation](https://wordpressfoundation.org/trademark-policy/). Uses of the WordPress® name in this repository are for identification purposes only and do not imply an endorsement by the WordPress Foundation.
