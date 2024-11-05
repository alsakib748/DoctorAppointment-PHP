<?php
session_start();
if (isset($_SESSION["doctorLogin"]) && $_SESSION["doctorLogin"] == true) {
    header("Location: doctor/dashboard.php");
    exit;
}
?>

<?php
include "admin/inc/db.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function send_mail($email, $aptData, $userData, $doctorData)
{
    require 'PHPMailer/Exception.php';
    require 'PHPMailer/PHPMailer.php';
    require 'PHPMailer/SMTP.php';

    // Todo: Send email to the users to verification 
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;
        //Enable verbose debug output
        $mail->isSMTP();
        //Send using SMTP
        $mail->Host = 'smtp.gmail.com';
        //Set the SMTP server to send through
        $mail->SMTPAuth = true;
        //Enable SMTP authentication
        $mail->Username = 'alsakib748@gmail.com';
        //SMTP username
        $mail->Password = 'tforsdttgaadnbaf';
        //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        //Enable implicit TLS encryption
        $mail->Port = 587;
        //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('alsakib748@gmail.com', 'doctorappointment');
        $mail->addAddress($email);
        //Add a recipient

        $mail->isHTML(true);
        //Set email format to HTML
        $mail->Subject = 'Appointment Take Successful';
        $mail->Body = '
                <!-- Complete Email template -->

<body style="background-color:grey">
    <table align="center" border="0" cellpadding="0" cellspacing="0" width="550" bgcolor="white" style="border:2px solid black">
        <tbody>
            <tr>
                <td align="center">
                    <table align="center" border="0" cellpadding="0" cellspacing="0" class="col-550" width="550">
                        <tbody>
                            <tr>
                                <td align="center" style="background-color: #146EBE;height: 50px;">

                                    <a href="#" style="text-decoration: none;">
                                        <p style="color:white;font-weight:bold;">
                                            Doctor Appointment
                                        </p>
                                    </a>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr style="height: 50px;">
                <td align="center" style="border: none;border-bottom: 2px solid #4cb96b;padding-right: 20px;padding-left:20px">

                    <p style="font-weight: bolder;font-size: 20px;letter-spacing: 0.025em;color:#146EBE;">
                        You are successfully booked an appointment  
                        <br/>
                        To the <strong style="color: #5D00FF; "><i>' . $doctorData['name'] . '</i></strong>.
                    </p>

                </td>
            </tr>

            <tr style="display: inline-block;">
                <td style="height: 150px;padding: 20px;border: none;border-bottom: 2px solid #361B0E;background-color: white;">

                    <h4 style="color: #146EBE">Appointment Information</h4>

                    <hr/>

                    <p style="text-align: left;align-items: center;">
                        <strong>Appointment No:</strong> ' . $aptData['apt_no'] . '
                    </p>
                    <p style="text-align: left;align-items: center;">
                        <strong>Appointment Date:</strong> ' . $aptData['apt_date'] . '
                    </p>
                    <p style="text-align: left;align-items: center;">
                        <strong>Appointment Shift:</strong> ' . $aptData['shift'] . '
                    </p>
                    <p style="text-align: left;align-items: center;">
                        <strong>Appointment Time:</strong> ' . $aptData['start_time'] . '
                    </p>
                    
                    <h4 style="color: #146EBE">Doctor Information</h4>

                    <hr/>

                    <p style="text-align: left;align-items: center;">
                        <strong>Doctor Name:</strong> ' . $doctorData['name'] . '
                    </p>

                    <p style="text-align: left;align-items: center;">
                        <strong>Doctor Designation:</strong> ' . $doctorData['designation'] . '
                    </p>

                    <p style="text-align: left;align-items: center;">
                        <strong>Doctor Specialization:</strong> ' . $doctorData['specialization'] . '
                    <p>

                    <p style="text-align: left;align-items: center;">
                        <strong>Doctor Fees:</strong> ' . $doctorData['fees'] . '
                    <p>
                        
                    <h4 style="color: #146EBE">Patient Information</h4>

                    <hr/>

                    <p style="text-align: left;align-items: center;">
                        <strong>Patient Name:</strong> ' . $userData['name'] . '
                    </p>

                    <p style="text-align: left;align-items: center;">
                        <strong>Patient Email:</strong> ' . $userData['email'] . '
                    </p>

                    <p style="text-align: left;align-items: center;">
                        <strong>Patient Contact:</strong> ' . $userData['contact'] . '
                    </p>

                    <p style="text-align: center;align-items: center;">

                        <a href="http://localhost/doctorappointment/profile.php?status=appointments" target="_blank"
                        style="text-decoration: none;background-color:#146EBE;color:white;border: 2px solid #146EBE;padding: 10px 30px;font-weight: bold;border-radius:5px;"> 
                            View Appointment
                        </a>

                    </p>

                </td>
            </tr>
            <tr style="border: none; 
            background-color: #146EBE; 
            height: 40px; 
            color:white; 
            padding-bottom: 20px; 
            text-align: center;">
                
<td height="40px" align="center">
    <p style="color:white; 
    line-height: 1.5em;">
    Doctor Appointment
    </p>
    <a href="#" 
    style="border:none;text-decoration: none;padding: 5px;"> 
    <img height="30" 
    src=
"https://extraaedgeresources.blob.core.windows.net/demo/salesdemo/EmailAttachments/icon-twitter_20190610074030.png" 
    width="30" /> 
    </a> 
    
    <a href="#"
    style="border:none;
    text-decoration: none; 
    padding: 5px;"> 
    
    <img height="30" 
    src=
"https://extraaedgeresources.blob.core.windows.net/demo/salesdemo/EmailAttachments/icon-linkedin_20190610074015.png" 
width="30" /> 
    </a>
    
    <a href="#" 
    style="border:none;
    text-decoration: none;
    padding: 5px;"> 
    
    <img height="20"
    src=
"https://extraaedgeresources.blob.core.windows.net/demo/salesdemo/EmailAttachments/facebook-letter-logo_20190610100050.png" 
        width="24" 
        style="position: relative;padding-bottom: 5px;" />
    </a>
</td>
</tr>

        </tbody>
    </table>
</body>

        ';
        $mail->AltBody = 'You are successfully booked an appointment to the doctor.';

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        return false;
    }
}

