<div class="side-panel">
	<div class="panel-bg text-center">
			<div class="panel-title">
				<span class="title"><?php print $lang['user-panel']; ?></span>
				<a class="subtitle" href="<?php print $site_url;?>users/register"><?php print $lang['register'];?></a>
			</div>
		<?php if($offline || !$database->is_loggedin()) { ?>
			<div class="row justify-content-center mt-4">
				<div class="col-10">
					<form class="form" role="form" method="post" action="<?php print $site_url; ?>users/login" accept-charset="UTF-8" id="login-nav">
						<div class="input-group mb-3">
							<span class="input-group-text" id="user-addon"><i class="bi bi-person-fill"></i></span>
							<input type="text" name="username" pattern=".{5,64}" maxlength="64" class="form-control" placeholder="<?php print $lang['user-name-or-email']; ?>" autocomplete="off" <?php if($offline) print 'disabled'; else print 'required'; ?>>
						</div>
						<div class="input-group mb-3">
							<span class="input-group-text" id="password-addon"><i class="bi bi-lock-fill"></i></span>
							<input type="password" name="password" pattern=".{5,16}" maxlength="16" class="form-control" placeholder="<?php print $lang['password']; ?>" <?php if($offline) print 'disabled'; else print 'required'; ?>>
						</div>
						<div class="form-group">
							<center><div align="center"  class="g-recaptcha" data-theme="dark" data-sitekey="<?php print $captchakey; ?>" style="transform: scale(0.51457);
  transform-origin: 0px 0px 0px;
  margin: auto;
  max-width: 150px; max-height: 55px"></div></center>
						</div>
						<div class="form-group" style="margin-top: -10px;">
							<input type="submit" class="btn-image mb-1 m-auto" value="<?php print $lang['login']; ?>"<?php if($offline) print ' disabled'; ?>>
						</div>
					</form>
					<?php if(!$offline) { ?>
							<div class="text-start mb-3 login-links">
								<a class="text-muted d-block" href="<?php print $site_url; ?>users/lost"><?php print $lang['forget-password']; ?></a>
								<a class="text-muted" href="<?php print $site_url; ?>users/register">
									<?php print $lang['no-account']; ?> <span class="highlight"><?php print $lang['register-now']; ?></span>
								</a>
							</div>
					<?php } ?>
				</div>
			</div>
			<?php } else { ?>
			<div class="list-group-new mt-2">
				<?php if($web_admin) { ?>
				<a href="<?php print $site_url; ?>admin" class="list-group-item list-group-item-action"><?php print $lang['administration']; ?></a>
				<?php 
					if($web_admin>=$jsondataPrivileges['donate']) {
						$count_donations = count(get_donations());
						if($count_donations)
						{
				?>	
				<a href="<?php print $site_url; ?>admin/donatelist" class="list-group-item list-group-item-action"><?php print $lang['donatelist']; ?> <span class="tag tag-info tag-pill float-xs-right"><?php print $count_donations.' '.$lang['new-donations']; ?> </span></a>
				<?php
						}
					}
				}
				$vote4coins = file_get_contents('include/db/vote4coins.json');
					$vote4coins = json_decode($vote4coins, true);
					
					if(count($vote4coins))
						print '<a href="'.$site_url.'user/vote4bonus" class="list-group-item list-group-item-action">Vote4Bonus</a>';
					
					$donate = file_get_contents('include/db/donate.json');
					$donate = json_decode($donate, true);
					
					if(count($donate))
						print '<a href="'.$site_url.'user/donate" class="list-group-item list-group-item-action">'.$lang['donate'].'</a>';
				?>
				<a href="<?php print $site_url; ?>user/administration" class="list-group-item list-group-item-action"><?php print $lang['account-data']; ?></a>
				<a href="<?php print $site_url; ?>user/characters" class="list-group-item list-group-item-action"><?php print $lang['chars-list']; ?></a>
				<a href="<?php print $site_url; ?>user/redeem" class="list-group-item list-group-item-action"><?php print $lang['redeem-codes']; ?></a>
				<?php if($jsondataFunctions['active-referrals']) { ?>
				<a href="<?php print $site_url; ?>user/referrals" class="list-group-item list-group-item-action"><?php print $lang['referrals']; ?></a>
				<?php } if($item_shop!="" && $database->is_loggedin()) { ?>
					
						<a  href="https://ameria.to/gateway/?uid=<?=getAccountName($_SESSION['id']);?>&uem=<?=getAccountEmail($_SESSION['id']);?>"><?php print $lang['donate']; ?></a>
					
				<?php } else { ?>
					
						<a  href="https://ameria.to/gateway/"><?php print $lang['donate']; ?></a>
				
					<?php } ?>
				<a href="<?php print $site_url; ?>users/logout" class="list-group-item list-group-item-action text-danger"><?php print $lang['logout']; ?></a>
				<?php if($web_admin) { ?>
				<a href="#" class="list-group-item list-group-item-action disabled">web_admin <?php print $web_admin; ?></a>
				<?php } ?>
			</div>
			<?php } ?>
</div>
</div>
