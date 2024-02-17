


<?php
// Include database connection
include('include/conn.php');

// Fetch data from bill and bill_product tables
$query = "SELECT bill.bill_date, bill.bill_number, bill_product.category, bill.total_amount FROM bill
          LEFT JOIN bill_product ON bill.bill_number = bill_product.bill_number";
$result = mysqli_query($con, $query);

// Prepare data for JSON response
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Close the database connection
mysqli_close($con);

// Return data as JSON
header('Content-Type: application/json');
echo json_encode($data);
?>
