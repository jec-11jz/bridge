$(document).ready(function(){
  $("form#addForm").submit(function() { 
  	// addForm is submitted
  	var name = $('#name').val();  
    var password = $('#password').val();
    var confirm = $('#confirm').val();
    var email = $('#email').val();
    var homeUrl = $("#home-logo").attr("href");
    var action = $("#addForm").attr("action");
	
    if (email && password && confirm && name) { // values are not empty
      $.ajax({
        type: "POST",
        url: action, // URL of the Perl script
        // send username and password as parameters to the Perl script
        data: "data[User][name]=" + name + "&data[User][password]=" + password +  "&data[User][confirm]=" + confirm + "&data[User][email]=" + email,
        // script call was *not* successful
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
          $('div#addResult').text("responseText: " + XMLHttpRequest.responseText
            + ", textStatus: " + textStatus 
            + ", errorThrown: " + errorThrown);
          $('div#addResult').addClass("error");
        }, // error 
        // script call was successful 
        // data contains the JSON values returned by the Perl script 
        success: function(data){
          if (data.error) { 
          	// script returned error
            $('div#addResult').text("data.error: " + data.error);
            $('div#addResult').addClass("error");
			location.href = homeUrl;
          } // if
          else { 
          	// add was successful
          	location.href = homeUrl;
          } //else
        } // success
      }); // ajax
    } // if
    else {
      $('div#addResult').text("enter email and password");
      $('div#addResult').addClass("error");
    } // else
    $('div#addResult').fadeIn();
    return false;
  });
});