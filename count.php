<?php
require_once ('form/connect.php');

$sql="SELECT * FROM controlform WHERE ass = 'unassigned'";
$result=mysqli_query($conn, $sql);
$count=mysqli_num_rows($result);
if($count>0) { 
  echo $count;
}

?>