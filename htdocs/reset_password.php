
<table cellspacing="0" cellpadding="0" border="0" width="100%" height="100%">
	<tr>
		<td></td>
		<td colspan="3" height="1" bgcolor="#0F1541"></td>
		<td></td>
	</tr>
	<tr>
		<td align="left" valign="top" width="500">
			<table width="100%" height="100%" border="0" cellspacing="5" cellpadding="5">
			<tr>
				<td valign="top">
					For security reasons, please enter your username and the password reset code you requested:

					<form action="reset_password_processing2.php" method="POST">
						<div align="center">
								<table border="0">
									<tr>
											<th align="right">Username:</th>
											<td><input name="login" type="text" id="InputFields" value="<?php echo isset($_REQUEST['login']) ? htmlspecialchars($_REQUEST['login']) : ''; ?>" /></td>
									</tr>
									<tr>
											<th align="right">Old Password:</th>
											<td><input name="old_password" type="password" id="InputFields" /></td>
									</tr>
											<th align="right">New Password:</th>
											<td><input name="password" type="password" id="InputFields" /></td>
									</tr>
									<tr>
											<th align="right">Confirm Password:</th>
											<td><input name="pass_verify" type="password" id="InputFields" /></td>
									</tr>
								</table>
									<input type="submit" value="Reset my password" id="InputFields" /></p>
						</div>
					</form>
				</td>
			</tr>
			</table>
		</td>
		<td width="1" bgcolor="#0F1541"></td>
		<td width="1">&nbsp;</td>
	</tr>
	<tr>
		<td></td>
		<td colspan="3" height="1" bgcolor="#0F1541"></td>
		<td></td>
	</tr>
	</table>
