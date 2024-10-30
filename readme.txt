=== Last.fm Rotation ===
Contributors: dfederighi
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=7365126
Tags: last.fm,music,social 
Requires at least: 2.7
Tested up to: 2.7
Stable tag: 1.0

Last.fm Rotation will display the album covers for the records that you've played the most over the last week. 

== Description ==

Last.fm Rotation will display the covers for the albums you have had in heavy rotation over the last week. It uses 
the Last.fm API via AJAX to fetch the data and includes a functional (albeit crude) caching mechanism to improve 
performance. You can make sure Last.fm gets updated with music played from different sources by utilizing one of the many 
scrobbler plugins available. For example, I use Rhapsody for music streaming, and therefore decided to use Rhobbler 
to make sure that Last.fm has a complete profile on my listening habits. Please send feedback, enhancement requests, 
bug details or any questions about installation to dfederighi@yahoo.com

== Installation ==

1. Upload the folder `lastfm-rotation` to the `wp-content/plugins` directory.

   The main script should be at `/wp-content/plugins/lastfm-rotation/lastfm-rotation.php`.

2. Activate the plugin through the 'Plugins' menu in WordPress
3. Configure under Settings -> Last.fm Rotation 
4. If you want to use Last.fm Rotation in your sidebar (the recommended spot), simply add the following code 
   in your sidebar.php file
    <pre>
        &lt;?php wp_lastfm_rotation(); ?&gt;
    </pre>

   This function will generate an unordered list (UL) element in HTML. Here is a code snippet with how your 
   sidebar.php file should look. You can place the call to wp_lastfm_rotation inside sidebar directly, or you 
   can include this code inside of div element that includes a header element with a name (e.g. 'The Rotation').

   <pre>
   &lt;!--- Sidebar Starts --&gt;
   &lt;div id="sidebar"&gt;
        &lt;div&gt;
            &lt;h2&gt;&lt;?php _e('The Rotation'); ?&gt;&lt;/h2&gt;
            &lt;?php wp_lastfm_rotation(); ?&gt;
        &lt;/div&gt;
        &lt;br clear="all" /&gt;
   &lt;/div&gt;
   &lt;!--- Sidebar Ends --&gt;
   </pre> 

== Frequently Asked Questions ==

= What are the features of Last.fm Rotation =

- display the latest and most commonly played albums in your blog
- each cover, when moused over, will trigger the display of the Artist and Album Title
- each cover is linked to an Amazon search for that Album and/or Artist
- configurable display through Settings

= List of configurable options =

- Last.fm Username 
- Amazon Affiliate ID (optional)

== Screenshots ==

1. This screenshot shows the default display for the plugin

== Changelog ==
= 1.0 =
* Initial add/check-in
