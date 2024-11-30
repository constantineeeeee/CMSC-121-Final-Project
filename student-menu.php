<?php
  include("top.html");
  include("store-values.php");

  $status = $db->query("SELECT COUNT(*) FROM student WHERE username = $username AND password = $password");

  foreach($status as $row) {
    if($row["COUNT(*)"] == 1) { ?>
      <div class="menu">

      <div class="borrowItems" id="borrowItems">
        <form action="borrow-handle.php" method="post">
          <label>Graduated Cylinder: <input type="number" placeholder="Quantity"></label> <br/>
          <label>Beaker: <input type="number"></label>
          <input type="submit" onclick="show()">
        </form>
        <button onclick="show()">Close</button>
      </div>


        <div class="menu2">
          <div class="borrow" onclick="show()">
            <img src="assets/images/borrowslip.png" alt="" class="bLogimg" id="test" >
            <h2>Borrow Items</h2>
          </div>
          <div class="borrow">
            <img src="assets/images/receipt.png" alt="" class="bLogimg">
            <h2>Check Slip/Return Items</h2>
          </div>
          <div class="borrow">
            <img src="assets/images/list.png" alt="" class="bLogimg">
            <h2>Check Inventory</h2>
          </div>
        </div>
      </div>

<?php
    include("bottom.html");
    }
    else{
      session_start();
      header("location: student-login.php");
    }
  }
?>
