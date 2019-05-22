
<?php
session_start();
require('connect.php');

	if(isset($_POST["page"]) && !empty($_POST["page"]))
{
	//Sign-up Page Starts here
	if($_POST["page"] == "users_registration")
	{
		$firstname = trim(strip_tags($_POST['firstname']));
		$lastname = trim(strip_tags($_POST['lastname']));
		$user_email = trim(strip_tags($_POST['email']));
		$user_password = trim(strip_tags($_POST['passwd']));
		$ruser_password = trim(strip_tags($_POST['rpasswd']));
		$encrypted_md5_password = md5($user_password);
		
		if($firstname == "" || $lastname == "" || $user_email == "" || $user_password == "" || $ruser_password == "")
		{
			echo '<br><div class="info">Sorry, all fields are required to create a new account. Thank you.</div><br>';
		}
		elseif(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $user_email))
		{
			echo '<br><div class="info">Sorry, Your email address is invalid, please enter a valid email address to proceed. Thank you.</div><br>';
		}
		elseif($user_password != $ruser_password)
		{
			echo '<br><div class="info">Your password do not match!</div><br>';
		}
		$sql_check = "SELECT * FROM signup_table WHERE (email = '$user_email')";
		$check_for_duplicates = mysqli_query($conn, $sql_check);

		if(mysqli_num_rows($check_for_duplicates) > 0)
		{
			echo '<br><div class="info">Sorry, your email address already exist in our database and duplicate email addresses are not allowed for security reasons.<br>Please enter a different email address to proceed or login with your existing account. Thank you.</div><br>';
		}
		else
		{
					$sql = "INSERT INTO signup_table (firstname, lastname, email, password, log_date) VALUES('$firstname' , '$lastname', '$user_email', '$encrypted_md5_password', now())";
			
			if (mysqli_query($conn, $sql)) {

				$_SESSION["licenced_users"] = $user_email;
				$_SESSION["licenced_users"] = 'signup.php';
				echo 'signup.php?welcome='.$firstname.'&';
				echo 'registered_successfully=yes';
				}
			else
			{
				echo '<br><div class="info">Sorry, your account could not be created at the moment. Please try again or contact the site admin to report this error if the problem persist. Thanks.</div><br>';
			}
		}
	}
	////Update Password Starts here
		
if($_POST["page"] == "update_registration")
	{
		
		$update_email = trim(strip_tags($_POST['email']));
		$update_password = trim(strip_tags($_POST['updatepasswd']));
		$encrypted_md5_password = md5($update_password);
		
		if($update_email == "" || $encrypted_md5_password == "" )
		{
			echo '<br><div class="info">Sorry, all fields are required to update your account! Thank you.</div><br>';
		}
		elseif(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $update_email))
		{
			echo '<br><div class="info">Sorry, Your email address is invalid, please enter a valid email address to proceed! Thank you.</div><br>';
		}

		$sql_check = "SELECT * FROM signup_table WHERE (email = '$update_email') ORDER BY id";
		$result_check = mysqli_query($conn, $sql_check);
		//condition statement to check if the data exist
					
		if(mysqli_num_rows($result_check) > 0){
					

		$sql_update = "UPDATE signup_table SET password = '$encrypted_md5_password' WHERE (email = '$update_email')";
			
				$result_update = mysqli_query($conn, $sql_update);
					
			//condition statement to check if it updates
			if($result_update){

				//used to check output of each row data 
				while($row_check = mysqli_fetch_assoc($result_check)){
			
					$_SESSION["licenced_users"] = $update_email;
		
					//the header redirect the user to the index.php page
					echo '<br><div class="info">Your password has been updated successfully! Thank you.</div><br>';
					die();
						}
				}else{
				//if an error occur exit and display these alert msg
			echo '<br><div class="info">Sorry, your email address is not in our records pls., click the signup button to register! Thank you.</div><br>';
			}
		}
	}
}
	//Update password Ends here

////resetPassword Starts here
if(isset($_POST["page"]) && !empty($_POST["page"]))
{

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

		$sql_check = "SELECT * FROM signup_table WHERE (email = '$reset_email' AND password = 'encrypted_md5_password1') ORDER BY id";
		$result_check = mysqli_query($conn, $sql_check);
		//condition statement to check if the data exist
					
		if(mysqli_num_rows($result_check) > 0){
					

		$sql_update = "UPDATE signup_table SET password = '$encrypted_md5_password2' WHERE (email = '$reset_email' AND password = 'encrypted_md5_password1')";
			
				$result_update = mysqli_query($conn, $sql_update);
					
			//condition statement to check if it updates
			if($result_update){

				//used to check output of each row data 
				while($row_check = mysqli_fetch_assoc($result_check)){
			
					$_SESSION["licenced_users"] = $reset_email;
		
					//the header redirect the user to the index.php page
					echo '<br><div class="info">Your password has been updated successfully! Thank you.</div><br>';
					die();
						}
				}else{
				//if an error occur exit and display these alert msg
			echo '<br><div class="info">Sorry, your email address is not in our records pls., click the signup button to register! Thank you.</div><br>';
			}
		}
	}
}
	//reset password Ends here
 ?>