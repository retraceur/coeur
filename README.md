# Retraceur

This **Personal Online Publication Hub** is a WordPress®[^1] **fork** I decided to build & maintain for [my use](https://imathi.eu) in reaction to the "Web" that Mr. Mullenweg has woven for 20 years and which has lately become untrustworthy (see [this](https://wordpress.org/news/2024/09/wp-engine-banned/) & [that](https://wordpress.org/news/2024/10/secure-custom-fields/)).

My belief is open source project should be led **virtuously** which excludes the current WP centralization of powers and the fact it currenlty lacks a watchdogs system making sure every community members and **firslty leaders** comply to highest standards of probity, integrity, fairness, impartiality, transparency & trustworthy (eg: basic requirements as a conflict of interest policy or a code of ethics are not currenly met by the WordPress®[^1] project).

More or less of 40% of the Web cannot have a strong dependency to a site owned by M. Mullenweg without any watchdogs. [wp-dot-org](https://w.org), a property of M. Mullenweg, is centralizing: code source management, documentation, translations, end users automatic updates; plugin, theme, block or pattern directory integrations; emojis; browser compatibility checks; default font collections, etc.

Retraceur is regularly synchronized with WP Core latest version to benefit from potential security fixes and interesting improvements brought by the great WP Core contributors team.

Everyone is free to make Retraceur their very own **Personal Online Publication Hub** & contributions are welcome!

Retraceur is setting us free from the WordPress®[^1] trademark and the wp-dot-org chains Mr. Mullenweg is using to preserve his personal interests:

- All links to the [wp-dot-org](https://w.org) network or distant API were removed from the source code.
- All references to the WordPress®[^1] trademark were replaced by the "WP" or "Retraceur" terms or removed.
- WordPress®[^1] logos were replaced by Retraceur ones.
- Gravatar was replaced by [Libravatar](https://www.libravatar.org/).
- WP Emojis were replaced by [OpenMojis](https://openmoji.org/).
- The default font collection was removed as it's hosted on `s.w.org`.

Retraceur Core ("**coeur**" in french, if you're wondering about the meaning of this repository name) only keeps what a **Personal Online Publication Hub** needs:

- The Link/Bookmark manager was removed.
- The Multisite feature was removed.
- The WP Comments $ Trackbacks feature were removed.
- The legacy WP Editor code (_the one used by the Classic editor_) was removed.
- Using the **Block Editor** & a **Block Theme** is required:
  - The WP Customizer was removed.
  - WP Widgets were removed.
  - WP Nav Menus were removed.

**This software comes without any warranty.**

"Retraceur" is not a trademark, it's just a GitHub organization name! You can use this name or the software logos (CC0 licensed) for any purpose. The users of the software wishing to make sure to get Retraceur safely can do so from this URL: [https://github.com/retraceur/coeur](https://github.com/retraceur/coeur) or from the [Retraceur’s documentation site](https://retraceur.github.io/).

There's no Benevolent Dictator For Life (BDFL), I'll be the first leader/committer as I'm currently the only one maintaining the software 😂. Below is how I believe leaders should behave & I'll do my best to do so:

> [!IMPORTANT]
> A servant-leader focuses primarily on the growth and well-being of people and the communities to which they belong. While traditional leadership generally involves the accumulation and exercise of power by one at the “top of the pyramid,” servant leadership is different. The servant-leader shares power, puts the needs of others first and helps people develop and perform as highly as possible.

Credits [greenleaf.org](https://www.greenleaf.org/what-is-servant-leadership/).

Next Retraceur steps are:
- [ ] build an automatic & distributed update system based on GitHub services replacing the WP distant plugin & theme API meging the [entrepôt](https://github.com/imath/entrepot) plugin features.
- [ ] Create a Retraceur Reactions feature as a plugin (using the Comments feature as an example of use).
- [ ] package the Multisite feature as a plugin.

[^1]: The WordPress® trademark is the intellectual property of the [WordPress Foundation](https://wordpressfoundation.org/trademark-policy/). Uses of the WordPress® name in this repository are for identification purposes only and do not imply an endorsement by the WordPress Foundation.
