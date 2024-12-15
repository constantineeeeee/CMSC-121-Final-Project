<?php
  include("db-connect.php");
   
  $IID = $_POST["IID"];
  $SID = $_POST["SID"];
  $quantity = $_POST["quantity"];
  $date = $_POST["date"];

  $IID = (int)$IID;
  $SID = (int)$SID;
  $quantity = (int)$quantity;
  $date = $db->quote($date);

  if(isset($_POST["return"])){
    $return_init = $db->exec("INSERT INTO returned(SID, IID, quantity, date) VALUES($SID, $IID, $quantity, $date)"); 
    $update_inv = $db->exec("UPDATE item SET quantity = quantity + $quantity WHERE itemID = $IID"); 
    $del = $db->exec("DELETE FROM borrow WHERE SID = $SID AND IID = $IID AND date = $date"); 
  }
  else if(isset($_POST["cancel"])){
    $del = $db->exec("DELETE FROM borrow WHERE SID = $SID AND IID = $IID AND date = $date");
    $update_inv = $db->exec("UPDATE item SET quantity = quantity + $quantity WHERE itemID = $IID"); 
  }
  
  header("location: student-menu.php");
?>