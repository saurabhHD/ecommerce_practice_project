<?php
require_once("../../common_files/php/database.php");

$option = $_POST['option'];
$all_data = [];

// today sales
if($option == "Today's sales")
{
	$current_date = date('Y-m-d');
	$get = "SELECT * FROM purchase WHERE purchase_date='$current_date'";
	$response = $db->query($get);
	if($response->num_rows != 0)
	{
		while($data = $response->fetch_assoc())
		{
			array_push($all_data,$data);
		}
		echo json_encode($all_data);
	}
	else
	{
		echo "No Result";
	}
}

// new sales
else if($option == "New sales")
{
	
	$get = "SELECT * FROM purchase ORDER BY purchase_date ASC";
	$response = $db->query($get);
	if($response->num_rows != 0)
	{
		while($data = $response->fetch_assoc())
		{
			array_push($all_data,$data);
		}
		echo json_encode($all_data);
	}
	else
	{
		echo "No Result";
	}
	
}

//old sales

else if($option == "Old sales")
{
	
	$get = "SELECT * FROM purchase ORDER BY  purchase_date DESC";
	$response = $db->query($get);
	if($response->num_rows != 0)
	{
		while($data = $response->fetch_assoc())
		{
			array_push($all_data,$data);
		}
		echo json_encode($all_data);
	}
	else
	{
		echo "No Result";
	}
}

//processing


else if($option == "Not dispached")
{
	
	$get = "SELECT * FROM purchase WHERE status='processing'";
	$response = $db->query($get);
	if($response->num_rows != 0)
	{
		while($data = $response->fetch_assoc())
		{
			array_push($all_data,$data);
		}
		echo json_encode($all_data);
	}
	else
	{
		echo "No Result";
	}
}


//dispached

else if($option == "Dispached Products")
{
	
	$get = "SELECT * FROM purchase WHERE status='dispatch'";
	$response = $db->query($get);
	if($response->num_rows != 0)
	{
		while($data = $response->fetch_assoc())
		{
			array_push($all_data,$data);
		}

		echo json_encode($all_data);
	}
	else
	{
		echo "No Result";
	}
}

// returned

else if($option == "Returned Products")
{
	
	$get = "SELECT * FROM purchase WHERE status='returned'";
	$response = $db->query($get);
	if($response->num_rows != 0)
	{
		while($data = $response->fetch_assoc())
		{
			array_push($all_data,$data);
		}
		echo json_encode($all_data);
	}
	else
	{
		echo "No Result";
	}
}

else
{
	echo "somthing went wrong";
}



?>