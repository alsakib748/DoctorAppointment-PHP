<?php

include "../admin/inc/db.php";

// Todo: show departments all data
if (isset($_POST["action"]) && $_POST["action"] == "loadAppointments") {
    $id = $_POST["id"];
    $email = $_POST["email"];
    // echo $id;
    // echo $email;
    // die;
    $getPatientSql = "SELECT `users`.`id`,`users`.`email`,`appointments`.*,`appointment_bookings`.`amount`,`appointment_bookings`.`status` AS `bookings_status` FROM `appointments` INNER JOIN `appointment_bookings` ON `appointments`.`id` = `appointment_bookings`.`appointment_id` INNER JOIN `users` ON `users`.`id` = `appointments`.`patient_id` WHERE `appointments`.`patient_id` = $id AND `users`.`email` = '$email' AND `appointments`.`status`='Booked' ";

    $getAdminSql = "SELECT `admin`.`id`,`admin`.`email`,`appointments`.*,`appointment_bookings`.`amount`,`appointment_bookings`.`status` AS `bookings_status` FROM `appointments` INNER JOIN `appointment_bookings` ON `appointments`.`id` = `appointment_bookings`.`appointment_id` INNER JOIN `admin` ON `appointments`.`admin_id`=`admin`.`id` WHERE `appointments`.`admin_id` = $id AND `admin`.`email` = '{$email}' AND `appointments`.`status`='Booked' ";

    $getPatientSqlResult = mysqli_query($con, $getPatientSql);
    $getAdminSqlResult = mysqli_query($con, $getAdminSql);

    $output = "";

    if (mysqli_num_rows($getPatientSqlResult) > 0 || mysqli_num_rows($getAdminSqlResult) > 0) {

        if (mysqli_num_rows($getPatientSqlResult) > 0) {
            $output .= "<table class='table table-light table-striped table-hover table-condensed'>
        <thead>
            <tr>
                <th scope='col'>Apt. No.</th>
                <th scope='col'>Apt. Data</th>
                <th scope='col'>Apt. Time</th>
                <th scope='col'>Booking Status</th>
                <th scope='col'>Payment Status</th>
                <th scope='col'>Action</th>
            </tr>
        </thead>
        <tbody>";
            while ($row = mysqli_fetch_assoc($getPatientSqlResult)) {
                if ($row['bookings_status'] == "VALID") {
                    $bookings_status = "<div class='badge text-bg-success fs-6'>Paid</div>";
                }
                $output .= "<tr>
            <td>{$row['apt_no']}</td>
            <td>{$row['apt_date']}</td>
            <td>{$row['start_time']}</td>
            <td class='text-center'>
                <div class='badge text-bg-primary fs-6'>{$row['status']}</div>
            </td>
            <td class='text-center'>
                $bookings_status
            </td>
            <td><a href='appointment_status.php?apt_id={$row['id']}' class='btn btn-info btn-sm shadow-none'><i class='bi bi-eye-fill'></i> View</a></td>
        </tr>";
            }
            $output .= "</tbody>
        </table>";

        echo $output;
        }
        else if (mysqli_num_rows($getAdminSqlResult) > 0) {
            $output .= "<table class='table table-light table-striped table-hover table-condensed'>
        <thead>
            <tr>
                <th scope='col'>Apt. No.</th>
                <th scope='col'>Apt. Data</th>
                <th scope='col'>Apt. Time</th>
                <th scope='col'>Booking Status</th>
                <th scope='col'>Payment Status</th>
                <th scope='col'>Action</th>
            </tr>
        </thead>
        <tbody>";
            while ($row = mysqli_fetch_assoc($getAdminSqlResult)) {
                if ($row['bookings_status'] == "VALID") {
                    $bookings_status = "<div class='badge text-bg-success fs-6'>Paid</div>";
                }
                $output .= "<tr>
            <td>{$row['apt_no']}</td>
            <td>{$row['apt_date']}</td>
            <td>{$row['start_time']}</td>
            <td class='text-center'>
                <div class='badge text-bg-primary fs-6'>{$row['status']}</div>
            </td>
            <td class='text-center'>
                $bookings_status
            </td>
            <td><a href='appointment_status.php?apt_id={$row['id']}' class='btn btn-info btn-sm shadow-none'><i class='bi bi-eye-fill'></i> View</a></td>
        </tr>";
            }
            $output .= "</tbody>
        </table>";

        echo $output;
        }
    } else {
        echo "<h6 class='alert alert-warning text-center fs-6'>You have no appointments</h6>";
        exit;
    }

    
}

if (isset($_POST["action"]) && $_POST["action"] == "loadProfileData") {
    $id = $_POST["id"];
    $checkUserSql = "SELECT * FROM `users` WHERE `id` = $id";
    $checkUserSqlResult = mysqli_query($con, $checkUserSql);

    if (mysqli_num_rows($checkUserSqlResult) > 0) {
        $row = mysqli_fetch_assoc($checkUserSqlResult);
    } else {
        echo "Not found Users";
        exit;
    }

    echo json_encode($row);
}
