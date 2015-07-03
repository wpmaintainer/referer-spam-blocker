=== Referer Spam Blocker ===
Contributors: wpmaintainer, theandystratton, bmoredrew, szbl
Tags: spam, domain, block
Requires at least: 4.2
Tested up to: 4.2.2
Stable tag: trunk
License: GPL

Block known spam referring domains at the WordPress level. Serves the offending referring URL an HTTP 403 Forbidden page. Customize your own list of domains using the settings page. 

== Description ==
Referer spam has been growing and clogging up website analytics data (such as Google Analytics) with fraudulent traffic statistics. Millions of users are reporting issues and it has become a major nuisance. 

Block these malicious sites easily. All major referer spam domains blocked out of the box and you can customize the domain keyword lists to block any domains you wish. Brought to you by the team of WordPress experts at WP Maintainer.

== Installation ==
Simply install the plugin and activate. If you want to add more domains or keywords go to Settings > Referer Spam Blocker and add/remove the domain keywords.


== Frequently Asked Questions ==
*What is a domain keyword?*
This is a piece of text that we will look for in the referring domain (host). For example, if you entered "4web" as the domain keyword, any sites linking to your site with the text "4web" in their domain will be blocked. The following example sites would be blocked in this example:

* 4webmasters.org
* 4websitecreators.com
* made4web.com

*Why can't I add a specific domain keyword?*
You may only enter a domain keyword once, so if it exists in the list you can't add it a second time. Also, you cannot add a domain keyword that would block your own site. For example, if our site is "wpmaintainer.com" and we enter the domain keyword "wp" – the plugin will block any links from our site that point to other pages on the site.