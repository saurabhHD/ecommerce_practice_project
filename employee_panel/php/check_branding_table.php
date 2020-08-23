<?php
require_once("../../common_files/php/database.php");

$get_table = "SELECT brand_name,domain_name,email,facebook_url,twitter_url,address,phone,about_us,privacy,cookies,term FROM branding";
$response = $db->query($get_table);
$all_data = [];
if($response)
{
	$data = $response->fetch_assoc();
	array_push($all_data, $data);
	echo json_encode($all_data);
}

?>