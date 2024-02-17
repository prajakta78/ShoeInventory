

<!-- head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

</head> -->

<?php

include('include/conn.php');
include('include/top_header.php');


if (isset($_POST['generate_bill'])) {
    $billNumber = "BILL-" . uniqid();
    $productCodes = $_POST['product_codes'];
    $quantities = $_POST['quantities'];
    // extract($_POST);
    $customer_name = $_POST['customer_name'];
    $customer_mno =  $_POST['customer_mno'];
     $customer_address =  $_POST['customer_address'];
     $user = $_POST['user'];

    // Initialize the total amount
    $totalAmount = 0;
$addedProductCodes = array();
    // Insert the bill entry
    $insertBillQuery = "INSERT INTO bill (bill_number, total_amount, customer_name, customer_mno, customer_address, username) VALUES ('$billNumber', 0, '$customer_name','$customer_mno','$customer_address','$user')";
    mysqli_query($con, $insertBillQuery);

    // Get the inserted bill's ID
    // $billId = mysqli_insert_id($con);

    // Process each product
    foreach ($productCodes as $index => $productCode) {
         if (in_array($productCode, $addedProductCodes)) {
            echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Duplicate Product Code",
                    text: "Product with code \'' . $productCode . '\' is already added to the bill ",
                    confirmButtonText: "OK"
                }).then(() => {
                    window.location.href = "bill_product.php";
                });
            </script>';
            exit(); // Exit the script
        }
          $addedProductCodes[] = $productCode;
        $quantity = intval($quantities[$index]);

        // Retrieve product details
        $productQuery = "SELECT * FROM products WHERE product_code = '$productCode'";
        $productResult = mysqli_query($con, $productQuery);

        if ($productResult) {
            $product = mysqli_fetch_assoc($productResult);
            $productName = $product['product_name'];
            $productPrice = $product['price'];
              $category = $product['category'];
            $brands = $product['brand'];
            $supplier = $product['supplier_name'];


            // Calculate total amount and update bill's total amount
            $totalPrice = $productPrice * $quantity;
            $totalAmount += $totalPrice;
            $updateBillAmountQuery = "UPDATE bill SET total_amount = $totalAmount WHERE bill_number = '$billNumber'";
            mysqli_query($con, $updateBillAmountQuery);

            // Insert the bill item
            $insertItemQuery = "INSERT INTO bill_product (bill_number, product_code, product_name, category, brand, supplier_name, quantity, per_piece_price, total_price, username)
                               VALUES ('$billNumber', '$productCode', '$productName','$category','$brands','$supplier', $quantity, $productPrice, $totalPrice, '$user')";
            mysqli_query($con, $insertItemQuery);

            // Update product quantity
            $updatedQuantity = $product['quantity'] - $quantity;
            $updateProductQuery = "UPDATE products SET quantity = $updatedQuantity WHERE product_code = '$productCode'";
            mysqli_query($con, $updateProductQuery);
        } else {
            echo "Error: " . mysqli_error($con);
        }
    }


    // Generate bill HTML with CSS styling


    // echo "Bill generated successfully!";
     echo '<script>
            window.onload = function() {
                window.print();
            };
        </script>';
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Hardware Shop Bill</title>
    <style>
       
        body {
    font-size: 16px;
}

/* CSS for smaller screens */
@media (max-width: 768px) {
    body {
        font-size: 14px;
    }
    /* Add more responsive CSS rules here as needed */
}

        .bill-container {
            border: 1px solid #ccc;
            padding: 20px;
            width: 100%;
            margin: 0;
            page-break-before: always;
        }

        .shop-info {
            text-align: left;
            /*font-size: 16px;*/
            font-weight: bold;
            margin-bottom: 20px;
        }

        .bill-details {
             text-align: right;
            margin-top: 20px;
            /*font-size: 16px;*/
            font-weight: bold;
        }

        .bill-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            text-align:center;
        }

        .bill-table th, .bill-table td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }

        .bill-table th {
            background-color: #f2f2f2;
        }

        .bill-total {
            text-align: right;
            margin-top: 20px;
            /*font-size: 18px;*/
            font-weight: bold;
        }

        .bill-footer {
            margin-top: 30px;
            text-align: center;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="bill-container">
        <div class="row">
            <h1 class="text-center">Invoice</h1>
        <div class="col-xs-6 col-sm-6 col-md-6 text-left">
            <h3>Bill Number: <?php echo $billNumber; ?></h3>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 text-right">
            <h3>Date: <?php echo date("Y-m-d"); ?></h3>
        </div>
    </div>
          <div class="row">
               <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="shop-info">
             <!-- <div class="row"> -->
                 <!--   <div class="col-xs-6 col-sm-6 col-md-6"> -->
            <p>Hardware Shop</p>
            <p>123 Hardware Street</p>
            <p>City, Country</p>
            <p>Contact: (123) 456-7890</p>
        </div>
        </div>
          <div class="col-xs-6 col-sm-6 col-md-6">
       <div class="bill-details">
    <!-- <div class="row"> -->
      <!--   <div class="col-xs-6 col-sm-6 col-md-6"> -->
            <!-- <p>Bill Number: <?php echo $billNumber; ?></p> -->
         
       <!--  </div> -->
<!--         <div class="col-xs-6 col-sm-6 col-md-6 text-right"> -->
            <p>Customer Name: <?php echo $customer_name; ?></p>
            <p>Customer Mobile: <?php echo $customer_mno; ?></p>
             <p>Customer Address: <?php echo $customer_address; ?></p>
        </div>
    </div>
</div>
        <table class="bill-table" style="height:300px;">
            <thead>
                <tr style="font-size:22px;font-weight:bold;">
                    <th>Item Name</th>
                   
                    <th>Quantity</th>
                    <th>Price Per Unit</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($productCodes as $index => $productCode) {
                    $product = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM products WHERE product_code = '$productCode'"));
                    $totalPrice = $product['price'] * intval($quantities[$index]);

                    echo '<tr style="font-size:20px;text-align:center;">
                        <td>' . $product['product_name'] . '</td>
                      
                        <td>' . $quantities[$index] . '</td>
                        <td>Rs.' . $product['price'] . '</td>
                        <td>Rs.' . $totalPrice . '</td>
                    </tr>';
                }
                ?>
            </tbody>
        </table>
        <div class="bill-total">
            <b style="font-size:25px;">Total Amount: Rs.<?php echo $totalAmount; ?></b>
        </div>
        <div class="bill-footer">
            Thank you for choosing our hardware shop!
        </div>
    </div>
</body>
</html>



<script type="text/javascript">
    window.onafterprint = function(e){
    closePrintView();
};

function myFunction(){
    window.print();
}

function closePrintView() {

    window.location.href = 'bill_product.php';   
}
</script>
<script src="assets/js/jquery-3.6.0.min.js"></script>
            <script src="assets/js/feather.min.js"></script>
            <script src="assets/js/jquery.slimscroll.min.js"></script>
            <script src="assets/js/jquery.dataTables.min.js"></script>
            <script src="assets/js/dataTables.bootstrap4.min.js"></script>
            <script src="assets/js/bootstrap.bundle.min.js"></script>
            <script src="assets/plugins/select2/js/select2.min.js"></script>
            <script src="assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
            <script src="assets/plugins/sweetalert/sweetalerts.min.js"></script>
            <script src="assets/js/script.js"></script>
<!--     <button onclick="printBill()">Print Bill</button> -->