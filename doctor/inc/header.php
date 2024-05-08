<?php
session_start();
if (!(isset($_SESSION["doctorLogin"]) && $_SESSION["doctorLogin"] == true)) {
    header("Location: ../login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <?php include "../inc/css_link.php"; ?>
    <link rel="stylesheet" href="../css/style.css" type="text/css" />
</head>

<body class="bg-light">
    <div class="row">
        <div class="col-md-3 col-sm-12">
            <div class="card bg-white shadow sticky-top-lg" style="min-height: 662px;">
                <div class="card-body">
                    <div class="m-3">
                        <img src="" />
                    </div>
                    <p class="m-3 fs-6 fw-semibold text-muted">MANAGE</p>
                    <div class="">
                        <ul class="nav nav-pills nav-sidebar flex-column">
                            <li class="nav-item py-1 dash-item">
                                <a class="nav-link fw-semibold text-secondary" href="dashboard.php"><i class="bi bi-house-heart-fill me-1"></i> Dashboard</a>
                            </li>
                            <li class="nav-item pb-1 dash-item" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" id="departmentId">
                                <div class="d-flex align-items-center justify-content-between">
                                    <a class="nav-link fw-semibold text-secondary" href="appointments.php">
                                        <i class="fa-regular fa-calendar-plus fs-5 me-2"></i> Appointments</a>
                                    <i id="arrow" class="fa-solid fa-chevron-right text-secondary pe-2"></i>
                                </div>

                            </li>
                            <div class="collapse" id="collapseExample">
                                <div class="card card-body border-0 pt-0">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link text-secondary fw-semibold" href="all_appointments.php"><i class="bi bi-dot fs-4 me-1"></i>Today All Appointments</a>
                                        </li>
                                        <li class="nav-item m-0">
                                            <a class="nav-link text-secondary fw-semibold" href="appointments_history.php"><i class="bi bi-dot fs-4 me-1"></i> Appointments History</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <li class="nav-item pb-1 dash-item">
                                <a class="nav-link fw-semibold text-secondary" href="patients_list.php"><i class="fa-solid fa-user-plus me-1"></i> Patients</a>
                            </li>
                            <li class="nav-item pb-1 dash-item">
                                <a class="nav-link fw-semibold text-secondary" href="profile.php"><i class="fa-regular fa-user me-2"></i> Profile</a>
                            </li>



                            <li class="nav-item pb-1 dash-item">
                                <a class="nav-link fw-semibold text-secondary" href="timings.php"><i class="fa-regular fa-calendar-days me-2"></i>Timings</a>
                            </li>
                            <li class="nav-item pb-1 dash-item">
                                <a class="nav-link fw-semibold text-secondary" href="change_password.php"><i class="fa-solid fa-gear me-1"></i> Change Password</a>
                            </li>
                            <li class="nav-item  bg-danger rounded">
                                <a class="nav-link fw-semibold text-white" href="logout.php"><i class="fa-solid fa-right-from-bracket me-1"></i> Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9 col-sm-12">
            <div class="container my-3">
                <div class="">
                    <nav class="navbar navbar-expand-lg bg-white shadow rounded">
                        <div class="container-fluid">
                            <a class="navbar-brand text-info fw-bolder" href="#">Doctor Dashboard</a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="btn-group">
                                <button type="button" class="btn btn-outline-light dropdown-toggle text-secondary" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                    <?php
                                    $imageSrc = "";
                                    if (isset($_SESSION["doctorProfile"]) && !empty($_SESSION["doctorProfile"])) {
                                        $imageSrc .= "../admin/images/doctors/" . $_SESSION["doctorProfile"];
                                    }
                                    ?>
                                    <img style="width:40px;height:40px;border-radius:50%;" src="<?php echo $imageSrc; ?>" /> <?php echo strtoupper($_SESSION["doctorName"]); ?>
                                </button>
                                <ul class="dropdown-menu shadow border-0 dropdown-menu-end dropdown-menu-lg-right">
                                    <li><a class="dropdown-item mb-0 text-muted" href="#"><?php echo strtoupper($_SESSION["doctorName"]); ?></a></li>
                                    <hr />
                                    <li><a class="dropdown-item text-muted" href="profile.php"><i class="fa-regular fa-user me-2"></i> My Profile</a></li>
                                    <hr />
                                    <li><a class="dropdown-item text-muted" href="logout.php"><i class="fa-solid fa-power-off me-2"></i> <span class="">Log Out</span></a></li>
                                </ul>
                            </div>

                        </div>
                    </nav>
                </div>
            </div>