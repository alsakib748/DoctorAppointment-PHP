<!-- header -->
<?php include "inc/header.php"; ?>

<section class="">

    <div class="container">
        <div class="card shadow-sm" style="min-width:100%;min-height: 576px;">
            <div class="card-body">
                <h5 class="card-title mb-4 text-secondary">Appointments</h5>

                <h6 class="text-secondary">Select type and date to get the appointments lists</h6>


                <form action="" method="POST" class="w-75 d-md-flex justify-content-start mb-4" id="date_to_search">
                    <select class="form-select rounded-end-0 text-muted fw-semibold shadow-none" id="select-apt" name="select_apt">
                        <option value="" selected class="text-muted">Select Appointment Date Type</option>
                        <option value="1" class="text-muted">Appointment Date</option>
                        <option value="2" class="text-muted">Appointment Created Date</option>
                    </select>
                    <input type="date" class="form-control rounded-start-0 rounded-end-0 bg-light shadow-none" name="filter_date" id="filter-date" />
                    <input type="submit" class="btn btn-primary rounded-0 px-3" name="filter_submit" id="filter" value="Filter" />
                    <input type="button" class="btn btn-danger rounded-start-0 px-3" name="filter_reset" id="filter-reset" value="Reset" />
                </form>


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

                <div class="mt-2" id="today_appointments">


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
        // Todo: loadTodayAppointments
        function todayAppointments() {
            $.ajax({
                url: "ajax/appointments_crud.php",
                method: "POST",
                data: {
                    action: "todayAppointmentsData"
                },
                success: function(response) {
                    // console.log(response);
                    $("#today_appointments").html(response);
                }
            });
        }
        todayAppointments();

        $("#date_to_search").on("submit", function(e) {
            e.preventDefault();
            let value = $(this).serialize();
            let option = $("#select-apt").val();
            if (option == 1) {
                $.ajax({
                    url: "ajax/appointments_crud.php",
                    method: "POST",
                    data: value,
                    success: function(response) {
                        // console.log(response);
                        $("#today_appointments").html(response);

                    }
                });
            }
        });

        $("#filter-reset").on("click", function() {
            $("#date_to_search").trigger("reset");
            todayAppointments();
        });

    });
</script>