<?php include('include/conn.php');
if(isset($_POST['update_c'])){
	extract($_POST);
	$id = $_POST['id'];
	$sql = "UPDATE `category` SET `category_name` = '$category_name', `category_code` = '$category_code', `description` = '$description' WHERE `id` = '$id'";
	$res = mysqli_query($con, $sql);
	if($res){
		 echo "<script type='text/javascript'>
        swal('Category Add Sucessfully!', 'You clicked the button!', 'success')
        .then(okay => {
            if (okay) {
                window.location = 'categorylist.php ';
            }

        });</script>";

    }else
    {
        header('location:categorylist.php');
    }

}



?>