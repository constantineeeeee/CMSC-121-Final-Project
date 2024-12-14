<?php
// Database connection configuration
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

// Function to fetch detailed returned records
function getReturnedItemsDetails($conn) {
    $sql = "SELECT 
                r.SID,
                s.firstname, 
                s.lastname, 
                i.itemName, 
                r.quantity, 
                r.date
            FROM returned r
            JOIN student s ON r.SID = s.ID
            JOIN item i ON r.IID = i.itemID
            ORDER BY r.date ASC";
    
    $result = $conn->query($sql);
    
    $returnedItems = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $returnedItems[] = $row;
        }
    }
    return $returnedItems;
}

// Fetch returned items details
$returnedItems = getReturnedItemsDetails($conn);

?>

<?php
  include("top.html");
?>
  <div id="logout" hidden>LOGOUT</div>
  <div id="hrefLink" hidden>index.php</div>
  <a class="backButton" href="admin-menu.php">&#9664;</a>
  <h1>Return Log</h1>


<table>
    <thead>
        <tr>
            <th>Student ID</th>
            <th>Student</th>
            <th>Item</th>
            <th>Quantity</th>
            <th>Return Date</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($returnedItems as $item): ?>
        <tr>
            <td><?=$item['SID'] ?></td>
            <td><?=$item['firstname'] . ' ' . $item['lastname'] ?></td>
            <td><?=$item['itemName'] ?></td>
            <td><?=$item['quantity'] ?></td>
            <td><?=$item['date'] ?: 'N/A' ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>


  <?php 
  include("bottom.html");  
?>