<?php 
include "../admin/inc/db.php";

if(isset($_POST['email']) && isset($_POST['pass'])){
    $email = mysqli_real_escape_string($con,test_input($_POST['email']));
    $pass = mysqli_real_escape_string($con,test_input($_POST['pass']));
    
    $pass_hash = password_hash($pass,PASSWORD_BCRYPT);

    // echo $pass_hash;
    // die;

    $userCheck = mysqli_query($con,"SELECT * FROM `users` WHERE `email`='{$email}' LIMIT 1");
    $adminCheck = mysqli_query($con,"SELECT * FROM `admin` WHERE `email`='{$email}'  LIMIT 1");
    $doctorCheck = mysqli_query($con,"SELECT * FROM `doctors` WHERE `email`='{$email}' LIMIT 1");

    $success = [];
    $error = [];

    if(mysqli_num_rows($userCheck) > 0 || mysqli_num_rows($adminCheck) > 0 || mysqli_num_rows($doctorCheck) > 0){
        $userRow = mysqli_fetch_assoc($userCheck);
        $adminRow = mysqli_fetch_assoc($adminCheck);
        $doctorRow = mysqli_fetch_assoc($doctorCheck);

        if(mysqli_num_rows($userCheck) > 0){
            // if($userRow['email'] != $email){
            //     $error['userEmailError'] = array("emailError" => "Email not found !!");
            // }
            // else 
            if(!password_verify($pass,$userRow['pass'])){
                $error['userPassError'] = array("passError" => "Password are not found !!");
            }
            else if($userRow['is_verified'] != 1){
                $error['userVerifyError'] = array("verifyError" => "You are not verified !!");
            }
            else{
                session_start();
                $_SESSION['userLogin'] = true;
                $_SESSION['userId'] = $userRow['id'];
                $_SESSION['userName'] = $userRow['name'];
                $_SESSION['userEmail'] = $userRow['email'];
                $_SESSION['userContact'] = $userRow['contact'];
                $_SESSION['userVerified'] = $userRow['is_verified'];
                $success['userLoginSuccess'] = array("success" => 1);
            }
        }
        else if(mysqli_num_rows($adminCheck) > 0){
            // if($adminRow['email'] != $email){
            //     $error['adminEmailError'] = array("emailError" => "Admin email not found !!");
            // }
            // else
            if(!password_verify($pass,$adminRow['password'])){
                $error['adminPassError'] = array("passError" => "Admin password are not found !!");
            }
            else if($adminRow['status'] != 1){
                $error['adminStatusError'] = array("statusError" => "Admin are not active !!");
            }
            else{
                session_start();
                $_SESSION['adminLogin'] = true;
                $_SESSION['adminId'] = $adminRow['id'];
                $_SESSION['adminName'] = $adminRow['name'];
                $_SESSION['adminEmail'] = $adminRow['email'];
                $_SESSION['adminContact'] = $adminRow['contact'];
                $_SESSION['adminProfile'] = $adminRow['profile'];
                $_SESSION['adminRole'] = $adminRow['role'];
                $success['adminLoginSuccess'] = array("success" => 1);
            }
        } 
        else if(mysqli_num_rows($doctorCheck) > 0){
            // if($doctorRow['email'] != $email){
            //     $error['doctorEmailError'] = array("emailError" => "Doctor email not found !!");
            // }
            // else
            if(!password_verify($pass,$doctorRow['password'])){
                $error['doctorPassError'] = array("passError" => "Doctor password are not found !!");
            }
            else if($doctorRow['active'] != 1){
                $error['doctorActiveError'] = array("activeError" => "Doctor are banned !!");
            }
            else{
                session_start();
                $_SESSION['doctorLogin'] = true;
                $_SESSION['doctorId'] = $doctorRow['id'];
                $_SESSION['doctorName'] = $doctorRow['name'];
                $_SESSION['doctorEmail'] = $doctorRow['email'];
                $_SESSION['doctorContact'] = $doctorRow['contact'];
                $_SESSION['doctorProfile'] = $doctorRow['profile'];
                $_SESSION['doctorDepartment'] = $doctorRow['department'];
                $_SESSION['doctorFees'] = $doctorRow['fees'];
                $success['doctorLoginSuccess'] = array("success" => 1);
            }    
        }

    }else{
        $error['loginAccessError'] = array("accessError" => "You are not enable to access.(Please register then login).!!");
        // $error['userPassError'] = array("passError" => "Password are not found!!");
        // $error['userVerifyError'] = array("verifyError" => "You are not verified!!");
    }

    if(!empty($error)){
        echo json_encode($error);
        exit;
    }

    if(!empty($success)){
        echo json_encode($success);
        exit;
    }
}

function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}

?>