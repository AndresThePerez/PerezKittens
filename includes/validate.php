<?php


function authenticate($data) {
  
  session_start();

  include("../includes/config.php");
  
  $query = "SELECT * from users where username = ?";

  
  $username = testInput($data['username']);
  $password = testInput($data['password']);
  $error = "";

  if($stmt = mysqli_prepare($link, $query)) {
    mysqli_stmt_bind_param($stmt, "s", $param_username);

    $param_username = $username;

    if(mysqli_stmt_execute($stmt)) {
      mysqli_stmt_store_result($stmt);

      if(mysqli_stmt_num_rows($stmt) == 1) {
        mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);

        if(mysqli_stmt_fetch($stmt)) {
          if(password_verify($password, $hashed_password)) {
            session_start();

            $_SESSION['loggedin'] = true;
            $_SESSION['id'] = $id;
            $_SESSION['username'] = $username;

            header("location: ../admin_page.php");
          } else {
            $error = "Invalid username or password";
          }
        }
      }
    }

    mysqli_stmt_close($stmt);
    mysqli_close($link);
  }

  if($error != "") {
          echo '<div class="container mt-2 w-50"><div class="alert alert-danger text-center">
                  <strong>Danger!</strong> '.$error.'
              </div></div>'; 
  }
}

function testInput($data) {
  $data = trim($data);
  $data = stripslashes($data);
//   $data = htmlspecialchars($data);
  return $data;
}



?>