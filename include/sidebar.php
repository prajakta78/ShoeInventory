<?php 
error_reporting(0);
session_start();
include "conn.php"; 
 // echo   $_SESSION['username'];?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<meta name="description" content="POS - Bootstrap Admin Template">
		<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern,  html5, responsive">
		<meta name="author" content="Dreamguys - Bootstrap Admin Template">
		<meta name="robots" content="noindex, nofollow">
		<title>Inventory System</title>
		<!-- <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png"> -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/css/animate.css">
		<link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
		<link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css">
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
		<link rel="stylesheet" href="assets/css/style.css">
			<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
			    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


			    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style type="text/css">
	.header .user-img {
    display: inline-block;
    position: relative;
    margin-top: -20px;
    margin-lrft: 21px;
    margin-left: 13px;
}
</style>
	</head>
	<body>
		<div id="global-loader">
			<div class="whirly-loader"> </div>
		</div>
		<div class="main-wrapper">
			<div class="header">
				<div class="header-left active" >
					<!-- <h5 ><b>Inventory System</b></h5>  -->
					<a href="dashboard.php" class="logo">
						<img src="assets/img/inventory_manage.png"  width="300" height="100"alt="">
					</a> 
					<!-- <a href="index.php" class="logo-small">
						<img src="assets/img/logo-small.png" alt="">
					</a> -->
					<a id="toggle_btn" href="javascript:void(0);">
					</a>
					<!-- <a class="navbar-brand mx-auto" id="navbarHeading">
            Dashboard
        </a> -->
				</div>
				<a id="mobile_btn" class="mobile_btn" href="#sidebar">
					<span class="bar-icon">
						<span></span>
						<span></span>
						<span></span>
					</span>
				</a>
				<ul class="nav user-menu">
					
					
					<li class="nav-item dropdown has-arrow main-drop">

						<a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
							<span class="d-none d-sm-block"><b><?php echo $_SESSION['username'];?></b></span>
							<span class="user-img"><img src="users/<?php echo $_SESSION['myfile'];?>" alt="">
							</a>

			<div class="dropdown-menu menu-drop-user">

								<div class="profilename">
									<div class="profileset">

										<span class="user-img"><img src="users/<?php echo $_SESSION['myfile'];?>" alt="">
											<span class="status online"></span></span>
											<div class="profilesets">
												
												<h6><?php echo $_SESSION['username'];?></h6>
												<!-- <h5>Admin</h5>
											</div>
										</div>
										<hr class="m-0">
										<!-- <a class="dropdown-item" href="profile.php"> <i class="me-2" data-feather="user"></i> My Profile</a>
										<a class="dropdown-item" href="generalsettings.php"><i class="me-2" data-feather="settings"></i>Settings</a>
										<hr class="m-0"> -->
										<a class="dropdown-item logout pb-0" href="logout.php" onclick="return confirm('Are you sure you want to log out ?')"><img src="assets/img/icons/log-out.svg" class="me-2" alt="img">Logout</a>
									</div>
								</div>
							</li>
						</ul>
						<div class="dropdown mobile-user-menu">
							<a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v" style="line-height: 2;"></i></a>
							<div class="dropdown-menu dropdown-menu-right">
								<!-- <a class="dropdown-item" href="profile.php">My Profile</a>
								<a class="dropdown-item" href="generalsettings.php">Settings</a> -->
								<a onclick="return confirm('Are you sure?')" class="dropdown-item" href="logout.php">Logout</a>
							</div>
						</div>
					</div>
<?php

include('conn.php');

$role=$_SESSION['role'];
$sql="SELECT * FROM `role` WHERE `role`='$role'";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_array($result);

