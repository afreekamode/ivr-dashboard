<?php
require_once ('form/function.php');
require ('form/connect.php');
require ('form/errors.php');
require_once ('form/logout.php');
require('form/assigForm.php');
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
<style type="text/css">
	
#demo-grid .txt-heading{background-color: #D3F5B8;}
#demo-grid table{width:100%;background-color:#F0F0F0;}

#demo-grid table th{text-align:left;}
#demo-grid table td{background-color:#FFFFFF;}
.search-box {border: 1px solid #F0F0F0;background-color:#C8EEFD;margin: 10px 0px;}
button#Filter {
    padding: 5px 30px;
    background: #586e75;
    border: #485c61 1px solid;
    color: #FFF;
    border-radius: 2px;
    cursor: pointer;
    margin-left: 20px;
    margin-bottom: 5px;
}
select#Place {
    margin-left: 20px;
    margin-top: 12px;
    padding-bottom: 25px;
}
</style>
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
document.getElementById("table_content").innerHTML=html;
}
});
return false;
}

</script>
  <body id="page-top">
     <!-- Navbar -->
       <?php require ('header.php');?>
    <div id="wrapper">
      <!-- Sidebar -->
       <?php require ('side.php');?>
<!-- Breadcrumbs-->

<?php if (isset($_GET['home'])){ ?>
<ol class="breadcrumb">
<li style="font-size:18px;"><a href="tables.php?home">Home&nbsp;| </a></li>
<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span style="font-size:18px;"></span>Pages
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
<label class="exlabel">Export Table</label>
<a href="exportingfile.php" ><button class="fas fa-download fa-fw" title="export table" onclick="return confirm('Want to download table?');"></button></a><br>
</ol>


         <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Data Tables</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                     <th>S/N</th>
                      <th>Request By</th>
                      <th>Department</th>
                      <th>Location</th>
                      <th>Receiving Point</th>
                      <th>Delivery Date</th>
                      <th>Priority</th>
                      <th>Ext/Phone</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                       <th>S/N</th>
                      <th>Request By</th>
                      <th>Department</th>
                      <th>Location</th>
                      <th>Receiving Point</th>
                      <th>Delivery Date</th>
                      <th>Priority</th>
                      <th>Ext/Phone</th>
                      <th>Date</th>
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

$sql = "SELECT CONCAT(fname, '  ', lname)AS Name, emp_id, unique4, dept, locat, recv, recv_date, priority, ass, phone, submit_date FROM controlform ;";

$result = $conn -> query($sql);

if($result -> num_rows > 0){
  $student = array();
  while ($row = $result->fetch_assoc()) {

   echo "<tr><td>"
   .$row['emp_id']."<td>".
   $row['Name']."<td>".
   $row['dept']."<td>".
   $row['locat']."<td>".
   $row['recv']."<td>".
   $row['recv_date']."<td>".
   $row['priority']."<td>".
   $row['phone']."<td>". 
   $row['submit_date'].
   "</td></tr>";
    # code...
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
<?php } ?>

<?php if (isset($_GET['cop'])){ ?>
<ol class="breadcrumb">

<li style="font-size:18px;"><a href="tables.php?home">Home&nbsp;| </a></li>
<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span style="font-size:18px;"></span>Pages
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
         <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Completed Tasks</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" border="1px">
                  <thead>
                    <tr>
                      <th>S/N</th>
                      <th>Req. No</th>
                      <th>Assigned To: First name</th>
                      <th>Assigned To: Last Name</th>
                      <th>Assigned By</th>
                      <th>Task Location</th>
                      <th>Request By</th>
                      <th>Task Status</th>
                      <th>Comment</th>
                      <th>Time Assigned</th>
                      <th>Re-assigned time</th>
                      <th>Time Reopened</th>
                      <th>Time Completed</th>
                      <th>Time Spent</th>
                      <th>Time Spent After Reassigned</th>
                    </tr>
                  </thead>
                  <tfoot>
                     <tr>
                        <th>S/N</th>
                      <th>Req. No</th>
                      <th>Assigned To: First name</th>
                      <th>Assigned To: Last Name</th>
                      <th>Assigned By</th>
                      <th>Task Location</th>
                      <th>Request By</th>
                      <th>Task Status</th>
                      <th>Comment</th>
                      <th>Time Assigned</th>
                      <th>Re-assigned time</th>
                      <th>Time Reopened</th>
                      <th>Time Completed</th>
                      <th>Time Spent</th>
                      <th>Time Spent After Reassigned</th>
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

$sql = "SELECT id, first_name, last_name, assignee, unique4, task_locate, CONCAT(task_request, '  ', task_request1)AS requestName, task_status, task_details, date_ass, task_time, retask_time, time_reopen, time_completed, TIMEDIFF(time_completed , task_time)AS TimeSpent, TIMEDIFF(time_completed , retask_time)AS ReassignedTSpent FROM `assform` WHERE task_status = 'completed';";

$result = $conn -> query($sql);

if($result -> num_rows > 0){
  $student = array();
  while ($row = $result->fetch_assoc()) {
   echo "<tr><td>"
   .$row['id']."<td>".
   $row['unique4']."<td>".
   $row['first_name']."<td>".
   $row['last_name']."<td>".
   $row['assignee']."<td>".
   $row['task_locate']."<td>".
   $row['requestName']."<td>".
   $row['task_status']."<td>".
   $row['task_details']."<td>".
   $row['task_time']."<td>".
   $row['retask_time']."<td>".
   $row['time_reopen']."<td>".
   $row['time_completed']."<td>".
   $row['TimeSpent']."<td>".
   $row['ReassignedTSpent'].  
   "</td></tr>";
    # code...
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
<!-- script to populate table -->
   <script>
var table = document.getElementById('dataTable');
for(var i = 1; i <table.rows.length; i++)
{
  table.rows[i].onclick = function()
  {
  document.getElementById("Rfname").value = this.cells[1].innerHTML;
  document.getElementById("fname").value = this.cells[2].innerHTML;
  document.getElementById("lname").value = this.cells[3].innerHTML;
    };
  }
 </script>
<div class="row" style="border-radius: 5px; padding:50px">

<div class="col-12">

<h1>Re-open a Task</h1>

</div>

<div style="width: 70%; border-radius: 5px; border:1px solid grey;padding: 30px; padding: 0 10 20px 50px">
 
<form method="post" action="">

<div class="form-group">

<label><strong>Staff Name</strong></label>

<input type="text" class="form-control" id="fname" name="fname" placeholder="*First Name" ><br>
<input type="text" class="form-control" id="lname" placeholder="*Last Name" name="lname" ><br>
<input type="text" class="form-control" id="Rfname" placeholder="*Ref. No" name="ref" required>

</div>

<div class="form-group">

<label><strong>Status:</strong> </label>
<br>
<span><input type="radio" name="jstatus" value="Reopen" style="margin:10px 0 0 10px;width: 20px;height: 20px; margin-right: 10px;" required >Re-open</span>
</span>


</div>

<div class="form-group">

<label><strong>Remarks</strong></label>

<textarea class="form-control" name="jdetails" required></textarea>

</div>

<div class="form-group">
<button type="submit" class="btn btn-primary" style="margin-bottom:10px; " name="reopen">Reopen</button>
</div>

</form>
</div>
</div>
<?php } ?>

<!-- report table -->
<?php if (isset($_GET['report'])){ ?>

  <ol class="breadcrumb">

<li style="font-size:18px;"><a href="tables.php?home">Home&nbsp;| </a></li>
<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span style="font-size:18px;"></span>Pages
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
<div style=" font-family:Verdana, Geneva, sans-serif; font-size:24px;">Performance View</div><br clear="all" />


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
                      <th>S/N</th>
                      <th>Req Code</th>
                      <th>Name</th>
                      <th>Inprogress</th>
                      <th>Re-assigned</th>
                      <th>Completed</th>
                      <th>Reopened</th>
                      <th>Ass Time</th>
                      <th>Completed Time</th>
                      <th>Time Spent</th>
                      <th>Time Spent After Reassigned</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>S/N</th>
                      <th>Req Code</th>
                      <th>Name</th>
                      <th>Inprogress</th>
                      <th>Re-assigned</th>
                      <th>Completed</th>
                      <th>Reopened</th>
                      <th>Ass Time</th>
                      <th>Completed Time</th>
                      <th>Time Spent</th>
                      <th>Time Spent After Reassigned</th>
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

$sql = "SELECT DISTINCT CONCAT(first_name, '  ', last_name)AS Name, id, SUM(task_status = 'In progress') AS Inprogress, SUM( task_status = 'Re-assigned') AS Reassigned, SUM(task_status = 'completed') AS Completed, SUM(task_status = 'Re-open/in progress') AS Reopened, date_ass AS Date, CAST(task_time AS DATETIME) AS AssTime, unique4, CAST(time_completed AS DATETIME) AS CompletedTime, TIMEDIFF(time_completed , task_time) AS TimeSpent, TIMEDIFF(time_completed , retask_time)AS ReassignedTSpent FROM `assform` GROUP BY id";

$result = $conn -> query($sql);

if($result -> num_rows > 0){
  $student = array();
  while ($row = $result->fetch_assoc()) {

   echo "<tr><td>"
   .$row['id']."<td>".
   $row['unique4']."<td>".
   $row['Name']."<td>".
   $row['Inprogress']."<td>".
   $row['Reassigned']."<td>".
   $row['Completed']."<td>".
   $row['Reopened']."<td>".
   $row['AssTime']."<td>".
   $row['CompletedTime']."<td>".
   $row['TimeSpent']."<td>".
   $row['ReassignedTSpent'].
   "</td></tr>";
    # code...
  }
  echo "</table>";
}
else{
  echo "<script>alert('0 result!')</script>";
}
$conn->close();
?>

</tbody>
</table>
</div>

</div>

<?php } ?>
<!-- report table end -->

<!-- report table -->
<?php if (isset($_GET['reprogress'])){ ?>

  <ol class="breadcrumb">

<li style="font-size:18px;"><a href="tables.php?home">Home&nbsp;| </a></li>
<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span style="font-size:18px;"></span>Pages
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
<div style=" font-family:Verdana, Geneva, sans-serif; font-size:24px;">Tasks Progress View</div><br clear="all" />


         <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Individual Report / <a href="tables.php?testprogress" class="w3-bar-item w3-button" style="color: red; text-decoration: none;">Search with Req. code</a></div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                     <tr>
                      <th>S/N</th>
				 <th>Req. No</th>
                      <th>Staff Name</th>
                      <th>Task Location</th>
                      <th>Task Status</th>
                      <th>Comment</th>
                      <th>Reassign Comment</th>
                      <th>Time Assigned</th>
                      <th>Re-assigned Time</th>
                      <th>Time Reopened</th>
                      <th>Time Completed</th>
                    </tr>
                  </thead>
                  <tfoot>
                      <tr>
                      <th>S/N</th>
				 <th>Req. No</th>
                      <th>Staff Name</th>
                      <th>Task Location</th>
                      <th>Task Status</th>
                      <th>Comment</th>
                      <th>Reassign Comment</th>
                      <th>Time Assigned</th>
                      <th>Re-assigned Time</th>
                      <th>Time Reopened</th>
                      <th>Time Completed</th>
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

$sql = "SELECT * , CONCAT(first_name, '  ', last_name)AS Name FROM assform ;";

$result = $conn -> query($sql);

if($result -> num_rows > 0){
  $student = array();
  while ($row = $result->fetch_assoc()) {
   echo "<tr><td>"
   .$row['id']."<td>".
   $row['unique4']."<td>".
   $row['Name']."<td>".
   $row['task_locate']."<td>".
   $row['task_status']."<td>".
   $row['task_details']."<td>".
   $row['retask_details']."<td>".
   $row['task_time']."<td>".
   $row['retask_time']."<td>".
   $row['time_reopen']."<td>".
   $row['time_completed'].  
   "</td></tr>";
    # code...
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


<?php } ?>

<!-- report table -->
<?php if (isset($_GET['testprogress'])){ ?>

  <ol class="breadcrumb">

<li style="font-size:18px;"><a href="tables.php?home">Home&nbsp;| </a></li>
<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span style="font-size:18px;"></span>Pages
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
<div style=" font-family:Verdana, Geneva, sans-serif; font-size:24px;">Select a Request Code to view task in progress history.</div><br clear="all" />


         <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Individual Report</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <!-- Drop button for inprogress table start-->
 <form method="POST" name="search" action="" id="registeration">
        <div id="demo-grid">
            <div class="search-box">
                <select id="Place" name="search[]" multiple="multiple">
                    <option value="0" selected="selected">Select Req. No</option>
                        <?php
                        if (! empty($countryResult)) {
                            foreach ($countryResult as $key => $value) {
                                echo '<option value="' . $countryResult[$key]['unique4'] . '">' . $countryResult[$key]['unique4'] . '</option>';
                            }
                        }
                        ?>
                </select><br> <br>
                <button id="Filter">Check</button>
            </div>
            
                <?php
                if (! empty($_POST['search'])) {
                    ?>
                    <table cellpadding="10" cellspacing="1" id="table_content">

                <thead>
                    <tr>
                        <th><strong>S/N</strong></th>
                        <th><strong>First Name</strong></th>
                        <th><strong>Last Nmae</strong></th>
                        <th><strong>Req. code</strong></th>
                        <th><strong>Task Comment</strong></th>
                        <th><strong>Commnet For Reassigning</strong></th>
                        <th><strong>Time Assigned</strong></th>
                        <th><strong>Reassigned Time</strong></th>
                        <th><strong>Time Completed</strong></th>

                    </tr>
                </thead>
                <tbody>
                <?php
                    $query = "SELECT * from assform";
                    $i = 0;
                    $selectedOptionCount = count($_POST['search']);
                    $selectedOption = "";
                    while ($i < $selectedOptionCount) {
                        $selectedOption = $selectedOption . "'" . $_POST['search'][$i] . "'";
                        if ($i < $selectedOptionCount - 1) {
                            $selectedOption = $selectedOption . ", ";
                        }
                        
                        $i ++;
                    }
                    $query = $query . " WHERE unique4 in (" . $selectedOption . ")";
                    
                    $result = $db_handle->runQuery($query);
                }
                if (empty($result)) {
                      echo "<script> alert ('No record found !!!'); </script>";
                        die(); 
                    }
                else if(! empty($result)) {
                    foreach ($result as $key => $value) {
                        ?>
                <tr>
                        <td><div class="col" id="user_data_1"><?php echo $result[$key]['id']; ?></div></td>
                        <td><div class="col" id="user_data_2"><?php echo $result[$key]['first_name']; ?> </div></td>
                        <td><div class="col" id="user_data_3"><?php echo $result[$key]['last_name']; ?> </div></td>
                        <td><div class="col" id="user_data_4"><?php echo $result[$key]['unique4']; ?> </div></td>
                        <td><div class="col" id="user_data_6"><?php echo $result[$key]['task_details']; ?> </div></td>
                        <td><div class="col" id="user_data_7"><?php echo $result[$key]['retask_details']; ?></div></td>
                        <td><div class="col" id="user_data_8"><?php echo $result[$key]['task_time']; ?> </div></td>
                        <td><div class="col" id="user_data_9"><?php echo $result[$key]['retask_time']; ?> </div></td>
                        <td><div class="col" id="user_data_01"><?php echo $result[$key]['time_completed']; ?> </div>
                        </td>
                        
                    </tr>
                <?php
                    }
                    ?>
                    
                </tbody>
            </table>
            <?php
                }
                ?>  
        </div>
    </form>
</form>

<!-- Drop button for inprogress table end-->
<?php } ?>
<div class="card-footer small text-muted">Updated: <?php $date_utc = new \DateTime("now", new \DateTimeZone("Africa/Lagos"));

echo $date_utc->format(\DateTime::RFC850); ?></div>
</div>
</div>
<!-- report table end -->

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
    <script src="js/export.js"></script>

  </body>

</html>
<?php
}
else{
  header('location: landing.php');
}
?>