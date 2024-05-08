<!-- header -->
<?php include "inc/header.php"; ?>

<section class="">

    <div class="container">
        <div class="card shadow-sm my-3" style="min-width:100%;">
            <div class="card-body">
                <div class="">
                    <h5 class="fs-5 text-muted mb-5">Profile</h5>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="doc_name" class="form-label">Doctor Name *</label>
                                        <input type="text" class="form-control shadow-none" id="doc_name" name="doctor_name" value="Al Sakib Ayon">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="doc_number" class="form-label">Phone Number *</label>
                                        <input type="number" class="form-control shadow-none" id="doc_number" name="doctor_number" value="017********">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="doc_email" class="form-label">Email *</label>
                                        <input type="email" class="form-control shadow-none" id="doc_email" name="doctor_email" value="alsakib.ayon123@gmail.com">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="doc_gender" class="form-label">Gender *</label>
                                        <select class="form-select shadow-none" id="doc_gender" aria-label="Default select example">
                                            <option value="">Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Others">Others</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="doc_desig" class="form-label">Designation *</label>
                                        <input type="text" class="form-control shadow-none" id="doc_desig" value="Neurology physician and surgen">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <img src="" class="img-fluid w-100 border-1" style="height: 240px;" id="doc_profile" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="doc_quali" class="form-label">Qualification</label>
                                <input type="text" class="form-control shadow-none" id="doc_quali" value="MBBS, MBSC">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="doc_image" class="form-label">Upload Profile Image</label>
                                <input type="file" class="form-control shadow-none" id="doc_image">
                            </div>
                        </div>
                    </div>

                    <hr />

                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="doc_exper" class="form-label shadow-none">Experience</label>
                                <input type="text" class="form-control shadow-none" id="doc_exper">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="doc_spec" class="form-label">Specialization (Max 1000 characters)</label>
                                <textarea class="form-control shadow-none" rows="3" id="doc_spec"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="doc_bio" class="form-label">Bio (Max 1000 characters)</label>
                                <textarea class="form-control shadow-none" rows="3" id="doc_bio"></textarea>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="doc_address" class="form-label">Address (Max 500 characters)</label>
                                <textarea class="form-control shadow-none" rows="3" id="doc_address"></textarea>
                            </div>
                        </div>
                        <hr />

                        <div class="row d-flex align-items-center justify-content-between">
                            <div class="col-md-6 mb-3">
                                <label for="doc_fees" class="form-label">Consultation Fees</label>
                                <input type="text" class="form-control shadow-none" id="doc_fees" value="850">
                            </div>
                            <div class="col-md-6"></div>
                        </div>
                        <div class="pb-4 d-md-flex justify-content-md-end">
                            <div class="shadow">
                                <button type="submit" name="submit" class="btn btn-primary shadow-none">Update</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

</section>

<!-- footer -->
<?php include "inc/footer.php"; ?>

<script>
    $(document).ready(function(){
        function loadProfile(){
            let userId = "<?php echo isset($_SESSION['doctorId']) ? $_SESSION['doctorId'] : ''; ?>";
            $.ajax({
                url: "ajax/profile_crud.php",
                method: "POST",
                data: {
                    id: userId,
                    action: "loadProfile"
                },
                success: function(data){
                    let info = JSON.parse(data);
                    let profile = "../admin/images/doctors/"+info.profile;
                    $("#doc_profile").attr("src",profile);
                    $("#doc_name").val(info.name);
                    $("#doc_number").val(info.contact);
                    $("#doc_email").val(info.email);
                    $("#doc_gender").val(info.gender);
                    $("#doc_desig").val(info.designation);
                    $("#doc_quali").val(info.qualification);
                    $("#doc_exper").val(info.experience);
                    $("#doc_spec").val(info.specialization);
                    $("#doc_bio").val(info.bio);
                    $("#doc_address").val(info.address);
                    $("#doc_fees").val(info.fees);
                    
                }
            });
        }

        loadProfile();
    });
</script>