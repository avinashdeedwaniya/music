=== Music ===
Contributors: avisavinash
Tags: Music
Requires at least: 3.0
Tested up to: 5.7.2
Requires PHP: 5.2.4
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This is a custom demo plugin where we create a custom post type \'Music\' and taxonomy and list all music content on front using a short code `[music]`.

== Description ==
This plugin will create a new custom post type name \'Music\' with taxonomy \'Genre\' and tag \'Music\'.
You can use shortcode `[music]` to list out all Music content on frontend on any page.
You can also pass the parameters to filter out the listing like 
`[music year=2021 genre=New]`

You can manage the currency and number of posts shown in one paging from `Music Settings` page.
This plugin will create a new custom table in the database to store all data of all meta fields connected to Music post type.

== Installation ==
1. Upload `music.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the \'Plugins\' menu in WordPress
3. Use `[music]` shorcode on page.

== Frequently Asked Questions ==
=Will this remove all data related to Music on deactivation or uninstall =

No, data will be intact from deactivation and uninstall

= Is there any hook provided to extend the design of music listing =

Yes, there are 2 filters available to enhance the music listing design.
1. `music_pagination_before_render`
2. `music_grid_before_render`

== Screenshots ==
1. Music Listing
2. Music Settings
3. Music CPT

== Changelog ==
= 1.0 =
* Updated readme.md file.