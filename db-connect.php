<?php
  $db = new PDO("mysql:dbname=inventory;host=localhost", "121", "121");
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>