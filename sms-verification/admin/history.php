<?php
include_once('../include/webzone.php');

//request login
$y1 = new Yougapi_login();
$y1->require_login(array('redirect'=>'./'));

$type = $_GET['type'];
$phone = $_GET['phone'];
$page_number = $_GET['page'];

if($page_number=='') $page_number=1;
$nb_display=50;
$start = $page_number*$nb_display-$nb_display;

include_once('../include/presentation/header_admin.php');

if($GLOBALS['demo_mode']==1) {
	$username = $GLOBALS['admin_username'];
	$password = $GLOBALS['admin_password'];
}
?>

<div class="container">	
	<div class="row">
		
		<div class="span12">
			
			<?php
			
			if($phone=='') {
				$type_tab = array(''=>'All', '1'=>'Users actions history', '2'=>'Admin actions history');
				echo '<form style="margin-bottom:8px;">';
				echo '<select name="type" onchange="form.submit();">';
				foreach($type_tab as $ind=>$value) {
					if($ind==$type) echo '<option value="'.$ind.'" selected>'.$value.'</option>';
					else echo '<option value="'.$ind.'">'.$value.'</option>';
				}
				echo '</select> ';
				echo '</form>';				
			}
			
			$history = get_sms_history(array('type'=>$type, 'phone'=>$phone, 'start'=>$start, 'nb_display'=>$nb_display));
			
			if(count($history)>0) {				
				echo '<table class="table table-condensed">';
				echo '<thead><tr><td><b>Phone number</b></td><td><b>Response</b></td><td><b>Message</b></td><td><b>Created</b></td></tr><thead>';
				
				for($i=0; $i<count($history); $i++) {
					$message_id = $history[$i]['message_id'];
					$message = $history[$i]['message'];
					$results = $history[$i]['results'];
					
					if($message_id!='') $response = $message_id;
					else $response = $results;
					
					/*
					$results = $history[$i]['results'];
					if($results!='') {
						$results = json_decode($results, true);
					}
					*/
					
					echo '<tr>';
					echo '<td>'.$history[$i]['phone'].'</td>';
					
					if($message_id!='') echo '<td>'.$response.'</td>';
					else echo '<td><textarea style="width:60%;">'.$response.'</textarea></td>';
					
					echo '<td>'.$message.'</td>';
					echo '<td>'.$history[$i]['created'].'</td>';
					echo '</tr>';
				}
				echo '</table>';
			}
			else {
				echo 'No entries found';
			}
							
			$history = get_sms_history(array('type'=>$type, 'phone'=>$phone));
			echo display_pagination(array('nbTotal'=>count($history), 'start'=>$start, 'nb_display'=>$nb_display));
			
			?>
			
		</div>			
		
	</div>
</div>

<?php
include_once('../include/presentation/footer.php');
?>