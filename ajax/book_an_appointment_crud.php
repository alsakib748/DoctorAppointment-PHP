<?php
include "../admin/inc/db.php";

date_default_timezone_set('Asia/Dhaka');

if (isset($_POST["action"]) && $_POST["action"] == "loadBookingDetails") {
    $id = $_POST['id'];

    $row = array();
    $feedback = array();

    //Todo: Doctor details fetch query
    $sql = "SELECT * FROM `doctors` WHERE `id` = $id";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row["doctor_info"] = mysqli_fetch_assoc($result);
        echo json_encode($row);
    } else {
        $feedback["not_found"] = array("blank" => "No Doctor found for this Link");
    }
    if (!empty($feedback)) {
        echo json_encode($feedback);
        exit;
    }

    // if (!empty($row)) {
    //     echo json_encode($row);
    //     exit;
    // }
}

if ((isset($_POST["action"]) && $_POST["action"] == "loadTimingDetailsShift")) {

    $doctor_id = $_POST['doctor_id'];

    $output = "";

    $day = "SELECT DISTINCT day  FROM `timings`  WHERE doctor_id = 16";

    $dayResult = mysqli_query($con, $day);

    // $output .= "<div class='col-md-12'>";

    while ($day = mysqli_fetch_assoc($dayResult)) {

        $current_day = $day['day'];

        // Todo: get appointment date start
        $todayDay = date('l');
        $today = date('Y-m-d');
        $nextSaturday = date('Y-m-d', strtotime('next Saturday'));
        $nextSunday = date('Y-m-d', strtotime('next Sunday'));
        $nextMonday = date('Y-m-d', strtotime('next Monday'));
        $nextTuesday = date('Y-m-d', strtotime('next Tuesday'));
        $nextWednesday = date('Y-m-d', strtotime('next Wednesday'));
        $nextThursday = date('Y-m-d', strtotime('next Thursday'));
        $nextFriday = date('Y-m-d', strtotime('next Friday'));

        $date = "";

        if ($current_day == $todayDay) {
            $date = $today;
        } else if ($current_day == "Saturday") {
            $date = $nextSaturday;
        } else if ($current_day == "Sunday") {
            $date = $nextSunday;
        } else if ($current_day == "Monday") {
            $date = $nextMonday;
        } else if ($current_day == "Tuesday") {
            $date = $nextTuesday;
        } else if ($current_day == "Wednesday") {
            $date = $nextWednesday;
        } else if ($current_day == "Thursday") {
            $date = $nextThursday;
        } else if ($current_day == "Friday") {
            $date = $nextFriday;
        }

        $date = date('d - m - Y', strtotime($date));
        
        $timingSql1 = "SELECT * FROM `timings` WHERE `day` = '{$current_day}' AND `shift` = 'Shift 1' AND `doctor_id` = $doctor_id ";

        $timingSqlResult1 = mysqli_query($con, $timingSql1);

        $timingSql2 = "SELECT * FROM `timings` WHERE `day` = '{$current_day}' AND `shift` = 'Shift 2' AND `doctor_id` = $doctor_id ";

        $timingSqlResult2 = mysqli_query($con, $timingSql2);

        if (!$current_day) {

            echo '
                <div class="alert alert-warning text-center">This doctor is not available now !</div>
            ';

            return;

        } else {
            $output .= "
            <div class='col-md-6'>
            <div class='card bg-white shadow mb-4' style='width: 100%;'>
            
                <div class='card-body p-2 m-1'>
                    <div class='row pb-2  border-bottom'>
                        <div class='col-md-6'>
                            <h5 class=''><i class='fa-regular fa-calendar-days'> {$date}</i> </h5>
                        </div>
                        <div class='col-md-6 d-flex align-items-start justify-content-end'>
                            <button class='btn btn-secondary shadow-none rounded'>{$current_day}</button>
                        </div>
                    </div> ";
        }    

            if (mysqli_num_rows($timingSqlResult1) > 0) {

                $i = 1;
                while ($row1 = mysqli_fetch_assoc($timingSqlResult1)) {

                    $start_time = strtoupper($row1['start_time']);
                    $end_time = strtoupper($row1['end_time']);

                    // Convert time strings to Unix timestamps
                    $start_timestamp = strtotime($start_time);
                    $end_timestamp = strtotime($end_time);

                    // Calculate the difference in seconds
                    $time_diff_seconds = $end_timestamp - $start_timestamp;

                    // Convert seconds to minutes
                    $time_diff_minutes = round($time_diff_seconds / 60); // round() is used for rounding off the result

                    // Todo: get appointment date start
                    // $todayDay = date('l');
                    // $today = date('Y-m-d');
                    // $nextSaturday = date('Y-m-d', strtotime('next Saturday'));
                    // $nextSunday = date('Y-m-d', strtotime('next Sunday'));
                    // $nextMonday = date('Y-m-d', strtotime('next Monday'));
                    // $nextTuesday = date('Y-m-d', strtotime('next Tuesday'));
                    // $nextWednesday = date('Y-m-d', strtotime('next Wednesday'));
                    // $nextThursday = date('Y-m-d', strtotime('next Thursday'));
                    // $nextFriday = date('Y-m-d', strtotime('next Friday'));

                    // $date = "";

                    // if ($row1['day'] == $todayDay) {
                    //     $date = $today;
                    // } else if ($row1['day'] == "Saturday") {
                    //     $date = $nextSaturday;
                    // } else if ($row1['day'] == "Sunday") {
                    //     $date = $nextSunday;
                    // } else if ($row1['day'] == "Monday") {
                    //     $date = $nextMonday;
                    // } else if ($row1['day'] == "Tuesday") {
                    //     $date = $nextTuesday;
                    // } else if ($row1['day'] == "Wednesday") {
                    //     $date = $nextWednesday;
                    // } else if ($row1['day'] == "Thursday") {
                    //     $date = $nextThursday;
                    // } else if ($row1['day'] == "Friday") {
                    //     $date = $nextFriday;
                    // }

                    // Todo: get appointment date end

                    
                    $totalAppointment = ($time_diff_minutes / $row1['avg_time']);

                    $output .= "
                        <h4 class='my-3 border-bottom'>Shift 1</h4>
                        <div class='time-schedule p-2 border mb-2 '>
                            <h5 class='mb-2'>{$start_time} - {$end_time}</h5>
                                <div class='row booking-schedule'>
                ";
                    // $start_timestamp;
                    $start_timestamp = strtotime($start_time);
                    
                    for ($i = 0; $i < $totalAppointment; $i++) {
                        
                        // Format the new timestamp back into a readable time format
                        $appointment_time = date("h:i A", $start_timestamp);
                        $randomId = bin2hex(random_bytes(3));

                        //Todo: user request schedule has anyone scheduled before
                        $checkSchedule = mysqli_query($con, "SELECT * FROM `appointments` WHERE `apt_date`='{$date}' AND `start_time` ='{$appointment_time}' AND `status` = 'Booked' ");

                        if (mysqli_num_rows($checkSchedule) > 0) {
                            $output .= "
                            <div class='col-xl-3 col-md-3 col-sm-3 d-flex align-items-center justify-content-center my-2'>
                                <div class='badge text-bg-warning text-center'>
                                    <label class='form-check-label my-1' for='{$row1['day']}{$randomId}' style='text-decoration: line-through;'>{$appointment_time}</label>
                                </div>
                            </div>
                            ";
                        } else {
                            $output .= "
                            <div class='col-xl-3 col-md-3 col-sm-3 d-flex align-items-center justify-content-center my-2'>
                            <div class='badge text-bg-info text-center' style='background-color: #146EBE !important;color:white !important;'>
                                <input type='radio' class='form-check-input my-1' name='confirm_booking' id='{$row1['day']}{$randomId}' value='{$appointment_time}' data-date='{$date}' data-avg='{$row1['avg_time']}' data-shift='{$row1['shift']}'  data-bs-toggle='modal' data-bs-target='#appointmentModal' />
                                <label class='form-check-label my-1' for='{$row1['day']}{$randomId}'>{$appointment_time}</label>
                            </div>
                            </div>
                            ";
                        }

                        // Add minutes to the timestamp
                        $start_timestamp = $start_timestamp + ($row1["avg_time"] * 60); // Convert minutes to seconds

                    }
                    $output .= "     
                    </div>
                                
                    </div>

                        <div class='d-flex align-items-center justify-content-evenly'>
                                <div class='d-flex align-items-center justify-content-center'>
                                    <div class='rounded me-1' style='width:20px;height:20px;background-color: #146EBE !important;border-radius:50%;'></div> <span>Available</span>
                                </div>
    
                                <div class='d-flex align-items-center justify-content-center'>
                                    <div class='rounded me-1 bg-warning' style='width:20px;height:20px;'></div> <span>Not Available</span>
                                </div>
                        </div>
    
                ";
                    $i++;
                }
                $output .= "</form>";

            } // todo: first shift condition end

            if (mysqli_num_rows($timingSqlResult2) > 0) {

                $i = 1;
                while ($row2 = mysqli_fetch_assoc($timingSqlResult2)) {

                    $start_time = strtoupper($row2['start_time']);
                    $end_time = strtoupper($row2['end_time']);

                    // Convert time strings to Unix timestamps
                    $start_timestamp = strtotime($start_time);
                    $end_timestamp = strtotime($end_time);

                    // Calculate the difference in seconds
                    $time_diff_seconds = $end_timestamp - $start_timestamp;

                    // Convert seconds to minutes
                    $time_diff_minutes = round($time_diff_seconds / 60); // round() is used for rounding off the result

                    // Todo: get appointment date start
                    // $todayDay = date('l');
                    // $today = date('Y-m-d');
                    // $nextSaturday = date('Y-m-d', strtotime('next Saturday'));
                    // $nextSunday = date('Y-m-d', strtotime('next Sunday'));
                    // $nextMonday = date('Y-m-d', strtotime('next Monday'));
                    // $nextTuesday = date('Y-m-d', strtotime('next Tuesday'));
                    // $nextWednesday = date('Y-m-d', strtotime('next Wednesday'));
                    // $nextThursday = date('Y-m-d', strtotime('next Thursday'));
                    // $nextFriday = date('Y-m-d', strtotime('next Friday'));

                    // $date = "";

                    // if ($row2['day'] == $todayDay) {
                    //     $date = $today;
                    // } else if ($row2['day'] == "Saturday") {
                    //     $date = $nextSaturday;
                    // } else if ($row2['day'] == "Sunday") {
                    //     $date = $nextSunday;
                    // } else if ($row2['day'] == "Monday") {
                    //     $date = $nextMonday;
                    // } else if ($row2['day'] == "Tuesday") {
                    //     $date = $nextTuesday;
                    // } else if ($row2['day'] == "Wednesday") {
                    //     $date = $nextWednesday;
                    // } else if ($row2['day'] == "Thursday") {
                    //     $date = $nextThursday;
                    // } else if ($row2['day'] == "Friday") {
                    //     $date = $nextFriday;
                    // }

                    // Todo: get appointment date end

                    $totalAppointment = ($time_diff_minutes / $row2['avg_time']);
                    $output .= "
                        <h4 class='my-3 border-bottom'>Shift 2</h4>
                        <div class='time-schedule p-2 border mb-2 '>
                            <h5 class='mb-2'>{$start_time} - {$end_time}</h5>
                                <div class='row booking-schedule'>
                ";
                    // $start_timestamp;
                    $start_timestamp = strtotime($start_time);
                    for ($i = 0; $i < $totalAppointment; $i++) {

                        // Format the new timestamp back into a readable time format
                        $appointment_time = date("h:i A", $start_timestamp);
                        $randomId = bin2hex(random_bytes(3));

                        //Todo: user request schedule has anyone scheduled before
                        $checkSchedule = mysqli_query($con, "SELECT * FROM `appointments` WHERE `apt_date`='{$date}' AND `start_time` ='{$appointment_time}' AND `status` = 'Booked' ");

                        if (mysqli_num_rows($checkSchedule) > 0) {
                            $output .= "
                            <div class='col-xl-3 col-md-3 col-sm-3 d-flex align-items-center justify-content-center my-2'>
                                <div class='badge text-bg-warning text-center'>
                                    <label class='form-check-label my-1' for='{$row2['day']}{$randomId}' style='text-decoration: line-through;'>{$appointment_time}</label>
                                </div>
                            </div>
                            ";
                        } else {
                            $output .= "
                            <div class='col-xl-3 col-md-3 col-sm-3 d-flex align-items-center justify-content-center my-2'>
                            <div class='badge text-bg-info text-center' style='background-color: #146EBE !important;color:white !important;'>
                                <input type='radio' class='form-check-input my-1' name='confirm_booking' id='{$row2['day']}{$randomId}' value='{$appointment_time}' data-date='{$date}' data-avg='{$row2['avg_time']}' data-shift='{$row2['shift']}'  data-bs-toggle='modal' data-bs-target='#appointmentModal' />
                                <label class='form-check-label my-1' for='{$row2['day']}{$randomId}'>{$appointment_time}</label>
                            </div>
                            </div>
                            ";
                        }

                        // Add minutes to the timestamp
                        $start_timestamp = $start_timestamp + ($row2["avg_time"] * 60); // Convert minutes to seconds

                    }
                    $output .= "     
                    </div>
                                
                    </div>
    
                            <div class='d-flex align-items-center justify-content-evenly'>
                                <div class='d-flex align-items-center justify-content-center'>
                                    <div class='rounded me-1' style='width:20px;height:20px;background-color: #146EBE !important;border-radius:50%;'></div> <span>Available</span>
                                </div>
    
                                <div class='d-flex align-items-center justify-content-center'>
                                    <div class='rounded me-1 bg-warning' style='width:20px;height:20px;'></div> <span>Not Available</span>
                                </div>
                            </div>
    
                ";
                    $i++;
                }
                $output .= "</form>";

            } // todo: first shift condition end

            $output .= "
                    </div>
                </div>
            </div>
            ";

        

    } // todo: while loop end

    // $output .= "</div>";

    echo $output;

    // var_dump($timingSqlResult1);

    // while ($row = mysqli_fetch_assoc($timingSqlResult1)) {
    //     echo $row['day'];
    // }


    // $timingSql2 = "SELECT * FROM `timings` WHERE `shift` = 'Shift 2' AND `doctor_id` = $doctor_id";

    // $timingSqlResult2 = mysqli_query($con, $timingSql2);


    // todo: Shift 1 Data --------------------------------------

    // if (mysqli_num_rows($timingSqlResult1) > 0) {
    //     $output .= "<h1 class='badge text-bg-dark fs-6 py-3 px-5'>SHIFT 1</h1>
    // ";
    //     $i = 1;
    //     while ($row1 = mysqli_fetch_assoc($timingSqlResult1)) {
    //         $start_time = strtoupper($row1['start_time']);
    //         $end_time = strtoupper($row1['end_time']);

    //         // Convert time strings to Unix timestamps
    //         $start_timestamp = strtotime($start_time);
    //         $end_timestamp = strtotime($end_time);

    //         // Calculate the difference in seconds
    //         $time_diff_seconds = $end_timestamp - $start_timestamp;

    //         // Convert seconds to minutes
    //         $time_diff_minutes = round($time_diff_seconds / 60); // round() is used for rounding off the result

    //         // Todo: get appointment date start
    //         $todayDay = date('l');
    //         $today = date('Y-m-d');
    //         $nextSaturday = date('Y-m-d', strtotime('next Saturday'));
    //         $nextSunday = date('Y-m-d', strtotime('next Sunday'));
    //         $nextMonday = date('Y-m-d', strtotime('next Monday'));
    //         $nextTuesday = date('Y-m-d', strtotime('next Tuesday'));
    //         $nextWednesday = date('Y-m-d', strtotime('next Wednesday'));
    //         $nextThursday = date('Y-m-d', strtotime('next Thursday'));
    //         $nextFriday = date('Y-m-d', strtotime('next Friday'));

    //         $date = "";

    //         if ($row1['day'] == $todayDay) {
    //             $date = $today;
    //         } else if ($row1['day'] == "Saturday") {
    //             $date = $nextSaturday;
    //         } else if ($row1['day'] == "Sunday") {
    //             $date = $nextSunday;
    //         } else if ($row1['day'] == "Monday") {
    //             $date = $nextMonday;
    //         } else if ($row1['day'] == "Tuesday") {
    //             $date = $nextTuesday;
    //         } else if ($row1['day'] == "Wednesday") {
    //             $date = $nextWednesday;
    //         } else if ($row1['day'] == "Thursday") {
    //             $date = $nextThursday;
    //         } else if ($row1['day'] == "Friday") {
    //             $date = $nextFriday;
    //         }

    //         // Todo: get appointment date end

    //         $totalAppointment = ($time_diff_minutes / $row1['avg_time']);
    //         $output .= "
    //     <div class='col-md-12'>
    //     <div class='card bg-white shadow mb-4' style='width: 100%;'>

    //         <div class='card-body p-2 m-1'>
    //             <div class='row pb-2  border-bottom'>
    //                 <div class='col-md-6'>
    //                     <h5 class=''><i class='fa-regular fa-calendar-days'></i> {$date}</h5>
    //                 </div>
    //                 <div class='col-md-6 d-flex align-items-start justify-content-end'>
    //                     <button class='btn btn-secondary shadow-none rounded'>{$row1['day']}</button>
    //                 </div>
    //             </div>
    //             <h4 class='my-3 border-bottom'>Shift 1</h4>
    //             <div class='time-schedule p-2 border mb-2 '>
    //                 <h5 class=''>{$start_time} - {$end_time}</h5>
    //                     <div class='row booking-schedule'>
    //     "; 
    //         $start_timestamp;
    //         for ($i = 0; $i < $totalAppointment; $i++) {
    //             // Add minutes to the timestamp
    //             $start_timestamp = $start_timestamp + ($row1["avg_time"] * 60); // Convert minutes to seconds
    //             // Format the new timestamp back into a readable time format
    //             $appointment_time = date("h:i A", $start_timestamp);
    //             $randomId = bin2hex(random_bytes(3));

    //             //Todo: user request schedule has anyone scheduled before
    //             $checkSchedule = mysqli_query($con, "SELECT * FROM `appointments` WHERE `apt_date`='{$date}' AND `start_time` ='{$appointment_time}' AND `status` = 'Booked' ");

    //             if (mysqli_num_rows($checkSchedule) > 0) {
    //                 $output .= "
    //                 <div class='col-md-2 mx-1 mb-3'>
    //                     <div class='badge text-bg-warning text-center'>
    //                         <label class='form-check-label my-1' for='{$row1['day']}{$randomId}' style='text-decoration: line-through;'>{$appointment_time}</label>
    //                     </div>
    //                 </div>
    //                 ";
    //             } else {
    //                 $output .= "
    //                 <div class='col-md-2 mx-1 mb-3'>
    //                 <div class='badge text-bg-info text-center'>
    //                     <input type='radio' class='form-check-input my-1' name='confirm_booking' id='{$row1['day']}{$randomId}' value='{$appointment_time}' data-date='{$date}' data-avg='{$row1['avg_time']}' data-shift='{$row1['shift']}'  data-bs-toggle='modal' data-bs-target='#appointmentModal' />
    //                     <label class='form-check-label my-1' for='{$row1['day']}{$randomId}'>{$appointment_time}</label>
    //                 </div>
    //                 </div>
    //                 ";
    //             }

    //         }
    //         $output .= "     
    //         </div>

    //                 </div>

    //                 <div class='d-flex align-items-center justify-content-evenly'>
    //                     <div class='d-flex align-items-center justify-content-center'>
    //                         <div class='rounded me-1 bg-info' style='width:20px;height:20px;'></div> <span>Available</span>
    //                     </div>

    //                     <div class='d-flex align-items-center justify-content-center'>
    //                         <div class='rounded me-1 bg-warning' style='width:20px;height:20px;'></div> <span>Not Available</span>
    //                     </div>
    //                 </div>

    //             </div>

    //         </div>
    //         </div>
    //     ";
    //         $i++;
    //     }
    //     $output .= "</form>";
    // }
    // echo $output;


    // todo: Shift 2 Data --------------------------------------

    // if (isset($_POST["action"]) && $_POST["action"] == "loadTimingDetailsShift2") {
    //     $id = $_POST["id"];
    //     $output = "";

    //     $timingSql2 = "SELECT * FROM `timings` WHERE `shift`='shift 2' AND `doctor_id` = $id";
    //     $timingSqlResult2 = mysqli_query($con, $timingSql2);

    //     if (mysqli_num_rows($timingSqlResult2) > 0) {
    //         $output .= "<h1 class='badge text-bg-dark fs-6 py-3 px-5'>SHIFT 2</h1>";
    //         $i = 1;
    //         while ($row1 = mysqli_fetch_assoc($timingSqlResult2)) {
    //             $start_time = strtoupper($row1['start_time']);
    //             $end_time = strtoupper($row1['end_time']);

    //             // Convert time strings to Unix timestamps
    //             $start_timestamp = strtotime($start_time);
    //             $end_timestamp = strtotime($end_time);

    //             // Calculate the difference in seconds
    //             $time_diff_seconds = $end_timestamp - $start_timestamp;

    //             // Convert seconds to minutes
    //             $time_diff_minutes = round($time_diff_seconds / 60); // round() is used for rounding off the result

    //             // Todo: get appointment date start
    //             $todayDay = date('l');
    //             $today = date('Y-m-d');
    //             $nextSaturday = date('Y-m-d', strtotime('next Saturday'));
    //             $nextSunday = date('Y-m-d', strtotime('next Sunday'));
    //             $nextMonday = date('Y-m-d', strtotime('next Monday'));
    //             $nextTuesday = date('Y-m-d', strtotime('next Tuesday'));
    //             $nextWednesday = date('Y-m-d', strtotime('next Wednesday'));
    //             $nextThursday = date('Y-m-d', strtotime('next Thursday'));
    //             $nextFriday = date('Y-m-d', strtotime('next Friday'));

    //             $date = "";

    //             if ($row1['day'] == $todayDay) {
    //                 $date = $today;
    //             } else if ($row1['day'] == "Saturday") {
    //                 $date = $nextSaturday;
    //             } else if ($row1['day'] == "Sunday") {
    //                 $date = $nextSunday;
    //             } else if ($row1['day'] == "Monday") {
    //                 $date = $nextMonday;
    //             } else if ($row1['day'] == "Tuesday") {
    //                 $date = $nextTuesday;
    //             } else if ($row1['day'] == "Wednesday") {
    //                 $date = $nextWednesday;
    //             } else if ($row1['day'] == "Thursday") {
    //                 $date = $nextThursday;
    //             } else if ($row1['day'] == "Friday") {
    //                 $date = $nextFriday;
    //             }

    //             // Todo: get appointment date end
    //             $totalAppointment = ($time_diff_minutes / $row1['avg_time']);
    //             $output .= "
    //         <div class='col-md-12'>
    //         <div class='card bg-white shadow mb-4' style='width: 100%;'>

    //             <div class='card-body p-2 m-1'>
    //                 <div class='row pb-2  border-bottom'>
    //                     <div class='col-md-6'>
    //                         <h5 class=''><i class='fa-regular fa-calendar-days'></i> {$date}</h5>
    //                     </div>
    //                     <div class='col-md-6 d-flex align-items-start justify-content-end'>
    //                         <button class='btn btn-secondary shadow-none rounded'>{$row1['day']}</button>
    //                     </div>
    //                 </div>
    //                 <h4 class='my-3 border-bottom'>Shift 2</h4>
    //                 <div class='time-schedule p-2 border mb-2 '>
    //                     <h5 class=''>{$start_time} - {$end_time}</h5>

    //                         <div class='row booking-schedule'>
    //         ";
    //             $start_timestamp;
    //             for ($i = 0; $i < $totalAppointment; $i++) {
    //                 // Add minutes to the timestamp
    //                 $start_timestamp = $start_timestamp + ($row1["avg_time"] * 60); // Convert minutes to seconds
    //                 // Format the new timestamp back into a readable time format
    //                 $appointment_time = date("h:i A", $start_timestamp);
    //                 $randomId = bin2hex(random_bytes(3));

    //                 //Todo: user request schedule has anyone scheduled before
    //                 $checkSchedule = mysqli_query($con, "SELECT * FROM `appointments` WHERE `apt_date`='{$date}' AND `start_time` ='{$appointment_time}' AND `status` = 'Booked' ");

    //                 if (mysqli_num_rows($checkSchedule) > 0) {
    //                     $output .= "
    //                     <div class='col-md-2 mx-1 mb-3'>
    //                         <div class='badge text-bg-warning text-center'>
    //                             <label class='form-check-label my-1' for='{$row1['day']}{$randomId}' style='text-decoration: line-through;'>{$appointment_time}</label>
    //                         </div>
    //                     </div>
    //                     ";
    //                 } else {
    //                     $output .= "
    //                     <div class='col-md-2 mx-1 mb-3'>
    //                     <div class='badge text-bg-info text-center'>
    //                         <input type='radio' class='form-check-input my-1' name='confirm_booking' id='{$row1['day']}{$randomId}' value='{$appointment_time}' data-date='{$date}' data-avg='{$row1['avg_time']}' data-shift='{$row1['shift']}'  data-bs-toggle='modal' data-bs-target='#appointmentModal' />
    //                         <label class='form-check-label my-1' for='{$row1['day']}{$randomId}'>{$appointment_time}</label>
    //                     </div>
    //                     </div>
    //                     ";
    //                 }

    //             }

    //             $output .= "     
    //             </div>

    //                     </div>

    //                     <div class='d-flex align-items-center justify-content-evenly'>
    //                         <div class='d-flex align-items-center justify-content-center'>
    //                             <div class='rounded me-1 bg-info' style='width:20px;height:20px;'></div> <span>Available</span>
    //                         </div>

    //                         <div class='d-flex align-items-center justify-content-center'>
    //                             <div class='rounded me-1 bg-warning' style='width:20px;height:20px;'></div> <span>Not Available</span>
    //                         </div>
    //                     </div>

    //                 </div>
    //             </div>
    //             </div>
    //         ";
    //             $i++;
    //         }
    //     }
    //     echo $output;
    // }

}
