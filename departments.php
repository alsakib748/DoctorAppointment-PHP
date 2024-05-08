<?php
session_start();
if (isset($_SESSION["doctorLogin"]) && $_SESSION["doctorLogin"] == true) {
    header("Location: doctor/dashboard.php");
    exit;
}

?>
<!-- header -->
<?php require_once("inc/header.php"); ?>

<section class="departments">

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
            <p class="text-center m-0">Search your department / specialist</p>
            <div class="d-flex justify-content-center">
                <form action="" method="POST" id="filter_form" autocomplete="off">
                    <div class="mt-1 mb-3 d-flex align-items-center justify-content-center">
                        <input type="text" class="form-control shadow-none bg-light rounded-end-0 p-1 dept-search" name="search" id="searchId" style="width: 500px;" placeholder="Search By Department Name" />
                        <input type="submit" id="filter" class="btn btn-primary shadow-none rounded-0 p-1 px-3" value="Filter">
                        <input type="button" id="filter_reset" class="btn btn-danger shadow-none rounded-start-0 rounded-end p-1 px-3" value="Reset">
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section class=" my-5">
        <!-- <div class="container d-flex align-items-center justify-content-center"> -->
        <div class="container">
            <div class="departments row" id="show-departments">

            </div>
        </div>
        <!-- </div> -->
    </section>

</section>

<!-- footer -->
<?php require_once("inc/footer.php") ?>

<script>
    $(document).ready(function() {
        function loadDepartments() {
            $.ajax({
                url: "ajax/departments_crud.php",
                method: "POST",
                data: {
                    status: "loadDepartments"
                },
                success: function(data) {
                    // console.log(data);
                    $("#show-departments").append(data);
                }
            });
        }
        loadDepartments();


    $("#filter_form").on("submit", function(e) {
        e.preventDefault();

        let department = $("#searchId").val();

        if (department != '') {
            $.ajax({
                url: "ajax/departments_crud.php",
                method: "POST",
                data: {
                    status: "showDepartmentByName",
                    department: department
                },
                success: function(data) {
                    // console.log(data);
                    $("#show-departments").html(data);
                }
            });
        } else {
            alert("You not search any department name");
        }
    });

    $("#filter_reset").on("click", function() {
        $("#filter_form").trigger("reset");
        loadDepartments();
    });
    
});

</script>