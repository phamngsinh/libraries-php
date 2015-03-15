<?php
include_once('../include/webzone.php');

$verified = $_GET['verified'];
$page_number = $_GET['page'];

if($page_number=='') $page_number=1;
$nb_display=50;
$start = $page_number*$nb_display-$nb_display;

//$verified=3;

include_once('../include/presentation/header_admin.php');

?>

<div class="container">	
	<div class="row">
		
		<div class="span10">
			
			<?php
			$y1 = new Yougapi_login();
			
			if($y1->isAdmin()) {
				
				$verified_tab = array(''=>'All numbers', '1'=>'Verified numbers');
				echo '<form style="margin-bottom:8px;">';
				echo '<select name="verified" onchange="form.submit();">';
				foreach($verified_tab as $ind=>$value) {
					if($ind==$verified) echo '<option value="'.$ind.'" selected>'.$value.'</option>';
					else echo '<option value="'.$ind.'">'.$value.'</option>';
				}
				echo '</select> - <a href="#" id="display_send_sms_btn">Send SMS</a>';
				echo '</form>';
				
				$sms_numbers = get_sms_numbers(array('verified'=>$verified, 'start'=>$start, 'nb_display'=>$nb_display));
				
				if(count($sms_numbers)>0) {
					echo '<table class="table table-condensed checkboxes">';
					echo '<thead><tr><td><b><input id="check_all_btn" type="checkbox" style="margin-bottom:7px;"> Phone number</b></td><td><b>Code</b></td><td><b>Verified</b></td><td><b>Created</b></td></tr><thead>';
					
					for($i=0; $i<count($sms_numbers); $i++) {
						$phone = $sms_numbers[$i]['phone'];
						echo '<tr><td><input type="checkbox" name="phones_selection[]" data-phone="'.$phone.'" style="margin-bottom:7px;">  <a href="./history.php?phone='.urlencode($phone).'">'.$phone.'</a></td><td>'.$sms_numbers[$i]['code'].'</td><td>'.$sms_numbers[$i]['verified'].'</td><td>'.$sms_numbers[$i]['created'].'</td></tr>';
					}
					echo '</table>';
				}
				else {
					echo 'No numbers found';
				}
								
				$sms_numbers = get_sms_numbers(array('verified'=>$verified));
				echo display_pagination(array('nbTotal'=>count($sms_numbers), 'start'=>$start, 'nb_display'=>$nb_display));
				
			}
			else {
				if($GLOBALS['demo_mode']==1) {
					$username = $GLOBALS['admin_username'];
					$password = $GLOBALS['admin_password'];
				}
				$y1->displayLoginForm(array('username'=>$username, 'password'=>$password));
			}
			?>
			
		</div>
		
		<div class="span2" style="text-align:right;">
			
			
		</div>
		
	</div>
</div>

<div id="send_sms_box" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    <h3>Sending SMS</h3>
  </div>
    <div class="modal-body">
    	<p id="send_sms_text"></p>
	    <textarea id="send_sms_message" style="width:95%; height:90px;"></textarea>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button id="admin_send_sms_btn" class="btn btn-primary">Send SMS</button>
    </div>
</div>

<?php
include_once('../include/presentation/footer.php');
?>