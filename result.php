<?php
  
  if (!isset($_SESSION)) {
    session_start();
  }

  if (isset($_SESSION['userLogin'])) {
    echo "Welcome ".$_SESSION['userLogin'];
  } else {
    echo "Welcome Guest";
  }

  include_once("connections/connection.php");

  $con = dbConnect();
  $search = $_GET['search'];
  // $sql = "SELECT * FROM student_list ORDER BY  id DESC";
  $sql = "SELECT * FROM `student_list` WHERE `first_name` LIKE '%$search%' || `last_name` LIKE '%$search%' ORDER BY `id` DESC";
  $students = $con->query($sql) or die ($con->error);

  $row = $students->fetch_assoc();
  $total = $students->num_rows;

   
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
        <?php if ($total > 0) { ?>
          <tr>
            <td><a href="details.php?id=<?php echo $row['id'] ?>">View</a></td>
            <td><?php echo $row['first_name']; ?></td>
            <td><?php echo $row['last_name']; ?></td>
          </tr>
        <?php } else { ?>
          <tr>
            <td colspan="3">No match found.</td>
          </tr>
        <?php } ?>
      <?php } while($row = $students->fetch_assoc()); ?>
    </tbody>
  </table>
</body>
</html>