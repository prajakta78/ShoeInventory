<?php 
include('include/sidebar.php');?>
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
           <h3>Less Stock Report</h3>
        </div>
    </div>
					<div class="content">
						<div class="page-header">
							<div class="page-title">
								<h4>Less Stock Report</h4>
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
									<div class="wordset">
										<ul>
											<li>
												<a id="pdf-button" data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img src="assets/img/icons/pdf.svg" alt="img"></a>
											</li>
											<li>
												<a id="excel-button" data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img src="assets/img/icons/excel.svg" alt="img"></a>
											</li>
											<li>
												<a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img src="assets/img/icons/printer.svg" alt="img"></a>
											</li>
										</ul>
									</div>
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
												<!-- <th>
													<label class="checkboxs">
														<input type="checkbox" id="select-all">
														<span class="checkmarks"></span>
													</label>
												</th> -->
											
												<th>Product Code</th>
												<th>Product Name</th>
												<th> Category</th>
												<th>Brand</th>
												<th>Username</th>
												<th> Quantity</th>
												<!-- <th>Instock qty</th> -->
												<th>Price</th>
												
												<!-- <th>Date </th> -->
											</tr>
										</thead>
										<tbody>
											<?php include('include/conn.php');
											$user = $_SESSION['name'];
$lowStockQuery = "SELECT * FROM products WHERE quantity < 10 AND created_by = '$user'";
$lowStockResult = mysqli_query($con, $lowStockQuery);
if ($lowStockResult) {
  while ($row = mysqli_fetch_assoc($lowStockResult)) {
?>
											<tr>
												<!-- <td>
													<label class="checkboxs">
														<input type="checkbox">
														<span class="checkmarks"></span>
													</label>
												</td> -->
												<!-- <td class="productimgname">
												
												</td> -->
												
												<td><?php echo $row['product_code'];?></td>
												<td><?php echo $row['product_name'];?></td>
												
												<td><?php echo $row['category'];?></td>
												<td><?php echo $row['brand'];?></td>
												<td><?php echo $row['created_by'];?></td>
												<td><?php echo $row['quantity'];?></td>
												<!--  <td><?php echo $remaining_quantity; ?></td> -->
												<td><?php echo $row['price'];?></td>
												<!-- <td><?php echo $row['bill_date'];?></td> -->
											</tr>
											<?php  } } else {
    echo "no less stock";
}  ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<script>
			document.getElementById('pdf-button').addEventListener('click', function (event) {
    event.preventDefault(); // Prevent the default behavior (e.g., following a link)
    
    // Replace with the URL to your PHP script that generates the PDF
    var pdfUrl = 'genearate_pdf.php';
    window.open(pdfUrl, '_blank'); // Open the PDF in a new tab/window
});
</script>
<script>
	// Add this to your existing JavaScript code
document.getElementById('excel-button').addEventListener('click', function (event) {
    event.preventDefault(); // Prevent the default behavior (e.g., following a link)
    
    // Replace with the URL to your PHP script that generates the Excel file
    var excelUrl = 'generate_excel.php';
    window.open(excelUrl, '_blank'); // Open the Excel file in a new tab/window
});

</script>
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