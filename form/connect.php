<?php
/**
 * Project by IT AUDIT.
 * Developer: Sikiru Shittu
 * Date: 20/10/2018
 * Version: 1.0
 * Time: 15:47
 */ 
$servername = "localhost";
$username =  "root";
$password = "";
$DBname = "control";

// create connection
$conn = mysqli_connect($servername, $username, $password, $DBname);
//check connection
if (!$conn) {
	die("connection failed: " . mysqli_connect_error());
}


