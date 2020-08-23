<?php
require_once("../../common_files/php/database.php");
	$id = $_POST['id'];
	$delete_data = "DELETE FROM category WHERE id='$id'";
	if($db->query($delete_data))
	{
		echo "success";
	}
	else
	{
		echo "faild";
	}
?>