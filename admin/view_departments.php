<!-- header -->
<?php include "inc/header.php"; ?>

<section class="">

    <div class="container">
        <div class="card shadow-sm" style="min-width:100%;min-height: 576px;">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="fs-5 text-muted">Departments List</h5>
                    <a href="add_department.php" class="text-decoration-none btn btn-primary shadow-none mb-4">Add Department</a>
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

                <div class="mt-2" id="show-table-data">



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

    <!-- Department Edit Modal -->
    <div class="modal fade" id="departmentEditModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Department</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" id="dept_edit_form">
                    <div class="modal-body">
                        <div class="mb-2">
                            <label for="edit-dept-name" class="form-label">Department New Name</label>
                            <input type="text" class="form-control shadow-none" name="edit_dept_name" id="edit-dept-name">
                        </div>
                        <div class="mb-2">
                            <img src="images/departments/" class="img-fluid w-50 h-25" id="show_image" /> <br />
                            <label for="edit-dept-name" class="form-label">Department New Avatar</label>
                            <input type="file" class="form-control shadow-none" name="edit_dept_image" id="edit-dept-image">
                        </div>
                        <input type="hidden" name="edit_dept_id" id="edit_dept_id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit"  class="btn btn-primary">Update</button>
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

        // Show the department
        function loadDepartments() {
            $.ajax({
                url: "ajax/departments_crud.php",
                type: "GET",
                data: "showDepartments",
                success: function(data) {
                    $("#show-table-data").html(data);
                }
            });
        }

        loadDepartments();

        // retrieve edit id data
        $(document).on("click", "#edit-department", function(e) {
            e.preventDefault();

            let id = $(this).data("eid");

            $.ajax({
                url: "ajax/departments_crud.php",
                method: "POST",
                data: {
                    id: id,
                    edit: "editDepartmentData"
                },
                success: function(data) {
                    let info = JSON.parse(data);
                    // let info = jQuery.parseJSON(data);
                    $("#edit_dept_id").val(info.id);
                    $("#edit-dept-name").val(info.name);
                    let avatar_name = info.avatar;
                    $("#show_image").attr("src", "images/departments/" + avatar_name);
                }
            });
        });

        /// update department js
        $(document).on("submit","#dept_edit_form",function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            $.ajax({
                url: "ajax/departments_crud.php",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    loadDepartments();
                    $("#departmentEditModal").modal("hide");
                    alert(data);
                    // console.log(data);
                }
            });
        });

    $(document).on("click","#delete_department",function(e){
        e.preventDefault();
        if(confirm("Are you sure want to delete this department ??")){
            let id = $(this).data("did");
            $.ajax({
                url: "ajax/departments_crud.php",
                type: "POST",
                data: {
                    id : id,
                    status : "deleteDepartment"
                },
                success: function(data){
                    console.log(data);
                    loadDepartments();
                    alert(data);
                }
            });
        }
    });

    });

</script>