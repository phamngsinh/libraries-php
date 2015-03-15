<?php
include_once('include/webzone.php');

$code = $_GET['code'];

if($code=='') $jsOnReady = "$('#code').focus();";
else $numbers = get_sms_numbers(array('code'=>$code));

include_once('include/presentation/header.php');
?>

<div class="container"><center>

<?php
if(count($numbers)>0) {
		
	if($numbers[0]['verified']!=1) {
		$m1 = new MySqlTable();
		$sql = 'UPDATE '.$GLOBALS['db_table']['sms'].' SET verified=1 WHERE code="'.$m1->escape($code).'"';
		$m1->executeQuery($sql);
	}
	
	include_once('locked_content.php');
	
}
else {
	?>
	<h3>Your verification code</h3>
	<p class="alt" style="margin-bottom:20px;">Please enter the code you have received by SMS</p>
	<form method="GET">
	<input type="text" id="code" name="code" placeholder="Your verification code" style="padding:10px; width:300px;" value="<?php echo $code; ?>"><br>
	<input type="submit" class="btn btn-primary btn-large" value="Verify my code">
	</form>
	<?php
	if($code!='' && count($numbers)==0) {
		$message = 'Your verification code is incorrect';
		echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">x</button>'.$message.'</div>';
	}
}

?>

</center>
</div>

<?php
include_once('include/presentation/footer.php');
?>