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

// create connection
$conn = mysqli_connect($servername, $username, $password, $DBname);
//check connection
if (!$conn) {
  die("connection failed: " . mysqli_connect_error());
}

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
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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

<li class="breadcrumb-item active">Users Feedback</li>

</ol>
         <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Feedback Table</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" border="1px">
                  <thead>
                    <tr>
                      <th>S/N</th>
                      <th>Request Code</th>
                      <th>Name</th>
                      <th>Department</th>
                      <th>Phone</th>
                      <th>Feedback</th>
                      <th>Date</th>
                      <th>Mark as solved</th>
                    </tr>
                  </thead>
                  <tfoot>
                     <tr>
                      <th>S/N</th>
                      <th>Request Code</th>
                      <th>Name</th>
                      <th>Department</th>
                      <th>Phone</th>
                      <th>Feedback</th>
                      <th>Date</th>
                      <th>Mark as solved</th>                   
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

$sql="SELECT *, feed_table.unique4 AS code,feed_table.id AS Myid, controlform.unique4 AS code, CONCAT(controlform.fname, ' ', controlform.lname)AS Name, feed_table.feed AS feed, feed_table.status AS status, feed_table.feed_date AS fdate, controlform.phone AS phone, controlform.dept AS dept
FROM feed_table
JOIN controlform ON feed_table.unique4=controlform.unique4 WHERE feed_table.status = 'notsolve' ORDER BY Myid DESC ;";

$result = $conn -> query($sql);

if($result -> num_rows > 0){
  $student = array();
  while ($row = $result->fetch_assoc()) {
echo "<tr>";
echo "<td>" . $row['Myid']. "</td>";
echo "<td>" . $row['code'] . "</td>";
echo "<td>" . $row['Name'] . "</td>";
echo "<td>" . $row['dept'] . "</td>";
echo "<td>" . $row['phone'] . "</td>";
echo "<td>" . $row['feed'] . "</td>";
echo "<td>" . $row['fdate'] . "</td>";
echo "<td><a style='color:green;font-size:18px;text-align:center;font-style:italic;' href=\"feedresolve.php?Myid=".$row['Myid']."\">Close</a></td>";

echo "</tr>";
}
echo "</table>";
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
<!-- script to populate table -->
 <!--   <script>
var table = document.getElementById('dataTable');
for(var i = 2; i <table.rows.length; i++)
{
  table.rows[i].onclick = function()
  {
  document.getElementById("Rfname").value = this.cells[3].innerHTML;
  document.getElementById("fname").value = this.cells[1].innerHTML;
  document.getElementById("lname").value = this.cells[2].innerHTML;
    };
  }
 </script> -->

</div>

</div>

        <!-- /.container-fluid -->

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
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <script src="js/export.js"></script>
    
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