<?php
require ('form/connect.php');

if (isset($_GET['Myid'])){
$id = $_GET['Myid'];//this needs to be sanitized 
$sql = "UPDATE feed_table SET status = 'solved' WHERE id=".$id.";";
$result = mysqli_query($conn, $sql);
      if($result){

        echo "<script>alert('Issue resolved!!!')</script>";
        //redirect user to login page if he log out
        header("location:feedtable.php");
      }else{
        echo "<script>alert('try again later!!!')</script>";
        }  
      }
?>