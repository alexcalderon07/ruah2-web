<div class="container">
	<div class="page-title">
		<h2 class=""><?php print $lang['vote']; ?></h2>
	</div>
	<?php if(isset($voted_now) && isset($already_voted) && !$voted_now) { ?>
	<div class="alert alert-danger" role="alert">
		<?php print $lang['vote-again'].' <strong>'.$already_voted.'</strong>'; ?>
	</div>

	<?php } if(count($vote4coins)) { ?>
	<table class="table table-hover">
		<thead class="thead-inverse">
			<tr class="text-center">
				<th style="width: 15%">#</th>
				<th style="width: 30%">Site</th>

				<th style="width: 20%"><?php print $lang['time']; ?></th>
				<th><?php print $lang['vote']; ?></th>
			</tr>
		</thead>
		<tbody>
		<?php $i=1; foreach($vote4coins as $key => $vote) { ?>
			<tr class="text-center">
				<th scope="row"><?php print $i++; ?></th>
				<td><?php print $vote['name']; ?></td>
				<td><?php print $vote['time'].' '.$lang['hours']; ?></td>
				<td><a href="<?php print $site_url.'user/vote4bonus/'.$key; ?>" class="btn btn-primary btn-sm"><?php print $lang['vote']; ?></a></td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
	<?php } else { ?>
	<div class="alert alert-info" role="alert">
		<strong>Info!</strong> <?php print $lang['no-download-links']; ?>
	</div>
	<?php } ?>
</div>
