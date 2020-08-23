<?php

echo '<div class="row">
				<div class="col-md-4 bg-white rounded-lg shadow-sm">
					<h5 class="my-3">Create category
						<i class="fa fa-circle-o-notch d-none create-category-loader fa-spin close" style="font-size: 18px"></i>
					</h5>
					<form class="create-category-form">
					<input type="text" name="" class="input form-control mb-3" placeholder="Mobile" style="border: none;background: #f9f9f9">
					<div class="add-field-area"></div>
					<button class="btn add-field-btn btn-primary mb-3" type="button" >
						<i class="fa fa-plus"></i>
						Add field
					</button>
					<button class="create-btn btn btn-danger mb-3" type="submit">
						Create
					</button>
					<div class="create-category-notice my-3"></div>	
					</form>
				</div>
				<div class="col-md-2"></div>
				<div class="col-md-6 bg-white rounded-lg shadow-sm">
					<h5 class="my-3">CATEGERY LIST</h5>
					<hr>
					<div class="category-area overflow-auto" style="height:300px;"></div>
				</div>
			</div>';


?>