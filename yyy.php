<?php include('include/sidebar.php');?>
<?php include('include/conn.php');?>

				<div class="page-wrapper">
					<div class="content">
						<div class="page-header">
							<div class="page-title">
								<h4>Sales Report</h4>
								<h6>Manage your Sales Report</h6>
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
									<!-- <div class="wordset">
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
									</div>-->
								</div> 
								<form method="post" action="#">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="start_date">Start Date</label>
                            <input type="date" class="form-control" name="start_date" required>
                        </div>
                        <div class="col-md-4">
                            <label for="end_date">End Date</label>
                            <input type="date" class="form-control" name="end_date" required>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" name="submit" class="btn btn-primary mt-4">Generate Report</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
								<!-- <div class="card" id="filter_inputs">
									<div class="card-body pb-0">
										<div class="row">
											<div class="col-lg-2 col-sm-6 col-12">
												<div class="form-group">
													<div class="input-groupicon">
														<input type="text" placeholder="From Date" class="datetimepicker">
														<div class="addonset">
															<img src="assets/img/icons/calendars.svg" alt="img">
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-2 col-sm-6 col-12">
												<div class="form-group">
													<div class="input-groupicon">
														<input type="text" placeholder="To Date" class="datetimepicker">
														<div class="addonset">
															<img src="assets/img/icons/calendars.svg" alt="img">
														</div>
													</div>
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
												<th>Bill Number</th>
												<th>SKU</th>
												<th>Product Name</th>
												<!-- <th> Category</th>
												<th>Brand</th> -->
												<th>Sold Qantity</th>
												<!-- <th>Instock qty</th> -->
												<th>Toatal</th>
												
												<th>Date </th>
											</tr>
										</thead>
										<tbody>
											<?php
											include('include/conn.php');
if(isset($_POST['submit'])){
$startDate = $_POST['start_date'];
$endDate = $_POST['end_date'];

// Query to retrieve sales data within the specified date range
$query = "
    SELECT
        bp.bill_number,
        b.customer_name,
        b.customer_mno,
        b.customer_address,
        bp.product_name,
        bp.category,
        bp.brand,
        bp.per_piece_price,
        bp.quantity,
        bp.total_price,
        bp.supplier_name,
        b.bill_date
    FROM
        bill b
    INNER JOIN
        bill_product bp ON b.bill_number = bp.bill_number
    WHERE
        b.bill_date BETWEEN '$startDate' AND '$endDate'
    ORDER BY
        b.bill_date DESC;
";


            $result = mysqli_query($con, $query);

            if ($result) {
            	while ($row = mysqli_fetch_assoc($result)) {
    $remaining_quantity = $row['available_quantity'] ;
    if ($remaining_quantity < 0) {
        $remaining_quantity = 0; // Make sure remaining quantity is not negative
    } ?>
											<tr>
												<!-- <td>
													<label class="checkboxs">
														<input type="checkbox">
														<span class="checkmarks"></span>
													</label>
												</td> -->
												<!-- <td class="productimgname">
												
												</td> -->
												  <td><?php echo $row['bill_number'];?></td>
        <td><?php echo $row['customer_name']?></td>
        <td><?php echo $row['customer_mno']?></td>
        
        <td><?php echo $row['product_name'];?></td>
        <td><?php echo $row['category'];?></td>
        <td><?php echo $row['brand'];?></td>
        <td><?php echo $row['per_piece_price']?></td>
        <td><?php echo  $row['quantity'];?></td>
        <td><?php echo $row['total_price'];?></td>
        <td><?php echo $row['supplier_name'];?></td>
        <td><?php echo $row['bill_date'];?></td>
											</tr>
											<?php } }  } ?>
										</tbody>
									</table>
								</div>
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
			<script src="assets/js/moment.min.js"></script>
			<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
			<script src="assets/plugins/select2/js/select2.min.js"></script>
			<script src="assets/js/moment.min.js"></script>
			<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
			<script src="assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
			<script src="assets/plugins/sweetalert/sweetalerts.min.js"></script>
			<script src="assets/js/script.js"></script>
		</body>
	</html>




































	<?php include('include/sidebar.php');?>
 <?php
include('include/conn.php');

