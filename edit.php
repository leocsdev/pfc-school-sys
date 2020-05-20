<?php
  include_once("connections/connection.php");

  $con = dbConnect(); 
  $id = $_GET['id'];

  $sql = "SELECT * FROM student_list WHERE id = '$id'";
  $students = $con->query($sql) or die ($con->error);
  $row = $students->fetch_assoc();

  if (isset($_POST['submit'])) {
    
    $fname = $_POST['first-name'];
    $lname = $_POST['last-name'];
    $gender = $_POST['gender'];
    

    $sql = "UPDATE `student_list` SET `first_name`='$fname', `last_name`='$lname', `gender`='$gender' WHERE id = '$id'";
    
    $con->query($sql) or die ($con->error);

    // go back to details.php
    echo header("Location: details.php?id=".$id);
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
    <input type="text" name="first-name" id="first-name" value="<?php echo $row['first_name'] ?>">

    <label for="last-name">Last Name</label>
    <input type="text" name="last-name" id="last-name" value="<?php echo $row['last_name'] ?>">

    <label for="gender">Gender</label>
    <select name="gender" id="gender">
      <option value="Male" <?php echo($row['gender'] == "Male") ? 'selected' : ''; ?>>Male</option>
      <option value="Female" <?php echo($row['gender'] == "Female") ? 'selected' : ''; ?>>Female</option>
    </select>
    

    <input type="submit" name="submit" value="Update Student">
  </form>
</body>
</html>