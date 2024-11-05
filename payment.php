<?php

include 'admin/inc/db.php';

if (isset($_POST['apt_no']) && isset($_POST['amount'])) {

    $apt_no = mysqli_real_escape_string($con, validate($_POST['apt_no']));
    $amount = mysqli_real_escape_string($con, validate($_POST['amount']));

    // echo $apt_no;
    // echo $amount;
    // die;

    $sql = "SELECT * FROM `appointments` WHERE `apt_no` = '{$apt_no}' ";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $apt_id = $row['id'];

        // echo $apt_no;

        $userPatient = mysqli_query($con, "SELECT * FROM `users` INNER JOIN `appointments` ON `users`.`id` = `appointments`.`patient_id` WHERE `apt_no` = '{$apt_no}' ");

        $adminPatient = mysqli_query($con, "SELECT * FROM `admin` INNER JOIN `appointments` ON `admin`.`id` = `appointments`.`admin_id` WHERE `apt_no` = '{$apt_no}' ");

        // echo $apt_id;
        // die;
        // echo print_r( $userPatient );
        // die;

        if (mysqli_num_rows($userPatient) > 0) {
            $userPatientResult = mysqli_fetch_assoc($userPatient);

            // echo $userPatientResult[ 'name' ];
            // echo $userPatientResult[ 'email' ];
            // echo $userPatientResult[ 'contact' ];

            // die;

            $post_data = array();
            $post_data['store_id'] = 'medic65f5ce6be7c07';
            $post_data['store_passwd'] = 'medic65f5ce6be7c07@ssl';
            $post_data['total_amount'] = "{$amount}";
            $post_data['currency'] = 'BDT';
            $post_data['tran_id'] = 'SSLCZ_TEST_' . uniqid();
            $post_data['success_url'] = 'http://localhost/doctorappointment/profile.php?status=appointments';
            $post_data['fail_url'] = 'http://localhost/doctorappointment/profile.php?status=appointments';
            $post_data['cancel_url'] = 'http://localhost/doctorappointment/profile.php?status=appointments';
            # $post_data[ 'multi_card_name' ] = 'mastercard,visacard,amexcard';
            # DISABLE TO DISPLAY ALL AVAILABLE

            # EMI INFO
            $post_data['emi_option'] = '1';
            $post_data['emi_max_inst_option'] = '9';
            $post_data['emi_selected_inst'] = '9';

            # CUSTOMER INFORMATION
            $post_data['cus_name'] = "{$userPatientResult['name']}";
            $post_data['cus_email'] = 'Email';
            $post_data['cus_add1'] = 'Dhaka';
            $post_data['cus_add2'] = 'Dhaka';
            $post_data['cus_city'] = 'Dhaka';
            $post_data['cus_state'] = 'Dhaka';
            $post_data['cus_postcode'] = '1000';
            $post_data['cus_country'] = 'Bangladesh';
            $post_data['cus_phone'] = '01711111111';
            $post_data['cus_fax'] = '01711111111';

            # SHIPMENT INFORMATION
            $post_data['ship_name'] = 'testmedicwpxn';
            $post_data['ship_add1 '] = 'Dhaka';
            $post_data['ship_add2'] = 'Dhaka';
            $post_data['ship_city'] = 'Dhaka';
            $post_data['ship_state'] = 'Dhaka';
            $post_data['ship_postcode'] = '1000';
            $post_data['ship_country'] = 'Bangladesh';

            # OPTIONAL PARAMETERS
            $post_data['value_a'] = "{$apt_no}";
            $post_data['value_b '] = "{$userPatientResult['email']}";
            $post_data['value_c'] = "{$apt_id}";
            $post_data['value_d'] = "{$userPatientResult['contact']}";

            # CART PARAMETERS
            $post_data['cart'] = json_encode(array(
                array('product' => 'DHK TO BRS AC A1', 'amount' => '200.00'),
                array('product' => 'DHK TO BRS AC A2', 'amount' => '200.00'),
                array('product' => 'DHK TO BRS AC A3', 'amount' => '200.00'),
                array('product' => 'DHK TO BRS AC A4', 'amount' => '200.00')
            ));
            $post_data['product_amount'] = '100';
            $post_data['vat'] = '5';
            $post_data['discount_amount'] = '5';
            $post_data['convenience_fee'] = '3';

            # REQUEST SEND TO SSLCOMMERZ
            $direct_api_url = 'https://sandbox.sslcommerz.com/gwprocess/v3/api.php';

            $handle = curl_init();
            curl_setopt($handle, CURLOPT_URL, $direct_api_url);
            curl_setopt($handle, CURLOPT_TIMEOUT, 30);
            curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 30);
            curl_setopt($handle, CURLOPT_POST, 1);
            curl_setopt($handle, CURLOPT_POSTFIELDS, $post_data);
            curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, FALSE);
            # KEEP IT FALSE IF YOU RUN FROM LOCAL PC

            $content = curl_exec($handle);

            $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

            if ($code == 200 && !(curl_errno($handle))) {
                // send_mail($userPatientResult['email'], $aptData, $userPatientResult, $doctorData);
                curl_close($handle);
                $sslcommerzResponse = $content;
            } else {
                curl_close($handle);
                echo 'FAILED TO CONNECT WITH SSLCOMMERZ API';
                exit;
            }

            # PARSE THE JSON RESPONSE
            $sslcz = json_decode($sslcommerzResponse, true);

            if (isset($sslcz['GatewayPageURL']) && $sslcz['GatewayPageURL'] != '') {
                // send_mail($userPatientResult['email'], $aptData, $userPatientResult, $doctorData);
                # THERE ARE MANY WAYS TO REDIRECT - Javascript, Meta Tag or Php Header Redirect or Other
                # echo "<script>window.location.href = '". $sslcz[ 'GatewayPageURL' ] ."';</script>";
                echo "<meta http-equiv='refresh' content='0;url=" . $sslcz['GatewayPageURL'] . "'>";
                # header( 'Location: '. $sslcz[ 'GatewayPageURL' ] );
                exit;
            } else {
                echo 'JSON Data parsing error!';
            }

            // $paymentStatus = checkPaymentStatus($sslcz['transaction_id']);
            // Implement this function based on your payment gateway's API

            // if ($paymentStatus == 'SUCCESS') {

            //     // todo; Send email

            //     if (!send_mail($userPatientResult['email'], $aptData, $userPatientResult, $doctorData)) {
            //         echo 'Mail send failed';
            //         exit;
            //     } else {
            //         echo 'Mail sent successfully';
            //     }

            // } else {
            //     echo 'Payment failed or not verified.';
            // }

        }

        if (mysqli_num_rows($adminPatient) > 0) {
            $adminPatientResult = mysqli_fetch_assoc($adminPatient);

            // echo $adminPatientResult['name'];
            // echo $adminPatientResult['email'];
            // echo $adminPatientResult['contact'];

            // die;

            $post_data = array();
            $post_data['store_id'] = "medic65f5ce6be7c07";
            $post_data['store_passwd'] = "medic65f5ce6be7c07@ssl";
            $post_data['total_amount'] = "{$amount}";
            $post_data['currency'] = "BDT";
            $post_data['tran_id'] = "SSLCZ_TEST_" . uniqid();
            $post_data['success_url'] = "http://localhost/doctorappointment/profile.php?status=appointments";
            $post_data['fail_url'] = "http://localhost/doctorappointment/profile.php?status=appointments";
            $post_data['cancel_url'] = "http://localhost/doctorappointment/profile.php?status=appointments";
            # $post_data['multi_card_name'] = "mastercard,visacard,amexcard";  # DISABLE TO DISPLAY ALL AVAILABLE

            # EMI INFO
            $post_data['emi_option'] = "1";
            $post_data['emi_max_inst_option'] = "9";
            $post_data['emi_selected_inst'] = "9";

            # CUSTOMER INFORMATION
            $post_data['cus_name'] = "{$adminPatientResult['name']}";
            $post_data['cus_email'] = "Email";
            $post_data['cus_add1'] = "Dhaka";
            $post_data['cus_add2'] = "Dhaka";
            $post_data['cus_city'] = "Dhaka";
            $post_data['cus_state'] = "Dhaka";
            $post_data['cus_postcode'] = "1000";
            $post_data['cus_country'] = "Bangladesh";
            $post_data['cus_phone'] = "01711111111";
            $post_data['cus_fax'] = "01711111111";

            # SHIPMENT INFORMATION
            $post_data['ship_name'] = "testmedicwpxn";
            $post_data['ship_add1 '] = "Dhaka";
            $post_data['ship_add2'] = "Dhaka";
            $post_data['ship_city'] = "Dhaka";
            $post_data['ship_state'] = "Dhaka";
            $post_data['ship_postcode'] = "1000";
            $post_data['ship_country'] = "Bangladesh";

            # OPTIONAL PARAMETERS
            $post_data['value_a'] = "{$apt_no}";
            $post_data['value_b '] = "{$adminPatientResult['email']}";
            $post_data['value_c'] = "{$apt_id}";
            $post_data['value_d'] = "{$adminPatientResult['contact']}";

            # CART PARAMETERS
            $post_data['cart'] = json_encode(array(
                array("product" => "DHK TO BRS AC A1", "amount" => "200.00"),
                array("product" => "DHK TO BRS AC A2", "amount" => "200.00"),
                array("product" => "DHK TO BRS AC A3", "amount" => "200.00"),
                array("product" => "DHK TO BRS AC A4", "amount" => "200.00")
            ));
            $post_data['product_amount'] = "100";
            $post_data['vat'] = "5";
            $post_data['discount_amount'] = "5";
            $post_data['convenience_fee'] = "3";

            # REQUEST SEND TO SSLCOMMERZ
            $direct_api_url = "https://sandbox.sslcommerz.com/gwprocess/v3/api.php";

            $handle = curl_init();
            curl_setopt($handle, CURLOPT_URL, $direct_api_url);
            curl_setopt($handle, CURLOPT_TIMEOUT, 30);
            curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 30);
            curl_setopt($handle, CURLOPT_POST, 1);
            curl_setopt($handle, CURLOPT_POSTFIELDS, $post_data);
            curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, FALSE); # KEEP IT FALSE IF YOU RUN FROM LOCAL PC

            $content = curl_exec($handle);

            $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

            if ($code == 200 && !(curl_errno($handle))) {
                curl_close($handle);
                $sslcommerzResponse = $content;
            } else {
                curl_close($handle);
                echo "FAILED TO CONNECT WITH SSLCOMMERZ API";
                exit;
            }

            # PARSE THE JSON RESPONSE
            $sslcz = json_decode($sslcommerzResponse, true);

            if (isset($sslcz['GatewayPageURL']) && $sslcz['GatewayPageURL'] != "") {
                # THERE ARE MANY WAYS TO REDIRECT - Javascript, Meta Tag or Php Header Redirect or Other
                # echo "<script>window.location.href = '". $sslcz['GatewayPageURL'] ."';</script>";
                echo "<meta http-equiv='refresh' content='0;
            url = " . $sslcz['GatewayPageURL'] . "'>";
                # header("Location: ". $sslcz['GatewayPageURL']);
                exit;
            } else {
                echo "JSON Data parsing error!";
            }

            $paymentStatus = checkPaymentStatus($sslcz['transaction_id']); // Implement this function based on your payment gateway's API

            if ($paymentStatus == 'SUCCESS') {
                // Send email

            } else {
                echo 'Payment failed or not verified.';
            }

        }

    } else {
        echo 'Not found any appointments to this apt.no';
    }
}

