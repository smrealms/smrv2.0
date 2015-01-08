<?php
if($ThisSector->hasPlanet()) {
	$planet =& $ThisSector->getPlanet(); ?>
	<table class="standard csl">
		<tr>
			<th>Planet: <?php echo $planet->getName() ?></th>
		</tr>
		<tr>
			<td>
				<a href="<?php echo $planet->getExamineHREF() ?>">
					<div style="
						display: inline-box; 
						padding: 0; 
						margins: 0; 
						height: 120px; 
						width: 120px; 
						background-image: url('<?php echo $planet->getImageLink(); ?>');
						background-size: <?php echo $planet->getSize(); ?> auto; 
						background-position: center center; 
						background-repeat:no-repeat;" 
						data-tip="<?php echo $planet->getTypeName().': '.$planet->getName(); ?>">
					</div>&nbsp;<?php echo $planet->getName() ?>&nbsp;
					<?php if($planet->isInhabitable()) { ?>
						<span class="inhab">Inhabitable</span>
					<?php 
					}
					else { ?>
						<span class="uninhab">Uninhabitable</span>
					<?php
					} ?>
				</a>
			</td>
		</tr>
	</table><br>
<?php } ?>