<!-- header -->
<?php include "inc/header.php"; ?>

<section class="">

    <div class="container">
        <div class="card shadow-sm" style="min-width:100%;min-height: 576px;">
            <div class="card-body">

                <div class="d-md-flex align-items-md-center justify-content-md-between">
                    <h5 class="card-title mb-4 text-secondary">Appointments</h5>

                    <div class="w-50 d-md-flex justify-content-md-end mb-4">
                        <input type="date" class="form-control rounded-start-0 rounded-end-0 bg-light shadow-none" />
                        <input type="submit" class="btn btn-primary rounded-0 px-3" value="Filter" />
                        <input type="submit" class="btn btn-danger rounded-start-0 px-3" value="Reset" />
                    </div>
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
                        <form class="d-flex align-items-center justify-content-center" method="POST" action="">
                            <label for="search" class="form-label me-2 text-muted fw-semibold mt-1">Search: </label>
                            <input type="text" class="form-control shadow-none" id="searchByName" placeholder="Search By Name" />
                        </form>
                    </div>
                </div>

                <div class="mt-2">
                    <table class='table table-striped table-light table-hover table-bordered'>
                        <thead>
                            <tr>
                                <th class='text-muted' scope='col'>APT. NO</th>
                                <th class='text-muted' scope='col'>APT. DATE</th>
                                <th class='text-muted' scope='col'>PATIENT NAME</th>
                                <th class='text-muted' scope='col'>EMAIL</th>
                                <th class='text-muted' scope='col'>PHONE</th>
                                <th class='text-muted' scope='col'>STATUS</th>
                                <th class='text-muted' scope='col'>ACTION</th>
                            </tr>
                        </thead>
                        
                        <tbody id="todayAppointmentsShow">

                        </tbody>

                    </table>
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

        function loadTodayAppointments() {
            let id = "<?php echo $_SESSION["doctorId"] ? $_SESSION["doctorId"] : ""; ?>";
            if (id != "") {
                $.ajax({
                    url: "ajax/all_appointments_crud.php",
                    method: "POST",
                    data: {
                        id: id,
                        action: "loadTodayAppointmentsData"
                    },
                    success: function(response) {
                        // console.log(response);
                        $("#todayAppointmentsShow").html(response);
                    }
                });
            }
        }
        loadTodayAppointments();

        $("#searchByName").on("keyup",function(e){
            let id = "<?php echo $_SESSION["doctorId"]? $_SESSION["doctorId"] : "";?>";
            let value = $(this).val();
            // console.log(value);
            if (id!= "") {
                $.ajax({
                    url: "ajax/all_appointments_crud.php",
                    method: "POST",
                    data: {
                        id: id,
                        value: value,
                        action: "searchByNameData"
                    },
                    success: function(response) {
                        console.log(response);
                        $("#todayAppointmentsShow").html(response);
                    }
                });
            }
        });

    });
</script>