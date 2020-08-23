<?php

require_once("../../common_files/database/database.php");

$product_id = $_POST['product_id'];
$index = $_POST['index'];
$pic = $_FILES['picture'];
$picture = addslashes(file_get_contents($pic['tmp_name']));
$username = base64_decode($_COOKIE['_au_']);
$comment = $_POST['comment'];

$update = "UPDATE purchase SET rate='$index',comment='$comment',picture='$picture' WHERE product_id='$product_id' AND email='$username'";

$response = $db->query($update);
if($response)
{
	echo "success";
}
else
{
	echo "faild";
}

?>