<?php 

include "../admin/inc/db.php";

if(isset($_POST["action"]) && $_POST["action"] == "loadDeptDoctors"){
    $dept = $_POST["dept"];
    $output = "";
    $sql = "SELECT * FROM `doctors` WHERE `department` = '$dept' ";
    $result = mysqli_query($con,$sql);

    // echo json_encode(mysqli_fetch_assoc($result));
    // die;
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            
            $output .= "
            <div class='col-md-6'>
            <div class='card mb-3 bg-white shadow' style='max-width: 540px;border-top: 4px solid rgb(12, 104, 238);'>
                <div class='row g-0'>
                    <div class='col-md-4'>
                        <img src='admin/images/doctors/{$row['profile']}' class='img-fluid w-100 h-100 rounded-circle p-2'>
                    </div>
                    <div class='col-md-8'>
                        <div class='card-body'>
                            <div class=''>
                                <h5 class='card-title mb-0'>{$row['name']}</h5>
                                <small class='card-text'>{$row['specialization']}</small>
                            </div>
                            <hr/>
                            <div class='mb-2'>
                                <h5 class='card-title mb-0'>Qualifications:</h5>
                                <small class='card-text'>{$row['qualification']}</small>
                            </div>
                            <div class=''>
                                <button type='submit' class='btn btn-sm btn-primary rounded-pill px-3'><a href='doctor_details.php?id={$row['id']}' class='text-decoration-none text-white'>Read More</a></button>
                                <button type='submit' class='btn btn-sm btn-primary rounded-pill px-3'><a href='book_an_appointment.php?id={$row['id']}' class='text-decoration-none text-white'>Book Appointment</a></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            ";
        }
        echo $output;
    }
    else{
        echo "<h5 class='alert alert-warning text-center my-3'>Not found any doctors for this department</h5>";
        exit;
    }
}

?>