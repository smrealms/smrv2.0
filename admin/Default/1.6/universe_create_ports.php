<?php
require_once(get_file_loc('SmrGalaxy.class.inc'));

if (isset($var['gal_on'])) $gal_on = $var['gal_on'];
else $PHP_OUTPUT.= 'Gal_on not found!!';

$galaxy =& SmrGalaxy::getGalaxy($var['game_id'],$var['gal_on']);
$galSectors =& $galaxy->getSectors();
//get totals
$total = array();
$totalPorts = array();
$totalMines = array();
$total['Ports'] = 0;
$total['Mines'] = 0;
for ($i=1;$i<=9;$i++) {
	$totalPorts[$i] = 0;
}
for ($i=1;$i<=20;$i++) {
	$totalMines[$i] = 0;
}
foreach ($galSectors as &$galSector) {
	if($galSector->hasPort()) {
		$totalPorts[$galSector->getPort()->getLevel()]++;
		$total['Ports']++;
	}
	if($galSector->hasMine()) {
		$totalMines[$galSector->getMine()->getLevel()]++;
		$total['Mines']++;
	}
}

//universe_create_ports.php
//get totals
$container = $var;
$container['url'] = '1.6/universe_create_save_processing.php';
$container['body'] = '1.6/universe_create_sectors.php';

$PHP_OUTPUT.= create_echo_form($container);
$PHP_OUTPUT.= 'Working on Galaxy : ' . $galaxy->getName() . ' (' . $galaxy->getGalaxyID() . ')<br />';
$PHP_OUTPUT.= '<table width="100%"><tr><th>Ports</th><th>Port Races</th><th>Starting Mines</th></tr><tr><td class="center">';
$PHP_OUTPUT.= '<table class="standard">';
for ($i=1;$i<=9;$i++) {
	$PHP_OUTPUT.= '<tr><td class="right">Level ' . $i . ' Ports</td><td>';
	$PHP_OUTPUT.= '<input type="number" value="';
	$PHP_OUTPUT.= $totalPorts[$i];
	$PHP_OUTPUT.= '" size="5" name="port' . $i . '" onFocus="startCalc();" onBlur="stopCalc();"></td></tr>';
}
$PHP_OUTPUT.= '<tr><td type="number" class="right">Total Ports</td><td><input type="number" size="5" name="total" value="';
$PHP_OUTPUT.= $total['Ports'];
$PHP_OUTPUT.= '"></td></tr>';
$PHP_OUTPUT.= '</table>';
$PHP_OUTPUT.= '</td><td class="center">';
$PHP_OUTPUT.= '<table class="standard"><tr><th colspan="2">Port Race % Distribution</th></tr>';

$races =& Globals::getRaces();
foreach ($races as &$race) {
	$PHP_OUTPUT.= '<tr><td class="right">' . $race['Race Name'] . '</td><td><input type="number" size="5" name="race' . $race['Race ID'] . '" value="0" onFocus="startRaceCalc();" onBlur="stopRaceCalc();"></td></tr>';
}
$PHP_OUTPUT.= '<tr><td class="right">Total</td><td><input type="number" size="5" name="racedist" value="0"></td></tr>';
$PHP_OUTPUT.= '<tr><td class="center" colspan="2">';
$PHP_OUTPUT.= '<div class="buttonA"><a class="buttonA" onClick="setEven();">&nbsp;Set All Equal&nbsp;</a></div></td></tr>';
$PHP_OUTPUT.= '</table>';
$PHP_OUTPUT.= '</td><td class="center"><table class="standard">';
for ($i=1;$i<=20;$i++) {
	$PHP_OUTPUT.= '<tr><td class="right">Level ' . $i . ' Mines</td><td>';
	$PHP_OUTPUT.= '<input type="number" value="';
	$PHP_OUTPUT.= $totalMines[$i];
	$PHP_OUTPUT.= '" size="5" name="mine' . $i . '" onFocus="startCalcM();" onBlur="stopCalcM();"></td></tr>';
}
$PHP_OUTPUT.= '<tr><td class="right">Total Mines</td><td><input type="number" size="5" name="totalM" value="';
$PHP_OUTPUT.= $total['Mines'];
$PHP_OUTPUT.= '"></td></tr>';
$PHP_OUTPUT.= '</table></td></tr>';

$PHP_OUTPUT.= '<tr><td colspan="3" class="center"><input type="submit" name="submit" value="Create Ports and Mines">';
$PHP_OUTPUT.= '<br /><br /><input type="submit" name="submit" value="Cancel"></td></tr></table>';

$PHP_OUTPUT.= '</form>';

