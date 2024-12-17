<?php
  session_start();

  include("top.html");
  include("db-connect.php");

  $id = (int)$_SESSION["id"];
  $items = $db->query("SELECT * FROM item");

  $borrow = $db->query("SELECT SID, IID, firstname, itemName, borrow.quantity, date, status 
                        FROM student 
                        JOIN borrow ON student.ID=borrow.SID 
                        JOIN item ON borrow.IID=item.itemID 
                        WHERE ID = $id");

  if(!isset($_SESSION["userCheck"])){
    header("Location: index.php");
    session_destroy();
  }
?>
  <div id="logout" hidden>LOGOUT</div>
  <div id="hrefLink" hidden>logout.php</div>
  <div id="homeLink" hidden>student-menu.php</div>
  <div id="bgImg" hidden>none</div>

  <h3 onload="showLogout()">Hello, <?= $_SESSION["firstName"] ?>! </h3>
  
  <div class="menu">

    <div class="borrowItems" id="borrowItems">
      <h2>BORROW ITEMS</h2>
      <form action="borrow-handle.php" method="post">
        <table class="borrowTable" >
          <tr>
            <th>Item</th>
            <th>Stock</th>
            <th>Quantity</th>
          </tr>
        <?php
          foreach($items as $item) { ?>
          <tr>
            <td>
              <?=$item["itemName"]?>: 
            </td>
            <td>
              <?= $item["quantity"] ?>
            </td>
            <td>
              <input type="number" placeholder="Qty" name="<?=$item["itemID"]?>Qty" min="0" max="<?=$item["quantity"]?>" size="8"> 
            </td>
          </tr>
        <?php } ?>
        </table>

        <input type="text" name="date" id="setDate" hidden >
        <input type="submit" onclick="setCurrentDate()" value="Request Items" class="reqBtn">
      </form>
      <button onclick="show('borrowItems')" class="reqBtn">Close</button>
    </div>
    
    <div class="showSlip" id="showSlip">
      <h2>BORROW SLIP</h2>
      <!-- <h3>Status:  ?></h3> -->
      <table>
        <tr>
          <th>Item</th>
          <th>Quantity</th>
          <th class="dBorrowDisplay">Date Borrowed</th>
          <th>Status</th>
          <th>Option</th>
        </tr>
        <?php
          foreach($borrow as $borrowItem){ ?>
            <tr>
              <td>
                <?= $borrowItem["itemName"]?>
              </td>
              <td>
                <?= $borrowItem["quantity"]?>
              </td>
              <td>
                <?=$borrowItem["date"] ?>
              </td>
              <td>
                <?=$borrowItem["status"] ?>
              </td>
              <td>
              <form action="return-handle.php" method="POST">
                <input type="hidden" name="IID" value="<?= $borrowItem["IID"] ?>" hidden>
                <input type="hidden" name="SID" value="<?= $borrowItem["SID"] ?>" hidden>
                <input type="hidden" name="quantity" value="<?= $borrowItem["quantity"] ?>" hidden>
                <input type="hidden" name="date" value="<?= $borrowItem["date"] ?>" hidden>
                <?php
                  if($borrowItem["status"] == "Confirmed") {
                ?>
                  <input class="reqBtn" type="submit" name="return" value="Return Item(s)">
                <?php  } else { ?>
                  <input class="reqBtn" type="submit" name="cancel" value="Cancel">
                <?php } ?>
              </form>
              </td>
            </tr>
        <?php }?>
      </table>
      <div class="editClose">
        <button class="btn" onclick="show('showSlip')">Close</button>
      </div>
    </div>


    <div class="menu2" id="menu2">
      <div class="borrow" id="borrow" onclick="show('borrowItems')" >
        <img src="assets/images/borrowslip.png" alt="" class="bLogimg" id="test" >
        <h2>Borrow Items</h2>
      </div>
      <div class="borrow" id="borrow" onclick="show('showSlip')">
        <img src="assets/images/receipt.png" alt="" class="bLogimg">
        <h2>Check Slip/Return Items</h2>
      </div>
    </div>
  </div>
<?php
  include("bottom.html");
?>
