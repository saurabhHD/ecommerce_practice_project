<?php
require_once("../../common_files/database/database.php");
$email = $_POST['email'];
$date = date('Y-m-d');

$check = "SELECT * FROM subscriber";
$response = $db->query($check);
if($response)
{
	$store = "INSERT INTO subscriber(email,subscriber_date)VALUES('$email','$date')";
		$response = $db->query($store);
		if($response)
		{
			echo "thank you for verify your email";
		}
		else
		{
			echo "sorry please try again later";
		}
}
else
{
	$create = "CREATE TABLE subscriber(
	id NOT NULL AUTO_INCREMENT,
	email VARCHAR(200),
	subscriber_date DATE,
	PRIMARY KEY(id)
	)";
	$response = $db->query($create);
	if($response)
	{
		$store = "INSERT INTO subscriber(email,subscriber_date)VALUES('$email','$date')";
		$response = $db->query($store);
		if($response)
		{
			echo "thank you for verify your email";
		}
		else
		{
			echo "sorry please try again later";
		}
	}
	else
	{
		echo "sorry please try again later";
	}
}

?>