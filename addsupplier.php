
<?php

session_start();
error_reporting(0);
$username=$_SESSION["username"];

if($username!="")
{
?>
<?php include('include/sidebar.php');?>
<?php include('include/conn.php');
if (isset($_POST['submit_c']) ){
   extract($_POST);

    $sql = "INSERT INTO `suppliers`(`supplier_code`, `supplier_name`, `supplier_address`, `mobile_no`) VALUES ('$supplier_code','$supplier_name','$supplier_address','$mobile_no')";
    $res = mysqli_query($con, $sql);
    if ($res) {
        echo "<script type='text/javascript'>
        swal('Supplier Add Sucessfully!', 'You clicked the button!', 'success')
        .then(okay => {
            if (okay) {
                window.location = 'supplierlist.php ';
            }

        });</script>";

    }else
    {
        header('location:addsupplier.php');
    }
    // print_r($_POST);die;
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
           <h3>Add Supplier</h3>
        </div>
    </div>
	<div class="content">
		<div class="page-header">
			<div class="page-title">
				<h4>Product Add Supplier</h4>
				<h6>Create new product Category</h6>
			</div>
		</div>
		<div class="card">
			<div class="card-body">
				<form action="#" method="post">
				<div class="row">
					<div class="col-lg-6 col-sm-6 col-12">
						<div class="form-group">
							<label>Supplier Name</label>
							<input type="text" name="supplier_name" required>
						</div>
					</div>
					<div class="col-lg-6 col-sm-6 col-12">
						<div class="form-group">
							<label>Supplier Code</label>
							<input type="text" name="supplier_code" required>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="form-group">
							<label>Supplier Address</label>
							<input type="text" class="form-control" name="supplier_address" required>
						</div>
					</div>
						<div class="col-lg-12">
						<div class="form-group">
							<label>Supplier Mobile</label>
							<input type="text" class="form-control" name="mobile_no" required>
						</div>
					</div>
			
			
					<div class="col-lg-12">
						<input type="submit" name="submit_c" class="btn btn-primary me-2">
						<a href="categorylist.html" class="btn btn-danger me-2">Cancel</a>
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
  <?php } 

   else
    {
        echo '<script type ="text/JavaScript">';
echo 'alert(" You need log in first!!! ");window.location.href = "index.php"';
echo '</script>';
    }?>