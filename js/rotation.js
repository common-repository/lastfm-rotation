/**
 * The core javascript for the plugin. Right now this only fetches the 
 * most popular albums, but in the future I'll include popular artists and 
 * possibly genres or friends
 * author: Dale Federighi <dfederighi@yahoo.com>
 */
(function() {

    lfmr_conf = {
        lastfm_id: '',
        amazon_id: ''
    };

    var albums_added = 0;

    var purl_script = '/wp-content/plugins/lastfm-rotation/lastfm-proxy.php';
    var lurl_prefix = 'http://ws.audioscrobbler.com/2.0/?api_key=7a398d085dbd2efe839019a32cf16db4&format=json';
    var aurl_prefix = 'http://www.amazon.com/gp/search?ie=UTF8&index=music';

    var getAlbumInfo = function(artist,album) {
        var gaUrl = lurl_prefix + '&method=album.getinfo&artist=' + artist + '&album=' + album;

	    var rotation_div = YAHOO.util.Dom.get('the_rotation');
	    var callback = {
		    success: function(o) {
			    var data = eval('(' + o.responseText + ')');
			    var a = data.album;
			    if(a && a.image[2]["#text"]) {
				    if(albums_added == 6) return;
				    albums_added++;
				    var c = document.createElement('img');
				    var li = document.createElement('li');
				    var lnk = document.createElement('a');
				    lnk.href = aurl_prefix + '&tag=' + lfmr_conf.amazon_id + 
                               '&keywords=' + a.artist + '%20' + a.name;
				    lnk.target = '_blank';
				    lnk.title = a.artist + ' :: ' + a.name;
				    c.src = a.image[2]["#text"];
				    lnk.appendChild(c);
				    li.appendChild(lnk);
				    rotation_div.appendChild(li);
			    }
		    },
		    failure: function(o) {}
	    }
        var purl = purl_script + '?aname=' + album + '&snode=' + escape(encodeURI(gaUrl));
	    YAHOO.util.Connect.asyncRequest('GET', purl, callback);
    };

    YAHOO.util.Event.onDOMReady(function() {
        var rotation_div = YAHOO.util.Dom.get('the_rotation');
        rotation_div.innerHTML = '<div align="center" style="margin-top:60px;">' + 
                                 '<img src="http://www.spuler.us/extensions/loading.gif">' + 
                                 '</div>';
        var gwacUrl = escape(lurl_prefix + '&method=user.getweeklyalbumchart&user=' + lfmr_conf.lastfm_id);

	    var callback = {
		    success: function(o) {
			    var data = eval('(' + o.responseText + ')');
                rotation_div.innerHTML = '';
                if(data.error) { 
                    /* Handle empty or invalid usernames */
                    rotation_div.innerHTML = '<p class="lfmr_error">' + data.message + '</div>'; 
                    return;
                }
			    var albums = data.weeklyalbumchart.album;
                var num_albums = (albums.length > 15 ? 15 : albums.length);
			    for(var idx=0; idx < num_albums; idx++) {
				    var album = albums[idx];
				    getAlbumInfo(album.artist["#text"], album.name);
			    }
		    },
		    failure: function(o) {} 
	    };
        var purl = purl_script + '?snode=' + gwacUrl;
	    YAHOO.util.Connect.asyncRequest('GET', purl, callback);
    });

})();
