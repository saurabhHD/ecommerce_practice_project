<?php

require_once("../../common_files/php/database.php");
$json_data = json_decode($_POST['json_data']);
$category = $_POST['category'];
$length = count($json_data);

$select_brands_table = "SELECT * FROM brands";

if($db->query($select_brands_table))
{
	$massage;
		for($i=0;$i<$length;$i++)
		{
			$store_data = "INSERT INTO brands(category_name,brands) VALUES('$category','$json_data[$i]')";
			if($db->query($store_data))
			{
				if(mkdir("../../stocks/".$category."/".$json_data[$i]))
				{
					$massage = "insert success";
				}
			}
			else
			{
				$massage = "insert faild";
			}
			
		}
		echo $massage;
}
else
{
	$create_table = "CREATE TABLE brands(
	id INT(11) NOT NULL AUTO_INCREMENT, category_name VARCHAR(50),
	brands VARCHAR(50),
	PRIMARY KEY(id))";

	if($db->query($create_table))
	{
		$massage;
		for($i=0;$i<$length;$i++)
		{
			$store_data = "INSERT INTO brands(category_name,brands) VALUES('$category','$json_data[$i]')";
			if($db->query($store_data))
			{
				if(mkdir("../../stocks/".$category."/".$json_data[$i]))
				{
					$massage = "insert success";
				}
			}
			else
			{
				$massage = "insert faild";
			}
			
		}
		echo $massage;
	}
	else
	{
		echo "faild to create table";
	}
}

?>