
<table cellspacing='0' cellpadding='0' border='0' width='100%' height='100%'>
<tr>
	<td></td>
	<td colspan='3' height='1'></td>
	<td></td>
</tr>
<tr>
	<td width='1'>&nbsp;</td>
	<td width='1'></td>
	<td align='left' valign='top' width='100%'>
		<table width='100%' height='100%' border='0' cellspacing='3' cellpadding='3'>
		<tr>
			<td valign='top'>

				<h1>Registration Form</h1>

				<form action='login_create_processing2.php' method='POST'>
					<table border='0' cellspacing='0' cellpadding='1'>
					<tr>
						<td width='40%'>User Name:</td>
						<td width='60%'><input type='text' name='login' size='20' maxlength='32' id='InputFields' /></td>
					</tr>
					<tr>
						<td width='40%' >First Name:</td>
						<td width='60%'><input type='text' name='first_name' size='20' maxlength='50' id='InputFields' /></td>
					</tr>
					<tr>
						<td width='40%'>Last Name:</td>
						<td width='60%'><input type='text' name='last_name' size='20' maxlength='50' id='InputFields' /></td>
					</tr>
					<tr>
						<td width='40%'>Password:</td>
						<td width='60%'><input type='password' name='password' size='20' maxlength='32' id='InputFields' /></td>
					</tr>
					<tr>
						<td width='40%'>Verify:</td>
						<td width='60%'><input type='password' name='pass_verify' size='20' maxlength='32' id='InputFields' /></td>
					</tr>
					<tr>
						<td width='27%'>E-Mail Address:</td>
						<td width='73%'><input type='email' name='email' size='20' maxlength='128' id='InputFields' /></td>
					</tr>
					<tr>
						<td width='27%'>Verify Address:</td>
						<td width='73%'><input type='email' name='email_verify' size='20' maxlength='128' id='InputFields' /></td>
					</tr>
					<tr style="display:none">
						<td width='27%'>Local Time:</td>
						<td width='73%'>
							<select name="timez" id="InputFields"><?php
								$time = TIME;
								for ($i = -12; $i<= 11; $i++) {
									?><option value="<?php echo $i; ?>"><?php echo date(DEFAULT_DATE_TIME_SHORT, $time + $i * 3600); ?></option><?php
								} ?>
							</select>
						</td>
					</tr>
					<tr style="display:none">
						<td width='27%'>Referral ID (Optional):</td>
						<td width='73%'><input type='text' name='referral_id' size='10' maxlength='20' id='InputFields'<?php if(isset($_REQUEST['ref'])){ echo 'value="'.htmlspecialchars($_REQUEST['ref']).'"'; }?> /></td>
					</tr>
					<tr style="display:none">
						<td colspan='2'>&nbsp;</td>
					</tr>
					<tr style="display:none">
						<th colspan='2'>User Information (Address Optional)</th>
					</tr>
					<tr style="display:none">
						<td colspan='2'>&nbsp;</td>
					</tr>
					<tr style="display:none">
						<td width='27%'>Address:</td>
						<td width='73%'><input type='text' name='address' size='50' maxlength='255' id='InputFields' /></td>
					</tr>
					<tr style="display:none">
						<td width='27%'>City:</td>
						<td width='73%'><input type='text' name='city' size='20' maxlength='50' id='InputFields' /></td>
					</tr>
					<tr style="display:none">
						<td width='27%'>Postal Code:</td>
						<td width='73%'><input type='text' name='postal_code' size='20' maxlength='10' id='InputFields' /></td>
					</tr>
					<tr style="display:none">
						<td width='27%'>Country:</td>
						<td width='73%'>
							<select name='country_code' id='InputFields'>
								<option value='US' selected="selected">United States</option>
								<option value='UK'>United Kingdom</option>
								<option value='DE'>Germany</option>
								<option value='CA'>Canada</option>
								<option value='FR'>France</option>
							</select>
						</td>
					</tr>
					<tr style="display:none">
						<td width='27%'>ICQ:</td>
						<td width='73%'><input type='text' name='icq' size='20' maxlength='15' id='InputFields' /></td>
					</tr>
					<tr>
						<td colspan='2'>&nbsp;</td>
					</tr>
					</table>

					

					<label style='font-size:80%;' for='agreement'>
						<input id='cb_agree' type='checkbox' name='agreement' value='checkbox' />I have read and accepted the User Agreement above, made sure all informationsubmitted is correct, and understand that my account can be closed or deleted with no warning should it contain invalid or false information. *** Any personal information is confidential and will not be sold to third parties. ***<br />
					</label>
					
					
					<p><input type="button" onclick="return toggleVisibility('create_login')" value="Back"/>
					<input type='submit' name='create_login' value='Create Login'/></p>
				</form>

			</td>
		</tr>
		</table>
	</td>
	<td width='1' bgcolor='#0F1541'></td>
	<td width='1'>&nbsp;</td>
</tr>
<tr>
	<td></td>
	<td colspan='3' height='1' bgcolor='#0F1541'></td>
	<td></td>
</tr>
</table>
