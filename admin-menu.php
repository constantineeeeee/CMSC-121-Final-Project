<?php
  include("top.html");
  include("store-values.php");
  $status = $db->query("SELECT COUNT(*) FROM admin WHERE username = $username AND password = $password");

  foreach($status as $row) {
    if($row["COUNT(*)"] == 1) { ?>
      <div class="menu">
        <div class="menu2">
          <div class="borrow">
            <img src="assets/images/borrowslip.png" alt="" class="bLogimg">
            <h2>Borrow Slip</h2>
          </div>
          <div class="borrow">
            <img src="assets/images/borrowLog.png" alt="">
            <h2>Borrow Log</h2>
          </div>
          <div class="borrow">
            <img src="assets/images/borrowLog.png" alt="">
            <h2>Check Inventory</h2>
          </div>
        </div>
      </div> ?>
<?php include("bottom.html");
    }
    else{
      session_start();
      header("location: admin-login.php");
    }
  }
?>
