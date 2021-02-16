<?php
	include 'assets/classes/class.database.php';
	include 'assets/constants.php';
	include 'assets/connect.php';

	$page = isset($_GET['page']) ? $_GET['page'] : 1;
	$skill = isset($_GET['skill']) ? $_GET['skill'] : "Overall";

	if (!is_numeric($page) || $page < 1)
		$page = 1;

	if (!isValidSkill($skill))
		$skill = "Overall";

	$mode = isset($_COOKIE['mode']) && is_numeric($_COOKIE['mode']) ? cleanInt($_COOKIE['mode']) : 0;

	if (isset($_GET['mode']) && is_numeric($_GET['mode'])) {
		setcookie("mode", $_GET['mode']);
		header("Location: index.php?skill=".$skill."");
		exit;
	}

	if (!isset($_GET['user']) && !isset($_GET['other'])) {
		$pages =  ceil($db->countUsers() / 25);

		if ($page > $pages) {
			$page = $pages;
		}
	}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Foxtrot Studios</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="assets/css/font-awesome.css" />
		<link rel="stylesheet" href="assets/css/style.css" />
	</head>
<body>

	<?php include 'assets/temps/global/navbar.php';?>

	<div class="container body-wrapper">
		<div class="col-xs-12 hs-header <?php echo (enable_modes ? "modes" : ""); ?>">
			<h1><?php echo strtoupper($skill); ?> HISCORES</h1>
			<?php if (enable_modes): ?>
			<p style="font-size:15px">
				Game Mode: <strong><?php echo $modes[$mode]; ?></strong>, Page: <strong>1</strong>
			</p>
			<?php endif; ?>
		</div>
		<div class="col-xs-12 text-center">
			<hr style="border-color:#333;">
			<?php
			if (!isset($_GET['user']) && !isset($_GET['other'])) {
				$next_disable = $page >= $pages ? "disabled" : "";
				$prev_disable = $page <= 1 ? "disabled" : "";

				echo '<a href="?skill='.$skill.'&page='.($page - 1).'" class="btn btn-default prev"><i class="fa fa-angle-left fa-fw"></i></a>';
				
				if (enable_modes) {
					$mode_keys = array_keys($modes);
					for ($i = 0; $i < count($modes); $i++) {
						$active = $mode == $mode_keys[$i] ? "active" : "";
						echo '<a class="btn btn-default '.$active.'" href="index.php?mode='.$mode_keys[$i].'&skill='.$skill.'" style="width:100px;">'.$modes[$mode_keys[$i]].'</a>';
					}
				} else {
					echo 'Page '.$page.' of '.$pages.'';
				}

				echo '<a href="?skill='.$skill.'&page='.($page + 1).'" class="btn btn-default next"><i class="fa fa-angle-right fa-fw"></i></a>';
			}
			?>
			<hr style="border-color:#333;">
		</div>
		<div class="col-xs-9">
			<?php
				if (isset($_GET['user'])) {
					include 'assets/temps/highscores/lookup.php';
				} else if (isset($_GET['player']) && isset($_GET['other'])) {
					include 'assets/temps/highscores/compare.php';
				} else {
					include 'assets/temps/highscores/main_table.php';
				}
			?>
		</div>
		<div class="col-xs-3">
			<?php include 'assets/temps/highscores/sidebar.php'; ?>
		</div>
	</div>

	<div class="footer_copyright">
		<p id="copyright">Copyright &copy; 2015 YourServer. Highscores created by King Fox</p>
	</div>

</body>
<script src="assets/js/jquery.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/smoothscroll.js"></script>
<script src="assets/js/custom.js"></script>
</html>
