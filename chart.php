<?php
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
    </style>
<div id="sales_chart_container" class="card-body">      
    <canvas id="sales_chart"></canvas>
</div>
<div id="month_legend" class="month-legend">
    <?php foreach ($monthYearData as $monthYear => $isDisplayed): ?>
        <p><?php echo $monthYear; ?></p>
    <?php endforeach; ?>
</div>





 <script src="assets\plugins\chartjs\chart.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<script>
    var salesData = <?php echo json_encode($salesData); ?>;

    var productNames = salesData.map(item => item.product_name);
    var totalQuantities = salesData.map(item => item.total_quantity_sold);

   var salesChart = new Chart(document.getElementById("sales_chart1"), {
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
