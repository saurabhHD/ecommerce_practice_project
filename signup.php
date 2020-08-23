<?php
require_once("common_files/database/database.php");

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="view-port" content="width=device-width, initial-scale=1">
	<title>Welcome</title>
	<link rel="stylesheet" href="common_files/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.0/animate.min.css">
	<script src="common_files/js/jquery.js"></script>
	<script src="common_files/js/popper.js"></script>
	<script src="common_files/js/bootstrap.min.js"></script>
</head>
<body class="bg-light">
	<?php
	include_once("assest/nav.php");
	?>
	<div class="container bg-white shadow-lg mt-3 p-4">
		<h2>CREATE AN ACCOUNT</h2>
		<hr>
		<div class="row">
			<div class="col-md-6">
				<form class="signup-form">
					<div class="form-group">
						<label for="firstname">Firstname<sup class="text-danger">*</sup></label>
						<input type="text" name="firstname" id="firstname" class="form-control bg-light" required="required" placeholder="mr raj">
					</div>
					<div class="form-group">
						<label for="lastname">Lastname<sup class="text-danger">*</sup></label>
						<input type="text" name="lastname" id="lastname" class="form-control bg-light" required="required" placeholder="kumar">
					</div>
					<div class="form-group">
						<label for="email">Email<sup class="text-danger">*</sup></label>
						<input type="email" name="email" id="email" class="form-control bg-light" required="required" placeholder="example@gmail.com">
					</div>
					<div class="form-group">
						<label for="mobile">Mobile<sup class="text-danger">*</sup></label>
						<input type="text" name="mobile" id="mobile" class="form-control bg-light" required="required" placeholder="9657889654">
					</div>
					<div class="form-group">
						<label for="password">Password<sup class="text-danger">*</sup></label>
						<input type="password" name="password" id="password" class="form-control bg-light" required="required" placeholder="Br!@455">
					</div>
					<div class="form-group">
						<label for="address">Address<sup class="text-danger">*</sup></label>
						<textarea type="text" name="address" id="address" class="form-control bg-light" required="required" placeholder="address"></textarea>
					</div>
					<div class="form-group">
						<label for="state">State<sup class="text-danger">*</sup></label>
						<input type="text" name="state" id="state" class="form-control bg-light" required="required" placeholder="UP">
					</div>
					<div class="form-group">
						<label for="country">Country<sup class="text-danger">*</sup></label>
						<input type="text" name="country" id="country" class="form-control bg-light" required="required" placeholder="India">
					</div>
					<div class="form-group">
						<label for="pincode">Pincode<sup class="text-danger">*</sup></label>
						<input type="text" name="pincode" id="pincode" class="form-control bg-light" required="required" placeholder="100200">
					</div>
					<div class="form-group">
						<button class="btn btn-primary py-2 shadow-sm register-btn" type="submit">Register Now</button>
					</div>
				</form>
				<form class="d-none otp-form">
					<div class="form-group">
						<div class="btn-group">
							<button class="btn btn-light" type="button">
								<input type="number" placeholder="123456" name="otp" class="form-control otp">
							</button>
							<button class="btn btn-light verify-btn" type="button">VERIFY NOW</button>
							<button class="btn btn-light resend-btn" type="button">RESEND OTP</button>
						</div>
					</div>
				</form>
			</div>
			<div class="col-md-6"></div>
		</div>
		
	</div>
	<?php
	include_once("assest/footer.php");
	?>
	<script>
		$(document).ready(function(){
			$(".signup-form").submit(function(e){
				e.preventDefault();
				$.ajax({
					type : "POST",
					url : "pages/php/register.php",
					data : new FormData(this),
					processData : false,
					contentType : false,
					cache : false,
					beforeSend : function(){
						$(".register-btn").html("Please wait");
					},
					success : function(response){
						if(response == "success")
						{
							$(".signup-form").addClass("d-none");
							$(".otp-form").removeClass("d-none");

							// verify otp

							$(".verify-btn").click(function(){
								$.ajax({
									type : "POST",
									url : "pages/php/verify_otp.php",
									data : {
										otp : $(".otp").val().trim(),
										email : $("#email").val()
									},
									beforeSend : function(){
										$(this).html("please wait...");
									},
									success : function(response){
										if(response.trim() == "success")
										{
											window.location = "login.php";	
										}
										else
										{
											$(".verify-btn").html(response);
											setTimeout(function(){
												$(".verify-btn").html("VERIFY NOW");
												$(".otp").val("");
											},3000);
										}
									}
								});
							});

							// resend otp 

							$(".resend-btn").click(function(){
								$.ajax({
									type : "POST",
									url : "pages/php/resend_otp.php",
									data : {
										mobile : $("#mobile").val()
									},
									success : function(response)
									{
										if(response == "success")
										{
											$(".resend-btn").html("Otp has been resended");
										}
										else
										{
											$(".resend-btn").html(response);	
											setTimeout(function(){
												$(".resend-btn").html("RESEND OTP")
											},3000);
										}
									}
								});
							});
						}
					}
				});
			});
		});
	</script>
</body>
</html>