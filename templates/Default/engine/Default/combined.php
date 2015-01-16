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
			<table align="center">
				<tr>
					<td>
						<div style="text-align:justify">
							<?php $this->includeTemplate('combined/TopPlayerInfo.inc'); ?>
						</div>
					</td>
				</tr>
				<tr>
					<td>
					<table align="center">
						<tr>
							<td style="vertical-align:top;">
								<div class="left_side_item_wrapper"><?php
									$this->includeTemplate('combined/SectorPlanet.inc');
									$this->includeTemplate('combined/SectorPort.inc');
									$this->includeTemplate('combined/SectorLocations.inc');
									$this->includeTemplate('combined/SectorPlayers.inc',array('PlayersContainer'=>&$ThisSector));
									$this->includeTemplate('combined/SectorForces.inc'); ?>
								</div>
							</td>
							<td style="vertical-align:top;">
								<div id="middle_panel"><?php
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
									$this->includeTemplate($TemplateBody); ?>
								</div>
							</td>
							<td style="vertical-align:top;">
								<div id="right_panel">
									COMBAT/EVENT LOG
								</div>
							</td>
						</tr>
					</table>
					</td>
				</tr>
			</table>
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