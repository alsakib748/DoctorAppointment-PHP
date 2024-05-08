<?php
session_start();
if (isset($_SESSION["adminLogin"]) && $_SESSION["adminLogin"] == true) {
    header("Location: admin/dashboard.php");
    exit;
} else if (isset($_SESSION["doctorLogin"]) && $_SESSION["doctorLogin"] == true) {
    header("Location: doctor/dashboard.php");
    exit;
}

?>
<!-- header -->
<?php require_once("inc/header.php"); ?>

<!--  -->
<section class="about">
    <div class="container py-3">
        <div class="row">
            <div class="col-md-6 mt-3">
                <h3 class="text-white mb-2">Find A Doctor</h3>
                <small class="text-white">
                    <a href="index.php" class="text-decoration-none text-white">Home</a>
                    /
                    <a href="find_a_doctor.php" class="text-decoration-none text-white">Find A Doctor</a>
                </small>
            </div>
            <div class="col-md-6 d-flex mt-3 align-items-center justify-content-end">
                <button type="button" class="btn btn-danger rounded">CALL US: 01608566748</button>
            </div>
        </div>
    </div>
</section>

<!-- Search or filter by department/specialist -->
<section class="my-5">
    <div class="container">
        <div class="d-flex justify-content-center">
            <form action="" method="POST">
                <label for="" class="form-label mb-0">Search Doctor's</label>
                <div class="mt-1 mb-3 d-flex align-items-center justify-content-center">
                    <div class="">
                        <input type="text" class="form-control shadow-none bg-light rounded-end-0 p-1" name="search" id="searchId" style="width: 600px;" placeholder="Search Doctor" />
                    </div>
                    <div class="">
                        <button type="submit" name="filter" class="btn btn-primary shadow-none rounded-0 p-1 px-3">Search</button>
                    </div>
                    <div class="">
                        <button type="submit" name="filter" class="btn btn-danger shadow-none rounded-start-0 rounded-end p-1 px-3">Reset</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</section>

<!-- Showed all doctor's -->
<section class="my-3">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-3 bg-white shadow" style="max-width: 540px;border-top: 4px solid rgb(12, 104, 238);">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="admin/images/doctors/nurology/demo/img-1.jpg" class="img-fluid w-100 h-100 rounded-circle p-2">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <div class="">
                                    <h5 class="card-title mb-0">Al Sakib Ayon</h5>
                                    <small class="card-text">Neurology physician and surgen</small>
                                </div>
                                <hr/>
                                <div class="mb-2">
                                    <h5 class="card-title mb-0">Qualifications:</h5>
                                    <small class="card-text">MBBS, MBSC</small>
                                </div>
                                <div class="">
                                    <button type="submit" class="btn btn-sm btn-primary rounded-pill px-3"><a href="doctor_details.php" class="text-decoration-none text-white">Read More</a></button>
                                    <button type="submit" class="btn btn-sm btn-primary rounded-pill px-3"><a href="book_an_appointment.php" class="text-decoration-none text-white">Book Appointment</a></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card mb-3 bg-white shadow" style="max-width: 540px;border-top: 4px solid rgb(12, 104, 238);">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="admin/images/doctors/nurology/demo/img-2.jpg" class="img-fluid w-100 h-100 rounded-circle p-2">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <div class="">
                                    <h5 class="card-title mb-0">H Rahman Jim</h5>
                                    <small class="card-text">Neurology and Brain</small>
                                </div>
                                <hr/>
                                <div class="mb-2">
                                    <h5 class="card-title mb-0">Qualifications:</h5>
                                    <small class="card-text">MBBS, FCPS</small>
                                </div>
                                <div class="">
                                    <button type="submit" class="btn btn-sm btn-primary rounded-pill px-3">Read More</button>
                                    <button type="submit" class="btn btn-sm btn-primary rounded-pill px-3">Book Appointment</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mb-3 bg-white shadow" style="max-width: 540px;border-top: 4px solid rgb(12, 104, 238);">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="admin/images/doctors/nurology/demo/img-3.jpg" class="img-fluid w-100 h-100 rounded-circle p-2">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <div class="">
                                    <h5 class="card-title mb-0">Sayed Najmul Hasan</h5>
                                    <small class="card-text">Neurology</small>
                                </div>
                                <hr/>
                                <div class="mb-2">
                                    <h5 class="card-title mb-0">Qualifications:</h5>
                                    <small class="card-text">MBBS, MD</small>
                                </div>
                                <div class="">
                                    <button type="submit" class="btn btn-sm btn-primary rounded-pill px-3">Read More</button>
                                    <button type="submit" class="btn btn-sm btn-primary rounded-pill px-3">Book Appointment</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mb-3 bg-white shadow" style="max-width: 540px;border-top: 4px solid rgb(12, 104, 238);">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="admin/images/doctors/nurology/demo/img-4.jpg" class="img-fluid w-100 h-100 rounded-circle p-2">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <div class="">
                                    <h5 class="card-title mb-0">Milon Kumbar Bhattacharjo</h5>
                                    <small class="card-text">Neurology</small>
                                </div>
                                <hr/>
                                <div class="mb-2">
                                    <h5 class="card-title mb-0">Qualifications:</h5>
                                    <small class="card-text">MBBS, FCPS</small>
                                </div>
                                <div class="">
                                    <button type="submit" class="btn btn-sm btn-primary rounded-pill px-3">Read More</button>
                                    <button type="submit" class="btn btn-sm btn-primary rounded-pill px-3">Book Appointment</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- footer -->
<?php require_once("inc/footer.php") ?>