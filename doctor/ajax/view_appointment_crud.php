<?php

include "../../admin/inc/db.php";

if (isset($_POST["action"]) && $_POST["action"] == "loadViewAppointmentsData") {
    $id = $_POST["id"];

    $sql = "SELECT appointments.id,appointments.apt_no,appointments.apt_date,appointments.start_time,appointments.status,users.id AS user_id,
    users.name,users.email,users.contact,users.age,users.dob,users.gender,doctors.id AS doctor_id,doctors.fees,appointments_feedback.id AS apt_feedback_id,appointments_feedback.user_comment,appointments_feedback.doctor_comment,appointments_feedback.appointment_status,appointments_feedback.fees_status FROM users INNER JOIN appointments ON users.id = appointments.patient_id INNER JOIN doctors ON doctors.id = appointments.doctor_id LEFT JOIN appointments_feedback ON appointments.id = appointments_feedback.appointment_id WHERE appointments.id = $id AND appointments.status = 'Booked' ";
    $result = mysqli_query($con, $sql);

    $adminSql = "SELECT appointments.id,appointments.apt_no,appointments.apt_date,appointments.start_time,appointments.status,admin.id AS admin_id,
    admin.name,admin.email,admin.contact,doctors.id AS doctor_id,doctors.fees,appointments_feedback.id AS apt_feedback_id,appointments_feedback.user_comment,appointments_feedback.doctor_comment,appointments_feedback.appointment_status,appointments_feedback.fees_status FROM admin INNER JOIN appointments ON admin.id = appointments.admin_id INNER JOIN doctors ON doctors.id = appointments.doctor_id LEFT JOIN appointments_feedback ON appointments.id = appointments_feedback.appointment_id WHERE appointments.id = $id AND appointments.status = 'Booked'";
    $adminSqlResult = mysqli_query($con, $adminSql);

    if (mysqli_num_rows($result) > 0 || mysqli_num_rows($adminSqlResult) > 0) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            echo json_encode(array("userSuccess" => $row));
        } else if (mysqli_num_rows($adminSqlResult) > 0) {
            $row = mysqli_fetch_assoc($adminSqlResult);
            echo json_encode(array("adminSuccess" => $row));
        }
    } else {
        echo "Not found any appointments";
    }
}

if ((isset($_POST["apt_id"])) && (isset($_POST["appointment_status"]) || isset($_POST["fees_status"]) || isset($_POST["doctor_comment"]))) {

    $apt_id = $_POST["apt_id"];
    $apt_status = $_POST["appointment_status"] ? $_POST["appointment_status"] : "";
    $fees_status = $_POST["fees_status"] ? $_POST["fees_status"] : "";
    $doctor_comment = $_POST["doctor_comment"] ? $_POST["doctor_comment"] : "";

        $sql = "UPDATE `appointments_feedback` SET `doctor_comment`='{$doctor_comment}', `appointment_status`='{$apt_status}', `fees_status`='{$fees_status}' WHERE `appointment_id` = $apt_id ";

        $result = mysqli_query($con, $sql);

        if ($result) {
            echo "Appointment status update successfully";
        } else {
            echo "Appointment status update failed !!";
        }
        
}