function validate($value)
{
    $value = trim($value);
    $value = stripslashes($value);
    $value = htmlspecialchars($value);
    return $value;
}

function checkPaymentStatus($transactionId)
{
    $url = 'https://sandbox.sslcommerz.com/validator/api/merchantTransIDvalidationAPI.php';
    // Use the appropriate URL for your environment ( sandbox or live )
    $store_id = 'medic65f5ce6be7c07';
    // Replace with your store ID
    $store_passwd = 'medic65f5ce6be7c07@ssl';
    // Replace with your store password

    $fields = [
        'val_id' => $transactionId,
        'store_id' => $store_id,
        'store_passwd' => $store_passwd,
        'format' => 'json'
    ];

    $handle = curl_init();
    curl_setopt($handle, CURLOPT_URL, $url);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($handle, CURLOPT_POST, true);
    curl_setopt($handle, CURLOPT_POSTFIELDS, http_build_query($fields));
    curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
    // SSL verification disabled for sandbox mode

    $response = curl_exec($handle);
    $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

    if ($code == 200 && !(curl_errno($handle))) {
        curl_close($handle);
        $result = json_decode($response, true);

        if (isset($result['status']) && $result['status'] == 'VALID') {
            return 'SUCCESS';
        } else {
            return 'FAILED';
        }
    } else {
        curl_close($handle);
        return 'FAILED';
    }
}

?>