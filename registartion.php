<?php
include('include/conn.php');

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Hash the password

    // Insert user data into the table
    $subscription_expiry = date('Y-m-d', strtotime('+1 year'));
    $subscriptionKey = generateSubscriptionKey(); // Generate a unique subscription key
    $subscriptionKeyRequired = 1; // Flag to indicate key is required on first login
    $firstLogin = 1; // Flag to indicate first login

    $sql = "INSERT INTO users (name, email, password, subscription_expiry, subscription_key, subscription_key_required, first_login) 
            VALUES ('$name', '$email', '$password', '$subscription_expiry', '$subscriptionKey', '$subscriptionKeyRequired', '$firstLogin')";

    if ($con->query($sql) === TRUE) {
        echo "Registration successful!";
        // Send email with the subscription key
        $subject = 'Your Subscription Key';
        $message = 'Hello ' . $name . ', your subscription key is: ' . $subscriptionKey;
        $headers = 'From: prajakta02fegade@gmail.com'; // Replace with your email

        if (mail($email, $subject, $message, $headers)) {
            echo "An email with your subscription key has been sent to your email address.";
        } else {
            echo "Email sending failed.";
        }

        header('location:enter_subscription_key.php?user_id=' . $con->insert_id);
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
}

// Function to generate a subscription key
function generateSubscriptionKey() {
    $key = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 10);
    return $key;
}
?>


<!-- <!DOCTYPE html>
<html>
	<head>
		<title>Registration Form</title>
	</head>
	<body>
		<h2>Registration Form</h2>
		<form action="#" method="POST">
			<label>Name: <input type="text" name="name" required></label><br>
			<label>Email: <input type="email" name="email" required></label><br>
			<label>Password: <input type="password" name="password" required></label><br>
			<input type="submit" name="submit"value="Register">
		</form>
	</body>
</html> -->
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
					<div class="login-content">
						<div class="login-userset">
							<div class="login-logo">
								<img src="assets/img/logo.png" alt="img">
							</div>
							<div class="login-userheading">
								<h3>Create an Account</h3>
								<h4>Continue where you left off</h4>
							</div>
							<form action="#" method="POST">
							<div class="form-login">
								<label>Full Name</label>
								<div class="form-addons">
									<input type="text" name="name" placeholder="Enter your full name">
									<img src="assets/img/icons/users1.svg" alt="img">
								</div>
							</div>
							<div class="form-login">
								<label>Email</label>
								<div class="form-addons">
									<input type="email" name="email" placeholder="Enter your email address">
									<img src="assets/img/icons/mail.svg" alt="img">
								</div>
							</div>
							<div class="form-login">
								<label>Password</label>
								<div class="pass-group">
									<input type="password" name="password" class="pass-input" placeholder="Enter your password">
									<span class="fas toggle-password fa-eye-slash"></span>
								</div>
							</div>
							<div class="form-login">
								<input type="submit" name="submit" class="btn btn-login" value="Register">
							</div>
						</form>
							<div class="signinform text-center">
								<h4>Already a user? <a href="index.php" class="hover-a">Log In</a></h4>
							</div>
							<!-- <div class="form-setlogin">
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