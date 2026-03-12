<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-11 col-md-12 col-sm-offset-2 col-md-offset-3">
            <form role="form" method="post" action="">
				<div class="page-title">
					<h2 class=""><?php print $lang['change-email']; ?></h2>
				</div>
				<?php
					if(isset($_POST['email']) && isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response']))
					{
						if($message==4) {
							print '<div class="alert alert-info" role="alert">
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>';
							print $lang['sended-link'];
							print '</div>';
							
							$code = '<br><br><a href="'.$site_url.'user/email/'.$code.'" target="_blank" style="display: inline-block; color: #ffffff; background-color: #3498db; border: solid 1px #3498db; border-radius: 5px; box-sizing: border-box; cursor: pointer; text-decoration: none; font-size: 14px; font-weight: bold; margin: 0; padding: 12px 25px; text-transform: capitalize; border-color: #3498db;">'.$lang['change-email'].'</a>';

							
							$alt_message = $lang['change-email'];
							$subject = $lang['change-email'];
							$sendName = getAccountName($_SESSION['id']);
							$sendEmail = $myEmail;
								
							$html_mail = sendCode($_POST['email'], $code, 5);
							include 'include/functions/sendEmail.php';
						} else if($message==5)
						{
							print '<div class="alert alert-danger" role="alert">
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>';
							print $lang['incorrect-recovery'];
							print '</div>';
						} else if($message==3)
						{
							print '<div class="alert alert-danger" role="alert">
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>';
							print $lang['incorrect-security'];
							print '</div>';
						} else if($message==2)
						{
							print '<div class="alert alert-danger" role="alert">
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>';
							print $lang['incorrect-email'];
							print '</div>';
						} else if($message==1)
						{
							print '<div class="alert alert-danger" role="alert">
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>';
							print $lang['already-email'];
							print '</div>';
						}
					}
					
				if($message!=11) {
				?>
				<table class="table table-hover">
					<tbody>
						<?php if($message==7) { ?>
						<tr>
							<td><?php print $lang['password']; ?>:</td>
							<td><input class="form-control" name="password" id="password" pattern=".{5,16}" maxlength="16" placeholder="<?php print $lang['password']; ?>" required="" title="Între 5 și 16 caractere permise." type="password"></td>
						</tr>
						<tr>
							<td><?php print $lang['rpassword']; ?>:</td>
							<td><input class="form-control" name="rpassword" id="rpassword" pattern=".{5,16}" maxlength="16" placeholder="<?php print $lang['password']; ?>" required="" title="Între 5 și 16 caractere permise." type="password">
							<p class="text-danger" id="checkpassword"></p>
							</td>
						</tr>
						<?php } else { ?>
						<tr>
							<td><?php print $lang['new-email-address']; ?>:</td>
							<td><input class="form-control" name="email" pattern=".{7,64}" maxlength="64" placeholder="<?php print $lang['email-address']; ?>" required="" title="Maxim 64 caractere." type="email"></td>
						</tr>
						<tr>
							<td><?php print $lang['captcha-code']; ?>:</td>
							<td><div class="g-recaptcha" data-theme="dark" data-sitekey="<?php print $captchakey; ?>"></div></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
				<hr>
				<input type="submit" value="<?php print $lang['change-email']; ?>" class="btn btn-info btn-lg btn-block" tabindex="7">
			<?php } ?>
            </form>
        </div>
    </div>
</div>
