<?php
require ('form/connect.php');

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
// define variable and set to empty values to avoid error before users input any information
$fnameErr = $lnameErr = "";
$fname = $lname = "";

$count=0;

if (isset($_POST["log"])) {
  $fcode = mysqli_real_escape_string($conn, $_POST["code"]);
  $feedback = mysqli_real_escape_string($conn, $_POST["feed"]);


    $to = "adespide@gmail.com"; // this is your Email address
    $from = "adespide@gmail.com"; // this is the sender's Email address
    $subject = "New requester's feedback";
    //$subject2 = "Copy of your form submission";
    //$message = $first_name . " " . $last_name . " wrote the following:" . "\n\n" . $_POST['message'];
  $message = " New feedback find details below: \n\nRequest code: " .$_POST['code']. "\n Details: ".$_POST['feed'].".";
  $headers = "From:" . $from;
  $headers2 = "From:" . $to;

if (!empty($fcode && $feedback)) {

  //insert the information into the databse
$sql = "INSERT INTO feed_table (unique4, feed, feed_date) VALUES('$fcode' , '$feedback', now())";

  //if the query is successful give the user the following messages using javascript alert function and take them to their portal
if (mysqli_query($conn, $sql)) {

   mail($to,$subject,$message,$headers);
      mail($from,$subject,$message,$headers2); // sends a copy of the message to the sender
      //echo "Mail Sent. Thank you " . $first_name . ", we will contact you shortly.";

    echo "<script> alert ('Feedback submited successfully !!!'); </script>";
     //the header redirect the user to the index.php page
      echo "<script> window.open('followup.php','_self'); </script>";
    
  }else{
    echo "<script> alert ('Form Not Submited !!!'); </script>" . $sql . "<br>" . mysqli_error($conn);
  }
}else{
     //if an error occur exit and display these alert msg
   echo"<script>alert('Please try again later!!!')</script>";
  }
}
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
	
.table--class table {
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0;
    border: 1px solid black;

}

.table--class tbody { box-sizing: border-box;display: block; }
.table--class tr{ box-sizing: border-box;display: block; }



/*any os other than mac*/
.table--class tbody {
  height: 200px;
  overflow-y: auto;
  width: 100%;
}



.table--class tbody td{
    width: 33.15%;
    float: left;
    border-right: 1px solid black;
}

.table--class thead th {
    width: 30.1%;
    float: left;
    border-right: 1px solid black;
    font-size: 13px;
}

.table--class {
    margin:0px;padding:0px;
    margin-left: auto;
    margin-right: auto;
    width:100%;
    box-shadow: 10px 10px 5px #888888;
    border:1px solid #4c7299;
    
    -moz-border-radius-bottomleft:0px;
    -webkit-border-bottom-left-radius:0px;
    border-bottom-left-radius:0px;
    
    -moz-border-radius-bottomright:0px;
    -webkit-border-bottom-right-radius:0px;
    border-bottom-right-radius:0px;
    
    -moz-border-radius-topright:0px;
    -webkit-border-top-right-radius:0px;
    border-top-right-radius:0px;
    
    -moz-border-radius-topleft:0px;
    -webkit-border-top-left-radius:0px;
    border-top-left-radius:0px;
}.table--class tr:last-child td:last-child {
    -moz-border-radius-bottomright:0px;
    -webkit-border-bottom-right-radius:0px;
    border-bottom-right-radius:0px;
}
.table--class table tr:first-child td:first-child {
    -moz-border-radius-topleft:0px;
    -webkit-border-top-left-radius:0px;
    border-top-left-radius:0px;
}
.table--class table tr:first-child td:last-child {
    -moz-border-radius-topright:0px;
    -webkit-border-top-right-radius:0px;
    border-top-right-radius:0px;
}.table--class tr:last-child td:first-child{
    -moz-border-radius-bottomleft:0px;
    -webkit-border-bottom-left-radius:0px;
    border-bottom-left-radius:0px;
}.table--class tr:hover td{
    background-color:#cccccc;
        

}
.table--class td{
    vertical-align:middle;
    
    background-color:#6699cc;

    border:1px solid #4c7299;
    border-width:0px 1px 1px 0px;
    text-align:left;
    padding:7px;
    font-size:10px;
    font-family:Arial;
    font-weight:normal;
    color:#ffffff;
}.table--class tr:last-child td{
    border-width:0px 1px 0px 0px;
}.table--class tr td:last-child{
    border-width:0px 0px 1px 0px;
}.table--class tr:last-child td:last-child{
    border-width:0px 0px 0px 0px;
}
.table--class tr:first-child th{
    
    border:0px solid #4c7299;
    text-align:center;
    border-width:0px 0px 1px 1px;
    font-size:15px;
    font-family:Arial Black;
    font-weight:bold;
    color:#1d53e5;
}
.table--class tr:first-child:hover th{

}
.table--class tr:first-child th:first-child{
    border-width:0px 0px 1px 0px;
}
.table--class tr:first-child th:last-child{
    border-width:0px 0px 1px 1px;
}

