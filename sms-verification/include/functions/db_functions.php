<?php

function add_history($criteria=array()) {
	$type = $criteria['type'];
	$phone = $criteria['phone'];
	$message_id = $criteria['message_id'];
	$message = $criteria['message'];
	$results = $criteria['results'];
	
	$m1 = new MySqlTable();
	$sql = 'INSERT INTO '.$GLOBALS['db_table']['sms_history'].' (type, phone, message_id, message, results, created) VALUES ("'.$m1->escape($type).'", "'.$m1->escape($phone).'", "'.$m1->escape($message_id).'", "'.$m1->escape($message).'", "'.$m1->escape($results).'", "'.date('Y-m-d H:i:s').'")';
	$m1->executeQuery($sql);
}

function add_sms_number($criteria=array()) {
	$phone = $criteria['phone'];
	$code = $criteria['code'];
	
	$m1 = new MySqlTable();
	$sql = 'INSERT INTO '.$GLOBALS['db_table']['sms'].' (phone, code, created) VALUES ("'.$m1->escape($phone).'", "'.$m1->escape($code).'", "'.date('Y-m-d H:i:s').'")';
	$m1->executeQuery($sql);
}

function get_sms_history($criteria=array()) {
	$type = $criteria['type'];
	$phone = $criteria['phone'];
	$start = $criteria['start'];
	$nb_display = $criteria['nb_display'];
	
	$m1 = new MySqlTable();
	$sql = "SELECT * FROM ".$GLOBALS['db_table']['sms_history']." WHERE 1 ";
	
	if($type!='') $sql .= " AND type='".$m1->escape($type)."'";
	if($phone!='') $sql .= " AND phone='".$m1->escape($phone)."'";
	
	$sql .= " ORDER BY id DESC";
	
	if($nb_display!='') $sql .= ' LIMIT '.$start.', '.$nb_display;
	
	$result = $m1->customQuery($sql);
	
	if($GLOBALS['demo_mode']==1) {
		for($i=0; $i<count($result); $i++) {
			$result[$i]['phone'] = substr($result[$i]['phone'], 0, -4).'xxxx';
			if($result[$i]['phone']=='') $result[$i]['phone']='xxxx';
		}
	}
	
	return $result;
}

function get_sms_numbers($criteria=array()) {
	$id = $criteria['id'];
	$phone = $criteria['phone'];
	$code = $criteria['code'];
	$verified = $criteria['verified'];
	$start = $criteria['start'];
	$nb_display = $criteria['nb_display'];
	
	$m1 = new MySqlTable();
	$sql = "SELECT * FROM ".$GLOBALS['db_table']['sms']." WHERE 1 ";
	
	if($id!='') $sql .= " AND id='".$m1->escape($id)."'";
	if($phone!='') $sql .= " AND phone='".$m1->escape($phone)."'";
	if($code!='') $sql .= " AND code='".$m1->escape($code)."'";
	if($verified!='') $sql .= " AND verified='".$m1->escape($verified)."'";
	
	$sql .= " ORDER BY id DESC";
	
	if($nb_display!='') $sql .= ' LIMIT '.$start.', '.$nb_display;
		
	$result = $m1->customQuery($sql);
	
	if($GLOBALS['demo_mode']==1) {
		for($i=0; $i<count($result); $i++) {
			$result[$i]['phone'] = substr($result[$i]['phone'], 0, -4).'xxxx';
			if($result[$i]['phone']=='') $result[$i]['phone']='xxxx';
		}
	}
	
	return $result;
}

/*
START Default add/update functions
*/

function save_posted_data($data, $table_name) {
	
	$s1 = new MySqlTable();
	
	$fields='';
	$fields_values='';
	if(count($data)>0) {
		foreach($data as $ind => $value) {
			$fields .= $s1->escape($ind).',';
			$fields_values .= "'".$s1->escape($value)."',";
		}
	}
	
	$fields = substr($fields,0,-1);
	$fields_values = substr($fields_values,0,-1);
	
	$sql = "INSERT INTO $table_name ($fields) VALUES ($fields_values)";
	$s1->executeQuery($sql);
}

function update_posted_data($data, $id, $table_name) {
	
	$s1 = new MySqlTable();
	
	$fields='';
	if(count($data)>0) {
		foreach($data as $ind => $value) {
			$fields .= $s1->escape($ind)."='".$s1->escape($value)."',";
		}
	}
	
	$fields = substr($fields,0,-1);
	$fields_values = substr($fields_values,0,-1);
	
	$sql = "UPDATE $table_name SET $fields WHERE id='".$s1->escape($id)."'";
	$s1->executeQuery($sql);
}

?>