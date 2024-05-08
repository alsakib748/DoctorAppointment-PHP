<?php 

include "../../admin/inc/db.php";

if(isset($_POST["action"]) && $_POST["action"] == "loadProfile"){
    $id = $_POST['id'];
    $sql = "SELECT * FROM `doctors` WHERE `id` = $id";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($result);
    echo json_encode($row);
} 

?>