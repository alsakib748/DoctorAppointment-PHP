<!-- header -->
<?php include "inc/header.php"; ?>

<section class="">

    <div class="container">
        <div class="card shadow-sm my-3" style="min-width:100%;">
            <div class="card-body">
                <div class="">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="fs-5 text-muted">View Appointment</h5>
                        <a href="appointments_history.php" name="department" class="text-decoration-none btn btn-danger shadow-none mb-4">Back</a>
                    </div>
                    <h5 class="fs-5 text-muted">Appointment Details</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="apt_number" class="form-label">Appointment Number</label>
                                <input type="text" class="form-control" id="appoint_number" name="appoint_number">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="apt_date" class="form-label">Appointment Date</label>
                                <input type="text" class="form-control" id="appoint_date" name="appoint_date">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="apt_time" class="form-label">Appointment Time</label>
                                <input type="text" class="form-control" id="appoint_time" name="appoint_time">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="card shadow-sm my-3" style="min-width:100%;">
            <div class="card-body">
                <div class="">
                    <h5 class="fs-5 text-muted">Patient Detail</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="apt_name" class="form-label">Full Name</label>
                                <input type="text" class="form-control shadow-none" id="apt_name">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="apt_email" class="form-label">Email Address</label>
                                <input type="email" class="form-control shadow-none" id="apt_email">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="apt_number" class="form-label">Phone Number</label>
                                <input type="text" class="form-control shadow-none" id="apt_number">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="apt_age" class="form-label">Age</label>
                                <input type="text" class="form-control shadow-none" id="apt_age">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="apt_email" class="form-label">Gender</label>
                                <select class="form-select shadow-none" id="apt_gender">
                                    <option value="" selected>Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="others">Others</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="apt_number" class="form-label">Alternative Phone Number</label>
                                <input type="text" class="form-control shadow-none" id="apt_number2">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="apt_dob" class="form-label">Date of Birth</label>
                                <input type="text" class="form-control shadow-none" id="apt_dob">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <label for="apt_comment" class="form-label">Patient/User Comment</label>
                            <textarea class="form-control shadow-none" id="apt_comment" rows="1"></textarea>
                        </div>
                        <div class="d-md-flex justify-content-md-end py-3">
                            <div class="shadow-md">
                                <input type="submit" name="update_patient" class="btn btn-primary shadow-none" value="Update Patient" />
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="card shadow-sm my-3" style="min-width:100%;">
            <div class="card-body">
                <div class="">
                    <h5 class="fs-5 text-muted">Appointment Status Update</h5>
                    <form action="" method="POST" id="appointment_status_update_form">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="apt_email" class="form-label">Appointment Status</label>
                                    <select class="form-select shadow-none" name="appointment_status" id="apt_status" > 
                                        <option value="">Select Appointment Status</option>
                                        <option value="Booked">Booked</option>
                                        <option value="Cancelled">Cancelled</option>
                                        <option value="Completed">Completed</option>
                                        <option value="Patient Not Available">Patient Not Available</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="apt_fees" class="form-label">Consultation Fees</label>
                                    <input type="text" class="form-control shadow-none bg-secondary text-white" name="appointment_fees" id="apt_fees" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3 mt-2">
                                    <small for="apt_fees_status" class="form-label text-muted">Consultation Fees Status (Payment received?)</small>
                                    <select class="form-select shadow-none" name="fees_status" id="apt_fees_status" >
                                        <option value="">Select Fees Status</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Completed">Completed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="apt_doctor_comment" class="form-label" >Doctor Comment (Write your comment)</label>
                                    <textarea class="form-control shadow-none" name="doctor_comment" id="apt_doctor_comment" rows="3" value="" placeholder="Write comment"></textarea>
                                </div>
                            </div>
                            <input type="hidden" name="apt_id" value="<?php echo $_GET["id"] ? $_GET["id"] : 0; ?>" />
                            <div class="d-md-flex justify-content-md-end py-3">
                                <div class="shadow-md">
                                    <input type="submit" name="update_patient" class="btn btn-primary shadow-none" value="Update" />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>

    </div>

</section>

<!-- footer -->
<?php include "inc/footer.php"; ?>

<script>
    $(document).ready(function() {

        function loadViewAppointments() {
            let id = "<?php echo $_GET["id"] ? $_GET["id"] : ""; ?>";

            if (id != "") {

                $.ajax({
                    url: "ajax/view_appointment_crud.php",
                    method: "POST",
                    data: {
                        id: id,
                        action: "loadViewAppointmentsData"
                    },
                    success: function(response) {
                        let data = JSON.parse(response);
                        if (data.userSuccess) {
                            // 
                            $("#appoint_number").val(data.userSuccess.apt_no);
                            $("#appoint_date").val(data.userSuccess.apt_date);
                            $("#appoint_time").val(data.userSuccess.start_time);
                            // 
                            $("#apt_name").val(data.userSuccess.name);
                            $("#apt_email").val(data.userSuccess.email);
                            $("#apt_number").val(data.userSuccess.contact);
                            $("#apt_age").val(data.userSuccess.age);

                            var apt_gender = data.userSuccess.gender.toLowerCase(); // Ensure the value is in lowercase
                            $("#apt_gender").val(apt_gender);

                            $("#apt_dob").val(data.userSuccess.dob);
                            $("#apt_comment").val(data.userSuccess.user_comment);
                            // 
                            $("#apt_fees").val(data.userSuccess.fees);
                            //
                            $("#apt_status").val(data.userSuccess.appointment_status);
                            $("#apt_fees_status").val(data.userSuccess.fees_status);
                            $("#apt_doctor_comment").val(data.userSuccess.doctor_comment);

                        } 
                        else if (data.adminSuccess) {
                            // 
                            $("#appoint_number").val(data.adminSuccess.apt_no);
                            $("#appoint_date").val(data.adminSuccess.apt_date);
                            $("#appoint_time").val(data.adminSuccess.start_time);
                            // 
                            $("#apt_name").val(data.adminSuccess.name);
                            $("#apt_email").val(data.adminSuccess.email);
                            $("#apt_number").val(data.adminSuccess.contact);
                            $("#apt_age").val(data.userSuccess.age);
                            $("#apt_gender").val(data.userSuccess.gender);
                            $("#apt_dob").val(data.userSuccess.dob);
                            $("#apt_comment").val(data.userSuccess.user_comment);
                            // 
                            $("#apt_fees").val(data.adminSuccess.fees);
                            //
                            $("#apt_status").val(data.adminSuccess.appointment_status);
                            $("#apt_fees_status").val(data.adminSuccess.fees_status);
                            $("#apt_doctor_comment").val(data.adminSuccess.doctor_comment);

                        }
                        else {
                            alert(response);
                        }

                        // console.log(response);
                    }
                });
            }
        }

        loadViewAppointments();

        $("#appointment_status_update_form").on("submit", function(e) {
            e.preventDefault();

            $.ajax({
                url: "ajax/view_appointment_crud.php",
                method: "POST",
                data:  $("#appointment_status_update_form").serialize(),
                success: function(response){
                    // console.log(response);
                    // alert(response);
                    if(response == "Appointment status update successfully"){
                        alert(response);
                        location.reload();
                    }    
                }
            });

        });


    });
</script>