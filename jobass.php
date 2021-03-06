
<?php
require_once ('form/function.php');
require ('form/connect.php');
require('form/assigForm.php');
require ('form/errors.php');
require_once ('form/logout.php');
ob_start();
$valid_user_id = trim($_SESSION["licenced_users"]);

if(isset($_SESSION["licenced_users"]) && !empty($valid_user_id))
{
?>
<!DOCTYPE html>
<html lang="en">

  <head>

  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>IVR Portal</title>
    <link rel="icon"  type="image/x-icon" href="favicon.ico">
    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

  </head>
<!--    <script type="text/javascript">
        $(window).scroll(function () {
            if ($(window).scrollTop() > 776) {
                $(".col-md-8").addClass("fixed");
            } else {
                $(".col-md-8").removeClass("fixed");
            }
        });
    </script>

    <style type="text/css">
        .fixed {
        position:fixed;
        width:45%;
        top:10px;
        bottom: 20px;
        left:750px;        
    }
    </style> -->
    <style>
  tr {
  cursor: pointer;transition: all .25s ease-in-out;
}
  table tr:not(first-child):hover{
  background-color: #aa9911;
}

table tr:(:2){
  background-color: #ddd;
}

    
</style>
<script type="text/javascript">
  var OSName="";
if (navigator.appVersion.indexOf("Win")!=-1) OSName="Windows";
if (navigator.appVersion.indexOf("Mac")!=-1) OSName="MacOS";
if (navigator.appVersion.indexOf("X11")!=-1) OSName="UNIX";
if (navigator.appVersion.indexOf("Linux")!=-1) OSName="Linux";

$('body').addClass(OSName);
</script>
  <body id="page-top">

      <!-- Navbar -->
      <?php require ('header.php');?>

    <div id="wrapper">

      <!-- Sidebar -->
       <?php require ('side.php');?>

       <!-- Breadcrumbs-->

<ol class="breadcrumb">

<li class="breadcrumb-item">

<a href="dash.php">Dashboard</a>

</li>

<li class="breadcrumb-item active">Assigning Page</li>
<li class="breadcrumb-item active"></li>
</ol>

<!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Data Table</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>S/N</th>
                      <th>Ref.No</th>
                      <th>Requester First Name</th>
                      <th>Requester Last Name</th>
                      <th>Department</th>
                      <th>Location</th>
                      <th>Receiving Point</th>
                      <th>Delivery Date</th>
                      <th>Item Description</th>
                      <th>Priority</th>
                      <th>Status</th>
                      <th>Ext/Phone</th>
                      <th>Request Date </th> 
                    </tr>
                  </thead>
                   <tfoot>
                    <tr>
                      <th>S/N</th>
                      <th>Ref.No</th>
                      <th>Requester First Name</th>
                      <th>Requester Last Name</th>
                      <th>Department</th>
                      <th>Location</th>
                      <th>Receiving Point</th>
                      <th>Delivery Date</th>
                      <th>Item Description</th>
                      <th>Priority</th>
                      <th>Status</th>
                      <th>Ext/Phone</th>
                      <th>Request Date </th> 
                    </tr>
                  </tfoot>

<tbody>
<?php


// create connection
$conn = mysqli_connect($servername, $username, $password, $DBname);
//check connection
if (!$conn) {
  die("connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM controlform WHERE ass = 'unassigned' LIMIT 20;";

$result = $conn -> query($sql);

if($result -> num_rows > 0){
  $student = array();
  while ($row = $result->fetch_assoc()) {
   echo "<tr><td>"
   .$row['emp_id']."<td>".
   $row['unique4']."<td>".
    $row['fname']."<td>".
    $row['lname']."<td>".
   $row['dept']."<td>".
   $row['locat']."<td>".
   $row['recv']."<td>".
   $row['recv_date']."<td>".
   $row['descp']."<td>".
   $row['priority']."<td>".
   $row['ass']. "<td>".
   $row['phone']."<td>".
   $row['submit_date'].
   "</td></tr>";
    # code...
  }
  echo "</a>";
}
else{
  echo "0 result";
}

?>

</tbody>
</table>
</div>

</div>

<div class="card-footer small text-muted">Updated: <?php $date_utc = new \DateTime("now", new \DateTimeZone("Africa/Lagos"));

echo $date_utc->format(\DateTime::RFC850); ?></div>

</div>

</div>
<!-- script to populate table -->
   <script>
var table = document.getElementById('dataTable');
for(var i = 1; i <table.rows.length; i++)
{
  table.rows[i].onclick = function()
  {
  document.getElementById("Rfname").value = this.cells[1].innerHTML;
  document.getElementById("jrequest").value = this.cells[2].innerHTML;
  document.getElementById("jrequest1").value = this.cells[3].innerHTML;
  document.getElementById("jlocate").value = this.cells[6].innerHTML;
    };
  }
 </script>

<div class="row" style="border-radius: 5px; padding:50px">

<div class="col-12">

<h1>Assign Task </h1>

</div>

<div class="col-md-8" style="border-radius: 5px; border:1px solid grey;padding: 30px; padding: 0 10 20px 30px">

<form method="post" action="" onsubmit="return checkForm(this);">

<div class="form-group">

<label><strong>Staff Name</strong></label>

<input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" required><br>
<input type="text" class="form-control" id="lname" placeholder="Last Name" name="lname" required>

</div>

<div class="form-group">

<label><strong>Ref. Code</strong></label>
<input type="text" class="form-control" id="Rfname" name="ref" placeholder="Request No" readonly="" required>
</div>

<div class="form-group">

<label><strong>Receiving Point</strong></label>

<input type="text" class="form-control" id="jlocate" name="jlocate" readonly>

</div>

<div class="form-group">

<label><strong>Requests By</strong></label>

<input type="text" class="form-control" id="jrequest" name="jrequest" readonly="" required>

</div>

<div class="form-group">

<input type="text" class="form-control" id="jrequest1" name="jrequest1" readonly>

</div>

<div class="form-group">
<label><strong>*Assign:</strong> </label>
<br>
<input type="radio" name="jstatus" value="In Progress"  style="margin:10px 0 0 10px;width: 20px;height: 20px; margin-right: 10px;" required>Assign
</div>

<div class="form-group">
<label><strong>Comment</strong></label>
<textarea class="form-control" name="jdetails" ></textarea>
</div>

<button type="submit" class="btn btn-primary" style="margin-bottom:10px;" name="reg_j" id="sub" onclick="submitform()">Submit</button>
</form>

<script>
    function submitform(){
        $('#registeration').find('form').submit();
        $('.clearFields').val('');
    }
</script>

<script>
document.getElementById("sub").addEventListener("click", myFunction);

function myFunction() {
  document.getElementById("sub").innerHTML = "Please wait...
}
</script>
</div>

<!-- Staff list strat -->

<div style="border-radius: 5px; border:1px solid grey;padding: 30px; padding: 0 10 20px 30px">
  <h3>Internal Control Staff List</h3>
<hr style="border: 1px solid green;width: 300px;">
<div class="table-responsive">
 <span style="font-size: 18px;text-align: center;color: #111;font-weight: bold; width: 300px;border-radius: 5px;margin-left: 10px;">Click To Select A Staff Name</span>
<div id="Demo1" class="table--class" style="width:100%;">
<table width="100%" id="dataTable2" height="50%" border="1" cellspacing="0">
<tbody class="table--class">
  

    <?php
// create connection
$conn = mysqli_connect($servername, $username, $password, $DBname);
//check connection
$sql="SELECT * FROM empDa ";
$result_check = mysqli_query($conn, $sql);

  //conditional statment for the person logged in
  if (mysqli_num_rows($result_check)>0){

    //to loggedout for logged in users we run our codes inside this logged in area
    
    while($row1 = mysqli_fetch_assoc($result_check)) {
      echo "<tr><td>" 
      .$row1['id']."<td>".
      $row1['first_name']."<td>".
      $row1['last_name'].
      "</td></tr>";
}
 echo "</table>";
}
$conn->close();
?>
</tbody>
</table>
</div>
<!-- script to populate table -->
   <script>
var table = document.getElementById('dataTable2');
for(var i = 0; i <table.rows.length; i++)
{
  table.rows[i].onclick = function()
  {
  document.getElementById("fname").value = this.cells[1].innerHTML;
  document.getElementById("lname").value = this.cells[2].innerHTML;
    };
  }
 </script>
</div>

</div>

</div>

<!-- /.container-fluid-->
        <!-- Sticky Footer -->
        <?php require ('footer.php');?>

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <form action="" method="POST" style="" class="float-right">
            <input type="submit" value="Logout" name="logout">
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="js/demo/datatables-demo.js"></script>
    <script src="js/demo/chart-area-demo.js"></script>

    <script src="js/export.js"></script>
<!-- script for accordion -->
<script>
function myFunction(id) {
  var x = document.getElementById(id);
  if (x.className.indexOf("table--class") == -1) {
    x.className += " table--class";
  } else { 
    x.className = x.className.replace(" table--class", "");
  }
}
</script>
  </body>

</html>
<?php
}
else{
  header('location: landing.php');
}
?>