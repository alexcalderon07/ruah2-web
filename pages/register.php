<div class="page-title">
	<h2 class=""><?php print $lang['register']; ?></h2>
</div>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-11 col-md-12 col-sm-offset-2 col-md-offset-3">

			<?php
			$promoterCode = null;
			if(isset($_GET['promoter'])) {
					if(get_promoter_by_code($_GET['promoter'])){
						$promoter = get_promoter_by_code($_GET['promoter']);
						$promoterCode = $_GET['promoter'];

				?>

				<div class="alert alert-info" role="alert">
					<strong>You are registering with promoter code:</strong> <?php print $_GET['promoter']; ?>
				</div>
						<?php } else { ?>
							<div class="alert alert-danger" role="alert">
								<strong>Invalid Promoter Code</strong>
							</div>
						<?php } ?>
			<?php } ?>
		<?php if($jsondataFunctions['active-registrations']==1) { ?>
            <form role="form" method="post" action="" id="registrationForm">
				<?php
					include 'include/functions/register.php';

				?>
				<table class="table table-hover">
					<tbody>
								<div class="alert alert-info" role="alert">
				<strong>Use a different password than other servers!</strong>
			</div>
						<tr>
							<td><?php print $lang['user-name']; ?>:</td>
							<td><input class="form-control" name="username" id="username" pattern=".{5,16}" maxlength="16" pattern="[A-Za-z0-9]" placeholder="<?php print $lang['user-name']; ?>..." required="" type="text" autocomplete="off">
							<p class="text-danger" id="checkname"></p>
							<p class="text-danger" id="checkname2"></p>
							</td>
						</tr>
					
						<tr>
							<td><?php print $lang['email-address']; ?>:</td>
							<td><input class="form-control" name="email" id="email" pattern=".{7,64}" maxlength="64" placeholder="ex@test.com" required="" type="email">
							<p class="text-danger" id="checkemail"></p>
							</td>
						</tr>
						<tr>
							<td><?php print $lang['password']; ?>:</td>
							<td>
								<input class="form-control" name="password" id="password" pattern="(?=.*[A-Z])(?=.*[!@#$&]).{8,16}" maxlength="16" placeholder="<?php print $lang['password']; ?>" required="" type="password">

								<p class="text-danger" id="passwordHint"></p>
							</td>
						</tr>
						<tr>
							<td><?php print $lang['rpassword']; ?>:</td>
							<td><input class="form-control" name="rpassword" id="rpassword" pattern="(?=.*[A-Z])(?=.*[!@#$&]).{8,16}" maxlength="16" placeholder="<?php print $lang['password']; ?>" required="" type="password">
							<p class="text-danger" id="checkpassword"></p>
							</td>
						</tr>
						<tr>
							<td>Promoters</td>
							<td>
								<select class="form-control" name="promoter" id="promoter">
									<option value="">Select promoter</option>
									<?php
									$promoters = get_all_promoters();
									foreach($promoters as $p){
										$selected = ($promoterCode !== null && $promoterCode == $p['code'] ? 'selected' : '');
										echo '<option value="'.htmlspecialchars($p['code']) . '"'.$selected.'>'.htmlspecialchars($p['code']).'</option>';
									}
									
									?>
								</select>
								<p class="text-danger" id="checkpromoter"></p>
							</td>
						</tr>
						<tr>
							<td><?php print $lang['captcha-code']; ?>:</td>
							<td><div class="g-recaptcha" data-theme="dark" data-sitekey="<?php print $captchakey;?>"></div></td>
						</tr>
					</tbody>
				</table>
				<hr>
				<input type="submit" value="<?php print $lang['register']; ?>" class="btn-image m-auto" tabindex="7">
            </form>
		<?php } else { ?>
			<div class="alert alert-info" role="alert">
				<strong>Info!</strong> <?php print $lang['disabled-registrations']; ?>
			</div>
		<?php } ?>
        </div>
    </div>


</div>
<script>
$(document).ready(function() {
    $('#password').on('input', function() {
        var password = $(this).val();
        var hint = $('#passwordHint');

        // Check for uppercase, symbol, and minimum length
        if (!/[A-Z]/.test(password) || !/[!@#$&]/.test(password) || password.length < 8) {
            hint.removeClass('text-success').addClass('text-danger');
            hint.text('Password must contain at least 1 capital letter, 1 symbol ( !@#$& ), and be a minimum of 8 characters.');
        } else {
            hint.removeClass('text-danger').addClass('text-success');
            hint.text('Password is good.');
        }
    });

    // Override form submit for this specific form
    $('#registrationForm').on('submit', function(e) {
        var password = $('#password').val();

        // If password doesn't meet the criteria, prevent form submission
        if (!/[A-Z]/.test(password) || !/[!@#$&]/.test(password) || password.length < 8) {
            e.preventDefault();
            alert('Please ensure your password meets the required criteria.');
        }
    });
});
</script>
