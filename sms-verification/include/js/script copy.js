
/*
function fb_wpress_inviter_init() {
	FB.api('/me', function(response) {
	  	jQuery('#fb_inviter_box').show();
	  	jQuery('#fb_inviter_send_btn').show();
		
		jQuery('#fb_inviter_display').jfmfs({ max_selected: Fb_inviter.max_selected, 
		exclude_friends: Fb_inviter.exclude_friends,
		max_selected_message: "{0} of {1} selected"});
	});
}


jQuery(document).on('click', '#fb_inviter_send_btn', function(event) {
	event.preventDefault();
    jQuery('#fb_inviter_send_btn').attr("disabled", true);
	var friendSelector = jQuery('#fb_inviter_display').data('jfmfs');
    
    var users_ids = friendSelector.getSelectedIds().join(',');
    var users_names = friendSelector.getSelectedNames().join(',');
    
    if(users_ids=='') {
    	alert('Please select at least a user');
    	jQuery('#fb_inviter_send_btn').attr("disabled", false);
    }
    else {
		jQuery.ajax({
			type: 'POST',
			url: 'account/send_invites.php',
			data: 'users_ids='+users_ids+'&users_names='+users_names,
			success: function(msg) {
				if(msg!='') alert(msg);
				window.location.reload();
			}
		});
    }
});

function displayLockedContent() {
	jQuery.ajax({
		type: 'POST',
		url: './account/ajax_connect.php',
		success: function(msg) {
			if(msg!='') $('#locked_content').html(msg);
		}
	});
}
*/

/*
Locked content
*/
jQuery(document).on('click', "#locked_content_save_btn", function(event) {
	event.preventDefault();
	
	var serialized_data = $("#locked_content_form").serialize();
	
	jQuery.ajax({
		type: 'POST',
		url: './listeners/ajax_save_locked_content.php',
		data: serialized_data,
		success: function(msg) {
			window.location.reload();
		}
	});
});

/*
Export data
*/
jQuery(document).on('click', "#export_btn", function(event) {
	event.preventDefault();
	
	var serialized_data = $("#export_form").serialize();
	
	jQuery.ajax({
		type: 'POST',
		url: './listeners/ajax_export_data.php',
		data: serialized_data,
		success: function(msg) {
			$('#export_form').hide();
			$('#export_results_box').show();
			$('#export_results').html(msg);
		}
	});
});

jQuery(document).on('click', "#export_box_display_btn", function(event) {
	event.preventDefault();
	$('#export_form').show();
	$('#export_results_box').hide();
});

/*
Save autopost email
*/
jQuery(document).on('click', "#autopost_email_save_btn", function(event) {
	event.preventDefault();
	
	var serialized_data = $("#autopost_email_form").serialize();
	$('#autopost_email_subject').attr('disabled', 'disabled');
	$('#autopost_email_message').attr('disabled', 'disabled');
	$('#autopost_email_save_btn').attr('disabled', 'disabled');
	
	jQuery.ajax({
		type: 'POST',
		url: './listeners/ajax_save_autopost_email_data.php',
		data: serialized_data,
		success: function(msg) {
			window.location.reload();
			$('#autopost_email_subject').removeAttr('disabled');
			$('#autopost_email_message').removeAttr('disabled');
			$('#autopost_email_save_btn').removeAttr('disabled');
		}
	});
});

jQuery(document).on('click', "#autopost_email", function(event) {
	var autopost = $(this).is(':checked');
	if(autopost) {
		$('#autopost_email_box').show();
		autopost = 'on';
	}
	else {
		$('#autopost_email_box').hide();
		autopost = '';
	}
	jQuery.ajax({
		type: 'POST',
		url: './listeners/ajax_save_autopost_email.php',
		data: 'autopost='+autopost,
		success: function(msg) {
		}
	});
});

/*
Save autopost status
*/
jQuery(document).on('click', "#autopost_status_save_btn", function(event) {
	event.preventDefault();
	
	var serialized_data = $("#status_update_form").serialize();
	$('#status_message').attr('disabled', 'disabled');
	$('#status_link').attr('disabled', 'disabled');
	$('#status_picture').attr('disabled', 'disabled');
	$('#post_status_btn').attr('disabled', 'disabled');
	
	jQuery.ajax({
		type: 'POST',
		url: './listeners/ajax_save_autopost_status_data.php',
		data: serialized_data,
		success: function(msg) {
			window.location.reload();
			$('#status_message').removeAttr('disabled');
			$('#status_link').removeAttr('disabled');
			$('#status_picture').removeAttr('disabled');
			$('#post_status_btn').removeAttr('disabled');
		}
	});
});

