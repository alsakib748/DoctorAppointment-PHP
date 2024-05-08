<?php
// session_start();
// if (isset($_SESSION["adminLogin"]) && $_SESSION["adminLogin"] == true) {
//     header("Location: admin/dashboard.php");
//     exit;
// } else if (isset($_SESSION["doctorLogin"]) && $_SESSION["doctorLogin"] == true) {
//     header("Location: doctor/dashboard.php");
//     exit;
// }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Appointment</title>
    <!-- CSS Link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.css" integrity="sha512-pmAAV1X4Nh5jA9m+jcvwJXFQvCBi3T17aZ1KWkqXr7g/O2YMvO8rfaa5ETWDuBvRq6fbDjlw4jHL44jNTScaKg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css" />
    <style>
        @media(max-width: 480px) {

            /* TopBar CSS */
            .topBar-left {
                display: flex;
                flex-direction: column;
                align-items: start;
                justify-content: end;
            }

            .topBar-right {
                display: flex;
                flex-direction: column;
                align-items: end;
                justify-content: start;
            }

            .topBar-line {
                display: none;
            }

            /* TopBar CSS END */

            /* Slider CSS */
            .swiper-slide .slider-img {
                height: 220px !important;
            }

            /* Slider CSS END */

            .contact .contact-info {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                margin: 10px 0px;
            }

            /* Department CSS START */

            .dept-search {
                width: 230px !important;
            }

            /* Department CSS END */

            /* Find Doctor CSS Start */
            .doctor-search {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
            }

            .doctor-search .search-bar {
                width: 400px !important;
                margin: 0 auto;
                margin: 5px 0;
                border-radius: 5px !important;
            }

            .doctor-search .filter-btn {
                width: 100%;
                margin: 0 auto;
                margin: 5px 0;
                border-radius: 5px !important;
            }

            .doctor-search .reset-btn {
                width: 100%;
                margin: 0 auto;
                margin: 5px 0;
                border-radius: 5px !important;
            }

            /* Find Doctor CSS End */

            /* Booking Doctor CSS Start */
            .booking-schedule {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
            }

            /* Booking Doctor CSS End */
            /* Profile CSS Start */
            .profile-card {
                margin-top: 5px;
                margin-bottom: 15px;
            }

            /* .profile-card .payment-cancel-btn{
        width: 100% !important;
    } */
            .payment-btn {
                display: grid;
                grid-template-columns: repeat(1, 1fr);
                grid-gap: 1rem;
            }

            .appointments-data-card .table-wrapper {
                /* max-height: 300px; */
                /* Define a max-height for the vertical scrollbar */
                overflow-x: auto;
                /* Enable horizontal scrollbar */
                overflow-y: auto;
                /* Enable vertical scrollbar */
                white-space: nowrap;
                /* Prevent table cells from wrapping */
            }

            .table-wrapper table {
                min-width: 100%;
                /* Ensure the table fills the wrapper horizontally */
            }

            /* Profile CSS End */
            /* Book An Appointment CSS Start :  */
            .fees-status {
                width: 100%;
                margin: 5px 0;
            }

            .another-doctor {
                width: 100%;
                margin: 5px 0;
            }

            /* Book An Appointment CSS End */
            /* Login Btn CSS Start */
            .login-card {
                margin-bottom: 20px !important;
            }

            .login-card .card {
                width: 100% !important;
            }

            .login-img img {
                width: 100% !important;
                border-radius: 10px;
            }

            .login-btn {
                margin: 10px 0px;
            }

            /* Login Btn CSS End */
            /* Register CSS START */
            .register-card {
                width: 100% !important;
                margin-bottom: 20px !important;
            }

            .register-card .card {
                width: 100% !important;
            }

            .register-img img {
                width: 100% !important;
                height: 520px;
                border-radius: 10px;
            }

            /* Register CSS END */

            /* Footer CSS Start */
            footer .footer-design {
                margin: 10px 0;
            }

            /* Footer CSS End */
        }

        @media(max-width: 768px) {

            /* TopBar CSS */
            .topBar-left {
                display: grid !important;
                grid-template-columns: 1fr !important;
            }

            .topBar-right {
                display: grid !important;
                grid-template-columns: 1fr !important;
                row-gap: 5px !important;
                justify-items: end;
                /* align-items: end; */
                align-content: start;
            }

            .topBar-line {
                display: none;
            }

            /* TopBar CSS END */

            /* Slider CSS */
            .swiper-slide .slider-img {
                height: 320px !important;
            }

            /* Slider CSS END */

            /* .contact .contact-info {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                margin: 10px 0px;
            } */

            /*  Department CSS START */

            .departments .dept-card{
                display: grid;
                /* grid-template-columns: repeat(3,3fr); */
            }

            /* Department CSS END */

            /* Find Doctor CSS Start */
            .doctor_search_form{
                width: 80%;
                margin: 0 auto;
            }
            
            .doctor-img{
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .doctor-img img{
                width: 150px !important;
                height: 150px !important;
                border-radius: 50% !important;
                object-fit: cover;
            }

            .book-btn{
                width: 100%;
                margin: 5px 0;
            }

            .read-more-btn{
                width: 100%;
                margin: 5px 0;
            }


            /* .doctor-search .search-bar {
                width: 400px !important;
                margin: 0 auto;
                margin: 5px 0;
                border-radius: 5px !important;
            } */

            /* .doctor-search .filter-btn {
                width: 100%;
                margin: 0 auto;
                margin: 5px 0;
                border-radius: 5px !important;
            }

            .doctor-search .reset-btn {
                width: 100%;
                margin: 0 auto;
                margin: 5px 0;
                border-radius: 5px !important;
            } */

            /* Find Doctor CSS End */

            /* Booking Doctor CSS Start */
            /* .booking-schedule {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
            } */

            /* Booking Doctor CSS End */
            /* Profile CSS Start */
            /* .profile-card {
                margin-top: 5px;
                margin-bottom: 15px;
            } */

            /* .profile-card .payment-cancel-btn{
width: 100% !important;
} */
            /* .payment-btn {
                display: grid;
                grid-template-columns: repeat(1, 1fr);
                grid-gap: 1rem;
            } */

            /* .appointments-data-card .table-wrapper {
                overflow-x: auto;
                overflow-y: auto;
                white-space: nowrap;
            } */

            /* .table-wrapper table {
                min-width: 100%;
            } */

            /* Profile CSS End */
            /* Book An Appointment CSS Start :  */
            /* .fees-status {
                width: 100%;
                margin: 5px 0;
            }

            .another-doctor {
                width: 100%;
                margin: 5px 0;
            } */

            /* Book An Appointment CSS End */
            /* Login Btn CSS Start */
            /* .login-card {
                margin-bottom: 20px !important;
            }

            .login-card .card {
                width: 100% !important;
            }

            .login-img img {
                width: 100% !important;
                border-radius: 10px;
            }

            .login-btn {
                margin: 10px 0px;
            } */

            /* Login Btn CSS End */
            /* Register CSS START */
            /* .register-card {
                width: 100% !important;
                margin-bottom: 20px !important;
            }

            .register-card .card {
                width: 100% !important;
            }

            .register-img img {
                width: 100% !important;
                height: 520px;
                border-radius: 10px;
            } */

            /* Register CSS END */

            /* Footer CSS Start */
            /* footer .footer-design {
                margin: 10px 0;
            } */
            /* Footer CSS End */
        }

    </style>

</head>

<body class="bg-light">

    <header class="sticky-top">
        <!-- top bar -->
        <section class="" style="background: #146EBE;">
            <div class="container">
                <div class="row top-bar" style="padding-bottom: 3px;">
                    <div class="col d-md-flex align-items-md-center justify-content-md-evenly topBar-left">
                        <div class="text-white">
                            <a href="call: +8801797327475" class="text-decoration-none text-white small"><i class="bi bi-telephone"></i>
                                Call Us: +8801797327475
                            </a>
                        </div>
                        <div class="text-white topBar-line">
                            |
                        </div>
                        <div class="text-white">
                            <a href="call: +8801608566978" class="text-decoration-none text-white small"><i class="bi bi-telephone"></i>
                                +8801608566978
                            </a>
                        </div>
                        <div class="text-white topBar-line">
                            |
                        </div>
                        <div class="text-white">
                            <a href="mail: ayon2465@gmail.com" class="text-decoration-none text-white small"><i class="bi bi-envelope"></i>
                                Email Us: ayon2465@gmail.com
                            </a>
                        </div>
                    </div>
                    <div class="col text-right d-md-flex align-items-md-center justify-content-md-end topBar-right">
                        <div class="text-white small">
                            <a href="contact_us.php" class="text-decoration-none text-white">Contact Us</a>
                        </div>
                        <div class="text-white mx-3 topBar-line">
                            |
                        </div>
                        <?php if ((isset($_SESSION["userLogin"]) && $_SESSION["userLogin"] == true) || (isset($_SESSION["adminLogin"]) && $_SESSION["adminLogin"] == true)) { ?>
                        <div class="text-white small ms-md-3">
                            <a href="profile.php?status=appointments" class="text-decoration-none text-white">
                                <i class="bi bi-calendar-plus"></i> My Appointments
                            </a>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>

        <!-- navbar section -->
        <section class="navigation">
            <nav class="navbar navbar-expand-lg bg-white shadow">
                <div class="container d-flex">
                    <a class="navbar-brand" href="#">Navbar</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 ">
                            <li class="nav-item">
                                <a class="nav-link fw-medium" href="index.php">HOME</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-medium" href="about_us.php">ABOUT US</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-medium" href="departments.php">DEPARTMENTS</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-medium" href="find_a_doctor.php">FIND A DOCTOR</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-medium" href="booking_appointment.php">BOOK APPOINTMENT</a>
                            </li>
                            <?php if ((isset($_SESSION["userLogin"]) && $_SESSION["userLogin"] == true) || (isset($_SESSION["adminLogin"]) && $_SESSION["adminLogin"] == true)) {
                                if (isset($_SESSION["userLogin"]) && $_SESSION["userLogin"] == true) {
                            ?>
                                    <div class="btn-group ms-5">
                                        <button type="button" class="btn btn-outline-light dropdown-toggle text-secondary" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                            <?php echo strtoupper($_SESSION["userName"]); ?>
                                        </button>
                                        <ul class="dropdown-menu shadow border-0 dropdown-menu-end dropdown-menu-lg-right">
                                            <li><a class="dropdown-item text-muted" href="profile.php?status=profile"><i class="fa-regular fa-user me-2"></i> My Profile</a></li>
                                            <li><a class="dropdown-item text-muted" href="profile.php?status=appointments"><i class="fa-solid fa-calendar-check me-2"></i> Appointments</a></li>
                                            <li><a class="dropdown-item text-muted" href="logout.php"><i class="fa-solid fa-power-off me-2"></i> <span class="">Logout</span></a></li>
                                        </ul>
                                    </div>
                                <?php
                                } else if (isset($_SESSION["adminLogin"]) && $_SESSION["adminLogin"] == true) {
                                ?>
                                    <div class="btn-group ms-5">
                                        <button type="button" class="btn btn-outline-light dropdown-toggle text-secondary" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                            <?php echo strtoupper($_SESSION["adminName"]); ?>
                                        </button>
                                        <ul class="dropdown-menu shadow border-0 dropdown-menu-end dropdown-menu-lg-right">
                                            <li><a class="dropdown-item text-muted" href="profile.php?status=profile"><i class="fa-regular fa-user me-2"></i> My Profile</a></li>
                                            <li><a class="dropdown-item text-muted" href="profile.php?status=appointments"><i class="fa-solid fa-calendar-check me-2"></i> Appointments</a></li>
                                            <li><a class="dropdown-item text-muted" href="admin/logout.php"><i class="fa-solid fa-power-off me-2"></i> <span class="">Logout</span></a></li>
                                        </ul>
                                    </div>
                                <?php
                                }
                                ?>

                            <?php  } else { ?>
                                <li class="nav-item ms-md-5 me-md-2 login-btn">
                                    <button type="button" class="btn btn-primary btn-sm p-0 m-0 rounded shadow-none w-100"><a class="nav-link fw-medium text-white" href="login.php">LOGIN</a></button>
                                </li>
                                <li class="nav-item register-btn">
                                    <button type="button" class="btn btn-primary btn-sm p-0 m-0 rounded shadow-none w-100"><a class="nav-link fw-medium text-white" href="register.php">REGISTER</a></button>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </section>
    </header>