if (isset($_POST["val_id"])) {
    $val_id = urlencode($_POST['val_id']);
    $store_id = urlencode("medic65f5ce6be7c07");
    $store_passwd = urlencode("medic65f5ce6be7c07@ssl");
    $requested_url = ("https://sandbox.sslcommerz.com/validator/api/validationserverAPI.php?val_id=" . $val_id . "&store_id=" . $store_id . "&store_passwd=" . $store_passwd . "&v=1&format=json");

    $handle = curl_init();
    curl_setopt($handle, CURLOPT_URL, $requested_url);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false); # IF YOU RUN FROM LOCAL PC
    curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false); # IF YOU RUN FROM LOCAL PC

    $result = curl_exec($handle);

    $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

    if ($code == 200 && !(curl_errno($handle))) {

        # TO CONVERT AS ARRAY
        # $result = json_decode($result, true);
        # $status = $result['status'];

        # TO CONVERT AS OBJECT
        $result = json_decode($result);

        # TRANSACTION INFO
        $status = $result->status;
        $tran_date = $result->tran_date;
        $tran_id = $result->tran_id;
        $val_id = $result->val_id;
        $amount = $result->amount;
        $store_amount = $result->store_amount;
        $bank_tran_id = $result->bank_tran_id;
        $card_type = $result->card_type;

        # EMI INFO
        $emi_instalment = $result->emi_instalment;
        $emi_amount = $result->emi_amount;
        $emi_description = $result->emi_description;
        $emi_issuer = $result->emi_issuer;

        # ISSUER INFO
        $card_no = $result->card_no;
        $card_issuer = $result->card_issuer;
        $card_brand = $result->card_brand;
        $card_issuer_country = $result->card_issuer_country;
        $card_issuer_country_code = $result->card_issuer_country_code;

        # API AUTHENTICATION
        $APIConnect = $result->APIConnect;
        $validated_on = $result->validated_on;
        $gw_version = $result->gw_version;

        # optional value
        $apt_no = $result->value_a;
        $email = $result->value_b;
        $apt_id = $result->value_c;

        $contact = $result->value_d;

        $checkIsUser = mysqli_query($con, " SELECT * FROM `users` WHERE `contact` = '{$contact}' ");

        $checkIsAdmin = mysqli_query($con, " SELECT * FROM `admin` WHERE `contact` = '{$contact}' ");

        // if (mysqli_num_rows($checkIsUser) > 0  || mysqli_num_rows($checkIsAdmin) > 0) {

        //     if (mysqli_num_rows($checkIsUser) > 0) {

        //         $PatientData = mysqli_query($con, "SELECT `users`.* FROM `users` INNER JOIN `appointments` ON `users`.`id` = `appointments`.`patient_id` WHERE `appointments`.`id` = $apt_id AND `appointments`.`apt_no` = '{$apt_no}' ");
        //         $userRow = mysqli_fetch_assoc($PatientData);

        //         $_SESSION['userLogin'] = true;
        //         $_SESSION['userId'] = $userRow['id'];
        //         $_SESSION['userName'] = $userRow['name'];
        //         $_SESSION['userEmail'] = $userRow['email'];
        //         $_SESSION['userContact'] = $userRow['contact'];
        //         $_SESSION['userVerified'] = $userRow['is_verified'];
        //         $success['userLoginSuccess'] = array("success" => 1);

        //         if ($status == "VALID") {
        //             if (mysqli_query($con, "UPDATE `appointments` SET `status` = 'Booked' WHERE `id`= $apt_id AND `apt_no` = '$apt_no' ")) {

        //                 $sql = "INSERT INTO `appointment_bookings`(`trans_date`, `card_type`, `amount`, `trans_id`, `status`, `appointment_id`) VALUES ('{$tran_date}','{$card_type}','{$amount}','{$tran_id}','{$status}','{$apt_id}')";

        //                 if (mysqli_query($con, $sql)) {
        //                     echo "<script>alert('Patient Appointment Bookings Successfully')</script>";
        //                 } else {
        //                     echo "<script>alert('Patient Appointments Bookings Failed !!')</script>";
        //                 }
        //             }
        //         }

        //     }

        //     if (mysqli_num_rows($checkIsAdmin) > 0) {
        //         $PatientData = mysqli_query($con, "SELECT `admin`.* FROM `admin` INNER JOIN `appointments` ON `admin`.`id` = `appointments`.`admin_id` WHERE `appointments`.`id` = $apt_id AND `appointments`.`apt_no` = '{$apt_no}' ");
        //         $userRow = mysqli_fetch_assoc($PatientData);

        //         $_SESSION['adminLogin'] = true;
        //         $_SESSION['adminId'] = $userRow['id'];
        //         $_SESSION['adminName'] = $userRow['name'];
        //         $_SESSION['adminEmail'] = $userRow['email'];
        //         $_SESSION['adminContact'] = $userRow['contact'];
        //         $_SESSION['adminProfile'] = $userRow['profile'];
        //         $_SESSION['adminRole'] = $userRow['role'];
        //         $success['adminLoginSuccess'] = array("success" => 1);

        //         if ($status == "VALID") {

        //             if (mysqli_query($con, "UPDATE `appointments` SET `status` = 'Booked' WHERE `id`= $apt_id AND `apt_no` = '$apt_no' ")) {

        //                 $sql = "INSERT INTO `appointment_bookings`(`trans_date`, `card_type`, `amount`, `trans_id`, `status`, `appointment_id`) VALUES ('{$tran_date}','{$card_type}','{$amount}','{$tran_id}','{$status}','{$apt_id}')";

        //                 if (mysqli_query($con, $sql)) {
        //                     echo "<script>alert('Patient Appointment Bookings Successfully')</script>";
        //                 } else {
        //                     echo "<script>alert('Patient Appointments Bookings Failed !!')</script>";
        //                 }
        //             }
        //         }
        //     }
        // }

        if ($status == "VALID") {
            if (mysqli_num_rows($checkIsUser) > 0 || mysqli_num_rows($checkIsAdmin) > 0) {

                if (mysqli_num_rows($checkIsUser) > 0) {

                    $PatientData = mysqli_query($con, "SELECT `users`.* FROM `users` INNER JOIN `appointments` ON `users`.`id` = `appointments`.`patient_id` WHERE `appointments`.`id` = $apt_id AND `appointments`.`apt_no` = '{$apt_no}' ");
                    $userRow = mysqli_fetch_assoc($PatientData);

                    $_SESSION['userLogin'] = true;
                    $_SESSION['userId'] = $userRow['id'];
                    $_SESSION['userName'] = $userRow['name'];
                    $_SESSION['userEmail'] = $userRow['email'];
                    $_SESSION['userContact'] = $userRow['contact'];
                    $_SESSION['userVerified'] = $userRow['is_verified'];
                    $success['userLoginSuccess'] = array("success" => 1);

                    $status_update = mysqli_query($con, "UPDATE `appointments` SET `status` = 'Booked' WHERE `id`= $apt_id AND `apt_no` = '$apt_no' ");
                    $apt_id_insert = mysqli_query($con, "INSERT INTO `appointments_feedback`(`appointment_id`) VALUES('{$apt_id}') ");

                    if ($status_update && $apt_id_insert) {

                        $sql = "INSERT INTO `appointment_bookings`(`trans_date`, `card_type`, `amount`, `trans_id`, `status`, `appointment_id`) VALUES ('{$tran_date}','{$card_type}','{$amount}','{$tran_id}','{$status}','{$apt_id}')";

                        if (mysqli_query($con, $sql)) {

                            $appointDoctor = mysqli_query($con, "SELECT * FROM `doctors` INNER JOIN `appointments` ON `doctors`.`id` = `appointments`.`doctor_id` WHERE `apt_no` = '{$apt_no}' ");

                            $doctorData = mysqli_fetch_assoc($appointDoctor);

                            $appointmentData = mysqli_query($con, "SELECT * FROM `appointments` WHERE `apt_no` = '{$apt_no}' AND `status` = 'Booked' ");

                            $aptData = mysqli_fetch_assoc($appointmentData);

                            send_mail($userRow['email'], $aptData, $userRow, $doctorData);

                            echo "<script>alert('Patient Appointment Bookings Successfully')</script>";
                        } else {
                            echo "<script>alert('Patient Appointments Bookings Failed !!')</script>";
                        }
                    }
                } else if (mysqli_num_rows($checkIsAdmin) > 0) {
                    $PatientData = mysqli_query($con, "SELECT `admin`.* FROM `admin` INNER JOIN `appointments` ON `admin`.`id` = `appointments`.`admin_id` WHERE `appointments`.`id` = $apt_id AND `appointments`.`apt_no` = '{$apt_no}' ");
                    $userRow = mysqli_fetch_assoc($PatientData);

                    $_SESSION['adminLogin'] = true;
                    $_SESSION['adminId'] = $userRow['id'];
                    $_SESSION['adminName'] = $userRow['name'];
                    $_SESSION['adminEmail'] = $userRow['email'];
                    $_SESSION['adminContact'] = $userRow['contact'];
                    $_SESSION['adminProfile'] = $userRow['profile'];
                    $_SESSION['adminRole'] = $userRow['role'];
                    $success['adminLoginSuccess'] = array("success" => 1);

                    $status_update = mysqli_query($con, "UPDATE `appointments` SET `status` = 'Booked' WHERE `id`= $apt_id AND `apt_no` = '$apt_no' ");
                    $apt_id_insert = mysqli_query($con, "INSERT INTO `appointments_feedback`(`appointment_id`) VALUES('{$apt_id}') ");

                    if ($status_update && $apt_id_insert) {
                        // todo: insert appointment id in the appointments_feedback table

                        $sql = "INSERT INTO `appointment_bookings`(`trans_date`, `card_type`, `amount`, `trans_id`, `status`, `appointment_id`) VALUES ('{$tran_date}','{$card_type}','{$amount}','{$tran_id}','{$status}','{$apt_id}')";

                        if (mysqli_query($con, $sql)) {
                            echo "<script>alert('Patient Appointment Bookings Successfully')</script>";
                        } else {
                            echo "<script>alert('Patient Appointments Bookings Failed !!')</script>";
                        }
                    }
                }
            }
        } else if ($status == "FAILED") {
            if (mysqli_num_rows($checkIsUser) > 0 || mysqli_num_rows($checkIsAdmin) > 0) {

                if (mysqli_num_rows($checkIsUser) > 0) {
                    $PatientData = mysqli_query($con, "SELECT `users`.* FROM `users` INNER JOIN `appointments` ON `users`.`id` = `appointments`.`patient_id` WHERE `appointments`.`id` = $apt_id AND `appointments`.`apt_no` = '{$apt_no}' ");
                    $userRow = mysqli_fetch_assoc($PatientData);

                    $_SESSION['userLogin'] = true;
                    $_SESSION['userId'] = $userRow['id'];
                    $_SESSION['userName'] = $userRow['name'];
                    $_SESSION['userEmail'] = $userRow['email'];
                    $_SESSION['userContact'] = $userRow['contact'];
                    $_SESSION['userVerified'] = $userRow['is_verified'];
                    $success['userLoginSuccess'] = array("success" => 1);
                } else if (mysqli_num_rows($checkIsAdmin) > 0) {
                    $PatientData = mysqli_query($con, "SELECT `admin`.* FROM `admin` INNER JOIN `appointments` ON `admin`.`id` = `appointments`.`admin_id` WHERE `appointments`.`id` = $apt_id AND `appointments`.`apt_no` = '{$apt_no}' ");
                    $userRow = mysqli_fetch_assoc($PatientData);

                    $_SESSION['adminLogin'] = true;
                    $_SESSION['adminId'] = $userRow['id'];
                    $_SESSION['adminName'] = $userRow['name'];
                    $_SESSION['adminEmail'] = $userRow['email'];
                    $_SESSION['adminContact'] = $userRow['contact'];
                    $_SESSION['adminProfile'] = $userRow['profile'];
                    $_SESSION['adminRole'] = $userRow['role'];
                    $success['adminLoginSuccess'] = array("success" => 1);
                }
            }
        }
    } else {
        echo "Failed to connect with SSLCOMMERZ";
    }
}

