=== Hello In All Languages ===
Contributors: StathisG
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=A545FWZ8AB5GL
Tags: hello in all languages, hello, greeting, hola, hallo, γεια σου, bonjour, marhaba, ola, dobry den
Requires at least: 2.8
Tested up to: 4.0
Stable tag: 1.0.5
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Hello In All Languages displays a "hello" word translated to the official language of the country the visitor's IP belongs to.

== Description ==
Hello In All Languages displays a "hello" word translated to the official language of the country the visitor's IP belongs to.

== Screenshots ==

1. Some "hello" translations
2. How to use in a post
3. The plugin's settings

== Installation ==

= How to install =

1. Upload the extracted archive to wp-content/plugins/ or upload the archive from the admin dashboard (Plugins -> Add New -> Upload).
2. Activate the plugin via the Plugins menu.

= How to configure =

1. Open the plugin settings page (Settings -> Hello In All Languages).
2. Select how the word will be displayed (capitalised, uppercase, or lowercase).
3. Select the default language (will be used if the visitor's IP cannot be determined).
4. Optional, but recommended: Sign up for a free IPInfoDB API key and paste it in the appropriate field.

= How to use =

Enter the shortcode [HELLO-IN-ALL-LANGUAGES] in any post or page and the translated hello will be displayed.

= Notes =

* To ensure that all the hello translations will be displayed correctly, please use UTF-8 charset.
* Please be aware that the plugin may not work properly if you are testing your blog in a local server.
* To determine the visitor's physical location based on his IP, the geolocation API provided by [IPInfoDB](http://ipinfodb.com/) is used.

== Frequently Asked Questions ==

= How can I get support? =

For questions, issues, or feature requests, you can either [contact me](http://burnmind.com/contact), or post them either in the [WordPress Forum](http://wordpress.org/tags/hello-in-all-languages) (make sure to add the tag "hello-in-all-languages"), or in [this](http://burnmind.com/freebies/hello-in-all-languages-wordpress-plugin) blog post.

== Changelog ==
= 1.0.5 =
* Some code refactoring.
* Removed "Way to connect to API" option.
* When plugin is uninstalled, saved settings are removed from the database.
= 1.0.4 =
* Fixed a wpdb warning.
* Minor content changes.
= 1.0.3 =
* Now using version 3 of the IPInfoDB API.
* Added the option to use personal API key.
* Added a country code
* Fixed an issue where an unknown coutry code was causing the greeting to be empty.
= 1.0.2 =
* Updated to use version 2 of the IPInfoDB API.
= 1.0.1 =
* Fixed uncaught exception error.
= 1.0.0 =
* The initial release!

== Upgrade Notice ==

= 1.0.5 =
Please upgrade to receive a version of the plugin with a refactored codebase.