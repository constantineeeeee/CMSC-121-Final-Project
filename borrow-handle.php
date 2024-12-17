<?php
  session_start();

  if(!isset($_SESSION["userCheck"])){
    header("Location: index.php");
    session_destroy();
  }

  include("db-connect.php");

  $item_check = $db->query("SELECT * FROM item");

  $SID = $_SESSION["id"];

  $borrowedItems = $db->query("SELECT * FROM borrow WHERE SID = $SID");

  foreach($item_check as $item) {
    try {
      $current_itemID = $item["itemID"];
      $quantity_check = $_POST[$current_itemID."Qty"];

      $date = $_POST["date"];
      $date = $db->quote($date);

      if($quantity_check != 0) {
        $borrow_init = $db->exec("INSERT INTO borrow(SID, IID, quantity, date) VALUES($SID, $current_itemID, $quantity_check, $date) ");
        $update_inv = $db->exec("UPDATE item SET quantity = quantity - $quantity_check WHERE itemID = $current_itemID");
      }
      else {
        continue;
      }
  } catch (Exception $e) {
    header("location: student-menu.php");
  }
}
header("location: student-menu.php");

?>