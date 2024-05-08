<!-- header include -->
<?php
session_start();
if (isset($_SESSION["adminLogin"]) && $_SESSION["adminLogin"] == true) {
    header("Location: admin/dashboard.php");
    exit;
} else if (isset($_SESSION["doctorLogin"]) && $_SESSION["doctorLogin"] == true) {
    header("Location: doctor/dashboard.php");
    exit;
}else if (!isset($_SESSION["userLogin"]) && !$_SESSION["userLogin"] == true) {
    header("Location: index.php");
    exit;
}

?>
<?php require_once("inc/header.php") ?>


<section class="my-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow" style="width: 100%;">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div class="">
                            <h5 class="">Appointment</h5>
                        </div>
                        <div class="">
                            <a href="profile.php?status=appointments" class="btn btn-danger btn-sm text-right">Back</a>
                        </div>

                    </div>
                    <div class="card-body" id="show_appointment_status">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- footer include -->

<?php require_once("inc/footer.php") ?>

<script>

$(document).ready(function(){
    function loadAppointmentsStatus(){
        let apt_id = "<?php echo $_GET["apt_id"]; ?>";

        $.ajax({
            url: "ajax/appointment_status_crud.php",
            method: "POST",
            data: {
                apt_id: apt_id,
                action: "loadAppointmentsStatus"
            },
            success: function(data){
                $("#show_appointment_status").html(data);
                console.log(data);
            }
        });
    }

    loadAppointmentsStatus();
});

</script>
