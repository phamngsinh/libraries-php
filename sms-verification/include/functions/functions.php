<?php

function sendMail($from, $to, $subject, $message, $bcc='') {
	$headers  = "From: $from\r\n";
	$headers .= "Content-type: text/html; charset=UTF-8\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	if($bcc!='') $headers .= "Bcc: $bcc";
	mail($to, $subject, $message, $headers);
}

function getDataFromUrl($url) {
	$ch = curl_init();
	$timeout = 5;
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
	//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //to make it support SSL calls on some servers
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}

function currentPageURL() {
	$pageURL = 'http';
	if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	}
	else {
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	return $pageURL;
}

function createFile($file, $content) {
	$fh = fopen($file, 'w') or die('Cannot create the file');
	fwrite($fh, $content);
	fclose($fh);
}

?>