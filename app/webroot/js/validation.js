$(document).ready(function() {
	jQuery.validator.setDefaults({
	  debug: true,
	  success: "valid"
	});
	var form = $( "#loginForm" );
	form.validate();
	$("submit").click(function() {
	  alert( "Valid: " + form.valid() );
	});
	
   $("#loginForm").validate({
        rules : {
        	email: {
        		email: true,
        		required: true
        	},
            password: {
                required: true,
                minlength: 5
            }
        },
        messages: {
            password: {
                required: "なんか書くだろ常考…",
                minlength: $.format("{0}文字くらい書けよハゲ")
            }
        },
    });
});
