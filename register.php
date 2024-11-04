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

<section class="about">
    <div class="container py-3">
        <div class="row">
            <div class="col-md-6 mt-3">
                <h3 class="text-white mb-2">Register</h3>
                <small class="text-white">
                    <a href="index.php" class="text-decoration-none text-white">Home</a>
                    /
                    <a href="register.php" class="text-decoration-none text-white">Register</a>
                </small>
            </div>
            <div class="col-md-6 d-flex mt-3 align-items-center justify-content-end">

            </div>
        </div>
    </div>
</section>

<section class="my-3">
    <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-5 col-sm-12 d-md-flex align-items-md-center justify-content-md-end register-card">
                <div class="card border-0 shadow w-100 ">
                    <div class="card-header" style="background-color: #146EBE">
                        <h4 class="text-center text-white">Register</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" name="signup_form" id="signup_form">
                            <div class="mb-2">
                                <label for="full-name" class="form-label">Full Name</label>
                                <input type="text" name="name" class="form-control" id="full-name" required>
                            </div>
                            <div class="mb-2" id="email_div_id">
                                <label for="email-address" class="form-label">Email address</label>
                                <input type="email" name="email" class="form-control" id="email-address" required>
                            </div>
                            <div class="mb-2" id="phone_div_id">
                                <label for="phone-number" class="form-label">Phone Number</label>
                                <input type="number" name="contact" class="form-control" id="phone-number" required>
                            </div>
                            <div class="mb-2">
                                <label for="pass" class="form-label">Password</label>
                                <input type="password" name="pass" class="form-control" id="pass" required>
                            </div>
                            <div class="mb-2">
                                <label for="confirm_pass" class="form-label">Confirm Password</label>
                                <input type="password" name="confirm_pass" class="form-control" id="confirm_pass" required>
                            </div>
                            <button type="submit" class="btn w-100 btn-primary mt-1">Register</button>
                            <div class="mt-2">
                                <h6 class="text-center">Already have an account ? <a href="login.php">Login</a> Now.</h6>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-5 col-sm-12 register-img">
                <img src="admin/images/auth/register-1.jpg" class="img-fluid w-100 h-100" />
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
</section>

<!-- footer include -->
<?php require_once("inc/footer.php"); ?>

<script>
    jQuery.validator.addMethod("customName", function(value, element) {
        return this.optional(element) || value == value.match(/^[a-zA-Z ]+$/);
    }, "<i class='fa-solid fa-triangle-exclamation'></i> Only Characters and White Space are Allowed.");

    jQuery.validator.addMethod("customEmail", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i.test(value);
    }, "<i class='fa-solid fa-triangle-exclamation'></i> Please enter valid email address!");

    jQuery.validator.addMethod("customPassword", function(value, element) {
        return this.optional(element) || /^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%&]).*$/i.test(value);
    }, "<i class='fa-solid fa-triangle-exclamation'></i> At least 1 number<br/><i class='fa-solid fa-triangle-exclamation'></i> At least 1 lowercase character(a-z)<br/><i class='fa-solid fa-triangle-exclamation'></i> At least 1 uppercase character (A-Z)<br/><i class='fa-solid fa-triangle-exclamation'></i> At least one special character !");

    $("#signup_form").validate({
        rules: {
            name: {
                minlength: 3,
                required: true,
                customName: true
            },
            email: {
                required: true,
                email: true,
                customEmail: true
            },
            contact: {
                required: true,
                number: true,
                minlength: 11,
                maxlength: 11
            },
            pass: {
                required: true,
                minlength: 8,
                customPassword: true
            },
            confirm_pass: {
                required: true,
                minlength: 8,
                customPassword: true,
                equalTo: "#pass"
            }
        },
        messages: {
            name: {
                required: "<i class='fa-solid fa-triangle-exclamation'></i> Please enter your name",
                minlength: "<i class='fa-solid fa-triangle-exclamation'></i> Name at least 3 characters"
            },
            email: {
                required: "<i class='fa-solid fa-triangle-exclamation'></i> Please enter your email address"
            },
            contact: {
                required: "<i class='fa-solid fa-triangle-exclamation'></i> please enter your phone number",
                number: "<i class='fa-solid fa-triangle-exclamation'></i> Please enter a valid phone number",
                minlength: "<i class='fa-solid fa-triangle-exclamation'></i> Please enter a 11 digit phone number",
                maxlength: "<i class='fa-solid fa-triangle-exclamation'></i> Please enter a 11 digit phone number"
            },
            pass: {
                required: "<i class='fa-solid fa-triangle-exclamation'></i> Please provide a password",
                minlength: "<i class='fa-solid fa-triangle-exclamation'></i> Your password must be at least 8 characters",
            },
            confirm_pass: {
                required: "<i class='fa-solid fa-triangle-exclamation'></i> Please provide a confirm password",
                minlength: "<i class='fa-solid fa-triangle-exclamation'></i> Your password must be at least 8 characters",
                equalTo: "<i class='fa-solid fa-triangle-exclamation'></i> Please enter the same password as above"
            }
        },
        submitHandler: function(form) {
            $.ajax({
                url: "ajax/register_crud.php",
                method: "POST",
                data: $("#signup_form").serialize(),
                success: function(data){
                    let info = JSON.parse(data);
                    if(info.success){
                        alert("Signup Successfully");
                        alert("Confirm to verify your email");
                        $("#signup_form").trigger("reset");
                        window.location.href = "http://localhost/doctorappointment/login.php";
                    }

                    if(info.emailError){
                        $("#email_div_id").append("<label id='full-name-error' class='error' for='email-address'><i class='fa-solid fa-triangle-exclamation'></i> "+info.emailError.email_exist+"</label>");
                    }

                    if(info.contactError){
                        $("#phone_div_id").append("<label id='full-name-error' class='error' for='phone-number'><i class='fa-solid fa-triangle-exclamation'></i> "+info.contactError.contact_exist+"</label>");
                    }

                    console.log(info);
                }
            });
            return false;
        }
    });
</script>