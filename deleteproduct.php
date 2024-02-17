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
$id = $_GET['id'];
// echo $id; die;

    $sql = "DELETE FROM `products` WHERE `id`= '$id'";
    $res = mysqli_query($con, $sql);
    if($res){

    echo "<script type='text/javascript'>
        swal('Product Deleted Sucessfully!', 'You clicked the button!', 'success')
        .then(okay => {
            if (okay) {
                window.location = 'productlist.php ';
            }

        });</script>";

    }else
    {
        header('location:brandlist.php');
    }






?>