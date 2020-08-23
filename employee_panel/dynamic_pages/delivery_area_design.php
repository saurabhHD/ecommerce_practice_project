<?php 

require_once("../../common_files/php/database.php");
echo '<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6 bg-white">
					<div class="jumbotron bg-white">
						<form class="set-area-form">
						<h4>SET DELIVERY LOCATION</h4>
						<select name="country" class="form-control mb-3 country">
							<option>Choose country</option>'; ?>
							<?php
							$get_country = "SELECT * FROM countries";
							$response = $db->query($get_country);
							if($response)
							{
								while($data = $response->fetch_assoc())
								{
									echo "<option country-id='".$data['id']."'>".$data['name']."</option>";
								}
							}
							?>
							<?php
						echo '</select>
						
						<select name="state" class="form-control mb-3 state">
							<option>Choose state</option>
							
						</select>
						<select name="city" class="form-control mb-3 city">
							<option>Choose city</option>
						</select>
						<input type="number" name="pincode" placeholder="pincode" class="form-control pincode mb-3">
						<select name="payment-mode" class="form-control mb-3 payment-mode">
							<option>Choose payment mode</option>
							<option>Online</option>
							<option>All</option>
						</select>
						
						<input type="text" name="delivery-time" placeholder="Delivery time 3 to 5 days" class="form-control delivery-time mb-3">
						<button class="btn btn-primary setarea-btn">SET AREA</button>
					 </form>
					</div>
				</div>
				<div class="col-md-3"></div>
			</div>'; ?>