/*
 * Copyright (c) 2009 Aitor Guevara Escalante
 *
 * Permission is hereby granted, free of charge, to any person obtaining
 * a copy of this software and associated documentation files (the
 * "Software"), to deal in the Software without restriction, including
 * without limitation the rights to use, copy, modify, merge, publish,
 * distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to
 * the following conditions:
 *
 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
 * LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
 * OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
 * WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 *
 */

(function(){var a,b,c;a=("undefined"!=typeof window&&null!==window?window.DOMParser:void 0)||("function"==typeof require?require("xmldom").DOMParser:void 0)||function(){},b=function(a,c){var d,e,f,g,h,i,j,k,l,m,n;if(a.hasChildNodes())for(g=a.childNodes,h=k=0,m=g.length;m>=0?m>k:k>m;h=m>=0?++k:--k)if(e=g[h],f=e.nodeName,/REF/i.test(f)){for(d=e.attributes,j=l=0,n=d.length;n>=0?n>l:l>n;j=n>=0?++l:--l)if(i=d[j].nodeName.match(/HREF/i)){c.push({file:e.getAttribute(i[0]).trim()});break}}else"#text"!==f&&b(e,c);return null},c=function(c){var d,e;return e=[],(d=(new a).parseFromString(c,"text/xml").documentElement)?(b(d,e),e):e},("undefined"!=typeof module&&null!==module?module.exports:window).ASX={name:"asx",parse:c}}).call(this),function(){var a,b,c,d,e,f,g;b="#EXTM3U",a=/:(?:(-?\d+),(.+)\s*-\s*(.+)|(.+))\n(.+)/,e=function(b){var c;return c=b.match(a),c&&6===c.length?{length:c[1]||0,artist:c[2]||"",title:c[4]||c[3],file:c[5].trim()}:void 0},g=function(a){return{file:a.trim()}},d=function(a){return!!a.trim().length},c=function(a){return"#"!==a[0]},f=function(a){var f;return a=a.replace(/\r/g,""),f=a.search("\n"),a.substr(0,f)===b?a.substr(f).split("\n#").filter(d).map(e):a.split("\n").filter(d).filter(c).map(g)},("undefined"!=typeof module&&null!==module?module.exports:window).M3U={name:"m3u",parse:f}}.call(this),function(){var a,b;a=/(file|title|length)(\d+)=(.+)\r?/i,b=function(b){var c,d,e,f,g,h,i,j,k,l;for(g=[],l=b.trim().split("\n"),j=0,k=l.length;k>j;j++)e=l[j],f=e.match(a),f&&4===f.length&&(i=f[0],d=f[1],c=f[2],h=f[3],g[c]||(g[c]={}),g[c][d.toLowerCase()]=h);return g.filter(function(a){return null!=a})},("undefined"!=typeof module&&null!==module?module.exports:window).PLS={name:"pls",parse:b}}.call(this);

(function($) {

    $.parserM3U = function(list) {
        this.parse = function() {
            //TODO: in some cases an empty string is matched, why?
            m = list.match(/^(?!#)(?!\s).*$/mg);
            urls = $.grep(m, function(n, i) {
                return (n != '');
            });
            var playlist = M3U.parse(list);
            return playlist;
        }
    };

    $.playlistOptions = {
        proxy: null,
        parsers: {
            m3u: $.parserM3U
        },
        navArrowsPath: ''
    };

    var fileExtension = function(url) {
        m = url.match(/\w*?(?=#)|\w*?(?=\?)|\w*$/);
        return m[0];
    }
	/*
    var createNavArrows = function(player) {
        var ids = ['left', 'right'];
        var arrows = new Array();
        for (i in ids) {
            var arrow = new Image();
            var pos = ids[i];
            var src = '../images/' + pos + '.png';
            console.log(src);
            var id = 'playlist_arrow_' + pos;
            $(arrow).attr('src', src);
            $(arrow).attr('id', id);
            $(arrow).hide();
            $('body').append($(arrow));
            arrows.push($(arrow));
        }
        return arrows;
    }

    var positionNavArrow = function(arrow, pos, player) {
        //In Webkit browsers the positioning fails if no height and
        //width have been set for the player.
        var atop = (player.height() / 2) + (player.position().top) - (arrow.height() / 2);
        console.log(player.position().left)
        console.log(player.width())
        if (pos == 'left') {
            var aleft = player.position().left - arrow.width() + 30;
        } else {
            var aleft = player.position().left + player.width() - 30;
        }
        arrow.css('position', 'absolute');
        arrow.css('top', atop);
        arrow.css('left', aleft);
        
    }

    var disableNavArrow = function(arrow) {
        arrow.hide()
        arrow.css('visibility', 'hidden');
    }

    var enableNavArrow = function(arrow) {
        arrow.css('visibility', 'visible');
        arrow.show();
    }*/

    $.fn.playlistParser = function(settings) {

        $.extend($.playlistOptions, settings);

        var plExtensions = new Array();
        for (ext in $.playlistOptions.parsers) {
            plExtensions.push(ext);
        }

        return this.each(function() {
            var player = this;
            var src = player.currentSrc;
            var extension = fileExtension(src);
            var playlist = new Array();
            var current = -1;
            var leftArrow = null;
            var rightArrow = null;

            if ($.inArray(extension, plExtensions) < 0) return;

            var playFollowing = function(reverse) {
                if (reverse) {
                    current--;
                } else {
                    current++;
                }
				if (current == 0) {
					$('#playlist_arrow_left').css('visibility', 'hidden');
				} else {
					$('#playlist_arrow_left').css('visibility', 'visible');
				}
				if (current == playlist.length - 1) {
					$('#playlist_arrow_right').css('visibility', 'hidden');
				} else {
					$('#playlist_arrow_right').css('visibility', 'visible');
				}
                var nextUrl = playlist[current].file;
                console.log(playlist[current].artist);
                $('#podcast-name').text(playlist[current].artist);
                $('#podcast-title').text(playlist[current].title);
                player.src = nextUrl;
                player.load();
            }
			$(window).on('load', function() {
				$('#playlist_arrow_right').bind('click', function(e) {
					playFollowing();
				});
				$('#playlist_arrow_left').bind('click', function(e) {
					playFollowing(true);
				});
			});


            if ($.playlistOptions.proxy) {
                ajax_url = $.playlistOptions.proxy;
                ajax_options = {url: src};
            } else {
                ajax_url = src;
                ajax_options = null;
            }

            $.get(ajax_url, ajax_options, function(data) {
                var parser = new $.playlistOptions.parsers[extension](data);
                playlist = parser.parse();
                // Playlist emulation, each time a file has ended playing
                // let's play the next one in the list.
                if (playlist.length > 0) {
                    $(player).bind('ended', function(e) {
                        playFollowing();
                    });
                }
                playFollowing();
            });

        });
    };

})(jQuery);

jQuery(document).ready(function() {
	jQuery('audio').playlistParser();
	var xhr = new XMLHttpRequest();
	xhr.open("GET", "https://www.atareao.es/podcasts.m3u");
	xhr.overrideMimeType("audio/x-mpegurl"); // Needed, see below.
	xhr.onload = parse;
	xhr.send();
});

// Parse it
function parse () {
  var playlist = M3U.parse(this.response);
  //var audio = new Audio();
  playlist.forEach(function(podcast, index) {
  console.log(podcast);
  console.log(podcast.title);
});
};
