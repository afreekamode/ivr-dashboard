<?php
session_start();
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


if($_POST["page"] == "reset_registration")
	{
		
		$reset_email = trim(strip_tags($_POST['email']));
		$reset_password1 = trim(strip_tags($_POST['resetpasswd1']));
		$reset_password2 = trim(strip_tags($_POST['resetpasswd2']));
		$encrypted_md5_password1 = md5($reset_password1);
		$encrypted_md5_password2 = md5($reset_password2);
		
		if($reset_email == "" || $encrypted_md5_password1 == "" || $encrypted_md5_password2 == "" )
		{
			echo '<br><div class="info">Sorry, all fields are required to update your account! Thank you.</div><br>';
		}
		elseif(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $reset_email))
		{
			echo '<br><div class="info">Sorry, Your email address is invalid, please enter a valid email address to proceed! Thank you.</div><br>';
		}

		$sql_check = "SELECT * FROM signup_table WHERE email = '$reset_email' AND password = '$encrypted_md5_password1'";
		$result_check = mysqli_query($conn, $sql_check);
		//condition statement to check if the data exist
					
		if(mysqli_num_rows($result_check) < 1){

			echo '<br><div class="info">Sorry, your email address and old password does not macth., you may use forgot password link! Thank you.</div><br>';
					}
				}else{	
					}
		$sql_update = "UPDATE signup_table SET password = '$encrypted_md5_password2' WHERE (email = '$reset_email')";
			
				$result_update = mysqli_query($conn, $sql_update);
					
			//condition statement to check if it updates
			if($result_update){

				//used to check output of each row data 
				while($row_check = mysqli_fetch_assoc($result_check)){
		
					//the header redirect the user to the index.php page
					echo '<br><div class="info">Your password has been updated successfully! Thank you.</div><br>';
					die();
				}
			}
	
	// //reset Page Ends here
?>