</style>
<style>

/* Button used to open the chat form - fixed at the bottom of the page */
.open-button {
  background-color: green;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 13px;
  right: 898px;
  width: 280px;
  z-index: 9;
  }

/* The popup chat - hidden by default */
.chat-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 835px;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 400px;
  padding: 10px;
  background-color: white;
}

/* Full-width textarea */
.form-container textarea {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
  resize: none;
  min-height: 200px;
}

/* When the textarea gets focus, do something */
.form-container textarea:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/send button */
.form-container .btn {
  background-color: #4CAF50;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
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
       <nav class="navbar navbar-expand navbar-dark bg-success static-top">
   <logo><img alt="FMN Logo" height="65" width="89" src="images/FMN_Logo.png" style="padding-right: 20px;"></logo><span><h2 style="font-weight: 200px;color: yellow;padding-left: 20px;">IVR</h2></span>
      <a class="navbar-brand mr-1" href="icform/icform2.php">&nbsp;&nbsp;Item Verification Requests</a>
      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>
        
      <!-- Navbar Search -->
      <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
          <strong>Today is: <?php $date_utc = new \DateTime("now", new \DateTimeZone("Africa/Lagos"));

echo $date_utc->format(\DateTime::RFC850); ?></strong>
          <div class="input-group-append">
          
            </button>
          </div>
        </div>
      </form>

      <!-- Navbar -->
      <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown no-arrow mx-1">
          <div>
            <div class="dropdown-divider"></div>
          </div>
        </li>
        <li class="nav-item dropdown no-arrow mx-1">
        </li>
        <li class="nav-item dropdown no-arrow">
        
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          </div>
        </li>
      </ul>

    </nav>
    <script>
      $(document).ready(function() {
      setInterval(function () {
        $("#result").load('count.php')
        $(".badge").load('count.php')
      }, 3000);
    });
    
    </script>

    <div id="wrapper">

       <!-- Sidebar -->
      <ul class="sidebar navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" >
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          
        </li>
      
      </ul>

      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          
<!-- report table -->

  <ol class="breadcrumb">

<li class="breadcrumb-item">

<a href="icform/icform2.php">Dashboard&nbsp;/&nbsp; </a>
</li>
<li><a href="icform/icform2.php">Home&nbsp;/&nbsp; </a></li>

<div id="prompt-form-container"> 
<form method="post" action="exportperfor.php" id="prompt-form" onsubmit="return isvalid() ">
  <div id="prompt-message"></div>
   <input name="text" id="reset" type="password" rese>
  <input type="submit" value="Ok">
  <input type="button" name="cancel" value="Exit">
</form>
 </div>
</ol>


<!-- Staff list strat -->

<div style="width: 700px;margin-left: 30px;">
   <p style="font-size: 20px; color: #111;font-weight: bold;border-radius: 5px;">Check Request Status</p>
   <p style="font-size: 12px; font-style:italic;">enter request code and search</p>
  
<form method="post" action="" >
  <input type="text" id="unique" name="unique" placeholder="Req. Code" style="height: 35px;">
  <span></span><button type="submit" class="btn btn-primary" name="check" >Search</button>
</form>
</div>

    <br class="clear">


         <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Task Status Report</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                     <tr>
                      <th>S/N</th>
                      <th>Request By</th>
                      <th>Department</th>
                      <th>Req. No</th>
                      <th>Request Status</th>
                      <th>Request Date</th>
                    </tr>
                  </thead>
                  <tfoot>
                     <tr>
                      <th>S/N</th>
                      <th>Request By</th>
                      <th>Department</th>
                      <th>Req. No</th>
                      <th>Request Status</th>
                      <th>Request Date</th>
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
  $uniq = mysqli_real_escape_string($conn, $_POST["unique"]);

  if (!empty($uniq)) {

$sql = "SELECT emp_id, CONCAT(fname, '  ', lname) AS requestName, unique4, dept, ass, submit_date FROM controlform WHERE unique4 ='$uniq';";

$result = $conn -> query($sql);

if(!empty($result)){
  $student = array();
  while ($row = $result->fetch_assoc()) {

   echo "<tr><td>"
   .$row['emp_id']."<td>".
   $row['requestName']."<td>".
   $row['dept']."<td>".
   $row['unique4']."<td>".
   $row['ass']."<td>".
   $row['submit_date'].
   "</td></tr>";
  }
}else{
  echo "<script>alert('No record!')</script>";
  }
}else{
  echo "<script>alert('Please fill the entry!')</script>";
}
}
$conn->close();
?>

