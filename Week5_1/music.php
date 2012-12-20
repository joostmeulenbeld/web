<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
 "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
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
		<?php
			function format_bytes($size) {
				$units = array(' B', ' KB', ' MB', ' GB', ' TB');
				for ($i = 0; $size >= 1024 && $i < 4; $i++) $size /= 1024;
				return round($size, 2)." ".$units[$i];
			}
			$playlistpaths = glob("songs/*.txt");
			if (isset($_REQUEST["playlist"]))
			{
				$mp3paths = file("songs/".$_REQUEST["playlist"]);
				for ($i = 0; $i < count($mp3paths); $i++)
				{
					$mp3paths[$i] = "songs/".$mp3paths[$i];
					echo $mp3paths[$i];
					echo filesize($mp3paths[$i]);
				}
			}
			else
			{
				$mp3paths = glob("songs/*.mp3");
			}
			
			
			if (isset($_REQUEST["shuffle"]) && $_REQUEST["shuffle"] = "on")
			{
				shuffle($mp3paths);
			}
		?>

		<div id="listarea">
			<ul id="musiclist">
				<?php
				foreach($mp3paths as $mp3path) { 	?>
					<li class="mp3item">
						<a href="<?= $mp3path ?>"><?= basename($mp3path) ?></a>
						
						<?php 
							echo "(".format_bytes(filesize($mp3path)).")";
						?>
						
					</li>
				<?php 
				} 
				?>
				
				<?php 
				if (!isset($_REQUEST["playlist"]))
				{
					foreach($playlistpaths as $playlistpath) { ?>
						<li class="playlistitem">
							<a href="<?= $playlistpath ?>"><?= basename($playlistpath) ?></a>
						</li>
					<?php }
				}
				?>

			</ul>
		</div>
	</body>
</html>
