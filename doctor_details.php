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
                <h3 class="text-white mb-2">Doctor Details</h3>
                <small class="text-white">
                    <a href="index.php" class="text-decoration-none text-white">Home</a>
                    /
                    <a href="departments.php" class="text-decoration-none text-white">Find A Doctor</a>
                    /
                    <a href="doctor_details.php" class="text-decoration-none text-white">Doctor Details</a>
                </small>
            </div>
            <div class="col-md-6 d-flex mt-3 align-items-center justify-content-end">
                <button type="button" class="btn btn-danger rounded">CALL US: 01608566748</button>
            </div>
        </div>
    </div>
</section>

<!-- doctor details data -->

<section class="my-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3 shadow bg-light">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="" class="img-fluid w-100 rounded-start py-3" id="doctor_img">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <div class="">
                                    <div class="">
                                        <h5 class="card-title mb-0" id="doctor_name"></h5>
                                        <small>Designation: <span id="doctor_designation"></span></small>
                                    </div>
                                    <hr />
                                    <div class="">
                                        <p id="doctor_bio"></p>
                                    </div>
                                    <hr />
                                    <div class="row">
                                        <div class="col-md-6">
                                            <ul class="nav flex-column">
                                                <li class="nav-item mb-3">
                                                    <a class="nav-link fw-bold text-dark m-0 p-0">Department: </a>
                                                    <small id="doctor_department"></small>
                                                </li>

                                                <li class="nav-item mb-3">
                                                    <a class="nav-link fw-bold text-dark m-0 p-0">Qualification: </a>
                                                    <small id="doctor_qualification"></small>
                                                </li>

                                                <li class="nav-item mb-3">
                                                    <a class="nav-link fw-bold text-dark m-0 p-0">Specialization: </a>
                                                    <small id="doctor_specialization"></small>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6">
                                            <ul class="nav flex-column">
                                                <li class="nav-item mb-3">
                                                    <a class="nav-link fw-bold text-dark m-0 p-0">Gender: </a>
                                                    <small id="doctor_gender"></small>
                                                </li>

                                                <li class="nav-item mb-3">
                                                    <a class="nav-link fw-bold text-dark m-0 p-0">Experience: </a>
                                                    <small id="doctor_experience"></small>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="row d-flex align-items-center justify-content-center">
                                        <div class="col-md-6">
                                            <h6 class="fw-bolder">Consulation Fees: <span id="doctor_fees"></span></h6>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                            if (isset($_SESSION['userLogin']) && isset($_SESSION['adminLogin']) && isset($_GET["id"])) {
                                                echo "<button type='submit' class='btn btn-primary rounded-pill text-right'><a href='book_an_appointment.php?id={$_GET['id']}' class='text-decoration-none text-white'>Book Appointment</a></button>";
                                            } else {
                                                echo "<button type='submit' class='btn btn-primary rounded-pill text-right'><a href='login.php' class='text-decoration-none text-white'>Book Appointment</a></button>";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <h6 class="fw-bolder">Timings</h6>
                                    <table class="table table-light table-striped table-hover" id="timing_data">
                                        <thead>
                                            <tr>
                                                <th>Day</th>
                                                <th>Shift</th>
                                                <th>Start_time</th>
                                                <th>End_time</th>
                                                <th>Avg_time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
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
    $(document).ready(function() {
        let id = "<?php if (isset($_GET["id"])) {
                        echo $_GET["id"];
                    } ?>";
        $.ajax({
            url: "ajax/doctor_details_crud.php",
            method: "POST",
            data: {
                id: id
            },
            success: function(data) {
                let info = JSON.parse(data);
                let profile = "admin/images/doctors/"+info.doctor_info.profile;
                $("#doctor_img").attr("src",profile);
                // Display doctor information
                $("#doctor_name").text(info.doctor_info.name);
                $("#doctor_designation").text(info.doctor_info.designation);
                $("#doctor_bio").text(info.doctor_info.bio);
                $("#doctor_department").text(info.doctor_info.department);
                $("#doctor_qualification").text(info.doctor_info.qualification);
                $("#doctor_specialization").text(info.doctor_info.specialization);
                $("#doctor_experience").text(info.doctor_info.experience);
                $("#doctor_fees").text(info.doctor_info.fees);

                // Extract doctor timings array
                var doctorTimings = info.doctor_timings;

                // Clear existing rows in the table body
                $("#timing_data tbody").empty();

                // Loop through doctor timings and generate table rows dynamically
                $.each(doctorTimings, function(index, timing) {
                    // Create a new table row
                    var row = $("<tr>");

                    // Create table cells and append them to the row
                    $("<td>").text(timing.day).appendTo(row); // Add day
                    $("<td>").text(timing.shift).appendTo(row); // Add shift
                    $("<td>").text(timing.start_time).appendTo(row);
                    $("<td>").text(timing.end_time).appendTo(row); // Add start time and end time
                    $("<td>").text(timing.avg_time).appendTo(row); // Add avg time

                    // Append the row to the table
                    row.appendTo("#timing_data tbody");
                });
            }
        });

    });
</script>