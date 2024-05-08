<!-- footer section -->
<footer>
    <section class="footer bg-dark text-light">
        <div class="container py-4">
            <div class="row">
                <div class="col-md-3 footer-design">
                    <h5 class="mb-2">ABOUT US</h5>
                    <small class="text-secondary">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe, maxime, doloremque molestiae inventore voluptas blanditiis odit recusandae sapiente quaerat temporibus quo totam eum cupiditate accusamus fuga iure aperiam quia nulla.</small>
                </div>
                <div class="col-md-3 footer-design">
                    <h5 class="mb-2">QUICK LINK</h5>
                    <small class="">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link text-secondary" href="index.php"><i class="fa-solid fa-chevron-right"></i> Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-secondary" href="about_us.php"><i class="fa-solid fa-chevron-right"></i> About Us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-secondary" href="find_a_doctor.php"><i class="fa-solid fa-chevron-right"></i> Find a doctor</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-secondary" href="contact_us.php"><i class="fa-solid fa-chevron-right"></i> Contact Us</a>
                            </li>
                        </ul>
                    </small>
                </div>
                <div class="col-md-3 footer-design">
                    <h5 class="mb-2">CONTACT US</h5>
                    <small class="">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link text-secondary" href="#"><small>Mirpur-1,Dhaka,Bangladesh</small></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-secondary" href="#"><i class="fa-brands fa-whatsapp"></i> 01608566948</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-secondary" href="find_a_doctor.php"><i class="fa-solid fa-chevron-right"></i> Find a doctor</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-secondary" href="contact_us.php"><i class="fa-solid fa-chevron-right"></i> Contact Us</a>
                            </li>
                        </ul>
                    </small>
                </div>
                <div class="col-md-3 footer-design">
                    <h5 class="mb-2">REACH US</h5>
                    <small class="">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link text-secondary" href="home.php"><i class="fa-solid fa-phone-volume"></i> 01797327445</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-secondary" href="about_us.php"><i class="fa-solid fa-phone-volume"></i> 01608466218</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-secondary" href="find_a_doctor.php"><i class="fa-regular fa-envelope"></i> ayon2465@gmail.com</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-secondary" href="find_a_doctor.php"><i class="fa-regular fa-envelope"></i> sakibcse282@gmail.com</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-secondary" href="find_a_doctor.php"><i class="fa-solid fa-fax"></i> FAX: 65464565</a>
                            </li>
                        </ul>
                    </small>
                </div>
            </div>
            <a href="" class="text-primary">Read More</a>
            <div class="row my-3">
                <div class="col-md-3">
                    <h5 class="text-white">FOLLOW US</h5>
                    <div class="">
                        <a href="#" class="text-white text-decoration-none me-2"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" class="text-white text-decoration-none me-2"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#" class="text-white text-decoration-none me-2"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#" class="text-white text-decoration-none me-2"><i class="fa-brands fa-youtube"></i></a>
                        <a href="#" class="text-white text-decoration-none me-2"><i class="fa-brands fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
            <hr />
            <div class="d-md-flex align-items-md-center justify-content-md-between">

                    <p class="text-secondary">@Copyright ASA it. All rights reserved 2024.</p>

                    <p class="text-secondary">Design & Developed by - <span class="text-white">AL SAKIB AYON</span></p>
            </div>
        </div>
    </section>
</footer>
<!-- Javascript Link -->
<?php include "inc/js_link.php"; ?>

<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper(".mySwiper", {
        spaceBetween: 30,
        effect: "fade",
        fadeEffect: {
            crossFade: true
        },
        loop: true,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        autoplay: {
            delay: 3000,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });
</script>
</body>

</html>