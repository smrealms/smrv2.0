<?php
	//Branch the old views vs the new view
	if ($TemplateBody == 'map_combined.php') { 
		require('combined.php');
	} else {
		require('regular.php');
	}
?>
