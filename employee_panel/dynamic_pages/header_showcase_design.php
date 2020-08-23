<?php
require_once("../../common_files/php/database.php");
echo '<div class="row">
				<div class="col-md-4 rounded-lg bg-white shadow-sm p-4">
					<form class="showcase-form">
						<div class="form-group">
							<label for="title-image">Title image</label>     <small>size 1920*978</small>
							<input type="file" accept="image/*" name="title-image" id="title-image" class="form-control">
						</div>
						<div class="form-group">
							<label for="title-text">Title text <small class="title-limit">0</small><small>/40</small></label>
							<textarea type="file" rows="1" name="title-limit" id="title-text" class="form-control" maxlength="40" required="required"></textarea>
						</div>
						<div class="form-group">
							<label for="subtitle-text">Subtitle text <small class="subtitle-limit">0</small><small>/100</small></label>
							<textarea type="file" rows="5" name="subtitle-text" id="subtitle-text" class="form-control" maxlength="100" required="required"></textarea>
						</div>
						
						<div class="form-group">
							<label for="create-button">Create buttons</label>
							<i class="fa fa-trash close delete-btn d-none"></i>
							<div id="create-button" class="input-group mb-2">
								<input type="url" name="btn-url" class="form-control btn-url" placeholder="https://google.com">
								<input type="text" name="btn-name" class="form-control btn-name" placeholder="Button 1">
							</div>
							<div class="input-group mb-2">
								<div class="input-group-prepend">
									<span class="input-group-text">BG COLOR</span>
								</div>
								<input type="color" name="btn-bgcolor" class="form-control btn-bgcolor">
								<div class="input-group-prepend">
									<span class="input-group-text">TEXT COLOR</span>
								</div>
								<input type="color" name="btn-textcolor" class="form-control btn-textcolor">
							</div>
							<div class="input-group mb-2">
								<div class="input-group-prepend">
									<span class="input-group-text">SIZE</span>
								</div>
								<select class="form-control btn-size">
									<option value="16px">small</option>
									<option value="20px">medium</option>
									<option value="24px">large</option>
								</select>
								<div class="input-group-append">
									<span class="input-group-text bg-danger text-light add-btn" style="cursor: pointer">Add</span>
								</div>
							</div>
							<div class="form-group">
							<button class="btn btn-primary add-showcase-btn py-2" type="submit" required="required">Add showcase</button>
							<button class="btn btn-primary py-2 real-preview-btn" type="button" required="required">Real preview</button>
						</div>
						<div class="form-group">
							<label for="edit-title">Edit title</label>
							<i class="fa fa-trash delete-title close d-none"></i>
							<select id="edit-title" class="form-control">
								<option>Choose title</option>'; ?>
								<?php
								$get_data = "SELECT * FROM header_showcase";
								$response = $db->query($get_data);
								if($response)
								{
									$count = 0;
									while($data =$response->fetch_assoc())
									{
										$count +=1;
										echo "<option value='".$data['id']."'>".$count."</option>";
									}
								}
								?>
							<?php

							echo '</select>
						</div>
						
						</div>
					</form>
				</div>
				<div class="col-md-1"></div>
				<div class="col-md-7 rounded-lg bg-white shadow-sm p-4 position-relative showcase-preview d-flex" style="height: 340px">
					<div class="title-box">
					<h1 class="showcase-title target">TITLE</h1>
					<h4 class="showcase-subtitle target">SUBTITLE</h4>
					<div class="title-buttons my-3">
						
					</div>
					</div>
					<div class="showcase-formating d-flex justify-content-around align-items-center">
						<div class="btn-group">
						<button class="btn btn-light">Color</button>
						<button class="btn btn-light">
						<input type="color" name="color-selector" class="color-selector">
						</button>
						</div>
						<div class="btn-group mx-2">
						<button class="btn btn-light">Font size</button>
						<button class="btn btn-light">
						<input type="range" min="100" max="500" name="font-size" class="font-size form-control">
						</button>
						</div>
						<button  class="btn btn-light dropdown-toggle" data-toggle="dropdown">
							<span>Alignment</span>
						<div class="dropdown-menu">
							<span class="dropdown-item alignment" align-position="h" align-value="flex-start">LEFT</span>
							<span class="dropdown-item alignment" align-position="h" align-value="center">CENTER</span>
							<span class="dropdown-item alignment" align-position="h" align-value="flex-end">RIGHT</span>
							<span class="dropdown-item alignment" align-position="v" align-value="flex-start">TOP</span>
							<span class="dropdown-item alignment" align-position="v" align-value="center">V-CENTER</span>
							<span class="dropdown-item alignment" align-position="v" align-value="flex-end">BOTTOM</span>
						</div>
						</button>
					</div>
				</div>
			</div>';

?>