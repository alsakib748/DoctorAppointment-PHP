<?php 

include "../inc/db.php";

if(isset($_POST["action"]) && $_POST["action"] == "showDoctorListData"){

    $sql = "SELECT * FROM `doctors`";
    $result = mysqli_query($con,$sql);
    $output = "";
    if(mysqli_num_rows($result) > 0){
        $output .= "<table class='table table-striped table-light table-hover table-bordered'>
        <thead>
            <tr>
                <th class='text-muted' scope='col'>DOCTOR NAME</th>
                <th class='text-muted' scope='col'>DOCTOR DEPARTMENT</th>
                <th class='text-muted' scope='col'>DESIGNATION</th>
                <th class='text-muted' scope='col'>SPECIALIZATION</th>
                <th class='text-muted' scope='col'>BOOK APPOINTMENT</th>
            </tr>
        </thead>
        <tbody>";
        while($row = mysqli_fetch_assoc($result)){
            $output .= "<tr>
            <td class='text-muted'>{$row['name']}</td>
            <td class='text-muted'>{$row['department']}</td>
            <td class='text-muted'>{$row['designation']}</td>
            <td class='text-muted'>{$row['specialization']}</td>
            <td><a href='../book_an_appointment.php?id={$row['id']}' target='_blank' class='text-decoration-none btn btn-sm btn-primary shadow-none mt-1'>BOOK APPOINTMENT</a></td>
        </tr>";
        }
        $output .= "</tbody>
        </table>";

        echo $output;
    }else{
        echo "Doctors not exist";
    }    
}

if(isset($_POST["action"]) && $_POST["action"] == "showKeyUpRelatedDoctors"){
    $value = $_POST["value"];
    $sql = "SELECT * FROM `doctors` WHERE `name` LIKE '%$value%' OR `department` LIKE '%$value%' ";
    $result = mysqli_query($con,$sql);
    $output = "";
    if(mysqli_num_rows($result) > 0){
        $output .= "<table class='table table-striped table-light table-hover table-bordered'>
        <thead>
            <tr>
                <th class='text-muted' scope='col'>DOCTOR NAME</th>
                <th class='text-muted' scope='col'>DOCTOR DEPARTMENT</th>
                <th class='text-muted' scope='col'>DESIGNATION</th>
                <th class='text-muted' scope='col'>SPECIALIZATION</th>
                <th class='text-muted' scope='col'>BOOK APPOINTMENT</th>
            </tr>
        </thead>
        <tbody>";
        while($row = mysqli_fetch_assoc($result)){
            $output .= "<tr>
            <td class='text-muted'>{$row['name']}</td>
            <td class='text-muted'>{$row['department']}</td>
            <td class='text-muted'>{$row['designation']}</td>
            <td class='text-muted'>{$row['specialization']}</td>
            <td><a href='../book_an_appointment.php?id={$row['id']}' target='_blank' class='text-decoration-none btn btn-sm btn-primary shadow-none mt-1'>BOOK APPOINTMENT</a></td>
        </tr>";
        }
        $output .= "</tbody>
        </table>";

        echo $output;
    }else{
        echo "<h6 class='alert alert-danger text-center'>Doctors not found</h6>";
    }    
}

?>