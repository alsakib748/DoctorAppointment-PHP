<?php
include "../admin/inc/db.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function send_mail($email, $token)
{
    require '../PHPMailer/Exception.php';
    require '../PHPMailer/PHPMailer.php';
    require '../PHPMailer/SMTP.php';

    // Todo: Send email to the users to verification 
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'alsakib748@gmail.com';                     //SMTP username
        $mail->Password   = 'tforsdttgaadnbaf';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('alsakib748@gmail.com', 'doctorappointment');
        $mail->addAddress($email);     //Add a recipient

        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Click To Verify Your Email';
        $mail->Body    = "
            <strong>
                <button type='button' style='cursor:pointer;border:none;outline:none;border-radius:10px;background:violet;padding:5px;box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;'>
                    <a href='http://localhost/doctorappointment/login.php?uemail=$email&utoken=$token' style='text-decoration:none;font-size:1rem;color:white;'>Click To Verify</a>
                </button>
            </strong>
        ";
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        return true;
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["contact"]) && isset($_POST["pass"]) && isset($_POST["confirm_pass"])) {

    $error = [];
    // Todo : check email is exist or not in the database
    $resultCheckEmail = mysqli_query($con, "SELECT `email` FROM `users` WHERE `email` = '{$_POST['email']}' ");
    if (mysqli_num_rows($resultCheckEmail) > 0) {
        $error['emailError'] = array("email_exist" => "Given email address already exist");
    }
    // Todo : check contact is exist or not in the database
    $resultCheckEmail = mysqli_query($con, "SELECT `contact` FROM `users` WHERE `contact` = '{$_POST['contact']}' ");
    if (mysqli_num_rows($resultCheckEmail) > 0) {
        $error['contactError'] = array("contact_exist" => "Given phone number already exist");
    }

    $name = mysqli_real_escape_string($con, validate($_POST["name"]));
    $email = mysqli_real_escape_string($con, validate($_POST["email"]));
    $contact = mysqli_real_escape_string($con, validate($_POST["contact"]));
    $pass = mysqli_real_escape_string($con, validate($_POST["pass"]));
    $confirm_pass = mysqli_real_escape_string($con, validate($_POST["confirm_pass"]));
    $token = bin2hex(random_bytes(16));

    if (!empty($error)) {
        echo json_encode($error);
        exit;
    }

    if(!send_mail($email,$token)){
        echo "Mail send failed";
        exit;
    }

    $pass_hash = password_hash($pass, PASSWORD_BCRYPT);
    $sql = "INSERT INTO `users` (`name`, `email`, `contact`, `pass`,`token`) VALUES ('{$name}', '{$email}', '{$contact}', '{$pass_hash}','{$token}')";
    $result = mysqli_query($con, $sql);
    if ($result) {
        echo json_encode(array("success" => "Signup Successful."));
    }else{
        echo json_encode(array("failed" => "Signup failed"));
    }
}

function validate($value)
{
    $value = trim($value);
    $value = stripslashes($value);
    $value = htmlspecialchars($value);

    return $value;
}
