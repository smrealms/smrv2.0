<?php

class SMR_BATTLE extends SmrMySqlDatabase
{
	var $fleet;
	var $chosen;

	function SMR_BATTLE($initiator_id, $game_id, $nocap = FALSE)
	{
		// make sector object global
		global $sector;

		// initialize array that holds the team player objects
		$this->fleet = array();
		$this->chosen = array();

		// time to ignore players
		$last_active = TIME - 259200;

		// create a account object from the given player
		$initiator_account =& SmrAccount::getAccount($initiator_id);

		// get our rank
		$rank_id = $initiator_account->get_rank();

		// create a player object from the given player
		$initiator =& SmrPlayer::getPlayer($initiator_id, $game_id);

		//put this guy in the arry
		$this->fleet[] = $initiator_id;

		// get a list of ppl who attack with us
		if ($initiator->alliance_id > 0)
		{
			$this->query('SELECT * FROM player ' .
						 'WHERE game_id = '.$game_id.' AND ' .
							   'alliance_id = '.$initiator->alliance_id.' AND ' .
							   'account_id != '.$initiator_id.' AND ' .
							   'newbie_turns = 0 AND ' .
							   'sector_id = '.$initiator->sector_id.' AND ' .
							   'last_cpl_action > '.$last_active.' AND ' .
							   'land_on_planet = \'FALSE\' ' .
						 'ORDER BY rand()');
			if(!$nocap) $max_fleet_size = 10;
			else $max_fleet_size = 30;

			while ($this->nextRecord() && $this->get_fleet_size() <= $max_fleet_size)
			{
				$curr_player =& SmrPlayer::getPlayer($this->getField('account_id'), $game_id);

				if (!$curr_player->hasFederalProtection())
				{
					// add to fleet
					$this->fleet[] = $this->getField('account_id');
				}
			}
		}
	}

	function next($check)
	{
		// we already got each id so we reset the whole thing
		if (count($this->chosen) == count($this->fleet))
			$this->chosen = array();

		while (true)
		{
			// get the id of the next index
			$index = mt_rand() % count($this->fleet);

			// take this value either if we don't should check it or
			// if this value wasn't chosen before.
			if (!$check || !isset($this->chosen[$index]))
			{
				// mark this value as choosen
				if ($check)
					$this->chosen[$index] = true;

				// return it
				return $this->fleet[$index];
			}
		}
	}

	function get_fleet_size()
	{
		return count($this->fleet);
	}
}

?>