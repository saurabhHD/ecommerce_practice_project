<?php

require_once("../../common_files/php/database.php");
$json_data = json_decode($_POST['json_data']);
$length = count($json_data);

$select_category_table = "SELECT * FROM category";

if($db->query($select_category_table))
{
	$massage;
		for($i=0;$i<$length;$i++)
		{
			$store_data = "INSERT INTO category(category_name) VALUES('$json_data[$i]')";
			if($db->query($store_data))
			{
				if(mkdir("../../stocks/".$json_data[$i]))
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
	$create_table = "CREATE TABLE category(
	id INT(11) NOT NULL AUTO_INCREMENT, category_name VARCHAR(50),
	PRIMARY KEY(id))";

	if($db->query($create_table))
	{
		$massage;
		for($i=0;$i<$length;$i++)
		{
			$store_data = "INSERT INTO category(category_name) VALUES('$json_data[$i]')";
			if($db->query($store_data))
			{
				if(mkdir("../../stocks/".$json_data[$i]))
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