?>

<?php require_once("inc/header.php") ?>
<?php
if ((isset($_SESSION["userLogin"]) && $_SESSION["userLogin"] == true) || isset($_SESSION["adminLogin"]) && $_SESSION["adminLogin"] == true) {
    ?>

    <section class="my-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <?php if (isset($_SESSION["userLogin"])) { ?>
                        <h6 class='badge text-bg-primary fs-6'>Hello <span
                                class="text-white"><?php echo $_SESSION['userName']; ?></span></h6>
                    <?php } ?>
                    <?php if (isset($_SESSION["adminLogin"])) { ?>
                        <h6 class='badge text-bg-primary fs-6'>Hello <span
                                class="text-white"><?php echo $_SESSION['adminName']; ?></span></h6>
                    <?php } ?>
                    <div class="card shadow profile-card" style="width: 100%;">
                        <div class="card-header">
                            <h5 class="">Quick Links</h5>
                        </div>
                        <div class="card-body">
                            <ul class="nav flex-column my-2">
                                <li class="nav-item border-bottom ">
                                    <a class="nav-link text-dark fw-semibold fs-6" href="profile.php?status=appointments"><i
                                            class="fa-regular fa-calendar-check text-info"></i> My Appointments</a>
                                </li>
                                <?php if (!isset($_SESSION["adminLogin"])) { ?>
                                    <li class="nav-item border-bottom ">
                                        <a class="nav-link text-dark fw-semibold fs-6" href="profile.php?status=profile"><i
                                                class="fa-regular fa-user text-info"></i> My Profile</a>
                                    </li>
                                    <li class="nav-item border-bottom ">
                                        <a class="nav-link text-dark fw-semibold fs-6"
                                            href="profile.php?status=change_password"><i class="fa-solid fa-lock text-info"></i>
                                            Change Password</a>
                                    </li>
                                <?php } ?>
                                <li class="nav-item border-bottom ">
                                    <a class="nav-link text-dark fw-semibold fs-6" href="profile.php?status=support"><i
                                            class="fa-solid fa-phone-volume text-info"></i> Support</a>
                                </li>
                                <li class="nav-item border-bottom ">
                                    <a class="nav-link text-dark fw-semibold fs-6" href="logout.php"><i
                                            class="fa-solid fa-right-from-bracket text-info"></i> Log Out</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <?php if (isset($_GET["status"]) && $_GET['status'] == "appointments") { ?>
                        <div class="card shadow appointments-data-card">
                            <div class="card-header">
                                <h5 class="">My Appointments</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <div class="table-wrapper" id="appointments_show">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } else if (isset($_GET["status"]) && $_GET['status'] == "profile" && !isset($_SESSION["adminLogin"])) { ?>
                            <div class="card shadow" style="width: 100%;">
                                <div class="card-header">
                                    <h5 class="">My Profile</h5>
                                </div>
                                <div class="card-body">
                                    <form action="" method="POST" id="profileForm">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="nameId" class="form-label">Name</label>
                                                    <input type="text" class="form-control" id="nameId">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="emailId" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="emailId">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="phoneId" class="form-label">Phone Number *</label>
                                                    <input type="number" class="form-control" id="phoneId">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="ageId" class="form-label">Age</label>
                                                    <input type="text" class="form-control" id="ageId">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="dateId" class="form-label">Date of Birth</label>
                                                    <input type="date" class="form-control" id="dateId">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="genderId" class="form-label">Gender *</label>
                                                    <select class="form-select" id="genderId">
                                                        <option value="" selected>Select your gender</option>
                                                        <option value="male">Male</option>
                                                        <option value="female">Female</option>
                                                        <option value="others">Others</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-2 d-flex align-items-center justify-content-end">
                                            <input type="submit" class="btn btn-primary" name="submit" value="Submit" id="submitId">
                                        </div>
                                    </form>
                                </div>
                            </div>
                    <?php } else if (isset($_GET["status"]) && $_GET['status'] == "change_password" && !isset($_SESSION["adminLogin"])) { ?>
                                <div class="card shadow" style="width: 100%;">
                                    <div class="card-header">
                                        <h5 class="">Change Your Password</h5>
                                    </div>
                                    <div class="card-body">
                                        <form action="" method="POST">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label for="current_passId" class="form-label">Current Password *</label>
                                                        <input type="password" class="form-control" id="current_passId">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label for="new_passId" class="form-label">New Password *</label>
                                                        <input type="email" class="form-control" id="new_passId">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label for="confirm_passId" class="form-label">Confirm Password *</label>
                                                        <input type="number" class="form-control" id="confirm_passId">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-2 d-flex align-items-center justify-content-end">
                                                <input type="submit" class="btn btn-primary" name="submit" value="Update Password"
                                                    id="submitId">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                    <?php } else if (isset($_GET["status"]) && $_GET['status'] == "support") { ?>
                                    <div class="card shadow" style="width: 100%;">
                                        <div class="card-header">
                                            <h5 class=""><i class="fa-solid fa-phone-volume text-info fs-6"></i> Support</h5>
                                        </div>
                                        <div class="card-body">
                                            <ul class="nav flex-column">
                                                <li class="nav-item border-bottom">
                                                    <h6 class="nav-link text-dark fw-semibold"><i
                                                            class="fa-regular fa-envelope text-info"></i> Email : ayon2465@gmail.com</h6>
                                                </li>
                                                <li class="nav-item border-bottom">
                                                    <h6 class="nav-link text-dark fw-semibold"><i
                                                            class="fa-regular fa-envelope text-info"></i> Email : sakibcse282@gmail.com</h6>
                                                </li>
                                                <li class="nav-item border-bottom">
                                                    <h6 class="nav-link text-dark fw-semibold"><i
                                                            class="fa-solid fa-phone-volume text-info"></i> Phone : 01797327584</h6>
                                                </li>
                                                <li class="nav-item border-bottom">
                                                    <h6 class="nav-link text-dark fw-semibold"><i
                                                            class="fa-solid fa-phone-volume text-info"></i> Phone : 01608544792</h6>
                                                </li>
                                                <li class="nav-item border-bottom">
                                                    <h6 class="nav-link text-dark fw-semibold"><i class="fa-solid fa-globe text-info"></i>
                                                        Website : www.asa.com</h6>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                    <?php } else if (isset($_GET["status"]) && $_GET['status'] == "payment" && isset($_POST["json_data"]) && !empty($_POST["json_data"])) {
                        // // Retrieve JSON data from URL parameter
                        // $json_data = urldecode($_GET['json_data']);
                        // // Parse JSON data
                        // $data = json_decode($json_data, true);
                        // Retrieve the JSON data from the POST request
                        $json_data = $_POST["json_data"];

                        // Decode the JSON data
                        $data = json_decode($json_data, true);
                        ?>
                        <?php if (isset($data['apt_no']) && isset($data['apt_date']) && isset($data['start_time']) && isset($data['patient_name']) && $data['patient_email'] && $data['patient_contact'] && $data['doctor_name'] && isset($data['doctor_department']) && isset($data['doctor_spec']) && isset($data['fees'])) {
                            ?>
                                            <div class="card shadow" style="width: 100%;">
                                                <div class="card-header">
                                                    <h5 class=""><i class="fa-solid fa-phone-volume text-info fs-6"></i> Payments</h5>
                                                </div>
                                                <div class="card-body">
                                        <?php
                                        $apt_no = $data['apt_no'];
                                        $date = $data['apt_date'];
                                        $start_time = $data['start_time'];
                                        $patient_name = $data['patient_name'];
                                        $patient_email = $data['patient_email'];
                                        $patient_contact = $data['patient_contact'];
                                        $doctor_name = $data['doctor_name'];
                                        $doctor_department = $data['doctor_department'];
                                        $doctor_spec = $data['doctor_spec'];
                                        $fees = $data['fees'];

                                        ?>
                                                    <label class="form-label"><b>Appointment No:</b> <span
                                                            id="apt_no"><?php echo $apt_no; ?></span></label><br />
                                                    <label class="form-label"><b>Appointment Day:</b> <span
                                                            id="apt_day"><?php echo $date; ?></span></label><br />
                                                    <label class="form-label"><b>Appointment Time:</b> <span
                                                            id="apt_time"><?php echo $start_time; ?></span></label><br />
                                                    <hr />
                                                    <label class="form-label"><b>Patient Name:</b> <span
                                                            id="patient_name"><?php echo $patient_name; ?></span></label><br />
                                                    <label class="form-label"><b>Patient Email:</b> <span
                                                            id="patient_email"><?php echo $patient_email; ?></span></label><br />
                                                    <label class="form-label"><b>Patient Contact:</b> <span
                                                            id="patient_contact"><?php echo $patient_contact; ?></span></label><br />
                                                    <hr />
                                                    <label class="form-label"><b>Doctor Name:</b> <span
                                                            id="doctor_name"><?php echo $doctor_name; ?></span></label><br />
                                                    <label class="form-label"><b>Doctor Department:</b> <span
                                                            id="doctor_department"><?php echo $doctor_department; ?></span></label><br />
                                                    <label class="form-label"><b>Doctor Specialization:</b> <span
                                                            id="doctor_spec"><?php echo $doctor_spec; ?></span></label><br />
                                                    <label class="form-label"><b>Doctor fees:</b> <span
                                                            id="doctor_fees"><?php echo $fees; ?></span></label><br />
                                                    <hr />
                                                    <label class="form-label"><b>Payment Amount:</b> <span
                                                            id="amount"><?php echo $fees; ?></span></label><br />
                                                    <hr />
                                                    <div class="d-md-flex justify-content-md-end payment-btn">
                                                        <button type="button" class="btn btn-secondary me-md-3 payment-cancel-btn"
                                                            data-bs-dismiss="modal"><a class='text-decoration-none text-white'
                                                                href="profile.php?status=appointments">Cancel</a></button>
                                                        <form action="payment.php" method="POST" class="payment-btn">
                                                            <input type="hidden" name="apt_no" value="<?php echo $apt_no; ?>" />
                                                            <input type="hidden" name="amount" value="<?php echo $fees; ?>" />
                                                            <input type="submit" name="payment" value="Payments"
                                                                class="btn btn-primary payment-submit-btn">
                                                        </form>
                                                    </div>
                                    <?php //} 
                                                ?>
                                                </div>
                                            </div>
                        <?php } else {
                            echo "<h5 class='alert alert-danger text-center'>Invalid Link !!</h5>";
                            exit;
                        }
                    } ?>
                </div>
            </div>
        </div>
    </section>

