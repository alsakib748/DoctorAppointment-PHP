<?php
session_start();
if ((isset($_SESSION["adminLogin"]) && $_SESSION["adminLogin"] == true)  || (isset($_SESSION["userLogin"]) && $_SESSION["userLogin"] == true)) {
    date_default_timezone_set('Asia/Dhaka');
?>
    <!-- header -->
    <?php require_once("inc/header.php"); ?>

    <?php if (isset($_GET["id"]) && $_GET["id"] != "") { ?>

        <div class="d-none" id="feedback">
            <h5 class="alert alert-danger text-center"></h5>
        </div>

        <div id="doctor_details">
            <!--  -->
            <section class="about">
                <div class="container py-3">
                    <div class="row">
                        <div class="col-md-6 mt-3">
                            <h3 class="text-white mb-2">Book an appointment</h3>
                            <small class="text-white">
                                <a href="index.php" class="text-decoration-none text-white">Home</a>
                                /
                                <a href="book_an_appointment.php" class="text-decoration-none text-white">Book an appointment</a>
                            </small>
                        </div>
                        <div class="col-md-6 d-flex mt-3 align-items-center justify-content-end">
                            <button type="button" class="btn btn-danger rounded">CALL US: 01608566748</button>
                        </div>
                    </div>
                </div>
            </section>

            <!-- All doctor details to individuals departments -->
            <section class=" my-4">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-3 bg-white shadow">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="" class="img-fluid w-100 rounded-circle p-2" style="height:250px;" id="doctor_img">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <div class="">
                                                <h5 class="card-title mb-0" id="name"></h5>
                                                <small class="card-text" id="designation"></small>
                                            </div>
                                            <div class="my-2">
                                                <h5 class="card-title m-0">Qualifications: <span id="qualification" class="fs-6 fw-normal"></span></h5>
                                            </div>
                                            <div class="my-2">
                                                <h5 class="card-title m-0">Specialization: <span id="specialization" class="fs-6 fw-normal"></span></h5>
                                            </div>
                                            <div class="my-3">
                                                <button type="button" class="btn btn-sm btn-secondary rounded px-3 fees-status"><a href="#" class="text-decoration-none text-white" readonly>Consulation Fees: <span id="fees"></span></a></button>
                                                <button type="submit" class="btn btn-sm btn-primary rounded-pill px-3 another-doctor"><a href="find_a_doctor.php" class="text-decoration-none text-white">Choose Another Doctor</a></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Doctor appointment Time Schedule -->
            <section class="">
                <div class="container">
                    <form action='' method='POST' id='schedule_form'>
                        <div class="row">
                            <div class="col-md-6" id="shift1_timing">

                            </div>
                            <div class="col-md-6" id="shift2_timing">

                            </div>
                        </div>
                    </form>
                </div>
            </section>
            <!-- todo: modals -->

            <!-- Confirm Booking Modal -->
            <div class="modal fade" id="appointmentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Confirmation Booking</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="" method="POST" id="appointment_form">
                            <div class="modal-body">
                                <div class="my-3 text-center">
                                    <h3 class="">Confirmation?</h3>
                                    <p class="">Are you sure want to select <span id="appoint_time"><b></b></span> on <br /> <span id="appoint_date"><b></b></span><b>?</b></p>
                                </div>
                                <div class="">

                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Enter Patient Name*</label>
                                        <input type="text" class="form-control" id="patient_name" name="name" placeholder="Enter your name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Enter Patient Email</label>
                                        <input type="email" class="form-control" id="patient_email" name="email" placeholder="Enter your email">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Enter Patient Phone Number</label>
                                        <input type="number" class="form-control" id="patient_contact" name="contact" placeholder="Enter you number">
                                    </div>
                                    <input type="hidden" id="doctor_id" name="doctorId" value="<?php if (isset($_GET["id"])) {
                                                                                                    echo $_GET["id"];
                                                                                                } ?>" />

                                </div>
                                <div class="d-none" id="appoint_error">
                                    <h6 class='alert alert-danger text-center'></h6>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <input type="submit" name="confirm" value="Appointment" id="appointment_btn" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    <?php } else {
        echo "<h5 class='alert alert-danger text-center'>No Doctor Found !!</h5>";
    } ?>

    <!-- footer -->
    <?php require_once("inc/footer.php") ?>

<?php
} else {
    header("Location: login.php");
    exit;
}
?>

