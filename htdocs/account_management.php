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

<!DOCTYPE html>

<html>
<head>
	<link rel="stylesheet" type="text/css" href="<?php echo DEFAULT_CSS; ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo DEFAULT_CSS_COLOUR; ?>">
	<style>.recaptchatable #recaptcha_response_field {background:white; color: black;}</style>
	<title>Space Merchant Realms</title>
</head>


<div id="buttons" align="center">
	<input type="button" onclick="return toggleVisibility('create_login')" value="Registration" style="width:150px; height:50px;"><br> 
	<input type="button" onclick="return toggleVisibility('reset_password')" value="Reset Password" style="width:150px; height:50px;"><br>
	<input type="button" onclick="return toggleVisibility('login')" value="Login" style="width:150px; height:50px;"><br>
</div>


<div id="create_login" style="width:500px; display:none;">
	<?php require("/login_create2.php"); ?>
</div>

<div id="reset_password" style="width:500px; display:none;">
	<?php require("/reset_password2.php"); ?>
</div>

<div id="login" style="width:500px; display:none;">
	<?php require("/login2.php"); ?>
</div>

</html>
