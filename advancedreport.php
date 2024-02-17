<?php

session_start();
error_reporting(0);
$username=$_SESSION["name"];

if($username!="")
{
?>
<?php include('include/sidebar.php');?>
<?php include('include/conn.php');?>

<style>

                    .navbar {
            background-color: #fff;
            color: black;
            padding: 10px;
            /*width: 1200px;*/
            margin-left: 20px;
              margin-right: 20px;
            margin-top: 10px;
            justify-content: center;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
        }

        .navbar a {
            color: black;
            text-decoration: none;

        }

       
    </style>                





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
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-top">
                    <!-- Add a dropdown for selecting user's name -->
                    <form method="post" action="#">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="user_name">Select User</label>
                                <select class="form-control" name="user_name">
                                    <option value="">Select User</option>
                                    <?php
                                    // Fetch user names from your user table and populate the dropdown
                                    $user_query = "SELECT DISTINCT name FROM users"; // Replace 'users' with your actual user table name
                                    $user_result = mysqli_query($con, $user_query);

                                    if ($user_result) {
                                        while ($user_row = mysqli_fetch_assoc($user_result)) {
                                            echo "<option value='{$user_row['name']}'>{$user_row['name']}</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="start_date">Start Date</label>
                                <input type="date" class="form-control" name="start_date" required>
                            </div>
                            <div class="col-md-4">
                                <label for="end_date">End Date</label>
                                <input type="date" class="form-control" name="end_date" required>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" name="submit" class="btn btn-primary mt-4">Generate Report</button>
                            </div>
                        </div>
                    </form>
                </div>

                <?php
                if (isset($_POST['submit'])) {
                    $user_name = $_POST['user_name'];
                    $start_date = $_POST['start_date'];
                    $end_date = $_POST['end_date'];

                    // Modify your SQL query to include the user filter
                    $query = "SELECT
                        b.bill_number,
                        b.bill_date,
                        p.product_name,
                        p.category,
                        p.brand,
                        b.username,
                        bp.quantity AS sold_quantity,
                        bp.total_price AS sale_amount,
                        p.quantity AS original_quantity,
                        p.quantity AS remaining_quantity
                    FROM
                        bill b
                    INNER JOIN
                        bill_product bp ON b.bill_number = bp.bill_number
                    INNER JOIN
                        products p ON bp.product_code = p.product_code
                    WHERE
                        b.bill_date BETWEEN '$start_date' AND '$end_date'";

                    // Add the user filter if a user is selected
                    if (!empty($user_name)) {
                        $query .= " AND b.username = '$user_name'";
                    }

                    $query .= " ORDER BY b.bill_number, p.product_name;"; // Order by bill number and product name

                    $result = mysqli_query($con, $query);

                    $current_bill_number = null; ?> 
    <table class='table'>                 <!-- To keep track of the current bill -->
 <thead>
            <tr>
                <th>Bill Number</th>
                <th>Bill Date</th>
                <th>Username</th>
                 <th>Action</th>
                 
            </tr>
        </thead>
                    <?php if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            if ($row['bill_number'] !== $current_bill_number) {
                                // Display the bill number in a table
                              
                                
                                echo "<tbody>";
                                $current_bill_number = $row['bill_number'];
                            }
                            // Display the product details for the current bill in the table
                            echo "<tr>";
                            echo "<tr>";
                                echo "<td>{$row['bill_number']}</td>";
                                echo "<td>{$row['bill_date']}</td>";
                                echo "<td>{$row['username']}</td>";
                                
                                echo "<td><a href='view_bill.php?bill_number={$row['bill_number']}' class='btn btn-primary'>View</a></td>"; // Add a link/button to view the bill
                                echo "</tr>";

                            echo "</tr>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                    }
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
     <?php } 

   else
    {
        echo '<script type ="text/JavaScript">';
echo 'alert(" You need log in first!!! ");window.location.href = "index.php"';
echo '</script>';
    }?>