<?php
if($ThisSector->hasLocation()) {
	$Locations =& $ThisSector->getLocations() ?>
	<table class="standard csl">
		<tr>
			<th>Location</th>
		</tr><?php
		foreach($Locations as $Location) { ?>
			<tr>
				<td<?php 
				if($Location->hasAction()) { ?>
				 onclick="document.location='<?php echo $Location->getExamineHREF(); ?>'" class="clickable"<?php 
				} ?>>
					<div style="" 
						data-img="../<?php echo $Location->getImage(); ?>"
						data-tip="<?php echo $Location->getName(); ?>">
						<img align="left" src="images/blank_16.png" 
						style="background-image: url('<?php echo $Location->getImage(); ?>');" 
						class="locations locationt<?php echo (int)($Location->getTypeID()/100); ?> location<?php echo $Location->getTypeID(); ?>" 
						alt="<?php echo $Location->getName(); ?>"/> 
					</div>
					&nbsp;<?php echo $Location->getName(); ?>
				</td>
			</tr><?php
			} ?>
	</table><br /><?php
} ?>