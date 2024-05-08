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
    <!-- header section include -->
    <?php require_once("inc/header.php"); ?>

    <!-- Slider Section -->
    <section class="slider">
        <!-- Swiper -->
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="admin/images/carousel/demo/img-1.jpg" class="w-100 img-fluid slider-img" style="height:450px;" />
                </div>
                <div class="swiper-slide">
                    <img src="admin/images/carousel/demo/img-2.jpg" class="w-100 img-fluid slider-img" style="height:450px;" />
                </div>
                <div class="swiper-slide">
                    <img src="admin/images/carousel/demo/img-3.jpg" class="w-100 img-fluid slider-img" style="height:450px;" />
                </div>
                <div class="swiper-slide">
                    <img src="admin/images/carousel/demo/img-4.jpg" class="w-100 img-fluid slider-img" style="height:450px;" />
                </div>
                <div class="swiper-slide">
                    <img src="admin/images/carousel/demo/img-5.jpg" class="w-100 img-fluid slider-img" style="height:450px;" />
                </div>
                <div class="swiper-slide">
                    <img src="admin/images/carousel/demo/img-6.jpg" class="w-100 img-fluid slider-img" style="height:450px;" />
                </div>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <!-- Contact section -->
    <section class="contact-section" style="background: #146EBE;">
        <div class="container">
            <div class="row contact">
                <div class="col-md-4 my-md-4 d-flex align-items-center justify-content-md-evenly  contact-info">
                    <a href="cell: +8801797327521" class="text-decoration-none text-white ">
                        <i class="bi bi-telephone"></i> Call Us : 
                        +8801797327521
                    </a>
                </div>
                <div class="col-md-4 my-md-4  d-flex align-items-center justify-content-md-evenly contact-info">
                    <a href="cell: +8801608542987" class="text-decoration-none text-white">
                        <i class="fa-solid fa-plus"></i> Emergency Care : 
                        +8801608542987
                    </a>
                </div>
                <div class="col-md-4 my-md-4 d-flex align-items-center justify-content-md-evenly  contact-info">
                    <a href="mail: ayon2465@gmail.com" class="text-decoration-none text-white">
                        <i class="fa-solid fa-envelope"></i> Email Us : 
                        ayon2465@gmail.com
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- about section -->
    <section class="about_content">
        <div class="container">
            <div class="row">
                <div class="col-md-8 my-4">
                    <h3 class="text-muted mb-2">About us</h3>
                    <p class="text-justify mb-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt, alias? Expedita tempora iste magni impedit omnis vitae facere sit amet reiciendis asperiores aliquid a officia eos nobis explicabo nulla, voluptate consequuntur eveniet sequi quia velit excepturi ipsam accusamus. Sequi pariatur blanditiis delectus? <br /> Atque necessitatibus maiores iusto nulla magnam ad cumque delectus quo qui cupiditate officiis tenetur rem explicabo esse nam eum, voluptatum et aliquid! Earum dolorum odio perspiciatis culpa nisi saepe asperiores, sapiente sint! Suscipit voluptate corrupti excepturi sequi quidem.</p>
                    <a href="about_us.php" class="btn btn-primary shadow-none rounded-pill">Read More</a>
                </div>
                <div class="col-md-4 my-4 d-flex justify-content-end">
                    <img src="admin/images/about/demo/img-2.webp" class="img-fluid w-100" style="height: 350px;" />
                </div>
            </div>
        </div>

    </section>

    <!-- footer section include -->
    <?php require_once("inc/footer.php"); ?>