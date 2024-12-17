<?php
  include("db-connect.php");
  include("user-values.php");

  $status = $db->query("SELECT username, COUNT(*), firstname, ID FROM student WHERE username = $username AND password = $password");

  foreach($status as $row) {
    if($row["COUNT(*)"] == 1) {
      header("location: student-menu.php");
      session_start();

      $_SESSION["username"] = $row["username"];
      $_SESSION["firstName"] = $row["firstname"];
      $_SESSION["id"] = $row["ID"];
      $_SESSION["userCheck"] = true; 
    }
    else{
      header("location: student-login.php");
      session_start();
      $_SESSION["failed"] = true;
    }
  }
?>