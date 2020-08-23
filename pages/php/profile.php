
<?php
require_once("../../common_files/database/database.php");

if(empty($_COOKIE['_au_']))
{
	header("Location:../../login.php");
	exit;
}

$username = base64_decode($_COOKIE['_au_']);

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="view-port" content="width=device-width, initial-scale=1">
	<title>Welcome</title>
	<link rel="stylesheet" href="../../common_files/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.0/animate.min.css">
	<script src="../../common_files/js/jquery.js"></script>
	<script src="../../common_files/js/popper.js"></script>
	<script src="../../common_files/js/bootstrap.min.js"></script>
	<script src="../../pages/js/index.js"></script>
</head>
<body class="bg-light">
	<?php
	include_once("../../assest/nav.php");
	
	?>
	<div class="container my-4">
		<div class="row">
			<div class="col-md-12">
				<ul class="nav nav-tabs">
					<li class="nav-item">
						<a href="#personal" class="nav-link active" data-toggle="tab">
						PERSONAL
						</a>
					</li>
					<li class="nav-item">
						<a href="#privacy" class="nav-link" data-toggle="tab">
						PRIVACY
						</a>
					</li>
					<li class="nav-item">
						<a href="#purchase" class="nav-link" data-toggle="tab">
						PURCHASE HISTORY
					</a>
				</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="personal">
						<?php
							$get_data = "SELECT * FROM users WHERE email='$username'";
							$response = $db->query($get_data);
							$email = "";
							$firstname = "";
							$lastname = "";
							$mobile = "";
							$address = "";
							$state = "";
							$pincode = "";
							$country = "";
							if($response)
							{
								$data = $response->fetch_assoc();
								$email = $data['email'];
								$firstname = $data['firstname'];
								$lastname = $data['lastname'];
								$mobile = $data['mobile'];
								$address = $data['address'];
								$state = $data['state'];
								$pincode = $data['pincode'];
								$country = $data['country'];
							
							}

						?>
						<div class="jumbotron py-3 my-4 bg-white shadow-sm border-right border-top border-bottom" style="border-left: 5px solid blue">
							<form class="personal-form">
								<div class="form-group">
									<label for="firstname">FIRSTNAME</label>
									<input type="text" name="firstname" id="firstname" class="form-control" value="<?php echo $firstname;?>">
								</div>
								<div class="form-group">
									<label for="lastname">LASTNAME</label>
									<input type="text" name="lastname" id="lastname" class="form-control" value="<?php echo $lastname;?>">
								</div>
								<div class="form-group">
									<label for="email">EMAIL</label>
									<input type="email" name="email" id="email" class="form-control" value="<?php echo $email;?>">
								</div>
								<div class="form-group">
									<label for="mobile">MOBILE</label>
									<input type="text" name="mobile" id="mobile" class="form-control" value="<?php echo $mobile;?>">
								</div>
								<div class="form-group">
									<label for="state">STATE</label>
									<input type="text" name="state" id="state" class="form-control"  value="<?php echo $state;?>">
								</div>
								<div class="form-group">
									<label for="country">COUNTRY</label>
									<input type="text" name="country" id="country" class="form-control"  value="<?php echo $country;?>">
								</div>
								<div class="form-group">
									<label for="pincode">PINCODE</label>
									<input type="text" name="pincode" id="pincode" class="form-control"  value="<?php echo $pincode;?>">
								</div>
								<div class="form-group">
									<label for="address">ADDRESS</label>
									<textarea name="address" id="address" class="form-control">
										<?php
										echo $address;;
										?>
									</textarea>
								</div>
								<button type="submit" class="btn btn-primary update-btn">UPDATE</button>
							</form>
						</div>
					</div>
					<div class="tab-pane fade" id="privacy">
						<div class="jumbotron py-3 my-4 bg-white shadow-sm border-right border-top border-bottom" style="border-left: 5px solid blue">
							<form class="privacy-form">
								<div class="form-group">
									<label for="oldpassword">OLD PASSWORD</label>
									<input type="password" name="oldpassword" id="oldpassword" class="form-control">
								</div>
								<div class="form-group">
									<label for="newpassword">NEW PASSWORD</label>
									<input type="password" name="newpassword" id="newpassword" class="form-control">
								</div>
								<div class="form-group">
									<label for="re-enter-password">RE ENTER NEW PASSWORD</label>
									<input type="password" name="re-enter-password" id="re-enter-password" class="form-control">
								</div>
							
								<button type="submit" class="btn btn-primary change-password-btn">CHANGE PASSWORD</button>
							</form>
						</div>
					</div>
					<div class="tab-pane fade" id="purchase">
						<?php

						$purchase = "SELECT * FROM purchase WHERE email='$username'";
						$response = $db->query($purchase);

						if($response)
						{
							if($response->num_rows != 0)
							{
								while($data = $response->fetch_assoc())
								{
									$product_id = $data['product_id'];
									$title = $data['title'];
									$brand = $data['brand'];
									$qnt = $data['qnt'];
									$amount = $data['amount'];
									$payment_mode = $data['payment_mode'];
									$status = $data['status'];
									$rate = $data['rate'];
									$comment = $data['comment'];
									$date= date_create($data['purchase_date']);
									$purchase_date = date_format($date, 'd/m/Y');
									$pic = "";

									// get pic

									$get_pic = "SELECT * FROM products WHERE id='$product_id'";
									$response = $db->query($get_pic);
									if($response)
									{
										$data = $response->fetch_assoc();
										$pic = $data['thumb_path'];
									}
									
									echo "<div class='media border bg-white shadow-sm my-4'>
									<img src='../../".$pic."' class='mr-2 border' width='150'>
									<div class='media-body'>
									<h4 class='text-uppercase'>".$title."</h4>
									<p class='p-0 my-2'><i class='fa fa-rupee'></i> ".$amount."</p>
									<p class='p-0 my-2'>Quantity : ".$qnt."</p>
									<p class='p-0 my-2'>payment mode : ".$payment_mode."</p>
									<p class='p-0 my-2'>Status : ".$status."</p>
									<p class='p-0 my-2'>Purchase date : ".$purchase_date."</p>
									
									";

									if($status == "delivered")
									{
										
										if($rate == 0)
										{
											echo "<h4 class='comment-header'>Rate this product</h4>";
											for($i=0;$i<5;$i++)
											{
												echo "<i class='fa fa-star-o mx-1 text-warning star' style='font-size:25px' index='".$i."'></i>";
											}
											echo "<div class='comment-box'>
											<div class='form-group'>
											<label for='comment'>Comment</label>
											<textarea maxlength='100' class='form-control w-75' id='comment'></textarea>
											</div>
											</div>
											<div class='picture-box'>
											<div class='form-group'>
											<label for='picture'>Picture</label>
											<input type='file' class='form-control w-75' accept='image/*' id='picture'>
											</div>
											</div>
											";
											echo "
											<p class='comment-msg'></p>
											<button class='btn star-btn d-none btn-primary my-2' product-id='".$product_id."'>Rate</button>";
										}
										else
										{
											echo "<h4>Your rateing</h4>";
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

										}
									}
									

									

									echo 
									"</div>
									</div>";
								}
							}
							else
							{
								echo "<h4><i class='fa fa-shopping-bag'></i> Your purchase history is empty !</h4>";
							}
						}

						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
	include_once("../../assest/footer.php");
	?>
</body>
</html>