<?php
require_once("../../common_files/php/database.php");

$cat_name = $_GET['c_name'];
$title = $_POST['product-title'];
$brands = $_POST['brands'];
$description = $_POST['description'];
$price = $_POST['price'];
$quan = $_POST['quantity'];
$date = date('Y-m-d');
$dir = "";

$massage = "";

$all_file = [$_FILES['thumb'],$_FILES['front'],$_FILES['back'],$_FILES['left'],$_FILES['right']];
$files_path = ['thumb_path','front_path','back_path','left_path','right_path'];
$length = count($all_file);
// get category name

$get_cat_name = "SELECT category_name FROM brands WHERE brands='$brands'";
$response = $db->query($get_cat_name);

if($response)
{
$data = $response->fetch_assoc();
}
$check_dir = is_dir("../../stocks/".$data['category_name']."/".$brands."/".$title);
if($check_dir)
{
	echo "this productalready exists";
	exit;
}
else{
	$dir = mkdir("../../stocks/".$data['category_name']."/".$brands."/".$title);
}

$select = "SELECT * FROM products";
if($db->query($select))
{
	$store = "INSERT INTO products(category_name,brands,title,description,price,quantity,create_date) VALUES('$cat_name','$brands','$title','$description','$price','$quan','$date')";
	$response = $db->query($store);
		if($response)
		{
			$current_id = $db->insert_id;
			if($dir)
			{
			for ($i=0;$i<$length ;$i++) 
			{ 
			$file = $all_file[$i];
			$filename = $file['name'];
			$location = $file['tmp_name'];
			$current_url = "stocks/".$data['category_name']."/".$brands."/".$title."/".$filename;
			if(move_uploaded_file($location, "../../stocks/".$data['category_name']."/".$brands."/".$title."/".$filename))
			{
				$update_path = "UPDATE products SET $files_path[$i]='$current_url' WHERE id='$current_id'";
				$response = $db->query($update_path);
				if($response)
				{
					$massage =  "success";
				}
				else
				{
					$massage = "unable to update file path";
				}
			}
			}
			echo $massage;
			}

		}
		else
		{
			echo "faild to store data in products table";
		}

}
else
{
	$create_table ="CREATE TABLE products(
	id INT(10) NOT NULL AUTO_INCREMENT,
	category_name VARCHAR(50),
	brands VARCHAR(50),
	title VARCHAR(100),
	description VARCHAR(255),
	price FLOAT(20),
	quantity INT(10),
	thumb_path VARCHAR(100),
	front_path VARCHAR(100),
	back_path VARCHAR(100),
	left_path VARCHAR(100),
	right_path VARCHAR(100),
	create_date DATE NULL,
	PRIMARY KEY(id))";
	$respnse = $db->query($create_table);
	if($respnse)
	{
		$store = "INSERT INTO products(category_name,brands,title,description,price,quantity,create_date) VALUES('$cat_name','$brands','$title','$description','$price','$quan','$date')";
		$response = $db->query($store);
		if($response)
		{
			$current_id = $db->insert_id;
			if($dir)
			{
			for ($i=0;$i<$length ;$i++) 
			{ 
			$file = $all_file[$i];
			$filename = $file['name'];
			$location = $file['tmp_name'];
			$current_url = "stocks/".$data['category_name']."/".$brands."/".$title."/".$filename;
			if(move_uploaded_file($location, "../../stocks/".$data['category_name']."/".$brands."/".$title."/".$filename))
			{
				$update_path = "UPDATE products SET $files_path[$i]='$current_url' WHERE id='$current_id'";
				$response = $db->query($update_path);
				if($response)
				{
					$massage =  "success";
				}
				else
				{
					$massage  = "unable to update file path";
				}
			}
			}
			echo $massage;
			}
		}
		else
		{
			echo "faild to store data in products table";
		}
	}
	else
	{
		echo "unable to create products table";
	}
}

?>