<?php
	include "../librivox.class.php";
	
	$librivox = new librivox();
	$req = $_GET;	
	if(isset($req['f']) && $req['f'] == 'json'){
		$librivox->printHead(true);
	}else{
		$librivox->printHead();
	}
?>