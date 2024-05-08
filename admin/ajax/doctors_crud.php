<?php

include "../inc/db.php";
//  Todo: doctors data show code
if (isset($_POST['status']) && $_POST['status'] == "showDoctors") {
    $output = "";

    $sql = "SELECT * FROM `doctors` WHERE `active` = 1";

    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        $output .= "<table class='table table-striped table-light table-hover table-bordered'>
            <thead>
                <tr>
                    <th class='text-muted' scope='col'>ID</th>
                    <th class='text-muted' scope='col'>IMAGE</th>
                    <th class='text-muted' scope='col'>DOCTOR NAME</th>
                    <th class='text-muted' scope='col'>DEPARTMENT</th>
                    <th class='text-muted' scope='col'>PHONE</th>
                    <th class='text-muted' scope='col'>IS ACTIVE</th>
                    <th class='text-muted' scope='col'>ACTION</th>
                </tr>
            </thead>
            <tbody>";
        $i = 1;
        while ($row = mysqli_fetch_assoc($result)) {

            if ($row['active'] == 1) {
                $active = "<span class='badge text-bg-primary'>ACTIVE</span>";
            } else {
                $active = "<span class='badge text-bg-danger'>INACTIVE</span>";
            }

            $output .= "<tr>
                <td class='text-muted'>{$i}</td>
                <td>
                    <img src='images/doctors/{$row['profile']}' class='img-fluid' width='60px' height='60px' />
                </td>
                <td>{$row['name']}</td>
                <td>{$row['department']}</td>
                <td>{$row['contact']}</td>
                <td>{$active}</td>
                <td>
                    <div class='btn-group'>
                        <a class='fw-bolder fs-5 text-decoration-none ms-4 text-muted' data-bs-toggle='dropdown' data-bs-display='static' aria-expanded='false'>
                            <i class='fa-solid fa-ellipsis-vertical'></i>
                        </a>
                        <ul class='dropdown-menu shadow border-0 dropdown-menu-end dropdown-menu-lg-right'>
                            <li><a class='dropdown-item text-muted fw-semibold' href='view_timings.php?id={$row['id']}' data-tid='{$row['id']}'><i class='bi bi-view-list'></i> View Timings</a></li>
                            <li><a class='dropdown-item text-muted fw-semibold' href='../doctor_details.php?id={$row['id']}' target='_blank' ><i class='fa-regular fa-circle-dot'></i> View Doctor</a></li>
                            <li><a class='dropdown-item text-muted fw-semibold' href='view_patients.php' data-pid='{$row['id']}'><i class='fa-solid fa-user-plus'></i> View Patients</a></li>
                            <li><a class='dropdown-item text-muted fw-semibold edit_doctor' href='#' data-eid='{$row['id']}'><i class='fa-regular fa-pen-to-square'></i> Edit Doctor</a></li>
                            <li><a class='dropdown-item text-muted fw-semibold delete_doctor' href='#' data-did='{$row['id']}'><i class='fa-regular fa-trash-can'></i> Delete Doctor</a></li>
                        </ul>
                    </div>

                </td>
            </tr>";
            $i++;
        }

        $output .= "</tbody>
            </table>";
    } else {
        echo "<h6 class='my-3 alert alert-danger'>Doctors data not found</h6>";
    }

    echo $output;
}

