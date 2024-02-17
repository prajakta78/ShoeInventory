
<?php
session_start(); // Start the session to access user data
include('include/conn.php');

// Check if the user is authenticated
if (!isset($_SESSION['username'])) {
    // Redirect to the login page if the user is not logged in
    header("Location: login.php");
    exit(); // Ensure script execution stops after redirection
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Weekly Data Graph</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div style="width: 800px; height: 500px;">
        <canvas id="salesChart"></canvas>
    </div>
    <script>
        fetch('fetch_data.php')
            .then(response => response.json())
            .then(data => {
                const categories = [...new Set(data.map(item => Object.keys(item).filter(key => key !== 'week')).flat())];
                const datasets = categories.map(category => ({
                    label: category,
                    data: data.map(item => item[category] || 0),
                    backgroundColor: getRandomColor(),
                }));

                const labels = data.map(item => `Week ${item.week}`);

                const ctx = document.getElementById('salesChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: datasets,
                    },
                    options: {
                        scales: {
                            x: {
                                stacked: true,
                            },
                            y: {
                                stacked: true,
                                beginAtZero: true,
                            }
                        }
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
</body>
</html>


</body>
</html>

<?php
$userID = $_SESSION['name']; 
include('include/conn.php');
// Fetch product data from the database
$productQuery = "SELECT product_name, price FROM products WHERE created_by = '$userID'";
$productResult = mysqli_query($con, $productQuery);

$productData = [];
while ($row = mysqli_fetch_assoc($productResult)) {
    $productData[] = $row;
}
?>

<div id="sales_chart_container" class="card-body">
    <canvas id="sales_chart"></canvas>
</div>

     <script src="assets\plugins\chartjs\chart.min.js"></script>

<script>
var productData = <?php echo json_encode($productData); ?>;


var productNames = productData.map(item => item.product_name);
var prices = productData.map(item => item.price);

var salesChart = new Chart(document.getElementById("sales_chart"), {
    type: 'pie',
    data: {
        labels: productNames,
        datasets: [{
            data: prices,
            backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4CAF50']
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});
</script>
<?php include('include/conn.php');
$productQuery = "SELECT product_name, quantity FROM products";
$productResult = mysqli_query($con, $productQuery);

$productData = [];
while ($row = mysqli_fetch_assoc($productResult)) {
    $productData[] = $row;
}
?>
<div id="quantity_chart_container" class="card-body">
    <canvas id="quantity_chart"></canvas>
</div>

   <script src="assets\plugins\chartjs\chart.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
    var productData = <?php echo json_encode($productData); ?>;
var productNames = productData.map(item => item.product_name);
var quantities = productData.map(item => item.quantity);

var quantityChart = new Chart(document.getElementById("quantity_chart"), {
    type: 'pie',
    data: {
        labels: productNames,
        datasets: [{
            data: quantities,
            backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4CAF50']
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});
});
</script>
<?php 
include('include/conn.php');

// Fetch sales data from the database
$salesQuery = "SELECT product_name, DATE_FORMAT(billdate, '%Y-%m') AS sale_month, SUM(quantity) AS total_quantity_sold FROM bill_product GROUP BY product_name, sale_month";
$salesResult = mysqli_query($con, $salesQuery);

$salesData = [];
while ($row = mysqli_fetch_assoc($salesResult)) {
    $salesData[] = $row;
}
?>
<div id="monthly_sales_chart_container" class="card-body">
    <canvas id="monthly_sales_chart"></canvas>
</div>

 <script src="assets\plugins\chartjs\chart.min.js"></script>
<script>
var monthLabels = [...new Set(salesData.map(item => item.sale_month))];
var datasets = [];

salesData.forEach(item => {
    var datasetIndex = monthLabels.indexOf(item.sale_month);
    if (!datasets[datasetIndex]) {
        datasets[datasetIndex] = {
            label: item.sale_month,
            data: [],
            backgroundColor: getRandomColor()
        };
    }
    datasets[datasetIndex].data.push(item.total_quantity_sold);
});

var monthlySalesChart = new Chart(document.getElementById("monthly_sales_chart"), {
    type: 'pie',
    data: {
        labels: monthLabels,
        datasets: datasets
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});

function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}
</script>







