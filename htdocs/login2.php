	<h1>Login</h1>
	<form action="login_processing2.php" method="post">
	<table width='100%' height='100%' border='0' cellspacing='1' cellpadding='1'>
		<tr>
			<td>User Name:</td>
			<td><input type="text" class="rounded" size="20" maxlength="30" name="login"/></td>
		</tr>
		<tr>
			<td>Password:</td>
			<td><input type="password" class="rounded" size="20" maxlength="30" name="password"/></td>
		</tr>
			<td colspan="2">
				<p>
					<input type="button" onclick="return toggleVisibility('login')" value="Cancel" style="display: inline-block;"/>
					<input id="login_submit" name="login_submit" type="submit" value="Submit" style="display: inline-block;"/>
				</p>
			</td>
		</tr>
	</table>
	</form>
	
