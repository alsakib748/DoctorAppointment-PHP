<!-- header -->
<?php include "inc/header.php"; ?>

<section class="">

    <div class="container">
        <div class="card shadow-sm my-3" style="min-width:100%;">
            <div class="card-body">
                <div class="">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="fs-5 text-muted">View Appointment</h5>

                        <a href="view_patients.php" name="department" class="text-decoration-none btn btn-danger shadow-none mb-4">Back</a>

                    </div>
                    <h5 class="fs-5 text-muted">Appointment Details</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="apt_number" class="form-label">Appointment Number</label>
                                <input type="text" class="form-control" id="apt_number" name="appoint_number" value="762195" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="apt_date" class="form-label">Appointment Date</label>
                                <input type="text" class="form-control" id="apt_date" name="appoint_date" value="February 26,2023" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="apt_time" class="form-label">Appointment Time</label>
                                <input type="text" class="form-control" id="apt_time" name="appoint_time" value="10:00 AM" readonly>
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
                                <input type="text" class="form-control shadow-none bg-light" id="apt_name" value="Al Sakib Ayon" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="apt_email" class="form-label">Email Address</label>
                                <input type="email" class="form-control shadow-none bg-light" id="apt_email" value="ayon2465@gmail.com" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="apt_number" class="form-label">Phone Number</label>
                                <input type="text" class="form-control shadow-none bg-light" id="apt_number" value="01797324568" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="apt_age" class="form-label">Age</label>
                                <input type="text" class="form-control shadow-none bg-light" id="apt_age" value="15" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="apt_gender" class="form-label">Gender</label>
                                <select class="form-select bg-light shadow-none" id='apt_gender' readonly>
                                    <option value="male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="apt_number" class="form-label">Alternate Phone Number</label>
                                <input type="text" class="form-control shadow-none bg-light" id="apt_number" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="apt_dob" class="form-label">Date of Birth</label>
                                <input type="text" class="form-control shadow-none bg-light" id="apt_dob" value="26 July 2000" readonly>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <label for="apt_comment" class="form-label">Patient/User Comment</label>
                            <textarea class="form-control shadow-none bg-light" id="apt_comment" rows="1" value="" readonly></textarea>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="card shadow-sm my-3" style="min-width:100%;">
            <div class="card-body">
                <div class="">
                    <h5 class="fs-5 text-muted">Appointment Status Update</h5>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="apt_status" class="form-label">Appointment Status</label>
                                <select class="form-select bg-light shadow-none" id="apt_status" readonly>
                                    <option value="Booked">Booked</option>
                                    <option value="Pending">Pending</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="apt_fees" class="form-label">Consultation Fees</label>
                                <input type="text" class="form-control shadow-none bg-light" id="apt_fees" value="850" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3 mt-2">
                                <small for="apt_payment_status" class="form-label text-muted">Consultation Fees Status (Payment received?)</small>
                                <input type="text" class="form-control shadow-none bg-light" id="apt_payment_status" value="Pending" readonly>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="apt_doctor_comment" class="form-label">Doctor Comment (Write your comment)</label>
                                <textarea class="form-control shadow-none bg-light" id="apt_doctor_comment" rows="3" value="" placeholder="Write comment"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

</section>

<!-- footer -->
<?php include "inc/footer.php"; ?>

<script>
    $(document).ready(function() {

        // Todo: view appointments function
        function viewAppointments() {
            let apt_no = "<?php echo $_GET["apt"]; ?>";

            $.ajax({
                url: "ajax/view_appointments_crud.php",
                method: "POST",
                data: {
                    apt_no: apt_no,
                    action: "viewAppointmentsData"
                },
                success: function(response) {
                    // console.log(response);
                    let data = JSON.parse(response);
                    if (data.nof_found) {

                    } else if (data.success) {
                        $("#apt_number").val(data.success.apt_no);
                        $("#apt_date").val(data.success.apt_date);
                        $("#apt_time").val(data.success.start_time);
                        $("#apt_name").val(data.success.name);
                        $("#apt_age").val(data.success.age);
                        $("#apt_gender").val(data.success.gender);
                        $("#apt_number").val(data.success.contact);
                        $("#apt_dob").val(data.success.dob);
                        // $("#apt_comment").val(data.success);
                        $("#apt_status").val(data.success.status);
                        // $("#apt_status_option_value").val(data.success.status);
                        $("#apt_fees").val(data.success.fees);
                        if (data.success.bookings_status == "VALID") {
                            $("#apt_payment_status").val("Paid");
                        } else {
                            $("#apt_payment_status").val("Pending");
                        }


                        // $("#apt_doctor_comment").val(data.success);
                    }

                    console.log(data);

                }
            });
        }

        viewAppointments();

    });
</script>