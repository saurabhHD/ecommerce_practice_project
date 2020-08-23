<?php
require_once("../../common_files/database/database.php");
$country = $_POST['country'];
$state = $_POST['state'];
$city = $_POST['city'];
$payment_mode = $_POST['payment-mode'];
$pincode = $_POST['pincode'];
$days = $_POST['delivery-time'];

$check = "SELECT * FROM delivery_area";
$response = $db->query($check);

if($response)
{
	$store_data = "INSERT INTO delivery_area(country,state,city,pincode,days,payment_mode)VALUES('$country','$state','$city','$pincode','$days','$payment_mode')";
		$response = $db->query($store_data);
		if($response)
		{
			echo "success";
		}
		else
		{
			echo "unable to store data";
		}
}
else
{
	$create_table = "CREATE TABLE delivery_area(
	id INT(11) NOT NULL AUTO_INCREMENT,
	country VARCHAR(100),
	state VARCHAR(100),
	city VARCHAR(100),
	pincode INT(12),
	days VARCHAR(255),
	payment_mode VARCHAR(12),
	PRIMARY KEY(id)
	)";

	$response = $db->query($create_table);
	if($response)
	{
		$store_data = "INSERT INTO delivery_area(country,state,city,pincode,days,payment_mode)VALUES('$country','$state','$city','$pincode','$days','$payment_mode')";
		$response = $db->query($store_data);
		if($response)
		{
			echo "success";
		}
		else
		{
			echo "unable to store data";
		}
	}
	else
	{
		echo "unable to create table";
	}
}

?>