<?php 

session_start();
session_destroy();
header("Location: ../login.php"); 
exit;
// redirect("login.php");

?>