
<div class="page-title d-flex justify-content-around">
	<h2 class=""><?php print $lang['news']; ?></h2>
	<h6 class="page-subtitle">All News</h6>
</div>
<!--	<div class="d-block d-sm-block d-md-block d-lg-block d-xl-block">-->
<!--		<div class="row" style="padding:15px">-->
<!---->
<!--			<widgetbot-->
<!--				server="1021506625518964767"-->
<!--				channel="1163055412241780817"-->
<!--				width="100%"-->
<!--				height="750"-->
<!--			></widgetbot>-->
<!--			<script src="https://cdn.jsdelivr.net/npm/@widgetbot/html-embed"></script>-->
<!---->
<!--		</div>-->
<!--		<br>-->
<!--	</div>-->
			<!-- carousel with 3 images -->

			<?php

				if($web_admin>=$jsondataPrivileges['news'])
					include 'include/functions/add-news.php';

			?>
<ul class="news-list">
			<?php
			if (version_compare($php_version = phpversion(), '5.6.0', '<')) {
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<span>Metin2CMS works with a PHP version >= 5.6.0. At this time, the server is running version <?php print $php_version; ?>.</span>
			</div>
			<?php
			}
			$query = "SELECT * FROM news ORDER BY id DESC";
			$records_per_page=intval(getJsonSettings("news"));
			$newquery = $paginate->paging($query,$records_per_page);
			$paginate->dataview($newquery, $lang['sure?'], $web_admin, $jsondataPrivileges['news'], $site_url, $lang['read-more']);
			$paginate->paginglink($query,$records_per_page,$lang['first-page'],$lang['last-page'],$site_url);
		?>
</ul>


