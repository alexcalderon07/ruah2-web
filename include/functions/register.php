<?php
	if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response']))
	{
		$errors = array();

		$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretkey.'&response='.$_POST['g-recaptcha-response']);
		$responseData = json_decode($verifyResponse);

		if(!$responseData->success)
			$errors[]=$lang['incorrect-security'];
		if(!isValidUserName($_POST['username']))
			$errors[]=$lang['incorrect-usermane'];
		if(!isValidUserPassword($_POST['password']))
			$errors[]=$lang['incorrect-password'];
		if($_POST['password'] != $_POST['rpassword'])
			$errors[]=$lang['no-password-r'];
		if(!isValidEmail($_POST['email']))
			$errors[]=$lang['incorrect-email'];
		if($database->checkUserName($_POST['username']))
			$errors[]=$lang['already-user'];
		if($database->checkUserEmail($_POST['email']))
			$errors[]=$lang['already-email'];

		$promoter = null;

		if(isset($_POST['promoter']) && strlen($_POST['promoter']) > 0){
			$promoter_code = strtolower($_POST['promoter']);
			$existingPromoter = get_promoter_by_code($promoter_code);
			if (!$existingPromoter){
				$errors[]="Invalid Promoter Code";
			}else{
				$promoter = $existingPromoter["id"];
			}

			
		}

		
		foreach($errors as $error)
			print '<div class="alert alert-danger" role="alert">
			  '.$error.'
			</div>';
		
		if(!count($errors))
		{
			$ref = isset($_GET['ref']) ? $_GET['ref'] : null;
			
			if(!$jsondataFunctions['active-referrals'])
				$ref=null;
			
			//$password = generatePassword(12);
			
			$password = $_POST['password'];
			
			if($database->register($_POST['username'],$password,$_POST['email'],$ref, $promoter)){
				print '<div class="alert alert-success" role="alert">
					  <h4 class="alert-heading">'.$lang['success'].'!</h4>
					  <p> Your password is: '.$password.'</p>
					  <p>'.$lang['success-register'].'</p>
					</div>';
					
					if($promoter){
						print '<div class="alert alert-success" role="alert">
					  <h4 class="alert-heading">'.$lang['success'].'!</h4>
					  <p>You have gift from your promoter in deposit!</p>
					</div>';
					}
					
				if($promoter != null){
					$account_id = getAccountIDbyName($_POST['username']);
					$epoch_time_in_7_days = time() +  86400 * 7;

					$item_position = new_item_position_safebox($account_id, $item_id);
					if($item_position != -1)
					{
						$stmt = $database->runQueryPlayer('INSERT item (owner_id, `window`, pos, count, vnum, socket0) VALUES (?,?,?,?,?,?)');
						$stmt->execute(array($account_id, 'SAFEBOX', $item_position, $item_count, $item_id, $epoch_time_in_7_days));
					}
				}

				
				print("<script>downloadTxtFile('Username: ".$_POST['username']." password: ".$password."');</script>");
			}
		}
	}
	
?>
