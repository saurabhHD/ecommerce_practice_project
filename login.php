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
		<h2>LOGIN WITH US</h2>
		<hr>
		<div class="row">
			<div class="col-md-6">
				<form class="signin-form">
					<div class="form-group">
						<label for="email">Email<sup class="text-danger">*</sup></label>
						<input type="email" name="email" id="email" class="form-control bg-light" required="required" placeholder="example@gmail.com">
					</div>
					<div class="form-group">
						<label for="password">Password<sup class="text-danger">*</sup></label>
						<input type="password" name="password" id="password" class="form-control bg-light" required="required" placeholder="Br!@455">
					</div>
					<div class="form-group">
						<button class="btn btn-primary py-2 login-btn shadow-sm" type="submit">Login Now</button>
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
				<div class="form-group login-notice"></div>
			</div>
			<div class="col-md-1"></div>
			<div class="col-md-5">
				<h4>NEW COSTOMER</h4>
				<p>If you don't have an account please register with us</p>
				<a href="signup.php" class="btn btn-danger py-2 my-3">Create an account</a>
			</div>
		</div>
		
	</div>
	<?php
	include_once("assest/footer.php");
	?>

	<script>
		$(document).ready(function(){
			$(".signin-form").submit(function(e){
				e.preventDefault();
				$.ajax({
					type : "POST",
					url : "pages/php/login.php",
					data : new FormData(this),
					processData : false,
					contentType : false,
					cache : false,
					beforeSend : function(){
						$(".login-btn").attr("disabled","disabled");
						$(".login-btn").html("Please wait...");
					},
					success : function(response){
						if(response.trim() == "success")
						{
							$(".otp-form").removeClass("d-none");
							$(".signin-form").addClass("d-none");

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
											var notice = document.createElement("DIV");
											notice.innerHTML = "your account successfully verified please login again";
											notice.className = "alert alert-success";
											$(".login-notice").append(notice);
											setTimeout(function(){
												window.location = "login.php";
											},3000);
												
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
										mobile : $("#email").val()
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
						else if(response.trim() == "login success") 
						{
							window.location = "index.php";
						}
						else
						{
							
							$(".signin-form").trigger('reset');
							$(".login-btn").removeAttr("disabled");
							$(".login-btn").html("LOGIN NOW");
							var notice = document.createElement("DIV");
											notice.innerHTML = "wrong password or email";
											notice.className = " alert alert-warning";
											$(".login-notice").html(notice);
											setTimeout(function(){
												$(".login-notice").html("");
											},3000);
						}
					}
				});
			});
		});
	</script>
</body>
</html>