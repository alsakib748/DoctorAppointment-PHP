<?php 

include "../inc/db.php";

if(isset($_POST["action"]) && $_POST["action"] == "viewAppointmentsData"){
    
    $apt_no = $_POST["apt_no"];
    $sql = "SELECT `appointments`.`id` AS `apt_id`,`appointments`.`apt_no`,`appointments`.`apt_date`,`appointments`.`start_time`,`users`.`id` AS `patient_id`,`users`.`name`,`users`.`email`,`users`.`contact`,`users`.`age`,`users`.`gender`,`users`.`dob`,`appointments`.`status`,`doctors`.`id` AS `doctor_id`,`doctors`.`fees`,`appointment_bookings`.`id` AS `bookings_id`,`appointment_bookings`.`status` AS `bookings_status` FROM `users` INNER JOIN `appointments` ON `users`.`id` = `appointments`.`patient_id` INNER JOIN `doctors` ON `doctors`.`id` = `appointments`.`doctor_id` INNER JOIN `appointment_bookings` ON `appointment_bookings`.`appointment_id` = `appointments`.`id` WHERE `appointments`.`apt_no` = '{$apt_no}' AND `appointments`.`status`='Booked' ";
    $result = mysqli_query($con,$sql);
    $output = "";
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        echo json_encode(array("success" => $row));
    }else{
        echo json_encode(array("not_found"=>"<h6 class='alert alert-warning text-center'>Here is no appointment</h6>"));
    }

}

?>