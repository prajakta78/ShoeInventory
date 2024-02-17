<?php
include('include/conn.php');
// Query to retrieve bill details and associated product data
$billId = $_GET['bill_id'];
$query = "
SELECT b.*, bi.*, p.product_name, p.price
FROM bill b
LEFT JOIN bill_product bi ON b.bill_number = bi.bill_number
LEFT JOIN products p ON bi.product_code = p.product_code
WHERE b.bill_number = '$billId'
";
$result = mysqli_query($con, $query);
// Process the fetched data and display the edit form
// ...
?>
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
</style>
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function fetchProductInfo(inputElement) {
var row = $(inputElement).closest('tr');
var productCode = $(inputElement).val();
$.ajax({
type: "POST",
url: "get_product_details.php",
data: { product_code: productCode },
success: function(data) {
var product = JSON.parse(data);
row.find('#product_name').val(product.product_name);
row.find('#category').val(product.category);
row.find('#brand').val(product.brand);
row.find('#price_input').val(product.price);
var stockStatus = product.quantity > 0 ? "In Stock" : "Out of Stock";
row.find('#stock_status').text(stockStatus);
if (stockStatus === "Out of Stock") {
alert('This product is currently out of stock.');
}
},
error: function() {
alert('Product not found');
}
});
}

function deleteRow(button) {
  const productId = button.getAttribute("data-product-id");
  const productIndex = button.getAttribute("data-product-index");
  
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "delete_product.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        // On successful deletion, remove the row from the table
        const row = button.closest("tr");
        row.remove();
      } else {
        // Handle error if needed
        console.error("Error deleting product");
      }
    }
  };
  
  const formData = new FormData();
  formData.append("product_id", productId);
  formData.append("product_index", productIndex);
  
  xhr.send(formData);
}
$(document).ready(function() {
$('#add_item').click(function() {
var newRow = `<tr>
        <td>
        <div class="input-container">
            <input type="text" class="product_code_input" name="product_code[]" required onkeypress="return RestrictSpace()" onchange="fetchProductInfo(this)">
        </div>
    </td>
    <td><input class="form-control" type="text" id="product_name" name="product_name[]" readonly></td>
    <td><input class="form-control" type="text" id="price_input" name="price_input[]" readonly></td>
    <td><input type="text"  class="form-control" id="category" name="category[]" required></td>&nbsp;&nbsp;&nbsp;&nbsp;
                                            <td><input type="text"  class="form-control" id="brand" name="brand[]"  required></td>&nbsp;&nbsp;&nbsp;&nbsp;
    <td><input class="form-group" type="number" id="quantity_input" name="quantity[]" required></td>&nbsp;&nbsp;&nbsp;&nbsp;
    
    <td>
                                            <input type="number" name="total_price[]" class=" form-group total-price-input" readonly></td>`;
    
    newRow += `<td><button class="fa fa-trash text-danger" onclick="deleteRow(this.closest('tr'))"></button></td>`;
newRow += `</tr>`;

$('#items_table tbody').append(newRow);
});
$('form').submit(function(event) {
var outOfStock = false;
$('#stock_status').each(function() {
if ($(this).text() === "Out of Stock") {
outOfStock = true;
return false;
}
});
if (outOfStock) {
alert('Please remove out-of-stock products before generating the bill.');
event.preventDefault();
}
});
});
</script>
<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Product Bill</h4>
                <h6>Create new Bill</h6>
            </div>
        </div>
        <form method="post" action="updatebill.php">
            <div class="card" >
                <div class="card-body">
                    <div class="row">
                        

                        <!-- <form method="post" action="#"> -->
                        <table id="items_table" class="table-responsive">
                            <thead>
                                <tr>
                                    <th>Product Code</th>
                                    <th>Product Name</th>
                                    <th>Price per Unit</th>
                                    
                                    <th>Category</th>
                                    <th>Brand</th>
                                    <th>Quantity</th>
                                    <th>TotalPrice</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                                <tr>
                                    <td>
                                        <div class="input-container">
                                            <input type="hidden" name="bill_id" value="<?php echo $billId; ?>">
                                            <input type="text" class="form-control" id="product_code" name="product_code[]" value="<?php echo $row['product_code']; ?>" required  onkeypress="return RestrictSpace()" onchange="fetchProductInfo(this)">
                                            <!--   <button type="button"  id="fetch_product">Fetch Product</button> -->
                                        </div>
                                    </td>
                                    <td><input type="text"  class="form-control" id="product_name" name="product_name[]" value="<?php echo $row['product_name']; ?>"readonly></td>
                                    <td><input type="text" class="form-control" id="price_input"  name="price_input[]" value="<?php echo $row['per_piece_price']; ?>"  readonly></td>
                                    <td><input type="text"  class="form-control" id="category" name="category[]" value="<?php echo $row['category']; ?>"required></td>
                                    <td><input type="text"  class="form-control" id="brand" name="brand[]" value="<?php echo $row['brand']; ?>" class="quantity-input"   required></td>
                                    <td><input type="number"  class="form-control quantity-input" id="quantity" name="quantity[]" value="<?php echo $row['quantity']; ?>"  data-per-piece-price="<?php echo $row['per_piece_price']; ?>" required></td>
                                    
                                    <td>
                                    <input type="number" name="total_price[]" value="<?php echo $row['quantity']* $row['per_piece_price']; ?>" class="total-price-input" readonly></td>
                                   <!--  <td><button class="fa fa-trash text-danger" name="delete_product" onclick="deleteRow(this.closest('tr'))"></button></td> -->
   <!--                                  <td>
          <button class="fa fa-trash text-danger" data-product-id="<?php echo $product_code; ?>" data-product-index="<?php echo $key; ?>" onclick="deleteRow(this)"></button>
          <input type="checkbox" name="delete_product[<?php echo $key; ?>]" value="<?php echo $product_code; ?>"> Delete
        </td> -->

        <td><a href="delete_product.php?id=<?php echo $row['id']; ?>&billId=<?php echo $billId; ?>">Delete</a></td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                        <div class="button-container">
                            
                            <button type="button" id="add_item" class="btn btn-submit me-2">Add Item</button>
                            
                            
                            <button type="submit" name="update_bill" class="btn btn-submit me-2">Generate Bill</button>
                            <?php
                            // Calculate initial total amount
                            $totalAmount = 0;
                            mysqli_data_seek($result, 0); // Reset result set pointer
                            while ($row = mysqli_fetch_assoc($result)) {
                            $totalAmount += $row['total_price'];
                            }
                            ?>
                            <h3>Total Bill Amount: <span id="total-amount"><?php echo number_format($totalAmount, 2); ?></span></h3>
                            <!-- Rest of the form and JavaScript code -->
                            
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
</div>
</form>

