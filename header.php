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
            <a href="jobass.php?$user"><p style="margin:30px 30px 10px 30px; color: green; text-align: center; border-radius: 5px; border:1px solid green; width: 130px; float: right;">Assign Task</p></a>
            <h6 class="dropdown-header">New Messages:</h6>
            <div class="dropdown-divider"></div>
            <?php
            echo '<a class="dropdown-item" href="">';
              
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
          <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-envelope fa-fw"></i>
            <span class="badge badge-danger" id="feed-count"></span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
            <h6 class="dropdown-header">New Alerts:</h6>
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

<a class="dropdown-item" href="#">

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
            <a class="dropdown-item" href="#">Settings</a><a class="dropdown-item" href="signup.php?reset" style="color: blue;">Reset Password</a>
            <a class="dropdown-item" href="signup.php?update">Forgot Password?</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal" style="color: red;">Logout</a>
          </div>
        </li>
      </ul>

    </nav>
    <script>
      $(document).ready(function() {
      setInterval(function () {
        $("#result").load('count.php')
        $("#notification-count").load('count.php')
        $("#feed-count").load('count_feed.php')
      }, 3000);
    });
    
    </script>
