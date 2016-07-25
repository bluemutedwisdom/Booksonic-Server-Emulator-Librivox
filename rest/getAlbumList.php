<?php

	$json = json_decode(file_get_contents('https://librivox.org/api/feed/audiobooks/?format=json&offset='.$_GET['offset'].'&limit=20'), true);
	
	//echo count($json['books']);

?><subsonic-response xmlns="http://subsonic.org/restapi" status="ok" version="1.14.0" librivox="up_to_date_beta"> 
	<albumList> 
<?php $i = 0; foreach($json['books'] as $book){
	if($i > 0) { echo "\n"; }
	
	$id = $book['id'];
	$title = htmlspecialchars($book['title']);
	$year = $book['copyright_year'];
	$author['id'] = $book['authors'][0]['id'];
	$author['name'] = trim(htmlspecialchars($book['authors'][0]['first_name'])." ".htmlspecialchars($book['authors'][0]['last_name']));
	
	echo "\t\t<album id=\"{$id}\" parent=\"{$author['id']}\" isDir=\"true\" title=\"{$title}\" album=\"{$title}\" artist=\"{$author['name']}\" year=\"{$year}\" coverArt=\"{$id}\" playCount=\"0\" created=\"2000-01-01T01:00:00.000Z\" />"; 
	$i++;
} ?>

	</albumList> 
</subsonic-response>