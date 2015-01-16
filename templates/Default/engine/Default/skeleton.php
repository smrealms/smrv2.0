<?php
	//Branch the old views vs the new view
	if ($TemplateBody == 'map_combined.php') { 
		require('combined_old.php');
	} else {
		require('regular.php');
	}
?>
