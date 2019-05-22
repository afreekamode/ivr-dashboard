<?php
require_once ('logout.php');
$servername = "localhost";
$username =  "root";
$password = "@!Abimbola@";
$DBname = "control";

// create connection
$conn = mysqli_connect($servername, $username, $password, $DBname);
//check connection
if (!$conn) {
  die("connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM controlform ORDER BY emp_id DESC limit 5;";

$result = $conn -> query($sql);

if($result -> num_rows > 0){
  $student = array();
  while ($row = $result->fetch_assoc()) {

  $student['emp_id'] = $row["emp_id"];
  $student['name'] = $row["fname"];
  $student['name'] = $row["lname"];
  $student['dept'] = $row["dept"];
  $student['locat'] = $row["locat"];
  $student['recv'] = $row["recv"] ;
  $student['recv_date'] = $row["recv_date"];
  $student['priority'] = $row["priority"];
  $student['phone'] = $row["phone"];
  $student['descp'] = $row["descp"];
  $student['submit_date'] = $row["submit_date"];
  }
 }



//task assigned count
$sql="SELECT * FROM assform WHERE status = 0";
$result=mysqli_query($conn, $sql);
$count1=mysqli_num_rows($result);

//task completed count
$sql="SELECT * FROM assform WHERE task_status = 'completed' ";
$result=mysqli_query($conn, $sql);
$count2=mysqli_num_rows($result);

date_default_timezone_set('Africa/Lagos');
//task assigned to count
//capture user data input

//capture user data input
if (isset($_POST['update'])){
		$fname = $_POST['fname'];
		$ref = $_POST['ref'];
		$lname = trim($_POST['lname']);
		$jstatus = trim($_POST['jstatus']);
		$jdetails = mysqli_real_escape_string($conn, $_POST["jdetails"]);
		$date = date("Y-m-d H:i:s");

	 $to = "ivr@fmnplc.com"; // this is your Email address
     $from = "adespide@gmail.com"; // this is the sender's Email
     $subject = "A task update message";
    //$subject2 = "Copy of your form submission";
    //$message = $first_name . " " . $last_name . " wrote the following:" . "\n\n" . $_POST['message'];
    $message = "Task completed by " . $fname ." ".$lname. ", find task details below:\n\n Task updated by: ". $user. ".\n\n Request code: " .$_POST['ref']. ".\n\n Supervisor remarks: ".$_POST["jdetails"].".\n\n Time: " .$date. ".\n\n\n\n Regards,\n\n Admin.";
    $headers = "From:" . $from;
    $headers2 = "From:" . $to;

		//to check if an userinput data in the forms
	if (!empty($fname && $lname)) {

		//select all the entries in the database check if that username or password exist?
		$sql_check = "SELECT * FROM assform where (unique4 = '$ref')";
		$result_check = mysqli_query($conn, $sql_check);
		//condition statement to check if the data exist

		if(mysqli_num_rows($result_check) > 0){

			//Update query syntax for login status
			$sql_update = "UPDATE assform SET task_status = '$jstatus', task_details = '$jdetails', time_completed = '$date' WHERE (unique4 = '$ref')";
			$result_update = mysqli_query($conn, $sql_update);

			//condition statement to check if it updates
			if($result_update){

				//used to check output of each row data 
			while($row_check = mysqli_fetch_assoc($result_check)){
			mail($to,$subject,$message,$headers);
      		mail($from,$subject,$message,$headers2); // sends a copy of the message to the sender
      		//echo "Mail Sent. Thank you " . $first_name . ", we will contact you shortly.";

			echo"<script>alert('Task record(s) updated successully!!!')</script>";
					//the header redirect the user to the index.php page
			echo "<script> window.open('performance.php','_self'); </script>";
				}
			}else{
				//if an error occur exit and display these alert msg
				echo"<script>alert('Please try again later!!!')</script>";
				echo "<script> window.open('performance.php','_self'); </script>";
			}

		}else{
			echo "<script>alert('Incorrect Staff name!')</script>";
			echo "<script> window.open('performance.php','_self'); </script>";
		}

		}else{
			echo "<script>alert('kindly fill all the entry in the form!!!')</script>";
			echo "<script> window.open('performance.php','_self'); </script>";
		}
	}
  

//pending task count
	$sql="SELECT * FROM assform WHERE task_status != 'completed'";
	$result=mysqli_query($conn, $sql);
   	$count3=mysqli_num_rows($result);

   	$sql="SELECT * FROM feed_table WHERE status = 'notsolve' ";
	$result=mysqli_query($conn, $sql);
	$feedcount=mysqli_num_rows($result);



   	//assigned task update
//capture user data input
if (isset($_POST['reopen'])){
		$ref = $_POST['ref'];
		$fname = $_POST['fname'];
		$lname = trim($_POST['lname']);
		$jdetails = mysqli_real_escape_string($conn, $_POST["jdetails"]);
		$date = date("Y-m-d H:i:s");

		$to = "ivr@fmnplc.com"; // this is your Email address
     $from = "adespide@gmail.com"; // this is the sender's Email
     $subject = "Task reopen message";
    //$subject2 = "Copy of your form submission";
    //$message = $first_name . " " . $last_name . " wrote the following:" . "\n\n" . $_POST['message'];
    $message = "We reopened a task completed by " . $fname ." ".$lname. ", find task details below:\n\n Task updated by: ". $user. ".\n\n Request code: " .$_POST['ref']. ".\n\n Supervisor remarks: ".$_POST["jdetails"].".\n\n Time: " .$date. ".\n\n\n Regards,\n Admin.";
    $headers = "From:" . $from;
    $headers2 = "From:" . $to;

		//to check if an userinput data in the forms
	if (!empty($ref)) {

		//select all the entries in the database check if that unique4 exist?
		$sql_check = "SELECT * FROM assform where (unique4 = '$ref')";
		$result_check = mysqli_query($conn, $sql_check);
		//condition statement to check if the data exist

		if(mysqli_num_rows($result_check) > 0){

			//Update query syntax for login status
			$sql_update = "UPDATE assform SET task_status = 'Re-open', time_reopen = '$date', task_details = '$jdetails' WHERE (unique4 = '$ref')";
			$result_update = mysqli_query($conn, $sql_update);



			$sql_check = "SELECT * FROM controlform where (unique4 = '$ref')";
		$result_check = mysqli_query($conn, $sql_check);
		//condition statement to check if the data exist

		if(mysqli_num_rows($result_check) > 0){

			//Update query syntax for login status
			$sql_update = "UPDATE controlform SET ass = 'unassigned' WHERE (unique4 = '$ref')";
			$result_update = mysqli_query($conn, $sql_update);

			


			//condition statement to check if it updates
			if($result_update){

				//used to check output of each row data 
			while($row_check = mysqli_fetch_assoc($result_check)){

		 	mail($to,$subject,$message,$headers);
      		mail($from,$subject,$message,$headers2); // sends a copy of the message to the sender
      		//echo "Mail Sent. Thank you " . $first_name . ", we will contact you shortly.";

			echo"<script>alert('Task record(s) re-open successully!!!')</script>";
					//the header redirect the user to the index.php page
			echo "<script> window.open('jobass.php?$user','_self'); </script>";
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
}

if (isset($_POST["recurent"])) {
  $fname = mysqli_real_escape_string($conn, $_POST["fname"]);
  $lname = mysqli_real_escape_string($conn, $_POST["lname"]);
  $jstatus = mysqli_real_escape_string($conn, $_POST["jstatus"]);
  $Rfname = mysqli_real_escape_string($conn, $_POST["ref"]); 
  $jdetails = mysqli_real_escape_string($conn, $_POST["jdetails"]);
  $date = date("Y-m-d H-i-s");

  //insert the information into the databse
$sql = "INSERT INTO assform (first_name, last_name, unique4, task_status, retask_details, date_ass, retask_time) 
VALUES('$fname' , '$lname', '$Rfname', '$jstatus', '$jdetails', now(), '$date')";

  //if the query is successful give the user the following messages using javascript alert function and take them to their portal
if (mysqli_query($conn, $sql)) {

//Update query syntax for login status
$sql_update = "UPDATE assform SET task_status = 'Re-assigned' WHERE (unique4 = '$Rfname' AND first_name != '$fname' AND last_name != '$lname' AND task_status = 'In Progress')";
$result_update = mysqli_query($conn, $sql_update);

//condition statement to check if it updates
			if($result_update){

    echo "<script> alert ('Task still in progress !!!'); </script>";
    echo "<script> window.open('performance.php','_self'); </script>";
  }else{
    echo "<script> alert ('Form Not Submited !!!'); </script>" . $sql . "<br>" . mysqli_error($conn);
    echo "<script> window.open('performance.php','_self'); </script>";
  }
}
}
$conn->close();

// drop down selection
class DBController {
	private $host = "localhost";
	private $user = "root";
	private $password = "@!Abimbola@";
	private $database = "control";
	private $conn;
	
        function __construct() {
        $this->conn = $this->connectDB();
	}	
	function connectDB() {
		$conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
		return $conn;
	}
        function runQuery($query) {
                $result = mysqli_query($this->conn,$query);
                while($row=mysqli_fetch_assoc($result)) {
                $resultset[] = $row;
                }		
                if(!empty($resultset))
                return $resultset;
	}
}
?>