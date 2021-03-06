<?php


$path = "../uploads";
$dir = scandir($path);

 $video = array();
 $audio = array();

//adds each file to an array for function return
//only if it's of a specific video format or an mp3
foreach($dir as $file){
	//filters directory of non image files
	if(($file!='..') && ($file!='.') && ($file!='.DS_Store')){
		
		if((strpos($file,'.mp4') !== false) || (strpos($file,'.mov') !== false) || (strpos($file,'.ogv') !== false) || (strpos($file,'.flv') !== false) || (strpos($file,'.WebM') !== false)){
			array_push($video, $file);

		}else if(strpos($file,'.mp3') !== false){
			array_push($audio, $file);
		}
	}
}

if($video || $audio){

	header('Content-type: application/json');
	echo json_encode(array('video'=>$video, 'audio'=>$audio));

}else{

	header('Content-type: application/json');
	echo json_encode(array('error'=>"Get files failed"));

}