<?php
/*
Plugin Name: Last.fm Rotation
Version: 1.0
Description: Uses the Last.fm API to fetch details on the albums you have in heavy rotation.  
Author: Dale Federighi
Author URI: http://www.federighi.net
*/

/*
Copyright 2009 Dale Federighi  (http://www.federighi.net)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

function wp_lastfm_rotation() {

    $lfmr_id = (get_option('wp_lastfm_id')) ? get_option('wp_lastfm_id') : 'dfederighi';
    $amzn_id = (get_option('wp_lastfm_amzn_id')) ? get_option('wp_lastfm_amzn_id') : 'fn03-20';

echo <<<E_O_HTML
	<link rel="stylesheet" type="text/css" href="/wp-content/plugins/lastfm-rotation/css/rotation.css"/>
	<script src="http://yui.yahooapis.com/combo?2.7.0/build/yuiloader-dom-event/yuiloader-dom-event.js&2.7.0/build/connection/connection-min.js"></script>
	<script src="/wp-content/plugins/lastfm-rotation/js/rotation.js"></script>
    <script>
        lfmr_conf.lastfm_id = "{$lfmr_id}";
        lfmr_conf.amazon_id = "{$amzn_id}";
    </script>
E_O_HTML;

echo <<<E_O_HTML
    <ul id='the_rotation'></ul>
E_O_HTML;

}

function wp_lastfm_admin_page() {
	if(isset($_POST['submitted'])){
        	$id = isset($_POST['lastfm_id']) ? $_POST['lastfm_id'] : '';
        	$amzn_id = isset($_POST['lastfm_amznid']) ? $_POST['lastfm_amznid'] : 'fn03-20';

        	update_option("wp_lastfm_id", $id);
            update_option("wp_lastfm_amzn_id", $amzn_id);
		    echo '<p style="padding:2px;width:90%;border:1px solid #000;background-color:#ccc;font-weight:bold">';
            echo 'Last.fm Rotation Plugin Updated.</p>';
    }
    $lastfm_id = ((get_option('wp_lastfm_id') != '') ? get_option('wp_lastfm_id') : '');
	echo <<<E_O_HTML
    	<h2>Last.fm Rotation Plugin Configuration</h2>
	    <br />
    	<form method="post" name="options" target="_self">
		<div style="font-weight:bold">Last.fm Username <span style="color:red">(required)</span></div>
        <input type="text" name="lastfm_id" value="${lastfm_id}"/><br />
        <br />
        <div style="font-weight:bold">Amazon Affiliate ID <span style="color:#666;">(optional)</span></div>
        <input type="text" name="lastfm_amznid" value="" /><br />
        <br />
		<input type="hidden" name="submitted" value="true" />
		<input type="submit" value="Update" />
        <br />
	</form>
E_O_HTML;
}

function wp_lastfm_add_to_menu() {
    add_submenu_page('options-general.php', 'Last.fm Rotation', 'Last.fm Rotation', 10, __FILE__, 'wp_lastfm_admin_page');
}

add_action('admin_menu', 'wp_lastfm_add_to_menu');

?>
