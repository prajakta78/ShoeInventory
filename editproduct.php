<?php include('include/sidebar.php');
session_start();
$user =  $_SESSION['name']; ?>
<?php include('include/conn.php');

		$id = $_GET['id'];											 
        $sql = "SELECT * FROM products WHERE id= '$id' AND created_by = '$user'"; // Replace 'categories' with your actual table name
        $result = mysqli_query($con,$sql);

       
          $row = mysqli_fetch_array($result);


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
           <h3>Edit Product</h3>
        </div>
    </div>
						<div class="content">
							<div class="page-header">
								<div class="page-title">
									<h4>Product Add</h4>
									<h6>Create new product</h6>
								</div>
							</div>
							<div class="card">
								<div class="card-body">
									<form action="updateproduct.php" method="POST" enctype="multipart/form-data">
									<div class="row">

										<div class="col-lg-3 col-sm-6 col-12">

										
											<div class="form-group">
												<label>Product Name</label>
												<input type="hidden" name="product_id" value="<?php echo $row['id'];?>" >

												<input type="text" name="p_name" value="<?php echo $row['product_name'];?>" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '').replace(/(\..*)\./g, '$1');"  pattern="([^\s][A-z0-9À-ž\s]+)" title="Enter Alphabets Only" required>
											</div>
										</div>
										<div class="col-lg-4 col-sm-6 col-12">
											<div class="form-group">
												<label>Category</label>
												<select name="category" class="select" required>
													<option value="">Choose Category</option>
													
                                                 
                            <?php
                            include('include/db.php');
                            $query = "SELECT * FROM `category`";
                            $result = $con->query($query);
                            if ($result->num_rows > 0) {
                            while ($row1 = $result->fetch_assoc()) {
                            $option = '<option value="'.$row1['category_name'].'"';
                              $option .= ($row['category'] == $row1['category_name']) ? 'selected' : '';
                            $option .= '>'.$row1['category_name'].'</option>';
                            echo $option;
                            }
                            }else{
                            echo '<option value="">Category Not available</option>';
                            }
                            ?>
													<!-- <option value="sports">Sports</option>
													<option value="walking">Walking</option>
													<option value="exercise">exercise</option> -->
												</select>
											</div>
										</div>
									
										<div class="col-lg-4 col-sm-6 col-12">
											<div class="form-group">
												<label>Brand</label>
												<select   name="brand" class="select" required>
													<option value="">Choose Brand</option>
													 <?php
                            include('include/db.php');
                            $query = "SELECT * FROM `brands`";
                            $result = $con->query($query);
                            if ($result->num_rows > 0) {
                            while ($row1 = $result->fetch_assoc()) {
                            $option = '<option value="'.$row1['brand_name'].'"';
                              $option .= ($row['brand'] == $row1['brand_name']) ? 'selected' : '';
                            $option .= '>'.$row1['brand_name'].'</option>';
                            echo $option;
                            }
                            }else{
                            echo '<option value="">Brand Not available</option>';
                            }
                            ?>
								
												</select>
											</div>
										</div>

										<div class="col-lg-4 col-sm-6 col-12">
											<div class="form-group">
												<label>Supplier</label>
												<select   name="supplier" class="select" required>
													<option value="">Choose Supplier</option>
													 <?php
                            include('include/db.php');
                            $query = "SELECT * FROM `suppliers`";
                            $result = $con->query($query);
                            if ($result->num_rows > 0) {
                            while ($row2 = $result->fetch_assoc()) {
                            $option = '<option value="'.$row2['supplier_name'].'"';
                              $option .= ($row['supplier_name'] == $row2['supplier_name']) ? 'selected' : '';
                            $option .= '>'.$row2['supplier_name'].'</option>';
                            echo $option;
                            }
                            }else{
                            echo '<option value="">Brand Not available</option>';
                            }
                            ?>
								
												</select>
											</div>
										</div>
										
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="form-group">
												<label>Product Code</label>
												<input type="text" name="p_code"  value="<?php echo $row['product_code'];?>" readonly>
											</div>
										</div>
									
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="form-group">
												<label>Quantity</label>
												<input type="text" name="quantity"  value="<?php echo $row['quantity'];?>" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="form-group">
												<label>Description</label>
												<textarea class="form-control" name="description" required><?php echo $row['description'];?></textarea>
											</div>
										</div>
										<!-- <div class="col-lg-3 col-sm-6 col-12">
											<div class="form-group">
												<label>Tax</label>
												<select class="select">
													<option>Choose Tax</option>
													<option>2%</option>
												</select>
											</div>
										</div> -->
									<!-- 	<div class="col-lg-3 col-sm-6 col-12">
											<div class="form-group">
												<label>Discount Type</label>
												<select class="select">
													<option>Percentage</option>
													<option>10%</option>
													<option>20%</option>
												</select>
											</div>
										</div> -->
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="form-group">
												<label>Price</label>
												<input type="text" name="price"  value="<?php echo $row['price'];?>" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="form-group">
												<label> Status</label>
												<select class="select" name="status">
													<option value="">Select Satus</option>
    <option value="closed" <?php echo $row['status'] == 'Closed' ? 'selected' : ''; ?>>Closed</option>
    <option value="open" <?php echo $row['status'] == 'open' ? 'selected' : ''; ?>>open</option>
</select>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="form-group">
												<label> Product Image</label>
												<div class="image-upload">
													<input type="text" name="old_file" value="<?php echo $row['product_image'];?>" readonly>
													<input type="file" name="product_image" >
													<div class="image-uploads">
														<img src="assets/img/icons/upload.svg" alt="img">
														<h4>Drag and drop a file to upload</h4>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-12">
											<input type="submit" name="add_product" class="btn btn-primary me-2" value="Update">
											<a href="productlist.php" class="btn btn-danger">Cancel</a>
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