if (isset($_POST['submit'])) {
	extract($_POST);
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $mobile_no = $_POST['mobile_no'];
     $user_img =$_FILES["myfile"]["name"];
$file_tmp =$_FILES["myfile"]["tmp_name"];
$folder = "users/" . $user_img;
     // Hash the password

    // Insert user data into the table
    $subscription_expiry = date('Y-m-d', strtotime('+1 year'));
    $subscriptionKey = generateSubscriptionKey(); // Generate a unique subscription key
    $subscriptionKeyRequired = 1; // Flag to indicate key is required on first login
    $firstLogin = 1; // Flag to indicate first login

    $sql = "INSERT INTO users (name,username, email, mobile_no, password, role, myfile, subscription_expiry, subscription_key, subscription_key_required, first_login) 
            VALUES ('$name','$username', '$email','$mobile_no','$password','$role','$user_img','$subscription_expiry', '$subscriptionKey', '$subscriptionKeyRequired', '$firstLogin')";
 move_uploaded_file($file_tmp,$folder);
    if ($con->query($sql) === TRUE) { 

    $fields = array(
    
        "message" =>"Your Otp is " . $subscriptionKey ,
        //$message = "Your One Time Password is " . $otp;
        "language" => "english",
        "route" => "v3",
        "numbers" => $mobile_no,
        "sender_id"=>"SUBPVL",
    );
  //  print_r($fields);die;

    $curl = curl_init();
    
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_SSL_VERIFYHOST => 0,
      CURLOPT_SSL_VERIFYPEER => 0,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => json_encode($fields),
      CURLOPT_HTTPHEADER => array(
     "authorization: pNcPXzF5mljfJhAD7kibCHusonSdZO9V1UWvTB0xGaEILtgerqm76dnrsAIqCYDohkwyiXjcZKfFB24G",
        "accept: */*",
        "cache-control: no-cache",
        "content-type: application/json"
      ),
    ));
    
     $response = curl_exec($curl);
     
    $err = curl_error($curl);
    
    curl_close($curl);
    
    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
     
    
   
     echo "<script>
            alert('OTP Send Successfully');
            window.location.href='enter_subscription_key.php?user_id=" . $con->insert_id . "';
          </script>";
    }
  }

    else
    {
    header("location:userlist.php");
    }









       
        // Send email with the subscription key
       
   
}

// Function to generate a subscription key
function generateSubscriptionKey() {
    $key = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 10);
    return $key;
}
?>

					<div class="page-wrapper">
						<div class="content">
							<div class="page-header">
								<div class="page-title">
									<h4>User Management</h4>
									<h6>Add/Update User</h6>
								</div>
							</div>
							<div class="card">
								<div class="card-body">
									<form action="#" method="POST" enctype="multipart/form-data">
									<div class="row">
										<div class="col-lg-4 col-sm-6 col-12">
											<div class="form-group">
												<label>User Name</label>
													<input type="text" name="name" placeholder="Enter your full name">
											</div>
											<div class="form-group">
												<label>Email</label>
												<input type="email" name="email" placeholder="Enter your email address">
											</div>
											<div class="form-group">
												<label>Password</label>
												<div class="pass-group">
														<input type="password" name="password" class="pass-input" placeholder="Enter your password">
									              <span class="fas toggle-password fa-eye-slash"></span>
												</div>
											</div>
											
										</div>
										<div class="col-lg-4 col-sm-6 col-12">
											<div class="form-group">
												<label>User Name</label>
													<input type="text" name="username" placeholder="Enter your username">
											</div>
											<div class="form-group">
												<label>Mobile</label>
												<input type="text" name="mobile_no"  class="pass-input" placeholder="Enter your Mobie no." >
											</div>
											<div class="form-group">
												<label>Role</label>
												<select name="role" class="select">
													<option value="" selected>Select</option>
													<option value="Admin">Admin</option>
													<option value="User">User</option>
												</select>
											</div>
											
										</div>
										<div class="col-lg-4 col-sm-6 col-12">
											<div class="form-group">
												<label> Profile Picture</label>
												<div class="image-upload image-upload-new">
													<input type="file" name="myfile">
													<div class="image-uploads">
														<img src="assets/img/icons/upload.svg" alt="img">
														<h4>Drag and drop a file to upload</h4>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-12">
												<input type="submit" name="submit" class="btn btn-primary" value="Register">
											
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