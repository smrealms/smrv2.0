<?php
$GalaxyMap = isset($GalaxyMap)&&$GalaxyMap;
$UniGen = isset($UniGen) ? $UniGen : false;
$MapPlayer = $UniGen ? null : $ThisPlayer;
$MovementTypes = array('Up','Left','Right','Down');
$isCombinedSector = true;
$dist = 2;
$span = 1 + ($dist * 2);

$topLeft =& $ThisSector;
$galaxy =& $ThisSector->getGalaxy();

$template->assign('GalaxyName',$galaxy->getName());

//figure out what should be the top left and bottom right
//go left then up
for ($i=0;$i<$dist&&$i<(int)($galaxy->getWidth()/2);$i++)
	$topLeft =& $topLeft->getNeighbourSector('Left');
for ($i=0;$i<$dist&&$i<(int)($galaxy->getHeight()/2);$i++)
	$topLeft =& $topLeft->getNeighbourSector('Up');

$MapSectors = array();
$leftMostSec =& $topLeft;
for ($i=0;$i<$span&&$i<$galaxy->getHeight();$i++) {
	$MapSectors[$i] = array();
	//new row
	if ($i!=0) $leftMostSec =& $leftMostSec->getNeighbourSector('Down');
	
	//get left most sector for this row
	$thisSec =& $leftMostSec;
	//iterate through the columns
	for ($j=0;$j<$span&&$j<$galaxy->getWidth();$j++) {
		//new sector
		if ($j!=0) $thisSec =& $thisSec->getNeighbourSector('Right');
		$MapSectors[$i][$j] =& $thisSec;
	}
}
$return = array();
foreach($MapSectors as &$MapRow) {
	$row = array();
	foreach($MapRow as &$Sector) {
		$sector = array();
		$sector['id'] = $Sector->getSectorID();
		if ($Sector->hasPlanet()) {
			$sector['planet'] = 'TRUE';
		}
		
		$row[] = $sector;
	}
	$return[] = $row;
}
echo json_encode($return);
?>
