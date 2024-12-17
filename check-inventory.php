<?php
session_start();
// inventory.php
// Database connection details
$servername = "localhost";
$username = "121";  // Replace with your database username
$password = "121";  // Replace with your database password
$dbname = "inventory";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to get available items
$sql = "SELECT itemName, quantity FROM item WHERE quantity > 0";
$result = $conn->query($sql);

// Store items in an array
$inventory_items = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $inventory_items[] = $row;
    }
}

// Close connection
$conn->close();
?>

<?php
  include("top.html");
  if(!isset($_SESSION["adminUserCheck"])){
    header("Location: index.php");
    session_destroy();
  }

?>
  <div id="logout" hidden>LOGOUT</div>
  <div id="hrefLink" hidden>logout.php</div>
  <div id="homeLink" hidden>admin-menu.php</div>
  <div id="bgImg" hidden>none</div>

  <a class="backButton" href="admin-menu.php">&#9664;</a>

  <h1>Available Inventory</h1>
    
    <?php if (!empty($inventory_items)): ?>
        <table>
            <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($inventory_items as $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['itemName']); ?></td>
                        <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No items available in inventory.</p>
    <?php endif; ?>


  <?php 
  include("bottom.html");  
?>