=== Ultimate News Plus Widget  ===
Contributors: conceptcorners
Tags: wordpress news plugin, simple news, news feeds, WordPress set post or page as news, WordPress dynamic news, news, latest news, custom post type, cpt, widget, news widget, classified news, newsadvert, conceptcorners, news website, news plugin, latest blog news, latest news widgets, Accelerated  news, breaking News, news timeline, news organizer, wordpress news, news slider, slider, latest news slider, mobile slider, mobile news slider, latest news with custom post type
Requires at least: 3.1
Tested up to: 4.8.3
Author URI: http://www.conceptcorners.com/
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A quick, easy way to add Latest News with custom post type plus News widget to WordPress website.

== Description ==

Every CMS site needs a news section. Ultimate News Plugin allows you add, manage and display news, date archives, widget, news with thumbnails widget on your website.

The plugin adds a Latest News tab to your admin menu, which allows you to enter news items just as you would regular posts.

* Now you can Display news post with the help of short code : 
<code> [ccs_news] </code>
<code> [ccs_news_slider] </code>

* Template code : <code><?php echo do_shortcode('[ccs_news]'); ?></code>
<code><?php echo do_shortcode('[ccs_news_slider]'); ?></code>

= Following are News Parameters for [ccs_news] : =

* **limit :** [ccs_news limit="10"] (Display latest 10 news.)
* **category :**  [ccs_news category="7,8,9"] (Display News categories wise. values are comma separated category ids.)
* **design :** [ccs_news design="design-1"] (select the design to show your news post. values are "design-1", "design-2", "design-3", "design-4", "design-5", "design-6")
* **grid :** [ccs_news grid="2"] (News items per row.)
* **show_date :** [ccs_news show_date="false"] (Display News date OR not. Options are "true OR false")
* **show_category_name :** [ccs_news show_category_name="true"] (Display News category name OR not. Options are "true OR false").
* **show_content :** [ccs_news show_content="true" ] (Display News Short content OR not. Options are "true OR false").
* **order :** [ccs_news order="asc"] (Display your news post in ascending or descending order. values are "asc" OR "desc")
* **orderby :** [ccs_news orderby="post_date"] (Display news post in desired order. Values are "post_date", "modified", "title", "name" (Post Slug), "ID", "rand", "menu_order", "comment_count")
* **link_target :** [ccs_news link_target="self"] (Open link in a same window or in a new tab. Values are "self" OR "blank".)
* **exclude_post :** [ccs_news exclude_post"1,2,3"] (Exclude some news post which you do not want to display.)
* **posts :** [ccs_news posts="4,5,6"] (Display only specific News posts.)
* **show_readmore :** [ccs_news show_readmore="false"] (Show read more button. Values are "true" and "false")
* **word_limit :** [ccs_news word_limit="20"] (Control News short content Words limit. By default limit is 20 words).
* **readmore_tail :** [ccs_news readmore_tail="..."] (Display three dots or ... after content.)
* **pagination :** [ccs_news pagination="false"] (Show pagination links. Values are "true" and "false")

= Following are News Parameters for [ccs_news_slider] : =

