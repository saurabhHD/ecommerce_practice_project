<?php
require_once("../../common_files/database/database.php");
$email = $_POST['email'];
$code = rand(847930, 332874);

$check_mail = mail($email, "Verification code", "Your verification code is :".$code);

if($check_mail)
{
	$data = ['success',trim($code)];
	echo json_encode($data);
}
else
{
	echo "unable to send verification code";
}

?>