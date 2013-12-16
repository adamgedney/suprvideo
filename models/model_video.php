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






	// public $sql;
	// public $db;

	// public function __construct(){
	// 	// mongo as a class level variable is now
	// 	//actually a property, therefore no $
	// 	$this->sql = new Mongo();

	// 	// //database connection to mongo
	// 	$this->db = $this->mongo->selectDb('blog')->selectCollection('posts');
	// }

	


	// public function newPost($id,$author,$title,$text,$category){


	// 	$datetime = new DateTime('NOW');
	// 	// $datetime = new DateTimeZone('Eastern');
	// 	$datetime = date("m/d/y g:i a"); 
				
	// 	$obj = array(
	// 		'_id'=>$id, 
	// 		'author'=>$author, 
	// 		'title'=>$title, 
	// 		'text'=>$text, 
	// 		'category'=>$category, 
	// 		'created'=>$datetime,
	// 		'comments'=>array()
	// 	);

	// 	$this->blog->save($obj);
	// }




	// public function updatePost($id,$author,$title,$text,$category){

	// 	ini_set('mongo.cmd', ':');

	// 	$updated = new DateTime('NOW');
	// 	// $updated = new DateTimeZone('Eastern');
	// 	$updated = date("m/d/y g:i a");

	// 	$obj = array( 
	// 		'author'=>$author, 
	// 		'title'=>$title, 
	// 		'text'=>$text, 
	// 		'category'=>$category, 
	// 		'updated'=>$updated
	// 	);

	// 	$this->blog->update(array('_id'=>$id), array(':set'=>$obj));

	// }




	// public function getPost($id){
	// 	$result = $this->blog->findOne(array('_id' => $id));
	// 	return $result;
	// }




	// public function getPosts(){
	// 	$result = $this->blog->find()->sort(array('created' => -1));
	// 	return $result;
	// 	// return iterator_to_array($result);
	// }




	// public function newComment($id,$author,$text){

	// 	ini_set('mongo.cmd', ':');

	// 	$createddate = new DateTime('NOW');
	// 	// $datetime = new DateTimeZone('Eastern');
	// 	$createddate = date("m/d/y g:i a"); 
				
	// 	$obj = array(
	// 			'author'=>$author,
	// 			'created'=>$createddate,
	// 			'text'=>$text
	// 	);

	// 	$this->blog->update(array('_id'=>$id), array(':push'=>array('comments'=>$obj)));

	// }


}// /class	
			