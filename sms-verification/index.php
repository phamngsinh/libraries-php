<?php
include_once('include/webzone.php');

$jsOnReady = '$("#phone_number").focus();';

include_once('include/presentation/header.php');

?>

<div class="container">
	
	<center>
	
	<h3>Please enter your phone number</h3>
	<form>
	<select id="country_code" name="country_code" style="width:160px;">
		<?php
		if(count($GLOBALS['countries_codes_allowed'])>0) {
			foreach($GLOBALS['countries_codes_allowed'] as $ind=>$value) {
				echo '<option value="'.$value.'">'.$ind.'</option>';
			}			
		}
		?>
	</select><br>
	<input type="text" id="phone_number" name="phone_number" placeholder="Your phone number" style="padding:10px; width:300px;"><br>
	<input type="submit" id="send_sms_btn" class="btn btn-primary btn-large" value="Send me the code">
	</form>
	
	<div id="error_display"></div>
	
	</center>

</div>

<?php
include_once('include/presentation/footer.php');
?>