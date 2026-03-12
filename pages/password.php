<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-11 col-md-12 col-sm-offset-2 col-md-offset-3">
            <form role="form" method="post" action="">
				<div class="page-title">
						<h2><?php if($message==7) print $lang['change-password']; else print $lang['account-recovery']; ?></h2>
				</div>
				<?php
					if(isset($myEmail) && isset($_GET['code']) && !empty($myEmail) && !empty($_GET['code']) && isValidEmail($myEmail))
					{
						if($message==6)
						{
							print '<div class="alert alert-danger" role="alert">';
							print $lang['incorrect-recovery'];
							print '</div>';
						}
						else if(isset($_POST['password']) && isset($_POST['rpassword']) && $message==9)
						{
							$message = 7;
							print '<div class="alert alert-danger" role="alert">';
							print $lang['no-password-r'];
							print '</div>';
						}
						else if(isset($_POST['password']) && isset($_POST['rpassword']) && $message==8)
						{
							$message = 11;
							print '<div class="alert alert-success" role="alert"> ';
							print $lang['success-change-password'];
							print '</div>';
						}
						else if(isset($_POST['password']) && isset($_POST['rpassword']) && $message==10)
						{
							$message = 7;
							print '<div class="alert alert-danger" role="alert">';
							print $lang['incorrect-password'];
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
							<td>
								<input class="form-control" name="password" id="password" pattern="(?=.*[A-Z])(?=.*[!@#$&]).{8,16}" maxlength="16" placeholder="<?php print $lang['password']; ?>" required="" title="Între 8 și 16 caractere permise. Must contain at least 1 capital letter and 1 symbol ( !@#$& )." type="password">
							</td>
						</tr>
						<tr>
							<td><?php print $lang['rpassword']; ?>:</td>
							<td>
								<input class="form-control" name="rpassword" id="rpassword" pattern="(?=.*[A-Z])(?=.*[!@#$&]).{8,16}" maxlength="16" placeholder="<?php print $lang['password']; ?>" required="" title="Între 8 și 16 caractere permise. Must contain at least 1 capital letter and 1 symbol ( !@#$& )." type="password">
							</td>
							<p class="text-danger" id="checkpassword"></p>
							</td>
						</tr>
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
							<td><?php print '<img src='.$site_url.'include/captcha/simple.php'.$_SESSION['captcha_lost']['image_src'].'>'; ?></td>
							<td><input style="height:70px; font-size: 30px;" class="form-control" name="captcha" pattern=".{4,6}" maxlength="5" placeholder="<?php print $lang['captcha-code']; ?>" required="" title="Maxim 15 caractere." type="text"></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
				<hr>
				<input type="submit" value="<?php if($message==7) print $lang['change-password']; else print $lang['account-recovery']; ?>" class="btn btn-<?php if($message==7) print 'success'; else print 'info'; ?> btn-lg btn-block" tabindex="7">
			<?php } ?>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    if (<?php echo $message; ?> == 7) {
        $('#password').on('input', function() {
            var password = $(this).val();
            var hint = $('#checkpassword');

            // Check for uppercase, symbol, and minimum length
            if (!/[A-Z]/.test(password) || !/[!@#$&]/.test(password) || password.length < 8) {
                hint.text('Password must contain at least 1 capital letter, 1 symbol ( !@#$& ), and be a minimum of 8 characters.');
            } else {
                hint.text('');
            }
        });

        // Override form submit
        $('form[role="form"]').on('submit', function(e) {
            var password = $('#password').val();

            // If password doesn't meet the criteria, prevent form submission
            if (!/[A-Z]/.test(password) || !/[!@#$&]/.test(password) || password.length < 8) {
                e.preventDefault();
                alert('Please ensure your password meets the required criteria.');
            }
        });
    }
});


</script>