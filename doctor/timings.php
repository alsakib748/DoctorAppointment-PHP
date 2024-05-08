<!-- header -->
<?php include "inc/header.php"; ?>

<section class="">

    <div class="container">
        <div class="card shadow-sm my-3" style="min-width:100%;">
            <div class="card-body">
                <div class="">
                    <?php if (isset($_GET["status"]) && $_GET["status"] == "edit" && $_GET["id"]) { ?>
                        <div class="d-md-flex align-items-md-center justify-content-md-between">
                            <h5 class="fs-5 text-muted mb-4">Edit Timings</h5>
                            <a href="timings.php" class="btn btn-danger text-decoration-none">Back</a>
                        </div>
                        <hr/>
                        <form action="" method="POST" id="timing_form">
                            <div class="row">
                                <h5 class='text-muted'>Day: </h5>
                                <h5 class='text-muted'>Shift: </h5>
                                <div class="col-md-3">
                                    <div class="mb-2" style="position: relative">
                                        <label for="start_time" class="form-label text-muted fw-semibold ">Start Time</label>
                                        <input type="time" class="form-control shadow-none bg-light" data-format="hh:mm A" name="start" id="start_time" />
                                    </div>
                                </div>
                                <div class="col-md-3" style="position: relative">
                                    <div class="mb-2">
                                        <label for="end_time" class="form-label text-muted fw-semibold">End Time</label>
                                        <input type="time" class="form-control shadow-none bg-light" name="end" id="end_time" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-2">
                                        <label for="avg_time" class="form-label text-muted fw-semibold" style="font-size: 0.8rem;">Avg Consultation Time</label>
                                        <select class="form-select" name="avg_time" id="avg_time">
                                            <option value="" selected class="text-muted fw-semibold">Avg time</option>
                                            <option value="10">10 Minutes</option>
                                            <option value="15">15 Minutes</option>
                                            <option value="20">20 Minutes</option>
                                            <option value="25">25 Minutes</option>
                                            <option value="30">30 Minutes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="mb-2">
                                        <label for="" class="form-label mb-4"></label>
                                        <div class="shadow">
                                            <input type="submit" class="btn btn-primary w-100 shadow-none text-light" value="Update" id="add_btn" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    <?php } else { ?>

                        <h5 class="fs-5 text-muted mb-4">Doctor Timings</h5>

                        <form action="" method="POST" id="timing_form">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="mb-2">
                                        <label for="select_day" class="form-label text-muted fw-semibold">Select a day</label>
                                        <select class="form-select" name="day" id="select_day">
                                            <option value="" selected class="text-muted fw-semibold">Select a day</option>
                                            <option value="Saturday">Saturday</option>
                                            <option value="Sunday">Sunday</option>
                                            <option value="Monday">Monday</option>
                                            <option value="Tuesday">Tuesday</option>
                                            <option value="Wednesday">Wednesday</option>
                                            <option value="Thursday">Thursday</option>
                                            <option value="Friday">Friday</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="mb-2">
                                        <label for="select_shift" class="form-label text-muted fw-semibold">Select a shift</label>
                                        <select class="form-select" name="shift" id="select_shift">
                                            <option value="" selected class="text-muted fw-semibold">Select a shift</option>
                                            <option value="Shift 1">Shift 1</option>
                                            <option value="Shift 2">Shift 2</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="mb-2" style="position: relative">
                                        <label for="start_time" class="form-label text-muted fw-semibold ">Start Time</label>
                                        <input type="time" class="form-control shadow-none bg-light" data-format="hh:mm A" name="start" id="start_time" />
                                    </div>
                                </div>
                                <div class="col-md-2" style="position: relative">
                                    <div class="mb-2">
                                        <label for="end_time" class="form-label text-muted fw-semibold">End Time</label>
                                        <input type="time" class="form-control shadow-none bg-light" name="end" id="end_time" />
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="mb-2">
                                        <label for="avg_time" class="form-label text-muted fw-semibold" style="font-size: 0.8rem;">Avg Consultation Time</label>
                                        <select class="form-select" name="avg_time" id="avg_time">
                                            <option value="" selected class="text-muted fw-semibold">Avg time</option>
                                            <option value="10">10 Minutes</option>
                                            <option value="15">15 Minutes</option>
                                            <option value="20">20 Minutes</option>
                                            <option value="25">25 Minutes</option>
                                            <option value="30">30 Minutes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="mb-2">
                                        <label for="" class="form-label mb-4"></label>
                                        <div class="shadow">
                                            <input type="submit" class="btn btn-primary w-100 shadow-none text-light" value="Add" id="add_btn" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <hr />
                        <div class="mt-4" id="show-timings">

                        </div>
                    <?php } ?>
                </div>

            </div>
        </div>

    </div>

</section>

<!-- footer -->
<?php include "inc/footer.php"; ?>

<script>
    $(document).ready(function() {

        function loadTimings() {
            $.ajax({
                url: "ajax/timings_crud.php",
                method: "POST",
                data: {
                    status: "loadTimings"
                },
                success: function(data) {
                    $("#show-timings").html(data);
                }
            });
        }

        loadTimings();

        $("#timing_form").on("submit", function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            $.ajax({
                url: "ajax/timings_crud.php",
                method: "POST",
                data: $("#timing_form").serialize(),
                success: function(data) {
                    if (data == 1) {
                        alert("Timings inserted successfully.");
                        loadTimings();
                        $("#timing_form").trigger("reset");
                    } else {
                        $("#timing_form").trigger("set");
                        alert(data);
                        console.log(data);
                    }
                }
            });
        });

    });
</script>