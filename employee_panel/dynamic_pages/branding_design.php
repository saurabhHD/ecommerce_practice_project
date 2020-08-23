<?php
echo '<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8 bg-white shadow-lg p-4 rounded-lg">
				<form class="branding-form">
					<div class="form-group mb-3">
						<label for="brand-name" class="font-weight-bold">Enter brand name</label><i class="fa fa-edit text-primary close branding-edit" style="cursor: pointer"> Edit details</i>
							<input type="text" name="brand_name" id="brand-name" class="form-control" placeholder="shopme">	
					</div>
					<div class="form-group mb-3">
						<label for="brand-logo" class="font-weight-bold">Upload brand logo</label>
							<input type="file" name="brand_logo" id="brand-logo" class="form-control pb-3" >	
					</div>
					<div class="form-group mb-3">
						<label for="domain-name" class="font-weight-bold">Enter domain name</label>
							<input type="text" name="domain_name" id="domain-name" class="form-control" placeholder="www.shopme.com">	
					</div>
					<div class="form-group mb-3">
						<label for="email" class="font-weight-bold">Email</label>
							<input type="text" name="email" id="email" class="form-control" placeholder="shopme@gmail.com">	
					</div>
					<div class="form-group mb-3">
						<label for="social-handel" class="font-weight-bold">Social handels</label>
							<input type="text" name="facebook" id="social-handel" class="form-control facebook mb-3" placeholder="facebook url">
							<input type="text" name="twitter" id="social-handel" class="form-control twitter" placeholder="twitter url">	
					</div>
					<div class="form-group mb-3">
						<label for="address" class="font-weight-bold">Address</label> <small class="address">0</small><small>/5000</small>
							<textarea name="address" rows="20" id="address" class="form-control" maxlength="5000"></textarea>
					</div>
					<div class="form-group mb-3">
						<label for="phone" class="font-weight-bold">Phone</label>
							<input type="text" name="phone" id="phone" class="form-control" placeholder="1800 1802223">	
					</div>
					<div class="form-group mb-3">
						<label for="about-us" class="font-weight-bold">About us</label> <small class="about">0</small><small>/5000</small>
							<textarea name="about-us" rows="20" id="about-us" class="form-control" maxlength="5000"></textarea>	
					</div>
					<div class="form-group mb-3">
						<label for="privacy-policy" class="font-weight-bold">Privacy policy</label> <small class="privacy">0</small><small>/5000</small>
							<textarea name="privacy-policy" rows="20" id="privacy-policy" class="form-control" maxlength="5000"></textarea>	
					</div>
					<div class="form-group mb-3">
						<label for="cookies-policy" class="font-weight-bold">Cookies policy</label> <small class="cookie">0</small><small>/5000</small>
							<textarea name="cookies-policy" rows="20" id="cookies-policy" class="form-control" maxlength="5000"></textarea>	
					</div>
					<div class="form-group mb-3">
						<label for="term" class="font-weight-bold">Term and condition</label> <small class="term-count">0</small><small>/5000</small>
							<textarea name="term" id="term" rows="20" maxlength="5000" class="form-control" ></textarea>	
					</div>
					<button class="btn btn-primary">Submit your information</button>
				</form>
				
			</div>
			<div class="col-md-2"></div>	
			</div>';
?>