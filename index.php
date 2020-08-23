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
	<script src="pages/js/index.js"></script>
	<style>
		.corousel-caption{
			line-height: 80px;
			height: 100%;
		}
		@media(max-width: 768px)
		{
			.corousel-caption{
				justify-content: center;
			}
			#top-slider h1{
				margin-top: 10%;
				font-size: 180% !important;
			}
			#top-slider h4{
				font-size: 120% !important;
			}
			#top-slider button a{
				font-size: 15px !important;
			}
		}
		@media(max-width: 576px)
		{
			
			#categoy-showcase{
				width: 80% !important;
				margin-left: 10%;
				margin-right: 10%;
			}
		}
	</style>
</head>
<body class="bg-white">
	<?php
	include_once("assest/nav.php");
	?>
	<div class="container-fluid p-0">
		<div class="carousel slide" data-ride="carousel" id="top-slider">
			<div class="carousel-inner">
				<div class="corousel-item">
					<img src="a.jpg" class="w-100">
					
				<?php
				$showcase = "SELECT * FROM header_showcase";
				$response = $db->query($showcase);
				if($response)
				{

					while($data = $response->fetch_assoc())
					{
						$h_align = $data['h_align'];
						$v_align = $data['v_align'];
						$text_align = "";
						if($h_align == "center")
						{
							$text_align = "text-center";
						}
						else
						{
							$text_align = "text-left";
						}
						$title_color = $data['title_color'];
						$title_size = $data['title_size'];
						$subtitle_color = $data['subtitle_color'];
						$subtitle_size = $data['subtitle_size'];
						echo "<div class='carousel-item carousel-item-control'>";
						$img = "data:image/png;base64,".base64_encode($data['title_image']);
						echo "<img src='".$img."' class='w-100'>";
						echo "<div class='carousel-caption ".$text_align." h-100 d-flex' style='justify-content:".$h_align.";align-items:".$v_align."'>";
						echo "<div>";
						echo "<h1 style='color:".$title_color.";font-size:".$title_size."'>".$data['title_text']."</h1>";
						echo "<h4 style='color:".$subtitle_color.";font-size:".$subtitle_size."'>".$data['subtitle_text']."</h4>";
						echo $data['buttons'];
						echo "</div>";
						echo "</div>";
						echo "</div>";
					}
				}
				?>
			</div>
		</div>
	</div>
	<!--Category showcase-->
	<div class="container" id="categoy-showcase">
		<h3 class="text-center my-3">Category Showcase</h3>
		<div class="row">
			<?php
			$dir = ["top-left","bottom-left","center","top-right","bottom-right"];
			$top_left_image = "";
			$top_left_lable = "";

			$bottom_left_image = "";
			$bottom_left_lable = "";

			$center_image = "";
			$center_lable = "";

			$top_right_image = "";
			$top_right_lable = "";

			$bottom_right_image = "";
			$bottom_right_lable = "";

			for($i=0;$i<count($dir);$i++)
			{
				$get_data = "SELECT * FROM category_showcase WHERE direction='$dir[$i]'";
				$response = $db->query($get_data);

				$data = $response->fetch_assoc();

				if($dir[$i] == "top-left")
				{
					$top_left_image = "data:image/png;base64,".base64_encode($data['image']);
					$top_left_lable = $data['lable'];
				}
				else if($dir[$i] == "bottom-left")
				{
					$bottom_left_image = "data:image/png;base64,".base64_encode($data['image']);
					$bottom_left_lable = $data['lable'];
				}
				else if($dir[$i] == "center")
				{
					$center_image = "data:image/png;base64,".base64_encode($data['image']);
					$center_lable = $data['lable'];
				}
				else if($dir[$i] == "top-right")
				{
					$top_right_image = "data:image/png;base64,".base64_encode($data['image']);
					$top_right_lable = $data['lable'];
				}
				else if($dir[$i] == "bottom-right")
				{
					$bottom_right_image = "data:image/png;base64,".base64_encode($data['image']);
					$bottom_right_lable = $data['lable'];
				}
			}

				echo "<div class='col-md-4'>
				<div class='position-relative mb-3'>
				<button class='btn border p-2 shadow-lg bg-white' style='position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);z-index:1000'>".$top_left_lable."</button>
				<img src='".$top_left_image."' width='100%'>
				</div>
				<div class='position-relative mb-3'>
				<button class='btn border p-2 shadow-lg bg-white' style='position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);z-index:1000'>".$bottom_left_lable."</button>
				<img src='".$bottom_left_image."' width='100%'>
				</div>
				</div>";

				echo "
					<div class='col-md-4'>
				<div class='position-relative mb-3'>
				<button class='btn border p-2 shadow-lg bg-white' style='position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);z-index:1000'>".$center_lable."</button>
				<img src='".$center_image."' width='100%'>
				</div>
				</div>
				";

				echo "<div class='col-md-4'>
				<div class='position-relative mb-3'>
				<button class='btn border p-2 shadow-lg bg-white' style='position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);z-index:1000'>".$top_right_lable."</button>
				<img src='".$top_right_image."' width='100%'>
				</div>
				<div class='position-relative mb-3'>
				<button class='btn border p-2 shadow-lg bg-white' style='position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);z-index:1000'>".$bottom_right_lable."</button>
				<img src='".$bottom_right_image."' width='100%'>
				</div>
				</div>";
			?>
		</div>
	</div>

	<!--End Category showcase-->


	<!--Products showcase-->
	<div class="container-fluid">
		<h4 class="text-center my-3">PRODUCTS FOR YOU</h4>
		<div class="row">
			<?php
			$get_data = "SELECT * FROM products ORDER BY rand() LIMIT 12";
			$response = $db->query($get_data);
			if($response)
			{
				while($data = $response->fetch_assoc())
				{
					$pro_id = $data['id'];
					echo "<div class='col-md-3 my-5' align='center'>
							<img src='".$data['thumb_path']."'><br>
							<span class='text-uppercase font-weight-bold'>".$data['category_name']."</span><br>";
	$one = [];
	$two = [];
	$three = [];
	$four = [];
	$five = [];
	$get_rating = "SELECT rate FROM purchase WHERE product_id='$pro_id' AND rate <> 0";
	$rating_response = $db->query($get_rating);
	if($rating_response)
	{
		while($rating_data = $rating_response->fetch_assoc())
		{
			if($rating_data['rate'] == 1)
			{
				array_push($one, 1);
			}
			else if($rating_data['rate'] == 2)
			{
				array_push($two, 2);
			}
			else if($rating_data['rate'] == 3)
			{
				array_push($three, 3);
			}
			else if($rating_data['rate'] == 4)
			{
				array_push($four, 4);
			}
			else if($rating_data['rate'] == 5)
			{
				array_push($five, 5);
			}
		}

		$count_one = count($one);
		$count_two = count($two);
		$count_three = count($three);
		$count_four = count($four);
		$count_five = count($five);

		$all_length = [$count_one,$count_two,$count_three,$count_four,$count_five];
		$max = 0;

		for($i=0;$i<count($all_length);$i++)
		{
			if($all_length[$i]>$max)
			{
				$max = $all_length[$i];
			}
		}

		if($max == $count_one)
		{
			for($i=0;$i<1;$i++)
			{
				echo "<i class='fa fa-star text-warning'></i>";
			}
			$res_star = 5-1;
			for($i=0;$i<$res_star;$i++)
			{
				echo "<i class='fa fa-star-o text-warning'></i>";
			}
		}
		else if($max == $count_two)
		{
			for($i=0;$i<2;$i++)
			{
				echo "<i class='fa fa-star text-warning'></i>";
			}
			$res_star = 5-2;
			for($i=0;$i<$res_star;$i++)
			{
				echo "<i class='fa fa-star-o text-warning'></i>";
			}
		}
		else if($max == $count_three)
		{
			for($i=0;$i<3;$i++)
			{
				echo "<i class='fa fa-star text-warning'></i>";
			}
			$res_star = 5-3;
			for($i=0;$i<$res_star;$i++)
			{
				echo "<i class='fa fa-star-o text-warning'></i>";
			}
		}
		else if($max == $count_four)
		{
			for($i=0;$i<4;$i++)
			{
				echo "<i class='fa fa-star text-warning'></i>";
			}
			$res_star = 5-4;
			for($i=0;$i<$res_star;$i++)
			{
				echo "<i class='fa fa-star-o text-warning'></i>";
			}
		}
		else if($max == $count_five)
		{
			for($i=0;$i<5;$i++)
			{
				echo "<i class='fa fa-star text-warning'></i>";
			}
			
		}
	}


							echo "<br>
							<span>".$data['title']."</span><br>
							<span><i class='fa fa-rupee'></i> ".$data['price']."</span><br>
							<button class='btn btn-danger cart-btn' product-id='".$data['id']."' product-title='".$data['title']."' product-brand='".$data['brands']."' product-price='".$data['price']."' product-pic='".$data['thumb_path']."'><i class='fa fa-shopping-cart'></i> ADD TO CART</button>
							<button class='btn btn-primary buy-btn' product-id='".$data['id']."'><i class='fa fa-shopping-bag'></i> BUY NOW</button>
					</div>";
				}
			}

			?>
		</div>
	</div>

	<!--/Products showcase-->
	
	<?php
	include_once("assest/footer.php");

	?>
	<script>
		$(document).ready(function(){
			var corousel_item = document.querySelector(".carousel-item-control");
			$(corousel_item).addClass("active");
		});
	</script>
</body>
</html>