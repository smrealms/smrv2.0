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

?>