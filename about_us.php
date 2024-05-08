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
    <?php require_once("inc/header.php"); ?>

<section class="about">
    <div class="container py-3">
        <div class="row">
            <div class="col-md-6 mt-3">
                <h3 class="text-white mb-2">About us</h3>
                <small class="text-white">
                    <a href="index.php" class="text-decoration-none text-white">Home</a>
                        /
                    <a href="about_us.php" class="text-decoration-none text-white">About Us</a>
                </small>
            </div>
            <div class="col-md-6 d-flex mt-3 align-items-center justify-content-end">
                <button type="button" class="btn btn-danger rounded">CALL US: 01608566748</button>
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
                    <p class="text-justify mb-3">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Doloribus ipsum dolor impedit, ab eius necessitatibus suscipit corporis quo aspernatur quasi veritatis velit dolorem facilis a, quos exercitationem? Assumenda officiis repellat quas maxime magnam nesciunt quod, repudiandae et rerum. Quo eaque, laudantium consequatur voluptates animi eos quasi nostrum veniam tempora itaque quae vitae repudiandae perspiciatis earum. Autem quibusdam natus quia velit aperiam itaque facere sed iure numquam excepturi optio culpa, qui corporis ipsum, modi est aut alias minus mollitia dolorem soluta? Laborum quis fugit pariatur reiciendis doloribus? Reprehenderit voluptatum modi numquam temporibus facilis ipsum voluptatibus, quaerat obcaecati molestiae error et accusantium, eius nesciunt nulla eligendi.<br/> Temporibus ducimus a quasi dolor, recusandae esse illum eius hic! Impedit ad vel suscipit quod eveniet, quos nostrum reiciendis quibusdam unde doloremque amet praesentium dolores accusantium ipsam earum error iure libero placeat sit officiis perferendis reprehenderit tempore! Officiis, iure illum. Itaque asperiores vero facilis incidunt eaque. Voluptates officiis inventore reiciendis dicta eum modi tempora deleniti? Amet et corporis dolorum cumque! Fuga assumenda nam quam commodi, minus vitae deserunt labore hic dolore quia rem vero, aliquam aperiam distinctio tempore dolorem! Deleniti tempore dolore, quas fugit, eaque, ad sequi est officiis repellat ullam dolor aliquam explicabo delectus maxime.</p>
                </div>
                <div class="col-md-4 my-4 d-flex justify-content-end">
                    <img src="admin/images/about/demo/img-2.webp" class="img-fluid w-100" style="height: 420px;" />
                </div>
            </div>
        </div>

</section>

<!-- footer include -->
    <?php require_once("inc/footer.php"); ?>