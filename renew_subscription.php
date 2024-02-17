<!-- renew_subscription.php -->
<?php
session_start();
include('include/conn.php');

if (!isset($_SESSION['expired_email'])) {
    header("Location: index.php");
    exit();
}

$expired_email = $_SESSION['expired_email'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $renewalKey = $_POST['renewal_key'];

    // Check if the provided renewal key matches the user's subscription key
    $sql = "SELECT * FROM users WHERE email = '$expired_email' AND subscription_key = '$renewalKey'";
    $result = $con->query($sql);

    if ($result->num_rows == 1) {
        // Renew the subscription and generate a new key
        $newKey = generateRandomKey(10);

        // Calculate the new subscription expiry date (one year from today)
        $newExpiryDate = date('Y-m-d', strtotime('+1 year'));

        $updateQuery = "UPDATE users SET subscription_expiry = '$newExpiryDate', subscription_key = '$newKey' WHERE email = '$expired_email'";
        $updateResult = $con->query($updateQuery);

        if ($updateResult) {
        	
            $_SESSION['subscription_expired'] = false; // Mark subscription as renewed
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Failed to renew subscription. Please contact support.";
        }
    } else {
        echo "Invalid renewal key.";
    }
}
function generateRandomKey() {
    $key = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 10);
    return $key;
}
?>

<!-- Display renewal key entry form -->
<!-- <form method="post" action="">
    Enter Renewal Key: <input type="text" name="renewal_key">
    <input type="submit" value="Renew Subscription">
</form> -->



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
	</head>
	<body class="account-page">
		<div class="main-wrapper">
			<div class="account-content">
				<div class="login-wrapper">
					<div class="login-content mx-auto">
						<div class="login-userset" style="border:1px solid black;padding:15px;">
							<div class="login-logo">
								<img src="assets/img/logo.png" alt="img">
							</div>
							<div class="login-userheading">
								<h3>Sign In</h3>
								<h4>Please login to your account</h4>
							</div>
							<form action="#" method="POST">
							<div class="form-login">
								<label>Subscription Key</label>
								<div class="form-addons">
									<input type="text" name="renewal_key" placeholder="Enter new key">
									<!-- <img src="assets/img/icons/mail.svg" alt="img"> -->
								</div>
							</div>
							
							<div class="form-login">
								 <input type="submit" value="Renew Subscription" class="btn btn-login">
							</div>
						</form>
							<!-- <div class="signinform text-center">
								<h4>Don’t have an account? <a href="registartion.php" class="hover-a">Login</a></h4>
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
					<!-- <div class="login-img">
						<img src="assets/img/login.jpg" alt="img">
					</div> -->
				</div>
			</div>
		</div>
		<script src="assets/js/jquery-3.6.0.min.js"></script>
		<script src="assets/js/feather.min.js"></script>
		<script src="assets/js/bootstrap.bundle.min.js"></script>
		<script src="assets/js/script.js"></script>
	</body>
</html>
