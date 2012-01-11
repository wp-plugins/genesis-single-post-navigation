=== Genesis Single Post Navigation ===
Contributors: daveshine
Donate link: http://genesisthemes.de/en/donate/
Tags: genesis, genesiswp, genesis framework, single post, navigation, browse, next, previous, next post, previous post, style, deckerweb
Requires at least: 3.2
Tested up to: 3.3.1
Stable tag: 1.4

Plugin adds next & prev nav links on single posts to have a "browse post by post nav style". Use of Genesis Theme Framework is required.

== Description ==
This small and lightweight plugin adds next & previous navigation links on single posts to have some kind of a browse post by post nav style. Using the WordPress core function for previous and next post links these links only appear on single posts. The browsing is chronological. Some blog authors prefer to have such a style to offer their readers some feeling of "book reading..." So the plugin might add some nice effect :). Styling with CSS is possible, please see under FAQ here!

In the css file a Media Query setting was added to avoid the display of these browse links on screens/ viewports with a width smaller than 1100px. You can edit this via CSS, see FAQ.

Finally, since version 1.4 of the plugin you can reverse the link direction via defining a little constant in your child theme. Please see the [FAQ section here](http://wordpress.org/extend/plugins/genesis-single-post-navigation/faq/) for more info on that.

Also since version 1.4 of the plugin you can customize the possible parameters of the previous/next post links - these are the same parameters the WordPress functions offers :-). Again, please see [FAQ section here](http://wordpress.org/extend/plugins/genesis-single-post-navigation/faq/) for more info on that!

**Please note:** This plugin requires the Genesis Theme Framework.

= Localization =
* English (default) - always included
* German - always included
* *Your translation? - [Just send it in](http://genesisthemes.de/en/contact/)*

[A plugin from deckerweb.de and GenesisThemes](http://genesisthemes.de/en/)

= Feedback =
* I am open for your suggestions and feedback - Thank you for using or trying out one of my plugins!
* Drop me a line [@deckerweb](http://twitter.com/#!/deckerweb) on Twitter
* Follow me on [my Facebook page](http://www.facebook.com/deckerweb.service)
* Or follow me on [+David Decker](http://deckerweb.de/gplus) on Google Plus ;-)

= More =
* [Also see my other plugins](http://genesisthemes.de/en/wp-plugins/) or see [my WordPress.org profile page](http://profiles.wordpress.org/users/daveshine/)
* Tip: [*GenesisFinder* - Find then create. Your Genesis Framework Search Engine.](http://genesisfinder.com/)

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
Yes, you can!

*First alternative (highly recommended!):* Just look in the packaged CSS file `single-post-navigation.css` to find out the CSS selectors and rules and then overwrite them via your child theme. In most cases you then have to apply them by adding an `!important` to the appropiate rule. -- Big advantage of this alternative: it's update secure!

*First alternative (highly recommended!):* You might edit the `single-post-navigation.css` file in the plugin folder `/genesis-single-post-navigation/css/`. Edit the link styles as documented in the stylesheet. (Just note that after any plugin update you have to do this again so never forget to make a BACKUP of your files to easily revert to the plugin's default!)

= Can I remove or change the styling of the tiny border lines? =
Yes, of course! Just the same procedure as above! Look for the documented style settings in the css file. - The alternative via child theme is always recommended :)

= Can I adjust the media query for another display size (or even various sizes) because my site or content width is bigger/ smaller? =
Again, that's possible! Just the same procedure as above! Look for the documented style settings in the css file. - The alternative via child theme is always recommended :)

= Can I swap/reverse the direction of the browsing links? =
Finally, this is now possible since version 1.4 of the plugin :). You only have to add one little line of code (a constant) to the functions.php file of your child theme. (Only add this if you really want to change the direction, if not then just DO NOT add it!) Please add the following code:
`/**
 * Genesis Single Post Navigation: Reverse link direction
 */
define( 'GSPN_REVERSE_LINK_DIRECTION', 'reverse_direction' );`

*Please note:* This leads to changing the general direction of the links, really book-like ("next post link" on the right side, "previous post link" on the left side). It also will lead to reversed arrows (the linked strings) so you now might also add the custom parameters like explained below in next FAQ entry:

= Can I customize the link string, set to only in the same category and can I exclude categories? =
Yes, this is now possible since version 1.4 of the plugin via custom filters which you can add to your functions.php file of the current theme or child theme. -- There's one filter function for each of the two - "previous post link" and "next post link":

**Changing parameters for "previous post link":**
`add_filter( 'gspn_previous_post_link', 'custom_gspn_previous_link' );
/**
 * Genesis Single Post Navigation: Add custom filters for "previous post link"
 */
function custom_gspn_previous_link() {

	$args = array (
		'format'                => '%link',     // Change link format (default: %link)
		'link'                  => '&raquo;',   // Change link string (default: &raquo;)
		'in_same_cat'           => FALSE,       // Apply only to same category (default: FALSE)
		'excluded_categories'   => ''           // Exclude categories (default: empty)
	);

	previous_post_link( $args['format'], $args['link'], $args['in_same_cat'], $args['excluded_categories'] );
}`
[You can also get this code from GitHub Gist here](https://gist.github.com/1576197) // See also [WordPress codex for info on the four possible parameters...](http://codex.wordpress.org/Template_Tags/previous_post_link)

If you reversed the link direction (see above FAQ entry) you might change the link string here to: `&laquo;`

**Changing parameters for "next post link":**
`add_filter( 'gspn_next_post_link', 'custom_gspn_next_link' );
/**
 * Genesis Single Post Navigation: Add custom filters for "next post link"
 */
function custom_gspn_next_link() {

	$args = array (
		'format'                => '%link',     // Change link format (default: %link)
		'link'                  => '&laquo;',   // Change link string (default: &laquo;)
		'in_same_cat'           => FALSE,       // Apply only to same category (default: FALSE)
		'excluded_categories'   => ''           // Exclude categories (default: empty)
	);

	next_post_link( $args['format'], $args['link'], $args['in_same_cat'], $args['excluded_categories'] );
}`
[You can also get this code from GitHub Gist here](https://gist.github.com/1576203) // See also [WordPress codex for info on the four possible parameters...](http://codex.wordpress.org/Template_Tags/next_post_link)

If you reversed the link direction (see above FAQ entry) you might change the link string here to: `&raquo;`

== Screenshots ==
1. Adding browse next & previous links to single posts of Genesis-powered blogs - 1st example: included default style for light backgrounds
2. Adding browse next & previous links to single posts of Genesis-powered blogs - 2nd example: user customized stylesheet for dark backgrounds

== Changelog ==
= 1.4 =
* *Finally:* Added possibility to reverse the link direction via a constant added to the child theme - [please see FAQ section here for more info](http://wordpress.org/extend/plugins/genesis-single-post-navigation/faq/)
* Added filters to the plugin which allow now to change the parameters for "previous post link" and "next post link" - all of the 4 parameters for the WordPress template tags/functions could be used - [please see FAQ here here for more info](http://wordpress.org/extend/plugins/genesis-single-post-navigation/faq/) - *Note:* This requires v1.4 or higher of this plugin!
* General code tweaks, also improved code documentation for newly added filters
* Added new rules for the customizations to CSS file, improved documentation and code standards
* Added plugin resource links on plugin list page
* Enhanced and improved readme.txt file with more info, documention and FAQ entries for customizing the parameters
* Updated German translations and also the .pot file for all translators!

= 1.3 =
* Fixed possible enqueue issue with stylesheet: replaced deprecated hook with new standard.
* Updated German translations and also the .pot file for all translators!
* Tested & proved compatibility with WordPress 3.3 final release :-)

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
= 1.4 =
Major changes and improvements - Added filters and constants for customizations via child theme. Added plugin resource links to plugin page. Some general code and documentation tweaks, also minor tweaks in CSS file. Furthermore, updated readme.txt file and also .pot file for translators together with German translations.

= 1.3 =
Important change: improved compatibility with WordPress 3.3+.

= 1.2 =
Several changes - Optimzed media query, added activation checks and localization and further improved code and documentation.

= 1.1 =
Minor changes - Added CSS3 Media Query to load only for bigger displays/ viewports, optimized and documented the stylesheet.

= 1.0 =
Just released into the wild.

== Translations ==

* English - default, always included
* German: Deutsch - immer dabei! [Download auch via deckerweb.de](http://deckerweb.de/material/sprachdateien/genesis-plugins/#genesis-single-post-navigation)

*Note:* All my plugins are localized/ translateable by default. This is very important for all users worldwide. So please contribute your language to the plugin to make it even more useful. For translating I recommend the awesome ["Codestyling Localization" plugin](http://wordpress.org/extend/plugins/codestyling-localization/) and for validating the ["Poedit Editor"](http://www.poedit.net/).
