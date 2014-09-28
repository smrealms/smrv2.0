<?php
////////////////////////////////////////////////////////////
//
//	Script:		map_combined.php
//	Purpose:	Displays Local Map and Current sector info (for ver 2.0)
//
////////////////////////////////////////////////////////////

if($player->isLandedOnPlanet())
	create_error('You are on a planet!');

$template->assign('SpaceView',true);
$template->assign('isCombinedSector',true);
$sector =& $player->getSector();
$template->assignByRef('ThisSector',$sector);

$zoomOn = false;
if(isset($var['Dir'])) {
	$zoomOn = true;
	if ($var['Dir'] == 'Up') {
		$player->decreaseZoom(1);
	}
	elseif ($var['Dir'] == 'Down') {
		$player->increaseZoom(1);
	}
}
$dist = 3;

$template->assign('isZoomOn',$zoomOn);

$container = array();
$container['url'] = 'skeleton.php';
$container['body'] = 'combined_map.php';
$span = 1 + ($dist * 2);

$topLeft =& $player->getSector();
$galaxy =& $topLeft->getGalaxy();

$template->assign('GalaxyName',$galaxy->getName());

//figure out what should be the top left and bottom right
//go left then up
for ($i=0;$i<$dist&&$i<(int)($galaxy->getWidth()/2);$i++)
	$topLeft =& $topLeft->getNeighbourSector('Left');
for ($i=0;$i<$dist&&$i<(int)($galaxy->getHeight()/2);$i++)
	$topLeft =& $topLeft->getNeighbourSector('Up');

$mapSectors = array();
$leftMostSec =& $topLeft;
for ($i=0;$i<$span&&$i<$galaxy->getHeight();$i++) {
	$mapSectors[$i] = array();
	//new row
	if ($i!=0) $leftMostSec =& $leftMostSec->getNeighbourSector('Down');
	
	//get left most sector for this row
	$thisSec =& $leftMostSec;
	//iterate through the columns
	for ($j=0;$j<$span&&$j<$galaxy->getWidth();$j++) {
		//new sector
		if ($j!=0) $thisSec =& $thisSec->getNeighbourSector('Right');
		$mapSectors[$i][$j] =& $thisSec;
	}
}
$template->assignByRef('MapSectors',$mapSectors);


// *******************************************
// *
// * Sector List
// *
// *******************************************

doTickerAssigns($template, $player, $db);

if(!isset($var['UnreadMissions'])) {
	$unreadMissions = $player->markMissionsRead();
	SmrSession::updateVar('UnreadMissions', $unreadMissions);
}
$template->assign('UnreadMissions', $var['UnreadMissions']);

// *******************************************
// *
// * Force and other Results
// *
// *******************************************
$turnsMessage = '';
switch($player->getTurnsLevel()) {
	case 'NONE':
		$turnsMessage = '<span class="red">WARNING</span>: You have run out of turns!';
	break;
	case 'LOW':
		$turnsMessage = '<span class="red">WARNING</span>: You are almost out of turns!';
	break;
	case 'MEDIUM':
		$turnsMessage = '<span class="yellow">WARNING</span>: You are running out of turns!';
	break;
}

$template->assign('TurnsMessage',$turnsMessage);

$protectionMessage = '';
if ($player->getNewbieTurns()) {
	if ($player->getNewbieTurns() < 25) {
		$protectionMessage = '<span class="blue">PROTECTION</span>: You are almost out of <span class="green">NEWBIE</span> protection.';
	}
	else
		$protectionMessage = '<span class="blue">PROTECTION</span>: You are under <span class="green">NEWBIE</span> protection.';
}
elseif ($player->hasFederalProtection()) {
	$protectionMessage = '<span class="blue">PROTECTION</span>: You are under <span class="blue">FEDERAL</span> protection.';
}
elseif($sector->offersFederalProtection())
	$protectionMessage = '<span class="blue">PROTECTION</span>: You are <span class="red">NOT</span> under protection.';

if(!empty($protectionMessage))
	$template->assign('ProtectionMessage',$protectionMessage);

//enableProtectionDependantRefresh($template,$player);

