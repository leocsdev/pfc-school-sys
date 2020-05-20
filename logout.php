<?php 
  session_start();
  unset($_SESSION['userLogin']);
  unset($_SESSION['access']);
  echo header("Location: index.php");
?>