=== WooRocks Magic Content ===
Contributors: andreaskviby
Donate link: http://woorocks.com
Tags: woorocks, elementor, page builder, magic content
Requires at least: 4.3
Tested up to: 4.9.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Control output of content using custom roles, if user is logged in or not and more.

== Description ==

** Due to loads of work I will have no time updating this plugin until october **

https://www.youtube.com/watch?v=hQ5DKroDZ2Q

** 1 of the most helpful plugins for Elementor according to Ben Pines of Elementor **

[Article from Elementor](https://elementor.com/third-party-addon-plugins/)

Magic Content by WooRocks is a lightweight and powerful add-on that allows you to take control of your website’s content by
restricting access to sections to logged in users, specific user roles or to logged out users.

You don't have to use any kind of shortcodes using this plugin. Just install Elementor Page Builder and this plugin and you are all set.

*   Choose if a section will be visible for logged in / logged out users only.
*   Choose if a section will be visible for logged in users that are members of a choosen role in Wordpress.
*   Choose if a section will be visible for logged in users that are members of any custom role in Wordpress.
*   Choose if a section will be visible for users from a specific country with two letter countrycodes.
*   Choose if a section will be visible for users from a specific region.
*   Choose if a section will be visible for users from a specific city.
*   You can NOT combine countries like SE, NO in this version.

You will have to assign sections both country and region or country or city if using GEO locations for them to work properly!

This is the first version of the plugin and we will add more features to it soon. The more people that uses it and spreads the word
about it the more time we will invest in developing it further.

We are also working on a PRO version fully packed with other features for the Elementor Page Builder Plugin.

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/woorocks-magic-content` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Startup the Elementor Page Builder and edit a page.
4. Goto a section and click on the Advanced TAB and see the Magic Content controls.

== Frequently Asked Questions ==

= Does this work with any other page builders =

YES, there are versions for Elementor Page Builder and also Siteorigins Pagebuilder.

= Does it affect some other plugins =

Not that we are aware of, we have tested it with several of the known memberships plugins without trouble.

= Does it affect some themes =

We have some reports that some themes mights be affected in the header and we are working hard to make it better.

= Does it support custom roles =

Yes, from version 1.0.10 it does support any custom role you might have setup in your installation.

= Does it support WooCommerce =

Yes, it now supports WooCommerce roles as well so you can create filters depending on customer / shop manager etc.

== Screenshots ==

1. Here you can see that we have just choosen to show this section to users that are logged out, also called visitors.

2. We can choose if the users need to be logged in or logged out.

3. We can also choose from all the built in standard user roles in the system. Just choose the role in your sections and they are protected.

4. Here you can see that we can also alter several sections on one page. So with Magic Content you can choose to have different restrictions
 on several parts of your pages.

5. This demosection is only displayed for users inside the role subscriber.

6. From version 1.0.5 you can also set GEO filters for country, region and city as the screenshot shows you. This way you can protect your content in Wordpress by country, region and country.

7. You can filter on any custom role in WordPress. Supports any added custom role.

== Changelog ==

= 1.0.0 =
* First version released.

= 1.0.1 =
* Update which now includes features for country,region and city filters for your content.

= 1.0.2 =
* Bugfix in countryselector.

= 1.0.3 =
* Bugfix, country selector does not work with some hosts so it has been depreciated until further.

= 1.0.4 =
* Bugfixes, it seem that the php function file_get_contens does not work on a lot of webhosts. So we upgraded to use curl.

= 1.0.5 =
* Major fix for GEO functions. We had to change API and also we did forget to trim all strings returned so therefore the function was not so good. We apologize.

= 1.0.6 =
Added freemium services to increase user feedback and start developing new user requested features.

= 1.0.7 =
Bugfixes.

= 1.0.8 =
Bugfixes.

= 1.0.9 =
Finally fixed the issue with the headers that got screwed up for some themes.

= 1.0.10 =
Finally added ability to filter on any custom role your installation may have.

= 1.0.11 =
New icons and readme

= 1.0.12 =
Fixed the debug missing part of the plugin.

= 1.0.13 =
Fixed the error in the admin panel and also hopefully makes crash with some plugins not happen anymore.

= 1.0.14 =
Added funtion to disable plugin in admin areas.

= 1.0.15 =
Added funtion to disable plugin in admin areas.

= 1.0.16 =
Changed the behaviour of plugin activation to support latest WP and Elementor.

= 1.0.17 =
Made changes so that the plugin won't try to load when ajax actions are performed. Trying to fix a bug for some ajax depending plugins that won't work when Magic Content is installed.

== Upgrade Notice ==

= 1.0.0 =
First version updated with options to use user roles as well. More features will come soon.

= 1.0.1 =
The new version will enable you to filter content for your users based on country, region and city. Awesome news!

= 1.0.2 =
* Bugfix in countryselector.

= 1.0.3 =
* Bugfix, country selector does not work with some hosts so it has been depreciated until further.

= 1.0.4 =
* Bugfixes, it seem that the php function file_get_contens does not work on a lot of webhosts. So we upgraded to use curl.

= 1.0.5 =
* Major fix for GEO functions. We had to change API and also we did forget to trim all strings returned so therefore the function was not so good. We apologize.

= 1.0.6 =
Added freemium services to increase user feedback and start developing new user requested features.

= 1.0.7 =
Bugfixes.

= 1.0.8 =
Bugfixes.

= 1.0.9 =
Finally fixed the issue with the headers that got screwed up for some themes.

= 1.0.10 =
Finally added ability to filter on any custom role your installation may have.

= 1.0.11 =
New icons and readme

= 1.0.12 =
Fixed the debug missing part of the plugin.

= 1.0.13 =
Fixed the error in the admin panel and also hopefully makes crash with some plugins not happen anymore.

= 1.0.14 =
Added funtion to disable plugin in admin areas.

= 1.0.15 =
Added funtion to disable plugin in admin areas.

= 1.0.16 =
Changed the behaviour of plugin activation to support latest WP and Elementor.

= 1.0.17 =
Made changes so that the plugin won't try to load when ajax actions are performed. Trying to fix a bug for some ajax depending plugins that won't work when Magic Content is installed.