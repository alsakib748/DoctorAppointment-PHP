<?php

include "../inc/db.php";

if (isset($_POST["status"]) && $_POST["status"] == "loadSettingsData") {
    $sql = "SELECT * FROM `settings` WHERE `id` = 1";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        echo json_encode($row);
    }
}

if (isset($_POST["web_name"]) || isset($_FILES['web_img']['name']) || isset($_POST['web_url']) || isset($_POST['web_copyright']) || isset($_FILES['web_favicon']['name']) || isset($_POST["web_email1"]) || isset($_POST["web_email2"]) || isset($_POST["web_contact1"]) || isset($_POST["web_contact2"]) || isset($_POST["web_fax"]) || isset($_POST["web_whatsapp"]) || isset($_POST["web_address"])) {

    // echo print_r($_POST);
    // echo print_r($_FILES);
    // exit();

    $web_name = $_POST["web_name"];
    $web_img_name = $_FILES["web_img"]["name"];
    $web_img_size = $_FILES["web_img"]["size"];
    $web_url = $_POST["web_url"];
    $web_copyright = $_POST["web_copyright"];
    $web_favicon_name = $_FILES["web_favicon"]["name"];
    $web_favicon_size = $_FILES["web_favicon"]["size"];
    $web_email1 = $_POST["web_email1"];
    $web_email2 = $_POST["web_email2"];
    $web_contact1 = $_POST["web_contact1"];
    $web_contact2 = $_POST["web_contact2"];
    $web_fax = $_POST["web_fax"];
    $web_whatsapp = $_POST["web_whatsapp"];
    $web_address = $_POST["web_address"];

    if (!filter_var($web_email1, FILTER_SANITIZE_EMAIL)) {
        echo "First email address is not valid";
        exit();
    } else if (!filter_var($web_email2, FILTER_SANITIZE_EMAIL)) {
        echo "Second email address is not valid";
        exit();
    } else if (strlen($web_contact1) != 11 || strlen($web_contact2) != 11) {
        echo "Contact number must be 11 digit";
        exit();
    } else if (strlen($web_whatsapp) != 11) {
        echo "Whatsapp number must be 11 digit";
        exit();
    }

    // Todo: image existing data get to unlink image
    $res = mysqli_query($con, "SELECT `logo`,`favicon` FROM `settings` WHERE `id` = 1");
    $data = mysqli_fetch_assoc($res);

    if ($_FILES["web_img"]["name"] == "" && $_FILES["web_favicon"]["name"] == "") {
        $sql = "UPDATE `settings` SET `name`='$web_name',`url`='$web_url',`copyright`='$web_copyright', `femail`='$web_email1',`semail`='$web_email2',`fcontact`='$web_contact1',`scontact`='$web_contact2',`fax`='$web_fax',`whatsapp`='$web_whatsapp', `address`='$web_address' WHERE `id` = 1";

        if (mysqli_query($con, $sql)) {
            echo 1;
        } else {
            echo "Settings update failed !!";
        }
    } else if ($_FILES["web_img"]["name"] == "") {
        $favicon_extension = pathinfo($web_favicon_name, PATHINFO_EXTENSION);
        $favicon_supported_extension = array("jpg", "jpeg", "png");
        if ($web_favicon_size > 1024000) {
            echo "Favicon size must be less than 1 MB";
            exit();
        } else if (!in_array($favicon_extension, $favicon_supported_extension)) {
            echo "Invalid favicon image formats use (jpg, jpeg, png).";
            exit();
        } else {
            unlink("../images/settings/{$data['favicon']}");

            $favicon_rand_name = rand() . "." . $favicon_extension;
            $favicon_path = "../images/settings/{$favicon_rand_name}";
            move_uploaded_file($_FILES["web_favicon"]["tmp_name"], $favicon_path);

            $sql = "UPDATE `settings` SET `name`='$web_name',`url`='$web_url',`copyright`='$web_copyright',`favicon`='$favicon_rand_name', `femail`='$web_email1',`semail`='$web_email2',`fcontact`='$web_contact1',`scontact`='$web_contact2',`fax`='$web_fax',`whatsapp`='$web_whatsapp', `address`='$web_address' WHERE `id` = 1";

            if (mysqli_query($con, $sql)) {
                echo 1;
            } else {
                echo "Settings update failed !!";
            }
        }
    } else if ($_FILES["web_favicon"]["name"] == "") {
        $logo_extension = pathinfo($web_img_name, PATHINFO_EXTENSION);
        $logo_supported_extension = array("jpg", "jpeg", "png");
        if ($web_img_size > 1024000) {
            echo "Logo size must be less than 1 MB";
            exit();
        } else if (!in_array($logo_extension, $logo_supported_extension)) {
            echo "Invalid logo image format use(jpg,jpeg,png)";
            exit();
        } else {
            unlink("../images/settings/{$data['logo']}");

            $logo_rand_name = rand() . "." . $logo_extension;
            $logo_path = "../images/settings/{$logo_rand_name}";
            move_uploaded_file($_FILES["web_img"]["tmp_name"], $logo_path);

            $sql = "UPDATE `settings` SET `name`='$web_name',`url`='$web_url',`copyright`='$web_copyright',`logo`='$logo_rand_name', `femail`='$web_email1',`semail`='$web_email2',`fcontact`='$web_contact1',`scontact`='$web_contact2',`fax`='$web_fax',`whatsapp`='$web_whatsapp', `address`='$web_address' WHERE `id` = 1";

            if (mysqli_query($con, $sql)) {
                echo 1;
            } else {
                echo "Settings update failed !!";
            }
        }
    } else {
        // Todo: favicon unlink and new upload
        $favicon_extension = pathinfo($web_favicon_name, PATHINFO_EXTENSION);
        $favicon_supported_extension = array("jpg", "jpeg", "png");
        if ($web_favicon_size > 1024000) {
            echo "Favicon size must be less than 1 MB";
            exit();
        } else if (!in_array($favicon_extension, $favicon_supported_extension)) {
            echo "Invalid favicon image formats use (jpg, jpeg, png).";
            exit();
        } else {

            unlink("../images/settings/{$data['favicon']}");

            $favicon_rand_name = rand() . "." . $favicon_extension;
            $favicon_path = "../images/settings/{$favicon_rand_name}";
            move_uploaded_file($_FILES["web_favicon"]["tmp_name"], $favicon_path);
        }

        // Todo: logo unlink and new upload
        $logo_extension = pathinfo($web_img_name, PATHINFO_EXTENSION);
        $logo_supported_extension = array("jpg", "jpeg", "png");
        if ($web_img_size > 1024000) {
            echo "Logo size must be less than 1 MB";
            exit();
        } else if (!in_array($logo_extension, $logo_supported_extension)) {
            echo "Invalid logo image format use(jpg,jpeg,png)";
            exit();
        } else {
            unlink("../images/settings/{$data['logo']}");

            $logo_rand_name = rand() . "." . $logo_extension;
            $logo_path = "../images/settings/{$logo_rand_name}";
            move_uploaded_file($_FILES["web_img"]["tmp_name"], $logo_path);
        }

        $sql = "UPDATE `settings` SET `name`='$web_name',`url`='$web_url',`logo`='$logo_rand_name',`copyright`='$web_copyright',`favicon`='$favicon_rand_name', `femail`='$web_email1',`semail`='$web_email2',`fcontact`='$web_contact1',`scontact`='$web_contact2',`fax`='$web_fax',`whatsapp`='$web_whatsapp', `address`='$web_address' WHERE `id` = 1";

        if (mysqli_query($con, $sql)) {
            echo 1;
        } else {
            echo "Settings update failed !!";
        }
    }
}
