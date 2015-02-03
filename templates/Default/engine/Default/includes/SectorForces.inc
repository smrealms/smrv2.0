<div id="sector_forces" class="ajax"><?php
	if($ThisSector->hasForces()) {
		$Forces =& $ThisSector->getForces();
		Sorter::sortByNumMethod($Forces,'getExpire');
		$RefreshAny = false; ?>
		<table class="standard fullwidth csForces">
			<tr>
				<th class="header">Forces (<?php echo count($Forces); ?>)</th>
			</tr>	
			
		<?php
		foreach($Forces as $Force) {
			$Owner =& $Force->getOwner();
			$SharedForceAlliance = $Owner->sharedForceAlliance($ThisPlayer);
			if($SharedForceAlliance) {
				$RefreshAny = true;
			} ?>
			<tr>
				<td>
					<table style="border: 0; width: 100%;">
						<tr>
							<th colspan=3><?php
	//							if($SharedForceAlliance) {
									echo $Owner->getLinkedDisplayName();
	//							}
	//							else {
	//								<span class="red">UNKNOWN</span>
	//							} ?>
							</th>
						</tr>
						<tr>
							<td style="border: 0; width: 35px;">
							<?php
							if($SharedForceAlliance && $ThisShip->canAcceptMines()&&$Force->hasMines()) {
								?><a href="<?php echo $Force->getTakeMineHREF() ?>" class="buttonA">&nbsp;-&nbsp;</a><?php								
							}
							if($SharedForceAlliance && $ThisShip->hasMines()&&$Force->canAcceptMines()) {
								?><a href="<?php echo $Force->getDropMineHREF() ?>" class="buttonA">&nbsp;+&nbsp;</a><?php
							} ?>
							</td>
							<td style="border: 0;">
								<?php echo $Force->getMines();?> Mines 
							</td>
							<td style="border: 0;">
							<a href="<?php
								if($SharedForceAlliance) {
									echo $Force->getExamineDropForcesHREF();
								} else {
									echo $Force->getExamineAttackForcesHREF();
								} ?>" class="buttonA<?php if(!$SharedForceAlliance){ ?> enemyExamine<?php } ?>"> Examine </a>
							</td>
						</tr>
						<tr>
							<td style="border: 0;"><?php
								if($SharedForceAlliance) {
									if ($ThisShip->canAcceptCDs()&&$Force->hasCDs()) {
									?><a href="<?php echo $Force->getTakeCDHREF() ?>" class="buttonA">&nbsp;-&nbsp;</a><?php
									}
									if ($Force->getCDs()>1&&$ThisShip->canAcceptCDs($Force->getCDs())&&$Force->hasCDs()) {
									?><a href="<?php echo $Force->getTakeCDHREF($Force->getCDs()) ?>" class="buttonA">&nbsp;--</a><?php
									}
								}
								if($SharedForceAlliance && $ThisShip->hasCDs()&&$Force->canAcceptCDs()) {
								?><a href="<?php echo $Force->getDropCDHREF() ?>" class="buttonA">&nbsp;+&nbsp;</a><?php
								} ?>
							</td>
							<td style="border: 0;">
								<?php echo $Force->getCDs();?> Combat 
							</td>
							<td style="border: 0;"><?php
							if($SharedForceAlliance) { ?>
								<a href="<?php echo $Force->getRefreshHREF() ?>" class="buttonA"> Refresh </a><?php
							} ?>
							</td>
						</tr>	
						<tr>
							<td style="border: 0;"><?php
								if($SharedForceAlliance && $ThisShip->canAcceptSDs()&&$Force->hasSDs()) {
									?><a href="<?php echo $Force->getTakeSDHREF() ?>" class="buttonA">&nbsp;-&nbsp;</a><?php
								}
								if($SharedForceAlliance && $ThisShip->hasSDs()&&$Force->canAcceptSDs()) {
									?><a href="<?php echo $Force->getDropSDHREF() ?>" class="buttonA">&nbsp;+&nbsp;</a><?php
								} ?>
							</td>
							<td style="border: 0;"><?php 
								echo $Force->getSDs();?> Scout 
							</td>
							
							<td style="border: 0;"></td>
						</tr>
					</table>
				</td>
			</tr><?php 
		} if($RefreshAny) { ?>
			<tr>
				<td class="center" colspan="6">
					<div class="buttonA"><a href="<?php echo $Force->getRefreshAllHREF() ?>" class="buttonA"> Refresh All </a></div>
				</td>
			</tr><?php
		} ?>
		</table><?php
	} ?>
</div>