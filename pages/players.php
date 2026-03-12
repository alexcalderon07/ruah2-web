<?php
define('CACHE_FILE', 'cache/top_100_players_cache.json');
define('CACHE_TIME', 300); // 5 minutes in seconds
error_reporting(E_ERROR | E_PARSE);
function getTop100Players() {
	if (file_exists(CACHE_FILE) && (time() - filemtime(CACHE_FILE) < CACHE_TIME)) {
		// Use cached data if it exists and is less than 5 minutes old
		return json_decode(file_get_contents(CACHE_FILE), true);
	}

	// If cache doesn't exist or is outdated, fetch data from database
	global $database;
	$banned_ids = getBannedAccounts();
	$query = "SELECT id, name, account_id, level, exp, conquerorlevel 
              FROM player 
              WHERE name NOT LIKE '[%]%' " .
		($banned_ids ? "AND account_id NOT IN ($banned_ids) " : "") .
		"ORDER BY conquerorlevel DESC, level DESC, exp DESC, playtime DESC, name ASC 
              LIMIT 100";

	$stmt = $database->runQueryPlayer($query);
	$stmt->execute();
	$players = $stmt->fetchAll(PDO::FETCH_ASSOC);

	// Add empire information to each player
	foreach ($players as &$player) {
		$player['empire'] = get_player_empire($player['account_id']);
	}

	// Cache the result
	file_put_contents(CACHE_FILE, json_encode($players));

	return $players;
}

// Get the top 100 players
$top_players = getTop100Players();
?>

<div class="container">
	<div class="page-title">
		<h2 class=""><?php echo $lang['ranking']; ?> - <?php echo $lang['players']; ?></h2>
	</div>

	<table class="table table-hover top100-table">
		<thead class="thead-inverse">
		<tr class="header-row">
			<th>#</th>
			<th><?php echo $lang['name']; ?></th>
			<th><?php echo $lang['empire']; ?></th>
			<th class="level-table"><?php echo $lang['level']; ?></th>
			<th class="highlight-conqueror" style="text-align:center">Champion</th>
			<th class="exp-table">EXP</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($top_players as $index => $player): ?>
			<tr>
				<th scope="row">
					<?php if($index < 3) { ?>
						<img src="<?php print $site_url; ?>images/top-<?php print $index + 1; ?>.png" alt="top-<?php print $index + 1; ?>" />
					<?php } else { ?>
						<span class="text-highlight"><?php print $index + 1; ?>.</span>
					<?php } ?>
				</th>
				<td><?php echo htmlspecialchars($player['name']); ?></td>
				<td><img src="<?php print $site_url; ?>images/empire/<?php print $player['empire']; ?>.jpg" alt="<?php print emire_name($player['empire']); ?>" title="<?php print emire_name($player['empire']); ?>"></td>
				<td class="level-table text-highlight"><?php print $player['level']; ?></td>
				<td class="level-table highlight-conqueror" style="text-align:center"><?php print $player['conquerorlevel']; ?></td>
				<td class="exp-table"><?php print number_format($player['exp']); ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>
