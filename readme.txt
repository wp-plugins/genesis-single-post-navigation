=== Genesis Single Post Navigation ===
Contributors: daveshine
Donate link: http://genesisthemes.de/en/donate/
Tags: genesis, genesiswp, genesis framework, single post, navigation, browse, next, previous, next post, previous post, style
Requires at least: 3.0.0
Tested up to: 3.3-aortic-dissection
Stable tag: 1.2

Plugin adds next & prev nav links on single posts to have a "browse post by post nav style". Use of Genesis Theme Framework is required.

== Description ==
This small and lightweight plugin adds next & previous navigation links on single posts to have some kind of a browse post by post nav style. Using the WordPress core function for previous and next post links these links only appear on single posts. The browsing is chronological. Some blog authors prefer to have such a style to offer their readers some feeling of "book reading..." So the plugin might add some nice effect :). Styling with CSS is possible, please see under FAQ here!

In the css file a Media Query setting was added to avoid the display of these browse links on screens/ viewports with a width smaller than 1100px. You can edit this via CSS, see FAQ.

Please note: The plugin requires the [Genesis Theme Framework](http://deckerweb.de/go/genesis/) (aff link)

= Localization =
* English (default) - always included
* German - always included
* Your translation? - [Just send it in](http://genesisthemes.de/en/contact/)

[A plugin from deckerweb.de and GenesisThemes](http://genesisthemes.de/en/)

* [*GenesisFinder* - Find then create. Your Genesis Framework Search Engine.](http://genesisfinder.com/)
* Please support me by [following on Twitter](http://twitter.com/#!/deckerweb) and [my Facebook page](http://www.facebook.com/deckerweb.service) - Thank you! ;-)
* [Also see my other plugins](http://genesisthemes.de/en/wp-plugins/) or see [my WordPress.org profile page](http://profiles.wordpress.org/users/daveshine/)

== Installation ==
1. Upload `genesis-single-post-navigation` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Visit any single post of your site or blog to see the browse links on the left and right side ...
4. Please note: This small and lightweight plugin has no options page - just activate and you're good to go :-).

== Frequently Asked Questions ==
= The link styles don't fit to my site and/or are invisible - what should I do? =
Don't panic. It's just some css styling - look at the next questions on how you can edit this. Thank you!
(The plugin comes only with one pre-defined style so it cannot fit with any site by default. Thank you for your understanding!)

= Can I change the color of the links and/or the link hover behaviour? =
Yes, you can! Just edit the `single-post-navigation.css` file in the plugin folder `/genesis-single-post-navigation/css/`. Edit the link styles as documented in the stylesheet. (Just note that after any plugin update you have to do this again so never forget to make a BACKUP of your files to easily revert to the plugin's default!)

= Can I remove or change the styling of the tiny border lines? =
Yes, of course! Just the same procedure as above! Look for the documented style settings in the css file.

= Can I adjust the media query for another display size (or even various sizes) because my site or content width is bigger/ smaller? =
Again, that's possible! Just the same procedure as above! Look for the documented style settings in the css file.

= Can I change the link string? =
Yes, it's possible of course but that requires some knowledge of the WordPress functions for `previous_post_link()` and `next_post_link()`. The function is documented in the [WordPress Codex](http://codex.wordpress.org/Template_Tags/next_post_link). - Please note: Changing functions in the php file of this plugin can lead to errors on the site or complete crashing of the site! So you should only edit if you really know what you are doing! And please make BACKUPs before editing anything! (Note: I am not responsible for crashed sites by false editing!)

== Screenshots ==
1. Adding browse next & previous links to single posts of Genesis-powered blogs - 1st example: included default style for light backgrounds
2. Adding browse next & previous links to single posts of Genesis-powered blogs - 2nd example: user customized stylesheet for dark backgrounds

== Changelog ==
= 1.2 =
* Optimized CSS3 Media Query: only display the links for displays of 1100px width or bigger
* Added checks for activated Genesis Framework and its minimum version before allowing plugin to activate
* Added plugin update nag in WP Admin with advice for existing CSS customizations to be backuped/saved
* Added localization for the whole plugin, which is pretty much the plugin description section and all messages in WP Admin
* Added German translations (plus English included by default)
* For translators: added .pot file to the download package (gspn.pot in /languages/)
* Improved and documented plugin code
* Tested & proved compatibility with WordPress 3.3-aortic-dissection :-)

= 1.1 =
* Added CSS3 Media Query to load only for bigger displays/ viewports
* Optimized and documented the stylesheet

= 1.0 =
* Initial release

== Upgrade Notice ==
If you have a cache plugin running in WordPress, it's recommended to delete/ clear the cache just after upgrading the plugin.

= 1.2 =
Several changes - Optimzed media query, added activation checks and localization and further improved code and documentation.

= 1.1 =
Minor changes - Added CSS3 Media Query to load only for bigger displays/ viewports, optimized and documented the stylesheet.

= 1.0 =
Just released into the wild.

== Translations ==

* English - default, always included
* Deutsch - immer dabei! [Download auch via deckerweb.de Sprachdateien](http://deckerweb.de/material/sprachdateien/genesis-plugins/#genesis-single-post-navigation)
