<?php

Class Model_Video{





	public function get_All_Videos(){

		$db = new PDO("mysql:hostname=localhost;dbname=SuprVideo","root","root");
		// $db = new PDO("mysql:hostname=localhost;dbname=SuprVideo","root","bhangra1");


		$st = $db->prepare("SELECT * FROM videos");
		$st->execute();

		$obj = $st->fetchAll();

		return $obj;
	}








	public function get_Video($vid_id){

		$db = new PDO("mysql:hostname=localhost;dbname=SuprVideo","root","root");
		// $db = new PDO("mysql:hostname=localhost;dbname=SuprVideo","root","SERVER PASSWORD HERE");


		$st = $db->prepare("SELECT * FROM videos WHERE id = :vid_id");
		$st->execute(array(":vid_id"=>$vid_id));

		$obj = $st->fetchAll();

		return $obj;
	}








	function add_Video($webm, $mp4, $mov, $ogv, $flv, $mp3, $shot1, $shot2, $shot3, $poster, $title){

		$db = new PDO("mysql:hostname=localhost;dbname=SuprVideo","root","root");
		// $db = new PDO("mysql:hostname=localhost;dbname=SuprVideo","root","SERVER PASSWORD HERE");


		$st = $db->prepare("INSERT INTO videos(webm, mp4, mov, ogv, flv, mp3, shot_1, shot_2, shot_3, poster, title) VALUES('$webm', '$mp4', '$mov', '$ogv', '$flv', '$mp3', '$shot1', '$shot2', '$shot3', '$poster', '$title')");
		$st->execute();

		$obj = $st->fetchAll();

		return $st;
	}








}		