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








	function add_Video($name, $title){

		$db = new PDO("mysql:hostname=localhost;dbname=SuprVideo","root","root");

		$st = $db->prepare("INSERT INTO videos(video_path, title) VALUES('uploads/$name', '$title')");
		$st->execute(array(':name'=>$name, ':title'=>$title));

		$obj = $st->fetchAll();

		return $st;
	}








}		