jQuery(document).on('click', "#autopost_status", function(event) {
	var autopost = $(this).is(':checked');
	if(autopost) {
		$('#status_update_box').show();
		autopost = 'on';
	}
	else {
		$('#status_update_box').hide();
		autopost = '';
	}
	jQuery.ajax({
		type: 'POST',
		url: './listeners/ajax_save_autopost_status.php',
		data: 'autopost='+autopost,
		success: function(msg) {
		}
	});
});

/*
Delete user
*/
jQuery(document).on('click', ".delete_user_btn", function(event) {
	event.preventDefault();
	
	if (confirm("Are you sure you want to delete this user?")) {
		var id = jQuery(this).attr('id');
		var fb_id = jQuery(this).attr('name');
		
		jQuery.ajax({
			type: 'POST',
			url: './listeners/ajax_delete_user.php',
			data: 'id='+id+'&fb_id='+fb_id,
			success: function(msg) {
				window.location.reload();
			}
		});
	}
});

jQuery(document).on('click', "#check_all_btn", function(event) {
	jQuery(this).parents('.checkboxes').find(':checkbox').prop('checked', this.checked);
});

/*
Post status
*/
jQuery(document).on('click', "#post_status_btn", function(event) {
	event.preventDefault();
	var message = jQuery('#message').val();
	var fb_ids = jQuery('body').data('fb_ids');
	
	var serialized_data = $("#status_update_form").serialize();
	$('#message').attr('disabled', 'disabled');
	$('#link').attr('disabled', 'disabled');
	$('#picture').attr('disabled', 'disabled');
	$('#post_status_btn').attr('disabled', 'disabled');
	
	if(message=='') {
		alert('Please type your status message');
		$('#message').removeAttr('disabled');
		$('#link').removeAttr('disabled');
		$('#picture').removeAttr('disabled');
		$('#post_status_btn').removeAttr('disabled');
		return false;
	}
	
	jQuery.ajax({
		type: 'POST',
		url: './listeners/ajax_post_status.php',
		data: 'fb_ids='+fb_ids+'&'+serialized_data,
		success: function(msg) {
			alert(msg);
			window.location.reload();
		}
	});
});

/*
Display status update box
*/
jQuery(document).on('click', "#update_users_wall_btn", function(event) {
	event.preventDefault();
	
	var fb_ids = '';
	jQuery('#users_list').html('');
	
	jQuery.each(jQuery("input[name='fb_accounts_selection[]']:checked"), function() {
		fb_ids += (fb_ids?',':'') + jQuery(this).attr('id');
		jQuery('#users_list').append('<img src="https://graph.facebook.com/'+jQuery(this).attr('id')+'/picture" style="width:25px; margin-right:5px;">');
	});
	
	if(fb_ids=='') {
		alert('Please select at least one user');
	}
	else {
		jQuery('#status_update_box').show();
		jQuery('#users_display_box').hide();
	}
	
	jQuery('body').data('fb_ids', fb_ids);
});

/*
Display send email box
*/
jQuery(document).on('click', "#send_email_box_btn", function(event) {
	event.preventDefault();
	
	var fb_ids = '';
	jQuery('#users_list_email').html('');
	
	jQuery.each(jQuery("input[name='fb_accounts_selection[]']:checked"), function() {
		fb_ids += (fb_ids?',':'') + jQuery(this).attr('id');
		jQuery('#users_list_email').append('<img src="https://graph.facebook.com/'+jQuery(this).attr('id')+'/picture" style="width:25px; margin-right:5px;">');
	});
	
	if(fb_ids=='') {
		alert('Please select at least one user');
	}
	else {
		jQuery('#send_email_box').show();
		jQuery('#users_display_box').hide();
	}
	
	jQuery('body').data('fb_ids', fb_ids);
});

/*
Send email
*/
jQuery(document).on('click', "#send_email_btn", function(event) {
	event.preventDefault();
	var subject = jQuery('#email_subject').val();
	var message = jQuery('#email_message').val();
	var fb_ids = jQuery('body').data('fb_ids');
	
	var serialized_data = $("#send_email_form").serialize();
	$('#email_subject').attr('disabled', 'disabled');
	$('#email_message').attr('disabled', 'disabled');
	$('#send_email_btn').attr('disabled', 'disabled');
	
	if(subject=='' || message=='') {
		alert('Please enter a subject and a message');
		$('#email_subject').removeAttr('disabled');
		$('#email_message').removeAttr('disabled');
		$('#send_email_btn').removeAttr('disabled');
		return false;
	}
	
	jQuery.ajax({
		type: 'POST',
		url: './listeners/ajax_send_email.php',
		data: 'fb_ids='+fb_ids+'&'+serialized_data,
		success: function(msg) {
			alert(msg);
			window.location.reload();
		}
	});
});
