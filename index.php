<?php
  
  if (!isset($_SESSION)) {
    session_start();
  }

  if (isset($_SESSION['userLogin'])) {
    echo "Welcome ".$_SESSION['userLogin'];
  } else {
    echo "Welcome Guest";
  }

  // include connection.php for db connection
  include_once("connections/connection.php");

  // call dbConnect function from connection.php and assign it to $con
  $con = dbConnect();

  // grab all student info from db and store them into $sql
  $sql = "SELECT * FROM `student_list` ORDER BY `id` DESC";
  $students = $con->query($sql) or die ($con->error);

  $row = $students->fetch_assoc();
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
  <h1>Student Management System</h1>
  <br>
  <?php
    if (isset($_SESSION['userLogin'])) { ?>
      <a href="logout.php">Logout</a>
      <a href="add.php">Add New</a>
    <?php } else { ?>
      <a href="login.php">Login</a>
    <?php } ?>
  <br><br>
  <form action="result.php" method="get">
    <input type="text" name="search" id="search">
    <button type="submit">Search</button>
  </form>

  <table>
    <thead>
      <tr>
        <th></th>
        <th>First Name</th>
        <th>Last Name</th>
      </tr>
    </thead>
    <tbody>
      <?php do { ?>
      <tr>
        <td><a href="details.php?id=<?php echo $row['id'] ?>">View</a></td>
        <td><?php echo $row['first_name']; ?></td>
        <td><?php echo $row['last_name']; ?></td>
      </tr>
      <?php } while($row = $students->fetch_assoc()); ?>
    </tbody>
  </table>
</body>
</html>