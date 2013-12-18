<?php

Class Model_Video{





	public function get_All_Videos(){

		$db = new PDO("mysql:hostname=localhost;dbname=SuprVideo","root","root");

		$st = $db->prepare("SELECT * FROM videos");
		$st->execute();

		$obj = $st->fetchAll();

		return $obj;
	}








	public function get_Video($vid_id){

		$db = new PDO("mysql:hostname=localhost;dbname=SuprVideo","root","root");

		$st = $db->prepare("SELECT * FROM videos WHERE id = :vid_id");
		$st->execute(array(":vid_id"=>$vid_id));

		$obj = $st->fetchAll();

		return $obj;
	}








	function add_Video($mp4, $mov, $ogv, $mp3, $shot1, $shot2, $shot3, $poster, $title){

		$db = new PDO("mysql:hostname=localhost;dbname=SuprVideo","root","root");

		$st = $db->prepare("INSERT INTO videos(mp4, mov, ogv, mp3, shot_1, shot_2, shot_3, poster, title) VALUES('$mp4', '$mov', '$ogv', '$mp3', '$shot1', '$shot2', '$shot3', '$poster', '$title')");
		$st->execute();

		$obj = $st->fetchAll();

		return $st;
	}








}		