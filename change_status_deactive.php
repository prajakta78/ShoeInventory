<?php

include_once('include/conn.php');
 
$id = $_GET["id"];


// $result = mysqli_query($conn,"SELECT * FROM staff_entry where s_id = $designation AND Shift='$Shift'");
$query="UPDATE `users` SET `status`='on' WHERE `id`='$id'";
$result=mysqli_query($con,$query);

if($result)
{
  // header('location:product_list.php');
  echo "<script type='text/javascript'> alert('Status Change Sucessfully!');window.location='userlist.php' </script>";

}else
{
    header('location:userlist.php');
}
?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>