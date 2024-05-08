<!-- header -->
<?php 
    include "inc/header.php";
    include "inc/db.php";
?>

<section class="">

    <div class="container">
        <div class="card shadow-sm my-3" style="min-width:100%;">
            <div class="card-body">
                <div class="">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="fs-5 text-muted">Add Doctor</h5>
                        <a href="view_doctors.php" name="department" class="text-decoration-none btn btn-info shadow-none mb-4">View Doctors</a>
                    </div>
                    <form method="POST" id="doctor_form">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="doc-name" class="form-label">Doctor Name *</label>
                                    <input type="text" class="form-control shadow-none" id="doc-name" name="name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="doc-number" class="form-label">Phone Number *</label>
                                    <input type="number" class="form-control shadow-none" id="doc-number" name="contact">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="doc-depart" class="form-label">Select Department *</label>
                                    <select class="form-select shadow-none" id="doc-depart" name="department">
                                        <option selected>Select Department</option>
                                        <?php 
                                            $sql = "SELECT * FROM `departments`";
                                            $result = mysqli_query($con,$sql);
                                            while($row = mysqli_fetch_assoc($result)){
                                                echo "<option value='{$row['name']}'>{$row['name']}</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="doc-email" class="form-label">Email *</label>
                                    <input type="email" class="form-control shadow-none" id="doc-email" name="email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="doc-pass" class="form-label">Password *</label>
                                    <input type="text" class="form-control shadow-none" id="doc-pass" name="pass">
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="doc-gender" class="form-label">Gender *</label>
                                    <select class="form-select shadow-none" id="doc-gender" name="gender">
                                        <option selected>Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Others">Others</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="doc-desig" class="form-label">Designation *</label>
                                    <input type="text" class="form-control shadow-none" id="doc-desig" name="designation">
                                </div>
                            </div>
                            <hr />
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="doc-quali" class="form-label">Qualification</label>
                                    <input type="text" class="form-control shadow-none" id="doc-quali" name="qualification">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="doc-exper" class="form-label shadow-none">Experience</label>
                                    <input type="text" class="form-control shadow-none" id="doc-exper" name="experience">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="doc-spec" class="form-label">Specialization (Max 1000 characters)</label>
                                    <textarea class="form-control shadow-none" rows="3" id="doc-spec" name="specialization"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="doc-bio" class="form-label">Bio (Max 1000 characters)</label>
                                    <textarea class="form-control shadow-none" rows="3" id="doc-bio" name="bio"></textarea>
                                </div>
                            </div>
                            <hr />
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="doc-fees" class="form-label">Consultation Fees</label>
                                    <input type="text" class="form-control shadow-none" id="doc-fees" name="fees">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="doc-image" class="form-label">Upload Doctor Image</label>
                                    <input type="file" class="form-control shadow-none" id="doc-image" name="profile">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="doc-address" class="form-label">Address (Max 500 characters)</label>
                                    <textarea class="form-control shadow-none" rows="3" id="doc-address" name="address"></textarea>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="active" id="doc-active">
                                    <label class="form-check-label" for="doc-active">
                                        is Active
                                    </label>
                                </div>
                                <div class="shadow">
                                    <input type="submit" name="submit_doctor_data" class="btn btn-primary shadow-none" value="Save" >
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>

</section>

<!-- footer -->
<?php include "inc/footer.php"; ?>

<script>
    $(document).ready(function() {
        
        $("#doctor_form").on("submit",function(e){
            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                url: "ajax/doctors_crud.php",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(data){
                    if(data == 1){
                        $("#doctor_form").trigger("reset");
                        alert("Doctor add successfully");
                    }else{
                        console.log(data);
                        alert(data);
                    }
                },
                error: function (request, status, error) {
                    $("#doctor_form").trigger("set");
                    printErrorMsg(request.responseText);
                }
            });

        });


    });
</script>