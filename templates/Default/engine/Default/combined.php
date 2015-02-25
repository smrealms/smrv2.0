<!DOCTYPE html>
<html>
	<head><?php
		$this->assign('FontSize', $FontSize-20);
		$this->includeTemplate('includes/Head.inc'); ?>	
	</head>
	<body align="center">
		<div id="menu_container">
			<div id="menu">
					<?php $this->includeTemplate('combined/LeftPanel.inc'); ?>
			</div>
		</div>
		<div>
		<div id="left_column">
			<div class="left_side_item_wrapper"><?php
				$this->includeTemplate('combined/SectorPlanet.inc');
				$this->includeTemplate('combined/SectorPort.inc');
				$this->includeTemplate('combined/SectorLocations.inc');
				$this->includeTemplate('combined/SectorPlayers.inc',array('PlayersContainer'=>&$ThisSector));
				$this->includeTemplate('combined/SectorForces.inc'); ?>
			</div>		
		</div>
		<div id="center_column">
			<div id="middle_panel"><?php
			if ($TemplateBody == "map_combined.php") {
				$this->includeTemplate('includes/SectorMap.inc');
			} else {
				
				if(isset($PageTopic)) {
					?><h1><?php echo $PageTopic; ?></h1><br><?php
				}
				if(isset($MenuItems)||isset($MenuBar)) { ?>
					<div class="bar1">
						<div><?php
							if(isset($MenuItems)) {
								$this->includeTemplate('combined/menu.inc');
							}
							else if(isset($MenuBar)) {
								echo $MenuBar;
							} ?>
						</div>
					</div><br><?php
				}
				else if(isset($SubMenuBar)) {
					echo $SubMenuBar;
				}
				$this->includeTemplate($TemplateBody); } ?>
			</div>			
		</div>
		<div id="log_column">
			<div style="padding:0px;vertical-align:top;"><?php
				$this->includeTemplate('combined/PlottedCourse.inc');
				$this->includeTemplate('combined/Ticker.inc');
				$this->includeTemplate('combined/Missions.inc'); ?>
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
			</div>		
			<div id="right_column">
				<?php $this->includeTemplate('includes/RightPanel.inc'); ?>
			</div>
		<?php $this->includeTemplate('combined/EndingJavascript.inc'); ?>
	</body>
	<img src="spinner.gif" id="spinner" style="width:30px; height:30px;position: absolute;top: 50%;left: 50%;"/>

	<script type="text/javascript">
		window.onload=hideSpinner;
 
		function hideSpinner() {
			document.getElementById('spinner').style.display = "none";
		}
	</script>
</html>