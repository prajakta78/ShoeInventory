<?php
include('include/sidebar.php');

include('include/conn.php');
// Include your database connection code here (e.g., include('include/conn.php'))

// Check if the 'bill_number' parameter is set in the URL
if (isset($_GET['bill_number'])) {
    $bill_number = $_GET['bill_number'];

    // Query to fetch detailed bill information
    $query = "SELECT b.bill_number, b.bill_date, b.username, b.bill_date,
                     p.product_name, p.category, p.brand, bp.quantity AS sold_quantity, bp.total_price AS sale_amount
              FROM bill b
              INNER JOIN bill_product bp ON b.bill_number = bp.bill_number
              INNER JOIN products p ON bp.product_code = p.product_code
              WHERE b.bill_number = '$bill_number'";

    $result = mysqli_query($con, $query);
?>
  <div class="page-wrapper">
                    <div class="navbar">
        <div class="navbar-header">
           <h3>Advanced Report</h3>
        </div>
    </div>
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Sales Report</h4>
                <h6>Manage your Sales Report</h6>

            </div>
             <a href="advancedreport.php" class="btn btn-primary">Back</a> 
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-top">
    <!-- <h4>Bill Details - <?php echo $bill_number; ?></h4> -->
    <table class='table'>
        <thead>
            <tr> <th>Bill Number</th>
                <th>Product Name</th>
                <th>Category</th>
                <th>Brand</th>
                 <th>Date</th>
                   <th>Username</th>
                <th>Sold Quantity</th>
                <th>Sale Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>{$row['bill_number']}</td>";
                    echo "<td>{$row['product_name']}</td>";
                    echo "<td>{$row['category']}</td>";
                    echo "<td>{$row['brand']}</td>";

                     echo "<td>{$row['bill_date']}</td>";
                      echo "<td>{$row['username']}</td>";
                    echo "<td>{$row['sold_quantity']}</td>";
                    echo "<td>{$row['sale_amount']}</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No data available for this bill.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <br>
  <!-- Provide the link to your sales report page -->
    <!-- Include your additional content or styling here -->
</body>
</html>
<?php
} else {
    echo "Invalid request. Please specify a bill number.";
}
?>
  </div>
        </div>
    </div>
</div>
<script src="assets/js/jquery-3.6.0.min.js"></script>
<!-- ... (rest of your JavaScript imports and code) ... -->
</body>
</html>

<script src="assets/js/jquery-3.6.0.min.js"></script>
            <script src="assets/js/feather.min.js"></script>
            <script src="assets/js/jquery.slimscroll.min.js"></script>
            <script src="assets/js/jquery.dataTables.min.js"></script>
            <script src="assets/js/dataTables.bootstrap4.min.js"></script>
            <script src="assets/js/bootstrap.bundle.min.js"></script>
            <script src="assets/js/moment.min.js"></script>
            <script src="assets/js/bootstrap-datetimepicker.min.js"></script>
            <script src="assets/plugins/select2/js/select2.min.js"></script>
            <script src="assets/js/moment.min.js"></script>
            <script src="assets/js/bootstrap-datetimepicker.min.js"></script>
            <script src="assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
            <script src="assets/plugins/sweetalert/sweetalerts.min.js"></script>
            <script src="assets/js/script.js"></script>
        </body>
    </html>