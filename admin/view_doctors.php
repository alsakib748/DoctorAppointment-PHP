<!-- header -->
<?php
include "inc/header.php";
include "inc/db.php";
?>

<section id="view-doctor" class="">

    <div class="container">
        <div class="card shadow-sm  pb-5" style="min-width:100%;min-height: 576px;">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="fs-5 text-muted">Doctors List</h5>
                    <a href="add_doctor.php" class="text-decoration-none btn btn-primary shadow-none mb-4">Add Doctor</a>
                </div>

                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center justify-content-start">
                        <h6 class="fs-6 text-muted">Show </h6>
                        <select class="form-select mx-2 shadow-none" aria-label="Default select example" style="width:80px;">
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

                <div class="mt-2" id="show-doctors">

                </div>

                <div class="d-flex align-items-center justify-content-between">
                    <p class="">Showing 1 to 3 of 3 entries</p>
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

<section id="edit-doctor" class="d-none">
    <div class="container">
        <div class="card shadow-sm my-3" style="min-width:100%;">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="fs-5 text-muted">Edit Doctor</h5>
                    <a href="view_doctors.php" name="department" class="text-decoration-none btn btn-danger shadow-none mb-4">Back</a>
                </div>
                <form action="" method="POST" id="edit_doctor_form">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="edit-department" class="form-label">Select Department *</label>
                                        <select class="form-select shadow-none" id="edit-department" name="edit_department">
                                            <option class="fw-bolder text-muted">Select Department</option>
                                            <?php
                                            $sqlDept = "SELECT * FROM `departments`";
                                            $resultDept = mysqli_query($con, $sqlDept);
                                            while ($rowDept = mysqli_fetch_assoc($resultDept)) {
                                                echo "<option value='{$rowDept['name']}'>{$rowDept['name']}</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="edit-name" class="form-label">Doctor Name *</label>
                                        <input type="text" class="form-control shadow-none" id="edit-name" name="edit_name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="edit-number" class="form-label">Phone Number *</label>
                                        <input type="number" value="" class="form-control shadow-none" id="edit-number" name="edit_number">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="edit-email" class="form-label">Email *</label>
                                        <input type="email" value="" class="form-control shadow-none" id="edit-email" name="edit_email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="edit-pass" class="form-label">Password *</label>
                                        <input type="text" class="form-control shadow-none" id="edit-pass" name="edit_pass">
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="col-md-4">
                            <img src="images/doctors/" class="img-fluid w-100 border-1" id="show_profile" style="height: 240px;" />

                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="edit-gender" class="form-label">Gender *</label>
                                <select class="form-select shadow-none" id="edit-gender" name="edit_gender">
                                    <option class="fw-bolder text-muted">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="edit-designation" class="form-label">Designation *</label>
                                <input type="text" value="" class="form-control shadow-none" id="edit-designation" name="edit_designation">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="edit-profile" class="form-label">Upload Doctor Image</label>
                                <input type="file" class="form-control shadow-none" value="" id="edit-profile" name="edit_profile">
                            </div>
                        </div>
                    </div>

                    <hr />

                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="edit-qualification" class="form-label">Qualification</label>
                                <input type="text" value="" class="form-control shadow-none" id="edit-qualification" name="edit_qualification">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="edit-experience" class="form-label shadow-none">Experience</label>
                                <input type="text" value="" class="form-control shadow-none" id="edit-experience" name="edit_experience">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit-specialization" class="form-label">Specialization (Max 1000 characters)</label>
                                <textarea class="form-control shadow-none" rows="3" id="edit-specialization" name="edit_specialization"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit-bio" class="form-label">Bio (Max 1000 characters)</label>
                                <textarea class="form-control shadow-none" rows="3" id="edit-bio" name="edit_bio"></textarea>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="edit-address" class="form-label">Address (Max 500 characters)</label>
                                <textarea class="form-control shadow-none" rows="3" id="edit-address" name="edit_address"></textarea>
                            </div>
                        </div>
                        <hr />

                        <div class="row d-flex align-items-center justify-content-between">
                            <div class="col-md-6 mb-3">
                                <label for="edit-fees" class="form-label">Consultation Fees</label>
                                <input type="text" value="" class="form-control shadow-none" id="edit-fees" name="edit_fees">
                            </div>

                            <div class="col-md-3 form-check">
                                <input class="form-check-input" type="checkbox" id="is-active" name="is_active">
                                <label class="form-check-label" for="is-active">
                                    is Active
                                </label>
                            </div>
                            <div class="col-md-3 form-check">
                                <input class="form-check-input" type="checkbox" id="is-ban" name="is_ban">
                                <label class="form-check-label" for="is-ban">
                                    is Ban
                                </label>
                            </div>
                        </div>
                        <input type="hidden" id="edit-id" name="edit_id" />
                        <div class="pb-4 d-md-flex justify-content-md-end">
                            <button type="submit" name="update_form" id="edit_btn" class="btn btn-primary shadow-none">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- footer -->
<?php include "inc/footer.php"; ?>

<script>
    $(document).ready(function() {

        // Todo: Fetch doctor data ajax request    
        function loadDoctors() {
            $.ajax({
                url: "ajax/doctors_crud.php",
                type: "POST",
                data: {
                    status: "showDoctors"
                },
                success: function(data) {
                    $("#show-doctors").html(data);
                    // console.log(data);
                }
            });
        }

        loadDoctors();

        // Todo: edit doctor data show ajax request
        $(document).on("click", ".edit_doctor", function(e) {
            e.preventDefault();
            $("#view-doctor").addClass("d-none");
            $("#edit-doctor").removeClass("d-none");
            let id = $(this).data("eid");
            $.ajax({
                url: "ajax/doctors_crud.php",
                type: "POST",
                data: {
                    id: id,
                    status: "edit_doctor_data"
                },
                success: function(data) {
                    let row = JSON.parse(data);
                    $("#edit-id").val(row.id);
                    $("#edit-name").val(row.name);
                    $("#edit-department").val(row.department);
                    $("#edit-email").val(row.email);
                    $("#edit-number").val(row.contact);
                    $("#edit-specialization").val(row.specialization);
                    $("#edit-qualification").val(row.qualification);
                    $("#edit-bio").val(row.bio);
                    $("#edit-fees").val(row.fees);
                    $("#edit-gender").val(row.gender);
                    $("#edit-designation").val(row.designation);
                    // $("#edit-profile").prop("value",row.profile);
                    $("#edit-address").val(row.address);
                    $("#edit-experience").val(row.experience);
                    $("#show_profile").attr("src", "images/doctors/" + row.profile);
                    // $("#active").val();
                    if (row.active == 1) {
                        $("#is-active").prop("checked", true);
                    } else {
                        $("#is-ban").prop("checked", true);
                    }
                }
            });
        });

        // Todo: update doctor data ajax request
        $("#edit_doctor_form").on("submit", function(e) {
            e.preventDefault();
            let editFormData = new FormData(this);
            $.ajax({
                url: "ajax/doctors_crud.php",
                type: "POST",
                data: editFormData,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data == 1) {
                        alert("Doctor edit successfully");
                    } else {
                        console.log(data);
                        alert(data);
                    }
                },
                error: function(request, status, error) {
                    printErrorMsg(request.responseText);
                }
            });

        });

        // Todo: delete doctor data ajax request

        $(document).on("click", ".delete_doctor", function() {
            if (confirm("Are you sure do you want to delete doctor record ??")) {
                let id = $(this).data("did");
                $.ajax({
                    url: "ajax/doctors_crud.php",
                    type: "POST",
                    data: {
                        id: id,
                        status: "deleteDoctor"
                    },
                    success: function(data) {
                        if (data == 1) {
                            alert("Doctor deleted successfully");
                            loadDoctors();
                        } else {
                            alert(data);
                        }
                    }
                });
            }
        });

    });
    // Todo: End of the jquery
</script>