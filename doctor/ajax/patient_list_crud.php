<?php

include "../../admin/inc/db.php";

if (isset($_POST["action"]) && $_POST["action"] == "patientListData") {

    $id = $_POST["id"];
    $output = "";
    $display = "";
    $sql = "SELECT `users`.*,`appointments`.`id` AS `apt_id`,`appointments`.`apt_date`,`appointments`.`status`,`appointments`.`doctor_id` FROM `users` INNER JOIN `appointments` ON `users`.`id` = `appointments`.`patient_id` WHERE `doctor_id` = {$id} AND `appointments`.`status` = 'Booked' ";
    $result = mysqli_query($con, $sql);

    $adminSql = "SELECT `admin`.*,`appointments`.`id` AS `apt_id`,`appointments`.`apt_date`,`appointments`.`status`,`appointments`.`doctor_id` FROM `admin` INNER JOIN `appointments` ON `admin`.`id` = `appointments`.`admin_id` WHERE `doctor_id` = {$id} AND `appointments`.`status` = 'Booked' ";
    $adminSqlResult = mysqli_query($con, $adminSql);

    if (mysqli_num_rows($result) > 0 || mysqli_num_rows($adminSqlResult) > 0) {

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $output .= "
                <tr>
                <td class='text-muted'>{$row['apt_date']}</td>
                <td class='text-muted'>{$row['name']}</td>
                <td class='text-muted'>{$row['email']}</td>
                <td class='text-muted'>{$row['age']}</td>
                <td class='text-muted'>{$row['contact']}</td>
                <td>
                    <button type='button' class='btn btn-primary btn-sm shadow-none'><i class='fa-solid fa-pencil'></i> Edit </button>
                    <button type='button' class='btn btn-info btn-sm shadow-none'><a class='text-decoration-none text-light' href='view_appointment.php?id={$row['apt_id']}'><i class='fa-regular fa-file-lines'></i> View Appointments</a></button>
                </td>
                </tr>
                ";
            }
            echo $output;
        }

        if (mysqli_num_rows($adminSqlResult) > 0) {
            while ($row = mysqli_fetch_assoc($adminSqlResult)) {
                $display .= "
                <tr>
                <td class='text-muted'>{$row['apt_date']}</td>
                <td class='text-muted'>{$row['name']}</td>
                <td class='text-muted'>{$row['email']}</td>
                <td class='text-muted'>{$row['age']}</td>
                <td class='text-muted'>{$row['contact']}</td>
                <td>
                    <button type='button' class='btn btn-primary btn-sm shadow-none'><i class='fa-solid fa-pencil'></i> Edit </button>
                    <button type='button' class='btn btn-info btn-sm shadow-none'><a class='text-decoration-none text-light' href='view_appointment.php?id={$row['apt_id']}'><i class='fa-regular fa-file-lines'></i> View Appointments</a></button>
                </td>
                </tr>
                ";
            }
            echo $display;
        }

    } else {
        echo "<tr><td class='table-danger text-center' colspan='6'>You have no patients</td></tr>";
    }
}

if (isset($_POST["action"]) && $_POST["action"] == "searchByNameData") {

    $id = $_POST["id"];
    $value = $_POST["value"];
    $output = "";
    $display = "";
    $sql = "SELECT `users`.*,`appointments`.`id` AS `apt_id`,`appointments`.`apt_date`,`appointments`.`status`,`appointments`.`doctor_id` FROM `users` INNER JOIN `appointments` ON `users`.`id` = `appointments`.`patient_id` WHERE `doctor_id` = {$id} AND `appointments`.`status` = 'Booked' AND `users`.`name` LIKE '%{$value}%' ";
    $result = mysqli_query($con, $sql);

    $adminSql = "SELECT `admin`.*,`appointments`.`id` AS `apt_id`,`appointments`.`apt_date`,`appointments`.`status`,`appointments`.`doctor_id` FROM `admin` INNER JOIN `appointments` ON `admin`.`id` = `appointments`.`admin_id` WHERE `doctor_id` = {$id} AND `appointments`.`status` = 'Booked' AND `admin`.`name` LIKE '%{$value}%' ";
    $adminSqlResult = mysqli_query($con, $adminSql);

    if (mysqli_num_rows($result) > 0 || mysqli_num_rows($adminSqlResult) > 0) {

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $output .= "
                <tr>
                <td class='text-muted'>{$row['apt_date']}</td>
                <td class='text-muted'>{$row['name']}</td>
                <td class='text-muted'>{$row['email']}</td>
                <td class='text-muted'>{$row['age']}</td>
                <td class='text-muted'>{$row['contact']}</td>
                <td>
                    <button type='button' class='btn btn-primary btn-sm shadow-none'><i class='fa-solid fa-pencil'></i> Edit </button>
                    <button type='button' class='btn btn-info btn-sm shadow-none'><a class='text-decoration-none text-light' href='view_appointment.php?id={$row['apt_id']}'><i class='fa-regular fa-file-lines'></i> View Appointments</a></button>
                </td>
                </tr>
                ";
            }
            echo $output;
        }

        if (mysqli_num_rows($adminSqlResult) > 0) {
            while ($row = mysqli_fetch_assoc($adminSqlResult)) {
                $display .= "
                <tr>
                <td class='text-muted'>{$row['apt_date']}</td>
                <td class='text-muted'>{$row['name']}</td>
                <td class='text-muted'>{$row['email']}</td>
                <td class='text-muted'>{$row['age']}</td>
                <td class='text-muted'>{$row['contact']}</td>
                <td>
                    <button type='button' class='btn btn-primary btn-sm shadow-none'><i class='fa-solid fa-pencil'></i> Edit </button>
                    <button type='button' class='btn btn-info btn-sm shadow-none'><a class='text-decoration-none text-light' href='view_appointment.php?id={$row['apt_id']}'><i class='fa-regular fa-file-lines'></i> View Appointments</a></button>
                </td>
                </tr>
                ";
            }
            echo $display;
        }

    } else {
        echo "<tr><td class='table-warning text-center' colspan='6'>You have no patients this name</td></tr>";
    }
}


?>