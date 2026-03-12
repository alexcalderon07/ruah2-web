<div class="side-panel">
	<div class="panel-bg statistics-bg">
		<div class="panel-title">
			<span><?php print $lang['statistics']; ?></span>
		</div>
		<table class="table top10-table statistics-table table-sm table-hover mt-4">
			<tbody>
			<?php
			foreach($jsondataFunctions as $key => $status)
				if($key != 'active-registrations' && $key != 'players-debug' && $key != 'active-referrals' && $status)
				{
					?>
					<tr>
						<td><span class="highlight">&#x2022; &nbsp;</span><?php print $lang[$key]; ?></td>
						<td class="text-end stat-odometer" data-stat-key="<?php echo $key; ?>">
						  <div class="odometer">0</div>
						</td>
					</tr>
					<tr class="tr-separate">
						<td colspan="2"><div class="separate"></div></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>

		</br>
	</div>
</div>