$permission=explode(",", $row['permission']);
// print_r($permission); die;
?>
					<div class="sidebar" id="sidebar">
						<div class="sidebar-inner slimscroll">
							<div id="sidebar-menu" class="sidebar-menu">
								<ul> 
									 <?php if(in_array ("Admin Dashboard",$permission)) {?> 
									<li class="active">
										<a href="dashboard.php" onclick="changeNavbarHeading('Admin Dashboard');"><img src="assets/img/icons/dashboard.svg" alt="img"><span> Admin Dashboard</span> </a>
<!-- 									
 -->									</li>
									<?php } ?>
									 <?php if(in_array (" User Dashboard",$permission)) {?> 
									<li class="active">
									<a href="userdashboard.php" onclick="changeNavbarHeading('User Dashboard');" ><i data-feather="layers"></i><span> User Dashboard</span> </a>
								</li>
								<?php } ?>
								 
								<!-- <li class="active">
										<a href="dashboard.php"><img src="assets/img/icons/dashboard.svg" alt="img"><span> User  Dashboard</span> </a>
									</li> -->
									<li class="submenu">
										<a href="javascript:void(0);"><img src="assets/img/icons/product.svg" alt="img"><span> Product</span> <span class="menu-arrow"></span></a>
										<ul>
											 <?php if(in_array(" Product List",$permission)) {?>
											<li><a href="productlist.php" onclick="changeNavbarHeading('Product List');" > Product List</a></li>
										
											<?php } ?>
											 <?php if(in_array(" Add Product",$permission)) {?>
											<li><a href="addproduct.php" onclick="changeNavbarHeading('Add Product');"> Add Product</a></li>
										<?php } ?>
								 <?php if(in_array(" Category List",$permission)) {?>
											
											<li><a href="categorylist.php"> Category List</a></li>
								<?php } ?>
											 <?php if(in_array(" Add Category",$permission)) {?>	
											<li><a href="addcategory.php"> Add Category</a></li>
										<?php } ?>
											<!-- <li><a href="subcategorylist.php">Sub Category List</a></li> -->
											<!-- <li><a href="subaddcategory.php">Add Sub Category</a></li> -->

											 <?php if(in_array(" Brand List",$permission)) {?>	
											<li><a href="brandlist.php">Brand List</a></li>
											<?php } ?>
											 <?php if(in_array(" Add Brand",$permission)) {?>	
											<li><a href="addbrand.php">Add Brand</a></li>
											<?php } ?>
											 <?php if(in_array(" Supplier List",$permission)) {?>	
											<li><a href="supplierlist.php">Supplier List</a></li>
											<?php } ?>
											 <?php if(in_array(" Add Supplier",$permission)) {?>	
											<li><a href="addsupplier.php">Add Supplier</a></li>
											<?php } ?>
											 <?php if(in_array(" Product Report",$permission)) {?>	
											<li><a href="advanceproductsreport.php">Product Report</a></li>
											<?php } ?>

											<!-- <li><a href="importproduct.php">Import Products</a></li> -->
											<!-- <li><a href="barcode.php">Print Barcode</a></li> -->
										</ul>
									</li>
									<!-- <li class="submenu">
										<a href="bill_product.php"><img src="assets/img/icons/dashboard.svg" alt="img"><span> Bill</span> </a>
									</li> -->

									<li class="submenu">
										<a href="javascript:void(0);"><img src="assets/img/icons/sales1.svg" alt="img"><span> Bill</span> <span class="menu-arrow"></span></a>
										<ul>
											 <?php if(in_array(" Create Bill",$permission)) {?>	
											<li><a href="bill_product.php">Create Bill</a></li>
										<?php } ?>
										 <?php if(in_array(" Todays Bill",$permission)) {?>	
											<li><a href="todays_bills.php">Todays Bill</a></li>
										<?php } ?>
											<!-- <li><a href="all_bills.php">All Bills</a></li> -->
											
											<li><a href="all.php">All Bills</a></li>
										
											<!-- <li><a href="salesreturnlists.php">Sales Return List</a></li>
											<li><a href="createsalesreturns.php">New Sales Return</a></li> -->
										</ul>
									</li>
									<!-- <li class="submenu">
										<a href="javascript:void(0);"><img src="assets/img/icons/purchase1.svg" alt="img"><span> Purchase</span> <span class="menu-arrow"></span></a>
										<ul>
											<li><a href="purchaselist.php">Purchase List</a></li>
											<li><a href="addpurchase.php">Add Purchase</a></li>
											<li><a href="importpurchase.php">Import Purchase</a></li>
										</ul>
									</li> -->
									
									<!-- <li class="submenu">
										<a href="javascript:void(0);"><img src="assets/img/icons/transfer1.svg" alt="img"><span> Transfer</span> <span class="menu-arrow"></span></a>
										<ul>
											<li><a href="transferlist.php">Transfer List</a></li>
											<li><a href="addtransfer.php">Add Transfer </a></li>
											<li><a href="importtransfer.php">Import Transfer </a></li>
										</ul>
									</li> -->
									
									
									
								<li class="submenu">
									<a href="javascript:void(0);"><img src="assets/img/icons/time.svg" alt="img"><span> Report</span> <span class="menu-arrow"></span></a>
									<ul>
										<!-- <li><a href="purchaseorderreport.php">Purchase order report</a></li>
										<li><a href="inventoryreport.php">Inventory Report</a></li> -->
										 <?php if(in_array(" Sales Report",$permission)) {?>	
										<li><a href="salesreport.php">Sales Report</a></li>
									<?php } ?>
									 <?php if(in_array(" Less Stock Report",$permission)) {?>
										<li><a href="less_stockreport.php">Less Stock Report</a></li>
									<?php } ?>
									 <?php if(in_array(" Advanced Sale Report",$permission)) {?>
										<li><a href="advancedreport.php">Advanced Sale Report</a></li>
									<?php } ?>
										<!-- <li><a href="purchasereport.php">Purchase Report</a></li>
										<li><a href="supplierreport.php">Supplier Report</a></li>
										<li><a href="customerreport.php">Customer Report</a></li> -->
									</ul>
								</li>
								<!-- <li class="submenu">
										<a href="javascript:void(0);"><img src="assets/img/icons/users1.svg" alt="img"><span> People</span> <span class="menu-arrow"></span></a>
										<ul>
											<li><a href="customerlist.php">Customer List</a></li>
											<li><a href="addcustomer.php">Add Customer </a></li>
											<li><a href="supplierlist.php">Supplier List</a></li>
											<li><a href="addsupplier.php">Add Supplier </a></li>
											<li><a href="userlist.php">User List</a></li>
											<li><a href="adduser.php">Add User</a></li>
											<li><a href="storelist.php">Store List</a></li>
											<li><a href="addstore.php">Add Store</a></li>
										</ul>
									</li>  -->
								<li class="submenu">
									<a href="javascript:void(0);"><img src="assets/img/icons/users1.svg" alt="img"><span> Users</span> <span class="menu-arrow"></span></a>
									<ul>
										 <?php if(in_array(" New User",$permission)) {?>
										<li><a href="newuser.php">New User </a></li>
									<?php } ?>
									<?php if(in_array(" Users List",$permission)) {?>
										<li><a href="userlist.php">Users List</a></li>
									<?php } ?>
									</ul>
								</li>
								<!-- <li class="submenu">
									<a href="javascript:void(0);"><img src="assets/img/icons/settings.svg" alt="img"><span> Settings</span> <span class="menu-arrow"></span></a>
									<ul>
										<li><a href="generalsettings.php">General Settings</a></li>
										<li><a href="emailsettings.php">Email Settings</a></li>
										<li><a href="paymentsettings.php">Payment Settings</a></li>
										<li><a href="currencysettings.php">Currency Settings</a></li>
										<li><a href="grouppermissions.php">Group Permissions</a></li>
										<li><a href="taxrates.php">Tax Rates</a></li>
									</ul>
								</li> -->
							</ul>
						</div>
					</div>
				</div>
				<script>
					function changeNavbarHeading(newHeading) {
    document.getElementById("menuHeading").textContent = newHeading;
}
				</script>
				


