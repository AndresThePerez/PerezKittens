<?php
    function insert_values() {
        extract($_POST);
        include 'includes/config.php';
        $statusMsg = '';

        // File upload path
        $targetDir = "uploads/";
        $fileName = basename(strtolower($_FILES["file"]["name"]));
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
        
        if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])){
            // Allow certain file formats
            $allowTypes = array('jpg','png','jpeg','gif','pdf');
            if(in_array($fileType, $allowTypes)){
                // Upload file to server
                if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
                    // Insert image file name into database
                    $date = date("Y-m-d", strtotime($date));
                    $stmt = mysqli_prepare($link, "INSERT INTO mainkittens (name, subheading, description, dob, picture_dir, status, reg_date) VALUES (?,?,?,?,?,'ACTIVE',NOW())");
                    mysqli_stmt_bind_param($stmt, 'sssss', $name, $subheading, $description, $date, $targetFilePath);
                    mysqli_stmt_execute($stmt);
                    if(mysqli_stmt_affected_rows($stmt) == 1){
                        $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
                    }else{
                        $statusMsg = "File upload failed, please try again.";
                    } 
                }else{
                    $statusMsg = "Sorry, there was an error uploading your file.";
                }
            }else{
                $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
            }
        }else{
            $statusMsg = 'Please select a file to upload.';
        }

            // Display status message
    echo $statusMsg;
    mysqli_stmt_close($stmt);
    mysqli_close($link);
    }

    function edit_values() {
        include "includes/config.php";
        extract($_POST);


        if($description == $description_old
            && $name == $name_old
            && $subheading == $subheading_old
            && $date == $date_old) {
                echo '<div class="container mt-2 w-50"><div class="alert alert-danger text-center">
                <strong>Danger!</strong> No changes detected.
                    </div></div>';
        }

        $sql = "UPDATE mainkittens SET name = ?, subheading = ?, description = ?, dob = ? where id = ?";

        $date = date("Y-m-d", strtotime($date));
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, "ssssi", $name, $subheading, $description, $date, $id);
        if(!mysqli_stmt_execute($stmt)) {
            echo '<div class="container mt-2 w-50"><div class="alert alert-danger text-center">
                    <strong>Danger!</strong> Something went wrong
                </div></div>';
        }
        mysqli_stmt_close($stmt);
        mysqli_close($link);
    }

?>