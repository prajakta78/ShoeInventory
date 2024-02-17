<?php
include('include/sidebar.php');
include('include/conn.php');

if (isset($_POST['submit'])) {
    extract($_POST);
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $mobile_no = $_POST['mobile_no'];
    $user_img = $_FILES["myfile"]["name"];
    $file_tmp = $_FILES["myfile"]["tmp_name"];
    $folder = "users/" . $user_img;

    // Check if the email already exists in the table
    $checkEmailQuery = "SELECT email FROM users WHERE email = '$email'";
    $result = $con->query($checkEmailQuery);

    if ($result->num_rows > 0) {
        echo "<script>alert('Email already exists in the database. Please use a different email address.');</script>";
    } else {
        // Hash the password
        // ... (your password hashing logic here)

        // Insert user data into the table
        $subscription_expiry = date('Y-m-d', strtotime('+1 year'));
        $subscriptionKey = generateSubscriptionKey(); // Generate a unique subscription key
        $subscriptionKeyRequired = 1; // Flag to indicate key is required on first login
        $firstLogin = 1; // Flag to indicate first login

        // Insert the user into the database
        $sql = "INSERT INTO users (name, username, email, mobile_no, password, role, myfile, subscription_expiry, subscription_key, subscription_key_required, first_login) 
                VALUES ('$name', '$username', '$email', '$mobile_no', '$password', '$role', '$user_img', '$subscription_expiry', '$subscriptionKey', '$subscriptionKeyRequired', '$firstLogin')";

        move_uploaded_file($file_tmp, $folder);
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



}





       
        // Send email with the subscription key
  }     
   


// Function to generate a subscription key
function generateSubscriptionKey() {
    $key = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 10);
    return $key;
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
           <h3>Add New User</h3>
        </div>
    </div>
						<div class="content">
							<div class="page-header">
								<div class="page-title">
									<h4>User Management</h4>
									<h6>Add User</h6>
								</div>
							</div>
							<div class="card">
								<div class="card-body">
									<form action="#" method="POST" enctype="multipart/form-data">
									<div class="row">
										<div class="col-lg-4 col-sm-6 col-12">
											<div class="form-group">
												<label>New User</label>
													<input type="text" name="name" placeholder="Enter your full name" required>
											</div>
											<div class="form-group">
												<label>Email</label>
												<input type="email" name="email" placeholder="Enter your email address"  required>
											</div>
											<div class="form-group">
												<label>Password</label>
												<div class="pass-group">
														<input type="password" name="password" class="pass-input" placeholder="Enter your password" required>
									              <span class="fas toggle-password fa-eye-slash"></span>
												</div>
											</div>
											
										</div>
										<div class="col-lg-4 col-sm-6 col-12">
											<div class="form-group">
												<label>User Name</label>
													<input type="text" name="username" placeholder="Enter your username" required>
											</div>
											<div class="form-group">
												<label>Mobile</label>
												<input type="text" name="mobile_no"  placeholder="Enter your Mobie no." required>
											</div>
											<div class="form-group">
												<label>Role</label>
												<select name="role" class="select" required>
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
													<div class="image-uploads" required>
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