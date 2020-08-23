<?php
require_once("../../common_files/database/database.php");
$id = $_POST['product_id'];
$title = $_POST['product_title'];
$pic = $_POST['product_pic'];
$brand = $_POST['product_brand'];
$price = $_POST['product_price'];
$username = base64_decode($_COOKIE['_au_']);
$check = "SELECT * FROM cart WHERE product_id='$id' AND username='$username'";
$response = $db->query($check);

if($response)
{
	if($response->num_rows == 0)
	{
	$store = "INSERT INTO cart(product_id,product_title,product_price,product_brand,product_pic,username)VALUES('$id','$title','$price','$brand','$pic','$username')";
		$response = $db->query($store);
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
		echo "this product already exits in your cart";
	}
}
else
{
	$create_table = "CREATE TABLE cart(
	id INT(11) NOT NULL AUTO_INCREMENT,
	product_id INT(11),
	product_title VARCHAR(150),
	product_price FLOAT(20),
	product_brand VARCHAR(150),
	product_pic VARCHAR(250),
	username VARCHAR(50),
	PRIMARY KEY(id)
	)";
	$response = $db->query($create_table);
	if($response)
	{
		$store = "INSERT INTO cart(product_id,product_title,product_price,product_brand,product_pic,username)VALUES('$id','$title','$price','$brand','$pic','$username')";
		$response = $db->query($store);
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