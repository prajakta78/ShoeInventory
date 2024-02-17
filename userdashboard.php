
<?php
session_start();

include('include/conn.php');
// Fetch sales data from the database
$salesQuery = "SELECT bp.product_name, YEAR(b.bill_date) AS sale_year, MONTH(b.bill_date) AS sale_month, SUM(bp.total_price) AS total_quantity_sold
               FROM bill_product bp
               JOIN bill b ON bp.bill_number = b.bill_number
               GROUP BY bp.product_name, sale_year, sale_month
               ORDER BY sale_year, sale_month";
$salesResult = mysqli_query($con, $salesQuery);

$salesData = [];
$monthYearData = [];

while ($row = mysqli_fetch_assoc($salesResult)) {
    $row['month_name'] = date('F', mktime(0, 0, 0, $row['sale_month'], 1));
    // $monthYear = $row['sale_year'] . ' ' . ;
     $monthYear = $row['month_name']. ' ' .  $row['sale_year'];


    // Check if the month and year combination has already been stored
    if (!isset($monthYearData[$monthYear])) {
        $monthYearData[$monthYear] = true;
    }

    // Store the data point for the pie chart
    $salesData[] = $row;
}


?>

<?php
// error_reporting(0);
session_start();
include('include/conn.php'); // Include your database connection

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
	 echo '<script type ="text/JavaScript">';
echo 'alert(" You need log in first!!! ");window.location.href = "index.php"';
echo '</script>';
    // header("Location: index.php");
    exit();
} 


