<?php
  session_start();
  include("db-connect.php");

  $item_check = $db->query("SELECT * FROM item");

  // $read_user_details = file_get_contents("userDetails.json");
  // $user = json_decode($read_user_details, true);
  // $username = $user["username"];
  // $password = $user["password"]; 
  // $firstname = $user["firstname"]; 
  $SID = $_SESSION["id"];

  // $borrowedItems = $db->query("SELECT firstname, IID, itemName, borrow.quantity, date, status FROM student JOIN borrow ON student.ID=borrow.SID JOIN item ON borrow.IID=item.itemID WHERE ID = $SID");
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