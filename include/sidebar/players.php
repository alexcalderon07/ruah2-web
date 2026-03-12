<div class="side-panel mt-5">

		<div class="panel-title">
			<span><?php print $lang['players']; ?></span>
			<a class="subtitle" href="<?php print $site_url;?>ranking/players">Top 100 +</a>
		</div>
		<div class="ranking-panel-bg">
		<table class="table top10-table table-sm table-hover mt-1">
			<tbody>
			<tr class="header-row">
				<th>
					#
				</th>
				<th>
					<?php print $lang['name']; ?>
				</th>
				<th>
					<?php print $lang['empire']; ?>
				</th>
				<th>
					<?php print $lang['level']; ?>
				</th>
				<th style="text-align:center">
					Champion
				</th>
			</tr>
			<?php
			if (!$offline) {
				$top = array();
				$top = top10players();

				$i = 1;

				foreach ($top as $player) {
?>
					<tr>
						<th scope="row">
							<?php if($i <= 3) { ?>
							<img src="<?php print $site_url; ?>images/top-<?php print $i; ?>.png" alt="top-<?php print $i++; ?>" />
							<?php } else { ?>
							<span class="text-highlight"><?php print $i++; ?>.</span>
							<?php } ?>
						</th>
						<td><?php print $player['name']; ?></td>
						<td>
							<span class="empire-<?php print $empire = get_player_empire($player['account_id']); ?>"><?php print emire_name($empire); ?></span>
						</td>
						<td><span class="text-highlight"><?php print $player['level']; ?></span></td>
						<td class="highlight-conqueror" style="text-align:center"><span ><?php print $player['conquerorlevel']; ?></span></td>
					</tr>
				<?php }

			} else print $offline_players;
			?>
			</tbody>
		</table>

		<center>
			<?php if (!$offline) { ?>
				<a href="<?php print $site_url; ?>ranking/players" class="btn-image" >Top 100 &raquo;</a>
			<?php } else print '<span class="tag tag-danger">' . $lang['server-offline'] . '</span></br><span class="tag tag-danger">' . $lang['last-update'] . ': ' . $offline_date . '</span>'; ?>
		</center>
		</br>
	</div>
</div>
