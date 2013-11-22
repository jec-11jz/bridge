$(document).ready(function(){
  $("form#loginForm").submit(function() { // loginForm is submitted
    var email = $('#email').val(); // get username
    var password = $('#password').val(); // get password
    var homeUrl = $("#home-logo").attr("href");
    var action = $("#loginForm").attr("action");
    
    if (email && password) { // values are not empty
      $.ajax({
        type: "POST",
        url: action, // URL of the Perl script
        // send username and password as parameters to the Perl script
        data: "data[User][email]=" + email + "&data[User][password]=" + password,
        // script call was *not* successful
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
          $('div#loginResult').text("responseText: " + XMLHttpRequest.responseText
            + ", textStatus: " + textStatus 
            + ", errorThrown: " + errorThrown);
          $('div#loginResult').addClass("error");
        }, // error 
        // script call was successful 
        // data contains the JSON values returned by the Perl script 
        success: function(data){
          if (data.error) { 
          	// script returned error
            $('div#loginResult').text("data.error: " + data.error);
            $('div#loginResult').addClass("error");
			location.href = homeUrl;
          } // if
          else { 
          	// login was successful
          	location.href = homeUrl;
          } //else
        } // success
      }); // ajax
    } // if
    else {
      $('div#loginResult').text("enter email and password");
      $('div#loginResult').addClass("error");
    } // else
    $('div#loginResult').fadeIn();
    return false;
  });
});