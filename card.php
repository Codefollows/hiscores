<?php
	include 'assets/constants.php';
	include 'assets/classes/class.database.php';
	include 'assets/classes/class.user.php';

	if (!isset($_GET['user']) || !is_string($_GET['user'])) {
		echo 'nope';
		exit;
	}

	$name = preg_replace('/[^A-Za-z0-9 _]/', '', $_GET['user']);
	$fname = strtolower(str_replace(" ", "_", $name));
	$filePath = 'assets/img/cache/'.$fname.'.png';

	if (file_exists($filePath)) {
		$curTime = explode(" ", microtime())[1];
		$timeDiff = $curTime - filemtime($filePath);

		if ($timeDiff < cache_time) {
			$image = imagecreatefrompng($filePath);
			header("Content-type: image/png");
			header("Content-Disposition: filename=".$fname.".png");
			imagepng($image);
			exit;
		}
	}

	include 'assets/connect.php';

	$result = $db->getUser($name);

	if ($result == null) {
		exit;
	}

	$user = new User($result);

	$image = imagecreatefrompng("assets/sigbg.png");
	$white = imagecolorallocate($image, 255, 255, 255);
	$black = imagecolorallocate($image, 0, 0, 0);

	imagettftext($image, 18, 0, 430, 38, $white, font, $user->getUsername().' #'.$db->getRank($result['username'], "overall", $result['mode']));
	imagettftext($image, 14, 0, 430, 65, $white, font, "Level: ".$user->getRealLevel());
	imagettftext($image, 14, 0, 430, 87, $white, font, "Exp: ".number_format($user->getTotalXp()));

	$skills = explode(",", skills);

	imagettftext($image, 14, 0, 430, 109, $white, font, "Total Lvl: ".number_format($result['total_level']));

	$baseX = 43;
	$baseY = 25;

	for ($i = 0; $i < count($skills); $i++) {
		if ($i == 5 || $i == 10 || $i == 15 || $i == 20) {
			$baseX += 81;
			$baseY = 25;
		}

		$level = $user->getLevel($skills[$i]);
		imagettftext($image, 13, 0, $baseX + 1, $baseY + 1, $black, font, $level);
		imagettftext($image, 13, 0, $baseX, $baseY, $white, font, $level);
		$baseY += 28;
	}

	header("Content-type: image/png");
	header("Content-Disposition: filename=".$fname.".png");

	imagepng($image, $filePath);
	imagepng($image);
?>
