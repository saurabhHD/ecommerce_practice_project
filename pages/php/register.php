<?php
require_once("../../common_files/database/database.php");
session_start();

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$password = md5($_POST['password']);
$address = addslashes($_POST['address']);
$state = $_POST['state'];
$country = $_POST['country'];
$pincode = $_POST['pincode'];

$check = "SELECT * FROM users";
$response = $db->query($check);
if($response)
{
	$store = "INSERT INTO users(firstname,lastname,email,mobile,password,address,state,country,pincode)VALUES('$firstname','$lastname','$email','$mobile','$password','$address','$state','$country','$pincode')";
		$response = $db->query($store);
		if($response)
		{
			require("sendsms.php");
		}
		else
		{
			echo "unable to store data in database";
		}
}
else
{
	$create_table = "CREATE TABLE users(
	id INT(11) NOT NULL AUTO_INCREMENT,
	firstname VARCHAR(50),
	lastname VARCHAR(50),
	email VARCHAR(100),
	mobile VARCHAR(20),
	password VARCHAR(150),
	address VARCHAR(250),
	state VARCHAR(50),
	country VARCHAR(20),
	pincode INT(11),
	status VARCHAR(20) DEFAULT 'panding',
	reg_date DATETIME DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY(id)
	)";

	$response = $db->query($create_table);
	if($response)
	{
		$store = "INSERT INTO users(firstname,lastname,email,mobile,password,address,state,country,pincode)VALUES('$firstname','$lastname','$email','$mobile','$password','$address','$state','$country','$pincode')";
		$response = $db->query($store);
		if($response)
		{
			require("sendsms.php");
		}
		else
		{
			echo "unable to store data in database";
		}
	}
	else
	{
		echo "unable to create table";
	}
}
?>