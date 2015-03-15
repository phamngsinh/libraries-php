/*
Login
*/
jQuery(document).on('click', '#ygp_login_btn', function(event) {
	event.preventDefault();
	var serialized_data = jQuery("#ygp_login_form").serialize();
	$.ajax({
	  type: 'POST',
	  data: serialized_data,
	  dataType: 'json',
	  url: Yougapi_login.path + 'listeners/check_login.php',
	  success: function(msg) {
	  	//alert(msg);
	  	if(msg.code==1) {
	  		$('#ygp_login_notification').html(msg.display);
	  	}
	  	else if(msg.code==2) {
	  		window.location.reload();
	  	}
	  }
	});
});

/*
Logout
*/
jQuery(document).on('click', '#ygp_logout_btn', function(event) {
	event.preventDefault();
	$.ajax({
	  type: 'POST',
	  url: Yougapi_login.path + 'listeners/logout.php',
	  success: function(msg) {
	  	window.location.reload();
	  }
	});
});