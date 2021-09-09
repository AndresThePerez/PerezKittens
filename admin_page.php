<?php

  session_start();

    if(!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== true){
      header("Location: /actions/login.php");
    }

    if(isset($_POST['submit'])) {
        include 'includes/actionfunctions.php';
        insert_values();
    }

    if(isset($_POST['submit_edit'])) {
        include 'includes/actionfunctions.php';
        edit_values();
    }

    include 'includes/dbfunctions.php';
    $array = getKats();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1 class="text-center mb-10 admin">Admin Page</h1>

<div class="container w-75">
    <div class="d-flex justify-content-end mb-2">
        <button class="btn-primary btn" data-toggle="modal" data-target="#new-entry-modal">Add New Entry</button>
        <a href="actions/logout.php" class="btn btn-danger ml-3">Sign Out</a>
    </div>
        <table class='table'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Subheading</th>
                    <th>Date of Birth</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                foreach($array as $entry) {
                    echo "<tr>";
                        echo "<td>".$entry['id']."</td>";
                        echo "<td>".$entry['name']."</td>";
                        echo "<td>".$entry['subheading']."</td>";
                        echo "<td>".$entry['dob']."</td>";
                        echo "<td>".$entry['description']."</td>";
                        echo "<td><a class='btn btn-secondary' data-toggle='modal' data-target='#edit-entry-modal-".$entry['id']."'>Edit</a>
                                <a class='btn btn-danger' onClick=\"javascript: return confirm('Please confirm deletion');\" href='/actions/delete.php?id=".$entry['id']."'>Delete</a>
                            </td>";
                    echo "</tr>";
                }
            ?>
            </tbody>
        </table>
    </div>
    
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
</html>

<!-- Modal -->
<div class="modal fade" id="new-entry-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="" method="post" href="admin_page.php" enctype="multipart/form-data">
        <div class="row">
            <div class="col-6">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="" required></input>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-6">
                <label for="subheading">Subheading</label>
                <input type="text" class="form-control" id="subheading" name="subheading" value="" required></input>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-6">
                <label for="subheading">Date Of Birth</label>
                <input type="text" class="date form-control" id="date" name="date" value="" required></input>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-12">
                <label for="description">Description</label>
                <textarea type="text" class="form-control" id="description" name="description" value="" required></textarea>
            </div>
        </div>
        <br>
        <label>Upload Your Image
            <input type="file" name="file" required/>
        </label>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" name="submit" value="Upload" class="btn btn-primary">
        </form>
      </div>
    </div>
  </div>
</div>


  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script>
  $(function () {
    $(".date").datepicker();
  });
</script>




<?php 
foreach ($array as $entry) {
?>

<div class="modal fade" id="edit-entry-modal-<?php echo $entry['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="/admin_page.php" method="post">
        <div class="row">
            <div class="col-6">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $entry['name'] ?>" required></input>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-6">
                <label for="subheading">Subheading</label>
                <input type="text" class="form-control" id="subheading" name="subheading" value="<?php echo $entry['subheading'] ?>" required></input>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-6">
                <label for="subheading">Date Of Birth</label>
                <input type="text" class="date form-control" id="date_<?php echo $entry['id'] ?>" name="date" value="<?php echo $entry['dob'] ?>" required></input>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-12">
                <label for="description">Description</label>
                <textarea type="text" class="form-control" id="description" name="description" required><?php echo $entry['description'] ?></textarea>
            </div>
        </div>
      </div>
      <div class="modal-footer">
      <input type="hidden" class="form-control" id="name_old" name="name_old" value="<?php echo $entry['name'] ?>"></input>
      <input type="hidden" class="form-control" id="subheading_old" name="subheading_old" value="<?php echo $entry['subheading'] ?>"></input>
      <input type="hidden" class="form-control" id="description_old" name="description_old" value="<?php echo $entry['description'] ?>"></input>
      <input type="hidden" class="form-control" id="date_old" name="date_old" value="<?php echo $entry['dob'] ?>"></input>
      <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $entry['id'] ?>"></input>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" name="submit_edit" value="Edit" class="btn btn-primary">
        </form>
      </div>
    </div>
  </div>
</div>

  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<?php }?>