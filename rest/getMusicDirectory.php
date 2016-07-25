<?php
	//error_reporting(0);
	include "../librivox.class.php";
	
	$librivox = new librivox();
	$librivox->printHead();
	$req = $_GET;	
?>
<?php
	
	$book = $librivox->getBookFiles($req['id']);
	
?> 
	<directory id="<?php echo $book['id']; ?>" parent="<?php echo $book['author']['id']; ?>" name="<?php echo $book['title']; ?>" userRating="0" averageRating="0" playCount="0"> 
		<?php 
			$i = 0; 
			foreach($book['files'] as $file){
				if($i>0){
					if($i>1){ echo "\t\t"; }
					echo "<child id=\"{$file['id']}\" parent=\"{$book['author']['id']}\" isDir=\"false\" title=\"{$file['name']}\" album=\"{$book['title']}\" artist=\"{$book['author']['name']}\" track=\"{$file['track']}\" coverArt=\"{$book['id']}\" size=\"0\" contentType=\"audio/mpeg\" suffix=\"mp3\" duration=\"{$file['duration']}\" bitRate=\"\" path=\"\" isVideo=\"false\" playCount=\"0\" created=\"{$book['created']}T01:00:00.000Z\" albumId=\"{$book['id']}\" artistId=\"{$book['author']['id']}\" type=\"music\" />\n";
				}
				$i++; 
			}
		 ?>
	</directory> 
</subsonic-response>