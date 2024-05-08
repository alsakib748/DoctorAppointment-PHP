<!-- header -->
<?php include "inc/header.php"; ?>

<section class="">

    <div class="container">
        <div class="card shadow-sm  pb-5" style="min-width:100%;min-height: 576px;">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="fs-5 text-muted">Admin</h5>
                    <a href="#" class="text-decoration-none btn btn-primary shadow-none mb-4" data-bs-toggle="modal" data-bs-target="#addAdmin">Add Admin</a>
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

                <div class="mt-2" id="show-admin">

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

<!--  Add Admin Modal -->
<div class="modal modal-lg fade" id="addAdmin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addAdminLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addAdminLabel">Add Admin</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST" id="admin_form">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="admin-name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="admin-name" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="admin-email" class="form-label">Email</label>
                            <input type="text" class="form-control" name="email" id="admin-email" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="admin-pass" class="form-label">Password</label>
                            <input type="password" class="form-control" name="pass" id="admin-pass" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="admin-profile" class="form-label">Profile</label>
                            <input type="file" class="form-control" name="profile" id="admin-profile" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="admin-number" class="form-label">Number</label>
                            <input type="number" class="form-control" name="contact" id="admin-number" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="admin-role" class="form-label">Role</label>
                            <select class="form-select" name="role" id="admin-role">
                                <option selected>Select Role</option>
                                <option value="Admin">Admin</option>
                                <option value="SubAdmin">SubAdmin</option>
                                <option value="Editor">Editor</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="add_admin" id="add-admin">Add Admin</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--  Edit Admin Modal -->
<div class="modal modal-lg fade" id="editAdmin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editAdminLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 fw-bold" id="editAdminLabel">Edit Admin</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST" id="edit_admin_form">
                <div class="modal-body">

                    <div class="row">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="col-md-12 mb-3">
                                    <label for="edit-admin-name" class="form-label fw-semibold">Name</label>
                                    <input type="text" class="form-control" name="ename" id="edit-admin-name" />
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="edit-admin-email" class="form-label fw-semibold">Email</label>
                                    <input type="text" class="form-control" name="eemail" id="edit-admin-email" />
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="edit-admin-pass" class="form-label fw-semibold">Password</label>
                                    <input type="password" class="form-control" name="epass" id="edit-admin-pass" />
                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="col-md-12 mb-3">
                                    <img src="" class="img-fluid w-100" style="height: 240px;" id="admin_profile_image" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit-admin-number" class="form-label fw-semibold">Number</label>
                            <input type="number" class="form-control" name="econtact" id="edit-admin-number" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit-admin-profile" class="form-label fw-semibold">Profile</label>
                            <input type="file" class="form-control" name="eprofile" id="edit-admin-profile" />
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="edit-admin-role" class="form-label fw-semibold">Role</label>
                            <select class="form-select" name="erole" id="edit-admin-role">
                                <option selected>Select Role</option>
                                <option value="Admin">Admin</option>
                                <option value="SubAdmin">SubAdmin</option>
                                <option value="Editor">Editor</option>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="update_id" id="update-id" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="update_admin" id="update-admin">Update Admin</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- footer -->
<?php include "inc/footer.php"; ?>

<script>
    // Todo: Jquery Start
    $(document).ready(function() {

        // Todo: load admin data
        function loadAdmin() {
            $.ajax({
                url: "ajax/admin_crud.php",
                type: "POST",
                data: {
                    status: "loadAdminData"
                },
                success: function(data) {
                    $("#show-admin").html(data);
                    // console.log(data);
                }
            });
        }

        loadAdmin();

        // Todo: insert admin form data

        $("#admin_form").on("submit", function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            $.ajax({
                url: "ajax/admin_crud.php",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data == 1) {
                        $("#addAdmin").modal("hide");
                        $("#admin_form").trigger("reset");
                        alert("Admin insert successfully.");
                        loadAdmin();
                    } else {
                        alert(data);
                        // console.log(data);
                    }

                }
            });
        });

        // todo: change status ajax request
        $(document).on("click", "#admin-status", function() {
            let id = $(this).data("aid");
            let name = $(this).attr("name");
            let status = "";
            if (name == "active") {
                status = 0;
            } else if (name == "inactive") {
                status = 1;
            }
            $.ajax({
                url: "ajax/admin_crud.php",
                type: "POST",
                data: {
                    uid: id,
                    status: status,
                    operation: "updateStatus"
                },
                success: function(data) {
                    if (data == 1) {
                        alert("Status change successfully.");
                        loadAdmin();
                    } else {
                        alert(data);
                        // console.log(data);
                    }
                }
            });
        });

        // Todo: edit admin data fetch ajax request

        $(document).on("click", ".edit-admin", function(e) {
            e.preventDefault();
            let id = $(this).data("aeid");
            $.ajax({
                url: "ajax/admin_crud.php",
                type: "POST",
                data: {
                    id: id,
                    operation: "editAdminData"
                },
                success: function(datum) {
                    let data = JSON.parse(datum);
                    // console.log(data);
                    $("#update-id").val(data.id);
                    $("#edit-admin-name").val(data.name);
                    $("#edit-admin-email").val(data.email);
                    $("#admin_profile_image").attr("src", "images/admin/" + data.profile);
                    // $("#admin-profile").val(data.profile);
                    $("#edit-admin-number").val(data.contact);
                    $("#edit-admin-role").val(data.role);
                }
            });
        });

        // Todo: update admin data 

        $("#edit_admin_form").on("submit",function(e){
            e.preventDefault();
            let formData = new FormData(this);

            $.ajax({
                url: "ajax/admin_crud.php",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(data){
                    if(data == 1){
                        $("#editAdmin").modal("hide");
                        $("#edit_admin_form").trigger("reset");
                        alert("Admin update successfully.");
                        loadAdmin();
                    }else{
                        alert(data);
                        // console.log(data);
                    }
                }
            });
        });

        // Todo: Delete admin data ajax request
        $(document).on("click",".delete-admin",function(e){
            e.preventDefault();
            let id = $(this).data("adid");
            if(confirm("Are you sure want to delete this admin??")){
                $.ajax({
                    url: "ajax/admin_crud.php",
                    type: "POST",
                    data: {
                        id: id,
                        status: "deleteAdmin"
                    },
                    success: function(data){
                        if(data == 1){
                            alert("Admin delete successfully.");
                            loadAdmin();
                        }else{
                            alert(data);
                            // console.log(data);
                        }
                    }
                });
            }    
        });

    });
    // Todo: Jquery End
</script>