<div class="side-panel mt-5">

	<div class="panel-title">
		<span><?php print $lang['guilds']; ?></span>
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
			</tr>
			<?php
			if (!$offline) {
				$top = array();
				$top = top10guilds();

				$i = 1;

				foreach ($top as $guild) {
					?>
					<tr>
						<th scope="row">
							<?php if($i <= 3) { ?>
								<img src="<?php print $site_url; ?>images/top-<?php print $i; ?>.png" alt="top-<?php print $i++; ?>" />
							<?php } else { ?>
								<span class="text-highlight"><?php print $i++; ?>.</span>
							<?php } ?>
						</th>
						<td><?php print $guild['name']; ?></td>
						<td>
							<span class="empire-<?php print $empire = get_guild_empire($guild['master']); ?>"><?php print emire_name($empire); ?></span>
						</td>
						<td><span class="text-highlight"><?php print $guild['level']; ?></span></td>
					</tr>
				<?php }

			} else print $offline_guilds;
			?>
			</tbody>
		</table>

		<center>
			<?php if (!$offline) { ?>
				<a href="<?php print $site_url; ?>ranking/guilds" class="btn-image" >Top 100 &raquo;</a>
			<?php } else print '<span class="tag tag-danger">' . $lang['server-offline'] . '</span></br><span class="tag tag-danger">' . $lang['last-update'] . ': ' . $offline_date . '</span>'; ?>
		</center>
		</br>
	</div>
</div>
