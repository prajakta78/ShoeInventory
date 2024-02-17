<?php include('include/sidebar.php');?>
<?php include('include/conn.php');
$idc = $_GET['id'];
if(isset($_POST['update_c'])){
	extract($_POST);
	
	$sql2 = "UPDATE `suppliers` SET `supplier_code`='$supplier_code',`supplier_name`='$supplier_name',`supplier_address`='$supplier_address',`mobile_no`='$mobile_no' WHERE `supplier_id`= '$idc'";
	$res1 = mysqli_query($con, $sql2);
	if($res1){
		 echo "<script type='text/javascript'>
        swal('Supplier Update Sucessfully!', 'You clicked the button!', 'success')
        .then(okay => {
            if (okay) {
                window.location = 'supplierlist.php ';
            }

        });</script>";

    }else
    {
        echo "<script type='text/javascript'>
        swal('Something went Wrong!', 'You clicked the button!', 'success')
        .then(okay => {
            if (okay) {
                window.location = 'supplierlist.php ';
            }

        });</script>";

    }

}



?>

<?php include('include/conn.php');
$id = $_GET['id'];
	 
        $sql = "SELECT * FROM `suppliers` WHERE `supplier_id` = '$idc'"; // Replace 'categories' with your actual table name
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
           <h3>Edit Supplier</h3>
        </div>
    </div>
						<div class="content">
							<div class="page-header">
								<div class="page-title">
									<h4>Product Edit Category</h4>
									<h6>Edit a product Category</h6>
								</div>
							</div>
						<div class="card">
								<div class="card-body">
									<form action="#" method="POST">
									<div class="row">
										<div class="col-lg-6 col-sm-6 col-12">
											<div class="form-group">
												<label>Supplier Name</label>
												<input type="hidden" value="<?php echo $row['id'];?>" name="id">
												<input type="text" name="supplier_name" value="<?php echo $row['supplier_name'];?>">
											</div>
										</div>
										<div class="col-lg-6 col-sm-6 col-12">
											<div class="form-group">
												<label>Supplier Code</label>
												<input type="text" name="supplier_code" value="<?php echo $row['supplier_code'];?>">
											</div>
										</div>
										<div class="col-lg-6 col-sm-6 col-12">
											<div class="form-group">
												<label>Supplier Address</label>
												<input type="text" name="supplier_address" value="<?php echo $row['supplier_address'];?>">
											</div>
										</div>
										<div class="col-lg-6 col-sm-6 col-12">
											<div class="form-group">
												<label>Supplier Mobile No. </label>
												<input type="text" name="mobile_no" value="<?php echo $row['mobile_no'];?>">
											</div>
										</div>
										
										<div class="col-lg-12">
											<input type="submit" name="update_c" class="btn btn-primary me-2" value="Update"></a>
											<a href="supplierlist.php" class="btn btn-danger">Cancel</a>
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




<!--  -->