<?php } else {
    echo "<h6 class='text-center alert alert-danger'>You are not permit to access this page</h6>";
} ?>

<!-- footer include -->

<?php require_once("inc/footer.php") ?>

<script>
    $(document).ready(function () {

        //Todo: show patients or users all appointments
        function loadAppointments() {

            let id = "<?php if (isset($_SESSION['userId']) && $_SESSION['userLogin'] == true) {
                echo $_SESSION['userId'];
            } else {
                echo '';
            }

            if (isset($_SESSION['adminId']) && $_SESSION['adminLogin'] == true) {
                echo $_SESSION['adminId'];
            } else {
                echo '';
            }

            ?>";

        let email = "<?php if (isset($_SESSION['userEmail']) && $_SESSION['userLogin'] == true) {
            echo $_SESSION['userEmail'];
        } else {
            echo '';
        }

        if (isset($_SESSION['adminEmail']) && $_SESSION['adminLogin'] == true) {
            echo $_SESSION['adminEmail'];
        } else {
            echo '';
        }

        ?>";

    if (id != '' && email != '') {
        $.ajax({
            url: "ajax/profile_crud.php",
            type: "POST",
            data: {
                id: id,
                email: email,
                action: "loadAppointments"
            },
            success: function (data) {
                $("#appointments_show").html(data);
                // console.log(data);
            }
        });
    }
        }
    // Call the function to load appointments
    loadAppointments();

    // Todo: load Profile Data 
    function loadProfile() {
        let profile_id = "<?php if (isset($_SESSION['userId']) && $_SESSION['userLogin'] == true) {
            echo $_SESSION['userId'];
        } else {
            echo '';
        }

        if (isset($_SESSION['adminId']) && $_SESSION['adminLogin'] == true) {
            echo $_SESSION['adminId'];
        } else {
            echo '';
        }

        ?>";

    if (profile_id != '') {
        $.ajax({
            url: "ajax/profile_crud.php",
            method: "POST",
            data: {
                id: profile_id,
                action: "loadProfileData"
            },
            success: function (response) {
                let data = JSON.parse(response);
                $("#nameId").val(data.name);
                $("#emailId").val(data.email);
                $("#phoneId").val(data.contact);
                $("#ageId").val(data.age);
                $("#dateId").val(data.dob);
                $("#genderId").val(data.gender);
                // console.log(response);
            }
        });
    }
        }
    loadProfile();

    $("#profileForm").on('submit', function(event){

        event.preventDefault();

        let name = $("#nameId").val();
        let email = $("#emailId").val();
        let phone = $("#phoneId").val();
        let age = $("#ageId").val();
        let dob = $("#dateId").val();
        let gender = $("#genderId").val();

        $.ajax({
            url: "ajax/profile_crud.php",
            method: "POST",
            data: {
                name: name,
                email: email,
                phone: phone,
                age: age,
                dob: dob,
                gender: gender, 
                action: "updateProfile",
            },
            success: function(response){
                if (response == 1) {
                    alert("Profile Updated Successfully");
                    loadProfile();
                } else {
                    alert("Profile Updated Failed !!");
                }
            }    
        });

    });

    });
</script>