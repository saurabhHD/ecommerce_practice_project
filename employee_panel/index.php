<?php
require_once("../common_files/php/database.php");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Welcome</title>
	<link rel="stylesheet" href="../common_files/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/index.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.0/animate.min.css">
	
	<script src="../common_files/js/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="../common_files/js/popper.js"></script>
    <script src="../common_files/js/bootstrap.min.js"></script>
	<script src="js/index.js"></script>  
</head>
<body>
	<div class="container-fluid w-100 animated fadeIn">
		<div class="sidebar">
			<button class="btn active w-100 text-left collapse-item" style="font-size: 20px" access-link="branding_design.php">
				<i class="fa fa-image"></i>
				Branding
			</button>
			<button class="btn w-100 text-left collapse-item" style="font-size: 20px" access-link="delivery_area_design.php">
				<i class="fa fa-map-marker"></i>
				Delivery Area
			</button>
			<button class="btn homepage-design-btn w-100 text-left" style="font-size: 20px">
				<i class="fa fa-home"></i>
				Homepage design   <i class="fa fa-angle-down close mt-2"></i>
			</button>
			<ul class="collapse homepage-design-collapse">
				<li class="border-left p-2 collapse-item x" access-link="header_showcase_design.php">Header showcase</li>
				<li class="border-left p-2 collapse-item" access-link="category_showcase_design.php">Category showcase</li>
			</ul>
			<button class="btn w-100 text-left stock-update-btn" style="font-size: 20px">
				<i class="fa fa-shopping-cart"></i>
				Stock update
				<i class="fa fa-angle-down close mt-2"></i>
			</button> 
			<ul class="collapse stock-update-btn-menu">
				<li class="border-left p-2 collapse-item x" access-link="create_category_design.php">Create category</li>
				<li class="border-left p-2 collapse-item" access-link="create_brands_design.php">Create brands</li>
				<li class="border-left p-2 collapse-item" access-link="create_products_design.php">Create products</li>
			</ul>
		</div>
		<div class="page">
			<div class="row">
				<div class="col-md-12 d-flex justify-content-between">
					<div class="btn-group bg-white shadow-sm">
						<button class="btn bg-white">Short By</button>
						<button class="btn bg-white">
							<select class="form-control short-by">
								<option>All data</option>
								<option>Today's sales</option>
								<option>New sales</option>
								<option>Old sales</option>
								<option>Not dispached</option>
								<option>Dispached Products</option>
								<option>Returned Products</option>
							</select>
						</button>
						<button class="btn btn-dark d-all">
							DISPACHED ALL
						</button>
					</div>
					<div class="btn-group bg-white shadow-sm">
						<button class="btn bg-white">Export TO</button>
						<button class="btn bg-white">
							<select class="form-control export-to">
								<option>Choose format</option>
								<option>pdf</option>
								<option>xls</option>
							</select>
						</button>
						
					</div>
				</div>
			</div>
			<div class="row my-4">
				<div class="col-md-12">
					<div class="table-responsive">
					<table class="w-100 purchase-table text-center table table-bordered bg-white">
						<tr>
							<th>S/NO</th>
							<th>PRODUCT_ID</th>
							<th>TITLE</th>
							<th>QUANTITY</th>
							<th>PRICE</th>
							<th>ADDRESS</th>
							<th>COUNTRY</th>
							<th>STATE</th>
							<th>PINCODE</th>
							<th>PURCHASE DATE</th>
							<th>COSTOMER NAME</th>
							<th>USERNAME</th>
							<th>MOBILE</th>
							<th>STATUS</th>
							<th>ACTION</th>
						</tr>
						<?php
						$get_data = "SELECT * FROM purchase";
						$response =$db->query($get_data);
						if($response)
						{
							while($data = $response->fetch_assoc())
							{
								echo "<tr>
								<td class='sr_no'>".$data['id']."</td>
								<td>".$data['product_id']."</td>
								<td>".$data['title']."</td>
								<td>".$data['qnt']."</td>
								<td>".$data['amount']."</td>
								<td>".$data['address']."</td>
								<td>".$data['country']."</td>
								<td>".$data['state']."</td>
								<td>".$data['pincode']."</td>
								<td>".$data['purchase_date']."</td>
								<td>".$data['fullname']."</td>
								<td>".$data['email']."</td>
								<td>".$data['mobile']."</td>
								<td class='status'>".$data['status']."</td>
								<td>";
								$dispached_date = date_create($data['dispached_date']);
								$final_date = $dispached_date->format('d-m-Y');
								if($data['status'] == 'processing')
								{
									echo "
								<button class='btn btn-primary dispatch-btn' product-id='".$data['product_id']."' title='".$data['title']."' qnt='".$data['qnt']."' amount='".$data['amount']."' address='".$data['address']."' fullname='".$data['fullname']."' email='".$data['email']."' mobile='".$data['mobile']."' order-id='".$data['id']."' brand='".$data['brand']."'>DISPATCH</button>";
								}
								else if($data['status'] == "dispatch")
								{
									echo "<button class='btn btn-danger' product-id='".$data['product_id']."' title='".$data['title']."' qnt='".$data['qnt']."' amount='".$data['amount']."' address='".$data['address']."' fullname='".$data['fullname']."' email='".$data['email']."' mobile='".$data['mobile']."' order-id='".$data['id']."' brand='".$data['brand']."'>DISPATCHED ON ".$final_date."</button>";	
								}
								echo "
								</td>
								</tr>";
							}
						}
						?>
					</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
		// dispatch btn

