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
           <h3>Advanced Product Report</h3>
        </div>
    </div>
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Product Report</h4>
                <h6>Userwise Product Report</h6>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <!-- <div class="table-top"> -->
                    <!-- Add a dropdown for selecting user's name -->
                    <form method="post" action="#">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="user_name">Select User</label>
                                <select class="form-control select" name="user_name">
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
                            <div class="col-md-6">
                                <button type="submit" name="submit" class="btn btn-primary mt-4">Generate Report</button>
                            </div>
                        </div>
                    </form>
                </div>

                <?php
                if (isset($_POST['submit'])) {
                    $user_name = $_POST['user_name'];

                    // Modify your SQL query to include the user filter
                    $query = "SELECT * FROM products WHERE created_by = '$user_name'";

                    $result = mysqli_query($con, $query);
                ?>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <h4>Product Report for User: <?php echo $user_name; ?></h4>
                            <tr>
                                <th>Product Image</th>
                                                    <th>Product Name</th>
                                                    <th>Category Name </th>
                                                    <th>Brand Name</th>
                                                    <th>Supplier Name</th>
                                                    <th>Product Code</th>
                                                    <th>Qty</th>
                                                    <th>Created by</th>
                                                    <th>Description</th>
                                                    <th>Price</th>
                            </tr>
                        </thead>
                        <tbody><?php 
                            while ($row = mysqli_fetch_array($result)) { ?>

                                                <tr>
                                                    <!-- <td>
                                                        <label class="checkboxs">
                                                            <input type="checkbox">
                                                            <span class="checkmarks"></span>
                                                        </label>
                                                    </td> -->
                                                    <td class="productimgname">
                                                        
                                                <img src="productimg/<?php echo $row['product_image'];?>" width="70" height="70" alt="product">
                                                        
                                                        <!-- <a href="javascript:void(0);">Macbook pro</a> -->
                                                    </td>
                                                    <td><?php echo $row['product_name']?></td>
                                                    <td><?php echo $row['category']?></td>
                                                    <td><?php echo $row['brand']?></td>
                                                    <td><?php echo $row['supplier_name']?></td>

                                                    <td><?php echo $row['product_code']?></td>
                                                    <td><?php echo $row['quantity']?></td>
                                                    <td><?php echo $row['created_by']?></td>
                                                    <td><?php echo substr($row['description'],0,20);?></td>
                                                    <td><?php echo $row['price']?></td>
                                                    <td></td>
                                                </tr>
                                            <?php }  } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
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