if (isset($_SESSION['subscription_expired']) && $_SESSION['subscription_expired'] === true) {
    // echo "Your subscription has expired.";
     echo '<script type ="text/JavaScript">';
echo 'alert(" Your subscription is expired!!! ");window.location.href = "renew_subscription.php"';
echo '</script>';
    // echo "<br><a href='renew_subscription.php'>Renew Subscription</a>";
} else {
    // Display dashboard content
//       echo '<script type ="text/JavaScript">';
// echo 'alert("Welcome to Dashboard ");';
// echo 'window.location.href = "dashboard.php";';
echo '</script>';
}
?>
<?php include('include/sidebar.php');?>
<style>
      .month-legend {
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: bold;
    }
    .month-legend p {
        margin: 0 10px;
    }
   			
					.navbar {
            background-color: #fff;
            color: black;
            padding: 10px;
            /*width: 1200px;*/
            margin-left: 20px;
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
           <h3>User Dashboard</h3>
        </div>
    </div>
					<div class="content">
						<div class="row">
							<div class="col-lg-3 col-sm-6 col-12">
								<div class="dash-widget">
									<div class="dash-widgetimg">
										<span><img src="assets/img/icons/dash1.svg" alt="img"></span>
									</div>
									<div class="dash-widgetcontent">
										 <?php
										 $username = $_SESSION['name'];
										 include('include/conn.php');

                   date_default_timezone_set("Asia/Calcutta");
                   // $cdate=date("Y-m-d");
                   $name2= "SELECT sum(total_amount) FROM bill WHERE username = '$username'";
                   $query=mysqli_query($con,$name2);
                   $row = mysqli_fetch_array($query);
                   ?>
										<h5><span class="counters"><?php echo '' . $row[0]; ?></span></h5>
										<h6>Total Sale</h6>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-sm-6 col-12">
								<div class="dash-widget dash1">
									<div class="dash-widgetimg">
										<span><img src="assets/img/icons/dash2.svg" alt="img"></span>
									</div>
									<?php 
									 $username = $_SESSION['name'];
									include('include/conn.php');
                  date_default_timezone_set("Asia/Calcutta");
                  $month=date('m');
                  $name2= "SELECT sum(total_amount) FROM bill where month(bill_date)='$month' AND username = '$username' ORDER BY bill_number DESC";
                  $query=mysqli_query($con,$name2);
                  $rows = mysqli_fetch_array($query);   
                  ?>
									<div class="dash-widgetcontent">
										<h5><span class="counters"><?php echo '' . $rows[0]; ?></span></h5>
										<h6> Monthly Total  Sale</h6>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-sm-6 col-12">
								<div class="dash-widget dash2">
									<div class="dash-widgetimg">
										<span><img src="assets/img/icons/dash3.svg" alt="img"></span>
									</div>
									
                  <?php
                   $username = $_SESSION['name'];
include('include/conn.php'); // Include your database connection

// Get today's date in the format 'Y-m-d'
$todayDate = date('Y-m-d');

// Query to retrieve sales data for today
$query = "SELECT SUM(total_amount) AS total_sales FROM bill WHERE DATE(bill_date) = '$todayDate' AND username = '$username'";
$result = mysqli_query($con, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalSales = $row['total_sales'];
} else {
    echo "Error: " . mysqli_error($con);
}
?>

									<div class="dash-widgetcontent">
										<h5><span class="counters"><?php echo '' . $totalSales; ?></span></h5>
										<h6>Today Sale Amount</h6>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-sm-6 col-12">
								<!-- <div class="dash-widget dash3">
									<div class="dash-widgetimg">
										<span><img src="assets/img/icons/dash4.svg" alt="img"></span>
									</div>
									<div class="dash-widgetcontent">
										<h5>$<span class="counters" data-count="40000.00">400.00</span></h5>
										<h6>Total Sale Amount</h6>
									</div>
								</div> -->
							</div>
							<div class="col-lg-3 col-sm-6 col-12 d-flex">
								<div class="dash-count">
									<div class="dash-counts">
										<?php
										  $username = $_SESSION['name'];
include('include/conn.php'); // Include your database connection

// Query to count the total number of products
$query = "SELECT COUNT(*) AS total_products FROM products WHERE created_by = '$username'";
$result = mysqli_query($con, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalProducts = $row['total_products'];
} else {
    echo "Error: " . mysqli_error($con);
}
?>
										<h4><?php echo $totalProducts; ?></h4>
										<h5>Products</h5>
									</div>
									<div class="dash-imgs">
										<i data-feather="user"></i>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-sm-6 col-12 d-flex">
								<div class="dash-count das1">
									<div class="dash-counts">
											<?php
include('include/conn.php'); // Include your database connection

// Query to count the total number of products
$query = "SELECT COUNT(*) AS total_products FROM category";
$result = mysqli_query($con, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalProducts = $row['total_products'];
} else {
    echo "Error: " . mysqli_error($con);
}
?>
										<h4><?php echo $totalProducts; ?></h4>
										<h5>Categories</h5>
									</div>
									<div class="dash-imgs">
										<i data-feather="user-check"></i>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-sm-6 col-12 d-flex">
								<div class="dash-count das2">
									<div class="dash-counts">
												<?php
include('include/conn.php'); // Include your database connection

// Query to count the total number of products
$query = "SELECT COUNT(*) AS total_products FROM brands";
$result = mysqli_query($con, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalProducts = $row['total_products'];
} else {
    echo "Error: " . mysqli_error($con);
}
?>
										<h4><?php echo $totalProducts; ?></h4>
										<h5>Brands</h5>
									</div>
									<div class="dash-imgs">
										<i data-feather="file-text"></i>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-sm-6 col-12 d-flex">
								<div class="dash-count das3">
									<div class="dash-counts">
												<?php
												  $username = $_SESSION['name'];
include('include/conn.php'); // Include your database connection

// Query to count the total number of products
 $query = "SELECT COUNT(*) AS total_products FROM bill WHERE username = '$username'"; 
$result = mysqli_query($con, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalProducts = $row['total_products'];
} else {
    echo "Error: " . mysqli_error($con);
}
	?>									<h4><?php echo $totalProducts; ?></h4>
										<h5>Sales Invoice</h5>
									</div>
									<div class="dash-imgs">
										<i data-feather="file"></i>
									</div>
								</div>
							</div>
						</div>
						 <div class="row">
							<div class="col-lg-6 col-sm-12 col-12 d-flex">
								<div class="card flex-fill">
									<div class="card-header pb-0 d-flex justify-content-between align-items-center">
										<h5 class="card-title mb-0">Purchase & Sales</h5>
										<!-- <div class="graph-sets">
											<ul>
												<li>
													<span>Sales</span>
												</li>
												<li>
													<span>Purchase</span>
												</li>
											</ul>
											<div class="dropdown">
												<button class="btn btn-white btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
												2022 <img src="assets/img/icons/dropdown.svg" alt="img" class="ms-2">
												</button>
												<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
													<li>
														<a href="javascript:void(0);" class="dropdown-item">2022</a>
													</li>
													<li>
														<a href="javascript:void(0);" class="dropdown-item">2021</a>
													</li>
													<li>
														<a href="javascript:void(0);" class="dropdown-item">2020</a>
													</li>
												</ul>
											</div>

										</div> -->
										  
									</div>
									<div class="card-body">
										  <canvas id="salesChart"></canvas>
										<!-- <div id="sales_charts"></div> -->
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-sm-12 col-12 d-flex">
								<div class="card flex-fill">
									<div class="card-header pb-0 d-flex justify-content-between align-items-center">
										<h5 class="card-title mb-0">Monthly Sale</h5>
										<!-- <div class="graph-sets">
											<ul>
												<li>
													<span>Sales</span>
												</li>
												<li>
													<span>Purchase</span>
												</li>
											</ul>
											<div class="dropdown">
												<button class="btn btn-white btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
												2022 <img src="assets/img/icons/dropdown.svg" alt="img" class="ms-2">
												</button>
												<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
													<li>
														<a href="javascript:void(0);" class="dropdown-item">2022</a>
													</li>
													<li>
														<a href="javascript:void(0);" class="dropdown-item">2021</a>
													</li>
													<li>
														<a href="javascript:void(0);" class="dropdown-item">2020</a>
													</li>
												</ul>
											</div>

										</div> -->
										  
									</div>
									<div class="card-body">
										 <div id="sales_chart_container" class="card-body">      
    <canvas id="sales_chart"></canvas>
</div>
<div id="month_legend" class="month-legend">
    <?php foreach ($monthYearData as $monthYear => $isDisplayed): ?>
        <p><?php echo $monthYear; ?></p>
    <?php endforeach; ?>
</div>
										<!-- <div id="sales_charts"></div> -->
									</div>
								</div>
							</div>
							
						</div>
					<!-- 	<div class="card mb-0">
							<div class="card-body">
								<h4 class="card-title">Expired Products</h4>
								<div class="table-responsive dataview">
									<table class="table datatable ">
										<thead>
											<tr>
												<th>SNo</th>
												<th>Product Code</th>
												<th>Product Name</th>
												<th>Brand Name</th>
												<th>Category Name</th>
												<th>Expiry Date</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>1</td>
												<td><a href="javascript:void(0);">IT0001</a></td>
												<td class="productimgname">
													<a class="product-img" href="productlist.html">
														<img src="assets/img/product/product2.jpg" alt="product">
													</a>
													<a href="productlist.html">Orange</a>
												</td>
												<td>N/D</td>
												<td>Fruits</td>
												<td>12-12-2022</td>
											</tr>
											<tr>
												<td>2</td>
												<td><a href="javascript:void(0);">IT0002</a></td>
												<td class="productimgname">
													<a class="product-img" href="productlist.html">
														<img src="assets/img/product/product3.jpg" alt="product">
													</a>
													<a href="productlist.html">Pineapple</a>
												</td>
												<td>N/D</td>
												<td>Fruits</td>
												<td>25-11-2022</td>
											</tr>
											<tr>
												<td>3</td>
												<td><a href="javascript:void(0);">IT0003</a></td>
												<td class="productimgname">
													<a class="product-img" href="productlist.html">
														<img src="assets/img/product/product4.jpg" alt="product">
													</a>
													<a href="productlist.html">Stawberry</a>
												</td>
												<td>N/D</td>
												<td>Fruits</td>
												<td>19-11-2022</td>
											</tr>
											<tr>
												<td>4</td>
												<td><a href="javascript:void(0);">IT0004</a></td>
												<td class="productimgname">
													<a class="product-img" href="productlist.html">
														<img src="assets/img/product/product5.jpg" alt="product">
													</a>
													<a href="productlist.html">Avocat</a>
												</td>
												<td>N/D</td>
												<td>Fruits</td>
												<td>20-11-2022</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div> -->
					</div>
				</div>
			</div>
			 <script>

        fetch('fetch_data.php')
            .then(response => response.json())
            .then(data => {
            	 console.log('Fetched data:', data);
                const categories = [...new Set(data.map(item => item.category))];
                const datasets = categories.map(category => ({
                    label: category,
                    data: data.filter(item => item.category === category).map(item => item.total_amount),
                    backgroundColor: getRandomColor(),
                    fill: false,
                }));

                const labels = data.map(item => `${item.bill_date}`);

                const ctx = document.getElementById('salesChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: datasets,
                    },
                    options: {
                        // Customize chart options
                    },
                });
            })
            .catch(error => console.error('Error fetching data:', error));

        function getRandomColor() {
            const letters = '0123456789ABCDEF';
            let color = '#';
            for (let i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }
    </script>
     <script src="assets\plugins\chartjs\chart.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<script>
    var salesData = <?php echo json_encode($salesData); ?>;

    var productNames = salesData.map(item => item.product_name);
    var totalQuantities = salesData.map(item => item.total_quantity_sold);

   var salesChart = new Chart(document.getElementById("sales_chart"), {
    type: 'pie',
    data: {
        labels: productNames,
        datasets: [{
            data: totalQuantities,
            backgroundColor: getRandomColors1(productNames.length)
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        tooltips: {
    callbacks: {
        title: function(tooltipItem, data) {
            var dataIndex = tooltipItem[0].index;
            var product = data.labels[dataIndex];
            var monthData = salesData.find(item => item.product_name === product);
            return product + ' - ' + monthData.month_name;
        },
        label: function(tooltipItem, data) {
            var quantity = data.datasets[0].data[tooltipItem.index];
            return 'Quantity: ' + quantity;
        }
    }
}
    }

});
   




    function getRandomColors1(count) {
        var colors = [];
        for (var i = 0; i < count; i++) {
            colors.push(getRandomColor1());
        }
        return colors;
    }

    function getRandomColor1() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }
</script>

			<script src="assets/js/jquery-3.6.0.min.js"></script>
			<script src="assets/js/feather.min.js"></script>
			<script src="assets/js/jquery.slimscroll.min.js"></script>
			<script src="assets/js/jquery.dataTables.min.js"></script>
			<script src="assets/js/dataTables.bootstrap4.min.js"></script>
			<script src="assets/js/bootstrap.bundle.min.js"></script>
			<script src="assets/plugins/apexchart/apexcharts.min.js"></script>
			<script src="assets/plugins/apexchart/chart-data.js"></script>
			<script src="assets/js/script.js"></script>
		</body>
	</html>
