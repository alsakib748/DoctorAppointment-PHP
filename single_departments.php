<?php
session_start();
if (isset($_SESSION["doctorLogin"]) && $_SESSION["doctorLogin"] == true) {
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
                <h3 class="text-white mb-2">Departments</h3>
                <small class="text-white">
                    <a href="index.php" class="text-decoration-none text-white">Home</a>
                    /
                    <a href="departments.php" class="text-decoration-none text-white">Departments</a>
                    /
                    <a href="single_departments.php" class="text-decoration-none text-white">Neurology</a>
                </small>
            </div>
            <div class="col-md-6 d-flex mt-3 align-items-center justify-content-end">
                <button type="button" class="btn btn-danger rounded">CALL US: 01608566748</button>
            </div>
        </div>
    </div>
</section>

<!-- this departments description -->
<section class=" my-5">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h5>Neurology</h5>
                <p class="text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut deleniti mollitia nobis aspernatur vel nisi rerum nesciunt totam doloribus obcaecati veniam quis illo expedita optio quisquam sit eaque, amet excepturi adipisci nemo. Fuga, nobis saepe. Quaerat, incidunt excepturi totam at rerum harum repellat eum cupiditate adipisci blanditiis assumenda!<br /> Laudantium, molestiae tempore totam reprehenderit dolorum necessitatibus odit modi id quos perferendis, sapiente quam nesciunt excepturi dolore cupiditate similique ratione temporibus optio? Debitis, quasi? Hic odit, nostrum accusamus voluptate porro, iste blanditiis quae et debitis soluta nam, deserunt amet quo dolore reiciendis. Minima facere officiis neque ut omnis. Ullam odio unde rerum.</p>
            </div>
            <div class="col-md-4">
                <img src="admin/images/departments/demo/nurology.png" class="w-100 img-fluid" />
            </div>
        </div>
    </div>
</section>

<!-- All doctor details to individuals departments -->
<section class=" my-4">
    <div class="container">
        <h4>Our Doctor's</h4>
        <div style="width:140px;" class="border border-2 border-primary mb-4"></div>
        <div class="row" id="doctors_show">

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
            
        </div>
    </div>
</section>

<!-- footer -->
<?php require_once("inc/footer.php") ?>

<script>
    $(document).ready(function(){
        let name = "<?php if(isset($_GET["dept"])){ echo $_GET["dept"]; } ?>";
        $.ajax({
            url: "ajax/single_departments_crud.php",
            method: "POST",
            data: {
                dept: name,
                action: "loadDeptDoctors"
            },
            success: function(data){
                $("#doctors_show").html(data);
                console.log(data);
            }
        });
    });
</script>