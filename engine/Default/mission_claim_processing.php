<?php

if ($var['MissionID']) {
	create_error('red','Error','You can only have 3 missions at a time.');
}

$rewardText = $player->claimMissionReward($var['MissionID']);

forward(create_container('skeleton.php', 'map_combined.php', array('MissionMessage' => $rewardText)));
?>