<?php
require_once('config.inc');
require_once(LIB.'External/recaptcha/recaptchalib.php');
	require_once(LIB . 'Default/SmrMySqlDatabase.class.inc');
	//require_once(get_file_loc('SmrSession.class.inc'));
	//require_once(get_file_loc('SmrAccount.class.inc'));
?>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type="text/javascript">
function toggleVisibility(a){
	$('.hider').each(function() { if (this.id != a) {$(this).slideUp(100, 'linear');}});
	$('#'+a).slideDown(100);
    return true;
}
</script>

<div id="buttons" align="center">
	<button id="login_button" onclick="toggleVisibility('login');" style="width:100%; height:50px;color:white;background: 0;border: 0;cursor:pointer;"><h2>Login</h2></button><br>
	<div class="hider" id="login" style="width:100%;">
	<?php include('login_side.php'); ?>
	</div>
	<button id="create_login_button" onclick="toggleVisibility('create_login');" style="width:100%; height:50px;color:white;background: 0;border: 0;cursor:pointer;"><h2>Registration</h2></button><br> 
	<div class="hider" id="create_login" style="width:100%;">
		<?php include('login_create.php'); ?>
	</div>
	<button id="reset_password_button" onclick="toggleVisibility('reset_password');" style="width:100%; height:50px;color:white;background: 0;border: 0;cursor:pointer;"><h2>Reset Password</h2></button><br>
	<div class="hider" id="reset_password" style="width:100%;">
		<?php include('reset_password.php'); ?>
	</div>

</div>
<script>
$('.hider').hide();
</script>
