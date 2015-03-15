<?php
include_once('../include/webzone.php');

$phones = $_POST['phones'];
$message = $_POST['message'];

$y1 = new Yougapi_login();

if($GLOBALS['demo_mode']==1) {
	echo 'Action cannot be performed. Demo mode enabled.';
}
else {
	if($y1->isAdmin()) {
		$phonesTab = explode(',', $phones);
		
		if(count($phonesTab)>0) {
			
			$client = new Services_Twilio($GLOBALS['twilio_sid'], $GLOBALS['twilio_token']);
			$nb_sent=0;
			$nb_failed=0;
			
			foreach($phonesTab as $phone) {
				$result = $client->account->sms_messages->create($GLOBALS['twilio_number'], $phone, $message);
				if($result->sid!='') {
					add_history(array('phone'=>$phone, 'message_id'=>$result->sid, 'message'=>$message, 'type'=>2));
					$nb_sent++;
				}
				else {
					$res['status'] = $result->status;
					$res['message'] = $result->message;
					$res['code'] = $result->code;
					$res = json_encode($res);
					add_history(array('phone'=>$phone, 'message'=>$message, 'results'=>$res, 'type'=>2));
					$nb_failed++;
				}
			}
			
			if($nb_sent>0) echo $nb_sent.' SMS succesfully sent'."\n";
			if($nb_failed>0) echo $nb_failed.' SMS failed';
		}	
	}	
}

?>