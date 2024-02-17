<?php

session_start();
error_reporting(0);
$username=$_SESSION["username"];

if($username!="")
{
?>

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
           <h3>Sales Report</h3>
        </div>
    </div>
					<div class="content">
						<div class="page-header">
							<div class="page-title">
								<h4>Sales Report</h4>
								<h6>Manage Your Stock Report</h6>
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
								<form method="post" action="#">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="start_date">Start Date</label>
                            <input type="date" class="form-control" name="start_date" required>
                        </div>
                        <div class="col-md-4">
                            <label for="end_date">End Date</label>
                            <input type="date" class="form-control" name="end_date" required>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" name="submit" class="btn btn-primary mt-4">Generate Report</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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
																	<?php
																	$user=$_SESSION["name"];

											if (isset($_POST['submit'])) {
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];

            // Retrieve data from the bill table within the date range
          $query = "SELECT
    p.product_name,
    p.category,
    p.brand,
    bp.billdate,
    bp.bill_number,
    bp.username,
    SUM(bp.quantity) AS total_sold_quantity,
    SUM(bp.total_price) AS total_sale_amount,
    p.quantity AS original_quantity,
    p.quantity AS remaining_quantity
FROM
    bill b
INNER JOIN
    bill_product bp ON b.bill_number = bp.bill_number
INNER JOIN
    products p ON bp.product_code = p.product_code
WHERE
    b.bill_date BETWEEN '$start_date' AND '$end_date'
    AND bp.username = '$user'  /* Add this filter for the logged-in user */
GROUP BY
    p.product_name, p.category, p.brand, p.quantity
ORDER BY
    total_sale_amount DESC";
            $result = mysqli_query($con, $query);
            ?>
								<div class="table-responsive">
									<table class="table">
										<thead>
											<h4>Sales Report : &nbsp;&nbsp;<span><?php echo $start_date ?> to <?php echo  $end_date?></span></h4>
											<tr>
												<th>
													<label class="checkboxs">
														<input type="checkbox" id="select-all">
														<span class="checkmarks"></span>
													</label>
												</th>
		<th>Bill Number</th>
		<th>Product Name</th>
        <th>Category</th>
        <th>Brand</th>
         <th>Username</th>
          <th>Bill Date</th>
        <th>Total Sold Quantity</th>
        <th>Total Sale Amount</th>
        <th>Available Quantity</th>
											</tr>
										</thead>
										<tbody>
		<?php

            if ($result) {
            	while ($row = mysqli_fetch_assoc($result)) {
    // $remaining_quantity = $row['available_quantity'] ;
    // if ($remaining_quantity < 0) {
    //     $remaining_quantity = 0; // Make sure remaining quantity is not negative
    // } ?>
											<tr>
												<td>
													<label class="checkboxs">
														<input type="checkbox">
														<span class="checkmarks"></span>
													</label>
												</td>
												<!-- <td class="productimgname">
												
												</td> -->
												<td><?php echo $row['bill_number'];?>
												<td><?php echo $row['product_name'];?></td>
												<td><?php echo $row['category'];?></td>
												
												<td><?php echo $row['brand'];?></td>
												<td><?php echo $row['username']; ?></td>
												<td><?php echo date('d-m-Y', strtotime($row['billdate'])); ?></td>
												<td><?php echo $row['total_sold_quantity'];?></td>
												<td><?php echo $row['total_sale_amount'];?></td>
												<td><?php echo $row['remaining_quantity'];?></td>
											</tr>
											<?php } }  } ?>
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