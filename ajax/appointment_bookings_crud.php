<?php

include "../admin/inc/db.php";

date_default_timezone_set("Asia/Dhaka");

if (isset($_POST["action"]) && $_POST["action"] == "appointmentBookings") {

    // echo $_POST["name"];
    // echo $_POST["email"];
    // echo $_POST["contact"];
    // echo $_POST["doctor_id"];
    // echo $_POST["time"];
    // echo $_POST["date"];
    // echo $_POST["shift"];
    // echo $_POST["avg"];
    // die;

    $name = mysqli_real_escape_string($con, validate($_POST["name"]));
    $email = mysqli_real_escape_string($con, validate($_POST["email"]));
    $contact = mysqli_real_escape_string($con, validate($_POST["contact"]));
    $doctor_id = mysqli_real_escape_string($con, validate($_POST["doctor_id"]));

    $start_time = mysqli_real_escape_string($con, validate($_POST["time"]));
    $date = mysqli_real_escape_string($con, validate($_POST["date"]));
    $avg = mysqli_real_escape_string($con, validate($_POST["avg"]));
    $shift = mysqli_real_escape_string($con, validate($_POST["shift"]));

    $checkUserSql = "SELECT * FROM `users` WHERE `email` = '{$email}' AND `contact` = '{$contact}' ";
    $userResult = mysqli_query($con, $checkUserSql);

    $checkAdminSql = "SELECT * FROM `admin` WHERE `email` = '{$email}' AND `contact` = '{$contact}' ";
    $adminResult = mysqli_query($con, $checkAdminSql);

    if (mysqli_num_rows($userResult) > 0 || mysqli_num_rows($adminResult) > 0) {

        if (mysqli_num_rows($userResult) > 0) {
            $todayDate = date('Y-m-d');

            // Todo: user prevent duplicate appointment 
            $row = mysqli_fetch_assoc($userResult);
            $user_id = $row['id'];
            $duplicatePatientPreventSql = "SELECT * FROM `appointments` WHERE  `current_date`='{$todayDate}' AND  `patient_id`='{$user_id}' AND `doctor_id`='{$doctor_id}' AND `status`='Booked' ";
            $duplicatePatientPreventSqlResult = mysqli_query($con, $duplicatePatientPreventSql);

            if (mysqli_num_rows($duplicatePatientPreventSqlResult) > 0) {
                echo json_encode(array("patient_exist" => "Today you have take one appointment to this doctor (Today you can't make another appointment with this doctor) !!"));
                exit;
            } else {
                $start_timestamp = strtotime($start_time);
                $end_time =  $start_timestamp + ($avg * 60);
                $end_time = date('h:i A', $end_time);

                $apt_no = bin2hex(random_bytes(3));

                $insertQuery = "INSERT INTO `appointments`(`apt_no`, `apt_date`, `shift`, `start_time`, `consultation_time`, `end_time`,`patient_id`, `doctor_id`) VALUES ('{$apt_no}','{$date}','{$shift}','{$start_time}','{$avg}','{$end_time}','{$user_id}','{$doctor_id}')";

                if (mysqli_query($con, $insertQuery)) {
                    $appointment_result = mysqli_query($con, "SELECT `appointments`.`apt_no`,`appointments`.`apt_date`,`appointments`.`start_time`,`users`.`name` AS `patient_name`,`users`.`email` AS `patient_email`,`users`.`contact` AS `patient_contact`,`doctors`.`name` AS `doctor_name`,`doctors`.`department` AS `doctor_department`,`doctors`.`specialization` AS `doctor_spec`,`doctors`.`fees` AS `fees` FROM `users` INNER JOIN `appointments` ON `appointments`.`patient_id` = `users`.`id` INNER JOIN `doctors` ON `appointments`.`doctor_id` = `doctors`.`id` WHERE `appointments`.`apt_no` = '{$apt_no}';");
                    $appointment_row = mysqli_fetch_assoc($appointment_result);
                    // echo json_encode(array("success" => $appointment_row), JSON_UNESCAPED_UNICODE);
                    $json_data = json_encode($appointment_row);
                    echo $json_data;
                    exit;
                } else {
                    // Error handling
                    echo "Error: " . mysqli_error($con);
                }
            }
        } else if (mysqli_num_rows($adminResult) > 0) {

            $row = mysqli_fetch_assoc($adminResult);
            $admin_id = $row['id'];
            $todayDate = date('Y-m-d');
            $duplicatePreventSql = "SELECT * FROM `appointments` WHERE  `current_date`='{$todayDate}' AND  `admin_id`='{$admin_id}' AND `doctor_id`='{$doctor_id}' AND `status`='Booked' ";

            $duplicateLPreventResult = mysqli_query($con, $duplicatePreventSql);

            if (mysqli_num_rows($duplicateLPreventResult) > 0) {
                echo json_encode(array("patient_exist" => "Today you have take one appointment to this doctor (Today you can't make another appointment with this doctor) !!"));
                exit;
            } else {
                $start_timestamp = strtotime($start_time);
                $end_time =  $start_timestamp + ($avg * 60);
                $end_time = date('h:i A', $end_time);

                $apt_no = bin2hex(random_bytes(3));

                $insertQuery = "INSERT INTO `appointments`(`apt_no`, `apt_date`, `shift`, `start_time`, `consultation_time`, `end_time`, `doctor_id`,`admin_id`) VALUES ('{$apt_no}','{$date}','{$shift}','{$start_time}','{$avg}','{$end_time}','{$doctor_id}','{$admin_id}')";

                if (mysqli_query($con, $insertQuery)) {
                    $appointment_result = mysqli_query($con, "SELECT `appointments`.`apt_no`,`appointments`.`apt_date`,`appointments`.`start_time`,`admin`.`name` AS `patient_name`,`admin`.`email` AS `patient_email`,`admin`.`contact` AS `patient_contact`,`doctors`.`name` AS `doctor_name`,`doctors`.`department` AS `doctor_department`,`doctors`.`specialization` AS `doctor_spec`,`doctors`.`fees` AS `fees` FROM `admin` INNER JOIN `appointments` ON `appointments`.`admin_id` = `admin`.`id` INNER JOIN `doctors` ON `appointments`.`doctor_id` = `doctors`.id WHERE `appointments`.`apt_no` = '{$apt_no}';");
                    $appointment_row = mysqli_fetch_assoc($appointment_result);
                    // echo json_encode(array("success" => $appointment_row), JSON_UNESCAPED_UNICODE);
                    $json_data = json_encode($appointment_row);
                    echo $json_data;
                    exit;
                } else {
                    // Error handling
                    echo "Error: " . mysqli_error($con);
                }
            }
        }
    } else {
        echo json_encode(array("patient_notFound" => "Not found any patient of this email and contact"));
        exit;
    }
}

function validate($value)
{
    $value = trim($value);
    $value = stripslashes($value);
    $value = htmlspecialchars($value);
    return $value;
}
