<?php
   include("user-values.php");
   
   $status = $db->query("SELECT COUNT(*) FROM student WHERE username = $username");

   $firstname = $_POST["firstname"];
   $lastname = $_POST["lastname"];
 
   $firstname = $db->quote($firstname);
   $lastname = $db->quote($lastname );
 
   foreach($status as $row) {
     if($row["COUNT(*)"] == 1) {
       session_start();
       header("location: signup.php");
       echo "username is already taken";
     }
     else{
      $insert = $db->exec("INSERT INTO student(username, password, firstname, lastname) VALUES($username, $password, $firstname, $lastname)");

      header("location: student-login.php");
     }
   }

?>