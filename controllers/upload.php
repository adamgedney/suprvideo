<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

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

	// $sitePath = "/Users/adamgedney/Documents/_Projects/Suprvideo/Code/Site/";//local
	$sitePath = "/var/www/";//server

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
	$format = substr($file['name'], -4); //grabs uploaded video format

	// $ffmpegPath = "/Users/adamgedney/ffmpeg/ffmpeg/ffmpeg";//local
	$ffmpegPath = "ffmpeg";//server

	// $ffmpeg2theoraPath = "/usr/local/bin/ffmpeg2theora";//local
	$ffmpeg2theoraPath = "ffmpeg2theora";//server
	


	//ffmpeg shell scripts -acodec aac -strict -2
	$to_mp4 = $ffmpegPath . ' -i ' . $sitePath . 'uploads/' . $filename . $format . ' -acodec copy -vcodec copy -f mp4 ' . $sitePath . 'uploads/' . $filename . '.mp4 2>&1';
	$to_webm = $ffmpegPath . ' -i ' . $sitePath . 'uploads/' . $filename . $format . '  -vcodec libvpx -acodec libvorbis  ' . $sitePath . 'uploads/' . $filename . '.WebM 2>&1';
	$to_mov = $ffmpegPath . ' -i ' . $sitePath . 'uploads/' . $filename . $format . ' -acodec copy -vcodec copy -f mov ' . $sitePath . 'uploads/' . $filename . '.mov 2>&1';
	$to_ogv = $ffmpeg2theoraPath . ' ' . $sitePath . 'uploads/' . $filename . $format;
	$to_flv = $ffmpegPath . ' -i ' . $sitePath . 'uploads/' . $filename . $format . ' -ar 44100 -ab 96 -f flv ' . $sitePath . 'uploads/' . $filename . '.flv 2>&1';
	$to_mp3 = $ffmpegPath . ' -i ' . $sitePath . 'uploads/' . $filename . $format . ' -vn -ar 44100 -ac 2 -ab 192 -f mp3 ' . $sitePath . 'uploads/' . $filename . '.mp3 2>&1';

	$to_jpgPoster = $ffmpegPath . ' -ss 00:00:02 -t 00:00:07 -i ' . $sitePath . 'uploads/' . $filename . $format . ' -r 0.3 ' . $sitePath . 'uploads/shots/' . $filename . '.jpg 2>&1';
	$to_jpgShot1 = $ffmpegPath . ' -ss 00:00:03 -t 00:00:05 -i ' . $sitePath . 'uploads/' . $filename . $format . ' -r 0.3 ' . $sitePath . 'uploads/shots/' . $filename . '1.jpg 2>&1';
	$to_jpgShot2 = $ffmpegPath . ' -ss 00:00:06 -t 00:00:09 -i ' . $sitePath . 'uploads/' . $filename . $format . ' -r 0.3 ' . $sitePath . 'uploads/shots/' . $filename . '2.jpg 2>&1';
	$to_jpgShot3 = $ffmpegPath . ' -ss 00:00:10 -t 00:00:15 -i ' . $sitePath . 'uploads/' . $filename . $format . ' -r 0.3 ' . $sitePath . 'uploads/shots/' . $filename . '3.jpg 2>&1';


	//file paths ..
	$webm = "uploads/". $filename . ".WebM";
	$mp4 = "uploads/". $filename . ".mp4";
	$mov = "uploads/". $filename . ".mov";
	$ogv = "uploads/". $filename . ".ogv";
	$flv = "uploads/". $filename . ".flv";
	$mp3 = "uploads/". $filename . ".mp3";
	$shot1 = "uploads/shots/". $filename . "1.jpg";
	$shot2 = "uploads/shots/". $filename . "2.jpg";
	$shot3 = "uploads/shots/". $filename . "3.jpg";
	$poster = "uploads/shots/". $filename . ".jpg";
	$title = $filename;



	if($move){
		//converts input mp4 to .mov and .ogv
		shell_exec($to_mp4);
		shell_exec($to_webm);
		shell_exec($to_mov);
		shell_exec($to_ogv);
		shell_exec($to_flv);

		//strips mp3 track out of mp4
		shell_exec($to_mp3);

		//strips poster jpg from mp4
		shell_exec($to_jpgPoster);

		//creates screenshots from mp4 frames
		shell_exec($to_jpgShot1);
		shell_exec($to_jpgShot2);
		$last_process = shell_exec($to_jpgShot3);

		//adds video & still paths to database
		$model->add_Video($webm, $mp4, $mov, $ogv, $flv, $mp3, $shot1, $shot2, $shot3, $poster, $title);
		
		// strips actions from URL by reloading site after complete conversions
		if($last_process){
			
			header('Location: /');
		}else{
			$e = "last_process failed";
			$e .= $last_process;
			echo $e;
		}

	}else{
		$ee = "move failed";
		$ee .= $move;
		echo $ee;
	}// if $move






}//if isset