<?php

session_start();

// Database connection configuration
$servername = "localhost";
$username = "root";  
$password = "";  
$dbname = "inventory";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to fetch detailed borrow records
function getBorrowedItemsDetails($conn) {
    $sql = "SELECT 
                b.SID, 
                s.firstname, 
                s.lastname, 
                b.IID, 
                i.itemName, 
                b.quantity, 
                b.date, 
                b.status
            FROM borrow b
            JOIN student s ON b.SID = s.ID
            JOIN item i ON b.IID = i.itemID
            ORDER BY b.status, s.lastname, s.firstname";
    
    $result = $conn->query($sql);
    
    $borrowedItems = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $borrowedItems[] = $row;
        }
    }
    return $borrowedItems;
}

// Fetch borrowed items details
$borrowedItems = getBorrowedItemsDetails($conn);

// Function to get status color
function getStatusColor($status) {
    switch($status) {
        case 'Confirmed':
            return 'green';
        case 'Pending':
            return 'orange';
        case 'Rejected':
            return 'red';
        default:
            return 'black';
    }
}
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

  <h1>Borrowed Items Details</h1>

<div class="summary">
    <?php
    // Calculate summary statistics
    $totalBorrows = count($borrowedItems);
    $statusCounts = [
        'Confirmed' => 0,
        'Pending' => 0,
        'Rejected' => 0
    ];

    $itemQuantities = [];

    foreach ($borrowedItems as $item) {
        $statusCounts[$item['status']]++;
        
        // Track item quantities
        if (!isset($itemQuantities[$item['itemName']])) {
            $itemQuantities[$item['itemName']] = 0;
        }
        $itemQuantities[$item['itemName']] += $item['quantity'];
    }
    ?>
    <h3>Borrow Summary</h3>
    <p>
        Total Borrow Requests: <?= $totalBorrows; ?><br>
        Confirmed Borrows: <?= $statusCounts['Confirmed']; ?><br>
        Pending Borrows: <?= $statusCounts['Pending']; ?><br>
        Rejected Borrows: <?= $statusCounts['Rejected']; ?>
    </p>
    
    <h3>Item Quantities Borrowed</h3>
    <ul>
        <?php foreach ($itemQuantities as $itemName => $quantity): ?>
            <li><?php echo htmlspecialchars($itemName); ?>: <?php echo $quantity; ?></li>
        <?php endforeach; ?>
    </ul>
</div>

<table>
    <thead>
        <tr>
            <th>Student ID</th>
            <th>Student</th>
            <th>Item</th>
            <th>Quantity</th>
            <th>Borrow Date</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($borrowedItems as $item): ?>
        <tr>
            <td><?=$item['SID'] ?></td>
            <td><?=$item['firstname'] . ' ' . $item['lastname'] ?></td>
            <td><?=$item['itemName'] ?></td>
            <td><?=$item['quantity'] ?></td>
            <td><?=$item['date'] ?: 'N/A' ?></td>
            <td class="status status-<?php echo strtolower($item['status']); ?>">
                <?=$item['status'] ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>


  <?php 
  include("bottom.html");  
?>