<div class="page-title">
	<h2 class=""><?php if($message==7) print $lang['change-password']; else print $lang['account-recovery']; ?></h2>
</div>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-11 col-md-12 col-sm-offset-2 col-md-offset-3">
            <form role="form" method="post" action="">

				<?php
					if(isset($_GET['email']) && isset($_GET['code']) && !empty($_GET['email']) && !empty($_GET['code']) && isValidEmail($_GET['email']))
					{
						if($message==6)
						{
							print '<div class="alert alert-danger" role="alert">
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>';
							print $lang['incorrect-recovery'];
							print '</div>';
						}
						else if(isset($_POST['password']) && isset($_POST['rpassword']) && $message==9)
						{
							$message = 7;
							print '<div class="alert alert-danger" role="alert">
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>';
							print $lang['no-password-r'];
							print '</div>';
						}
						else if(isset($_POST['submit']) && $message==8)
						{
							$message = 11;
							print '<div class="alert alert-success" role="alert">';
							print '<p> Your password is: '.$password_generated.'</p>';
							print $lang['success-change-password'];
							print '</div>';
							print("<script>downloadTxtFile('password: ".$password_generated."');</script>");

						}
						else if(isset($_POST['password']) && isset($_POST['rpassword']) && $message==10)
						{
							$message = 7;
							print '<div class="alert alert-danger" role="alert">
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>';
							print $lang['incorrect-password'];
							print '</div>';
						}
					} else if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response']))
					{
						if($message==5)
						{
							print '<div class="alert alert-danger" role="alert">
							  ';
							print $lang['incorrect-security'];
							print '</div>';
						}
						else {
							print '<div class="alert alert-info" role="alert">
							 ';
							print $lang['email-recovery'];
							print '</div>';
							
							if($message==1)
							{
								$alt_message = $lang['code-delete-chars'];
								$subject = $lang['account-recovery'];
								$sendName = $_POST['username'];
								$sendEmail = $_POST['email'];
								
								$code = generateSocialID(32);
								update_passlost_token($_POST['username'], $code);
								$html_mail = recoveryPassword($code, $_POST['email'], $_POST['username']);
								include 'include/functions/sendEmail.php';
							}
						}
					}
					
				if($message!=11) {
				?>
				<table class="table table-hover">
					<tbody>
						<?php if($message==7) { ?>
						<div class="alert alert-info">
							Click on button to generate a new passowrd. 
						</div>
						<?php } else { ?>
						<tr>
							<td><?php print $lang['user-name']; ?>:</td>
							<td><input class="form-control" name="username" pattern=".{5,16}" maxlength="16" pattern="[A-Za-z0-9]" placeholder="<?php print $lang['user-name']; ?>..." required="" title="Între 5 și 16 caractere permise." type="text" autocomplete="off"></td>
						</tr>
						<tr>
							<td><?php print $lang['email-address']; ?>:</td>
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
				<input name="submit" type="submit" value="<?php if($message==7) print $lang['change-password']; else print $lang['account-recovery']; ?>" class="btn btn-<?php if($message==7) print 'success'; else print 'info'; ?> btn-lg btn-block m-auto" tabindex="7">
			<?php } ?>
            </form>
        </div>
    </div>
</div>