// Todo: doctors data insert to database code
if (isset($_POST["name"]) && isset($_POST["contact"]) && isset($_POST["department"]) && isset($_POST["email"]) && isset($_POST["pass"]) && isset($_POST["gender"]) && isset($_POST["designation"]) && isset($_POST["qualification"]) && isset($_POST["experience"]) && isset($_POST["specialization"]) && isset($_POST["bio"]) && isset($_POST["fees"]) && isset($_FILES["profile"]["name"]) && isset($_POST["address"]) && isset($_POST["active"])) {

    if ( !(empty($_POST["name"]) && empty($_POST["contact"]) && empty($_POST["department"]) && empty($_POST["email"]) && empty($_POST["pass"]) && empty($_POST["gender"]) && empty($_POST["designation"]) && empty($_POST["qualification"]) && empty($_POST["experience"]) && empty($_POST["specialization"]) && empty($_POST["bio"]) && empty($_POST["fees"]) && empty($_FILES["profile"]["name"]) && empty($_POST["address"]) && empty($_POST["active"]) ) ) {
        $name = $_POST["name"];
        $contact = trim($_POST["contact"]);
        $department = $_POST["department"];
        $email = trim($_POST["email"]);
        $pass = trim($_POST["pass"]);
        $gender = $_POST["gender"];
        $designation = mysqli_real_escape_string($con,$_POST["designation"]);
        $qualification = mysqli_real_escape_string($con,$_POST["qualification"]);
        $experience = $_POST["experience"];
        $specialization = mysqli_real_escape_string($con,$_POST["specialization"]);
        $bio = mysqli_real_escape_string($con,$_POST["bio"]);
        $fees = $_POST["fees"];
        $address = mysqli_real_escape_string($con,$_POST["address"]);
        $active = $_POST["active"];
        $img_name = $_FILES["profile"]["name"];
        $img_size = $_FILES["profile"]["size"];

        $extension = pathinfo($img_name, PATHINFO_EXTENSION);
        $supported_extension = array("jpg", "jpeg", "png", "webp");

        if (strlen($contact) != 11) {
            echo "Contact number must be 11 digit";
            exit;
        } else if (strlen($pass) < 8) {
            echo "Password must be 8 character";
            exit;
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            exit;
        } else if (!in_array($extension, $supported_extension)) {
            echo "Invalid image extension or formats";
            exit;
        } else {
            $active_status = "";
            $pass_hash = password_hash($pass,PASSWORD_BCRYPT);
            $img_new_name = rand() . "." . $extension;
            $path = "../images/doctors/{$img_new_name}";
            move_uploaded_file($_FILES["profile"]["tmp_name"], $path);
            if (strtolower($active) == "on") {
                $active_status = 1;
            } else {
                $active_status = 0;
            }
            $sql = "INSERT INTO `doctors`(`name`, `contact`, `department`, `email`, `password`, `gender`, `designation`, `qualification`, `experience`, `specialization`, `bio`, `fees`, `profile`, `address`, `active`) VALUES ('{$name}','{$contact}','{$department}','{$email}','{$pass_hash}','{$gender}','{$designation}','{$qualification}','{$experience}','{$specialization}','{$bio}','{$fees}','{$img_new_name}','{$address}','{$active_status}')";
            if (mysqli_query($con, $sql)) {
                echo 1;
            } else {
                echo "Doctors data inserted failed !!";
            }
        }
    } else {
        echo "Please fill all the fields";
        exit;
    }
}

// Todo: edit request doctor data fetch 
if(isset($_POST["status"]) && $_POST["status"] == "edit_doctor_data"){
    $id = $_POST['id'];
    $result = mysqli_query($con,"SELECT * FROM `doctors` WHERE `id` = $id");
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        echo json_encode($row);
    }else{
        echo "Doctor data not found for this id";
        exit;
    }
}

