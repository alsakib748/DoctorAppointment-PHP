<!-- header -->
<?php include "inc/header.php"; ?>

<section class="">

    <div class="container">
        <div class="card shadow-sm my-3" style="min-width:100%;">
            <div class="card-body">
                <div class="">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="fs-5 text-muted">Add Department</h5>
                        <a href="view_departments.php" name="department" class="text-decoration-none btn btn-danger shadow-none mb-4">View Department</a>
                    </div>
                    <form action="" method="POST" id="dept_form" enctype="multipart/form-data">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="dept-name" class="form-label">Department Name *</label>
                                    <input type="text" class="form-control shadow-none" id="dept-name" name="dept_name">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="dept-image" class="form-label">Upload Department Image</label>
                                    <input type="file" class="form-control shadow-none" id="dept-image" name="dept_image">
                                </div>
                            </div>

                            <div class="d-md-flex align-items-md-center justify-content-md-end">
                                <div class="shadow">
                                    <input type="submit" id="dept-submit" name="dept_submit" class="btn btn-primary shadow-none" value="Add Department">
                                </div>
                            </div>

                        </div>
                    </form>
                </div>

            </div>

</section>

<!-- footer -->
<?php include "inc/footer.php"; ?>

<script>
    $(document).ready(function() {

        $("#dept_form").on("submit", function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                url: "ajax/departments_crud.php",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    $("#dept_form").trigger("reset");
                    if(data == 1){
                        // loadDepartments();
                        // window.location = "view_departments.php";
                        alert("Data Successfully Inserted");
                    }
                    else{
                        alert(data);
                    }
                    console.log(data);
                }
            });

        });

    });
</script>