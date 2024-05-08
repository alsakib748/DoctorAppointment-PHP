<!-- header -->
<?php include "inc/header.php"; ?>

<section class="">

    <div class="container">
        <div class="card shadow-sm my-3" style="min-width:100%;">
            <div class="card-body">
                <div class="">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="fs-5 text-muted">Doctor Timings</h5>
                        <a href="view_doctors.php" name="department" class="text-decoration-none btn btn-danger shadow-none mb-4">Back</a>
                    </div>
                    <?php 
                        if(isset($_GET["id"])){
                            include "inc/db.php";
                            $id = $_GET["id"];
                            $result = mysqli_query($con,"SELECT `name` FROM `doctors` WHERE `id` = {$id} ");
                            $row = mysqli_fetch_assoc($result);
                        }
                    ?>
                    <h5 class="fs-5 text-muted badge text-bg-info">Doctor <span class='text-light'><?php echo $row['name']; ?></span> Timings</h5>
                    <hr />
                    <div class="" id="show_timings">
                        
                    
                    </div>
                </div>

            </div>
        </div>

    </div>

</section>

<!-- footer -->
<?php include "inc/footer.php"; ?>

<script>

$(document).ready(function(){
    
    function loadTimings(){
        let id = "<?php if(isset($_GET["id"])){ echo $_GET["id"]; } ?>";
        // console.log(id);
        $.ajax({
            url: "ajax/view_timings_crud.php",
            method: "POST",
            data: {
                id: id,
                action: "loadTimingsData"
            },    
            success: function(response){
                $("#show_timings").html(response);
                // console.log(response);
            }
        });
    }

    loadTimings();

});

</script>