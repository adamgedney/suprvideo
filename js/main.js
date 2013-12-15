$(function(){





//-----------templating---------------
//This $.get closes just before namespace close at end of file
//acts as a window.onload for the rest of the program
$.get('/templates/template.html', function(htmlArg){

	//----loads bg video----
	var source = $(htmlArg).find('#bg-video').html();
	var template = Handlebars.compile(source);
	$('#bg-container').append(template);

	//----loads site----
	var siteSource = $(htmlArg).find('#site').html();
	var siteTemplate = Handlebars.compile(siteSource);
	$('#site-container').append(siteTemplate);

	// setTimeout(init, 100);



	//initializes hide on all show/hide behaviors
	$('.dl-list').hide();
	$('.desc').hide();
	$('.form-wrapper').hide();






//-----------Description & download show/hide handler-----------
var dl_toggle = true;
var info_toggle = true;

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




$(document).on('click', '.close-list-x', function(e){
	$('.dl-list').fadeOut(1000);
	dl_toggle = true;

	$('.desc').fadeOut(1000);
});








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









//--------------Video Controls Handler-----------------
// source: http://blog.teamtreehouse.com/building-custom-controls-for-html5-videos    
// window.onload = function() {

	//note: JQuery does not work on video element selectors.
	// Video
	var video = document.getElementById("video");

	// Buttons
	var playButton = document.getElementById("play-pause");
	var muteButton = document.getElementById("mute");
	var fullScreenButton = document.getElementById("full-screen");

	// Sliders
	var seekBar = document.getElementById("seek-bar");
	var volumeBar = document.getElementById("volume-bar");



	// Event listener for the play/pause button
	playButton.addEventListener("click", function() {

	  if (video.paused == true) {
	    // Play the video
	    video.play();

	    // Update the button text to 'Pause'
	     $('#play-pause').css('background', 'url(images/pause.png) no-repeat');
	  } else {

	    // Pause the video
	    video.pause();

	    // Update the button text to 'Play'
	    $('#play-pause').css('background', 'url(images/play.png) no-repeat');
	  }
	});








//Event listener for video element play/pause control
$(document).on('click', '#video', function() {

  if (video.paused == true) {
    // Play the video
    video.play();

    // Update the button text to 'Pause'
     $('#play-pause').css('background', 'url(images/pause.png) no-repeat');
  } else {

    // Pause the video
    video.pause();

    // Update the button text to 'Play'
    $('#play-pause').css('background', 'url(images/play.png) no-repeat');
  }
});








// Event listener for the seek bar
seekBar.addEventListener("change", function() {
  
  // Calculate the new time
  var time = video.duration * (seekBar.value / 100);

  // Update the video time
  video.currentTime = time;
});








//Displays video's current time in transport window
//updates seek bar
//and handles switching to replay button
//****NOTE: tweak the running of this function.
timeDisplay();
function timeDisplay(){

	var pos = "00:" + Math.floor(video.currentTime);

	//upon video end, changes play button to a replay button
	if(video.ended){
		// Update the button button to 'replay'
	    $('#play-pause').css('background', 'url(images/replay.png) no-repeat');

	};


	if(video.playbackRate > 0){

		$('#time-display').html(pos);
		seekBar.value = Math.floor(video.currentTime) * 3.25;

		setTimeout(timeDisplay, 100);
	};
};


// console.log(video.currentTime);

// //horizontal scroll scrubbing
// $(window).scroll(function(e){
       
//         // Calculate the new time

//   if($(this).scrollLeft()){
//   	var time = video.duration * ($(this).scrollLeft() * 10);
//   }else if($(this).scrollRight()){
//   	var time = video.duration * ($(this).scrollRight() * -10);
//   };
  

//   // Update the video time
//   video.currentTime = time;



//         // if($(this).scrollLeft()>500)
//         // {
        
//         //     $("#label").show();
//         // }
//         // else
//         // {
//         //     $("#label").hide();
//         // }
//     });





// }// onload



//-----------------Mousemove fadein/fadeout footer handler-------------------------

// $(document).on('mousemove', function(){

// 	$('footer').stop().animate({opacity:0});
// 	$('#vid-button').stop().animate({opacity:0});

// 	$('footer').animate({opacity:1});
// 	$('#vid-button').animate({opacity:1});

// 	//runs fade out function
// 	// setTimeout(fadeOutFooter, 2000);
// });

// function fadeOutFooter(){

// 	$('footer').animate({opacity:0});
// 	$('#vid-button').animate({opacity:0});
	
// };


// $(window).mouseover('footer', function(){
// 	$('footer').show();
// 	$('#vid-button').show();
// });



//-------------------------------------------Validate form---------------------------------
$('#submit-btn').on("click", function(e){

	var email = $('#con-email').val();
	var phone = $('#con-phone').val();
	var message = $('#con-message').val();

	var emailPat = /^\w+[\w-\.]*\@\w+((-\w+)|(\w*))\.[a-z]{2,3}$/; // standard email validation
	var phonePat = /^[2-9]\d{2}-\d{3}-\d{4}$/; //845-216-5030 


	//contact form validation conditions
	if(!emailPat.test(email)){

		e.preventDefault();
		$('[name=email]').css('background', '#ff0000');
	}else if(!phonePat.test(phone)){

		e.preventDefault();
		$('[name=phone]').css('background', '#ff0000');
	}else if(message == "" || message == null){

		e.preventDefault();
		$('[name=message]').css('background', '#ff0000');
	}else{

		return "true";
	}

});// Validate














});//get

});// function