$PHP_OUTPUT.= '<div class="center"><span class="small">Note: When you press "Create Ports and Mines" this will rearrange all current ports and mines.<br />';
$PHP_OUTPUT.= 'To add new ports and mines without rearranging everything use the edit sector feature.</span> <br /><br />';

$uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
$actual_link = 'http://' . $_SERVER['HTTP_HOST'] . $uri_parts[0] . '?sn=' . $_GET['sn'];

$PHP_OUTPUT.= "Create, edit and remove ports individually. <br /> <a href='$actual_link&create=create' class='buttonA'> Create New Port </a> </div><br /> <br />";



if (isset($_GET['create'])) {
	$uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
	$actual_link = 'http://' . $_SERVER['HTTP_HOST'] . $uri_parts[0] . '?sn=' . $_GET['sn'];

	$PHP_OUTPUT.= "<form action='$actual_link&save=create' method='POST'>";
	$PHP_OUTPUT.= '<table class="standard">';
	$PHP_OUTPUT.= "<tr> <th>  </th>";
	$PHP_OUTPUT.= "<th> Sector </th>";
	$PHP_OUTPUT.= "<th> Level </th>";
	$PHP_OUTPUT.= "<th> Race </th>";
	$PHP_OUTPUT.= '<th>  </th> </tr>';
	
	$additem=1;

	$PHP_OUTPUT.= "<tr> <td> <a href='" . $actual_link . "' style='color:orange;'> >BACK< </a> </td> ";
	
	$PHP_OUTPUT.= "<td> <select type='text' name='sectorid' value=''>";
	foreach ($galSectors as &$galSector) {
		if($galSector->hasPort()) {	
		}
		else {
			$sid = $galSector->getSectorID();
			$PHP_OUTPUT.= "<option value='$sid'> $sid </option>";
		}
	}
	$PHP_OUTPUT.= "</select>";
	$PHP_OUTPUT.= "<input type='hidden' name='gameid' value='" .$var['game_id'] . "' style='color:white;'/> </td>";
	
	//$PHP_OUTPUT.= "<td> <input name='level' value='' style='color:white; width:70px;'/> </td>";
	$PHP_OUTPUT.= "<td> <select type='text' name='level' value=''>";
	for ($nums = 1; $nums < 10; $nums++) {
		$PHP_OUTPUT.= "<option value='$nums'> $nums </option>";
	}
	$PHP_OUTPUT.= "</select> </td>";
	
	$PHP_OUTPUT.= "<td> <select type='text' name='race' value=''>";
	for ($nums = 1; $nums < 10; $nums++) {
		$PHP_OUTPUT.= "<option value='$nums'>" . Globals::getRaceName($nums) . "</option>";
	}
	$PHP_OUTPUT.= "</select> </td>";
	
	$PHP_OUTPUT.= "<td> <input name='submit' type='submit' value='Create' style='color:white;' /> </td> </tr>";
			
	$PHP_OUTPUT.= '</table>';
	$PHP_OUTPUT.= "</form>";
	
}
else{


if (!isset($_GET['edit'])) {

	if (isset($_GET['s']) && isset($_GET['g']) && isset($_GET['a']))
	{
		SmrPort::removePort($_GET['g'],$_GET['s']);
		
		$uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
		$actual_link = 'http://' . $_SERVER['HTTP_HOST'] . $uri_parts[0] . '?sn=' . $_GET['sn'];
		header( "Location: " . $actual_link ) ;
	}
	else if (isset($_GET['s']) && isset($_GET['g']))
	{
		$port = $galSector->getPort($var['game_id'],$_GET['s']);
		$port->removePortGood2($var['game_id'],$_GET['s'],$_GET['g']);
		
		$uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
		$actual_link = 'http://' . $_SERVER['HTTP_HOST'] . $uri_parts[0] . '?sn=' . $_GET['sn'];
		header( "Location: " . $actual_link );
	}

	if (isset($_POST['buygood']) && $_POST['buygood'] != '' )
	{
		$port =& SmrPort::getPort($_POST['gameid'],$_POST['sectorid']);
		$port->addPortGood2($_POST['gameid'],$_POST['sectorid'],$_POST['buygood'], "Buy");

	}
	if (isset($_POST['sellgood']) && $_POST['sellgood'] != '' && $_POST['buygood'] != $_POST['sellgood'])
	{
		$port2 =& SmrPort::getPort($_POST['gameid'],$_POST['sectorid']);
		$port2->addPortGood2($_POST['gameid'],$_POST['sectorid'],$_POST['sellgood'], "Sell");
	}

	if (isset($_POST['sectorid']))
	{

		$port =& SmrPort::getPort($_POST['gameid'],$_POST['sectorid']);
		
		if (isset($_POST['race']))
			$port->setRaceID($_POST['race']);
		
		if (isset($_POST['level']))
			$port->setLevel($_POST['level']);
		
		/*if (isset($_POST['shields']))
			$port->setShields($_POST['shields']);
			
		if (isset($_POST['armor']))
			$port->setArmour($_POST['armor']);
			
		if (isset($_POST['drones']))
			$port->setCDs($_POST['drones']);*/
			
		header( "Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ) ;
	}


	 
	$PHP_OUTPUT.= '<table class="standard">';
	$PHP_OUTPUT.= '<tr> <th>  </th>';
	$PHP_OUTPUT.= '<th> Sector </th>';
	$PHP_OUTPUT.= '<th> Level </th>';
	$PHP_OUTPUT.= '<th> Race </th>';
	$PHP_OUTPUT.= '<th> Combat Drones </th>';
	$PHP_OUTPUT.= '<th> Armor </th>';
	$PHP_OUTPUT.= '<th> Goods </th>';
	$PHP_OUTPUT.= '<th> Shields </th>';
	$PHP_OUTPUT.= '<th>  </th> </tr>';
	$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

	foreach ($galSectors as &$galSector) {
		if($galSector->hasPort()) {
		$sectorid = $galSector->getPort()->getSectorID();
		$PHP_OUTPUT.= "<tr> <td> <a href='" . $actual_link . "&edit=$sectorid' style='color:orange;'> >EDIT< </a> </td>";
		
		$sectorid = $galSector->getPort()->getSectorID();
		$gameid = $galSector->getPort()->getGameID();
		$PHP_OUTPUT.= "<td> <input type='hidden' name='sectorid' value='$sectorid' disabled='disabled' style='color:white;'/> $sectorid ";
		$PHP_OUTPUT.= "<input type='hidden' name='gameid' value='$gameid' disabled='disabled' style='color:white;'/></td> ";
		
		$lev = $galSector->getPort()->getLevel();
		$PHP_OUTPUT.= "<td> $lev </td>";
		
		$race = $galSector->getPort()->getRaceID();
		$PHP_OUTPUT.= "<td>" . Globals::getRaceName($race) . "</td>";
			
		$drones = $galSector->getPort()->getCDs();
		$PHP_OUTPUT.= "<td> $drones </td>";
			
		$armor = $galSector->getPort()->getArmour();
		$PHP_OUTPUT.= "<td> $armor </td>";
		
		$PHP_OUTPUT.= "<td>";
		$goods = $galSector->getPort()->getGoods();
		foreach ($goods['All Goods'] as $good) {
			 $PHP_OUTPUT.= $good['Name'] . " <-> Transaction Type: " . $good['TransactionType'] . " <->  Amount: " . $good['Amount'] . " <br />";
		}
		$PHP_OUTPUT.= "</td>";
		
		$shields = $galSector->getPort()->getShields();
		$PHP_OUTPUT.= "<td> $shields </td>";
		
		$PHP_OUTPUT.= "<td> <a href='$actual_link&g=" . $gameid . "&s=" . $sectorid . "&a=deleteport' style='color:red;'> X </a> </td> </tr>";
			//$galSector->getPort()->getSectors();
		}
	}
	
	$PHP_OUTPUT.= '</table>';

}
else {

	$uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
	$actual_link = 'http://' . $_SERVER['HTTP_HOST'] . $uri_parts[0] . '?sn=' . $_GET['sn'];

	$PHP_OUTPUT.= "<form action='$actual_link' method='POST'>";
	$PHP_OUTPUT.= '<table class="standard">';
	$PHP_OUTPUT.= "<tr> <th>  </th>";
	$PHP_OUTPUT.= "<th> Sector </th>";
	$PHP_OUTPUT.= "<th> Level </th>";
	$PHP_OUTPUT.= "<th> Race </th>";
	$PHP_OUTPUT.= "<th> Combat Drones </th>";
	$PHP_OUTPUT.= "<th> Armor </th>";
	$PHP_OUTPUT.= "<th> Goods </th>";
	$PHP_OUTPUT.= "<th> Shields </th>";
	$PHP_OUTPUT.= '<th>  </th> </tr>';
	
	$additem=1;

	foreach ($galSectors as &$galSector) {
		if($galSector->hasPort()) {
			if ($galSector->getPort()->getSectorID() == $_GET['edit']){
		
				$sectorid = $galSector->getPort()->getSectorID();
				$PHP_OUTPUT.= "<tr> <td> <a href='" . $actual_link . "' style='color:orange;'> >BACK< </a> </td> ";
				
				$sectorid = $galSector->getPort()->getSectorID();
				$gameid = $galSector->getPort()->getGameID();
				$PHP_OUTPUT.= "<td> <input type='hidden' name='sectorid' value='$sectorid' style='color:white;'/> $sectorid ";
				$PHP_OUTPUT.= "<input type='hidden' name='gameid' value='$gameid' style='color:white;'/></td> ";
				
				$lev = $galSector->getPort()->getLevel();
				//$PHP_OUTPUT.= "<td> <input name='level' value='$lev' style='color:white; width:70px;'/> </td>";
				$PHP_OUTPUT.= "<td> <select type='text' name='level' value=''>";
				for ($nums = 1; $nums < 10; $nums++) {
					if ($lev == $nums)
						$PHP_OUTPUT.= "<option value='$nums' selected='selected'> $nums </option>";
					else
						$PHP_OUTPUT.= "<option value='$nums'> $nums </option>";
				}
				$PHP_OUTPUT.= "</select> </td>";
				
				$race = $galSector->getPort()->getRaceID();
				$PHP_OUTPUT.= "<td> <select type='text' name='race' value=''>";
				for ($nums = 1; $nums < 10; $nums++) {
					if ($race == $nums)
						$PHP_OUTPUT.= "<option value='$nums' selected='selected'>" . Globals::getRaceName($nums) . "</option>";
					else
						$PHP_OUTPUT.= "<option value='$nums'>" . Globals::getRaceName($nums) . "</option>";
				}
				$PHP_OUTPUT.= "</select> </td>";
				
				/*$drones = $galSector->getPort()->getCDs();
				$PHP_OUTPUT.= "<td> <input name='drones' value='$drones' style='color:white; width:70px;'/> </td>";
					
				$armor = $galSector->getPort()->getArmour();
				$PHP_OUTPUT.= "<td> <input name='armor' value='$armor' style='color:white; width:70px;'/> </td>";*/
				
				$drones = $galSector->getPort()->getCDs();
				$PHP_OUTPUT.= "<td> $drones </td>";
			
				$armor = $galSector->getPort()->getArmour();
				$PHP_OUTPUT.= "<td> $armor </td>";
				
				$PHP_OUTPUT.= "<td >";
				foreach ($galSector->getPort()->getGoods()['All Goods'] as $goods) {
					 //$holder[$counter++]=$goods['ID'];
					 $PHP_OUTPUT.= $goods['Name'] . "(ID: " . $goods['ID'] .  ") <-> Transaction Type: " . $goods['TransactionType'] . " <->  Amount: " . $goods['Amount'];
					 $PHP_OUTPUT.= "<a href='$actual_link&g=" . $goods['ID'] . "&s=" . $sectorid . "' style='color:red;'> X </a> <br />";
				}
				
				$PHP_OUTPUT.= "Add Good for Purchase: <select name='buygood' style='width:70px;'> ";
				$PHP_OUTPUT.= "<option value=''> </option>";
				for ($nums = 1; $nums < 13; $nums++){
					$additem=1;
					foreach ($galSector->getPort()->getGoods()['All Goods'] as $goods) {
						if ($goods['ID'] == $nums)
							$additem=0;
					}
					if ($additem == 1)
						$PHP_OUTPUT.= "<option value=" . $nums . ">" . Globals::getGood($nums)['Name'] . "</option>";
				}
				$PHP_OUTPUT.= "</select >  <br />";
				
				$PHP_OUTPUT.= "Add Good for Sale: <select name='sellgood' style='width:70px;'> ";
				$PHP_OUTPUT.= "<option value=''> </option>";
				for ($nums = 1; $nums < 13; $nums++){
					$additem=1;
					foreach ($galSector->getPort()->getGoods()['All Goods'] as $goods) {
						if ($goods['ID'] == $nums)
							$additem=0;
					}
					if ($additem == 1)
						$PHP_OUTPUT.= "<option value=" . $nums . ">" . Globals::getGood($nums)['Name'] . "</option>";
				}
				$PHP_OUTPUT.= "</select >  <br />";
				
				//$PHP_OUTPUT.= "Add Good for Sale: <input name='sellgood' value='' style='color:white; width:70px;'/> <br />";
				$PHP_OUTPUT.= "</td>";
				
				//$shields = $galSector->getPort()->getShields();
				//$PHP_OUTPUT.= "<td> <input name='shields' value='$shields' style='color:white; width:70px;'/> </td>";
				
				$shields = $galSector->getPort()->getShields();
				$PHP_OUTPUT.= "<td> $shields </td>";
				
				$PHP_OUTPUT.= "<td> <input name='submit' type='submit' value='Confirm' style='color:white;' /> </td> </tr>";
			}
		}
	}
	$PHP_OUTPUT.= '</table>';
	$PHP_OUTPUT.= "</form>";
	
}
}


?>
