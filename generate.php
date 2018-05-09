<?php
/*
 * Playlist generator
 *
 * Generates a playlist for defined Icecast servers, using URL paramaters.
 * Example: generate.php?stream=example-stream.mp3&format=m3u
 *
 * @version 2018-05-09
 * @author François LASSERRE <choiz@me.com>
 * @author Matt Ribbins <mribbins@celador.co.uk>
 * @license GNU GPL {@link http://www.gnu.org/licenses/gpl.html}
 */

require 'station.php';
require 'playlist.php';

// Retrieve URL GET variables
if(isset($_GET['stream'])) $stream = $_GET['stream'];
if(isset($_GET['format'])) $format = $_GET['format'];
if(!isset($stream)) return false;

// Add the station by stream name
$station = new Station($stream);
// Define the stream servers
$station->addServer('http://streamserver1.example:8000');
$station->addServer('http://streamserver2.example:8000');
// Retrieve stream name and description from the Icecast server
$station->retrieveMetaData();


// Display the playlist in the format we define. Default to m3u.
if(isset($format)) {
  $playlist = new Playlist($station, $format);
} else {
  // Default M3U
  $playlist = new Playlist($station, 'm3u');
}

// Generate the file!
$playlist->generate();
