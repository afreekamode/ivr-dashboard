<?php
require_once ('form/connect.php');

$sql="SELECT * FROM feed_table WHERE status = 'notsolve' ";
$result=mysqli_query($conn, $sql);
$feedcount=mysqli_num_rows($result);
if($feedcount>0) { 
  echo $feedcount;
}

?>