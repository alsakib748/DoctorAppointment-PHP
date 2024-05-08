<?php

include "../inc/db.php";

if (isset($_POST["status"]) && $_POST["status"] == "loadAdminData") {
    $sql = "SELECT * FROM `admin`";
    $result = mysqli_query($con, $sql);
    $output = "";
    if (mysqli_num_rows($result) > 0) {
        $output .= "<table class='table table-striped table-light table-hover table-bordered'>
        <thead>
            <tr>
                <th class='text-muted' scope='col'>ID</th>
                <th class='text-muted' scope='col'>Profile</th>
                <th class='text-muted' scope='col'>NAME</th>
                <th class='text-muted' scope='col'>EMAIL</th>
                <th class='text-muted' scope='col'>PHONE</th>
                <th class='text-muted' scope='col'>ROLE</th>
                <th class='text-muted' scope='col'>STATUS</th>
                <th class='text-muted' scope='col'>ACTION</th>
            </tr>
        </thead>
        <tbody>";
        $i = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            $status = "";
            if ($row['status'] == 1) {
                $status = "<button type='submit' name='active' id='admin-status' data-aid='{$row['id']}' class='btn btn-sm btn-info'>ACTIVE</button>";
            } else {
                $status = "<button type='submit' name='inactive' id='admin-status' data-aid='{$row['id']}' class='btn btn-sm btn-danger'>INACTIVE</button>";
            }
            $output .= "
            <tr>
            <td class='text-muted'>$i</td>
            <td> <img src='images/admin/{$row['profile']}' class='img-fluid' style='border-radius: 50%;' width='60px' height='60' /> </td>
            <td>{$row['name']}</td>
            <td>{$row['email']}</td>
            <td>{$row['contact']}</td>
            <td><span class='badge text-bg-primary'>{$row['role']}</span></td>
            <td>{$status}</td>
            <td>
                <button type='submit' class='btn btn-sm btn-success shadow-none edit-admin' data-aeid='{$row['id']}' data-bs-toggle='modal' data-bs-target='#editAdmin'><i class='fa-solid fa-pen-to-square'></i> Edit</button>
                <button type='submit' class='btn btn-sm btn-danger shadow-none delete-admin' data-adid='{$row['id']}'><i class='fa-regular fa-trash-can'></i> Delete</button>
            </td>
            </tr>
            ";

            $i++;
        }
        $output .= "</tbody>
        </table>";
    } else {
        echo "Admin not found !!";
        exit();
    }

    echo $output;
}

