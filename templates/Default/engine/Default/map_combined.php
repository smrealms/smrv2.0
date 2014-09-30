<div class="center">
	Local Map of the Known <span class="big bold">
	<?php echo $GalaxyName ?>
	</span> Galaxy.<br>
	<?php if(isset($Error)) echo $Error; ?>
</div><br>

<?php $isCombinedSector = true; $this->includeTemplate('includes/SectorMap.inc'); ?>
<div style="padding:0px;vertical-align:top;width:32em;"><?php
	$this->includeTemplate('includes/PlottedCourse.inc');
	$this->includeTemplate('includes/Ticker.inc');
	$this->includeTemplate('includes/Missions.inc'); ?>
	<span id="secmess"><?php
		if(isset($ErrorMessage)) {
			echo $ErrorMessage; ?><br><?php
		}
		if(isset($ProtectionMessage)) {
			echo $ProtectionMessage; ?><br><?php
		}
		if(isset($TurnsMessage)) {
			echo $TurnsMessage; ?><br><?php
		}
		if(isset($TradeMessage)) {
			echo $TradeMessage; ?><br><?php
		}
		if(isset($ForceRefreshMessage)) {
			echo $ForceRefreshMessage; ?><br><?php
		}
		if(isset($AttackResults)) {
			if($AttackResultsType=='PLAYER') {
				$this->includeTemplate('includes/TraderFullCombatResults.inc',array('TraderCombatResults'=>$AttackResults,'MinimalDisplay'=>true));
			}
			else if($AttackResultsType=='FORCE') {
				$this->includeTemplate('includes/ForceFullCombatResults.inc',array('FullForceCombatResults'=>$AttackResults,'MinimalDisplay'=>true));
			}
			else if($AttackResultsType=='PORT') {
				$this->includeTemplate('includes/PortFullCombatResults.inc',array('FullPortCombatResults'=>$AttackResults,'MinimalDisplay'=>true));
			}
			else if($AttackResultsType=='PLANET') {
				$this->includeTemplate('includes/PlanetFullCombatResults.inc',array('FullPlanetCombatResults'=>$AttackResults,'MinimalDisplay'=>true));
			} ?><br><?php
		}
		if(isset($VarMessage)) {
			echo $VarMessage; ?><br><?php
		} ?>
	</span>
</div>