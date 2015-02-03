<div id="sector_port" class="ajax">
	<?php if($ThisSector->hasPort()) {
		$Port =& $ThisSector->getPort(); ?>
		<table class="standard csl">
			<tr>
				<th colspan="3"><a href="<?php echo Globals::getTraderRelationsHREF(); ?>"><?php echo $ThisPlayer->getColouredRaceName($Port->getRaceID()); ?></a> Port <?php echo $Port->getSectorID(); ?> (Level <?php echo $Port->getLevel(); ?>)</th>
			</tr>
			<tr>
				<td style="border:0;">
					<div class="goods">
						<div style="display: inline;" 
							data-tip="<?php echo $Port->getRaceName(); ?> Port">
						<img src="images/port/buy.png" width="5" height="16" alt="Buy (<?php echo $Port->getRaceName(); ?>)" 
							class="port<?php echo $Port->getRaceID(); ?>"/></div><?php
							foreach($Port->getVisibleGoodsSold($MapPlayer) as $Good) { ?>
								<div style="display:inline;" 
									data-tip="Buy <?php echo $Good['Name']; ?>">
									<img src="images/blank_13.png" alt="<?php echo $Good['Name']; ?>" 
									class="goods" 
									style="background-image: url('<?php echo $Good['ImageLink']; ?>');" 
									/>
								</div><?php
							} ?>
						
						<br /><div style="display:inline;" 
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
							} ?>
						</div>
					</div>
				</td>
				<td style="border:0;">
					<div style="text-align: center;padding-right:1px;vertical-align:top;" class="right">
						<img height="<?php echo $Port->getUpgradePercent()*32; ?>" width="6px" style="border:2px solid #000000;border-bottom:none;" src="images/green.gif" alt="Upgrade" title="Upgrade" /><img height="<?php echo $Port->getCreditsPercent()*32; ?>" width="6px" style="border:2px solid #000000;border-bottom:none;" src="images/blue.gif" alt="Credits" title="Credits" /><img height="<?php echo $Port->getReinforcePercent()*32; ?>" width="6px" style="border:2px solid #000000;border-bottom:none;" src="images/red.gif" alt="Defense" title="Defense" />
					</div>	
				</td>
				<td class="center shrink noWrap" style="border:0;"><?php
					if($Port->isUnderAttack()) {
						?><span class="red bold">ALERT!!</span><?php
					}
					else if($PortIsAtWar) {
						?><span class="red bold">WAR!!</span><?php
					}
					else { ?>
						<div class="buttonA" style="display: block;">
							<a class="buttonA" href="<?php echo Globals::getTradeHREF() ?>">&nbsp;Trade&nbsp;</a>
						</div><?php
					} ?>&nbsp;
					<div class="buttonA"  style="display: block;">
						<a class="buttonA" href="<?php echo $Port->getRaidWarningHREF() ?>">&nbsp;Raid&nbsp;</a>
					</div>
				</td>
			</tr>
		</table><br /><?php
	} ?>
</div>