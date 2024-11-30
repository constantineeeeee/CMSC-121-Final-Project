<?php
  include("db-connect.php");
  include("user-values.php");

  $status = $db->query("SELECT COUNT(*), firstname, ID FROM student WHERE username = $username AND password = $password");

  foreach($status as $row) {
    if($row["COUNT(*)"] == 1) {
      $user_details = array(
        "username"=>$username,
        "password"=>$password,
        "firstname"=>$row["firstname"],
        "ID"=>$row["ID"]
      );
      $json_string = json_encode($user_details);
      $file_handle = fopen("userDetails.json", "w");
      fwrite($file_handle, $json_string);
      fclose($file_handle);

      header("location: student-menu.php"); 
    }
    else{
      header("location: student-login.php");
    }
  }
?>