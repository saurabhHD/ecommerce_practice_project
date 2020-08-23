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
	<div class="container bg-white border shadow-lg mt-3 p-5">
		<h2>TERMS & CONDITIONS</h2>
		<hr>
		<?php

		echo $branding_result['term'];
		?>
	</div>
	<?php
	include_once("assest/footer.php");
	?>
</body>
</html>