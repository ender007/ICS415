$(function(){
  $("#reportBox").hide();
  
  //This handles the signup button which loads a registration screen for the user
  $("#signup").click(function(){
  	//$("#insideJumbo").empty();
    $("#insideJumbo").load("http://localhost/Pool%20League/pool%20leagues/form.txt");
  });
  
  //This code handles the report function that allows users to report their matches
  $("body").on('click','#report',function(){
  	$("#reportBox").css({
	position:'absolute',
	top: $(this).offset().top + $(this).height() + 30 + 'px',
	left: $(this).offset().left + 'px',
	zIndex:1000
   });
    $("#reportBox").slideToggle(300);

  });
  
  //This function handles the signin button. It checks to see if the user input data, 
  //then checks the database to see if the password entered equals the password for 
  //the user with that name. Then it either logs them in or rejects them.
  $("body").on('click','#login',function(){
  	var name = $("input#lastName").val();
  	var password = $("input#userPW").val();
  	if((name!='')&&(password!='')){
  		var dataString = 'lname='+name+'&password='+password;
  		//alert(dataString);
  	    $.ajax({  
          type: "POST",  
          url: "http://localhost/Pool%20League/pool%20leagues/bin/verifyUser.php",  
          data: dataString,  
       success: function(response) {
         $("#insideJumbo").load("http://localhost/Pool%20League/pool%20leagues/bin/login.php",{name:response});
       },
       error: function(data,status){
          alert("Failed in verifyUser.php");
       }
    });
    return false;
  		//check to see if the name exists
  		
  		//compare the password
  		//if it all checks out log them in
  		//if not, return an error message
  	} else {
  		alert("Please enter your full name and password!");
  	}
  });
  
  //This function handles the register button that allows users to register an account
  $("body").on('click','#register',function(){
    var dataString = 'fname='+ $("input#fname").val() + '&lname='+ $("input#lname").val() + '&building=' + $("select#building").val() + '&email=' + $("input#email").val() + '&pwd1=' + $("input#pwd1").val() + '&pwd2=' + $("input#pwd2").val();  
  	//alert(dataString);
    $.ajax({  
       type: "POST",  
       url: "http://localhost/Pool%20League/pool%20leagues/bin/registerUser.php",  
       data: dataString,  
       success: function(response) {
         $("#insideJumbo").load("http://localhost/Pool%20League/pool%20leagues/bin/login.php",{name:response});
       },
       error: function(data,status){
          alert("Something is wrong with your registration. Please contact Josh.");
       }
    }); 
  return false;
  });
  
  //This function handles the logout button that allows users to logout
  $("body").on('click','#logout',function(){
  	$.removeCookie('name',{ path: '/' });
  	window.location.reload(true);
  });
});

