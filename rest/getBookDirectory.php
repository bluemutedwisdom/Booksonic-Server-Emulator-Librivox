<?php
	include "../librivox.class.php";
	
	$librivox = new librivox();
	$req = $_GET;	
	
	$book = $librivox->getBook($req['id']);
	
	$response = array(
		'subsonic-response' => array(
			'status' => 'ok',
			'version' =>'1.14.0',
			'librivox' => $librivox->updateString(),
			'directory' => array(
				'id' => $book['id'],
				'parent' => $book['author']['id'],
				'name' => $book['title'],
				'description' => $book['desc'],
				'reader' => $book['reader']
			)		
		)
	);
		
	echo json_encode($response);
?>