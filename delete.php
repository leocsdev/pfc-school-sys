<?php
  // print_r($_POST);

  include_once("connections/connection.php");
  $con = dbConnect();

  if (isset($_POST['delete'])) {

    $id = $_POST['id'];

    $sql = "DELETE FROM `student_list` WHERE id = '$id'";
    $con->query($sql) or die ($con->error);

    // go back to index.php
    echo header("Location: index.php");
  }
?>