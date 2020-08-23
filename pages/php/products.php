
<?php
require_once("../../common_files/database/database.php");
$cat_name = $_GET['cat_name'];
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
	<style>
		*:focus{
			box-shadow: none !important;
		}
	</style>
</head>
<body class="bg-light">
	<?php
	include_once("../../assest/nav.php");
	
	?>
	<div class="container-fluid my-4">
		<a href="#"><?php echo $cat_name;?></a>
		<div class="row mt-3">
			<div class="col-md-3">
				<div class="bg-white w-100 p-4 border">
					<h4>Filter By Brand</h4>
					<div class="btn-group-vertical mb-4">
					<?php
					$get_brand = "SELECT * FROM brands WHERE category_name='$cat_name'";
					$response = $db->query($get_brand);
					if($response)
					{
						echo "<button class='btn filter-btn px-0 text-capitalize text-left' cat-name='".$cat_name."' brand-name='all'><i class='fa fa-angle-double-right'></i> All</button>";
						while($data = $response->fetch_assoc())
						{
							echo "<button class='btn filter-btn px-0 text-capitalize text-left' cat-name='".$cat_name."' brand-name='".$data['brands']."'><i class='fa fa-angle-double-right'></i> ".$data['brands']."</button>";
						}
					}
					?>
					</div>
					<h4>Filter By Price</h4>
					<div class="btn-group-vertical bg-light shadow-sm mb-3">
						<button class="btn">
							<input type="number" name="min-price" class="form-control min-price" placeholder="min price">
						</button>
						<button class="btn">
							<input type="number" name="max-price" class="form-control max-price" placeholder="max price">
						</button>
						<button class="btn price-filter-btn" cat-name="<?php echo $cat_name;?>">Get product
						</button>
					</div>
					<h4>Short BY</h4>
						<select class="form-control short-by">
							<option value="recomended">Recomended</option>
							<option value="high">High to low</option>
							<option value="low">Low to high</option>
							<option value="new">Newest</option>
						</select>
					</h4>
				</div>
			</div>
			<div class="col-md-9">
				<div class="bg-white product-result w-100 p-4 border d-flex flex-wrap justify-content-between"></div>
			</div>
		</div>
	</div>
	<?php
	include_once("../../assest/footer.php");
	?>
</body>
</html>