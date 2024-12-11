<?php
  include("top.html");
  include("db-connect.php");
  include("get-user-details.php");


  $items = $db->query("SELECT * FROM item");

  $borrow = $db->query("SELECT firstname, itemName, borrow.quantity, date, status FROM student JOIN borrow ON student.ID=borrow.SID JOIN item ON borrow.IID=item.itemID WHERE ID = $SID");


?>
  <div id="logout" hidden>LOGOUT</div>
  <div id="hrefLink" hidden>index.php</div>
  <h3 onload="showLogout()">Hello, <?= $firstname ?>! </h3>
  
  <div class="menu">

    <div class="borrowItems" id="borrowItems">
      <form action="borrow-handle.php" method="post">
        <table >
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
        <input type="submit" onclick="setCurrentDate()" value="Request Items" class="btn">
      </form>
      <button onclick="show('borrowItems')" class="btn">Close</button>
    </div>
    
    <div class="showSlip" id="showSlip">
      <h2>BORROW SLIP</h2>
      <h3>Status: <?php foreach($borrow as $b) { ?> <?=$b["status"] ?> <?php break; } ?></h3>
      <table>
        <tr>
          <th>Item</th>
          <th>Quantity</th>
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
            </tr>
        <?php }?>
      </table>
      <div class="editClose">
        <button class="btn">Edit</button>
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
      <!-- <div class="borrow" id="borrow">
        <img src="assets/images/list.png" alt="" class="bLogimg">
        <h2>Check Inventory</h2>
      </div> -->
    </div>
  </div>
<?php
  include("bottom.html");
?>
