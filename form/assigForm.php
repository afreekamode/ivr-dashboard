<?php
require_once ('logout.php');
require ('form/connect.php');

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
// define variable and set to empty values to avoid error before users input any information
$fnameErr = $lnameErr = $locatErr = $jassignErr = $jlocateErr = $jrequestErr = $jrequest1Err = $jstatusErr = "";
$fname = $lname = $locat = $dept = $recv_date = $jRdetails = $phone = "";
date_default_timezone_set('Africa/Lagos');
$count=0;

if (isset($_POST["reg_j"])) {
  $fname = mysqli_real_escape_string($conn, $_POST["fname"]);
  $lname = mysqli_real_escape_string($conn, $_POST["lname"]);
  $jlocate = mysqli_real_escape_string($conn, $_POST["jlocate"]);
  $jrequest = mysqli_real_escape_string($conn, $_POST["jrequest"]);
  $jrequest1 = mysqli_real_escape_string($conn, $_POST["jrequest1"]);
  $jstatus = mysqli_real_escape_string($conn, $_POST["jstatus"]);
  $Rfname = mysqli_real_escape_string($conn, $_POST["ref"]); 
  $jdetails = mysqli_real_escape_string($conn, $_POST["jdetails"]);
  $date = date("Y-m-d H-i-s");
  $taskcount = 1;

$sql ="SELECT * FROM assform WHERE status = 0";
$result=mysqli_query($conn, $sql);
$count=mysqli_num_rows($result);

 //conditional to stop resubmit if already assigned


$sql ="SELECT * FROM controlform WHERE ass = 'assigned'";
$result_new=mysqli_query($conn, $sql);

  if (mysqli_num_rows($result_new)>0){

  
    $unique = "";
    while($rows_check = mysqli_fetch_assoc($result_new)) {

      
      $unique = $rows_check['unique4'];

      if ($unique === "$Rfname") {
  header('location: jobass.php');
  
  die();
  }

    }
}

  //insert the information into the databse
$sql = "INSERT INTO assform (first_name, last_name, assignee, task_locate, unique4, task_request, task_request1, task_status, task_details, retask_details, date_ass, task_time, task_acc, request_feed) 
VALUES('$fname' , '$lname', '$user', '$jlocate', '$Rfname', '$jrequest', '$jrequest1', '$jstatus', '$jdetails', '$jRdetails', now(), '$date', '$taskcount', '')";
 //if the query is successful give the user the following messages using javascript alert function and take them to their portal
if (mysqli_query($conn, $sql)) {

$sql_updates = "UPDATE assform SET ass = 'assigned' WHERE (first_name = '$fname' AND last_name = '$lname' AND unique4 = '$Rfname')";

  //if the query is successful give the user the following messages using javascript alert function and take them to their portal
if (mysqli_query($conn, $sql_updates)) {

    echo "<script> alert ('Task Assigned successfully !!!'); </script>";
    }
  }else{
    echo "<script> alert ('Form Not Submited !!!'); </script>" . $sql . "<br>" . mysqli_error($conn);
  }
}

if (isset($_POST['reg_j'])){
    $first_name= $_POST['fname'];
    $last_name= $_POST['lname'];
    $jlocate = $_POST['jlocate'];
    $jrequest = trim($_POST['jrequest']);
    $jrequest1 = trim($_POST['jrequest1']);
    $Rfname = trim($_POST['ref']);

    $to = "ivr@fmnplc.com"; // this is your Email address
    $from = "adespide@gmail.com"; // this is the sender's Email address
    $subject = "A new task assigned";
    //$subject2 = "Copy of your form submission";
    //$message = $first_name . " " . $last_name . " wrote the following:" . "\n\n" . $_POST['message'];
    $message = "Task has been assigned to " . $first_name . " ". $last_name . ", find details below: \n\n Department: ". $_POST["jlocate"]. ", \n\nRequester: ".$_POST['jrequest']. ", ".$_POST['jrequest1']. " , \n\nrequest code: " .$_POST['ref'].".";
    $headers = "From:" . $from;
    $headers2 = "From:" . $to;

    //to check if an userinput data in the forms
  if (!empty($fname && $jrequest)) {

    //select all the entries in the database check if that username or password exist?
    $sql_check = "SELECT * FROM controlform WHERE (fname = '$jrequest' AND lname = '$jrequest1' AND recv = '$jlocate' AND unique4 = '$Rfname')";
    $result_check = mysqli_query($conn, $sql_check);
    //condition statement to check if the data exist

    if(mysqli_num_rows($result_check) > 0){

      //Update query syntax for login status
      $sql_update = "UPDATE controlform SET ass = 'assigned' WHERE (fname = '$jrequest' AND lname = '$jrequest1' AND unique4 = '$Rfname')";
      $result_update = mysqli_query($conn, $sql_update);

      //condition statement to check if it updates
      if($result_update){
        //used to check output of each row data 
      while($row_check = mysqli_fetch_assoc($result_check)){

      mail($to,$subject,$message,$headers);
      //mail($to1,$subject,$message,$headers);
      mail($from,$subject,$message,$headers2); // sends a copy of the message to the sender
      //echo "Mail Sent. Thank you " . $first_name . ", we will contact you shortly.";
      echo"<script>alert('Assigned!!!')</script>";
          //the header redirect the user to the index.php page
      echo "<script> window.open('jobass.php','_self'); </script>";
        }
      }else{
        //if an error occur exit and display these alert msg
        echo"<script>alert('Please try again later!!!')</script>";
      }

    }else{
      echo "<script>alert('Incorrect Staff name!')</script>";
    }

    }else{
      echo "<script>alert('kindly fill all the entry in the form!!!')</script>";
    }
  }


  
$conn->close();
?>