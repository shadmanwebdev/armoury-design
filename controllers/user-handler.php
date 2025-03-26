<?php
    if(!isset($_SESSION)) { 
        ob_start();
        session_start(); 
    }
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    include '../functions.php';
    include '../Classes/Db.php';
    include '../Classes/User.php';
    

    if(isset($_POST['update_account_details'])) {
        $user = new User();
        $user->update();
    }
    if(isset($_POST['update_password'])) {
        $user = new User();
        $user->update_password();
    }
    if(isset($_POST['forgot_password'])) {
        $user = new User();
        $check_email = $user->email_exists($_POST['email']);
        if($check_email == '1') {
            $url = $user->generatePwdLink($_POST['email']);
            $subject = 'Armoury Design Password Reset';
            $msgBody = "<p>Your password reset link: </p>
            <a href='$url'>$url</a>";

            $smtp_details = $user->smtp_details();

            $host = $smtp_details['smtp_host'];
            $encryption = $smtp_details['smtp_encryption'];
            $port = $smtp_details['smtp_port'];
            $username = $smtp_details['username'];
            $pwd = $smtp_details['pwd'];

            sendEmailSwiftMailer($host, $encryption, $port, $username, $pwd, $_POST['email'], $subject, $msgBody);
            echo '1';
        } else {
            echo '0';
        }
    }
    if(isset($_POST['update_password_2'])) {
        $user = new User();
        $user->update_password_2();
    }
    if(isset($_POST['email_setup'])) {
        $user = new User();
        $user->update_email_details();
    }
    if(isset($_POST['update_public_info'])) {
        $user = new User();
        $user->update_public_info();
    }
    if(isset($_POST['update_private_info'])) {
        $user = new User();
        $user->update_private_info();
    }
?>