<script>
document.addEventListener("DOMContentLoaded", function() {
// Assuming you have an input field for the product code
const productCodeInput = document.getElementById("product-code-input");
const productNameInput = document.getElementById("product-name-input");
const perPiecePriceInput = document.getElementById("per-piece-price-input");
productCodeInput.addEventListener("blur", function() {
const productCode = productCodeInput.value;
// Make an API request to fetch product details based on the code
fetch(`api/get_product_details.php?product_code=${productCode}`)
.then(response => response.json())
.then(data => {
productNameInput.value = data.product_name;
perPiecePriceInput.value = data.per_piece_price;
})
.catch(error => {
console.error("Error fetching product details:", error);
});
});
});
</script>
<script>
document.addEventListener("DOMContentLoaded", function() {
const quantityInputs = document.querySelectorAll(".quantity-input");
const totalPriceInputs = document.querySelectorAll(".total-price-input");
const totalAmountSpan = document.getElementById("total-amount");
// Update total price and amount when quantity changes
quantityInputs.forEach(input => {
input.addEventListener("input", function() {
const quantity = parseInt(input.value);
const perPiecePrice = parseFloat(input.dataset.perPiecePrice);
const totalPrice = quantity * perPiecePrice;
const row = input.closest("tr");
const totalPriceInput = row.querySelector(".total-price-input");
totalPriceInput.value = isNaN(totalPrice) ? "" : totalPrice.toFixed(2);
// Update total amount
let newTotalAmount = 0;
totalPriceInputs.forEach(input => {
const price = parseFloat(input.value);
newTotalAmount += isNaN(price) ? 0 : price;
});
totalAmountSpan.textContent = newTotalAmount.toFixed(2);
});
});
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