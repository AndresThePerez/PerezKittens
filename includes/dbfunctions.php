<?php 

function getKats() {
    include 'config.php';
    
    $sql = "SELECT id,name,subheading,description, DATE_FORMAT(dob, '%m/%d/%Y') as dob, picture_dir, status, reg_date FROM mainkittens WHERE STATUS = 'ACTIVE'";

    if($result = mysqli_query($link, $sql)) {
        $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    return $row;

}
?>