<?php 

include "../inc/db.php";

date_default_timezone_set("Asia/Dhaka");

if(isset($_POST["action"]) && $_POST["action"] == "todayAppointmentsData"){
    $sql = "SELECT `users`.`name`,`users`.`email`,`users`.`contact`,`appointments`.`apt_no`,`appointments`.`apt_date`,`appointments`.`status` FROM `appointments` INNER JOIN `users` ON `appointments`.`patient_id` = `users`.`id`  WHERE `apt_date` = CURDATE() AND `appointments`.`status` = 'Booked' ";
    $result = mysqli_query($con,$sql);
    $output = "";
    if(mysqli_num_rows($result) > 0){
        $output .= "<table class='table table-striped table-light table-hover table-bordered'>
        <thead>
            <tr>
                <th class='text-muted' scope='col'>APT. NO</th>
                <th class='text-muted' scope='col'>APT. DATE</th>
                <th class='text-muted' scope='col'>PATIENT NAME</th>
                <th class='text-muted' scope='col'>EMAIL</th>
                <th class='text-muted' scope='col'>PHONE</th>
                <th class='text-muted' scope='col'>STATUS</th>
                <th class='text-muted' scope='col'>ACTION</th>
            </tr>
        </thead>
        <tbody>";
        while($row = mysqli_fetch_array($result)){
            $output .= "<tr>
            <td class='text-muted'>{$row['apt_no']}</td>
            <td class='text-muted'>{$row['apt_date']}</td>
            <td class='text-muted'>{$row['name']}</td>
            <td class='text-muted'>{$row['email']}</td>
            <td class='text-muted'>{$row['contact']}</td>
            <td><span class='badge text-bg-primary mt-1'>{$row['status']}</span></td>
            <td>
                <a href='view_appointment.php?apt={$row['apt_no']}' class='text-decoration-none btn btn-sm btn-info shadow-none text-light'>
                    <i class='fa-solid fa-eye'></i> View
                </a>
            </td>
            </tr>";
        }
        $output .= "</tbody>
        </table>";

        echo $output;
    }else{
        echo "<h6 class='alert alert-danger text-center'>Today not found any appointments</h6>";
    }    

}

if(isset($_POST["select_apt"]) && isset($_POST["filter_date"])){
    $apt_date = $_POST["filter_date"];
    $sql = "SELECT `users`.`name`,`users`.`email`,`users`.`contact`,`appointments`.`apt_no`,`appointments`.`apt_date`,`appointments`.`status` FROM `appointments` INNER JOIN `users` ON `appointments`.`patient_id` = `users`.`id`  WHERE `apt_date` = '{$apt_date}' AND `appointments`.`status` = 'Booked' ";
    $result = mysqli_query($con,$sql);
    $output = "";
    if(mysqli_num_rows($result) > 0){
        $output .= "<table class='table table-striped table-light table-hover table-bordered'>
        <thead>
            <tr>
                <th class='text-muted' scope='col'>APT. NO</th>
                <th class='text-muted' scope='col'>APT. DATE</th>
                <th class='text-muted' scope='col'>PATIENT NAME</th>
                <th class='text-muted' scope='col'>EMAIL</th>
                <th class='text-muted' scope='col'>PHONE</th>
                <th class='text-muted' scope='col'>STATUS</th>
                <th class='text-muted' scope='col'>ACTION</th>
            </tr>
        </thead>
        <tbody>";
        while($row = mysqli_fetch_array($result)){
            $output .= "<tr>
            <td class='text-muted'>{$row['apt_no']}</td>
            <td class='text-muted'>{$row['apt_date']}</td>
            <td class='text-muted'>{$row['name']}</td>
            <td class='text-muted'>{$row['email']}</td>
            <td class='text-muted'>{$row['contact']}</td>
            <td><span class='badge text-bg-primary mt-1'>{$row['status']}</span></td>
            <td>
                <a href='view_appointment.php?apt={$row['apt_no']}' class='text-decoration-none btn btn-sm btn-info shadow-none text-light'>
                    <i class='fa-solid fa-eye'></i> View
                </a>
            </td>
            </tr>";
        }
        $output .= "</tbody>
        </table>";

        echo $output;
    }else{
        echo "<h6 class='alert alert-danger text-center'>This date not found any appointments </h6>";
    }    

}

?>