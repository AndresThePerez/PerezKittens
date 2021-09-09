<?php

    include "../includes/config.php";
    $id = $_GET['id'];


    $stmt = mysqli_prepare($link, "UPDATE mainkittens SET status = 'INACTIVE' WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 'i', $id);
    if(mysqli_stmt_execute($stmt)) {
        header("Location: /admin_page.php");
    } else {
        echo '<div class="container mt-2 w-50"><div class="alert alert-danger text-center">
                <strong>Danger!</strong> Something went wrong
            </div></div>';
    }
    mysqli_stmt_close($stmt);
    mysqli_close($link);
?>