<?php
require_once("../../common_files/database/database.php");

$old_password = md5($_POST['oldpassword']);
$new_password = md5($_POST['newpassword']);
$username = base64_decode($_COOKIE['_au_']);

$check = "SELECT * FROM users WHERE email='$username' AND password='$old_password'";
$response = $db->query($check);
if($response->num_rows != 0)
{
 	$update = "UPDATE users SET password='$new_password' WHERE email='$username'";
 	$response = $db->query($update);
 	if($response)
 	{
 		echo "password changed successfull";
 	}
 	else
 	{
 		echo "try again later";
 	}
}
else
{
	echo "your old password is wrong";
}
?>