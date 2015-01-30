<?php
try {
	require_once('config.inc');
	
	
	if (get_magic_quotes_gpc()) {
	    function stripslashes_array($array)
	    {
	        return is_array($array) ? array_map('stripslashes_array', $array) : stripslashes($array);
	    }
	
	    $_COOKIE = stripslashes_array($_COOKIE);
	    $_FILES = stripslashes_array($_FILES);
	    $_GET = stripslashes_array($_GET);
	    $_POST = stripslashes_array($_POST);
	    $_REQUEST = stripslashes_array($_REQUEST);
	}
	
	header('Cache-Control: no-cache, must-revalidate');
	//A date in the past
	header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');

	// ********************************
	// *
	// * I n c l u d e s   h e r e
	// *
	// ********************************
	
	// We want these to be already defined as globals
	$player=null;
	$ship=null;
	$sector=null;
	$container=null;
	$var=null;
	$lock=false;
	
	// overwrite database class to use our db
	require_once(LIB . 'Default/SmrMySqlDatabase.class.inc');
	require_once(LIB . 'Default/Globals.class.inc');
	
	require_once(get_file_loc('smr.inc'));
	
	// new db object
	$db = new SmrMySqlDatabase();
	
	// ********************************
	// *
	// * c h e c k   S e s s i o n
	// *
	// ********************************
	
	// do we have a session?
	if (SmrSession::$account_id == 0) {
		echo null;
		exit;
	}
  
	//this is where we decide what type of request it is
	//then we gather or necessary variables and call the proper encoder
	if ($_REQUEST['action'] == 'get_local') {
		$ThisPlayer =& SmrPlayer::getPlayer(SmrSession::$account_id, SmrSession::$game_id);
		$ThisSector =& $ThisPlayer->getSector(); 
		$ThisShip	=& $ThisPlayer->getShip();
		require_once('../javix/get_local.inc');
	}

}
catch(Exception $e) {
	handleException($e);
}
?>
