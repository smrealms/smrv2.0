<?php
$GalaxyMap = isset($GalaxyMap)&&$GalaxyMap;
$UniGen = isset($UniGen) ? $UniGen : false;
$MapPlayer = $UniGen ? null : $ThisPlayer;
$MovementTypes = array('Up','Left','Right','Down');
if (!isset($isCombinedSector)) {
	$isCombinedSector = false;
}
?>
<table class="lmt centered <?php echo "galaxy".$MapSectors[0][0]->getGalaxyID(); ?>"><?php
	foreach($MapSectors as &$MapSector) { ?>
		<tr><?php
			foreach($MapSector as &$Sector) {
				$isCurrentSector = !$UniGen && $ThisSector->equals($Sector);
				$isLinkedSector = !$UniGen && $ThisSector->isLinkedSector($Sector);
				$isVisited = $Sector->isVisited($MapPlayer); 
				if ($Sector->hasPlanet()) { $planet = $Sector->getPlanet(); }?>
				<td id="sector<?php echo $Sector->getSectorID(); ?>" class="ajax">
					<div class="lm_sector galaxy<?php echo $Sector->getGalaxyID();
						if($isCurrentSector){ echo ' currentSeclm"'; } 
						else if($isLinkedSector){ echo ' connectSeclm"'; } 
						else if($isVisited){ echo ' normalSeclm"'; }else{ echo ' normalSeclmu"'; } 
						
						$url = ''; $size = ''; $position = ''; $tail = '';
						
						if($isCurrentSector) {
							$url .= 'url("images/currentsector.png"),'; 
							$size .= '100% auto,';
							$position .= 'center center,';
						}
						if ($Sector->hasPlanet()) { 
							$planet = $Sector->getPlanet();
							$url .= 'url("'.$planet->getImageLink().'"),'; 
							$size .= $planet->getSize().' auto,';
							$position .= 'center center,';
							$tail = 'data-img="../'.$planet->getImageLink().'" data-tip="'.$planet->getTypeName().': '.$planet->getName().'"';
						} 
						if($Sector->hasFeature()) {
							$url .= 'url("'.$Sector->getFeatureImageThumbLink().'"),';
							$size .= $Sector->getFeatureSize().',';
							$position .= $Sector->getFeatureLocation().',';
						} 
						if ($url !='') {
							echo " style='background-image: ".rtrim($url, ",").";";
							echo " background-size: ".rtrim($size, ",").";";
							echo " background-position: ".rtrim($position, ",").";";
							echo " background-repeat: no-repeat;' ";
						}
						echo $tail.'>';
						if($isVisited) {
							if(isset($ToggleLink)) {
								$ToggleLink['sector_id'] = $Sector->getSectorID();
							}
							foreach($MovementTypes as $MovementType) {
								if(isset($ToggleLink)) {
									$ToggleLink['dir'] = $MovementType; ?>
									<a href="<?php echo SmrSession::getNewHREF($ToggleLink); ?>" class="lm<?php echo $MovementType; ?>"><?php
								} ?>
								<div class="lm<?php echo $MovementType; ?> <?php echo "galaxy".$Sector->getGalaxyID(); if($Sector->getLink($MovementType)) { ?> con<?php } else { ?> wall<?php } ?>"></div><?php
								if(isset($ToggleLink)) { ?>
									</a><?php
								}
							}
							if($Sector->hasLocation() || $Sector->hasPlanet()) { ?>
								<div class="lmloc"><?php
								if($Sector->hasLocation()) {
									foreach($Sector->getLocations() as $Location) {
										if($isCurrentSector && $Location->hasAction() && !$GalaxyMap) {
											?><a href="<?php echo $Location->getExamineHREF() ?>"><?php
										} ?>
											<div style="display:inline;" 
												data-img="../<?php echo $Location->getImage(); ?>"
												data-tip="<?php echo $Location->getName(); ?>">
												<img src="images/blank_16.png" 
												style="background-image: url('<?php echo $Location->getImage(); ?>');" 
												class="locations locationt<?php echo (int)($Location->getTypeID()/100); ?> location<?php echo $Location->getTypeID(); ?>" 
												alt="<?php echo $Location->getName(); ?>"/> 
											</div>
												
										<?php
										if($isCurrentSector && $Location->hasAction() && !$GalaxyMap){ ?></a><?php }
									}
								} ?>
								</div><?php
							}
							if((($UniGen || $isCurrentSector) && $Sector->hasPort()) || $Sector->hasCachedPort($MapPlayer)) {
								if(($UniGen || $isCurrentSector) && $Sector->hasPort()) {
									$Port =& $Sector->getPort();
								}
								else if($Sector->hasCachedPort($MapPlayer)) {
									$Port =& $Sector->getCachedPort($MapPlayer);
								} ?>
								<div class="lmport <?php if($Sector->getLinkLeft()) { ?>a<?php } else { ?>b<?php } ?> 
									"><?php
									if($isCurrentSector && !$GalaxyMap) {
										?><a href="<?php echo Globals::getTradeHREF(); ?>"><?php
									} ?>
										<div style="display:inline;" 
											data-tip="<?php echo $Port->getRaceName(); ?> Port">
										<img src="images/port/buy.png" width="5" height="16" alt="Buy (<?php echo $Port->getRaceName(); ?>)" 
											class="port<?php echo $Port->getRaceID(); ?>"/></div><?php
											foreach($Port->getVisibleGoodsSold($MapPlayer) as $Good) { ?>
												<div style="display:inline;" 
													data-tip="Buy <?php echo $Good['Name']; ?>">
													<img src="images/blank_13.png" alt="<?php echo $Good['Name']; ?>" 
													class="good" 
													style="background-image: url('<?php echo $Good['ImageLink']; ?>');" 
													/>
												</div><?php
											} ?><br>
										<div style="display:inline;" 
											data-tip="<?php echo $Port->getRaceName(); ?> Port">
										<img src="images/port/sell.png" width="5" height="16" alt="Sell (<?php echo $Port->getRaceName(); ?>)" 
										class="port<?php echo $Port->getRaceID(); ?>"/></div><?php
											foreach($Port->getVisibleGoodsBought($MapPlayer) as $Good) { ?>
												<div style="display:inline;" 
													data-tip="Sell <?php echo $Good['Name']; ?>">
													<img src="images/blank_13.png" alt="<?php echo $Good['Name']; ?>" 
													class="good" 
													style="background-image: url('<?php echo $Good['ImageLink']; ?>');" 
													/>
												</div><?php
											}
									if($isCurrentSector && !$GalaxyMap){ ?></a><?php } ?>
								</div><?php
							}
						}
						if(($isVisited && ($Sector->hasWarp() || $Sector->hasMine())) || (!$UniGen && ($MapPlayer->isPartOfCourse($Sector) || ($MapPlayer->hasPlottedCourse()&&$isCurrentSector)))) { ?>
							<div class="lmp"><?php
								if(!$UniGen && ($MapPlayer->isPartOfCourse($Sector) || ($MapPlayer->hasPlottedCourse()&&$isCurrentSector))) {
									?><img title="Course" alt="Course" src="images/plot_icon.gif" width="16" height="16"/><?php
								}
								if($isVisited) {
									if($Sector->hasWarp()) {
										if($GalaxyMap){ ?><a href="<?php echo $Sector->getWarpSector()->getGalaxyMapHREF(); ?>"><?php }
										else if($isCombinedSector && $isCurrentSector){ ?><a href="<?php echo $Sector->getWarpSector()->getCombinedMapHREF(); ?>"><?php } 
										else if($isCurrentSector){ ?><a href="<?php echo $Sector->getWarpSector()->getLocalMapHREF(); ?>"><?php } ?>
											<div style="display:inline;" 
												data-tip="Warp to #<?php echo $Sector->getWarp(); ?> (<?php echo $Sector->getWarpSector()->getGalaxyName(); ?>)">
												<img src="images/blank_16.png"  alt="Warp to #<?php echo $Sector->getWarp(); ?>"
												class="warp" 
												style="background-image: url('images/warp2.png');" 
												/>
											</div><?php
										if($isCurrentSector || $GalaxyMap){ ?></a><?php }
									}
									if($Sector->hasMine()) {
										?><img src="images/asteroid.gif" width="16" height="16" alt="Mining Available Here" title="Mining Available Here" /><?php
									}
								} ?>
							</div><?php
						}
						$CanScanSector = $UniGen || ($ThisShip->hasScanner() && $isLinkedSector) || $isCurrentSector;
						if( ($CanScanSector && ($Sector->hasForces() || $Sector->hasPlayers()) ) || $Sector->hasFriendlyForces($MapPlayer) || $Sector->hasFriendlyTraders($MapPlayer)) { ?>
							<div class="lmtf"><?php
								if(!$UniGen && (($isCurrentSector && $Sector->hasOtherTraders($MapPlayer)) || ($ThisShip->hasScanner() && $isLinkedSector && $Sector->hasPlayers()) || $Sector->hasFriendlyTraders($MapPlayer))) {
									if($CanScanSector && $Sector->hasEnemyTraders($MapPlayer)) {
										?>
										<div style="display:inline;" data-tip="Enemy Trader">
											<img class="enemyBack" alt="Enemy Trader" src="images/trader.png" width="13" height="16"/>
										</div><?php
									}
									if($CanScanSector && $Sector->hasProtectedTraders($MapPlayer)) {
										?>
										<div style="display:inline;" data-tip="Protected Trader">
											<img class="neutralBack" alt="Protected Trader" src="images/trader.png" width="13" height="16"/>
										</div><?php
									}
									if($Sector->hasFriendlyTraders($MapPlayer)) {
										?>
										<div style="display:inline;" data-tip="Friendly Trader">
											<img class="friendlyBack" alt="Friendly Trader" src="images/trader.png" width="13" height="16"/>
										</div><?php
									}
								}
								if($Sector->hasForces()) {
									if($CanScanSector && $Sector->hasEnemyForces($MapPlayer)) {
										?>
										<div style="display:inline;" data-tip="Enemy Forces">
											<img class="enemyBack" alt="Enemy Forces" src="images/forces.png" width="13" height="16"/>
										</div><?php
									}
									if($Sector->hasFriendlyForces($MapPlayer)) {
										?>
										<div style="display:inline;" data-tip="Friendly Forces">
											<img class="friendlyBack" alt="Friendly Forces" src="images/forces.png" width="13" height="16"/>
										</div><?php
									}
								} ?>
							</div><?php
						} ?>
						<div class="lmsector <?php echo "galaxy".$Sector->getGalaxyID(); if($isVisited){ echo ' visited">'; }else{ echo ' unvisited">'; } 
							if($Sector->hasPlanet()) { echo '<span class="boldblack">'; } echo $Sector->getSectorID(); if($Sector->hasPlanet()){ echo'</span>'; } ?>
						</div><?php
						if($UniGen) {
							$UniGen['sector_id'] = $Sector->getSectorID(); ?>
							<a class="move_hack" href="<?php echo SmrSession::getNewHREF($UniGen); ?>"></a><?php
						} 
						else if($isCombinedSector && $isLinkedSector) { ?>
							<a class="move_hack" href="<?php echo $Sector->getCombinedMapHREF(); ?>"></a><?php
						}
						else if ($isCurrentSector && !$GalaxyMap && $Sector->hasPlanet()) { ?>
							<a class="move_hack" href="<?php echo $planet->getExamineHREF(); ?>"></a><?php
						}
						else if($GalaxyMap) { ?>
							<a class="move_hack" href="<?php echo $Sector->getGalaxyMapHREF(); ?>"></a><?php
						}
						else if($isLinkedSector) { ?>
							<a class="move_hack" href="<?php echo $Sector->getLocalMapHREF(); ?>"></a><?php
						}
						else if($isCurrentSector && !$isCombinedSector) { ?>
							<a class="move_hack" href="<?php echo Globals::getCurrentSectorHREF(); ?>"></a><?php
						} ?>
					</div>
				</td><?php
			} unset($Sector); ?>
		</tr><?php
		//A little hacky but clearing these caches for each row of gal map drastically reduces total memory usage, and these caches should never be needed after this point either.
		SmrPort::clearCache();
		SmrForce::clearCache();
		SmrPlanet::clearCache();
	} unset($MapSector); ?>
</table>