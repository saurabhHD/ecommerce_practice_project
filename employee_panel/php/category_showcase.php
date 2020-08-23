<?php
require_once("../../common_files/php/database.php");
$file = "";
$image = "";
if($_FILES)
{
$file = $_FILES['pic'];
$image = addslashes(file_get_contents($file['tmp_name']));
}
$lable = $_POST['text'];
$dir = $_POST['dir'];

$check = "SELECT * FROM category_showcase";
$response = $db->query($check);
if($response)
{
	$check_dir = "SELECT * FROM category_showcase WHERE direction='$dir'";
	$response = $db->query($check_dir);
	
		if($response->num_rows != 0)
		{
			if($file != "")
			{
				$update_data = "UPDATE category_showcase SET image='$image',lable='$lable' WHERE direction='$dir'";
				$response = $db->query($update_data);
				if($response)
				{
					echo "success";
				}
				else
				{
					echo "unable to update data";
				}
			}
			else
			{
				$update_data = "UPDATE category_showcase SET lable='$lable' WHERE direction='$dir'";
				$response = $db->query($update_data);
				if($response)
				{
					echo "success";
				}
				else
				{
					echo "unable to update data";
				}
			}
		}
		else
		{
			$store = "INSERT INTO category_showcase(image,lable,direction)VALUES('$image','$lable','$dir')";
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
	
}
else
{
	$table = "CREATE TABLE category_showcase(
	id INT(11) NOT NULL AUTO_INCREMENT,
	image MEDIUMBLOB,
	lable VARCHAR(50),
	direction VARCHAR(50),
	PRIMARY KEY(id)
	)";
	$response = $db->query($table);
	if($response)
	{
		$store = "INSERT INTO category_showcase(image,lable,direction)VALUES('$image','$lable','$dir')";
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