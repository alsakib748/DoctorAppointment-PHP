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
        <div class="d-flex justify-content-center doctor-search-content">
            <form action="" method="POST" class="doctor_search_form" id="filter_form" autocomplete="off">
                <label for="" class="form-label mb-0 search-doctor-label">Search Doctor's</label>
                <div class="mt-1 mb-3 d-flex align-items-center justify-content-center doctor-search">
                    <input type="text" class="form-control shadow-none bg-light rounded-end-0 p-1 search-bar" name="search" id="searchId" style="width: 600px;" placeholder="Search By Doctor Name, Designation, Specialization" />
                    <input type="submit" name="filter" class="btn btn-primary shadow-none rounded-0 p-1 px-3 filter-btn" value="Search">
                    <input type="button" id="reset_filter" class="btn btn-danger shadow-none rounded-start-0 rounded-end p-1 px-3 reset-btn" value="Reset">
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Showed all doctor's -->
<section class="my-3">
    <div class="container">
        <div class="row" id="show-doctors">

        </div>
    </div>
</section>


<!-- footer -->
<?php require_once("inc/footer.php") ?>

<script>
    $(document).ready(function() {
        function loadDoctors() {
            $.ajax({
                url: "ajax/find_doctors_crud.php",
                method: "POST",
                data: {
                    status: "loadDoctors"
                },
                success: function(data) {
                    $("#show-doctors").append(data);
                }
            });
        }

        loadDoctors();

        $("#filter_form").on("submit", function(e) {
            e.preventDefault();
            let value = $("#searchId").val();
            if (value != "") {
                console.log(value);
                $.ajax({
                    url: "ajax/find_doctors_crud.php",
                    method: "POST",
                    data: {
                        value: value,
                        status: "showDoctorsBySearch"
                    },
                    success: function(data) {
                        $("#show-doctors").html(data);
                    }
                });
            } else {
                alert("You do not search anything");
            }
        });

        $("#reset_filter").on("click",function(){
            $("#filter_form").trigger("reset");
            loadDoctors();
        });

    });
</script>