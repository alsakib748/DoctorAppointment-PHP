<?php
session_start();
include "../../admin/inc/db.php";

date_default_timezone_set('GMT');

if (isset($_POST["status"]) && $_POST["status"] == "loadTimings") {
    $doctor_id = $_SESSION['doctorId'];
    $sql = "SELECT * FROM `timings` WHERE `doctor_id` = $doctor_id ";
    $result = mysqli_query($con, $sql);
    $output = "";
    if (mysqli_num_rows($result) > 0) {
        $output .= "<table class='table table-striped table-hover table-bordered table-light'>
        <thead>
            <tr>
                <th class='text-muted' scope='col'>DAYS</th>
                <th class='text-muted' scope='col'>SHIFTS</th>
                <th class='text-muted' scope='col'>START TIME</th>
                <th class='text-muted' scope='col'>END TIME</th>
                <th class='text-muted' scope='col'>AVG CONSULTATION TIME (IN MINS)</th>
                <th class='text-muted' scope='col'>Action</th>
            </tr>
        </thead>
        <tbody>";
        while ($row = mysqli_fetch_assoc($result)) {
            $output .= "<tr>
            <td>{$row['day']}</td>
            <td>{$row['shift']}</td>
            <td>{$row['start_time']}</td>
            <td>{$row['end_time']}</td>
            <td>{$row['avg_time']} Minutes</td>
            <td>
                <a href='timings.php?status=edit&id={$row['id']}' data-eid='{$row['id']}' class='btn btn-success btn-sm shadow-none edit-btn'>Edit</a>
                <a href='timings.php?status=edit&id={$row['id']}' data-did='{$row['id']}' class='btn btn-danger btn-sm shadow-none delete-btn'>Delete</a>
            </td>
        </tr>";
        }
        $output .= "</tbody>
        </table>";

        echo $output;
    } else {
        echo "<h6 class='alert alert-warning text-center'><i class='bi bi-exclamation-octagon-fill'></i> No Timings Found</h6>";
    }
}

if (isset($_POST["day"]) || isset($_POST["shift"]) || isset($_POST["start"]) || isset($_POST["end"]) || isset($_POST["avg_time"])) {
    if (!($_POST["day"] == "") && !($_POST["shift"] == "") && !($_POST["start"] == "") && !($_POST["end"] == "") && !($_POST["avg_time"] == "")) {

        $doctor_id = $_SESSION['doctorId'];

        $day = $_POST["day"];
        $shift = $_POST["shift"];
        $start = $_POST["start"];
        $end = $_POST["end"];
        $avg_time = $_POST["avg_time"];
        $start_time = date("g:i:s a", strtotime($start));
        $end_time = date("g:i:s a", strtotime($end));
        $doctor_id = $_SESSION["doctorId"];

        $checkTiming = mysqli_query($con, "SELECT * FROM `timings` WHERE `day` = '{$day}' AND `shift` = '{$shift}' AND `doctor_id` = $doctor_id ");

        if (mysqli_num_rows($checkTiming) > 0) {
            echo "This Timings already exist";
        } else {
            $query = mysqli_query($con, "INSERT INTO `timings` (`day`, `shift`, `start_time`, `end_time`, `avg_time`,`doctor_id`) VALUES ('$day', '$shift', '$start_time', '$end_time', '$avg_time','$doctor_id')");

            if ($query) {
                echo 1;
            } else {
                echo "Timings inserted failed !!";
            }
        }
    } else {
        echo "All fields are required !!";
    }
}
