<?php include('include/sidebar.php');

 include('include/conn.php');
$id = $_GET['id'];
// echo $id; die;

$sql = "SELECT * FROM users where id= '$id'";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($res);
 
 
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
           <h3>Edit User</h3>
        </div>
    </div>
						<div class="content">
							<div class="page-header">
								<div class="page-title">
									<h4>User Management</h4>
									<h6>Edit/Update User</h6>
								</div>
							</div>
							<div class="card">
								<div class="card-body">
									<form action="updateuser.php" method="POST" enctype="multipart/form-data">
									<div class="row">
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="form-group">
												<label>First Name</label>
												<input type="hidden" name="id"  value="<?php echo $row['id'];?>">
												<input type="text" name="name" placeholder="Enter Y our Full name" value="<?php echo $row['name'];?>">
											</div>
										</div>
										<!-- <div class="col-lg-3 col-sm-6 col-12">
											<div class="form-group">
												<label>Last Name</label>
												<input type="text" value="">
											</div>
										</div> -->
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="form-group">
												<label>User Name</label>
												<input type="text" name="username" value="<?php echo $row['username'];?>">
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="form-group">
												<label>Password</label>
												<div class="pass-group">
													<input type="password" name="password" class=" pass-input" placeholder="Enter Password" value="<?php echo $row['password'];?>">
													<span class="fas toggle-password fa-eye-slash"></span>
												</div>
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="form-group">
												<label>Phone</label>
												<input type="text" name="mobile_no" value="<?php echo $row['mobile_no'];?>">
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="form-group">
												<label>Email</label>
												<input type="text" name="email" value="<?php echo $row['email'];?>">
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											 <div class="form-group">
        <label>Role</label>
        <select name="role" class="select">
            <option value="Admin" <?php echo ($row['role'] == 'Admin') ? 'selected' : ''; ?>>Admin</option>
            <option value="User" <?php echo ($row['role'] == 'User') ? 'selected' : ''; ?>>User</option>
        </select>
    </div>
										</div>
										<div class="col-lg-12">
											<div class="form-group">
												<label> User Image</label>
												<div class="image-upload">
													<input type="text" name="oldfile" value="<?php echo $row['myfile'];?>">
													<input type="file" name="myfile" >
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
													<li class="ps-0">
														<div class="productviewset">
															<div class="productviewsimg">
																<img src="users/<?php echo $row['myfile'];?>" alt="img">

															</div>
															<!-- <div class="productviewscontent">
																<a href="javascript:void(0);" class="hideset"><i class="fa fa-trash-alt"></i></a>
															</div> -->
														</div>
													</li>
												</ul>
											</div>
										</div>
										<div class="col-lg-12">
											<input type="submit" name="update" value="Update" class="btn btn-primary"></a>
											<!-- <a class="btn btn-danger">Cancel</a> -->
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