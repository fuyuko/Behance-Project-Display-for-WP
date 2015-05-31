=== WP Behance Project Display ===
Contributors: fuyuko
Donate link: http://fuyuko.net/donation/
Tags: portfolio, project, Behance
Requires at least: 3.7.1
Tested up to: 4.2.2
Stable tag: 
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

a plugin to showcase your Behance projects on your WP site.

== Description ==

WP Behance Project Display is a plugin to allow Projects hosted on behance.com to be displayed within a WP site.

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
= 0.4 =
*Beta release
*UPDATE - Plugin name has been changed tp WP Behance Project Display from Fuyuko Project Display Plugin for WP
*UPDATE - ow the content is written in HTML5
*UPDATE - New layout design (need to have awesome font installed)
*UPDATE - Stylesheet now generated using Compass (SCSS)
*UPDATE - Shortcode for the project desplay changed from "fuyukoprojects" to "wpbehance"
*NEW - Settings link added in the installed plugin page
*NEW - The user must obtain Behance API Key to use this plugin. The key must be entered and saved in the plugin setting page.

= 0.3 =
*Alpha - third release (second release to public)
*minor layout adjustment & content update to the plugin's admin page
*shortcode now has "display" attribute which allows to output different layout code. Current values accepted for the display attribute is "default" and "alpha02". "default" or omission of the display attribute will output the most recent version of the layout code. "alpha02" output the code for version 0.2 (alpha). 
*css update 1 - now there is a class associated for #behance-projects container. "default" class for default layout "alpha02" class for alpha02 layout. 
*css update 2 - alpha02: changed the #behance-projects container to be "flex" display type from "table" display type. Impoved the layout 

= 0.2 =
*Alpha - second release (first release to public)
*moved the css link insert location of fuyuko_behance_style.css (priority = 0)
*added break lines between views, appreciatiosns, comments

= 0.1 =
*Alpha - first release
*Manually updates the project data from Behance by clicking a button in the plugin's setting page.
*Default layout design is implemented in fuyuko_behance_style.css (which works well with Twentythirteen theme)
