<?php

session_start();
error_reporting(0);
$username=$_SESSION["username"];

if($username!="")
{
?>

<?php include('include/sidebar.php');?>
<?php include('include/conn.php');
if(isset($_POST['add_brand'])){
extract($_POST);
  $brand_img =$_FILES["brand_img"]["name"];
$file_tmp =$_FILES["brand_img"]["tmp_name"];
$folder = "images/" . $brand_img;
  $sql = "INSERT INTO `brands` (`brand_name`, `description`, `brand_img`)
            VALUES ('$b_name', '$description', '$brand_img')";
$res = mysqli_query($con, $sql);
move_uploaded_file($file_tmp,$folder);

    if ($res) {
      echo "<script type='text/javascript'>
        swal('Brand Add Sucessfully!', 'You clicked the button!', 'success')
        .then(okay => {
            if (okay) {
                window.location = 'brandlist.php ';
            }

        });</script>";

    }else
    {
        header('location:addbrand.php');
    }
}


?>
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
           <h3>Add Brand</h3>
        </div>
    </div>
						<div class="content">
							<div class="page-header">
								<div class="page-title">
									<h4> Add Brand</h4>
									<h6>Create New Brand</h6>
								</div>
							</div>
							<div class="card">
								<div class="card-body">
									<form action="#" method="POST" enctype="multipart/form-data">
									<div class="row">
										<div class="col-lg-3 col-sm-6 col-12">

											<div class="form-group">
												<label>Brand Name</label>
												<input type="text" name="b_name" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '').replace(/(\..*)\./g, '$1');"  pattern="([^\s][A-z0-9À-ž\s]+)" title="Enter Alphabets Only"  class="form-control" placeholder="Enter Brand Name" required>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="form-group">
												<label>Description</label>
												<textarea name="description" id="myTextarea" class="form-control" oninput="removeLeadingSpaces()"required placeholder="Enter Description"></textarea>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="form-group">
												<label> Brand Image</label>
												<div class="image-upload">
													<input type="file" name="brand_img" required>
													<div class="image-uploads">
														<img src="assets/img/icons/upload.svg" alt="img">
														<h4>Drag and drop a file to upload</h4>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-12">
											<input type="submit" name="add_brand" class="btn btn-primary me-2" value="Submit">
											<a href="brandlist.php" class="btn btn-danger">Cancel</a>
										</div>
									</div>
								</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				<script>
  function removeLeadingSpaces() {
    var textarea = document.getElementById("myTextarea");
    var text = textarea.value;
    
    // Remove leading spaces
    while (text.startsWith(' ')) {
      text = text.substring(1);
    }
    
    // Update the textarea value
    textarea.value = text;
  }
</script>
<script type="text/javascript">
    // Function to change the Navbar Heading
    function changeNavbarHeading(newHeading) {
        document.getElementById("navbarHeading").textContent = newHeading;
    }

    // Function to handle Sidebar Toggle
    document.getElementById("sidebarCollapse").addEventListener("click", function () {
        // Toggle Sidebar Logic
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