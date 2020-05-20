<?php

  // connect the web app to db
  function dbConnect() {
    $host = "localhost";
    $username = "root";
    $password = "root123";
    $database = "pfc_student_system";

    $con = new mysqli($host, $username, $password, $database);

    // check db connection if there are errors
    if ($con->connect_error) {
      echo $con->connect_error;
    } else {
      return $con;
    }
  }
?>