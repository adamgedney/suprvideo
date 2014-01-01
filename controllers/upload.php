<?php
require 'models/model_video.php';
$model = new Model_Video();

//file upload controller
//moves files into an upload directory
//converts to necessary formats
//logs path in database

if(isset($_FILES['file'])){

	//strip spaces and & from string
	$string = str_replace(' ', '', $_FILES['file']);
	$string = str_replace('&', '', $string);

	$file = $string;
	$tempfile = $file["tmp_name"];
	$dir = "/var/www/uploads/".$file['name'];

	//grabs file from temp, saves to server
	$move = move_uploaded_file($tempfile,$dir);




	//ffmpeg format conversions and jpg ripping
	//
	//after file has uploaded, ffmpeg converts mp4 in uploads directory
	//to various formats, saving them in their proper directory.
	$filename = substr($file['name'], 0, -4);
	// $ffmpegPath = "/Users/adamgedney/ffmpeg/ffmpeg/ffmpeg";//local
	$ffmpegPath = "../../../ffmpeg/ffmpeg";//server
	// $ffmpeg2theoraPath = "/usr/local/bin/ffmpeg2theora";//local
	$ffmpeg2theoraPath = "../../../ffmpeg2theora/ffmpeg2theora";//server
	// $sitePath = "/Users/adamgedney/Documents/_Projects/Suprvideo/Code/Site/";//local
	$sitePath = "/var/www/";//server

	//ffmpeg shell scripts
	// $mp4_water = '/Users/adamgedney/ffmpeg/ffmpeg/ffmpeg -i /Users/adamgedney/Documents/_Projects/Suprvideo/Code/Site/' . $filename . '.mp4 -y /Users/adamgedney/Documents/_Projects/Suprvideo/Code/Site/images/logo.png -filter_complex overlay /Users/adamgedney/Documents/_Projects/Suprvideo/Code/Site/' . $filename . '.mp4 2>&1';
	$mp4_webm = $ffmpegPath . ' -i ' . $sitePath . 'uploads/' . $filename . '.mp4  -vcodec libvpx -acodec libvorbis  ' . $sitePath . 'uploads/' . $filename . '.WebM 2>&1';
	$mp4_mov = $ffmpegPath . ' -i ' . $sitePath . 'uploads/' . $filename . '.mp4 -acodec copy -vcodec copy -f mov ' . $sitePath . 'uploads/' . $filename . '.mov 2>&1';
	$mp4_ogv = $ffmpeg2theoraPath . ' ' . $sitePath . 'uploads/' . $filename . '.mp4';
	$mp4_flv = $ffmpegPath . ' -i ' . $sitePath . 'uploads/' . $filename . '.mp4 -ar 44100 -ab 96 -f flv ' . $sitePath . 'uploads/' . $filename . '.flv 2>&1';
	$mp4_mp3 = $ffmpegPath . ' -i ' . $sitePath . 'uploads/' . $filename . '.mp4 -vn -ar 44100 -ac 2 -ab 192 -f mp3 ' . $sitePath . 'uploads/' . $filename . '.mp3 2>&1';
	$mp4_jpgPoster = $ffmpegPath . ' -ss 00:00:02 -i ' . $sitePath . 'uploads/' . $filename . '.mp4 -frames:v 1 ' . $sitePath . 'uploads/poster/' . $filename . '.jpg 2>&1';
	$mp4_jpgShot1 = $ffmpegPath . ' -ss 00:00:03 -t 00:00:05 -i ' . $sitePath . 'uploads/' . $filename . '.mp4 -r 0.3 ' . $sitePath . 'uploads/shots/' . $filename . '1.jpg 2>&1';
	$mp4_jpgShot2 = $ffmpegPath . ' -ss 00:00:06 -t 00:00:09 -i ' . $sitePath . 'uploads/' . $filename . '.mp4 -r 0.3 ' . $sitePath . 'uploads/shots/' . $filename . '2.jpg 2>&1';
	$mp4_jpgShot3 = $ffmpegPath . ' -ss 00:00:10 -t 00:00:15 -i ' . $sitePath . 'uploads/' . $filename . '.mp4 -r 0.3 ' . $sitePath . 'uploads/shots/' . $filename . '3.jpg 2>&1';


	//file paths
	$webm = "uploads/". $filename . ".WebM";
	$mp4 = "uploads/". $filename . ".mp4";
	$mov = "uploads/". $filename . ".mov";
	$ogv = "uploads/". $filename . ".ogv";
	$flv = "uploads/". $filename . ".flv";
	$mp3 = "uploads/". $filename . ".mp3";
	$shot1 = "uploads/shots/". $filename . "1.jpg";
	$shot2 = "uploads/shots/". $filename . "2.jpg";
	$shot3 = "uploads/shots/". $filename . "3.jpg";
	$poster = "uploads/poster/". $filename . ".jpg";
	$title = $filename;



	if($move){
		//converts input mp4 to .mov and .ogv
		$first_process = shell_exec($mp4_webm);
		shell_exec($mp4_mov);
		shell_exec($mp4_ogv);
		shell_exec($mp4_flv);

		//strips mp3 track out of mp4
		shell_exec($mp4_mp3);

		//strips poster jpg from mp4
		shell_exec($mp4_jpgPoster);

		//creates screenshots from mp4 frames
		shell_exec($mp4_jpgShot1);
		shell_exec($mp4_jpgShot2);
		$last_process = shell_exec($mp4_jpgShot3);

		//adds video & still paths to database
		$model->add_Video($webm, $mp4, $mov, $ogv, $flv, $mp3, $shot1, $shot2, $shot3, $poster, $title);
		var_dump($first_process);
		//strips actions from URL by reloading site after complete conversions
		// if($last_process){
		// 	// var_dump($last_process);
		// 	header('Location: /');
		// }else{
		// 	$e = "last_process failed";
		// 	$e .= $last_process;
		// 	echo $e;
		// }

	}else{
		$ee = "move failed";
		$ee .= $move;
		echo $ee;
	}// if $move






}//if isset