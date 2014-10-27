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
if (isset($ThisSector)) {
	$url = ''; $size = ''; $position = '';
	if ($ThisSector->hasPlanet()) { 
		$planet = $ThisSector->getPlanet();
		$url .= 'url("'.$planet->getImage().'"),'; 
		$size .= '150% auto,';
		$position .= 'center -20%,';
	} 
	if($ThisSector->hasFeature()) {
		$url .= 'url("'.$ThisSector->getFeatureImage().'"),';
		$size .= $ThisSector->getFeatureSize().',';
		$position .= $ThisSector->getFeatureLocation().',';
	} 
	if ($url != '') {
		echo '<script type="text/javascript">$("body").css({';
		echo " 'background-image' : '".rtrim($url, ",")."',";
		echo " 'background-size' : '".rtrim($size, ",")."',";
		echo " 'background-position' : '".rtrim($position, ",")."',";
		echo " 'background-repeat' : 'no-repeat'";
		echo "})</script>";
	}
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
} ?>

<script>

	$("#planet_selector").on("click",".selectable", function(event, path){
		
		/*console.log($(event.delegateTarget).find(".selectable"));*/
		$(event.delegateTarget).find(".selectable").each(function(){
			var me = $(this);
			if (me.hasClass("selected")){
				me.removeClass("selected");
			}
			
		});
		
		$(event.target).addClass("selected");
		
		$("#planetEdit > input[name=image]").attr("value", "images/planets/" + $(event.target).attr("data-name"));
	
	});
	function planetSelect(obj){
		console.log(obj);		
	}
	
	
</script>
