

<html>
    <head>
           <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width,initial-scale=1">
        
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'></link> 
    </head>
     <body>
            
        </body>
</html>

<?php include('include/conn.php');
 if(isset($_POST['update'])){

 extract($_POST);
 $oldfile = $_POST['oldfile'];
    // $new_file = $old_file; // Default to the old file if no new one is provided
    $user_image =$_FILES["myfile"]["name"];
$file_tmp =$_FILES["myfile"]["tmp_name"];
$folder = "users/" . $user_image;



  
if(move_uploaded_file($file_tmp,$folder)){
    $oldfile = $user_image;
 }



 
 	$sql2 = "UPDATE `users` SET `name`='$name',`username`='$username',`email`='$email',`mobile_no`='$mobile_no',`password`='$password',`role`='$role',`myfile`='$oldfile' WHERE `id` = '$id'";
 	$res = mysqli_query($con, $sql2);
 	 if($res) {
         echo "<script type='text/javascript'>
        swal('User Update Sucessfully!', 'You clicked the button!', 'success')
        .then(okay => {
            if (okay) {
                window.location = 'userlist.php ';
            }

        });</script>";
    } else {
        echo "Error updating user: " . $con->error;
    }
 }
?>