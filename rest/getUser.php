<?php
	include "../librivox.class.php";
	
	$librivox = new librivox();
	$librivox->printHead();
	$req = $_GET;	
?>
	<user username="Librivox" scrobblingEnabled="false" adminRole="false" settingsRole="false" downloadRole="false" uploadRole="false" playlistRole="false" coverArtRole="false" commentRole="false" podcastRole="false" streamRole="true" jukeboxRole="false" shareRole="false" videoConversionRole="false"> 
		<folder>0</folder> 
	</user> 
</subsonic-response>