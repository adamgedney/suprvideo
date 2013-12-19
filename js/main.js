$(function(){



//-----------templating---------------
//This $.get closes just before namespace close at end of file
//acts as a window.onload for the rest of the program
$.get('/templates/template.html', function(htmlArg){

	
	//----loads site----
	var siteSource = $(htmlArg).find('#site').html();
	var siteTemplate = Handlebars.compile(siteSource);
	$('#site-container').append(siteTemplate);


	//initializes hide on all show/hide behaviors
	//once added to DOM
	$('.dl-list').hide();
	$('.desc').hide();
	$('.form-wrapper').hide();
	$('#upload-success').hide();
	$('#loading').hide();
	$('#seek-bar').val(0);


 









//********get and load all videos upon program init********
$.ajax({
	url: '/controllers/get_videos.php',
	type: 'get',
	dataType: 'json',
	success: function(response){

	var vids = response.videos

	//loops through screenshots to grab the first shot from each DB video
	//to be used as a THUMBNAIL CLIP for main navigation
	var lng = vids.length;
	for(var i=0; i < lng; i++){
		var img = '<img class= "video-thumb" id="' + vids[i].id +'" src="' + vids[i].shot_1 + '" alt="videos stored">';
		$('#slider').append(img);
	};





	//loads default video SHOTS to DOM
	var shots_init = '<a href="' + vids[0].shot_1 + '" data-lightbox="1"><img src="' + vids[0].shot_1 + '" alt="screenshot"/></a>';
		shots_init += '<a href="' + vids[0].shot_2 + '" data-lightbox="1"><img src="' + vids[0].shot_2 + '" alt="screenshot"/></a>';
		shots_init += '<a href="' + vids[0].shot_3 + '" data-lightbox="1"><img src="' + vids[0].shot_3 + '" alt="screenshot"/></a>';
	
	$('.shots').append(shots_init);
	$('.title-display').html(vids[0].title);





	//title & description init
	var info_init = '<h2>' + vids[0].title + '</h2>';
		info_init += '<p>' + vids[0].desc + '</p>';

	$('#desc-content').append(info_init);




	
											
	//first BACKGROUND VIDEO being added to DOM
	//**NOTE** MUSTTTT use the .scr function in JS to make caching work properly
	var video = document.getElementById('video');

	video.src = vids[0].mp4;
	$('#video').attr("poster", vids[0].poster);

	//build fallbacks
	var fallback = '<source src="' + vids[0].webm + '" type="video/webm" />' + '\n';
		fallback += '<source src="' + vids[0].ogv + '" type="video/ogv" />' + '\n';

		fallback += '<object type="application/x-shockwave-flash" data="http://releases.flowplayer.org/swf/flowplayer-3.2.1.swf">' + '\n';
		fallback += '<param name="movie" value="' + vids[0].flv + '" />' + '\n';
		fallback += '<param name="allowFullScreen" value="true" />' + '\n';
		fallback += '<param name="wmode" value="transparent" />' + '\n';
		fallback += '<param name="flashVars" value="config={playlist:[' + vids[0].poster + ',{url:' + vids[0].mp4 + ', autoPlay:false}]}" />' + '\n';
		fallback += '<img alt="' + vids[0].title + '" src="' + vids[0].poster + '" title="No video playback capabilities, please download the video instead." />' + '\n';
		fallback += '</object>' + '\n';
		fallback += '<p>Your browser does not support video. Is it Internet Explorer 3??</p>';

	$('#video').empty();
	$('#video').append(fallback);
	


	//runs the folder parser function that populates the dl file list
	fileList(vids[0].title);

	//loads video control and functions once first video has been added to DOM
	video_init();

	

	}//success
});// ajax














//--------------Video Controls Handler-----------------
function video_init(){


	
// inspiration: http://blog.teamtreehouse.com/building-custom-controls-for-html5-videos    

// Video
var video = document.getElementById("video");
var seekBar = document.getElementById("seek-bar");



// Event listener for the play/pause button
$(document).on('click', '#play-pause', function(){

	playPause(video);
 
});// listener playButton


//Event listener for video element play/pause control
$(document).on('click', '#video', function() {

  playPause(video);

});// onCLick #video


//listens for spacebar press to toggle play/pause
$(window).on('keypress', function(e){
	if(e.charCode == 32){
		playPause(video);
	}
});














function playPause(video, seekBar){
	 if (video.paused == true) {
    // Play the video
    video.play();

    //starts time display
    timeDisplay()

    //sets video seek-bar duration
	$('#seek-bar').attr('max', video.duration);



    // Update the button text to 'Pause'
     $('#play-pause').css('background', 'url(images/pause.png) no-repeat');
  } else {

    // Pause the video
    video.pause();

    // Update the button text to 'Play'
    $('#play-pause').css('background', 'url(images/play.png) no-repeat');

    //show footer controls
    $('footer').show();
	$('#vid-button').show();
  }
};














// Event listener for the seek bar
seekBar.addEventListener("change", function() {

  // Update the video time
  //because seek bar max is video.duration, 
  //current time is same as seekbar value.
  video.currentTime = seekBar.value;

});// seek listener














//Displays video's current time in transport window
//updates seek bar
//and handles switching to replay button
//****NOTE: tweak the running of the replay portion of this function.

function timeDisplay(){

	var curTime = Math.floor(video.currentTime).toString();
	var pos = "";

	//sets seekbar length to video duration
	$('#seek-bar').attr("max", video.duration);


	if(curTime.length < 2){
		pos = "00:0" + Math.floor(video.currentTime);
	}else{
		pos = "00:" + Math.floor(video.currentTime) ;
	}

	//upon video end, changes play button to a replay button
	if(video.ended){
		// Update the button button to 'replay'
	    $('#play-pause').css('background', 'url(images/replay.png) no-repeat');

	};


	if(video.playbackRate > 0){

		$('#time-display').html(pos);
		seekBar.value = Math.floor(video.currentTime);

		setTimeout(timeDisplay, 100);
	};
};// timeDisplay()
};//*******************video_init











//Center Video clip seek bar handler
$(document).on('change', '#video-scroll', function(){
	var videoScroll = document.getElementById("video-scroll");
	var multiple = videoScroll.value * 10;
	var val = '-' + multiple + 'px';

	$('#slider').css({'marginLeft' : val});
});











//click handlers for CURRENT VIDEO selection
$(document).on('click', '.video-thumb', function(e){
	
	$.ajax({
		url: '../controllers/get_video.php',
		data: {
			vid_id: this.id
		},
		type: 'get',
		dataType: 'json',
		success: function(response){

			var vid = response.video[0];

			//empties content from containers
			$('.shots').empty();
			$('#desc-content').empty();

			//loads video SHOTS to DOM
			var shots = '<a href="' + vid.shot_1 + '" data-lightbox="1"><img src="' + vid.shot_1 + '" alt="screenshot"/></a>';
				shots += '<a href="' + vid.shot_2 + '" data-lightbox="1"><img src="' + vid.shot_2 + '" alt="screenshot"/></a>';
				shots += '<a href="' + vid.shot_3 + '" data-lightbox="1"><img src="' + vid.shot_3 + '" alt="screenshot"/></a>';
			
			$('.shots').append(shots);


			//loads title & description to DOM
			var info = '<h2>' + vid.title + '</h2>';
				info += '<p>' + vid.desc + '</p>';

			$('#desc-content').append(info);
			$('.title-display').html(vid.title);

			//runs the folder parser function and populates dl list modal
			fileList(vid.title);
	
		}//success
	});//ajax
});//onClick .video-thumb














//adds folder audio/video file list to download modal
function fileList(title){
	
	//ajax call to run through folder contents returning file list for DOWNLOADS
	$.ajax({
		url: '/controllers/get_files.php',
		type: 'get',
		dataType: 'json',
		success: function(response){

		
			var v = response.video;
			var a = response.audio;

			$('#file-list').empty();
			$('#audio-dl').empty();


			
			//loops through video results
			for(var j=0;j<v.length;j++){
				var name = v[j];
				var t = name.substring(0,v[j].length - 4);

				//only populates where file is the same as clicked video
				if(t == title){
					var html = '<li><a href="uploads/' + name + '"><img class="dl-list-reel" src="images/reel.png" alt="movie icon"/>' + name + '<img class="dl-list-icon" src="images/cloud.png" alt="download link"/></a><li>';

					$('#file-list').append(html);
				}//if
			}//for


			//loops through audio results
			for(var k=0; k<a.length;k++){
				var a_name = a[k];
				var a_t = a_name.substring(0,a[k].length - 4);

				//only populates where file is the same as clicked audio
				if(a_t == title){
					
					var a_html = '<a href="uploads/' + a_name + '"><img class="dl-list-reel" src="images/spkr.png" alt="audio icon"/>' + a_name + '<img  class="dl-list-icon"src="images/cloud.png" alt="download link"/></a>';

					$('#audio-dl').append(a_html);
				}//if
			}//for
		}//success
	});//ajax
};//fileList()















//DOUBLE CLICK video to load it as BACKGROUND
$(document).on('dblclick', '.video-thumb', function(e){

	// Update the button text to 'Play'
    $('#play-pause').css('background', 'url(images/play.png) no-repeat');
 	$.ajax({
		url: '../controllers/get_video.php',
		data: {
			vid_id: this.id
		},
		type: 'get',
		dataType: 'json',
		success: function(response){

			var vid = response.video[0];
			
			var current_video = document.getElementById("video");

			// //sets video seek-bar duration
			// $('#time-display').html(current_video.duration;

			//loads BACKGROUND VIDEO to DOM
			$('#video').attr("poster", vid.poster);
			current_video.src = vid.mp4;

			//build fallbacks
			var fallback = '<source src="' + vid.webm + '" type="video/webm" />' + '\n';
				fallback += '<source src="' + vid.ogv + '" type="video/ogv" />' + '\n';
				fallback += '<object type="application/x-shockwave-flash" data="http://releases.flowplayer.org/swf/flowplayer-3.2.1.swf">' + '\n';
				fallback += '<param name="movie" value="' + vid.flv + '" />' + '\n';
				fallback += '<param name="allowFullScreen" value="true" />' + '\n';
				fallback += '<param name="wmode" value="transparent" />' + '\n';
				fallback += '<param name="flashVars" value="config={playlist:[' + vid.poster + ',{url:' + vid.mp4 + ', autoPlay:false}]}" />' + '\n';
				fallback += '<img alt="' + vid.title + '" src="' + vid.poster + '" title="No video playback capabilities, please download the video instead." />' + '\n';
				fallback += '</object>' + '\n';
				fallback += '<p>Your browser does not support video. Is it Internet Explorer 3??</p>';

			$('#video').empty();
			$('#video').append(fallback);

			$('.title-display').html(vid.title);

		}//success
	});//ajax
});// dblclick

			














//-----------Description & download show/hide handler-----------
var dl_toggle = true;
var info_toggle = true;


//download button handler
$(document).on('click', '#dl-btn', function(e){
	
	if(dl_toggle){

		$('.dl-list').show();
		dl_toggle = false;

		$('.desc').fadeOut(1000);
	}else{

		$('.dl-list').fadeOut(1000);
		dl_toggle = true;

		$('.desc').fadeOut(1000);
	};
	
	e.preventDefault();
});





//close x handler
$(document).on('click', '.close-list-x', function(e){
	$('.dl-list').fadeOut(1000);
	dl_toggle = true;

	$('.desc').fadeOut(1000);
});





//info button handler
$(document).on('click', '#info-btn', function(e){
	
	if(info_toggle){
	
		$('.desc').show();
		info_toggle = false;
		$('.dl-list').fadeOut(1000);
	}else{

		$('.desc').fadeOut(1000);
		info_toggle = true;
		$('.dl-list').fadeOut(1000);
	};
	
	e.preventDefault();
});





//closeout x handler
$(document).on('click', '.close-desc-x', function(e){
	$('.desc').fadeOut(1000);
	info_toggle = true;
	$('.dl-list').fadeOut(1000);
});





	










//---------form show/hide handler-----------------
$(document).on('click', '#vid-button', function(e){

	$('#vid-button').hide();
	$('.form-wrapper').show();
});




$(document).on('click', '.close-modal-x', function(e){

	$('#vid-button').show();
	$('.form-wrapper').hide();
});




//loading .gif handler
$(document).on('click', '#form-submit', function(e){
	$('#loading').show();
	$('#upload-success').show();
});




//shows upload checkmark when file enters input-file field
$(document).on('change', '#upload-drop', function(){
	$('#upload-success').show();
});










//-----------------Mousemove fadein/fadeout footer handler-------------------------
// $(document).on('mouseover', '.pseudo-footer', function(){
// 	// console.log('mouseover running');

// 	$('footer').show();
// 	$('#vid-button').show();
// });

// $(document).on('mouseover', 'footer', function(){
// 	// console.log('mouseover running');

// 	$('footer').show();
// 	$('#vid-button').show();
// });

// $(document).on('mouseout', 'footer', function(){
// 	// console.log('mouseover running');
// 	$('footer').fadeOut(100);
// 	$('#vid-button').fadeOut(100);
// });










});//get

});// function