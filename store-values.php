<?php
  $db = new PDO("mysql:dbname=inventory;host=localhost", "121", "121");
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $username = $_POST["username"];
  $password = $_POST["password"];

  $username = $db->quote($username);
  $password = $db->quote($password);  
?>