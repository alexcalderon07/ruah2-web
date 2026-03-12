<?php
	$message = 0;
	if(isset($_GET['email']) && isset($_GET['code']) && !empty($_GET['email']) && !empty($_GET['code']) && isValidEmail($_GET['email']))
	{
		if(check_recovery($_GET['email'], $_GET['code']))
		{
			$message = 7;//bun
			if(isset($_POST['submit']))
			{
				$password_generated = generatePassword(12);
				$password = getHashPassword($password_generated);
				update_passlost_token_by_email($_GET['email']);
				update_password_by_email($_GET['email'], $password);
				$message = 8;
			}
		} else {
			$message = 6;
		}
	} else if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response']))
	{
		$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretkey.'&response='.$_POST['g-recaptcha-response']);
		$responseData = json_decode($verifyResponse);

		if($responseData->success || 1==1)
		{
			$username = strip_tags($_POST['username']);
			$email = $_POST['email'];

			if(isValidEmail($email))
			{
				$message = $database->Lost($username,$email);
			} else $message = 4;

		}
		else $message = 5;
	}
?>
