<?php
require_once("../common_files/database/database.php");
$id = base64_decode($_GET['id']);
$title = base64_decode($_GET['title']);
$brand = base64_decode($_GET['brand']);
$amount = base64_decode($_GET['amount']);
$qnt = base64_decode($_GET['qnt']);
$mode = base64_decode($_GET['payment_mode']);
$mobile = "";
$fullname = "";
$username = base64_decode($_COOKIE['_au_']);
$get = "SELECT * FROM users WHERE email='$username'";
if($response = $db->query($get))
{
	$data = $response->fetch_assoc();
	$fullname = $data['firstname']." ".$data['lastname'];
	$mobile = $data['mobile'];

}

$address = "";
$country = "";
$state = "";
$pincode = "";
$date = date('Y-m-d');
$time = date('H:i:s');
$quantity = "";
$massage = "";

$get_qnt = "SELECT quantity FROM products WHERE id='$id' AND brands='$brand'";
$response = $db->query($get_qnt);
if($response)
{
	$data = $response->fetch_assoc();
	$quantity = $data['quantity']-$qnt;
}
$get_data = "SELECT * FROM users WHERE email='$username'";
$response = $db->query($get_data);
if($response)
{
	$data = $response->fetch_assoc();
	$address = $data['address'];
	$country = $data['country'];
	$state = $data['state'];
	$pincode = $data['pincode'];

	$select = "SELECT * FROM purchase";
	$response = $db->query($select);
	if($response)
	{
		$store_data = "INSERT INTO purchase(product_id,title,brand,qnt,amount,fullname,email,mobile,address,state,pincode,country,purchase_date,purchase_time,payment_mode)VALUES('$id','$title','$brand','$qnt','$amount','$fullname','$username','$mobile','$address','$state','$pincode','$country','$date','$time','$mode')";
			$response = $db->query($store_data);
			if($response)
			{
				//delete cart

				$delete_cart = "DELETE FROM cart WHERE username='$username' AND product_id='$id'";
				$response = $db->query($delete_cart);
				if($response)
				{
					// stock update

					$update = "UPDATE products SET quantity='$quantity' WHERE title='$title' AND brands='$brand'";
					$response =  $db->query($update);
					if($response)
					{
						$massage ="success";
					}
					else
					{
						$massage = "unable to update stock";
					}
				}
				else
				{
					// stock update

					$update = "UPDATE products SET quantity='$quantity' WHERE title='$title' AND brands='$brands'";
					$response =  $db->query($update);
					if($response)
					{
						$massage = "success";
					}
					else
					{
						$massage = "unable to update stock";
					}
				}
			}
			else
			{
				$massage = $db->error;
			}
	}
	else
	{
		$create_table = "CREATE TABLE purchase(
		id INT(11) NOT NULL AUTO_INCREMENT,
		product_id INT(25),
		title VARCHAR(250),
		brand VARCHAR(100),
		qnt INT(11),
		amount FLOAT(25),
		fullname VARCHAR(250),
		email VARCHAR(250),
		mobile VARCHAR(50),
		address VARCHAR(255),
		state VARCHAR(180),
		pincode INT(20),
		country VARCHAR(150),
		payment_mode VARCHAR(50),
		purchase_date DATE,
		purchase_time TIME,
		rate INT(6) DEFAULT '0',
		comment MEDIUMTEXT NULL,
		picture MEDIUMBLOB NULL,
		status VARCHAR(50) DEFAULT 'processing',
		dispached_date DATE NULL, 
		PRIMARY KEY(id)
		)";

		$response = $db->query($create_table);
		if($response)
		{
			$store_data = "INSERT INTO purchase(product_id,title,brand,qnt,amount,fullname,email,mobile,address,state,pincode,country,purchase_date,purchase_time,payment_mode)VALUES('$id','$title','$brand','$qnt','$amount','$fullname','$username','$mobile','$address','$state','$pincode','$country','$date','$time','$mode')";
			$response = $db->query($store_data);
			if($response)
			{
				$massage = "success";
			}
			else
			{
				$massage ="unable to store data";
			}
		}
		else
		{
			$massage = "unable to create table";
		}
	}
}


?>




<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="view-port" content="width=device-width, initial-scale=1">
	<title>Welcome</title>
	<link rel="stylesheet" href="../common_files/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.0/animate.min.css">
	<script src="../common_files/js/jquery.js"></script>
	<script src="../common_files/js/popper.js"></script>
	<script src="../common_files/js/bootstrap.min.js"></script>
</head>
<body class="bg-light">
	<?php
	include_once("../assest/nav.php");
	$fullname = $_SESSION['fullname'];
	$mobile = $_SESSION['mobile'];
	?>
	<div class="container">
		<div class="mt-5 jumbotron border-top border-right border-bottom shadow-sm bg-white" style="border-left: 5px solid #47e20a">
			<center>
				<?php
				if($massage == "success")
				{
				echo '<i class="fa fa-check-circle" style="font-size: 100px;color: #47e20a"></i>';
				}
				else
				{
					echo '<i class="fa fa-times-circle" style="font-size: 100px;color: red"></i>';
				}

				?>
				<h4>PURCHASE <?php echo $massage; ?> !</h4>
				<p>PLEASE OPEN YOUR EMAIL FOR MORE INFORMATION</p>
				<button class="btn btn-danger"><a href="http://localhost/shop/index.php" class="text-decoration-none text-light">SHOP MORE</a></button>
			</center>
		</div>
	</div>
	<?php
	include_once("../assest/footer.php");
	?>
</body>
</html>