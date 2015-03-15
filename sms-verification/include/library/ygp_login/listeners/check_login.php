<?php
include('../include/webzone.php');

$login = $_POST['login'];
$password = $_POST['password'];

if($login=='' || $password=='') {
	$display .= '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">x</button>';
	$display .= 'Missing login and/or password';
	$display .= '</div>';
	$d['display'] = $display;
	$d['code'] = 1;
	echo json_encode($d);
}
else {
	if( ($login==$GLOBALS['admin_username']) && ($password==$GLOBALS['admin_password']) ) {
		$y1 = new Yougapi_login();
		$y1->start_session(array('user_id'=>'', 'login'=>$login));
		
		$d['code'] = 2; //success
		echo json_encode($d);
	}
	else {
		$display .= '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">x</button>';
		$display .= 'The username and/or password are incorrect';
		$display .= '</div>';
		$d['display'] = $display;
		$d['code'] = 1;
		echo json_encode($d);
	}
}

?>