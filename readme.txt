=== Service Area Postcode Checker ===
Contributors: second2none
Plugin Name: Service Area Postcode Checker
Donate link: http://wordpress.plustime.com.au/donate/
Tags: postcode checker, business service area checker, postcode search, customer delivery areas, postcode, search
Requires at least: 4.9.6
Tested up to: 5.1.1
Stable tag: 2.0.7
Requires PHP: 7.0.10
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Customisable plugin that creates a widget to allows your vistors to check if you service or deliver to their area through a postcode check.


== Contribute ==

Want to contribute to the plguin? Check out the github:
[service-area-postcode-checker](https://github.com/second-2None/service-area-postcode-checker)

== Donate ==

[Please consider donating if this plugin has helped you.](http://wordpress.plustime.com.au/donate/) - Most of our plugins are free, we also proved support for free and all donations, big and small, go towards the development of present and future plugins.

== Description ==
[](http://coderisk.com/wp/plugin/service-area-postcode-checker/RIPS-VdrS-OwJfv)

Service Area Postcode Checker

Allow your users or customers to search their postcode from a custom list. Create multiple lists for Service Area, Delivery Area etc.

== Features ==

* Personalize the plugin with custom classes and text
* Personalize error and success messages
* Customise submit options
* Create multiple lists to search from
* Use shortcodes or widgets to display anywhere
* Redirect users or customers to URL if successful
* Lists accept Wildcard (*) parameter
* On/Off switch for both Checker and Display
* Numeric and alphanumeric postcodes accepted

== Exmaple List Formats ==

Service Area Postcode Checker will accept all these postcode formats.

4000:Brisbane
4000
400*
400*:Brisbane
40*:Brisbane Area
CM*:Custom Match
Check:Display

== Shortcode Usage ==

If you are using the shortcodes you need to include the list you want to search.
**Postcode Checker
[sapc_checker list-select="Default"]

Accepted Parameters (Note if not found, the default settings on the Options page will fill the blanks)

list-select = "Default" *** REQUIRED ***
title-checker = "This is a Test Title"
message-success = "This is a Success Message"
class-success = "success-class"
message-error = "This is a Error Message"
placeholder = "Start Typing Your Postcode"
class-error = "error-class"
trigger-value = "4"
verify-integer  = "on" // on or off
type-trigger  = "on" // on or off
enable-enter  = "on" // on or off
enable-button  = "on" // on or off
button-class = "button-class"
button-txt = "Press Me"
redirect = "http://google.com"

**Postcode Display
[sapc_display list-display="Default"]

title-display = "This is a Test Title"
class-display = "display-class"
class-bullet = "bullet-class"

== Widget Info ==

The plugin creates 2 different widgets:
    -   1 that displays the suburbs and postcodes into a selected list.
    -   1 that displays an input box to check user or customer postcode from selected list

Settings created in the widget overide settings in the option page.

== Demo & Help ==
[Service Area Postcode Checker in Action](http://wordpress.plustime.com.au/service-area-postcode-checker/)
    


== Installation ==

Installation is simple.

1. Upload the plugin files to the `/wp-content/plugins/` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. From the menu click Postcode Checker Settings and input your suburb:postcode list.
4. Insert Postcode Checker Input widget on one of your pages.
5. (Optional) Insert Postcode Display Widget on one of your pages.

== Frequently Asked Questions ==

= I Get Invalid List: Contact Admin when using Shortcode =
You need to include the correct list name when using shortcodes [sapc_checker list-select="Default"]


= What is this plugin used for? =

This plugin is mainly used for local businesses who need a plugin that helps their users search their service or delivery areas quickly and easily.

= Will it be updated? =

Plugin will be updated as much as I can.


== Screenshots ==

1. WP-Admin Service Area Postcode Checker & Submit Default Options
2. WP-Admin Service Area Postcode Display Default Options
3. WP-Admin Service Area Postcode List Options
4. WP-Admin Widget Area Service Area Postcode Checker
5. WP-Admin Widget Area Service Area Postcode Display


== Changelog ==

= 2.0.7 =
* Fixed Plugin Header Issue
* Removed "Postcode Not Foun" in error message
* Added case insensitive check for postcodes.


= 2.0.6 =
* Added Update Placeholder Text from Options Page, Widget and Shortcode
* Removed PHP Deprecated Create_Function  

= 2.0.5 =
* PHP function mispelled

= 2.0.4 =
* Removed Delete_Option for more testing

= 2.0.3 =
* Redirect JS Error Fixed
* Added Translations
* Corrected Success & Error Message bugs
* Fixed Small Code Imperfections
* Made List Name Checks Case Insensitive

= 2.0.2 =
* Fixed JS Button Bug - Class Typo
* Fixed Bug that caused some users to lose their postcodes on update.

= 2.0.1 =
* Fixed typo

= 2.0.0 =
* Fixed whitespace issue and Default Postcode List Issue

= 1.9 =
* Optimized Code and Functions
* Added Multiple List Function
* Added Wildcard Function
* Added URL Redirect on Success
* Add Multiple Searches on 1 Page

= 1.8 =
* Fixed Bug with Wordpress.com

= 1.7 =
* Fixed Bug with typing trigger

= 1.6 =
* List now accepts postcodes only, or format postcode:suburb (or both)
* Fixed incorrect labels and hints
* Fixed Submit Button Issues
* Fixed couple of bugs in JS

= 1.5 =
* Fixed Bug with Verify Integer

= 1.4 =
* Fixed Bug in Display Widget

= 1.3 =
* Added Shortcodes for Checker and Display
* Updated Back end for easier use.
* Optimised Code
  
 = 1.2 =
* Added more submitting options
    - option to add button with custom text and custom class
    - turn typing trigger on and off
    - options added for pressing enter on input box
    - fixed bug when enter was pressed would reload page
    
= 1.1 =
* Added admin option to allow Text Postcode for international users. If the Verify Integer checkbox is checked it will check if the users input is all integers / numbers.

= 1.0 =
* Added custom success / error messages
* Added custom input trigger length value

== Upgrade Notice ==

= 2.0.6 =
= 2.0.7 =
* Fixed Plugin Header Issue
* Removed "Postcode Not Foun" in error message
* Added case insensitive check for postcodes.

* Added Update Placeholder Text from Options Page, Widget and Shortcode
* Removed PHP Deprecated Create_Function  

= 2.0.5 =
* PHP function mispelled

= 2.0.4 =
* Removed Delete_Option for more testing

= 2.0.3 =
* Redirect JS Error Fixed
* Added Translations
* Corrected Success & Error Message bugs
* Fixed Small Code Imperfections

= 2.0.2 =
* Fixed JS Button Bug - Class Typo
* Fixed Bug that caused some users to lose their postcodes on update.

= 2.0.1 =
*Fixed typo

= 2.0.0 =
*Fixed whitespace issue and Default Postcode List Issue

= 1.9 =
* Optimized Code and Functions
* Added Multiple List Function
* Added Wildcard Function
* Added URL Redirect on Success
* Add Multiple Searches on 1 Page

= 1.8 =
* Fixed Bug with Wordpress.com

= 1.7 =
* Fixed Bug with typing trigger

 = 1.6 =
* List now accepts 1 postcode per line.
* Fixed incorrect labels and hints
* Fixed Submit Button Issues
* Fixed couple of bugs in JS
 
= 1.5 =
* Fixed Bug with Verify Integer

 = 1.4 =
* Fixed Bug in Display Widget

 = 1.3 =
* Added Shortcodes for Checker and Display
* Updated Back end for easier use
* Optimised Code

 = 1.2 =
* Added more submitting options
    - option to add button with custom text and custom class
    - turn typing trigger on and off
    - options added for pressing enter on input box
    - fixed bug when enter was pressed would reload page
= 1.1 =
* Added international postcode support