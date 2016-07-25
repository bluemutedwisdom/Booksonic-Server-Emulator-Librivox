<?php
	class librivox{
		
		function printHead(){
			print '<subsonic-response xmlns="http://subsonic.org/restapi" status="ok" version="1.14.0" librivox="'.$this->updateString().'">';
		}
		
		function getBook($id){
				return $this->parseBook($id, 'streams/');
		}
		
		function getBookFiles($id){
				return $this->parseBook($id, 'streams/', true);
		}
		
		function getCover($id){
			return $this->getBook($id)['cover'];
		}
		
		function updateString(){
			return "up_to_date_beta";
		}
		
		
		protected function parseBook($id, $savePath = "", $parseFiles = false){
			$data = array();
			
			$raw = file_get_contents("https://librivox.org/{$id}");
			$data['id'] = $id;
			$data['title'] = htmlspecialchars($this->get_between($raw, '<h1>', '</h1>'));
			$data['cover'] = $this->get_between($this->get_between($raw, '<div class="book-page-book-cover">', 'book-cover-large'), 'src="', '"');
			$data['desc'] = htmlspecialchars(strip_tags($this->get_between($raw, '<div class="description">', '</div>')));
			$data['reader'] = htmlspecialchars(strip_tags($this->get_between($this->get_between($raw, 'Read by', '<dt>'), '<dd>', '</dd>')));
			$data['created'] = htmlspecialchars(strip_tags($this->get_between($this->get_between($raw, 'Catalog date', '<dt>'), '<dd>', '</dd>')));
			$data['author']['id'] = $this->get_between($raw, "author/", '"');
			$data['author']['name'] = htmlspecialchars($this->get_between($raw, $data['author']['id'].'">', ' ('));
			
			if($parseFiles){
				$i = 0; 
				foreach($this->get_between_all($raw, '<tr>', '</tr>') as $part){
					if($i>0){
						$data['files'][$i]['url'] = $this->get_between_all($part, 'href="', '"')[1];
						
						if($savePath != ""){ $this->file_write("{$savePath}{$id}_{$i}.strm", $data['files'][$i]['url']); }
						
						$data['files'][$i]['id'] = "{$id}_{$i}";
						$data['files'][$i]['track'] = $i;
						$data['files'][$i]['name'] = htmlspecialchars($this->get_between($part, 'chapter-name">', '</a>'));
						$data['files'][$i]['duration'] = strtotime("1970-01-01 ".$this->get_between_all($part, '<td>', '</td>')[3]." UTC");
					}
					$i++; 
				}
			}
			return $data;
			
		}
		
		
		function parseSearch($query){
			$data = array();
			
			return $data;
		}
		
		
		protected function file_write($file, $data){
			$fh = fopen($file, 'w') or die("can't open file");
			fwrite($fh, $data);
			fclose($fh);		
		}
		
		protected function get_between($content, $before, $after){
			$temp = explode($before, $content);
			if (isset($temp[1])){
				$temp = explode($after, $temp[1]);
				return $temp[0];
			} else{
				return '';
			}
		}
		
		protected function get_between_all($content, $start, $end, $array = array()){
			$temp = explode($start, $content, 2);
			if(isset($temp[1])){
				$temp = explode($end, $temp[1], 2);
				$array[] = $temp[0];
				return $this->get_between_all($temp[1], $start, $end, $array);
			} else{
				return $array;
			}
		}
		
	}
?>