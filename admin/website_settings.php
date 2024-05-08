<!-- header -->
<?php include "inc/header.php"; ?>

<section class="">
    <div class="container">
        <form action="" method="POST" id="setting_form">
            <div class="card shadow-sm my-3" style="min-width:100%;">
                <div class="card-body">
                    <h5 class="fs-5 text-muted">Website Information</h5>
                    <hr />
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="web-name" class="form-label">Website Name</label>
                                <input type="text" class="form-control shadow-none" id="web-name" name="web_name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="web-img" class="form-label">Logo Upload</label>
                                <input type="file" class="form-control shadow-none" id="web-img" name="web_img">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="web-url" class="form-label">Website URL / Domain</label>
                                <input type="text" class="form-control shadow-none" id="web-url" name="web_url">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <img src="" class="img-fluid" id="web-logo" width="100px" height="80px" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="web-copyright" class="form-label">Copyright Title</label>
                                <input type="text" class="form-control shadow-none" id="web-copyright" name="web_copyright">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="web-favicon" class="form-label">Favicon Upload</label>
                                <input type="file" class="form-control shadow-none" id="web-favicon" name="web_favicon">
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="card shadow-sm my-3" style="min-width:100%;">
                <div class="card-body">
                    <div class="">
                        <h5 class="fs-5 text-muted">Contact Information</h5>
                        <hr />
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="web-email-1" class="form-label">Email Address 1</label>
                                    <input type="email" class="form-control shadow-none" id="web-email1" name="web_email1">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="web-email-2" class="form-label">Email Address 2</label>
                                    <input type="email" class="form-control shadow-none" id="web-email2" name="web_email2">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="web-phone-1" class="form-label">Phone (1)</label>
                                    <input type="number" class="form-control shadow-none" id="web-phone1" name="web_contact1">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="web-phone-2" class="form-label">Phone (2)</label>
                                    <input type="number" class="form-control shadow-none" id="web-phone2" name="web_contact2">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="web-fax" class="form-label">FAX</label>
                                    <input type="text" class="form-control shadow-none" id="web-fax" name="web_fax">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="web-whatsapp" class="form-label">Whatsapp Number</label>
                                    <input type="number" class="form-control shadow-none" id="web-whatsapp" name="web_whatsapp">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="web-address" class="form-label">Address</label>
                                    <textarea class="form-control shadow-none" rows="3" id="web-address" name="web_address"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="mb-4 d-md-flex justify-content-md-end">
                <input type="submit" class="btn btn-primary shadow-none" name="settings" id="web-settings" value="Save Setting" />
            </div>
        </form>
    </div>
</section>

<!-- footer -->
<?php include "inc/footer.php"; ?>

<script>
    function loadSettings() {
        $.ajax({
            url: "ajax/settings_crud.php",
            type: "POST",
            data: {
                status: "loadSettingsData"
            },
            success: function(datum) {
                let data = JSON.parse(datum);
                $("#web-name").val(data.name);
                $("#web-url").val(data.url);
                // $("#web-img").val(data.logo);
                $("#web-copyright").val(data.copyright);
                // $("#web-favicon").val(data.favicon);
                $("#web-email1").val(data.femail);
                $("#web-email2").val(data.semail);
                $("#web-phone1").val(data.fcontact);
                $("#web-phone2").val(data.scontact);
                $("#web-fax").val(data.fax);
                $("#web-whatsapp").val(data.whatsapp);
                $("#web-address").val(data.address);
                $("#web-logo").attr("src", "images/settings/"+data.logo);
            }
        });
    }

    loadSettings();

    $("#setting_form").on("submit", function(e) {
        e.preventDefault();
        let formData = new FormData(this);

        $.ajax({
            url: "ajax/settings_crud.php",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response == 1) {
                    alert("Setting update successfully");
                } else {
                    alert(response);
                    console.log(response);
                }
            }
        });

    });
</script>