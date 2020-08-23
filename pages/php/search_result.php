
<?php
require_once("../../common_files/database/database.php");
$keyword = $_GET['search'];
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
			<div class="col-md-12 px-3 d-flex justify-content-between flex-wrap">
		<?php
		$get_data = "SELECT * FROM products WHERE title LIKE '%$keyword%' LIMIT 12";
		$response = $db->query($get_data);
		if($response->num_rows != 0)
		{
			while($data = $response->fetch_assoc())
			{
				echo "<div class='bg-white text-center border shadow-sm p-3 mb-4'>
				<img src='../../".$data['thumb_path']."' width='250' height='316'>
				<br><span class='text-uppercase font-weight-bold'>".$data['brands']."</span>
				<br><span class='text-capitalize'>".$data['title']."</span>
				<br><span class='text-capitalize'><i class='fa fa-rupee'></i> ".$data['price']."</span><br>
				<button class='btn btn-danger mt-3 cart-btn' product-id='".$data['id']."' product-title='".$data['title']."' product-brand='".$data['brands']."' product-price='".$data['price']."' product-pic='".$data['thumb_path']."'><i class='fa fa-shopping-cart'></i> ADD TO CART</button>
				<button class='btn btn-primary mt-3 buy-btn' product-id='".$data['id']."' product-title='".$data['title']."' product-brand='".$data['brands']."' product-price='".$data['price']."' product-pic='".$data['thumb_path']."'><i class='fa fa-shopping-bag'></i> BUY NOW</button>
				</div>";
			}
		}
		else
		{
			$get_data = "SELECT * FROM products WHERE category_name LIKE '%$keyword%' LIMIT 12";
		$response = $db->query($get_data);
		if($response->num_rows != 0)
		{
			while($data = $response->fetch_assoc())
			{
				echo "<div class='bg-white text-center border shadow-sm p-3 mb-4'>
				<img src='../../".$data['thumb_path']."' width='250' height='316'>
				<br><span class='text-uppercase font-weight-bold'>".$data['brands']."</span>
				<br><span class='text-capitalize'>".$data['title']."</span>
				<br><span class='text-capitalize'><i class='fa fa-rupee'></i> ".$data['price']."</span><br>
				<button class='btn btn-danger mt-3 cart-btn' product-id='".$data['id']."' product-title='".$data['title']."' product-brand='".$data['brands']."' product-price='".$data['price']."' product-pic='".$data['thumb_path']."'><i class='fa fa-shopping-cart'></i> ADD TO CART</button>
				<button class='btn btn-primary mt-3 buy-btn' product-id='".$data['id']."' product-title='".$data['title']."' product-brand='".$data['brands']."' product-price='".$data['price']."' product-pic='".$data['thumb_path']."'><i class='fa fa-shopping-bag'></i> BUY NOW</button>
				</div>";
			}
		}
		else
		{
			$get_data = "SELECT * FROM products WHERE brands LIKE '%$keyword%' LIMIT 12";
		$response = $db->query($get_data);
		if($response->num_rows != 0)
		{
			while($data = $response->fetch_assoc())
			{
				echo "<div class='bg-white text-center border shadow-sm p-3 mb-4'>
				<img src='../../".$data['thumb_path']."' width='250' height='316'>
				<br><span class='text-uppercase font-weight-bold'>".$data['brands']."</span>
				<br><span class='text-capitalize'>".$data['title']."</span>
				<br><span class='text-capitalize'><i class='fa fa-rupee'></i> ".$data['price']."</span><br>
				<button class='btn btn-danger mt-3 cart-btn' product-id='".$data['id']."' product-title='".$data['title']."' product-brand='".$data['brands']."' product-price='".$data['price']."' product-pic='".$data['thumb_path']."'><i class='fa fa-shopping-cart'></i> ADD TO CART</button>
				<button class='btn btn-primary mt-3 buy-btn' product-id='".$data['id']."' product-title='".$data['title']."' product-brand='".$data['brands']."' product-price='".$data['price']."' product-pic='".$data['thumb_path']."'><i class='fa fa-shopping-bag'></i> BUY NOW</button>
				</div>";
			}
		}
		else
		{
			echo "not found";
		}
		}
		}
		?>
	</div>
	</div>
	</div>
	<?php
	include_once("../../assest/footer.php");
	?>
</body>
</html>