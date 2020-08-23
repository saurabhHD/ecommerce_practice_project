<?php

require_once("../../common_files/database/database.php");

$username = base64_decode($_COOKIE['_au_']);
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$address = $_POST['address'];
$state = $_POST['state'];
$pincode = $_POST['pincode'];
$country = $_POST['country'];

$update = "UPDATE users SET firstname='$firstname',lastname='$lastname',email='$email',mobile='$mobile',address='$address',state='$state',pincode='$pincode',country='$country'";

$response = $db->query($update);

if($response)
{
	echo "success";
}
else
{
	echo "unable to update data";
}

?>