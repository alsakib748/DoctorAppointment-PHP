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
<!-- header include -->
<?php include "inc/header.php"; ?>

<!--  -->
<section class="about">
    <div class="container py-3">
        <div class="row">
            <div class="col-md-6 mt-3">
                <h3 class="text-white mb-2">Contact us</h3>
                <small class="text-white">
                    <a href="index.php" class="text-decoration-none text-white">Home</a>
                    /
                    <a href="contact_us.php" class="text-decoration-none text-white">Contact Us</a>
                </small>
            </div>
            <div class="col-md-6 d-flex mt-3 align-items-center justify-content-end">
                <button type="button" class="btn btn-danger rounded">CALL US: 01608566748</button>
            </div>
        </div>
    </div>
</section>

<!-- Contact Information -->
<section class="contact_info my-4">
    <div class="container">
        <div class="row">
        <div class="col-md-6">
            <ul class="nav flex-column">
                <li class="nav-item border-bottom">
                    <h3 class="nav-link fs-3 ps-0 text-dark">Contact Information<br/><small class="fs-6">Get in touch with Doctor App</small></h3> 
                </li>
                <li class="nav-item border-bottom">
                    <h6 class="nav-link fs-6 ps-0 text-dark fw-semibold" href="#"><i class="fa-regular fa-envelope"></i> Email: ayon2465@gmail.com</h6>
                </li>
                <li class="nav-item border-bottom">
                    <h6 class="nav-link fs-6 ps-0 text-dark fw-semibold" href="#"><i class="fa-regular fa-envelope"></i> Email: sakibcse282@gmail.com</h6>
                </li>
                <li class="nav-item border-bottom">
                    <h6 class="nav-link fs-6 ps-0 text-dark fw-semibold" href="#"><i class="fa-solid fa-phone"></i> Phone: 01797327458</h6>
                </li>
                <li class="nav-item border-bottom">
                    <h6 class="nav-link fs-6 ps-0 text-dark fw-semibold" href="#"><i class="fa-solid fa-phone"></i> Phone 2: 01608544792</h6>
                </li>
                <li class="nav-item border-bottom">
                    <h6 class="nav-link fs-6 ps-0 text-dark fw-semibold" href="#"><i class="fa-brands fa-whatsapp"></i> Whatsapp: 01608544792</h6>
                </li>
                <li class="nav-item border-bottom">
                    <h6 class="nav-link fs-6 ps-0 text-dark fw-semibold" href="#"><i class="fa-solid fa-fax"></i> Fax: 01790931287</h6>
                </li>
                <li class="nav-item border-bottom">
                    <h6 class="nav-link fs-6 ps-0 text-dark fw-semibold" href="#"><i class="fa-solid fa-globe"></i> Website: www.asa.com</h6>
                </li>
            </ul>
        </div>
        <div class="col-md-6 d-flex justify-content-center">
            <img src="admin/images/auth/register-11.png" class="img-fluid w-75"   />
        </div>
        </div>
    </div>
</section>

<!-- footer include -->
<?php include "inc/footer.php"; ?>