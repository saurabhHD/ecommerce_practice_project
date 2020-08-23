<?php
$file = $_FILES['photo'];
$location = $file['tmp_name'];
$image = "data:image/png;base64,".base64_encode(file_get_contents($location));
$data = json_decode($_POST['data']);
$text = $data[0];
$h_align = $data[1];
$text_align = "";
if($h_align == "center")
{
	$text_align = "text-center";
}
else if($h_align == "flex-start")
{
	$text_align = "text-left";
}
else if($h_align == "flex-end")
{
	$text_align = "text-left";
}
$v_align = $data[2];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Welcome</title>
	<link rel="stylesheet" href="../../common_files/css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/index.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.0/animate.min.css">
	
	<script src="../../common_files/js/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="../../common_files/js/popper.js"></script>
    <script src="../../common_files/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container-fluid p-0">
		<div class="carousel">
			<div class="carousel-inner">
				<div class="carousel-item active">
					<img src="<?php echo $image;?>" class="w-100">
					<div class="carousel-caption h-100 <?php echo $text_align;?> d-flex" style="justify-content: <?php echo $h_align;?>;align-items: <?php echo $v_align;?>;">
						<div>
							<?php
							echo $text;
							?>
						</div>
					</div>
				</div>	
			</div>
		</div>
	</div>
</body>
</html>