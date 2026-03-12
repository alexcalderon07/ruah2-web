<?php
    $site_url = "https://TU-URL.up.railway.app/";
    
    $host = getenv('DB_HOST');
    $user = getenv('DB_USER');
    $password = getenv('DB_PASS');
    
    $SMTPAuth = true;
    $SMTPSecure = "ssl";
    $EmailHost = getenv('MAIL_HOST');
    $emailPort = 465;
    $email_username = getenv('MAIL_USER');
    $email_password = getenv('MAIL_PASS');
    
    $safebox_size = 1;
    $captchakey = "6LeboCkqAAAAAPD-r7SsOnp95_Fc6T-XQ2k1y-jR";
    $secretkey = "6LeboCkqAAAAAG9Ytze8PK3ilJl51i4NPzv1576d";
    
    $item_id = 60302;
    $item_count = 1;