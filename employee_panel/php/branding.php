<?php
require_once("../../common_files/php/database.php");
$file = $_FILES['brand_logo'];
$location;
$logo;
if($file['name'] == "")
{
 $logo = "";
 $location = "";
}
else
{
	$location = $file['tmp_name'];
	$logo = addslashes(file_get_contents($location));
}

$brand_name = $_POST['brand_name'];
$domain_name = $_POST['domain_name'];
$email = $_POST['email'];
$facebook_url = $_POST['facebook'];
$twitter_url = $_POST['twitter'];
$address = addslashes($_POST['address']);
$phone = $_POST['phone'];

$about_us = addslashes($_POST['about-us']);
$privacy = addslashes($_POST['privacy-policy']);
$cookies = addslashes($_POST['cookies-policy']);
$term = addslashes($_POST['term']);

$check_branding_table = "SELECT * FROM branding";
$response = $db->query($check_branding_table);
if($response)
{
	if($logo == "")
	{
		$update_table = "UPDATE branding SET brand_name='$brand_name',domain_name='$domain_name',email='$email',facebook_url='$facebook_url',twitter_url='$twitter_url',address='$address',phone='$phone',about_us='$about_us',privacy='$privacy',cookies='$cookies',term='$term'";
		$response = $db->query($update_table);
		if($response)
		{
			echo "data update success";
		}
		else
		{
			echo "faild to update data";
		}
	}
	else
	{
		$update_table = "UPDATE branding SET brand_name='$brand_name',brand_logo='$logo',domain_name='$domain_name',email='$email',facebook_url='$facebook_url',twitter_url='$twitter_url',address='$address',phone='$phone',about_us='$about_us',privacy='$privacy',cookies='$cookies',term='$term'";
		$response = $db->query($update_table);
		if($response)
		{
			echo "data update success";
		}
		else
		{
			echo "faild to update data";
		}
	}
}
else
{
	$create_table = "CREATE TABLE branding(
	id INT(10) NOT NULL AUTO_INCREMENT,
	brand_name VARCHAR(50),
	brand_logo MEDIUMBLOB,
	domain_name VARCHAR(100),
	email VARCHAR(100),
	facebook_url VARCHAR(255),
	twitter_url VARCHAR(255),
	address VARCHAR(100),
	phone INT(12),
	about_us MEDIUMTEXT,
	privacy MEDIUMTEXT,
	cookies MEDIUMTEXT,
	term MEDIUMTEXT,
	PRIMARY KEY(id)
	)";

	$response = $db->query($create_table);
	if($response)
	{
		$store_data = "INSERT INTO branding(brand_name,brand_logo,domain_name,email,facebook_url,twitter_url,address,phone,about_us,privacy,cookies,term) VALUES('$brand_name','$logo','$domain_name','$email','$facebook_url','$twitter_url','$address','$phone','$about_us','$privacy','$cookies','$term')";
		$response = $db->query($store_data);
		if($response)
		{
			echo "insert success";
		}
		else
		{
			echo "unable to store data in brandig";
		}
	}
	else
	{
		echo "unable to create branding table";
	}
}

?>