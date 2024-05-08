<!-- header -->
<?php include "inc/header.php"; ?>

<section class="">

    <div class="container">
        <div class="card shadow-sm my-3" style="min-width:100%;">
            <div class="card-body">
                    <h5 class="fs-5 text-muted mb-4">Change Your Password</h5>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="current-pass" class="form-label">Current Password *</label>
                                <input type="password" class="form-control shadow-none" id="current-pass">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="new-pass" class="form-label">New Password *</label>
                                <input type="password" class="form-control shadow-none" id="new-pass">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="confirm-pass" class="form-label">Confirm Password *</label>
                                <input type="password" class="form-control shadow-none" id="confirm-pass">
                            </div>
                        </div>
                        <div class="mb-3 d-md-flex justify-content-md-end">
                                <input type="submit" class="btn btn-primary shadow-none" value="Update Password" id="confirm-pass">
                        </div>
                    </div>
            </div>
        </div>

    </div>

</section>

<!-- footer -->
<?php include "inc/footer.php"; ?>