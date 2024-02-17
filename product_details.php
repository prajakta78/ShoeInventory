
<?php include('include/sidebar.php');
session_start();
$user =  $_SESSION['name']; ?>
<?php include('include/conn.php');

		$id = $_GET['id'];											 
        $sql = "SELECT * FROM products WHERE id= '$id' AND created_by = '$user'"; // Replace 'categories' with your actual table name
        $result = mysqli_query($con,$sql);

       
        


?>

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
           <h3>Product Details</h3>
        </div>
    </div>
						<div class="content">
							<div class="page-header">
								<div class="page-title">
									<!-- <h4>Product Details</h4>
									<h6>Full details of a product</h6> -->
									<a href="productlist.php" class="btn btn-danger">Back</a>
								</div>

							</div>
							<?php
											 while($row = mysqli_fetch_array($result)){?>
							<div class="row">


								<div class="col-lg-8 col-sm-12">

									<div class="card">
										<div class="card-body">
											
											
											<div class="productdetails">
												<ul class="product-bar">
													<li>
														<h4>Product Name</h4>
														<h6><?php echo $row['product_name'];?></h6>
													</li>
													<li>
														<h4>Category Name</h4>
														<h6><?php echo $row['category'];?></h6>
													</li>
													
													<li>
														<h4>Brand Name</h4>
														<h6><?php echo $row['brand'];?></h6>
													</li>
													
													<li>
														<h4>Product Code</h4>
														<h6><?php echo $row['product_code'];?></h6>
													</li>
													
													<li>
														<h4>Quantity</h4>
														<h6><?php echo $row['quantity'];?></h6>
													</li>
													<!-- <li>
														<h4>Tax</h4>
														<h6>0.00 %</h6>
													</li> -->
													<li>
														<h4>Supplier Name</h4>
														<h6><?php echo $row['supplier_name'];?></h6>
													</li>
													<li>
														<h4>Price</h4>
														<h6><?php echo $row['price'];?></h6>
													</li>
													<li>
														<h4>Status</h4>
														<h6><?php echo $row['status'];?></h6>
													</li>
													<li>
														<h4>Description</h4>
														<h6><?php echo $row['description'];?></h6>
													</li>
												</ul>
											</div>
										
										</div>
									</div>
								</div>
								<div class="col-lg-4 col-sm-12">
									<div class="card">
										<div class="card-body">
											<div class="slider-product-details">
												<!-- <div class="owl-carousel owl-theme product-slide"> -->
													<!-- <div class="slider-product"> -->
												<img src="productimg/<?php echo $row['product_image'];?>" alt="img">
													<!-- 	<h4><?php echo $row['product_image'];?></h4> -->
														<!-- <h6>581kb</h6> -->
													</div>
													<!-- <div class="slider-product">
														<img src="assets/img/product/product69.jpg" alt="img">
														<h4>macbookpro.jpg</h4>
														<h6>581kb</h6>
													</div> -->
												</div>
											</div>
										</div>
									</div>
								<?php } ?>
								</div>

							</div>
						</div>
					</div>
				</div>
				<script src="assets/js/jquery-3.6.0.min.js"></script>
				<script src="assets/js/feather.min.js"></script>
				<script src="assets/js/jquery.slimscroll.min.js"></script>
				<script src="assets/js/bootstrap.bundle.min.js"></script>
				<script src="assets/plugins/owlcarousel/owl.carousel.min.js"></script>
				<script src="assets/plugins/select2/js/select2.min.js"></script>
				<script src="assets/js/script.js"></script>
			</body>
		</html>