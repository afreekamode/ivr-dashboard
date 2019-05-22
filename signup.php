<?php
require('form/addnew.php');
require('form/connect.php');
$user = "";
$sql = "SELECT * FROM signup_table WHERE login_status = false ORDER BY id DESC LIMIT 1";
  $result_check = mysqli_query($conn, $sql);

  //conditional statment for the person logged in
  if (mysqli_num_rows($result_check)==1){

    //to loggedout for logged in users we run our codes inside this logged in area
    
    while($rows_check = mysqli_fetch_assoc($result_check)) {

      //get the user name frm the login details
      $user = $rows_check['firstname'];
      $user = ucfirst($user);

    }
}

?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>IVR | Users Registration</title>

<link rel="icon"  type="image/x-icon" href="favicon.ico">
<!-- Required header files -->
<script type="text/javascript" src="js/logjs/jquery_1.5.2.js"></script>
<script type="text/javascript" src="js/logjs/save_details.js"></script>
<script type="text/javascript" src="js/logjs/update_pass.js"></script>
<script type="text/javascript" src="js/logjs/reset_pass.js"></script>

<link href="css/logstyle.css" rel="stylesheet" type="text/css">

</head>

<body>
<br clear="all">
<center>

<?php if (isset($_GET['signup'])){ ?>
<div style=" font-family:Verdana, Geneva, sans-serif; font-size:24px;">New Users Registration Page</div><br clear="all" /><br clear="all" /><br clear="all">
<div style="" id="programming_blog_wrapper">

<div class="" align="left" style="width:120px; float:left;font-family:Verdana, Geneva, sans-serif; font-size:16px; font-weight:bold;">Sign Up</div>
<div class="lebels_fields" align="left">Please complete the form below to sign up.</div><br clear="all"><br clear="all">
<div class="lebels" align="left">*Your Firstname:</div>
<div class="lebels_fields" align="left"><input type="text" id="firstname" name="firstname" class="blog_form" /></div><br clear="all"><br clear="all">

<div class="lebels" align="left">*Your Lastname:</div>
<div class="lebels_fields" align="left"><input type="text" id="lastname" name="lastname" class="blog_form" /></div><br clear="all"><br clear="all">

<div class="lebels" align="left">*Email Address:</div>
<div class="lebels_fields" align="left"><input type="text" id="email" name="email" class="blog_form" /></div><br clear="all"><br clear="all">

<div class="lebels" align="left">*Desired Password:</div>
<div class="lebels_fields" align="left"><input type="password" id="passwd" name="passwd" class="blog_form" /></div><br clear="all"><br clear="all">

<div class="lebels" align="left">*Repeat Password:</div>
<div class="lebels_fields" align="left"><input type="password" id="rpasswd" name="rpasswd" class="blog_form" /></div><br clear="all"><br clear="all">
<br clear="all">
<div class="lebels" align="left">&nbsp;</div>
<div style="width:300px;float:left;" align="left"><button type="submit" name="signup"  onclick="users_registration();" class="general_button">Submit</button><a href="login.php?login" class="general_button">Back to Login</a></div><br clear="all">
<div class="lebels" align="left">&nbsp;</div>
<div class="lebels_fields" align="left" id="signup_status"></div><br clear="all">
</div>
</center><br>
<?php } ?>


<?php if (isset($_GET['update'])){ ?>
<div style=" font-family:Verdana, Geneva, sans-serif; font-size:24px;">Update Password</div><br clear="all" /><br clear="all" /><br clear="all">
<div style="" id="programming_blog_wrapper">

<div class="" align="left" style="width:120px; float:left;font-family:Verdana, Geneva, sans-serif; font-size:16px; font-weight:bold;">Update</div>
<div class="lebels_fields" align="left">Enter email to update your credential.</div><br clear="all"><br clear="all">

<div class="lebels" align="left">*Email Address:</div>
<div class="lebels_fields" align="left"><input type="text" id="email" name="email" class="blog_form" /></div><br clear="all"><br clear="all">

<div class="lebels" align="left">*Password:</div>
<div class="lebels_fields" align="left"><input type="password" id="updatepasswd" name="updatepasswd" class="blog_form" /></div><br clear="all"><br clear="all">
<br clear="all">
<div class="lebels" align="left">&nbsp;</div>
<div style="width:300px;float:left;" align="left"><a href="javascript:void(0);" onclick="update_registration();" class="general_button">Submit</a><a href="login.php?login" class="general_button">Back to Login</a></div><br clear="all">
<div class="lebels" align="left">&nbsp;</div>
<div class="lebels_fields" align="left" id="signup_status"></div><br clear="all">

</div>
</center><br>
<?php } ?>

