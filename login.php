<?php
session_start();
if (isset($_SESSION["adminLogin"]) && $_SESSION["adminLogin"] == true) {
    header("Location: admin/dashboard.php");
    exit;
} else if (isset($_SESSION["doctorLogin"]) && $_SESSION["doctorLogin"] == true) {
    header("Location: doctor/dashboard.php");
    exit;
} else if (isset($_SESSION["userLogin"]) && $_SESSION["userLogin"] == true) {
    header("Location: index.php");
    exit;
}

?>
<!-- header include -->
<?php require_once("inc/header.php"); ?>
<?php
include "admin/inc/db.php";
if (isset($_GET['uemail']) && isset($_GET['utoken'])) {
    $email = $_GET['uemail'];
    $token = $_GET['utoken'];

    $sql = "SELECT * FROM `users` WHERE `email` LIKE '$email' AND `token` LIKE '$token' ";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) > 0) {
        if (mysqli_query($con, "UPDATE `users` SET `is_verified` = 1 WHERE `email` = '$email' AND `token` = '$token' ")) {
            echo "<script>alert('User Verified Successfully')</script>";
        }
    } else {
        echo "<script>alert('User not found !!')</script>";
    }
}
?>

<section class="about">
    <div class="container py-3">
        <div class="row">
            <div class="col-md-6 mt-3">
                <h3 class="text-white mb-2">Login</h3>
                <small class="text-white">
                    <a href="index.php" class="text-decoration-none text-white">Home</a>
                    /
                    <a href="login.php" class="text-decoration-none text-white">Login</a>
                </small>
            </div>
            <div class="col-md-6 d-flex mt-3 align-items-center justify-content-end">

            </div>
        </div>
    </div>
</section>

<div class="container d-none" id="error_message">
    <h6 class='alert alert-danger text-center'> </h6>
</div>

<section class="my-3">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-12 d-md-flex justify-content-md-end login-card">
                <div class="card border-0 shadow w-75">
                    <div class="card-header" style="background-color: #146EBE">
                        <h4 class="text-center text-white">Login</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" id="login-form">
                            <div class="mb-3">
                                <label for="emailId" class="form-label">Email address</label>
                                <input type="email" class="form-control" name="email" id="emailId">
                            </div>
                            <div class="mb-3" id="pass_div_id">
                                <label for="passId" class="form-label">Password</label>
                                <input type="password" class="form-control" name="pass" id="passId">
                            </div>
                            <!-- <div class="mb-3 form-check">
                                
                                <div class="d-flex align-items-center justify-content-between">

                                    <div class="check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">Remember Me</label>
                                    </div>
                                    <div class="forgot-password">
                                        <label class="form-check-label" for="exampleCheck1"><a href="">Forgot Your Password?</a></label>
                                    </div>
                                    
                                </div>

                            </div> -->
                            <button type="submit" class="btn w-100 btn-primary mb-2">Login</button>
                            <div class="my-3">
                                <h6 class="text-center">Don't have an account ? <a href="register.php">Register</a> Now.</h6>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12 login-img">
                <img src="admin/images/auth/login-1.jpg" class="img-fluid w-75 " />
            </div>
        </div>
    </div>
</section>

<!-- footer include -->
<?php require_once("inc/footer.php"); ?>

<script>
    jQuery.validator.addMethod("customEmail", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i.test(value);
    }, "<i class='fa-solid fa-triangle-exclamation'></i> Please enter valid email address!");

    jQuery.validator.addMethod("customPassword", function(value, element) {
        return this.optional(element) || /^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%&]).*$/i.test(value);
    }, "<i class='fa-solid fa-triangle-exclamation'></i> At least 1 number<br/><i class='fa-solid fa-triangle-exclamation'></i> At least 1 lowercase character(a-z)<br/><i class='fa-solid fa-triangle-exclamation'></i> At least 1 uppercase character (A-Z)<br/><i class='fa-solid fa-triangle-exclamation'></i> At least one special character !");

    $("#login-form").validate({
        rules: {
            email: {
                required: true,
                email: true,
                customEmail: true
            },
            pass: {
                required: true
                // minlength: 8,
                // customPassword: true
            },
        },
        messages: {
            email: {
                required: "<i class='fa-solid fa-triangle-exclamation'></i> Please enter your email address"
            },
            pass: {
                required: "<i class='fa-solid fa-triangle-exclamation'></i> Please provide a password"
                // minlength: "<i class='fa-solid fa-triangle-exclamation'></i> Your password must be at least 8 characters",
            },
        },
        submitHandler: function(form) {
            var previousPageUrl = document.referrer;

            $.ajax({
                url: "ajax/login_crud.php",
                method: "POST",
                data: $("#login-form").serialize(),
                success: function(data) {
                    let info = JSON.parse(data);
                    if (info.adminLoginSuccess && info.adminLoginSuccess.success == 1) {
                        alert("Admin login Successfully");
                        window.location.href = "http://localhost/doctorappointment/admin/dashboard.php";
                        $("#login-form").trigger("reset");
                    } else if (info.doctorLoginSuccess && info.doctorLoginSuccess.success == 1) {
                        alert("Doctor login Successfully");
                        window.location.href = "http://localhost/doctorappointment/doctor/dashboard.php";
                        $("#login-form").trigger("reset");
                    } else if (info.userLoginSuccess && info.userLoginSuccess.success == 1) {
                        alert("User login Successfully");
                        $("#login-form").trigger("reset");
                        window.location.href = previousPageUrl;
                    }
                    //  Password field error show-
                    if (info.userPassError) {
                        $("#pass_div_id").append("<label id='full-name-error' class='error' for='passId'><i class='fa-solid fa-triangle-exclamation'></i> " + info.userPassError.passError + "</label>");
                        // alert(info.userPassError.passError);
                    }

                    if (info.adminPassError) {
                        $("#pass_div_id").append("<label id='full-name-error' class='error' for='passId'><i class='fa-solid fa-triangle-exclamation'></i> " + info.adminPassError.passError + "</label>");
                    }

                    if (info.doctorPassError) {
                        $("#pass_div_id").append("<label id='full-name-error' class='error' for='passId'><i class='fa-solid fa-triangle-exclamation'></i> " + info.doctorPassError.passError + "</label>");
                    }
                    // alert according to verify , status, active status
                    if (info.userVerifyError) {
                        $("#error_message").removeClass("d-none");
                        $("#error_message h6").append("<i class='fa-solid fa-triangle-exclamation'></i>  " + info.userVerifyError.verifyError).fadeIn("slow").slideDown();;
                    }

                    if (info.adminStatusError) {
                        $("#error_message").removeClass("d-none");
                        $("#error_message h6").append("<i class='fa-solid fa-triangle-exclamation'></i>  " + info.adminStatusError.statusError).fadeIn("slow").slideDown();;
                    }

                    if (info.doctorActiveError) {
                        $("#error_message").removeClass("d-none");
                        $("#error_message h6").append("<i class='fa-solid fa-triangle-exclamation'></i>  " + info.doctorActiveError.activeError).fadeIn("slow").slideDown();;
                    }

                    if (info.loginAccessError) {
                        $("#error_message").removeClass("d-none");
                        $("#error_message h6").html("<i class='fa-solid fa-triangle-exclamation'></i> " + info.loginAccessError.accessError).fadeIn("slow").slideDown();
                    }



                    // console.log(JSON.parse(data));
                    // console.log(info.userPassError[0]);
                    // console.log(info.userPassError.passError);
                }
            });
            return false;
        }
    });
</script>