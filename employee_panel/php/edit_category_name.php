<?php
require_once("../../common_files/php/database.php");
$id = $_POST['id'];
$name = $_POST['name'];
$update_name = "UPDATE category SET category_name='$name' WHERE id='$id'";
if($db->query($update_name))
{
	echo "success";
}
else
{
	echo "fail to change name";
}

?>