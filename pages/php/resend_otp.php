<?php
session_start();
require_once("../../common_files/database/database.php");

require('textlocal.class.php');
$textlocal = new Textlocal(false,false, 'bgoD10md7io-8zohXAsXQoGHCsJm4ccyeYbmaRiwpQ');
$mobile = $_POST['mobile'];
$email = strrchr($mobile, '@');
if($email)
{
	$get_data = "SELECT mobile FROM users WHERE email='$mobile'";
	$response = $db->query($get_data);
	if($response)
	{
		$data = $response->fetch_assoc();
		$mobile = $data['mobile'];
	}
}
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