// Todo: Doctors data edit or update to database
if (isset($_POST["edit_id"]) && isset($_POST["edit_name"]) || isset($_POST["edit_number"]) || isset($_POST["edit_department"]) || isset($_POST["edit_email"]) || isset($_POST["edit_gender"]) || isset($_POST["edit_designation"]) || isset($_POST["edit_qualification"]) || isset($_POST["edit_experience"]) || isset($_POST["edit_specialization"]) || isset($_POST["edit_bio"]) || isset($_POST["edit_fees"]) || isset($_FILES["edit_profile"]["name"]) || isset($_POST["edit_address"]) || isset($_POST["is_active"]) || isset($_POST["is_ban"]) || isset($_POST["is_ban"]) || isset($_POST["edit_pass"])) {

    $id = $_POST["edit_id"];
    $name = $_POST["edit_name"];
    $contact = trim($_POST["edit_number"]);
    $department = $_POST["edit_department"];
    $email = trim($_POST["edit_email"]);
    $pass = trim($_POST["edit_pass"]);
    $gender = $_POST["edit_gender"];
    $designation = mysqli_real_escape_string($con, $_POST["edit_designation"]);
    $qualification = mysqli_real_escape_string($con, $_POST["edit_qualification"]);
    $experience = $_POST["edit_experience"];
    $specialization = mysqli_real_escape_string($con, $_POST["edit_specialization"]);
    $bio = mysqli_real_escape_string($con, $_POST["edit_bio"]);
    $fees = $_POST["edit_fees"];
    $address = mysqli_real_escape_string($con, $_POST["edit_address"]);
    $img_name = $_FILES["edit_profile"]["name"];
    $img_size = $_FILES["edit_profile"]["size"];

    if (strlen($contact) != 11) {
        echo "Contact number must be 11 digit";
        exit;
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
        exit;
    }

    $pass_hash = "";
    $get = mysqli_query($con, "SELECT `password`,`profile` FROM `doctors` WHERE `id` = {$id}");
    $data = mysqli_fetch_assoc($get);

    if ($_POST['edit_pass'] == "") {
        $pass_hash = $data['password'];
    } else {
        if (strlen($pass) < 8) {
            echo "Password must be 8 character";
            exit;
        } else {
            $pass_hash = password_hash($pass, PASSWORD_BCRYPT);
        }
    }

    $active_status = "";
    if (isset($_POST['is_active']) && !empty($_POST['is_active'])) {
        $active = $_POST["is_active"];
        if (strtolower($active) == "on") {
            $active_status = 1;
        }
    } else if (isset($_POST['is_ban']) && !empty($_POST['is_ban'])) {
        $ban = $_POST["is_ban"];
        if (strtolower($ban) == "on") {
            $active_status = 0;
        }
    }

    if ($_FILES["edit_profile"]["name"] == "") {
        $updateSql = "UPDATE `doctors` SET `name`='{$name}',`contact`='{$contact}',`department`='{$department}',`email`='{$email}',`password`='{$pass_hash}',`gender`='{$gender}',`designation`='{$designation}',`qualification`='{$qualification}',`experience`='{$experience}',`specialization`='{$experience}',`bio`='{$bio}',`fees`='{$fees}',`address`='{$address}',`active`='{$active_status}' WHERE `id` = $id";
        if (mysqli_query($con, $updateSql)) {
            echo 1;
        } else {
            echo "Doctors data updated failed!!";
        }
    } else {
        $extension = pathinfo($img_name, PATHINFO_EXTENSION);
        $supported_extension = array("jpg", "jpeg", "png", "webp");
        if (!in_array($extension, $supported_extension)) {
            echo "Invalid image extension or formats";
            exit;
        } else {
            $del_img_name = $data['profile'];
            if (unlink("../images/doctors/{$del_img_name}")) {
                $img_new_name = rand() . "." . $extension;
                $path = "../images/doctors/{$img_new_name}";
                move_uploaded_file($_FILES["edit_profile"]["tmp_name"], $path);

                $updateSql = "UPDATE `doctors` SET `name`='{$name}',`contact`='{$contact}',`department`='{$department}',`email`='{$email}',`password`='{$pass_hash}',`gender`='{$gender}',`designation`='{$designation}',`qualification`='{$qualification}',`experience`='{$experience}',`specialization`='{$experience}',`bio`='{$bio}',`fees`='{$fees}',`profile`='{$img_new_name}',`address`='{$address}',`active`='{$active_status}' WHERE `id` = $id";
                if (mysqli_query($con, $updateSql)) {
                    echo 1;
                } else {
                    echo "Doctors data updated failed!!";
                }

            }
        }
    }
}

// Todo: Doctor data delete

if(isset($_POST["status"]) && $_POST['status'] == "deleteDoctor"){
    $id = $_POST["id"];
    $del_img_sql = "SELECT `profile` FROM `doctors` WHERE `id` = $id";
    $del_img_sql_res = mysqli_query($con,$del_img_sql);
    $del_img_row = mysqli_fetch_assoc($del_img_sql_res);
    $del_img_name = $del_img_row['profile'];
    if(unlink("../images/doctors/{$del_img_name}")){
        $sql = "DELETE FROM `doctors` WHERE `id` = $id ";
        if (mysqli_query($con, $sql)) {
            echo 1;
        } else {
            echo "Doctors data deleted failed!!";
        }
    }else{
        echo "Doctor image deleted failed !!";
    }

}