<?php 

    include "../admin/inc/db.php";

if(isset($_POST["id"])){
    $id = $_POST["id"];

    // Query to fetch doctor information
    $doctorSql = "SELECT * FROM `doctors` WHERE `id` = $id";
    $doctorResult = mysqli_query($con, $doctorSql);

    // Query to fetch doctor timings
    $timingSql = "SELECT * FROM `timings` WHERE `doctor_id` = $id";
    $timingResult = mysqli_query($con, $timingSql);

    // Associative array to hold the fetched data
    $responseData = array();

    // Check if data exists for both queries
    if(mysqli_num_rows($doctorResult) > 0) {
        // Fetch doctor information and add it to the response data array
        $responseData['doctor_info'] = mysqli_fetch_assoc($doctorResult);
    } else {
        $responseData['doctor_info'] = "Doctor information not found";
    }
    
    if(mysqli_num_rows($timingResult) > 0) {
        // Fetch doctor timings and add it to the response data array
        $responseData['doctor_timings'] = array();
        while ($row = mysqli_fetch_assoc($timingResult)) {
            $responseData['doctor_timings'][] = $row;
        }
    } else {
        $responseData['doctor_timings'] = "Doctor timings not found";
    }

    // Encode the response data into JSON format and send it to the front-end
    echo json_encode($responseData);
}

?>