// Todo: insert admin data to database
if (isset($_POST['name']) || isset($_POST['email']) || isset($_POST['pass']) || isset($_POST['contact']) || isset($_POST['role']) || isset($_FILES['profile']['name'])) {

    if ($_POST['name'] == "" || $_POST['email'] == "" || $_POST['pass'] == "" || $_POST['contact'] == "" || $_POST['role'] == "" || $_FILES['profile']['name'] == "") {
        echo "All fields are required";
    } else {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $pass = trim($_POST['pass']);
        $contact = trim($_POST['contact']);
        $role = $_POST['role'];
        $img_name = $_FILES['profile']['name'];
        $img_size = $_FILES['profile']['size'];
        $extension = pathinfo($img_name, PATHINFO_EXTENSION);
        $supported_extension = array("jpg", "jpeg", "png", "webp");
        if (!in_array($extension, $supported_extension)) {
            echo "Invalid Image Use(jpg,png,webp) Formats.";
            exit();
        } else if ($img_size > 2048000) {
            echo "Image size use less than 2 MB.";
            exit();
        } else if (strlen($pass) < 8) {
            echo "Password at least 8 character.";
            exit();
        } else if (strlen($contact) != 11) {
            echo "Contact number must be 11 digit";
            exit();
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email address";
            exit();
        } else {
            $pass_hash = password_hash($pass, PASSWORD_BCRYPT);
            $profile_rand_name = rand() . "." . $extension;
            $path = "../images/admin/{$profile_rand_name}";
            if (move_uploaded_file($_FILES['profile']['tmp_name'], $path)) {
                $sql = "INSERT INTO `admin`(`name`,`email`,`password`,`profile`,`contact`,`role`) VALUES ('{$name}','{$email}','{$pass_hash}','{$profile_rand_name}','{$contact}','{$role}')";
                if (mysqli_query($con, $sql)) {
                    echo 1;
                    exit();
                } else {
                    echo "Doctor data insert failed !!";
                    exit();
                }
            }
        }
    }
}
// Todo: change status (active or inactive) code
if (isset($_POST["operation"]) && $_POST["operation"] == "updateStatus") {
    $id = $_POST["uid"];
    $status = $_POST["status"];

    $sql = "UPDATE `admin` SET `status` = {$status} WHERE `id`={$id} ";
    $result = mysqli_query($con, $sql);
    if ($result) {
        echo 1;
    } else {
        echo "Status changed failed !!";
    }
}
// Todo: edit admin existing data fetch code
if (isset($_POST["operation"]) && $_POST["operation"] == "editAdminData" && isset($_POST["id"])) {
    $id = $_POST["id"];

    $sql = "SELECT * FROM `admin` WHERE `id` = $id";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    echo json_encode($row);
}
// Todo: update admin data to database
if (isset($_POST['ename']) || isset($_POST['eemail']) || isset($_POST['epass']) || isset($_POST['econtact']) || isset($_POST['erole']) || isset($_FILES['eprofile']['name'])) {
    $id = $_POST["update_id"];
    $name = $_POST['ename'];
    $email = $_POST['eemail'];
    $pass = trim($_POST['epass']);
    $contact = trim($_POST['econtact']);
    $role = $_POST['erole'];
    $img_name = $_FILES['eprofile']['name'];
    $img_size = $_FILES['eprofile']['size'];

    if (strlen($contact) != 11) {
        echo "Contact number must be 11 digit";
        exit();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email address";
        exit();
    }

    $hash_pass = "";
    $getPassSql = "SELECT `password`,`profile` FROM `admin` WHERE `id` = $id";
    $getPassResult = mysqli_query($con, $getPassSql);
    $getPassRow = mysqli_fetch_assoc($getPassResult);
    if($pass == ""){
        $hash_pass = $getPassRow['password'];
    }else{
        if (strlen($pass) < 8) {
            echo "Password at least 8 character.";
            exit();
        }
        $hash_pass = password_hash($pass,PASSWORD_BCRYPT);
    }

    if ($_FILES['eprofile']['name'] == "") {
        $sql = "UPDATE `admin` SET `name`='{$name}',`email`='{$email}',`password`='{$hash_pass}',`contact`='{$contact}',`role`='{$role}' WHERE `id` = $id";
        if(mysqli_query($con,$sql)){
            echo 1;
        }else{
            echo "Admin data update failed !!";
        }
    } else {
        $extension = pathinfo($img_name, PATHINFO_EXTENSION);
        $supported_extension = array("jpg", "jpeg", "png", "webp");

        if (!in_array($extension, $supported_extension)) {
            echo "Invalid Image Use(jpg,png,webp) Formats.";
            exit();
        } else if ($img_size > 2048000) {
            echo "Image size use less than 2 MB.";
            exit();
        }else{
            unlink("../images/admin/{$getPassRow['profile']}");
            $profile_rand_name = rand(). ".". $extension;
            $path = "../images/admin/{$profile_rand_name}";
            if (move_uploaded_file($_FILES['eprofile']['tmp_name'], $path)) {
                $sql = "UPDATE `admin` SET `name`='{$name}',`email`='{$email}',`password`='{$hash_pass}',`profile`='{$profile_rand_name}',`contact`='{$contact}',`role`='{$role}' WHERE `id` = $id";
                if(mysqli_query($con,$sql)){
                    echo 1;
                }else{
                    echo "Admin data update failed!!";
                }
            }    
        }
    }
}

if(isset($_POST["status"]) && $_POST["status"] == "deleteAdmin"){
    $id = $_POST['id'];
    $sql = "DELETE FROM `admin` WHERE `id` = $id";
    if(mysqli_query($con,$sql)){
        echo 1;
    }else{
        echo "Admin delete failed !!";
    }
}
