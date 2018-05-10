php-playlist-generator
======================

Generate playlist files for audio streaming servers (i.e. Icecast or Shoutcast).

Formats supported:
- M3U
- PLS
- QuickTime (qtl)
- Windows Media Player (asx or wax)
- XML Shareable Playlist Format (XSPF)


## Web server configuration examples
### Nginx
Example rewrite within a location. This will allow /example-stream.mp3.m3u
to be translated to /playlist-generator/generate.php?stream=example-stream&format=m3u
```
   location ^~ / {
        rewrite ^/(\w+[-]\w+[-]\d+).(\w+).pls$ /playlist-generator/generate.php?stream=$1.$2&format=pls last;
        rewrite ^/(\w+[-]\w+[-]\d+).(\w+).m3u$ /playlist-generator/generate.php?stream=$1.$2&format=m3u last;
        rewrite ^/(\w+[-]\w+[-]\d+).(\w+).asx$ /playlist-generator/generate.php?stream=$1.$2&format=asx last;
        rewrite ^/(\w+[-]\w+[-]\d+).(\w+).xspf$ /playlist-generator/generate.php?stream=$1.$2&format=xspf last;
    }
```
