<?php
require_once("../../common_files/database/database.php");

$country_id = $_POST['country_id'];
$get_country = "SELECT * FROM states WHERE country_id='$country_id'";
$response = $db->query($get_country);
$states = [];
if($response)
{
	while($data = $response->fetch_assoc())
	{
		array_push($states, $data);
	}

	echo json_encode($states);
}
?>