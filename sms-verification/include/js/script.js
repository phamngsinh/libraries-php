/*
SMS sending - Front end
*/
jQuery(document).on('click', '#send_sms_btn', function(event) {
	event.preventDefault();
    var phone = jQuery('#phone_number').val();
    var country_code = jQuery('#country_code').val();
    
    if(phone=='') {
	    alert('Phone number required');
	    jQuery('#phone_number').focus();
    }
    else {
    	var original_val = $('#send_sms_btn').val();
    	$('#send_sms_btn').attr('disabled', 'disabled').val('Loading');
		jQuery.ajax({
			type: 'POST',
			dataType: 'json',
			url: 'listeners/send_sms.php',
			data: 'phone='+phone+'&country_code='+encodeURIComponent(country_code),
			success: function(msg) {
				$('#send_sms_btn').removeAttr('disabled').val(original_val);
				if(msg.type=='1') $('#error_display').html(msg.message);
				else if(msg.type=='2') {
					alert('We just sent you an SMS !');
					window.location = msg.redirect;
				}
			}
		});
    }
});

/*
START Admin functions
*/
jQuery(document).on('click', "#check_all_btn", function(event) {
	jQuery(this).parents('.checkboxes').find(':checkbox').prop('checked', this.checked);
});

jQuery(document).on('click', "#display_send_sms_btn", function(event) {
	event.preventDefault();
	
	var phones = '';
	var nb=0;
	
	jQuery.each(jQuery("input[name='phones_selection[]']:checked"), function() {
		phones += (phones?',':'') + jQuery(this).attr('data-phone');
		nb++;
	});
	
	if(phones=='') {
		alert('Please select at least one phone number');
	}
	else {
		jQuery('body').data('phones', phones);
		jQuery('body').data('nb_phones', nb);
		jQuery('#send_sms_box').modal();
	}
});

jQuery(document).on('shown', "#send_sms_box", function(event) {
	var nb_phones = jQuery('body').data('nb_phones');
	jQuery('#send_sms_message').focus();
	jQuery('#send_sms_text').html('Sending to <b>'+nb_phones+'</b> selected phone(s)');
});

jQuery(document).on('click', '#admin_send_sms_btn', function(event) {
	event.preventDefault();
	var phones = jQuery('body').data('phones');
	var message = jQuery('#send_sms_message').val();
	if(message=='') {
		alert('Missing message');
	}
	else {
		$('#admin_send_sms_btn').attr('disabled', 'disabled');
		jQuery.ajax({
			type: 'POST',
			url: '../listeners/admin_send_sms.php',
			data: 'phones='+encodeURIComponent(phones)+'&message='+message,
			success: function(msg) {
				$('#admin_send_sms_btn').removeAttr('disabled');
				if(msg!='') alert(msg);
			}
		});		
	}
});
