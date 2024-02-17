<?php
error_reporting(0);
include("config.php");
if(isset($_POST['submit']))
{

  $start=$_POST['start_date'];
  $nm = $_POST['fld_bill_brand_name'];
  $end=$_POST['end_date'];
  $sql= "SELECT * FROM  bill WHERE date(fld_bill_current_date) BETWEEN '$start' and '$end' ORDER BY fld_bill_id DESC";
  $result=$conn->query($sql);
  $cnt=1;
}
?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from www.bootstrapdash.com/demo/corona-free/jquery/template/pages/tables/basic-table.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 24 Aug 2022 08:14:55 GMT -->
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Nayan Beer & Wine Shop</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="assets/css/style.css">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="assets/images/favicon.png" />
  <?php include 'config.php'; ?>
</head>
<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_sidebar.html -->
    <?php
    include 'header.php';
    ?>
    <!-- partial -->
    <div class="main-panel">
      <div class="content-wrapper">
        <button onclick="exportTableToExcel('dom-jqr')" class="btn btn-primary">Export Data</button><br><br>  
       <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <form action="" method="POST">
                <div class="row">
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label>Start Date</label>
                      <input class="form-control" name="start_date" type="date" placeholder="Enter Date" value="<?php echo isset($_GET['start_date']) ? $_GET['start_date'] : '' ?>" style="color: black; background-color: white;" required="">

                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label>End Date</label>
                      <input class="form-control" name="end_date"  value="<?php echo isset($_GET['end_date']) ? $_GET['start_date'] : '' ?>" type="date" placeholder="Enter Date" style="color: black; background-color: white;" required>

                    </div>
                  </div>
                  <div class="col-lg-2">
                    <center>
                      <div class="form-group" style="padding-top: 28px;">
                  <select class="form-select" id="item" name="item">
                       <option>
                       <?php while($row mysqli_fetch_array($res);
                       ?> 
                       </option>
                       
                  </select>
                      </div>
                    </center>
                  
                  <div class="col-lg-4">
                    <center>
                      <div class="form-group" style="padding-top: 28px;">
                        <button type="submit" name="submit" class="btn btn-success">Submit</button>
                      </div>
                    </center>
                  </div>
                </div>
              </form>
              <h4 class="card-title">Between Date Sale</h4>
              <div class="table-responsive">
                <table class="table table-bordered" id="dom-jqr">
                  <thead>
                    <tr>
                      <th> Sr No </th>
                      <th> Bill No </th>
                      <th> Name </th>
                      <th> Total </th>
                      <th> Date </th>
                    </tr>
                  </thead>
                  <?php
                  include("config.php");
                  date_default_timezone_set("Asia/Calcutta");
                  $start=$_POST['start_date'];
                  $end=$_POST['end_date'];
                  $name2= "SELECT sum(fld_bill_total) FROM bill where date(fld_bill_current_date) BETWEEN '$start' and '$end' ORDER BY fld_bill_id DESC";
                  $query=mysqli_query($conn,$name2);
                  $row = mysqli_fetch_array($query);
                  ?>  
                  <tbody>
                    <?php
                    if(isset($result))
                    {
                      foreach ($result as $rows) {
                          $a=$row['fld_bill_brand_name'];

                        ?>
                        
                        <tr>
                          <td><?php echo $cnt++; ?></td>


                          <td><?php echo $rows['fld_bill_id']; ?></td>
                           <td><?php echo $row['fld_bill_brand_name'];?></td>
                          <td><?php echo $rows['fld_bill_total']; ?></td>
                          <td><?php echo $rows['fld_bill_current_date']; ?></td>
                        </tr>
                        <?php
                      }
                    }
                    ?>

                  </tbody>

                </table><hr><h4 style="color: red"><b><?php echo 'Total Sale: ' . $row[0]; ?></b></h4>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- content-wrapper ends -->
  <!-- partial:../../partials/_footer.html -->
  <?php include 'footer.php'; ?>
  <!-- partial -->
</div>
<!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="assets/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="assets/js/off-canvas.js"></script>
<script src="assets/js/hoverable-collapse.js"></script>
<script src="assets/js/misc.js"></script>
<script src="assets/js/settings.js"></script>
<script src="assets/js/todolist.js"></script>

<script type="text/javascript">
  function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'inbetween_data.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
      var blob = new Blob(['\ufeff', tableHTML], {
        type: dataType
      });
      navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
      }
    }
  </script>
  <!-- endinject -->
  <!-- Custom js for this page -->
  <!-- End custom js for this page -->
</body>
<!-- Mirrored from www.bootstrapdash.com/demo/corona-free/jquery/template/pages/tables/basic-table.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 24 Aug 2022 08:14:56 GMT -->
</html>





<select class="form-control form-select" name="item" id="item">
                <option> Select Item</option>
              <?php
              include('config.php');
              // $itd = $_POST['item']
              $query = "SELECT fld_bill_brand_name from bill ";
              $result = mysqli_query($conn,$query);
            while($row = mysqli_fetch_array($result)) {
           echo '<option value="'.$row['fld_bill_brand_name'].'">'.$row['fld_bill_brand_name'].'</option>';
 }
 ?>
</select>