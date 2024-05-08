<?php 

    // echo $_FILES["dept_image"]["name"]."\n";

    // echo $_FILES["dept_image"]["type"]."\n";

    // echo $_FILES["dept_image"]["size"]."\n";

    // echo $_POST["dept_name"]."\n";
    include "../inc/db.php";

    if(isset($_GET["showDepartments"])){
        $sql = "SELECT * FROM `departments`";
        $result = mysqli_query($con,$sql);
        $output = "";
        if(mysqli_num_rows($result) > 0){
            $output .= "<table class='table table-striped table-light table-hover table-bordered'>
            <thead>
                <tr>
                    <th class='text-muted' scope='col'>ID</th>
                    <th class='text-muted' scope='col'>DEPARTMENT NAME</th>
                    <th class='text-muted' scope='col'>IMAGE</th>
                    <th class='text-muted' scope='col'>ACTION</th>
                </tr>
            </thead>
            <tbody>";
            $i = 1;
            while($row = mysqli_fetch_assoc($result)){
                $output .= "<tr>
                <td class='text-muted'>{$i}</td>
                <td>{$row['name']}</td>
                <td>
                    <img src='images/departments/{$row['avatar']}' class='img-fluid' width='60px' height='60px' />
                </td>
                <td>
                    <button type='submit' class='btn btn-primary btn-sm shadow-none edit-btn' id='edit-department' data-eid='{$row['id']}' data-bs-toggle='modal' data-bs-target='#departmentEditModal'> Edit </button>
                    <button type='submit' class='btn btn-danger btn-sm shadow-none' id='delete_department' data-did='{$row['id']}'>Delete</button>
                </td>
            </tr>";
            $i++;
            }
            $output .= "</tbody>
            </table>";
        }else{
            echo "<h5 class='text-center alert alert-danger'>Not Found Any Department!!</h5>";
            exit;
        }
        echo $output;
    }

    if(isset($_POST["dept_name"]) && isset ($_FILES["dept_image"]["name"])){
        if(!empty($_POST["dept_name"]) && !empty($_FILES["dept_image"]["name"])){
            $img_name = $_FILES["dept_image"]["name"];
            $img_size = $_FILES["dept_image"]["size"];
            $name = $_POST["dept_name"];
            $extension = pathinfo($img_name,PATHINFO_EXTENSION);
            $supported_extension = array("jpg","jpeg","png","webp");
            if(in_array($extension,$supported_extension)){
                if($img_size < 2096000){
                    $random_name = rand().".".$extension;
                    $path = "../images/departments/".$random_name;
                    if(move_uploaded_file($_FILES["dept_image"]["tmp_name"],$path)){
                        $sql = "INSERT INTO `departments`(`name`,`avatar`) VALUES('$name','$random_name')";
                        $result = mysqli_query($con,$sql);
                        if($result){
                            echo 1;
                        }else{
                            echo "File insert failed !!";
                        }
                    }
                }else{
                    echo "File Size is large use less than 2 MB image";
                }
            }else{
                echo "This file format is not valid";
            }

        }else{
            echo "File should not be empty !!";
        }
    }


    if(isset($_POST["edit"]) && $_POST["edit"] == "editDepartmentData"){
        $id = $_POST['id'];
        $sql = "SELECT * FROM `departments` WHERE `id` = $id";
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_assoc($result);
        echo json_encode($row);
    }

    if(isset($_POST["edit_dept_name"]) && isset($_FILES["edit_dept_image"]["name"])){
        // echo print_r($_POST);
        // echo print_r($_FILES);
        // exit;
        $edit_name = $_POST['edit_dept_name'];
        $edit_id = $_POST['edit_dept_id'];
        $edit_img_name = $_FILES["edit_dept_image"]["name"];
        $edit_img_size = $_FILES["edit_dept_image"]["size"];

        if(!empty($_POST["edit_dept_name"]) && !empty($_FILES["edit_dept_image"]["name"])){
            // if(empty($_FILES["edit_dept_image"]["name"])){
            //     $sql = "UPDATE `departments` SET `name`='{$edit_name}' WHERE `id` = {$edit_id} ";
            //     if(mysqli_query($con,$sql)){
            //         echo "Department Updated Successfully";
            //     }else{
            //         echo "Department Updated Failed!!";
            //     }
            // }else 
            // if(!empty($_POST["edit_dept_name"]) && !empty($_FILES["edit_dept_image"]["name"])){
                
                $extension = pathinfo($edit_img_name,PATHINFO_EXTENSION);

                $supported_extension = array("jpg","jpeg","png","webp");

                if(in_array($extension,$supported_extension)){
                    if($edit_img_size < 2096000){
                        $sql = "SELECT * FROM `departments` WHERE `id` = {$edit_id}";
                        $result = mysqli_query($con,$sql);
                        $row = mysqli_fetch_assoc($result);
                        $unlink_img_name = $row['avatar'];
                        $unlink_data = "../images/departments/{$unlink_img_name}";
                        unlink($unlink_data);
                        $img_new_name = rand().".".$extension;
                        $path = "../images/departments/".$img_new_name;
                        if(move_uploaded_file($_FILES["edit_dept_image"]["tmp_name"],$path)){
                            $edit_sql = "UPDATE `departments` SET `name` = '{$edit_name}' , `avatar` = '{$img_new_name}' WHERE `id` = {$edit_id} ";
                            $run_sql = mysqli_query($con,$edit_sql);
                            if($run_sql){
                                echo "Department Updated Successfully";
                            }else{
                                echo "Department Updated Failed !!";
                            }
                        }
                    }else{
                        echo "Image size is too large. use less 2 MB image";
                    }
                }else{
                    echo "Invalid Image Formats";
                }
            // }else{
            //     echo "you must be stay previous name in the input field";
            // }
        }
        else{
            echo "You must be update your full date. Otherwise its could not update!!";
        }    

    }
    
    if(isset($_POST['status']) && $_POST['status'] == "deleteDepartment"){
        $id = $_POST['id'];
        $query = mysqli_query($con,"SELECT * FROM `departments` WHERE `id` = {$id}");
        $result = mysqli_fetch_assoc($query);
        $existing_image = $result['avatar'];

        unlink("../images/departments/$existing_image");

        $del_query = mysqli_query($con,"DELETE FROM `departments` WHERE `id` = {$id}");

        if($del_query){
            echo "Department Deleted Successfully";
        }else{
            echo "Department Deleted Failed !!";
        }


        
    }

?>