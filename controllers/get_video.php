<?php
//Name: get_video
//Description: Gets single video from the database
//Inputs: vid_id
//URL: localhost:8887/controllers/get_video.php

	require '../models/model_video.php';
	$model = new Model_Video();


		$vid_id = $_GET['vid_id'];


		//loads model to get video
		$result = $model->get_Video($vid_id);


		if($result){

			header('Content-type: application/json');
			echo json_encode(array('video'=>$result));

		}else{

			header('Content-type: application/json');
			echo json_encode(array('error'=>"Get video failed"));

		}