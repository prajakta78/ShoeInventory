<?php include('include/conn.php');
if(isset($_POST['Generate_report'])){
$startDate = $_POST['start_date'];
$endDate = $_POST['end_date'];

// Query to retrieve aggregated sales data within the specified date range
$query = "
    SELECT
        p.product_name,
        p.category,
        p.brand,
        SUM(bp.quantity) AS total_sold_quantity,
        SUM(bp.total_price) AS total_sale_amount,
        p.quantity AS original_quantity,
        p.quantity  AS remaining_quantity
    FROM
        bill b
    INNER JOIN
        bill_product bp ON b.bill_number = bp.bill_number
    INNER JOIN
        products p ON bp.product_code = p.product_code
    WHERE
        b.bill_date BETWEEN '$startDate' AND '$endDate'
    GROUP BY
        p.product_name, p.category, p.brand, p.quantity
    ORDER BY
        total_sale_amount DESC;
";

$result = $con->query($query);



// Generate HTML for the sales report
$salesReport = "<h2>Sales Report ($startDate to $endDate)</h2>";
$salesReport .= "<table border='1'>
    <tr>
        <th>Product Name</th>
        <th>Category</th>
        <th>Brand</th>
        <th>Total Sold Quantity</th>
        <th>Total Sale Amount</th>
        <th>Available Quantity</th>
    </tr>";

if ($result->num_rows > 0) {
   while ($row = $result->fetch_assoc()) {
    $salesReport .= "<tr>
        <td>{$row['product_name']}</td>
        <td>{$row['category']}</td>
        <td>{$row['brand']}</td>
        <td>{$row['total_sold_quantity']}</td>
        
        <td>{$row['total_sale_amount']}</td>
        <td>{$row['remaining_quantity']}</td>
    </tr>";
}
} else {
    $salesReport .= "<tr><td colspan='6'>No sales data available</td></tr>";
}

$salesReport .= "</table>";
}
// Close the database connection
// $conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sales Report</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <form method="post">
        Start Date: <input type="date" name="start_date" required>
        End Date: <input type="date" name="end_date" required>
        <input type="submit" name="Generate_report" value="Generate Report">
    </form>
    <?php echo $salesReport; ?>

</body>
</html>