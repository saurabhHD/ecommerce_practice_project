<?php 
require_once("../../common_files/php/database.php");
echo '<div class="row animated slideInDown upload-data">
  <div class="col-md-12 bg-white rounded-lg py-2 shadow-sm">
    <h5>CREATE PRODUCTS</h5>
    <form class="create-products-form">
      <div class="row">
        <div class="col-md-6 mb-3">
          <input type="text" placeholder="ENTER PRODUCT TITLE" name="product-title" class="form-control">
        </div>
        <div class="col-md-6 mb-3">
          <select class="form-control brands-name w-50 float-right" name="brands">
            <option>Choose brand</option>';

            $get_brands = "SELECT * FROM brands";
            $response = $db->query($get_brands);
            if($response){
              while ($data = $response->fetch_assoc()) 
              {
                echo "<option c-name='".$data['category_name']."'>".$data['brands']."</option>";
              }
            }

          echo '</select>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 mb-3">
          <h6>DESCRIPTION</h6>
          <textarea class="form-control mb-3" name="description" rows="20"></textarea>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 mb-3">
          <h6>PRICE</h6>
          <input type="text" name="price" placeholder="2000" class="form-control">
        </div>
        <div class="col-md-6 mb-3">
          <h6>QUANTITY</h6>
          <input type="text" name="quantity" placeholder="20" class="form-control">
        </div>
      </div>
      <div class="row mb-3">
        <div class="col-md-2 mb-3">
            <div class="w-75  text-light text-center bg-dark overflow-hidden">
            <input type="file" name="thumb" class="form-control rounded-0">
            <p><b>THUMB</b></p>
            <p>250*316</p>
            </div>
          </div>
        <div class="col-md-2 mb-3">
          <div class="w-75 text-light text-center bg-dark overflow-hidden">
          <input type="file" name="front" class="form-control rounded-0">
          <p><b>FRONT</b></p>
          <p>350*615</p>
          </div>
        </div>
        <div class="col-md-2 mb-3">
          <div class="w-75 text-light text-center bg-dark overflow-hidden">
          <input type="file" name="back" class="form-control rounded-0">
          <p><b>BACK</b></p>
          <p>350*615</p>
          </div>
        </div>
       
        <div class="col-md-2 mb-3">
          <div class="w-75 text-light text-center bg-dark overflow-hidden">
          <input type="file" name="left" class="form-control rounded-0">
          <p><b>LEFT</b></p>
          <p>350*615</p>
          </div>
        </div>
        <div class="col-md-2 mb-3">
          <div class="w-75 text-light text-center bg-dark overflow-hidden">
          <input type="file" name="right" class="form-control rounded-0">
          <p><b>RIGHT</b></p>
          <p>350*615</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-9 mb-3">
          <div class="progress create-products-progress d-none mt-3">
            <div class="progress-bar bg-primary"></div>
          </div>
        </div>
        <div class="col-md-3 mb-3 px-3">
          <button type="submit" class="btn btn-danger text-center text-light w-75 float-right">SUBMIT</button>
        </div>
      </div>
    </form> 
  </div>
</div>

';
?>