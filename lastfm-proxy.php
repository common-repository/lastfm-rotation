<?php
    /**
     * Handles the requests for Album lists or individual album details
     * @todo Write some logic in to periodically clear out the cache
     */
	if(!is_dir('./cache')) { mkdir('./cache', 0700); }
	$content = '';
	if(!empty($_REQUEST['aname']) && file_exists('./cache/' . md5($_REQUEST['aname']))) { 
		$content = file_get_contents('./cache/' . md5($_REQUEST['aname']));
	} else {
		$content = @file_get_contents(html_entity_decode($_REQUEST['snode']));
		if(!empty($_REQUEST['aname'])) {
			file_put_contents('./cache/' . md5($_REQUEST['aname']), $content);	
		}
	}
	echo $content;
?>
