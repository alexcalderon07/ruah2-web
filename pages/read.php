<div class="mt2cms2-c-l">
	<div class="page-title">
		<ul class="news-list my-2">
			<li class="news-hovered">
				<span class="news-badge">[News]</span>
				<span class="news-content"><a href="<?php print $site_url; ?>read/<?php print $article['id']; ?>"><?php print $article['title']; ?></a></span>
				<span class="news-date"><?php print $article['time']; ?></span>
			</li>
		</ul>
	</div>
	<?php	
		if(!$offline && $database->is_loggedin())
			if($web_admin>=$jsondataPrivileges['news'])
				include 'include/functions/edit-news.php';
	?>
    <div class="p-3 news-read">

		<?php
		if(!$offline && $database->is_loggedin())
			if($web_admin>=$jsondataPrivileges['news'])
			{
				?>
				<a href="<?php print $site_url; ?>?delete=<?php print $read_id; ?>" onclick="return confirm('<?php print $lang['sure?']; ?>');">
					<i style="color:red;" class="bi bi-trash3" aria-hidden="true"></i>
				</a>
				<?php
			}
		?>
			<div class="text">
				<div>
					<div class="copy">
						<?php print $article['content']; ?>
					</div>
				</div>
			</div>

    </div>
</div>
