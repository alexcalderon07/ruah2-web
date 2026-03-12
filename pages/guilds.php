<?php
define('GUILD_CACHE_FILE', 'cache/top_100_guilds_cache.json');
define('GUILD_CACHE_TIME', 300); // 5 minutes in seconds
//disable warnings
error_reporting(E_ERROR | E_PARSE);
function getTop100Guilds() {
	if (file_exists(GUILD_CACHE_FILE) && (time() - filemtime(GUILD_CACHE_FILE) < GUILD_CACHE_TIME)) {
		// Use cached data if it exists and is less than 5 minutes old
		return json_decode(file_get_contents(GUILD_CACHE_FILE), true);
	}

	// If cache doesn't exist or is outdated, fetch data from database
	global $database;
	$query = "SELECT id, name, master, level, ladder_point, exp 
              FROM guild 
              WHERE name NOT LIKE '[%]%' 
              ORDER BY level DESC, ladder_point DESC, exp DESC, name ASC 
              LIMIT 100";

	$stmt = $database->runQueryPlayer($query);
	$stmt->execute();
	$guilds = $stmt->fetchAll(PDO::FETCH_ASSOC);

	// Add additional information for each guild
	foreach ($guilds as &$guild) {
		$guild['master_name'] = getPlayerName($guild['master']);
		$guild['empire'] = get_player_empire(getAccountID($guild['master']));
	}

	// Cache the result
	file_put_contents(GUILD_CACHE_FILE, json_encode($guilds));

	return $guilds;
}

// Get the top 100 guilds
$top_guilds = getTop100Guilds();
?>

<div class="container">
	<div class="page-title">
		<h2 class=""><?php print $lang['ranking']; ?> - <?php print $lang['guilds']; ?></h2>
	</div>

	<table class="table table-hover top100-table">
		<thead class="thead-inverse">
		<tr class="header-row">
			<th>#</th>
			<th><?php print $lang['guild']; ?></th>
			<th><?php print $lang['leader']; ?></th>
			<th><?php print $lang['empire']; ?></th>
			<th class="level-table"><?php print $lang['level']; ?></th>
			<th class="exp-table"><?php print $lang['points']; ?></th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($top_guilds as $index => $guild): ?>
			<tr>
				<th scope="row">
					<?php if($index < 3) { ?>
						<img src="<?php print $site_url; ?>images/top-<?php print $index + 1; ?>.png" alt="top-<?php print $index + 1; ?>" />
					<?php } else { ?>
						<span class="text-highlight"><?php print $index + 1; ?>.</span>
					<?php } ?>
				</th>
				<td><?php print htmlspecialchars($guild['name']); ?></td>
				<td class="text-highlight"><?php print htmlspecialchars($guild['master_name']); ?></td>
				<td><img src="<?php print $site_url; ?>images/empire/<?php print $guild['empire']; ?>.jpg" alt="<?php print emire_name($guild['empire']); ?>" title="<?php print emire_name($guild['empire']); ?>"></td>
				<td class="level-table text-highlight"><?php print $guild['level']; ?></td>
				<td class="exp-table"><?php print number_format($guild['ladder_point']); ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>
