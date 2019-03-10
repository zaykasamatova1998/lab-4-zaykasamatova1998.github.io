<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Music Viewer</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <link href="viewer.css" type="text/css" rel="stylesheet" />
</head>
<body>
  <div id="header">
	<h1>190M Music Playlist Viewer</h1>
	<h2>Search Through Your Playlists and Music</h2>
  </div>

  <div id="listarea">
    <ul id="musiclist">
	  <?php
		function displaySongs(){
		  if(!isset($_REQUEST['playlist'])){
		  	$musicFolder = glob("songs/*.mp3");
		  	$valid = false;
		  }
		  else{
			$musicFolder = file('songs/' . $_REQUEST['playlist'], FILE_IGNORE_NEW_LINES);
			$valid = true;
		  }
		foreach ($musicFolder as $mp3) { 
		  if (!$valid) {
			  $size = filesize($mp3);
			  if ($size > 0 && $size < 1024){
			  	$size = $size . " b";
			  }
			  elseif ($size > 1024 && $size < 1048575){
			  	$size = round($size / 1024, 2) . " kb";
			  }
			  elseif ($size > 1048575){
			  	$size = round($size / 1048575, 2) . " mb";
			  }
			    if (!in_array($mp3,array(".",".."))){ 
			  ?>
			  <li class="mp3item"><a href="songs/<?= basename($mp3) ?>">
			  	<?= basename($mp3) . " (" . $size . " )" ; ?></a></li>
			  <?php
			  }
			}
			else{
				$size = filesize("songs/".$mp3);
			  if ($size > 0 && $size < 1024){
			  	$size = $size . " b";
			  }
			  elseif ($size > 1024 && $size < 1048575){
			  	$size = round($size / 1024, 2) . " kb";
			  }
			  elseif ($size > 1048575){
			  	$size = round($size / 1048575, 2) . " mb";
			  }
			    if (!in_array($mp3,array(".",".."))){ 
			  ?>
			  <li class="mp3item"><a href="songs/<?= basename($mp3) ?>">
			  	<?= basename($mp3) . " (" . $size . " )" ; ?></a></li>
			  	<?php
			  }
			}
		  }
	    }
	  ?>
	  <?php
		function displayPlaylist(){
		  $playlistFolder = "songs/*.txt";
		  foreach (glob($playlistFolder) as $txt) { 
		    if (!in_array($txt,array(".",".."))){ 
		  ?>
		  <li class="mp3item"><a href="music.php?playlist=<?= basename($txt) ?>">
		  	<?= basename($txt); ?> </a></li>
		  <?php
			}
		  }
	    }
	  ?>
	  <?php 
	  	displaySongs();
	  	if(!isset($_REQUEST['playlist']))
	  		displayPlaylist();
	   ?>
	</ul>
  </div>
</body>
</html>