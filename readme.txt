=== Walk Score Plugin ===
Contributors: mahalie, walkscore
Tags: walk-score, walkscore, google maps, maps, real estate, real estate listings, real estate maps, neighborhood info, neighborhood, hyper local, local, homes, listing, plugin, shortcode, realty, commute report, commuting, commute map
Requires at least: 3.0
Tested up to: 3.2.1
Stable tag: 0.5.5
License: GPLv2

The Walk Score plugin provides a shortcode so you can embed neighborhood maps in your posts and pages.

== Description ==

Provides WordPress shortcodes for embedding [Walk Score Neighborhood Maps](http://www.walkscore.com/professional/neighborhood-map.php?utm_source=wspi) in your posts and pages. Walk Score Neighborhood Maps display a map for any address that shows a property's location on a map, Walk Score (0-100 score measuring how walkable the location is) and nearby amenities. With the interactive map your visitors can create a Commute Report showing drive times to work to that location, explore lists of amenities by category (schools,restaurants, coffee shops, etc). The map displays a Google map by default, but offers your visitors options to use Street View (Google), Bird's Eye view (Bing), a walkability heat map and a 15-minute walkability zone (walkshed). 

Features in Walk Score 0.5 series include:

* Embed neighborhood maps in posts.
* Set default sizes (small, medium or large) and format (vertical or horizontal)
* Override default settings in the shortcode for a specific post

You'll need a [Walk Score ID](http://www.walkscore.com/professional/sign-up.php?utm_source=wspi) to use it this plugin.  The ID is free for personal blogs, with paid subscriptions you can remove ads and outbound links.

== Installation ==

1. Upload the `walk-score` folder to the `/wp-content/plugins/` directory.
1. Activate the plugin in your WordPress Plugins area.
1. Sign up for a [Walk Score ID](http://www.walkscore.com/professional/sign-up.php?utm_source=wspi).
1. Copy your new Walk Score ID from the email you receive from Walk Score after signing up.
1. Enter the Walk Score ID in the plugin settings (Settings > Walk Score)
1. Embed maps in your posts & pages using the shortcode (see below)

**Shortcode Usage**

The plugin makes the following shortcode available.

`[walk-score-map address="ANY-ADDRESS-GOES-HERE"]`


Attributes:
* `address=""` - **required attribute**, enter a complete address.
* `size=""` - size of map, options: `small`, `medium`, `large`, `s`, `m`, `l`.
* `format=""` - orientation, options: `vertical`, `horizontal`, `v`, `h`.

Note the optional attributes override the default attributes for all maps set in the plugin settings.

**Shortcode Examples**

Display a map of the White House, USA:

`[walk-score-map address="1450 Pennsylvania Avenue Northwest, Washington DC"]`


Display a map of the Sydney Opera House in the small horizontal format (overrides default map size):

`[walk-score-map address="2 Macquarie Street, Sydney NSW 2000, Australia" size="s" format="h"]`


== Frequently Asked Questions ==

= What size are the different map options? = 

They are the same size as pre-set Neighborhood Maps provided by Walk Score here:
[http://www.walkscore.com/professional/neighborhood-map.php](http://www.walkscore.com/professional/neighborhood-map.php?utm_source=wspi)

= Can I create a custom size? =

Not yet.

= Where can I get support? =

Please report any problems or suggest features on [Walk Score's Get Satisfaction forum](http://getsatisfaction.com/walk_score/products/walk_score_walk_score_wordpress_plugin).

== Screenshots ==

1. Plugin admin options
2. Example post with a map on the default WordPress theme.
3. Example of an embedded map after a visitor has entered an address for their commute.

== Changelog ==

= 0.5.5 =

* Fix go button styling issue caused by lack of doctype in map iframe

= 0.5.0 =

* Initial release

