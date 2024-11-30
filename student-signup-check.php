<?php
   include("store-values.php");
   
   $status = $db->query("SELECT COUNT(*) FROM student WHERE username = $username");
 
   foreach($status as $row) {
     if($row["COUNT(*)"] == 1) {
       session_start();
       header("location: signup.php");
       echo "username is already taken";
     }
     else{
      $insert = $db->exec("INSERT INTO student VALUES($username, $password)");

       session_start();
       header("location: student-login.php");
     }
   }

?>