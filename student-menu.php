<?php
  include("top.html");
  include("db-connect.php");
  include("get-user-details.php");


  $items = $db->query("SELECT * FROM item");

?>
  <div id="logout" hidden>LOGOUT</div>
  <div id="hrefLink" hidden>index.php</div>
  <h3 ="showLogout()">Hello, <?= $firstname ?>! </h3>
  
  <div class="menu">

    <div class="borrowItems" id="borrowItems">
      <form action="borrow-handle.php" method="post">
        <table>
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
              <input type="number" placeholder="Quantity" name="<?=$item["itemID"]?>Qty" min="0" max="<?=$item["quantity"]?>"> 
            </td>
          </tr>
        <?php } ?>
        </table>

        <input type="text" name="date" id="setDate" hidden>
        <input type="submit" onclick="setCurrentDate()" value="Request Items">
      </form>
      <button onclick="show()">Close</button>
    </div>

    <div class="menu2" id="menu2">
      <div class="borrow" id="borrow" onclick="show()" >
        <img src="assets/images/borrowslip.png" alt="" class="bLogimg" id="test" >
        <h2>Borrow Items</h2>
      </div>
      <div class="borrow" id="borrow">
        <img src="assets/images/receipt.png" alt="" class="bLogimg">
        <h2>Check Slip/Return Items</h2>
      </div>
      <div class="borrow" id="borrow">
        <img src="assets/images/list.png" alt="" class="bLogimg">
        <h2>Check Inventory</h2>
      </div>
    </div>
  </div>
<?php
  include("bottom.html");
?>
