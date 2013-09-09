=== Wordpress Map Maker ===
Contributors: Topher253
Donate link: http://example.com/
Tags: comments, spam
Requires at least: 3.0.1
Tested up to: 3.6
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

The Wordpress Map Maker is a tool that allows you to make a map in your Wordpress admin options panel and place it where ever you would like on a page using short code.

== Description ==

The Wordpress Map Maker is a tool using <a href="http://www.mapbox.com/developers/">the MapBox API</a> that allows you to make a map in your Wordpress admin options panel and place it where ever you would like on a page. The idea is to have a very easy and efficient way to place a customized map on your WordPress site.

Under WordPress' Settings section called "Map Maker Editor" you will be allow to customize a map. From there you will use [Map Maker] shortcode and display the map anywhere you would like to on your site

Features for WordPress Map Maker 
* Selecting a map style
* Mark your location.
* Customize your marker
	-Hex Color
	-Title
	-Description
* Place on any page using [Map Maker] shortcode


== Installation ==

1. Upload `mapmaker.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Place `<?php do_action('plugin_name_hook'); ?>` in your templates

== Changelog ==

= 1.0 =
* Initial

== Upgrade Notice == 

= 1.0 =
Upgrade notices describe the reason a user should upgrade. 

== Screenshots ==

1. This screen shot description corresponds to screenshot-1.(png|jpg|jpeg|gif). Note that the screenshot is taken from
the /assets directory or the directory that contains the stable readme.txt (tags or trunk). Screenshots in the /assets 
directory take precedence. For example, `/assets/screenshot-1.png` would win over `/tags/4.3/screenshot-1.png` 
(or jpg, jpeg, gif).
2. This is the second screen shot

== Frequently Asked Questions ==

= Can I create a map marking my store location marked and put it on my contact page?  =

Yes, you can create a marker with you business name and information marked on the map. You will then go to your contact page and insert [Map Maker] where you would like it to appear.



`<?php code(); // goes in backticks ?>`