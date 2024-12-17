<?php
  include("db-connect.php");
  include("user-values.php");
  
  $status = $db->query("SELECT COUNT(*), username FROM admin WHERE username = $username AND password = $password");

  foreach($status as $row) {
    if($row["COUNT(*)"] == 1) {

      header("location: admin-menu.php"); 
      session_start();
      $_SESSION["username"] = $row["username"];
      $_SESSION["adminUserCheck"] = true;
    }
    else{
      header("location: admin-login.php");
      session_start();
      $_SESSION["failed"] = true;
    }
  }
?>