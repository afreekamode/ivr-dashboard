<?php

//Database Connection Settings
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
?>
