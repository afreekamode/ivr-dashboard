<?php

$servername = "localhost";

$username = "root";

$password = "@!Abimbola@";

$dbname = "control";

// Create connection

$conn = mysqli_connect($servername, $username, $password, $dbname );
// //check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}else{
echo "<script> alert ('connected successfully !!!'); </script>";
}

if (!$conn) {
	die("connection failed: " . mysqli_connect_error());
}

$sql = "CREATE TABLE assform (
id INT(22) AUTO_INCREMENT PRIMARY KEY,
first_name VARCHAR(255) NOT NULL,
last_name VARCHAR(255) NOT NULL,
task_assign VARCHAR(255) NOT NULL,
task_locate VARCHAR(255) NOT NULL,
task_request VARCHAR(255) NOT NULL,
task_status VARCHAR(255) NOT NULL,
task_details VARCHAR(255) NOT NULL,
time_ass timestamp,
)";

  if (mysqli_query($conn, $sql)) {
  echo "<script> alert ('Table created successfully!: !!!'); </script>";
}
else{echo "<script> alert ('Error creating table: !!!'); </script>" . mysqli_error($conn);
}

//the function is to make sure all white spaces
//and html specialchar are well taken care of


// CREATE TABLE `users` (

// `id` int(11) NOT NULL,

// `username` varchar(100) NOT NULL,

// `email` varchar(100) NOT NULL,

// `password` varchar(100) NOT NULL

// ) ENGINE=InnoDB DEFAULT CHARSET=latin1;



// CREATE TABLE `products` (

// `product_id` int(22) NOT NULL,

// `product_name` varchar(22) NOT NULL,

// `product_price` int(22) NOT NULL,

// `product_cat` varchar(22) NOT NULL,

// `product_details` varchar(22) NOT NULL

// ) ENGINE=InnoDB DEFAULT CHARSET=latin1;



// CREATE TABLE `sales_stats` (

// `id` int(22) NOT NULL,

// `sales` int(22) NOT NULL,

// `month` varchar(25) NOT NULL,

// `pending_orders` int(55) NOT NULL,

// `revenue` int(55) NOT NULL,

// `Vistors` int(55) NOT NULL

// ) ENGINE=InnoDB DEFAULT CHARSET=latin1;





/*$sql = "CREATE TABLE IF NOT EXISTS controlform(
emp_id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(255) UNIQUE NOT NULL,
dept VARCHAR(255) NOT NULL,
locat VARCHAR(255) NOT NULL,
recv VARCHAR(255) NOT NULL,
recv_date DATE NOT NULL,
priority TINYINT NOT NULL,
phone INT NOT NULL,
description TEXT,
submit_date TIMESTAMP,
)";*/

?>