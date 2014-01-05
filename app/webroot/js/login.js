$(function(){
  $("form#loginForm").submit(function() { // loginForm is submitted
    var email = $('#loginEmail').val(); // get username
    var password = $('#loginPassword').val(); // get password
    var homeUrl = $("#home-logo").attr("href");
    var action = $("#loginForm").attr("action");
    
    if (email && password) {
      $.ajax({
        type: "POST",
        url: action,
        data: "data[User][email]=" + email + "&data[User][password]=" + password,
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
			/*
          $('div#loginResult').text("responseText: " + XMLHttpRequest.responseText
            + ", textStatus: " + textStatus 
            + ", errorThrown: " + errorThrown);
			*/
          $('div#loginResult').addClass("error");
        }, 
        success: function(data){
          	location.href = homeUrl;
        }
      });
    }
    $('div#loginResult').fadeIn();
    return false;
  });
});
