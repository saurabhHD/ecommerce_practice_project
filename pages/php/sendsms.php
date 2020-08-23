<?php
require('textlocal.class.php');
$textlocal = new Textlocal(false,false, 'bgoD10md7io-8zohXAsXQoGHCsJm4ccyeYbmaRiwpQ');

$numbers = array($mobile);
$sender = 'TXTLCL';
$otp = rand(456789, 998657);
$_SESSION["otp"] = $otp;
$message = 'Welcome to saurabh website your otp is : '.$otp;

try {
    $result = $textlocal->sendSms($numbers, $message, $sender);
    echo "success";
} catch (Exception $e) {
    die('Error: ' . $e->getMessage());
}
?>