<?php
require_once("../../common_files/database/database.php");

$state_id = $_POST['state_id'];
$get_state = "SELECT * FROM cities WHERE state_id='$state_id'";
$response = $db->query($get_state);
$city = [];
if($response)
{
	while($data = $response->fetch_assoc())
	{
		array_push($city, $data);
	}

	echo json_encode($city);
}
?>