<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:og="http://ogp.me/ns#"
      xmlns:fb="https://www.facebook.com/2008/fbml">
<html xmlns:fb="http://ogp.me/ns/fb#">
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
<title>SMS Verification & Marketing App</title> 

<link rel="stylesheet" href="../include/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="../include/css/bootstrap-responsive.min.css" type="text/css">
<link rel="stylesheet" href="../include/css/style.css" type="text/css">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript" src="../include/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../include/js/script.js"></script>

<script> 
$(document).ready(function() {
	<?php echo $jsOnReady; ?>
})
</script>

</head>
<body>

<?php
$y1 = new Yougapi_login(array('path'=>'../include/library/ygp_login/'));
$y1->add_js();
?>

<div class="navbar navbar-inverse navbar-fixed-top">
  	<div class="navbar-inner">
    	<div class="container">
			
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			
			<a class="brand" href="./">Admin</a>
			
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class=""><a href="./">Numbers list</a></li>
              <li class=""><a href="./history.php">History</a></li>
            </ul>
            
            <ul class="nav pull-right">
            <li class=""><a href="../">Front end</a></li>
			<?php
			$y1 = new Yougapi_login();
			if($y1->isAdmin()) {
			?>
            	<li id="fat-menu" class="dropdown">
	            	<a href="#" id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown">Logged in as admin <b class="caret"></b></a>
	            	<ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
	                	<li role="presentation"><a role="menuitem" tabindex="-1" href="#" id="ygp_logout_btn">Logout</a></li>
	                </ul>
                </li>
            <?php
            }
            ?>
            </ul>
            
          </div>
	        
		</div>
	</div>
</div>

<br><br><br>