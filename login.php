<?php require('form/form.php');

// $sql="SELECT adpascode FROM ad_table ";
// $result=mysqli_query($conn, $sql);
// $count=mysqli_num_rows($result);
// if(!empty($count)) { 
//   $count;
// }
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>IVR | Users Login</title>
<link rel="icon"  type="image/x-icon" href="favicon.ico">
<!-- Required header files -->
<script type="text/javascript" src="js/logjs/jquery_1.5.2.js"></script>
<script type="text/javascript" src="js/logjs/login.js"></script>
<link href="css/logstyle.css" rel="stylesheet" type="text/css">

<!-- <script>
var remainingAttempts = 3;

function checkDetails() {
    var password = user.passwd.value;
    console.log('password', password);
    var validPassword = validatePassword(password);
    if (validPassword) {
        alert('Login successful');
    } else {
        user.passwd.value = '';
        remainingAttempts-;

        var msg = '';
        if (validPassword) {
            msg += 'Username incorrect: ';
        } else {
            msg += 'The field cannot be empty: ';
        }

        msg += remainingAttempts + ' attempts left.';
        alert(msg);

        if (remainingAttempts <= 0) {
            alert('Closing window...');
    		window.location="index.php";
}
        }
    }

    return validPassword;
}

function validatePassword(password) {
    return password == $count;
}
</script> -->

</head>
<body>
<br clear="all">

<?php if (isset($_GET['login'])){ ?>
<center>
<div style=" font-family:Verdana, Geneva, sans-serif; font-size:24px;">Registered Users Login Page</div><br clear="all" /><br clear="all" /><br clear="all">



<div style="padding-bottom: 20px;" id="programming_blog_wrapper">
<form method="post" action="" id="user">
<div class="" align="left" style="width:120px; float:left;font-family:Verdana, Geneva, sans-serif; font-size:16px; font-weight:bold;">Users Login</div>

<div class="lebels_fields" align="left">Please complete the form below to login.</div><br clear="all"><br clear="all">

<div class="lebels" align="left">Email Address:</div>
<div class="lebels_fields" align="left"><input type="text" name="username" id="email" class="blog_form" autocomplete="off"/></div><br clear="all"><br clear="all">

<div class="lebels" align="left">Password:</div>
<div class="lebels_fields" align="left"><input type="password" name="password" id="passwd" class="blog_form" autocomplete="off"/></div><br clear="all"><br clear="all"><br clear="all">

<div class="lebels" align="left">&nbsp;</div>
<div style="width:300px;float:left;"><button type="submit" name="login" onclick="user_log();" class="general_button">Login</button><a href="login.php?logadmin" class="general_button">Sign Up</a><br></button>	
</div><br clear="all"><br clear="all">
<br clear="all">
<div class="lebels" align="left">&nbsp;</div>
<div class="lebels_fields" align="left" id="login_status" style="color: red;"><?php echo "$Errmsg1","$Errmsg2","$Errmsg3";?>
</div>
</form>
<br clear="all" /><br clear="all" />
<div style="font-family:Verdana, Geneva, sans-serif; font-size:12px;" align="center">
<br />
Designed by<br>  Business Assurance, IT Audit Dept., FMN PLC.

</div>

</center>

<?php } ?>

<?php if (isset($_GET['logadmin'])){ ?>
<center>
<div style=" font-family:Verdana, Geneva, sans-serif; font-size:24px;">Admin Login Page</div><br clear="all" /><br clear="all" /><br clear="all">



<div style="padding-bottom: 20px;" id="programming_blog_wrapper">
<form method="post" action="" id="user">
<div class="" align="left" style="width:120px; float:left;font-family:Verdana, Geneva, sans-serif; font-size:16px; font-weight:bold;">Admin Login</div>

<div class="lebels_fields" align="left">Please complete the form below to login.</div><br clear="all"><br clear="all">

<div class="lebels" align="left">Email Address:</div>
<div class="lebels_fields" align="left"><input type="text" name="adusername" id="ademail" class="blog_form" autocomplete="off"/></div><br clear="all"><br clear="all">

<div class="lebels" align="left">Password:</div>
<div class="lebels_fields" align="left"><input type="password" name="adpassword" id="adpasswd" class="blog_form" autocomplete="off"/></div><br clear="all"><br clear="all"><br clear="all">

<div class="lebels" align="left">&nbsp;</div>
<div style="width:300px;float:left;" align="left"><button type="submit" name="logad" onclick="admn_log();" class="general_button">Login</button><a href="dash.php" class="general_button">Not Admin? Back</a><br></button>	
</div><br clear="all"><br clear="all">
<a href="signup.php?update" style="text-decoration: none;">Forgot Password?</a>
<br clear="all">
<div class="lebels" align="left">&nbsp;</div>
<div class="lebels_fields" align="left" id="adm_status" style="color: red;"><?php echo "$Errmsg4","$Errmsg5","$Errmsg6";?>
</div>
</form>
<br clear="all" /><br clear="all" />
<div style="font-family:Verdana, Geneva, sans-serif; font-size:12px;" align="center">
<br />
Designed by <br> Business Assurance, IT Audit Dept., FMN PLC.

</div>

</center>
<?php } ?>

<?php if (isset($_GET['logad'])){ ?>
<center>
<div style=" font-family:Verdana, Geneva, sans-serif; font-size:24px;">Input Pass Code.</div><br clear="all" /><br clear="all" /><br clear="all">



<div style="padding-bottom: 20px;" id="programming_blog_wrapper">
	<p>Provide passcode to access this page.</p><br>
<form method="post" action="" id="user" >
<div class="" align="left" style="width:120px; float:left;font-family:Verdana, Geneva, sans-serif; font-size:16px; font-weight:bold;"></div>

<div class="lebels" align="left">* Passcode:</div>
<div class="lebels_fields" align="left"><input type="password" name="pascode" id="passwd" class="blog_form" autocomplete="off"/></div><br clear="all"><br clear="all"><br clear="all">

<div class="lebels" align="left">&nbsp;</div>
<div style="width:300px;float:left;" align="left"><button type="submit" name="pass" class="general_button" onclick="pas_log();">Ok</button> <a href="dash.php" class="general_button">Cancel</a><br></button>	

</div><br clear="all"><br clear="all">
<br clear="all">
<div class="lebels" align="left">&nbsp;</div>
<div class="lebels_fields" align="left" id="pas_status" style="color: red;"><?php echo "$Errmsg4p","$Errmsg5p","$Errmsg6p" ;?>
</div>
</form>
<br clear="all" /><br clear="all" />
<div style="font-family:Verdana, Geneva, sans-serif; font-size:11px;" align="center">
<br />
Designed by <br> Business Assurance, IT Audit Dept., FMN PLC.

</div>

</center>
<!-- script for counter auto load -->
  <script>
    $(document).ready(function() {
      setInterval(function () {
  window.location.replace("landing.php")
      }, 60000);
    });

    $(document).ready(function() {
      setInterval(function () {
      	alert ('You will be redirect in 15secs !!!');
      }, 45000);
    });
</script>
<?php } ?>
</body>
</html>