$(document).ready(function(){
	$(".dispatch-btn").each(function(){
		$(this).click(function(){
			var btn = $(this);
			var product_id = $(this).attr("product-id");
			var order_id = $(this).attr("order-id");
			var title = $(this).attr("title");
			var amount = $(this).attr("amount");
			var address = $(this).attr("address");
			var fullname = $(this).attr("fullname");
			var mobile = $(this).attr("mobile");
			var brand = $(this).attr("brand");
			var qnt = $(this).attr("qnt");
			var email = $(this).attr("email").trim();
			
			$.ajax({
				type : "POST",
				url  : "php/dispatch.php",
				data : {
					product_id : product_id,
					order_id : order_id,
					title : title,
					amount : amount,
					address : address,
					fullname : fullname,
					mobile : mobile,
					brand : brand,
					email : email,
					qnt : qnt
				},
				beforeSend : function()
				{
					$(btn).html("please wait...");
				},
				success : function(response){
					var length = Number($(".sr_no").length);
					var num = Number(sessionStorage.getItem("count"))+1;
					sessionStorage.setItem("count",num);
					$(".d-all").html(num+" DISPACHED");
					if(length == num)
					{
						$(".d-all").html("COMPLETE");
						sessionStorage.removeItem("count");
						setTimeout(function(){
							$(".d-all").html("DISPATCH ALL");
						}, 2000);
					}
				}
			});
		});
	});
});
//dispach all

$(document).ready(function(){
	$(".d-all").click(function(){
		var status = $(".status");
		var i;
		var massage = "DISPATCH ALL";
		for(i=0;i<status.length;i++)
		{
			if(status[i].innerHTML == "processing")
			{
				var btn = $(".dispatch-btn");
				for(i=0;i<btn.length;i++)
				{
					btn[i].click();
				}

			}
			else
			{
				massage = "No items";
			}
		}
		$(".d-all").html(massage);
		
	});
});

// export to xls 

$(document).ready(function(){
	$(".export-to").on("change", function(){
		if($(this).val() == "xls")
		{
			window.location = "php/export_to_xls.php";
		}
		else if($(this).val() == "pdf")
		{
			window.location = "php/dompdf.php";
		}
	});
});

// short by code

$(document).ready(function(){
	$(".short-by").on("change", function(){
		var option = $(".short-by").val();
		if(option != "all")
		{
			$.ajax({
				type : "POST",
				url : "php/short_by.php",
				data : {
					option : option
				},
				cache : false,
				success : function(response)
				{
					alert(response);
				}
			});
		}
	});
});
	</script>
</body>
</html>