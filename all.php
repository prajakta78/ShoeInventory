<?php

session_start();
error_reporting(0);
$username=$_SESSION["username"];

if($username!="")
{
?>

<?php include('include/sidebar.php');?>

<?php include('include/conn.php');
session_start();
$username= $_SESSION['name'];


// // Query to retrieve all bills and their associated product data
// $query = "
//     SELECT b.*, bi.*, p.product_name, p.category, p.brand
//     FROM bill b
//     LEFT JOIN bill_product bi ON b.bill_number = bi.bill_number
//     LEFT JOIN products p ON bi.product_code = p.product_code
// ";

// $result = mysqli_query($con, $query);

// if ($result) {
//     $billData = array();
//     while ($row = mysqli_fetch_assoc($result)) {
//         $billId = $row['bill_number'];

//         // Initialize an array for the current bill
//         if (!isset($billData[$billId])) {
//             $billData[$billId] = array(
//                 'bill_number' => $row['bill_number'],
//                 'items' => array()
//             );
//         }

//         // Collect item data for the current bill
//         if ($row['product_code']) {
//             $item = array(
//                 'product_code' => $row['product_code'],
//                 'product_name' => $row['product_name'],
//                 'category' => $row['category'],
//                 'brand' => $row['brand'],
//                 'quantity' => $row['quantity'],
//                 'per_piece_price' => $row['per_piece_price'],
//                 'total_price' => $row['total_price']
//             );
//             $billData[$billId]['items'][] = $item;
//         }
//     }

   
// } else {
//     echo "Error: " . mysqli_error($con);
// }

// Query to retrieve all bills and their associated product data

 $query = "
    SELECT b.*, bi.*, p.product_name, p.category, p.brand
           , b.customer_name, b.bill_date
    FROM bill b
    LEFT JOIN bill_product bi ON b.bill_number = bi.bill_number
    LEFT JOIN products p ON bi.product_code = p.product_code
    WHERE b.username = '$username'  ORDER BY b.bill_date DESC";

$result = mysqli_query($con, $query);

if ($result) {
    $billData = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $billId = $row['bill_number'];

        // Initialize an array for the current bill
        if (!isset($billData[$billId])) {
            $billData[$billId] = array(
                 'id' => $row['id'],
                 'username' => $row['username'],
                'bill_number' => $row['bill_number'],
                'customer_name' => $row['customer_name'],
                 'bill_date' => $row['bill_date'],
                 'total_amount' => $row['total_amount'],
                 'customer_mno' => $row['customer_mno'],
                'items' => array()
            );
        }

        // Collect item data for the current bill
        if ($row['product_code']) {
            $item = array(
                'product_code' => $row['product_code'],
                'product_name' => $row['product_name'],
                'category' => $row['category'],
                'brand' => $row['brand'],
                'quantity' => $row['quantity'],
                'per_piece_price' => $row['per_piece_price'],
                'total_price' => $row['total_price']
            );
            $billData[$billId]['items'][] = $item;
        }
    }
}
?>
			<style>

					.navbar {
            background-color: #fff;
            color: black;
            padding: 10px;
            /*width: 1200px;*/
            margin-left: 20px;
              margin-right: 20px;
            margin-top: 10px;
            justify-content: center;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
        }

        .navbar a {
            color: black;
            text-decoration: none;

        }

       
    </style>				





				<div class="page-wrapper">
					<div class="navbar">
        <div class="navbar-header">
           <h3>All Invoices</h3>
        </div>
    </div>
					<div class="content">
						<div class="page-header">
							<div class="page-title">
								<h4>All Bill's</h4>
								<h6>Your Sales Invoices</h6>
							</div>
						</div>

					
								<div class="table-responsive">
									<table class="table">
										<thead>

											<tr>
												<!-- <th>
													<label class="checkboxs">
														<input type="checkbox" id="select-all">
														<span class="checkmarks"></span>
													</label>
												</th> -->
												<th>Bill Id</th>
												<th>Bill Number</th>
                                                 <th>Bill Date</th>
                                               <th>Username</th>
                                                <th>Customer Name</th>
                                                 <th>Customer Mobile no.</th>
                                                
                                                
                                                 <th>Total</th>
                                                 <th>Action</th>

												<!-- <th>SKU</th> -->
												
											</tr>
											
          
										</thead>
										<tbody>
											<?php 
											include('include/conn.php');
											 foreach ($billData as $billId => $billInfo) {?>
 	<tr>
         <td><?php echo $billInfo['id'];?></td>
        <td rowspan= <?php (count($billInfo['items']) + 1) ?>><?php echo $billInfo['bill_number'] ?></td>
           <td><?php echo date('d-m-Y', strtotime($billInfo['bill_date'])); ?></td>
             <td><?php echo $billInfo['username'];?></td>
        <td><?php echo $billInfo['customer_name'];?></td>
         <td><?php echo $billInfo['customer_mno'];?></td>
     
         <td><?php echo $billInfo['total_amount'];?></td>
    
         <td><a href="editbill.php?bill_id=<?php echo $billId;?>">Edit</a></td>
    
        </tr>
         <?php
        } ?>
										

           
											
										
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<script src="assets/js/jquery-3.6.0.min.js"></script>
			<script src="assets/js/feather.min.js"></script>
			<script src="assets/js/jquery.slimscroll.min.js"></script>
			<script src="assets/js/jquery.dataTables.min.js"></script>
			<script src="assets/js/dataTables.bootstrap4.min.js"></script>
			<script src="assets/js/bootstrap.bundle.min.js"></script>
			<script src="assets/js/moment.min.js"></script>
			<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
			<script src="assets/plugins/select2/js/select2.min.js"></script>
			<script src="assets/js/moment.min.js"></script>
			<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
			<script src="assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
			<script src="assets/plugins/sweetalert/sweetalerts.min.js"></script>
			<script src="assets/js/script.js"></script>
		</body>
	</html>
     <?php } 

   else
    {
        echo '<script type ="text/JavaScript">';
echo 'alert(" You need log in first!!! ");window.location.href = "index.php"';
echo '</script>';
    }?>