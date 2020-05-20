<?php
  
  if (!isset($_SESSION)) {
    session_start();
  }

  if (isset($_SESSION['access']) && $_SESSION['access'] == "administrator") {
    echo "Welcome ".$_SESSION['userLogin']."<br><br>";
  } else {
    echo header("Location: index.php");
  }

  include_once("connections/connection.php");

  $con = dbConnect();

  $id = $_GET['id'];

  $sql = "SELECT * FROM student_list WHERE id = '$id'";
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
  <form action="delete.php" method="post">
  <a href="index.php"><-Back</a>
  <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>  
    
    <?php if ($_SESSION['access'] == "administrator") { ?>
        <button type="submit" name="delete">Delete</button>
    <?php } ?>
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
  </form>
  <h2><?php echo $row['first_name']; ?> <?php echo $row['last_name']; ?></h2>
  <p>Gender: <strong><?php echo $row['gender']; ?></strong></p>
</body>
</html>