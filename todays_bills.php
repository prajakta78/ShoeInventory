<?php include('include/sidebar.php');?>
<?php include('include/conn.php');?>


				<style>
					.navbar {
            background-color: #fff;
            color: black;
            padding: 10px;
            /*width: 1200px;*/
            margin-left: 20px;
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
           <h3>Todays Bill's</h3>
        </div>
    </div>
					<div class="content">
						<div class="page-header">
							<div class="page-title">
								<h4>Todays Bill's</h4>
								<h6> Your Todays Sales Report</h6>
							</div>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="table-top">
									<!-- <div class="search-set">
										<div class="search-path">
											<a class="btn btn-filter" id="filter_search">
												<img src="assets/img/icons/filter.svg" alt="img">
												<span><img src="assets/img/icons/closes.svg" alt="img"></span>
											</a>
										</div>
										<div class="search-input">
											<a class="btn btn-searchset"><img src="assets/img/icons/search-white.svg" alt="img"></a>
										</div>
									</div> -->
									<!-- <div class="wordset">
										<ul>
											<li>
												<a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img src="assets/img/icons/pdf.svg" alt="img"></a>
											</li>
											<li>
												<a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img src="assets/img/icons/excel.svg" alt="img"></a>
											</li>
											<li>
												<a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img src="assets/img/icons/printer.svg" alt="img"></a>
											</li>
										</ul>
									</div>-->
								</div> 
												<!-- <div class="card" id="filter_inputs">
									<div class="card-body pb-0">
										<div class="row">
											<div class="col-lg-2 col-sm-6 col-12">
												<div class="form-group">
													<div class="input-groupicon">
														<input type="text" placeholder="From Date" class="datetimepicker">
														<div class="addonset">
															<img src="assets/img/icons/calendars.svg" alt="img">
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-2 col-sm-6 col-12">
												<div class="form-group">
													<div class="input-groupicon">
														<input type="text" placeholder="To Date" class="datetimepicker">
														<div class="addonset">
															<img src="assets/img/icons/calendars.svg" alt="img">
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-1 col-sm-6 col-12 ms-auto">
												<div class="form-group">
													<a class="btn btn-filters ms-auto"><img src="assets/img/icons/search-whites.svg" alt="img"></a>
												</div>
											</div>
										</div>
									</div>
								</div> -->
								<div class="table-responsive">
									<table class="table">
										<thead>
											<tr>
												
												<th>Bill Id</th>
												<th>Bill Number</th>

												<th>Customer Name</th>
												<!-- <th>Product Name</th> -->
												
												<!-- <th>Sold Qantity</th> -->
											
												<th>Toatal</th>
												
												<th>Date </th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
											include('include/conn.php');
										$currentDate = date("Y-m-d");

// Query to retrieve today's bills
$query = "SELECT * FROM bill WHERE DATE(bill_date) = '$currentDate'";
$result = mysqli_query($con, $query);
 
        while ($row = mysqli_fetch_assoc($result)) {
        	$billId = $row['bill_number'];
            ?>


											
          
											<tr>
												
												<td><?php echo $row['id'];?>
												<td><?php echo $row['bill_number'];?>
												<td><?php echo $row['customer_name'];?></td>
												<!--  <td><?php echo $remaining_quantity; ?></td> -->
												<td><?php echo $row['total_amount'];?></td>
												<td><?php echo date('d-m-Y', strtotime($row['bill_date'])); ?></td>

												    <td><a href="editbill.php?bill_id=<?php echo $billId;?>">Edit</a></td>

											</tr>
											<?php   } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>



			<?php


// Function to fetch products for a specific bill number
function getProductsForBill($billNumber, $con) {
    $query = "SELECT * FROM bill WHERE bill_number = '$billNumber'";
    $result = mysqli_query($con, $query);
    $products = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }
    return $products;
}

$currentDate = date("Y-m-d");
$query = "SELECT * FROM bill WHERE DATE(bill_date) = '$currentDate'";
$result = mysqli_query($con, $query);
?>


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