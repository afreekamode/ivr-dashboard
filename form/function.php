<?php
session_start();
require_once ('connect.php');

//3. If the form is submitted or not.
//3.1 If the form is submitted		
$inactive = 1800;

//after 60 seconds the user gets logged out
// check to see if $_SESSION['timeout'] is set
if(isset($_SESSION['licenced_user']) ) {
$session_life = time() - $_SESSION['licenced_user'];
if($session_life > $inactive)
    { 

    	isset($_GET['logout']);
        session_destroy(); 
        header("Location: expire.php"); 
}
}
$_SESSION['licenced_user'] = time();
?>