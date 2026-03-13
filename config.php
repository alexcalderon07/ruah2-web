<?php
    $site_url = "https://ruah2-web-production.up.railway.app/";
    
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
    $captchakey = "6LfYXoksAAAAAIYP20C9AuDgj5jhXrKHX3NCNvlk";
    $secretkey = "6LfYXoksAAAAAAalDqS85PklY-AGxgq1asEKQyBO";
    
    $item_id = 60302;
    $item_count = 1;