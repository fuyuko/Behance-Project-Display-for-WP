=== Fuyuko Project Display Plugin for WP - Powered by Behance ===
Contributors: fuyuko
Donate link: http://wp-behance.fuyuko.net/
Tags: portfolio, project, Behance
Requires at least: 3.7.1
Tested up to: 3.7.1
Stable tag: 
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

a WP plugin to showcase your Behance projects on your WP site.

== Description ==

Fuyuko Project Display Plugin for WP - Powered by Behance is a plugin to allow Projects hosted on behance.com to be displayed within a WP site.

The plugin downloads a specified Behance user's project information using Behance API in JSON format, and generates HTML format Project list. 

= Features =
* Included Behance Data - project name, project thumbnail, project detail page link in behance.com, comments, views, and appreciation data collected at behance.com
* A button click (in the setting page) will regenerate the project list with most recent data from Behance.com

= Notes =
* Currently supporting single WP sites only. The plugin has NOT been tested in MUWP environment.


== Installation ==

Starndard Wordpress Plugin install.

1. Upload `fuyuko-behance-wp.zip` using Wordpress plugin upload feature, or unzip the file and upload the content to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Configure the plugin by "Project Display" menu item under setting in the admin menu
4. Place a shortcode `[fuyukoprojects]` in a page or post where you want to display your projects hosted at Behance

== Frequently Asked Questions ==

Pleaes visit [FuyukoBehanceWP](http://wp-behance.fuyuko.net/ "the plugin webiste") for more information.

== Screenshots ==

1. Admin page for the plugin (under "Setting" in Admin menu).

== Changelog ==

= 0.1 =
*Beta - first release
*Manually updates the project data from Behance by clicking a button in the plugin's setting page.
*Default layout design is implemented in fuyuko_behance_style.css (which works well with Twentythirteen theme)
