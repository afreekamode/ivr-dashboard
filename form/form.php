<?php
session_start();
require('connect.php');

//capture user data input
$Errmsg1 = "";
$Errmsg2 = "";
$Errmsg3 = "";
$Errmsg4 = "";

if (isset($_POST['login'])){
		$email = trim(strip_tags($_POST['username']));
		$pword = trim(strip_tags($_POST['password']));
		$encrypted_md5_password = md5($pword);
	

		if (!empty($pword && $email)) {

			$stmt = $conn->prepare('SELECT * FROM signup_table WHERE email = ?');
			$stmt->bind_param('s', $email);
			$stmt->execute();

			$result_check = $stmt->get_result();
					
		if(mysqli_num_rows($result_check) > 0){

			$sql_check = "SELECT * FROM signup_table WHERE password = '$encrypted_md5_password' AND email = '$email' ";

			 $result_check = mysqli_query($conn, $sql_check);
    		//condition statement to check if the data exist

    		if(mysqli_num_rows($result_check) > 0){
					
			//Update query syntax for login status
			$sql_update = "UPDATE signup_table SET login_status = true WHERE (email= '$email' AND password = '$encrypted_md5_password') ORDER BY log_date ASC limit 1";
			$result_update = mysqli_query($conn, $sql_update);
					
			//condition statement to check if it updates
			if($result_update){

				//used to check output of each row data 
				while($row_check = mysqli_fetch_assoc($result_check)){
					
					$_SESSION["licenced_users"] = $email;
					$_SESSION['licenced_users'] = $email;
					//the header redirect the user to the index.php page
					header("location: index.php");
				//header("location: index.php?op=atHome")
				}
			}else{
				//if an error occur exit and display these alert msg
				$Errmsg1 = "Please try again later!!!";
			}

		}else{
			$Errmsg2 = "Incorrect USERNAME/PASSWORD!";
		}

		}else{
			$Errmsg3 = "kindly fill all the entry in the form or check your input!";
		}

	}
}

	function PrepSQL($value)
    {
        // Stripslashes
        if(get_magic_quotes_gpc()) 
        {
            $value = stripslashes($value);
        }

        // Quote
        $value = "'" . mysqli_real_escape_string($value) . "'";

        return($value);
    }
	
	//Login Page Starts here
// 	if (isset($_POST['login'])){
	
// 		$user_email = trim(strip_tags($_POST['email']));
// 		$user_password = trim(strip_tags($_POST['passwd']));
// 		$encrypted_md5_password = md5($user_password);
		
// 		$sql = "SELECT * FROM `signup_table` where email = '$user_email' AND password = '$encrypted_md5_password' ";
// 		$validate_user_information = mysqli_query($conn, $sql);
		
// 		if(mysqli_num_rows($validate_user_information) == 1)
// 		{
// 			$get_user_information = mysqli_fetch_array($validate_user_information);
// 			$_SESSION["VALID_USER_ID"] = $user_email;
// 			$_SESSION["USER_FULLNAME"] = strip_tags($get_user_information["firstname"]);
// 			echo 'index.php';
			
// 		}
// 		else
// 		{
// 			echo '<br><div class="info">Sorry, you have provided incorrect information. Please enter correct user information to proceed. Thanks.</div><br>';
// 		}
// 	}
// 	//Login Page Ends here
// }

    $conn->close();
?>
<?php
require('connect.php');

$Errmsg4 = "";
$Errmsg5 = "";
$Errmsg6 = "";

if (isset($_POST['logad'])){
		$email = trim(strip_tags($_POST['adusername']));
		$pword = trim(strip_tags($_POST['adpassword']));
		$encrypted_md5_password = md5($pword);

		if (!empty($pword && $email)) {

			$stmt = $conn->prepare('SELECT * FROM ad_table WHERE ademail = ?');
			$stmt->bind_param('s', $email);
			$stmt->execute();

			$result = $stmt->get_result();
  
		// $result_check = mysqli_query($conn, $sql_check);
		// //condition statement to check if the data exist
			if(!empty($result)){

			$sql_check = "SELECT * FROM ad_table WHERE adpassword = '$encrypted_md5_password' AND ademail = '$email' ORDER BY id ASC limit 1";

			 $result = mysqli_query($conn, $sql_check);
    		//condition statement to check if the data exist

    		if(mysqli_num_rows($result) > 0){
					
			//Update query syntax for login status
			$sql_update = "UPDATE ad_table SET login_status = true WHERE (ademail= '$email' AND adpassword = '$encrypted_md5_password') ORDER BY id ASC limit 1";
			$result_update_check = mysqli_query($conn, $sql_update);
					
			//condition statement to check if it updates
			if($result_update_check){

				//used to check output of each row data 
				while($row_check = mysqli_fetch_assoc($result)){
					
					$_SESSION["licenced_users"] = $email;
					$_SESSION['licenced_users'] = $email;
					//the header redirect the user to the index.php page
					header("location: admin.php?admin={$row_check['ademail']}");
				//header("location: index.php?op=atHome");
			die();
				}
			}else{
				//if an error occur exit and display these alert msg
				$Errmsg4 = "Please try again later!!!";
			}

		}else{
			$Errmsg5 = "Incorrect USERNAME/PASSWORD!";
		}

		}else{
			$Errmsg6 = "kindly fill all the entry in the form!!!";
		}
	}
}	
	$conn->close();
 ?>


 <?php
 require('connect.php');

$Errmsg4p = "";
$Errmsg5p = "";
$Errmsg6p = "";

		if (isset($_POST['pass'])){
		$pword = trim(strip_tags($_POST['pascode']));
		$encrypted_md5_password = md5($pword);
		$id = 'admn';

		if (!empty($pword)) {

			$stmt = $conn->prepare('SELECT * FROM ad_table WHERE lastname = ?');
			$stmt->bind_param('s', $id);
			$stmt->execute();

			$result_check = $stmt->get_result();
   
		// $result_check = mysqli_query($conn, $sql_check);
		// //condition statement to check if the data exist
				
		if(mysqli_num_rows($result_check) > 0){

			$sql_check = "SELECT * FROM ad_table WHERE adpascode = '$encrypted_md5_password' AND id = 2 ";

			 $result_check = mysqli_query($conn, $sql_check);
    		//condition statement to check if the data exist

    		if(mysqli_num_rows($result_check) > 0){
					
			//Update query syntax for login status
			$sql_update = "UPDATE ad_table SET login_status = true WHERE ( adpascode = '$encrypted_md5_password') ORDER BY id ASC limit 1";
			$result_update = mysqli_query($conn, $sql_update);
					
			//condition statement to check if it updates
			if($result_update){
	
				//used to check output of each row data 
				while($row_check = mysqli_fetch_assoc($result_check)){

					//the header redirect the user to the index.php page
				header("location: tables.php?home");
			die();
				}
			}else{
			//if an error occur exit and display these alert msg
			$Errmsg4p = "Please try again later!!!";
			}
		}else{
			$Errmsg5p = "Incorrect PASSCODE!";
		   }

		}else{
			$Errmsg6p = "kindly fill the entry in the form!!!";
			}
		}
	}	
	$conn->close();
 ?>