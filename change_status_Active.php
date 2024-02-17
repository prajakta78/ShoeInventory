<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	
<?php

include_once('include/conn.php');
 
$id = $_GET['id'];


$query="UPDATE `users` SET `status`='off' WHERE `id`='$id'";
$result=mysqli_query($con,$query);

if($result)
{
    echo "<script type='text/javascript'> alert('Status Change Sucessfully!');window.location='userlist.php' </script>";


}else
{
    header('location:userlist.php');
}
?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>