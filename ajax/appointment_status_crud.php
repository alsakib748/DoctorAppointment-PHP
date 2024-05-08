<?php

include "../admin/inc/db.php";

if (isset($_POST["action"]) && $_POST["action"] == "loadAppointmentsStatus") {
    $apt_id = $_POST['apt_id'];

    $sql = "SELECT `appointments`.*,`doctors`.`name`,`doctors`.`profile`,`doctors`.`designation`,`doctors`.`fees`,`appointment_bookings`.`status` AS `bookings_status` FROM `doctors` INNER JOIN `appointments` ON `doctors`.`id` = `appointments`.`doctor_id` INNER JOIN `appointment_bookings` ON `appointments`.`id` = `appointment_bookings`.`appointment_id` WHERE `appointments`.`id` = $apt_id ";

    $result = mysqli_query($con, $sql);

    $output = "";

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if ($row["bookings_status"] == "VALID") {
            $status = "<span class='badge text-bg-success fs-6'>Paid</span>";
        }

        $output .= "<div class='row'>
        <div class='col-md-7'>
            <ul class='nav flex-column'>
                <li class='nav-item border-bottom '>
                    <h5 class='nav-link text-dark fw-semibold py-0'>Appointment No: {$row['apt_no']}</h5>
                    <h5 class='nav-link text-dark fw-semibold py-0'>Appointment Date: {$row['apt_date']}</h5>
                    <h5 class='nav-link text-dark fw-semibold pt-0 pb-2'>Appointment Time: {$row['start_time']}</h5>
                </li>
                <li class='nav-item border-bottom my-2'>
                    <h5 class='nav-link text-dark fw-semibold py-0'>Doctor Name: {$row['name']}</h5>
                    <h5 class='nav-link text-dark fw-semibold py-0'>Doctor Designation: {$row['designation']}</h5>
                </li>
                <li class='nav-item border-bottom '>
                    <h5 class='nav-link text-dark fw-semibold py-0'>Consultation Fees: {$row['fees']}</h5>
                    <h5 class='nav-link text-dark fw-semibold py-0'>Consultation Fees Payment Status: $status</h5>
                    <h5 class='nav-link text-dark fw-semibold pt-0 pb-2'>Doctor Comment: </h5>
                </li>
                <li class='nav-item my-2'>
                    <h5 class='nav-link text-dark fw-semibold py-0'>Status: <span class='badge text-bg-primary fs-6'>{$row['status']}</span></h5>
                </li>
            </ul>
        </div>

        <div class='col-md-5'>
            <img src='admin/images/doctors/{$row['profile']}' class='img-fluid w-100 rounded shadow-sm' />
        </div>
    </div>
";

        echo $output;
    } else {
        echo "<h6 class='alert alert-danger text-center'>Not found any Appointment</h6>";
        exit;
    }
}
