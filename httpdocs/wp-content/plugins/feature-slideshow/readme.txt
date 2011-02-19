=== Plugin Name ===
Contributors: Bakke
Donate link: http://sleek.no
Tags: featured, feature, slideshow, jquery, posts, frontpage
Requires at least: 3.0
Tested up to: 3.0.5
Stable tag: 1.0.8-beta 

Retrives posts / pages and creates a jQuery driven slideshow, with a vertical list of post titles and a short excerpt.

== Description ==


Retrives posts / pages and creates a jQuery driven slideshow (using the post feature images), with a vertical list of post titles and a short excerpt.


**Key features:**

* Easy customization 
 * Choose size of the slideshow 
 * Choose number of posts to be displayed and specify categories, tags etc. 
 * Easy customizable CSS.

* Posts are automatically added to the slideshow, if they are amoung the target posts.

* Posts feature image will automatically be used for the slideshow.

* Automatic scaling and cropping of images



This Slideshow uses the Feature List jQuery plugin by <a href="http://jqueryglobe.com/">jQueryGlobe</a>.

You can see the slideshow in action over at <a href="http://pervelde.idrift.no/">Per Veldes website</a>.

== Installation ==


1. Copy the <code>feature-slideshow</code> folder and all its contents to the <code>/wp-content/plugins/</code> directory

2. Activate the plugin through the 'Plugins' menu in WordPress.

3. Set your desired settings under 'Settings' --> 'Feature Slideshow'

4. Make sure all posts that will be displayed in the slideshow has a feature image

5. Set a short description of each post in the <em>Feature Slideshow Options</em>-metabox. You can also add a text to be displayed over the image.

6. Place the <code>[feature-slideshow]</code> shortcode in a post / page, or put <code>feature_slideshow_init();</code> in your code, 
where you want the slideshow.

== Frequently Asked Questions ==

If you can't find your answer here, please post your question <a href="http://sleek.no/kunder/138">here</a>.
 
= The slideshow is going super fast after update =

At update to 1.0.7-beta I changed the intervals from seconds to milliseconds, for better control. Just change your interval time to milliseconds.

= The slideshow stops at the second slide =

This is a jQuery crash that usually occur due to the current theme (or some other plugin) that includes an old version of jQuery. In the popular theme <em>Mystique</em> you can simply go into the file <code>lib/settings.php</code> and remove line 189: <code>  wp_enqueue_script('mystique', THEME_URL.'/js/jquery.mystique.js', array('jquery'), $ver=THEME_VERSION, $in_footer=true);</code>

== Screenshots ==

1. Example of Feature Slideshow
2. Admin area

== Changelog ==

= 1.0.8 =

* Preg_match error from 1.0.7-beta fixed

= 1.0.7 =

* Metaboxes added
* New option to change color of titles
* jQuery put in noconflict-mode
* Intervals is changed to milliseconds, rather than seconds

= 1.0.5 =

* Fixed jQuery conlict in adminpanel.

= 1.0.2 =

* Automatic cropping of images in the slideshow

* Option in adminpanel for setting transition interval

* <code>feature_slideshow_init();</code> bug fixed

= 1.0.1 =
* First release of the Feature Slideshow plugin.