* **limit :** [ccs_news_slider limit="10"] (Display latest 10 news.)
* **category :**  [ccs_news_slider category="7,8,9"] (Display News categories wise. values are comma separated category ids.)
* **design :** [ccs_news_slider design="design-1"] (select the design to show your news post. values are "design-1", "design-2", "design-3")
* **show_date :** [ccs_news_slider show_date="false"] (Display News date OR not. Options are "true OR false")
* **show_category_name :** [ccs_news_slider show_category_name="true"] (Display News category name OR not. Options are "true OR false").
* **show_content :** [ccs_news_slider show_content="true" ] (Display News Short content OR not. Options are "true OR false").
* **order :** [ccs_news_slider order="asc"] (Display your news post in ascending or descending order. values are "asc" OR "desc")
* **orderby :** [ccs_news_slider orderby="post_date"] (Display news post in desired order. Values are "post_date", "modified", "title", "name" (Post Slug), "ID", "rand", "menu_order", "comment_count")
* **link_target :** [ccs_news_slider link_target="self"] (Open link in a same window or in a new tab. Values are "self" OR "blank".)
* **exclude_post :** [ccs_news_slider exclude_post"1,2,3"] (Exclude some news post which you do not want to display.)
* **posts :** [ccs_news_slider posts="4,5,6"] (Display only specific News posts.)
* **show_readmore :** [ccs_news_slider show_readmore="false"] (Show read more button. Values are "true" and "false")
* **word_limit :** [ccs_news_slider word_limit="20"] (Control News short content Words limit. By default limit is 20 words).
* **readmore_tail :** [ccs_news_slider readmore_tail="..."] (Display three dots or ... after content.)
* **slides_column :** [ccs_news_slider slides_column="2"] (show the news slide at time in slider.)
* **slides_scroll :** [ccs_news_slider slides_scroll="1"] (number of slides to scroll.)
* **dots :** [ccs_news_slider dots="true"] (show pagination dots under the slider. values are "true" OR "false")
* **arrows :** [ccs_news_slider arrows="true"] (show the slider arrows. values are "true" OR "false")
* **autoplay :** [ccs_news_slider autoplay="true"] (auto slide your news post in slider. values are "true" OR "false")
* **loop :** [ccs_news_slider loop="true"] (continuous loop of news posts. values are "true" OR "false")

== Installation ==

1. Upload the 'ultimate-news-plus-widget' folder to the '/wp-content/plugins/' directory.
1. Activate the Ultimate News Plus Widget plugin through the 'Plugins' menu in WordPress.
1. Add and manage news items on your site by clicking on the 'Latest News' tab that appears in your admin menu.
1. Create a page with the any name and paste this short code <code> [ccs_news] </code>.

== Frequently Asked Questions ==

= Are there shortcodes for news items? =

Yes <code> [ccs_news] </code> for showing news in grid.
<code> [ccs_news_slider] </code> for showing news in slider

= Are you getting fatal error after upgrading to 2.1?
= just go to widgets and save your news widget once.

== Screenshots ==

1. Latest news Listing.
2. Add item into latest news where you can add news title, news category, news featrue image and news custom link.
3. Add categories to latest news also you can see shortcode for each category so just copy the shortcode and paste it in any page or post.

== Changelog == 

= 2.2 =
* [+] New Desgin Added Like Design-4, design-5, design-6.
* [*] Resolved CSS bugs for other themes.

= 2.1 =
* [*] Widgets merged for better use.
* [*] Resolved CSS bugs for other themes.

= 2.0 =
* [+] Added slider shortcode.
* [+] Added content word limit.
* [+] Added readmore button.
* [+] Added Next-Previous pagination for news grid.
* [*] Improved widgets.
* [*] Better control with shortcode parameters.
* [*] Resolved css bugs.

= 1.3 =
* [+] Added category shortcode column.
* [+] Added custom news link.
* [*] Design enhancement and solve css issue.

= 1.2 =
* [+] Added custom readmore link.
* [*] Updated readme file.

= 1.1 =
* [*] Resolved some css issue.

= 1.0 =
* Initial release.

== Upgrade Notice ==

= 2.2 =
* [+] New Desgin Added Like Design-4, design-5, design-6.
* [*] Resolved CSS bugs for other themes.

= 2.1 =
* [*] Widgets merged for better use.
* [*] Resolved CSS bugs for other themes.

= 2.0 =
* [+] Added slider shortcode.
* [+] Added content word limit.
* [+] Added readmore button.
* [+] Added Next-Previous pagination for news grid.
* [*] Improved widgets.
* [*] Better control with shortcode parameters.
* [*] Resolved css bugs.

= 1.3 =
* [+] Added category shortcode column.
* [+] Added custom news link.
* [*] Design enhancement and solve css issue.

= 1.2 =
* [+] Added custom readmore link.
* [*] Updated readme file.

= 1.1 =
* [*] Resolved some css issue.

= 1.0 =
* Initial release.