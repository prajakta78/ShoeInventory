<?php

session_start();
error_reporting(0);
$username=$_SESSION["name"];

if($username!="")
{
?>

<?php include('include/conn.php');?>
<?php include('include/sidebar.php');?>
<style>
	body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

h1 {
    text-align: center;
}

#items_table {
    width: 100%;
    border-collapse: collapse;
}

#items_table th,
#items_table td {
    padding: 8px;
    border: 1px solid #ddd;
    text-align: left;
}
 td {
    padding: 8px;
    border: 1px solid #ddd;
    text-align: left;
}
#items_table th {
    background-color: #f2f2f2;
}

.input-container {
    display: flex;
    align-items: center;
}

.input-container input,
.input-container select {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.button-container {
    text-align: center;
    margin-top: 10px;
}

.button-container button {
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.button-container button:hover {
    background-color: #0056b3;
}
.form-group {
    margin: 0; /* Remove default margin */
    width: 100%; /* Fill the entire width */
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
}
.form-control:disabled, .form-control[readonly] {
    background-color: #e9ecef;
    opacity: 1;
}
.mt{
	padding-top:100;
}
 

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





              




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    
// Initialize an array to store added product codes
var addedProductCodes = [];

function fetchProductInfo(inputElement) {
    var row = $(inputElement).closest('tr');
    var productCode = $(inputElement).val();

    // Check if the product code is already in the array
    if (addedProductCodes.includes(productCode)) {
        alert('This product code has already been added to the bill.');
        return; // Exit the function, don't make the AJAX request
    }

    $.ajax({
        type: "POST",
        url: "get_product_details.php",
        data: { product_code: productCode },
        success: function(data) {
            var product = JSON.parse(data);
            console.log(data);
            row.find('#product_name').val(product.product_name);
            row.find('#category').val(product.category);
            row.find('#brand').val(product.brand);
            row.find('#available_quantity').val(product.quantity);

            row.find('#price_input').val(product.price);
            var stockStatus = product.quantity >= 0 ? "In Stock" : "Out of Stock";
            row.find('#stock_status').text(stockStatus);

            if (stockStatus === "Out of Stock") {
                alert('This product is currently out of stock.');
            } else {
                // Add the product code to the array
                addedProductCodes.push(productCode);
            }
        },
        error: function() {
            alert('Product not found');
        }
    });
}

function calculateTotal() {
    var totalBillAmount = 0;

    // Iterate through each row
    $('.quantity_input').each(function() {
        var row = $(this).closest('tr');
        var quantity = parseFloat($(this).val()) || 0;
        var price = parseFloat(row.find('.price_input').val()) || 0;
        var total = quantity * price;

        // Update the total input field in the same row
        row.find('.total_input').val(total);

        totalBillAmount += total; // Accumulate the total amount
    });

    // Update the total amount in the bill
    $('#total_amount').text(totalBillAmount.toFixed(2));
}


function deleteRow(row) {
    $(row).remove();
     calculateTotal(); 
}
 
$(document).ready(function() {
    var productCode = $('#product_code').val();
    var isProductAdded = false;

    $('.product_code_input').each(function() {
        if ($(this).val() === productCode) {
            isProductAdded = true;
            return false; // Exit the loop
        }
    });

    if (isProductAdded) {
        alert('This product has already been added to the bill.');
        return; // Exit the function, don't add the product again
    }
});



$(document).ready(function() {
var billProductCodes = [];
    $(document).on('input', '.quantity_input', function() {
        var totalBillAmount = 0;

        // Iterate through each row
        $('.quantity_input').each(function() {
            var row = $(this).closest('tr');
            var quantity = parseFloat($(this).val()) || 0;
            var price = parseFloat(row.find('.price_input').val()) || 0;
            var total = quantity * price;

            // Update the total input field in the same row
            row.find('.total_input').val(total);

            totalBillAmount += total; // Accumulate the total amount
        });

        // Update the total amount in the bill
        $('#total_amount').text(totalBillAmount.toFixed(2));
    });

$('#add_item').click(function() {
       var productCode = $('#product_code').val();
    
    
    //  var productCode = $('#product_code').val();


    // var isProductAdded = false;
    // $('.product_code_input').each(function() {
    //     if ($(this).val() === productCode) {
    //         isProductAdded = true;
    //         return false; 
    //     }
    // });

    // if (isProductAdded) {
    //     alert('This product has already been added to the bill.');
    //     return; // Exit the function, don't add the product again
    // }

    // // Add the product code to the array
    // billProductCodes.push(productCode);
var newRow = `<tr>
	<td>
                <div class="input-container">
                <div id="quantity_error" class="text-danger" style="display: none;">Entered quantity exceeds available quantity!</div>


                    <input type="text" class="product_code_input" id="product_code" name="product_codes[]" required onkeypress="return RestrictSpace()" onchange="fetchProductInfo(this)">
                </div>
            </td>
            <td><input class="form-control" type="text" id="product_name" name="product_names[]" readonly></td>
           <td><input type="number" class="form-control price_input" id="price_input" name="prices[]" readonly></td>
            <td><input type="text"  class="form-control" id="category" name="category[]" required></td>&nbsp;&nbsp;&nbsp;&nbsp;
			<td><input type="text"  class="form-control" id="brand" name="brand[]"  required></td>&nbsp;&nbsp;&nbsp;&nbsp;
            <td><input type="number" class="form-control quantity_input" id="quantity_input" name="quantities[]"oninput="this.value = this.value.replace(/[^0-9]/g, '');" required></td>
            <td><input type="number" class="form-control " id="available_quantity" name="available_quantity[]" required readonly></td>

            <td><input type="number" class="form-control total_input" id="total" name="total[]" readonly></td>
            <td id="stock_status"></td>`;


        
         newRow += `<td><button class="fa fa-trash text-danger" onclick="deleteRow(this.closest('tr'))"></button></td>`;
                        newRow += `</tr>`;

               

$('#items_table tbody').append(newRow);
 updateTotalAmount();
   billProductCodes.push(productCode);
});
function updateTotalAmount() {
        var totalBillAmount = 0;

        // Iterate through each row
        $('#quantity_input').each(function() {
            var row = $(this).closest('tr');
            var quantity = parseFloat($(this).val()) || 0;
            var price = parseFloat(row.find('#price_input').val()) || 0;
            var total = quantity * price;

            // Update the total input field in the same row
            row.find('#total').val(total.toFixed(2));

            totalBillAmount += total; // Accumulate the total amount
        });

        // Update the total amount in the bill
        $('#total_amount').text(totalBillAmount.toFixed(2));
    }
$('form').submit(function(event) {
    
    var outOfStock = false;
    $('#stock_status').each(function() {
        if ($(this).text() === "Out of Stock") {
            outOfStock = true;
            return false;
        }
    });

    var totalAmount = parseFloat($('#total_amount').text());

    if (outOfStock) {
        alert('Please remove out-of-stock products before generating the bill.');
        event.preventDefault();
    } else if (totalAmount <= 0) {
        alert('Total amount should be greater than zero to generate the bill.');
        event.preventDefault();
    }

});


});
</script>

<script>

	$(document).ready(function() {
    var quantityExceeded = false; // Flag to track quantity exceeding

    $(document).on('input', '.quantity_input', function() {
        $('#quantity_error').hide();

        var row = $(this).closest('tr');
        var quantity = parseFloat($(this).val()) || 0;
        var availableQuantity = parseFloat(row.find('#available_quantity').val()) || 0;

        if (quantity > availableQuantity) {
            $('#quantity_error').show();
            quantityExceeded = true; // Set the flag to true
        } else {
            quantityExceeded = false; // Reset the flag to false
        }

        // Rest of your code
    });

    $('form').submit(function(event) {
        if (quantityExceeded) {
            alert('Entered quantity exceeds available quantity. Please correct the quantities before generating the bill.');
            event.preventDefault(); // Prevent form submission
        }
    });

    // Rest of your code
});

	</script>

  <div class="page-wrapper">
    <div class="navbar">
        <div class="navbar-header">
           <h3>Create New Bill</h3>
        </div>
    </div>
	<div class="content">
		<!-- <div class="page-header">
			<div class="page-title">
				<h4>Product Bill</h4>
				<h6>Create new Bill</h6>
			</div>
		</div> -->
		<form method="post" action="generate_bill.php">
			<div class="card" >
				<div class="card-body">
					<div class="row">
						<div class="col-sm-6 pb-5">
                            <input type="hidden" name="user" value="<?php echo $username?>">
							<label for="name"><b>Customer Name</b></label>
						<input type="text"  class="form-control" id="customer_name" name="customer_name" placeholder="Enter Customer Name" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '').replace(/(\..*)\./g, '$1');"  pattern="([^\s][A-z0-9À-ž\s]+)" title="Enter Alphabets Only" required></div>
						<div class="col-sm-6 pb-5">
							<label for="name"><b>Customer Mobile No.</b></label>
					   <input type="text" class="form-control" id="customer_mno" name="customer_mno"  placeholder="Enter Customer Mobile No."  pattern="[0-9]{10}"  required></div>
					   <div class="col-sm-6 pb-5">
					   	<label for="name"><b>Invoice Date</b></label>
						<input type="text"  class="form-control" id="date" name="date" readonly></div>
					   <div class="col-sm-6 pb-5">
                     <label for="name"><b>Customer Address</b></label>
						<input type="text" id="address"  oninput="removeLeadingSpaces()" class="form-control" id="customer_address" name="customer_address" required placeholder="Enter Customer Address">
					</div><br>
<style>
	th{
		font-weight:600;
	}
</style>
						<!-- <form method="post" action="#"> -->
							<table id="items_table" class="table table-responsive"style="margin-top:100px;">

								<thead>
									<tr>
										<th>Code</th>
										<th>Product Name</th>
										<th>Price</th>

										
										<th>Category</th>
										<th> Brand Name</th>
										<th>Quantity</th>
										<th>Available Quantity</th>
										<th>Total</th>
										<th>Status</th>
									</tr>

								</thead>

								<tbody>
									<tr>
										<td>
										 <div class="input-container">
<div id="quantity_error" class="text-danger" style="display: none;">Entered quantity exceeds available quantity!</div>

											<input type="hidden" name="user" value="<?php echo $username;?>">
											<input type="text" class="form-control" id="product_code" name="product_codes[]" required  onkeypress="return RestrictSpace()" onchange="fetchProductInfo(this)">
											<!--   <button type="button"  id="fetch_product">Fetch Product</button> -->
											</div>
										</td>
										<td><input type="text"  class="form-control" id="product_name" name="product_names[]" readonly></td>
										<!-- <td><input type="text" class="form-control" id="price_input" name="prices[]" readonly></td> -->
										<td><input type="number" class="form-control price_input" id="price_input" name="prices[]" readonly></td>
										<td><input type="text"  class="form-control" id="category" name="category[]" required></td>
										<td><input type="text"  class="form-control" id="brand" name="brand[]"  required></td>
										<td><input type="number" class="form-control quantity_input" id="quantity_input" name="quantities[]" required oninput="this.value = this.value.replace(/[^0-9]/g, '');"></td>
										<td><input type="number" class="form-control " id="available_quantity" name="available_quantity[]" readonly required></td>

										<td><input type="number" class="form-control total_input" id="total" name="total[]" readonly></td>

										<!-- <td><input type="number"  class="form-control" id="quantity" name="quantities[]" required></td> -->
										<!-- <td><input type="number"  class="form-control" id="total" name="total[]" required></td> -->



										
										
										
										<td id="stock_status"></td>
									</tr>
								</tbody>
							</table>
							  <div class="button-container">
    <button type="button" id="add_item" class="btn btn-submit me-2">Add Item</button>
    <button type="submit" name="generate_bill" class="btn btn-submit me-2">Generate Bill</button><br><br>
    <div class="float-end"><h3>Total Amount</h3><span><b>Rs.</b></span> <span id="total_amount" style="font-size:28px;">0.00</span></div>
</div>

						</form>
					</div>
				</div>
			</div>
	
	</div>
</div>
<script>
  // Get the current date
  var currentDate = new Date();

  // Get the input element by its ID
  var dateInput = document.getElementById("date");

  // Format the date as YYYY-MM-DD (adjust as needed)
  var year = currentDate.getFullYear();
  var month = String(currentDate.getMonth() + 1).padStart(2, '0');
  var day = String(currentDate.getDate()).padStart(2, '0');

  // Construct the formatted date string
  var formattedDate = year + "-" + month + "-" + day;

  // Set the value of the input field to the formatted date
  dateInput.value = formattedDate;
</script>
<script>
  function removeLeadingSpaces() {
    var textarea = document.getElementById("address");
    var text = textarea.value;
    
    // Remove leading spaces
    while (text.startsWith(' ')) {
      text = text.substring(1);
    }
    
    // Update the textarea value
    textarea.value = text;
  }
</script>
<script>
            $(document).ready(function() {
                // Function to check product quantity against stock quantity
                function checkQuantity() {
                    var productQuantities = document.getElementsByName("quantities[]");
                    var stockQuantities = document.getElementsByName("available_quantity[]");
                    var generateButton = document.querySelector('[name="generate_bill"]');
                    
                    var canGenerate = true; // Assume we can generate invoice

                    for (var i = 0; i < productQuantities.length; i++) {
                        var productQuantity = parseInt(productQuantities[i].value);
                        var stockQuantity = parseInt(stockQuantities[i].value);

                        if (productQuantity > stockQuantity) {
                            canGenerate = false; // Quantity exceeds stock, cannot generate
                            break; // No need to check further
                        }
                    }

                    // Enable or disable the Generate Invoice button based on the result
                    if (canGenerate) {
                        generateButton.disabled = false;
                    } else {
                        generateButton.disabled = true;
                    }
                }

                // Attach the checkQuantity function to the input event of product quantities
                var productQuantityInputs = document.getElementsByName("productQuantity[]");
                for (var i = 0; i < productQuantityInputs.length; i++) {
                    productQuantityInputs[i].addEventListener("input", checkQuantity);
                }

                // Initially, check the quantity when the page loads
                checkQuantity();
            });
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
		</body>
	</html>
	<?php } 

   else
    {
        echo '<script type ="text/JavaScript">';
echo 'alert(" You need log in first!!! ");window.location.href = "index.php"';
echo '</script>';
    }?>






