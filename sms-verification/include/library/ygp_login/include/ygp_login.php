<?php

class Yougapi_login
{
	var $path;
	
	function __construct($criteria=array()) {
		$this->path = $criteria['path'];
	}
	
	function isAdmin() {
		if($this->session_is_live()) {
			$data = $this->get_session();
			if($data['login']==$GLOBALS['admin_username']) return true;
			else return false;
		}
		else return false;
	}
	
	function session_is_live() {
		if(@$_SESSION['session']['login']!='') return true;
		else return false;
	}
	
	function get_session() {
		return $_SESSION['session'];
	}
	
	function start_session($criteria=array()) {
		$_SESSION['session'] = $criteria;
	}
	
	function kill_session() {
		unset($_SESSION['session']);
	}
	
	function require_login($criteria=array()) {
		$redirect = $criteria['redirect'];
		if(!$this->session_is_live()) header('Location: '.$redirect);
	}
	
	function add_js() {
		echo '<script>var Yougapi_login = {"path":"'.$this->path.'"}</script>';
		echo '<script type="text/javascript" src="'.$this->path.'script.js"></script>';
	}
	
	function displayLoginForm($criteria=array()) {
		$username = $criteria['username'];
		$password = $criteria['password'];
		?>
		<form id="ygp_login_form" name="ygp_login_form" class="form-stacked">
			<div id="ygp_login_notification"></div>
			<p><label>Username</label><input type="text" id="login" name="login" value="<?php echo $username; ?>"></p>
			<p><label>Password</label><input type="password" id="password" name="password" value="<?php echo $password; ?>"></p>
			<p><input type="submit" value="Login" id="ygp_login_btn" class="btn default"></p>
		</form>
		<?php
	}
}

?>