<div id="players_cs" class="ajax"><?php
	if($PlayersContainer->hasOtherTraders($ThisPlayer)) {
		$Players =& $PlayersContainer->getOtherTraders($ThisPlayer);
		if(!($PlayersContainer instanceof SmrSector) || $ThisPlayer->canSeeAny($Players)) { ?>
			<table class="standard fullwidth csShips">
				<tr>
					<th class="header">Ships (<?php echo count($Players) ?>)</th>
				</tr>
				<tr>
					<th>Trader Ship Rating Level Option</th>
				</tr>
				<?php
				foreach($Players as &$Player) {
					if(!($PlayersContainer instanceof SmrSector) || $ThisPlayer->canSee($Player)) {
						$Ship =& $Player->getShip();?>
						<tr<?php if($Player->getAccount()->isNewbie()) { ?> class="newbie"<?php } ?>><?php
						if($PlayersContainer instanceof SmrPlanet) {
							if($ThisPlanet->getOwnerID() == $ThisPlayer->getAccountID()) {
								?><td onclick="document.location='<?php echo $Player->getPlanetKickHREF() ?>'">
									<?php /*if(!$ThisPlayer->traderNAPAlliance($Player)){ 
										if ($Player->canFight()) {
											enemy 
										} else {
											neutral
										}
									} else {
										friendly
									}*/
							} else { ?>
								<td><?php 
							}
						
						} else { ?>
							<td onclick="document.location='<?php echo $Player->getExamineTraderHREF() ?>'"><?php
						} ?>
								<?php echo $Player->getLinkedDisplayName(); ?>
							<br /><?php
								if($Player->hasCustomShipName()&&($ThisAccount->isDisplayShipImages()||stripos($Player->getCustomShipName(),'<img')===false)) {
									echo $Player->getCustomShipName();
								}
								if($ThisPlayer->traderMAPAlliance($Player) || !$Ship->hasActiveIllusion()) {
									echo $Ship->getName();
								}
								if($Ship->hasActiveIllusion()) {
									if(!$ThisPlayer->traderMAPAlliance($Player)) {
										echo $Ship->getIllusionShipName();
									}
									else if($Ship->getName() != $Ship->getIllusionShipName()) {
										?> <span class="npcColour">(<?php echo $Ship->getIllusionShipName(); ?>)</span><?php
									}
								}
								if($Ship->isCloaked()) {
									?> <span class="red">[Cloaked]</span><?php
								} ?>
							<br /><?php
								if($ThisPlayer->traderMAPAlliance($Player) || !$Ship->hasActiveIllusion()) {
									echo $Ship->getAttackRating(); ?> / <?php echo $Ship->getDefenseRating();
								}
								if($Ship->hasActiveIllusion()) {
									if(!$ThisPlayer->traderMAPAlliance($Player)) {
										echo $Ship->getIllusionAttack(); ?> / <?php echo $Ship->getIllusionDefense();
									}
									else if($Ship->getAttackRating() != $Ship->getIllusionAttack() || $Ship->getDefenseRating() != $Ship->getIllusionDefense()) {
										?> <span class="npcColour">(<?php echo $Ship->getIllusionAttack(); ?> / <?php echo $Ship->getIllusionDefense(); ?>)</span><?php
									}
								} ?> 
							Level: <?php echo $Player->getLevelID() ?></td>
							</td>
						</tr><?php
					}
				} ?>
			</table><?php
		}
		else {
			?><span class="red bold">WARNING:</span> Sensors have detected the presence of cloaked vessels in this sector<?php
		}
	} ?>
</div><br />