</tbody>
</table>
</div>

</div>

<div class="card-footer small text-muted">Updated: <?php echo date('H:i:s - d-M-Y'); ?></div>
</div>

         <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Task Status Report</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                     <tr>
                      <th>S/N</th>
                      <th>Assigned To</th>
                      <th>Req. No</th>
                      <th>Task Status</th>
                      <th>Date/Time Assigned</th>
                      <th>Time Reopened</th>
                      <th>Time Completed</th>
                    </tr>
                  </thead>
                  <tfoot>
                     <tr>
                      <th>S/N</th>
                      <th>Assigned To</th>
                      <th>Req. No</th>
                      <th>Task Status</th>
                      <th>Date/Time Assigned</th>
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

if (isset($_POST["check"])) {
  $uniq = mysqli_real_escape_string($conn, $_POST["unique"]);

  if (!empty($uniq)) {

$sql = "SELECT id, CONCAT(first_name, '  ', last_name) AS Name, unique4, task_status, date_ass, task_time, time_reopen, time_completed FROM assform WHERE unique4 ='$uniq';";

$result = $conn -> query($sql);

if(!empty($result)){
  $student = array();
  while ($row = $result->fetch_assoc()) {

   echo "<tr><td>"
   .$row['id']."<td>".
   $row['Name']."<td>".
   $row['unique4']."<td>".
   $row['task_status']."<td>".
   $row['task_time']."<td>".
   $row['time_reopen']."<td>".
   $row['time_completed'].
   "</td></tr>";
  }
}else{
  echo "<script>alert('No record!')</script>";
  }
}else{
  echo "<script>alert('Please fill the entry!')</script>";
}
}
$conn->close();
?>

</tbody>
</table>
</div>
</div>
</div>
<div style="width: 700px;margin-left: 30px;">
   <p style="font-size: 20px; color: #111;font-weight: bold;border-radius: 5px;">Still not satisfy? Send us a message.</p><hr width="400">
  
<!-- <form method="post" action="" >
  <div class="form-group">
  <input type="text" id="unique" name="code" placeholder="Req. Code" style="height: 35px;">
</div>
  <div class="form-group">
<label><strong>Message</strong></label>
<textarea class="form-control" name="feed" ></textarea>
</div>
  <button type="submit" class="btn btn-primary" name="log" onclick="submitform()">Submit</button>
</form> -->

<button class="open-button" onclick="openForm()">Send us a message</button>

<div class="chat-popup" id="myForm">
  <form action="" method="post" class="form-container">
    <p style="font-size: 22px; font-weight: bold;">Enter Request Code First.</p><hr>
    <input type="text" id="unique" name="code" placeholder="Req. Code" style="height: 35px;" required><br><br>
    <label for="msg"><b>Message</b></label><br>
    <textarea placeholder="Type message.." name="feed" required></textarea>

    <button type="submit" name="log" class="btn" onclick="submitform()">Send</button>
    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
  </form>
</div>

<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>
<script>
    function submitform(){
        $('#registeration').find('form').submit();
        $('.clearFields').val('');
    }
</script>
</div>

<br class="clear">
<br class="clear">
<hr>
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
