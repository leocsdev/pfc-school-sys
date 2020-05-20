<?php
  include_once("connections/connection.php");

  // call dbConnect function from connection.php and assign it to $con
  $con = dbConnect(); 

  // add student info to db
  if (isset($_POST['submit'])) {
    
    $fname = $_POST['first-name'];
    $lname = $_POST['last-name'];
    $gender = $_POST['gender'];
    
    $sql = "INSERT INTO `student_list`(`first_name`, `last_name`, `gender`) VALUES ('$fname', '$lname', '$gender')";

    $con->query($sql) or die ($con->error);

    // go back to homepage
    echo header("Location: index.php");
  }

  
?> 

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <title>Student Management System</title>
</head>
<body>
  <form action="" method="post">
    <label for="first-name">Firs Name</label>
    <input type="text" name="first-name" id="first-name">

    <label for="last-name">Last Name</label>
    <input type="text" name="last-name" id="last-name">

    <label for="gender">Gender</label>
    <select name="gender" id="gender">
      <option value="Male">Male</option>
      <option value="Female">Female</option>
    </select>
    

    <input type="submit" name="submit" value="Add Student">
  </form>
</body>
</html>