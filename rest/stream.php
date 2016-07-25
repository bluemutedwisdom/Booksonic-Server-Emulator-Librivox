<?php
	
	function file_read($file){
		$fh = fopen($file, 'r');
		$data = fread($fh, filesize($file));
		fclose($fh);
		return $data;	
	}
	
	$url = file_get_contents("streams/{$_GET['id']}.strm");
	
	header("Location: {$url}");
?>