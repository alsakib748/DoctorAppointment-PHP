
<?php 

session_start();

include "../admin/inc/db.php";

if(isset($_POST["status"]) && $_POST["status"] == "loadDoctors"){
    $sql = "SELECT * FROM `doctors`";
    $result = mysqli_query($con, $sql);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $booking = "";
            if(isset($_SESSION['userLogin']) && $_SESSION['userLogin'] == true){
                $booking .= "<button type='submit' class='btn btn-sm btn-primary rounded-pill px-3 book-btn'><a href='book_an_appointment.php?id={$row['id']}' class='text-decoration-none text-white'>Book Appointment</a></button>";
            }else{
                $booking .= "<button type='submit' class='btn btn-sm btn-primary rounded-pill px-3 book-btn'><a href='login.php' class='text-decoration-none text-white'>Book Appointment</a></button>";
            }
            echo <<<data
            <div class="col-md-6">
            <div class="card mb-3 bg-white shadow" style="max-width: 540px;border-top: 4px solid rgb(12, 104, 238);">
                <div class="row g-0">
                    <div class="col-md-4 doctor-img">
                        <img src="admin/images/doctors/{$row['profile']}" class="img-fluid w-100 rounded-circle p-2" style="height: 180px;">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <div class="">
                                <h5 class="card-title mb-0">{$row['name']}</h5>
                                <small class="card-text">{$row['specialization']}</small>
                            </div>
                            <hr/>
                            <div class="mb-2">
                                <h5 class="card-title mb-0">Qualifications:</h5>
                                <small class="card-text">{$row['qualification']}</small>
                            </div>
                            <div class="">
                                <button type="submit" class="btn btn-sm btn-primary rounded-pill px-3 read-more-btn"><a href="doctor_details.php?id={$row['id']}" class="text-decoration-none text-white">Read More</a></button>
                                $booking
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            data;
        }
    }else{
        echo "<h6 class='alert alert-warning text-center'><i class='bi bi-exclamation-octagon-fill'></i> No Timings Found</h6>";
    }    
}

if(isset($_POST["status"]) && $_POST["status"] == "showDoctorsBySearch"){
    $value = $_POST["value"];
    
    $sql = "SELECT * FROM `doctors` WHERE `doctors`.`name` LIKE '%{$value}%' OR `doctors`.`designation` LIKE '%{$value}%' OR `doctors`.`specialization` LIKE '%{$value}%' ";
    $result = mysqli_query($con, $sql);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $booking = "";
            if(isset($_SESSION['userLogin']) && $_SESSION['userLogin'] == true){
                $booking .= "<button type='submit' class='btn btn-sm btn-primary rounded-pill px-3'><a href='book_an_appointment.php?id={$row['id']}' class='text-decoration-none text-white'>Book Appointment</a></button>";
            }else{
                $booking .= "<button type='submit' class='btn btn-sm btn-primary rounded-pill px-3'><a href='login.php' class='text-decoration-none text-white'>Book Appointment</a></button>";
            }
            echo <<<data
            <div class="col-md-6">
            <div class="card mb-3 bg-white shadow" style="max-width: 540px;border-top: 4px solid rgb(12, 104, 238);">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="admin/images/doctors/{$row['profile']}" class="img-fluid w-100 rounded-circle p-2" style="height: 180px;">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <div class="">
                                <h5 class="card-title mb-0">{$row['name']}</h5>
                                <small class="card-text">{$row['specialization']}</small>
                            </div>
                            <hr/>
                            <div class="mb-2">
                                <h5 class="card-title mb-0">Qualifications:</h5>
                                <small class="card-text">{$row['qualification']}</small>
                            </div>
                            <div class="">
                                <button type="submit" class="btn btn-sm btn-primary rounded-pill px-3"><a href="doctor_details.php?id={$row['id']}" class="text-decoration-none text-white">Read More</a></button>
                                $booking
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            data;
        }
    }else{
        echo "<h6 class='alert alert-warning text-center'><i class='bi bi-exclamation-octagon-fill'></i> No doctors found for this search query</h6>";
    }    
}

?>