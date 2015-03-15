<?php

//app settings
$GLOBALS['app_url'] = 'http://localhost/dev/sms_marketing'; //ex: http://yougapi.com

//Twilio API - https://www.twilio.com
$GLOBALS['twilio_sid'] = '';
$GLOBALS['twilio_token'] = '';
$GLOBALS['twilio_number'] = '';

//database access
$GLOBALS['db_host'] = 'localhost';
$GLOBALS['db_name'] = 'dev';
$GLOBALS['db_user'] = 'root';
$GLOBALS['db_password'] = '';

//Max number of SMS a user can send to his phone
$GLOBALS['max_sms_per_phone'] = 1;

//Message to send - Can use {code} corresponding to the activation code
$GLOBALS['sms_message'] = 'Hello world - Here is your code: {code}';

$GLOBALS['countries_codes_allowed'] = array('USA / Canada (+1)'=>'+1');

//Admin access
$GLOBALS['admin_username'] = 'admin';
$GLOBALS['admin_password'] = 'admin';

//demo mode
$GLOBALS['demo_mode'] = 0; //possible values: 0 or 1

/*
System variables
Not to be modified at least of you know what you are doing
*/
//database tables names
$GLOBALS['db_table']['sms'] = 'sms_numbers';
$GLOBALS['db_table']['sms_history'] = 'sms_history';

?>