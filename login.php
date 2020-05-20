<?php

  // set session if there's none
  if (!isset($_SESSION)) {
    session_start();
  }

  include_once("connections/connection.php");

  $con = dbConnect();

  if (isset($_POST['login'])) {
    
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `student_users` WHERE username = '$username' AND password = '$password'";

    $user = $con->query($sql) or die ($con->error);
    $row = $user->fetch_assoc();
    $total = $user->num_rows;

    if ($total > 0) {
      $_SESSION['userLogin'] = $row['username'];
      $_SESSION['access'] = $row['access'];
      echo header("Location: index.php");
    } else {
      echo "No user found.";
    }
    
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
  <h1>Login</h1>
  <br>
  <form action="" method="post">
    <label for="username">Username</label>
    <input type="text" name="username" id="username">
    <label for="password">Password</label>
    <input type="password" name="password" id="password">
    <button type="submit" name="login">Login</button>
  </form>
</body>
</html>