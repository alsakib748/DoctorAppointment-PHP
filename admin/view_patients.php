<!-- header -->
<?php
include "inc/header.php";
include "inc/db.php";
?>

<section class="">

    <div class="container">
        <div class="card shadow-sm" style="min-width:100%;min-height: 576px;">
            <div class="card-body">
                <div class="d-md-flex justify-content-md-between">
                    <h5 class="fs-5 text-muted">Patient List</h5>
                    <a href="view_doctors.php" name="department" class="text-decoration-none btn btn-danger shadow-none mb-4">Back</a>
                </div>

                <h6 class="text-secondary">Select doctor to list its patients</h6>

                <div class="w-50 d-md-flex justify-content-start mb-4">
                    <form action="" method="POST" id="show_by_doctors">
                        <div class="d-md-flex align-items-md-center justify-content-md-start">
                            <select class="form-select  text-muted fw-semibold shadow-none me-3" id="department" style="width: 250px;">
                                <option value="" selected class="text-muted">Select Department</option>
                                <?php
                                $query = "SELECT * FROM `departments`";
                                $result = mysqli_query($con, $query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                    <option value="<?php echo $row['name'] ?>" class="text-muted"><?php echo $row['name'] ?></option>
                                <?php } ?>
                            </select>
                            <select class="form-select text-muted fw-semibold shadow-none me-3" id="doctors" style="width: 250px;" disabled>
                                <option value="" selected class="text-muted">Select Doctor</option>
                            </select>
                            <input type="hidden" id="search_id" name="searchId" />

                            <input type="submit" class="btn btn-primary shadow-none px-3" value="Filter" />
                            <input type="button" class="btn btn-danger shadow-none ms-2 px-3" value="Reset" id="reset_id" />
                        </div>
                    </form>

                </div>

                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center justify-content-start">
                        <h6 class="fs-6 text-muted">Show </h6>
                        <select class="form-select mx-2" aria-label="Default select example" style="width:80px;">
                            <option value="10" selected>10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                            <option value="25">25</option>
                            <option value="30">30</option>
                            <option value="35">35</option>
                            <option value="40">40</option>
                            <option value="45">45</option>
                            <option value="50">50</option>
                        </select>
                        <h6 class="fs-6 text-muted"> entries</h6>
                    </div>
                    <div class="">
                        <form class="d-flex align-items-center justify-content-center" action="">
                            <label for="search" class="form-label me-2 text-muted fw-semibold mt-1">Search: </label>
                            <input type="text" class="form-control shadow-none" />
                        </form>
                    </div>
                </div>

                <div class="mt-2" id="patients_all_data">

                </div>

                <div class="d-flex align-items-center justify-content-between">
                    <p class="">Showing 1 to 1 of 1 entries</p>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

</section>

<!-- footer -->
<?php include "inc/footer.php"; ?>

<script>
    $(document).ready(function() {
        // Todo: View all patients data
        function viewAllPatients() {
            $.ajax({
                url: "ajax/view_patients_crud.php",
                type: "POST",
                data: {
                    action: "viewAllPatientsData"
                },
                success: function(response) {
                    $("#patients_all_data").html(response);
                    // console.log(response);
                }
            });
        }
        viewAllPatients();

        // Todo: after select department change doctors
        $("#department").on("change", function(e) {
            // e.preventDefault();
            let value = $("#department").val();
            // console.log(value);
            if (value != "") {
                $.ajax({
                    url: "ajax/view_patients_crud.php",
                    method: "POST",
                    data: {
                        value: value,
                        action: "showDepartmentDoctors"
                    },
                    success: function(response) {
                        let data = JSON.parse(response);
                        $("#doctors").removeAttr("disabled");
                        // console.log(data);
                        $("#doctors").empty();
                        $.each(data, function(index, value) {
                            // console.log("id: " + value.id + ", name: " + value.name);
                            // $("#doctors").append("<option id='doctors" + (index + 1) + "' value='" + value.name + "' data-id='" + value.id + "' class='text-muted'>" + value.name + "</option>");
                            $("#doctors").append("<option id='doctors" + (index + 1) + "' value='" + value.name + "' data-id='" + value.id + "' class='text-muted'>" + value.name + "</option>");

                            $("#doctors" + (index + 1)).data("id", value.id);

                        });
                    }
                });
            } else {
                $("#doctors").empty();
            }
        });

        // Todo: show search doctor related appointment patients 

        let val = '';
        let id = '';

        $("#doctors").on("change", function() {
            val = $("#doctors").val();
            // Get the selected option
            let selectedOption = $(this).find("option:selected");

            id = selectedOption.data("id");
        });

        $("#show_by_doctors").on("submit", function(e) {
            e.preventDefault();

            if (val != '' && id != '') {
                $.ajax({
                    url: "ajax/view_patients_crud.php",
                    method: "POST",
                    data: {
                        id: id,
                        val: val,
                        action: "doctorNameRelatedPatients"
                    },
                    success: function(response) {
                        $("#patients_all_data").html(response);
                    }
                });
            }else{
                alert("Select first Department Then Doctor");
            }

        });

        // Todo: reset fileter
        $("#reset_id").on("click", function() {
            $("#show_by_doctors").trigger("reset");
            $("#doctors").empty();
            viewAllPatients();
        });

    });
</script>