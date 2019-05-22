<?php
require_once ('form/function.php');
require ('form/connect.php');
require ('form/errors.php');
require_once ('form/logout.php');
// drop down table
$db_handle = new DBController();
$countryResult = $db_handle->runQuery("SELECT DISTINCT unique4 FROM assform WHERE task_status = 'In Progress' ORDER BY date_ass DESC");
// drop down table end
ob_start();
$valid_user_id = trim($_SESSION["licenced_users"]);

if(isset($_SESSION["licenced_users"]) && !empty($valid_user_id))
{
require ('form/connect.php');

$sql="SELECT * FROM controlform WHERE status = 0";
$result=mysqli_query($conn, $sql);
$count=mysqli_num_rows($result);
$conn->close();
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
    <script>
function dashboard() {
var query_parameter = document.getElementById("name").value;
var dataString = 'parameter=' + query_parameter;

// AJAX code to execute query and get back to same page with table content without reloading the page.
$.ajax({
type: "POST",
url: "errors.php",
data: dataString,
cache: false,
success: function(html) {
// alert(dataString);
document.getElementById("table_content1").innerHTML=html;
}
});
return false;
}

</script>
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

<!-- script for scrolling table -->
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
<!-- report table -->

  <ol class="breadcrumb">

<li><a href="tables.php?home">Home&nbsp;|</a></li>
<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span></span>Pages
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <hr>
<a class="dropdown-item" href="tables.php?cop">Completed Tasks</a>
 <a class="dropdown-item" href="tables.php?report">Performance View</a>
 <a class="dropdown-item" href="report.php">Staff Performance</a>
 <a class="dropdown-item" href="tables.php?reprogress">Tasks Progress View</a>
  <div class="dropdown-divider"></div>
            <div class="card-footer small text-muted"></div>
          </div>
        </li>
 <!-- export table -->
 <label class="exlabel">Export Table</label>
<a href="exportSpt.php" ><button class="fas fa-download fa-fw" title="export table" onclick="return confirm('Want to download table?');"></button></a><br>
</ol>

<h1 style="font-size: 26px;color: green; font-style: under-line;">STAFF PERFORMANCE VIEW</h1><hr style="border: 1px solid green;width: 400px;">
<!-- Staff list strat -->

<div id="Demo1" class="table--class" style="width:40%;">
   <p style="font-size: 22px;text-align: center;color: green;font-weight: bold; width: 400px;border-radius: 5px;margin-left: 30px;">Click To Select A Staff Name</p>
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
<br class="clear">
<div style="padding-left: 30px">
<form method="post" action="">
    <div class="form-group">
      <div class="lebels" align="left">*Name</div>
  <input type="text" id="fi_name" name="fi_name" placeholder="First name" required>
</div>
  <div class="form-group">
  <input type="text" id="la_name" name="la_name" placeholder="Last name" required>
</div>
  <div class="form-group">
    <div class="lebels" align="left">Date Range</div>
  <input type="text" name="date_from" placeholder="from: 2017-03-01" required>
</div>
  <div class="form-group">
  <input type="text" name="date_to" title="Format: 2017-03-10 (Year-Month-Day)" placeholder="to: 2017-03-10" required>
</div>
  <button type="submit" class="btn btn-primary" style="margin-bottom:10px;" name="check" >Submit</button>
      </form>
    </div>
</div>
<br class="clear">
<!-- script to populate table -->
   <script>
var table = document.getElementById('dataTable2');
for(var i = 0; i <table.rows.length; i++)
{
  table.rows[i].onclick = function()
  {
  document.getElementById("fi_name").value = this.cells[1].innerHTML;
  document.getElementById("la_name").value = this.cells[2].innerHTML;
    };
  }
 </script>

    <br class="clear">


         <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Individual Report</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                     <tr>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Completed</th>
                      <th>Reopened</th>
                      <th>Tasks Average</th>
                      <th>Total</th>
                    </tr>
                  </thead>
                  <tfoot>
                     <tr>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Completed</th>
                      <th>Reopened</th>
                      <th>Tasks Average</th>
                      <th>Total</th>
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

if (isset($_POST["check"])) {
  $fi_name = mysqli_real_escape_string($conn, $_POST["fi_name"]);
  $la_name = mysqli_real_escape_string($conn, $_POST["la_name"]);
  $date_from = mysqli_real_escape_string($conn, $_POST["date_from"]);
  $date_to = mysqli_real_escape_string($conn, $_POST["date_to"]);

$sql = "SELECT first_name, last_name, SUM(task_status='Completed') + SUM(task_status='Re-open') AS Total, SUM(task_status='Completed')AS Completed, SUM(task_status='Re-open')AS Reopen, SUM(task_status='Completed') / SUM(task_status='Re-open') AS AvgTask FROM `assform` WHERE (first_name = '$fi_name' AND last_name = '$la_name' AND task_acc = 1 AND date_ass BETWEEN '$date_from' AND '$date_to')  ORDER BY date_ass";

$result = $conn -> query($sql);

if($result -> num_rows > 0){
  $student = array();
  while ($row = $result->fetch_assoc()) {

   echo "<tr><td>"
   .$row['first_name']."<td>".
   $row['last_name']."<td>".
   $row['Completed']."<td>".
   $row['Reopen']."<td>".
   $row['AvgTask']."<td>".
   $row['Total'].
   "</td></tr>";
    # code...
  }
  echo "</table>";
}
else{
  echo "<script>alert('No record!')</script>";
}
$conn->close();
}
?>

</tbody>
</table>
</div>

</div>

<div class="card-footer small text-muted">Updated: <?php echo date('H:i:s - d-M-Y'); ?></div>
</div>
</div>
<!-- report table end -->

        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span><strong>FMN PLC <?php echo date('Y'); ?> © Developed By BA. IT Audit Department.</strong></span>
            </div>
          </div>
        </footer>

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

   <!-- drop down Modal-->
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
              <button class="btn btn-secondary" type="submit" value="Logout" name="logout">Logout</button>
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
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    
    <!-- Demo scripts for this page-->
    <script src="js/demo/datatables-demo.js"></script>
    <script src="js/export.js"></script>
 <!-- script for accordion -->
<script>
function myFunction(id) {
  var x = document.getElementById(id);
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else { 
    x.className = x.className.replace(" w3-show", "");
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