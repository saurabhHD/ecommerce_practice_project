<?php
require_once("../../common_files/database/database.php");

if(empty($_COOKIE['_au_']))
{
	header("Location:../../login.php");
	exit;
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="view-port" content="width=device-width, initial-scale=1">
	<title>Welcome</title>
	<link rel="stylesheet" href="http://localhost/shop/common_files/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.0/animate.min.css">
	<script src="http://localhost/shop/common_files/js/jquery.js"></script>
	<script src="http://localhost/shop/common_files/js/popper.js"></script>
	<script src="http://localhost/shop/common_files/js/bootstrap.min.js"></script>
	<script src="http://localhost/shop/pages/js/index.js"></script>
</head>
<body class="bg-light">
	<?php
	include_once("../../assest/nav.php");
	?>
	<div class="container my-4">
		<div class="row">
			<div class="col-md-8">
				<div class="bg-white p-3">
					<?php
					$username = base64_decode($_COOKIE['_au_']);
					$get_data = "SELECT * FROM cart WHERE username='$username'";
					$response = $db->query($get_data);
					if($response->num_rows != 0)
					{
						while($data = $response->fetch_assoc())
						{
							echo "<div class='media border mb-3 shadow-sm'>
							<div class='media-left mr-2'>
							<img src='../../".$data['product_pic']."' width='100'>
							</div>
							<div class='media-body'>
							<h5 class='text-capitalize p0 m-0'>".$data['product_title']."</h5>
							<span>".$data['product_brand']."</span><br>
							<span><i class='fa fa-rupee'></i> ". $data['product_price']."</span><br>
							<div class='btn-group shadow-sm mt-2'>
							<button class='btn btn-primary delete-cart-btn' product-id='".$data['product_id']."' id='".$data['id']."'><i class='fa fa-trash'></i></button>
							<button class='btn btn-danger buy-btn' product-id='".$data['product_id']."'>BUY NOW</button>
							</div>
							</div>
							</div>";
						}
					}
					else
					{
						echo "<h1 class='text-center'> <i class='fa fa-shopping-cart'></i> Your cart is empty</h1>";
					}
					?>
				</div>
			</div>
			<div class="col-md-4">
				<div class="bg-white">test 2</div>
			</div>
		</div>
	</div>
	<?php
	include_once("../../assest/footer.php");
	?>
</body>
</html>