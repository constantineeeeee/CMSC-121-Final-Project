<?php
  include("top.html");

  session_start();

  if(!isset($_SESSION["username"])){
    header("Location: index.php");
    session_destroy();
  }
?>
    <div id="logout" hidden>LOGOUT</div>
    <div id="hrefLink" hidden>logout.php</div>
  
  <div class="menu">
    <div class="menu2">
    <a href="borrow-slip.php" >
      <div class="borrow">
        <img src="assets/images/borrowslip.png" alt="" class="bLogimg">
        <h2>Borrow Slip</h2>
      </div>
    </a>
    <a href="borrow-log.php" >
      <div class="borrow">
        <img src="assets/images/borrowLog.png" alt="">
        <h2>Borrow Log</h2>
      </div>
    </a>
      <a href="check-inventory.php" >
      <div class="borrow">
        <img src="assets/images/checkinv.png" alt="">
        <h2>Check Inventory</h2>
      </div>
    </a>
    <a href="return-log.php" >
      <div class="borrow">
        <img src="assets/images/returned.png" alt="">
        <h2>Returned Items</h2>
      </div>
    </a>
    </div>
  </div>

  
<?php 
  include("bottom.html");  
  ?>