<?php if (isset($_GET['reset'])){ ?>
<div style=" font-family:Verdana, Geneva, sans-serif; font-size:24px;">Reset Password</div><br clear="all" /><br clear="all" /><br clear="all">
<div style="" id="programming_blog_wrapper">

<div class="" align="left" style="width:120px; float:left;font-family:Verdana, Geneva, sans-serif; font-size:16px; font-weight:bold;">Update</div>
<div class="lebels_fields" align="left">Enter email to reset your credential.</div><br clear="all"><br clear="all">

<div class="lebels" align="left">*Email Address:</div>
<div class="lebels_fields" align="left"><input type="text" id="email" name="email" class="blog_form" /></div><br clear="all"><br clear="all">

<div class="lebels" align="left">*Old Password:</div>
<div class="lebels_fields" align="left"><input type="password" id="resetpasswd1" name="resetpasswd1" class="blog_form" /></div><br clear="all">
<br clear="all">

<div class="lebels" align="left">*New Password:</div>
<div class="lebels_fields" align="left"><input type="password" id="resetpasswd2" name="resetpasswd2" class="blog_form" /></div><br clear="all"><br clear="all">
<br clear="all">
<div class="lebels" align="left">&nbsp;</div>
<div style="width:300px;float:left;" align="left"><a name="reset" onclick="reset_registration();" class="general_button">Submit</a><a href="login.php?login" class="general_button">Back to Login</a></div><br clear="all">
<div class="lebels" align="left">&nbsp;</div>
<div class="lebels_fields" align="left" id="signup_status"></div><br clear="all">

</div>
</center><br>
<?php } ?>

<?php if (isset($_GET['welcome'])){ ?>
<center>
<div style="" id="programming_blog_wrapper">

<div class="" align="left" style="width:200px; float:left;font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold;">Signup Successfull...<br><br><?php echo "<span style='color : green;font-size:15px;' > Welcome " .$user. " ! </span>";?></div>

<span></span><a href="login.php?login" class="general_button">Login Here</a><br clear="all">
<div class="lebels" align="left">&nbsp;</div>
<div class="lebels_fields" align="left" id="signup_status"></div><br clear="all">
<?php } ?>

<?php if (isset($_GET['addnew'])){ ?>

<div style=" font-family:Verdana, Geneva, sans-serif; font-size:24px;">Update Staff Table</div><br clear="all" /><br clear="all" /><br clear="all">
<div style="" id="programming_blog_wrapper">
<form method="post" action="">
    <div class="form-group">
   <div class="lebels">*First Name:</div>
  <input type="text" id="fname" name="fname" required="">
</div><br class="clear">
  <div class="form-group">
  	<div class="lebels">*last Name:</div>
  <input type="text" id="lname" name="lname" required="">
</div><br class="clear">
  <button type="submit" style="margin-bottom:10px;" name="addnew" >Submit</button><br class="clear">
  <span></span><a href="login.php?logadmin" >Login as Admin</a>&nbsp;|<span></span><a href="dash.php" >Home</a>
      </form><br class="clear">
    </div>
</div>
<br class="clear">
<?php } ?>

</div>
</center>
<div style="font-family:Verdana, Geneva, sans-serif; font-size:11px;" align="center">
<div style="width:200px; border:1px solid #CCC; padding:10px;" align="center">

</div>
<br />
Designed by <br> Sikiru Shittu.

</div>
</body>
</html>