<?php
require_once ('form/function.php');
require ('form/connect.php');
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
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

  </head>
<script>
function myFunction() {
      alert('Downloading tables now...!');
    }
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

<a href="index.html">Dashboard</a>

</li>

<li class="breadcrumb-item active">Tables</li>
<form method="post" action="exportSpt.php">
  <label style="position:absolute;left:1295px;top:105px; width: 100px; color:blue; font-size: 11px;">Export Table</label>
  <button class="fas fa-download fa-fw" onclick="myFunction()" style="position:absolute;left:1300px;top:120px; width: 50px"></button> 
</form>
<!--logout here-->

<li class="breadcrumb-item active"></li>

</ol>

         <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Data Table Example</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                  <tr>
                    <th>S/N</th>
                      <th>Ref.No</th>
                      <th>Name</th>
                      <th>Department</th>
                      <th>Location</th>
                      <th>Receiving Point</th>
                       <th>Rec/Supply Date</th>
                      <th>Priority</th>
                      <th>Status</th>
                      <th>Ext/Phone</th>
                      <th>Description</th>
                      <th>Request Date </th> 
                    </tr>
                  </thead>
                  <tfoot>
                     <tr>
                      <th>S/N</th>
                      <th>Ref.No</th>
                      <th>Name</th>
                      <th>Department</th>
                      <th>Location</th>
                      <th>Receiving Point</th>
                       <th>Rec/Supply Date</th>
                      <th>Priority</th>
                      <th>Status</th>
                      <th>Ext/Phone</th>
                      <th>Description</th>
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

$sql = "SELECT * FROM controlform WHERE ass = 'unassigned' ORDER BY emp_id DESC LIMIT 20;";

$result = $conn -> query($sql);

if($result -> num_rows > 0){
  $student = array();
  while ($row = $result->fetch_assoc()) {
    echo "<tr><td>"
    .$row['emp_id']."<td>".
    $row['unique4']."<td>".
    $row['name']."<td>".
   $row['dept']."<td>".
   $row['locat']."<td>".
   $row['recv']."<td>".
   $row['recv_date']."<td>".
   $row['priority']."<td>".
   $row['ass']. "<td>".
   $row['phone']."<td>".
   $row['descp']."<td>".
   $row['submit_date'].
   "</td></tr>";
    # code...
  }
  echo "</a>";
}
else{
  echo "0 result";
}
$conn->close();
?>

</tbody>
</table>
</div>

</div>

<div class="card-footer small text-muted">Updated: <?php echo date('H:i:s - d-M-Y'); ?></div>

</div>

</div>

        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span><strong>FMN PLC 2018 © Developed By BA. IT Audit Department.</strong></span>
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

  </body>

</html>
<?php
}
else{
  header('location: landing.php');
}
?>