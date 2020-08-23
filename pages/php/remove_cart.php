<?php
require_once("../../common_files/database/database.php");
$username = base64_decode($_COOKIE['_au_']);
$pro_id = $_POST['pro_id'];
$id = $_POST['id'];
$delete = "DELETE FROM cart WHERE product_id='$pro_id' AND id='$id' AND username='$username'";
$response = $db->query($delete);
if($response)
{
	echo "success";
}
else
{
	echo "unable to delete item from yourr cart";
}

?>