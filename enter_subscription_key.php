<?php
include('include/conn.php');

if (isset($_POST['submit'])) {
    $enteredKey = $_POST['subscription_key'];
    $userId = $_POST['user_id']; // Passed from form

    // Check if entered key matches the user's subscription key
    $keySql = "SELECT * FROM users WHERE id = '$userId' AND subscription_key = '$enteredKey'";
    $keyResult = $con->query($keySql);

    if ($keyResult->num_rows === 1) {
        // Valid subscription key, update the flag and redirect to login page
        $updateFlagSql = "UPDATE users SET subscription_key_required = 0 WHERE id = '$userId'";
        $con->query($updateFlagSql);
echo "<script>
            alert('User Created Successfully');
            window.location.href='userlist.php';
          </script>";
        // header('location:userlist.php');
        exit; // Add this line to stop executing further code
    } else {
        echo "Invalid subscription key.";
    }
}
?>
<!-- HTML form to enter subscription key -->
<!-- <!DOCTYPE html>
<html>
<head>
    <title>Enter Subscription Key</title>
</head>
<body>
    <h2>Enter Subscription Key</h2>
    <form action="" method="post">
        <input type="hidden" name="user_id" value="<?php echo $_GET['user_id']; ?>">
        <label for="subscription_key">Subscription Key:</label>
        <input type="text" id="subscription_key" name="subscription_key" required>
        <input type="submit" name="submit" value="Submit">
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
                    <div class="login-content mx-auto">
                        <div class="login-userset" style="border:1px solid black;padding:15px;">
                            <div class="login-logo">
                                <img src="assets/img/inventory_manage.png" alt="img">
                            </div>
                            <div class="login-userheading">
                                <h3>Registration</h3>
                                <h4>Please login to your account</h4>
                            </div>
                            <form action="#" method="POST">
                            <div class="form-login">
                                <label>Subscription Key</label>
                                <div class="form-addons">
                                     <input type="hidden" name="user_id" value="<?php echo $_GET['user_id']; ?>">
                                     <input type="text" id="subscription_key" name="subscription_key" required>
                                    <!-- <img src="assets/img/icons/mail.svg" alt="img"> -->
                                </div>
                            </div>
                            
                            <div class="form-login">
                                 <input type="submit" name="submit" value="Submit" class="btn btn-login">
                            </div>
                        </form>
                            <!-- <div class="signinform text-center">
                                <h4>Don’t have an account? <a href="registartion.php" class="hover-a">Login</a></h4>
                            </div> -->
<!--                            <div class="form-setlogin">
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
