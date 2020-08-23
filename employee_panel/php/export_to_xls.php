

<?php
header("Content-type: application/vnd.ms-excel; name='excel'");
header("Content-Disposition: attachment; filename=exportfile.xls");

require_once("../../common_files/php/database.php");


echo '<table class="w-100 purchase-table text-center table table-bordered bg-white">
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
						</tr>';

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
								</tr>";
							}
						}
						echo "</table>";
?>