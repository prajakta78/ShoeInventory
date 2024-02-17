


<?php
include('include/conn.php');

 echo $id =$_GET['id'];

 echo $billId=$_GET['billId'];


 $deleteQuery = "DELETE FROM bill_product WHERE bill_number = '$billId' AND id='$id'";
 mysqli_query($con, $deleteQuery);
header("Location: editbill.php?bill_id=" . $billId);


?>