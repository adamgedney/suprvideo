<?php
//Name: get_videos
//Description: Gets all videos from the database
//Inputs: none required
//URL: localhost:8887/controllers/get_videos.php

	require '../models/model_video.php';
	$model = new Model_Video();


		//loads model to get all videos
		$result = $model->get_All_Videos();


		if($result){

			header('Content-type: application/json');
			echo json_encode(array('videos'=>$result));

		}else{

			header('Content-type: application/json');
			echo json_encode(array('error'=>"Get videos failed"));

		}