<?php 

    define("DB_HOST","localhost");
    define("DB_PRE","root");
    define("DB_PASS","");
    define("DB_NAME","doctorappointment");

    $con = mysqli_connect(DB_HOST,DB_PRE,DB_PASS,DB_NAME) or die("Database connection failed!!");

?>