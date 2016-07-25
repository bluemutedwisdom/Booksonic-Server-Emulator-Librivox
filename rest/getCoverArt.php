<?php
	include "../librivox.class.php";
	
	$librivox = new librivox();
	$librivox->printHead();
	$req = $_GET;	
?>
<?php
	
	$cover = $librivox->getCover($req['id']);
	header("Location: {$cover}");
?>