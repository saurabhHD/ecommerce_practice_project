
			
				<?php
				require_once("../../common_files/php/database.php");
				echo '<div class="row">';
			$dir = ["top-left","bottom-left","center","top-right","bottom-right"];
			$top_left_image = "../common_files/images/small_sample.jpg";
			$top_left_lable = "";

			$bottom_left_image = "../common_files/images/small_sample.jpg";
			$bottom_left_lable = "";

			$center_image = "../common_files/images/large_sample.jpg";
			$center_lable = "";

			$top_right_image = "../common_files/images/small_sample.jpg";
			$top_right_lable = "";

			$bottom_right_image = "../common_files/images/small_sample.jpg";
			$bottom_right_lable = "";

			for($i=0;$i<count($dir);$i++)
			{
				$get_data = "SELECT * FROM category_showcase WHERE direction='$dir[$i]'";
				$response = $db->query($get_data);

				$data = $response->fetch_assoc();

				if($dir[$i] == "top-left")
				{
					if($response->num_rows !=0)
					{
					$top_left_image = "data:image/png;base64,".base64_encode($data['image']);
					$top_left_lable = $data['lable'];
					}
				}
				else if($dir[$i] == "bottom-left")
				{
					if($response->num_rows !=0)
					{
					$bottom_left_image = "data:image/png;base64,".base64_encode($data['image']);
					$bottom_left_lable = $data['lable'];
					}
				}
				else if($dir[$i] == "center")
				{
					if($response->num_rows !=0)
					{
					$center_image = "data:image/png;base64,".base64_encode($data['image']);
					$center_lable = $data['lable'];
					}
				}
				else if($dir[$i] == "top-right")
				{
					if($response->num_rows !=0)
					{
					$top_right_image = "data:image/png;base64,".base64_encode($data['image']);
					$top_right_lable = $data['lable'];
					}
				}
				else if($dir[$i] == "bottom-right")
				{	
					if($response->num_rows !=0)
					{
					$bottom_right_image = "data:image/png;base64,".base64_encode($data['image']);
					$bottom_right_lable = $data['lable'];
					}
				}
			}
			?>
			<?php 
				echo '<div class="col-md-4">
					<div class="position-relative">
					<div class="btn-group border position-absolute shadow-sm" style="z-index: 10">
						<button class="btn btn-dark">
							<input type="file" accept="image/*" class="upload-icon position-absolute form-control" style="width: 100%;height:100%;top:0;left: 0;opacity: 0">
							<i class="fa fa-upload"></i>
						</button>
						<button class="btn">
							<input type="text" class="form-control upload-lable" placeholder="mobile" value="'; ?><?php echo $top_left_lable;?><?php echo '">
						</button>
						<button class="btn btn-dark set-btn" disabled="disabled" img-dir="top-left">
							SET
						</button>	
					</div>
					<img src="'; ?><?php echo $top_left_image;?><?php echo '" attr="small_sample" class="w-100 mb-3">
					</div>
					<div class="position-relative">
					<div class="btn-group border position-absolute shadow-sm" style="z-index: 10">
						<button class="btn btn-dark">
							<input type="file" accept="image/*" class="upload-icon position-absolute form-control" style="width: 100%;height:100%;top:0;left: 0;opacity: 0">
							<i class="fa fa-upload upload-icon"></i>
						</button>
						<button class="btn">
							<input type="text" class="form-control upload-lable" placeholder="mobile" value="'; ?><?php echo $bottom_left_lable;?><?php echo '">
						</button>
						<button class="btn btn-dark set-btn" disabled="disabled" img-dir="bottom-left">
							SET
						</button>	
					</div>
					<img src="'; ?><?php echo $bottom_left_image;?><?php echo '" attr="small_sample" class="w-100 mb-3">
					</div>
				</div>
				<div class="col-md-4">
					<div class="position-relative">
					<div class="btn-group border position-absolute shadow-sm" style="z-index: 10">
						<button class="btn btn-dark">
							<input type="file" accept="image/*" class="upload-icon position-absolute form-control" style="width: 100%;height:100%;top:0;left: 0;opacity: 0">
							<i class="fa fa-upload upload-icon"></i>
						</button>
						<button class="btn">
							<input type="text" class="form-control upload-lable" placeholder="mobile" value="'; ?><?php echo $center_lable;?><?php echo '">
						</button>
						<button class="btn btn-dark set-btn" disabled="disabled" img-dir="center">
							SET
						</button>	
					</div>
					<img src="'; ?><?php echo $center_image;?><?php echo '" attr="small_sample" class="w-100 mb-3">
					</div>
				</div>
				<div class="col-md-4">
					<div class="position-relative">
					<div class="btn-group border position-absolute shadow-sm" style="z-index: 10">
						<button class="btn btn-dark">
							<input type="file" accept="image/*" class="upload-icon position-absolute form-control" style="width: 100%;height:100%;top:0;left: 0;opacity: 0">
							<i class="fa fa-upload upload-icon"></i>
						</button>
						<button class="btn">
							<input type="text" class="form-control upload-lable" placeholder="mobile" value="'; ?><?php echo $top_right_lable;?><?php echo '">
						</button>
						<button class="btn btn-dark set-btn" disabled="disabled" img-dir="top-right">
							SET
						</button>	
					</div>
					<img src="'; ?><?php echo $top_right_image;?><?php echo '" attr="small_sample" class="w-100 mb-3">
					</div>
					<div class="position-relative">
					<div class="btn-group border position-absolute shadow-sm" style="z-index: 10">
						<button class="btn btn-dark">
							<input type="file" accept="image/*" class="upload-icon position-absolute form-control" style="width: 100%;height:100%;top:0;left: 0;opacity: 0">
							<i class="fa fa-upload upload-icon"></i>
						</button>
						<button class="btn">
							<input type="text" class="form-control upload-lable" placeholder="mobile" value="'; ?><?php echo $bottom_right_lable;?><?php echo '">
						</button>
						<button class="btn btn-dark set-btn" disabled="disabled" img-dir="bottom-right">
							SET
						</button>	
					</div>
					<img src=';?><?php echo $bottom_right_image; ?> <?php echo ' attr="small_sample" class="w-100 mb-3">
					</div>
				</div>
			</div>'; ?>