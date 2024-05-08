<?php

include "../admin/inc/db.php";

if (isset($_POST["status"]) && $_POST["status"] == "loadDepartments") {
    $sql = "SELECT * FROM `departments`";
    $result = mysqli_query($con, $sql);
    $output = "";
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $output .= "<div class='col-md-3 col-sm-12 mb-3 dept-card'>
        <div class='card shadow'>
            <img src='admin/images/departments/{$row['avatar']}' class='card-img-top w-100 img-fluid' style='height: 200px;'>
            <div class='card-body'>
                <h5 class='card-title text-center fw-bolder'><a href='single_departments.php?dept={$row['name']}' class='text-decoration-none text-secondary'>{$row['name']}</a></h5>
            </div>
            </div>
        </div>";
        }
        echo $output;
    } else {
        echo "<h6 class='alert alert-warning text-center'><i class='bi bi-exclamation-octagon-fill'></i> No Departments Found !!</h6>";
    }
}

if (isset($_POST["status"]) && $_POST["status"] == "showDepartmentByName") {
    // // echo print_r($_POST);
    // echo $_POST["department"];
    // die;
    $department = $_POST["department"];
    $sql = "SELECT * FROM `departments` WHERE `departments`.`name` LIKE '%{$department}%' ";
    $result = mysqli_query($con, $sql);
    $output = "";
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $output .= "<div class='col-md-3 col-sm-12 mb-3 dept-card'>
        <div class='card shadow '>
            <img src='admin/images/departments/{$row['avatar']}' class='card-img-top w-100 img-fluid' style='height: 200px;'>
            <div class='card-body'>
                <h5 class='card-title text-center fw-bolder'><a href='single_departments.php?dept={$row['name']}' class='text-decoration-none text-secondary'>{$row['name']}</a></h5>
            </div>
            </div>
        </div>";
        }
        echo $output;
    } else {
        echo "<h6 class='alert alert-warning text-center'><i class='bi bi-exclamation-octagon-fill'></i> Not found any department for this name !!</h6>";
    }
}
