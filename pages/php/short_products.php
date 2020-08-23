<?php

require_once("../../common_files/database/database.php");
if(empty($_COOKIE['_au_']))
{
	header("Location:../../login.php");
	exit;
}

$cat_name = $_POST['cat_name'];
$brand_name = $_POST['brand_name'];
$short_by = $_POST['short_by'];
$username = base64_decode($_COOKIE['_au_']);
$all_data = [];

if($brand_name == "all")
{
		if($short_by == "high")
	{
		$get_data = "SELECT * FROM products WHERE category_name='$cat_name' ORDER BY price DESC";
		$response = $db->query($get_data);
		if($response)
		{
			while($data =$response->fetch_assoc())
			{
				array_push($all_data, $data);
			}

			echo json_encode($all_data);
		}
	}
	else if($short_by == "low")
	{
		$get_data = "SELECT * FROM products WHERE category_name='$cat_name' ORDER BY price ASC";
		$response = $db->query($get_data);
		if($response)
		{
			while($data =$response->fetch_assoc())
			{
				array_push($all_data, $data);
			}

			echo json_encode($all_data);
		}
	}
	else if($short_by == "new")
	{
		$get_data = "SELECT * FROM products WHERE category_name='$cat_name' ORDER BY create_date DESC";
		$response = $db->query($get_data);
		if($response)
		{
			while($data =$response->fetch_assoc())
			{
				array_push($all_data, $data);
			}

			echo json_encode($all_data);
		}
	}
	else if($short_by == "recomended")
	{
		$get_data = "SELECT * FROM products WHERE category_name='$cat_name' ";
		$response = $db->query($get_data);
		if($response)
		{
			while($data =$response->fetch_assoc())
			{
				array_push($all_data, $data);
			}

			echo json_encode($all_data);
		}
	}
}
else
{
		if($short_by == "high")
	{
		$get_data = "SELECT * FROM products WHERE category_name='$cat_name' AND brands='$brand_name' ORDER BY price DESC";
		$response = $db->query($get_data);
		if($response)
		{
			while($data =$response->fetch_assoc())
			{
				array_push($all_data, $data);
			}

			echo json_encode($all_data);
		}
	}
	else if($short_by == "low")
	{
		$get_data = "SELECT * FROM products WHERE category_name='$cat_name' AND brands='$brand_name' ORDER BY price ASC";
		$response = $db->query($get_data);
		if($response)
		{
			while($data =$response->fetch_assoc())
			{
				array_push($all_data, $data);
			}

			echo json_encode($all_data);
		}
	}
	else if($short_by == "new")
	{
		$get_data = "SELECT * FROM products WHERE category_name='$cat_name' AND brands='$brand_name' ORDER BY create_date DESC";
		$response = $db->query($get_data);
		if($response)
		{
			while($data =$response->fetch_assoc())
			{
				array_push($all_data, $data);
			}

			echo json_encode($all_data);
		}
	}
	else if($short_by == "recomended")
	{
		$get_data = "SELECT * FROM products WHERE category_name='$cat_name' AND brands='$brand_name'";
		$response = $db->query($get_data);
		if($response)
		{
			while($data =$response->fetch_assoc())
			{
				array_push($all_data, $data);
			}

			echo json_encode($all_data);
		}
	}
}
?>