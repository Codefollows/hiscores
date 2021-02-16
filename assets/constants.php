<?php
	$sql_host = "localhost";
	$sql_user = "root";
	$sql_pass = "mysql";
	$sql_data = "foxtrot_highscores";

	$table = "hs_users";

	define("skills", "Overall,Attack,Defence,Strength,Constitution,Ranged,Prayer,Magic,Cooking,Woodcutting,Fletching,Fishing,Firemaking,Crafting,Smithing,Mining,Herblore,Agility,Thieving,Slayer,Farming,Runecrafting,Hunter,Construction,Summoning,Dungeoneering");

	define("enable_modes", 1); //0 = disable, 1 = enabled

	$modes = array( // id => title
		0 => "Easy",
		1 => "Normal",
		2 => "Hard",
		3 => "Iron Man",
	);

	# playercard
	define("font", "assets/fonts/Oswald-Regular.ttf");
	define("cache_time", 300); #seconds - 300 = 5 minutes

	function formatName($string) {
		return ucwords(str_replace("_", " ", $string));
	}

	function cleanString($string) {
		return filter_var(preg_replace("/[^A-Za-z0-9_ ]/", ' ', $string), FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_HIGH);
	}

	function cleanInt($string) {
		return  filter_var(preg_replace("/[^0-9]/", ' ', $string), FILTER_SANITIZE_STRING);
	}

	function isValidEmail($email) {
		return filter_var($email, FILTER_VALIDATE_EMAIL);
	}

	function getSkills() {
		return explode(",", skills);
	}

	function isValidSkill($skill) {
		foreach (getSkills() as $skillName) {
			if (strtolower($skill) == strtolower($skillName)) {
				return true;
			}
		}
		return false;
	}

	function getTotalLevel($user) {
		$total = 0;
		foreach (getSkills() as $skill) {
			if (strtolower($skill) == "overall")
				continue;
			$skillName = strtolower($skill).'_xp';
			$total += getLevelForXp($user[$skillName], $skill);
		}
		return $total;
	}

	function getLevelForXp($exp, $skill) {
		$points = 0;
		$output = 0;
		for ($lvl = 1; $lvl <= (strtolower($skill) == 'dungeoneering' ? 120 : 99); $lvl++) {
			$points += floor($lvl + 300.0 * pow(2.0, $lvl / 7.0));
			$output = (int) floor($points / 4);
			if (($output - 1) >= $exp) {
				return $lvl;
			}
		}
		return (strtolower($skill) == 'dungeoneering' ? 120 : 99);
	}

	function getXPForLevel($level) {
		$points = 0;
		$output = 0;
		for ($lvl = 1; $lvl <= $level; $lvl++) {
			$points += floor($lvl + 300.0 * pow(2.0, $lvl / 7.0));
			if ($lvl >= $level) {
				return $output;
			}
			$output = (int) floor($points / 4);
		}
		return 0;
	}

	function getCombatLevel($row) {
		$attack = getLevelForXp($row['attack_xp'], "");
		$defence = getLevelForXp($row['defence_xp'], "");
		$strength = getLevelForXp($row['strength_xp'], "");
		$hp = getLevelForXp($row['constitution_xp'], "");
		$prayer = getLevelForXp($row['prayer_xp'], "");
		$ranged = getLevelForXp($row['ranged_xp'], "");
		$magic = getLevelForXp($row['magic_xp'], "");
		$combatLevel = (int) (($defence + $hp + floor($prayer / 2)) * 0.25) + 1;
		$melee = ($attack + $strength) * 0.325;
		$ranger = floor($ranged * 1.5) * 0.325;
		$mage = floor($magic * 1.5) * 0.325;

		if ($melee >= $ranger && $melee >= $mage) {
			$combatLevel += $melee;
		} else if ($ranger >= $melee && $ranger >= $mage) {
			$combatLevel += $ranger;
		} else if ($mage >= $melee && $mage >= $ranger) {
			$combatLevel += $mage;
		}
		return (int)$combatLevel;
	}

	function getLevel($row) {
		return (int)(getCombatLevel($row) + getSummoningCombatLevel($row));
	}

	function getSummoningCombatLevel($row) {
		return getLevelForXp($row['summoning_xp'], "") / 8;
	}

?>
