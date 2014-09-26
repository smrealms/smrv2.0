<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="UTF-8">
    <title>SMR Login</title>
    <style type="text/css">
		html {    
			background: #000000 url(images/rockbackground.jpg) no-repeat center center;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;     
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
		#wapper {
			width: 100%;
			height: 100%;
			position: relative;     
		}
		#header {
			padding-top: 10px;
			height: 20px;
		}
		#container {
			max-width: 1010px;
			min-width: 1002px;
			height: 90%;
			min-height: 800px;
			padding-bottom: 60px;
			margin: 0px auto 0px auto; 
		}
		#footer {
			width: 100%;
			position: absolute;
			bottom: 0px;
			height: 60px;
			font-size: 14px;
			text-align: center;
		}
		.overlap1 {
			position: absolute;
			top: 185px;
			margin-left: 10px;
			margin-right: auto;    
			z-index: 1;
		}
		.overlap2 {
			position: absolute;
			top: 208px;
			margin-left: 45px;
			margin-right: auto;    
			z-index: 1;
		}
		.overlap3 {
			position: absolute;
			top: 216px;
			margin-left: 80px;
			margin-right: auto;    
			z-index: 1;
		}
		.menu {
			margin-right: 40px;
		}
		.top {
			width: 1000px;
			height: 180px;
		}
		div.left {
			text-align: left;
			background: url(images/loginpanel.png) no-repeat;
			width: 280px;
			height: 292px;
			margin-top: 48px;
			margin-left: 6px;
			padding-left: 28px;
			float: left;
		}
		input.rounded {
			background : none;
			border : none;
			color: rgb(255, 255, 255);
			-moz-border-radius: 8px;
			-webkit-border-radius: 8px;
			border-radius: 8px;	
			font-size: 14px;
			padding: 4px 7px;
			outline: 0;
			-webkit-appearance: none;
		}
		div.center {
			text-align: center;
			background: url(images/centerpanel.png) no-repeat;
			width: 378px;
			height: 292px;
			margin-top: 48px;       
			float: left;         
		}
		div.center_content {
			width: 355px;
			height: 265px;
			padding: 10px;
			overflow: auto;
		}
		div.right {
			text-align: left;
			background: url(images/registerpanel.png) no-repeat;
			width: 309px;
			height: 374px;
			margin-top: 48px;
			margin-left: 0px;   
			float: left;    
		}
		.myCheckbox span {
			width: 26px;
			height: 28px;    
		}
		div.altlogin {
			position: absolute;
			top: 565px;
			margin-left: 10px;    
			background: url(images/alt_login.png) no-repeat;
			width: 290px;
			height: 80px;
		}
		img.google {
			margin-top: 25px;
			margin-left: -8px;
		}
		img.facebook {
			margin-top: 25px;
			margin-left: 13px;
		}
		img.twitter {
			margin-top: 25px;
			margin-left: 11px;
		}
		hr {    
			width: 20%
		}
		.clear {
			clear: both;
		}
		.cursor {
			cursor: pointer;
		}
		img {
			border-style: none;
		}
		.noWrap {
			white-space: nowrap;
		}
		a:link {
			text-decoration: none;
		}
		a:active {
			text-decoration: none;
		}
		a:visited { 
			text-decoration: none;
		}
		a:hover { 
			text-decoration: none;
		}
		/* ************ POP UP *********** */
		#popup {
			height: 100%;
			width: 100%;
			background: url(images/tranbg.png);
			position: absolute;
			top: 0px;
			left: 0px;    
			z-index: 3;
		}
		#window {
			color: rgb(255, 255, 255);
			width: 580px;
			height: 300px;
			margin: 0 auto;
			padding: 5px 10px 5px 10px;
			background: url(images/pop.png) no-repeat;    
			position: absolute;
			top: 200px;
			left: 25%;
			z-index: 4;
		}
		div#popUpL {
			width: 50%;
			text-align: left;
			float: left;
		}
		div#popUpR {
			width: 50%;
			text-align: right;
			float: left;
		}
		div#content {
			width: 100%;
		}
		.cursor {
			cursor: pointer;
		}
		/* ************ END ************** */
		.big {
			font-size: 1.25em;
		}
		.myCenter {
			text-align: center;
		}
		/* *********** Scrollbar ******* */
		::-webkit-scrollbar {  
			width:8px;
			height:8px;
			-webkit-border-radius: 6px;
		}
		::-webkit-scrollbar-track,
		::-webkit-scrollbar-track-piece {
			background-color:transparent;
		}
		::-webkit-scrollbar-thumb {  
			background-color: rgba(200,200,200,0.3);
			width: 6px;
			height: 6px;
			-webkit-border-radius:6px;
		}
	</style>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script type="text/javascript">
		jQuery(document).ready(function() {     
		jQuery('#register_button').click(function() {
			$('#popup').fadeIn('fast');
			$('#window').fadeIn('fast');        
			//Generates the captcha function    
			var a = Math.ceil(Math.random() * 9)+ '';
			var b = Math.ceil(Math.random() * 9)+ '';       
			var c = Math.ceil(Math.random() * 9)+ '';  
			var d = Math.ceil(Math.random() * 9)+ '';  
			var e = Math.ceil(Math.random() * 9)+ '';  
		  
			var code = a + b + c + d + e;
			document.getElementById("Numbers").value = code;
			document.getElementById("myNumbers").innerHTML = code;        
		});    
		jQuery('#Close').click(function() {
			$('#popup').fadeOut('fast');
			$('#window').fadeOut('fast');
		});    
		jQuery('#register_button').click(function() {        
			var n=document.forms["Rform"]["login"].value;
			var p=document.forms["Rform"]["password"].value;
			var e=document.forms["Rform"]["email"].value;        
			var check=document.forms["Rform"]["myCheck"].value;
			var atpos=e.indexOf("@");
			var dotpos=e.lastIndexOf(".");        
			if (n==null || n=="") {
				$('#message').html('You forgot to type a <span style="color: Red;">User Name!</span> <br />' + 
				'Please click the (Close X) on the upper right side and enter your User Name.');
				$('#Captcha').fadeOut('fast');
			} else if (p==null || p=="") {
				$('#message').html('You forgot to type a <span style="color: Red;">Password!</span> <br />' + 
				'Please click the (Close X) on the upper right side and enter your Password.'); 
				$('#Captcha').fadeOut('fast');       
			} else if (atpos<1 || dotpos<atpos+2 || dotpos+2>=e.length) {
				$('#message').html('You forgot to type your <span style="color: Red;">email</span> or you typed it wrong! <br />' + 
				'Please click the (Close X) on the upper right side and enter your email.');
				$('#Captcha').fadeOut('fast');               
			} else if (check=='unchecked' || check==null || check=="") {
				$('#message').html('You forgot to check the <span style="color: Red;">User Agreement box!</span> <br />' + 
				'Please click the (Close X) on the upper right side and check the User Agreement box!.');
				$('#Captcha').fadeOut('fast');   
			} else {
				$('#message').html('');
				$('#Captcha').fadeIn('fast');
			}
		});        
		jQuery('#myImage').click(function() {        
			if ($('#myImage').attr('src') == 'images/unchecked.png') {        
				$('#myImage').attr('src','images/checked.png');
				$('#myCheck').val('checked');
			} else {            
				$('#myImage').attr('src','images/unchecked.png');
				$('#myCheck').val('unchecked');            
			}        
		});
		jQuery('#testHuman').click(function() {
			var num1 = document.getElementById('Numbers').value;
			var num2 = document.getElementById('numberInput').value;
			if(num1 == num2) {
				document.forms["Rform"].submit();
			} else {
				$('#message').html('The numbers did not match! Please retype them and click submit again!'); 
			}
		});
	//******************New On 3/17/14***********************************
	var myTime;
	var images = new Array();
	jQuery('#snapClose').click(function() {
			clearTimeout(myTime);
			$('#popup').fadeOut('fast');
			$('#snapShot').fadeOut('fast');
		});

	jQuery('#snapImage').click(function() {	
		$('#popup').fadeIn('fast');
		$('#snapShot').fadeIn('fast');
		loadImages();	
	});
	function loadImages() {	 
				function preload() {
					for (i = 0; i < preload.arguments.length; i++) {
						images[i] = new Image()
						images[i].src = preload.arguments[i]
					}
				}
				preload(
					'images/race2.jpg',
					'images/race3.jpg',
					'images/race4.jpg',
					'images/race5.jpg',
					'images/race6.jpg',
					'images/race7.jpg',
					'images/race8.jpg',
					'images/race9.jpg'
				)
				canvasApp();
	}
	function canvasApp() {
		var theCanvas = document.getElementById('theCanvas');
			if(!theCanvas || !theCanvas.getContext) return;
			var ctx = theCanvas.getContext('2d'),
				smrImage = new Image(),
				num = 0,
				alpha = 0,
				fadeIn = true,
				loadImage = true,
				imageDelay = 0;        

		function drawScreen() {
			ctx.globalAlpha = 1.0;
			ctx.fillStyle = 'rgba(0, 0, 0, 1)';
			ctx.fillRect(0,0,theCanvas.width,theCanvas.height);
			ctx.clearRect(0,0,theCanvas.width,theCanvas.height);

			if(fadeIn) {
			  alpha += .03;
			  if(alpha >= 1) {
				alpha = 1;
				imageDelay++;
				if (imageDelay == 150) { 
					fadeIn = false;
					imageDelay = 0;
				}
			  }
			} else {
			  alpha -= .01;
			  if (alpha < 0) {
				alpha = 0;
				fadeIn = true;
				num++;
				loadImage = true;
			  }
			}
			if (num >= 8) num = 0;
			if (loadImage) {
				smrImage.src = images[num].src;
				smrImage.onload = function() {
					ctx.globalAlpha = alpha;
					ctx.drawImage(smrImage,160,60);
					loadImage = false;
				}
			} else {
				ctx.globalAlpha = alpha;
				ctx.drawImage(smrImage,160,60);
			}            
		}
		function mySRC(num) {
		  var myImagePath = 'images/race'+num+'.jpg';
		  return myImagePath;
		}
		function fadeImage() {
			drawScreen();
			myTime = window.setTimeout(fadeImage,20);
		  }
		  fadeImage();
	}
	//********************End New****************************************	
	});
	</script>   
