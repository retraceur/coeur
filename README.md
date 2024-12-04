# Retraceur

It's a WordPress®[^1] **fork** first focusing on **blogging** features I decided to build & maintain for [my use](https://imathi.eu) in reaction to the "Web" that Mr. Mullenweg has woven for 20 years and which has lately become untrustworthy (see [this](https://wordpress.org/news/2024/09/wp-engine-banned/) & [that](https://wordpress.org/news/2024/10/secure-custom-fields/)).

My belief is open source project should be lead **virtuously** which excludes the current WP centralization of powers and the fact it currenlty lacks a watchdogs system making sure every community members and **firslty its leader** comply to highest standards of probity, integrity, fairness, impartiality, transparency & trustworthy (eg: basic requirements as a conflict of interest policy or a code of ethics are not currenly met).

> A servant-leader focuses primarily on the growth and well-being of people and the communities to which they belong. While traditional leadership generally involves the accumulation and exercise of power by one at the “top of the pyramid,” servant leadership is different. The servant-leader shares power, puts the needs of others first and helps people develop and perform as highly as possible.

Credits [greenleaf.org](https://www.greenleaf.org/what-is-servant-leadership/).

More or less of 40% of the Web cannot have a strong dependency to a site owned by M. Mullenweg without any watchdogs. [w.org](https://w.org) is centralizing: code source management, documentation, translations, end users automatic updates; plugin, theme, block or pattern directory integrations; emojis; browser compatibility checks; default font collections, etc.

Retraceur is regularly synchronized with WP Core latest version to benefit from potential security fixes and interesting improvements brought by the great WP Core contributors team. Please note:

- All links to the [w.org](https://w.org) network or distant API were removed from the source code.
- All references to the WordPress®[^1] trademark were replaced by the "WP" or "Retraceur" terms or removed.
- WordPress®[^1] logos were replaced by Retraceur ones.
- Gravatar was replaced by [Libravatar](https://www.libravatar.org/).
- WP Emojis were replaced by [OpenMojis](https://openmoji.org/).
- The default font collection was removed as it's hosted on `s.w.org`.
- The Link/Bookmark manager was removed.
- The Multisite feature was removed.
- Using **Block Themes** in Retraceur is recommended:
  - The WP Customizer was removed.
  - WP Widgets were removed.
	- WP Nav Menus were removed.

This software comes without any warranty. Everyone is welcome to contribute!

My next steps will be:
- [ ] build an automatic & distributed update system based on GitHub services replacing the WP distant plugin & theme API using the [entrepôt](https://github.com/imath/entrepot) plugin features merge.
- [ ] move the WP comments feature out of Retraceur Core & make it available as a plugin.
- [ ] package the Multisite feature as a plugin.


[^1]: The WordPress® trademark is the intellectual property of the [WordPress Foundation](https://wordpressfoundation.org/trademark-policy/). Uses of the WordPress® name in this repository are for identification purposes only and do not imply an endorsement by the WordPress Foundation.
