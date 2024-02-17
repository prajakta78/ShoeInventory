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
if(isset($_POST['update_b'])){
	extract($_POST);
	$id = $_POST['id'];
    // echo $id; die;
     $oldfile = $_POST['oldfile'];

 


$brand_img =$_FILES["brand_img"]["name"];
$file_tmp =$_FILES["brand_img"]["tmp_name"];
$folder = "images/" . $brand_img;


    if(move_uploaded_file($file_tmp, $folder)){
    $oldfile = $brand_img;


}
	$sql = "UPDATE `brands` SET `brand_name`='$brand_name', `description`='$description',`brand_img`='$oldfile' WHERE `id` = '$id' ";

	$res = mysqli_query($con, $sql);
	if($res){
		 echo "<script type='text/javascript'>
        swal('Brand Update Sucessfully!', 'You clicked the button!', 'success')
        .then(okay => {
            if (okay) {
                window.location = 'brandlist.php ';
            }

        });</script>";

    }else
    {
        header('location:brandlist.php');
    }

}



?>