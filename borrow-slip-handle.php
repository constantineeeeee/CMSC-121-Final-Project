<?php
  include("db-connect.php");

  $borrow_check = $db->query("SELECT * FROM borrow");

  $read_user_details = file_get_contents("userDetails.json");
  $user = json_decode($read_user_details, true);
  $username = $user["username"];
  $password = $user["password"]; 
  $firstname = $user["firstname"]; 
  $SID = $user["ID"];

  foreach($item_check as $item) {
    
  }
?>