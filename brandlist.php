<?php

session_start();
error_reporting(0);
$username=$_SESSION["username"];

if($username!="")
{
?>
<?php include('include/sidebar.php');?>
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
           <h3>Brand List</h3>
        </div>
    </div>
					<div class="content">
						<div class="page-header">
							<div class="page-title">
								<!-- <h4>Brand List</h4>
								<h6>Manage your Brand</h6> -->
							</div>
							<div class="page-btn">
								<a href="addbrand.html" class="btn btn-added"><img src="assets/img/icons/plus.svg" class="me-2" alt="img">Add Brand</a>
							</div>
						</div>
						<div class="card">
							<div class="card-body">
								<!-- <div class="table-top">
									<div class="search-set">
										<div class="search-path">
											<a class="btn btn-filter" id="filter_search">
												<img src="assets/img/icons/filter.svg" alt="img">
												<span><img src="assets/img/icons/closes.svg" alt="img"></span>
											</a>
										</div>
										<div class="search-input">
											<a class="btn btn-searchset"><img src="assets/img/icons/search-white.svg" alt="img"></a>
										</div>
									</div>
									<div class="wordset">
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
									</div>
								</div> -->
								<!-- <div class="card" id="filter_inputs">
									<div class="card-body pb-0">
										<div class="row">
											<div class="col-lg-3 col-sm-6 col-12">
												<div class="form-group">
													<input type="text" placeholder="Enter Brand Name">
												</div>
											</div>
											<div class="col-lg-3 col-sm-6 col-12">
												<div class="form-group">
													<input type="text" placeholder="Enter Brand Description">
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
												<th>Image</th>
												<th>Brand Name</th>
												<th>Brand Description</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
												 <?php
												 include('include/conn.php');
        $sql = "SELECT * FROM brands"; // Replace 'categories' with your actual table name
        $result = mysqli_query($con,$sql);

       
            while ($row = mysqli_fetch_assoc($result)) { ?>
											<tr>
												<!-- <td>
													<label class="checkboxs">
														<input type="checkbox">
														<span class="checkmarks"></span>
													</label>
												</td> -->
												<td>
													<a class="product-img">
														<img src="images/<?php echo $row['brand_img'];?>" alt="product">
													</a>
												</td>
												<td><?php echo $row['brand_name'];?></td>
												<td><?php echo substr($row['description'],0,20);?></td>
												<td>
													<a class="me-3" href="editbrand.php?id=<?php echo $row['id'];?>">
														<img src="assets/img/icons/edit.svg" alt="img">
													</a>
													<a class="me-3" href="deletebrand.php?id=<?php echo $row['id'];?>"  onclick="return confirm('Are you sure?')">
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
	<?php } 

   else
    {
        echo '<script type ="text/JavaScript">';
echo 'alert(" You need log in first!!! ");window.location.href = "index.php"';
echo '</script>';
    }?>