<?php
	include_once 'session.inc.php';
	include_once 'check_login.php';
	include_once 'connect.inc.php';

	if( (!empty($_POST['username']) || !empty($_POST['password'])))
	{
		if($_POST['login'])
		$email=(($_POST['username']));
		$password=sha1($_POST['password']);
		if($email=="username")
		{
			$query1=mysqli_query("SELECT * FROM log_table WHERE username='$email' and password='$password' and login_status=1") or die("Cannot execute query1");
			if(mysqli_num_rows($query1)==1)
			{
				$_SESSION['login']=$email;
				echo json_encode(array("success" => true, "message" => 'Valid Details entered', "url" => 'index.php'));
				return ;
			}
			else{

			$_SESSION['msg1']="<div style=\"color:red\"><b><br>Invalid username or password.</b></div><br><br>";
			echo json_encode(array("success" => false, "message" => 'Invalid username or password'));
			return;
			}
		}
		else
		{
			echo json_encode(array("success" => false, "message" => 'Please fill in all the details'));
			return;
		}
	}
	else{
		echo json_encode(array("success" => false, "message" => 'Please Fill in your details'));
		return;

	}
?>

