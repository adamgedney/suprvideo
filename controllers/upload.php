<?php
require 'models/model_video.php';


$model = new Model_Video();

//file upload controller
//moves files into an upload directory
//logs path in database

if(isset($_FILES['file'])){


$file = $_FILES['file'];
	$tempfile = $file["tmp_name"];

	$dir = "uploads/".$file['name'];
	$move = move_uploaded_file($tempfile,$dir);

	//reenble this. Adds file to database
	// if($move){

	// 	$title = substr($file['name'], 0, -4);

	// 	//adds video entry to database
	// 	$model->add_Video($file['name'], $title);

	// }



//ffmpeg conversions & shell scripts  
// $flv_mp4 = '/Users/adamgedney/ffmpeg/ffmpeg/ffmpeg -i /Users/adamgedney/Documents/_Projects/Suprvideo/Code/Site/test.flv -ar 22050 /Users/adamgedney/Documents/_Projects/Suprvideo/Code/Site/test.mp4 2>&1';
// $mp4_mp3 = '/Users/adamgedney/ffmpeg/ffmpeg/ffmpeg -i /Users/adamgedney/Documents/_Projects/Suprvideo/Code/Site/test.mp4 -vn -ar 44100 -ac 2 -ab 192 -f mp3 /Users/adamgedney/Documents/_Projects/Suprvideo/Code/Site/test.mp3 2>&1';
// $mp4_mov = '/Users/adamgedney/ffmpeg/ffmpeg/ffmpeg -i /Users/adamgedney/Documents/_Projects/Suprvideo/Code/Site/test.mp4 -acodec copy -vcodec copy -f mov /Users/adamgedney/Documents/_Projects/Suprvideo/Code/Site/test.mov 2>&1';
// $mp4_ogv = '/usr/local/bin/ffmpeg2theora /Users/adamgedney/Documents/_Projects/Suprvideo/Code/Site/test.mp4';

$filename = substr($file['name'], 0, -4);
$mp4_jpgPoster = '/Users/adamgedney/ffmpeg/ffmpeg/ffmpeg -ss 00:00:02 -i /Users/adamgedney/Documents/_Projects/Suprvideo/Code/Site/test.mp4 -frames:v 1 /Users/adamgedney/Documents/_Projects/Suprvideo/Code/Site/uploads/poster/' . $filename . '%1d.jpg 2>&1';
$mp4_jpgShot1 = '/Users/adamgedney/ffmpeg/ffmpeg/ffmpeg -ss 00:00:02 -t 00:00:10 -i /Users/adamgedney/Documents/_Projects/Suprvideo/Code/Site/test.mp4 -r 0.3 /Users/adamgedney/Documents/_Projects/Suprvideo/Code/Site/uploads/shots/' . $filename . '1.jpg 2>&1';
$mp4_jpgShot2 = '/Users/adamgedney/ffmpeg/ffmpeg/ffmpeg -ss 00:00:13 -t 00:00:19 -i /Users/adamgedney/Documents/_Projects/Suprvideo/Code/Site/test.mp4 -r 0.3 /Users/adamgedney/Documents/_Projects/Suprvideo/Code/Site/uploads/shots/' . $filename . '2.jpg 2>&1';
$mp4_jpgShot3 = '/Users/adamgedney/ffmpeg/ffmpeg/ffmpeg -ss 00:00:21 -t 00:00:28 -i /Users/adamgedney/Documents/_Projects/Suprvideo/Code/Site/test.mp4 -r 0.3 /Users/adamgedney/Documents/_Projects/Suprvideo/Code/Site/uploads/shots/' . $filename . '3.jpg 2>&1';


$out = shell_exec($mp4_jpgShot3);
var_dump($out);




	// $file = file_get_contents ('http://www.youtube.com/embed/XI-vXdeWs3Q');
	
	
	// var_dump($file);











	
}