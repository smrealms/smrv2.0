<!DOCTYPE html>
<html>
	<head><?php
		$this->assign('FontSize', $FontSize-20);
		$this->includeTemplate('includes/Head.inc'); ?>	
	</head>
	<body align="center">
		<div class="view_wrap"><!-- Outter wrap -->
			<div id="menu_container">
				<div id="menu">
						<?php $this->includeTemplate('includes/LeftPanel.inc'); ?>
				</div>
			</div>


			<div class="column left_column"><!-- Sector view --><?php
				$this->includeTemplate('includes/SectorPlanet.inc');
				$this->includeTemplate('includes/SectorPort.inc');
				$this->includeTemplate('includes/SectorLocations.inc');
				$this->includeTemplate('includes/SectorPlayers.inc',array('PlayersContainer'=>&$ThisSector));
				$this->includeTemplate('includes/SectorForces.inc'); ?>
			
			</div>
			
			
			
			
			<div class="column center_column"><!-- Main screen (map and locations) --><?php
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
								$this->includeTemplate('includes/menu.inc');
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
				$this->includeTemplate($TemplateBody); 
			} 
				
				$this->includeTemplate('includes/PlottedCourse.inc');
				$this->includeTemplate('includes/Ticker.inc');
				$this->includeTemplate('includes/Missions.inc'); ?>
				<span id="secmess"><?php
					if(isset($ProtectionMessage)) {
						echo $ProtectionMessage; 
					} ?>
				</span>
			</div>
			
		
			
			<div class="column right_column"><!-- Event log -->
				<ul id="new_events" style="display: none;"><?php
					if(isset($ErrorMessage)) {
						echo "<li>".$ErrorMessage."</li>";
					}
					if(isset($TurnsMessage)) {
						echo $TurnsMessage."</li>";
					}
					if(isset($TradeMessage)) {
						echo $TradeMessage."</li>";
					}
					if(isset($ForceRefreshMessage)) {
						echo $ForceRefreshMessage."</li>";
					}
					if(isset($AttackResults)) {
						if($AttackResultsType=='PLAYER') {
							echo "<li>";
							$this->includeTemplate('includes/TraderFullCombatResults.inc',array('TraderCombatResults'=>$AttackResults,'MinimalDisplay'=>true));
							echo "</li>";
						}
						else if($AttackResultsType=='FORCE') {
							echo "<li>";
							$this->includeTemplate('includes/ForceFullCombatResults.inc',array('FullForceCombatResults'=>$AttackResults,'MinimalDisplay'=>true));
							echo "</li>";
						}
						else if($AttackResultsType=='PORT') {
							echo "<li>";
							$this->includeTemplate('includes/PortFullCombatResults.inc',array('FullPortCombatResults'=>$AttackResults,'MinimalDisplay'=>true));
							echo "</li>";
						}
						else if($AttackResultsType=='PLANET') {
							echo "<li>";
							$this->includeTemplate('includes/PlanetFullCombatResults.inc',array('FullPlanetCombatResults'=>$AttackResults,'MinimalDisplay'=>true));
							echo "</li>";
						} 
					}
					if(isset($VarMessage)) {
						echo "<li>".$VarMessage."</li>"; 
					} ?>
					
				</ul>
				<ul id="event_log" class="event_log">
			
				</ul>
				<button class="buttonA" onClick="$('#event_log').html(''); window.name = '';">Clear Log</button>
			</div>
			
			
			
			
			<div class="column info_column"><!-- Trader info -->
				<?php $this->includeTemplate('includes/RightPanel.inc'); ?>
			
			
			</div>




		</div>

		<!-- Script for rendering the event log -->
		<script>
			$(document).ready(
				function() {
					if (window.name != "") {
						console.log('making new array');
						window.my_events = $.parseJSON(window.name);
					} else {
						window.my_events = new Array();
					}
					$("#new_events").find("li").each(function(index, value) {
						window.my_events.push($(this).html());
					});
					$(window.my_events).each(function(index, value) {
						$("#event_log").prepend('<li id="event_'+index+'"'+value+'</li>');
					});
					window.name = JSON.stringify(window.my_events);
			});
		</script>
		<?php $this->includeTemplate('includes/EndingJavascript.inc'); ?>
	</body>
		<img src="spinner.gif" id="spinner" style="width:30px; height:30px;position: absolute;top: 50%;left: 50%;"/>

	<script type="text/javascript">
		window.onload=hideSpinner;
 
		function hideSpinner() {
			document.getElementById('spinner').style.display = "none";
		}
	</script>
</html>