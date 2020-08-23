<?php
require_once("../../common_files/php/database.php");

$category = $_POST['category'];

$display = "SELECT * FROM brands WHERE category_name='$category'";
$response = $db->query($display);
$result = [];
if($response->num_rows != 0)
{
while($data = $response->fetch_assoc())
{
	array_push($result,$data);
}

echo json_encode($result);
}
else
{
	echo "<b>No brands has been created yet in this category</b>";
}

?>