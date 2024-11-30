<?php
  include("db-connect.php");
  $username = $_POST["username"];
  $password = $_POST["password"];

  $username = $db->quote($username);
  $password = $db->quote($password);

?>