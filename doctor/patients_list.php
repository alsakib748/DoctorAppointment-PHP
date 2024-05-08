<!-- header -->
<?php include "inc/header.php"; ?>

<section class="">

    <div class="container">
        <div class="card shadow-sm" style="min-width:100%;min-height: 576px;">
            <div class="card-body">
                <h5 class="fs-5 text-muted mb-5">Patients List</h5>

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
                            <input type="text" class="form-control shadow-none" id="search" placeholder="Search By Name" />
                        </form>
                    </div>
                </div>

                <div class="mt-2">

                    <table class='table table-striped table-light table-hover table-bordered'>
                        <thead class="text-center">
                            <tr>
                                <th class='text-muted' scope='col'>Apt. Date</th>
                                <th class='text-muted' scope='col'>PATIENT NAME</th>
                                <th class='text-muted' scope='col'>EMAIL</th>
                                <th class='text-muted' scope='col'>AGE</th>
                                <th class='text-muted' scope='col'>PHONE</th>
                                <th class='text-muted' scope='col'>ACTION</th>
                            </tr>
                        </thead>
                        <tbody class="text-center" id="show_patient_list">

                        </tbody>

                    </table>
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

<!-- footer -->
<?php include "inc/footer.php"; ?>

<script>
    $(document).ready(function() {
        let id = "<?php echo $_SESSION["doctorId"]; ?>"

        function patientList() {
            $.ajax({
                url: "ajax/patient_list_crud.php",
                method: "POST",
                data: {
                    id: id,
                    action: "patientListData"
                },
                success: function(response) {
                    $("#show_patient_list").html(response);
                    // console.log(response);
                }
            });
        }

        patientList();

        $("#search").on("keyup", function() {
            let id = "<?php echo $_SESSION["doctorId"]; ?>"
            let value = $(this).val();
            $.ajax({
                url: "ajax/patient_list_crud.php",
                method: "POST",
                data: {
                    id: id,
                    value: value,
                    action: "searchByNameData"
                },
                success: function(response) {
                    $("#show_patient_list").html(response);
                    // console.log(response);
                }
            });

        });

    });
</script>