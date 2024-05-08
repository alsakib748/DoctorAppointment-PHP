<!-- header -->
<?php include "inc/header.php"; ?>

<section class="">

    <div class="container">
        <div class="card shadow-sm my-3" style="min-width:100%;">
            <div class="card-body">
                <div class="">
                    <div class="d-md-flex align-items-md-center justify-content-md-between">
                        <h5 class="fs-5 text-muted">Edit Timings</h5>
                        <a href="timings.php" class="btn btn-danger shadow-none my-1 px-3">Back</a>
                    </div>
                    <hr />
                    <h6 class="fs-6 text-muted">Day: SUNDAY</h6>
                    <h6 class="fs-6 text-muted">Shift: SHIFT_1</h6>
                    <div class="row">
                        
                        <div class="col-md-3">
                            <div class="mb-2">
                                <label for="start_time" class="form-label text-muted fw-semibold">Start Time</label>
                                <input type="time" class="form-control shadow-none bg-light" id="start_time" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-2">
                                <label for="end_time" class="form-label text-muted fw-semibold">End Time</label>
                                <input type="time" class="form-control shadow-none bg-light" id="end_time" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-2">
                                <label for="avg_time" class="form-label text-muted fw-semibold" style="font-size: 0.8rem;">Avg Consultation Time</label>
                                <select class="form-select" aria-label="Default select example" id="avg_time">
                                    <option selected class="text-muted fw-semibold">Avg time</option>
                                    <option value="10">10 Minutes</option>
                                    <option value="15">15 Minutes</option>
                                    <option value="20">20 Minutes</option>
                                    <option value="25">25 Minutes</option>
                                    <option value="30">30 Minutes</option>
                                    <option value="35">35 Minutes</option>
                                    <option value="40">40 Minutes</option>
                                    <option value="45">45 Minutes</option>
                                    <option value="50">50 Minutes</option>
                                    <option value="55">55 Minutes</option>
                                    <option value="60">60 Minutes</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-2">
                                    <label for="" class="form-label mb-4"></label>
                                    <div class="shadow">
                                        <input type="submit" class="btn btn-primary w-100 shadow-none text-light" value="Update" id="add_btn" />
                                    </div>    
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