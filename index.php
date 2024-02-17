<?php
error_reporting(0);
session_start();
include('include/conn.php');
include('include/top_header.php');


if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
     $role = $_POST['role'];

    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password' AND role = '$role'";
    $result = $con->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        if (strtotime($row['subscription_expiry']) > time()) {
            $_SESSION['name'] = $row['name'];
            $_SESSION['username'] = $row['email'];
            $_SESSION['password'] = $row['password'];
            $_SESSION['myfile'] = $row['myfile'];
             $_SESSION['role'] = $row['role'];
              if($role==='Admin' && $user===$_SESSION['user'] && $pass===$_SESSION['pass'])
            {
            header("location:dashboard.php");
            }
            elseif( $role=='User' && $user===$_SESSION['user'] && $pass===$_SESSION['pass'])
            {
              header("location:userdashboard.php")    ;  
            }
              

            // header("Location: dashboard.php");
            exit();
        } else {
            $_SESSION['subscription_expired'] = true;
            $_SESSION['expired_email'] = $row['email'];
           echo '<script type ="text/JavaScript">';
echo 'alert(" Your subscription is expired!!! ");window.location.href = "renew_subscription.php"';
echo '</script>';
            // exit();
        }
    } else {
        echo "Invalid email or password.";
    }
}

// ... rest of the code ...
?>




<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<meta name="description" content="POS - Bootstrap Admin Template">
		<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects">
		<meta name="author" content="Dreamguys - Bootstrap Admin Template">
		<meta name="robots" content="noindex, nofollow">
		<title>Login - Pos admin template</title>
		<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
		<link rel="stylesheet" href="assets/css/style.css">
		<style>
			.pass-input, .pass-select {
    background: #fff!important;
    border-color: #ff9f43;
/*}*/
/*.select2-container--default .select2-selection--single {*/
    border: 1px solid rgba(145,158,171,.32);
    border-radius: 5px;
/*}*/
/*.select2-container .select2-selection--single {*/
    height: 40px;
    width:100%;
/*}*/
/*.select2-container--default .select2-selection--single {*/
    background-color: #fff;
    border: 1px solid #aaa;
    border-radius: 4px;
/*}*/
/*.select2-container .select2-selection--single {*/
    box-sizing: border-box;
    cursor: pointer;
    display: block;
    height: 28px;
    user-select: none;
    -webkit-user-select: none;
}
		</style>
	</head>
	<body class="account-page">
		<div class="main-wrapper">
			<div class="account-content">
				<div class="login-wrapper">
					<div class="login-content">
						<div class="login-userset">
							<div class="login-logo">
								<img src="assets/img/logo.png" alt="img">
							</div>
							<div class="login-userheading">
								<h3>Sign In</h3>
								<h4>Please login to your account</h4>
							</div>
							<form action="#" method="POST">
							<div class="form-login">
								<label>Email</label>
								<div class="form-addons">
									<input type="text" name="email" placeholder="Enter your email address" required>
									<img src="assets/img/icons/mail.svg" alt="img">
								</div>
							</div>
							<div class="form-login">
								<label>Password</label>
								<div class="pass-group">
									<input type="password" name="password" class="pass-input" placeholder="Enter your password" required>
									<span class="fas toggle-password fa-eye-slash"></span>
								</div>
							</div>
							<div class="form-login">
										
												<label> Role</label>
													<div class="pass-group">
												<select class="pass-input pass-select"  name="role" required title="please select role">
															<option value="" Selected>Select Role</option>
													<option value="Admin">Admin</option>
													<option value="User">User</option>
												</select>
											</div>
										</div>
							<!-- <div class="form-login">
								<div class="alreadyuser">
									<h4><a href="forgetpassword.html" class="hover-a">Forgot Password?</a></h4>
								</div>
							</div> -->
							<div class="form-login">
								<input type="submit" class="btn btn-login" name="submit" value="login">
							</div>
						</form>
							<!-- <div class="signinform text-center">
								<h4>Don’t have an account? <a href="registartion.php" class="hover-a">Register Here</a></h4>
							</div> -->
<!-- 							<div class="form-setlogin">
								<h4>Or sign up with</h4>
							</div> -->
							<!-- <div class="form-sociallink">
								<ul>
									<li>
										<a href="javascript:void(0);">
											<img src="assets/img/icons/google.png" class="me-2" alt="google">
											Sign Up using Google
										</a>
									</li>
									<li>
										<a href="javascript:void(0);">
											<img src="assets/img/icons/facebook.png" class="me-2" alt="google">
											Sign Up using Facebook
										</a>
									</li>
								</ul>
							</div> -->
						</div>
					</div>
					<div class="login-img">
						<img src="assets/img/login.jpg" alt="img">
					</div>
				</div>
			</div>
		</div>
		<script src="assets/js/jquery-3.6.0.min.js"></script>
		<script src="assets/js/feather.min.js"></script>
		<script src="assets/js/bootstrap.bundle.min.js"></script>
		<script src="assets/js/script.js"></script>
	</body>
</html>