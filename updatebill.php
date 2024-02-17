<?php
include('include/conn.php');

if (isset($_POST['update_bill'])) {

  

    $billNumber = $_POST['bill_id'];

    extract($_POST);

$totalAmount = 0;
foreach ($_POST["product_name"] as $key => $product_name) {
     $product = $_POST["product_name"][$key];
     $price_input = $_POST["price_input"][$key];
     $category = $_POST["category"][$key];
     $brand = $_POST["brand"][$key];
     $quantity = $_POST["quantity"][$key];

     $total_price = $_POST["total_price"][$key];
     $product_code = $_POST["product_code"][$key];
     $total_price = $price_input * $quantity;

   $totalAmount += $total_price;
   $checkQuery = "SELECT * FROM bill_product WHERE bill_number = '$bill_id' AND product_name = '$product'";
    $checkResult = mysqli_query($con, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {



   $checkQuery1 = "SELECT * FROM bill_product WHERE bill_number = '$bill_id' AND product_name = '$product'";
    $checkResult1 = mysqli_query($con, $checkQuery1);

        if (mysqli_num_rows($checkResult1) > 0) {

     $updateQuery = "UPDATE bill_product 
                            SET product_name = '$product', per_piece_price = '$price_input',
                                category = '$category', brand = '$brand', quantity = '$quantity', total_price = '$total_price'
                            WHERE bill_number = '$billNumber' AND product_code = '$product_code'";
       $ro=  mysqli_query($con, $updateQuery);

        }
        else
        {
                $insertQuery = "INSERT INTO bill_product (bill_number, product_code, product_name, per_piece_price, category, brand, quantity, total_price)
                            VALUES ('$billNumber', '$product_code', '$product', '$price_input', '$category', '$brand', '$quantity', '$toal_price')";
            mysqli_query($con, $insertQuery);

        }

   // header("Location: all.php");
    }

    else
    {
        $insertQuery = "INSERT INTO bill_product (bill_number, product_code, product_name, per_piece_price, category, brand, quantity, total_price)
                            VALUES ('$billNumber', '$product_code', '$product', '$price_input', '$category', '$brand', '$quantity', '$toal_price')";
            mysqli_query($con, $insertQuery);

            // header("Location: all.php");

    }
$updateTotalAmountQuery = "
        UPDATE bill 
        SET total_amount = '$totalAmount', 
            customer_name = '$customer_name', 
            customer_mno = '$mobile_no', 
            customer_address = '$address' 
        WHERE bill_number = '$billNumber'";
    // mysqli_query($con, $updateTotalAmountQuery);
mysqli_query($con, $updateTotalAmountQuery);


}
 $billQuery = "SELECT b.*, bi.*, p.product_name, p.category, p.brand
                  FROM bill b
                  LEFT JOIN bill_product bi ON b.bill_number = bi.bill_number
                  LEFT JOIN products p ON bi.product_code = p.product_code
                  WHERE b.bill_number = '$billNumber'";
    $billResult = mysqli_query($con, $billQuery);

    if ($billResult && mysqli_num_rows($billResult) > 0) {
        // Start building the bill HTML
        $billHTML = '<html><head><title>Bill</title></head><body>';
        $billHTML .= '<h1>Bill</h1>';

        // Loop through the bill items and add them to the HTML
        while ($row = mysqli_fetch_assoc($billResult)) {
            $billHTML .= '<p>Product Name: ' . $row['product_name'] . '</p>';
            $billHTML .= '<p>Category: ' . $row['category'] . '</p>';
            $billHTML .= '<p>Brand: ' . $row['brand'] . '</p>';
            // Add more fields as needed
        }

        // Add the total amount to the bill
        $billHTML .= '<p>Total Amount: ' . $totalAmount . '</p>';

        // Close the HTML
        $billHTML .= '</body></html>';

        // Output the bill HTML or save it to a file
        echo $billHTML;
    }
    
}





// $productNames = $_POST['product_name'];
// $product_code = $_POST['product_code'];
// $product_quantity = $_POST['quantities'];

// $uniqueProductNames = array_unique($productNames);
// $uniqueProductCount = count($uniqueProductNames);


//     // Loop through the submitted product items
//     foreach ($_POST['product_items'] as $productCode => $productItem) {


//         $productName = $productItem['product_name'];
//         $perPiecePrice = $productItem['per_piece_price'];
//         $category = $productItem['category'];
//         $brand = $productItem['brand'];
//         $quantity = $productItem['quantity'];
//         $totalPrice = $productItem['total_price'];

//         // Check if the product exists in bill_product table
//         $checkQuery = "SELECT * FROM bill_product WHERE bill_number = '$billNumber' AND product_code = '$productCode'";
//         $checkResult = mysqli_query($con, $checkQuery);

//         if (mysqli_num_rows($checkResult) > 0) {



//             // Update existing product record in bill_product table
//             $updateQuery = "UPDATE bill_product 
//                             SET product_name = '$productName', per_piece_price = '$perPiecePrice',
//                                 category = '$category', brand = '$brand', quantity = '$quantity', total_price = '$totalPrice'
//                             WHERE bill_number = '$billNumber' AND product_code = '$productCode'";
//             mysqli_query($con, $updateQuery);
//         } else {
//             // Insert new product record into bill_product table
//             // $insertQuery = "INSERT INTO bill_product (bill_number, product_code, product_name, per_piece_price, category, brand, quantity, total_price)
//             //                 VALUES ('$billNumber', '$productCode', '$productName', '$perPiecePrice', '$category', '$brand', '$quantity', '$totalPrice') WHERE bill_number  =  '$billNumber'";
//             // mysqli_query($con, $insertQuery);
//         }

//         // Update product quantity in products table
//         $productUpdateQuery = "UPDATE products SET quantity = quantity - '$quantity' WHERE product_code = '$productCode'";
//         mysqli_query($con, $productUpdateQuery);
//     }


//                         if($productNames)
//                     {
//                         $p_name=implode('',$productNames);
//                           $p_code=implode('',$product_code);
//                           $p_qty=implode('',$product_quantity);
//                         for($i=0;$i<$uniqueProductCount;$i++)
//                         {
//                               echo $insertQuery = "INSERT INTO `bill_product` (`bill_number`, `product_code`, `product_name`, `per_piece_price`, `category`, `brand`, `quantity`, `total_price`) VALUES ('$billNumber', '$p_code', '$p_name', '$perPiecePrice', '$category', '$brand', '$p_qty', '$totalPrice')";
//                                 mysqli_query($con, $insertQuery);
//                         }

                        
//                     }        


//      $totalAmount += floatval($totalPrice);
//       $updateTotalAmountQuery = "UPDATE bill SET total_amount = '$totalAmount' WHERE bill_number = '$billNumber'";
//     mysqli_query($con, $updateTotalAmountQuery);


//     // Redirect back to the form or any other desired page
//     // header("Location: your_form_page.php");
//     exit;
// }
?>
