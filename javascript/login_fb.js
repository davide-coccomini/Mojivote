  function statusChangeCallback(response) {
    if (response.status === 'connected') {
      registra_o_login();
    } else if (response.status === 'not_authorized') {
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    } else {
      document.getElementById('status').innerHTML = 'Please log ' +
        'into Facebook.';
    }
  }

  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
	  FB.init({
	    appId      : '1166271176826249',
	    cookie     : true,  // enable cookies to allow the server to access 
	                        // the session
	    xfbml      : true,  // parse social plugins on this page
	    version    : 'v2.8' // use graph api version 2.8
	  });

	  /*FB.getLoginStatus(function(response) {
	    statusChangeCallback(response);
	  });*/

  };

  // Load the SDK asynchronously
 function registra_o_login() {
    FB.api('/me?fields=id,first_name,last_name,gender,birthday,email', function(response) {
	    
	    Cookies.set('nome_fb',response.first_name);
	    Cookies.set('cognome_fb',response.last_name)
	    if(response.gender.localeCompare("male") ==0)
	      Cookies.set('sesso_fb',0);
	    else
	      Cookies.set('sesso_fb',1);

	    Cookies.set('id_fb',response.id)
		
	    var data;
		
	    if(response.birthday != null){
	   	 	var data = response.birthday.split('/');
	    	data = data[2]+'-'+data[0]+'-'+data[1];
		} else
	    	data = '1999-01-01';
	    
	    Cookies.set('d_nascita_fb',data);
	    Cookies.set('email_fb',response.email);

	    $.ajax({
	      type: "GET",
	      url: "php/registra_fb.php",
	      data: "",
	      dataType: "html",
	    });

		$( document ).ajaxComplete(function() {
			window.location.replace("php/main.php?p=menucategorie");
		});

    });
  }