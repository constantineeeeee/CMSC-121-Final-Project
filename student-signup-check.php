<?php
   $db = new PDO("mysql:dbname=inventory;host=localhost", "121", "121");
   $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
   $username = $_POST["username"];
   $password = $_POST["password"];
 
   $username = $db->quote($username);
   $password = $db->quote($password);
 
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
       echo "WARAY ACCOUNT";
     }
   }

?>