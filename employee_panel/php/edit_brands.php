<?php
require_once("../../common_files/php/database.php");


// previous data

$previous_c_name = $_POST['previous_c_name'];
$previous_b_name = $_POST['previous_b_name'];

// new data 

$c_name = $_POST['c_name'];
$b_name = $_POST['b_name'];

$edit_data = "UPDATE brands SET category_name='$c_name',brands='$b_name' WHERE category_name='$previous_c_name' AND brands='$previous_b_name'";
$response = $db->query($edit_data);

if($response)
{
	echo "<b>Success</b>";
}
else
{
	echo "<b>Faild to update</b>";
} 

?>