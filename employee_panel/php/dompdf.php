<?php
// include autoloader
require_once '../../dompdf/autoload.inc.php';
// reference the Dompdf namespace
use Dompdf\Dompdf;
require_once("../../common_files/php/database.php");
$design = "<html>
			<body>
			<table border='1' width='100%' style='text-align:center;border-collapse:collapse;'>
			<caption style='font-size:30px;font-weight:bold;margin-bottom:15px;'>SALSE REPORT</caption>
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
							<th>DISPACHED DATE</th>
						</tr>";
						$get_data = "SELECT * FROM purchase";
						$response =$db->query($get_data);
						if($response)
						{
							while($data = $response->fetch_assoc())
							{
								$design .= "<tr>
											<td>".$data['id']."</td>
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
											<td>".$data['status']."</td>
											<td>".$data['dispached_date']."</td>		
									   </tr>";
							}
						}

				$design .= "<table></body></html>";
			

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml($design);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A3', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream();

?>