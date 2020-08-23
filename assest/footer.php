<div class="container-fluid bg-white border-top py-3" style="margin-top: 100px">
		<div class="container d-flex justify-content-between">
			<div class="input-group w-50">
				<input type="email" name="email" class="form-control subscribe-email" placeholder="example@gmail.com">
				<div class="input-group-append ">
					<span class="input-group-text subscribe-btn">SUBSCRIBE</span>
				</div>
			</div>
			<div class="btn-group">
				<button class="btn border btn-dark">FOLLOW US</button>
				<button class="btn border px-3"><a href="<?php echo $branding_result['facebook_url'];?>"><i class="fa fa-facebook"></i></a></button>
				<button class="btn border px-3"><a href="<?php echo $branding_result['twitter_url'];?>"><i class="fa fa-twitter"></i></a></button>
			</div>
		</div>
	</div>
	<div class="container-fluid bg-dark">
		<div class="container py-3">
			<div class="row">
				<div class="col-md-3">
					<h5 class="text-light">CATEGORY</h5>
					<?php
					$get_category = "SELECT category_name FROM category";
					$response = $db->query($get_category);
					if($response)
					{
						while($nav = $response->fetch_assoc())
						{
							echo '<a class="d-block text-capitalize py-2" href="#">'.$nav['category_name'].'</a>';
						}
					}
					?>
				</div>
				<div class="col-md-1"></div>
				<div class="col-md-3">
					<h5 class="text-light">POLICIES</h5>
					<a href="privacy.php" class="d-block py-2">Privacy Policy</a>
					<a href="cookies.php" class="d-block py-2">Cookies Policy</a>
					<a href="terms.php" class="d-block py-2">Terms & Conditions</a>
				</div>
				<div class="col-md-1"></div>
				<div class="col-md-4">
					<h5 class="text-light">CONTACTS</h5>
					<p class="text-light">Venue : <?php echo $branding_result['address'];?></p>
					<p class="text-light">Call : <?php echo $branding_result['phone'];?></p>
					<p class="text-light">Email : <?php echo $branding_result['email'];?></p>
					<p class="text-light">Website : <?php echo $branding_result['domain_name'];?></p>
				</div>
			</div>
		</div>
	</div>