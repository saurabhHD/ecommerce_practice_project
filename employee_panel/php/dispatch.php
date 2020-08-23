<?php

require_once("../../common_files/php/database.php");

$order_id = $_POST['order_id'];
$product_id = $_POST['product_id'];
$title = $_POST['title'];
$brand = $_POST['brand'];
$amount = $_POST['amount'];
$address = $_POST['address'];
$fullname = $_POST['fullname'];
$phone = $_POST['mobile'];
$qnt = $_POST['qnt'];
$email = $_POST['email'];
$date = date('Y-m-d');

$update = "UPDATE purchase SET status='dispatch',dispached_date='$date' WHERE id='$order_id'";
$response = $db->query($update);
if($response)
{
	$message = "Hi ".$fullname."
	Your order has shipped
	Order details
	".$fullname."
	Product name : ".$title."
	Quantity : ".$qnt."
	Amount : ".$amount."
	Address : ".$address."
	Mobile : ".$phone."
	Thanks and REGARDS
	SKSHOP TEAM
	";
	$header = "From:SKSHOP TEAM <purchase@gmail.com>\r\nContent-type:text/html;CHARSET:UTF_8";
	$check_mail = mail($email, "SKSHOP ORDER", $message,$header);
	if($check_mail)
	{
		echo "success";
	}
	else
	{
		echo "unable to send email";
	}
}
else
{
	echo "faild";
}


?>