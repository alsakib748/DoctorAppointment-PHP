
<?php 

include "../inc/db.php";

if(isset($_POST["action"]) && $_POST["action"] == "loadTimingsData"){
    $id = $_POST["id"];
    $result = mysqli_query($con,"SELECT * FROM `timings` WHERE `doctor_id` = {$id} ");
    $output = "";
    if(mysqli_num_rows($result) > 0){
        $output .= "<table class='table table-striped table-hover table-bordered table-light'>
        <thead>
            <tr>
                <th scope='col'>DAYS</th>
                <th scope='col'>SHIFTS</th>
                <th scope='col'>START TIME</th>
                <th scope='col'>END TIME</th>
                <th scope='col'>AVG CONSULTATION TIME (IN MINS)</th>
            </tr>
        </thead>
        <tbody>";
        while($row = mysqli_fetch_assoc($result)){
            $output .= "<tr>
            <td>{$row['day']}</td>
            <td>{$row['shift']}</td>
            <td>{$row['start_time']}</td>
            <td>{$row['end_time']}</td>
            <td>{$row['avg_time']}</td>
        </tr>";
        }
        $output .= "</tbody>
        </table>";
        echo $output;
        exit;
    }else{
        echo "<h6 class='alert alert-danger'>Time schedule not found for this doctors !!</h6>";
        exit;
    }
}



?>