$db->query('SELECT * FROM sector_message WHERE account_id = ' . $db->escapeNumber($player->getAccountID()) . ' AND game_id = ' . $db->escapeNumber($player->getGameID()));
if ($db->nextRecord()) {
	$msg = $db->getField('message');
	$db->query('DELETE FROM sector_message WHERE account_id = ' . $db->escapeNumber($player->getAccountID()) . ' AND game_id = ' . $db->escapeNumber($player->getGameID()));
	checkForForceRefreshMessage($msg);
	checkForAttackMessage($msg);
}
if (isset($var['AttackMessage'])) {
	$msg = $var['AttackMessage'];
	checkForAttackMessage($msg);
}
if (isset($var['MissionMessage'])) {
	$template->assign('MissionMessage', $var['MissionMessage']);
}
if (isset($var['msg'])) {
	checkForForceRefreshMessage($var['msg']);
	$template->assign('VarMessage', bbifyMessage($var['msg']));
}

//error msgs take precedence
if (isset($var['errorMsg'])) $template->assign('ErrorMessage', $var['errorMsg']);

// *******************************************
// *
// * Trade Result
// *
// *******************************************

//You have sold 300 units of Luxury Items for 1738500 credits. For your excellent trading skills you receive 220 experience points!
if (!empty($var['traded_xp']) ||
	!empty($var['traded_amount']) ||
	!empty($var['traded_good']) ||
	!empty($var['traded_credits'])) {

	$tradeMessage = 'You have just ' . $var['traded_transaction'] . ' <span class="yellow">' .
		$var['traded_amount'] . '</span> units of <span class="yellow">' . $var['traded_good'] .
		'</span> for <span class="creds">' . $var['traded_credits'] . '</span> credits.<br />';

	if ($var['traded_xp'] > 0) {
		$tradeMessage .= 'Your excellent trading skills have gained you <span class="exp">' . $var['traded_xp'] . ' </span> experience points!<br />';
	}

	$tradeMessage .= '<br />';

	$template->assign('TradeMessage',$tradeMessage);
}


// *******************************************
// *
// * Ports
// *
// *******************************************

if($sector->hasPort()) {
	$port =& $sector->getPort();
	$template->assign('PortIsAtWar',$player->getRelation($port->getRaceID()) < -300);
}

function checkForForceRefreshMessage(&$msg) {
	global $db,$player,$template;
	$contains = 0;
	$msg = str_replace('[Force Check]','',$msg,$contains);
	if($contains>0) {
		if(!$template->hasTemplateVar('ForceRefreshMessage')) {
			$forceRefreshMessage ='';
			$db->query('SELECT refresh_at FROM sector_has_forces WHERE refresh_at >= ' . $db->escapeNumber(TIME) . ' AND sector_id = ' . $db->escapeNumber($player->getSectorID()) . ' AND game_id = ' . $db->escapeNumber($player->getGameID()) . ' AND refresher = ' . $db->escapeNumber($player->getAccountID()) . ' ORDER BY refresh_at DESC LIMIT 1');
			if ($db->nextRecord()) {
				$remainingTime = $db->getField('refresh_at') - TIME;
				$forceRefreshMessage = '<span class="green">REFRESH</span>: All forces will be refreshed in '.$remainingTime.' seconds.';
				$db->query('REPLACE INTO sector_message (game_id, account_id, message) VALUES (' . $db->escapeNumber($player->getGameID()) . ', ' . $db->escapeNumber($player->getAccountID()) . ', \'[Force Check]\')');
			}
			else $forceRefreshMessage = '<span class="green">REFRESH</span>: All forces have finished refreshing.';
			$template->assign('ForceRefreshMessage',$forceRefreshMessage);
		}
	}
}

function checkForAttackMessage(&$msg) {
	global $db,$player,$template;
	$contains = 0;
	$msg = str_replace('[ATTACK_RESULTS]','',$msg,$contains);
	if($contains>0) {
		SmrSession::updateVar('AttackMessage','[ATTACK_RESULTS]'.$msg);
		if(!$template->hasTemplateVar('AttackResults')) {
			$db->query('SELECT sector_id,result,type FROM combat_logs WHERE log_id=' . $db->escapeNumber($msg) . ' LIMIT 1');
			if($db->nextRecord()) {
				if($player->getSectorID()==$db->getField('sector_id')) {
					$results = unserialize(gzuncompress($db->getField('result')));
					$template->assign('AttackResultsType',$db->getField('type'));
					$template->assignByRef('AttackResults',$results);
				}
			}
		}
	}
}
?>