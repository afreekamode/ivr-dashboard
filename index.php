<?php
require_once ('form/function.php');
require_once ('form/errors.php');
require_once ('form/connect.php');
require_once ('form/logout.php');
ob_start();
$valid_user_id = trim($_SESSION["licenced_users"]);

if(isset($_SESSION["licenced_users"]) && !empty($valid_user_id))
{


?> 
<!DOCTYPE html>
<html>
  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE9" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IVR Portal</title>

    <link rel="icon"  type="image/x-icon" href="favicon.ico">  <link href="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript">
    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link href="scss/sb-admin.css" rel="stylesheet">
  <link href="scss/_global.css" rel="stylesheet">
<link href="scss/_navbar.css" rel="stylesheet">
<script type="text/javascript" src="js/jquery.js"></script>
  </head>

  <body id="page-top">
    <nav class="navbar navbar-expand navbar-dark bg-success static-top">
    <logo><img alt="FMN Logo" height="65" width="89" src="images/FMN_Logo.png" style="padding-right: 20px;"></logo><span><h2 style="font-weight: 200px;color: yellow;padding-left: 20px;">IVR</h2></span>
      <a class="navbar-brand mr-1" href="dash.php">&nbsp;&nbsp;Item Verification Requests</a>
      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>
        
      <!-- Navbar Search -->
      <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
          <?php echo "<span style='color : #fff;' > $valid_user_id </span>";?><span></span>
          <strong>Today is: <?php $date_utc = new \DateTime("now", new \DateTimeZone("Africa/Lagos"));

echo $date_utc->format(\DateTime::RFC850); ?></strong>
          <div class="input-group-append">
          
            </button>
          </div>
        </div>
      </form>

      <!-- Navbar -->
      <ul class="navbar-nav ml-auto ml-md-0">
<li class="nav-link">
      		<a href="vendor/IVRHelp.pdf" alt='Help page' target="_blank">
      		<i class="fas fa-fw"  id="notification-icon"><span>Q?</span> </i>
      	</a>
      	</li>
        <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" onclick="Function()" id="notification-icon" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          
            <i class="fas fa-bell fa-fw"  id="notification-icon"></i>
            <span class="badge badge-danger" id="notification-count"></span>
            <div id="notification-latest"></div>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
            <a href="jobass.php"><p style="margin:30px 30px 10px 30px; color: green; text-align: center; border-radius: 5px; border:1px solid green; width: 130px; float: right;">Assign Task</p></a>
            <h6 class="dropdown-header">New Messages:</h6>
            <div class="dropdown-divider"></div>
            <?php
            echo '<a class="dropdown-item" href="jobass.php?$user">';
              
$conn = new mysqli("localhost","root","@!Abimbola@","control");

$sql="UPDATE controlform SET status=1 WHERE status=0 ;";  
$result=mysqli_query($conn, $sql);

$sql="SELECT * FROM controlform WHERE ass = 'unassigned' ORDER BY emp_id DESC LIMIT 3;";
$result=mysqli_query($conn, $sql);

if($result)
{

$response='';

while($row1=mysqli_fetch_array($result)) {
  $response = $response . "<strong class='notification-subject'>". $row1["fname"] . "</strong>" .
  "<div class='dropdown-message small'><strong> Dept.: </strong >" . $row1["dept"]  . "</div>" .
  "<div class='dropdown-message small'><strong>Location: </strong> " . $row1["locat"]  . "</div>" .
  "<div class='dropdown-message small'><strong>Priority: </strong> " . $row1["priority"]  . "</div>" .
  "<div class='dropdown-message small'><strong>Phone: </strong>" . $row1["phone"]  . "</div>" .
  "<div class='dropdown-message small'><strong>Descp.: </strong>" . $row1["unique4"]  . "</div>" .
  '<span class="small float-right text-muted"><strong>Time: </strong> ' . $row1["submit_date"]  .'</span>' .
  "<div class='dropdown-divider'></div>";
  
}

if(!empty($response)) {
  print $response;

}
  echo "</a>";
}

?> 
<a class="dropdown-item small" href="jobass.php?$user">View all messages</a>
          </div>
        </li>
        <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link dropdown-toggle" href="feedtable.php" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            
            <i class="fas fa-envelope fa-fw"></i>
            <span class="badge badge-danger" id="feed-count"></span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
            <h6 class="dropdown-header">New Feeds:</h6>
            <div class="dropdown-divider"></div>

         <?php
            echo '<a class="dropdown-item" href="feedtable.php">';
              
$conn = new mysqli("localhost","root","@!Abimbola@","control");

$sql="SELECT *, feed_table.unique4 AS code,feed_table.id AS id, controlform.unique4 AS code, CONCAT(controlform.fname, ' ', controlform.lname)AS Name, feed_table.feed AS feed, feed_table.feed_date AS fdate, controlform.phone AS phone, controlform.dept AS dept
FROM feed_table
INNER JOIN controlform ON feed_table.unique4=controlform.unique4 WHERE feed_table.status = 'notsolve' ORDER BY fdate DESC LIMIT 3;";
$result=mysqli_query($conn, $sql);

if($result)
{

$response1='';

while($row1=mysqli_fetch_array($result)) {
  $response1 = $response1 . "<strong class='notification-subject'>". $row1["Name"] . "</strong>" .
  "<div class='dropdown-message small'><strong> Dept.: </strong >" . $row1["dept"]  . "</div>" .
  "<div class='dropdown-message small'><strong>Phone: </strong>" . $row1["phone"]  . "</div>" .
  "<div class='dropdown-message small'><strong>Req. Code.: </strong>" . $row1["code"]  . "</div>" .
  "<div class='dropdown-message small'><strong>Details: </strong>" . $row1["feed"]  . "</div>" .
  "<div class='dropdown-message small'><strong>Details: </strong>" . $row1["fdate"]  . "</div>" .
  "<div class='dropdown-divider'></div>";
  
}

if(!empty($response1)) {
  print $response1;

}
  echo "</a>";
}

?>

<div class="dropdown-divider"></div>

<a class="dropdown-item" href="feedtable.php">

<span class="text-success">

<strong>

<i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>

</span>

<span class="small float-right text-muted"><?php echo date('H:m:s'); ?></span>

<div class="dropdown-message small">This is an automated server response message. All systems are online.</div>

</a>

<div class="dropdown-divider"></div>

<a class="dropdown-item small" href="feedtable.php">View all alerts</a>
          </div>
        </li>
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           
            <i class="fas fa-user-circle fa-fw"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="#">Settings</a>
            <a class="dropdown-item" href="signup.php?reset" style="color: blue;">Reset Password</a>
            <a class="dropdown-item" href="signup.php?update">Forgot Password?</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal" style="color: red;">Logout</a>
          </div>
        </li>
      </ul>

    </nav>

    <div id="wrapper">

      <!-- Sidebar -->
      <ul class="sidebar navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-user"></i>
            <span></span><?php echo "<span style='color : yellow;' >Welcome $user</span>";?>
          </a>
         <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <hr>
           <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal" style="color: blue;">Logout</a>
            <a class="dropdown-item" href="login.php?logadmin" style="color: blue;">Signup</a>
            <a class="dropdown-item" href="signup.php?update">Forgot Password</a>
            <div class="dropdown-divider"></div>
            <div class="card-footer small text-muted"></div>
          </div>
        </li>
         <li class="nav-item">
          <a class="nav-link" href="jobass.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            
            <span>Assign a task</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="performance.php">
            <i class="fas fa-fw fa-table"></i>
            
            <span>All Assigned Tasks</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="charts.php">
            <i class="fas fa-fw fa-chart-area"></i>
            
            <span>Performance Charts</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="login.php?logad">
            <i class="fas fa-fw fa-table"></i>
            
            <span class="table1">Performance Tables</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="new_request.php?user">
            <i class="fas fa-fw fa-table"></i>
            <span>New Requests Table</span></a>
        </li>
      </ul>

      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Overview</li>
            <li class="breadcrumb-item active"></li>


<div id="prompt-form-container"> 
 </div>
</ol>
          <!-- Icon Cards-->

          <div class="row">
            <div title="view contents" class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-bell"></i>
                  </div>
                 
                  <div class="mr-5" ><span id="result"></span> New Requests</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="jobass.php?$user" target="_self">
                  <span class="float-left">View Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            <div title="view contents" class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-warning o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-list"></i>
                  </div>
                  
                  <div class="mr-5"><?php if($count1>0) { echo $count1; } ?> Assigned Tasks!
                  </div>
                </div>
             <a class="card-footer text-white clearfix small z-1" href="performance.php">
                  <span class="float-left">View Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            <div title="view contents" class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-danger o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-table"></i>
                  </div>

                  <div class="mr-5"><?php if($count3>0) { echo $count3; } ?> Uncompleted Tasks!</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="performance.php">
                  <span class="float-left">View Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            <div title="view contents" class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-success o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-folder"></i>
                  </div>
                  
                  <div class="mr-5"><?php if($count2>0) { echo $count2; } ?> Completed Tasks!</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="login.php?logad">
                  <span class="float-left">View Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
          </div>

          <!-- Area Chart Example-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-chart-area"></i>
              Activities Chart</div>
            <div class="card-body">
              <canvas id="myAreaChart" width="100%" height="30"></canvas>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div>

          <div class="row">
            <div class="col-lg-8">
              <div class="card mb-3">
                <div class="card-header">
                  <i class="fas fa-chart-bar"></i>
                  Staff Performance Level Chart</div>
                <div class="card-body">
                  <canvas id="myBarChart" width="100%" height="50"></canvas>
                </div>
                <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="card mb-3">
                <div class="card-header">
                  <i class="fas fa-chart-pie"></i>
                  Tasks Status Chart</div>
                <div class="card-body">
                  <canvas id="myPieChart" width="100%" height="100"></canvas>
                </div>
                <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
              </div>
            </div>
          </div>

          <p class="small text-center text-muted my-5">
            <em>More chart coming soon...</em>
          </p>

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
      <script src="js/export.js"></script>
      
    <!-- Demo scripts for this page-->
    <script src="js/demo/datatables-demo.js"></script>
   <!-- <script src="js/demo/chart-area-demo.js"></script>--> 

       <!-- Demo scripts for this page-->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-bar-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

  <!-- script for counter auto load -->
  <script>
    $(document).ready(function() {
      setInterval(function () {
        $("#result").load('count.php')
        $("#notification-count").load('count.php')
        $("#feed-count").load('count_feed.php')
      }, 3000);
    });
   
</script>
</div>
</body>
</html>
<?php
}
else{
  header('location: landing.php');
}
?>