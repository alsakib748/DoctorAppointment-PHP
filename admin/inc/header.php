<?php
session_start();
if (!(isset($_SESSION["adminLogin"]) && $_SESSION["adminLogin"] == true)) {
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
                            <li class="nav-item pb-1 dash-item">
                                <a class="nav-link fw-semibold text-secondary" href="appointments.php"><i class="fa-solid fa-list-check me-1"></i> Appointments</a>
                            </li>
                            <li class="nav-item pb-1 dash-item">
                                <a class="nav-link fw-semibold text-secondary" href="create_appointments.php"><i class="fa-solid fa-list-check me-1"></i> Create Appointments</a>
                            </li>
                            <li class="nav-item pb-1 dash-item" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" id="departmentId">
                                <div class="d-flex align-items-center justify-content-between">
                                    <a class="nav-link fw-semibold text-secondary" href="dashboard.php"><i class="fa-solid fa-person fs-5 me-2"></i> Department</a>
                                    <i id="arrow" class="fa-solid fa-chevron-right text-secondary pe-2"></i>
                                </div>

                            </li>
                            <div class="collapse" id="collapseExample">
                                <div class="card card-body border-0 pt-0">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link text-secondary fw-semibold" href="add_department.php"><i class="bi bi-dot fs-4 me-1"></i> Add Department</a>
                                        </li>
                                        <li class="nav-item m-0">
                                            <a class="nav-link text-secondary fw-semibold" href="view_departments.php"><i class="bi bi-dot fs-4 me-1"></i> View Departments</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <li class="nav-item pb-1 dash-item" data-bs-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample2" id="doctorId">
                                <div class="d-flex align-items-center justify-content-between">
                                    <a class="nav-link fw-semibold text-secondary" href="dashboard.php"><i class="fa-solid fa-plus fs-5 me-2"></i> Doctors</a>
                                    <i id="arrow" class="fa-solid fa-chevron-right text-secondary pe-2"></i>
                                </div>
                            </li>
                            <div class="collapse" id="collapseExample2">
                                <div class="card card-body border-0 pt-0">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link text-secondary fw-semibold" href="add_doctor.php"><i class="bi bi-dot fs-4 me-1"></i> Add Doctor</a>
                                        </li>
                                        <li class="nav-item m-0">
                                            <a class="nav-link text-secondary fw-semibold" href="view_doctors.php"><i class="bi bi-dot fs-4 me-1"></i> View Doctors</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <li class="nav-item pb-1 dash-item">
                                <a class="nav-link fw-semibold text-secondary" href="view_patients.php"><i class="fa-solid fa-hospital-user me-1"></i> Patients</a>
                            </li>
                            <li class="nav-item pb-1 dash-item">
                                <a class="nav-link fw-semibold text-secondary" href="manage_admin.php"><i class="fa-solid fa-bars-progress me-1"></i> Manage Admin</a>
                            </li>
                            <li class="nav-item pb-1 dash-item">
                                <a class="nav-link fw-semibold text-secondary" href="website_settings.php"><i class="fa-solid fa-gear me-1"></i> Website Setting</a>
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
                            <a class="navbar-brand text-info fw-bolder" href="#">Admin Dashboard</a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="btn-group">
                                <button type="button" class="btn btn-outline-light dropdown-toggle text-secondary" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                    <?php
                                        $imageSrc ="";
                                        if(isset($_SESSION["adminProfile"]) && !empty($_SESSION["adminProfile"])) {
                                            $imageSrc .= "images/admin/" . $_SESSION["adminProfile"];
                                        }    
                                    ?>
                    <img style="width:40px;height:40px;border-radius:50%;" src="<?php echo $imageSrc; ?>" /> <?php echo strtoupper($_SESSION["adminName"]); ?>
                                </button>
                                <ul class="dropdown-menu shadow border-0 dropdown-menu-end dropdown-menu-lg-right">
                                    <li><a class="dropdown-item mb-0 text-muted" href="#"><?php echo strtoupper($_SESSION["adminName"]); ?></a></li>
                                    <p class="mt-0 ms-3 text-muted" style="font-size:0.7rem;"><?php echo strtoupper($_SESSION["adminName"]); ?></p>
                                    <hr />
                                    <li><a class="dropdown-item text-muted" href="#"><i class="fa-regular fa-user me-2"></i> My Profile</a></li>
                                    <li><a class="dropdown-item text-muted" href="#"><i class="fa-solid fa-gear me-2"></i> Settings</a></li>
                                    <hr />
                                    <li><a class="dropdown-item text-muted" href="logout.php"><i class="fa-solid fa-power-off me-2"></i> <span class="">Logout</span></a></li>
                                </ul>
                            </div>

                        </div>
                    </nav>
                </div>
            </div>