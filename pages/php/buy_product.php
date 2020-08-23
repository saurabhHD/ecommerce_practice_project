
<?php
require_once("../../common_files/database/database.php");
$id = base64_decode($_GET['id']);
if(empty($_COOKIE['_au_']))
{
	header("Location:../../login.php");
	exit;
}
$get_data = "SELECT * FROM products WHERE id='$id'";
$response = $db->query($get_data);
$title = "";
$price = "";
$brand = "";
$description = "";
$category= "";
$stocks = "";
$front_pic = "";
$back_pic = "";
$left_pic = "";
$right_pic = "";
if($response->num_rows !=0)
{
	$data = $response->fetch_assoc();
	$title = $data['title'];
	$price = $data['price'];
	$brand = $data['brands'];
	$description = $data['description'];
	$category = $data['category_name'];
	$stocks = $data['quantity'];
	$front_pic = $data['front_path'];

	$back_pic = $data['back_path'];
	$left_pic = $data['left_path'];
	$right_pic = $data['right_path'];

}
else
{
	header("Location:http://localhost/shop");
}
$cart_btn = "";
$username = base64_decode($_COOKIE['_au_']);
$check = "SELECT * FROM cart WHERE product_id='$id' AND username='$username'";
$response = $db->query($check);
if($response)
{
	if($response->num_rows !=0)
	{
		$cart_btn = "";
	}
	else
	{
		$cart_btn = "<button class='btn btn-danger mt-3 cart-btn' product-id='".$data['id']."' product-title='".$data['title']."' product-brand='".$data['brands']."' product-price='".$data['price']."' product-pic='".$data['thumb_path']."'><i class='fa fa-shopping-cart'></i> ADD TO CART</button>";
	}
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
	$pincode = $_SESSION['pincode'];
	$buy_btn = "";
	$check_pincode = "SELECT * FROM delivery_area WHERE pincode='$pincode'";
	$response = $db->query($check_pincode);
	$cod_btn = "";
	if($response)
	{
		if($response->num_rows != 0)
		{
			$data = $response->fetch_assoc();
			
			if($data['payment_mode'] == "all")
			{
				$cod_btn = '<input type="radio" name="pay-mode" value="cod"> CASH ON DELEVERY';
			}
			else
			{
				$cod_btn = "";
			}
			if($stocks != 0)
			{
			$buy_btn = '<button class="btn btn-primary purchase-btn mt-3" product-id="'.$id.'" product-price="'.$price.'" product-title="'.$title.'" product-brand="'.$brand.'">BUY NOW</button>';
			}
			else
			{
				$buy_btn = "<button class='btn btn-success border mt-3'><i class='fa fa-shopping-cart'></i> Whoops ! Out of stock</button>";
			}
		}
		else
		{
			$buy_btn = "<button class='btn btn-info mt-3'>Whoops ! product delivery not available in your area</button>";
		}
	}
	?>
	<div class="container my-4">
		<a href="#" class="text-capitalize"><?php echo $category;?></a>
		>
		<a href="#" class="text-capitalize"><?php echo $brand;?></a>
		>
		<a href="#" class="text-capitalize"><?php echo $title;?></a>
		<div class="row mt-3">
			<div class="col-md-6 bg-white py-3" align="center">
				<img src="<?php echo "../../".$front_pic;?>" width="60%" class="preview">
				<br>
				<img src="<?php echo "../../".$back_pic;?>" width="80" class="border thumb-pic">
				<img src="<?php echo "../../".$left_pic;?>" width="80" class="border thumb-pic">
				<img src="<?php echo "../../".$right_pic;?>" width="80" class="border thumb-pic">
			</div>
			<div class="col-md-6 bg-white py-4" style="border-left: 5px solid #F8F9FA">
				<h4 class="m-0 p-0 text-capitalize"><?php echo $title;?></h4>
				<p class="p-0 m-0 text-uppercase"><?php echo $brand;?></p>
				<p><i class="fa fa-rupee"></i> <?php echo $price;?></p>
				<h4>Descripton</h4>
				<?php echo $description;?>
				<h4>Quantity</h4>
				<?php
				if($stocks<=5)
				{
					echo "<p class='text-success font-weight-bold'>Only <span class='stocks'>".$stocks."</span> in stock</p>";
				}
				else
				{
					echo "<p class='text-success d-none font-weight-bold'>Only <span class='stocks'>".$stocks."</span> in stock</p>";
				}
				?>
				<input type="number" name="qunatity" class="form-control quantity mb-3" style="width: 80px;" value="1">
				<h4>Pay Mode</h4>
				<input type="radio" name="pay-mode" value="online"> ONLINE
				<?php echo $cod_btn;?><br>
				<?php echo $cart_btn;?>
				<?php echo $buy_btn;?>
				<br>

				<h4 class="mt-2">CHECK PRODUCTS AVAILABLITY</h4>
				<input type="number" name="pincode" class="form-control w-75 my-2 pincode-field">
				<p class="pincode-notice"></p>
				<button class="btn btn-warning my-2 pincode-btn">PROCED</button>
			</div>
			<div class="col-md-12 bg-white my-4">
				<h4>Product Reviews</h4>
				<?php
				$get_rateing = "SELECT * FROM purchase WHERE product_id='$id' AND rate <> 0";
				$response = $db->query($get_rateing);
				if($response)
				{
					while($data = $response->fetch_assoc())
					{
						$fullname = $data['fullname'];
						$rate = $data['rate'];
						$comment = $data['comment'];
						$picture = $data['picture'];
						$src = "data:image/png;base64,".base64_encode($picture);

						echo "<div class='media'>
						<img src='".$src."' width='80' height='80' class='border p-2 shadow-sm rounded-circle mr-2'>
						<div class='media-body'>
						<p class='p-0 m-0'>".$fullname."</p>";

						for($i=0;$i<$rate;$i++)
											{
											 echo "<i class='fa fa-star mx-1 text-warning star' style='font-size:25px; pointer-events:none' index='".$i."'></i>";	
											}

											$res_star = 5-$rate;
											for($i=0;$i<$res_star;$i++)
											{
											 echo "<i class='fa fa-star-o mx-1 text-warning star' style='font-size:25px;pointer-events:none' index='".$i."'></i>";	
											}

						echo "<p>".$comment."</p>";
						echo "
						</div>
						</div>";
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