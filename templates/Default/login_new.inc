<!DOCTYPE html>

<html lang="en">
<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="UTF-8">
    <title>SMR Login</title>
    <style type="text/css">
		html {    
			background: #000000 url(images/login_new/blueplanet1.jpg) no-repeat center center;
			background-size: 100% auto;  
		}
		html, body {   
			font-family: Arial, sans-serif;
			font-size: 12px;
			color: rgb(255, 255, 255);
			text-align: center;
			width:  100%;
			height: 100%;
			min-height: 860px;
			margin: 0px;
			padding: 0px;   
		}
		img {
			margin: 0;
			padding: 0;
		}
		#wrapper {
			width: 1010px;
			margin-left: auto;
			margin-right: auto;
		}
		#banner {
			padding: 0;
			margin: 0;
			border: 2px solid #4C93E0;
			border-radius: 5px;
			text-align: right;
			vertical-align: bottom;
			line-height: 172px;
			width: 100%
			height: 172px;
			background: #000000 url(images/login_new/head.jpg) no-repeat center center;
			background-size: 100% auto; 
			display: block;
		}
		#banner_text {
			vertical-align: bottom;
		}
		#menu {
			padding: 0;
			margin: 0;
			margin-top: 10px;
			padding-top: 7px;
			border: 2px solid #4C93E0;
			border-radius: 5px;
			width: 100%;
			height: 32px;
			display: block;
			background-color: rgba(58,112,173,0.4);
		}
		#menu img {
			margin-left: 5px;
			margin-right: 5px;
		}
		#footer {
			width: 100%;
			position: absolute;
			bottom: 0px;
			height: 60px;
			font-size: 14px;
			text-align: center;
		}
		#content {
			padding: 0;
			margin: 0;
			margin-top: 10px;
			width: 1001px;
			clear: both;
		}
		#left {
			padding: 0;
			margin: 0;
			margin-top: 10px;
			border: 2px solid #4C93E0;
			border-radius: 5px;
			width: 300px;
			background-color: rgba(58,112,173,0.4);
			display: inline-block;
		}
		#right {
			padding: 0;
			margin: 0;
			margin-top: 10px;
			border: 2px solid #4C93E0;
			border-radius: 5px;
			width: 690px;
			background-color: rgba(58,112,173,0.4);
			display: inline-block;
			float: right;
		}
	</style>
</head>
<body>

<div id="wrapper">
	<div id="banner">
		<span id="banner_text">&nbsp</span>
	</div>
	<div id="menu">
		<a href="http://wiki.smrealms.de/index.php" target="_blank"><img class="menu" alt="" src="images/login_new/wiki.gif" /></a>
		<a href="http://smrcnn.smrealms.de/" target="_blank"><img class="menu" alt="" src="images/login_new/forums.gif" /></a>
		<a href="http://client01.chat.mibbit.com/?server=irc.coldfront.net&channel=%23smr" target="_blank"><img class="menu" alt="" src="images/login_new/irc.gif" /></a>
		<a href="" target="_blank"><img class="menu" alt="" src="images/login_new/contact.gif" /></a>
		<img id="snapImage" type="image" class="menu cursor" alt="" src="images/login_new/shots.gif" />
	</div>
	
	<div id="content">
		<div id="left">
			<?php include(getcwd() . "\account_management.php");  ?>
		</div>
		
		<div id="right">
			<span style="font-size:18px; font-weight:bold;">News</span>
			<br /><br /><hr />                      
			<span>3/12/2011</span>
			<br />            
			<span>There are now hotkeys for movement and scanning, as well as for 
				switch between Current Sector, Local Map and Plot Course. Default bindings can be 
				found under Preferences, where you can also able to customise them.
			</span>                
			<br /><br /><hr />            
			<span>2/12/2011</span>
			<br />
			<span>There are now hotkeys for movement and scanning, as well as for 
				switch between Current Sector, Local Map and Plot Course. Default bindings can be 
				found under Preferences, where you can also able to customise them.            
			</span>                
			<br /><br /><hr />                           
			<span>12/27/2012</span>
			<br />
			<span>This is Freon22 testing to see what will happen in this div when the text 
				over flows??????
			</span>
		</div>
	</div>

</div>
<div id="footer">
	<a href="https://www.google.com/intl/en/chrome/browser/"><img alt="" src="images/login_new/Google_Chrome_icon.png" /></a>
	<br>
	This web page is best viewed with Google Chrome. Download it for free. 
</div>
</body>
</html>