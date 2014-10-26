<?php
require_once('config.inc');
require_once(LIB.'External/recaptcha/recaptchalib.php');
	require_once(LIB . 'Default/SmrMySqlDatabase.class.inc');
	//require_once(get_file_loc('SmrSession.class.inc'));
	//require_once(get_file_loc('SmrAccount.class.inc'));
?>

<script type="text/javascript">
function toggleVisibility(a){
    var e = document.getElementById(a);
    if(!e) return true;
    if(e.style.display == "none") {
        e.style.display = "block";
		var buttons = document.getElementById('buttons');
		buttons.style.display = "none";
    } else {
        e.style.display = "none";
		var buttons = document.getElementById('buttons');
		buttons.style.display = "block";
    }
    return true;
}
</script>

<div id="buttons" align="center">
	<input type="button" onclick="toggleVisibility('create_login');" value="Registration" style="width:150px; height:50px; background-color:#475486;" /><br> 
	<input type="button" onclick="toggleVisibility('reset_password');" value="Reset Password" style="width:150px; height:50px; background-color:#475486;" /><br>
	<input type="button" onclick="toggleVisibility('login');" value="Login" style="width:150px; height:50px; background-color:#475486;" /><br>
</div>

<div id="create_login" style="width:100%; display:none;">
	<?php include(getcwd() . "/login_create2.php"); ?>
</div>

<div id="reset_password" style="width:100%; display:none;">
	<?php include(getcwd() . "/reset_password2.php"); ?>
</div>

<div id="login" style="width:100%; display:none;">
	<?php include(getcwd() . "/login2.php"); ?>
</div>
