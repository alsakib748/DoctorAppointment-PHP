
<?php 

// if(isset($_SERVER['HTTP_REFERER'])) {
//     $referrer = $_SERVER['HTTP_REFERER'];;
// } 

session_start();
session_destroy();
// header("Location: $referrer"); 
header("Location: login.php");
exit;
// redirect("login.php");

?>