<script>
    // let time;
    // let date;
    // let shift;
    // let avg;
    $(document).ready(function() {
        // Todo: doctor details data
        function loadData() {
            let id = "<?php echo isset($_GET["id"]) ? $_GET["id"] : 'alert("Invalid Link")'; ?>";
            $.ajax({
                url: "ajax/book_an_appointment_crud.php",
                method: "POST",
                data: {
                    id: id,
                    action: "loadBookingDetails"
                },
                success: function(data) {
                    let info = JSON.parse(data);
                    let profile = "admin/images/doctors/" + info.doctor_info.profile;
                    $("#doctor_img").attr("src", profile);
                    $("#name").text(info.doctor_info.name);
                    $("#designation").text(info.doctor_info.designation);
                    $("#qualification").text(info.doctor_info.qualification);
                    $("#specialization").text(info.doctor_info.specialization);
                    $("#fees").text(info.doctor_info.fees);

                    if (info.not_found) {
                        $("#doctor_details").addClass("d-none");
                        $("#feedback").removeClass("d-none");
                        $("#feedback h5").text(info.not_found.blank);
                    }
                }
            });
        }
        loadData();
        // Todo: Timing Schedule show function in shift 1
        function loadTimingShift1() {
            let id = "<?php echo isset($_GET["id"]) ? $_GET["id"] : 'alert("Invalid Link")'; ?>";
            $.ajax({
                url: "ajax/book_an_appointment_crud.php",
                method: "POST",
                data: {
                    id: id,
                    action: "loadTimingDetailsShift1"
                },
                success: function(data) {
                    $("#shift1_timing").html(data);
                    // console.log(data);
                }
            });
        }

        loadTimingShift1();

        // Todo: Timing Schedule show function in shift 2
        function loadTimingShift2() {
            let id = "<?php echo isset($_GET["id"]) ? $_GET["id"] : 'alert("Invalid Link")'; ?>";
            $.ajax({
                url: "ajax/book_an_appointment_crud.php",
                method: "POST",
                data: {
                    id: id,
                    action: "loadTimingDetailsShift2"
                },
                success: function(data) {
                    $("#shift2_timing").html(data);
                    // console.log(data);
                }
            });
        }

        loadTimingShift2();

        // Todo: submit schedule time

        $(document).on("click", 'input[type="radio"]', function() {
            // e.preventDefault();

            // Get data attributes from the clicked radio button
            var time = $(this).val();
            var date = $(this).data("date");
            var shift = $(this).data("shift");
            var avg = $(this).data("avg");

            $("#appoint_time b").html(time);
            $("#appoint_date b").html(date);

            // var formData = $("#appointment_form").serialize();

            jQuery.validator.addMethod("customName", function(value, element) {
                return this.optional(element) || value == value.match(/^[a-zA-Z ]+$/);
            }, "<i class='fa-solid fa-triangle-exclamation'></i> Only Characters and White Space are Allowed.");

            jQuery.validator.addMethod("customEmail", function(value, element) {
                return this.optional(element) || /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i.test(value);
            }, "<i class='fa-solid fa-triangle-exclamation'></i> Please enter valid email address!");

            jQuery.validator.addMethod("customPassword", function(value, element) {
                return this.optional(element) || /^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%&]).*$/i.test(value);
            }, "<i class='fa-solid fa-triangle-exclamation'></i> At least 1 number<br/><i class='fa-solid fa-triangle-exclamation'></i> At least 1 lowercase character(a-z)<br/><i class='fa-solid fa-triangle-exclamation'></i> At least 1 uppercase character (A-Z)<br/><i class='fa-solid fa-triangle-exclamation'></i> At least one special character !");

            $("#appointment_form").validate({
                rules: {
                    name: {
                        minlength: 3,
                        required: true,
                        customName: true
                    },
                    email: {
                        required: true,
                        email: true,
                        customEmail: true
                    },
                    contact: {
                        required: true,
                        number: true,
                        minlength: 11,
                        maxlength: 11
                    }
                },
                messages: {
                    name: {
                        required: "<i class='fa-solid fa-triangle-exclamation'></i> Please enter your name",
                        minlength: "<i class='fa-solid fa-triangle-exclamation'></i> Name at least 3 characters"
                    },
                    email: {
                        required: "<i class='fa-solid fa-triangle-exclamation'></i> Please enter your email address"
                    },
                    contact: {
                        required: "<i class='fa-solid fa-triangle-exclamation'></i> please enter your phone number",
                        number: "<i class='fa-solid fa-triangle-exclamation'></i> Please enter a valid phone number",
                        minlength: "<i class='fa-solid fa-triangle-exclamation'></i> Please enter a 11 digit phone number",
                        maxlength: "<i class='fa-solid fa-triangle-exclamation'></i> Please enter a 11 digit phone number"
                    }
                },
                submitHandler: function(form) {
                    $("#appointment_btn").removeAttr("data-bs-target").removeAttr("data-bs-toggle");
                    $("#appointment_btn").attr("data-bs-target", "#confirmModal");
                    $("#appointment_btn").attr("data-bs-toggle", "modal");

                    // var formData = $("#appointment_form").serialize();
                    $.ajax({
                        url: 'ajax/appointment_bookings_crud.php', // Assuming submit.php is your backend endpoint
                        type: 'POST',
                        data: {
                            // formData1: $("#schedule_form").serialize(),
                            name: $("#patient_name").val(),
                            email: $("#patient_email").val(),
                            contact: $("#patient_contact").val(),
                            doctor_id: $("#doctor_id").val(),
                            time: time,
                            date: date,
                            shift: shift,
                            avg: avg,
                            action: "appointmentBookings"
                        },
                        success: function(response) {
                            let data = JSON.parse(response);

                            if (data.patient_exist) {
                                alert(data.patient_exist);
                                $("#appointmentModal").modal("hide");
                                return false;
                            }

                            if (data.patient_notFound) {
                                alert(data.patient_notFound);
                                $("#appointmentModal").modal("hide");
                                return false;
                            }


                            $("#appointmentModal").modal("hide");

                            let form = $('<form action="profile.php?status=payment" method="POST">' +
                                '<input type="hidden" name="json_data" value=\'' + JSON.stringify(data) + '\'>' +
                                '</form>');

                            $('body').append(form);
                            form.submit();

                            // console.log(data);

                        }
                    });
                    return false;
                }
            });

        });

    });
</script>