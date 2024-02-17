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


<?php
include('include/conn.php');

if(isset($_POST['add_product'])) {
    $product_id = $_POST['product_id'];
    $p_name = $_POST['p_name'];
    $category = $_POST['category'];
    $brand = $_POST['brand'];
     $supplier = $_POST['supplier'];
    $p_code = $_POST['p_code'];
    $quantity = $_POST['quantity'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $status = $_POST['status'];
    
    // Handle the uploaded image if needed
    $old_file = $_POST['old_file'];
    // $new_file = $old_file; // Default to the old file if no new one is provided
    $product_image =$_FILES["product_image"]["name"];
$file_tmp =$_FILES["product_image"]["tmp_name"];
$folder = "productimg/" . $product_image;



  
if(move_uploaded_file($file_tmp,$folder)){
    $old_file = $product_image;
 }
    // Update the product details in the database
    $update_query = "UPDATE products SET 
                     product_name = '$p_name', category = '$category', brand = '$brand',
                     supplier_name = '$supplier', 
                     product_code = '$p_code', quantity = '$quantity', 
                     description = '$description', price = '$price', 
                     status = '$status', product_image = '$old_file' 
                     WHERE id = $product_id"; // Replace $product_id with the actual ID of the product you are updating
 $res= mysqli_query($con,$update_query);

    if($res) {
         echo "<script type='text/javascript'>
        swal('Product Update Sucessfully!', 'You clicked the button!', 'success')
        .then(okay => {
            if (okay) {
                window.location = 'productlist.php ';
            }

        });</script>";
    } else {
        echo "Error updating product: " . $con->error;
    }
}
?>
