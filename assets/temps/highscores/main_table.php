<?php
	if (count(get_included_files()) <= 1) {
		exit; # do not remove
	}

	$skill_sort = strtolower($skill).'_xp';
	$pages =  ceil($db->countUsers() / 25);

	if ($pages > 20)
		$pages = 20;
?>

<table class="table" style="margin-top: 0;">
	<tr>
		<td style="width:30px;"></td>
		<td style="width:30px;"></td>
		<td style="width:130px;">Username</td>
		<td style="width:130px;"class="text-right">Combat</td>
		<td style="width:130px;"class="text-right">Total Level</td>
		<td style="width:130px;"class="text-right">Experience</td>
		<td style="width:130px;"class="text-right">Completion</td>
	</tr>
	<?php
		$min = $page == 1 ? 0 : ($page * 25) - 25;

		$users = null;
		
		if (enable_modes) {
			$users = $db->getAllUsers($skill_sort, $min, $mode);
		} else {
			$users = $db->getAllUsers($skill_sort, $min);
		}

		$rank = $min + 1;

		foreach($users as $user) {

			$username = ucwords(strip_tags($user['username']));
			$username = str_replace("_", " ", $username);

			echo '<tr>';

			switch ($user['rights']) {
				case 1:
					echo '<td style="width:30px;text-align:right;"><img src="assets/img/mod.gif" style="vertical-align:middle"/></td>';
					break;
				//case 2:
				//	echo '<td style="width:30px;text-align:right;"><img src="assets/img/silver.png" width="16" height="16" style="vertical-align:middle"/></td>';
				//	break;
				case 3:
					echo '<td style="width:30px;text-align:right;"><img src="assets/img/bronze.png" style="vertical-align:middle"/></td>';
					break;
				case 4:
					echo '<td style="width:30px;text-align:right;"><img src="assets/img/silver.png" style="vertical-align:middle"/></td>';
					break;
				case 5:
					echo '<td style="width:30px;text-align:right;"><img src="assets/img/gold.png" style="vertical-align:middle"/></td>';
					break;
				default:
					echo '<td style="width:30px;text-align:right;"></td>';
					break;
			}

			$exp = $user[$skill_sort];
			$max = strtolower($skill) == "overall" ? 5000000000 : 200000000;
			$perc = (($exp / $max) * 100);

			$level = (strtolower($skill) == "overall" ? getTotalLevel($user) : getLevelForXp($exp, $skill));

			echo '<td style="width:30px;">'.$rank.'</td>';
			echo '<td style="width:130px;"><a href="?user='.$user['username'].'">'.$username.'</a></td>';
			echo '<td style="width:130px;" class="text-right">'.number_format(getLevel($user)).'</td>';
			echo '<td style="width:130px;" class="text-right">'.number_format($level).'</td>';
			echo '<td style="width:130px;" class="text-right">'.number_format($exp).'</td>';
			echo '<td style="width:160px;" class="text-right">
					<div class="progress progress-striped active" style="margin:0;text-align:center;">
						<div class="percent">'.number_format($perc, 0).'%</div>
						<div class="progress-bar" style="width: '.$perc.'%;"></div>
					</div>
				  </td>';
			echo '</tr>';
			$rank++;
		}
	?>
</table>

<?php
	if ($page != 1) {
		echo '<a href="?skill='.$skill.'&page='.($page - 1).'" class="btn btn-default">Prev Page</a>';
	}
	if ($pages > 1 && $page < $pages) {
		echo '<a href="?skill='.$skill.'&page='.($page + 1).'" class="btn btn-default">Next Page</a>';
	}
?>
