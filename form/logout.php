
<?php
require('connect.php');
ob_start();
$valid_user_id = trim($_SESSION["licenced_users"]);

//check if there is user
if (isset($_POST['logout'])){
    if(isset($_SESSION['licenced_user']));

  //perform query to check if the user is lodded in
  $sql_check = "SELECT * FROM signup_table WHERE login_status = true ";
  $result_check = mysqli_query($conn, $sql_check);

  //conditional statment for the person logged in
  if (mysqli_num_rows($result_check)>0){

    //to loggedout for logged in users we run our codes inside this logged in area
    $user = "";
    while($rows_check = mysqli_fetch_assoc($result_check)) {

      //get the user name frm the login details
      $user = $rows_check['email'];

    }
    if(isset($_POST['logout'])){

      //change users status to false when user logged out to protect the account
      $sql = "UPDATE signup_table SET login_status = false WHERE email = '$valid_user_id'";
      $result = mysqli_query($conn, $sql);
      if($result){
        //redirect user to login page if he log out
        session_destroy(); 
        header("location:landing.php");
      }else{
        echo "<script>alert('try again later!!!')</script>";
        }  
      }
    }
}
$conn = new mysqli("localhost","root","@!Abimbola@","control");
$user = "";
$sql = "SELECT id, email, password, firstname FROM signup_table WHERE email = '$valid_user_id'";
  $result_check = mysqli_query($conn, $sql);

  //conditional statment for the person logged in
  if (mysqli_num_rows($result_check)>0){

    //to loggedout for logged in users we run our codes inside this logged in area
    
    while($rows_check = mysqli_fetch_assoc($result_check)) {

      //get the user name frm the login details
      $user = $rows_check['firstname'];
      $user = ucfirst($user);
      $user1 = $rows_check['email'];

    }
}

//check if there is user
if (isset($_POST['logout'])){
    if(isset($_SESSION['licenced_user']));

  //perform query to check if the user is lodded in
  $sql_check = "SELECT * FROM ad_table WHERE login_status = true ";
  $result_check = mysqli_query($conn, $sql_check);

  //conditional statment for the person logged in
  if (mysqli_num_rows($result_check)>0){

    //to loggedout for logged in users we run our codes inside this logged in area
    $user = "";
    while($rows_check = mysqli_fetch_assoc($result_check)) {

      //get the user name frm the login details
      $user = $rows_check['ademail'];

    }
    if(isset($_POST['logout'])){

      //change users status to false when user logged out to protect the account
      $sql = "UPDATE ad_table SET login_status = false WHERE ademail = '$valid_user_id'";
      $result = mysqli_query($conn, $sql);
      if($result){
        //redirect user to login page if he log out
        session_destroy(); 
        header("location:admin.php");
      }else{
        echo "<script>alert('try again later!!!')</script>";
        }  
      }
    }
}

?>