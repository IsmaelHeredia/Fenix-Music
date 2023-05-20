<?php

namespace App\Functions;

class Util {

	function clearName($name) {
		$list = array("@","$","%","&","\\","/",":","*","?");
		foreach ($list as $string) {
			$name = str_replace($string,"",$name);
		}
		return $name;
	}
	
	function getInfoMP3($filename) {

		$datetime = date("Y-m-d H:i:s", filectime($filename));
	
		$getID3 = new \getID3;
		$information = $getID3->analyze($filename);
	
		$name = basename($filename, '.mp3');
	
		\getid3_lib::CopyTagsToComments($information);
	
		$title = "";
	
		if(isset($information['comments_html']['title'][0])) {
			$title = $information['comments_html']['title'][0];
		} else {
			$title = $name;
		}
	
		$artist = "";
	
		if(isset($information['comments_html']['artist'][0])) { 
			$artist = $information['comments_html']['artist'][0];
		} else {
			$artist = "Artist Unknown";
		}
	
		$album = "";
	
		if(isset($information['comments_html']['album'][0])) {
			$album = $information['comments_html']['album'][0];
		} else {
			$album = "Album Unknown";
		} 
	
		$year = "";
	
		if(isset($information['comments_html']['year'][0])) { 
			$year = $information['comments_html']['year'][0];
		} else {
			$year = "Year Unknown";
		}
	
		$genre = "";
	
		if(isset($information['comments_html']['genre'][0])) {
			$genre = $information['comments_html']['genre'][0];
		} else {
			$genre = "Genre Unknown";
		}
	
		$time = "";
	
		if(isset($information['playtime_string'])) {
			$time = $information['playtime_string'];
		} else {
			$time = "Time Unknown";
		}
	
		$image_data = "";
	
		if(isset($information['comments']['picture'][0]['data'])) {
			$image_data = $information['comments']['picture'][0];
		}
	
		$image_name = $this->clearName($artist) . " - " . $this->clearName($album) . ".jpg";
	
		return array($title,$artist,$album,$year,$genre,$time,$image_name,$image_data,$datetime);
	
	}
}