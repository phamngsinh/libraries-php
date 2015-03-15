<?php
include_once('../include/webzone.php');

$phone = $_POST['phone'];
$country_code = $_POST['country_code'];

if($phone!='' && is_numeric($phone)) {
	
	//Check if phone number allowed (country code)
	$phone_allowed = 0;
	if(count($GLOBALS['countries_codes_allowed'])>0) {
		foreach($GLOBALS['countries_codes_allowed'] as $ind=>$value) {
			if($country_code===$value) $phone_allowed=1;
		}
	}
	if($phone_allowed!=1) {
		$d['type'] = 1;
		$d['message'] = '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">x</button>The phone number is not allowed (country restriction)</div>';
		$d = json_encode($d);
		echo $d;
		exit();
	}
	
	$phone = $country_code.$phone;
	
	if($GLOBALS['demo_mode']==1) {
		if(strlen($phone)!=10) {
			$d['type'] = 1;
			$d['message'] = '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">x</button>
			Invalid phone number
			</div>';
			$d = json_encode($d);
			echo $d;
			exit();
		}
		
		if(!is_array($_SESSION['sms_app'])) $_SESSION['sms_app'] = array();
		if(!in_array($phone, $_SESSION['sms_app'])) $_SESSION['sms_app'][] = $phone;
		if(count($_SESSION['sms_app'])>2) {
			$d['type'] = 1;
			$d['message'] = '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">x</button>
			You have tried to send too many SMS. The demo mode is active. Please try again in 48h.
			</div>';
			$d = json_encode($d);
			echo $d;
			exit();
		}		
	}
	
	//check if sending limit has been reached
	$m1 = new MySqlTable();
	$sql = "SELECT * FROM ".$GLOBALS['db_table']['sms_history']." WHERE phone='".$m1->escape($phone)."'";
	$history = $m1->customQuery($sql);
	if(count($history)>=$GLOBALS['max_sms_per_phone']) {
		$d['type'] = 1;
		$d['message'] = '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">x</button>
		Sorry, you have reached the limit on the SMS you can send (set to '.$GLOBALS['max_sms_per_phone'].' by the app admin)
		</div>';
		$d = json_encode($d);
		echo $d;
		exit();
	}
	
	$numbers = get_sms_numbers(array('phone'=>$phone));
	if(count($numbers)>0) {
		$code = $numbers[0]['code'];
	}
	else {
		$code = rand(99,999).rand(99,999);
		
		//make sure the code is unique
		$all_numbers = get_sms_numbers();
		$all_codes = array();
		for($i=0; $i<count($all_numbers); $i++) {
			$all_codes[] = $all_numbers[$i]['code'];
		}
		while(in_array($code, $all_codes)) {
			$code = rand(99,999).rand(99,999);
		}
	}
	
	//Replace the shortcode in the message
	$pos = strpos($GLOBALS['sms_message'], '{code}');
	if($pos!==false) $GLOBALS['sms_message'] = str_replace('{code}', $code, $GLOBALS['sms_message']);
	
	//Send SMS
	$client = new Services_Twilio($GLOBALS['twilio_sid'], $GLOBALS['twilio_token']);
	$result = $client->account->sms_messages->create(
	  $GLOBALS['twilio_number'],
	  $phone,
	  $GLOBALS['sms_message']
	);
	
	//if sent
	if($result->sid!='') {
		add_history(array('phone'=>$phone, 'message_id'=>$result->sid, 'type'=>1));
		
		$numbers = get_sms_numbers(array('phone'=>$phone));
		if(count($numbers)==0) {
			add_sms_number(array('phone'=>$phone, 'code'=>$code));
		}
		
		$d['type'] = 2;
		$d['redirect'] = 'reserved.php';
		$d = json_encode($d);
		echo $d;
	}
	else {
		$res['status'] = $result->status;
		$res['message'] = $result->message;
		$res['code'] = $result->code;
		$res = json_encode($res);
		add_history(array('phone'=>$phone, 'results'=>$res, 'type'=>1));
		
		$d['type'] = 1;
		$d['message'] = '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">x</button>'.$result->message.'</div>';
		$d = json_encode($d);
		echo $d;
	}	
}

?>