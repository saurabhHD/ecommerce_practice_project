<?php
session_start();
$cart = "";
$branding_result = "";
$get_branding_data = "SELECT * FROM branding";
$branding_response = $db->query($get_branding_data);
if($branding_response)
{
	$branding_result = $branding_response->fetch_assoc();
}
$menu = "";
if(empty($_COOKIE['_au_']))
{
	$menu = '<a href="signup.php" class="dropdown-item"><i class="fa fa-user"></i> Sign up</a>
					<a href="login.php" class="dropdown-item"><i class="fa fa-sign-in"></i> Sign in</a>';
}
else
{
	$username = base64_decode($_COOKIE['_au_']);
	$fullname = "";
	$get_data = "SELECT * FROM users WHERE email='$username'";
	$response = $db->query($get_data);
	if($response)
	{
		$data = $response->fetch_assoc();
		$fullname = $data['firstname']." ".$data['lastname'];
		$_SESSION['fullname'] = $fullname;
		$_SESSION['username'] = $username;
		$_SESSION['mobile'] = $data['mobile'];
		$_SESSION['pincode'] = $data['pincode'];

	}
	$menu = '<a href="http://localhost/shop/pages/php/profile.php" class="dropdown-item text-capitalize"><i class="fa fa-user"></i> '.$fullname.'</a>
	<a href="http://localhost/shop/pages/php/logout.php" class="dropdown-item"><i class="fa fa-sign-out"></i> Sign out</a>';
	$get_cart = "SELECT COUNT(id) AS result FROM cart WHERE username='$username'";
	$response = $db->query($get_cart);

	if($response){
	if($response->num_rows != 0)
	{
		$data = $response->fetch_assoc();
		if($data['result'] != 0)
		{
		$cart = '<div style="position: absolute;width:25px;height:25px;background-color: red;color: white;font-weight: bold;border-radius: 50%;top: -10px;left: 25px;z-index: 1000" class="cart-notification">
					<span>
						'.$data['result'].'
					</span>
				</div>';
			}
	}
}
}
?>

<div class="container-fluid bg-white shadow-sm">
	<nav class="container navbar navbar-expand-sm bg-white">
		<div class="collapse navbar-collapse" id="menu-box">
		<ul class="navbar-nav">
			<a href="http://localhost/shop/index.php" class="navbar-brand border shadow-sm d-flex align-items-center p-2 text-uppercase">
				<?php
				$logo_string = base64_encode($branding_result['brand_logo']);
				$complete_src = "data:image/png;base64,".$logo_string;
				echo "<img src='".$complete_src."' width='20'>";
				echo "&nbsp";
				echo "<small>".$branding_result['brand_name']."</small>";
				

				?>
			</a>
			<?php
			$get_category = "SELECT category_name FROM category";
			$response = $db->query($get_category);
			if($response)
			{
				while($nav = $response->fetch_assoc())
				{
					echo '<li class="nav-item"><a class="nav-link text-uppercase text-dark" href="http://localhost/shop/products/'.$nav['category_name'].'">'.$nav['category_name'].'</a></li>';
				}
			}
			?>
		</ul>
		</div>
		<div class="btn-group ml-auto">
			<button class="btn border navbar-toggler" data-toggle="collapse" data-target="#menu-box"><i class="fa fa-bars"></i></button>
			<button class="btn border" ><a href="http://localhost/shop/show_cart.php" class="cart-link"><i class="fa fa-shopping-cart"></i>
				<?php
				echo $cart;
				?>
			</a>
			</button>

			<button class="btn border d-flex align-items-center">
				<input type="search" class="form-control search mr-2" style="width: 350px;float: left;" placeholder="search products">
				</button>
				<button class="btn border search-icon">
					<i class="fa fa-search"></i>
				</button>
			<button class="btn border dropdown" ><i class="fa fa-user" data-toggle="dropdown"></i>
				<div class="dropdown-menu">
					<?php echo $menu;?>
				</div>
			</button>
			<div class="position-absolute bg-white search-hint" style="width: 100%;z-index: 5000;top: 60px;">
				
			</div>
		</div>
	</nav>
</div>