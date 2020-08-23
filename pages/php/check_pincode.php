<?php
require_once("../../common_files/database/database.php");
$pin = $_POST['pincode'];

$check = "SELECT * FROM delivery_area WHERE pincode='$pin'";
$response = $db->query($check);

if($response->num_rows !=0)
{
	$data = $response->fetch_assoc();
	echo $data['days'];
}
else
{
	echo "Whoops ! Deliver not ablavile in your area";
}
?>