<?php
require_once("../../common_files/database/database.php");
$keyword = $_POST['keyword'];

$get = "SELECT * FROM products WHERE title LIKE '%$keyword%' LIMIT 10";
$response = $db->query($get);
if($response)
{
	while($data = $response->fetch_assoc())
	{
		echo "<p class='mx-2 p-2 search-tag text-capitalize' product-id='".$data['id']."'>".$data['title']."</p>";
	}
}

?>