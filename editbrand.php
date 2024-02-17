<?php include('include/sidebar.php');?>
<?php include('include/conn.php');
$id = $_GET['id'];
// echo $id;
	 
        $sql = "SELECT * FROM `brands` WHERE `id` = '$id'"; // Replace 'categories' with your actual table name
        $result = mysqli_query($con,$sql);

       
            $row = mysqli_fetch_assoc($result); ?>

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
           <h3>Edit Brand</h3>
        </div>
    </div>
						<div class="content">
							<div class="page-header">
								<div class="page-title">
									<!-- <h4>Brand Edit</h4>
									<h6>Update your Brand</h6> -->
								</div>
							</div>
							<div class="card">
								<div class="card-body">
									<form action="updatebrand.php" method="POST" enctype="multipart/form-data">
									<div class="row">
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="form-group">
												<label>Brand Name</label>
												<input type="hidden" name="id" value="<?php echo $id;?>">
												<input type="text" name="brand_name" value="<?php echo $row['brand_name'];?>">
											</div>
										</div>
										<div class="col-lg-12">
											<div class="form-group">
												<label>Description</label>
												<textarea name="description" class="form-control"><?php echo $row['description'];?></textarea>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="form-group">
												<label> Product Image</label>
												<div class="image-upload">
													<input type="hidden" name="oldfile" value="<?php echo $row['brand_img'];?>">
													<input type="file" name="brand_img">
													<div class="image-uploads">
														<img src="assets/img/icons/upload.svg" alt="img">
														<h4>Drag and drop a file to upload</h4>
													</div>
												</div>
											</div>
										</div>
										<div class="col-12">
											<div class="product-list">
												<ul class="row">
													<li>
														<div class="productviews">
															<div class="productviewsimg">
																<img src="images/<?php echo $row['brand_img'];?>" alt="img">
															</div>
															<div class="productviewscontent">
																<div class="productviewsname">
																	<h2><?php echo $row['brand_img'];?></h2>
																	<!-- <h3>581kb</h3> -->
																</div>
																<!-- <a href="javascript:void(0);">x</a> -->
															</div>
														</div>
													</li>
												</ul>
											</div>
										</div>
										<div class="col-lg-12">
											<input type="submit" value="Update" class="btn btn-primary me-2" name="update_b">
											<a href="brandlist.php" class="btn btn-danger">Cancel</a>
										</div>
									</div>
								</form>
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
				<script src="assets/plugins/select2/js/select2.min.js"></script>
				<script src="assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
				<script src="assets/plugins/sweetalert/sweetalerts.min.js"></script>
				<script src="assets/js/script.js"></script>
			</body>
		</html>
		