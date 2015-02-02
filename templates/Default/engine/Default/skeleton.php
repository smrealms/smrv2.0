<?php
	//Branch the old views vs the new view
	if (!isset($GameID)) { 
		require('regular.php');
	} else {
		require('combined_old.php');
	}
?>
