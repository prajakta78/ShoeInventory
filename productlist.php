
<?php include('include/sidebar.php');?>

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
           <h3>Product List</h3>
        </div>
    </div>
						<div class="content">
							<div class="page-header">
								<div class="page-title">
									<!-- <h4>Product List</h4>
									<h6>Manage your products</h6> -->
								</div>
								<div class="page-btn">
									<a href="addproduct.php" class="btn btn-added"><img src="assets/img/icons/plus.svg" alt="img" class="me-1">Add New Product</a>
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
									<!-- 	<div class="wordset">
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
										</div> -->
									</div>
								<!-- 	<div class="card mb-0" id="filter_inputs">
										<div class="card-body pb-0">
											<div class="row">
												<div class="col-lg-12 col-sm-12">
													<div class="row">
														<div class="col-lg col-sm-6 col-12">
															<div class="form-group">
																<select class="select">
																	<option>Choose Product</option>
																	<option>Macbook pro</option>
																	<option>Orange</option>
																</select>
															</div>
														</div>
														<div class="col-lg col-sm-6 col-12">
															<div class="form-group">
																<select class="select">
																	<option>Choose Category</option>
																	<option>Computers</option>
																	<option>Fruits</option>
																</select>
															</div>
														</div>
														<div class="col-lg col-sm-6 col-12">
															<div class="form-group">
																<select class="select">
																	<option>Choose Sub Category</option>
																	<option>Computer</option>
																</select>
															</div>
														</div>
														<div class="col-lg col-sm-6 col-12">
															<div class="form-group">
																<select class="select">
																	<option>Brand</option>
																	<option>N/D</option>
																</select>
															</div>
														</div>
														<div class="col-lg col-sm-6 col-12 ">
															<div class="form-group">
																<select class="select">
																	<option>Price</option>
																	<option>150.00</option>
																</select>
															</div>
														</div>
														<div class="col-lg-1 col-sm-6 col-12">
															<div class="form-group">
																<a class="btn btn-filters ms-auto"><img src="assets/img/icons/search-whites.svg" alt="img"></a>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div> -->
									<div class="table-responsive">
										<table class="table datanew">
											<thead>
												<tr>
													<!-- <th>
														<label class="checkboxs">
															<input type="checkbox" id="select-all">
															<span class="checkmarks"></span>
														</label>
													</th> -->
													<th>Product Image</th>
													<th>Product Name</th>
													<th>Category Name </th>
													<th>Brand Name</th>
													<th>Supplier Name</th>
													<th>Product Code</th>
													<th>Qty</th>
													<th>Created by</th>
													<th>Description</th>
													<th>Price</th>
													<!-- <th>Unit</th> -->
													
													
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
													 <?php
													 error_reporting(0);
													 session_start();
													 $user = $_SESSION['name'];
													 include('include/conn.php');
        $sql = "SELECT * FROM products WHERE created_by = '$user'"; // Replace 'categories' with your actual table name
        $result = mysqli_query($con,$sql);

       
            while ($row = mysqli_fetch_array($result)) { ?>

												<tr>
													<!-- <td>
														<label class="checkboxs">
															<input type="checkbox">
															<span class="checkmarks"></span>
														</label>
													</td> -->
													<td class="productimgname">
														
												<img src="productimg/<?php echo $row['product_image'];?>" width="70" height="70" alt="product">
														
														<!-- <a href="javascript:void(0);">Macbook pro</a> -->
													</td>
													<td><?php echo $row['product_name']?></td>
													<td><?php echo $row['category']?></td>
													<td><?php echo $row['brand']?></td>
													<td><?php echo $row['supplier_name']?></td>

													<td><?php echo $row['product_code']?></td>
													<td><?php echo $row['quantity']?></td>
													<td><?php echo $row['created_by']?></td>
													<td><?php echo substr($row['description'],0,20);?></td>
													<td><?php echo $row['price']?></td>
													<td>
														<a href="product_details.php?id=<?php echo $row['id'];?>">
															<img src="assets/img/icons/eye.svg" alt="img">
														</a>
														<a  href="editproduct.php?id=<?php echo $row['id'];?>">
															<img src="assets/img/icons/edit.svg" alt="img">
														</a>
														<a  href="deleteproduct.php?id=<?php echo $row['id'];?>"  onclick="return confirm('Are you sure?')">
															<img src="assets/img/icons/delete.svg" alt="img">
														</a>
													</td>
												</tr>
												<?php } ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<script type="text/javascript">
    // Function to change the Navbar Heading
    function changeNavbarHeading(newHeading) {
        document.getElementById("navbarHeading").textContent = newHeading;
    }

    // Function to handle Sidebar Toggle
    document.getElementById("sidebarCollapse").addEventListener("click", function () {
        // Toggle Sidebar Logic
    });
    </script>
				<script src="assets/js/jquery-3.6.0.min.js"></script>
				<script src="assets/js/feather.min.js"></script>
				<script src="assets/js/jquery.slimscroll.min.js"></script>
				<script src="assets/js/jquery.dataTables.min.js"></script>
				<script src="assets/js/dataTables.bootstrap4.min.js"></script>
				<script src="assets/js/bootstrap.bundle.min.js"></script>
				<script src="assets/plugins/select2/js/select2.min.js"></script>
				<script src="assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
				<script src="assets/plugins/sweetalert/sweetalerts.min.js"></script>
				<script src="assets/js/script.js"></script>
			</body>
		</html>