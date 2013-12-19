<?php 
	if(isset($_GET['action'])){
		if(file_exists('controllers/' . $_GET['action'] . '.php')){
			require 'controllers/' . $_GET['action'] . '.php';
		}
}?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Suprvideo</title>
	<meta charset="utf-8" />
	<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" /> -->

	<link type="text/plain" rel="author" href="/humans.txt" />
	<link rel="shortcut icon" href="http://adamshields.com/favicon.ico" />
	<link rel="stylesheet" href="css/main.css" />



</head>
	<body>	

		<div id="bg-container">
			<video id="video" poster="">
				
			</video>
		</div><!-- /#bg-container-->
		
		<!-- loading gif-->
		<div id="loading">
			<img src="images/loading.gif" alt="loading gif">
			<p>Your file is being converted. Please be patient. Do not hit the back button, or refresh this page. The world will explode!</p>
		</div><!-- /#loading-->

		<!-- upload modal button-->	
		<a href="#" id="vid-button" title="Convert your .mp4 to .webm, .mov, .flv, .ogv, .mp3"/>+ Add Video</a>
		
		<div id="site-container">
		</div><!-- /#site-container-->


		<!-- Scripts -->
		<script src="js/jquery-1.10.2.min.js"></script>
		<script src="js/handlebars-v1.1.2.js"></script>
		<script src="js/lightbox-2.6.min.js"></script>
		<script src="js/main.js"></script>

	</body>
</html>
