<?php
require('function.php');
require('connect.php');

ob_start();
$valid_user_id = trim($_SESSION["licenced_users"]);

if (isset($_POST['addnew'])){
//check if there is user
    if(isset($_SESSION['licenced_user']));

  //perform query to check if the user is lodded in
  $sql_check = "SELECT * FROM ad_table WHERE login_status = true";
  $result_check = mysqli_query($conn, $sql_check);

  //conditional statment for the person logged in
  if (mysqli_num_rows($result_check)>0){

    //to loggedout for logged in users we run our codes inside this logged in area
    $user = "";
    while($rows_check = mysqli_fetch_assoc($result_check)) {

      //get the user name frm the login details
      $user = $rows_check['ademail'];

    if ($user == 'odada@fmnplc.com') {

$fnameErr = $lnameErr ="";
  $name1 = mysqli_real_escape_string($conn, $_POST["fname"]);
  $name2 = mysqli_real_escape_string($conn, $_POST["lname"]);
  $fname = strtoupper($name1);
  $lname = strtoupper($name2);

if (!empty($fname && $lname)) {

$sql ="SELECT * FROM empda WHERE (first_name = '$fname' AND last_name = '$lname')";
$result_new=mysqli_query($conn, $sql);

$data = mysqli_fetch_array($result_new);
if($data < 1) {
  //insert the information into the databse
$sql = "INSERT INTO empda (first_name, last_name) VALUES('$fname' , '$lname')";
 //if the query is successful give the user the following messages using javascript alert function and take them to their portal
if (mysqli_query($conn, $sql)) {

    echo "<script> alert ('Staff name added successfully !!!'); </script>";
    echo "<script> window.open('signup.php?addnew','_self'); </script>";
        }
      }else{
        //if an error occur exit and display these alert msg
        echo "<script>alert('Staff name already exist in the databse!')</script>";
      echo "<script> window.open('signup.php?addnew','_self'); </script>";
      }
    }else{
      echo "<script>alert('kindly fill all the entry in the form!!!')</script>";
      echo "<script> window.open('signup.php?addnew','_self'); </script>";
    }
    }else{
      echo"<script>alert('Most be an admin to perform this action!!!')</script>";
        echo "<script> window.open('signup.php?addnew','_self'); </script>";
        
    }
  }
}
}
	// //reset Page Ends here
?>