</head>
<body>
    <div id="wapper">
        <div id="header"></div>
        <div id="container">
        <span class="top"><img alt="" src="images/head.jpg" /></span>
        <div class="overlap1"><img alt="" src="images/buckel.gif" /></div>
        <div class="overlap2"><img alt="" src="images/menubar.png" /></div>
        <div class="overlap3 noWrap">
            <a href="http://wiki.smrealms.de/index.php" target="_blank"><img class="menu" alt="" src="images/wiki.gif" /></a>
            <a href="http://smrcnn.smrealms.de/" target="_blank"><img class="menu" alt="" src="images/forums.gif" /></a>
            <a href="http://client01.chat.mibbit.com/?server=irc.coldfront.net&channel=%23smr" target="_blank"><img class="menu" alt="" src="images/irc.gif" /></a>
            <a href="" target="_blank"><img class="menu" alt="" src="images/contact.gif" /></a>
        </div>       
        <div class="left">            
            <form action="login_processing.php" method="post" style="margin-top:80px; margin-left:0px;">                
                <input type="text" class="rounded" size="30" maxlength="30" name="login" />
                <br /><br /><br /><br />
                <input type="password" class="rounded" size="30" maxlength="30" name="password" />
                <br /><br />
                <input id="login_submit" type="image" src="images/login_button.png" />
                <br /><br />
                <a href="reset_password.php"><img alt="Reset Password" src="images/reset_button.png" /></a>               
            </form>           
        </div>
        <div id="center22" class="center">
            <div class="center_content">
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
        <div class="right">
            <form id="Rform" action="login_create_processing.php" method="post" 
            style="margin-top:80px; margin-left:30px; margin-right:20px;">
                <div style="margin-left:20px;">                        
                <input type="text" class="rounded" size="30" maxlength="30" name="login" />
                <br /><br /><br /><br />
                <input type="password" class="rounded" size="30" maxlength="30" name="password" />
                <br /><br /><br />
                <input type="email" class="rounded" size="30" maxlength="30" name="email" />                
                </div>
                <br />
                <div style="margin-top:10px; margin-left:-4px;">
                    <label class="myCheckbox">
                    <input id="myCheck" type="hidden" name="myCheck" value="unchecked" />
                    <span><img id="myImage" src="images/unchecked.png" /></span>
                    </label>
                </div>
                <br /><br /><br />
              </form>  
                <div style="text-align:right; margin-top:-4px; margin-right:20px;">
                <input id="register_button" type="image" src="images/register_button.png" />
                </div>            
        </div>
        <div class="clear"></div>
        <div class="altlogin noWrap">
            <a href=""><img class="google" alt="" src="images/google.png" /></a>
            <a href=""><img class="facebook" alt="" src="images/facebook.png" /></a>
            <a href=""><img class="twitter" alt="" src="images/twitter.png" /></a>  
        </div>        
        <div id="popup" style="display: none;"></div>
             <div id="window" style="display: none;">
                <div id="popup_content">
                    <div id="popUpL"><h1>Form Validation</h1></div>
                    <div id="popUpR"><span id="Close" class="cursor big">Close  X</span></div>
                    <div class="clear"></div>
                    <br />
                    <div id="content">
                    <label id="message" for="message" style="font-size: 14px; color: White;"></label>
                    <div id="Captcha" style="display: none;">
                        <label for="code">Please type these numbers below >
                        <span id="myNumbers" style="color:#F00; font-size:18px;"></span> 
                        <input type="hidden" id="Numbers" /></label><br />
                        <input type="text" name="numberInput" id="numberInput" size="30" />
                        <br /><br />
                        <input id="testHuman" type="button" value="Submit" />
                    </div>                                
                    </div>
                 </div>
             </div>          
        </div> 
            <div id="footer">
              <a href="https://www.google.com/intl/en/chrome/browser/"><img alt="" src="images/Google_Chrome_icon.png" /></a>
              <br />
             This web page is best viewed with Google Chrome. Download it for free. 
             </div>
    </div>   
</body>
</html>
