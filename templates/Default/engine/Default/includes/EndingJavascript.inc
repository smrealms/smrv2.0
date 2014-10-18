<script type="text/javascript" src="js/jquery.hotkeys.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>
<!-- <script type="text/javascript" src="js/smrConfirm.js"></script> -->

<?php
if(!empty($js)) {
	?><script type="text/javascript" src="<?php echo $js; ?>"></script><?php
}
foreach($this->jsAlerts as $string) {
	?>alert(<?php echo json_encode($string); ?>);<?php
} 
if($AJAX_ENABLE_REFRESH) {
	$AvailableLinks = Globals::getAvailableLinks();
	?><script type="text/javascript">$(function(){
		startRefresh('<?php echo $AJAX_ENABLE_REFRESH; ?>');<?php
		foreach($AvailableLinks as $LinkName => $AvailableLink) {
			$Hotkeys = $ThisAccount->getHotkeys($LinkName);
			foreach($Hotkeys as $Hotkey) {
				?>$(document).bind('keydown', '<?php echo addslashes($Hotkey); ?>', followLink('<?php echo $AvailableLink; ?>'));<?php
			}
		} ?>
	})</script><?php
}

if($ThisSector->hasPlanet()) {
	$planet =& $ThisSector->getPlanet(); 
	$image = $planet->getImage();
	?><!-- JavaScript to modify the background of body with the planet image; jQuery dependent -->
	<script type="text/javascript">
		$("body").css({
			'background-image' : 'url("<?php echo $image; ?>")',
			'background-size' : '150% auto',
			'background-position' : 'center -20%',
			'background-repeat' : 'no-repeat'
			});
	</script><?php
} ?>