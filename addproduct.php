<?php

session_start();
error_reporting(0);
$username=$_SESSION["name"];

if($username!="")
{
?>
<?php
include('include/conn.php');
include('include/sidebar.php');


if (isset($_POST['add_product'])) {
    $product_name = $_POST['p_name'];
    $category = $_POST['category'];
    $brand = $_POST['brand'];
    $supplier = $_POST['supplier'];
    $product_code = $_POST['p_code'];
    $quantity = $_POST['quantity'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $status = $_POST['status'];
    $product_image = $_FILES["product_image"]["name"];
    $file_tmp = $_FILES["product_image"]["tmp_name"];
    $folder = "productimg/" . $product_image;

    // Check if product code already exists
    $existingProductQuery = "SELECT * FROM products WHERE product_code = '$product_code'";
    $existingProductResult = mysqli_query($con, $existingProductQuery);

    if (mysqli_num_rows($existingProductResult) > 0) {
        echo "<script type='text/javascript'>
            swal('Product Code Already Exists!', 'Please choose a different product code.', 'error');
        </script>";
    } else {
        $sql = "INSERT INTO products (product_name, category, brand, supplier_name, product_code, quantity, description, price, status, created_by, product_image)
                VALUES ('$product_name', '$category', '$brand', '$supplier','$product_code', '$quantity', '$description','$price', '$status','$username','$product_image')";

        $res = mysqli_query($con, $sql);
        move_uploaded_file($file_tmp, $folder);

        if ($res) {
            echo "<script type='text/javascript'>
                swal('Product Added Successfully!', 'You clicked the button!', 'success')
                .then(okay => {
                    if (okay) {
                        window.location = 'productlist.php';
                    }
                });
            </script>";
        } else {
            header('location: productlist.php');
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
           <h3>Add Product</h3>
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
									<form action="#" method="POST" enctype="multipart/form-data">
									<div class="row">

										<div class="col-lg-3 col-sm-6 col-12">

										
											<div class="form-group">
												<label>Product Name</label>
												<input type="text" name="p_name" placeholder="Entyer Product Name" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '').replace(/(\..*)\./g, '$1');"  pattern="([^\s][A-z0-9À-ž\s]+)" title="Enter Alphabets Only" required>
											</div>
										</div>
										<div class="col-lg-4 col-sm-6 col-12">
											<div class="form-group">
												<label>Category Name</label>
												<select name="category" class="select" required>
													<option value="">Choose Category</option>
													 <?php
                                                    // include('include/db.php');
                                                    
                                                    $query = "SELECT distinct category_name from category";
                                                    $rlt = mysqli_query($con,$query);
                                                    while($row = mysqli_fetch_array($rlt)) {
                                                    echo '<option value="'.$row['category_name'].'">'.$row['category_name'].'</option>';?>
                                                    <?php } ?>
													<!-- <option value="sports">Sports</option>
													<option value="walking">Walking</option>
													<option value="exercise">exercise</option> -->
												</select>
											</div>
										</div>
									
										<div class="col-lg-4 col-sm-6 col-12">
											<div class="form-group">
												<label>Brand Name</label>
												<select   name="brand" class="select" required>
													<option value="">Choose Brand</option>
													 <?php
                                                    // include('include/db.php');
                                                    
                                                    $query1 = "SELECT distinct brand_name from brands";
                                                    $rlt1 = mysqli_query($con,$query1);
                                                    while($row1 = mysqli_fetch_array($rlt1)) {
                                                    echo '<option value="'.$row1['brand_name'].'">'.$row1['brand_name'].'</option>';?>
                                                    <?php } ?>
													<option >Brand</option>
												</select>
											</div>
										</div>
										<div class="col-lg-4 col-sm-6 col-12">
											<div class="form-group">
												<label>Supplier Name</label>
												<select name="supplier" class="select" required>
													<option value="">Select Supplier</option>
													 <?php
                                                    // include('include/db.php');
                                                    
                                                    $query = "SELECT distinct supplier_name from suppliers";
                                                    $rlt = mysqli_query($con,$query);
                                                    while($row = mysqli_fetch_array($rlt)) {
                                                    echo '<option value="'.$row['supplier_name'].'">'.$row['supplier_name'].'</option>';?>
                                                    <?php } ?>
													<!-- <option value="sports">Sports</option>
													<option value="walking">Walking</option>
													<option value="exercise">exercise</option> -->
												</select>
											</div>
										</div>
										
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="form-group">
												<label>Product Code</label>
												<input type="text" name="p_code" placeholder="Enter Product Code" pattern="[0-9]+" title="Please enter numbers only" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>

											</div>
										</div>
									
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="form-group">
												<label>Quantity</label>
												<input type="text" name="quantity" required placeholder="Enter Quantity" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
											</div>
										</div>
										<div class="col-lg-12">
											<div class="form-group">
												<label>Description</label>
												<textarea id="myTextarea" oninput="removeLeadingSpaces()"placeholder="Enter Description" name="description" required></textarea >
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
												<input type="text" name="price" placeholder="Enter Price" required>
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="form-group">
												<label> Status</label>
												<select class="select" name="status" required>
													<option value="Closed">Closed</option>
													<option value="open">Open</option>
												</select>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="form-group">
												<label> Product Image</label>
												<div class="image-upload">
													<input type="file" name="product_image" required>
													<div class="image-uploads">
														<img src="assets/img/icons/upload.svg" alt="img">
														<h4>Drag and drop a file to upload</h4>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-12">
										<input type="submit" name="add_product" class="btn btn-primary me-2">
											<a href="productlist.php" class="btn btn-danger">Cancel</a>
										</div>

					                </div>
					            </form>

								</div>
							</div>
						</div>
					</div>
				</div>
	<script>
  function removeLeadingSpaces() {
    var textarea = document.getElementById("myTextarea");
    var text = textarea.value;
    
    // Remove leading spaces
    while (text.startsWith(' ')) {
      text = text.substring(1);
    }
    
    // Update the textarea value
    textarea.value = text;
  }
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
