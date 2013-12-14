//@codekit-prepend "jquery-1.10.2.min.js"
//@codekit-prepend "handlebars-v1.1.2.js"
//@codekit-prepend "lightbox-2.6.min.js"



//namespace
$(function(){





















//-------------------------------------------Validate contact form---------------------------------
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

});// Validate Contact
















});// function