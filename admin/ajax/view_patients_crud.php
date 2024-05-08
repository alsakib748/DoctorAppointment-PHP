<?php 

include "../inc/db.php";

function fetchData($output,$result){
    // $output = "";
    $output .= "
    <table class='table table-striped table-light table-hover table-bordered'>
    <thead>
        <tr>
            <th class='text-muted' scope='col'>Apt. Date</th>
            <th class='text-muted' scope='col'>PATIENT NAME</th>
            <th class='text-muted' scope='col'>EMAIL</th>
            <th class='text-muted' scope='col'>AGE</th>
            <th class='text-muted' scope='col'>PHONE</th>
            <th class='text-muted' scope='col'>ACTION</th>
        </tr>
    </thead>
    <tbody>
    ";
        while($row = mysqli_fetch_array($result)){
                $output .= "
                <tr>
                <td class='text-muted'>{$row['apt_date']}</td>
                <td class='text-muted'>{$row['name']}</td>
                <td class='text-muted'>{$row['email']}</td>
                <td class='text-muted'>{$row['age']}</td>
                <td class='text-muted'>{$row['contact']}</td>
                <td>
                    <a href='view_appointment.php?id={$row['id']}' class='text-decoration-none btn btn-sm btn-info shadow-none text-light'>
                        <i class='fa-solid fa-file-lines'></i> View Appointments
                    </a>
                </td>
                </tr>
                ";
        }

        $output .= "
        </tbody>
        </table>
        ";

        return $output;
}

// Todo: Show all patients data
if(isset($_POST["action"]) && $_POST["action"] == "viewAllPatientsData"){
    $sql = " SELECT `users`.*,`appointments`.`apt_date`,`appointments`.`status` FROM `users` INNER JOIN `appointments` ON `users`.`id` = `appointments`.`patient_id` WHERE `appointments`.`status` = 'Booked' ";
    $result = mysqli_query($con,$sql);
    $output = "";
    if(mysqli_num_rows($result) > 0){
        $output = fetchData($output,$result);
        echo $output;
    }else{
        echo "<h6 class='alert alert-warning text-center'>Patient's Not Found</h6>";
    }

}

// Todo: show department related doctors after change department
if(isset($_POST["action"]) && $_POST["action"] == "showDepartmentDoctors"){
    $department = $_POST["value"];
    $output = array();
    $result = mysqli_query($con,"SELECT * FROM `doctors` WHERE `department` = '{$department}' AND `active` = '1'");
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            array_push($output,$row);
        }
        echo json_encode($output);
        unset($output);
    }else{
        echo "Doctors Not Found";
    }
}

// Todo: show doctors related patients after filter doctor name
if(isset($_POST["action"]) && $_POST["action"] == "doctorNameRelatedPatients"){
    $doctor_name = $_POST["val"];
    $doctor_id = $_POST["id"];
    $output = "";
    $sql = "SELECT `users`.*,`appointments`.`apt_date`,`appointments`.`status` FROM `users` INNER JOIN `appointments` ON `users`.`id` = `appointments`.`patient_id` WHERE `appointments`.`status` = 'Booked' AND `appointments`.`doctor_id` = $doctor_id ";
    $result = mysqli_query($con,$sql);
    if(mysqli_num_rows($result) > 0){
        $output = fetchData($output,$result);
        echo $output;
    }else{
        echo "<h6 class='alert alert-warning text-center'>Patient's Not Found For Selected Doctor !!</h6>";
    }

}


?>